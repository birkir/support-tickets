<div class="row">
	<div class="col-sm-3">
		<?=Request::factory('Category/List/'.$category->id)->execute();?>
	</div>
	<div class="col-sm-9">
		<div class="panel panel-default">
			<div class="panel-heading">
				<?= __('Tickets'); ?>
			</div>
			<div class="list-group">
				<?php foreach ($items as $item): ?>
					<a href="/Ticket/Detail/<?=$item->id;?>" class="list-group-item">
						<span class="pull-right label label-<?=$item->status('state');?>"><?=$item->status('text');?></span>
						<h4 class="list-group-item-heading"><?=$item->title;?></h4>
						<span class="pull-right"><?=Date::fuzzy_span(strtotime($item->created_at));?></span>
						<p class="list-group-item-text">
							<?=Text::limit_words($item->message, 5);?>
						</p>
					</a>
				<?php endforeach; ?>
				<?php if (count($items) === 0): ?>
					<div class="list-group-item">
						<p><?=__('No tickets available.');?></p>
					</div>
				<?php endif; ?>
			</div>
		</div>
		<a href="/Ticket/Create" class="btn btn-primary"><?= __('Create ticket');?></a>
	</div>
</div>