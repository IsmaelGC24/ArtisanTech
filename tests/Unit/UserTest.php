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

    public function test_initials_use_the_first_letter_of_the_first_two_words(): void
    {
        $user = new User;
        $user->setName('Ismael García Ceballos');

        $this->assertSame('IG', $user->getInitials());
    }

    public function test_initials_of_a_single_name_are_one_uppercase_letter(): void
    {
        $user = new User;
        $user->setName('ana');

        $this->assertSame('A', $user->getInitials());
    }

    public function test_initials_ignore_extra_spaces_and_keep_accented_letters(): void
    {
        $user = new User;
        $user->setName('  álvaro   pérez ');

        $this->assertSame('ÁP', $user->getInitials());
    }
}
