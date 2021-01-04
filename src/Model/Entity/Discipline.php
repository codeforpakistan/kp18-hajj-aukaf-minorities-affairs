<?php
namespace App\Model\Entity;

use Cake\ORM\Entity;

/**
 * Discipline Entity
 *
 * @property int $id
 * @property int $qualification_level_id
 * @property string $discipline
 * @property \Cake\I18n\FrozenTime $created
 * @property \Cake\I18n\FrozenTime $modified
 *
 * @property \App\Model\Entity\QualificationLevel $qualification_level
 * @property \App\Model\Entity\Qualification[] $qualifications
 */
class Discipline extends Entity
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
        'qualification_level_id' => true,
        'discipline' => true,
        'created' => true,
        'modified' => true,
        'qualification_level' => true,
        'qualifications' => true
    ];
}
