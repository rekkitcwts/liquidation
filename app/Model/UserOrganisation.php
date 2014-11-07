<?php

class UserOrganisation extends AppModel 
{
	public $useTable = 'user_organisation';

	public $belongsTo = array(
		'User' => array(
			'className' => 'User',
			'foreignKey' => 'user_id',
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