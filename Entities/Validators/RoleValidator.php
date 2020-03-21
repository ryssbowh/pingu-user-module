<?php 

namespace Pingu\User\Entities\Validators;

use Pingu\Field\Support\FieldValidator\BaseFieldsValidator;

class RoleValidator extends BaseFieldsValidator
{
    /**
     * @inheritDoc
     */
    protected function messages(): array
    {
        return [
            'name' => 'required|string',
            'description' => 'string',
        ];
    }

    /**
     * @inheritDoc
     */
    protected function rules(bool $updating): array
    {
        return [
            'name.required' => 'Name is required',
        ];
    }
}