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

	public $validate = array(
		'recipient' => array(
			'nonEmpty' => array(
                'rule' => array('notEmpty'),
                'message' => 'Please provide a recipient.',
                'allowEmpty' => false
            )
		),
		'position' => array(
			'nonEmpty' => array(
                'rule' => array('notEmpty'),
                'message' => 'Please provide your position, e.g. BUFICOM, Treasurer',
                'allowEmpty' => false
            )
		),
		'form_number' => array(
			'nonEmpty' => array(
                'rule' => array('notEmpty'),
                'message' => 'Please provide a form number.',
                'allowEmpty' => false
            )
		),
		'voucher_number' => array(
			'nonEmpty' => array(
                'rule' => array('notEmpty'),
                'message' => 'Please provide a voucher number.',
                'allowEmpty' => false
            )
		),
		'amount_received' => array(
			'rule' => array('range', 0, null),
			'message' => 'Please provide a valid amount.'
		),
		'org_id' => array(
			'nonEmpty' => array(
                'rule' => array('notEmpty'),
                'message' => 'Please provide an organisation.',
                'allowEmpty' => false
            )
		)
	);
}