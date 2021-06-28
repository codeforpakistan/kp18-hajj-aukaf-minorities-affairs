<?php

namespace App\Helpers;

/**
 * DataTable helper functions
 */
class Table
{
	public static function searchQuery($model,$search,$searchableFields = [])
    {
        if(!$search || !count($searchableFields)) return $model;

        return $model->where(function($q) use ($model,$search,$searchableFields){
            $search = $search['value'];
            if(strlen($search)){
                foreach($searchableFields as $field)
                {
                    $q->orWhere($field,'like',"%$search%");
                }
            }
        });
    }


}