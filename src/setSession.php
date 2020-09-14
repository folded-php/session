<?php

declare(strict_types = 1);

namespace Folded;

if (!function_exists("setSession")) {
    /**
     * Set the value in the session.
     *
     * @param string $key   The name of the key that will hold the value in session.
     * @param mixed  $value The value that will be stored in session.
     *
     * @throws RuntimeException If the session is not started.
     *
     * @since 0.1.0
     *
     * @example
     * setSession("foo", "bar");
     */
    function setSession(string $key, $value): void
    {
        Session::set($key, $value);
    }
}
