<?php

class Liquidation extends AppModel 
{
	public $hasOne = array(
		'buficom' => array(
			'className' => 'User',
			'foreignKey' => 'id',
			'conditions' => array(
				'User.role' => 'buficom'
			),
			'dependent' => true
		),
		'org_id' => array(
			'className' => 'Organisation',
			'foreignKey' => 'id',
			'dependent' => true
		)
	);
}