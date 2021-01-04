<?php
namespace App\Model\Table;

use Cake\ORM\Query;
use Cake\ORM\RulesChecker;
use Cake\ORM\Table;
use Cake\Validation\Validator;

/**
 * SubCategories Model
 *
 * @property \App\Model\Table\FundCategoriesTable|\Cake\ORM\Association\BelongsTo $FundCategories
 * @property \App\Model\Table\AppliesTable|\Cake\ORM\Association\HasMany $Applies
 * @property \App\Model\Table\FundsTable|\Cake\ORM\Association\HasMany $Funds
 * @property \App\Model\Table\ProvidedFundsTable|\Cake\ORM\Association\HasMany $ProvidedFunds
 *
 * @method \App\Model\Entity\SubCategory get($primaryKey, $options = [])
 * @method \App\Model\Entity\SubCategory newEntity($data = null, array $options = [])
 * @method \App\Model\Entity\SubCategory[] newEntities(array $data, array $options = [])
 * @method \App\Model\Entity\SubCategory|bool save(\Cake\Datasource\EntityInterface $entity, $options = [])
 * @method \App\Model\Entity\SubCategory|bool saveOrFail(\Cake\Datasource\EntityInterface $entity, $options = [])
 * @method \App\Model\Entity\SubCategory patchEntity(\Cake\Datasource\EntityInterface $entity, array $data, array $options = [])
 * @method \App\Model\Entity\SubCategory[] patchEntities($entities, array $data, array $options = [])
 * @method \App\Model\Entity\SubCategory findOrCreate($search, callable $callback = null, $options = [])
 *
 * @mixin \Cake\ORM\Behavior\TimestampBehavior
 */
class SubCategoriesTable extends Table
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

        $this->setTable('sub_categories');
        $this->setDisplayField('type_of_fund');
        $this->setPrimaryKey('id');

        $this->addBehavior('Timestamp');

        $this->belongsTo('FundCategories', [
            'foreignKey' => 'fund_category_id',
            'joinType' => 'INNER'
        ]);
        $this->hasMany('Applies', [
            'foreignKey' => 'sub_category_id'
        ]);
        $this->hasMany('Funds', [
            'foreignKey' => 'sub_category_id'
        ]);
        $this->hasMany('ProvidedFunds', [
            'foreignKey' => 'sub_category_id'
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

    /**
     * Returns a rules checker object that will be used for validating
     * application integrity.
     *
     * @param \Cake\ORM\RulesChecker $rules The rules object to be modified.
     * @return \Cake\ORM\RulesChecker
     */
    public function buildRules(RulesChecker $rules)
    {
        $rules->add($rules->existsIn(['fund_category_id'], 'FundCategories'));

        return $rules;
    }
}
