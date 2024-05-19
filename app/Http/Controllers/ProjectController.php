<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Project;



class ProjectController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $projects = Project::all();
        return response()->json($projects);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $data = $request->validate([
            "name" => 'required|string',
            "desc" => 'required|string',
            "image" => 'required|image',
        ]);
        $project = new Project;
        $project->name = $data['name'];
        $project->desc = $data['desc'];

        if($data["image"]){
            $image = $data["image"];
            $imageName = time() .'.' . $image->getClientOriginalExtension();
            $image->move(public_path('images'), $imageName );
            $project->image = $imageName;
        }
        $project->save();
        return response(["msg" => "project add succissfuly", 201]);
    }

    /**
     * Display the specified resource.
     */
    public function show(Project $project)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Project $project)
    {
        $data = $request->validate([
            "name" => 'nullable|string',
            "desc" => 'nullable|string',
            "image" => 'image',
        ]);
        if($project){
            if($data["image"]){
                $image = $data["image"];
                $imageName = time() .'.' . $image->getClientOriginalExtension();
                $image->move(public_path('images'), $imageName );
                $image = $imageName;
            }
            else{
                $image = $project->image;
            }
            $project->update([
                'name' => $data['name'],
                'desc' => $data['desc'],
                'image' => $image,

            ]);
            return response(["msg" => "project update succissfuly", 201]);

        }
        return response(["msg" => "project ddnt exist ", 401]);

    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Project $project)
    {
        $project->delete();
        return response()->json([
            'status' => 'deleted success', 401
        ]);
    }
}
