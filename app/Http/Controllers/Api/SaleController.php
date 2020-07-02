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
                return AliveSale::whereYear('date', date('Y'))
                    ->whereMonth('date', '>', date('m') - 3)
                    ->with(['client:id,name', 'pricer:id,name'])
                    ->orderBy('id', 'DESC')
                    ->paginate(10);
                break;
            case 'fresh':
                return FreshSale::whereYear('date', date('Y'))
                    ->whereMonth('date', '>', date('m') - 3)
                    ->with(['client:id,name', 'pricer:id,name'])
                    ->orderBy('id', 'DESC')
                    ->paginate(10);
                break;
            case 'pork':
                return PorkSale::whereYear('date', date('Y'))
                    ->whereMonth('date', '>', date('m') - 3)
                    ->with(['client:id,name', 'pricer:id,name'])
                    ->orderBy('id', 'DESC')
                    ->paginate(10);
                break;
            case 'processed':
                return ProcessedSale::whereYear('date', date('Y'))
                    ->whereMonth('date', '>', date('m') - 3)
                    ->with(['client:id,name', 'pricer:id,name'])
                    ->orderBy('id', 'DESC')
                    ->paginate(10);
                break;
            default:
                return \Response::json(['success' => false]);
                break;
        }
    }

    function search($type, $keyword)
    {
        $keyword = substr($keyword, -4);

    	switch ($type) {
    		case 'alive':
    			return AliveSale::where('folio', 'LIKE', "%$keyword%")
                    ->orWhere('status', 'LIKE', "%$keyword%")
                    ->with(['client:id,name', 'pricer:id,name'])->orderBy('id', 'DESC')->paginate(10);
    			break;
    		case 'fresh':
    			return FreshSale::where('folio', 'LIKE', "%$keyword%")
                    ->orWhere('status', 'LIKE', "%$keyword%")
                    ->with(['client:id,name', 'pricer:id,name'])->orderBy('id', 'DESC')->paginate(10);
    			break;
    		case 'pork':
    			return PorkSale::where('folio', 'LIKE', "%$keyword%")
                    ->orWhere('status', 'LIKE', "%$keyword%")
                    ->with(['client:id,name', 'pricer:id,name'])->orderBy('id', 'DESC')->paginate(10);
    			break;
    		case 'processed':
    			return ProcessedSale::where('folio', 'LIKE', "%$keyword%")
                    ->orWhere('status', 'LIKE', "%$keyword%")
                    ->with(['client:id,name', 'pricer:id,name'])->orderBy('id', 'DESC')->paginate(10);
    			break;
    		default:
    			return \Response::json(['success' => false]);
    			break;
    	}
	}
}
