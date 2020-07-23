@extends('layouts.app')
@section('content')
<div class="container">
    <form method="POST" action="{{ route('projects.store') }}">
        @csrf
        <fieldset>
            <legend>{{ __('Create New Project') }}</legend>
            

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
                        <label for="name">Project Name</label>
                        <input type="text" class="form-control" id="name" name="name" value="{{ old('name') }}" required>
                    </div>
                    
                </div>
            </div>
            
            <div class="form-group">
                <button type="submit" class="btn btn-primary">Create</button>
            </div>
    </form>

</div>
@endsection