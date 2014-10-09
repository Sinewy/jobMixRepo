<?php

session_start();

function displayMessage() {
    if (isset($_SESSION["message"])) {
        $output = "<div class='message'>";
        $output .= "<p>Warning:</p>";
        $output .= "<p>";
        $output .=  htmlentities($_SESSION["message"]);
        $output .= "</p>";
        $output .= "</div>";

        // clear message after use
        $_SESSION["message"] = null;

        return $output;
    }
}