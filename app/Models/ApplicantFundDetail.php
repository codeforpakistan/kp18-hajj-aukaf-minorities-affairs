<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\Traits\Userstamps;
use Illuminate\Database\Eloquent\SoftDeletes;

class ApplicantFundDetail extends Model
{
    use Userstamps;
    use SoftDeletes;

	/**
     * @var string $table the name of the table
     */
    protected $table = 'applicant_fund_details';

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
        'applicant_id', 'fund_id', 'fund_category_id', 'sub_category_id', 'amount_recived', 'payment_date', 'check_number', 'appling_date', 'selected', 'distributed', 'created_by', 'updated_by', 'deleted_by'
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
    public function fund()
    {
        return $this->belongsTo('App\Models\Fund', 'fund_id', 'id');
    }

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
}
