<?php


namespace App\Http\Controllers;


use App\Server;
use Illuminate\Http\Request;

class AdminController extends Controller
{

    public function deleteServer(Request $request)
    {
        $server = Server::all()->where('id', $request->get('server_id'))->first();
        if (empty($server)) {
            return abort(404);
        }
        $server->delete();
        return response()->json(['success' => true]);
    }

}
