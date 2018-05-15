<?php
function tazalau($clear_str)
{
    $clear_str = strip_tags($clear_str);
    $clear_str = mysql_real_escape_string($clear_str);
    $clear_str = trim($clear_str);
    return $clear_str;
}
?>