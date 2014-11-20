<?php

function d($var = 'Step 1', $die = true) {
    echo "<pre>";
    var_dump($var);
    echo "</pre>";
    if ($die)
        die();
}
