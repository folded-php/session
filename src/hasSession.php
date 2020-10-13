<?php

declare(strict_types = 1);

namespace Folded;

use RuntimeException;

if (!function_exists("Folded\hasSession")) {
    /**
     * Returns true if the session has the value by its key, else returns false.
     *
     * @param string $key The name of the key holding the value in session.
     *
     * @throws RuntimeException If the session is not started.
     *
     * @since 0.1.0
     *
     * @example
     * if (hasSession("foo")) {
     *  echo "foo is in session";
     * } else {
     *  echo "foo is not in session";
     * }
     */
    function hasSession(string $key): bool
    {
        return Session::has($key);
    }
}
