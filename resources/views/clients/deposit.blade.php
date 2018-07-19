{!! Form::open(['method' => 'POST', 'route' => 'deposit.store']) !!}

<div class="input-group input-group-sm">
    <input type="hidden" name="type" value="{{ strtolower($type) }}">
    <input type="hidden" name="sale_id" value="{{ $sale->id }}">
    <input type="hidden" name="user" value="{{ auth()->user()->name }}">
    <input type="hidden" name="dif" value="{{ $sale->amount - $sale->deposit_total }}">
    <input type="number" class="form-control" name="amount" min="0" step="0.01" max="{{ $sale->amount - $sale->deposit_total }}">
    <span class="input-group-btn">
      <button type="submit" class="btn btn-success btn-flat btn-xs" onclick="submitForm(this);">
          <i class="fa fa-plus"></i>
      </button>
    </span>
</div>

{!! Form::close() !!}
