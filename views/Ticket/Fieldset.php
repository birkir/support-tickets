<?=$form->open(NULL, ['class' => 'form-horizontal', 'role' => 'form', 'method' => 'POST']);?>

	<div class="form-group">
		<div class="col-sm-offset-2 col-sm-9">
			<h3><?=__('Support Ticket');?></h3>
			<?=$form;?>
		</div>
	</div>

	<?php if ( ! $form->model->saved()): ?>

		<div class="form-group <?= $form->has('categories');?>">
			<?=Form::label('ticketCategories', __('Categories'), ['class' => 'col-sm-2 control-label']);?>
			<div class="col-sm-9">
				<?=Form::select('categories[]', $categories, $form->value('categories'), ['placeholder' => 'Select categories', 'multiple' => 'multiple', 'class' => 'form-control']);?>
				<?=$form->helper('categories');?>
			</div>
		</div>

		<div class="form-group <?= $form->has('title');?>">
			<?=Form::label('ticketTitle', __('Title'), ['class' => 'col-sm-2 control-label',]);?>
			<div class="col-sm-9">
				<?=Form::input('title', $form->value('title'), ['class' => 'form-control', 'id' => 'ticketTitle', 'placeholder' => __('Write your ticket subject')]);?>
				<?=$form->helper('title');?>
			</div>
		</div>

		<div class="form-group <?= $form->has('message');?>">
			<?=Form::label('ticketMessage', __('Message'), ['class' => 'col-sm-2 control-label',]);?>
			<div class="col-sm-9">
				<?=Form::textarea('message', $form->value('message'), ['class' => 'form-control', 'id' => 'ticketMessage', 'placeholder' => __('Write your question or problem')]);?>
				<?=$form->helper('message');?>
			</div>
		</div>

		<div class="form-group">
			<div class="col-sm-offset-2 col-sm-9">
				<?=Form::button(NULL, __(($form->model->loaded() ? 'Update' : 'Create').' ticket'), ['class' => 'btn btn-primary', 'type' => 'submit']);?>
				&nbsp; &nbsp;
				<?=HTML::anchor('Ticket', __('Cancel')); ?>
			</div>
		</div>

	<?php endif; ?>

<?=Form::close();?>