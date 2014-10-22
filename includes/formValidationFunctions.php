<?php

$errors = array();

// is there some value
function hasPresence($value) {
    return isset($value) && $value !== "";
}

function hasMaxLength($value, $max) {
    return strlen($value) <= $max;
}

function hasMinLength($value, $min) {
    return strlen($value) >= $min;
}

function formErrors($errors=array()) {
    global $lang;
    $output = "";
    if (!empty($errors)) {
        $output .= "<div class='message'>";
        $output .= "<p>" . $lang["Please fix the following errors:"] . "</p>";
        $output .= "<ul>";
        foreach ($errors as $key => $error) {
            $output .= "<li>{$error}</li>";
        }
        $output .= "</ul>";
        $output .= "</div>";
    }
    return $output;
}