<?php

namespace App\Helpers;

/**
 * DataTable helper functions
 */
class Table
{
	public static function searchQuery($model,$search)
    {
        return $model->where(function($q) use ($model,$search){
            $search = $search['value'];
            if(strlen($search) && $model->searchable){
                foreach($model->searchable as $key){
                    $q->orWhere($key,'like',"%$search%");
                }
            }
        });
    }


}