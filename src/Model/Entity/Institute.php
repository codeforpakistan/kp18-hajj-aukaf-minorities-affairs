<?php

namespace App\Model\Entity;

use Cake\ORM\Entity;

/**
 * Institute Entity
 *
 * @property int $id
 * @property int $institute_type_id
 * @property string $name
 * @property int $city_id
 * @property string $institute_sector
 * @property string $address
 * @property int $applicantcontact_id
 * @property \Cake\I18n\FrozenTime $created
 * @property \Cake\I18n\FrozenTime $modified
 *
 * @property \App\Model\Entity\InstituteType $institute_type
 * @property \App\Model\Entity\City $city
 * @property \App\Model\Entity\Applicantcontact $applicantcontact
 * @property \App\Model\Entity\Qualification[] $qualifications
 */
class Institute extends Entity {

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
        'institute_type_id' => true,
        'reg_num' => true,
        'user_id' => true,
        'affiliated_with_board' => true,
        'photo_of_affiliation' => true,
        'name' => true,
        'city_id' => true,
        'institute_sector' => true,
        'address' => true,
        'contact_number' => true,
        'created' => true,
        'modified' => true,
        'institute_type' => true,
        'city' => true,
//        'applicantcontact' => true,
        'qualifications' => true
    ];

}
