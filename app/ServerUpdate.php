<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class ServerUpdate extends Model
{

    public function data()
    {
        return json_decode($this->last_data, true);
    }

    public function getOnlineClients()
    {
        return array_filter($this->data(), function ($object) {
            return $object['class'] == 'client' && $object['image'] != 'client-query';
        });
    }

    public function getChannels()
    {
        return array_filter($this->data(), function ($object) {
            return $object['class'] == 'channel';
        });
    }

    public function isLocked(){
        return $this->data()[0]['image'] == 'server-pass';
    }

    public function isOpen(){
        return $this->data()[0]['image'] == 'server-open';
    }

    public function getProps(){
        return $this->data()[0]['props'];
    }

    public function getSlots(){
        return $this->getProps()['slots'];
    }

    public function getPlatform(){
        return $this->getProps()['platform'];
    }
    public function getVersion(){
        return $this->getProps()['version'];
    }

}
