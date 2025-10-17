<?php

namespace Tests\Feature;

use Tests\TestCase;
use App\Models\User;
use App\Models\Project;
use Illuminate\Foundation\Testing\RefreshDatabase;

class ApiProjectTest extends TestCase
{
    use RefreshDatabase;

    protected $admin;
    protected $user;

    protected function setUp(): void
    {
        parent::setUp();

        // Create users
        $this->admin = User::factory()->create(['role' => 'admin']);
        $this->user = User::factory()->create(['role' => 'user']);
    }

    /** @test */
    public function login_returns_token()
    {
        User::factory()->create([
            'name' => 'Test User',
            'email' => 'test@example.com',
            'password' => bcrypt('password'),
            'role' => 'admin',
        ]);

        $response = $this->postJson('/api/v1/login', [
            'email' => 'test@example.com',
            'password' => 'password'
        ]);

        $response->assertStatus(200)->assertJsonStructure([
            'message',
            'auth_token',
            'token_type'
        ]);
    }

    /** @test */
    public function authenticated_user_can_list_projects()
    {
        $user = User::factory()->create(['role' => 'user']);
        $admin = User::factory()->create(['role' => 'admin']);

        // Create projects
        Project::factory()->count(2)->create(['user_id' => $user->id]);
        Project::factory()->count(3)->create(['user_id' => $admin->id]);

        // Authenticate as $user
        $token = $user->createToken('api-token')->plainTextToken;

        $response = $this->withHeader('Authorization', 'Bearer ' . $token)->getJson('/api/v1/projects');

        $response->assertStatus(200)
            ->assertJson([
                'message' => 'Success!',
            ])
            ->assertJsonCount(2, 'data');

        $response->assertJsonStructure([
            'message',
            'data' => [
                '*' => [
                    'id',
                    'title',
                    'description',
                    'deadline',
                    'progress',
                    'owner' => [
                        'id', 'name', 'email', 'role'
                    ],
                    'tasks' => [
                        '*' => [
                            'id', 'title', 'status', 'deadline', 'assigned_to', 'created_at'
                        ]
                    ]
                ]
            ]
        ]);
    }


    /** @test */
    public function user_can_create_project()
    {
        $token = $this->user->createToken('api-token')->plainTextToken;

        $response = $this->withHeader('Authorization', 'Bearer ' . $token)
            ->postJson('/api/v1/projects/store', [
                'title' => 'API Project',
                'description' => 'Project created via API',
                'deadline' => now()->addDays(10)->format('Y-m-d'),
            ]);

        $response->assertStatus(200)
                 ->assertJson([
                     'message' => 'Project created successfully!',
                     'data' => [
                         'title' => 'API Project',
                         'description' => 'Project created via API',
                     ]
                 ]);

        $this->assertDatabaseHas('projects', [
            'title' => 'API Project',
            'user_id' => $this->user->id
        ]);
    }

    /** @test */
    public function user_can_view_single_project()
    {
        $project = Project::factory()->create(['user_id' => $this->user->id]);
        $token = $this->user->createToken('api-token')->plainTextToken;

        $response = $this->withHeader('Authorization', 'Bearer ' . $token)
                         ->getJson("/api/v1/projects/{$project->id}");

        $response->assertStatus(200)
                 ->assertJson([
                     'message' => 'Project retrieved successfully!',
                     'data' => [
                         'id' => $project->id,
                         'title' => $project->title
                     ]
                 ]);
    }

    /** @test */
    public function user_can_update_project()
    {
        $project = Project::factory()->create(['user_id' => $this->user->id]);
        $token = $this->user->createToken('api-token')->plainTextToken;

        $response = $this->withHeader('Authorization', 'Bearer ' . $token)
                         ->putJson("/api/v1/projects/{$project->id}", [
                             'title' => 'Updated API Project',
                             'description' => 'Updated description',
                             'deadline' => now()->addDays(15)->format('Y-m-d'),
                         ]);

        $response->assertStatus(200)
                 ->assertJson([
                     'message' => 'Project updated successfully!',
                     'data' => [
                         'title' => 'Updated API Project'
                     ]
                 ]);

        $this->assertDatabaseHas('projects', [
            'id' => $project->id,
            'title' => 'Updated API Project'
        ]);
    }

    /** @test */
    public function user_can_delete_project()
    {
        $project = Project::factory()->create(['user_id' => $this->user->id]);
        $token = $this->user->createToken('api-token')->plainTextToken;

        $response = $this->withHeader('Authorization', 'Bearer ' . $token)
                         ->deleteJson("/api/v1/projects/{$project->id}");

        $response->assertStatus(200)
                 ->assertJson([
                     'message' => 'Project deleted successfully!'
                 ]);

        $this->assertSoftDeleted('projects', ['id' => $project->id]);
    }

    /** @test */
    public function unauthenticated_user_cannot_access_projects()
    {
        $response = $this->getJson('/api/v1/projects');
        $response->assertStatus(401);
    }
}
