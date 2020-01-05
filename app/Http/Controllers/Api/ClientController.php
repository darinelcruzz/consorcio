<?php

namespace App\Http\Controllers\Api;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Client;
use App\{AliveSale, FreshSale, PorkSale, ProcessedSale};

class ClientController extends Controller
{
    function index($product)
    {
    	$buyers = Client::orderBy('name', 'asc')
    		->get()
            ->filter(function ($item) use ($product) {
                return strpos($item->products, $product);
            });

    	$clients = [];

        foreach ($buyers as $client) {

            array_push($clients, (object) [
                'id' => $client->id,
                'name' => $client->name,
                'address' => $client->address,
                'notes' => $client->notes,
                'credit' => $client->credit,
                'unpaid' => $client->unpaid_notes,
                'balance' => $client->balance,
            ]);
        }

        return $clients;
    }

    function show($keyword = null)
    {
        if ($keyword != null) {
            return Client::where('name', 'LIKE', "%$keyword%")
                ->orWhere('email', 'LIKE', "%$keyword%")
                ->orWhere('products', 'LIKE', "%$keyword%")
                ->orWhere('address', 'LIKE', "%$keyword%")
                ->paginate(10);
        }

        return Client::paginate(10);
    }

    function sales($client, $type)
    {
        switch ($type) {
            case 'alive':
                return AliveSale::where('client_id', $client)
                    ->with(['client:id,name', 'pricer:id,name'])
                    ->orderBy('id', 'DESC')
                    ->paginate(10);
                break;
            case 'fresh':
                return FreshSale::where('client_id', $client)
                    ->with(['client:id,name', 'pricer:id,name'])
                    ->orderBy('id', 'DESC')
                    ->paginate(10);
                break;
            case 'pork':
                return PorkSale::where('client_id', $client)
                    ->with(['client:id,name', 'pricer:id,name'])
                    ->orderBy('id', 'DESC')
                    ->paginate(10);
                break;
            case 'processed':
                return ProcessedSale::where('client_id', $client)
                    ->with(['client:id,name', 'pricer:id,name'])
                    ->orderBy('id', 'DESC')
                    ->paginate(10);
                break;
            default:
                return \Response::json(['success' => false]);
                break;
        }
    }

    function search($client, $type, $keyword)
    {
        switch ($type) {
            case 'alive':
                return AliveSale::where('client_id', $client)
                    ->where('folio', 'LIKE', "%$keyword%")
                    ->orWhere('status', 'LIKE', "%$keyword%")
                    ->with(['client:id,name', 'pricer:id,name'])->orderBy('id', 'DESC')->paginate(10);
                break;
            case 'fresh':
                return FreshSale::where('client_id', $client)
                    ->where('folio', 'LIKE', "%$keyword%")
                    ->orWhere('status', 'LIKE', "%$keyword%")
                    ->with(['client:id,name', 'pricer:id,name'])->orderBy('id', 'DESC')->paginate(10);
                break;
            case 'pork':
                return PorkSale::where('client_id', $client)
                    ->where('folio', 'LIKE', "%$keyword%")
                    ->orWhere('status', 'LIKE', "%$keyword%")
                    ->with(['client:id,name', 'pricer:id,name'])->orderBy('id', 'DESC')->paginate(10);
                break;
            case 'processed':
                return ProcessedSale::where('client_id', $client)
                    ->where('folio', 'LIKE', "%$keyword%")
                    ->orWhere('status', 'LIKE', "%$keyword%")
                    ->with(['client:id,name', 'pricer:id,name'])->orderBy('id', 'DESC')->paginate(10);
                break;
            default:
                return \Response::json(['success' => false]);
                break;
        }
    }
}
