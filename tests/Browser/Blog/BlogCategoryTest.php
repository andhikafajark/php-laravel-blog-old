<?php

namespace Tests\Browser\Blog;

use App\Models\User;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use Laravel\Dusk\Browser;
use Tests\DuskTestCase;
use Throwable;

class BlogCategoryTest extends DuskTestCase
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
     * Test show list blog category.
     *
     * @group BlogCategory
     * @return void
     * @throws Throwable
     */
    public function test_show_list_blog_category(): void
    {
        $blogCategories = [
            ['title' => 'Technology'],
            ['title' => 'Animal']
        ];

        $this->browse(function (Browser $browser) use ($blogCategories) {
            $browser->loginAs(User::where('username', 'admin')->first())
                ->visitRoute('blog-category.index')
                ->waitFor('#table')
                ->assertSeeIn('#table thead tr th:nth-child(1)', 'No')
                ->assertSeeIn('#table thead tr th:nth-child(2)', 'Title')
                ->assertSeeIn('#table thead tr th:nth-child(3)', 'Action');

            foreach ($blogCategories as $i => $blogCategory) {
                $no = $i + 1;
                $browser->assertSeeIn("#table tbody tr:nth-child($no) td:nth-child(1)", $no)
                    ->assertSeeIn("#table tbody tr:nth-child($no) td:nth-child(2)", $blogCategory['title'])
                    ->assertSeeIn("#table tbody tr:nth-child($no) td:nth-child(3)", 'Edit')
                    ->assertSeeIn("#table tbody tr:nth-child($no) td:nth-child(3)", 'Delete');
            }
        });
    }

    /**
     * Test filter search list blog category.
     *
     * @group BlogCategory
     * @return void
     * @throws Throwable
     */
    public function test_filter_search_list_blog_category(): void
    {
        $expectedSee = [
            ['title' => 'Technology']
        ];
        $expectedDontSee = [
            ['title' => 'Animal']
        ];

        $this->browse(function (Browser $browser) use ($expectedSee, $expectedDontSee) {
            $browser->loginAs(User::where('username', 'admin')->first())
                ->visitRoute('blog-category.index')
                ->waitFor('#table')
                ->type('#table_wrapper #table_filter input[type="search"]', 'Technology')
                ->pause(500);

            foreach ($expectedSee as $i => $item) {
                $no = $i + 1;
                $browser->assertSeeIn("#table tbody tr:nth-child($no) td:nth-child(1)", $no)
                    ->assertSeeIn("#table tbody tr:nth-child($no) td:nth-child(2)", $item['title'])
                    ->assertSeeIn("#table tbody tr:nth-child($no) td:nth-child(3)", 'Edit')
                    ->assertSeeIn("#table tbody tr:nth-child($no) td:nth-child(3)", 'Delete');
            }

            foreach ($expectedDontSee as $item) {
                $browser->assertDontSeeIn("#table tbody", $item['title']);
            }
        });
    }

    /**
     * Test filter order list blog category.
     *
     * @group BlogCategory
     * @return void
     * @throws Throwable
     */
    public function test_filter_order_list_blog_category(): void
    {
        $expected = [
            ['title' => 'Animal'],
            ['title' => 'Technology']
        ];

        $this->browse(function (Browser $browser) use ($expected) {
            $browser->loginAs(User::where('username', 'admin')->first())
                ->visitRoute('blog-category.index')
                ->waitFor('#table')
                ->click('#table thead tr th:nth-child(2)')
                ->pause(500);

            foreach ($expected as $i => $item) {
                $no = $i + 1;
                $browser->assertSeeIn("#table tbody tr:nth-child($no) td:nth-child(1)", $no)
                    ->assertSeeIn("#table tbody tr:nth-child($no) td:nth-child(2)", $item['title'])
                    ->assertSeeIn("#table tbody tr:nth-child($no) td:nth-child(3)", 'Edit')
                    ->assertSeeIn("#table tbody tr:nth-child($no) td:nth-child(3)", 'Delete');
            }
        });
    }

    /**
     * Test create blog category success.
     *
     * @group BlogCategory
     * @return void
     * @throws Throwable
     */
    public function test_create_blog_category_success(): void
    {
        $this->browse(function (Browser $browser) {
            $browser->loginAs(User::where('username', 'admin')->first())
                ->visitRoute('blog-category.create')
                ->type('title', 'test')
                ->press('Save')
                ->waitFor('.swal2-container')
                ->assertSeeIn('.swal2-container', 'Create Data Success');
        });
    }

    /**
     * Test create blog category invalid validation.
     *
     * @group BlogCategory
     * @return void
     * @throws Throwable
     */
    public function test_create_blog_category_invalid_validation(): void
    {
        $this->browse(function (Browser $browser) {
            $browser->loginAs(User::where('username', 'admin')->first())
                ->visitRoute('blog-category.create')
                ->type('title', '')
                ->press('Save')
                ->waitFor('#form #title-error')
                ->assertSeeIn('#form #title-error', 'This field is required.');
        });
    }

    /**
     * Test edit blog category success.
     *
     * @group BlogCategory
     * @return void
     * @throws Throwable
     */
    public function test_edit_blog_category_success(): void
    {
        $expectedSee = [
            ['title' => 'Technology']
        ];

        $this->browse(function (Browser $browser) use ($expectedSee) {
            $browser->loginAs(User::where('username', 'admin')->first())
                ->visitRoute('blog-category.edit', 'e976eba4-6853-4405-9549-a503ab645981')
                ->assertValue('#form #title', $expectedSee[0]['title'])
                ->type('title', 'test')
                ->press('Save')
                ->waitFor('.swal2-container')
                ->assertSeeIn('.swal2-container', 'Update Data Success');
        });
    }

    /**
     * Test create blog category invalid validation.
     *
     * @group BlogCategory
     * @return void
     * @throws Throwable
     */
    public function test_edit_blog_category_invalid_validation(): void
    {
        $expectedSee = [
            ['title' => 'Technology']
        ];

        $this->browse(function (Browser $browser) use ($expectedSee) {
            $browser->loginAs(User::where('username', 'admin')->first())
                ->visitRoute('blog-category.edit', 'e976eba4-6853-4405-9549-a503ab645981')
                ->assertValue('#form #title', $expectedSee[0]['title'])
                ->type('title', '')
                ->press('Save')
                ->waitFor('#form #title-error')
                ->assertSeeIn('#form #title-error', 'This field is required.');
        });
    }

    /**
     * Test delete blog category success.
     *
     * @group BlogCategory
     * @return void
     * @throws Throwable
     */
    public function test_delete_blog_category_success(): void
    {
        $blogCategories = [
            ['title' => 'Technology']
        ];

        $this->browse(function (Browser $browser) use ($blogCategories) {
            $browser->loginAs(User::where('username', 'admin')->first())
                ->visitRoute('blog-category.index')
                ->waitFor('#table')
                ->assertSeeIn('#table thead tr th:nth-child(1)', 'No')
                ->assertSeeIn('#table thead tr th:nth-child(2)', 'Title')
                ->assertSeeIn('#table thead tr th:nth-child(3)', 'Action');

            $no = 0;

            foreach ($blogCategories as $i => $item) {
                $no = $i + 1;
                $browser->assertSeeIn("#table tbody tr:nth-child($no) td:nth-child(1)", $no)
                    ->assertSeeIn("#table tbody tr:nth-child($no) td:nth-child(2)", $item['title'])
                    ->assertSeeIn("#table tbody tr:nth-child($no) td:nth-child(3)", 'Edit')
                    ->assertSeeIn("#table tbody tr:nth-child($no) td:nth-child(3)", 'Delete');
            }

            $browser->click("#table tbody tr:nth-child($no) td:nth-child(3) button.delete")
                ->waitFor('.swal2-container')
                ->assertSeeIn('.swal2-container .swal2-title', 'Are you sure?')
                ->assertSeeIn('.swal2-container .swal2-actions .swal2-confirm', 'Yes, delete it!')
                ->assertSeeIn('.swal2-container .swal2-actions .swal2-cancel', 'Cancel')
                ->click('.swal2-container .swal2-actions .swal2-confirm')
                ->waitFor('.swal2-container')
                ->assertSeeIn('.swal2-container', 'Delete Data Success');

            foreach ($blogCategories as $item) {
                $browser->assertDontSeeIn("#table tbody", $item['title']);
            }
        });
    }
}
