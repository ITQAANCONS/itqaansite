<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class ExampleTest extends TestCase
{
    use RefreshDatabase;

    /**
     * The root path redirects to the default locale.
     */
    public function test_root_redirects_to_default_locale(): void
    {
        $this->get('/')->assertRedirect('/ar');
    }

    /**
     * The Arabic homepage renders successfully.
     */
    public function test_home_page_renders(): void
    {
        $this->get('/ar')->assertOk();
        $this->get('/en')->assertOk();
    }
}
