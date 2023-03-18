<?php

$category_question = $db->single('category_questions',['question_id'=>$data->id]);
$data->category = $db->single('categories',['id' => $category_question->category_id])->id;

return $data;