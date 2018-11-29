<?php

namespace App\Model\Entity;

use Cake\ORM\Entity;

/**
 * Fund Entity
 *
 * @property int $id
 * @property int $fund_category_id
 * @property int $sub_category_id
 * @property string $fund_name
 * @property string $total_amount
 * @property \Cake\I18n\FrozenDate $receiving_date
 * @property string $amount_remaining
 * @property \Cake\I18n\FrozenDate $last_date
 * @property string $fund_for_year
 * @property bool $active
 * @property \Cake\I18n\FrozenTime $created
 * @property \Cake\I18n\FrozenTime $modified
 *
 * @property \App\Model\Entity\FundCategory $fund_category
 * @property \App\Model\Entity\SubCategory $sub_category
 * @property \App\Model\Entity\ApplicantFunddetail[] $applicant_funddetails
 */
class Fund extends Entity {

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
        'sub_category_id' => true,
        'fund_name' => true,
        'total_amount' => true,
        'institute_students' => true,
        'receiving_date' => true,
        'amount_remaining' => true,
        'last_date' => true,
        'fund_for_year' => true,
        'active' => true,
        'created' => true,
        'modified' => true,
        'fund_category' => true,
        'sub_category' => true,
        'applicant_funddetails' => true
    ];

}
