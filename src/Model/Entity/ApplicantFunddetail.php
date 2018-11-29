<?php

namespace App\Model\Entity;

use Cake\ORM\Entity;

/**
 * ApplicantFunddetail Entity
 *
 * @property int $id
 * @property int $applicant_id
 * @property int $fund_category_id
 * @property int $sub_category_id
 * @property string $amount_recived
 * @property \Cake\I18n\FrozenDate $payment_date
 * @property string $check_number
 * @property \Cake\I18n\FrozenDate $appling_date
 * @property \Cake\I18n\FrozenTime $created
 * @property \Cake\I18n\FrozenTime $modified
 *
 * @property \App\Model\Entity\Applicant $applicant
 * @property \App\Model\Entity\FundCategory $fund_category
 * @property \App\Model\Entity\SubCategory $sub_category
 */
class ApplicantFunddetail extends Entity {

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
        '*' => true,
        'id' => false
    ];

}
