@extends('layouts.app')

@section('content')
    <div class="content">
        <div class="row">
            <div class="col-md-12">
                <div class="block block-themed">
                    <div class="block-header bg">
                        <h3 class="block-title">Servers</h3>
                    </div>
                    <div class="block-content pb-3">
                        <table class="table table-striped table-responsive display js-dataTable-full" style="">
                            <thead>
                            <tr>
                                <th>Votes</th>
                                <th>Name</th>
                                <th>Country</th>
                                <th>Status</th>
                                <th>Clients</th>
                                <th>Since</th>
                                <th>Uptime</th>
                                <th>Downtime</th>
                            </tr>
                            </thead>
                            <tbody>
                            @foreach (\App\Server::all() as $server)
                                @if ($server->hasUpdate())
                                    <tr class="">
                                        <td class="">{{ $server->votes }}</td>
                                        <td>
                                            <a href="{{ route('servers.details', [$server->id]) }}">{{ json_decode($server->serverUpdate()->last_data, true)[0]['name'] }}</a>
                                        </td>
                                        <td class="">{{ $server->country }}</td>
                                        <td>{!! empty($server->serverUpdate()->current_online)?'<span class="nav-main-link-badge badge badge-pill badge-danger">Offline</span>':'<span class="nav-main-link-badge badge badge-pill badge-success">Online</span>' !!}</td>
                                        <td>{{ $server->serverUpdate()->last_online_count }}
                                            / {{ $server->serverUpdate()->getSlots() }}</td>
                                        <td>{{ $server->created_at }}</td>
                                        <td>{{ $server->serverUpdate()->days_online }} days</td>
                                        <td>{{ $server->serverUpdate()->days_offline }} days</td>

                                    </tr>
                                @endif
                            @endforeach
                            </tbody>
                        </table>

                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

@section('css_before')
    <!-- Page JS Plugins CSS -->
    <link rel="stylesheet" href="{{ asset('assets/js/plugins/datatables/dataTables.bootstrap4.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/js/plugins/datatables/buttons-bs4/buttons.bootstrap4.min.css') }}">
@endsection

@section('js_after')
    <!-- Page JS Plugins -->
    <script src="{{ asset('assets/js/plugins/datatables/jquery.dataTables.min.js') }}"></script>
    <script src="{{ asset('assets/js/plugins/datatables/dataTables.bootstrap4.min.js') }}"></script>
    <script src="{{ asset('assets/js/plugins/datatables/buttons/dataTables.buttons.min.js') }}"></script>
    <script src="{{ asset('assets/js/plugins/datatables/buttons/buttons.print.min.js') }}"></script>
    <script src="{{ asset('assets/js/plugins/datatables/buttons/buttons.html5.min.js') }}"></script>
    <script src="{{ asset('assets/js/plugins/datatables/buttons/buttons.flash.min.js') }}"></script>
    <script src="{{ asset('assets/js/plugins/datatables/buttons/buttons.colVis.min.js') }}"></script>

    <!-- Page JS Code -->
    <script src="{{ asset('datatables.js') }}"></script>

    <script>
    </script>
@endsection
