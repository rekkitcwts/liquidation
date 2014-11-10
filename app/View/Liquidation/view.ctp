<h1>Liquidation Report</h1>
<?php
	//print_r($liquidation);
?>
<table class="table table-bordered">
	<tbody>
		<tr>
			<td><strong>Recipient</strong></td>
			<td><?php echo $liquidation['Liquidation']['recipient']; ?></td>
		</tr>
		<tr>
			<td><strong>Recipient's Position</strong></td>
			<td><?php echo $liquidation['Liquidation']['position']; ?></td>
		</tr>
		<tr>
			<td><strong>Activity</strong></td>
			<td><?php echo $liquidation['Liquidation']['activity']; ?></td>
		</tr>
		<tr>
			<td><strong>Filed By</strong></td>
			<td><?php echo $liquidation['Buficom']['fname'] . ' ' . $liquidation['Buficom']['lname']; ?></td>
		</tr>
		<tr>
			<td><strong>Form No.</strong></td>
			<td><?php echo $liquidation['Liquidation']['form_number']; ?></td>
		</tr>
		<tr>
			<td><strong>Per Cash Voucher No.</strong></td>
			<td><?php echo $liquidation['Liquidation']['voucher_number']; ?></td>
		</tr>
		<tr>
			<td><strong>Date Filed</strong></td>
			<td><?php echo $liquidation['Liquidation']['created']; ?></td>
		</tr>
	</tbody>
</table>
<?php
    $this->start('sidebar');
    echo $this->Html->link("<span class=\"glyphicon glyphicon-book\"></span> Generate PDF", array('action'=>'generatePDF', $liquidation['Liquidation']['id']),array('escape' => false, 'class' => 'btn btn-success') );
    echo $this->Html->link("<span class=\"glyphicon glyphicon-chevron-left\"></span> Back to Liquidation Listings", array('action'=>'index'),array('escape' => false, 'class' => 'btn btn-info') );
    $this->end();
?>