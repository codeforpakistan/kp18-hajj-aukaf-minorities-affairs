<?php
namespace App\Model\Entity;

use Cake\ORM\Entity;

/**
 * FundCategory Entity
 *
 * @property int $id
 * @property string $type_of_fund
 * @property string $description
 *
 * @property \App\Model\Entity\Apply[] $applies
 * @property \App\Model\Entity\Fund[] $funds
 * @property \App\Model\Entity\ProvidedFund[] $provided_funds
 * @property \App\Model\Entity\SubCategory[] $sub_categories
 */
class FundCategory extends Entity
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
        'type_of_fund' => true,
        'description' => true,
        'applies' => true,
        'funds' => true,
        'provided_funds' => true,
        'sub_categories' => true
    ];
}
