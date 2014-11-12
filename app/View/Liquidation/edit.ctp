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
		echo $this->Form->hidden('id', array('value' => $liquidation['Liquidation']['id']));
		echo $this->Form->input('recipient', array('value' => $liquidation['Liquidation']['recipient']));
		echo $this->Form->input('position', array('value' => $liquidation['Liquidation']['position']));
		echo $this->Form->input('activity', array('value' => $liquidation['Liquidation']['activity']));
		echo $this->Form->input('form_number', array('value' => $liquidation['Liquidation']['form_number']));
		echo $this->Form->input('voucher_number', array('value' => $liquidation['Liquidation']['voucher_number']));
		echo $this->Form->input('amount_received', array('value' => $liquidation['Liquidation']['amount_received']));
		echo $this->Form->hidden('buficom', array('value' => $liquidation['Liquidation']['buficom']));
		echo $this->Form->input('org_id', array(
            'options' => $org_options,
            'label' => 'Organisation',
            'value' => $liquidation['Liquidation']['org_id']
        ));
        echo $this->Form->submit('Update This Liquidation Report', array('class' => 'btn btn-primary'));
	?>
	<?php echo $this->Form->end(); ?>
</div>
<?php
    $this->start('sidebar');
    echo $this->Html->link("<span class=\"glyphicon glyphicon-chevron-left\"></span> Back to Liquidations Index", array('action'=>'index'),array('escape' => false, 'class' => 'btn btn-primary') );
    $this->end();
?>