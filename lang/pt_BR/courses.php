<?php

return [
    'label' => [
        'singular' => 'Curso',
        'plural' => 'Cursos',
    ],
    'fields' => [
        'title' => 'Título',
        'description' => 'Descrição',
        'teacher' => 'Professor',
        'is_active' => 'Status do curso',
        'created_at' => 'Cadastrado em'
    ],
    'enums' => [
        'status' => [
            'valid' => 'Ativo',
            'invalid' => 'Inativo',
        ]
    ]
];
