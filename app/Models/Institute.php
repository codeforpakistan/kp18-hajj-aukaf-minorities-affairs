<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Institute extends Model
{
	use SoftDeletes;

	/**
     * @var string $table the name of the table
     */
    protected $table = 'institutes';

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
        'user_id', 'name', 'reg_num', 'affiliated_with_board', 'photo_of_affiliation', 'type', 'institute_type_id', 'city_id', 'institute_sector', 'address', 'contact_number'
    ];

    /**
     * Get the user that owns the institute.
     */
    public function user()
    {
        return $this->belongsTo('App\Models\User', 'user_id', 'id');
    }

    /**
     * Get the user that owns the institute.
     */
    public function instituteType()
    {
        return $this->belongsTo('App\Models\InstituteType', 'institute_type_id', 'id');
    }

    /**
     * Get the user that owns the institute.
     */
    public function city()
    {
        return $this->belongsTo('App\Models\City', 'city_id', 'id');
    }

    /**
     * Get the models that are related to this model.
     */
    public function qualifications()
    {
        return $this->hasMany('App\Models\Qualification', 'institute_id', 'id');
    }

    /**
     * Get the models that are related to this model.
     */
    public function instituteClasses()
    {
        return $this->hasMany('App\Models\InstituteClass', 'institute_id', 'id');
    }
}
