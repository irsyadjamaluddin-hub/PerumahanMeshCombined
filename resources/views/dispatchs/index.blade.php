@extends('layouts.app-all')

@section('title', 'e-Despatch')

@section('content')

<?php
$pagename = "DIS";
?>

<img src="/img/med_new.png">

<style>                
.dataTable-info{
    color: white;
}
</style>

<section class="section">
<div class="row">

    @if(Session::has('success_message'))
    <div class="alert alert-success">
        <i class=" fas fa-fw fa-check"></i>
        {!! session('success_message') !!}
    </div>
    @endif

    <div class="col-12 mb-2 mt-2" style="text-align: right;">
        <a href="{{ route('dispatchs.dis.create') }}" class="btn btn-primary">
            <i class="bi bi-plus-lg"></i>
        </a>
    </div>


    <div class="col-12">
        <div class="card">

            <div class="card-body overflow-auto">

                <table class="table table-borderless datatable mt-3">
                    <thead>
                        <tr>
                            <th scope="col">Jenis</th>
                            <th scope="col">Daripada</th>
                            <th scope="col">Kepada</th>
                            <th scope="col">Status</th>
                            <th scope="col">Tindakan</th>
                        </tr>
                    </thead>

                    <tbody>
                        @if(count($dispatchs) == 0)
                        <tr class="text-center">
                            <td colspan="8">
                                <h5>No records found</h5>
                            </td>
                        </tr>

                        @else

                        @foreach($dispatchs as $dispatch)
                        <?php $kpds=$dispatch->kpd ? json_decode($dispatch->kpd, true) : []; ?>

                            <tr>

                                <td>{{ optional($dispatch->jenis) ->label }}</td>
                                <td>{{ optional($dispatch->Daripada)->label }}</td>
                                
                                <td>@foreach (json_decode($dispatch->kpd) as $kpds){{ $kpds }}
                                <br>
                                @endforeach</td>
                      

                                @if ($dispatch->dispatch_recieved_at==null)
                                <td><span class="badge bg-danger"> Dihadapkan</span></td>
                                @else
                                <td><span class="badge bg-success"> Diterima</span></td>
                                @endif
                                
                                <td>

                                    <div class="btn-group gap-2" role="group" aria-label="Basic example">

                                        <!----Edit Button----->
                                        <form method="get" action="{{ route('dispatchs.dis.edit', $dispatch->id ) }}">
                                            @csrf
                                            <button type="submit" class="btn btn-outline-primary">
                                                <i class="bi bi-pencil-fill"></i>
                                            </button>
                                        </form>

                                        <!----Edit Button----->
                                        <form method="get" action="{{ route('dispatchs.dis.show', $dispatch->id) }}">
                                            @csrf
                                            <button type="submit" class="btn btn-outline-primary">
                                                <i class="bi bi-eye-fill"></i>
                                            </button>
                                        </form>

                                        <!----Delete Button----->
                                        <form method="post" action="{{ route('dispatchs.dis.destroy', $dispatch->id ) }}">
                                        @csrf
                                        @method('delete')
                                        <button type="submit" class="btn btn-outline-danger">
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

</div>
</section>
@endsection