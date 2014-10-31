<div class="panel panel-default">
	<div class="panel-heading">
		@lang('Post Response')
	</div>
	<div class="panel-body">
		{{ Form::open(['url' => 'ticket/'.$ticket->id]) }}

			<div class="form-group">
				{{ Form::label('messageMessage', 'Message') }}
				{{ Form::textarea('message', NULL, ['class' => 'form-control', 'id' => 'messageMessage']) }}
				@if ($errors->has('message'))
					<p class="help-block">{{ $errors->first('message') }}</p>
				@endif
			</div>

			<button type="submit" class="btn btn-primary">@lang('Send Response')</button>

		{{ Form::close() }}
	</div>
</div>