<?php

namespace Pingu\User\Http\Contexts;

use Illuminate\Support\Collection;
use Pingu\Core\Http\Contexts\EditContext;

class EditPasswordContext extends EditContext
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
    public function getFields(): Collection
    {
        return $this->object->fieldRepository()->only(['password', 'repeat_password']);
    }
}