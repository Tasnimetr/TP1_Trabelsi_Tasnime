<?php

namespace App\Http\Controllers;

use App\Http\Resources\EquipmentResource;
use Illuminate\Http\Request;
use App\Models\Equipment;
use Exception;
use Illuminate\Database\QueryException;

class EquipmentController extends Controller
{
    public function index()
    {
        try
        {
            return EquipmentResource::collection(Equipment::all())->response()->setStatusCode(200);
        }
        catch (Exception $e)
        {
            abort(500, 'Server error');
        }
    }

    public function show($id)
    {
        try
        {
            return (new EquipmentResource(Equipment::findOrFail($id)))->response()->setStatusCode(200);
        }
        catch (QueryException $ex)
        {
            abort(404, "Invalid Id");
        }
        catch (Exception $ex)
        {
            abort(500, "server error");
        }
    }
}