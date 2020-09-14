<?php

declare(strict_types = 1);

namespace Folded;

if (!function_exists("flashSession")) {
    /**
     * Flash a data.
     * A flashed data can only be getted once.
     *
     * @param string $key   The name of the key to set in session.
     * @param mixed  $value The value to set in session.
     *
     * @throws RuntimeException If the session is not started.
     *
     * @since 0.1.0
     *
     * @example
     * flashSession("token", "12345");
     */
    function flashSession(string $key, $value): void
    {
        Session::flash($key, $value);
    }
}
