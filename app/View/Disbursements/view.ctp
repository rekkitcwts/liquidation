<!-- Nav tabs -->
<ul class="nav nav-tabs" role="tablist">
  <li role="presentation" class="active"><a href="#list" role="tab" data-toggle="tab">List of Disbursements</a></li>
  <li role="presentation"><a href="#add" role="tab" data-toggle="tab">Add a New Disbursement</a></li>
</ul>

<!-- Tab panes -->
<div class="tab-content">
  <div role="tabpanel" class="tab-pane active" id="list">
  	<table class="table table-bordered table-hover">
	<thead>
		<tr>
			<th>Date</th>
			<th>OR Number</th>
			<th>Particulars</th>
			<th>Amount</th>
			<th>Actions</th>
		</tr>
	</thead>
	<tbody>
		<?php
			foreach ($disbursements as $disbursement) 
			{
				echo '<tr>';
				echo '<td>';
				echo $disbursement['Disbursement']['disbursement_date'];
				echo '</td>';
				echo '<td>';
				echo $disbursement['Disbursement']['or_number'];
				echo '</td>';
				echo '<td>';
				echo $disbursement['Item']['item_name'];
				echo '</td>';
				echo '<td>';
				echo $disbursement['Disbursement']['amount'];
				echo '</td>';
				echo '<td>';
				echo $this->Html->link("Edit",array('action'=>'edit', $disbursement['Disbursement']['id']));
				echo ' | ';
				echo $this->Html->link("Delete",array('action'=>'delete', $disbursement['Disbursement']['id']));
				echo '</td>';
				echo '</tr>';
			}
		?>
	</tbody>
</table>
  </div>
  <div role="tabpanel" class="tab-pane" id="add">
  	<div class="alert alert-warning" role="alert">
  		<p><strong class="text-danger">STOP!</strong> Are you sure that the item you are trying to add is listed? Check it in the item dropdown below or <?php echo $this->Html->link("check it here first.", array('controller' => 'items', 'action'=>'index'),array('escape' => false, 'class' => 'alert-link') ); ?> If the item is not listed on BOTH the items page and the dropdown below, then <?php echo $this->Html->link("add it here.", array('controller' => 'items', 'action'=>'add'),array('escape' => false, 'class' => 'alert-link') ); ?></p>
  	</div>
  	<?php
		$items_options = array();
		foreach ($items as $item) 
        {
            $items_options[$item['Item']['id']] = $item['Item']['item_name'];
        }

  		echo $this->Form->create('Disbursement');
  		echo $this->Form->hidden('liquidation_id', array('value' => $liquidation['Liquidation']['id']));
  		echo $this->Form->input('item_id', array(
            'options' => $items_options
        ));
  		echo $this->Form->input('disbursement_date', array('label' => 'Date'));
        echo $this->Form->input('or_number');
        echo $this->Form->input('amount');
        echo $this->Form->submit('Add Reimbursement', array('class' => 'btn btn-primary'));
  		echo $this->Form->end();
  	?>
  </div>
</div>

<?php
    $this->start('sidebar');
    echo $this->Html->link("<span class=\"glyphicon glyphicon-chevron-left\"></span> Back to Liquidation Form", array('controller' => 'liquidation', 'action'=>'view', $liquidation['Liquidation']['id']),array('escape' => false, 'class' => 'btn btn-info') );
    $this->end();
?>