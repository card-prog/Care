<?php
session_start();
include 'navbar.php';
include 'connect.php'; // Import database connection

// Ensure the user is logged in before accessing the Dashboard
if (!isset($_SESSION['admin_id'])) {
    header("Location: login.php");
    exit();
}

$selected_barangay = $_GET['barangay'] ?? '';

// Build where clause based on the selected barangay (optional)
$where_clause = $selected_barangay ? "WHERE barangay = '" . mysqli_real_escape_string($conn, $selected_barangay) . "'" : '';

// Fetch data for dental issues
$query_data = "
    SELECT dental, COUNT(*) as count 
    FROM senior_citizens $where_clause 
    GROUP BY dental
";
$result_data = mysqli_query($conn, $query_data);

// Prepare arrays for chart labels and data
$labels = [];
$data = [];

while ($row = mysqli_fetch_assoc($result_data)) {
    $labels[] = $row['dental']; // Assuming 'dental' column has values (e.g., 'Yes', 'No')
    $data[] = $row['count']; // Count of people with dental issues
}

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dental Data Bar Chart</title>
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script> <!-- Include Chart.js -->
</head>
<body>

    <h2>Dental Data for Senior Citizens</h2>
    <canvas id="dentalChart" width="400" height="200"></canvas> <!-- Chart container -->

    <script>
        var ctxDental = document.getElementById('dentalChart').getContext('2d');

        // Create the gradient (optional for styling)
        var gradient = ctxDental.createLinearGradient(0, 0, 0, 400);
        gradient.addColorStop(0, '#7BD5F5');  // Start color (light blue)
        gradient.addColorStop(1, '#1F2F98');  // End color (dark blue)

        // Create the chart
        var dentalChart = new Chart(ctxDental, {
            type: 'bar',
            data: {
                labels: <?php echo json_encode($labels); ?>,  // PHP variable for labels (e.g., 'Yes', 'No')
                datasets: [{
                    label: 'Dental Issues Count',
                    data: <?php echo json_encode($data); ?>,  // PHP variable for the count data
                    backgroundColor: gradient,  // Apply gradient to the bars
                    borderColor: '#2c3e50',  // Border color for the bars
                    borderWidth: 1
                }]
            },
            options: {
                responsive: true,
                scales: {
                    y: {
                        beginAtZero: true,
                        grid: {
                            display: true  // Display grid lines on the y-axis
                        }
                    },
                    x: {
                        grid: {
                            display: false,  // Disable grid lines on x-axis
                            drawBorder: false  // Disable x-axis border line
                        }
                    }
                },
                elements: {
                    bar: {
                        borderRadius: 10,  // Make bars rounded
                    }
                }
            }
        });
    </script>

</body>
</html>
