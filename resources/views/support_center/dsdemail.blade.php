@extends('layouts.app-all')

@section('title', 'DevOps Admin Email')

@section('content')
<?php $pagename = "DevOps Admin Email"; ?>

<div class="section profile">

  <a href="{{ route('support-center.index') }}" class="btn btn-primary mb-2">
    <i class="bi bi-arrow-left-circle"></i>
  </a>

  @if(Session::has('success_message'))
    <div class="alert alert-success">
      <i class="fas fa-fw fa-check"></i>
      {!! session('success_message') !!}
    </div>
  @endif

  <div class="col-lg-12">
    <div class="card">
      <div class="card-body">

        <div class="profile-overview pt-3">
          <div class="col profile-overview overflow-auto" style="border:2px solid #012970; padding:20px; border-radius:25px;">
            <h3 class="card-title">Tambah Emel</h3>

            <form method="post" action="{{ route('support-center.admin-emails.store') }}" enctype="multipart/form-data">
              @csrf

              <table class="table-achiev" id="declare">
                <thead>
                  <tr>
                    <th class="text-center">IC No</th>
                    <th class="text-center">Emel</th>
                    <th class="text-center">Tel No</th>
                    <th class="text-center">Tindakan</th>
                  </tr>
                </thead>

                <tbody>
                  <tr class="text-center">
                    <td>
                      <input type="text" name="moreFields[0][ic_no]" id="ic_no_0"
                        class="form-control @error('moreFields.0.ic_no') bg-red-100 border-2 border-red-500 @enderror"
                        value="{{ old('moreFields.0.ic_no') }}">
                      @error('moreFields.0.ic_no')
                        <small class="text-danger">{{ $message }}</small>
                      @enderror
                    </td>

                    <td>
                      <input type="text" name="moreFields[0][email]" id="email_0"
                        class="form-control @error('moreFields.0.email') bg-red-100 border-2 border-red-500 @enderror"
                        value="{{ old('moreFields.0.email') }}">
                      @error('moreFields.0.email')
                        <small class="text-danger">{{ $message }}</small>
                      @enderror
                    </td>

                    <td>
                      <input type="text" name="moreFields[0][tel_no]" id="tel_no_0"
                        class="form-control @error('moreFields.0.tel_no') bg-red-100 border-2 border-red-500 @enderror"
                        value="{{ old('moreFields.0.tel_no') }}">
                      @error('moreFields.0.tel_no')
                        <small class="text-danger">{{ $message }}</small>
                      @enderror
                    </td>

                    <td>
                      <button class="btn btn-primary mt-2 mb-2 btn-sm" type="button" name="addDeclare" id="addDeclare">
                        <i class="bi bi-plus-lg"></i>
                      </button>
                    </td>
                  </tr>
                </tbody>
              </table>

              <br>
              <div class="text-center">
                <button type="submit" class="btn btn-primary">Save</button>
              </div>
            </form>
          </div>

          <br>

          <!-- ===== List Section ===== -->
          <div class="col profile-overview overflow-auto" style="border:2px solid #012970; padding:20px; border-radius:25px;">
            <h3 class="card-title">Senarai Emel</h3>

            <table class="table-achiev datatable" id="tableprestasi1">
              <thead>
                <tr>
                  <th class="text-center">IC No</th>
                  <th class="text-center">Emel</th>
                  <th class="text-center">Tel No</th>
                  <th class="text-center">Tindakan</th>
                </tr>
              </thead>
              <tbody>
                @if($devopsAdminEmails->isEmpty())
                  <tr class="text-center">
                    <td colspan="4"><h5>Tiada rekod</h5></td>
                  </tr>
                @else
                  @foreach($devopsAdminEmails as $adminEmail)
                    <tr class="text-center">
                      <td>{{ $adminEmail->ic_no }}</td>
                      <td>{{ $adminEmail->email }}</td>
                      <td>{{ $adminEmail->tel_no }}</td>
                      <td>
                        <form method="post" action="{{ route('support-center.admin-emails.delete', $adminEmail->id) }}" onsubmit="return confirm('Are you sure you want to delete?');">
                          @csrf
                          @method('delete')
                          <button type="submit" class="btn btn-outline-danger btn-sm">
                            <i class="bi bi-trash-fill"></i>
                          </button>
                        </form>
                      </td>
                    </tr>
                  @endforeach
                @endif
              </tbody>
            </table>
          </div>
          <!-- ===== /List Section ===== -->

        </div>
      </div>
    </div>
  </div>
</div>

{{-- ===== Simple inline JS ===== --}}
<script type="text/javascript">
  (function () {
    let i = 0;
    const addBtn = document.getElementById('addDeclare');
    const table  = document.getElementById('declare').getElementsByTagName('tbody')[0];

    addBtn.addEventListener('click', function () {
      i++;

      const row = document.createElement('tr');
      row.className = 'text-center';
      row.innerHTML = `
        <td><input class="form-control" type="text" placeholder="IC No" name="moreFields[${i}][ic_no]" required></td>
        <td><input class="form-control" type="text" placeholder="Email" name="moreFields[${i}][email]" required></td>
        <td><input class="form-control" type="text" placeholder="Tel No" name="moreFields[${i}][tel_no]"></td>
        <td><button class="removeDeclare btn btn-danger mt-2 mb-2 btn-sm" type="button"><i class="bi bi-dash"></i></button></td>
      `;
      table.appendChild(row);
    });

    document.addEventListener('click', function (e) {
      if (e.target.closest('.removeDeclare')) {
        e.target.closest('tr').remove();
      }
    });
  })();
</script>
@endsection
