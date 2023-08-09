<?php

namespace App\Http\Controllers\Api;

use Illuminate\Http\Request;
use App\Http\Controllers\Api\BaseController as BaseController;
use App\Models\Option;
use App\Models\TeamUser;
use Carbon\Carbon;

class OptionController extends BaseController
{
    public function index()
    {
        $user = auth()->user();
        $success['option'] = [];
        $teamOption = Option::find($user->current_team_id);
        if (!$teamOption) {
            $responseMessage = "The specified Rental Product advance does not exist or is not associated with the current team.";
            return $this->sendError($responseMessage, 500);
        }
        $success['option'] = [
            'advance' => $teamOption->advance,
            'now_datetime' => Carbon::now(),
            'now_stop_datetime' => Carbon::now()->addHours($teamOption->advance),
            'updated_datetime' => Carbon::parse($teamOption->updated_at),
            'updated_stop_datetime' => Carbon::parse($teamOption->updated_at)->addHours($teamOption->advance),
        ];
        return $this->sendResponse($success, null);
    }

    public function store(Request $request)
    {
        $user = auth()->user();
        $invitedTeams = TeamUser::where('user_id', $user->id)->get();
        $allTeams[0] = $user->current_team_id;
        foreach ($invitedTeams as $invitedTeam) {
            $allTeams[] = $invitedTeam->team_id;
        }
        Option::whereIn('team_id', $allTeams)->update([
                'advance' => $request->advance
            ]);
        $responseMessage = "Rental Product advance updated successfully.";
        return $this->sendResponse([], $responseMessage);
    }
}
