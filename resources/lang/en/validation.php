<?php

return [

    /*
    |--------------------------------------------------------------------------
    | Validation Language Lines
    |--------------------------------------------------------------------------
    |
    |  following language lines contain  default error messages used by
    |  validator class. Some of these rules have multiple versions such
    | as  size rules. Feel free to tweak each of these messages here.
    |
    */

    'accepted'             => ':attribute باید پذیرفته شود',
    'active_url'           => ':attribute یک لینک معتبر نیست',
    'after'                => ':attribute باید بعد از تاریخ :date باشد',
    'alpha'                => ':attribute ممکن است فقط حاوی حروف باشد',
    'alpha_dash'           => ':attribute ممکن است فقط حاوی حروف، اعداد، و خطا باشد.',
    'alpha_num'            => ':attribute ممکن است فقط حاوی حروف و اعداد باشد',
    'array'                => ':attribute باید یک آرایه باشد',
    'before'               => ':attribute باید قبل از تاریخ :date باشد',
    'between'              => [
        'numeric' => ':attribute باید بین :min و :max باشد',
        'file'    => ':attribute باید بین :min و :max KB باشد',
        'string'  => ':attribute باید بین :min و :max کاراکتر باشد',
        'array'   => ':attribute باید بین :min و :max آیتم ها باشد',
    ],
    'boolean'              => ':attribute فیلد باید درست یا نادرست باشد',
    'confirmed'            => ':attribute تأیید مطابقت ندارد',
    'date'                 => ':attribute یک تاریخ معتبر نیست',
    'date_format'          => ':attribute فرمت تاریخ نا معتبر است :format.',
    'different'            => ':attribute و :other باید متفاوت باشد',
    'digits'               => ':attribute فیلد :digits باید عدد باشد',
    'digits_between'       => ':attribute باید عددی بین :min و :max باشد',
    'distinct'             => ':attribute فیلد دارای مقدار تکراری است',
    'email'                => ':attribute می بایست یک ایمیل ادرس معتبر باشد',
    'exists'               => ':attribute نا معتبر است',
    'filled'               => ':attribute پر کردن الزامی است',
    'image'                => ':attribute باید یک تصویر باشد',
    'in'                   => ':attribute نا معتبر است',
    'in_array'             => ':attribute در آرایه :other موجود نیست',
    'integer'              => ':attribute یک عدد صحیح نیست',
    'ip'                   => ':attribute یک آی پی معتبر نیست',
    'json'                 => ':attribute فرمت نامعتبر است(json)',
    'max'                  => [
        'numeric' => 'ممکن است بزرگتر از :max باشد',
        'file'    => 'ممکن است بزرگتر از :max ',
        'string'  => 'ممکن است بزرگتر از :max کاراکترها باشد',
        'array'   => 'ممکن است بیشتر نباشد than :max',
    ],
    'mimes'                => ' :attribute باید یک فایل از نوع :values باشد',
    'min'                  => [
        'numeric' => ' :attribute باید حداقل  :min باشد',
        'file'    => ' :attribute باید حداقل :min کیلو بایت باشد',
        'string'  => ' :attribute باید حداقل :min کاراکتر باشد',
        'array'   => ' :attribute باید حداقل داشته  :min آیتم داشته باشد',
    ],
    'not_in'               => 'نا معتبر است',
    'numeric'              => 'باید یک نوع عددی باشد',
    'present'              => 'یک فیلد الزامی است',
    'regex'                => 'غیر قابل قبول است',
    'required'             => 'یک فیلد الزامی است',
    'required_if'          => ' :attribute field is required when :other is :value.',
    'required_unless'      => ' :attribute field is required unless :other is in :values.',
    'required_with'        => ' :attribute field is required when :values is present.',
    'required_with_all'    => ' :attribute field is required when :values is present.',
    'required_without'     => ' :attribute field is required when :values is not present.',
    'required_without_all' => ' :attribute field is required when none of :values are present.',
    'same'                 => ' :attribute و :other باید یکسان باشد',
    'size'                 => [
        'numeric' => ' :attribute باید  :size باشد',
        'file'    => ' :attribute باید  :size کیلوبایت باشد',
        'string'  => ' :attribute باید  :size کاراکتر باشد',
        'array'   => ' :attribute باید :size آیتم باشد',
    ],
    'string'               => ' باید حروف باشد',
    'timezone'             => ' باید یک منطقه معتبر باشد',
    'unique'               => ' قبلا استفاده شده است',
    'url'                  => 'قالب نا معتبر می باشد',

    /*
    |--------------------------------------------------------------------------
    | Custom Validation Language Lines
    |--------------------------------------------------------------------------
    |
    | Here you may specify custom validation messages for attributes using the
    | convention "attribute.rule" to name  lines. This makes it quick to
    | specify a specific custom language line for a given attribute rule.
    |
    */

    'custom' => [
        'attribute-name' => [
            'rule-name' => 'custom-message',

        ],
    ],

    /*
    |--------------------------------------------------------------------------
    | Custom Validation Attributes
    |--------------------------------------------------------------------------
    |
    |  following language lines are used to swap attribute place-holders
    | with something more reader friendly such as E-Mail Address instead
    | of "email". This simply helps us make messages a little cleaner.
    |
    */

    'attributes' => [],

];
