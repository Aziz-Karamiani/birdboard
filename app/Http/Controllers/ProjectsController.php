<?php

namespace App\Http\Controllers;

use App\Models\Project;
use Illuminate\Contracts\Foundation\Application;
use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\View\View;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Routing\Redirector;

class ProjectsController extends Controller
{

    /**
     * @return Application|Factory|View
     */
    public function index()
    {
        $projects = Project::all();
        return view('projects.index', compact('projects'));
    }

    /**
     * @param Project $project
     * @return Application|Factory|View
     */
    public function show(Project $project)
    {
        return view('projects.show', compact('project'));
    }

    /**
     * Store Project
     * @param Request $request
     * @return Application|RedirectResponse|Redirector
     */
    public function store(Request $request): Redirector|Application|RedirectResponse
    {
        // Validation
        $request->validate(["title" => "required", "description" => "required"]);

        // get request data
        $attributes = request(["title", "description"]);

        // Store project
        Project::create($attributes);

        // Redirect to /projects
        return redirect('/projects');
    }
}
