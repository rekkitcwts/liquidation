<div class="liquidations form">
	<table class="table table-hover table-bordered">
    <thead>
        <tr>
        <!--    <th><?php echo $this->Form->checkbox('all', array('name' => 'CheckAll',  'id' => 'CheckAll')); ?></th>
 -->           <th><?php echo $this->Paginator->sort('activity', 'Activity');?>  </th>
            <th><?php echo $this->Paginator->sort('created', 'Date Filed');?></th>
            <th>Filed By</th>
            <th>Actions</th>
        </tr>
    </thead>
    <tbody>
		<?php $count=0; ?>
        <?php foreach($liquidations as $liquidation): ?>               
        <?php $count ++;?>
        <?php echo '<tr>'; ?>
        <!--    <td><?php echo $this->Form->checkbox('Liquidation.id.'.$liquidation['Liquidation']['id']); ?></td>-->
            <td><?php echo $this->Html->link( $liquidation['Liquidation']['activity']  ,   array('action'=>'view', $liquidation['Liquidation']['id']),array('escape' => false) );?></td>
            <td><?php echo $liquidation['Liquidation']['created'];?></td>
            <?php if (AuthComponent::user('id') == $liquidation['Liquidation']['buficom']): ?>
            <td>Me</td>
            <?php else: ?>
            <td><?php echo $liquidation['Buficom']['fname'] . ' ' . $liquidation['Buficom']['lname'] ?></td>
            <?php endif; ?>
            <td>
            <?php echo $this->Html->link("<span class=\"glyphicon glyphicon-pencil\"></span> Edit",array('action'=>'edit', $liquidation['Liquidation']['id']), array('escape' => false, 'class' => 'btn btn-success')); ?>
            <?php
                echo ' ';
                echo '<button type="button" class="btn btn-danger" data-toggle="modal" data-target="#confirmDelete'.$liquidation['Liquidation']['id'].'"><span class="glyphicon glyphicon-trash"></span> Delete</button>';
            ?>
            <!-- Modal -->
<div class="modal fade" id="confirmDelete<?php echo $liquidation['Liquidation']['id']; ?>" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">&times;</span><span class="sr-only">Close</span></button>
        <h4 class="modal-title" id="myModalLabel">Confirm Liquidation Removal</h4>
      </div>
      <div class="modal-body">
        <p>Remove this liquidation? This cannot be undone.</p>
      </div>
      <div class="modal-footer">
        <?php
            echo $this->Html->link("Yes",array('action'=>'delete', $liquidation['Liquidation']['id']),array('class' => 'btn btn-danger'));
        ?>
        <button type="button" class="btn btn-default" data-dismiss="modal">No</button>
      </div>
    </div>
  </div>
</div>
            </td>
        </tr>
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