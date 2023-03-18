<?php

return [
    'slides' => [
        'filename' => [
            'label' => 'File',
            'type'  => 'file'
        ]
    ],
    'categories'    => [
        'name' => [
            'label' => 'Nama',
            'type'  => 'text'
        ],
        'price' => [
            'label' => 'Harga',
            'type'  => 'number'
        ],
        'active_time'  => [
            'label' => 'Masa Berlaku (Hari)',
            'type'  => 'number'
        ]
    ],
    'questions'    => [
        'title'  => [
            'label' => 'Judul',
            'type'  => 'text'
        ],
        'description' => [
            'label' => 'Deskripsi',
            'type'  => 'textarea'
        ],
        'category' => [
            'label' => 'Kategori',
            'type'  => 'options-obj:categories,id,name'
        ]
    ],
    'transactions' => [
        'user_id' => [
            'label' => 'User',
            'type'  => 'options-obj:users,id,name'
        ],
        'category_id' => [
            'label' => 'Kategori',
            'type'  => 'options-obj:categories,id,name'
        ],
        'file' => [
            'label' => 'File',
            'type'  => 'file'
        ],
        'status' => [
            'label' => 'Status',
            'type'  => 'text'
        ],
        'amount' => [
            'label' => 'Total',
            'type'  => 'number'
        ]
    ],
    'logs' => [
        'user_id' => [
            'label' => 'User',
            'type'  => 'options-obj:users,id,name'
        ],
        'description' => [
            'label' => 'Deskripsi',
            'type'  => 'text'
        ],
        'created_at' => [
            'label' => 'Waktu',
            'type'  => 'text',
        ]
    ]
];