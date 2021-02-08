<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Fund extends Model
{
	use SoftDeletes;

    /**
     * @var string $table the name of the table
     */
    protected $table = 'funds';

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
        'fund_name', 'fund_category_id', 'sub_category_id', 'total_amount', 'receiving_date', 'amount_remaining', 'last_date', 'fund_for_year', 'institute_students', 'active'
    ];

    /**
     * Get the related model that is assigned to this model.
     */
    public function fundCategory()
    {
        return $this->belongsTo('App\Models\FundCategory', 'fund_category_id', 'id');
    }

    /**
     * Get the related model that is assigned to this model.
     */
    public function subCategory()
    {
        return $this->belongsTo('App\Models\SubCategory', 'sub_category_id', 'id');
    }

    /**
     * Get the models that are related to this model.
     */
    public function applicantFundDetails()
    {
        return $this->hasMany('App\Models\ApplicantFundDetail', 'fund_id', 'id');
    }

    /**
     * Get the models that are related to this model.
     */
    public function instituteClasses()
    {
        return $this->hasMany('App\Models\InstituteClass', 'fund_id', 'id');
    }
}
