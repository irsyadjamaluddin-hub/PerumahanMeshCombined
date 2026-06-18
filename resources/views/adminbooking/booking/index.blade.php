@extends('layouts.app-all')
@section('content')

<?php 
    $pagename = "Bookings Index";
?>

    <div style="margin-bottom: 10px;" class="row">
        <div class="col-lg-12">
            <a class="btn btn-success" href="{{ route('adminbooking.booking.create') }}">
                Add Booking
            </a>
        </div>
    </div>
<div class="card">
    <div class="card-header">
        List of Bookings
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
                                {{ $event->start_time  }}
                            </td>
                            <td>
                                {{ $event->end_time  }}
                            </td>
                            <td>
                                {{ $event->description  }}
                            </td>
                            <td>
                                <a class="btn btn-outline-primary" href="{{ route('adminbooking.booking.show', $event->id) }}">
                                    <i class="bi bi-eye-fill"></i>
                                </a>
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
@parent
<script>
    $(function () {
  let dtButtons = $.extend(true, [], $.fn.dataTable.defaults.buttons)
@can('event_delete')
  let deleteButtonTrans = '{{ trans('global.datatables.delete') }}'
  let deleteButton = {
    text: deleteButtonTrans,
    url: "{{ route('admin.events.massDestroy') }}",
    className: 'btn-danger',
    action: function (e, dt, node, config) {
      var ids = $.map(dt.rows({ selected: true }).nodes(), function (entry) {
          return $(entry).data('entry-id')
      });

      if (ids.length === 0) {
        alert('{{ trans('global.datatables.zero_selected') }}')

        return
      }

      if (confirm('{{ trans('global.areYouSure') }}')) {
        $.ajax({
          headers: {'x-csrf-token': _token},
          method: 'POST',
          url: config.url,
          data: { ids: ids, _method: 'DELETE' }})
          .done(function () { location.reload() })
      }
    }
  }
  dtButtons.push(deleteButton)
@endcan

  $.extend(true, $.fn.dataTable.defaults, {
    order: [[ 1, 'desc' ]],
    pageLength: 100,
  });
  $('.datatable-Event:not(.ajaxTable)').DataTable({ buttons: dtButtons })
    $('a[data-toggle="tab"]').on('shown.bs.tab', function(e){
        $($.fn.dataTable.tables(true)).DataTable()
            .columns.adjust();
    });
})

</script>
@endsection