@extends('layouts.app-all')
@section('title', 'Indeks Tempahan Admin')
@section('content')

<?php 
    $pagename = "Senarai Tempahan";
?>

    <div style="margin-bottom: 10px;" class="row">
        <div class="col-lg-12">
            <a class="btn btn-success" href="{{ route('adminbooking.booking.create') }}">
                Tambah Tempahan
            </a>
        </div>
    </div>
    @if(Session::has('success_message'))
    <div class="alert alert-success">
        <i class=" fas fa-fw fa-check"></i>
        {!! session('success_message') !!}
    </div>
    @endif
<div class="card">
    <div class="card-header">
        Senarai Tempahan
    </div>

    <div class="card-body">
        <div class="table-responsive">
            <table class="table table-borderless datatable mt-3">
                <thead>
                    <tr>
                        <th>
                            Nama
                        </th>
                        <th>
                            Bilik
                        </th>
                        <th>
                            Masa Mula
                        </th>
                        <th>
                            Masa Tamat
                        </th>
                        <th>
                            Keterangan
                        </th>
                        <th>
                            Tindakan
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
                                <div class="btn-group gap-2" role="group">
                                    <a class="btn btn-outline-primary" href="{{ route('adminbooking.booking.showadmin', $event->id) }}">
                                        <i class="bi bi-eye-fill"></i>
                                    </a>

                                    <form method="get" action="{{ route('adminbooking.booking.edit', $event->id) }}">
                                        @csrf

                                        <button type="submit" class="btn btn-outline-primary" >
                                            <i class="bi bi-pencil-fill"></i>
                                        </button>

                                    </form>

                                    <!----Delete Button----->
                                    <form method="post" action="{{ route('adminbooking.booking.destroy', $event->id) }}">
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