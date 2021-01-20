<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class City extends Model
{
	use SoftDeletes;

    /**
     * @var string $table the name of the table
     */
    protected $table = 'cities';

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
        'name', 'latitude', 'longitude', 'province'
    ];

    /**
     * Get the models that are related to this model.
     */
    public function applicantAddresses()
    {
        return $this->hasMany('App\Models\ApplicantAddress', 'city_id', 'id');
    }

    /**
     * Get the models that are related to this model.
     */
    public function institutes()
    {
        return $this->hasMany('App\Models\Institute', 'city_id', 'id');
    }
}
