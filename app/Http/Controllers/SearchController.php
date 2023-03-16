<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Helper\SearchService;

class SearchController extends Controller
{
    public function index(Request $request, SearchService $searchService)
    {
        $validated = $request->validate(['search' => 'required']);
        $result = $searchService->searchTask($validated['search']);
        $searchResult = $result === false ? collect() : $result;
        return view('user.search', ['result' => $searchResult, 'search' => $validated['search']]);
    }
}
