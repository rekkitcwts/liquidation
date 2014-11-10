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
			}
		?>
	</tbody>
</table>
<?php
    $this->start('sidebar');
    echo $this->Html->link("<span class=\"glyphicon glyphicon-chevron-left\"></span> Back to Liquidation Form", array('action'=>'view', $liquidation['Liquidation']['id']),array('escape' => false, 'class' => 'btn btn-info') );
    $this->end();
?>