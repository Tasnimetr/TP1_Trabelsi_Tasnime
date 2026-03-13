<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Review;
use OpenApi\Attributes as OA;

class ReviewController extends Controller
{
    #[OA\Delete(
        path: "/api/reviews/{id}",
        summary: "Supprimer une critique",
        description: "Supprimer une critique par ID",
        tags: ["Reviews"],
        parameters: [
            new OA\Parameter(
                name: "id",
                description: "Review ID",
                in: "path",
                required: true,
                schema: new OA\Schema(type: "integer")
            )
        ],
        responses: [
            new OA\Response(
                response: 204,
                description: "Review deleted successfully"
            ),
            new OA\Response(
                response: 404,
                description: "Review not found"
            )
        ]
    )]
    public function destroy($id){
        $review = Review::findOrFail($id);
        $review->delete();
        //source consultée: https://restfulapi.net/http-methods/#delete
        return response()->noContent();
    }
}
