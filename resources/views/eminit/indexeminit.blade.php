@extends('layouts.app-all')

@section('title', 'E-Memo')

@section('content')

<?php
$pagename = "E-Memo";
?>

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
    <div class="col-12 mb-2 mt-2" style="text-align: left;">
    <button type="button" class="btn btn-primary"
        onclick="window.location.href='{{ route('servicesdashboard', ['open' => 'EMT']) }}'">
        <i class="bi bi-arrow-left-circle"></i> Kembali
    </button>
    </div>

    <div class="col-12 mb-2 mt-2" style="text-align: right;">
        <a href="{{ route('eminit.eminit.createeminit') }}" class="btn btn-primary"  title="Tambah Rekod">
            <i class="bi bi-plus-lg"></i>
        </a>
    </div>


    <div class="col-12">
        <div class="card">
            

            <br>
            <h5 class="card-title" style="text-align: center; color: white; padding: 10px; border-radius: 0px; background-color: #4682B4;">E-Memo</h5>


            <div class="card-body overflow-auto">


            <table class="table table-borderless datatable mt-3">
              
                    <thead>
                        <tr>
                            <th scope="col">Jenis</th>
                            <th scope="col">Memo Daripada</th>
                            <th scope="col">Kepada</th>
                            <th scope="col">Perkara</th>
                            <th scope="col">Rujukan (Memo Diterima)</th>
                            <th scope="col">Tarikh</th>
                            <th scope="col">Status Admin</th>
                            <th scope="col">Created By</th>
                            <th scope="col">Action By</th>
                            <th scope="col">Action</th>

                        </tr>
                    </thead>

                    <tbody>
                        @if(count($eminits) == 0)
                        <tr class="text-center">
                            <td colspan="8">
                                <h5>No records found</h5>
                            </td>
                        </tr>

                        @else

                        @foreach($eminits as $eminit)

                            <tr>

                                <td>{{ $jenisMap[(int)($eminit->jenis ?? 0)] ?? '-' }}</td>
                                <td>{{ $eminit->memoDepartment->label ?? '-' }}</td>
                                @php
                                $ids = (array) ($eminit->kpd ?? []);
                                $names = array_map(fn($id) => $labelsById[$id] ?? "ID {$id}", $ids);
                                @endphp
                                <td>{{ implode(', ', $names) }}</td>
                                <td style="font-weight: bold; text-transform: uppercase;">
                                    {{ $eminit->perkara }}
                                </td>
                                <td>{{$eminit->rujukan_tp}}</td>

                                <td>{{$eminit->created_at}}</td>



                                @php $ts = optional($eminit->latestAdminEntry)->created_at; @endphp
                                <td>
                                @if($ts)
                                    {{ $ts->timezone('Asia/Brunei')->format('d/m/Y, H:i') }}
                                @else
                                    <span class="badge rounded-pill bg-secondary">
                                    <i class="bi bi-hourglass-split me-1"></i>Belum Diterima
                                    </span>
                                @endif
                                </td>

                                <td>
                                    {{
                                        optional(\App\Models\Eminit_Tindakandiperlukan::where('ic_no', $eminit->ic_no)->first())->kod ?? '-'
                                    }}
                                </td>

                                <td>
                                    {{
                                        optional(
                                            \App\Models\Eminit_Tindakandiperlukan::where('ic_no', $eminit->ic_no)->first()
                                        )->kod
                                        ? \Illuminate\Support\Str::title(
                                            optional(
                                                \App\Models\Eminit_Tindakandiperlukan::where('ic_no', $eminit->ic_no)->first()
                                            )->kod
                                        )
                                        : '-'
                                    }}
                                </td>
                      
                                <td>

                                    <div class="btn-group gap-2" role="group" aria-label="Basic example">

                                    @if(auth()->check() && $eminit->ic_no === auth()->user()->ic_no)
                                        <!----Edit Button----->
                                        <form method="get" action="{{ route('eminit.eminit.editeminit', $eminit-> id ) }}"  title="Kemaskini">
                                            @csrf
                                            <button type="submit" class="btn btn-outline-primary">
                                                <i class="bi bi-pencil-fill"></i>
                                            </button>
                                        </form>
                                        <!----Delete Button----->
                                        <form method="post" action="{{ route('eminit.eminit.destroy', $eminit->id ) }}"  title="Padam Rekod">
                                        @csrf
                                        @method('delete')
                                        <button type="submit" class="btn btn-outline-danger">
                                            <i class="bi bi-trash-fill"></i>
                                        </button>
                                        </form>

                                    @else
                                    <form method="get" action="{{ route('eminit.eminit.editeminit', $eminit-> id ) }}"  title="Kemaskini">
                                            @csrf
                                            <button type="submit" class="btn btn-outline-primary">
                                                <i class="bi bi-eye"></i>
                                            </button>
                                        </form>

                                    @endif
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