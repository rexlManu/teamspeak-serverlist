<?php

namespace App;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;

class Server extends Model
{
    protected $fillable = ["address", "port", "query_port", "votes", "country"];

    public function serverUpdate(): ServerUpdate
    {
        $serverUpdate = ServerUpdate::all()->where('server_id', $this->id)->first();
        if (!empty($serverUpdate)) return $serverUpdate;
        $serverUpdate = new ServerUpdate();
        $serverUpdate->server_id = $this->id;
        $serverUpdate->current_online = Carbon::now()->addDays(-10);
        $serverUpdate->save();
        return $serverUpdate;
    }

    public function hasUpdate()
    {
        return !empty($this->serverUpdate()->last_data);
    }

    public function resolveAddress()
    {
        $resolve = dns_get_record('_ts3._udp.' . $this->address);
        $address = $this->address;
        if (!filter_var($address, FILTER_VALIDATE_IP, FILTER_FLAG_IPV4)) {
            // SRV RECORD CHECK
            if (is_array($resolve) && empty(!$resolve[0]) && array_key_exists('target', $resolve[0])) {
                $address = $resolve[0]['target'];
            } else {
                $address = gethostbyname($this->address);
            }
        }
        return $address;
    }

    public function getPingImage()
    {
        $ping = $this->serverUpdate()->ping;
        if ($ping == 0){
            return 'ping_disconnected.svg';
        }
        if ($ping < 50) {
            return 'ping_connection_4.svg';
        } else if ($ping < 100) {
            return 'ping_connection_3.svg';
        } else if ($ping < 250) {
            return 'ping_connection_2.svg';
        } else if ($ping < 500) {
            return 'ping_connection_1.svg';
        }
    }
}
