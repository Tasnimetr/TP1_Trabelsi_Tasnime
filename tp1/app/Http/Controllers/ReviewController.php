<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Review;

class ReviewController extends Controller
{
    public function destroy($id){
        $review = Review::findOrFail($id);
        $review->delete();
        //source consultée: https://restfulapi.net/http-methods/#delete
        return response()->noContent();
    }
}
