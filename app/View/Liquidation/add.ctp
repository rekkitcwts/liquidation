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
		echo $this->Form->input('recipient');
		echo $this->Form->input('position');
		echo $this->Form->input('activity');
		echo $this->Form->input('form_number');
		echo $this->Form->input('voucher_number');
		echo $this->Form->input('amount_received');
		echo $this->Form->hidden('buficom', array('value' => AuthComponent::user('id')));
		echo $this->Form->input('org_id', array(
            'options' => $org_options
        ));
        echo $this->Form->submit('File This Liquidation Report', array('class' => 'btn btn-primary'));
	?>
	<?php echo $this->Form->end(); ?>
</div>
<?php
    $this->start('sidebar');
    echo $this->Html->link("<span class=\"glyphicon glyphicon-chevron-left\"></span> Back to Liquidations Index", array('action'=>'index'),array('escape' => false, 'class' => 'btn btn-primary') );
    $this->end();
?>