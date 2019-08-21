<div class="btn-group">
    
    <button type="button" class="btn btn-xs btn-warning dropdown-toggle" data-toggle="dropdown">
      <i class="fa fa-cogs" aria-hidden="true"></i>
      <span class="sr-only">Toggle Dropdown</span>
    </button>

    <ul class="dropdown-menu" role="menu">
      
      @if($shipping->product == '20')
      	<li>
			<a href="{{ route('shipping.show', $shipping)}}">
				<i class="fa fa-eye"></i> Ver productos
			</a>
		</li>
      @endif

      @if(auth()->user()->level == 1)
      	<li>
			<a href="{{ route('shipping.edit', $shipping)}}">
				<i class="fa fa-edit"></i> Editar
			</a>
	      </li>
      @endif

    </ul>

</div>