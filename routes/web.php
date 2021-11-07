<?php

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

use App\Server;
use Carbon\Carbon;
use Illuminate\Support\Facades\Route;
use Spatie\Dns\Dns;

Route::get('/', function () {
    return view('welcome');
});

Auth::routes(['register' => false]);

Route::view('servers/create', 'server.create')->name('servers.create.view');
Route::view('servers', 'server.list')->name('servers.list.view');
Route::post('servers/create', 'ServerController@addServer')->name('servers.create');
Route::get('servers/{id}', 'ServerController@details')->name('servers.details');
Route::get('servers/{id}/vote', 'ServerController@vote')->name('servers.vote');

Route::prefix('admin')->middleware(['auth'])->group(function () {
    Route::view('/', 'admin.dashboard');
    Route::view('/servers', 'admin.servers')->name('admin.servers');
    Route::post('/servers/delete', 'AdminController@deleteServer')->name('admin.servers.delete')->middleware(['ajax']);
    Route::get('/logout', function () {
        \Illuminate\Support\Facades\Auth::logout();
        return redirect('/login');
    })->name('logout');
});

Route::get('debug', function () {

    return response()->json(Server::all()->first()->serverUpdate()->data());

    $data = Server::all()->last()->serverUpdate()->data();

    function getLayersByIdent($ident, $data)
    {
        return array_filter($data, function ($sub) use ($ident, $data) {
            return $sub['parent'] == $ident;
        });
    }

    function loadParent($layer, $data)
    {
        foreach (getLayersByIdent($layer['ident'], $data) as $layer) {
            echo '>>>>'.$layer['name'] . '<br>';
            loadParent($layer, $data);
        }
    }
    foreach (getLayersByIdent($data[0]['ident'], $data) as $layer) {
        echo $layer['name'] . '<br>';
        loadParent($layer, $data);
    }

    return;


    return response()->json(Server::all()->first()->serverUpdate()->data());

    $server = Server::all()->first();
    $address = $server->resolveAddress();
    $ts3_VirtualServer = TeamSpeak3::factory("serverquery://" . $address . ":" . $server->query_port . "/?server_port=" . $server->port);
    return $ts3_VirtualServer->getViewer(new \App\Teamspeak\BetterTeamspeakView("/images/viewer/", "/images/flags/", "data:image"));

    return response()->json(Server::all()->first()->serverUpdate()->data());

    return json_encode(array_search('Germany', \Monarobase\CountryList\CountryListFacade::getList('en', 'php')));
    return;
    return response()->json(Server::all()->first()->serverUpdate()->data());

    function isOlderThen24Hours($date)
    {
        $dateInTime = strtotime($date);
        echo $dateInTime + 86400;
        echo '<br>';
        echo time();
        return ($dateInTime + 86400) < time();
    }

    foreach (Server::all() as $server) {
        $serverUpdate = $server->serverUpdate();
        try {
            $address = $server->resolveAddress();
            $ts3_VirtualServer = TeamSpeak3::factory("serverquery://" . $address . ":" . $server->query_port . "/?server_port=" . $server->port);
            $serverUpdate->last_data = $ts3_VirtualServer->getViewer(new TeamSpeak3_Viewer_Json ());


            if (!empty($serverUpdate->current_online) && isOlderThen24Hours($serverUpdate->current_online)) {
                $serverUpdate->days_online++;
                $serverUpdate->current_online = Carbon::now();
            }

            if (empty($serverUpdate->current_online) && !empty($serverUpdate->current_offline)) {
                $serverUpdate->current_offline = null;
                $serverUpdate->current_online = Carbon::now();
                $serverUpdate->last_online = Carbon::now();
                $serverUpdate->days_offline = 0;
                $serverUpdate->days_online++;
            }
        } catch (TeamSpeak3_Exception $e) {
            if (!empty($serverUpdate->current_offline) && isOlderThen24Hours($serverUpdate->current_offline)) {
                $serverUpdate->days_offline++;
                $serverUpdate->current_offline = Carbon::now();
            }

            if (empty($serverUpdate->current_offline) && !empty($serverUpdate->current_online)) {
                $serverUpdate->current_online = null;
                $serverUpdate->current_offline = Carbon::now();
                $serverUpdate->last_offline = Carbon::now();
                $serverUpdate->days_online = 0;
                $serverUpdate->days_offline++;
            }
        }
        $serverUpdate->save();
    }

    return;

    $input = 'ts.servnode.de';
    $resolve = dns_get_record('_ts3._udp.' . $input);
    // SRV RECORD CHECK
    if (is_array($resolve) && empty(!$resolve[0]) && array_key_exists('target', $resolve[0])) {
        return $resolve[0]['target'] . ':' . $resolve[0]['port'];
    } else {
        return gethostbyname($input);
    }
    return;
    try {
        $server = \App\Server::all()->first();
        // IPv4 connection URI
        $uri = "serverquery://51.77.168.224:10011/?server_port=9987";
        //dd(dns_get_record('_ts3._udp.plocic.de'));

        //dd(gethostbyname("plocic.de"));
        // connect to above specified server, authenticate and spawn an object for the virtual server on port 9987
        $ts3_VirtualServer = TeamSpeak3::factory($uri);

        return response()->json(json_decode($ts3_VirtualServer->getViewer(new TeamSpeak3_Viewer_Json ())));

        //dd($ts3_VirtualServer->clientCount());
        //dd($ts3_VirtualServer['virtualserver_name']);
        //dd(count($ts3_VirtualServer->channelList()));
        //dd($ts3_VirtualServer->channelGetDefault());
        //dd($ts3_VirtualServer->channelGetDefault());

        // spawn an object for the channel using a specified name
        //$ts3_Channel = $ts3_VirtualServer->channelGetByName("I do not exist");
    } catch (TeamSpeak3_Exception $e) {
        // print the error message returned by the server
        echo "Error " . $e->getCode() . ": " . $e->getMessage();
    }

});
