<?php
if (!function_exists('esc')) {
    function esc($string, $context = 'html')
    {
        if ($context === 'raw') {
            return $string; // biar HTML bisa muncul mentah
        }
        return htmlspecialchars($string, ENT_QUOTES, 'UTF-8');
    }
}
