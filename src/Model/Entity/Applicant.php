<?php
namespace App\Model\Entity;

use Cake\ORM\Entity;

/**
 * Applicant Entity
 *
 * @property int $id
 * @property string $name
 * @property string $fname
 * @property string $cnic
 * @property int $religon_id
 * @property \Cake\I18n\FrozenDate $date_of_birth
 * @property string $current_address
 * @property string $permanent_address
 * @property string $zipcode
 * @property string $email
 * @property string $telephone_number
 * @property string $mobile_number
 *
 * @property \App\Model\Entity\Religon $religon
 */
class Applicant extends Entity
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
<<<<<<< HEAD
        '*' => true,
        'id' => false
=======
        'name' => true,
        'fname' => true,
        'cnic' => true,
        'religon_id' => true,
        'date_of_birth' => true,
        'current_address' => true,
        'permanent_address' => true,
        'zipcode' => true,
        'email' => true,
        'telephone_number' => true,
        'mobile_number' => true,
        'religon' => true
>>>>>>> parent of 5c021008... code cleaned
    ];
}
