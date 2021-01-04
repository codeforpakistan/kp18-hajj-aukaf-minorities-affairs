<?php
namespace App\Model\Table;

use Cake\ORM\Query;
use Cake\ORM\RulesChecker;
use Cake\ORM\Table;
use Cake\Validation\Validator;

/**
 * InstituteTypes Model
 *
 * @property \App\Model\Table\InstitutesTable|\Cake\ORM\Association\HasMany $Institutes
 *
 * @method \App\Model\Entity\InstituteType get($primaryKey, $options = [])
 * @method \App\Model\Entity\InstituteType newEntity($data = null, array $options = [])
 * @method \App\Model\Entity\InstituteType[] newEntities(array $data, array $options = [])
 * @method \App\Model\Entity\InstituteType|bool save(\Cake\Datasource\EntityInterface $entity, $options = [])
 * @method \App\Model\Entity\InstituteType|bool saveOrFail(\Cake\Datasource\EntityInterface $entity, $options = [])
 * @method \App\Model\Entity\InstituteType patchEntity(\Cake\Datasource\EntityInterface $entity, array $data, array $options = [])
 * @method \App\Model\Entity\InstituteType[] patchEntities($entities, array $data, array $options = [])
 * @method \App\Model\Entity\InstituteType findOrCreate($search, callable $callback = null, $options = [])
 */
class InstituteTypesTable extends Table
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

        $this->setTable('institute_types');
        $this->setDisplayField('id');
        $this->setPrimaryKey('id');

        $this->hasMany('Institutes', [
            'foreignKey' => 'institute_type_id'
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
            ->scalar('type')
            ->maxLength('type', 90)
            ->requirePresence('type', 'create')
            ->notEmpty('type');

        return $validator;
    }
}
