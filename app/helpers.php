<?php

function usesas($ctrl, $fun, $as = null)
{
    if ($as) {
        return ['uses' => "$ctrl@$fun", 'as' => $as];
    }
    return ['uses' => "$ctrl@$fun", 'as' => $fun];
}

function fdate($original_date, $format = 'Y-m-d', $original_format = 'Y-m-d H:i:s')
{
    $date = Date::createFromFormat($original_format, $original_date);
    return $date->format($format);
}

function datediff($date)
{
	$datediff = time() - strtotime($date);
	return round($datediff / (60 * 60 * 24));
}

function drawTableHead(... $titles)
{
	echo "<thead><tr>";
    foreach ($titles as $title) {
        echo "<th>" . ucfirst($title) . "</th>";
    }
    echo "</tr></thead>";
}

function drawHeader(...$titles)
{
    echo "<template slot=\"header\"><tr>";
    foreach ($titles as $title) {
        echo "<th>" . ucfirst($title) . "</th>";
    }
    echo "</tr></template>";
}

function getBoxesColor($type)
{
    return ['fresco' => 'warning', 'vivo' => 'primary', 'cerdo' => 'baby', 'procesado' => 'success'][$type] ?? 'warning';
}

function getPageColor($type)
{
    return ['fresco' => 'yellow', 'vivo' => 'blue', 'cerdo' => 'pink', 'procesado' => 'green'][$type] ?? 'yellow';
}

function getProductID($type)
{
    return ['fresco' => 2, 'vivo' => 3, 'cerdo' => 1, 'procesado' => 4][$type] ?? 2;
}

function getSaleModel($type)
{
    $model = [
        'fresco' => 'FreshSale',
        'fresh' => 'FreshSale',
        'vivo' => 'AliveSale',
        'alive' => 'AliveSale',
        'cerdo' => 'PorkSale',
        'pork' => 'PorkSale',
        'procesado' => 'ProcessedSale',
        'processed' => 'ProcessedSale'
    ][$type] ?? 'AliveSale';

    $namespacedModel = '\\App\\' . $model;
    return $namespacedModel;
}

function getLastSale($type)
{
    $model = getSaleModel($type);
    return $model::all()->last();
}

function getYearCount($type, $year)
{
    $model = getSaleModel($type);
    return $model::whereYear('date', $year)->count();
}

