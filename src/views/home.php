<?php

?>

<?php

use app\core\Application;

if (!Application::isGuest()):
    ?>
    <div class="container">

        <div class="row">
            <div class="col-8">
                <div class="card">
                    <div class="card-body">
                        <div class="card-title">Application Data</div>
                        <canvas id="myChart"></canvas>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <script>
        // JavaScript to create the chart
        var ctx = document.getElementById('myChart').getContext('2d');
        var myChart = new Chart(ctx, {
            type: 'bar',
            data: {
                labels: ['Users', 'Department','Employee'],
                datasets: [{
                    label: 'Total Counts',
                    data: <?= $data ?>,
                    backgroundColor: [
                        'rgba(255, 99, 132, 0.2)',
                        'rgba(54, 162, 235, 0.2)',
                        'rgba(255, 206, 86, 0.2)',
                    ],
                    borderColor: [
                        'rgba(255, 99, 132, 1)',
                        'rgba(54, 162, 235, 1)',
                        'rgba(255, 206, 86, 1)',
                    ],
                    borderWidth: 1
                }]
            },
            options: {
                scales: {
                    y: {
                        beginAtZero: true
                    }
                }
            }
        });
    </script>
<?php
else: ?>
<div class="container">
    Please login to view data
</div>
<?php endif; ?>
