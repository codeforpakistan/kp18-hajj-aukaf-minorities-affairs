<?php
namespace App\Model\Table;

use Cake\ORM\Query;
use Cake\ORM\RulesChecker;
use Cake\ORM\Table;
use Cake\Validation\Validator;

/**
 * Applicant Model
 *
 * @property \App\Model\Table\ReligonsTable|\Cake\ORM\Association\BelongsTo $Religons
 *
 * @method \App\Model\Entity\Applicant get($primaryKey, $options = [])
 * @method \App\Model\Entity\Applicant newEntity($data = null, array $options = [])
 * @method \App\Model\Entity\Applicant[] newEntities(array $data, array $options = [])
 * @method \App\Model\Entity\Applicant|bool save(\Cake\Datasource\EntityInterface $entity, $options = [])
 * @method \App\Model\Entity\Applicant|bool saveOrFail(\Cake\Datasource\EntityInterface $entity, $options = [])
 * @method \App\Model\Entity\Applicant patchEntity(\Cake\Datasource\EntityInterface $entity, array $data, array $options = [])
 * @method \App\Model\Entity\Applicant[] patchEntities($entities, array $data, array $options = [])
 * @method \App\Model\Entity\Applicant findOrCreate($search, callable $callback = null, $options = [])
 */
class ApplicantTable extends Table
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

        $this->setTable('applicant');
        $this->setDisplayField('name');
        $this->setPrimaryKey('id');

        $this->belongsTo('Religons', [
            'foreignKey' => 'religon_id',
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

        $validator
            ->scalar('name')
            ->maxLength('name', 222)
            ->requirePresence('name', 'create')
            ->notEmpty('name');

        $validator
            ->scalar('fname')
            ->maxLength('fname', 222)
            ->requirePresence('fname', 'create')
            ->notEmpty('fname');

        $validator
            ->scalar('cnic')
            ->maxLength('cnic', 222)
            ->requirePresence('cnic', 'create')
            ->notEmpty('cnic');

        $validator
            ->date('date_of_birth')
            ->requirePresence('date_of_birth', 'create')
            ->notEmpty('date_of_birth');

        $validator
            ->scalar('current_address')
            ->maxLength('current_address', 222)
            ->requirePresence('current_address', 'create')
            ->notEmpty('current_address');

        $validator
            ->scalar('permanent_address')
            ->maxLength('permanent_address', 222)
            ->requirePresence('permanent_address', 'create')
            ->notEmpty('permanent_address');

        $validator
            ->scalar('zipcode')
            ->maxLength('zipcode', 222)
            ->requirePresence('zipcode', 'create')
            ->notEmpty('zipcode');

        $validator
            ->email('email')
            ->requirePresence('email', 'create')
            ->notEmpty('email');

        $validator
            ->scalar('telephone_number')
            ->maxLength('telephone_number', 222)
            ->requirePresence('telephone_number', 'create')
            ->notEmpty('telephone_number');

        $validator
            ->scalar('mobile_number')
            ->maxLength('mobile_number', 222)
            ->requirePresence('mobile_number', 'create')
            ->notEmpty('mobile_number');

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
        $rules->add($rules->isUnique(['email']));
        $rules->add($rules->existsIn(['religon_id'], 'Religons'));

        return $rules;
    }
}
