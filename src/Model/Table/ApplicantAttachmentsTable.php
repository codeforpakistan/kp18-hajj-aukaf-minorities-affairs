<?php
namespace App\Model\Table;

use Cake\ORM\Query;
use Cake\ORM\RulesChecker;
use Cake\ORM\Table;
use Cake\Validation\Validator;

/**
 * ApplicantAttachments Model
 *
 * @property \App\Model\Table\ApplicantsTable|\Cake\ORM\Association\BelongsTo $Applicants
 *
 * @method \App\Model\Entity\ApplicantAttachment get($primaryKey, $options = [])
 * @method \App\Model\Entity\ApplicantAttachment newEntity($data = null, array $options = [])
 * @method \App\Model\Entity\ApplicantAttachment[] newEntities(array $data, array $options = [])
 * @method \App\Model\Entity\ApplicantAttachment|bool save(\Cake\Datasource\EntityInterface $entity, $options = [])
 * @method \App\Model\Entity\ApplicantAttachment|bool saveOrFail(\Cake\Datasource\EntityInterface $entity, $options = [])
 * @method \App\Model\Entity\ApplicantAttachment patchEntity(\Cake\Datasource\EntityInterface $entity, array $data, array $options = [])
 * @method \App\Model\Entity\ApplicantAttachment[] patchEntities($entities, array $data, array $options = [])
 * @method \App\Model\Entity\ApplicantAttachment findOrCreate($search, callable $callback = null, $options = [])
 */
class ApplicantAttachmentsTable extends Table
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

        $this->setTable('applicant_attachments');
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
            ->scalar('attachments')
            ->maxLength('attachments', 40)
            ->requirePresence('attachments', 'create')
            ->notEmpty('attachments');

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
