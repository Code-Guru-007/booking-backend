<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Api\BaseController as BaseController;
use App\Models\RentalProducts;
use App\Models\TeamUser;
use Illuminate\Http\Request;
use App\Models\WidgetFlow;
use App\Models\WidgetProduct;
use Carbon\Carbon;

class WidgetFlowController extends BaseController
{

    public function index()
    {
        $user = auth()->user();
        $invitedTeams = TeamUser::where('user_id', $user->id)->get();
        $allTeams[0] = $user->current_team_id;
        foreach ($invitedTeams as $invitedTeam) {
            $allTeams[] = $invitedTeam->team_id;
        }
        $success['widget_flows']=[];
        $widget_flows = WidgetFlow::whereIn('team_id', $allTeams)->get();
        foreach ($widget_flows as $widget_flow) {
            $widgetProducts = $widget_flow->widgetProducts;
            $widget_flow->widgetGifts;
            foreach ($widgetProducts as $widgetProduct) {
                $widgetProduct->product;
            }
            $success['widget_flows'] = $widget_flow;
        }
        return $this->sendResponse($success, null);
    }

    public function store(Request $request)
    {

        $widget_flow = new WidgetFlow();
        $widget_flow->name = $request->name;
        $widget_flow->description = $request->description;
        $widget_flow->is_show = 1;
        $widget_flow->save();

        $rentalProducts = RentalProducts::all();
        foreach ($rentalProducts as $rentalProduct) {
            $widgetProduct = new WidgetProduct();
            $widgetProduct->product_id = $rentalProduct->id;
            $widgetProduct->widget_flow_id = $widget_flow->id;
            $widgetProduct->name = $rentalProduct->name;
            $widgetProduct->description = $rentalProduct->description;
            $widgetProduct->is_show = 0;
            $widgetProduct->save();
        }
        $responseMessage = "Widget Flow created successfully.";



        return $this->sendResponse([], $responseMessage);
    }

    public function getById($id)
    {
        $widget_flow = WidgetFlow::find($id);
        if (!$widget_flow) {
            $responseMessage = "The specified Widget Flow does not exist";
            return $this->sendError($responseMessage, 500);
        }
        $widgetProducts = $widget_flow->widgetProducts;
        $widget_flow->widgetGifts;
        foreach ($widgetProducts as $widgetProduct) {
            $widgetProduct->product;
        }
        $success['widget_flow'] = $widget_flow;
        return $this->sendResponse($success, null);
    }

    public function update(Request $request, $id)
    {

        $currentWidgetFlow = WidgetFlow::whereId($id)->get();

        if (!$currentWidgetFlow) {
            $responseMessage = "The specified Widget Flow does not exist or is not associated with the current team.";
            return $this->sendError($responseMessage, 500);
        }

        $widget_flow = WidgetFlow::find($id);
        $widget_flow->name = $request->name;
        $widget_flow->description = $request->description;
        $widget_flow->is_show = $request->is_show;
        $widget_flow->save();

        $sucess['widget_flow'] = $widget_flow;
        $responseMessage = "Current Widget Flow updated successfully.";
        return $this->sendResponse($sucess, $responseMessage);
    }

    public function destroy($id)
    {
        $ids = explode(",", $id);
        $deleteWidgetFlow = WidgetFlow::whereIn('id', $ids)->delete();

        if ($deleteWidgetFlow == 0) {
            $responseMessage = 'The specified Widget Flow does not exist or is not associated with the current team.';
            return $this->sendError($responseMessage, 500);
        }
        $responseMessage = "Rental Widget Flow deleted successfully.";
        return $this->sendResponse([], $responseMessage);
    }
}
