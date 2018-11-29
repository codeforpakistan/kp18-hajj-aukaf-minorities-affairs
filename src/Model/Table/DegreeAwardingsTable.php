<?php
namespace App\Model\Table;

use Cake\ORM\Query;
use Cake\ORM\RulesChecker;
use Cake\ORM\Table;
use Cake\Validation\Validator;

/**
 * DegreeAwardings Model
 *
 * @property \App\Model\Table\QualificationsTable|\Cake\ORM\Association\HasMany $Qualifications
 *
 * @method \App\Model\Entity\DegreeAwarding get($primaryKey, $options = [])
 * @method \App\Model\Entity\DegreeAwarding newEntity($data = null, array $options = [])
 * @method \App\Model\Entity\DegreeAwarding[] newEntities(array $data, array $options = [])
 * @method \App\Model\Entity\DegreeAwarding|bool save(\Cake\Datasource\EntityInterface $entity, $options = [])
 * @method \App\Model\Entity\DegreeAwarding|bool saveOrFail(\Cake\Datasource\EntityInterface $entity, $options = [])
 * @method \App\Model\Entity\DegreeAwarding patchEntity(\Cake\Datasource\EntityInterface $entity, array $data, array $options = [])
 * @method \App\Model\Entity\DegreeAwarding[] patchEntities($entities, array $data, array $options = [])
 * @method \App\Model\Entity\DegreeAwarding findOrCreate($search, callable $callback = null, $options = [])
 */
class DegreeAwardingsTable extends Table
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

        $this->setTable('degree_awardings');
        $this->setDisplayField('name');
        $this->setPrimaryKey('id');

        $this->hasMany('Qualifications', [
            'foreignKey' => 'degree_awarding_id'
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
            ->maxLength('name', 30)
            ->requirePresence('name', 'create')
            ->notEmpty('name');

        return $validator;
    }
}
