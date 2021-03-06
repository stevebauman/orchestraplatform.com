	<div class="form-box">
	{!! app('form')->open(array_merge($form, ['class' => 'form-horizontal'])) !!}

	@if ($token)
	{!! app('form')->token() !!}
	@endif

	@foreach ($hiddens as $hidden)
	{!! $hidden !!}
	@endforeach

	@foreach ($fieldsets as $fieldset)
		<fieldset{!! app('html')->attributes($fieldset->attributes ?: []) !!}>
			@if ($fieldset->name)
			<legend>{!! $fieldset->name or '' !!}</legend>
			@endif

			@foreach ($fieldset->controls() as $control)
			<div class="form-group{!! $errors->has($control->name) ? ' has-error' : '' !!}">
				{!! app('form')->label($control->name, $control->label, ['class' => 'three columns control-label']) !!}

				<div class="nine columns">
					<div>{!! $control->getField($row, $control, []) !!}</div>
					@if ($control->inlineHelp)
					<span class="help-inline">{!! $control->inlineHelp !!}</span>
					@endif
					@if ($control->help)
					<p class="help-block">{!! $control->help !!}</p>
					@endif
					{!! $errors->first($control->name, $format) !!}
				</div>
			</div>
			@endforeach
		</fieldset>
	@endforeach

	<fieldset>
		<div class="row">
			{{-- Fixed row issue on Bootstrap 3 --}}
		</div>
		<div class="row">
			<div class="nine columns offset-by-three">
				<button type="submit" class="btn btn-primary">
					{!! $submit !!}
				</button>
			</div>
		</div>
	</fieldset>

	{!! app('form')->close() !!}
</div>
