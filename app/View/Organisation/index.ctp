<div class="organisations form">
	<table class="table table-hover table-bordered">
    <thead>
        <tr>
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
            <td><?php echo $this->Html->link( $organisation['Organisation']['name']  ,   array('action'=>'edit', $organisation['Organisation']['id']),array('escape' => false) );?></td>
            <td >
            <?php echo $this->Html->link("Edit", array('action'=>'edit', $organisation['Organisation']['id']) ); ?>
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

<nav>
<!--    <ul class="pagination">
        <li><?php echo $this->Paginator->prev(htmlentities('&laquo;'), array(), null, array('class'=>'disabled'));?></li>

<?php echo $this->Paginator->numbers(array(   'class' => 'numbers'     ));?>
<?php echo $this->Paginator->next(__('next', true) . ' >>', array(), null, array('class' => 'disabled'));?>
    </ul> -->
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
//    echo $this->Html->link("Add A New Organisation", array('action'=>'add'),array('escape' => false) );
    echo $this->Html->link("<span class=\"glyphicon glyphicon-plus\"></span> Add A New Organisation", array('action'=>'add'),array('escape' => false, 'class' => 'btn btn-primary') );
    $this->end();
?>