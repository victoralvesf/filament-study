<?php

return [
    'label' => [
        'singular' => 'Student',
        'plural' => 'Students',
    ],
    'fields' => [
        'name' => 'Name',
        'email' => 'Email',
        'birth_date' => 'Birth date',
        'course' => 'Course',
        'enrollment_status' => 'Enrollment status',
    ],
    'enums' => [
        'enrollment' => [
            'valid' => 'Valid',
            'invalid' => 'Cancelled',
        ]
    ]
];
