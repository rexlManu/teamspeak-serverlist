<?php


namespace App\Http\Controllers;


use App\Server;
use App\Teamspeak\ViewHandler;
use App\VoteHistory;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use MongoDB\Driver\Manager;
use TeamSpeak3;
use TeamSpeak3_Exception;
use TeamSpeak3_Viewer_Json;

class ServerController extends Controller
{

    public function addServer(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'address' => ['required', 'string', 'max:64', 'min:3'],
            'port' => ['required', 'integer', 'min:1', 'max:65536'],
            'query_port' => ['required', 'integer', 'min:1', 'max:65536'],
            'permission' => ['required'],
            'country' => ['required', 'string']
        ]);
        if ($validator->fails()) {
            return back()->withInput()->withErrors($validator->errors());
        }


        if (!in_array($request->get('country'), \Monarobase\CountryList\CountryListFacade::getList('en'))) {
            return back()->withInput()->withErrors(['country' => 'illegal country']);
        }

        $server = Server::all()->where('address', strtolower($request->get('address')))->where('port', $request->get('port'))->first();
        if (!empty($server)) {
            alert()->error('Server was already added to list!', 'Error!');
            return back()->withInput();
        }

        $resolve = dns_get_record('_ts3._udp.' . $request->get('address'));
        $address = $request->get('address');
        if (!filter_var($address, FILTER_VALIDATE_IP, FILTER_FLAG_IPV4)) {
            // SRV RECORD CHECK
            if (is_array($resolve) && empty(!$resolve[0]) && array_key_exists('target', $resolve[0])) {
                $address = $resolve[0]['target'];
            } else {
                $address = gethostbyname($request->get('address'));
            }
        }

        try {
            $ts3_VirtualServer = TeamSpeak3::factory("serverquery://" . $address . ":" . $request->get('query_port') . "/?server_port=" . $request->get('port'));
            if (!$ts3_VirtualServer->isOnline()) {
                alert()->error('Server is offline.', 'Error!');
                return back()->withInput();
            }

        } catch (TeamSpeak3_Exception $e) {
            alert()->error($e->getMessage(), 'Error!');
            return back()->withInput();
        }

        $server = new Server($request->all());
        $server->address = strtolower($server->address);
        $server->save();

        alert()->success('Server was added successfully!', 'Success!');
        return back();
    }

    public function vote($id)
    {
        $server = Server::all()->where('id', $id)->first();
        if (empty($server)) {
            return abort(404);
        }

        $address = \Illuminate\Support\Facades\Request::ip();
        $voteHistory = VoteHistory::all()->where('address', $address)->where('server_id', $server->id)->first();
        if (empty($voteHistory)) {
            $server->votes++;
            $server->save();
            $voteHistory = new VoteHistory();
            $voteHistory->server_id = $server->id;
            $voteHistory->address = $address;
            $voteHistory->user_agent = \Illuminate\Support\Facades\Request::userAgent();
            $voteHistory->save();
            alert()->success('Your vote was successful!', 'Success!');
            return back();
        }

        if ($this->isOlderThen24Hours($voteHistory->updated_at)) {
            $server->votes++;
            $server->save();
            $voteHistory->updated_at = Carbon::now();
            $voteHistory->save();
            alert()->success('Your vote was successful!', 'Success!');
            return back();
        }

        alert()->error('You\'re already voted for this server!', 'Error!');
        return back();
    }

    function isOlderThen24Hours($date)
    {
        $dateInTime = strtotime($date);
        return ($dateInTime + 86400) < time();
    }

    public function details($id)
    {
        $server = Server::all()->where('id', $id)->first();
        if (empty($server)) {
            return abort(404);
        }
        $data = $server->serverUpdate()->data();

        $viewHandler = new ViewHandler($data);
        $serverView = $viewHandler->getView();

        return view('server.details', compact(['server', 'serverView']));
    }

}
