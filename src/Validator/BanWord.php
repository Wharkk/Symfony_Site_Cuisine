<?php

namespace App\Validator;

use Symfony\Component\Validator\Constraint;

#[\Attribute(\Attribute::TARGET_PROPERTY | \Attribute::TARGET_METHOD | \Attribute::IS_REPEATABLE)]
class BanWord extends Constraint
{
    /**
     * @param string $message
     * @param array $banWords
     * @param array|null $groups
     * @param mixed|null $payload
     */
    public function __construct(
        public string $message = 'This contains a banned word "{{ banWord }}".',
        public array $banWords = ['spam', 'viagra'],
        public ?array $groups = null,
        public mixed $payload = null,
    )
    {
        parent::__construct(null, $groups, $payload);
    }
}
