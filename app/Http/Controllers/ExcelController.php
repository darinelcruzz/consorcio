<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Maatwebsite\Excel\Facades\Excel;
use App\Client;

class ExcelController extends Controller
{
    function export()
    {
        Excel::create('quotations', function ($excel)
        {
            $excel->sheet('cotizaciones', function ($sheet)
            {
                $items = Quotation::all();

                $sheet->fromArray($items);
            });
        })->export('xlsx');
    }

    function import()
    {
    	Excel::load('clients.xlsx', function($reader) {
            foreach ($reader->get() as $item) {
                Client::create([
                  'name' => $item->name,
                  'email' => $item->email,
                  'rfc' => $item->rfc,
                  'address' => $item->address,
                  'phone' => $item->phone,
                  'cellphone' => $item->cellphone,
                  'credit' => $item->credit,
                  'notes' => $item->notes,
                  'products' => serialize(explode(" ", substr($item->products, 0, -1))),
                ]);
            }
        });

        return redirect('/');
    }
}
