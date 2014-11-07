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

	public function add()
	{
		
	}

	public function view($id = null)
	{
		if (!$id || !is_numeric($id)) 
		{
            $this->Session->setFlash('No valid data to display.');
            $this->redirect(array('action'=>'index'));
        }

        $liquidation = $this->Liquidation->findById($id);
        if (!$liquidation) 
        {
        	$this->Session->setFlash('The liquidation report you specified was not found.');
            $this->redirect(array('action'=>'index'));
        }
        else
        {
        	$this->set('liquidation', $liquidation);
        }
	}
}