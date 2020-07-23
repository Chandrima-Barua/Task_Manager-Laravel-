<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Validator;
use App\Task;
use App\Project;

class TaskController extends Controller
{
    
    public function index()
    {
        $tasks = Task::orderBy('priority','ASC')->get();
        $projects = Project::all();
       
        return view('task.index')->with(['projects'=> $projects, 'tasks'=> $tasks]);
    
    }

   
    public function create()
    {
        $projects = Project::all();
        return view('task.create')->with(['projects'=> $projects]);
    }

   
    public function store(Request $request)
    {
        $request->validate([
            'task_name'=>'required',
            
        ]);
        $task = new Task();
        $task->task_name = $request->input('task_name');
        // $task->save();

        $projectid = Project::find($request->input('project'));
        $projectid->tasks()->save($task);

        return redirect('/')->with('success', 'Task created!');
    }

    
    public function update(Request $request)
    {
        $tasks = Task::all();

        foreach ($tasks as $task) {
            foreach ($request->priority as $priority) {
                if ($priority['id'] == $task->id) {
                    $task->update(['priority' => $priority['position']]);
                }
            }
        }
        
        return response('Update Successfully.', 200);
    }


    public function destroy($id)
    {
        $task = Task::find($id);
        $task->delete();
        return redirect('/')->with('success', 'Task deleted!');
        
    }



   
}
