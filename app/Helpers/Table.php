<?php

namespace App\Helpers;

/**
 * DataTable helper functions
 */
class Table
{
	public static function searchQuery($model,$search,$searchableFields = [])
    {
        return $model->where(function($q) use ($model,$search,$searchableFields){
            if($search != null)
            {
                $search = $search['value'];
                if(strlen($search) && $model->searchable)
                {
                    foreach($model->searchable as $key){
                        $q->orWhere($key,'like',"%$search%");
                    }
                }
                if(strlen($search) && count($searchableFields)){
                    foreach($searchableFields as $field)
                    {
                        $q->orWhere($field,'like',"%$search%");
                    }
                }
            }
        });
    }


}