<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Laravel\Jetstream\Jetstream;

class UserRequest extends FormRequest
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
            case 'POST':
                $validation = [
                    'name'  => ['required', 'max:50'],
                    'email' => ['required', 'email', "unique:users"],
                    'password' => ['min:6', 'required_with:password_confirmation', 'same:password_confirmation', 'regex:/^(?=.*[a-zA-Z])(?=.*\d).+$/'],
				    'password_confirmation' => ['required'],
                    'terms' => Jetstream::hasTermsAndPrivacyPolicyFeature() ? ['required', 'accepted'] : '',
                ];
                break;
            case 'PUT':
            case 'PATCH':
                $validation = [
                    'name'  => ['required', 'max:50'],
                    'email' => ['required', 'email', "unique:users,email,{$this->user->id},id"],
                ];

                if($this->password)
                {
                    $validation += [
                        'password' => ['min:6', 'required_with:password_confirmation', 'same:password_confirmation', 'regex:/^(?=.*[a-zA-Z])(?=.*\d).+$/'],
				        'password_confirmation' => ['required'],
                    ];
                }
                break;
            default:
                break;
        }

        return $validation;
    }
}
