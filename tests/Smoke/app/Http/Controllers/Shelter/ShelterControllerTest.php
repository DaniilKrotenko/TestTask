<?php

use App\Models\Shelter;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class ShelterControllerTest extends TestCase
{
    use RefreshDatabase;

    public function testGetShelters(): void
    {
        Shelter::factory()->count(5)->create();

        $response = $this->getJson('/api/shelters');

        $response->assertStatus(200);

        $shelters = Shelter::all();
        $response->assertJsonCount($shelters->count());

        $response->assertJson($shelters->toArray());
    }

    public function testUpdateShelter(): void
    {
        $shelter = Shelter::factory()->create();

        $updateData = [
            'shelter_id' => $shelter->id,
            'name' => 'Updated Shelter Name',
            'address' => 'Updated Shelter Address',
        ];

        $response = $this->post('/api/shelter/update', $updateData);

        $response->assertStatus(200);

        $this->assertDatabaseHas('shelters', [
            'id' => $shelter->id,
            'name' => 'Updated Shelter Name',
            'address' => 'Updated Shelter Address',
        ]);
    }

    public function testAddShelter(): void
    {
        $shelterData = [
            'name' => 'New Shelter Name',
            'address' => 'New Shelter Address',
        ];

        $response = $this->post('/api/shelter/add', $shelterData);

        $response->assertStatus(200);

        $this->assertDatabaseHas('shelters', $shelterData);
    }

    public function testDeleteShelter(): void
    {
        $shelter = Shelter::factory()->create();

        $response = $this->delete('/api/shelter/delete', ['shelter_id' => $shelter->id]);

        $response->assertStatus(200);

        $this->assertDatabaseMissing('shelters', ['id' => $shelter->id]);
    }

}
