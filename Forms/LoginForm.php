<?php

namespace Pingu\User\Forms;

use Pingu\Forms\Support\Fields\Email;
use Pingu\Forms\Support\Fields\Password;
use Pingu\Forms\Support\Fields\Submit;
use Pingu\Forms\Support\Form;
use Pingu\Forms\Support\Types\Text;

class LoginForm extends Form
{
    /**
     * Fields definitions for this form, classes used here
     * must extend Pingu\Forms\Support\Field
     * 
     * @return array
     */
    protected function elements(): array
    {
        return [
            new Email(
                'email',
                [
                    'type' => Text::class,
                    'label' => 'Email Address',
                    'required' => true
                ]
            ),
            new Password(
                'password',
                [
                    'type' => Text::class,
                    'label' => 'Password',
                    'required' => true
                ]
            ),
            new Submit(
                '_submit'
            )
        ];
    }

    /**
     * Method for this form, POST GET DELETE PATCH and PUT are valid
     * 
     * @return string
     */
    protected function method(): string
    {
        return 'POST';
    }

    /**
     * Url for this form, valid values are
     * ['url' => '/foo.bar']
     * ['route' => 'my.route']
     * ['action' => 'MyController@action']
     * 
     * @return array
     * @see    https://github.com/LaravelCollective/docs/blob/5.6/html.md
     */
    protected function action(): array
    {
        return ['route' => 'user.login'];
    }

    /**
     * Name for this form, ideally it would be application unique, best to prefix
     * it with the name of the module it's for. Only letters, numbers and hyphens
     * 
     * @return string
     */
    protected function name(): string
    {
        return 'user-login';
    }
}