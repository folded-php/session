<?php

declare(strict_types = 1);

use Folded\Session;
use Folded\Exceptions\SessionKeyNotFoundException;

beforeEach(function (): void {
    if (session_status() !== PHP_SESSION_ACTIVE) {
        session_start();
    }

    $_SESSION = null;
});

// Session::get()
it("should set the session value in the key", function (): void {
    $value = "bar";

    Session::set("foo", $value);

    expect(Session::get("foo"))->toBe($value);
});

it("should throw an exception if the session key is not found", function (): void {
    $this->expectException(SessionKeyNotFoundException::class);

    Session::get("not-found");
});

it("should set the session key in the exception if the session key is not found", function (): void {
    $key = "not-found";

    try {
        Session::get($key);
    } catch (SessionKeyNotFoundException $exception) {
        expect($exception->getKey())->toBe($key);
    }
});

it("should throw an exception message if the session key is not found", function (): void {
    $this->expectExceptionMessage("session key not-found not found");

    Session::get("not-found");
});

it("should throw an exception if session is not started when getting a session value", function (): void {
    $this->expectException(RuntimeException::class);

    session_destroy();

    Session::get("foo");
});

it("should throw an exception message if session is not started when getting a session value", function (): void {
    $this->expectExceptionMessage("session not started");

    session_destroy();

    Session::get("foo");
});

// Session::has()
it("should return false if the session key is not found", function (): void {
    expect(Session::has("not-found"))->toBeFalse();
});

it("should return true if the session key has been set", function (): void {
    Session::set("foo", "bar");

    expect(Session::has("foo"))->toBeTrue();
});

it("should throw an exception if the session is not started when checking if a session key exist", function (): void {
    $this->expectException(RuntimeException::class);

    session_destroy();

    Session::has("foo");
});

it("should throw an exception message if the session is not started when checking if a session key exist", function (): void {
    $this->expectExceptionMessage("session not started");

    session_destroy();

    Session::has("foo");
});

// Session::flash()
it("should set the value when flashing data", function (): void {
    $value = "bar";

    Session::flash("foo", $value);

    expect(Session::get("foo"))->toBe($value);
});

it("should not be able to get the value twiced after being flashed", function (): void {
    $value = "bar";

    Session::flash("foo", $value);

    Session::get("foo");

    expect(Session::has("foo"))->toBeFalse();
});

it("should keep the data one more time", function (): void {
    $key = "foo";
    $value = "bar";

    Session::flash($key, $value);
    Session::get($key, true);

    expect(Session::get($key))->toBe($value);
});

it("should throw an exception if the session is not started when flashing data", function (): void {
    $this->expectException(RuntimeException::class);

    session_destroy();

    Session::flash("foo", "bar");
});

it("should throw an exception message if the session is not started when flashing data", function (): void {
    $this->expectExceptionMessage("session not started");

    session_destroy();

    Session::flash("foo", "bar");
});

// Session::remove()
it("should remove the session key", function (): void {
    Session::set("foo", "bar");
    Session::remove("foo");

    expect(Session::has("foo"))->toBeFalse();
});

it("should throw an exception if the session key is not found when removing the key", function (): void {
    $this->expectException(SessionKeyNotFoundException::class);

    Session::remove("not-found");
});

it("should set the session key in the exception if the session key is not found when removing the key", function (): void {
    $key = "not-found";

    try {
        Session::remove($key);
    } catch (SessionKeyNotFoundException $exception) {
        expect($exception->getKey())->toBe($key);
    }
});

it("should throw an exception message if the session key is not found when removing the key", function (): void {
    $this->expectExceptionMessage("session key not-found not found");

    Session::remove("not-found");
});

it("should throw an exception if the session is not started", function (): void {
    $this->expectException(RuntimeException::class);

    session_destroy();

    Session::remove("foo");
});

it("should throw an exception message if the session is not started", function (): void {
    $this->expectExceptionMessage("session not started");

    session_destroy();

    Session::remove("foo");
});
