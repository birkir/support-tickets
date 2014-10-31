<div class="panel panel-default">
	<div class="panel-heading">
		@lang('Categories')
	</div>
	<div class="list-group">
		@foreach ($categories as $category)
			<a href="{{ route('tickets.category', ['id' => $category->id]) }}" class="list-group-item @if ($selected AND ($selected->id === $category->id)) active @endif">
				<span class="badge">{{ $category->tickets->count() }}</span>
				{{ $category->name }}
			</a>
		@endforeach
	</div>
</div>