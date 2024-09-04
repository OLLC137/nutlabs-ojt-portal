<div class="grid-margin stretch-card">
    <h2><span class="hide" id="totalPending">0</span></h2>

    <x-template.card>
        <x-template.card-body>
            <div class="requirementType">
                <div class="dropdown-container" style="display: flex; justify-content: flex-end;">
                    <label for="reqTypeDropdown" style="margin-right: 10px; margin-top: 25px;">Choose Requirement Type:</label>
                    <div style="position: relative;">
                        <select class="custom-dropdown dropdown-toggle" id="reqTypeDropdown" style="padding-right: 10px;">
                            <option value="all">All</option>
                            <option value="pre">Pre - Requirements</option>
                            <option value="post">Post - Requirements</option>
                        </select>
                    </div>
                </div>
            </div>
            <div id="pendingRequirementsData" data-requirements="{{ json_encode($pendingRequirements) }}" style="display:none;"></div>
            <div class="chart-cont">
                <canvas id="pendingReqs"></canvas>
            </div>
        </x-template.card-body>
    </x-template.card>
</div>

<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
<script>
    document.addEventListener('DOMContentLoaded', function () {
      const pendingRequirementsDataElement = document.getElementById('pendingRequirementsData');
      const pendingRequirementsJson = pendingRequirementsDataElement.getAttribute('data-requirements');
      const pendingRequirements = JSON.parse(pendingRequirementsJson);

      const requirementLabels = [
        'Medical Certificate',
        'Vaccination Card',
        'Curriculum Vitae',
        'Personal History Statement',
        'Parent\'s Consent',
        'Endorsement Letter',
        'Training Plan',
        'Memorandum Of Agreement',
        'Internship Agreement',
        'OJT Acceptance Form',
        'OJT Journal',
        'Trainee\'s Feedback Form',
        'Supervisor\'s Feedback Form',
        'Performance Appraisal Report'
      ];

      const datasets = {
        'all': requirementLabels,
        'pre': requirementLabels.slice(0, 10),
        'post': requirementLabels.slice(10)
      };

      const reqTypeDropdown = document.getElementById('reqTypeDropdown');
      const ctx = document.getElementById('pendingReqs').getContext('2d');
      let chart;

      function updateChart(selectedType) {
        const selectedLabels = datasets[selectedType];
        const pendingCounts = selectedLabels.map(label => {
          const index = requirementLabels.indexOf(label);
          return pendingRequirements[index + 1] || 0;
        });
        const totalPending = pendingCounts.reduce((total, count) => total + count, 0);

        document.getElementById('totalPending').textContent = totalPending;

        if (chart) {
          chart.data.labels = selectedLabels;
          chart.data.datasets[0].data = pendingCounts;
          chart.options.plugins.title.text = `Total Pending: ${totalPending}`;
          chart.update();
        } else {
          chart = new Chart(ctx, {
            type: 'bar',
            data: {
              labels: selectedLabels,
              datasets: [{
                label: 'Pending Requirements',
                data: pendingCounts,
                backgroundColor: 'rgba(255, 0, 0, 0.2)',
                hoverBackgroundColor: 'rgba(255, 0, 0, 0.4)',
                // borderColor: 'rgba(255, 99, 132, 0.8)',
                borderWidth: 1
              }]
            },
            options: {
              responsive: true,
              maintainAspectRatio: false,
              indexAxis: 'y',
              scales: {
                x: {
                  beginAtZero: true,
                  ticks: {
                    callback: function (value) {
                      return Number.isInteger(value) ? value : '';
                    },
                    stepSize: 3
                  },
                  title: {
                    display: true,
                    text: 'NUMBER OF PENDING REQUIREMENTS',
                    align: 'center',
                    padding: { top: 16 },
                    font: {
                      size: 16
                    }
                  }
                },
                y: {
                  ticks: {
                    autoSkip: false,
                    maxRotation: 0,
                    font: {
                        size: 12
                    }
                    // callback: function (value) {
                    //   const label = this.getLabelForValue(value);
                    //   return label.split('\n');
                    // }
                  }
                }
              },
              plugins: {
                legend: {
                  display: false
                },
                title: {
                  display: true,
                  text: `Total Pending: ${totalPending}`,
                  font: {
                    size: 16
                  }
                }
              }
            }
          });
        }
      }

      // Initial chart setup
      updateChart('all');

      // Dropdown change listener
      reqTypeDropdown.addEventListener('change', function () {
        const selectedType = this.value;
        updateChart(selectedType);
      });
    });
</script>
