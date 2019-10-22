<?php
namespace App\Controller;

use App\Controller\AppController;

/**
 * Products Controller
 *
 * @property \App\Model\Table\ProductsTable $Products
 *
 * @method \App\Model\Entity\Product[]|\Cake\Datasource\ResultSetInterface paginate($object = null, array $settings = [])
 */
class ProductsController extends AppController
{
    /**
     * Index method
     *
     * @return \Cake\Http\Response|null
     */
    public function index()
    {
        $this->paginate = [
            'contain' => ['Categories']
        ];
        $products = $this->paginate($this->Products);

        $this->set(compact('products'));
    }

    /**
     * View method
     *
     * @param string|null $id Product id.
     * @return \Cake\Http\Response|null
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function view($id = null)
    {
        $product = $this->Products->get($id, [
            'contain' => ['Categories']
        ]);

        $this->set('product', $product);
    }

    /**
     * Add method
     *
     * @return \Cake\Http\Response|null Redirects on successful add, renders view otherwise.
     */
    public function add()
    {
        $product = $this->Products->newEntity();
        if ($this->request->is('post')) {
            $product = $this->Products->patchEntity($product, $this->request->getData());
            if ($this->Products->save($product)) {
                $this->Flash->success(__('The product has been saved.'));

                return $this->redirect(['action' => 'index']);
            }
            $this->Flash->error(__('The product could not be saved. Please, try again.'));
        }
        $categories = $this->Products->Categories->find('list', ['limit' => 200, 'order'=>'categories.category_name']);
        $this->set(compact('product', 'categories'));
    }

    /**
     * Edit method
     *
     * @param string|null $id Product id.
     * @return \Cake\Http\Response|null Redirects on successful edit, renders view otherwise.
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function edit($id = null)
    {
        $product = $this->Products->get($id, [
            'contain' => []
        ]);
        if ($this->request->is(['patch', 'post', 'put'])) {
            $product = $this->Products->patchEntity($product, $this->request->getData());
            if ($this->Products->save($product)) {
                $this->Flash->success(__('The product has been saved.'));

                return $this->redirect(['action' => 'index']);
            }
            $this->Flash->error(__('The product could not be saved. Please, try again.'));
        }
        $categories = $this->Products->Categories->find('list', ['limit' => 200]);
        $this->set(compact('product', 'categories'));
    }

    /**
     * Delete method
     *
     * @param string|null $id Product id.
     * @return \Cake\Http\Response|null Redirects to index.
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function delete($id = null)
    {
        $this->request->allowMethod(['post', 'delete']);
        $product = $this->Products->get($id);
        if ($this->Products->delete($product)) {
            $this->Flash->success(__('The product has been deleted.'));
        } else {
            $this->Flash->error(__('The product could not be deleted. Please, try again.'));
        }

        return $this->redirect(['action' => 'index']);
    }

    /**
     * Search method
     *
     * @return \Cake\Http\Response|null Redirects on successful add, renders view otherwise.
     */
    public function search()
    {
        if ($this->request->is('post')) {
            if ($this->request->getData('Country_of_Origin') != '' ||
                $this->request->getData('Sale_Price') != ''
                //|| $this->request->getData('Category_Name')
            ) {
                if ($this->request->getData('Sale_Price') == '') {
                    $products = $this->Products->find('all')
                        ->where(['product_origin LIKE' => "%" .
                            $this->request->getData('Country_of_Origin') . "%"])
                        ->order(['product_name' => 'asc'])
                        ->contain(['Categories']);
                } elseif ($this->request->getData('Country_of_Origin') == '') {
                    $products = $this->Products->find('all')
                        ->where(['product_price <=' => $this->request->getData('Sale_Price')])
                        ->order(['product_name' => 'asc'])
                        ->contain(['Categories']);
                } else {
                    $products = $this->Products->find('all')
                        ->where(['product_origin LIKE' => "%" .
                            $this->request->getData('Country_of_Origin') . "%",
                            'product_price <=' => $this->request->getData('Sale_Price')])
                        ->order(['product_name' => 'asc'])
                        ->contain(['Categories']);
                }
            } else {
                // The below line returns an empty search.
                $products = $this->Products;

                $this->Flash->error(__('Please complete at least one search field.'));
            }
            $this->set(compact('products'));
        }
        else{
            $this->paginate = [
                'contain' => ['Categories'],
                'order' => ['product_name asc']
            ];
            $products = $this->paginate($this->Products);
            $this->set(compact('products'));
        }
    }
}
