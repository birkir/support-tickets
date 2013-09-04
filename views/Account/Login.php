<div class="form-group col-sm-4 col-sm-offset-4">
	<h3><?=__('Please sign in');?></h3>
	<?=$form;?>
	<?php if ($auth->logged_in()): ?>
		<div class="alert alert-success">
			<strong><?=__('Sign in successful');?></strong>
			<br>
			<?=__('You have successfully logged in,<br>please :click to continue.', [':click' => HTML::anchor('Ticket', __('click here'))]);?>
		</div>
	<?php endif; ?>
</div>

<?=Form::open('Account/Login', ['class' => 'form col-sm-4 col-sm-offset-4', 'role' => 'form', 'method' => 'POST']);?>

	<?php if ( ! $auth->logged_in()): ?>

		<div class="form-group <?= $form->has('email');?>">
			<?=Form::label('accountEmail', __('Email'), ['class' => 'control-label']);?>
			<?=Form::input('email', $form->value('email'), ['class' => 'form-control', 'id' => 'accountEmail', 'placeholder' => __('E-Mail Address')]);?>
			<?=$form->helper('email');?>
		</div>

		<div class="form-group <?= $form->has('password');?>">
			<?=Form::label('accountPassword', __('Password'), ['class' => 'control-label']);?>
			<?=Form::password('password', NULL, ['class' => 'form-control', 'id' => 'accountPassword']);?>
			<?=$form->helper('password');?>
		</div>

		<div class="form-group">
			<?=Form::label('accountRemember', Form::checkbox('remember', 1, (bool) $form->value('remember'), ['id' => 'accountRemember']).__('Remember me'), ['class' => 'checkbox']);?>
			<?=Form::button(NULL, __('Sign in'), ['class' => 'btn btn-primary', 'type' => 'submit']);?>
			<?=HTML::anchor('Account/Register', __('Sign up (it\'s free!)'), ['class' => 'btn btn-link']);?>
		</div>

	<?php endif; ?>

<?=Form::close();?>