<?php

namespace App\Model\Entity;

use Cake\ORM\Entity;

/**
 * Qualification Entity
 *
 * @property int $id
 * @property int $applicant_id
 * @property int $qualification_level_id
 * @property int $discipline_id
 * @property int $institute_id
 * @property int $degree_awarding_id
 * @property string $education_system
 * @property string $grading_system
 * @property int $total_cgpa
 * @property float $obtained_cgpa
 * @property int $total_marks
 * @property int $obtained_marks
 * @property float $percentage
 * @property int $created_by
 * @property int $modified_by
 * @property \Cake\I18n\FrozenTime $created
 * @property \Cake\I18n\FrozenTime $modified
 *
 * @property \App\Model\Entity\Applicant $applicant
 * @property \App\Model\Entity\QualificationLevel $qualification_level
 * @property \App\Model\Entity\Discipline $discipline
 * @property \App\Model\Entity\Institute $institute
 * @property \App\Model\Entity\DegreeAwarding $degree_awarding
 */
class Qualification extends Entity {

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
        'qualification_level_id' => true,
        'recent_class' => true,
        'current_class' => true,
        'discipline_id' => true,
        'institute_id' => true,
        'degree_awarding_id' => true,
        'education_system' => true,
        'grading_system' => true,
        'total_cgpa' => true,
        'obtained_cgpa' => true,
        'total_marks' => true,
        'obtained_marks' => true,
        'percentage' => true,
        'passing_date' => true,
        'completed' => true,
        'created_by' => true,
        'modified_by' => true,
        'created' => true,
        'modified' => true,
        'applicant' => true,
        'qualification_level' => true,
        'discipline' => true,
        'institute' => true,
        'degree_awarding' => true
    ];

}
