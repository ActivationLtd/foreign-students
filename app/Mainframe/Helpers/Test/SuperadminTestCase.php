<?php

namespace App\Mainframe\Helpers\Test;

use Tests\TestCase;
use App\User;

class SuperadminTestCase extends TestCase
{
    /**
     * Logged in user
     *
     * @var User
     */
    public $user;

    /**
     * A prefix to add in the DB fields to indicate test entries.
     * They will be later deleted.
     *
     * @var string
     */
    public $testPrefix = 'TEST--';

    protected function setUp(): void
    {
        parent::setUp();

        $this->withoutExceptionHandling();
        $this->user = User::remember(timer('long'))->find(env('SUPERADMIN_USER_ID'));
        $this->be($this->user); // Impersonate as the currently created admin user
    }

}


