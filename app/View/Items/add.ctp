<div class="items form">
	<?php echo $this->Form->create('Item');?>
    <fieldset>
        <legend><?php echo __('Add New Item For Reimbursement Purposes'); ?></legend>
        <?php 
        echo $this->Form->input('item_name');
         
        echo $this->Form->submit('Add Item', array('class' => 'btn btn-primary') );
?>
    </fieldset>
<?php echo $this->Form->end(); ?>
</div>