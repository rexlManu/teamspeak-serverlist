<?php

namespace App\Console;

use App\Server;
use App\ServerUpdate;
use Carbon\Carbon;
use Illuminate\Console\Scheduling\Schedule;
use Illuminate\Foundation\Console\Kernel as ConsoleKernel;
use TeamSpeak3;
use TeamSpeak3_Exception;
use TeamSpeak3_Viewer_Html;
use TeamSpeak3_Viewer_Json;

class Kernel extends ConsoleKernel
{
    /**
     * The Artisan commands provided by your application.
     *
     * @var array
     */
    protected $commands = [
        //
    ];

    /**
     * Define the application's command schedule.
     *
     * @param \Illuminate\Console\Scheduling\Schedule $schedule
     * @return void
     */
    protected function schedule(Schedule $schedule)
    {
        // $schedule->command('inspire')
        //          ->hourly();

        $schedule->call(function () {
            foreach (Server::all() as $server) {
                $serverUpdate = $server->serverUpdate();
                try {
                    $address = $server->resolveAddress();
                    $ts3_VirtualServer = TeamSpeak3::factory("serverquery://" . $address . ":" . $server->query_port . "/?server_port=" . $server->port . '&nickname=' . env('APP_NAME'));
                    $serverUpdate->last_data = $ts3_VirtualServer->getViewer(new TeamSpeak3_Viewer_Json ());
                    $serverUpdate->last_online_count = $ts3_VirtualServer->clientCount();
                    $serverUpdate->html_view = $ts3_VirtualServer->getViewer(new TeamSpeak3_Viewer_Html("/images/viewer/", "/images/flags/", "data:image"));
                    $serverUpdate->security_level = $ts3_VirtualServer['virtualserver_needed_identity_security_level'];
                    $serverUpdate->reserved_slots = $ts3_VirtualServer['virtualserver_reserved_slots'];
                    $serverUpdate->hostbutton_tooltip = $ts3_VirtualServer['virtualserver_hostbutton_tooltip'];
                    $serverUpdate->hostbutton_url = $ts3_VirtualServer['virtualserver_hostbutton_url'];
                    $serverUpdate->hostbutton_gfx_url = $ts3_VirtualServer['virtualserver_hostbutton_gfx_url'];
                    $serverUpdate->hostbanner_url = $ts3_VirtualServer['virtualserver_hostbanner_url'];
                    $serverUpdate->hostbanner_gfx_url = $ts3_VirtualServer['virtualserver_hostbanner_gfx_url'];
                    $serverUpdate->server_created = $ts3_VirtualServer['virtualserver_created'];
                    $serverUpdate->name_phonetic = $ts3_VirtualServer['virtualserver_name_phonetic'];
                    $serverUpdate->ping = $ts3_VirtualServer['virtualserver_total_ping'];

                    if (!empty($serverUpdate->current_online) && $this->isOlderThen24Hours($serverUpdate->current_online)) {
                        $serverUpdate->days_online++;
                        $serverUpdate->current_online = Carbon::now();
                    }

                    if (empty($serverUpdate->last_online)) {
                        $serverUpdate->last_online = Carbon::now();
                    }

                    if (empty($serverUpdate->current_online) && !empty($serverUpdate->current_offline)) {
                        $serverUpdate->current_offline = null;
                        $serverUpdate->current_online = Carbon::now();
                        $serverUpdate->last_offline = Carbon::now();
                        $serverUpdate->days_offline = 0;
                        $serverUpdate->days_online++;
                    }
                } catch (TeamSpeak3_Exception $e) {

                    if (empty($serverUpdate->last_offline)) {
                        $serverUpdate->last_offline = Carbon::now();
                    }

                    if (!empty($serverUpdate->current_offline) && $this->isOlderThen24Hours($serverUpdate->current_offline)) {
                        $serverUpdate->days_offline++;
                        $serverUpdate->current_offline = Carbon::now();
                    }

                    if (empty($serverUpdate->current_offline) && !empty($serverUpdate->current_online)) {
                        $serverUpdate->current_online = null;
                        $serverUpdate->current_offline = Carbon::now();
                        $serverUpdate->last_online = Carbon::now();
                        $serverUpdate->days_online = 0;
                        $serverUpdate->days_offline++;
                    }
                }
                $serverUpdate->save();
            }
        })->everyMinute();
    }

    function isOlderThen24Hours($date)
    {
        $dateInTime = strtotime($date);
        return ($dateInTime + 86400) < time();
    }

    /**
     * Register the commands for the application.
     *
     * @return void
     */
    protected function commands()
    {
        $this->load(__DIR__ . '/Commands');

        require base_path('routes/console.php');
    }
}
