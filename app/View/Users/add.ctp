<div class="users form">
 
<?php echo $this->Form->create('User');?>
    <fieldset>
        <legend><?php echo __('Add User'); ?></legend>
        <?php echo $this->Form->input('username', array('class' => 'form-control'));
        echo $this->Form->input('password', array('class' => 'form-control'));
        echo $this->Form->input('password_confirm', array('label' => 'Confirm Password *', 'maxLength' => 255, 'title' => 'Confirm password', 'type'=>'password', 'class' => 'form-control'));
        echo $this->Form->input('fname',array('label' => 'First Name', 'class' => 'form-control'));
        echo $this->Form->input('lname',array('label' => 'Last Name', 'class' => 'form-control'));
        echo $this->Form->input('role', array(
            'class' => 'form-control',
            'options' => array('buficom' => 'BUFICOM', 'admin' => 'Administrator')
        ));
        echo '<br />';
        echo $this->Form->submit('Add User', array('class' => 'btn btn-primary',  'title' => 'Click here to add the user') );
?>
    </fieldset>
<?php echo $this->Form->end(); ?>
</div>
<?php
    $this->start('sidebar');
    echo $this->Html->link( "Return to Dashboard",   array('action'=>'index') );
    $this->end();
/*for ($i=0; $i < count($testing); $i++) 
{ 
    echo $testing[$i]['Organisation']['id'] . '=>' . $testing[$i]['Organisation']['name'] . '<br />';
}*/

?>