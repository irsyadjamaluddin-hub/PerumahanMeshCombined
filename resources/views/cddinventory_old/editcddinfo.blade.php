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
        <h5 class="card-title" style="text-align: center; color: white; padding: 10px; border-radius: 0px; background-color: #1F4E78;">Bahan-Bahan Kurikuum</h5>

        <div class="col-lg-12 overflow-auto">
        <form class=" search-form d-flex align-items-center" method="POST" action="{{ route('cddinventory.cddinventory.updateinfo') }}">
          <table class="table table-bordered">
            <tbody>
                            
                    @foreach ($inventorynormalbbk as $inventorynormalbbk)
                        @csrf   
                            <input type="text" name="id" class="bg-gray-200 form-control " value="{{$inventorynormalbbk->id}}" hidden>
                            
                            <tr>
                                <th scope="row">Mata Pelajaran</th>
                                <td><input type="text" name="matapelajaran" value="{{$inventorynormalbbk->matapelajaran}}" class="form-control" readonly></td>
                            </tr>
                            <tr>
                                <th scope="row">Judul Bahan</th>
                                <td><input type="text" name="judulbahan" value="{{$inventorynormalbbk->judulbahan}}" class="form-control" readonly></td>
                            </tr> 
                            <tr>
                                <th scope="row">ISBN No.</th>
                                <td><input type="text" name="isbn" value="{{$inventorynormalbbk->isbn}}" class="form-control" readonly></td>
                            </tr>
                            <tr>
                                <th scope="row">Pengarang/Penerbit</th>
                                <td><input type="text" name="pengarang_penerbit" value="{{$inventorynormalbbk->pengarang_penerbit}}" class="form-control" readonly></td>
                            </tr>      
                            <tr>
                                <th scope="row">Kuantiti DiPohonkan</th>
                                <td><input type="text" name="qty_dipohonkan" value="{{$inventorynormalbbk->qty_dipohonkan}}" class="form-control"></td>
                            </tr>
                            <tr>
                                <th scope="row">Sebab Permohonan</th>
                                <td>
                                <textarea  type="text" name="sebab_permohonan" value="{{$inventorynormalbbk->sebab_permohonan}}" class="form-control">{{$inventorynormalbbk->sebab_permohonan}}</textarea>
                                </td>
                            </tr>      
                    @endforeach
            </tbody>
          </table>
          </div>
      
        <div class="text-center"> <button type="submit" class="btn btn-primary">Submit</button> </div>
        </form>
       
      </div>
    </div>

    </section>
@endsection