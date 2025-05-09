<?php
/**
 * Security helper functions to prevent XSS
 */

/**
 * Safely output text to prevent XSS
 */
function safe_echo($text) {
    echo htmlspecialchars($text, ENT_QUOTES, 'UTF-8');
}

/**
 * Safely output text with newlines converted to <br>
 */
function safe_echo_nl2br($text) {
    echo nl2br(htmlspecialchars($text, ENT_QUOTES, 'UTF-8'));
}

/**
 * Return text that is safe to include in HTML attributes
 */
function safe_attr($text) {
    return htmlspecialchars($text, ENT_QUOTES, 'UTF-8');
}
?>