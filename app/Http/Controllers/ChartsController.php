<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Charts\SalesTotal;
use App\Charts\TotalKg;
use App\Charts\HighChart;
use App\Movement;

class ChartsController extends Controller
{
    function index(Request $request)
    {
    	$start = $request->start ?? now();
    	$end = $request->end ?? now();
    	$interval = $request->interval ?? 'd';

    	foreach (['App\PorkSale' => 'pork', 'App\AliveSale' => 'alive', 'App\FreshSale' => 'fresh', 'App\ProcessedSale' => 'processed'] as $model => $name) {
            
            $$name = $model::where('date', '>=', $start)
            	->where('date', '<=', $end)
            	->where('status', '!=', 'cancelada')
            	->get()
            	->groupBy(function ($item) use ($interval) {
            		return fdate($item->date, $interval, 'Y-m-d');
            	});
        }

    	$salesChart = new SalesTotal;
    	$salesChart->labels($pork->keys());
    	$salesChart->dataset('Cerdo', 'line', $pork->map(function ($time) {return $time->sum('quantity');})->values())->options(['borderColor' => '#ee76a0', 'fill' => false]);
    	$salesChart->dataset('Vivo', 'line', $alive->map(function ($time) {return $time->sum('quantity');})->values())->options(['borderColor' => '#3c8dbc', 'fill' => false]);
    	$salesChart->dataset('Fresco', 'line', $fresh->map(function ($time) {return $time->sum('quantity');})->values())->options(['borderColor' => '#f39c12', 'fill' => false]);
    	$salesChart->dataset('Procesado', 'line', $processed->map(function ($time) {return $time->sum('quantity');})->values())->options(['borderColor' => '#00a65a', 'fill' => false]);

    	$kgChart = new TotalKg;
    	$kgChart->labels($pork->keys());
    	$kgChart->dataset('Cerdo', 'line', $pork->map(function ($time) {return round($time->sum('kg'), 2);})->values())->options(['borderColor' => '#ee76a0', 'fill' => false]);
    	$kgChart->dataset('Vivo', 'line', $alive->map(function ($time) {return round($time->sum('kg'), 2);})->values())->options(['borderColor' => '#3c8dbc', 'fill' => false]);
    	$kgChart->dataset('Fresco', 'line', $fresh->map(function ($time) {return round($time->sum('kg'), 2);})->values())->options(['borderColor' => '#f39c12', 'fill' => false]);
    	$kgChart->dataset('Procesado', 'line', $processed->map(function ($time) {return round($time->sum('kg'), 2);})->values())->options(['borderColor' => '#00a65a', 'fill' => false]);

    	return view('charts.index', compact('salesChart', 'kgChart', 'start', 'end', 'interval'));
    }
}
