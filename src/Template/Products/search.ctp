<?php
/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\Product $product
 */
?>

<html>
<head>
    <!--
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
    -->
</head>

<body style="background-color: lemonchiffon;">

<div class="products form large-9 medium-8 columns content" style="width: 80%; padding-left: 25%;">
    <?= $this->Form->create(/*['novalidate'=>true]*/) ?>
    <fieldset>
        <h3 style="color: olive;">Search Products</h3>
        <?php
        echo $this->Form->control('Country_of_Origin');
        echo $this->Form->control('Sale_Price');
        echo $this->Form->control('Category');
        ?>
    </fieldset>
    <?= $this->Form->button(__('Search')) ?>
    <?= $this->Form->end() ?>

    <br>
    <br>
    <br>
    <br>

</div>
<div class="products table large-9 medium-8 columns content" style="width: 100%;">

    <h3 style="color: olive;"><?= __('Products') ?></h3>
    <table align="left" class="table table-striped table-hover" style="background-color: aliceblue;">
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
    
    <div class="paginator">
        <ul class="pagination">
            <?= $this->Paginator->first('<< ' . __('first')) ?>
            <?= $this->Paginator->prev('< ' . __('previous')) ?>
            <?= $this->Paginator->numbers() ?>
            <?= $this->Paginator->next(__('next') . ' >') ?>
            <?= $this->Paginator->last(__('last') . ' >>') ?>
        </ul>

    </div>
</div>

</body>
</html>
