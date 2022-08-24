<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;
use App\Models\Category;

class CategoryTest extends TestCase
{
    use RefreshDatabase;

    public function test_new_category_store()
    {
        $this->post(route('category.store'), [
            'name' => 'test category',
            'status' => 'active',
        ])
            ->assertRedirect(route('index'));

        $this->assertDatabaseCount(Category::class, 1);
        $this->assertDatabaseHas(Category::class, [
            'name' => 'test category',
            'status' => 'active',
        ]);
    }

    public function test_category_index()
    {
        Category::factory()
            ->count(5)
            ->sequence(fn($sequence) => ['name' => 'Name ' . $sequence->index])
            ->create();

        $this->get(route('index'))
            ->assertSeeText(['Name 0', 'Name 1', 'Name 2', 'Name 3']);

        $this->get(route('index', [
            'categories' => 2,
        ]))
            ->assertSeeText('Name 4')
            ->assertDontSeeText('Name 3');
    }

    public function test_category_update()
    {
        $category = Category::factory()->create();
        $this->put(route('category.update', $category->id), [
            'name' => 'updated category',
            'status' => 'inactive',
        ])
            ->assertRedirect(route('index'));

        $this->assertDatabaseHas(Category::class, [
            'id' => $category->id,
            'name' => 'updated category',
            'status' => 'inactive'
        ]);
    }

    public function test_category_delete()
    {
        $category = Category::factory()->create();
        $this->delete(route('category.destroy', $category))
            ->assertRedirect(route('index'));

        $this->assertDatabaseMissing(Category::class, ['id' => $category->id]);
    }
}
