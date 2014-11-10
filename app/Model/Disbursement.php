<?php

class Disbursement extends AppModel 
{
	public $useTable = 'disbursements';

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

	public $validate = array(
		'disbursement_date' => array(
			'nonEmpty' => array(
                'rule' => array('notEmpty'),
                'message' => 'Date is required',
                'allowEmpty' => false
            )
		),
		'or_number' => array(
			'nonEmpty' => array(
                'rule' => array('notEmpty'),
                'message' => 'OR number required',
                'allowEmpty' => false
            )
		),
		'amount' => array(
			'nonEmpty' => array(
                'rule' => array('notEmpty'),
                'message' => 'Disbursed amount is required',
                'allowEmpty' => false
            )
		)
	);
}