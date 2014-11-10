<?php

class Disbursement extends AppModel 
{
	public $belongsTo = array(
		'Liquidation' => array(
			'className' => 'Liquidation',
			'foreignKey' => 'liquidation_id',
			'type' => 'inner',
			'dependent' => true
		),
		'Item' => array(
			'className' => 'Item',
			'foreignKey' => 'item_id',
			'type' => 'inner',
			'dependent' => true
		)
	);
}