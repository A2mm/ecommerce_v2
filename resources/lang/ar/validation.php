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
    'email'                => 'The :attribute must be a valid email address.',
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
                'required' => 'يرجي ادخال اﻹسم',
                'unique'  => 'هذا اﻹسم قيد الاستخدام بالفعل',
                'string'  => 'يجب ان يتكون الاسم من حروف',
                'min' => 'يجب ان يتكون الاسم من ثلاثة احرف علي الاقل',
                'max' => 'يجب الا يزيد الاسم عن 50 حرف ',
                'regex' => 'يجب ان يتكون الاسم من حروف فقط',
            ],
            'email' => [
                'required' => 'يرجي ادخال البريد الالكتروني',
                'unique'   => 'هذا البريد الالكتروني قيد الاستخدام',
                'email'    => 'يرجي ادخال بريد الكتروني صالح',
            ],
            'permissions' => [
                'required' => 'يرجي ادخال صلاحية علي الاقل',
              ],
            'password' => [
                'required' => 'يرجي ادخال كلمة السر',
                'min'  =>  'كلمة السر يجب ان تكون اكبر من 8 وحدات',
                'max' => 'يجب الا تتعدي كلمه  المرور 30 وحده',
                'regex' => 'يجب ان تتكون كلمة المرور من حروف وارقام',
                'confirm_required' => 'حقل تأكيد كلمة المرور مطلوب' ,
                'new_confirmation' => ' يجب ان تتكون كلمة التاكيد من 8 أحرف علي اﻷقل' ,
                'confirmed' => 'لا يتطابق تأكيد كلمة المرور'
            ],
            'category_id' => [
                'integer' => 'يرجي ادخال رقم فئة صحيح',
                'required' => 'يرجي ادخال اسم الفئة',
                'exists' => 'عفوا هذه الفئة غير موجودة',
            ],
            'subcategory_id' => [
                'required' => 'يرجي ادخال اسم الفئة الفرعية',
            ],
            'purchase_id' => [
              'integer' => 'يجب أن يكون رقم الشراء عدد'
            ],
            'refunds' => [
                'required' => 'يرجي ادخال المنتج بالكود والكمية',
            ],
            'to_store' => [
                'required' => 'يرجي ادخال  الفرع المراد التحويل اليه ',
            ],
            'store_id' => [
                'required' => 'يرجي ادخال اسم المتجر',
            ],
            /*'store_quantities' => [
                'required' => 'يرجي ادخال كمية المنتج',
            ],*/
            'store_quantities.*' => [
                'required' => 'يرجي ادخال كمية المنتج',
                // 'max' => 
            ],
            'unique_id' => [
                'required' => 'يرجي ادخال كود المنتج',
                'unique' => 'هذا الكود مستخدم بالفعل',
                'digits_between' => 'يجب ان يتكون كود المنتج من ارقام',
            ],
            
            /*'otherprices.*' => [
                'required' => 'يرجي ادخال السعر',
                'numeric' => 'يجب ادخال السعر علي هيئة رقم ',
                'min' => 'يجب ان يكون السعر  واحد علي الاقل',
            ],*/
           'otherprices.0' => [
                'required' => 'يرجي ادخال  سعر  الفئة  القطاعي ',
                'numeric' => 'يجب ادخال السعر القطاعي  علي هيئة رقم ',
               'min' => 'يجب ان يكون  سعر  الفئة القطاعي  صفر علي الاقل',
            ],


            'otherprices.1' => [
                            'required' => 'يرجي ادخال  سعر  الفئة الاولي ',
                            'numeric' => 'يجب ادخال السعرفي الفئة الاولي علي هيئة رقم ',
                            'min' => 'يجب ان يكون سعر الفئة الاولي  واحد علي الاقل',
                        ],

            'otherprices.2' => [
                            'required' => 'يرجي ادخال  سعر  الفئة الثانية',
                            'numeric' => 'يجب ادخال السعر في الفئة الثانية علي هيئة رقم ',
                            'min' => 'يجب ان يكون سعر الفئة الثانية واحد علي الاقل',
                        ],

            'otherprices.3' => [
                            'required' => 'يرجي ادخال  سعر  الفئة الثالثة',
                            'numeric' => 'يجب ادخال السعر في الفئة الثالثة  علي هيئة رقم ',
                            'min' => 'يجب ان يكون سعر الفئة الثالثة واحد علي الاقل',
                        ],

            'otherprices.4' => [
                            'required' => 'يرجي ادخال  سعر  الفئة الرابعة',
                            'numeric' => 'يجب ادخال السعر في الفئة الرابعة علي هيئة رقم ',
                            'min' => 'يجب ان يكون سعر الفئة الرابعة واحد علي الاقل',
                        ],
            'shiporder_id' => [
                'required' => 'يرجي ادخال رقم الطلبية',
                'unique'   => 'هذا الرقم قيد اﻹستخدام بالفعل',
                 'integer'   => ' يجب أن يكون رقم الطلبية عدد صحيح ',
                 'digits_between' => 'يجب  الا يتعدي رقم الطلبية  تسعة ارقام ',
            ],
            'refund_id' => [
                'required' => 'يرجي ادخال رقم  المرتجع',
                'unique'   => 'هذا الرقم قيد اﻹستخدام بالفعل',
                 'integer'   => ' يجب أن يكون رقم المرتجع عدد صحيح ',
            ],
            'settle_id' => [
                'required' => 'يرجي ادخال رقم  التسوية',
                'unique'   => 'هذا الرقم قيد اﻹستخدام بالفعل',
                 'integer'   => ' يجب أن يكون رقم التسوية عدد صحيح ',
            ],
            'reason' => [
                'required' => 'يرجي ادخال  السبب',
                'max'   => 'يجب الا يزيد  السبب  عن  250 حرف',
                'min' => 'يجب الا يقل السبب عن 3 احرف',
            ],
            'transfer_id' => [
                'required' => 'يرجي ادخال رقم  التحويلة',
                'unique'   => 'هذا الرقم قيد اﻹستخدام بالفعل',
                'integer'   => ' يجب أن يكون رقم التحويلة عدد صحيح ',
            ],
            'bannering_type_id' => [
                'required' => 'يرجي ادخال  النوع',
                'unique'   => 'يرجي ادخال نوع صالح',
            ],
            'title' => [
                'required' => 'يرجي ادخال الاسم',
                'min'   => 'يجب ان يتكون الاسم من 3 احرف علي الافل ',
                'max' => 'يجب الا يزيد الاسم عن 30 حرفا',
                'unique'   => 'خذا الاسم قيد الاستخدام',
            ],
            'full_image' => [
                'required' => 'يرجي ادخال صورة اللافتة',
            ],
            'images.*' => [
                'mimes' => 'يجب ان تكون الصور علي احدي هذه الصيغ  jpeg,png,jpg,gif,svg',
                'image' => 'يرجي ادخال صورة صالحة',
               // 'file' => 'يرجي ادخال  ملف صورة صالحة',
              ],
               'images2.*' => [
                'mimes' => 'يجب ان تكون الصور علي احدي هذه الصيغ  jpeg,png,jpg,gif,svg',
                'image' => 'يرجي ادخال صورة صالحة',
              ],
              'image' => [
                'required' => 'يرجي ادخال صورة ',
                'mimes' => 'يجب ان تكون الصور علي احدي هذه الصيغ  jpeg,png,jpg,gif,svg',
                'image' => 'يرجي ادخال صورة صالحة',
              ],
              'precentge' =>[
                   'required' => 'حقل النسبة المئوية مطلوب',
                   'min' => 'يجب الا تقل نسبة الخصم عن 1',
                   'max' => 'يجب الا تزيد نسبة الخصم عن 99',
                   'numeric' => 'يجب ان تكون نسبة التخفيض   علي صورة رقم', 
                   'integer' => 'يجب ادخال نسبة الخصم علي صورة رقم صحيح ',
              ],
               'percentage' => [
                'required' => 'يرجي ادخال نسبة الخصم ',
                'integer' => 'يجب ادخال نسبة الخصم علي صورة رقم صحيح ',
                'min' => 'يجب الا تقل نسبة الخصم عن 1',
                'max' => 'يجب الا تزيد نسبة الخصم عن 99',
              ],
               'tag' => [
                'required' => 'يرجي ادخال التاج ',
                'unique' => 'هذا التاج قيد الاستخدام بالفعل  ',
                'min' => 'يجب ان يتكون التاج من حرف علي الاقل ',
                'max' => 'يجب الا يتخطي التاج 30 حرف ',
              ],
              'tags.*' => [
                'required' => 'يرجي ادخال التاج ',
                'unique' => 'هذا التاج قيد الاستخدام بالفعل  ',
                'min' => 'يجب ان يتكون التاج من حرف علي الاقل ',
                'max' => 'يجب الا يتخطي التاج 30 حرف ',
              ],
               'category_name' => [
                'required' => 'يرجي ادخال اسم الفئة',
                'min' => 'يجب الا يقل اسم الفئة عن 3 احرف',
                'max' => 'يجب الا يزيد اسم الفئة عن 50 حرف',
                'unique' =>  'هذا اﻹسم قيد الاستخدام بالفعل',
                'regex' => 'يجب ان يتكون اسم الفئة من حروف فقط',
            ],
            'banner_link' => [
                'required' => 'يرجي ادخال  رابط اللافتة',
                'url' => 'يرجي ادخال  الرابط بشكل  صحيح',
            ],
             'product_id' => [
                'required' => 'يرجي ادخال  المنتج',
                'integer' => 'يجب ان يكون  رقم المنتج عدد صحيح',
                'exists' => 'هذا المنتج غير موجود',
            ],
            'per_page' => [
                'required' => 'يرجي ادخال عدد المنتجات المطلوب عرضها لكل صفحة',
                'integer'  => 'يرجي ادخال عدد صحيح',
            ],
            'weight' => [
                'required' => 'يرجي ادخال الوزن',
                'numeric' => 'يجب ان يكون الوزن علي هيئة رقم',
                'min' => 'يجب  ان يكون الوزن 0.1 جرام علي الاقل',
            ],
            'category_online_id' => [
                'required' => 'يرجي ادخال اسم الفئة  الاونلاين',
                'exists' => 'عفوا هذه الفئة غالاونلاين ير موجودة',
            ],
            'receptor_mobile' => [
                'required' => 'يرجي ادخال رقم تليفون المستقبل ',
                'regex' => 'يرجي ادخال رقم  تليفون المستقبل بشكل صحيح',
                'min' => 'يجب ان يتكون رقم تليفون  المستقبل من 11 رقم',
                'unique' => 'هذا الرقم قيد اﻹستخدام',
                'size' => 'يجب ان يكون رقم هاتف  المستقبل  مكون من 11 رقم',
            ],
            'buyer_mobile' => [
                'required' => 'يرجي ادخال رقم تليفون المشتري ',
                'regex' => 'يرجي ادخال رقم  تليفون المشتري بشكل صحيح',
                'min' => 'يجب ان يتكون رقم تليفون المشتري من 11 رقم',
                'unique' => 'هذا الرقم قيد اﻹستخدام',
                'size' => 'يجب ان يكون رقم هاتف المشتري  مكون من 11 رقم',
            ],
            'receptor_name' => [
                'required' => 'يرجي ادخال  اسم المستقبل',
                'min' => 'يجب الا يقل اسم المستقبل عن 2 حرف',
                'max' => 'يجب الا يزيد اسم المستقبل عن 30 حرف',
            ],
            'othertypes.*' => [
                'required' => 'يرجي اختيار نوع العميل',
                'exists'   => 'يرجي ادخال نوع العميل',
            ],
            'discount' => [
                //'required' => 'يرجي ادخال نسبة التخفيض',
                'required' => 'يرجي ادخال  الخصم',
                'min'      => 'يجب  ان تكون نسبة  الخصم علي الاقل 1',
                'max'      => 'يجب الا تزيد نسبة التخفيض عن سعر المنتج',
                'numeric' => 'يجب ان تكون نسبة التخفيض رقم',
                'digits_between' => 'يجب ان  تتكون نسبة الخصم من رقمين فقط',
            ],
            'from' => [
                'required' => 'يرجي ادخال الفترة',
                'before_or_equal'      => 'يجب ان يكون تاريخ بداية الفترة سابق او يساوي تاريخ نهاية الفترة',
                'date' => 'يجب ان تكون الفترة تاريخ',
              ],
              'to' => [
                'required' => 'يرجي ادخال الفترة',
                'after_or_equal'      => 'يجب ان يكون تاريخ نهاية الفترة لاحق او يساوي تاريخ بداية الفترة',
                'date' => 'يجب ان تكون الفترة تاريخ',
              ],
              'search_day' => [
                'required' => 'يجب إدخال  اليوم المطلوب البحث به',
              ],
              'to_day' => [
                'required' => 'يجب إدخال  توقيت بداية البحث',
                'after_or_equal' => 'يجب أن يكون توقيت نهاية البحث أكبر من أو مساوي لتوقيت  بداية البحث',
              ],
              'from_day' => [
                'required' => 'يجب إدخال توقيت نهاية البحث',
                'before_or_equal' => 'يجب أن يكون توقيت بداية البحث أقل من أو مساوي لتوقيت نهاية البحث',
              ],
              'to_hour' => [
                'required' => 'يجب إدخال  توقيت بداية البحث',
                'after_or_equal' => 'يجب أن يكون توقيت نهاية البحث أكبر من أو مساوي لتوقيت  بداية البحث',
              ],
              'from_hour' => [
                'required' => 'يجب إدخال توقيت نهاية البحث',
                'before_or_equal' => 'يجب أن يكون توقيت بداية البحث أقل من أو مساوي لتوقيت نهاية البحث',
              ],
            'seller_discount' => [
                'required' => 'يرجي ادخال نسبة التخفيض',
                'min' => 'يجب الا تقل نسبة التخفيض عن صفر',
                'digits_between' => 'يجب ان تتراوح نسبة التخفيض بين رقم او اثنين',
            ],
            'address' => [
                'required' => 'يرجي ادخال عنوان المتجر',
                'min' => 'يجب الا يقل العنوان عن  10 احرف',
                'max' => 'يجب الا يتعدي  العنوان  255 حرف', 
            ],
            'phone' => [
                'required' => 'يرجي ادخال رقم التليفون',
                'regex' => 'يرجي ادخال رقم التليفون بشكل صحيح',
                'min' => 'يجب ان يتكون رقم التليفون من 11 رقم',
                'unique' => 'هذا الرقم قيد اﻹستخدام',
                'size' => 'يجب ان يكون رقم الهاتف مكون من 11 رقم',
                // 'numeric' => 'يجب أن يتكون رقم  التليفو  من ارقام فقط',
                'digits_between' => 'يجب ان يتكون رقم  التليفون  من ارقام فقط',
            ],
            'usertype_id' => [
                'required' => 'يرجي اختيار نوع العميل',
            ],
            'addCheck' => [
                'required' => 'يرجي اختيار الاجراء المتخذ سواء اضافة او خصم كمية',
                'integer'  => 'يجب  اختيار اجراء واحد فقط  سواء اضافة او خصم',
            ],
            'refund_quantity' => [
                'required' => 'يرجي ادخال الكمية المطلوب ارجاعها',
                'min'      => 'يجب ان تكون الكمية اكبر من صفر',
                'integer'  => 'يجب ان تكون الكمية عدد صحيح',
            ],
            'quantity' => [
                'required' => 'يرجي إدخال كمية المنتج',
                'integer' => 'يجب ان تكون الكمية عدد صحيح',
                'min' => 'يجب  ان تكون الكمية علي  الاقل 1',
            ],
            'bill_id' => [
                'required' => 'يرجي ادخال رقم الفاتورة',
                'numeric'      => 'يجب ان يتكون رقم الفاتورة من ارقام صحيحة',
            ],
            'area' => [
                'required' => 'يرجي ادخال المنطقة',
                'unique' => 'هذه المنطقة قيد الاستخدام',
                'min' => 'يجب أن تتكون المنطقة من 3 أحرف على الأقل',
                'max' => 'يجب ألا تزيد المنطقة عن 30 حرفًا'
            ],
            'price' => [
                'required' => 'يرجي ادخال السعر',
                'min' => 'يجب ان يكون السعر اكبر من 0',
                'max' => 'يجب ألا يزيد السعر عن 200'
            ],
            'code' => [
                'required' => 'يرجي ادخال الكود',
                'min' => 'يجب ان يتكون الكود من رقمين علي اﻷقل',
                'max' => 'يجب ألا يزيد الكود عن 10 أرقام',
                'unique' => 'تم بالفعل أخذ الرمز',
            ],
             'api_token' => [
                'required' => 'يرجي ادخال رمز التحقق',
                'exists' => 'رمز التحقق غير صحيح',
              ],
               'purchase_id' => [
              'integer' => 'يجب أن يكون رقم الشراء عدد', 
              'required' => 'يرجي ادخال رقم الشراء',
            ],
            'product_ids' => [
                'required' => 'يرجي ادخال ارقام المنتجات المطلوي توصيلها',
            ],
            'description' => [
                'required' => 'يرجي إدخال  الوصف ',
                'min' => 'يجب ان يتكون  الوصف  من 30 حرفا علي الاقل',
                'max' => 'يجب ألا يتخطي  الوصف  1200 حرفا',
                'regex' => 'يجب إدخال وصف المنتج بالشكل الصحيح(حروف وأرقام فقط)',
            ],
             'product_benefits' => [
                // 'required' => 'يرجي إدخال وصف المنتج',
                'min' => 'يجب ان يتكون  حقل فوائد المنتج من 30 حرف علي الاقل ',
                'max' => 'يجب ألا يتخطي فوائد المنتج   1200 حرفا',
               // 'regex' => 'يجب إدخال وصف المنتج بالشكل الصحيح(حروف وأرقام فقط)',
            ],
            'slug' => [
                'unique' => 'هذه الكلمة الدلالية قيد الاستخدام بالفعل',
                'required' => 'يرجي ادخال الكلمة الدلالية',
                'max' => 'يجب ألا يتخطي  الكلمة الدلالية 75 حرفا',
                'integer' =>  'هذه الكلمة الدلالية قيد الاستخدام بالفعل',
                'exists' => 'يرجي ادخال كلمة دلالية صالحة',
            ],
             'seo_description' => [
                'required' => 'يرجي إدخال وصف   محركات البحث  ',
                'min' => 'يجب ان يتكون وصف   محركات البحث  من  50 حرفا علي  الاقل',
                'max' => 'يجب ألا يتخطي  وصف  محركات البحث  160 حرفا',
                // 'regex' => 'يجب إدخال وصف المنتج بالشكل الصحيح(حروف وأرقام فقط)',
            ],
            'id' => [
                'integer' => 'يرجي ادخال  عدد صحيح ',
                'exists' => 'يرجي ادخال منتج صالح ',
            ],
            'expire_date' => [
                 'required' => 'حقل تاريخ انتهاء الصلاحية مطلوب'
            ],
            'expire_time' => [
                 'required' => 'حقل وقت انتهاء الصلاحية مطلوب'
            ],
            'type' => [
                 'required' => 'حقل النوع مطلوب',
            ],
            'restrict_price' =>[
                  'required' => 'حقل سعر مقيد مطلوب' ,
              ],
            'flat_rate' =>[
                  'required' => 'حقل سعر الخصم مطلوب' ,
              ],
            'delivery_address' =>[
                  'required' => 'حقل عنوان التسليم مطلوب' ,
              ],
            'billing_address' =>[
                  'required' => 'حقل عنوان الفاتورة مطلوب' ,
                  'min' => 'يجب أن يكون عنوان الفواتير 6 أحرف على الأقل',
                  'max' => 'عنوان الفاتورة طويل جدًا الحد الأقصى 250 حرفًا',
              ],

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

    'attributes' => [
      'name' => '',
      'arabic_name' => '',
      'email' => '',
      'password' => '',
      'chat_prv' => '',
      'notification_prv' => '',
      'email_prv' => '',
      'aff_prv' => '',
      'cus_prv' => '',
      'ven_prv' => '',
      'product_id' => '',
      'slug' => '',
      'role' => '',
      'start_date' => '',
      'end_date' => '',
      'attributeTypeId' => '',
      'type' => '',
      'description' => '',
      'arabic_description' => '',
      'category_id' => '',
      'subcategory_id' => '',
      'vendor_id' => '',
      'store_id' => '',
      'price' => '',
      'date' => '',
      'expire_time' => '',
      'save_1' => '',
      'auction_id' => '',
      'weight' => '',
      'dimensions' => '',
      'supplier_id' => '',
      'view_cost' => '',
      'order_cost' => '',
      'minimum_order' => '',
      'supplier_ability' => '',
      'country' => '',
      'quantity' => '',
      'reason' => '',
      'discount' => '',
      'banner_type_id' => '',
      'title' => '',
      'banner_link' => '',
      'full_image' => '',
      'image' => '',
      'barcode' => '',
      'store' => '',
      'row' => '',
      'icon' => '',
      'expire_date' => '',
      'configurations' => '',
      'code' => '',
      'precentge' => '',
      'flat_rate' => '',
      'restrict_price' => '',
      'block_message' => '',
      'perv' => '',
      'enable_local' => '',
      'country_code' => '',
      'local_price' => '',
      'main_image' => '',
      'small_image' => '',
      'image_1' => '',
      'image_2' => '',
      'image_3' => '',
      'store_quantities' => '',
      'null_local' => '',
      'attributes' => '',
      'fire_discount' => '',
      'local_discount' => '',
      'product_store_quantity' => '',
      'address' => '',
      'newAttributes' => '',
      'phone' => '',
      'sub' => '',
      'url' => '',
      'username' => '',
      'delivery_address' => '',
      'billing_address' => '',
      'receptor_mobile' => '',
      'buyer_mobile' => '',
      'receptor_name' => '',
      'note' => '',
    ],

];
