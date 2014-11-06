<?php

class Liquidation extends AppModel 
{
	public $belongsTo = array(
		'Buficom' => array(
			'className' => 'User',
			'foreignKey' => 'buficom',
			'conditions' => array(
				'Buficom.role' => 'buficom'
			),
			'type' => 'inner',
			'dependent' => true
		),
		'Organisation' => array(
			'className' => 'Organisation',
			'foreignKey' => 'org_id',
			'type' => 'inner',
			'dependent' => true
		)
	);
}