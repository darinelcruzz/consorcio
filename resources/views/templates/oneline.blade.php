<div id="field_{{ $id }}"{!! Html::classes(['form-group', 'has-error' => $hasErrors]) !!}>
    <label for="{{ $id }}" class="col-sm-2 control-label">
        {{ $label }}
    </label>

    @if ($required)
        <span class="label label-info">Required</span>
    @endif

    <div class="col-sm-10">
        {!! $input !!}
        @foreach ($errors as $error)
            <p class="help-block">{{ $error }}</p>
        @endforeach
    </div>
</div>
