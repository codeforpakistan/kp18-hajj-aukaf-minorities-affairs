<?php

namespace App\Model\Table;

use Cake\ORM\Query;
use Cake\ORM\RulesChecker;
use Cake\ORM\Table;
use Cake\Validation\Validator;

/**
 * InstituteFunddetails Model
 *
 * @property \App\Model\Table\ApplicantsTable|\Cake\ORM\Association\BelongsTo $Applicants
 * @property \App\Model\Table\FundsTable|\Cake\ORM\Association\BelongsTo $Funds
 *
 * @method \App\Model\Entity\InstituteFunddetail get($primaryKey, $options = [])
 * @method \App\Model\Entity\InstituteFunddetail newEntity($data = null, array $options = [])
 * @method \App\Model\Entity\InstituteFunddetail[] newEntities(array $data, array $options = [])
 * @method \App\Model\Entity\InstituteFunddetail|bool save(\Cake\Datasource\EntityInterface $entity, $options = [])
 * @method \App\Model\Entity\InstituteFunddetail|bool saveOrFail(\Cake\Datasource\EntityInterface $entity, $options = [])
 * @method \App\Model\Entity\InstituteFunddetail patchEntity(\Cake\Datasource\EntityInterface $entity, array $data, array $options = [])
 * @method \App\Model\Entity\InstituteFunddetail[] patchEntities($entities, array $data, array $options = [])
 * @method \App\Model\Entity\InstituteFunddetail findOrCreate($search, callable $callback = null, $options = [])
 *
 * @mixin \Cake\ORM\Behavior\TimestampBehavior
 */
class InstituteFunddetailsTable extends Table {

    /**
     * Initialize method
     *
     * @param array $config The configuration for the Table.
     * @return void
     */
    public function initialize(array $config) {
        parent::initialize($config);

        $this->setTable('institute_funddetails');
        $this->setDisplayField('id');
        $this->setPrimaryKey('id');

        $this->addBehavior('Timestamp');

        $this->belongsTo('Applicants', [
            'foreignKey' => 'applicant_id',
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



        $validator
                ->date('appling_date')
                ->requirePresence('appling_date', 'create')
                ->notEmpty('appling_date');

//        $validator
//            ->requirePresence('selected', 'create')
//            ->notEmpty('selected');

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
        $rules->add($rules->existsIn(['applicant_id'], 'Applicants'));
        $rules->add($rules->existsIn(['fund_id'], 'Funds'));

        return $rules;
    }

}
