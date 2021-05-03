<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Applicant extends Model
{
	use SoftDeletes;

	/**
     * @var string $table the name of the table
     */
    protected $table = 'applicants';

    /**
     * @var string $primaryKey the primary key of the table
     */
    protected $primaryKey = 'id';
    
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'user_id', 'institute_class_id', 'name', 'father_name', 'husband_name', 'religion_id', 'cnic', 'gender', 'domicile', 'maritalstatus_id', 'gname', 'gfather_name', 'gcnic', 'gcontact', 'disease', 'dname', 'clinic_address', 'dcontact', 'image', 'operator_review', 'recommended_by'
    ];

    /**
     * Get the user that owns the institute.
     */
    public function user()
    {
        return $this->belongsTo('App\Models\User', 'user_id', 'id');
    }

    /**
     * Get the related model that is assigned to this model.
     */
    public function instituteClass()
    {
        return $this->belongsTo('App\Models\InstituteClass', 'institute_class_id', 'id');
    }

    /**
     * Get the related model that is assigned to this model.
     */
    public function religion()
    {
        return $this->belongsTo('App\Models\Religion', 'religion_id', 'id');
    }

    /**
     * Get the related model that is assigned to this model.
     */
    public function maritalStatus()
    {
        return $this->belongsTo('App\Models\MaritalStatus', 'maritalstatus_id', 'id');
    }

    /**
     * Get the models that are related to this model.
     */
    public function applicantAddress()
    {
        return $this->hasOne('App\Models\ApplicantAddress', 'applicant_id', 'id');
    }

    /**
     * Get the models that are related to this model.
     */
    public function applicantAttachments()
    {
        return $this->hasMany('App\Models\ApplicantAttachment', 'applicant_id', 'id');
    }

    /**
     * Get the models that are related to this model.
     */
    public function applicantContacts()
    {
        return $this->hasMany('App\Models\ApplicantContact', 'applicant_id', 'id');
    }

    /**
     * Get the models that are related to this model.
     */
    public function applicantFundDetail()
    {
        return $this->hasOne('App\Models\ApplicantFundDetail', 'applicant_id', 'id');
    }

    /**
     * Get the models that are related to this model.
     */
    public function applicantHouseholdDetail()
    {
        return $this->hasOne('App\Models\ApplicantHouseholdDetail', 'applicant_id', 'id');
    }

    /**
     * Get the models that are related to this model.
     */
    public function applicantIncome()
    {
        return $this->hasOne('App\Models\ApplicantIncome', 'applicant_id', 'id');
    }

    /**
     * Get the models that are related to this model.
     */
    public function applicantProfession()
    {
        return $this->hasOne('App\Models\ApplicantProfession', 'applicant_id', 'id');
    }

    /**
     * Get the models that are related to this model.
     */
    public function applies()
    {
        return $this->hasMany('App\Models\Apply', 'applicant_id', 'id');
    }

    /**
     * Get the models that are related to this model.
     */
    public function instituteFundDetails()
    {
        return $this->hasMany('App\Models\InstituteFundDetail', 'applicant_id', 'id');
    }

    /**
     * Get the models that are related to this model.
     */
    public function qualification()
    {
        return $this->hasOne('App\Models\Qualification', 'applicant_id', 'id');
    }
}
