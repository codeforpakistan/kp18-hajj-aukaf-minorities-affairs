<?php

namespace App\Model\Entity;

use Cake\ORM\Entity;

/**
 * Applicantaddress Entity
 *
 * @property int $id
 * @property int $applicant_id
 * @property string $current_address
 * @property string $permenent_address
 * @property string $city
 * @property string $postal_address
 * @property string $zip_code
 * @property bool $updated
 *
 * @property \App\Model\Entity\Applicant $applicant
 */
class Applicantaddress extends Entity {

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
        'current_address' => true,
        'permenent_address' => true,
        'city_id' => true,
        'postal_address' => true,
        'zip_code' => true,
        'updated' => true,
        'applicant' => true
    ];

}
