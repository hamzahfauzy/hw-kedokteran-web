<?php

$db->update('category_questions',[
    'category_id' => $_POST['category'],
],[
    'question_id' => $edit->id
]);