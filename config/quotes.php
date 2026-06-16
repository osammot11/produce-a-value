<?php

return [
    'access_code' => env('QUOTE_ACCESS_CODE', '9999'),

    'company' => [
        'name' => env('QUOTE_COMPANY_NAME', 'Produce a Value'),
        'vat' => env('QUOTE_COMPANY_VAT', ''),
        'email' => env('QUOTE_COMPANY_EMAIL', 'giovannonicommerciale@gmail.com'),
        'phone' => env('QUOTE_COMPANY_PHONE', ''),
        'address' => env('QUOTE_COMPANY_ADDRESS', ''),
        'website' => env('QUOTE_COMPANY_WEBSITE', 'https://produceavalue.com'),
    ],
];
