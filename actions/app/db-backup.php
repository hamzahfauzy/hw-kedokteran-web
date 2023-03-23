<?php

$file = backup();

header('location:'.asset($file));
die();