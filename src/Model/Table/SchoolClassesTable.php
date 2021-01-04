<?php

namespace App\Model\Table;

use Cake\ORM\Query;
use Cake\ORM\RulesChecker;
use Cake\ORM\Table;
use Cake\Validation\Validator;

/**
 * SchoolClasses Model
 *
 * @method \App\Model\Entity\SchoolClass get($primaryKey, $options = [])
 * @method \App\Model\Entity\SchoolClass newEntity($data = null, array $options = [])
 * @method \App\Model\Entity\SchoolClass[] newEntities(array $data, array $options = [])
 * @method \App\Model\Entity\SchoolClass|bool save(\Cake\Datasource\EntityInterface $entity, $options = [])
 * @method \App\Model\Entity\SchoolClass|bool saveOrFail(\Cake\Datasource\EntityInterface $entity, $options = [])
 * @method \App\Model\Entity\SchoolClass patchEntity(\Cake\Datasource\EntityInterface $entity, array $data, array $options = [])
 * @method \App\Model\Entity\SchoolClass[] patchEntities($entities, array $data, array $options = [])
 * @method \App\Model\Entity\SchoolClass findOrCreate($search, callable $callback = null, $options = [])
 *
 * @mixin \Cake\ORM\Behavior\TimestampBehavior
 */
class SchoolClassesTable extends Table {

    /**
     * Initialize method
     *
     * @param array $config The configuration for the Table.
     * @return void
     */
    public function initialize(array $config) {
        parent::initialize($config);

        $this->setTable('school_classes');
        $this->setDisplayField('id');
        $this->setPrimaryKey('id');

        $this->addBehavior('Timestamp');
        
        $this->hasMany('Instituteclasses', [
            'foreignKey' => 'school_class_id'
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
                ->scalar('class_number')
                ->maxLength('class_number', 20)
                ->requirePresence('class_number', 'create')
                ->notEmpty('class_number');

        return $validator;
    }

}
