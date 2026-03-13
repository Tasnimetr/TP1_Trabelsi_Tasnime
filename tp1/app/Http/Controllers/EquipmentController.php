<?php

namespace App\Http\Controllers;

use App\Http\Resources\EquipmentResource;
use Illuminate\Http\Request;
use App\Models\Equipment;
use App\Models\Rental;
use App\Models\Review;
use Exception;
use Illuminate\Database\QueryException;
use OpenApi\Attributes as OA;

class EquipmentController extends Controller
{
    #[OA\Get(
        path: "/api/equipment",
        summary: "Liste de tous les equipment",
        tags: ["Equipment"],
        responses: [
            new OA\Response(
                response: "200",
                description: "OK"
            )
        ]
    )]
    public function index()
    {
        try {
            return EquipmentResource::collection(Equipment::all())->response()->setStatusCode(200);
        } catch (Exception $e) {
            abort(500, 'Server error');
        }
    }

    #[OA\Get(
        path: "/api/equipment/{id}",
        summary: "Afficher un équipement",
        tags: ["Equipment"],
        parameters: [
            new OA\Parameter(
                name: "id",
                description: "Equipment ID",
                in: "path",
                required: true,
                schema: new OA\Schema(type: "integer")
            )
        ],
        responses: [
            new OA\Response(
                response: "200",
                description: "OK"
            ),
            new OA\Response(
                response: "404",
                description: "Équipement non trouvé"
            )
        ]
    )]
    public function show($id)
    {
        try {
            return (new EquipmentResource(Equipment::findOrFail($id)))->response()->setStatusCode(200);
        } catch (QueryException $ex) {
            abort(404, "Invalid Id");
        } catch (Exception $ex) {
            abort(500, "server error");
        }
    }

    #[OA\Get(
        path: "/api/equipment/{id}/popularity",
        summary: "Afficher indice de popularité d'un équipement",
        tags: ["Equipment"],
        parameters: [
            new OA\Parameter(
                name: "id",
                description: "Equipment ID",
                in: "path",
                required: true,
                schema: new OA\Schema(type: "integer")
            )
        ],
        responses: [
            new OA\Response(
                response: "200",
                description: "OK"
            )
        ]
    )]
    public function popularity($id)
    {
        $equipment = Equipment::findOrFail($id);

        $totalNumberLocations = $equipment->rentals()->count();

        $rental = Rental::Where('equipment_id', $id)->first();

        if ($rental) {
            $rentalId = $rental->id;
        } else {
            $rentalId = 0;
        }

        $averageRating = Review::where('rental_id', $rentalId)->avg('rating');

        $popularityIndex = ($totalNumberLocations * 0.6) + ($averageRating * 0.4);
        echo ("L'indice de popularité est de " . $popularityIndex);
    }

    #[OA\Get(
        path: "/api/equipment/{id}/average_price",
        summary: "Afficher moyenne du prix total de location d’un équipement",
        tags: ["Equipment"],
        parameters: [
            new OA\Parameter(
                name: "id",
                description: "Equipment ID",
                in: "path",
                required: true,
                schema: new OA\Schema(type: "integer")
            ),
            new OA\Parameter(
                name: "minDate",
                description: "Minimum date",
                in: "query",
                required: false,
                schema: new OA\Schema(type: "date", default: "2020-01-01")
            ),
            new OA\Parameter(
                name: "maxDate",
                description: "Maximum date",
                in: "query",
                required: false,
                schema: new OA\Schema(type: "date", default:"2026-03-01")
            )
        ],
        responses: [
            new OA\Response(
                response: "200",
                description: "OK"
            ),
            new OA\Response(
                response: "400",
                description: "minDate doit être inférieur à maxDate"
            )
        ]
    )]
    public function averagePrice(Request $request, $id)
    {
        $minDate = $request->input('minDate');
        $maxDate = $request->input('maxDate');

        if ($minDate && $maxDate) {
            if ($minDate > $maxDate) {
                echo ("minDate doit être inférieur à maxDate");
                return;
            }
        }

        $location = Rental::where('equipment_id', $id);

        if ($minDate) {
            $location->where('startDate', '>=', $minDate);
        }

        if ($maxDate) {
            $location->where('startDate', '<=', $maxDate);
        }

        $averagePrice = $location->avg('totalPrice') ?? 0;
        echo ('La moyenne du prix total de location de cet équipement est de: ' . $averagePrice);
    }
}
