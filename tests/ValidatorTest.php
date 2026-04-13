<?php

namespace LaraOrVite\Validation\Tests;

use Illuminate\Contracts\Support\Arrayable;
use Illuminate\Translation\ArrayLoader;
use Illuminate\Translation\Translator;
use LaraOrVite\Validation\EloquentWildcardValidator;
use PHPUnit\Framework\Attributes\Test;

class ValidatorTest extends TestCase
{
    #[Test]
    public function it_fixes_indirect_modification_error_with_nested_objects()
    {
        $translator = new Translator(
            new ArrayLoader(),
            'en'
        );

        $person = new class() implements Arrayable {
            public $attributes = ['email' => 'test@example.com'];

            public function toArray()
            {
                return $this->attributes;
            }

            public function __get($k)
            {
                return $this->attributes[$k] ?? null;
            }

            public function __set($k, $v)
            {
                $this->attributes[$k] = $v;
            }
        };

        $data = ['users' => [['profile' => $person]]];
        $rules = ['users.*.profile.email' => 'required|email'];

        $validator = new EloquentWildcardValidator($translator, $data, $rules);

        $this->assertFalse($validator->fails(), 'Validation failed unexpectedly');
        $this->assertEquals('test@example.com', $person->email, 'The email should not be null');
    }
}
