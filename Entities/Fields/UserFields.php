<?php

namespace Pingu\User\Entities\Fields;

use Illuminate\Support\Collection;
use Pingu\Field\BaseFields\Email;
use Pingu\Field\BaseFields\ManyModel;
use Pingu\Field\BaseFields\Password;
use Pingu\Field\BaseFields\Text;
use Pingu\Field\Support\FieldRepository\BundledEntityFieldRepository;
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
        if ($user and $user->hasRole('God')) {
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
}