<!--<div class="users form">
<?php echo $this->Session->flash('auth'); ?>
<?php echo $this->Form->create('User'); ?>
    <fieldset>
        <legend><?php echo __('Please enter your username and password'); ?></legend>
        <?php echo $this->Form->input('username');
        echo $this->Form->input('password');
    ?>
    </fieldset>
<?php echo $this->Form->end(__('Login')); ?>
</div>
<?php
 echo $this->Html->link( "Add A New User",   array('action'=>'add') );
 ?>-->

 <div class="form-box" id="login-box">
 	<div class="header">Sign In</div>
 	<?php echo $this->Session->flash(); ?>
	<?php echo $this->Session->flash('auth'); ?>
	<?php echo $this->Form->create('User'); ?>
 		<div class="body bg-gray">
 			<div class="form-group">
 				<?php echo $this->Form->input('username', array('class' => 'form-control', 'placeholder' => 'Username')); ?>
 			</div>
 			<div class="form-group">
 				<?php echo $this->Form->input('password', array('class' => 'form-control', 'placeholder' => 'Password')); ?>
 			</div>          
 		</div>
 		<div class="footer">                                                               
 			<button type="submit" class="btn bg-olive btn-block">Sign me in</button>
 		</div>
<?php echo $this->Form->end(); ?>
 </div>