<?php

// validation here
Validation::run([
    'filename' => [
        'file','required','mime:jpeg,jpg,png'
    ]
], $_FILES, 'json');

$_POST[$table]['filename'] = do_upload($_FILES['filename'],'uploads');