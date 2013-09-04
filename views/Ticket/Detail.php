<div class="row">
	<div class="col-sm-3">
		<div class="panel panel-default">
			<div class="panel-heading">
				<?= __('Ticket'); ?>
			</div>
			<div class="list-group">
				<div class="list-group-item">
					<strong><?=__('Categories');?></strong><br>
					<?php foreach ($item->categories->find_all() as $cat): ?>
						<a href="#"><?=$cat->name;?></a>,
					<?php endforeach; ?>
				</div>
				<div class="list-group-item">
					<strong><?=__('Date');?></strong><br>
					<?=strftime('%a %e. %B %Y', strtotime($item->created_at));?>
				</div>
				<div class="list-group-item">
					<strong><?=__('Status');?></strong>
					<span class="pull-right label label-<?=$item->status('state');?>"><?=$item->status('text');?></span><br>
				</div>
				<div class="list-group-item">
					<strong><?=__('Posted by');?></strong>
					<?=HTML::anchor('Account/Detail/'.$item->user->id, ''.$item->user->name);?>
				</div>
			</div>
		</div>
	</div>
	<div class="col-sm-9">
		<div class="panel panel-default">
			<div class="panel-heading">
				<?=$item->title;?>
			</div>
			<div class="panel-body">
				<p><?=$item->message;?></p>
			</div>
			<?php if ($admin): ?>
				<div class="panel-footer">
					<?=HTML::anchor('Ticket/Delete/'.$item->id, __('Delete'), ['class' => 'btn btn-danger btn-xs confirm']);?>
				</div>
			<?php endif; ?>
		</div>

		<?php if ($verified OR $admin): ?>
			<?php foreach ($messages as $message): ?>
				<div class="panel panel-default">
					<div class="panel-body">
						<small class="pull-right text-muted"><?=__(':date by :user', [':date' => strftime('%d.%m.%Y - %H:%m', strtotime($message->created_at)), ':user' => HTML::anchor('Account/Detail/'.$message->user->id, $message->user->name)]);?></small>
						<p><?=$message->message;?></p>
					</div>
					<?php if ($admin): ?>
						<div class="panel-footer">
							<?=HTML::anchor('Ticket/Delete_Message/'.$message->id, __('Delete'), ['class' => 'btn btn-danger btn-xs confirm']);?>
						</div>
					<?php endif; ?>
				</div>
			<?php endforeach; ?>
		<?php else: ?>
			<div class="alert alert-warning">
				<strong><?=__('Not verified user');?></strong>
				<p><?=__('Please :login or :register to see solution to this problem.', [
					':login' => HTML::anchor('Account/Login', __('login')),
					':register' => HTML::anchor('Account/Register', __('register'))
				]);?></p>
			</div>
		<?php endif; ?>

		<?php if ($admin OR $owner): ?>
			<?=Request::factory('Ticket/Message/'.$item->id)->execute();?>
		<?php endif; ?>
	</div>
</div>