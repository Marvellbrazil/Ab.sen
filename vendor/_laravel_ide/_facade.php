<?php

namespace Illuminate\Support\Facades;

interface Auth
{
    /**
     * @return \App\Models\Account|false
     */
    public static function loginUsingId(mixed $id, bool $remember = false);

    /**
     * @return \App\Models\Account|false
     */
    public static function onceUsingId(mixed $id);

    /**
     * @return \App\Models\Account|null
     */
    public static function getUser();

    /**
     * @return \App\Models\Account
     */
    public static function authenticate();

    /**
     * @return \App\Models\Account|null
     */
    public static function user();

    /**
     * @return \App\Models\Account|null
     */
    public static function logoutOtherDevices(string $password);

    /**
     * @return \App\Models\Account
     */
    public static function getLastAttempted();
}