<?php

class Organisation extends AppModel 
{
	public $belongsTo = array(
		'Adviser' => array(
			'className' => 'User',
			'foreignKey' => 'adviser',
			'conditions' => array(
				'Adviser.role' => 'adviser'
			),
			'type' => 'inner',
			'dependent' => true
		)
	);

	public $validate = array(
		'name' => array(
			'nonEmpty' => array(
				'rule' => array('notEmpty'),
				'message' => 'An organisation must have a name.',
				'allowEmpty' => false
				),
			'between' => array(
				'rule' => array('between', 8, 200),
				'required' => true,
				'message' => 'Organisation names must be spelled out, and should contain 8 to 200 characters.'
				)
			)
		);
}