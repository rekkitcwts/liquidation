<div class="liquidations form">
	<table class="table table-hover table-bordered">
    <thead>
        <tr>
            <th><?php echo $this->Form->checkbox('all', array('name' => 'CheckAll',  'id' => 'CheckAll')); ?></th>
            <th><?php echo $this->Paginator->sort('created', 'Date Filed');?>  </th>
            <th>Filed By</th>
            <th>Actions</th>
        </tr>
    </thead>
    <tbody>
		<?php $count=0; ?>
        <?php foreach($liquidations as $liquidation): ?>               
        <?php $count ++;?>
        <?php if ((AuthComponent::user('role') == 'admin') || ((AuthComponent::user('role') == 'buficom') && ($liquidation['Buficom']['id'] === AuthComponent::user('id')))): ?>
        <?php echo '<tr>'; ?>
            <td><?php echo $this->Form->checkbox('Liquidation.id.'.$liquidation['Liquidation']['id']); ?></td>
            <td><?php echo $this->Html->link( $liquidation['Liquidation']['created']  ,   array('action'=>'view', $liquidation['Liquidation']['id']),array('escape' => false) );?></td>
            <td><?php echo $liquidation['Buficom']['fname'] . ' ' . $liquidation['Buficom']['lname'] ?></td>
            <td>
            <?php echo $this->Html->link("Edit",array('action'=>'edit', $liquidation['Liquidation']['id']) ); ?>
            </td>
        </tr>
        <?php endif; ?>
        <?php endforeach; ?>
        <?php unset($liquidations); ?>
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
    echo $this->Html->link("<span class=\"glyphicon glyphicon-pencil\"></span> File New Liquidation", array('action'=>'add'),array('escape' => false, 'class' => 'btn btn-primary') );
    $this->end();
?>