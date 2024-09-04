<div class="grid-margin stretch-card">
    <x-template.card>
    <x-template.card-body>
        <div>
            <div class="dropdown-container" style="display: flex; justify-content: flex-end;">
                <label for="filterStatus" style="margin-right: 10px; margin-top: 25px;">Status:</label>
                <div style="position: relative;">
                    <select class="custom-dropdown dropdown-toggle" id="filterStatus" style="padding-right: 10px;">
                        <option value="active">Active</option>
                        <option value="inactive">Inactive</option>
                    </select>
                </div>
            </div>
        </div>
    <!-- Hidden div to store initial category data in JSON format -->
    <div id="categoryData" data-category="{{ json_encode($category) }}" style="display:none;"></div>

    <!-- Container for the chart -->
    <div class="chart-container">
        <canvas id="partnerIndustry"></canvas>
    </div>
</x-template.card-body>
    </x-template.card>
</div>

<!-- Include Chart.js library -->
<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>

<script>
    document.addEventListener('DOMContentLoaded', function() {
        // Get the data from the hidden div's data attribute
        const categoryDataElement = document.getElementById('categoryData');
        const categoryJson = categoryDataElement.getAttribute('data-category');
        const category = JSON.parse(categoryJson);

        // Ensure unique category names
        const categoryNames = [...new Set(category.map(item => item.category))];

        // Initialize arrays for job counts
        const jobs_count_active = Array(categoryNames.length).fill(0);
        const jobs_count_inactive = Array(categoryNames.length).fill(0);

        // Populate job counts for active and inactive jobs
        category.forEach(item => {
            const index = categoryNames.indexOf(item.category);
            if (item.job_status == 1) {
                jobs_count_active[index] = item.jobs_count;
            } else {
                jobs_count_inactive[index] = item.jobs_count;
            }
        });

        // Create a horizontal bar chart using Chart.js
        const ctx1 = document.getElementById('partnerIndustry').getContext('2d');
        const myChart1 = new Chart(ctx1, {
            type: 'bar',
            data: {
                labels: categoryNames,
                datasets: [
                    {
                        label: 'Active Partnership',
                        data: jobs_count_active,
                        backgroundColor: 'rgba(255, 0, 0, 0.2)', // Bar color for active jobs
                        hoverBackgroundColor: 'rgba(255, 0, 0, 0.7)', // Hover color for active jobs
                        borderWidth: 1, // Border width
                        //barThickness: 33 // Set fixed bar thickness
                    }
                ]
            },
            options: {
                indexAxis: 'y', // Make the chart horizontal
                responsive: true, // Make the chart responsive
                maintainAspectRatio: false, // Do not maintain aspect ratio
                plugins: {
                    title: {
                        display: true,
                        text: `Total Active Partnership: ${jobs_count_active.reduce((a, b) => a + b, 0)}`, // Display the total jobs in the chart title
                        font: { size: 16 } // Font size for the title
                    },
                    legend: {
                        display: false, // Display the legend
                        position: 'bottom' // Position the legend at the bottom
                    }
                },
                scales: {
                    x: {
                        beginAtZero: true, // Start the x-axis at zero
                        ticks: {
                            callback: function(value) { return Number.isInteger(value) ? value : ''; }, // Only display integer values
                            stepSize: 2 // Step size for the x-axis
                        },
                        title: {
                            display: true,
                            text: 'NUMBER OF PARTNERSHIP INDUSTRY', // Title for the x-axis
                            padding: { bottom: 4 }, // Padding below the title
                            font: { size: 16 } // Font size for the title
                        }
                    }
                }
            }
        });

        // Dropdown change event listener
        document.getElementById('filterStatus').addEventListener('change', function() {
            const filterStatus = this.value;
            let jobs_count;
            let chartTitle;

            if (filterStatus === 'active') {
                jobs_count = jobs_count_active;
                chartTitle = `Total Active Partnership: ${jobs_count_active.reduce((a, b) => a + b, 0)}`;
            } else {
                jobs_count = jobs_count_inactive;
                chartTitle = `Total Inactive Partnership: ${jobs_count_inactive.reduce((a, b) => a + b, 0)}`;
            }

            // Update chart data
            myChart1.data.datasets[0].data = jobs_count;
            myChart1.options.plugins.title.text = chartTitle;
            myChart1.update();
        });

        // Listen for the event from Livewire
        Livewire.on('chartDataUpdated', (data) => {
            const categoryNames = [...new Set(data.map(item => item.category))];
            const jobs_count_active = Array(categoryNames.length).fill(0);
            const jobs_count_inactive = Array(categoryNames.length).fill(0);

            // Populate job counts for active and inactive jobs
            data.forEach(item => {
                const index = categoryNames.indexOf(item.category);
                if (item.job_status === 1) {
                    jobs_count_active[index] = item.jobs_count;
                } else {
                    jobs_count_inactive[index] = item.jobs_count;
                }
            });

            // Update the dropdown filter based on the current selection
            const filterStatus = document.getElementById('filterStatus').value;
            let jobs_count;
            let chartTitle;

            if (filterStatus === 'active') {
                jobs_count = jobs_count_active;
                chartTitle = `Total Active Partnership: ${jobs_count_active.reduce((a, b) => a + b, 0)}`;
            } else {
                jobs_count = jobs_count_inactive;
                chartTitle = `Total Inactive Partnership: ${jobs_count_inactive.reduce((a, b) => a + b, 0)}`;
            }

            // Update chart data
            myChart1.data.labels = categoryNames;
            myChart1.data.datasets[0].data = jobs_count;
            myChart1.options.plugins.title.text = chartTitle;
            myChart1.update();
        });
    });
</script>
