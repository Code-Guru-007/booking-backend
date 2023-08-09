<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Api\BaseController as BaseController;

use Illuminate\Http\Request;
use App\Models\WidgetFlow;
use App\Models\WidgetProduct;
use Carbon\Carbon;

class WidgetProductController extends BaseController
{

    public function index($widget_id)
    {
        $success['widget_product'] = [];
        $widgetProducts = WidgetProduct::where(['widget_flow_id' => $widget_id])->get();
        foreach ($widgetProducts as $widgetProduct) {
            $widgetProduct->product;
            $success['widget_product'][] = $widgetProduct;
        }

        return $this->sendResponse($success, null);
    }
    
    public function fe_index($widget_id)
    {
        $success['widget_product'] = [];
        $widgetProducts = WidgetProduct::where(['widget_flow_id' => $widget_id])->get();
        foreach ($widgetProducts as $widgetProduct) {
            $widgetProduct->product;
            $success['widget_product'][] = $widgetProduct['product'];
        }

        return $this->sendResponse($success, null);
    }

    public function store(Request $request, $widget_id)
    {

        WidgetProduct::where(['id' => $request->id])
            ->update([
                'name'  => $request->name,
                'description'  => $request->description,
                'is_show' => 1,
            ]);
        $responseMessage = "Widget Product created successfully.";
        return $this->sendResponse([], $responseMessage);
    }

    public function getById($widget_id, $id)
    {
        $widgetProduct = WidgetProduct::whereId($id)->get()->first();
        if (!$widgetProduct) {
            $responseMessage = "The specified Widget Product does not exist";
            return $this->sendError($responseMessage, 500);
        }
        $success['widget_product'] = $widgetProduct;
        return $this->sendResponse($success, null);
    }
    
    public function fe_getById($widget_id, $id)
    {
        $widgetProduct = WidgetProduct::whereId($id)->get()->first();
        if (!$widgetProduct) {
            $responseMessage = "The specified Widget Product does not exist";
            return $this->sendError($responseMessage, 500);
        }
        $widgetProduct->product;
        $widgetProduct->product->equipmenttypes;
        $widgetProduct->product->availabilities;
        $widgetProduct->product->durations;
        $widgetProduct->product->prices;
        $widgetProduct->product->rentalQuestions;
        $success['widget_product'] = $widgetProduct->product;
        return $this->sendResponse($success, null);
    }

    public function update(Request $request, $widget_id, $id)
    {
        $user = auth()->user();

        $currentWidgetProduct = WidgetProduct::whereId($id)->get();

        if (!$currentWidgetProduct) {
            $responseMessage = "The specified Widget Flow does not exist or is not associated with the current team.";
            return $this->sendError($responseMessage, 500);
        }

        $widgetProduct = WidgetProduct::find($id);
        $widgetProduct->name = $request->name;
        $widgetProduct->description = $request->description;
        $widgetProduct->save();

        $sucess['widget_product'] = $widgetProduct;
        $responseMessage = "Current Widget Product updated successfully.";
        return $this->sendResponse($sucess, $responseMessage);
    }

    public function destroy($widget_id, $id)
    {
        $ids = explode(",", $id);
        $deleteWidgetProduct = WidgetProduct::whereIn('id', $ids)->update(['is_show' => 0]);

        if ($deleteWidgetProduct == 0) {
            $responseMessage = 'The specified Widget Product does not exist or is not associated with the current team.';
            return $this->sendError($responseMessage, 500);
        }
        $responseMessage = "Rental Widget Product deleted successfully.";
        return $this->sendResponse([], $responseMessage);
    }
}
