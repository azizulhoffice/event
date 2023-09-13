<?php

use App\Models\Participant;

function isActive($path, $active = 'active menu-open')
{
    return call_user_func_array('Request::is', (array)$path) ? $active : '';
}
function isPublished($event_id)
{
    $participant_scores = Participant::where('event_id',$event_id)
    ->where('rank','>','0')
    ->orWhere('rank','!=',null)
    ->orWhere('avg_score' ,'!=',null)
    ->orWhere('avg_score' ,'>','0')
    ->get();
   return count($participant_scores) > 0? true : false;
}
