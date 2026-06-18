@extends('layouts.app-all')
@section('title', 'Tambah Bilik')
@section('content')

<?php 
    $pagename = "Bilik";
?>

@if (Auth::check())
    <div style="margin-bottom: 10px;" class="row">
        <div class="col-lg-12">
            <a class="btn btn-success" href="{{ route('adminbooking.rooms.create') }}">
                Tambah Bilik
            </a>
        </div>
    </div>
@endif
<div class="card">
    <div class="card-header">
       Senarai Bilik Mesyuarat
    </div>

    <div class="card-body">
        <div class="table-responsive">
         <table class="table table-borderless datatable mt-3">
                <thead>
                <tr>
                    <th scope="row">Nama</th>
                    <th scope="row">Kapasiti</th>
                    <th scope="row">Keterangan</th>
                    <th scope="row">Tindakan</th>
                </tr>
                </thead>
                <tbody>
                @if(count($rooms) == null)
                            <tr class="text-center">
                                <td colspan="8">
                                    <h5>Tiada rekod dijumpai</h5>
                                </td>
                            </tr>

                        @else
                         @foreach($rooms as $room)   
                            <tr>
                                <td>{{$room->label }}</td>
                                <td>{{$room->capacity }}</td>
                                <td>{{$room->description }}</td>
                                <td>
                                    <div class="btn-group gap-2" role="group">
                                        <a class="btn btn-outline-primary" href="{{ route('adminbooking.rooms.show', $room->id) }}">
                                            <i class="bi bi-eye-fill"></i>
                                        </a>

                                        <form method="get" action="{{ route('adminbooking.rooms.edit', $room->id) }}">
                                            @csrf

                                            <button type="submit" class="btn btn-outline-primary" >
                                                <i class="bi bi-pencil-fill"></i>
                                            </button>

                                        </form>

                                        <!----Delete Button----->
                                        <form method="post" action="{{ route('adminbooking.rooms.destroy', $room->id) }}">
                                            @csrf
                                            @method('delete')
                                            <a onclick='return confirm("Sahkan untuk padam data?")'>
                                            <button type="submit" class="btn btn-outline-danger" >
                                                <i class="bi bi-trash-fill"></i>
                                            </button>
                                        </form>
                                    </div>
                                </td>
                            </tr>
                            @endforeach
                            @endif
                    
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
@can('room_delete')
  let deleteButtonTrans = '{{ trans('global.datatables.delete') }}'
  let deleteButton = {
    text: deleteButtonTrans,
    url: "{{ route('admin.rooms.massDestroy') }}",
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
  $('.datatable-Room:not(.ajaxTable)').DataTable({ buttons: dtButtons })
    $('a[data-toggle="tab"]').on('shown.bs.tab', function(e){
        $($.fn.dataTable.tables(true)).DataTable()
            .columns.adjust();
    });
})

</script>
@endsection