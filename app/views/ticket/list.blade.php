@extends('layouts.master')

@section('content')
	<div class="row">
		<div class="col-sm-3">
			{{ $categoryView }}
		</div>
		<div class="col-sm-9">
			<div class="panel panel-default">
				<div class="panel-heading">
					@lang('Tickets')
				</div>
				<div class="list-group">
					@foreach ($tickets as $ticket)
						<a href="{{ route('ticket.details', ['id' => $ticket->id]) }}" class="list-group-item">
							<span class="pull-right label label-{{ $ticket->state }}">{{ $ticket->state }}</span>
							<h4 class="list-group-item-heading">{{ $ticket->title }}</h4>
							<span class="pull-right">{{ $ticket->created_at->toDateTimeString() }}</span>
							<p class="list-group-item-text">
								{{ $ticket->message }}
							</p>
						</a>
					@endforeach
				</div>
			</div>
		</div>
	</div>
@stop