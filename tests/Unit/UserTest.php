<?php

namespace Tests\Unit;

use App\Models\User;
use PHPUnit\Framework\TestCase;

class UserTest extends TestCase
{
    public function test_user_with_admin_role_is_admin(): void
    {
        $user = new User;
        $user->setRole('admin');

        $this->assertTrue($user->isAdmin());
    }

    public function test_user_with_customer_role_is_not_admin(): void
    {
        $user = new User;
        $user->setRole('customer');

        $this->assertFalse($user->isAdmin());
    }
}
