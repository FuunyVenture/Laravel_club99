<?php

namespace App\Http\Requests;

use App\Http\Requests\Request;

class PageRequest extends Request
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
                return [
                    'title' => 'required|max:255',
                    'content' => 'required',
                    'slug' => 'required|unique:pages',
                ];
            }
            case 'PUT':
            case 'PATCH': {
                return [
                    'title' => 'required|max:255',
                    'content' => 'required',
                    'slug' => 'required|unique:pages,slug,' . $this->input('page_id')
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
