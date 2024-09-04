<div class="grid-margin stretch-card">
    <x-template.card>
        <x-template.card-body>
            <!-- Hidden div to store initial category data in JSON format -->
            <div id="internshipData" data-intern="{{ json_encode($intern) }}" style="display:none;"></div>
            <div class="chart-container">
                <canvas id="ongoingIntern"></canvas>
            </div>
        </x-template.card-body>
    </x-template.card>
</div>

<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
<script>
    document.addEventListener('DOMContentLoaded', function () {
        // Get the data from the hidden div's data attribute
        const internshipDataElement = document.getElementById('internshipData');
        const internJson = internshipDataElement.getAttribute('data-intern');
        console.log('Intern JSON:', internJson); // Log the JSON data
        const intern = JSON.parse(internJson);

        // Extract department names and student counts
        const interndept = intern.map(item => item.department);
        const studentCounts = intern.map(item => item.students_count);
        //Calcu total num of interns
        const totalOngoingInterns = studentCounts.reduce((sum, count) => sum + count, 0);

        // Create a bar chart using Chart.js
        const ctx = document.getElementById('ongoingIntern').getContext('2d');
        new Chart(ctx, {
            type: 'bar',
            data: {
                labels: interndept,
                datasets: [{
                    label: 'Quantity: ',
                    data: studentCounts,
                    backgroundColor: 'rgba(255, 0, 0, 0.2)',
                    borderColor: 'rgba(255, 99, 132, 2)',
                    borderWidth: 1
                }]
            },
            options: {
                responsive: true,
                maintainAspectRatio: false,
                plugins: {
                    title: {
                        display: true,
                        text: `Total Number of Ongoing Interns: ${totalOngoingInterns}`, // Display the total jobs in the chart title
                        font: { size: 16 } // Font size for the title
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
                            text: 'NUMBER OF INTERNS',
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
                            padding: { top: 15 },
                            font: {
                                size: 16
                            }
                        }
                    }
                }
            }
        });
            myChart2.update();

    });
</script>
