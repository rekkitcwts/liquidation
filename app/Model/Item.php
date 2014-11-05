<?php

class Item extends AppModel 
{
	public $validate = array(
		'item_name' => array(
			'nonEmpty' => array(
                'rule' => array('notEmpty'),
                'message' => 'Item name is required.',
                'allowEmpty' => false
            ),
            'between' => array(
                'rule' => array('between', 5, 100),
                'required' => true,
                'message' => 'Item name must be between 5 to 100 characters'
            ),
             'unique' => array(
                'rule'    => array('isUniqueItem'),
                'message' => 'This item name is already in use'
            ),
            'alphaNumericDashUnderscore' => array(
                'rule'    => array('alphaNumericDashUnderscore'),
                'message' => 'Item names can only be letters, numbers and underscores'
            )
		)
	);

	/**
     * Before isUniqueItem
     * @param array $options
     * @return boolean
     */
    function isUniqueItem($check) 
    {
 
        $item = $this->find(
            'first',
            array(
                'fields' => array(
                    'Item.id',
                    'Item.item_name'
                ),
                'conditions' => array(
                    'Item.item_name' => $check['item_name']
                )
            )
        );
 
        if(!empty($item))
        {
            if($this->data[$this->alias]['id'] == $item['Item']['id'])
            {
                return true;
            }
            else
            {
                return false;
            }
        }
        else
        {
            return true;
        }
    }

	public function alphaNumericDashUnderscore($check) {
        // $data array is passed using the form field name as the key
        // have to extract the value to make the function generic
        $value = array_values($check);
        $value = $value[0];
 
        return preg_match('/^[a-zA-Z0-9_ \-]*$/', $value);
    }
}