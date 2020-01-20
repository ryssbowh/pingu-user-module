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
    protected function rules(): array
    {
        return [
            'name' => 'required',
            'email' => 'required|email|unique:users,email,'.$this->object->id,
            'password' => 'required|min:8',
            'repeat_password' => 'required|same:password',
            'roles' => 'required',
            'roles.*' => 'int'
        ];
    }

    // protected function removeRequiredRule(string $rule): string
    // {
    //     $rule = explode('|', $rule);
    //     $index = array_search('required', $rule);
    //     if (is_int($index)) {
    //         unset($rule[$index]);
    //     }
    //     return implode('|', $rule);
    // }

    // public function getRules($updating = true): array
    // {
    //     $rules = parent::getRules();
    //     if ($updating) {
    //         if (isset($rules['password'])) {
    //             $rules['password'] = $this->removeRequiredRule($rules['password']);
    //         }
    //         if (isset($rules['repeat_password'])) {
    //             $rules['repeat_password'] = $this->removeRequiredRule($rules['repeat_password']);
    //         }
    //     }
    //     return $rules;
    // }
}