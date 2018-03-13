<div class="box box-widget widget-user-2">
    <div class="widget-user-header bg-{{ $labelcolor }}">
        @if (!is_iterable($product))
            <h3>{{ $product }}</h3>
        @else
            <h3>{{ $slot }}</h3>
        @endif
    </div>
    <div class="box-footer no-padding">
        <ul class="nav nav-stacked">
            @if (!is_iterable($product))
                <li><a href="#">{{ $product }}<span class="pull-right badge bg-{{ $labelcolor }}">{{ $slot }}</span></a></li>
            @else
                @foreach ($product as $key => $value)
                    <li><a href="#">{{ $key }}<span class="pull-right badge bg-{{ $labelcolor }}">{{ $value }}</span></a></li>
                @endforeach
            @endif
        </ul>
    </div>
</div>
