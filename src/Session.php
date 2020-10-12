<?php

declare(strict_types = 1);

namespace Folded;

use RuntimeException;
use Folded\Exceptions\SessionKeyNotFoundException;

/**
 * Represents values in the server session.
 *
 * @since 0.1.0
 */
final class Session
{
    const FLASHED_KEYS_NAME = "__folded_flashed_keys";

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
     * Session::flash("token", "12345");
     */
    public static function flash(string $key, $value): void
    {
        // Check for whether session is started or not happens in the method set().
        self::set($key, $value);
        self::addFlashedKey($key);
    }

    /**
     * Get a value from the session.
     *
     * @param string $key  The name of the key associated with the value stored in session.
     * @param bool   $keep Wether to keep the value (useful if you flashed the data but need to keep it one more time).
     *
     * @throws RuntimeException                              If the session is not started.
     * @throws Folded\Exceptions\SessionKeyNotFoundException If the session key is not found.
     *
     * @since 0.1.0
     *
     * @example
     * Session::get("foo");
     */
    public static function get(string $key, bool $keep = false)
    {
        self::checkSessionStarted();
        self::checkKeyExists($key);

        $value = $_SESSION[$key];

        if (self::keyFlashed($key) && !$keep) {
            self::remove($key);
        }

        return $value;
    }

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
     * if (Session::has("foo")) {
     *  echo "foo is in session";
     * } else {
     *  echo "foo is not in session";
     * }
     */
    public static function has(string $key): bool
    {
        self::checkSessionStarted();

        return isset($_SESSION[$key]);
    }

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
     * Session::remove("foo");
     */
    public static function remove(string $key): void
    {
        self::checkSessionStarted();
        self::checkKeyExists($key);

        unset($_SESSION[$key]);
    }

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
     * Session::set("foo", "bar");
     */
    public static function set(string $key, $value): void
    {
        self::checkSessionStarted();

        $_SESSION[$key] = $value;
    }

    /**
     * Add a key in the tracked flashed keys.
     *
     * @param string $key The name of the key holding the data in the session.
     *
     * @since 0.1.0
     *
     * @example
     * Session::addFlashedKey("foo");
     */
    private static function addFlashedKey(string $key): void
    {
        $_SESSION[self::FLASHED_KEYS_NAME][$key] = true;
    }

    /**
     * Throws an exception if the key is not in session.
     *
     * @throws Folded\Exceptions\SessionKeyNotFoundException If the key is not found in session.
     *
     * @since 0.1.0
     *
     * @example
     * Session::checkKeyExists("foo");
     */
    private static function checkKeyExists(string $key): void
    {
        if (!isset($_SESSION[$key])) {
            // @todo raise a SessionKeyNotFoundException instead
            throw (new SessionKeyNotFoundException("session key $key not found"))->setKey($key);
        }
    }

    /**
     * Throws a exception if the session is not started.
     *
     * @throws RuntimeException If the session is not started.
     *
     * @since 0.1.0
     *
     * @example
     * Session::checkSessionStarted();
     */
    private static function checkSessionStarted(): void
    {
        if (session_status() !== PHP_SESSION_ACTIVE) {
            throw new RuntimeException("session not started");
        }
    }

    /**
     * Returns true if the key has been flashed, else returns false.
     *
     * @param string $key The name of the key holding data in session.
     *
     * @since 0.1.0
     *
     * @example
     * if (Session::keyFlashed("foo")) {
     *  echo "key foo has been flashed";
     * } else {
     *  echo "key foo has not been flashed";
     * }
     */
    private static function keyFlashed(string $key): bool
    {
        return isset($_SESSION[self::FLASHED_KEYS_NAME][$key]);
    }
}
