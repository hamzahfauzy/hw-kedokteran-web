<?php

$db->query = "SELECT *, (SELECT categories.name FROM categories WHERE id IN (SELECT category_id FROM category_questions WHERE question_id=$table.id)) as category FROM $table $where ORDER BY ".$columns[$order[0]['column']]." ".$order[0]['dir']." LIMIT $start,$length";
$data  = $db->exec('all');

$total = $db->exists($table,$where,[
    $columns[$order[0]['column']] => $order[0]['dir']
]);

return compact('data','total');