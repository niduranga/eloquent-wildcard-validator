<?php

namespace LaraOrVite\Validation;

use Illuminate\Contracts\Support\Arrayable;
use Illuminate\Validation\Validator;

class EloquentWildcardValidator extends Validator
{
    /**
     * Create a new Validator instance.
     */
    public function __construct($translator, $data, $rules, $messages = [], $attributes = [])
    {
        $data = static::initializeAndArrayify($data);

        parent::__construct($translator, $data, $rules, $messages, $attributes);
    }

    /**
     * Recursively convert data to a plain array.
     */
    public static function initializeAndArrayify($data)
    {
        if ($data instanceof Arrayable) {
            return $data->toArray();
        }

        if (!is_array($data)) {
            return $data;
        }

        foreach ($data as $key => $value) {
            $data[$key] = static::initializeAndArrayify($value);
        }

        return $data;
    }
}