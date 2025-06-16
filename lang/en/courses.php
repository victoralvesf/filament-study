<?php

return [
    'label' => [
        'singular' => 'Course',
        'plural' => 'Courses',
    ],
    'form' => [
        'messages' => [
            'info' => 'Informations',
            'status' => 'Status'
        ]
    ],
    'fields' => [
        'title' => 'Title',
        'description' => 'Description',
        'teacher' => 'Teacher',
        'is_active' => 'Course status',
        'created_at' => 'Created at'
    ],
    'enums' => [
        'status' => [
            'valid' => 'Active',
            'invalid' => 'Inactive',
        ]
    ]
];
