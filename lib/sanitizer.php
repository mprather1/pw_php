<?php
  class Sanitizer
  {
    public static function sanitize($input) {
      $input = trim($input);
      $clean_html = htmlspecialchars($input);
      return $clean_html;
    }
  }
?>