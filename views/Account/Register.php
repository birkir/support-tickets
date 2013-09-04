<div class="form-group col-sm-offset-4 col-sm-4">
	<h3><?=__('Register');?></h3>
	<?=$form;?>
</div>

<?=$form->open('Account/Register', ['method' => 'post', 'class' => 'form col-sm-4 col-sm-offset-4', 'role' => 'form']);?>

	<?php if ( ! $form->model->saved()): ?>

		<div class="form-group<?=$form->has('email');?>">
			<?=Form::label('registerEmail', __('E-Mail address'), ['class' => 'control-label']);?>
			<?=Form::input('email', $form->value('email'), ['class' => 'form-control', 'id' => 'registerEmail', 'placeholder' => 'example@example.com', 'type' => 'email']);?>
			<?=$form->helper('email');?>
		</div>

		<div class="form-group<?=$form->has('password');?>">
			<?=Form::label('registerPassword', __('Password'), ['class' => 'control-label']);?>
			<?=Form::password('password', NULL, ['class' => 'form-control', 'id' => 'registerPassword', 'placeholder' => __('min 6 characters')]);?>
			<?=$form->helper('password');?>
		</div>

		<div class="form-group<?=$form->has('password_confirm');?>">
			<?=Form::label('registerPassword2', __('Re-type password'), ['class' => 'control-label']);?>
			<?=Form::password('password_confirm', NULL, ['class' => 'form-control', 'id' => 'registerPassword2']);?>
			<?=$form->helper('password_confirm');?>
		</div>

		<div class="form-group">
			<?=Form::button(NULL, __('Register'), ['class' => 'btn btn-primary', 'type' => 'submit']);?>
			&nbsp; &nbsp;
			<?=HTML::anchor('Account/Login', __('Cancel')); ?>
		</div>

	<?php endif; ?>

<?=$form->close();?>