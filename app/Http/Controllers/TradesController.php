<?php

namespace App\Http\Controllers;

use App\Exchange;
use Hellovoid\Gdax\Client;
use Hellovoid\Gdax\Configuration;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;


class TradesController extends Controller
{
    public function index(Request $request, $idExchange){
        $userId = Auth::id();
        $exchange = Exchange::find($idExchange);
        if($exchange->user_id !== $userId){

            return redirect('/home');
        }



        $apiKey = $exchange->api_key;
        $apiSecret = $exchange->api_secret;
        $apiPassphrase = $exchange->api_passphrase;
        $configuration = Configuration::apiKey($apiKey, $apiSecret, $apiPassphrase);
        $client = Client::create($configuration);

        $accounts = $client->getAccounts();
        return view('exchanges.list-trades',['accounts' => $accounts]);
    }
}
