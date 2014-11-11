<?php
	//print_r($disbursement);
	$items_options = array();
		foreach ($items as $item) 
        {
            $items_options[$item['Item']['id']] = $item['Item']['item_name'];
        }

  		echo $this->Form->create('Disbursement');
  		echo $this->Form->hidden('id', array('value' => $disbursement['Disbursement']['id']));
  		echo $this->Form->input('item_id', array(
            'options' => $items_options
        ));
  		echo $this->Form->input('disbursement_date', array('label' => 'Date'));
        echo $this->Form->input('or_number', array('value' => $disbursement['Disbursement']['or_number']));
        echo $this->Form->input('amount', array('value' => $disbursement['Disbursement']['amount']));
        echo $this->Form->submit('Edit Disbursement', array('class' => 'btn btn-primary'));
  		echo $this->Form->end();
?>
<?php
    $this->start('sidebar');
    echo $this->Html->link("<span class=\"glyphicon glyphicon-chevron-left\"></span> Back to Liquidation Form", array('controller' => 'liquidation', 'action'=>'view', $disbursement['Liquidation']['id']),array('escape' => false, 'class' => 'btn btn-info') );
    $this->end();
?>