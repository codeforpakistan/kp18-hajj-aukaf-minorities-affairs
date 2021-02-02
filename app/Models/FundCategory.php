<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class FundCategory extends Model
{
	use SoftDeletes;

    /**
     * @var string $table the name of the table
     */
    protected $table = 'fund_categories';

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
        'type_of_fund', 'description'
    ];

    /**
     * Get the models that are related to this model.
     */
    public function applies()
    {
        return $this->hasMany('App\Models\Apply', 'fund_category_id', 'id');
    }

    /**
     * Get the models that are related to this model.
     */
    public function funds()
    {
        return $this->hasMany('App\Models\Dund', 'fund_category_id', 'id');
    }

    /**
     * Get the models that are related to this model.
     */
    public function subCategories()
    {
        return $this->hasMany('App\Models\SubCategory', 'fund_category_id', 'id');
    }
}
