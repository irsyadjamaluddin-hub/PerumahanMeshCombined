@extends('layouts.app-all')

@section('title', 'Edit CDD Inventory')

@section('content')

<?php
$pagename = "Cddinventory";
?>

@if(session('success_message'))
    <div class="alert alert-success">
        {{ session('success_message') }}
    </div>
@endif

<div class="card">
      <div class="card-body mt-3">
        <h5 class="card-title" style="text-align: center; color: white; padding: 10px; border-radius: 0px; background-color: #1F4E78;">Bahan-Bahan Kurikulum</h5>

        <div class="col-lg-12 overflow-auto">
        <form class=" search-form d-flex align-items-center" method="POST" action="{{ route('cddinventory.cddinventory.updatecddinfoadmin') }}">
          <table class="table table-bordered">
            <tbody>
                            
                    @foreach ($inventorynormalbbk as $inventorynormalbbk)
                        @csrf   
                            <input type="text" name="id" class="bg-gray-200 form-control " value="{{$inventorynormalbbk->id}}" hidden>
                            <tr>
                                <th scope="row">Mata Pelajaran</th>
                                <td><input type="text"  value="{{$inventorynormalbbk->matapelajaran}}" class="form-control" readonly></td>
                            </tr>
                            <tr>
                                <th scope="row">Judul Bahan</th>
                                <td><input type="text" value="{{$inventorynormalbbk->judulbahan}}" class="form-control"readonly></td>
                            </tr> 
                            <tr>
                                <th scope="row">ISBN No.</th>
                                <td><input type="text" value="{{$inventorynormalbbk->isbn}}" class="form-control"readonly></td>
                            </tr>
                            <tr>
                                <th scope="row">Pengarang/Penerbit</th>
                                <td><input type="text"  value="{{$inventorynormalbbk->pengarang_penerbit}}" class="form-control" readonly></td>
                            </tr>      
                            <tr>
                                <th scope="row">Kuantiti DiPohonkan</th>
                                <td><input type="text"  value="{{$inventorynormalbbk->qty_dipohonkan}}" class="form-control"readonly></td>
                            </tr>
                            <tr>
                                <th scope="row">Sebab Permohonan</th>
                                <td>
                                <textarea  type="text"  value="{{$inventorynormalbbk->sebab_permohonan}}" class="form-control" readonly>{{$inventorynormalbbk->sebab_permohonan}}</textarea>
                                </td>
                            </tr>      
                    @endforeach
            </tbody>
          </table>
          </div>

        <h5 class="card-title" style="text-align: center; color: white; padding: 10px; border-radius: 0px; background-color: #1F4E78;">Admin</h5>

        <div class="col-lg-12 overflow-auto">
          <table class="table table-bordered">
            <tbody>           
                <tr>
                    <th scope="row">Kuantiti Diluluskan</th>
                    <td><input type="text" name="cdd_qty_diluluskan" value="{{$inventorynormalbbk->cdd_qty_diluluskan}}" class="form-control"></td>
                </tr>
                <tr>
                    <th scope="row">Catatan</th>
                    <td><textarea name="cdd_catatan" class="form-control">{{$inventorynormalbbk->cdd_catatan}}</textarea></td>  </tr> 

                <tr>
                    <th scope="row">Status</th>
                    <td>
                    <select name="cdd_status" class="form-control">
                                <option value="" {{ $inventorynormalbbk->cdd_status == NULL ? 'selected' : '' }}>Please Select</option>
                                <option value="Borang Pengeluaran" {{ $inventorynormalbbk->cdd_status == 'Borang Pengeluaran' ? 'selected' : '' }}>Surat Pengeluaran</option>
                                <option value="Sebutharga" {{ $inventorynormalbbk->cdd_status == 'Sebutharga' ? 'selected' : '' }}>Sebutharga</option>
                                <option value="Rejected" {{ $inventorynormalbbk->cdd_status == 'Rejected' ? 'selected' : '' }}>Rejected</option>
                                <option value="In Process" {{ $inventorynormalbbk->cdd_status == 'In Process' ? 'selected' : '' }}>In Process</option>
                            </select>

                    </td>
                </tr>
                              
            </tbody>
          </table>
          </div>
          
         <div class="text-center"> <button type="submit" class="btn btn-primary">Submit</button> </div>
        </form>
       
      </div>
    </div>

    </section>
@endsection