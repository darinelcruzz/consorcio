<?php

namespace App\Http\Controllers\Api;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\{AliveSale, FreshSale, PorkSale, ProcessedSale};

class SaleController extends Controller
{
    function index($type)
    {
        switch ($type) {
            case 'alive':
                return AliveSale::with(['client:id,name', 'pricer:id,name'])->orderBy('id', 'DESC')->paginate(10);
                break;
            case 'fresh':
                return FreshSale::with(['client:id,name', 'pricer:id,name'])->orderBy('id', 'DESC')->paginate(10);
                break;
            case 'pork':
                return PorkSale::with(['client:id,name', 'pricer:id,name'])->orderBy('id', 'DESC')->paginate(10);
                break;
            case 'processed':
                return ProcessedSale::with(['client:id,name', 'pricer:id,name'])->orderBy('id', 'DESC')->paginate(10);
                break;
            default:
                return \Response::json(['success' => false]);
                break;
        }
    }

    function search($type, $keyword)
    {
    	switch ($type) {
    		case 'alive':
    			return AliveSale::where('folio', 'LIKE', "%$keyword%")
                    ->with(['client:id,name', 'pricer:id,name'])->orderBy('id', 'DESC')->paginate(10);
    			break;
    		case 'fresh':
    			return FreshSale::where('folio', 'LIKE', "%$keyword%")
                    ->with(['client:id,name', 'pricer:id,name'])->orderBy('id', 'DESC')->paginate(10);
    			break;
    		case 'pork':
    			return PorkSale::where('folio', 'LIKE', "%$keyword%")
                    ->with(['client:id,name', 'pricer:id,name'])->orderBy('id', 'DESC')->paginate(10);
    			break;
    		case 'processed':
    			return ProcessedSale::where('folio', 'LIKE', "%$keyword%")
                    ->with(['client:id,name', 'pricer:id,name'])->orderBy('id', 'DESC')->paginate(10);
    			break;
    		default:
    			return \Response::json(['success' => false]);
    			break;
    	}
	}

    function show($id)
    {
        // return Movie::find($id);

    }

    function store(Request $request)
    {
        // $movie = Movie::create($request->all());
        // return $movie;
    }

    function update($id, Request $request)
    {
        // $movie = Movie::find($id);

		// $movie->update($request->only(['title', 'director']));

        // return $movie;
	}

    function destroy($id)
    {
        // $movie = Movie::find($id);
        // $movie->delete();

        // return \Response::json(['success' => true]);
    }
}
