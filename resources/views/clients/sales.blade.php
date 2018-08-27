<data-table col="col-md-12" title="{{ $type }}" example="example{{ $example }}" color="box-{{ $color }}" collapsed="collapsed-box">

    <template slot="header">
        <tr>
            <th>Folio</th>
            <th>Fecha</th>
            <th>Kg</th>
            <th>Precio</th>
            <th>Importe</th>
            <th>Por pagar</th>
            <th>Abonar</th>
            <th>Estado</th>
            <th></th>
        </tr>
    </template>

    <template slot="body">
        @foreach($client->$sale as $sale)
            @if ($sale->status != 'cancelada')
                <tr>
                    <td>{{ $sale->folio }}</td>
                    <td>{{ $sale->short_date }}</td>
                    <td>{{ $sale->kg }}</td>
                    <td>{{ $sale->pricer->name }}</td>
                    <td>{{ $sale->nice_amount }}</td>
                    <td>{{ $sale->credit == 0 ? 'Contado' : '$ ' . number_format($sale->amount - $sale->deposit_total, 2) }}</td>
                    <td>
                        @includeWhen($sale->status != 'pagado' && auth()->user()->level == 1,'clients/deposit')
                    </td>
                    <td>{{ $sale->status }}</td>
                    @if ($sale->credit == 1)
                        <td>
                            <a href="{{ route('deposit.details', ['id' => $sale->id, 'type' => $sale->type, 'amount' => $sale->amount]) }}"  class="btn btn-info">
                                <i class="fa fa-eye" aria-hidden="true"></i>
                            </a>
                        </td>
                    @else
                        <td></td>
                    @endif
                </tr>
            @endif
        @endforeach
    </template>

</data-table>
