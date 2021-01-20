<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class InstituteType extends Model
{
	use SoftDeletes;

    /**
     * @var string $table the name of the table
     */
    protected $table = 'institute_types';

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
        'type'
    ];

    /**
     * Get the models that are related to this model.
     */
    public function institutes()
    {
        return $this->hasMany('App\Models\Institute', 'institute_type_id', 'id');
    }
}
