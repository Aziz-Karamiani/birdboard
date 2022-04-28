<?php

namespace Tests\Unit;

use App\Models\Project;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Support\Collection;
use Tests\TestCase;

class ProjectTest extends TestCase
{
    use RefreshDatabase, WithFaker;
    /**
     * A basic unit test example.
     *
     * @return void
     */
    public function test_example()
    {
        $project = Project::factory(Project::class)->create();

        $this->assertEquals('/projects/'. $project->id, $project->path());
    }

    /**
     *  Project belongsTo user
     */
    public function test_project_belongs_to_user(): void
    {
        $user = User::factory(User::class)->create();
        $this->assertInstanceOf(Collection::class, $user->projects);
    }
}
