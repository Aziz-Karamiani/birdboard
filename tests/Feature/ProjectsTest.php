<?php

namespace Tests\Feature;

use App\Models\Project;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class ProjectsTest extends TestCase
{
    use WithFaker, RefreshDatabase;

    /**
     * A basic feature test example.
     *
     * @return void
     */
    public function test_create_project(): void
    {
        $this->withExceptionHandling();        $this->withExceptionHandling();

        $this->loginUser();

        $this->get('/projects/create')->assertStatus(200);

        // Create Project
        $attributes = [
            "title" => $this->faker->sentence,
            "description" => $this->faker->text,
            "owner_id" => auth()->id()
        ];

        // Assert Database
        $this->post('/projects', $attributes)->assertRedirect('/projects');
        $this->assertDatabaseHas("projects", $attributes);

        // Assert View
        $this->get('/projects')->assertStatus(200);
        $this->get('/projects')->assertSee($attributes["title"]);
    }

    /**
     * Title validation must required.
     */
    public function test_title_validation(): void
    {
        $this->withExceptionHandling();

        $this->loginUser();

        $this->post('/projects', [])->assertSessionHasErrors(['title']);
    }

    /**
     * Description validation must required.
     */
    public function test_description_validation(): void
    {
        $this->withExceptionHandling();

        $this->loginUser();

        $this->post('/projects', [])->assertSessionHasErrors(['description']);
    }

    /**
     *
     */
    public function test_a_user_view_a_project()
    {
        $user = User::factory()->create();
        $this->be($user);

        $this->withExceptionHandling();

        $project = Project::factory(Project::class)->create(['owner_id' => auth()->id()]);

        $this->get($project->path())
            ->assertSee($project->title)
            ->assertSee($project->description);
    }

    /**
     *
     */
    public function test_authenticated_user_cannot_view_other_user_project()
    {
        $user = User::factory()->create();
        $this->be($user);

        $this->withExceptionHandling();

        $project = Project::factory(Project::class)->create();

        $this->get($project->path())->assertStatus(403);
    }

    /**
     * Owner for project
     */
    public function test_authenticated_user_can_create_project(): void
    {
        $attributes = Project::factory()->raw(['owner_id' => null]);

        $this->get('/projects/create')->assertRedirect('/login');
        $this->post('/projects', $attributes)->assertRedirect('/login');

    }

    /**
     * Login user
     */
    public function loginUser(): void
    {
        $user = User::factory()->create();
        $this->actingAs($user);
    }
}
