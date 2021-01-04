<?php
namespace App\Model\Table;

use Cake\ORM\Query;
use Cake\ORM\RulesChecker;
use Cake\ORM\Table;
use Cake\Validation\Validator;

/**
 * Maritalstatus Model
 *
 * @property \App\Model\Table\ApplicantsTable|\Cake\ORM\Association\HasMany $Applicants
 *
 * @method \App\Model\Entity\Maritalstatus get($primaryKey, $options = [])
 * @method \App\Model\Entity\Maritalstatus newEntity($data = null, array $options = [])
 * @method \App\Model\Entity\Maritalstatus[] newEntities(array $data, array $options = [])
 * @method \App\Model\Entity\Maritalstatus|bool save(\Cake\Datasource\EntityInterface $entity, $options = [])
 * @method \App\Model\Entity\Maritalstatus|bool saveOrFail(\Cake\Datasource\EntityInterface $entity, $options = [])
 * @method \App\Model\Entity\Maritalstatus patchEntity(\Cake\Datasource\EntityInterface $entity, array $data, array $options = [])
 * @method \App\Model\Entity\Maritalstatus[] patchEntities($entities, array $data, array $options = [])
 * @method \App\Model\Entity\Maritalstatus findOrCreate($search, callable $callback = null, $options = [])
 */
class MaritalstatusTable extends Table
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

        $this->setTable('maritalstatus');
        $this->setDisplayField('status');
        $this->setPrimaryKey('id');

        $this->hasMany('Applicants', [
            'foreignKey' => 'maritalstatus_id'
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
            ->scalar('status')
            ->maxLength('status', 20)
            ->requirePresence('status', 'create')
            ->notEmpty('status');

        return $validator;
    }
}
