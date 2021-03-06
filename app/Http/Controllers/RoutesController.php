<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Route;
use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\ValidationException;

class RoutesController extends Controller
{

    public function createRoute(Request $request){
        try {
            $validator = validator::make($request->all(), [
                "r_number" => "required",
                "r_des" => "required",
                "distance" => "required",
                "amount" => "required"
            ]);
            if($validator->fails()){
                return response()->json(['message' => 'local passenger validation fails']);    
            }else {
                $route = Route::getRoute();
                $route->r_number = request('r_number');
                $route->r_des = request('r_des');
                $route->distance = request('distance');
                $route->amount = request('amount');
                $route->save();

                return $route;
            }
        } catch (Exception $e) {
            return response()->json(['message' => 'Something went wrong', 'error' => $e], 500);
        }
    }

}
