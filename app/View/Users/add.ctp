<div class="users form">
 
<?php echo $this->Form->create('User');?>
    <fieldset>
        <legend><?php echo __('Add User'); ?></legend>
        <?php echo $this->Form->input('username');
        echo $this->Form->input('password');
        echo $this->Form->input('password_confirm', array('label' => 'Confirm Password *', 'maxLength' => 255, 'title' => 'Confirm password', 'type'=>'password'));
        echo $this->Form->input('fname',array('label' => 'First Name'));
        echo $this->Form->input('lname',array('label' => 'Last Name'));
        echo $this->Form->input('role', array(
            'options' => array( 'governor' => 'Governor', 'buficom' => 'BUFICOM', 'admin' => 'Administrator')
        ));
         
        echo $this->Form->submit('Add User', array('class' => 'form-submit',  'title' => 'Click here to add the user') );
?>
    </fieldset>
<?php echo $this->Form->end(); ?>
</div>
<?php
if($this->Session->check('Auth.User')){
echo $this->Html->link( "Return to Dashboard",   array('action'=>'index') );
}else{
echo $this->Html->link( "Return to Login Screen",   array('action'=>'login') );
}
echo '<br />';
for ($i=0; $i < count($testing); $i++) 
{ 
    echo $testing[$i]['Organisation']['id'] . '=>' . $testing[$i]['Organisation']['name'] . '<br />';
}

?>