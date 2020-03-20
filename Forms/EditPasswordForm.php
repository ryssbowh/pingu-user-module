<?php
namespace Pingu\User\Forms;

use Pingu\Forms\Support\Fields\Password;
use Pingu\Forms\Support\Fields\Submit;
use Pingu\Forms\Support\Form;
use Pingu\User\Entities\User;

class EditPasswordForm extends Form
{
    protected $action;

    /**
     * Bring variables in your form through the constructor :
     */
    public function __construct(array $action, User $user)
    {
        $this->action = $action;
        $this->user = $user;
        parent::__construct();
    }

    /**
     * Fields definitions for this form, classes used here
     * must extend Pingu\Forms\Support\Field
     * 
     * @return array
     */
    public function elements(): array
    {
        $fields = $this->user->fields()->toFormElements($this->user, ['password', 'repeat_password']);
        $fields[] = new Submit;
        return $fields;
    }

    /**
     * Method for this form, POST GET DELETE PATCH and PUT are valid
     * 
     * @return string
     */
    public function method(): string
    {
        return 'PUT';
    }

    /**
     * Url for this form, valid values are
     * ['url' => '/foo.bar']
     * ['route' => 'login']
     * ['action' => 'MyController@action']
     * 
     * @return array
     * @see    https://github.com/LaravelCollective/docs/blob/5.6/html.md
     */
    public function action(): array
    {
        return $this->action;
    }

    /**
     * Name for this form, ideally it would be application unique, 
     * best to prefix it with the name of the module it's for.
     * only alphanumeric and hyphens
     * 
     * @return string
     */
    public function name(): string
    {
        return 'user-edit-password';
    }
}