<?php
namespace App\Model\Table;

use Cake\ORM\Query;
use Cake\ORM\RulesChecker;
use Cake\ORM\Table;
use Cake\Validation\Validator;

/**
 * Qualifications Model
 *
 * @property \App\Model\Table\ApplicantsTable|\Cake\ORM\Association\BelongsTo $Applicants
 * @property \App\Model\Table\QualificationLevelsTable|\Cake\ORM\Association\BelongsTo $QualificationLevels
 * @property \App\Model\Table\DisciplinesTable|\Cake\ORM\Association\BelongsTo $Disciplines
 * @property \App\Model\Table\InstitutesTable|\Cake\ORM\Association\BelongsTo $Institutes
 * @property \App\Model\Table\DegreeAwardingsTable|\Cake\ORM\Association\BelongsTo $DegreeAwardings
 *
 * @method \App\Model\Entity\Qualification get($primaryKey, $options = [])
 * @method \App\Model\Entity\Qualification newEntity($data = null, array $options = [])
 * @method \App\Model\Entity\Qualification[] newEntities(array $data, array $options = [])
 * @method \App\Model\Entity\Qualification|bool save(\Cake\Datasource\EntityInterface $entity, $options = [])
 * @method \App\Model\Entity\Qualification|bool saveOrFail(\Cake\Datasource\EntityInterface $entity, $options = [])
 * @method \App\Model\Entity\Qualification patchEntity(\Cake\Datasource\EntityInterface $entity, array $data, array $options = [])
 * @method \App\Model\Entity\Qualification[] patchEntities($entities, array $data, array $options = [])
 * @method \App\Model\Entity\Qualification findOrCreate($search, callable $callback = null, $options = [])
 *
 * @mixin \Cake\ORM\Behavior\TimestampBehavior
 */
class QualificationsTable extends Table
{

    /**
     * Initialize method
     *
     * @param array $config The configuration for the Table.
     * @return void
     */
    public function initialize(array $config)
    {
        parent::initialize($config);

        $this->setTable('qualifications');
        $this->setDisplayField('id');
        $this->setPrimaryKey('id');

        $this->addBehavior('Timestamp');

        $this->belongsTo('Applicants', [
            'foreignKey' => 'applicant_id',
            'joinType' => 'INNER'
        ]);
        $this->belongsTo('QualificationLevels', [
            'foreignKey' => 'qualification_level_id',
            'joinType' => 'INNER'
        ]);
        $this->belongsTo('Disciplines', [
            'foreignKey' => 'discipline_id',
            'joinType' => 'INNER'
        ]);
        $this->belongsTo('Institutes', [
            'foreignKey' => 'institute_id',
            'joinType' => 'INNER'
        ]);
        $this->belongsTo('DegreeAwardings', [
            'foreignKey' => 'degree_awarding_id',
            'joinType' => 'INNER'
        ]);
    }

    /**
     * Default validation rules.
     *
     * @param \Cake\Validation\Validator $validator Validator instance.
     * @return \Cake\Validation\Validator
     */
    public function validationDefault(Validator $validator)
    {
        $validator
            ->integer('id')
            ->allowEmpty('id', 'create');

        $validator
            ->scalar('education_system')
            ->maxLength('education_system', 20)
            ->requirePresence('education_system', 'create')
            ->notEmpty('education_system');

        $validator
            ->scalar('grading_system')
            ->maxLength('grading_system', 10)
            ->requirePresence('grading_system', 'create')
            ->allowEmpty('grading_system', 'create');

        $validator
            ->integer('total_cgpa')
            ->allowEmpty('total_cgpa');

        $validator
            ->numeric('obtained_cgpa')
            ->allowEmpty('obtained_cgpa');

        $validator
            ->integer('total_marks')
            ->allowEmpty('total_marks');

        $validator
            ->integer('obtained_marks')
            ->allowEmpty('obtained_marks');

        $validator
            ->numeric('percentage')
            ->requirePresence('percentage', 'create')
            ->allowEmpty('percentage');

        $validator
            ->integer('created_by')
            ->allowEmpty('created_by');

        $validator
            ->integer('modified_by')
            ->allowEmpty('modified_by');

        return $validator;
    }

    /**
     * Returns a rules checker object that will be used for validating
     * application integrity.
     *
     * @param \Cake\ORM\RulesChecker $rules The rules object to be modified.
     * @return \Cake\ORM\RulesChecker
     */
    public function buildRules(RulesChecker $rules)
    {
        $rules->add($rules->existsIn(['applicant_id'], 'Applicants'));
        $rules->add($rules->existsIn(['qualification_level_id'], 'QualificationLevels'));
        $rules->add($rules->existsIn(['discipline_id'], 'Disciplines'));
        $rules->add($rules->existsIn(['institute_id'], 'Institutes'));
        $rules->add($rules->existsIn(['degree_awarding_id'], 'DegreeAwardings'));

        return $rules;
    }
}
