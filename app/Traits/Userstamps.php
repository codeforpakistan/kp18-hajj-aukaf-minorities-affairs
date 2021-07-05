<?php

namespace App\Traits;

trait Userstamps
{
    public static function boot()
    {
        parent::boot();
        // static::creating(function($model)
        // {
        //     $user = \Auth::user();
        //     $model->created_by = $user->id;
        //     $model->updated_by = $user->id;
        // });

        static::updating(function($model)
        {
            $user = \Auth::user();
            $model->updated_by = $user->id;
        });

        static::deleting(function($model)
        {
            $user = \Auth::user();
            $model->deleted_by = $user->id;
            $model->updated_by = $user->id;
        });
    }

    /**
     * Get the related model that is assigned to this model.
     */
    public function createdBy()
    {
        return $this->belongsTo('App\Models\User', 'created_by', 'id');
    }

    /**
     * Get the related model that is assigned to this model.
     */
    public function updatedBy()
    {
        return $this->belongsTo('App\Models\User', 'updated_by', 'id');
    }

    /**
     * Get the related model that is assigned to this model.
     */
    public function deletedBy()
    {
        return $this->belongsTo('App\Models\User', 'deleted_by', 'id');
    }
}