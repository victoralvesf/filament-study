<?php

return [
    'label' => [
        'singular' => 'Estudante',
        'plural' => 'Estudantes',
    ],
    'fields' => [
        'name' => 'Nome',
        'email' => 'E-mail',
        'birth_date' => 'Data de nascimento',
        'course' => 'Curso',
        'enrollment_status' => 'Status da matrícula',
    ],
    'enums' => [
        'enrollment' => [
            'valid' => 'Válida',
            'invalid' => 'Cancelada',
        ]
    ]
];
