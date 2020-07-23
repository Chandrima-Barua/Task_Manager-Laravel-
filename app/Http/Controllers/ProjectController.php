<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Project;


class ProjectController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('projects.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $request->validate([
            'name'=>'required',
            
        ]);

        $project = new Project();
        $project->name = $request->input('name');
        $project->save();
        return redirect('/')->with('success', 'Project created!');
    }

   

  
    public function destroy($id)
    {
        //
    }

    public function taskshow(Request $request,$id){
        
        if($request->ajax()) {
            $project = Project::find($id);
 
            $tasks = $project->tasks;
            return response()->json( ['tasks' => $tasks]);
           
          
        }
    }
}
