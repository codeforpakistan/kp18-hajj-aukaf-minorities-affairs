<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Role extends Model
{
	use SoftDeletes;

    /**
     * @var string $table the name of the table
     */
    protected $table = 'roles';

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
        'name'
    ];

    /**
     * Get the models that are related to this model.
     */
    public function users()
    {
        return $this->hasMany('App\Models\User', 'role_id', 'id');
    }
}
