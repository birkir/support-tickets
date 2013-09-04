<?=$form;?>

<?php if ( ! $form->model->saved()): ?>
	<div class="panel panel-default">
		<div class="panel-heading">
			<?= __('Post Response'); ?>
		</div>
		<div class="panel-body">
			<?=Form::open(NULL, ['method' => 'post']);?>
				<div class="form-group<?=$form->has('message');?>">
					<?=Form::label('ticketMessage', __('Message'), ['class' => 'control-label']);?>
					<?=Form::textarea('message', $form->value('message'), ['class' => 'form-control', 'id' => 'ticketMessage']);?>
					<?=$form->helper('message');?>
				</div>
				<?php if ($admin): ?>
					<div class="form-group">
						<?=Form::label('ticketStatus', __('Status'), ['class' => 'control-label']);?>
						<?=Form::select('status', array_map(function($s) { return Arr::get($s, 'text'); }, $ticket->status()), $ticket->status, ['class' => 'form-control', 'id' => 'ticketStatus']);?>
					</div>
				<?php endif; ?>
				<?=Form::button(NULL, __('Send Response'), ['class' => 'btn btn-primary', 'type' => 'submit']);?>
			<?=Form::close();?>
		</div>
	</div>
<?php endif; ?>