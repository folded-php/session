<?php

declare(strict_types = 1);

use function Folded\hasSession;
use function Folded\getSession;
use function Folded\flashSession;

beforeEach(function (): void {
    if (session_status() !== PHP_SESSION_ACTIVE) {
        session_start();
    }

    $_SESSION = null;
});

it("should set the value using the flashSession function", function (): void {
    $value = "bar";

    flashSession("foo", $value);

    expect(getSession("foo"))->toBe($value);
});

it("should not be able to get twice the value using the flashSession function", function (): void {
    flashSession("foo", "bar");

    getSession("foo");

    expect(hasSession("foo"))->toBeFalse();
});
