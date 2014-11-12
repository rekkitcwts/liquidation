<div class="items form">
	<table class="table table-hover table-bordered">
		<thead>
			<tr>
				<th>Item Name</th>
				<th>Actions</th>
			</tr>
		</thead>
		<tbody>
			<?php $count=0; ?>
			<?php foreach($items as $item): ?>      
			<?php $count ++;?>
			<tr>
				<td><?php echo $this->Html->link( $item['Item']['item_name']  ,   array('action'=>'edit', $item['Item']['id']),array('escape' => false) );?></td>
				<td>
					<?php echo $this->Html->link("<span class=\"glyphicon glyphicon-pencil\"></span> Edit",array('action'=>'edit', $item['Item']['id']),array('escape' => false, 'class' => 'btn btn-success')); ?>
				</td>
			</tr>

<?php endforeach; ?>
<?php unset($items); ?>
</tbody>
</table>
<nav>
    <?php
        $pagination = array(
                $this->Paginator->prev(),
                $this->Paginator->numbers(),
                $this->Paginator->next()
            );
        echo $this->Html->nestedList($pagination, array('class' => 'pagination'));
    ?>
</nav>
</div>
<?php
$this->start('sidebar');
echo $this->Html->link("<span class=\"glyphicon glyphicon-plus\"></span> Add New Item", array('action'=>'add'),array('escape' => false, 'class' => 'btn btn-primary') );
$this->end();
?>