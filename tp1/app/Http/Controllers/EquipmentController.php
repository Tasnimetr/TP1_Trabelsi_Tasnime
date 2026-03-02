<?php

namespace App\Http\Controllers;

use App\Http\Resources\EquipmentResource;
use Illuminate\Http\Request;
use App\Models\Equipment;
use App\Models\Rental;
use App\Models\Review;
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

    public function popularity($id)
    {
        $equipment = Equipment::findOrFail($id);

        $totalNumberLocations = $equipment->rentals()->count();

        $rental = Rental::Where('equipment_id', $id)->first();

        if($rental) {
            $rentalId = $rental->id;
        } else {
            $rentalId = 0;
        }

        $averageRating = Review::where('rental_id', $rentalId)->avg('rating');

        $popularityIndex = ($totalNumberLocations * 0.6) + ($averageRating * 0.4);
        echo("L'indice de popularité est de " . $popularityIndex);
    }
} 