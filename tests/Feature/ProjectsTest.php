<?php

namespace Tests\Feature;

use App\Models\Project;
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
    public function test_example(): void
    {
        $this->withExceptionHandling();

        // Create Project
        $attributes = [
            "title" => $this->faker->sentence,
            "description" => $this->faker->text
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

        $this->post('/projects', [])->assertSessionHasErrors(['title']);
    }

    /**
     * Description validation must required.
     */
    public function test_description_validation(): void
    {
        $this->withExceptionHandling();

        $this->post('/projects', [])->assertSessionHasErrors(['description']);
    }

    /**
     *
     */
    public function test_a_user_view_a_project()
    {
        $this->withExceptionHandling();

        $project = Project::factory(Project::class)->create();

        $this->get('/projects/' . $project->id)
            ->assertSee($project->title)
            ->assertSee($project->description);
    }
}
