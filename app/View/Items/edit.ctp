<div class="items form">
	<?php echo $this->Form->create('Item');?>
    <fieldset>
        <legend><?php echo __('Update Item Name'); ?></legend>
        <?php 
        echo $this->Form->hidden('id', array('value' => $item['Item']['id']));
        echo $this->Form->input('item_name', array('value' => $item['Item']['item_name']));
         
        echo $this->Form->submit('Edit Item', array('class' => 'btn btn-primary') );
?>
    </fieldset>
<?php echo $this->Form->end(); ?>
</div>
<?php
    $this->start('sidebar');
    echo $this->Html->link("<span class=\"glyphicon glyphicon-chevron-left\"></span> Back to Item Listings", array('action'=>'index'),array('escape' => false, 'class' => 'btn btn-info') );
    $this->end();
?>