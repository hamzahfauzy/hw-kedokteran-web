<?php

return [
    'dashboard' => 'default/index',
    'slide show' => 'crud/index?table=slides',
    'kategori' => 'crud/index?table=categories',
    'bank soal' => 'crud/index?table=questions',
    'transaksi' => 'crud/index?table=transactions',
    'log aktivitas' => 'crud/index?table=logs',
    'laporan' => 'reports/index',
    'pengguna'  => [
        'semua pengguna' => 'users/index',
        'roles' => 'roles/index'
    ],
    'pengaturan' => 'application/index'
];