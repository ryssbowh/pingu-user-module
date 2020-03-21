<?php 

namespace Pingu\User\Entities\Validators;

use Pingu\Field\Support\FieldValidator\BaseFieldsValidator;

class UserValidator extends BaseFieldsValidator
{
    /**
     * @inheritDoc
     */
    protected function messages(): array
    {
        return [
            'name.required' => 'Name is required',
            'email.required' => 'Email is required',
            'email.unique' => 'Email is already in use',
            'email.email' => 'Please enter a valid email address',
            'roles.required' => 'Role is required',
            'password.required' => 'Password is required',
            'password.min' => 'Password is too short',
            'repeat_password.same' => 'The 2 passwords must be the same'
        ];
    }

    /**
     * @inheritDoc
     */
    protected function rules(bool $updating): array
    {
        return [
            'name' => 'required',
            'email' => 'required|email|unique:users,email,'.$this->object->id,
            'password' => $updating ? null : 'required|min:8',
            'repeat_password' => $updating ? null : 'required|same:password',
            'roles' => 'required',
            'roles.*' => 'int'
        ];
    }
}