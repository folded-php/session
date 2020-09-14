<?php

declare(strict_types = 1);

use function Folded\hasSession;
use function Folded\setSession;

beforeEach(function (): void {
    if (session_status() !== PHP_SESSION_ACTIVE) {
        session_start();
    }

    $_SESSION = null;
});

it("should return true if the session is present using the hasSession function", function (): void {
    $key = "foo";

    setSession($key, "bar");

    expect(hasSession($key))->toBeTrue();
});

it("should return false if the session is not present using the hasSession function", function (): void {
    expect(hasSession("not-found"))->toBeFalse();
});
