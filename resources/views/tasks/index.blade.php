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
            <th scope="col">Tasks</th>
            <th scope="col">Actions</th>
            <th scope="col">Labor Total</th>
            <th scope="col">Parts Total</th>
            <th scope="col">Subtotal</th>
            <td></td>
          </tr>
        </thead>
        <tbody class="text-center">   
          @foreach($tasks as $task)
            <tr>
                <td style="overflow: hidden;">{{$task->taskName}}<table class="table ms-2 mt-5 intable">
              @forelse($task->workers as $worker)
                  <tr style="font-size: 9px;width: 10%;">
                    <td>
                    <form method="get" action="/deleteWorker/{{$worker->id}}">
                      {{ csrf_field() }}
                    <input type="hidden" name="_method" value="delete">
                    <button type="submit" onclick="return confirm('Are you sure?')" class="btn btn-danger btn-icon deleteW">
                      <i>X</i>
                   
                    </button> </form></td>
                    <td>{{$worker->workerName}}</td>
                    <td>{{$worker->workRate}}</td>
                    <td>{{$worker->workersTotal}}</td>
                  </tr>
                  @php
                  $task->laborTotal = $task->laborTotal += $worker->workersTotal
                  @endphp
                 
               @empty  
                  <tr><td><i>No workers yet </i></td></tr>
                @endforelse
              </table>
                </td>
                <td>
                  <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#modal{{$task->id}}">
                    <i>Add worker</i>
                  </button>
                </form>
               
                <div class="modal fade" id="modal{{$task->id}}" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                  <div class="modal-dialog">
                    <div class="modal-content">
                      <div class="modal-header">
                        <h5 class="modal-title" id="exampleModalLabel">Modal title</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                      </div>
                      <div class="modal-body">
                          <form method="POST" action="{{url('/addWorker')}}">
                            {{ csrf_field() }}
                            @method('post')
                            <label for="workerName">Name</label>
                            <input type="text" name="workerName" class="form-control"/>
                            <label for="workerRate">Rate</label>
                            <input type="text" name="workRate"  class="form-control"/>
                            <label for="workHours">Work Hours</label>
                            <input type="text" name="workHours"  class="form-control mb-2"/>
                            <input type="hidden" name="tasks_id" value="{{$task->id}}" />
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
                @if(isset($task->laborTotal))
                <td>{{$task->laborTotal}}</td>
                @else
                <td>0</td>
                @endif
                <td>{{$task->partsTotal}}</td>
                <td>{{$task->partsTotal + $task->laborTotal}}</td>
                <td><form method="POST" action="{{ route('tasks.destroy',$task->id) }}">
                  {{ csrf_field() }}
                @method('delete')
                <input type="hidden" name="_method" value="delete">
                <button type="submit" onclick="return confirm('Remove whole task?')" class="btn btn-danger btn-icon">
                  <i>Delete Task</i>
                </button></form></td>
            </tr>
            
            @endforeach
        </tbody>
      </table>
      
      <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>
    </div>
    @endsection