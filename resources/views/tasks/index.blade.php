@extends('tasks.layout')
@section('content')

<div>
  <form action="/tasks" class="mt-3" method="POST">
    {{ csrf_field() }}
    <label for="taskName">Add Task</label>
    <input class="form-control mb-3" type="text" id="taskName" name="taskName" />
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
            @if(isset($task->workers))
            @foreach ($task->workers as $worker)


            <tr style="font-size: 9px;width: 10%;">
              <td>
                <form method="POST" action="/deleteWorker/{{$worker->id}}">
                  {{ csrf_field() }}
                  @method('delete')
                  <input type="hidden" name="_method" value="delete">
                  <button type="submit" onclick="confirm('Are you sure?')"
                    class="btn btn-danger btn-icon deleteW">
                    <i>X</i>

                  </button>
                </form>
              </td>
              <td>{{$worker->workerName}}</td>
              <td>{{$worker->workRate}}</td>
              <td>{{$worker->workersTotal}}</td>
            </tr>
            @php
            
            @endphp
            @endforeach
            @endif
            @if(isset($task->parts))
            @foreach ($task->parts as $part)


            <tr style="font-size: 9px;width: 10%;">
              <td>
                <form method="POST" action="/deletePart/{{$part->id}}">
                  {{ csrf_field() }}
                  @method('delete')
                  <input type="hidden" name="_method" value="delete">
                  <button type="submit" onclick="return confirm('Are you sure?')"
                    class="btn btn-danger btn-icon deleteW">
                    <i>X</i>

                  </button>
                </form>
              </td>
              <td>{{$part->partName}}</td>
              <td>{{$part->partQty}}</td>
              <td>{{$part->partsTotal}}</td>
            </tr>
            </form>
            @php
           
            @endphp
            @endforeach
            @endif

          </table>
        </td>

        <td align="right">
          {{-- Modal Buttons --}}
          <button type="button" class="btn btn-primary position-relative me-0 " data-bs-toggle="modal"
            data-bs-target="#modal{{$task->id}}">
            <i class="fa-solid fa-person"></i>
            @if($task->workers->isNotEmpty())
            <span class="position-absolute top-0 start-100 translate-middle badge rounded-pill bg-danger">
              {{count($task->workers)}}
            </span>
            @endif

          </button>
          <button type="button" class="btn btn-primary position-relative mx-1" data-bs-toggle="modal"
            data-bs-target="#pmodal{{$task->id}}">
            <i class="fa-solid fa-gear"></i>
            @if($task->parts->isNotEmpty())
            <span class="position-absolute top-0 start-100 translate-middle badge rounded-pill bg-danger">
              {{count($task->parts)}}
            </span>
            @endif
          </button>
          <button type="button" class="btn btn-primary position-relative mx-1" data-bs-toggle="modal"
            data-bs-target="#imodal{{$task->id}}">
            <i class="fa-solid fa-circle-exclamation"></i>
          </button>
          {{-- Modal Body --}}
          <div class="modal fade" id="modal{{$task->id}}" tabindex="-1" aria-labelledby="exampleModalLabel"
            aria-hidden="true">
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
                    <input type="text" name="workerName" class="form-control" />
                    <label for="workerRate">Rate</label>
                    <input type="text" name="workRate" class="form-control" />
                    <label for="workHours">Work Hours</label>
                    <input type="text" name="workHours" class="form-control mb-2" />
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
          <div class="modal fade" id="pmodal{{$task->id}}" tabindex="-1" aria-labelledby="exampleModalLabel"
            aria-hidden="true">
            <div class="modal-dialog">
              <div class="modal-content">
                <div class="modal-header">
                  <h5 class="modal-title" id="exampleModalLabel">Modal title</h5>
                  <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                  <form method="POST" action="{{url('/addPart')}}">
                    {{ csrf_field() }}
                    @method('post')
                    <label for="partName">Part Name</label>
                    <input type="text" name="partName" class="form-control" />
                    <label for="partQty">Quantity</label>
                    <input type="text" name="partQty" class="form-control" />
                    <label for="partPrice">Part Price</label>
                    <input type="text" name="partPrice" class="form-control mb-2" />
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
        @php
            $grandTotal = $task->partsTotal + $task->laborTotal
        @endphp
        <td>{{$grandTotal}}</td>
        <td>
          <form method="POST" action="{{ route('tasks.destroy',$task->id) }}">
            {{ csrf_field() }}
            @method('DELETE')
            <input type="hidden" name="_method" value="delete">
            <button type="submit" onclick="return confirm('Remove whole task?')" class="btn btn-danger btn-icon">
              <i>Delete</i>
            </button>
          </form>
        </td>
      </tr>
     
      @endforeach
    </tbody>
  </table>

  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js"
    integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous">
  </script>
</div>

<footer>
  <h6>Taxes : &#8369; 0.00</h6>
  <h6>Additional Fees : &#8369; 0.00</h6>
  <h4>Subtotal : &#8369; 0.00</h4>
  <h2>Total : &#8369; {{}}</h2>
</footer>
@endsection