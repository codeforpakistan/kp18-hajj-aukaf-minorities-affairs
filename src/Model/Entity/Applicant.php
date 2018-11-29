<?php
namespace App\Model\Entity;

use Cake\ORM\Entity;

/**
 * Applicant Entity
 *
 * @property int $id
 * @property string $name
 * @property string $father_or_husband_name
 * @property int $religion_id
 * @property string $cnic
 * @property string $groom_or_bride_name
 * @property \Cake\I18n\FrozenTime $created
 * @property \Cake\I18n\FrozenTime $modified
 *
 * @property \App\Model\Entity\Religion $religion
 * @property \App\Model\Entity\ApplicantAttachment[] $applicant_attachments
 * @property \App\Model\Entity\ApplicantHouseholdDetail[] $applicant_household_details
 * @property \App\Model\Entity\Applicantaddress[] $applicantaddresses
 * @property \App\Model\Entity\Applicantcontact[] $applicantcontacts
 * @property \App\Model\Entity\Applicantincome[] $applicantincomes
 * @property \App\Model\Entity\Applicantprofession[] $applicantprofessions
 * @property \App\Model\Entity\Apply[] $applies
 * @property \App\Model\Entity\ProvidedFund[] $provided_funds
 */
class Applicant extends Entity
{

    /**
     * Fields that can be mass assigned using newEntity() or patchEntity().
     *
     * Note that when '*' is set to true, this allows all unspecified fields to
     * be mass assigned. For security purposes, it is advised to set '*' to false
     * (or remove it), and explicitly make individual fields accessible as needed.
     *
     * @var array
     */
    protected $_accessible = [
        '*' => true,
        'id' => false
    ];
}
