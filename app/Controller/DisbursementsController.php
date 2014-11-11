<?php

class DisbursementsController extends AppController 
{
    // $id = Disbursement ID
    public function edit($id = null)
    {
        if (!$id || !is_numeric($id)) 
        {
            $this->Session->setFlash('No valid data to display.');
            $this->redirect($this->referer());
        }

        $disbursement = $this->Disbursement->findById($id);
        if (!$disbursement) 
        {
            $this->Session->setFlash('Disbursement not found.');
            $this->redirect(array('controller' => 'liquidation','action'=>'index'));
        } 
        else 
        {
            $this->loadModel('Item');
            $items = $this->Item->find('all', array('order' => 'Item.item_name ASC'));
            $this->set('disbursement', $disbursement);
            $this->set('items', $items);
        }

        if ($this->request->is('post') || $this->request->is('put')) 
        {
            $this->Disbursement->id = $id;
            if ($this->Disbursement->save($this->request->data)) 
            {
                $this->Session->setFlash(__('Disbursement has been updated'));
                $this->redirect(array('action' => 'view', $disbursement['Liquidation']['id']));
            }
            else
            {
                $this->Session->setFlash(__('Unable to update the disbursement.'));
            }
        }
    }

    // $id = Disbursement ID
    public function delete($id = null)
    {
        if (!$id || !is_numeric($id)) 
        {
            $this->Session->setFlash('Data not found');
            $this->redirect($this->referer());
        }

        $this->Disbursement->id = $id;
        $disbursement = $this->Disbursement->findById($id);
        if (!$this->Disbursement->exists()) {
            $this->Session->setFlash('Invalid disbursement provided');
            $this->redirect(array('controller' => 'liquidation','action'=>'view',$disbursement['Liquidation']['id']));
        }
        if ($this->Disbursement->saveField('deleted', 'true')) {
            $this->Session->setFlash(__('Disbursement deleted'));
            $this->redirect(array('controller' => 'liquidation','action'=>'view',$disbursement['Liquidation']['id']));
        }
        $this->Session->setFlash(__('Disbursement was not deleted'));
        $this->redirect(array('controller' => 'liquidation','action'=>'view',$disbursement['Liquidation']['id']));
    }

    // $id = Liquidation ID
	public function view($id = null)
	{
		$this->loadModel('Liquidation');

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
            
            $this->loadModel('Item');
            $disbursements = $this->Disbursement->find('all', array('conditions' => array('Disbursement.liquidation_id' => $id, 'Disbursement.deleted' => 'false')));
            $items = $this->Item->find('all', array('order' => 'Item.item_name ASC'));
            $this->set('liquidation', $liquidation);
            $this->set('disbursements', $disbursements);
            $this->set('items', $items);

            
        }

        if ($this->request->is('post'))
        {
            $this->Disbursement->create();
            if ($this->Disbursement->save($this->request->data)) 
            {
                $this->Session->setFlash(__('Disbursement added.'));
                $this->redirect(array('action'=>'view', $liquidation['Liquidation']['id']));
            } 
            else 
            {
                $this->Session->setFlash(__('Unable to add disbursement.'));
            }  
        }
	}
}