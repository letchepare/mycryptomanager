@extends('exchanges.list')
@section('list-grid')
<table class="table">
  <thead>
    <tr>
      <th scope="col">Connexion Name</th>
      <th scope="col">Api key</th>
      <th scope="col">Api secret</th>
      <th scope="col">Api Passphrase</th>
    </tr>
  </thead>
  <tbody>
      @foreach ($exchanges as $exchange)
          
        <tr>
          <th scope="row">{{$exchange->connexion_name}}</th>
          <td>{{$exchange->api_key}}</td>
          <td>{{$exchange->api_secret}}</td>
          <td>{{$exchange->api_passphrase}}</td>
        </tr>
      @endforeach
  </tbody>
</table>
    
@endsection