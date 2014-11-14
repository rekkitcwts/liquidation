<div class="liquidations form">
	<?php
		//print_r($orgs);
		$org_options = array();
		foreach ($orgs as $org) 
        {
            $org_options[$org['Organisation']['id']] = $org['Organisation']['name'];
        }
	?>
	<?php echo $this->Form->create('Liquidation');?>
	<?php
		echo $this->Form->input('recipient', array('class' => 'form-control'));
		echo $this->Form->input('position', array('class' => 'form-control'));
		echo $this->Form->input('activity', array('class' => 'form-control'));
		echo $this->Form->input('form_number', array('class' => 'form-control'));
		echo $this->Form->input('voucher_number', array('class' => 'form-control'));
		echo $this->Form->input('amount_received', array('class' => 'form-control'));
		echo $this->Form->hidden('buficom', array('value' => AuthComponent::user('id'), 'class' => 'form-control'));
		echo $this->Form->input('org_id', array(
            'options' => $org_options,
            'class' => 'form-control',
            'label' => 'Organisation'
        ));
        echo '<br />';
        echo $this->Form->submit('File This Liquidation Report', array('class' => 'btn btn-primary'));
	?>
	<?php echo $this->Form->end(); ?>
</div>
<?php
    $this->start('sidebar');
    echo $this->Html->link("<span class=\"glyphicon glyphicon-chevron-left\"></span> Back to Liquidations Index", array('action'=>'index'),array('escape' => false, 'class' => 'btn btn-primary') );
    $this->end();
?>