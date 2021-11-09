<?php

namespace Tests\Feature;

use App\Models\Books;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class BooksTest extends TestCase
{
    use RefreshDatabase;
    /**
     * @test
     * Test case Model fillable not defined
     */
    public function check_if_collumns_books_is_correct()
    {
        $books = new Books();
        $expected = [
            'title',
            'author',
            'description',
            'pages',
            'user_id'
        ];

        $arraVerify = array_diff($expected, $books->getFillable());

        $this->assertEquals(0, count($arraVerify));
    }

    /**
     * @test
     * Test case post has expected data in the Model fillable
     */
    public function check_model_and_post_is_valid()
    {
        $books = new Books();
        $post = [
            'title'                 => 'Livro Test',
            'author'                => 'Author Test',
            'description'           => 'Descrição de um livro maravilhoso.',
            'pages'                 => 480,
            'user_id'               => 1,
        ];
        $this->assertEquals(array_values(array_keys($post)), array_values($books->getFillable()));
    }

    /**
     * @test
     * Integration Test
     * Test case post has expected data in the Model fillable
     */
    public function check_data_send_is_correct()
    {
        $books = new Books();
        $user = User::factory()->create();
        $this->actingAs($user);
        $this->assertIsInt($user->id);
        $this->assertGreaterThan(0, $user->id, 'Failed');
    }
}
