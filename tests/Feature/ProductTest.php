<?php

namespace Tests\Feature;

use App\Models\Category;
use App\Models\Product;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Http\UploadedFile;
use Illuminate\Support\Facades\Storage;
use Tests\TestCase;

class ProductTest extends TestCase
{
    use RefreshDatabase;

    public function test_new_product_store()
    {
        $category = Category::factory()->create();
        $file = UploadedFile::fake()->image('image.jpg', 1, 1);
        Storage::fake('public/storage/images');

        $this->post(route('product.store'), [
            'name' => 'test product',
            'status' => 'active',
            'image' =>  $file,
            'category' => array($category->id),
        ])
            ->assertRedirect(route('index'));
        $productId = Product::query()->value('id');

        $this->assertDatabaseCount(Product::class, 1);

        $this->assertDatabaseHas(Product::class, [
            'name' => 'test product',
            'status' => 'active',
            'image' => $file->hashName(),
        ]);

        $this->assertDatabaseHas('category_product',[
            'product_id' => $productId,
            'category_id' => $category->id,
        ]);
    }

    public function test_product_index()
    {
        Product::factory()
            ->count(5)
            ->sequence(fn($sequence) => ['name' => 'Product ' . $sequence->index])
            ->create();

        $this->get(route('index'))
            ->assertSeeText(['Product 0', 'Product 1', 'Product 2', 'Product 3']);

        $this->get(route('index', [
            'products' => 2,
        ]))
            ->assertSeeText('Product 4')
            ->assertDontSeeText('Product 3');
    }

    public function test_product_update()
    {
        $category = Category::factory()->create();
        $product = Product::factory()->create();
        $file = UploadedFile::fake()->image('photo1.jpg');
        Storage::fake('public/storage/images');

        $this->put(route('product.update', $product->id), [
            'id' => $product->id,
            'name' => 'updated product',
            'status' => 'inactive',
            'image' => $file,
            'category' => array($category->id),
        ])
            ->assertRedirect(route('index'));

        $this->assertDatabaseHas(product::class, [
            'id' => $product->id,
            'name' => 'updated product',
            'status' => 'inactive',
            'image' => $file->hashName(),
        ]);

        $this->assertDatabaseHas('category_product',[
            'product_id' => $product->id,
            'category_id' => $category->id,
        ]);
    }

    public function test_product_delete()
    {
        $product = Product::factory()->create();
        $this->delete(route('product.destroy', $product))
            ->assertRedirect(route('index'));

        $this->assertDatabaseMissing(Product::class, ['id' => $product->id]);
    }
}
