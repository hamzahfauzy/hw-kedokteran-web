<?php

$db->insert('category_questions',[
    'category_id' => $_POST['category'],
    'question_id' => $insert->id
]);