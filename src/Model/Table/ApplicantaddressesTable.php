<?php
namespace App\Model\Table;

use Cake\ORM\Query;
use Cake\ORM\RulesChecker;
use Cake\ORM\Table;
use Cake\Validation\Validator;

/**
 * Applicantaddresses Model
 *
 * @property \App\Model\Table\ApplicantsTable|\Cake\ORM\Association\BelongsTo $Applicants
 *
 * @method \App\Model\Entity\Applicantaddress get($primaryKey, $options = [])
 * @method \App\Model\Entity\Applicantaddress newEntity($data = null, array $options = [])
 * @method \App\Model\Entity\Applicantaddress[] newEntities(array $data, array $options = [])
 * @method \App\Model\Entity\Applicantaddress|bool save(\Cake\Datasource\EntityInterface $entity, $options = [])
 * @method \App\Model\Entity\Applicantaddress|bool saveOrFail(\Cake\Datasource\EntityInterface $entity, $options = [])
 * @method \App\Model\Entity\Applicantaddress patchEntity(\Cake\Datasource\EntityInterface $entity, array $data, array $options = [])
 * @method \App\Model\Entity\Applicantaddress[] patchEntities($entities, array $data, array $options = [])
 * @method \App\Model\Entity\Applicantaddress findOrCreate($search, callable $callback = null, $options = [])
 */
class ApplicantaddressesTable extends Table
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

        $this->setTable('applicantaddresses');
        $this->setDisplayField('id');
        $this->setPrimaryKey('id');

        $this->belongsTo('Applicants', [
            'foreignKey' => 'applicant_id',
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
            ->scalar('current_address')
            ->maxLength('current_address', 255)
            ->requirePresence('current_address', 'create')
            ->notEmpty('current_address');

        $validator
            ->scalar('permenent_address')
            ->maxLength('permenent_address', 255)
            ->requirePresence('permenent_address', 'create')
            ->notEmpty('permenent_address');

        $validator
            ->scalar('city')
            ->maxLength('city', 30)
            ->requirePresence('city', 'create')
            ->notEmpty('city');

        $validator
            ->scalar('postal_address')
            ->maxLength('postal_address', 255)
            ->allowEmpty('postal_address');

        $validator
            ->scalar('zip_code')
            ->maxLength('zip_code', 11)
            ->allowEmpty('zip_code');

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
        $rules->add($rules->existsIn(['applicant_id'], 'Applicants'));

        return $rules;
    }
}
