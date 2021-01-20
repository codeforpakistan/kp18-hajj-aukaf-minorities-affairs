<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class QualificationLevel extends Model
{
	use SoftDeletes;

    /**
     * @var string $table the name of the table
     */
    protected $table = 'qualification_levels';

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
        'name', 'institute_type_id'
    ];

    /**
     * Get the related model that is assigned to this model.
     */
    public function instituteType()
    {
        return $this->belongsTo('App\Models\InstituteType', 'institute_type_id', 'id');
    }

    /**
     * Get the models that are related to this model.
     */
    public function instituteClasses()
    {
        return $this->hasMany('App\Models\Discipline', 'qualification_level_id', 'id');
    }

    /**
     * Get the models that are related to this model.
     */
    public function qualifications()
    {
        return $this->hasMany('App\Models\Qualification', 'qualification_level_id', 'id');
    }
}
