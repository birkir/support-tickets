@extends('layouts.master')

@section('content')
	<div class="row">
		<div class="col-sm-3">
			<div class="panel panel-default">
				<div class="panel-heading">
					@lang('Ticket')
				</div>
				<div class="list-group">
					<div class="list-group-item">
						<strong>@lang('Categories')</strong><br>
						@foreach ($ticket->categories as $category)
							<a href="/tickets/category/{{ $category->id }}">{{ $category->name }}</a>
						@endforeach
					</div>
					<div class="list-group-item">
						<strong>@lang('Date')</strong>
						{{ $ticket->created_at }}
					</div>
					<div class="list-group-item">
						<strong>@lang('Status')</strong>
						<span class="pull-right label label-{{ $ticket->state }}">{{ $ticket->state }}</span><br>
					</div>
					<div class="list-group-item">
						<strong>@lang('Posted by')</strong>
						{{ $ticket->user->email }}
					</div>
				</div>
			</div>
			@if (Auth::check() AND (Auth::user()->hasRole('admin') OR Auth::user()->id === $ticket->user->id))
				<a href="/ticket/{{ $ticket->id }}/delete" class="btn btn-danger btn-xs" onclick="return confirm('Are you sure?')">@lang('Delete Ticket')</a>
			@endif
		</div>
		<div class="col-sm-9">
			<div class="panel panel-default">
				<div class="panel-heading">
					{{ $ticket->title }}
				</div>
				<div class="panel-body">
					<p>{{ $ticket->message }}</p>
				</div>
			</div>

			@foreach ($ticket->messages as $message)
				<div class="panel panel-default">
					<div class="panel-body">
						<small class="pull-right text-muted">
							{{ $ticket->created_at->toDateTimeString() }} by {{ $message->user->email }}
						</small>
						<p>{{ $message->message }}</p>
					</div>
					@if (Auth::check() AND (Auth::user()->hasRole('admin') OR Auth::user()->id === $message->user->id))
						<div class="panel-footer">
							<a href="/ticket/message/{{ $message->id }}/delete" class="btn btn-danger btn-xs" onclick="return confirm('Are you sure?')">@lang('Delete Message')</a>
						</div>
					@endif
				</div>
			@endforeach

			@if (Auth::check())
				{{ $messageView }}
			@endif
		</div>
	</div>
@stop