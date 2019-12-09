@extends('layouts.app')

@section('content')
    @if(count($accounts) > 0)
        <select class="custom-select">
            @foreach($accounts as $account)
                <option value="{{$account["id"]}}">{{$account["currency"]}}</option>
            @endforeach
        </select>
    @else


    <div class="col-md-10">
        <div class="card">
            <div class="card-header">Exchanges</div>

            <div class="card-body">
                <div class="alert alert-danger" role="alert">
                    no accounts recorded on this exchange
                </div>
            </div>
        </div>
    </div>

    @endif

@endsection
