<?php

namespace Pingu\User\Entities\Uris;

use Pingu\Core\Support\Uris\BaseModelUris;

class UserUris extends BaseModelUris
{
    public function uris(): array
    {
        return [
            'editPassword' => '@slug@/{@slug@}/password',
            'savePassword' => '@slug@/{@slug@}/password'
        ];
    }
}