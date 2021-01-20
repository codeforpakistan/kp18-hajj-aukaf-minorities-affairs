<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class SubCategory extends Model
{
	use SoftDeletes;

    /**
     * @var string $table the name of the table
     */
    protected $table = 'sub_categories';

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
        'fund_category_id', 'type', 'description', 'status'
    ];

    /**
     * Get the related model that is assigned to this model.
     */
    public function fundCategory()
    {
        return $this->belongsTo('App\Models\FundCategory', 'fund_category_id', 'id');
    }

    /**
     * Get the models that are related to this model.
     */
    public function applies()
    {
        return $this->hasMany('App\Models\Apply', 'sub_category_id', 'id');
    }

    /**
     * Get the models that are related to this model.
     */
    public function funds()
    {
        return $this->hasMany('App\Models\Fund', 'sub_category_id', 'id');
    }
}
