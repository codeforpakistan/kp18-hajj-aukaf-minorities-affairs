<?php
namespace App\Model\Entity;

use Cake\ORM\Entity;

/**
 * Apply Entity
 *
 * @property int $id
 * @property int $applicant_id
 * @property int $fund_category_id
 * @property int $sub_category_id
 * @property \Cake\I18n\FrozenDate $date
 * @property \Cake\I18n\FrozenTime $created
 * @property \Cake\I18n\FrozenTime $modified
 *
 * @property \App\Model\Entity\Applicant $applicant
 * @property \App\Model\Entity\FundCategory $fund_category
 * @property \App\Model\Entity\SubCategory $sub_category
 */
class Apply extends Entity
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
        'applicant_id' => true,
        'fund_category_id' => true,
        'sub_category_id' => true,
        'date' => true,
        'created' => true,
        'modified' => true,
        'applicant' => true,
        'fund_category' => true,
        'sub_category' => true
    ];
}
