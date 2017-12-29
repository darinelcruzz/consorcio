<?php

function usesas($uses, $as)
{
    return ['uses' => $uses, 'as' => $as];
}

function fdate($original_date, $format = 'Y-m-d')
{
    $date = Date::createFromFormat('Y-m-d H:i:s', $original_date);
    return $date->format($format);
}
