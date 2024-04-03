<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Project;
use App\Models\Type;
use Illuminate\Http\Request;

class TypeProjectController extends Controller
{
    public function __invoke(string $slug)
    {
        $type = Type::whereSlug($slug)->first();
        if(!$type) return response(null, 404);

        $projects = Project::whereTypeId($type->id)
        ->whereIsPublished(true)
        ->with('type', 'technologies')
        ->get();

        // $type->load('projects.type', 'projects.technologies');
        // $projects = $type->projects->where('is_published', 1);

        foreach($projects as $project)
        if($project->image) $project->image = url('storage/' . $project->image);

        return response()->json(['projects' => $projects, 'label' => $type->label]);
    }
}