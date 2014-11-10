<?php
	$amount_disbursed = 0;
?>
<h1>Liquidation Report</h1>
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
		<tr>
			<td><strong>Amount Received</strong></td>
			<td><?php echo $liquidation['Liquidation']['amount_received']; ?></td>
		</tr>
	</tbody>
</table>

<h2>Disbursements <small>To add or remove disbursements, use the Add or Remove Disbursements button on the left</small></h2>
<table class="table table-bordered table-hover">
	<thead>
		<tr>
			<th>Date</th>
			<th>OR Number</th>
			<th>Particulars</th>
			<th>Amount</th>
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
				echo '</tr>';
				$amount_disbursed += $disbursement['Disbursement']['amount'];
			}
		?>
	</tbody>
</table>
<p><strong>Amount Disbursed: </strong><?php echo $amount_disbursed; ?></p>
<?php
	$amount_returned = $liquidation['Liquidation']['amount_received'] - $amount_disbursed;
	if ($amount_returned > 0) 
	{
		echo '<p><strong>Amount to be returned: </strong>'.$amount_returned.'</p>';
	}
?>
<?php
    $this->start('sidebar');
    echo $this->Html->link("<span class=\"glyphicon glyphicon-book\"></span> Generate PDF", array('action'=>'generatePDF', $liquidation['Liquidation']['id']),array('escape' => false, 'class' => 'btn btn-success') );
    echo $this->Html->link("<span class=\"glyphicon glyphicon-chevron-left\"></span> Back to Liquidation Listings", array('action'=>'index'),array('escape' => false, 'class' => 'btn btn-info') );
    echo $this->Html->link("<span class=\"glyphicon glyphicon-shopping-cart\"></span> Add or Remove Disbursements", array('controller' => 'disbursements', 'action'=>'view', $liquidation['Liquidation']['id']),array('escape' => false, 'class' => 'btn btn-primary') );
    $this->end();
?>