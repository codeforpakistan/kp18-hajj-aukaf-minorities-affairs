<?php
namespace App\Model\Entity;

use Cake\ORM\Entity;

/**
 * City Entity
 *
 * @property int $id
 * @property string $name
 * @property string $latitude
 * @property string $longitude
 * @property string $provence
 *
 * @property \App\Model\Entity\Applicantaddress[] $applicantaddresses
 * @property \App\Model\Entity\Institute[] $institutes
 */
class City extends Entity
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
        'name' => true,
        'latitude' => true,
        'longitude' => true,
        'provence' => true,
        'applicantaddresses' => true,
        'institutes' => true
    ];
}
