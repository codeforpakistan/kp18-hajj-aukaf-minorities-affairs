<?php
namespace App\Model\Entity;

use Cake\ORM\Entity;

/**
 * SubCategory Entity
 *
 * @property int $id
 * @property int $fund_category_id
 * @property string $type_of_fund
 * @property string $description
 * @property \Cake\I18n\FrozenTime $created
 * @property int $status
 *
 * @property \App\Model\Entity\FundCategory $fund_category
 * @property \App\Model\Entity\Apply[] $applies
 * @property \App\Model\Entity\Fund[] $funds
 * @property \App\Model\Entity\ProvidedFund[] $provided_funds
 */
class SubCategory extends Entity
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
        'fund_category_id' => true,
        'type_of_fund' => true,
        'description' => true,
        'created' => true,
        'status' => true,
        'fund_category' => true,
        'applies' => true,
        'funds' => true,
        'provided_funds' => true
    ];
}
