<?php

namespace App\Http\Controllers;

use App\Exchange;
use Illuminate\Http\Request;
use Hellovoid\Gdax\Configuration;
use Hellovoid\Gdax\Client;
use Illuminate\Support\Facades\Auth;

class ExchangeController extends Controller
{
    public function index(Request $request){

        if (Auth::check()) {
            // Getting authenticated user's id
            $id = Auth::id();

            $exchanges = \App\Exchange::where("user_id", $id)->get();

//            if(count($exchanges) > 0){
                return view('exchanges.list-grid',['exchanges' => $exchanges]);
//            }


//            $apiKey = "8dd8a466e54d37d765f4740b09c1bc53";
//            $apiSecret = "58+gI5LYsPnBiPGRNQAB/C0ScHiyVaYamKBO8+wnPJvchkqZSyQxQycqG3EY/4I8d8+bV3Mp5jClaZLzjZdqoA==";
//            $apiPassphrase = "IdxF@Gh3g\"6##t.=8DVc";
//            $configuration = Configuration::apiKey($apiKey, $apiSecret, $apiPassphrase);
//            $client = Client::create($configuration);
//
//            $accounts = $client->getAccountHistory("8f278fbb-827e-45de-881e-74a228bc33d8");

        }
        else{
            return redirect('/home');
        }
    }
}
