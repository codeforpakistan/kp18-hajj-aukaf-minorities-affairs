<?php
namespace App\Model\Entity;

use Cake\ORM\Entity;

/**
 * QualificationLevel Entity
 *
 * @property int $id
 * @property string $name
 * @property int $institute_type_id
 *
 * @property \App\Model\Entity\InstituteType $institute_type
 * @property \App\Model\Entity\Discipline[] $disciplines
 * @property \App\Model\Entity\Qualification[] $qualifications
 */
class QualificationLevel extends Entity
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
        'institute_type_id' => true,
        'institute_type' => true,
        'disciplines' => true,
        'qualifications' => true
    ];
}
