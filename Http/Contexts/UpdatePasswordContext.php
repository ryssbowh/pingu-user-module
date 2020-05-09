<?php

namespace Pingu\User\Http\Contexts;

use Illuminate\Support\Collection;
use Pingu\Core\Http\Contexts\UpdateContext;
use Pingu\Field\Contracts\HasFieldsContract;

class UpdatePasswordContext extends UpdateContext
{
    /**
     * @inheritDoc
     */
    public static function scope(): string
    {
        return 'password';
    }

    /**
     * @inheritDoc
     */
    public function getValidationRules(HasFieldsContract $model): array
    {
        return $model->fieldRepository()->validationRules()->only(['password', 'repeat_password'])->toArray();
    }
}