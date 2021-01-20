<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class IsApplicable extends Model
{
	use SoftDeletes;

    /**
     * @var string $table the name of the table
     */
    protected $table = 'is_applicables';

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
        'sub_category_id', 'marital_status_id'
    ];

    /**
     * Get the related model that is assigned to this model.
     */
    public function subCategory()
    {
        return $this->belongsTo('App\Models\SubCategory', 'sub_category_id', 'id');
    }  

    /**
     * Get the related model that is assigned to this model.
     */
    public function maritalStatus()
    {
        return $this->belongsTo('App\Models\MaritalStatus', 'marital_status_id', 'id');
    }
}
