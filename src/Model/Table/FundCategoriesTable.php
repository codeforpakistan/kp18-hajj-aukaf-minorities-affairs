<?php

namespace App\Model\Table;

use Cake\ORM\Query;
use Cake\ORM\RulesChecker;
use Cake\ORM\Table;
use Cake\Validation\Validator;

/**
 * FundCategories Model
 *
 * @property \App\Model\Table\AppliesTable|\Cake\ORM\Association\HasMany $Applies
 * @property \App\Model\Table\FundsTable|\Cake\ORM\Association\HasMany $Funds
 * @property \App\Model\Table\ProvidedFundsTable|\Cake\ORM\Association\HasMany $ProvidedFunds
 * @property \App\Model\Table\SubCategoriesTable|\Cake\ORM\Association\HasMany $SubCategories
 *
 * @method \App\Model\Entity\FundCategory get($primaryKey, $options = [])
 * @method \App\Model\Entity\FundCategory newEntity($data = null, array $options = [])
 * @method \App\Model\Entity\FundCategory[] newEntities(array $data, array $options = [])
 * @method \App\Model\Entity\FundCategory|bool save(\Cake\Datasource\EntityInterface $entity, $options = [])
 * @method \App\Model\Entity\FundCategory|bool saveOrFail(\Cake\Datasource\EntityInterface $entity, $options = [])
 * @method \App\Model\Entity\FundCategory patchEntity(\Cake\Datasource\EntityInterface $entity, array $data, array $options = [])
 * @method \App\Model\Entity\FundCategory[] patchEntities($entities, array $data, array $options = [])
 * @method \App\Model\Entity\FundCategory findOrCreate($search, callable $callback = null, $options = [])
 */
class FundCategoriesTable extends Table {

    /**
     * Initialize method
     *
     * @param array $config The configuration for the Table.
     * @return void
     */
    public function initialize(array $config) {
        parent::initialize($config);

        $this->setTable('fund_categories');
        $this->setDisplayField('id');
        $this->setPrimaryKey('id');

        $this->hasMany('Applies', [
            'foreignKey' => 'fund_category_id'
        ]);
        $this->hasMany('Funds', [
            'foreignKey' => 'fund_category_id'
        ]);
        $this->hasMany('ProvidedFunds', [
            'foreignKey' => 'fund_category_id'
        ]);
        $this->hasMany('SubCategories', [
            'foreignKey' => 'fund_category_id'
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
                ->scalar('type_of_fund')
                ->maxLength('type_of_fund', 20)
                ->requirePresence('type_of_fund', 'create')
                ->notEmpty('type_of_fund');

        $validator
                ->scalar('description')
                ->maxLength('description', 255)
                ->allowEmpty('description');

        return $validator;
    }

}
