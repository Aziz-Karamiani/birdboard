<?php

namespace App\Http\Controllers;

use App\Models\Project;
use Illuminate\Contracts\Foundation\Application;
use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\View\View;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Routing\Redirector;
use Illuminate\Support\Facades\Auth;

class ProjectsController extends Controller
{

    /**
     * @return Application|Factory|View
     */
    public function index()
    {
        $projects = Auth::user()->projects;
        return view('projects.index', compact('projects'));
    }

    /**
     * @param Project $project
     * @return Application|Factory|View
     */
    public function show(Project $project)
    {
        if (auth()->id() !== $project->user->id) {
            abort(403);
        }

        return view('projects.show', compact('project'));
    }

    public function create()
    {
        return view('projects.create');
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

        $attributes['owner_id'] = auth()->id();

        // Store project
        Project::create($attributes);

        // Redirect to /projects
        return redirect('/projects');
    }
}
