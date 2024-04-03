<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Technology;
use App\Models\Project;

class TechnologyProjectController extends Controller
{
    public function __invoke(string $slug)
    {
        $technology = Technology::whereSlug($slug)->first();
        if(!$technology) return response(null, 404);

        $projects = Project::whereIsPublished(true)
        ->whereHas('technologies', function($query) use ($technology){
            $query->where('technologies.id', $technology->id);
        })
        ->get();

        return response()->json(['projects' => $projects, 'label' => $technology->label]);
    }
}
