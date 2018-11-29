<?php

namespace App\Model\Entity;

use Cake\ORM\Entity;

/**
 * Instituteclass Entity
 *
 * @property int $id
 * @property int $institute_id
 * @property string $class_no
 * @property string $total_students
 * @property string $minority_students
 * @property string $needy_students
 * @property string $textbook_cost
 * @property string $boys_uniform
 * @property string $girls_uniform
 * @property \Cake\I18n\FrozenDate $date
 * @property \Cake\I18n\FrozenTime $created
 * @property \Cake\I18n\FrozenTime $modified
 *
 * @property \App\Model\Entity\Institute $institute
 */
class Instituteclass extends Entity {

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
        'institute_id' => true,
        'school_class_id' => true,
        'fund_id'=>true,
        'class_no' => true,
        'total_students' => true,
        'minority_students' => true,
        'needy_students' => true,
        'textbook_cost' => true,
        'boys_uniform' => true,
        'girls_uniform' => true,
        'date' => true,
        'deleted' => true,
        'created' => true,
        'modified' => true,
        'institute' => true
    ];

}
