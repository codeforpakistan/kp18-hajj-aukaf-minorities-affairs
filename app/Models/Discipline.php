<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Discipline extends Model
{
	use SoftDeletes;

    /**
     * @var string $table the name of the table
     */
    protected $table = 'disciplines';

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
        'qualification_level_id', 'institute_id', 'discipline'
    ];

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
    public function institute()
    {
        return $this->belongsTo('App\Models\Institute', 'institute_id', 'id');
    }

    /**
     * Get the models that are related to this model.
     */
    public function qualifications()
    {
        return $this->hasMany('App\Models\Qualification', 'discipline_id', 'id');
    }
}
