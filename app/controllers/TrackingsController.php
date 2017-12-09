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
            $day = Input::get('day');
            $tracking = new Tracking();
            $tracking->user_id = Auth::user()->id;
            $tracking->project_id = $project->id;
            $tracking->from = $day . ' ' . Input::get('from');
            $tracking->to = $day . ' ' . Input::get('to');
            $tracking->save();

            $this->json(['tracking' => $tracking]);
        }
        else
        {
            http_response_code(401);
            $this->json(['error' => 'Unauthorized']);
        }
    }

    public function day()
    {
        $day = Input::get('day');

        $trackings = Tracking::where('user_id', Auth::user()->id)->whereDate('from', '=', $day)->get();

        $this->json($trackings);
    }
}