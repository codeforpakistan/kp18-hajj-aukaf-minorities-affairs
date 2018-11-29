<?php
namespace App\Model\Entity;

use Cake\ORM\Entity;

/**
 * Applicantcontact Entity
 *
 * @property int $id
 * @property int $applicant_id
 * @property string $mob_number
 * @property string $tel_number
 * @property int $updated
 *
 * @property \App\Model\Entity\Applicant $applicant
 */
class Applicantcontact extends Entity
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
        'mob_number' => true,
        'tel_number' => true,
        'updated' => true,
        'applicant' => true
    ];
}
