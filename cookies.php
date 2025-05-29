<?php

    function setMyCookies($name, $value, $expire = 3600) {
        setcookie($name, $value, time() + $expire, "/");
    }
    function getMyCookies($name) {
        return isset($_COOKIE[$name]) ? $_COOKIE[$name] : null;
    }
    function deleteMyCookies($name) {
        setcookie($name, "", time() - 3600, "/");
    }
    
    function clearAllCookies() {
        if (isset($_SERVER['HTTP_COOKIE'])) {
            $cookies = explode(';', $_SERVER['HTTP_COOKIE']);
            foreach ($cookies as $cookie) {
                $parts = explode('=', $cookie);
                $name = trim($parts[0]);
                deleteMyCookies($name);
            }
        }
    }
