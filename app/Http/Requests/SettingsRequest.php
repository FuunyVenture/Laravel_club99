<?php

namespace App\Http\Requests;

use App\Http\Requests\Request;

class SettingsRequest extends Request {

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
                        'key_cd' => 'required|max:255|unique:settings',
                        'type' => 'required',
                        'display_value' => 'required',
                        'value' => 'required',
                    ];
                }
            case 'PUT':
            case 'PATCH': {
                    return [
                        'key_cd' => 'required|max:255|unique:settings,key_cd,' . $this->input('setting_id'),
                        'type' => 'required',
                        'display_value' => 'required',
                        'value' => 'required',
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
