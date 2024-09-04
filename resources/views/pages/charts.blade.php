<x-app-layout>

    <script src="{{ url('vendors/chart.js/Chart.min.js') }}"></script>

    <x-slot name="header">
        <div class="page-header">
            <h3 class="page-title">
                <span class="page-title-icon bg-gradient-primary text-white me-2">
                    <i class="mdi mdi-home"></i>
                </span>
                Chart-js
            </h3>
            <nav aria-label="breadcrumb">
                <ul class="breadcrumb">
                    <li class="breadcrumb-item active" aria-current="page">
                        <span></span>Charts <i class="mdi mdi-alert-circle-outline icon-sm text-primary align-middle"></i>
                    </li>
                </ul>
            </nav>
        </div>
    </x-slot>

    <x-template.charts.chart-js />

</x-app-layout>