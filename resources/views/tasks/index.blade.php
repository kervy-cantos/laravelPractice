@extends('tasks.layout')
@section('content')
    
<div>
    <form action="/tasks" class="mt-3" method="POST">
      {{ csrf_field() }}
        <label for="taskName">Add Task</label>
        <input class="form-control mb-3" type="text" id="taskName" name="taskName"/>
    </form>
    <table class="table table-bordered table-striped">
   
        <thead>
          <tr>
            <th scope="col">taskName</th>
            <td></td>
            <th scope="col">partsTotal</th>
            <th scope="col">laborTotal</th>
            <th scope="col">subTotal</th>
          </tr>
        </thead>
        <tbody>
          @foreach($tasks as $task)
            <tr>
                <td>{{$task->taskName}}</td>
                <td>
                  <form method="POST" action="{{ route('tasks.destroy',$task->id) }}">
                    {{ csrf_field() }}
                  @method('delete')
                  <input type="hidden" name="_method" value="delete">
                  <button type="submit" onclick="return confirm('Are you sure?')" class="btn btn-danger btn-icon">
                    <i data-feather="delete"></i>
                  </button>
                </form>
                <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#modal{{$task->id}}">
                  Add
                </button>
                <div class="modal fade" id="modal{{$task->id}}" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                  <div class="modal-dialog">
                    <div class="modal-content">
                      <div class="modal-header">
                        <h5 class="modal-title" id="exampleModalLabel">Modal title</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                      </div>
                      <div class="modal-body">
                          <form method="POST" action ="">
                            {{ csrf_field() }}
                            <label for="workerName">Name</label>
                            <input type="text" id="workerName" class="form-control"/>
                            <label for="workerRate">Rate</label>
                            <input type="text" id="workerRate"  class="form-control"/>
                            <label for="workerTotal">Work Hours</label>
                            <input type="text" id="workerTotal"  class="form-control"/>
                            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                            <button type="submit" name="form2" class="btn btn-primary">Save changes</button>
                          </form>
                      </div>
                      <div class="modal-footer">
                
                      </div>
                    </div>
                  </div>
                </div>
              </td>
                <td>{{$task->laborTotal}}</td>
                <td>{{$task->partsTotal}}</td>
                <td>{{$task->taskTotal}}</td>
               
            </tr>
            @endforeach
        </tbody>
      </table>
      <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>
    </div>
    @endsection