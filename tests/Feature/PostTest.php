<?php

namespace Tests\Feature;

use App\Models\Posts;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Support\Facades\Auth;
use Tests\TestCase;

class PostTest extends TestCase
{
    use RefreshDatabase;

    public function test_home_screen_can_be_rendered()
    {
        $response = $this->get('/');
        $response->assertViewHas('posts');
        $response->assertStatus(200);
    }

    public function test_home_screen_can_be_rendered_with_posts()
    {
        $post = Posts::factory(5)->create();
        $response = $this->get('/');
        $response->assertViewHas('posts');
        $response->assertSeeTextInOrder([
            date('j F Y', strtotime($post[0]->created_at)),
            $post[0]->title,
            strlen($post[0]->content) > 100 ? substr(strip_tags($post[0]->content), 0, 100) . '...' : strip_tags($post->content),
            'Read more',
            $post[0]->user->name
        ]);
        $response->assertStatus(200);
    }

    public function test_create_post_screen_can_be_rendered()
    {
        $user = User::factory()->create();

        $response = $this->actingAs($user)->get('/posts/create');

        $response->assertStatus(200);
    }

    public function test_user_can_create_post()
    {
        $user = User::factory()->create();

        $response = $this->actingAs($user)->post('/posts', [
            'title' => 'Test title',
            'content' => '<h1>Testing this out</h1>'
        ]);

        $response->assertRedirect('/posts/6');

        $this->assertDatabaseHas('posts', [
            'title' => 'Test title',
            'content' => '<h1>Testing this out</h1>'
        ]);
    }

    public function test_create_post_title_validation()
    {
        $user = User::factory()->create();

        $response = $this->actingAs($user)->post('/posts', [
            'title' => null,
            'content' => '<h1>Testing this out</h1>'
        ]);

        $response->assertSessionHasErrors(['title']);
    }

    public function test_create_post_content_validation()
    {
        $user = User::factory()->create();

        $response = $this->actingAs($user)->post('/posts', [
            'title' => 'Test title',
            'content' => null
        ]);

        $response->assertSessionHasErrors(['content']);
    }

    public function test_edit_post_screen_can_be_rendered()
    {
        $post = Posts::factory()->create();
        $user = User::factory()->create();

        $response = $this->actingAs($user)->get('/posts/' . $post->id . '/edit');

        $response->assertStatus(200);
    }

    public function test_user_can_edit_post()
    {
        $post = Posts::factory()->create();
        $user = User::factory()->create();

        $response = $this->actingAs($user)->put('/posts/' . $post->id, [
            'title' => 'Changing Post',
            'content' => '<h1>Changing the content for post</h1>'
        ]);

        $response->assertRedirect('/posts/' . $post->id);

        $this->assertDatabaseHas('posts', [
            'title' => 'Changing Post',
            'content' => '<h1>Changing the content for post</h1>'
        ]);
    }

    public function test_edit_post_title_validation()
    {
        $post = Posts::factory()->create();
        $user = User::factory()->create();

        $response = $this->actingAs($user)->put('/posts/' . $post->id, [
            'title' => null,
            'content' => '<h1>Testing this out</h1>'
        ]);

        $response->assertSessionHasErrors(['title']);
    }

    public function test_edit_post_content_validation()
    {
        $post = Posts::factory()->create();
        $user = User::factory()->create();

        $response = $this->actingAs($user)->put('/posts/' . $post->id, [
            'title' => 'Test title',
            'content' => null
        ]);

        $response->assertSessionHasErrors(['content']);
    }
}
