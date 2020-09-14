<?php

declare(strict_types = 1);

use function Folded\getSession;
use function Folded\setSession;

beforeEach(function (): void {
    if (session_status() !== PHP_SESSION_ACTIVE) {
        session_start();
    }

    $_SESSION = null;
});

it("should set the session value using the setSession function", function (): void {
    $key = "foo";
    $value = "bar";

    setSession($key, $value);

    expect(getSession($key))->toBe($value);
});
