@extends('layouts.app-all')
@section('title', 'Room Booking')
@section('content')

<?php 
    $pagename = "Room Booking";
?>

<div class="card" style="height:1000px;">
    <div class="card-header">
        Room Booking
    </div>
    @if(Session::has('success_message'))
      <div class="alert alert-success">
        {{Session::get('success_message')}}
      </div>
    @endif
    
    <div class="profile-overview pt-3">

    <div class="card-body">
        <form>
            <div class="row"  style="padding-top:10px;">
                <div class="col-md-4">
                    <div class="form-group" >
                        <label class="col-form-label">From:</label>
                        <input type="text"  class="form-control datetime" name="start_time" id="start_time" value="{{ request()->input('start_time') }}" placeholder="e.g. 2020-05-11 07:50" required>
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="form-group">
                    <label class="col-form-label">To:</label>
                        <input type="text" class="form-control datetime" name="end_time" id="end_time" value="{{ request()->input('end_time') }}" placeholder="e.g. 2020-05-11 09:50" required>
                    </div>
                </div>
                <div class="col-md-3">
                <label class="col-form-label">Capacity:</label>
                    <div class="form-group">
                        <input class="form-control" type="number" name="capacity" id="capacity" value="{{ request()->input('capacity') }}" placeholder="{{ trans('cruds.room.fields.capacity') }}" step="1" min="0" required>
                    </div>
                </div>
                <div style="padding-top:38px;" class="col-md-1">
                    <button class="btn btn-success">
                        Search
                    </button>
                </div>
            </div>
        </form>
        @if($rooms !== null)
            <hr />
            @if($rooms->count())
                <div class="table-responsive">
                    <table class="table table-borderless datatable mt-3">
                        <thead>
                            <tr>
                                <th>
                                    Room
                                </th>
                                <th>
                                    Capacity
                                </th>
                                <th>
                                    Description
                                </th>
                                <th>
                                    Action
                                </th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($rooms as $room)
                                <tr>
                                    <td class="room-name">
                                        {{ $room->label }}
                                    </td>
                                    <td>
                                        {{ $room->capacity }}
                                    </td>
                                    <td>
                                        {{ $room->description }}
                                    </td>
                                    <td>
                                        <button type="button" class="btn btn-sm btn-primary" data-toggle="modal" data-target="#bookRoom" data-room-id="{{ $room->id }}">
                                            Book
                                        </button>
                                    </td>

                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            @else
                <p class="text-center">There are no rooms available at the time you have chosen</p>
            @endif
        @endif
    </div>
</div>

<div class="modal" tabindex="-1" role="dialog" id="bookRoom">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Booking Room For</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form action="{{ route('bookRoom') }}" method="POST" id="bookingForm">
                    @csrf
            @foreach ($userdetails as $userdetail)
            <div class="form-group">
                <label class="required" for="name">Nama</label>
                <input class="form-control {{ $errors->has('name') ? 'is-invalid' : '' }}" type="text" name="name" id="name" value="{{ $userdetail->name }}" required>
            </div>

            <div class="form-group">
                <label class="required" for="jawatan">Jawatan</label>
                <input class="form-control" type="text" name="jawatan" id="jawatan" value="{{ $userdetail->current_designation_id }}" required>
            </div>

            <div class="form-group">
                <label class="required" for="tel_no">No Telefon</label>
                <input class="form-control" type="text" name="tel_no" id="tel_no" value="{{ $userdetail->telephone_mobile }}" required>
            </div>

            <div class="form-group">
                <label class="required" for="agenda">Tajuk</label>
                <input class="form-control" type="text" name="agenda" id="agenda" value="{{ old('agenda') }}" required>
            </div>

            <div class="form-group">
                <label class="required" for="anjuran">Anjuran</label>
                <input class="form-control" type="text" name="anjuran" id="anjuran" value="{{ old('anjuran') }}" required>
            </div>

            <div class="form-group">
                <label class="required" for="pengerusi">Pengerusi/Tetamu Hormat</label>
                <input class="form-control" type="text" name="pengerusi" id="pengerusi" value="{{ old('pengerusi') }}" required>
            </div>

            <div class="form-group">
                <label class="required" for="dept">Jabatan</label>
                <select class="form-select" name="dept" aria-label="Default select example" required>
                    <option value="{{ optional($userdetail->department)->label }}">{{ optional($userdetail->department)->label }}</option>
                    @foreach ($departments as $key => $value)
                    <option value="{{ $value }}">
                      {{ $value }}
                    </option>
                    @endforeach
                </select>
                <!--<input class="form-control" type="text" name="dept" id="dept" value="{{ old('dept') }}" required>-->
            </div>
             @endforeach

            <div class="form-group">
                <label for="description">Description</label>
                <textarea class="form-control " name="description" id="description">{{ old('description') }}</textarea>
            </div>

            <!--Hidden Values of Start Time, End Time, Room ID & Reccuring Until -->
            <input type="hidden" name="room_id" id="room_id" value="{{request()->input('room_id') }}">
            <input type="hidden" name="start_time" value="{{ request()->input('start_time') }}">
            <input type="hidden" name="end_time" value="{{ request()->input('end_time') }}">
            <input type="hidden" name="deleted_at" value="">
            <input class="form-control date {{ $errors->has('recurring_until') ? 'is-invalid' : '' }}" type="text" name="recurring_until" id="recurring_until" value="{{ request()->input('start_time')}}" hidden>
            <!--Ends here-->  
                    
                    <button type="submit" style="display: none;"></button>
                </form>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-primary" id="submitBooking">Submit</button>
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
            </div>
        </div>
    </div>
</div>
</div>
<div class="card">
    <div class="card-header">
        History of Bookings
    </div>

    <div class="card-body">
        <div class="table-responsive">
            <table class="table table-borderless datatable mt-3">
                <thead>
                    <tr>
                        <th>
                            Name
                        </th>
                        <th>
                            Room
                        </th>
                        <th>
                            Title    
                        </th>
                        <th>
                            Start Time
                        </th>
                        <th>
                            End Time
                        </th>
                        <th>
                            Description
                        </th>
                        <th>
                            Action
                        </th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($events as $key => $event)
                        <tr>
                            <td>
                                {{ $event->name }}
                            </td>
                            <td>
                                {{ $event->label  }}
                            </td>
                            
                            <td>
                                {{ $event->title  }}
                            </td>
                            <td>
                                {{ $event->start_time  }}
                            </td>
                            <td>
                                {{ $event->end_time  }}
                            </td>
                            <td>
                                {{ $event->description  }}
                            </td>
                            <td>
                                <div class="btn-group gap-2" role="group">

                                    <a class="btn btn-outline-primary" href="{{ route('adminbooking.booking.show', $event->id) }}">
                                        <i class="bi bi-eye-fill"></i>
                                    </a>

                                    <!----Delete Button----->
                                    <form method="post" action="{{ route('adminbooking.booking.destroyuser', $event->id) }}">
                                        @csrf
                                        @method('delete')
                                        <a onclick='return confirm("Confirm to cancel booking?")'>
                                        <button type="submit" class="btn btn-outline-danger" >
                                            <i class="bi bi-x-square-fill"></i>
                                        </button>
                                    </form>
                                </div>
                            </td>

                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
</div>
@endsection

@section('scripts')
<script>
$('#bookRoom').on('show.bs.modal', function (event) {
    var button = $(event.relatedTarget);
    var roomId = button.data('room-id');
    var modal = $(this);
    modal.find('#room_id').val(roomId);
    modal.find('.modal-title').text('Booking of a room ' + button.parents('tr').children('.room-name').text());

    $('#submitBooking').click(() => {
        modal.find('button[type="submit"]').trigger('click');
    });
});
</script>
<script>
    $(function () {
    $('.datetimepicker').datetimepicker();
});
</script>
<script>

    $('#myselect').select2({
      width: '100%',
      placeholder: "Pilih Jabatan",
      allowClear: true
    });
  </script>
@endsection
