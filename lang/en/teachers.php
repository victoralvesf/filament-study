<?php

return [
    'label' => [
        'singular' => 'Teacher',
        'plural' => 'Teachers',
    ],
    'fields' => [
        'name' => 'Name',
        'email' => 'Email',
        'hire_date' => 'Hired at',
        'is_active' => 'Employment status'
    ],
    'enums' => [
        'employment' => [
            'valid' => 'Active',
            'invalid' => 'Inactive',
        ]
    ]
];
