<?php

use App\Models\Cat;
use App\Models\Shelter;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class CatControllerTest extends TestCase
{
    use RefreshDatabase;

    public function testGetCats()
    {
        $cats = Cat::factory()->count(5)->create();

        $response = $this->get('/api/cats');

        $response->assertStatus(200);

        $response->assertJsonCount($cats->count());

        $response->assertJson($cats->toArray());
    }

    public function testAddCatSuccess()
    {
        $shelter = Shelter::factory()->create();

        $response = $this->postJson('/api/cat/add', [
            'name' => 'Kitty',
            'shelter_id' => $shelter->id,
            'health' => 'Ok',
            'arrival' => '2023-06-13',
            'departure' => '2023-06-15',
        ]);

        $response->assertStatus(200)
            ->assertJson([
                'Request' => 'Cat data successfully created'
            ]);

        $this->assertDatabaseHas('cats', [
            'name' => 'Kitty',
            'shelter_id' => $shelter->id,
            'health' => 'Ok',
            'arrival' => '2023-06-13',
            'departure' => '2023-06-15',
        ]);
    }

    public function testAddCatValidationFailure()
    {
        $response = $this->postJson('/api/cat/add', []);

        $response->assertStatus(422)
            ->assertJsonValidationErrors([
                'name', 'shelter_id', 'health', 'arrival'
            ]);
    }

    public function testUpdateCatSuccess()
    {
        $cat = Cat::factory()->create();
        $shelter = Shelter::factory()->create();

        $response = $this->putJson('/api/cat/update', [
            'cat_id' => $cat->id,
            'name' => 'New Kitty',
            'shelter_id' => $shelter->id,
            'health' => 'Ok',
            'arrival' => '2023-06-13',
            'departure' => '2023-06-15',
        ]);

        $response->assertStatus(200)
            ->assertJson([
                'Request' => 'Cat data successfully updated'
            ]);

        $this->assertDatabaseHas('cats', [
            'id' => $cat->id,
            'name' => 'New Kitty',
            'shelter_id' => $shelter->id,
            'health' => 'Ok',
            'arrival' => '2023-06-13',
            'departure' => '2023-06-15',
        ]);
    }

    public function testUpdateCatNotFound()
    {
        $response = $this->putJson('/api/cat/update', [
            'name' => 'New Kitty',
            'shelter_id' => 1,
            'health' => 'Ok',
            'arrival' => '2023-06-13',
            'departure' => '2023-06-15',
        ]);

        $response->assertStatus(200)
            ->assertJson([
                'Error' => 'ID cat not found'
            ]);
    }

    public function testUpdateCatValidationFailure()
    {
        $cat = Cat::factory()->create();

        $response = $this->putJson('/api/cat/update', [
            'cat_id' => $cat->id,
            'name' => '',
            'shelter_id' => 'abc',
            'health' => 'Invalid',
            'arrival' => 'Invalid Date',
            'departure' => '2023-06-10',
        ]);

        $response->assertStatus(422)
            ->assertJsonValidationErrors([
                'name', 'shelter_id', 'health', 'arrival'
            ]);
    }

    public function testDeleteCat()
    {
        $cat = Cat::factory()->create();

        $response = $this->delete('/api/cat/delete', ['cat_id' => $cat->id]);

        $response->assertStatus(200);

        $this->assertDatabaseMissing('cats', ['id' => $cat->id]);
    }
}
