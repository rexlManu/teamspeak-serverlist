@extends('layouts.app')
@section('content')
    <div class="content">
        @if (session()->has('success'))
            <div class="alert alert-success d-flex align-items-center" role="alert">
                <div class="flex-00-auto">
                    <i class="fa fa-fw fa-check"></i>
                </div>
                <div class="flex-fill ml-3">
                    <p class="mb-0">{{ session('success') }}</p>
                </div>
            </div>
        @endif
        <div class="row">
            <div class="col-md-12">
                <div class="block block-themed">
                    <div class="block-header bg">
                        <h3 class="block-title">Add server to list</h3>
                    </div>
                    <div class="block-content">
                        <form action="{{ route('servers.create') }}" method="POST">
                            @csrf
                            <div class="form-group form-row">
                                <div class="col-12 col-md-4 pt-1">
                                    <label>Server address / Domain</label>
                                    <input type="text" name="address"
                                           class="form-control @error('address') is-invalid @enderror"
                                           value="{{ old('address') }}">
                                    @error('address')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                    @enderror
                                </div>
                                <div class="col-3 col-md-2 pt-1">
                                    <label>Country</label>
                                    <select class="js-select2 form-control @error('country') is-invalid @enderror"
                                            name="country" data-placeholder="Choose one..">
                                        <option></option>
                                        @foreach(\Monarobase\CountryList\CountryListFacade::getList('en') as $country)
                                            <option value="{{ $country }}" @if(old('country') == $country) selected @endif >{{ $country }}</option>
                                        @endforeach
                                    </select>

                                    @error('country')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                    @enderror
                                </div>
                                <div class="col-md-3 pt-1">
                                    <label>Server Port</label>
                                    <input type="number" name="port" value="{{ old('port', 9987) }}"
                                           class="form-control @error('port') is-invalid @enderror">
                                    @error('port')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                    @enderror
                                </div>
                                <div class="col-md-3 pt-1">
                                    <label>Server Query port</label>
                                    <input type="number" name="query_port" value="{{ old('query_port', 10011) }}"
                                           class="form-control @error('query_port') is-invalid @enderror">
                                    @error('query_port')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                    @enderror
                                </div>
                            </div>
                            <div class="custom-control custom-checkbox custom-control-primary mb-1">
                                <input type="checkbox"
                                       {{ empty(old('permission')) ? '' : 'checked' }} class="custom-control-input @error('permission') is-invalid @enderror"
                                       id="permission" name="permission">
                                <label class="custom-control-label" for="permission">I confirm that I am authorized to
                                    add this TeamSpeak and that I agree that the entered TeamSpeak will be publicly
                                    viewable on this website.</label>
                                @error('permission')
                                <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                            <div class="text-center">
                                <button type="submit" class="btn btn-hero-primary mt-2 mb-3 col-md-3">Add to list</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-md-12">
                <div class="block block-themed">
                    <div class="block-header bg">
                        <h3 class="block-title">Information</h3>
                    </div>
                    <div class="block-content">
                        <h5>To add your server to our list, the guest group needs the following additional
                            permissions:</h5>
                        <ul>
                            <li>b_virtualserver_info_view</li>
                            <li>b_virtualserver_channel_list</li>
                            <li>b_virtualserver_client_list</li>
                            <li>b_virtualserver_servergroup_list</li>
                            <li>b_virtualserver_channelgroup_list</li>
                        </ul>
                        <h5>More information</h5>
                        <ul>
                            <li>These permissions are needed so we can get the necessary information from your server
                                that our system need to add it to the list.
                            </li>
                            <li>The permissions are not a security risk and can be added to the guest group without
                                hesitation.
                            </li>
                            <li>The permissions can be added via the "Advanced permission system".</li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

@section('js_after')
    <script src="{{ asset('assets/js/plugins/select2/js/select2.full.min.js') }}"></script>
    <script>jQuery(function () {
            Dashmix.helpers(['select2']);
        });</script>
@endsection

@section('css_before')
    <link rel="stylesheet" href="{{ asset('assets/js/plugins/select2/css/select2.min.css') }}">
@endsection
