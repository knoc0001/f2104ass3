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

<div class="products form large-9 medium-8 columns content" style="width: 100%;">
    <?= $this->Form->create($product, ['novalidate'=>true]) ?>
    <fieldset>
        <h3 style="color: olive;">Add Product</h3>
        <?php
            echo $this->Form->control('product_name');
            echo $this->Form->control('product_origin');
            echo $this->Form->control('product_price');
            echo $this->Form->control('category_id', ['options' => $categories, 'empty' => true]);
        ?>
    </fieldset>
    <?= $this->Form->button(__('Submit')) ?>
    <?= $this->Form->end() ?>
</div>

</body>
</html>
