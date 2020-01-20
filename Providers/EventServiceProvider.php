<?php

namespace Pingu\User\Providers;

use Illuminate\Foundation\Support\Providers\EventServiceProvider as ServiceProvider;
use Pingu\Field\Events\FieldsValidationRulesRetrieved;
use Pingu\Forms\Events\FormBuilt;
use Pingu\User\Listeners\RemovePasswordField;
use Pingu\User\Listeners\RemovePasswordRules;

class EventServiceProvider extends ServiceProvider
{
    protected $listen = [
        FormBuilt::class => [RemovePasswordField::class],
        FieldsValidationRulesRetrieved::class => [RemovePasswordRules::class]
    ];
}