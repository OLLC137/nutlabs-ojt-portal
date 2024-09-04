<div class="row">
    <div class="col-lg-6 grid-margin stretch-card">
        <x-template.card>
            <x-template.card-body>
                <x-slot name="title">Line chart</x-slot>
                <canvas id="lineChart" style="height:250px"></canvas>
            </x-template.card-body>
        </x-template.card>
    </div>
    <div class="col-lg-6 grid-margin stretch-card">
        <x-template.card>
            <x-template.card-body>
                <x-slot name="title">Bar chart</x-slot>
                <canvas id="barChart" style="height:230px"></canvas>
            </x-template.card-body>
        </x-template.card>
    </div>
</div>

<div class="row">
    <div class="col-lg-6 grid-margin stretch-card">
        <x-template.card>
            <x-template.card-body>
                <x-slot name="title">Area chart</x-slot>
                <canvas id="areaChart" style="height:250px"></canvas>
            </x-template.card-body>
        </x-template.card>
    </div>
    <div class="col-lg-6 grid-margin stretch-card">
        <x-template.card>
            <x-template.card-body>
                <x-slot name="title">Doughnut chart</x-slot>
                <canvas id="doughnutChart" style="height:250px"></canvas>
            </x-template.card-body>
        </x-template.card>
    </div>
</div>

<div class="row">
    <div class="col-lg-6 grid-margin stretch-card">
        <x-template.card>
            <x-template.card-body>
                <x-slot name="title">Pie chart</x-slot>
                <canvas id="pieChart" style="height:250px"></canvas>
            </x-template.card-body>
        </x-template.card>
    </div>
    <div class="col-lg-6 grid-margin stretch-card">
        <x-template.card>
            <x-template.card-body>
                <x-slot name="title">Scatter chart</x-slot>
                <canvas id="scatterChart" style="height:250px"></canvas>
            </x-template.card-body>
        </x-template.card>
    </div>
</div>


@vite(['resources/assets/js/chart.js'])