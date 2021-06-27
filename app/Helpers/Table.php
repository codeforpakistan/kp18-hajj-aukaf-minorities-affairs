<?php

namespace App\Helpers;

/**
 * DataTable helper functions
 */
class Table
{
	public static function searchQuery($model,$search,$searchableJoins = [])
    {
        return $model->where(function($q) use ($model,$search,$searchableJoins){
            $search = $search['value'];
            if(strlen($search) && $model->searchable)
            {
                foreach($model->searchable as $key){
                    $q->orWhere($key,'like',"%$search%");
                }
            }
            if(strlen($search) && count($searchableJoins)){
                foreach($searchableJoins as $field)
                {
                    $q->orWhere($field,'like',"%$search%");
                }
            }
        });
    }


}