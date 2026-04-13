<?php

namespace LaraOrVite\Validation;

use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\Validator;

class ValidationFixServiceProvider extends ServiceProvider
{
    /**
     * Boot the service provider.
     */
    public function boot()
    {
        Validator::resolver(function ($translator, $data, $rules, $messages, $attributes) {
            return new EloquentWildcardValidator($translator, $data, $rules, $messages, $attributes);
        });
    }
}