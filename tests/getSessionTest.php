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

it("should get the session value using the getSession function", function (): void {
    $value = "bar";

    setSession("foo", $value);

    expect(getSession("foo"))->toBe($value);
});
