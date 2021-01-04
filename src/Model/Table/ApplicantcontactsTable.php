<?php
namespace App\Model\Table;

use Cake\ORM\Query;
use Cake\ORM\RulesChecker;
use Cake\ORM\Table;
use Cake\Validation\Validator;

/**
 * Applicantcontacts Model
 *
 * @property \App\Model\Table\ApplicantsTable|\Cake\ORM\Association\BelongsTo $Applicants
 *
 * @method \App\Model\Entity\Applicantcontact get($primaryKey, $options = [])
 * @method \App\Model\Entity\Applicantcontact newEntity($data = null, array $options = [])
 * @method \App\Model\Entity\Applicantcontact[] newEntities(array $data, array $options = [])
 * @method \App\Model\Entity\Applicantcontact|bool save(\Cake\Datasource\EntityInterface $entity, $options = [])
 * @method \App\Model\Entity\Applicantcontact|bool saveOrFail(\Cake\Datasource\EntityInterface $entity, $options = [])
 * @method \App\Model\Entity\Applicantcontact patchEntity(\Cake\Datasource\EntityInterface $entity, array $data, array $options = [])
 * @method \App\Model\Entity\Applicantcontact[] patchEntities($entities, array $data, array $options = [])
 * @method \App\Model\Entity\Applicantcontact findOrCreate($search, callable $callback = null, $options = [])
 */
class ApplicantcontactsTable extends Table
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

        $this->setTable('applicantcontacts');
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
            ->scalar('mob_number')
            ->maxLength('mob_number', 15)
            ->allowEmpty('mob_number');

        $validator
            ->scalar('tel_number')
            ->maxLength('tel_number', 15)
            ->allowEmpty('tel_number');

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
