@extends('hrs.layouts.app-minimal')

@section('title', 'Teaching Dashboard Report')

@section('content')

<script src="https://cdn.jsdelivr.net/npm/apexcharts"></script>

<div class="py-8 px-4" x-data="reportPage()" x-init="init()">

    <div class="text-center mb-8">
        <h1 class="text-4xl font-bold text-gray-800 mb-2">Teaching Dashboard Report</h1>
        <div class="w-24 h-1 bg-blue-600 mx-auto rounded-full"></div>
    </div>

    <div class="flex justify-between items-center mb-4">
        <a href="{{ route('pj.teaching.list') }}" class="text-blue-600 hover:underline">&larr; Back to Staff List</a>
        <button
            @click="showFilterModal = true"
            class="px-4 py-2 bg-blue-600 text-white rounded-md shadow hover:bg-blue-700 transition">
            Filter
        </button>
    </div>

    <div x-show="activeFilterSummary" class="mb-6 p-3 bg-blue-50 rounded-md">
        <p class="text-sm text-blue-800" x-text="activeFilterSummary"></p>
    </div>

    <div x-show="loading" class="text-center text-gray-500 py-10">Loading report...</div>

    <div x-show="!loading">
        <!-- Summary cards -->
        <div class="grid grid-cols-2 md:grid-cols-5 gap-4 mb-8">
            <div class="bg-white rounded-lg shadow p-4 text-center">
                <p class="text-sm text-gray-500">Total Teachers</p>
                <p class="text-2xl font-bold text-gray-800" x-text="data.total ?? 0"></p>
            </div>
            <div class="bg-white rounded-lg shadow p-4 text-center">
                <p class="text-sm text-gray-500">Active</p>
                <p class="text-2xl font-bold text-green-600" x-text="(data.statusCounts && data.statusCounts.Active) ?? 0"></p>
            </div>
            <div class="bg-white rounded-lg shadow p-4 text-center">
                <p class="text-sm text-gray-500">Retired</p>
                <p class="text-2xl font-bold text-gray-600" x-text="(data.statusCounts && data.statusCounts.Retired) ?? 0"></p>
            </div>
            <div class="bg-white rounded-lg shadow p-4 text-center">
                <p class="text-sm text-gray-500">Inactive</p>
                <p class="text-2xl font-bold text-red-600" x-text="(data.statusCounts && data.statusCounts.Inactive) ?? 0"></p>
            </div>
            <div class="bg-white rounded-lg shadow p-4 text-center">
                <p class="text-sm text-gray-500">Avg Age</p>
                <p class="text-2xl font-bold text-blue-600" x-text="data.avgAge ?? 0"></p>
            </div>
        </div>

        <!-- Charts grid -->
        <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
            <div class="bg-white rounded-lg shadow p-4">
                <h3 class="font-semibold mb-2">Status</h3>
                <div id="chart-status"></div>
            </div>
            <div class="bg-white rounded-lg shadow p-4">
                <h3 class="font-semibold mb-2">Gender (Jantina)</h3>
                <div id="chart-jantina"></div>
            </div>
            <div class="bg-white rounded-lg shadow p-4">
                <h3 class="font-semibold mb-2">Top 10 Jawatan</h3>
                <div id="chart-jawatan"></div>
            </div>
            <div class="bg-white rounded-lg shadow p-4">
                <h3 class="font-semibold mb-2">Kelulusan</h3>
                <div id="chart-kelulusan"></div>
            </div>
            <div class="bg-white rounded-lg shadow p-4">
                <h3 class="font-semibold mb-2">Top 10 Tempat Bertugas</h3>
                <div id="chart-tempat"></div>
            </div>
            <div class="bg-white rounded-lg shadow p-4">
                <h3 class="font-semibold mb-2">Daerah</h3>
                <div id="chart-daerah"></div>
            </div>
            <div class="bg-white rounded-lg shadow p-4">
                <h3 class="font-semibold mb-2">Age Distribution</h3>
                <div id="chart-age"></div>
            </div>
            <div class="bg-white rounded-lg shadow p-4">
                <h3 class="font-semibold mb-2">Upcoming Retirement Timeline</h3>
                <div id="chart-retire"></div>
            </div>
        </div>
    </div>

    <!-- Filter Modal (same fields as the Export Excel modal) -->
    <div
        x-show="showFilterModal"
        class="fixed inset-0 bg-black bg-opacity-50 flex items-start justify-center pt-10 z-50 overflow-y-auto"
        x-cloak>

        <div class="bg-white rounded-lg shadow-lg p-6 w-full max-w-2xl my-8 mx-4">
            <h2 class="text-lg font-semibold mb-4">Report Filters</h2>

            <div class="space-y-4">
                <div>
                    <label class="block text-sm font-medium mb-1">Jawatan</label>
                    <select x-model="filters.jawatan" class="w-full border rounded-md px-3 py-2">
                        <option value="">All Jawatan</option>
                        @foreach($jawatanOptions as $option)
                            <option value="{{ $option }}">{{ $option }}</option>
                        @endforeach
                    </select>
                </div>

                <div>
                    <label class="block text-sm font-medium mb-1">Jantina</label>
                    <select x-model="filters.jantina" class="w-full border rounded-md px-3 py-2">
                        <option value="">All Jantina</option>
                        <option value="Lelaki">Lelaki</option>
                        <option value="Perempuan">Perempuan</option>
                    </select>
                </div>

                <div>
                    <label class="block text-sm font-medium mb-1">Tempat Bertugas</label>
                    <select x-model="filters.tempat_bertugas" class="w-full border rounded-md px-3 py-2">
                        <option value="">All Tempat Bertugas</option>
                        @foreach($tempatBertugasOptions as $option)
                            <option value="{{ $option }}">{{ $option }}</option>
                        @endforeach
                    </select>
                </div>

                <div>
                    <label class="block text-sm font-medium mb-1">Daerah</label>
                    <select x-model="filters.daerah" class="w-full border rounded-md px-3 py-2">
                        <option value="">All Daerah</option>
                        @foreach($daerahOptions as $option)
                            <option value="{{ $option }}">{{ $option }}</option>
                        @endforeach
                    </select>
                </div>

                <div>
                    <label class="block text-sm font-medium mb-1">Kelulusan</label>
                    <select x-model="filters.kelulusan" class="w-full border rounded-md px-3 py-2">
                        <option value="">All Kelulusan</option>
                        @foreach($kelulusanOptions as $option)
                            <option value="{{ $option }}">{{ $option }}</option>
                        @endforeach
                    </select>
                </div>

                <div>
                    <label class="block text-sm font-medium mb-1">Status</label>
                    <select x-model="filters.status" class="w-full border rounded-md px-3 py-2">
                        <option value="">All Status</option>
                        <option value="Active">Active</option>
                        <option value="Retired">Retired</option>
                        <option value="Inactive">Inactive (Tatatertib)</option>
                    </select>
                </div>
            </div>

            <div class="flex justify-end gap-2 mt-6">
                <button @click="resetFilters()" class="px-4 py-2 bg-gray-300 rounded-md hover:bg-gray-400">Reset</button>
                <button @click="showFilterModal = false" class="px-4 py-2 bg-gray-300 rounded-md hover:bg-gray-400">Cancel</button>
                <button @click="applyFilters()" class="px-4 py-2 bg-blue-600 text-white rounded-md hover:bg-blue-700">Apply</button>
            </div>
        </div>
    </div>

</div>

<script>
function reportPage() {
    const emptyFilters = () => ({
        jawatan: '', jantina: '', tempat_bertugas: '', daerah: '', kelulusan: '', status: ''
    });

    return {
        loading: true,
        showFilterModal: false,
        data: {},
        charts: {},
        filters: emptyFilters(),

        init() {
            this.fetchData();
        },

        resetFilters() {
            this.filters = emptyFilters();
        },

        applyFilters() {
            this.showFilterModal = false;
            this.fetchData();
        },

        get activeFilterSummary() {
            const labels = {
                jawatan: 'Jawatan', jantina: 'Jantina', tempat_bertugas: 'Tempat Bertugas',
                daerah: 'Daerah', kelulusan: 'Kelulusan', status: 'Status'
            };
            const parts = [];
            for (const key in labels) {
                if (this.filters[key]) parts.push(labels[key] + ': ' + this.filters[key]);
            }
            return parts.length ? 'Filtered by ' + parts.join(', ') : '';
        },

        fetchData() {
            this.loading = true;
            const params = new URLSearchParams();
            for (const key in this.filters) {
                if (this.filters[key]) params.append(key, this.filters[key]);
            }
            fetch('{{ route('pj.teaching.report.data') }}?' + params.toString())
                .then(r => r.json())
                .then(json => {
                    this.data = json;
                    this.loading = false;
                    this.$nextTick(() => this.renderCharts());
                })
                .catch(err => {
                    console.error('Failed to load report data', err);
                    this.loading = false;
                });
        },

        renderCharts() {
            this.renderDonut('chart-status', this.data.statusCounts);
            this.renderDonut('chart-jantina', this.data.byJantina);
            this.renderBar('chart-jawatan', this.data.byJawatan, true);
            this.renderBar('chart-kelulusan', this.data.byKelulusan);
            this.renderBar('chart-tempat', this.data.byTempatBertugas, true);
            this.renderBar('chart-daerah', this.data.byDaerah);
            this.renderBar('chart-age', this.data.ageBuckets);
            this.renderBar('chart-retire', this.data.retireBuckets);
        },

        renderDonut(elId, obj) {
            const el = document.querySelector('#' + elId);
            if (!el) return;
            if (this.charts[elId]) this.charts[elId].destroy();
            obj = obj || {};
            this.charts[elId] = new ApexCharts(el, {
                chart: { type: 'donut', height: 260 },
                labels: Object.keys(obj),
                series: Object.values(obj),
                legend: { position: 'bottom' }
            });
            this.charts[elId].render();
        },

        renderBar(elId, obj, horizontal = false) {
            const el = document.querySelector('#' + elId);
            if (!el) return;
            if (this.charts[elId]) this.charts[elId].destroy();
            obj = obj || {};
            this.charts[elId] = new ApexCharts(el, {
                chart: { type: 'bar', height: 300, toolbar: { show: false } },
                plotOptions: { bar: { horizontal: horizontal, borderRadius: 4 } },
                dataLabels: { enabled: true },
                xaxis: { categories: Object.keys(obj) },
                series: [{ name: 'Count', data: Object.values(obj) }]
            });
            this.charts[elId].render();
        }
    }
}
</script>

@endsection
