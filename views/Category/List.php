<div class="panel panel-default">
	<div class="panel-heading">
		<?=__('Categories'); ?>
	</div>
	<div class="list-group">
		<?php foreach ($items as $item): ?>
			<a href="/Ticket/Category/<?=$item->id;?>" class="list-group-item<?php if ($selected === $item->id): ?> active<?php endif; ?>">
				<span class="badge"><?=$item->tickets->count_all();?></span>
				<?=$item->name;?>
			</a>
		<?php endforeach; ?>
	</div>
</div>