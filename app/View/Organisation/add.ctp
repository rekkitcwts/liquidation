<div class="organisations form">
	<?php
		//print_r($orgs);
		$adviser_options = array();
		foreach ($adviser as $adv) 
        {
            $adviser_options[$adv['User']['id']] = $adv['User']['fname'] . ' ' . $adv['User']['lname'];
        }
	?>

	<?php echo $this->Form->create('Organisation');?>
	<?php
		echo $this->Form->input('name', array('class' => 'form-control'));
		echo $this->Form->input('adviser', array(
            'options' => $adviser_options,
            'class' => 'form-control',
            'label' => 'Adviser'
        ));
		echo '<br />';
		echo $this->Form->submit('Add New Organisation', array('class' => 'btn btn-primary'));
	?>
	<?php echo $this->Form->end(); ?>
</div>
<?php
    $this->start('sidebar');
    echo $this->Html->link("<span class=\"glyphicon glyphicon-chevron-left\"></span> Back to Organisations Index", array('action'=>'index'),array('escape' => false, 'class' => 'btn btn-primary') );
    $this->end();
?>