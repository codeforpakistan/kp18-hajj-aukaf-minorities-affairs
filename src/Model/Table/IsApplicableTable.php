<?php
namespace App\Model\Table;

use Cake\ORM\Query;
use Cake\ORM\RulesChecker;
use Cake\ORM\Table;
use Cake\Validation\Validator;

/**
 * IsApplicable Model
 *
 * @property \App\Model\Table\SubCategoriesTable|\Cake\ORM\Association\BelongsTo $SubCategories
 * @property \App\Model\Table\MaritalstatusesTable|\Cake\ORM\Association\BelongsTo $Maritalstatuses
 *
 * @method \App\Model\Entity\IsApplicable get($primaryKey, $options = [])
 * @method \App\Model\Entity\IsApplicable newEntity($data = null, array $options = [])
 * @method \App\Model\Entity\IsApplicable[] newEntities(array $data, array $options = [])
 * @method \App\Model\Entity\IsApplicable|bool save(\Cake\Datasource\EntityInterface $entity, $options = [])
 * @method \App\Model\Entity\IsApplicable|bool saveOrFail(\Cake\Datasource\EntityInterface $entity, $options = [])
 * @method \App\Model\Entity\IsApplicable patchEntity(\Cake\Datasource\EntityInterface $entity, array $data, array $options = [])
 * @method \App\Model\Entity\IsApplicable[] patchEntities($entities, array $data, array $options = [])
 * @method \App\Model\Entity\IsApplicable findOrCreate($search, callable $callback = null, $options = [])
 */
class IsApplicableTable extends Table
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

        $this->setTable('is_applicable');
        $this->setDisplayField('id');
        $this->setPrimaryKey('id');

        $this->belongsTo('SubCategories', [
            'foreignKey' => 'sub_category_id',
            'joinType' => 'INNER'
        ]);
        $this->belongsTo('Maritalstatuses', [
            'foreignKey' => 'maritalstatus_id',
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
        $rules->add($rules->existsIn(['sub_category_id'], 'SubCategories'));
        $rules->add($rules->existsIn(['maritalstatus_id'], 'Maritalstatuses'));

        return $rules;
    }
}
