<?php

class Redirect {
    public static function to($uri) {
        header('Location: ' . $uri);
        exit;
    }
}