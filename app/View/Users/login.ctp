<div class="form-box" id="login-box">
<?php echo $this->Session->flash(); ?>
<?php echo $this->Session->flash('auth'); ?>

 	<div class="header">Sign In</div>
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