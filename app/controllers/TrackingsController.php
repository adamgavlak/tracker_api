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
use App\Models\Tracking;

class TrackingsController extends Controller
{

    public function create()
    {
        $project = Project::find(Input::get('id'));

        if ($this->userOwns($project))
        {
            $tracking = new Tracking();
            $tracking->fill(Input::all());
            $tracking->user_id = Auth::user()->id;
            $tracking->project_id = $project->id;
            $tracking->save();

            $this->json($tracking);
        }
        else
        {
            http_response_code(401);
            $this->json(['error' => 'Unauthorized']);
        }
    }

    public function update()
    {
        $tracking = Tracking::find(Input::get('id'));

        if ($this->userOwns($tracking))
        {
            $tracking->fill(Input::all());

            if (Input::has('project_id')) {
                $project = Project::find(Input::get('project_id'));

                if ($this->userOwns($project))
                {
                    $tracking->project_id = Input::get('project_id');
                }
            }

            $tracking->save();
            $this->json($tracking);
        }
    }

    public function destroy()
    {
        $tracking = Tracking::find(Input::get('id'));

        if ($this->userOwns($tracking))
        {
            Tracking::destroy($tracking->id);
        }
    }

    public function day()
    {
        $day = Input::get('day');

        $trackings = Tracking::where('user_id', Auth::user()->id)->whereDate('day', '=', $day)->get();

        $this->json($trackings);
    }
}