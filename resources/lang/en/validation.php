<?php

return [

    /*
    |--------------------------------------------------------------------------
    | Validation Language Lines
    |--------------------------------------------------------------------------
    |
    | The following language lines contain the default error messages used by
    | the validator class. Some of these rules have multiple versions such
    | as the size rules. Feel free to tweak each of these messages here.
    |
    */

    'accepted'             => 'The :attribute must be accepted.',
    'active_url'           => 'The :attribute is not a valid URL.',
    'after'                => 'The :attribute must be a date after :date.',
    'alpha'                => 'The :attribute may only contain letters.',
    'alpha_dash'           => 'The :attribute may only contain letters, numbers, and dashes.',
    'alpha_num'            => 'The :attribute may only contain letters and numbers.',
    'array'                => 'The :attribute must be an array.',
    'before'               => 'The :attribute must be a date before :date.',
    'between'              => [
        'numeric' => 'The :attribute must be between :min and :max.',
        'file'    => 'The :attribute must be between :min and :max kilobytes.',
        'string'  => 'The :attribute must be between :min and :max characters.',
        'array'   => 'The :attribute must have between :min and :max items.',
    ],
    'boolean'              => 'The :attribute field must be true or false.',
    'confirmed'            => 'The :attribute confirmation does not match.',
    'date'                 => 'The :attribute is not a valid date.',
    'date_format'          => 'The :attribute does not match the format :format.',
    'different'            => 'The :attribute and :other must be different.',
    'digits'               => 'The :attribute must be :digits digits.',
    'digits_between'       => 'The :attribute must be between :min and :max digits.',
    'dimensions'           => 'The :attribute has invalid image dimensions.',
    'distinct'             => 'The :attribute field has a duplicate value.',
    // 'email'                => 'The :attribute must be a valid email address.',
    'email'                => 'Enter a vaild email.',
    'exists'               => 'The selected :attribute is invalid.',
    'file'                 => 'The :attribute must be a file.',
    'filled'               => 'The :attribute field is required.',
    'image'                => 'The :attribute must be an image.',
    'in'                   => 'The selected :attribute is invalid.',
    'in_array'             => 'The :attribute field does not exist in :other.',
    'integer'              => 'The :attribute must be an integer.',
    'ip'                   => 'The :attribute must be a valid IP address.',
    'json'                 => 'The :attribute must be a valid JSON string.',
    'max'                  => [
        'numeric' => 'The :attribute may not be greater than :max.',
        'file'    => 'The :attribute may not be greater than :max kilobytes.',
        'string'  => 'The :attribute may not be greater than :max characters.',
        'array'   => 'The :attribute may not have more than :max items.',
    ],
    'mimes'                => 'The :attribute must be a file of type: :values.',
    'mimetypes'            => 'The :attribute must be a file of type: :values.',
    'min'                  => [
        'numeric' => 'The :attribute must be at least :min.',
        'file'    => 'The :attribute must be at least :min kilobytes.',
        'string'  => 'The :attribute must be at least :min characters.',
        'array'   => 'The :attribute must have at least :min items.',
    ],
    'not_in'               => 'The selected :attribute is invalid.',
    'numeric'              => 'The :attribute must be a number.',
    'present'              => 'The :attribute field must be present.',
    'regex'                => 'The :attribute format is invalid.',
    'required'             => 'The :attribute field is required.',
    'required_if'          => 'The :attribute field is required when :other is :value.',
    'required_unless'      => 'The :attribute field is required unless :other is in :values.',
    'required_with'        => 'The :attribute field is required when :values is present.',
    'required_with_all'    => 'The :attribute field is required when :values is present.',
    'required_without'     => 'The :attribute field is required when :values is not present.',
    'required_without_all' => 'The :attribute field is required when none of :values are present.',
    'same'                 => 'The :attribute and :other must match.',
    'size'                 => [
        'numeric' => 'The :attribute must be :size.',
        'file'    => 'The :attribute must be :size kilobytes.',
        'string'  => 'The :attribute must be :size characters.',
        'array'   => 'The :attribute must contain :size items.',
    ],
    'string'               => 'The :attribute must be a string.',
    'timezone'             => 'The :attribute must be a valid zone.',
    'unique'               => 'The :attribute has already been taken.',
    'uploaded'             => 'The :attribute failed to upload.',
    'url'                  => 'The :attribute format is invalid.',
    'short_password'       => 'Password is too short (minimum is 8 characters).',
    'weak_password'       => 'Password should consist of letters and numbers',

    /*
    |--------------------------------------------------------------------------
    | Custom Validation Language Lines
    |--------------------------------------------------------------------------
    |
    | Here you may specify custom validation messages for attributes using the
    | convention "attribute.rule" to name the lines. This makes it quick to
    | specify a specific custom language line for a given attribute rule.
    |
    */

    'custom' => [
        'attribute-name' => [
            'rule-name' => 'custom-message',
        ],
        'name' => [
            'required' => 'The username field is required.',
            'max' => 'The username is too long (maximum is 255 characters).',
        ],
        'email' => [
            'required' => 'The :attribute field is required.',
            'email' => 'Enter a vaild email.',
            'unique' => 'The :attribute has already been taken.',
        ],
        'password' => [
            'required' => 'The password field is required.',
            'confirm_required' => 'Confirm Password field is required.',
            'short_password'       => 'Password is too short (minimum is 8 characters).',
            'weak_password'       => 'Password should consist of letters and numbers',
            'confirmed'       => 'The password confirmation does not match.',
            'password_changed' => 'Your password has been changed',
            'wrong_password_change_code' => 'Incorrect confirmation code',

        ],
        'delivery_address' => [
            'required' => 'The delivery address field is required.',
            'max' => 'The delivery address is too long (maximum is 255 characters).',
        ],
        'billing_address' => [
            'required' => 'The billing address field is required.',
            'max' => 'The billing address is too long (maximum is 255 characters).',
        ],
        'receptor_mobile' => [
            'required' => 'The receptor mobile field is required.',
            'min' => 'The receptor mobile is too short (minimum is 11 numbers).',
            'numeric' => 'The receptor mobile must be a number.',
        ],
        'buyer_mobile' => [
            'required' => 'The buyer mobile field is required.',
            'min' => 'The buyer mobile is too short (minimum is 11 numbers).',
            'numeric' => 'The buyer mobile must be a number.',
        ],
        'receptor_name' => [
            'required' => 'The receptor name field is required.',
            'max' => 'The receptor name is too long (maximum is 255 characters).',
        ],
        'review' => [
            'required' => 'Fill your review.',
            'max' => 'Review is too long (maximum is 255 characters).',
            'product' => 'Select a product to review.',
        ],
        'invalid_promo' => 'invalid promo code',
        'valid_promo' => 'valid promo code',
        'invalid_competition' => 'invalid/wrong code',
        'invalid_purchase' => 'invalid purchase',
        'invalid_user' => 'unauthorized user',
        'user_invalid_promo' => 'invalid promo code for this user',
        'something_wrong' => 'something went wrong',
        'payment_success' => 'payment success',
        'payment_failed' => 'payment failed',
        'exists' => 'Already Exists',
        'wishlist_added' => 'Added to Wishlist',
        'used_code' => 'you already used this code',
        'participating_thanks' => 'Thanks for participating in event',

    ],

    /*
    |--------------------------------------------------------------------------
    | Custom Validation Attributes
    |--------------------------------------------------------------------------
    |
    | The following language lines are used to swap attribute place-holders
    | with something more reader friendly such as E-Mail Address instead
    | of "email". This simply helps us make messages a little cleaner.
    |
    */

    'attributes' => [],

];
