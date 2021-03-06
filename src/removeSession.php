<?php

declare(strict_types = 1);

namespace Folded;

use RuntimeException;

if (!function_exists("Folded\removeSession")) {
    /**
     * Removes a value by its key in the session.
     *
     * @param string $key The name of the key holding the value in session.
     *
     * @throws RuntimeException If the session is not started.
     *
     * @since 0.1.0
     *
     * @example
     * removeSession("foo");
     */
    function removeSession(string $key): void
    {
        Session::remove($key);
    }
}
