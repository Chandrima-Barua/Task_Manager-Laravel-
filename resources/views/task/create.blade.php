@extends('layouts.app')
@section('content')
<div class="container">
    <form method="POST" action="{{ route('tasks.store') }}">
        @csrf
        <fieldset>
            <legend>{{ __('Create New Task') }}</legend>
            

            @if ($errors->any())
          <div class="alert alert-danger">
                    <ul>
                    @foreach ($errors->all() as $error)
                     <li>{{ $error }}</li>
                @endforeach
             </ul>
             </div>
             @endif
        <!--error ends-->
            <div class="form-group">
                <div class="row">
                    <div class="col">
                        <label for="task_name">Task Name</label>
                        <input type="text" class="form-control" id="task_name" name="task_name" value="{{ old('task_name') }}" required>
                    </div>
                    
                </div>
            </div>

            <div class="form-group row">
                <div class="col-xs-4">
                    <label for="exampleFormControlSelect1">Select Project</label>
                    <select class="form-control project" name="project" id="project">
                        <option value='0'>-- Select project --</option>
                        @foreach($projects as $project)
                        <option value='{{ $project->id }}'>{{ $project->name }}</option>
                        @endforeach
                    </select>
                </div>
            </div>
            
            <div class="form-group">
                <button type="submit" class="btn btn-primary">Create</button>
            </div>
    </form>

</div>
@endsection