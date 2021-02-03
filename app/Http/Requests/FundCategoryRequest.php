<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class FundCategoryRequest extends FormRequest
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
                    'type_of_fund' => 'required',
                    'description'  => 'required',
                ];
                break;
            case 'POST':
            default:
                $rules = [
                    'type_of_fund' => 'required',
                    'description'  => 'required',
                ];
                break;
        }
        return $rules;
    }
}
