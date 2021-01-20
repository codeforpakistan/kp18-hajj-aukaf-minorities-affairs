<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class InstituteFundDetail extends Model
{
	use SoftDeletes;

	/**
     * @var string $table the name of the table
     */
    protected $table = 'institute_fund_details';

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
        'applicant_id', 'fund_id', 'amount_recived', 'payment_date', 'appling_date', 'selected'
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
}
