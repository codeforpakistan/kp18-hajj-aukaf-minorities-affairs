<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\Traits\Userstamps;
use Illuminate\Database\Eloquent\SoftDeletes;

class Qualification extends Model
{
    use Userstamps;
	use SoftDeletes;

    /**
     * @var string $table the name of the table
     */
    protected $table = 'qualifications';

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
        'applicant_id', 'qualification_level_id', 'recent_class', 'current_class', 'discipline_id', 'institute_id', 'degree_awarding_id', 'education_system', 'grading_system', 'total_cgpa', 'obtained_cgpa', 'total_marks', 'obtained_marks', 'percentage', 'passing_date', 'completed', 'created_by', 'updated_by', 'deleted_by'
    ];

    /**
     * Get the related model that is assigned to this model.
     */
    public function applicant()
    {
        return $this->belongsTo('App\Models\Applicant', 'applicant_id', 'id');
    }

    /**
     * Get the related model that is assigned to this model.
     */
    public function qualificationLevel()
    {
        return $this->belongsTo('App\Models\QualificationLevel', 'qualification_level_id', 'id');
    }

    /**
     * Get the related model that is assigned to this model.
     */
    public function discipline()
    {
        return $this->belongsTo('App\Models\Discipline', 'discipline_id', 'id');
    }

    /**
     * Get the related model that is assigned to this model.
     */
    public function institute()
    {
        return $this->belongsTo('App\Models\Institute', 'institute_id', 'id');
    }

    /**
     * Get the related model that is assigned to this model.
     */
    public function degreeAwarding()
    {
        return $this->belongsTo('App\Models\DegreeAwarding', 'degree_awarding_id', 'id');
    }
}
