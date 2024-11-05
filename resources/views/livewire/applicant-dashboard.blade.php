<div class="grid-margin stretch-card">
    <h2><span class="hide" id="totalEnrolled">0</span></h2>

    <x-template.card>
        <x-template.card-body>
            <canvas id="departmentChart"></canvas>
        </x-template.card-body>
    </x-template.card>

</div>

<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
<script>
    document.addEventListener('DOMContentLoaded', function () {
        // Define department data (replace with actual data as needed)
        const departments = [
            { department: 'Engineering', students_count: 120 },
            { department: 'Business', students_count: 80 },
            { department: 'Arts', students_count: 60 },
            { department: 'Sciences', students_count: 100 }
        ];

        // Extract department names and student counts
        const departmentNames = departments.map(dept => dept.department);
        const studentCounts = departments.map(dept => dept.students_count);

        // Calculate the total number of students
        const totalEnrolled = studentCounts.reduce((total, count) => total + count, 0);

        // Update the total enrolled label
        document.getElementById('totalEnrolled').textContent = totalEnrolled;

        // Create a bar chart using Chart.js
        const ctx = document.getElementById('departmentChart').getContext('2d');
        new Chart(ctx, {
            type: 'bar',
            data: {
                labels: departmentNames,
                datasets: [{
                    label: 'Number of Students',
                    data: studentCounts,
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
                        text: `Total Enrolled: ${totalEnrolled}`,
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
                        ticks: {
                            callback: function(value) {
                                return Number.isInteger(value) ? value : '';
                            },
                            stepSize: 1
                        },
                        title: {
                            display: true,
                            text: 'NUMBER OF STUDENTS',
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
