@extends('layouts.app')


@section('content')
<div class="container">
    
    
    <div class="row justify-content-center">
            @if (count($exchanges) > 0)
                @yield('list-grid')
            @else
            <div class="col-md-10">
                <div class="card">
                    <div class="card-header">Exchanges</div>

                    <div class="card-body">
                            <div class="alert alert-danger" role="alert">
                                no exchange recorded on this account
                            </div>
                    </div>
                </div>
            </div>
            @endif

        </div>
    </div>
@endsection
