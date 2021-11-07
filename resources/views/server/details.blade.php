@extends('layouts.app')

@section('content')

    <div class="content">
        @if(!empty($server->serverUpdate()->hostbanner_gfx_url))
            <div class="row">
                <div class="col">
                    <a class="block block-rounded block-link-pop" href="{{ $server->serverUpdate()->hostbanner_url }}"
                       target="_blank">
                        <img class="block block-rounded block-link-pop"
                             src="{{ $server->serverUpdate()->hostbanner_gfx_url }}" alt="{{ $server->address }}"
                             style="width: 100%;margin-bottom: unset!important;">
                    </a>
                </div>
            </div>
        @endif
        <div class="row">
            <div class="col">
                <a class="block block-rounded block-link-pop text-center p-3" href="javascript:void(0)">
                    <div class="font-size-h1 font-w300 text-black">{{$server->serverUpdate()->data()[0]['name']}}</div>
                </a>
            </div>
        </div>
        <div class="row">
            <div class="col-md-6">

                <div class="row">
                    <div class="col-6 col-md-6 js-appear-enabled animated fadeIn" data-toggle="appear">
                        <a class="block block-rounded block-link-pop text-center" href="javascript:void(0)">
                            <div
                                class="block-content block-content-full aspect-ratio-16-9 d-flex justify-content-center align-items-center">
                                <div>
                                    <div
                                        class="font-size-h1 font-w300 text-black">{{ $server->serverUpdate()->last_online_count }}
                                        / {{ $server->serverUpdate()->getSlots() }}</div>
                                    <div class="font-w600 mt-2 text-uppercase text-muted">Clients</div>
                                </div>
                            </div>
                        </a>
                    </div>
                    <div class="col-6 col-md-6 js-appear-enabled animated fadeIn" data-toggle="appear">
                        <a class="block block-rounded block-link-pop text-center" href="javascript:void(0)">
                            <div
                                class="block-content block-content-full aspect-ratio-16-9 d-flex justify-content-center align-items-center">
                                <div>
                                    <div class="font-size-h1 font-w300 text-black">{{ $server->votes }}</div>
                                    <div class="font-w600 mt-2 text-uppercase text-muted">Votes</div>
                                </div>
                            </div>
                        </a>
                    </div>
                    <div class="col-6 col-md-6 js-appear-enabled animated fadeIn" data-toggle="appear">
                        <a class="block block-rounded block-link-pop text-center" href="javascript:void(0)">
                            <div
                                class="block-content block-content-full aspect-ratio-16-9 d-flex justify-content-center align-items-center">
                                <div>
                                    <div
                                        class="font-size-h1 font-w300 text-black">{{ empty($server->serverUpdate()->current_online) ? 'Offline':'Online' }}</div>
                                    <div class="font-w600 mt-2 text-uppercase text-muted">Status</div>
                                </div>
                            </div>
                        </a>
                    </div>
                    <div class="col-6 col-md-6 js-appear-enabled animated fadeIn" data-toggle="appear">
                        <a class="block block-rounded block-link-pop text-center" href="javascript:void(0)">
                            <div
                                class="block-content block-content-full aspect-ratio-16-9 d-flex justify-content-center align-items-center">
                                <div>
                                    <div
                                        class="font-size-h1 font-w300 text-black">{{ count($server->serverUpdate()->getChannels()) }}</div>
                                    <div class="font-w600 mt-2 text-uppercase text-muted">Channels</div>
                                </div>
                            </div>
                        </a>
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-12">
                        <a class="block block-rounded block-link-pop text-center p-3" href="javascript:void(0)">
                            <button class="btn btn-hero-primary col"
                                    onclick="window.location.href = '{{ route('servers.vote', [$server->id]) }}'">Vote
                            </button>
                        </a>
                    </div>
                    <div class="col-md-12">
                        <a class="block block-rounded block-link-pop text-center p-3" href="javascript:void(0)">
                            <button class="btn btn-hero-primary col"
                                    onclick="window.location.href = 'ts3server://{{ $server->address }}'">Connect
                            </button>
                        </a>
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-12 col-xl-12">
                        <div class="block">
                            <div class="block-content block-content-full">
                                <a class="block block-rounded block-link-rotate bg-body-dark mb-2"
                                   href="javascript:void(0)">
                                    <div
                                        class="block-content block-content-sm block-content-full d-flex align-items-center justify-content-between">
                                        <div class="mr-3">
                                            <p class="font-size-h3 font-w300 mb-0">
                                                {{ $server->country }}
                                            </p>
                                            <p class="text-muted font-italic mb-0">
                                                Country
                                            </p>
                                        </div>
                                        <div class="item">
                                            <img class="text-muted" height="40"
                                                 src="{{ asset('/assets/media/lands/4x3/'.strtolower(array_search($server->country, \Monarobase\CountryList\CountryListFacade::getList('en', 'php'))).'.svg') }}">
                                        </div>
                                    </div>
                                </a>
                                <a class="block block-rounded block-link-rotate bg-body-dark mb-2"
                                   href="javascript:void(0)">
                                    <div
                                        class="block-content block-content-sm block-content-full d-flex align-items-center justify-content-between">
                                        <div class="mr-3">
                                            <p class="font-size-h3 font-w300 mb-0">
                                                {{ $server->serverUpdate()->getVersion() }}
                                            </p>
                                            <p class="text-muted font-italic mb-0">
                                                Version
                                            </p>
                                        </div>
                                        <div class="item">
                                            <i class="fab fa-2x fa-teamspeak text-muted"></i>
                                        </div>
                                    </div>
                                </a>
                                <a class="block block-rounded block-link-rotate bg-body-dark mb-2"
                                   href="javascript:void(0)">
                                    <div
                                        class="block-content block-content-sm block-content-full d-flex align-items-center justify-content-between">
                                        <div class="mr-3">
                                            <p class="font-size-h3 font-w300 mb-0">
                                                {{ $server->serverUpdate()->getPlatform() }}
                                            </p>
                                            <p class="text-muted font-italic mb-0">
                                                Platform
                                            </p>
                                        </div>
                                        <div class="item">
                                            <i class="fab fa-2x fa-{{ $server->serverUpdate()->getPlatform()=='Linux'?'linux':'windows' }} text-muted"></i>
                                        </div>
                                    </div>
                                </a>
                                <a class="block block-rounded block-link-rotate bg-body-dark mb-0"
                                   href="javascript:void(0)">
                                    <div
                                        class="block-content block-content-sm block-content-full d-flex align-items-center justify-content-between">
                                        <div class="mr-3">
                                            <p class="font-size-h3 font-w300 mb-0">
                                                {{ $server->serverUpdate()->security_level }}
                                            </p>
                                            <p class="text-muted font-italic mb-0">
                                                Security Level
                                            </p>
                                        </div>
                                        <div class="item">
                                            <object class="text-muted" height="48"
                                                    data="{{ asset('/assets/media/icons/security_level.svg') }}"
                                                    type="image/svg+xml">
                                            </object>
                                        </div>
                                    </div>
                                </a>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-12 col-xl-12">
                        <div class="block">
                            <div class="block-content block-content-full">
                                <a class="block block-rounded block-link-rotate bg-body-dark mb-2"
                                   href="javascript:void(0)">
                                    <div
                                        class="block-content block-content-sm block-content-full d-flex align-items-center justify-content-between">
                                        <div class="mr-3">
                                            <p class="font-size-h3 font-w300 mb-0">
                                                {{ \Carbon\Carbon::createFromTimestamp($server->serverUpdate()->server_created) }}
                                            </p>
                                            <p class="text-muted font-italic mb-0">
                                                Created on
                                            </p>
                                        </div>
                                        <div class="item">
                                            <object class="text-muted" height="48" type="image/svg+xml"
                                                    data="{{ asset('/assets/media/icons/created_server_time.svg') }}">
                                            </object>
                                        </div>
                                    </div>
                                </a>
                                <a class="block block-rounded block-link-rotate bg-body-dark mb-2"
                                   href="javascript:void(0)">
                                    <div
                                        class="block-content block-content-sm block-content-full d-flex align-items-center justify-content-between">
                                        <div class="mr-3">
                                            <p class="font-size-h3 font-w300 mb-0">
                                                {{ empty($server->serverUpdate()->name_phonetic)?'???':$server->serverUpdate()->name_phonetic }}
                                            </p>
                                            <p class="text-muted font-italic mb-0">
                                                Name phonetic
                                            </p>
                                        </div>
                                        <div class="item">
                                            <object class="text-muted" height="48" type="image/svg+xml"
                                                    data="{{ asset('/assets/media/icons/phonetics_nickname.svg') }}">
                                            </object>
                                        </div>
                                    </div>
                                </a>
                                <a class="block block-rounded block-link-rotate bg-body-dark mb-2"
                                   href="javascript:void(0)">
                                    <div
                                        class="block-content block-content-sm block-content-full d-flex align-items-center justify-content-between">
                                        <div class="mr-3">
                                            <p class="font-size-h3 font-w300 mb-0">
                                                {{ $server->serverUpdate()->reserved_slots }}
                                            </p>
                                            <p class="text-muted font-italic mb-0">
                                                Reserved slots
                                            </p>
                                        </div>
                                        <div class="item">
                                            <object class="text-muted" height="48"
                                                    data="{{ asset('/assets/media/icons/reserved-slots.svg') }}"
                                                    type="image/svg+xml"></object>
                                        </div>
                                    </div>
                                </a>
                                <a class="block block-rounded block-link-rotate bg-body-dark mb-0"
                                   href="javascript:void(0)">
                                    <div
                                        class="block-content block-content-sm block-content-full d-flex align-items-center justify-content-between">
                                        <div class="mr-3">
                                            <p class="font-size-h3 font-w300 mb-0">
                                                {{ $server->serverUpdate()->ping }}ms
                                            </p>
                                            <p class="text-muted font-italic mb-0">
                                                Ping
                                            </p>
                                        </div>
                                        <div class="item">
                                            <object class="text-muted" height="48" type="image/svg+xml"
                                                    data="{{ asset('/assets/media/icons/'.$server->getPingImage()) }}">
                                            </object>
                                        </div>
                                    </div>
                                </a>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col">
                        <a class="block block-rounded p-3 block-link-pop" href="javascript:void(0)">
                            <div class="font-size-h2 font-w300 text-black text-center">Welcome Message of the Server:
                            </div>

                            <div
                                class="font-size-h5 font-w300 text-black">{{ $server->serverUpdate()->getProps()['welcmsg'] }}</div>
                        </a>
                    </div>
                </div>
                <div class="row">
                    <div class="col">
                        <a class="block block-rounded block-link-pop" href="javascript:void(0)">
                            <div
                                class="block-content  block-bordered block-content-sm block-content-full d-flex align-items-center align-content-between">
                                <div class="item mr-3">
                                    <object type="image/svg+xml" class="text-muted" height="48"
                                            data="{{ asset('/assets/media/icons/status_last_scan.svg') }}">
                                    </object>
                                </div>
                                <p class="font-size-h3 font-w300 mb-0">
                                    Last scan
                                </p>
                                <div class="ml-2">

                                    <p class="text-muted font-italic mb-0">
                                        {{ $server->serverUpdate()->updated_at }}
                                    </p>
                                </div>
                            </div>
                            <div
                                class="block-content block-content-sm block-content-full d-flex align-items-center align-content-between">
                                <div class="item mr-3">
                                    <object type="image/svg+xml" class="text-muted" height="48"
                                            data="{{ asset('/assets/media/icons/status_online.scan.svg') }}">
                                    </object>
                                </div>
                                <p class="font-size-h3 font-w300 mb-0">
                                    Last online
                                </p>
                                <div class="ml-2">

                                    <p class="text-muted font-italic mb-0">
                                        {{ $server->serverUpdate()->last_online }}
                                    </p>
                                </div>
                            </div>
                            <div
                                class="block-content block-content-sm block-content-full d-flex align-items-center align-content-between">
                                <div class="item mr-3">
                                    <object class="text-muted" height="48" type="image/svg+xml"
                                            data="{{ asset('/assets/media/icons/status_offline_scan.svg') }}">
                                    </object>
                                </div>
                                <p class="font-size-h3 font-w300 mb-0">
                                    Last offline
                                </p>
                                <div class="ml-2">

                                    <p class="text-muted font-italic mb-0">
                                        {{ empty($server->serverUpdate()->last_offline)?'Never':$server->serverUpdate()->last_offline }}
                                    </p>
                                </div>
                            </div>
                        </a>

                    </div>
                </div>

            </div>
            <div class="col-md-6">
                <a class="block block block-rounded block-link-pop p-3" href="javascript:void(0)">
                    @include('server.server-view', ['server' => $server, 'serverView' => $serverView] )
                </a>
            </div>
        </div>
    </div>

@endsection

@section('css_after')
    <link rel="stylesheet" href="{{ asset('/assets/js/plugins/nestable2/jquery.nestable.min.css') }}">

@endsection

@section('js_after')
    <script src="{{ asset('/assets/js/plugins/nestable2/jquery.nestable.min.js') }}"></script>

    <script>
        $('#serverView').nestable({handleClass: '123'});

    </script>
@endsection
