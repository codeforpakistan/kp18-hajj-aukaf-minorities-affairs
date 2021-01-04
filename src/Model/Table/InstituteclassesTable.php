<?php

namespace App\Model\Table;

use Cake\ORM\Query;
use Cake\ORM\RulesChecker;
use Cake\ORM\Table;
use Cake\Validation\Validator;

/**
 * Instituteclasses Model
 *
 * @property \App\Model\Table\InstitutesTable|\Cake\ORM\Association\BelongsTo $Institutes
 *
 * @method \App\Model\Entity\Instituteclass get($primaryKey, $options = [])
 * @method \App\Model\Entity\Instituteclass newEntity($data = null, array $options = [])
 * @method \App\Model\Entity\Instituteclass[] newEntities(array $data, array $options = [])
 * @method \App\Model\Entity\Instituteclass|bool save(\Cake\Datasource\EntityInterface $entity, $options = [])
 * @method \App\Model\Entity\Instituteclass|bool saveOrFail(\Cake\Datasource\EntityInterface $entity, $options = [])
 * @method \App\Model\Entity\Instituteclass patchEntity(\Cake\Datasource\EntityInterface $entity, array $data, array $options = [])
 * @method \App\Model\Entity\Instituteclass[] patchEntities($entities, array $data, array $options = [])
 * @method \App\Model\Entity\Instituteclass findOrCreate($search, callable $callback = null, $options = [])
 *
 * @mixin \Cake\ORM\Behavior\TimestampBehavior
 */
class InstituteclassesTable extends Table {

    /**
     * Initialize method
     *
     * @param array $config The configuration for the Table.
     * @return void
     */
    public function initialize(array $config) {
        parent::initialize($config);

        $this->setTable('instituteclasses');
        $this->setDisplayField('id');
        $this->setPrimaryKey('id');

        $this->addBehavior('Timestamp');

        $this->belongsTo('Institutes', [
            'foreignKey' => 'institute_id',
            'joinType' => 'INNER'
        ]);
        $this->belongsTo('SchoolClasses', [
            'foreignKey' => 'school_class_id',
            'joinType' => 'INNER'
        ]);
        $this->belongsTo('Funds', [
            'foreignKey' => 'fund_id',
            'joinType' => 'INNER'
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

//        $validator
//            ->scalar('class_no')
//            ->maxLength('class_no', 20)
//            ->requirePresence('class_no', 'create')
//            ->notEmpty('class_no');

        $validator
                ->scalar('total_students')
                ->maxLength('total_students', 10)
                ->requirePresence('total_students', 'create')
                ->notEmpty('total_students');

        $validator
                ->scalar('minority_students')
                ->maxLength('minority_students', 10)
                ->requirePresence('minority_students', 'create')
                ->notEmpty('minority_students');

        $validator
                ->scalar('needy_students')
                ->maxLength('needy_students', 10)
                ->requirePresence('needy_students', 'create')
                ->notEmpty('needy_students');

        $validator
                ->scalar('textbook_cost')
                ->maxLength('textbook_cost', 10)
                ->requirePresence('textbook_cost', 'create')
                ->notEmpty('textbook_cost');

        $validator
                ->scalar('boys_uniform')
                ->maxLength('boys_uniform', 10)
                ->allowEmpty('boys_uniform');

        $validator
                ->scalar('girls_uniform')
                ->maxLength('girls_uniform', 10)
                ->allowEmpty('girls_uniform');

        $validator
                ->date('date')
                ->requirePresence('date', 'create')
                ->notEmpty('date');

        return $validator;
    }

    /**
     * Returns a rules checker object that will be used for validating
     * application integrity.
     *
     * @param \Cake\ORM\RulesChecker $rules The rules object to be modified.
     * @return \Cake\ORM\RulesChecker
     */
    public function buildRules(RulesChecker $rules) {
        $rules->add($rules->existsIn(['institute_id'], 'Institutes'));

        return $rules;
    }

}
