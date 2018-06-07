<?php

namespace App\Http\Requests;

use App\Http\Requests\Request;

class RolesRequest extends Request {

    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize() {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules() {
        switch ($this->method()) {
            case 'GET':
            case 'DELETE': {
                    return [];
                }
            case 'POST': {
                    return [
                        'name' => 'required|max:255|unique:roles',
                    ];
                }
            case 'PUT':
            case 'PATCH': {
                    return [
                        'name' => 'required|max:255|unique:roles,name,' . $this->input('role_id'),
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
