<?php

namespace App\Model\Table;

use Cake\ORM\Query;
use Cake\ORM\RulesChecker;
use Cake\ORM\Table;
use Cake\Validation\Validator;

/**
 * Institutes Model
 *
 * @property \App\Model\Table\InstituteTypesTable|\Cake\ORM\Association\BelongsTo $InstituteTypes
 * @property \App\Model\Table\CitiesTable|\Cake\ORM\Association\BelongsTo $Cities
 * @property \App\Model\Table\QualificationsTable|\Cake\ORM\Association\HasMany $Qualifications
 *
 * @method \App\Model\Entity\Institute get($primaryKey, $options = [])
 * @method \App\Model\Entity\Institute newEntity($data = null, array $options = [])
 * @method \App\Model\Entity\Institute[] newEntities(array $data, array $options = [])
 * @method \App\Model\Entity\Institute|bool save(\Cake\Datasource\EntityInterface $entity, $options = [])
 * @method \App\Model\Entity\Institute|bool saveOrFail(\Cake\Datasource\EntityInterface $entity, $options = [])
 * @method \App\Model\Entity\Institute patchEntity(\Cake\Datasource\EntityInterface $entity, array $data, array $options = [])
 * @method \App\Model\Entity\Institute[] patchEntities($entities, array $data, array $options = [])
 * @method \App\Model\Entity\Institute findOrCreate($search, callable $callback = null, $options = [])
 *
 * @mixin \Cake\ORM\Behavior\TimestampBehavior
 */
class InstitutesTable extends Table {

    /**
     * Initialize method
     *
     * @param array $config The configuration for the Table.
     * @return void
     */
    public function initialize(array $config) {
        parent::initialize($config);

        $this->setTable('institutes');
        $this->setDisplayField('name');
        $this->setPrimaryKey('id');

        $this->addBehavior('Timestamp');

        $this->belongsTo('InstituteTypes', [
            'foreignKey' => 'institute_type_id',
            'joinType' => 'INNER'
        ]);
        $this->belongsTo('Cities', [
            'foreignKey' => 'city_id',
            'joinType' => 'INNER'
        ]);
        $this->belongsTo('Applicantcontacts', [
            'foreignKey' => 'applicantcontact_id',
            'joinType' => 'INNER'
        ]);
        $this->hasMany('Qualifications', [
            'foreignKey' => 'institute_id'
        ]);
        $this->hasMany('Instituteclasses', [
            'foreignKey' => 'institute_id'
        ]);
    }

    /**
     * Default validation rules.
     *
     * @param \Cake\Validation\Validator $validator Validator instance.
     * @return \Cake\Validation\Validator
     */
    public function validationDefault(Validator $validator) {
        $validator
                ->integer('id')
                ->allowEmpty('id', 'create');

        $validator
                ->scalar('name')
                ->maxLength('name', 90)
                ->requirePresence('name', 'create')
                ->notEmpty('name');

        $validator
                ->scalar('institute_sector')
                ->maxLength('institute_sector', 10)
                ->requirePresence('institute_sector', 'create')
                ->notEmpty('institute_sector');

        $validator
                ->scalar('address')
                ->maxLength('address', 255)
                ->allowEmpty('address');

        return $validator;
    }

    /**
     * Returns a rules checker object that will be used for validating
     * application integrity.
     *
     * @param \Cake\ORM\RulesChecker $rules The rules object to be modified.
     * @return \Cake\ORM\RulesChecker
     */
//    public function buildRules(RulesChecker $rules) {
//        $rules->add($rules->existsIn(['institute_type_id'], 'InstituteTypes'));
//        $rules->add($rules->existsIn(['city_id'], 'Cities'));
//
//        return $rules;
//    }
}
