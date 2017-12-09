<?php
/**
 * Created by PhpStorm.
 * User: gavlak
 * Date: 06/02/17
 * Time: 13:01
 */

namespace App\Controllers;

use App\Core\Auth;
use App\Core\Input;
use App\Models\Project;

class ProjectsController extends Controller
{
    public function index()
    {
        $projects = Project::where('user_id', Auth::user()->id)->get();
        return json($projects);
    }

    public function show()
    {
        $project = Project::find(Input::get('id'));

        if (Auth::user()->id === $project->user_id)
            return json($project);
        else {
          http_response_code(401);
          return json(['error' => 'unauthorized']);
        }
    }

    public function create()
    {
        $project = new Project();
        $project->fill(Input::all());
        $project->user_id = Auth::user()->id;
        var_dump($project->save());
        json($project);
    }

    public function update()
    {
        $project = Project::find(Input::get('id'));

        if ($this->userOwns($project))
        {
            $project->fill(Input::all());
            $project->save();
            $this->json($project);
        }
        else
        {
            http_response_code(401);
            $this->json(['error' => 'Unauthorized']);
        }
    }

    public function destroy()
    {
        $project = Project::find(Input::get('id'));

        if ($this->userOwns($project))
        {
            Project::destroy($project->id);
            json($project);
        }
        else
        {
            http_response_code(401);
            $this->json(['error' => 'Unauthorized']);
        }
    }
}
