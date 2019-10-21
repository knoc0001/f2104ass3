<?php
/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\Product $product
 */
?>
<div class="products form large-9 medium-8 columns content">
    <?= $this->Form->create() ?>
    <fieldset>
        <legend><?= 'Search Products' ?></legend>
        <?php
        echo $this->Form->control('namesearch');
        echo $this->Form->control('price');
        ?>
    </fieldset>
    <?= $this->Form->button('Search') ?>
    <?= $this->Form->end() ?>

    <h3><?= __('Products') ?></h3>
    <table cellpadding="0" cellspacing="0">
        <thead>
        <tr>
            <th scope="col"><?= $this->Paginator->sort('product_id') ?></th>
            <th scope="col"><?= $this->Paginator->sort('product_name') ?></th>
            <th scope="col"><?= $this->Paginator->sort('product_desc') ?></th>
            <th scope="col"><?= $this->Paginator->sort('product_origin') ?></th>
            <th scope="col"><?= $this->Paginator->sort('product_price') ?></th>
            <th scope="col"><?= $this->Paginator->sort('category_id') ?></th>
            <th scope="col" class="actions"><?= __('Actions') ?></th>
        </tr>
        </thead>
        <tbody>
        <?php foreach ($products as $product): ?>
            <tr>
                <td><?= $this->Number->format($product->product_id) ?></td>
                <td><?= h($product->product_name) ?></td>
                <td><?= h($product->product_desc) ?></td>
                <td><?= h($product->product_origin) ?></td>
                <td><?= $this->Number->format($product->product_price) ?></td>
                <td><?= $product->has('category') ? $this->Html->link($product->category->category_name, ['controller' => 'Categories', 'action' => 'view', $product->category->category_name]) : '' ?></td>
                <td class="actions">
                    <?= $this->Html->link(__('View'), ['action' => 'view', $product->product_id]) ?>
                    <?= $this->Html->link(__('Edit'), ['action' => 'edit', $product->product_id]) ?>
                    <?= $this->Form->postLink(__('Delete'), ['action' => 'delete', $product->product_id], ['confirm' => __('Are you sure you want to delete # {0}?', $product->product_id)]) ?>
                </td>
            </tr>
        <?php endforeach; ?>
        </tbody>
    </table>


</div>
