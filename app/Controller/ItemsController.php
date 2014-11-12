<?php

class ItemsController extends AppController 
{
	public function index()
	{
		$this->paginate = array(
            'limit' => 6,
            'order' => array('Item.item_name' => 'asc' )
        );
        $items = $this->paginate('Item');
        $this->set(compact('items'));
	}

	public function add()
	{
		if ($this->request->is('post')) 
        {
                 
            $this->Item->create();
            if ($this->Item->save($this->request->data)) 
            {
                $this->Session->setFlash(__('The item has been added and can now be used in reimbursements.'));
                $this->redirect(array('action' => 'index'));
            } 
            else 
            {
                $this->Session->setFlash(__('Sorry, something bad happened when trying to add a new item.'));
            }  
        }
	}

	public function edit($id = null)
	{
        if (!$id || !is_numeric($id)) 
        {
            $this->Session->setFlash('No valid data to display.');
            $this->redirect(array('action'=>'index'));
        }

        $item = $this->Item->findById($id);
        if (!$item) 
        {
            $this->Session->setFlash('The item specified was not found.');
            $this->redirect(array('action'=>'index'));
        }
        else
        {
            $this->set('item', $item);
        }

        if ($this->request->is('post') || $this->request->is('put')) 
        {
            $this->Item->id = $id;
            if ($this->Item->save($this->request->data)) 
            {
                $this->Session->setFlash(__('Item has been updated'));
                $this->redirect(array('action' => 'index'));
            }
            else
            {
                $this->Session->setFlash(__('Unable to update the item.'));
            }
        }
	}

	public function delete()
	{

	}
}