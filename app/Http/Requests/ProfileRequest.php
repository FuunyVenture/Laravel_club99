<?php

namespace App\Http\Requests;

use App\Http\Requests\Request;

class ProfileRequest extends Request
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
        switch ($this->method()) {
            case 'GET':
            case 'DELETE': {
                return [];
            }
            case 'POST': {
                return [];
            }
            case 'PUT':
            case 'PATCH': {
                return [
                    'name' => 'required|max:255',
                    'password' => 'confirmed|min:6',
                    'address' => 'required',
                    'job_title' => 'required',
                    'avatar' => 'mimes:jpg,jpeg,png|max:500'
                ];
            }
            default:
                break;
        }
        return [
            //
        ];
    }
}
