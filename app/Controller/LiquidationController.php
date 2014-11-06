<?php

class LiquidationController extends AppController 
{
	public function index()
	{
		$this->paginate = array(
            'limit' => 6,
            'order' => array('Liquidation.created' => 'desc' )
        );
        $liquidations = $this->paginate('Liquidation');
        $this->set(compact('liquidations'));
	}

	public function view($id = null)
	{

	}
}