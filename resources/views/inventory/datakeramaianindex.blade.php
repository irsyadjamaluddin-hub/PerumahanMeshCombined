@extends('layouts.app-all')

@section('title', 'Data Keramaian Pelajar')

@section('content')

<?php
    $pagename = "Inventory";
?>

    <div class="pagetitle">
    <h1>Data Keramaian Pelajar</h1>
    <nav>
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="{{ route('home') }}">Home</a></li>
            <li class="breadcrumb-item active">Data Keramaian</li> 
        </ol>
    </nav>
    </div><!-- End Page Title -->

    <section class="section profile">

        <!--  Index Table -->
            @if(Session::has('success_message'))
            <div class="alert alert-success">
                <i class=" fas fa-fw fa-check"></i>
                {!! session('success_message') !!}
            </div>
            @endif

    <div class="col-12">
        <div class="card">

            <!-- Default Tabs -->
            <ul class="nav nav-tabs d-flex" id="myTabjustified" role="tablist">
                <li class="nav-item flex-fill" role="presentation">
                    <button class="nav-link w-100 active" id="PeringkatRendah-tab" data-bs-toggle="tab" data-bs-target="#PeringkatRendah-justified" type="button" role="tab" aria-controls="PeringkatRendah" aria-selected="true">Peringkat Rendah</button>
                </li>
                <li class="nav-item flex-fill" role="presentation">
                    <button class="nav-link w-100" id="PeringkatMenengah-tab" data-bs-toggle="tab" data-bs-target="#PeringkatMenengah-justified" type="button" role="tab" aria-controls="PeringkatMenengah" aria-selected="false">Peringkat Menengah</button>
                </li>
                <li class="nav-item flex-fill" role="presentation">
                    <button class="nav-link w-100" id="TingkatanEnam-tab" data-bs-toggle="tab" data-bs-target="#TingkatanEnam-justified" type="button" role="tab" aria-controls="TingkatanEnam" aria-selected="false">Tingkatan Enam</button>
                </li>
            </ul>

            <div class="tab-content pt-2" id="myTabjustifiedContent">

            <!-- Peringkat Rendah Table -->
                <div class="tab-pane fade show active" id="PeringkatRendah-justified" role="tabpanel" aria-labelledby="PeringkatRendah-tab">
                    <div class="card-body overflow-auto">
                        <table class="table table-borderless datatable mt-3">
                            <thead>
                                <tr>
                                    <th scope="col" style="text-align: center;">No.</th>
                                    <th scope="col" style="text-align: center;">Nama Sekolah</th>
                                    <th scope="col" style="text-align: center;">Kluster</th>
                                    <th scope="col" style="text-align: center;">Pra Sekolah</th>
                                    <th scope="col" style="text-align: center;">Tahun 1</th>
                                    <th scope="col" style="text-align: center;">Tahun 2</th>
                                    <th scope="col" style="text-align: center;">Tahun 3</th>
                                    <th scope="col" style="text-align: center;">Tahun 4</th>
                                    <th scope="col" style="text-align: center;">Tahun 5</th>
                                    <th scope="col" style="text-align: center;">Tahun 6</th>
                                    <th scope="col" style="text-align: center;">Jumlah</th>
                                    <th scope="col" style="text-align: center;">Action</th>
                                </tr>
                            </thead>
                            <tbody>
                            @foreach ($schoolnameSR as $schoolSR)
                            <tr style="text-align: center;">
                                    <td>{{ $loop->iteration }}</td>
                                    <td style="text-align: justify; width: 300px;" name="school" value="{{ $schoolSR->school_name }}">
                                        @if (isset($schoolNameMapping[$schoolSR->school_name]))
                                            {{ $schoolNameMapping[$schoolSR->school_name] }}
                                        @endif
                                    </td>
                                    <td>{{ $schoolSR->kluster }}</td>
                                    {{-- <td>{{ $schoolSources[$schoolSR->school_name] }}</td> --}}
                                    @php
                                        // Check if data exists for the current school in studentInvSM
                                        $schoolDataExists = $studentInv->where('school_name', $schoolNameMapping[$schoolSR->school_name])->isNotEmpty();
                                    @endphp
                                    @if ($schoolDataExists)
                                        @foreach ($studentInv as $studentSR)
                                            @if ($studentSR->school_name == ($schoolNameMapping[$schoolSR->school_name] ?? ''))
                                                <td>{{ $studentSR->pra_sekolah }}</td>
                                                <td>{{ $studentSR->tahun_1 }}</td>
                                                <td>{{ $studentSR->tahun_2 }}</td>
                                                <td>{{ $studentSR->tahun_3 }}</td>
                                                <td>{{ $studentSR->tahun_4 }}</td>
                                                <td>{{ $studentSR->tahun_5 }}</td>
                                                <td>{{ $studentSR->tahun_6 }}</td>
                                                <td>{{ $studentSR->pra_sekolah + $studentSR->tahun_1 + $studentSR->tahun_2 + $studentSR->tahun_3 + $studentSR->tahun_4 + $studentSR->tahun_5 + $studentSR->tahun_6}}</td>
                                            @endif
                                        @endforeach
                                    @else
                                        <td>{{ $schoolTotals[$schoolSR->school_name]['jumlahPraSekolah'] ?? 0 }}</td>
                                        <td>{{ $schoolTotals[$schoolSR->school_name]['jumlahTahun1'] ?? 0 }}</td>
                                        <td>{{ $schoolTotals[$schoolSR->school_name]['jumlahTahun2'] ?? 0 }}</td>
                                        <td>{{ $schoolTotals[$schoolSR->school_name]['jumlahTahun3'] ?? 0 }}</td>
                                        <td>{{ $schoolTotals[$schoolSR->school_name]['jumlahTahun4'] ?? 0 }}</td>
                                        <td>{{ $schoolTotals[$schoolSR->school_name]['jumlahTahun5'] ?? 0 }}</td>
                                        <td>{{ $schoolTotals[$schoolSR->school_name]['jumlahTahun6'] ?? 0 }}</td>
                                        <td>{{ ($schoolTotals[$schoolSR->school_name]['jumlahTahunPraSekolah'] ?? 0) +
                                            ($schoolTotals[$schoolSR->school_name]['jumlahTahun1'] ?? 0) +
                                            ($schoolTotals[$schoolSR->school_name]['jumlahTahun2'] ?? 0) +
                                            ($schoolTotals[$schoolSR->school_name]['jumlahTahun3'] ?? 0) +
                                            ($schoolTotals[$schoolSR->school_name]['jumlahTahun4'] ?? 0) +
                                            ($schoolTotals[$schoolSR->school_name]['jumlahTahun5'] ?? 0) +
                                            ($schoolTotals[$schoolSR->school_name]['jumlahTahun6'] ?? 0) }}</td>
                                    @endif
                                    <td>
                                        <form method="get" action="{{ route('inventory.datakeramaianedit', ['id' => $schoolSR['id']]) }}">
                                            @csrf
                                            <button type="submit" class="btn btn-outline-primary mr-2">
                                                <i class="bi bi-pencil-fill"></i>
                                            </button>
                                        </form>
                                    </td>
                                </tr>
                            @endforeach
                            </tbody>
                        </table>
                    </div>

                    <!-- Jumlah Seluruh Pelajar Table -->
                    <div class="col-12">
                        <div class="card" style="padding-top:20px;">
                            <div class="card-body overflow-auto">

                                <table class="table table-bordered" style="border-top: 2px solid currentColor;">
                                    <thead>
                                        <tr>
                                            <th scope="col" style="text-align: center; width: 150px; background: #e9ecef;"></th>
                                            <th scope="col" style="text-align: center; background: #e9ecef;">Pra Sekolah</th>
                                            <th scope="col" style="text-align: center; background: #e9ecef;">Tahun 1</th>
                                            <th scope="col" style="text-align: center; background: #e9ecef;">Tahun 2</th>
                                            <th scope="col" style="text-align: center; background: #e9ecef;">Tahun 3</th>
                                            <th scope="col" style="text-align: center; background: #e9ecef;">Tahun 4</th>
                                            <th scope="col" style="text-align: center; background: #e9ecef;">Tahun 5</th>
                                            <th scope="col" style="text-align: center; background: #e9ecef;">Tahun 6</th>
                                            <th scope="col" style="text-align: center; background: #d8f9ff;">Jumlah</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <tr style="text-align: center;">
                                            <td><b>Jumlah Pelajar</b></td>
                                            <td>{{ $totalStudentsPraSekolah }}</td>
                                            <td>{{ $totalStudentsTahun1 }}</td>
                                            <td>{{ $totalStudentsTahun2 }}</td>
                                            <td>{{ $totalStudentsTahun3 }}</td>
                                            <td>{{ $totalStudentsTahun4 }}</td>
                                            <td>{{ $totalStudentsTahun5 }}</td>
                                            <td>{{ $totalStudentsTahun6 }}</td>
                                            <td>{{ $totalStudentsPraSekolah + $totalStudentsTahun1 + $totalStudentsTahun2 + $totalStudentsTahun3 
                                            + $totalStudentsTahun4 + $totalStudentsTahun5 + $totalStudentsTahun6 }}</td>
                                        </tr>
                                    </tbody>
                                </table>

                            </div>
                        </div>
                    </div><!-- END Jumlah Seluruh Pelajar Table -->
                </div><!-- END Peringkat Rendah Table -->

            <!-- Peringkat Menengah Table -->
                <div class="tab-pane fade show" id="PeringkatMenengah-justified" role="tabpanel" aria-labelledby="PeringkatMenengah-tab">
                    <div class="card-body overflow-auto">
                        <table class="table table-borderless datatable mt-3">
                            <thead>
                                <tr>
                                    <th scope="col" style="text-align: center;">No.</th>
                                    <th scope="col" style="text-align: center;">Nama Sekolah</th>
                                    <th scope="col" style="text-align: center;">Kluster</th>
                                    <th scope="col" style="text-align: center;">Tahun 7</th>
                                    <th scope="col" style="text-align: center;">Tahun 8</th>
                                    <th scope="col" style="text-align: center;">Tahun 9</th>
                                    <th scope="col" style="text-align: center;">Tahun 10</th>
                                    <th scope="col" style="text-align: center;">Tahun 11</th>
                                    <th scope="col" style="text-align: center;">Jumlah</th>
                                    <th scope="col" style="text-align: center;">Action</th>
                                </tr>
                            </thead>
                            <tbody>
                            @foreach ($schoolnameMaktab as $schoolMaktab)
                            <tr style="text-align: center;">
                                    <td>{{ $loop->iteration }}</td>
                                    <td style="text-align: justify; width: 300px;" name="school" value="{{ $schoolMaktab->school_name }}">
                                        @if (isset($schoolNameMapping[$schoolMaktab->school_name]))
                                            {{ $schoolNameMapping[$schoolMaktab->school_name] }}
                                        @endif
                                    </td>
                                    <td>{{ $schoolMaktab->kluster }}</td>
                                    {{-- <td>{{ $schoolSources[$schoolMaktab->school_name] }}</td> --}}
                                    @php
                                        // Check if data exists for the current school in studentInvSM
                                        $schoolDataExists = $studentInv->where('school_name', $schoolNameMapping[$schoolMaktab->school_name])->isNotEmpty();
                                    @endphp
                                    @if ($schoolDataExists)
                                        @foreach ($studentInv as $studentMaktab)
                                            @if ($studentMaktab->school_name == ($schoolNameMapping[$schoolMaktab->school_name] ?? ''))
                                                <td>{{ $studentMaktab->tahun_7 }}</td>
                                                <td>{{ $studentMaktab->tahun_8 }}</td>
                                                <td>{{ $studentMaktab->tahun_9 }}</td>
                                                <td>{{ $studentMaktab->tahun_10 }}</td>
                                                <td>{{ $studentMaktab->tahun_11 }}</td>
                                                <td>{{ $studentMaktab->tahun_7 + $studentMaktab->tahun_8 + $studentMaktab->tahun_9 + $studentMaktab->tahun_10 + $studentMaktab->tahun_11}}</td>
                                            @endif
                                        @endforeach
                                    @else
                                        <td>{{ $schoolTotals[$schoolMaktab->school_name]['jumlahTahun7'] ?? 0 }}</td>
                                        <td>{{ $schoolTotals[$schoolMaktab->school_name]['jumlahTahun8'] ?? 0 }}</td>
                                        <td>{{ $schoolTotals[$schoolMaktab->school_name]['jumlahTahun9'] ?? 0 }}</td>
                                        <td>{{ $schoolTotals[$schoolMaktab->school_name]['jumlahTahun10'] ?? 0 }}</td>
                                        <td>{{ $schoolTotals[$schoolMaktab->school_name]['jumlahTahun11'] ?? 0 }}</td>
                                        <td>{{ ($schoolTotals[$schoolMaktab->school_name]['jumlahTahun7'] ?? 0) +
                                            ($schoolTotals[$schoolMaktab->school_name]['jumlahTahun8'] ?? 0) +
                                            ($schoolTotals[$schoolMaktab->school_name]['jumlahTahun9'] ?? 0) +
                                            ($schoolTotals[$schoolMaktab->school_name]['jumlahTahun10'] ?? 0) +
                                            ($schoolTotals[$schoolMaktab->school_name]['jumlahTahun11'] ?? 0) }}</td>
                                    @endif
                                    <td>
                                        <form method="get" action="{{ route('inventory.datakeramaianedit', ['id' => $schoolMaktab['id']]) }}">
                                            @csrf
                                            <button type="submit" class="btn btn-outline-primary mr-2">
                                                <i class="bi bi-pencil-fill"></i>
                                            </button>
                                        </form>
                                    </td>
                                </tr>
                            @endforeach

                            @foreach ($schoolnameSM as $schoolSM)
                                <tr style="text-align: center;">
                                    <td>{{ $loop->iteration + 1 }}</td>
                                    <td style="text-align: justify; width: 300px;" name="school" value="{{ $schoolSM->school_name }}">
                                        @if (isset($schoolNameMapping[$schoolSM->school_name]))
                                            {{ $schoolNameMapping[$schoolSM->school_name] }}
                                        @endif
                                    </td>
                                    <td>{{ $schoolSM->kluster }}</td>
                                    {{-- <td>{{ $schoolSources[$schoolSM->school_name] }}</td> --}}
                                    @php
                                        // Check if data exists for the current school in studentInvSM
                                        $schoolDataExists = $studentInv->where('school_name', $schoolNameMapping[$schoolSM->school_name])->isNotEmpty();
                                    @endphp
                                    @if ($schoolDataExists)
                                        @foreach ($studentInv as $studentSM)
                                            @if ($studentSM->school_name == ($schoolNameMapping[$schoolSM->school_name] ?? ''))
                                                <td>{{ $studentSM->tahun_7 }}</td>
                                                <td>{{ $studentSM->tahun_8 }}</td>
                                                <td>{{ $studentSM->tahun_9 }}</td>
                                                <td>{{ $studentSM->tahun_10 }}</td>
                                                <td>{{ $studentSM->tahun_11 }}</td>
                                                <td>{{ $studentSM->tahun_7 + $studentSM->tahun_8 + $studentSM->tahun_9 + $studentSM->tahun_10 + $studentSM->tahun_11}}</td>
                                            @endif
                                        @endforeach
                                    @else
                                        <td>{{ $schoolTotals[$schoolSM->school_name]['jumlahTahun7'] ?? 0 }}</td>
                                        <td>{{ $schoolTotals[$schoolSM->school_name]['jumlahTahun8'] ?? 0 }}</td>
                                        <td>{{ $schoolTotals[$schoolSM->school_name]['jumlahTahun9'] ?? 0 }}</td>
                                        <td>{{ $schoolTotals[$schoolSM->school_name]['jumlahTahun10'] ?? 0 }}</td>
                                        <td>{{ $schoolTotals[$schoolSM->school_name]['jumlahTahun11'] ?? 0 }}</td>
                                        <td>{{ ($schoolTotals[$schoolSM->school_name]['jumlahTahun7'] ?? 0) +
                                            ($schoolTotals[$schoolSM->school_name]['jumlahTahun8'] ?? 0) +
                                            ($schoolTotals[$schoolSM->school_name]['jumlahTahun9'] ?? 0) +
                                            ($schoolTotals[$schoolSM->school_name]['jumlahTahun10'] ?? 0) +
                                            ($schoolTotals[$schoolSM->school_name]['jumlahTahun11'] ?? 0) }}</td>
                                    @endif
                                    <td>
                                        <form method="get" action="{{ route('inventory.datakeramaianedit', ['id' => $schoolSM['id']]) }}">
                                            @csrf
                                            <button type="submit" class="btn btn-outline-primary mr-2">
                                                <i class="bi bi-pencil-fill"></i>
                                            </button>
                                        </form>
                                    </td>
                                </tr>
                            @endforeach
                            </tbody>
                        </table>
                    </div>

                    <!-- Jumlah Seluruh Pelajar Table -->
                    <div class="col-12">
                        <div class="card" style="padding-top:20px;">
                            <div class="card-body overflow-auto">

                                <table class="table table-bordered" style="border-top: 2px solid currentColor;">
                                    <thead>
                                        <tr>
                                            <th scope="col" style="text-align: center; width: 150px; background: #e9ecef;"></th>
                                            <th scope="col" style="text-align: center; background: #e9ecef;">Tahun 7</th>
                                            <th scope="col" style="text-align: center; background: #e9ecef;">Tahun 8</th>
                                            <th scope="col" style="text-align: center; background: #e9ecef;">Tahun 9</th>
                                            <th scope="col" style="text-align: center; background: #e9ecef;">Tahun 10</th>
                                            <th scope="col" style="text-align: center; background: #e9ecef;">Tahun 11</th>
                                            <th scope="col" style="text-align: center; background: #d8f9ff;">Jumlah</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <tr style="text-align: center;">
                                            <td><b>Jumlah Pelajar</b></td>
                                            <td>{{ $totalStudentsTahun7 }}</td>
                                            <td>{{ $totalStudentsTahun8 }}</td>
                                            <td>{{ $totalStudentsTahun9 }}</td>
                                            <td>{{ $totalStudentsTahun10 }}</td>
                                            <td>{{ $totalStudentsTahun11 }}</td>
                                            <td>{{ $totalStudentsTahun7 + $totalStudentsTahun8 + $totalStudentsTahun9 
                                                    + $totalStudentsTahun10 + $totalStudentsTahun11}}</td>
                                        </tr>
                                    </tbody>
                                </table>

                            </div>
                        </div>
                    </div><!-- END Jumlah Seluruh Pelajar Table -->
                </div><!-- END Peringkat Menengah Table -->

                <!-- Pusat Tingkatan 6 Table -->
                <div class="tab-pane fade show" id="TingkatanEnam-justified" role="tabpanel" aria-labelledby="TingkatanEnam-tab">
                    <div class="card-body overflow-auto">
                        <table class="table table-borderless datatable mt-3">
                            <thead>
                                <tr>
                                    <th scope="col" style="text-align: center;">No.</th>
                                    <th scope="col" style="text-align: center;">Nama Sekolah</th>
                                    <th scope="col" style="text-align: center;">Kluster</th>
                                    <th scope="col" style="text-align: center;">6 Bawah</th>
                                    <th scope="col" style="text-align: center;">6 Atas</th>
                                    <th scope="col" style="text-align: center;">Jumlah Pelajar</th> 
                                    <th scope="col" style="text-align: center;">Action</th>
                                </tr>
                            </thead>
                            <tbody>
                            @foreach ($schoolnameMaktab as $schoolMaktab)
                            <tr style="text-align: center;">
                                    <td>{{ $loop->iteration }}</td>
                                    <td style="text-align: justify; width: 300px;" name="school" value="{{ $schoolMaktab->school_name }}">
                                        @if (isset($schoolNameMapping[$schoolMaktab->school_name]))
                                            {{ $schoolNameMapping[$schoolMaktab->school_name] }}
                                        @endif
                                    </td>
                                    <td>{{ $schoolMaktab->kluster }}</td>
                                    {{-- <td>{{ $schoolSources[$schoolMaktab->school_name] }}</td> --}}
                                    @php
                                        // Check if data exists for the current school in studentInvSM
                                        $schoolDataExists = $studentInv->where('school_name', $schoolNameMapping[$schoolMaktab->school_name])->isNotEmpty();
                                    @endphp
                                    @if ($schoolDataExists)
                                        @foreach ($studentInv as $studentMaktab)
                                            @if ($studentMaktab->school_name == ($schoolNameMapping[$schoolMaktab->school_name] ?? ''))
                                                <td>{{ $studentMaktab->prau_1 }}</td>
                                                <td>{{ $studentMaktab->prau_2 }}</td>
                                                <td>{{ $studentMaktab->prau_1 + $studentMaktab->prau_2}}</td>
                                            @endif
                                        @endforeach
                                    @else
                                        <td>{{ $schoolTotals[$schoolMaktab->school_name]['jumlahEnamBawah'] ?? 0 }}</td>
                                        <td>{{ $schoolTotals[$schoolMaktab->school_name]['jumlahEnamAtas'] ?? 0 }}</td>
                                        <td>{{ ($schoolTotals[$schoolMaktab->school_name]['jumlahEnamBawah'] ?? 0) +
                                            ($schoolTotals[$schoolMaktab->school_name]['jumlahEnamAtas'] ?? 0 ) }}</td>
                                    @endif
                                    <td>
                                        <form method="get" action="{{ route('inventory.datakeramaianedit', ['id' => $schoolMaktab['id']]) }}">
                                            @csrf
                                            <button type="submit" class="btn btn-outline-primary mr-2">
                                                <i class="bi bi-pencil-fill"></i>
                                            </button>
                                        </form>
                                    </td>
                                </tr>
                            @endforeach

                                @foreach ($schoolnamePTE as $schoolPTE)
                                <tr style="text-align: center;">
                                    <td>{{ $loop->iteration + 1 }}</td>
                                    <td style="text-align: justify;  width: 300px;" name="school" value="{{ $schoolPTE->school_name }}">{{ $schoolNameMapping[$schoolPTE->school_name] }}</td>
                                    <td>{{ $schoolPTE->kluster }}</td>
                                    {{-- <td>{{ $schoolSources[$schoolPTE->school_name] }}</td> --}}
                                    @php
                                        // Check if data exists for the current school in studentInvPTE
                                        $schoolDataExists = $studentInv->where('school_name', $schoolNameMapping[$schoolPTE->school_name])->isNotEmpty();
                                    @endphp
                                    @if ($schoolDataExists)
                                        @foreach ($studentInv as $studentPTE)
                                            @if ($studentPTE->school_name == $schoolNameMapping[$schoolPTE->school_name])
                                                <td>{{ $studentPTE->prau_1 }}</td>
                                                <td>{{ $studentPTE->prau_2 }}</td>
                                                <td>{{ $studentPTE->prau_1 + $studentPTE->prau_2}}</td>
                                            @endif
                                        @endforeach
                                    @else
                                        <td>{{ $schoolTotals[$schoolPTE->school_name]['jumlahEnamBawah'] ?? 0 }}</td>
                                        <td>{{ $schoolTotals[$schoolPTE->school_name]['jumlahEnamAtas'] ?? 0 }}</td>
                                        <td>{{ ($schoolTotals[$schoolPTE->school_name]['jumlahEnamBawah'] ?? 0) + ($schoolTotals[$schoolPTE->school_name]['jumlahEnamAtas'] ?? 0) }}</td>
                                    @endif
                                    <td>
                                        <form method="get" action="{{ route('inventory.datakeramaianedit', ['id' => $schoolPTE->id]) }}">
                                            @csrf
                                            <button type="submit" class="btn btn-outline-primary mr-2">
                                                <i class="bi bi-pencil-fill"></i>
                                            </button>
                                        </form>
                                    </td>
                                </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>

                    <!-- Jumlah Seluruh Pelajar Table -->
                    <div class="col-12">
                        <div class="card" style="padding-top:20px;">
                            <div class="card-body overflow-auto">

                                <table class="table table-bordered" style="border-top: 2px solid currentColor;">
                                    <thead>
                                        <tr>
                                            <th scope="col" style="text-align: center; width: 150px; background: #e9ecef;"></th>
                                            <th scope="col" style="text-align: center; background: #e9ecef;">6 Bawah</th>
                                            <th scope="col" style="text-align: center; background: #e9ecef;">6 Atas</th>
                                            <th scope="col" style="text-align: center; background: #d8f9ff;">Jumlah</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <tr style="text-align: center;">
                                            <td><b>Jumlah Pelajar</b></td>
                                            <td>{{ $totalStudentsEnamBawah }}</td>
                                            <td>{{ $totalStudentsEnamAtas }}</td>
                                            <td>{{ $totalStudentsEnamBawah + $totalStudentsEnamAtas }}</td>
                                        </tr>
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div><!-- END Jumlah Seluruh Pelajar Table -->
                </div><!-- END Pusat Tingkatan 6 Table -->

            </div>
        </div>
    </div>

    </section>

<style>
.nav-tabs .nav-link.active, .nav-tabs .nav-item.show .nav-link {
    color: #495057;
    background-color: #f8fafc;
    border-color: #dee2e6 #dee2e6 #f8fafc;
}
</style>

@endsection