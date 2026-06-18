@extends('layouts.app-all')

@section('title', 'Archived SSM Records')

@section('content')
<section class="section profile">
    <div class="container mt-4">
        <h3>Archived SSM Records</h3>

        <!-- Back Button -->
        <div class="mb-3">
            <a href="{{ url('ssmrequests/indexall') }}" class="btn btn-primary btn-sm">
                <i class="bi bi-arrow-left"></i> Back to Current Records
            </a>
        </div>

        @php
            $archivedTables = [
                'ssm-approval' => ['title' => 'Approval', 'data' => $ssmapprovalArchived ?? collect()],
                'ssm-cuti' => ['title' => 'Delete Cuti', 'data' => $ssmdeletecutiArchived ?? collect()],
                'ssm-peranan' => ['title' => 'Peranan', 'data' => $ssmperananArchived ?? collect()],
                'ssm-password' => ['title' => 'Password', 'data' => $ssmpasswordArchived ?? collect()],
                'ssm-bakicuti' => ['title' => 'Baki Cuti', 'data' => $ssmbakicutiArchived ?? collect()],
                'ssm-pertukaran' => ['title' => 'Pertukaran IC No', 'data' => $ssmpertukaranicArchived ?? collect()],
                'ssm-others' => ['title' => 'Others', 'data' => $ssmotherArchived ?? collect()],
            ];
            $tabCount = count($archivedTables);
        @endphp

        <!-- Tabs: Equal Width -->
        <ul class="nav nav-tabs mb-3" id="archiveTabs" role="tablist" 
            style="display:flex; border:1px solid #dee2e6; border-radius:0.25rem; background:white;">
            @foreach($archivedTables as $id => $table)
                <li class="nav-item" role="presentation" style="flex: 1 1 0;">
                    <button class="nav-link @if($loop->first) active @endif text-center" 
                            id="tab-{{ $id }}"
                            data-bs-toggle="tab"
                            data-bs-target="#{{ $id }}"
                            type="button"
                            role="tab"
                            aria-controls="{{ $id }}"
                            aria-selected="{{ $loop->first ? 'true' : 'false' }}"
                            style="border:none; border-bottom:2px solid transparent; color:black; font-weight:500; width:100%;">
                        {{ $table['title'] }} <span class="badge bg-secondary ms-1">{{ $table['data']->count() }}</span>
                    </button>
                </li>
            @endforeach
        </ul>

        <!-- Tab Content -->
        <div class="tab-content">
            @foreach($archivedTables as $id => $table)
                <div class="tab-pane fade @if($loop->first) show active @endif" id="{{ $id }}" role="tabpanel" aria-labelledby="tab-{{ $id }}">
                    
                    <!-- White Card Wrapper -->
                    <div class="card shadow-sm mb-4">
                        <div class="card-body">

                            <!-- Search Input -->
                            <div class="mb-2">
                                <input type="text" class="form-control form-control-sm search-table" placeholder="Search {{ $table['title'] }}..." data-target="table-{{ $id }}">
                            </div>

                            @if($table['data']->isEmpty())
                                <p class="p-3 text-muted">No archived records found.</p>
                            @else
                                <div class="table-responsive" style="max-height:500px; overflow-y:auto;">
                                    <table class="table table-hover table-bordered mb-0 table-sm" id="table-{{ $id }}">
                                        <thead class="table-light position-sticky top-0">
                                            <tr>
                                                @foreach($table['data']->first()->getAttributes() as $key => $value)
                                                    <th class="text-nowrap">{{ ucwords(str_replace('_', ' ', $key)) }}</th>
                                                @endforeach
                                            </tr>
                                        </thead>
                                        <tbody>
                                            @foreach($table['data'] as $record)
                                                <tr class="@if($loop->even) table-active @endif">
                                                    @foreach($record->getAttributes() as $value)
                                                        <td class="text-nowrap">{{ $value }}</td>
                                                    @endforeach
                                                </tr>
                                            @endforeach
                                        </tbody>
                                    </table>
                                </div>

                                @if(method_exists($table['data'], 'links'))
                                    <div class="mt-2 px-2">
                                        {{ $table['data']->links() }}
                                    </div>
                                @endif
                            @endif
                        </div>
                    </div>
                    <!-- End Card -->

                </div>
            @endforeach
        </div>

    </div>
</section>

<!-- Search & Tabs Script -->
<script>
document.addEventListener('DOMContentLoaded', function() {
    // Table search
    const searchInputs = document.querySelectorAll('.search-table');
    searchInputs.forEach(input => {
        input.addEventListener('keyup', function() {
            const targetId = this.getAttribute('data-target');
            const table = document.getElementById(targetId);
            const filter = this.value.toLowerCase();
            table.querySelectorAll('tbody tr').forEach(row => {
                row.style.display = row.textContent.toLowerCase().includes(filter) ? '' : 'none';
            });
        });
    });

    // Tabs: black default, blue underline active
    const tabs = document.querySelectorAll('#archiveTabs .nav-link');
    tabs.forEach(tab => {
        tab.addEventListener('shown.bs.tab', function (e) {
            tabs.forEach(t => {
                t.style.color = 'black';
                t.style.borderBottom = '2px solid transparent';
            });
            e.target.style.color = '#0d6efd';
            e.target.style.borderBottom = '2px solid #0d6efd';
        });
    });

    // Initialize first tab
    if (tabs.length) {
        tabs[0].style.color = '#0d6efd';
        tabs[0].style.borderBottom = '2px solid #0d6efd';
    }
});
</script>
@endsection
