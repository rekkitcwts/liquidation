<div class="organisations form">
<h1>Organisations</h1>
	<table>
    <thead>
        <tr>
            <th><?php echo $this->Form->checkbox('all', array('name' => 'CheckAll',  'id' => 'CheckAll')); ?></th>
            <th><?php echo $this->Paginator->sort('name', 'Name');?>  </th>
            <th>Actions</th>
        </tr>
    </thead>
    <tbody>                      
        <?php $count=0; ?>
        <?php foreach($organisations as $organisation): ?>               
        <?php $count ++;?>
        <?php if($count % 2): echo '<tr>'; else: echo '<tr class="zebra">' ?>
        <?php endif; ?>
            <td><?php echo $this->Form->checkbox('Organisation.id.'.$organisation['Organisation']['id']); ?></td>
            <td><?php echo $this->Html->link( $organisation['Organisation']['name']  ,   array('action'=>'edit', $organisation['Organisation']['id']),array('escape' => false) );?></td>
            <td >
            <?php echo $this->Html->link(    "Edit",   array('action'=>'edit', $organisation['Organisation']['id']) ); ?> |
            <?php
/*                if( $user['User']['deleted'] !== 'f'){
                    echo $this->Html->link(    "Delete", array('action'=>'delete', $user['User']['id']));}else{
                    echo $this->Html->link(    "Re-Activate", array('action'=>'activate', $user['User']['id']));
                    } */
            ?>
            </td>
        </tr>
        <?php endforeach; ?>
        <?php unset($organisation); ?>
    </tbody>
</table>
</div>
<?php echo $this->Html->link( "Add A New Organisation",   array('action'=>'add'),array('escape' => false) ); ?>
<br/>
<?php
echo $this->Html->link( "Logout",   array('action'=>'logout') );
?>