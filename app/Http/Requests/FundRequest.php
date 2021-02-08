<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class FundRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        switch ($this->getMethod()) {
            case 'PUT':
                $rules = [
                    'fund_category_id'   => 'required',
                    'sub_category_id'    => 'required',
                    'fund_name'          => 'required',
                    'total_amount'       => 'required',
                    'last_date'          => 'required',
                    'fund_for_year'      => 'required',
                    'institute_students' => 'required',
                    'active'             => 'required',
                ];
                break;
            case 'POST':
            default:
                $rules = [
                    'fund_category_id'   => 'required',
                    'sub_category_id'    => 'required',
                    'fund_name'          => 'required',
                    'total_amount'       => 'required',
                    'last_date'          => 'required',
                    'fund_for_year'      => 'required',
                    'institute_students' => 'required',
                    'active'             => 'required',
                ];
                break;
        }
        return $rules;
    }
}
