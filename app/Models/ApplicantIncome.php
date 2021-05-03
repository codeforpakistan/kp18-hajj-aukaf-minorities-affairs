<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class ApplicantIncome extends Model
{
	use SoftDeletes;

	/**
     * @var string $table the name of the table
     */
    protected $table = 'applicant_incomes';

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
        'applicant_id', 'monthly_income'
    ];

    /**
     * Get the related model that is assigned to this model.
     */
    public function applicant()
    {
        return $this->belongsTo('App\Models\Applicant', 'applicant_id', 'id');
    }
}