<div class="grid-margin stretch-card">
    <div class="card">
        <div class="card-body">
            <canvas class ="company-dashobard-chart" id="jobListChart"></canvas>
        </div>
    </div>
</div>

<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
<script>
    document.addEventListener('DOMContentLoaded', function() {
        const jobLists = @json($jobListData);

        console.log(JSON.stringify(jobLists));

        const jobListNames = jobLists.map(job => job.category);
        const jobListCounts = jobLists.map(job => job.jobs_count);

        const ctx = document.getElementById('jobListChart').getContext('2d');
        new Chart(ctx, {
            type: 'bar',
            data: {
                labels: jobListNames,
                datasets: [{
                    data: jobListCounts,
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
                        text: `Number of Job Lists: {{ $joblistCount }}
                        Available Job Lists: {{ $availableJobListCount }}`,
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
                            padding: {
                                bottom: 12
                            },
                            font: {
                                size: 16
                            }
                        }
                    },
                    x: {
                        title: {
                            display: true,
                            text: 'JOB LISTS',
                            padding: {
                                top: 14
                            },
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
