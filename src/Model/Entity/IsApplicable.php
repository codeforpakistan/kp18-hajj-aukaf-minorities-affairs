<?php
namespace App\Model\Entity;

use Cake\ORM\Entity;

/**
 * IsApplicable Entity
 *
 * @property int $id
 * @property int $sub_category_id
 * @property int $maritalstatus_id
 *
 * @property \App\Model\Entity\SubCategory $sub_category
 * @property \App\Model\Entity\Maritalstatus $maritalstatus
 */
class IsApplicable extends Entity
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
        'sub_category_id' => true,
        'maritalstatus_id' => true,
        'sub_category' => true,
        'maritalstatus' => true
    ];
}
