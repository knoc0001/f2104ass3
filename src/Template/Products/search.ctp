<?php
/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\Product $product
 */
?>

<nav class="large-3 medium-4 columns" id="actions-sidebar">
    <ul class="side-nav">
        <li class="heading"><?= __('Actions') ?></li>
        <li><?= $this->Html->link(__('List Products'), ['action' => 'index']) ?></li>
        <li><?= $this->Html->link(__('New Product'), ['action' => 'add']) ?></li>
        <li><?= $this->Html->link(__('List Categories'), ['controller' => 'Categories', 'action' => 'index']) ?></li>
        <li><?= $this->Html->link(__('New Category'), ['controller' => 'Categories', 'action' => 'add']) ?></li>
    </ul>
</nav>

<div class="products form large-9 medium-8 columns content">
    <?= $this->Form->create(/*['novalidate'=>true]*/) ?>
    <fieldset>
        <legend><?= 'Search Products' ?></legend>
        <?php
        echo $this->Form->control('Country_of_Origin');
        echo $this->Form->control('Sale_Price');
        echo $this->Form->control('Category_Name');
        ?>
    </fieldset>
    <?= $this->Form->button(__('Search')) ?>
    <?= $this->Form->end() ?>
</div>

<div class="products table large-9 medium-8 columns content">
    <h3><?= __('Products') ?></h3>
    <table cellpadding="0" cellspacing="0">
        <thead>
        <tr>
            <th scope="col"><?= $this->Paginator->sort('product_name') ?></th>
            <th scope="col"><?= $this->Paginator->sort('product_origin') ?></th>
            <th scope="col"><?= $this->Paginator->sort('product_price') ?></th>
            <th scope="col"><?= $this->Paginator->sort('category_id') ?></th>
        </tr>
        </thead>
        <tbody>
        <?php foreach ($products as $product): ?>
            <tr>
                <td><?= h($product->product_name) ?></td>
                <td><?= h($product->product_origin) ?></td>
                <td><?= $this->Number->format($product->product_price) ?></td>
                <td><?= $product->has('category') ? $this->Html->link($product->category->category_name, ['controller' => 'Categories', 'action' => 'view', $product->category->category_name]) : '' ?></td>
            </tr>
        <?php endforeach; ?>
        </tbody>
    </table>
</div>
