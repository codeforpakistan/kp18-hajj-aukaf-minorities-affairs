<?php
namespace App\Model\Entity;

use Cake\ORM\Entity;

/**
 * SchoolClass Entity
 *
 * @property int $id
 * @property string $class_number
 * @property \Cake\I18n\FrozenTime $created
 * @property \Cake\I18n\FrozenTime $modified
 */
class SchoolClass extends Entity
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
        'class_number' => true,
        'created' => true,
        'modified' => true
    ];
}
