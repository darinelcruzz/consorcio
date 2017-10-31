<div class="box box-widget widget-user-2">
    {{ $slot }}
    <div class="box-footer no-padding">
        <ul class="nav nav-stacked">
            @foreach ($products as $product)
                @if ($product->name != 'Procesado')
                    <li><a href="#">{{ $product->name }}<span class="pull-right badge bg-{{ $labelcolor }}">{{ $product->quantity }}</span></a></li>
                @endif
            @endforeach
        </ul>
    </div>
</div>
