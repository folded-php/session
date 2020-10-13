<?php

declare(strict_types = 1);

namespace Folded;

use RuntimeException;
use Folded\Exceptions\SessionKeyNotFoundException;

if (!function_exists("Folded\getSession")) {
    /**
     * Get a value from the session.
     *
     * @param string $key The name of the key associated with the value stored in session.
     *
     * @throws RuntimeException            If the session is not started.
     * @throws SessionKeyNotFoundException If the session key is not found.
     *
     * @return mixed|string
     *
     * @since 0.1.0
     *
     * @example
     * getSession("foo");
     */
    function getSession(string $key)
    {
        return Session::get($key);
    }
}
