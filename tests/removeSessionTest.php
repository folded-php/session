<?php

declare(strict_types = 1);

use function Folded\hasSession;
use function Folded\setSession;
use function Folded\removeSession;

beforeEach(function (): void {
    if (session_status() !== PHP_SESSION_ACTIVE) {
        session_start();
    }

    $_SESSION = null;
});

it("should remove the session key/value using the removeSession function", function (): void {
    $key = "foo";

    setSession($key, "bar");
    removeSession($key);

    expect(hasSession($key))->toBeFalse();
});
