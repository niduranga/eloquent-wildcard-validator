<?php

namespace LaraOrVite\Validation;

use Illuminate\Support\Facades\Validator;
use Illuminate\Support\ServiceProvider;

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