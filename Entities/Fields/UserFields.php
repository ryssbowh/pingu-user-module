<?php

namespace Pingu\User\Entities\Fields;

use Illuminate\Support\Collection;
use Pingu\Entity\Support\FieldRepository\BundledEntityFieldRepository;
use Pingu\Field\BaseFields\Email;
use Pingu\Field\BaseFields\ManyModel;
use Pingu\Field\BaseFields\Password;
use Pingu\Field\BaseFields\Text;
use Pingu\User\Entities\Role;

class UserFields extends BundledEntityFieldRepository
{
    /**
     * @inheritDoc
     */
    protected function fields(): array
    {
        $user = \Auth::user();
        /**
         * Only God users can add God users.
         * And no one can add 'Guest' users which are only for unauthenticated users
         */
        if ($user and $user->hasRole(1)) {
            $items = Role::where('id', '!=', 2)->get();
        } else {
            $items = Role::whereNotIn('id', [1, 2])->get();
        }
        return [
            new Text('name', [
                'required' => true
            ]),
            new Email('email', [
                'required' => true
            ]),
            new Password('password', [
                'required' => true
            ]),
            new Password(
                'repeat_password',
                ['required' => true],
                'Repeat password'
            ),
            new ManyModel(
                'roles',
                [
                    'model' => Role::class,
                    'textField' => ['name'],
                    'required' => true,
                    'items' => $items
                ]
            )
        ];
    }

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
            'email' => 'required|unique:users,email,'.$this->object->id,
            'password' => 'required|min:8',
            'repeat_password' => 'required|same:password',
            'roles' => 'required'
        ];
    }
}