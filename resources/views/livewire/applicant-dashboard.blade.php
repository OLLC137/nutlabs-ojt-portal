<div class="grid-margin stretch-card">
    <x-template.card>
        <x-template.card-body>
            <canvas class ="company-dashobard-chart" id="departmentChart"></canvas>
        </x-template.card-body>
    </x-template.card>
</div>

<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
<script>
    document.addEventListener('DOMContentLoaded', function () {
        const departments = @json($departmentData);

        const departmentNames = Object.keys(departments);
        const applicantCounts = Object.values(departments);

        const totalApplicant = applicantCounts.reduce((total, count) => total + count, 0);

        const ctx = document.getElementById('departmentChart').getContext('2d');
        new Chart(ctx, {
            type: 'bar',
            data: {
                labels: departmentNames,
                datasets: [{
                    data: applicantCounts,
                    backgroundColor: 'rgba(255, 0, 0, 0.2)',
                    borderColor: 'rgba(255, 99, 132, 1)',
                    borderWidth: 1
                }]
            },
            options: {
                responsive: true,
                maintainAspectRatio: false,
                plugins: {
                    title: {
                        display: true,
                        text: `Total number of applicants: ${totalApplicant}`,
                        font: {
                            size: 16
                        }
                    },
                    legend: {
                        display: false
                    }
                },
                scales: {
                    y: {
                        beginAtZero: true,
                        title: {
                            display: true,
                            text: 'NUMBER OF APPLICANTS',
                            padding: { bottom: 12 },
                            font: {
                                size: 16
                            }
                        }
                    },
                    x: {
                        title: {
                            display: true,
                            text: 'DEPARTMENTS',
                            padding: { top: 14 },
                            font: {
                                size: 16
                            }
                        }
                    }
                }
            }
        });
    });
</script>
