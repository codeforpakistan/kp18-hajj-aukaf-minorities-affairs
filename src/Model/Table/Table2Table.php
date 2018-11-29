<?php
namespace App\Model\Table;

use Cake\ORM\Query;
use Cake\ORM\RulesChecker;
use Cake\ORM\Table;
use Cake\Validation\Validator;

/**
 * Table2 Model
 *
 * @method \App\Model\Entity\Table2 get($primaryKey, $options = [])
 * @method \App\Model\Entity\Table2 newEntity($data = null, array $options = [])
 * @method \App\Model\Entity\Table2[] newEntities(array $data, array $options = [])
 * @method \App\Model\Entity\Table2|bool save(\Cake\Datasource\EntityInterface $entity, $options = [])
 * @method \App\Model\Entity\Table2|bool saveOrFail(\Cake\Datasource\EntityInterface $entity, $options = [])
 * @method \App\Model\Entity\Table2 patchEntity(\Cake\Datasource\EntityInterface $entity, array $data, array $options = [])
 * @method \App\Model\Entity\Table2[] patchEntities($entities, array $data, array $options = [])
 * @method \App\Model\Entity\Table2 findOrCreate($search, callable $callback = null, $options = [])
 */
class Table2Table extends Table
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

        $this->setTable('table2');
        $this->setDisplayField('id');
        $this->setPrimaryKey('id');
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
            ->integer('fname')
            ->requirePresence('fname', 'create')
            ->notEmpty('fname');

        return $validator;
    }
}
