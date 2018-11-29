<?php
namespace App\Model\Table;

use Cake\ORM\Query;
use Cake\ORM\RulesChecker;
use Cake\ORM\Table;
use Cake\Validation\Validator;

/**
 * QualificationLevels Model
 *
 * @property \App\Model\Table\InstituteTypesTable|\Cake\ORM\Association\BelongsTo $InstituteTypes
 * @property \App\Model\Table\DisciplinesTable|\Cake\ORM\Association\HasMany $Disciplines
 * @property \App\Model\Table\QualificationsTable|\Cake\ORM\Association\HasMany $Qualifications
 *
 * @method \App\Model\Entity\QualificationLevel get($primaryKey, $options = [])
 * @method \App\Model\Entity\QualificationLevel newEntity($data = null, array $options = [])
 * @method \App\Model\Entity\QualificationLevel[] newEntities(array $data, array $options = [])
 * @method \App\Model\Entity\QualificationLevel|bool save(\Cake\Datasource\EntityInterface $entity, $options = [])
 * @method \App\Model\Entity\QualificationLevel|bool saveOrFail(\Cake\Datasource\EntityInterface $entity, $options = [])
 * @method \App\Model\Entity\QualificationLevel patchEntity(\Cake\Datasource\EntityInterface $entity, array $data, array $options = [])
 * @method \App\Model\Entity\QualificationLevel[] patchEntities($entities, array $data, array $options = [])
 * @method \App\Model\Entity\QualificationLevel findOrCreate($search, callable $callback = null, $options = [])
 */
class QualificationLevelsTable extends Table
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

        $this->setTable('qualification_levels');
        $this->setDisplayField('name');
        $this->setPrimaryKey('id');

        $this->belongsTo('InstituteTypes', [
            'foreignKey' => 'institute_type_id',
            'joinType' => 'INNER'
        ]);
        $this->hasMany('Disciplines', [
            'foreignKey' => 'qualification_level_id'
        ]);
        $this->hasMany('Qualifications', [
            'foreignKey' => 'qualification_level_id'
        ]);
        $this->belongsTo('Applicants', [
            'foreignKey' => 'applicant_id',
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
            ->scalar('name')
            ->maxLength('name', 11)
            ->requirePresence('name', 'create')
            ->notEmpty('name');

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
        $rules->add($rules->existsIn(['institute_type_id'], 'InstituteTypes'));

        return $rules;
    }
}
