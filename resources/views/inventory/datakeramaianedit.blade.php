@extends('layouts.app-all')

@section('title', 'Edit Data Keramaian')

@section('content')

<?php
$pagename = "Inventory";
?>

<div class="pagetitle">
    <h1>Data Keramaian Pelajar</h1>
    <nav>
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="{{ route('home') }}">Home</a></li>
            <li class="breadcrumb-item"><a href="{{ route('inventory.datakeramaianindex') }}">Data Keramaian</a></li> 
            <li class="breadcrumb-item active">Edit</li> 
        </ol>
    </nav>
</div><!-- End Page Title -->

<section class="section profile">

    <a href="{{ route('inventory.datakeramaianindex') }}" class="btn btn-primary text-right mb-2">
        <i class="bi bi-arrow-left-circle"></i>
    </a>

    <!-- QO Table -->
    <div class="col-12">
        <div class="card recent-sales" style="border-radius:10px;">
            <div class="card-body">
                <div class="profile-overview pt-3">
                    <h3 class="card-title">Edit Jumlah Pelajar</h3>
                    
                    <form method="post" action="{{ route('inventory.datakeramaianupdate', ['id' => $id]) }}"enctype="multipart/form-data">
                        @csrf
                        <div class="col profile-overview" style="border: 2px solid #012970; padding: 20px; border-radius: 25px;">
                            <h5 class="card-title" name="school_name" value="{{ $schoolNameMapping[$selectedSchool->school_name] }}">
                                {{ $schoolNameMapping[$selectedSchool->school_name] }}
                            </h5>
                            <div class="card">
                            @if ($source === 'SR')
                            <table class="table-achiev">
                                <thead>
                                    <tr>
                                        <th style="text-align: center;">Pra Sekolah</th>
                                        <th style="text-align: center;">Tahun 1</th>
                                        <th style="text-align: center;">Tahun 2</th>
                                        <th style="text-align: center;">Tahun 3</th>
                                        <th style="text-align: center;">Tahun 4</th>
                                        <th style="text-align: center;">Tahun 5</th>
                                        <th style="text-align: center;">Tahun 6</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <tr>
                                        @php
                                        // Check if data exists for the current school in studentInvPTE
                                        $schoolDataExists = $studentInv->where('school_name', $schoolNameMapping[$selectedSchool->school_name])->isNotEmpty();
                                        @endphp

                                        @if ($schoolDataExists && $studentData = $studentInv->where('school_name', $schoolNameMapping[$selectedSchool->school_name])->first())
                                        <td>
                                            <input type="text" name="pra_sekolah" value="{{ $studentData->pra_sekolah }}" class="form-control">
                                            {!! $errors->first('tahun_1', '<p class="help-block text-danger">:message</p>') !!}
                                        </td>
                                        <td>
                                            <input type="text" name="tahun_1" value="{{ $studentData->tahun_1 }}" class="form-control">
                                            {!! $errors->first('tahun_1', '<p class="help-block text-danger">:message</p>') !!}
                                        </td>
                                        <td>
                                            <input type="text" name="tahun_2" value="{{ $studentData->tahun_2 }}" class="form-control">
                                            {!! $errors->first('tahun_2', '<p class="help-block text-danger">:message</p>') !!}
                                        </td>
                                        <td>
                                            <input type="text" name="tahun_3" value="{{ $studentData->tahun_3 }}" class="form-control">
                                            {!! $errors->first('tahun_3', '<p class="help-block text-danger">:message</p>') !!}
                                        </td>
                                        <td>
                                            <input type="text" name="tahun_4" value="{{ $studentData->tahun_4 }}" class="form-control">
                                            {!! $errors->first('tahun_4', '<p class="help-block text-danger">:message</p>') !!}
                                        </td>
                                        <td>
                                            <input type="text" name="tahun_5" value="{{ $studentData->tahun_5 }}" class="form-control">
                                            {!! $errors->first('tahun_5', '<p class="help-block text-danger">:message</p>') !!}
                                        </td>
                                        <td>
                                            <input type="text" name="tahun_6" value="{{ $studentData->tahun_6 }}" class="form-control">
                                            {!! $errors->first('tahun_6', '<p class="help-block text-danger">:message</p>') !!}
                                        </td>
                                        @else {{-- If no data in StudentInv, use data from CCA --}}
                                        <td>
                                            <input type="text" name="pra_sekolah" value="{{ $schoolTotals[$schoolData->id]['jumlahPraSekolah'] }}" class="form-control">
                                            {!! $errors->first('pra_sekolah', '<p class="help-block text-danger">:message</p>') !!}
                                        </td>
                                        <td>
                                            <input type="text" name="tahun_1" value="{{ $schoolTotals[$schoolData->id]['jumlahTahun1'] }}" class="form-control">
                                            {!! $errors->first('tahun_1', '<p class="help-block text-danger">:message</p>') !!}
                                        </td>
                                        <td>
                                            <input type="text" name="tahun_2" value="{{ $schoolTotals[$schoolData->id]['jumlahTahun2'] }}" class="form-control">
                                            {!! $errors->first('tahun_2', '<p class="help-block text-danger">:message</p>') !!}
                                        </td>
                                        <td>
                                            <input type="text" name="tahun_3" value="{{ $schoolTotals[$schoolData->id]['jumlahTahun3'] }}" class="form-control">
                                            {!! $errors->first('tahun_3', '<p class="help-block text-danger">:message</p>') !!}
                                        </td>
                                        <td>
                                            <input type="text" name="tahun_4" value="{{ $schoolTotals[$schoolData->id]['jumlahTahun4'] }}" class="form-control">
                                            {!! $errors->first('tahun_4', '<p class="help-block text-danger">:message</p>') !!}
                                        </td>
                                        <td>
                                            <input type="text" name="tahun_5" value="{{ $schoolTotals[$schoolData->id]['jumlahTahun5'] }}" class="form-control">
                                            {!! $errors->first('tahun_5', '<p class="help-block text-danger">:message</p>') !!}
                                        </td>
                                        <td>
                                            <input type="text" name="tahun_6" value="{{ $schoolTotals[$schoolData->id]['jumlahTahun6'] }}" class="form-control">
                                            {!! $errors->first('tahun_6', '<p class="help-block text-danger">:message</p>') !!}
                                        </td>
                                        @endif
                                    </tr>
                                </tbody>
                            </table>
                            @elseif ($source === 'SM')
                                <table class="table-achiev">
                                    <thead>
                                        <tr>
                                            <th style="text-align: center;">Tahun 7</th>
                                            <th style="text-align: center;">Tahun 8</th>
                                            <th style="text-align: center;">Tahun 9</th>
                                            <th style="text-align: center;">Tahun 10</th>
                                            <th style="text-align: center;">Tahun 11</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <tr>
                                            @php
                                            // Check if data exists for the current school in studentInvPTE
                                            $schoolDataExists = $studentInv->where('school_name', $schoolNameMapping[$selectedSchool->school_name])->isNotEmpty();
                                            @endphp
                                            
                                            @if ($schoolDataExists && $studentData = $studentInv->where('school_name', $schoolNameMapping[$selectedSchool->school_name])->first())
                                            <td>
                                                <input type="text" name="tahun_7" value="{{ $studentData->tahun_7 }}" class="form-control">
                                                {!! $errors->first('tahun_7', '<p class="help-block text-danger">:message</p>') !!}
                                            </td>
                                            <td>
                                                <input type="text" name="tahun_8" value="{{ $studentData->tahun_8 }}" class="form-control">
                                                {!! $errors->first('tahun_8', '<p class="help-block text-danger">:message</p>') !!}
                                            </td>
                                            <td>
                                                <input type="text" name="tahun_9" value="{{ $studentData->tahun_9 }}" class="form-control">
                                                {!! $errors->first('tahun_9', '<p class="help-block text-danger">:message</p>') !!}
                                            </td>
                                            <td>
                                                <input type="text" name="tahun_10" value="{{ $studentData->tahun_10 }}" class="form-control">
                                                {!! $errors->first('tahun_10', '<p class="help-block text-danger">:message</p>') !!}
                                            </td>
                                            <td>
                                                <input type="text" name="tahun_11" value="{{ $studentData->tahun_11 }}" class="form-control">
                                                {!! $errors->first('tahun_11', '<p class="help-block text-danger">:message</p>') !!}
                                            </td>
                                            @else {{-- If no data in StudentInv, use data from CCA --}}
                                            <td>
                                                <input type="text" name="tahun_7" value="{{ $schoolTotals[$schoolData->id]['jumlahTahun7'] }}" class="form-control">
                                                {!! $errors->first('tahun_7', '<p class="help-block text-danger">:message</p>') !!}
                                            </td>
                                            <td>
                                                <input type="text" name="tahun_8" value="{{ $schoolTotals[$schoolData->id]['jumlahTahun8'] }}" class="form-control">
                                                {!! $errors->first('tahun_8', '<p class="help-block text-danger">:message</p>') !!}
                                            </td>
                                            <td>
                                                <input type="text" name="tahun_9" value="{{ $schoolTotals[$schoolData->id]['jumlahTahun9'] }}" class="form-control">
                                                {!! $errors->first('tahun_9', '<p class="help-block text-danger">:message</p>') !!}
                                            </td>
                                            <td>
                                                <input type="text" name="tahun_10" value="{{ $schoolTotals[$schoolData->id]['jumlahTahun10'] }}" class="form-control">
                                                {!! $errors->first('tahun_10', '<p class="help-block text-danger">:message</p>') !!}
                                            </td>
                                            <td>
                                                <input type="text" name="tahun_11" value="{{ $schoolTotals[$schoolData->id]['jumlahTahun11'] }}" class="form-control">
                                                {!! $errors->first('tahun_11', '<p class="help-block text-danger">:message</p>') !!}
                                            </td>
                                            @endif
                                        </tr>
                                    </tbody>
                                </table> 
                            @elseif ($source === 'PTE')
                                <table class="table-achiev">
                                    <thead>
                                        <tr>
                                            <th style="text-align: center;">6 Bawah</th>
                                            <th style="text-align: center;">6 Atas</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <tr>
                                            @php
                                            // Check if data exists for the current school in studentInvPTE
                                            $schoolDataExists = $studentInv->where('school_name', $schoolNameMapping[$selectedSchool->school_name])->isNotEmpty();
                                            @endphp
                                            @if ($schoolDataExists && $studentData = $studentInv->where('school_name', $schoolNameMapping[$selectedSchool->school_name])->first())
                                            <td>
                                                <input type="text" name="prau_1" value="{{ $studentData->prau_1 }}" class="form-control">
                                                {!! $errors->first('prau_1', '<p class="help-block text-danger">:message</p>') !!}
                                            </td>
                                            <td>
                                                <input type="text" name="prau_2" value="{{ $studentData->prau_2 }}" class="form-control">
                                                {!! $errors->first('prau_2', '<p class="help-block text-danger">:message</p>') !!}
                                            </td>
                                            @else {{-- If no data in StudentInv, use data from CCA --}}
                                            <td>
                                                <input type="text" name="prau_1" value="{{ $schoolTotals[$schoolData->id]['jumlahEnamBawah'] }}" class="form-control">
                                                {!! $errors->first('prau_1', '<p class="help-block text-danger">:message</p>') !!}
                                            </td>
                                            <td>
                                                <input type="text" name="prau_2" value="{{ $schoolTotals[$schoolData->id]['jumlahEnamAtas'] }}" class="form-control">
                                                {!! $errors->first('prau_2', '<p class="help-block text-danger">:message</p>') !!}
                                            </td>
                                            @endif
                                        </tr>
                                    </tbody>
                                </table>
                            @elseif ($source === 'SM/PTE')
                                <table class="table-achiev">
                                    <thead>
                                        <tr>
                                            <th style="text-align: center;">Tahun 7</th>
                                            <th style="text-align: center;">Tahun 8</th>
                                            <th style="text-align: center;">Tahun 9</th>
                                            <th style="text-align: center;">Tahun 10</th>
                                            <th style="text-align: center;">Tahun 11</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <tr>
                                            @php
                                            // Check if data exists for the current school in studentInvPTE
                                            $schoolDataExists = $studentInv->where('school_name', $schoolNameMapping[$selectedSchool->school_name])->isNotEmpty();
                                            @endphp
                                            @if ($schoolDataExists && $studentData = $studentInv->where('school_name', $schoolNameMapping[$selectedSchool->school_name])->first())
                                            <td>
                                                <input type="text" name="tahun_7" value="{{ $studentData->tahun_7 }}" class="form-control">
                                                {!! $errors->first('tahun_7', '<p class="help-block text-danger">:message</p>') !!}
                                            </td>
                                            <td>
                                                <input type="text" name="tahun_8" value="{{ $studentData->tahun_8 }}" class="form-control">
                                                {!! $errors->first('tahun_8', '<p class="help-block text-danger">:message</p>') !!}
                                            </td>
                                            <td>
                                                <input type="text" name="tahun_9" value="{{ $studentData->tahun_9 }}" class="form-control">
                                                {!! $errors->first('tahun_9', '<p class="help-block text-danger">:message</p>') !!}
                                            </td>
                                            <td>
                                                <input type="text" name="tahun_10" value="{{ $studentData->tahun_10 }}" class="form-control">
                                                {!! $errors->first('tahun_10', '<p class="help-block text-danger">:message</p>') !!}
                                            </td>
                                            <td>
                                                <input type="text" name="tahun_11" value="{{ $studentData->tahun_11 }}" class="form-control">
                                                {!! $errors->first('tahun_11', '<p class="help-block text-danger">:message</p>') !!}
                                            </td>
                                            @else {{-- If no data in StudentInv, use data from CCA --}}
                                            <td>
                                                <input type="text" name="tahun_7" value="{{ $schoolTotals[$schoolData->id]['jumlahTahun7'] }}" class="form-control">
                                                {!! $errors->first('tahun_7', '<p class="help-block text-danger">:message</p>') !!}
                                            </td>
                                            <td>
                                                <input type="text" name="tahun_8" value="{{ $schoolTotals[$schoolData->id]['jumlahTahun8'] }}" class="form-control">
                                                {!! $errors->first('tahun_8', '<p class="help-block text-danger">:message</p>') !!}
                                            </td>
                                            <td>
                                                <input type="text" name="tahun_9" value="{{ $schoolTotals[$schoolData->id]['jumlahTahun9'] }}" class="form-control">
                                                {!! $errors->first('tahun_9', '<p class="help-block text-danger">:message</p>') !!}
                                            </td>
                                            <td>
                                                <input type="text" name="tahun_10" value="{{ $schoolTotals[$schoolData->id]['jumlahTahun10'] }}" class="form-control">
                                                {!! $errors->first('tahun_10', '<p class="help-block text-danger">:message</p>') !!}
                                            </td>
                                            <td>
                                                <input type="text" name="tahun_11" value="{{ $schoolTotals[$schoolData->id]['jumlahTahun11'] }}" class="form-control">
                                                {!! $errors->first('tahun_11', '<p class="help-block text-danger">:message</p>') !!}
                                            </td>
                                            @endif
                                        </tr>
                                    </tbody>
                                </table>

                                <table class="table-achiev">
                                    <thead>
                                        <tr>
                                            <th style="text-align: center;">6 Bawah</th>
                                            <th style="text-align: center;">6 Atas</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <tr>
                                            @php
                                            // Check if data exists for the current school in studentInvPTE
                                            $schoolDataExists = $studentInv->where('school_name', $schoolNameMapping[$selectedSchool->school_name])->isNotEmpty();
                                            @endphp
                                            @if ($schoolDataExists && $studentData = $studentInv->where('school_name', $schoolNameMapping[$selectedSchool->school_name])->first())
                                            <td>
                                                <input type="text" name="prau_1" value="{{ $studentData->prau_1 }}" class="form-control">
                                                {!! $errors->first('prau_1', '<p class="help-block text-danger">:message</p>') !!}
                                            </td>
                                            <td>
                                                <input type="text" name="prau_2" value="{{ $studentData->prau_2 }}" class="form-control">
                                                {!! $errors->first('prau_2', '<p class="help-block text-danger">:message</p>') !!}
                                            </td>
                                            @else {{-- If no data in StudentInv, use data from CCA --}}
                                            <td>
                                                <input type="text" name="prau_1" value="{{ $schoolTotals[$schoolData->id]['jumlahEnamBawah'] }}" class="form-control">
                                                {!! $errors->first('prau_1', '<p class="help-block text-danger">:message</p>') !!}
                                            </td>
                                            <td>
                                                <input type="text" name="prau_2" value="{{ $schoolTotals[$schoolData->id]['jumlahEnamAtas'] }}" class="form-control">
                                                {!! $errors->first('prau_2', '<p class="help-block text-danger">:message</p>') !!}
                                            </td>
                                            @endif
                                        </tr>
                                    </tbody>
                                </table>
                            @endif
                            </div>
                            <div class="text-right" style="padding-right:20px;">
                                <button type="submit" class="btn btn-primary">Update</button>
                            </div>
                        </div>
                    </form>

                </div>
            </div>
        </div>
    </div>
</section>
@endsection