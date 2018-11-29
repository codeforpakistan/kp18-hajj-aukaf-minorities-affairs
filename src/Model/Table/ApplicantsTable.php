<?php

namespace App\Model\Table;

use Cake\ORM\Query;
use Cake\ORM\RulesChecker;
use Cake\ORM\Table;
use Cake\Validation\Validator;

/**
 * Applicants Model
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
class ApplicantsTable extends Table {

    /**
     * Initialize method
     *
     * @param array $config The configuration for the Table.
     * @return void
     */
    public function initialize(array $config) {
        parent::initialize($config);

        $this->setTable('applicants');
        $this->setDisplayField('name');
        $this->setPrimaryKey('id');
<<<<<<< HEAD

        $this->addBehavior('Timestamp');

        $this->belongsTo('Religions', [
            'foreignKey' => 'religion_id',
            'joinType' => 'INNER'
        ]);
       
        $this->belongsTo('Instituteclasses', [
            'foreignKey' => 'instituteclass_id',
            'joinType' => 'INNER'
        ]);
        $this->belongsTo('Users', [
            'foreignKey' => 'user_id',
            'joinType' => 'INNER'
        ]);
        $this->belongsTo('Maritalstatus', [
            'foreignKey' => 'maritalstatus_id',
            'joinType' => 'INNER'
        ]);
        $this->hasMany('ApplicantAttachments', [
            'foreignKey' => 'applicant_id', 'dependent' => true
        ]);
        $this->hasMany('ApplicantHouseholdDetails', [
            'foreignKey' => 'applicant_id', 'dependent' => true
        ]);
        $this->hasMany('Applicantaddresses', [
            'foreignKey' => 'applicant_id', 'dependent' => true
        ]);
        $this->hasMany('Applicantcontacts', [
            'foreignKey' => 'applicant_id', 'dependent' => true
        ]);
        $this->hasMany('InstituteFunddetails', [
            'foreignKey' => 'applicant_id', 'dependent' => true
        ]);
        $this->hasMany('Applicantincomes', [
            'foreignKey' => 'applicant_id', 'dependent' => true
        ]);
        $this->hasMany('Applicantprofessions', [
            'foreignKey' => 'applicant_id', 'dependent' => true
        ]);
        $this->hasMany('Applies', [
            'foreignKey' => 'applicant_id', 'dependent' => true
        ]);
//        $this->hasMany('ProvidedFunds', [
//            'foreignKey' => 'applicant_id', 'dependent' => true
//        ]);
        $this->hasMany('Qualifications', [
            'foreignKey' => 'applicant_id', 'dependent' => true
        ]);
        $this->hasMany('ApplicantFunddetails', [
            'foreignKey' => 'applicant_id', 'dependent' => true
        ]);
=======
>>>>>>> parent of 5c021008... code cleaned
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
<<<<<<< HEAD
                ->scalar('name')
                ->maxLength('name', 40)
                ->requirePresence('name', 'create')
                ->notEmpty('name');

        $validator
                ->scalar('father_name')
                ->maxLength('father_name', 40)
                ->requirePresence('father_name', 'create')
                ->notEmpty('father_name');
        $validator
                ->scalar('husband_name')
                ->maxLength('husband_name', 40)
                ->allowEmpty('groom_or_bride_name');

        $validator
                ->scalar('cnic')
                ->maxLength('cnic', 15)
                ->requirePresence('cnic', 'create')
                ->notEmpty('cnic');

        $validator
                ->scalar('groom_or_bride_name')
                ->maxLength('groom_or_bride_name', 40)
                ->allowEmpty('groom_or_bride_name');
=======
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
            ->dateTime('date of birth')
            ->requirePresence('date of birth', 'create')
            ->notEmpty('date of birth');

        $validator
            ->scalar('current address')
            ->maxLength('current address', 222)
            ->requirePresence('current address', 'create')
            ->notEmpty('current address');

        $validator
            ->scalar('permanent address')
            ->maxLength('permanent address', 222)
            ->requirePresence('permanent address', 'create')
            ->notEmpty('permanent address');

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
            ->scalar('telephone number')
            ->maxLength('telephone number', 222)
            ->requirePresence('telephone number', 'create')
            ->notEmpty('telephone number');

        $validator
            ->scalar('mobile number')
            ->maxLength('mobile number', 222)
            ->requirePresence('mobile number', 'create')
            ->notEmpty('mobile number');
>>>>>>> parent of 5c021008... code cleaned

        return $validator;
    }

    /**
     * Returns a rules checker object that will be used for validating
     * application integrity.
     *
     * @param \Cake\ORM\RulesChecker $rules The rules object to be modified.
     * @return \Cake\ORM\RulesChecker
     */
<<<<<<< HEAD
    public function buildRules(RulesChecker $rules) {
        $rules->add($rules->existsIn(['religion_id'], 'Religions'));
=======
    public function buildRules(RulesChecker $rules)
    {
        $rules->add($rules->isUnique(['email']));

>>>>>>> parent of 5c021008... code cleaned
        return $rules;
    }

}
