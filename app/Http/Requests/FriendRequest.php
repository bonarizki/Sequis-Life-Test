<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Validator;

class FriendRequest extends FormRequest
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
        switch($this->method())
        {
            case 'GET':
            case 'DELETE':
            case 'POST':
            {
                return [
                    "requestor" => "required|string|email",
                    "to" => "required|string|email"
                ];
            }
            case 'PUT':
            case 'PATCH':
            {
                return [
                    "requestor" => "required|string|email",
                    "to" => "required|string|email"
                ];
            }
            default:break;
        }
    }

}
