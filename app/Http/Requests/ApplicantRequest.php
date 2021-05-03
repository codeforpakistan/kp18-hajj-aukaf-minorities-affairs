<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class ApplicantRequest extends FormRequest
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
                    'institute_class_id' => "required",
                    'name'               => "required",
                    'father_name'        => "required",
                    'husband_name'       => "required",
                    'religion_id'        => "required",
                    'cnic'               => "required",
                    'gender'             => "required",
                    'domicile'           => "required",
                    'maritalstatus_id'   => "required",
                    'gname'              => "required",
                    'gfather_name'       => "required",
                    'gcnic'              => "required",
                    'gcontact'           => "required",
                    'disease'            => "required",
                    'dname'              => "required",
                    'clinic_address'     => "required",
                    'dcontact'           => "required",
                    'image'              => "required",
                    'operator_review'    => "required",
                    'recommended_by'     => "required",
                ];
                break;
            case 'POST':
            default:
                $rules = [
                    'institute_class_id' => "required",
                    'name'               => "required",
                    'father_name'        => "required",
                    'husband_name'       => "required",
                    'religion_id'        => "required",
                    'cnic'               => "required",
                    'gender'             => "required",
                    'domicile'           => "required",
                    'maritalstatus_id'   => "required",
                    'gname'              => "required",
                    'gfather_name'       => "required",
                    'gcnic'              => "required",
                    'gcontact'           => "required",
                    'disease'            => "required",
                    'dname'              => "required",
                    'clinic_address'     => "required",
                    'dcontact'           => "required",
                    'image'              => "required",
                    'operator_review'    => "required",
                    'recommended_by'     => "required",
                ];
                break;
        }
        return $rules;
    }
}
