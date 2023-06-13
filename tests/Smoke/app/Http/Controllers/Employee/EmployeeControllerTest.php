<?php

use App\Models\Employee;
use App\Models\Shelter;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class EmployeeControllerTest extends TestCase
{
    use RefreshDatabase;
    use WithFaker;

    public function testGetEmployees(): void
    {
        $employees = Employee::factory()->count(5)->create();

        $response = $this->get('/api/employees');

        $response->assertStatus(200);

        $response->assertJsonCount($employees->count());

        $response->assertJson($employees->toArray());
    }

    public function testAddEmployeeSuccess()
    {
        $shelter = Shelter::factory()->create();

        $response = $this->postJson('/api/employee/add', [
            'name' => 'John Doe',
            'shelter_id' => $shelter->id,
            'position' => 'Manager',
            'email' => 'john.doe@test.com',
            'birthday' => '1990-01-01',
        ]);

        $response->assertStatus(200)
            ->assertJson([
                'Request' => 'Employee successfully created'
            ]);

        $responseData = $response->decodeResponseJson();

        $this->assertDatabaseHas('employees', [
            'name' => 'John Doe',
            'shelter_id' => $shelter->id,
            'position' => 'Manager',
            'email' => 'john.doe@test.com',
            'birthday' => '1990-01-01',
        ]);
    }

    public function testAddEmployeeValidationFailure()
    {
        $response = $this->postJson('/api/employee/add', [
            'name' => '', // Invalid name
            'shelter_id' => 'abc', // Invalid shelter_id
            'position' => 'Em', // Invalid position
            'email' => 'invalid_email', // Invalid email
            'birthday' => 'Invalid Date', // Invalid birthday
        ]);

        $response->assertStatus(422)
            ->assertJsonValidationErrors([
                'name', 'shelter_id', 'position', 'email', 'birthday'
            ]);
    }

    public function testUpdateEmployeeSuccess()
    {
        $employee = Employee::factory()->create();
        $shelter = Shelter::factory()->create();

        $response = $this->postJson('/api/employee/update', [
            'employee_id' => $employee->id,
            'name' => 'Updated Employee',
            'shelter_id' => $shelter->id,
            'position' => 'Manager',
            'email' => 'updated@test.com',
            'birthday' => '1990-01-01',
        ]);

        $response->assertStatus(200)
            ->assertJson([
                'Request' => 'Employee successfully updated'
            ]);

        $this->assertDatabaseHas('employees', [
            'id' => $employee->id,
            'name' => 'Updated Employee',
            'shelter_id' => $shelter->id,
            'position' => 'Manager',
            'email' => 'updated@test.com',
            'birthday' => '1990-01-01',
        ]);
    }

    public function testUpdateEmployeeNotFound()
    {
        $employee = Employee::factory()->create();
        $shelter = Shelter::factory()->create();

        $response = $this->postJson('/api/employee/update', [
            'employee_id' => $employee->id, // Верный идентификатор сотрудника
            'name' => 'Updated Employee',
            'shelter_id' => $shelter->id, // Верный идентификатор приюта
            'position' => 'Manager',
            'email' => 'updated@test.com', // Действительный адрес электронной почты
            'birthday' => '1990-01-01',
        ]);

        $response->assertStatus(200)
            ->assertJson([
                'Request' => 'Employee successfully updated'
            ]);
    }

    public function testDeleteEmployee(): void
    {
        $employee = Employee::factory()->create();

        $response = $this->delete('/api/employee/delete', ['employee_id' => $employee->id]);

        $response->assertStatus(200);

        $this->assertDatabaseMissing('employees', ['id' => $employee->id]);
    }
}
