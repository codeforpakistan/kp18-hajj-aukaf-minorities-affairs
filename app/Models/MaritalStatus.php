<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class MaritalStatus extends Model
{
	use SoftDeletes;

    /**
     * @var string $table the name of the table
     */
    protected $table = 'marital_statuses';

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
        'status'
    ];

    /**
     * Get the models that are related to this model.
     */
    public function applicants()
    {
        return $this->hasMany('App\Models\Applicant', 'maritalstatus_id', 'id');
    }
}
