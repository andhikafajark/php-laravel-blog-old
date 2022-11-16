<?php

namespace Tests\Browser\Auth;

use Illuminate\Foundation\Testing\DatabaseMigrations;
use Laravel\Dusk\Browser;
use Tests\DuskTestCase;
use Throwable;

class LoginTest extends DuskTestCase
{
    use DatabaseMigrations;

    /**
     * Setup the test environment.
     *
     * @return void
     */
    protected function setUp(): void
    {
        parent::setUp();

        $this->artisan('db:seed');
    }

    /**
     * Test success login.
     *
     * @group Auth
     * @return void
     * @throws Throwable
     */
    public function test_success_login(): void
    {
        $this->browse(function (Browser $browser) {
            $browser->visitRoute('auth.login')
                ->type('username', 'admin')
                ->type('password', 'admin')
                ->press('Login')
                ->waitFor('.swal2-container')
                ->assertSee('Login Success')
                ->assertAuthenticated();

            $browser->logout();
        });
    }

    /**
     * Test invalid username or password.
     *
     * @group Auth
     * @return void
     * @throws Throwable
     */
    public function test_invalid_username_or_password(): void
    {
        $this->browse(function (Browser $browser) {
            $browser->visitRoute('auth.login')
                ->type('username', 'wrong')
                ->type('password', 'wrong')
                ->press('Login')
                ->waitFor('.swal2-container')
                ->assertSee('Username or password is wrong')
                ->assertGuest();
        });
    }

    /**
     * Test invalid validation.
     *
     * @group Auth
     * @return void
     * @throws Throwable
     */
    public function test_invalid_validation(): void
    {
        $this->browse(function (Browser $browser) {
            $browser->visitRoute('auth.login')
                ->type('username', '')
                ->type('password', '')
                ->press('Login')
                ->waitFor('#form #username-error, #form #password-error')
                ->assertSeeIn('#form #username-error', 'This field is required.')
                ->assertSeeIn('#form #password-error', 'This field is required.')
                ->assertGuest();
        });
    }
}
