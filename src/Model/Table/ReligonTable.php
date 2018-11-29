<?php
namespace App\Model\Table;

use Cake\ORM\Query;
use Cake\ORM\RulesChecker;
use Cake\ORM\Table;
use Cake\Validation\Validator;

/**
 * Religon Model
 *
 * @property \App\Model\Table\ApplicantTable|\Cake\ORM\Association\HasMany $Applicant
 *
 * @method \App\Model\Entity\Religon get($primaryKey, $options = [])
 * @method \App\Model\Entity\Religon newEntity($data = null, array $options = [])
 * @method \App\Model\Entity\Religon[] newEntities(array $data, array $options = [])
 * @method \App\Model\Entity\Religon|bool save(\Cake\Datasource\EntityInterface $entity, $options = [])
 * @method \App\Model\Entity\Religon|bool saveOrFail(\Cake\Datasource\EntityInterface $entity, $options = [])
 * @method \App\Model\Entity\Religon patchEntity(\Cake\Datasource\EntityInterface $entity, array $data, array $options = [])
 * @method \App\Model\Entity\Religon[] patchEntities($entities, array $data, array $options = [])
 * @method \App\Model\Entity\Religon findOrCreate($search, callable $callback = null, $options = [])
 */
class ReligonTable extends Table
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

        $this->setTable('religon');
        $this->setDisplayField('name');
        $this->setPrimaryKey('id');

        $this->hasMany('Applicant', [
            'foreignKey' => 'religon_id'
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
            ->scalar('name')
            ->maxLength('name', 100)
            ->requirePresence('name', 'create')
            ->notEmpty('name');

        return $validator;
    }
}
