@extends('layouts.app')


@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-10">
                <div class="card">
                    <div class="card-header">Exchanges</div>

                    <div class="card-body">
                        @if (count($exchanges) > 0)
                            @foreach($exchanges as $exchange)
                                <div class="alert alert-success" role="alert">
                                    {{ $exchange->connexion_name }} <br>
                                    {{ $exchange->api_key }} <br>
                                    {{ $exchange->api_secret }} <br>
                                    {{ $exchange->api_passphrase }}
                                </div>
                            @endforeach
                        @else
                            <div class="alert alert-danger" role="alert">
                                no exchange recorded on this account
                            </div>
                        @endif
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
