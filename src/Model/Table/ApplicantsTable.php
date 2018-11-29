<?php

namespace App\Model\Table;

use Cake\ORM\Query;
use Cake\ORM\RulesChecker;
use Cake\ORM\Table;
use Cake\Validation\Validator;

/**
 * Applicants Model
 *
 * @property \App\Model\Table\ReligionsTable|\Cake\ORM\Association\BelongsTo $Religions
 * @property \App\Model\Table\ApplicantAttachmentsTable|\Cake\ORM\Association\HasMany $ApplicantAttachments
 * @property \App\Model\Table\ApplicantHouseholdDetailsTable|\Cake\ORM\Association\HasMany $ApplicantHouseholdDetails
 * @property \App\Model\Table\ApplicantaddressesTable|\Cake\ORM\Association\HasMany $Applicantaddresses
 * @property \App\Model\Table\ApplicantcontactsTable|\Cake\ORM\Association\HasMany $Applicantcontacts
 * @property \App\Model\Table\ApplicantincomesTable|\Cake\ORM\Association\HasMany $Applicantincomes
 * @property \App\Model\Table\ApplicantprofessionsTable|\Cake\ORM\Association\HasMany $Applicantprofessions
 * @property \App\Model\Table\AppliesTable|\Cake\ORM\Association\HasMany $Applies
 * @property \App\Model\Table\ProvidedFundsTable|\Cake\ORM\Association\HasMany $ProvidedFunds
 *
 * @method \App\Model\Entity\Applicant get($primaryKey, $options = [])
 * @method \App\Model\Entity\Applicant newEntity($data = null, array $options = [])
 * @method \App\Model\Entity\Applicant[] newEntities(array $data, array $options = [])
 * @method \App\Model\Entity\Applicant|bool save(\Cake\Datasource\EntityInterface $entity, $options = [])
 * @method \App\Model\Entity\Applicant|bool saveOrFail(\Cake\Datasource\EntityInterface $entity, $options = [])
 * @method \App\Model\Entity\Applicant patchEntity(\Cake\Datasource\EntityInterface $entity, array $data, array $options = [])
 * @method \App\Model\Entity\Applicant[] patchEntities($entities, array $data, array $options = [])
 * @method \App\Model\Entity\Applicant findOrCreate($search, callable $callback = null, $options = [])
 *
 * @mixin \Cake\ORM\Behavior\TimestampBehavior
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

        return $validator;
    }

    /**
     * Returns a rules checker object that will be used for validating
     * application integrity.
     *
     * @param \Cake\ORM\RulesChecker $rules The rules object to be modified.
     * @return \Cake\ORM\RulesChecker
     */
    public function buildRules(RulesChecker $rules) {
        $rules->add($rules->existsIn(['religion_id'], 'Religions'));
        return $rules;
    }

}
