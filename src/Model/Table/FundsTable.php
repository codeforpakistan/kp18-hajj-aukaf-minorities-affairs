<?php

namespace App\Model\Table;

use Cake\ORM\Query;
use Cake\ORM\RulesChecker;
use Cake\ORM\Table;
use Cake\Validation\Validator;

/**
 * Funds Model
 *
 * @property \App\Model\Table\FundCategoriesTable|\Cake\ORM\Association\BelongsTo $FundCategories
 * @property \App\Model\Table\SubCategoriesTable|\Cake\ORM\Association\BelongsTo $SubCategories
 * @property \App\Model\Table\ApplicantFunddetailsTable|\Cake\ORM\Association\HasMany $ApplicantFunddetails
 *
 * @method \App\Model\Entity\Fund get($primaryKey, $options = [])
 * @method \App\Model\Entity\Fund newEntity($data = null, array $options = [])
 * @method \App\Model\Entity\Fund[] newEntities(array $data, array $options = [])
 * @method \App\Model\Entity\Fund|bool save(\Cake\Datasource\EntityInterface $entity, $options = [])
 * @method \App\Model\Entity\Fund|bool saveOrFail(\Cake\Datasource\EntityInterface $entity, $options = [])
 * @method \App\Model\Entity\Fund patchEntity(\Cake\Datasource\EntityInterface $entity, array $data, array $options = [])
 * @method \App\Model\Entity\Fund[] patchEntities($entities, array $data, array $options = [])
 * @method \App\Model\Entity\Fund findOrCreate($search, callable $callback = null, $options = [])
 *
 * @mixin \Cake\ORM\Behavior\TimestampBehavior
 */
class FundsTable extends Table {

    /**
     * Initialize method
     *
     * @param array $config The configuration for the Table.
     * @return void
     */
    public function initialize(array $config) {
        parent::initialize($config);

        $this->setTable('funds');
        $this->setDisplayField('fund_name');
        $this->setPrimaryKey('id');

        $this->addBehavior('Timestamp');

        $this->belongsTo('FundCategories', [
            'foreignKey' => 'fund_category_id',
            'joinType' => 'INNER'
        ]);
        $this->belongsTo('SubCategories', [
            'foreignKey' => 'sub_category_id'
        ]);
        $this->hasMany('ApplicantFunddetails', [
            'foreignKey' => 'fund_id'
        ]);
        $this->hasMany('Instituteclasses', [
            'foreignKey' => 'fund_id'
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
                ->scalar('total_amount')
                ->maxLength('total_amount', 11)
                ->requirePresence('total_amount', 'create')
                ->notEmpty('total_amount');

        $validator
                ->date('receiving_date')
                ->allowEmpty('receiving_date');

        $validator
                ->scalar('amount_remaining')
                ->maxLength('amount_remaining', 10)
                ->allowEmpty('amount_remaining');

        $validator
                ->date('last_date')
                ->allowEmpty('last_date');

        $validator
                ->scalar('fund_for_year')
                ->allowEmpty('fund_for_year');

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
        $rules->add($rules->existsIn(['fund_category_id'], 'FundCategories'));
        $rules->add($rules->existsIn(['sub_category_id'], 'SubCategories'));

        return $rules;
    }

}
