<?php

namespace Tests\Unit;

use App\Post;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class PostTest extends TestCase
{
    /** @test */
    public function it_fills_a_slug_attribute()
    {
        $post = new Post;

        $this->assertNull($post->slug);

        $post->title = 'Testing';

        $this->assertSame('testing', $post->slug);
    }
}
