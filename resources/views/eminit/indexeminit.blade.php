@extends('layouts.app-all')

@section('title', 'E-Memo')

@section('content')
{{-- #========== NEWLY ADDED ============ --}}
{{-- #============= ORI CODE ============== --}}
{{-- Dark mode in the Home page theme (purple/gold), chosen Oct 2026: shared styles in public/css/mesh-home-theme.css, --}}
{{-- applied to everything inside the mesh-home-theme wrapper below. Light mode is unchanged. --}}
{{-- <link href="{{ asset('css/mesh-home-theme.css') }}?v={{ filemtime(public_path('css/mesh-home-theme.css')) }}" rel="stylesheet"> --}}
{{-- #================================ --}}
{{-- Dark mode in the Home page theme (purple/gold), chosen Oct 2026: the styles are in public/css/mesh-dark.css --}}
{{-- ("Home page theme" section; app-all already loads that file), applied inside the mesh-home-theme wrapper below. --}}
{{-- Light mode is unchanged. --}}
{{-- #================================ --}}
<div class="mesh-home-theme">
{{-- #================================ --}}

<?php
$pagename = "E-Memo";
?>

<style>
.dataTable-info{
    color: white;
}

/* Elegant action buttons */
.action-btn {
    display: inline-flex;
    align-items: center;
    justify-content: center;
    padding: 6px 16px;
    border-radius: 20px;
    border: 1.5px solid transparent;
    font-size: 13px;
    font-weight: 600;
    letter-spacing: 0.02em;
    background-color: transparent;
    transition: all 0.2s ease-in-out;
}
.action-btn:hover {
    transform: translateY(-1px);
}
.action-btn.btn-view {
    border-color: #2563eb;
    color: #2563eb;
}
.action-btn.btn-view:hover {
    background-color: #2563eb;
    color: #fff;
    box-shadow: 0 4px 10px rgba(37,99,235,0.25);
}
.action-btn.btn-edit {
    border-color: #d97706;
    color: #d97706;
}
.action-btn.btn-edit:hover {
    background-color: #d97706;
    color: #fff;
    box-shadow: 0 4px 10px rgba(217,119,6,0.25);
}
.action-btn.btn-delete {
    border-color: #dc2626;
    color: #dc2626;
}
.action-btn.btn-delete:hover {
    background-color: #dc2626;
    color: #fff;
    box-shadow: 0 4px 10px rgba(220,38,38,0.25);
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
        <i class="bi bi-arrow-left-circle"></i> Back
    </button>
    </div>

    <div class="col-12 mb-2 mt-2" style="text-align: right;">
        <a href="{{ route('eminit.eminit.createeminit') }}" class="btn btn-primary" title="Add E-Memo">
            <i class="bi bi-plus-lg me-1"></i> Add E-Memo
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
                            <th scope="col">Category</th>
                            <th scope="col">Memo From</th>
                            <th scope="col">To</th>
                            <th scope="col">Subject</th>
                            <th scope="col">No Reference (Memo Recieved)</th>
                            <th scope="col">Date</th>
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
                                    <i class="bi bi-hourglass-split me-1"></i>Not Yet Received
                                    </span>
                                @endif
                                </td>

                                <td>
                                    {{
                                        optional(\App\Models\Eminit_Tindakandiperlukan::where('ic_no', $eminit->ic_no)->first())->kod ?? '-'
                                    }}
                                </td>

                                <td>
                                    @php
                                        $actionByIc = optional($eminit->latestAdminEntry)->created_by;
                                        $actionByKod = $actionByIc
                                            ? optional(\App\Models\Eminit_Tindakandiperlukan::where('ic_no', $actionByIc)->first())->kod
                                            : null;
                                    @endphp
                                    {{ $actionByKod ? \Illuminate\Support\Str::title($actionByKod) : '-' }}
                                </td>
                      
                                <td>

                                    <div class="d-flex gap-2">

                                    @if(auth()->check() && $eminit->ic_no === auth()->user()->ic_no)
                                        <!----Edit Button----->
                                        <form method="get" action="{{ route('eminit.eminit.editeminit', $eminit-> id ) }}">
                                            @csrf
                                            <button type="submit" class="action-btn btn-edit">
                                                Edit
                                            </button>
                                        </form>
                                        <!----Delete Button----->
                                        <form method="post" action="{{ route('eminit.eminit.destroy', $eminit->id ) }}">
                                        @csrf
                                        @method('delete')
                                        <button type="submit" class="action-btn btn-delete">
                                            Delete
                                        </button>
                                        </form>

                                    @else
                                    <form method="get" action="{{ route('eminit.eminit.editeminit', $eminit-> id ) }}">
                                            @csrf
                                            <button type="submit" class="action-btn btn-view">
                                                View
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
{{-- #========== NEWLY ADDED ============ --}}
</div>{{-- end .mesh-home-theme --}}
{{-- #================================ --}}
@endsection