<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\BakedGood;

class SearchController extends Controller
{
    public function search(Request $request)
    {
        // Retrieve the search query from the request
        $query = $request->input('q');

        // Perform the search on the BakedGood model
        $results = BakedGood::search($query)->get(); // Ensure the search method is properly set up in your model

        // Return a JSON response with the search results
        return response()->json([
            'results' => $results->map(function($bakedGood) {
                return [
                    'name' => $bakedGood->name,
                    'price' => $bakedGood->price,
                    'description' => $bakedGood->description,
                ];
            })
        ]);
    }
}
