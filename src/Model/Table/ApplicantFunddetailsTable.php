<?php

namespace App\Model\Table;

use Cake\ORM\Query;
use Cake\ORM\RulesChecker;
use Cake\ORM\Table;
use Cake\Validation\Validator;

/**
 * ApplicantFunddetails Model
 *
 * @property \App\Model\Table\ApplicantsTable|\Cake\ORM\Association\BelongsTo $Applicants
 * @property \App\Model\Table\FundsTable|\Cake\ORM\Association\BelongsTo $Funds
 * @property \App\Model\Table\FundCategoriesTable|\Cake\ORM\Association\BelongsTo $FundCategories
 * @property \App\Model\Table\SubCategoriesTable|\Cake\ORM\Association\BelongsTo $SubCategories
 *
 * @method \App\Model\Entity\ApplicantFunddetail get($primaryKey, $options = [])
 * @method \App\Model\Entity\ApplicantFunddetail newEntity($data = null, array $options = [])
 * @method \App\Model\Entity\ApplicantFunddetail[] newEntities(array $data, array $options = [])
 * @method \App\Model\Entity\ApplicantFunddetail|bool save(\Cake\Datasource\EntityInterface $entity, $options = [])
 * @method \App\Model\Entity\ApplicantFunddetail|bool saveOrFail(\Cake\Datasource\EntityInterface $entity, $options = [])
 * @method \App\Model\Entity\ApplicantFunddetail patchEntity(\Cake\Datasource\EntityInterface $entity, array $data, array $options = [])
 * @method \App\Model\Entity\ApplicantFunddetail[] patchEntities($entities, array $data, array $options = [])
 * @method \App\Model\Entity\ApplicantFunddetail findOrCreate($search, callable $callback = null, $options = [])
 *
 * @mixin \Cake\ORM\Behavior\TimestampBehavior
 */
class ApplicantFunddetailsTable extends Table {

    /**
     * Initialize method
     *
     * @param array $config The configuration for the Table.
     * @return void
     */
    public function initialize(array $config) {
        parent::initialize($config);

        $this->setTable('applicant_funddetails');
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
        $this->belongsTo('FundCategories', [
            'foreignKey' => 'fund_category_id'
        ]);
        $this->belongsTo('SubCategories', [
            'foreignKey' => 'sub_category_id',
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
//                ->scalar('amount_recived')
//                ->maxLength('amount_recived', 10)
//                ->allowEmpty('amount_recived');
//
//        $validator
//                ->date('payment_date')
//                ->allowEmpty('payment_date');
//
//        $validator
//                ->scalar('check_number')
//                ->maxLength('check_number', 30)
//                ->allowEmpty('check_number');

//        $validator
//                ->dateTime('appling_date')
//                ->allowEmpty('appling_date');

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
//        $rules->add($rules->existsIn(['fund_id'], 'Funds'));
        $rules->add($rules->existsIn(['fund_category_id'], 'FundCategories'));
        $rules->add($rules->existsIn(['sub_category_id'], 'SubCategories'));

        return $rules;
    }

}
