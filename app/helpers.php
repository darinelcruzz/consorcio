<?php

function usesas($ctrl, $fun, $as = null)
{
    if ($as) {
        return ['uses' => "$ctrl@$fun", 'as' => $as];
    }
    return ['uses' => "$ctrl@$fun", 'as' => $fun];
}

function fdate($original_date, $format = 'Y-m-d')
{
    $date = Date::createFromFormat('Y-m-d H:i:s', $original_date);
    return $date->format($format);
}

function datediff($date)
{
	$datediff = time() - strtotime($date);
	return round($datediff / (60 * 60 * 24));
}
