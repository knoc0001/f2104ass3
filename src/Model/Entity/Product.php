<?php
namespace App\Model\Entity;

use Cake\ORM\Entity;

/**
 * Product Entity
 *
 * @property int $product_id
 * @property string $product_name
 * @property string|null $product_desc
 * @property string|null $product_origin
 * @property float $product_price
 * @property int|null $category_id
 *
 * @property \App\Model\Entity\Category $category
 */
class Product extends Entity
{
    /**
     * Fields that can be mass assigned using newEntity() or patchEntity().
     *
     * Note that when '*' is set to true, this allows all unspecified fields to
     * be mass assigned. For security purposes, it is advised to set '*' to false
     * (or remove it), and explicitly make individual fields accessible as needed.
     *
     * @var array
     */
    protected $_accessible = [
        'product_name' => true,
        'product_desc' => true,
        'product_origin' => true,
        'product_price' => true,
        'category_id' => true,
        'category' => true
    ];
}
