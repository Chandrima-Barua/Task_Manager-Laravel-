@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">

        <div class="card shadow">
            <div class="card-header text-center"><strong>Tasks</strong>
            <div><h4>For see the tasks select project first! </h4></div>
            
            </div>
            <div class="card-body">

                @if(count($projects) > 0)
                <div class="form-group row">
                    <div class="col-xs-4">
                        <label for="exampleFormControlSelect1">Select Project</label>
                        <select class="form-control project" name="project" id="projectid">
                            <option value='0'>-- Select Project --</option>
                            @foreach($projects as $project)
                            <option value='{{ $project->id }}'>{{ $project->name }}</option>
                            @endforeach
                        </select>
                    </div>
                </div>
            </div>



            <!-- for searching items -->
            <div class="row">
                <div id="tasklist">
                    <table class="table table-hover table-responsive" id="taskcontents">
                        <thead>
                            <tr>
                                <td>Task ID</td>
                                <td>Task Name</td>
                                <td>Created At</td>
                                <td>Action</td>
                            </tr>
                        </thead>
                        <tbody>


                        </tbody>
                    </table>
                </div>

            </div>

            @endif
            <div class="card-body">
                @if(count($tasks) > 0)


                @else
                <p class="text-center">No tasks found!</p>
                @endif
            </div>

        </div>
    </div>
</div>
@endsection

@push('scripts')
<!-- <script> -->

<script type="text/javascript">
$(document).ready(function() {

    $(document).on('change', '.project', function(e) {
        $('table tbody').html('');
        var query = $(this).val();
        $.ajax({

            url: 'projects/tasks/' + query,


            type: "GET",

            dataType: 'json',
            success: function(response) {

                for (var i = 0; i < response['tasks'].length; i++) {
                    var option = "<tr class='taskrow' data-id=" + response['tasks'][i]['id'] +
                        "><td id=" + response['tasks'][i]['id'] +
                        ">" + response['tasks'][i]['id'] +
                        "</td><td>" + response['tasks'][i]['task_name'] +
                        "</td><td>" + response['tasks'][i]['created_at'] +
                        "</td><td><a href='{{ route('tasks.destroy'," + response['tasks'][i]['created_at'] +")}}'>Delete</a>&nbsp;</td><tr>"
                    $('table tbody').append(option);

                }
            }
        })
    });




    $("document, #table").DataTable();

    $("document, #taskcontents").sortable({
        items: "tr",
        cursor: 'move',
        opacity: 0.6,
        update: function() {
            updatetasks();
        }
    });

    function updatetasks() {
        var priority = [];
        var token = $('meta[name="csrf-token"]').attr('content');
        $('document, tr.taskrow').each(function(index, element) {
            priority.push({
                id: $(this).attr('data-id'),
                position: index + 1
            });
        });
        console.log(priority)

        $.ajax({
            type: "POST",
            dataType: "json",
            url: "{{ url('update') }}",
            data: {
                priority: priority,
                _token: token
            },
            success: function(response) {
                if (response.status == "success") {
                    console.log(response);
                } else {
                    console.log(response);
                }
            }
        });
    }
});
</script>
@endpush