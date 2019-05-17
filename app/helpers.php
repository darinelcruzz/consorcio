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
