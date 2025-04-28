<?php
session_start();
include 'connect.php';

// Ensure the user is logged in
if (!isset($_SESSION['admin_id'])) {
    header("Location: login.php");
    exit();
}

// Fetch available barangays
$query_barangays = "SELECT DISTINCT barangay FROM barangay";
$result_barangays = mysqli_query($conn, $query_barangays);
if (!$result_barangays) {
    die("Query failed: " . mysqli_error($conn));
}

$selected_barangay = $_GET['barangay'] ?? '';

// Handle birthday query
$birth_query = "
    SELECT * FROM senior_citizens 
    WHERE MONTH(birthdate) = MONTH(CURDATE()) 
      AND DAY(birthdate) >= 1
";
if (!empty($selected_barangay)) {
    $birth_query .= " AND barangay = '" . mysqli_real_escape_string($conn, $selected_barangay) . "'";
}
$birth_query .= " ORDER BY birthdate ASC";
$result_birthdays = mysqli_query($conn, $birth_query);

// Prepare where clause
$where_clause = !empty($selected_barangay)
    ? "WHERE barangay = '" . mysqli_real_escape_string($conn, $selected_barangay) . "'"
    : '';

// Prepare filter with AND for extra conditions
$filter = !empty($where_clause) ? "$where_clause AND" : 'WHERE';

// Category selection
$selected_category = $_GET['category'] ?? 'dental';
$column_name = match ($selected_category) {
    'hearing' => 'hearing',
    'optical' => 'optical',
    default => 'dental',
};

// Count total seniors
$query_total = "SELECT COUNT(*) as total_seniors FROM senior_citizens $where_clause";
$result_total = mysqli_query($conn, $query_total);
if (!$result_total) {
    die("Total count query failed: " . mysqli_error($conn));
}
$row_total = mysqli_fetch_assoc($result_total);
$total_seniors = $row_total['total_seniors'] ?? 0;

// Adjust WHERE clause
$filter = $where_clause ? "$where_clause AND" : "WHERE";

// Count seniors with 'YES' in remarks (case-insensitive)
$query_priority = "
    SELECT COUNT(*) as priority_count 
    FROM senior_citizens 
    $filter TRIM(UPPER(remarks)) = 'YES'
";
$result_priority = mysqli_query($conn, $query_priority);
if (!$result_priority) {
    die("Priority count query failed: " . mysqli_error($conn));
}
$row_priority = mysqli_fetch_assoc($result_priority);
$priority_count = $row_priority['priority_count'] ?? 0;



// Age distribution
$query_age = "
    SELECT 
        SUM(CASE WHEN age BETWEEN 60 AND 64 THEN 1 ELSE 0 END) AS age_60_64,
        SUM(CASE WHEN age BETWEEN 65 AND 69 THEN 1 ELSE 0 END) AS age_65_69,
        SUM(CASE WHEN age BETWEEN 70 AND 74 THEN 1 ELSE 0 END) AS age_70_74,
        SUM(CASE WHEN age BETWEEN 75 AND 79 THEN 1 ELSE 0 END) AS age_75_79,
        SUM(CASE WHEN age >= 80 THEN 1 ELSE 0 END) AS age_80_above
    FROM senior_citizens $where_clause";
$result_age = mysqli_query($conn, $query_age);
$row_age = mysqli_fetch_assoc($result_age);

// Gender distribution
$query_gender = "
    SELECT 
        SUM(CASE WHEN gender = 'Male' THEN 1 ELSE 0 END) AS male_count,
        SUM(CASE WHEN gender = 'Female' THEN 1 ELSE 0 END) AS female_count
    FROM senior_citizens $where_clause";
$result_gender = mysqli_query($conn, $query_gender);
$row_gender = mysqli_fetch_assoc($result_gender);

// Category data (excluding NONE/NULL/empty)
$query_data = "
    SELECT $column_name, COUNT(*) as count 
    FROM senior_citizens 
    $filter TRIM(UPPER($column_name)) NOT IN ('', 'NONE', 'NULL') 
    GROUP BY $column_name";
$result_data = mysqli_query($conn, $query_data);
$labels = [];
$data = [];
while ($row = mysqli_fetch_assoc($result_data)) {
    $labels[] = $row[$column_name];
    $data[] = $row['count'];
}

include 'navbar.php';
?>





<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0"/>
  <title>Dashboard</title>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet"/>
  <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>


  <style>
    body {
      background-color: #e9ecef;
    }
    .page-container {
      max-width: 1200px;
      margin: 30px auto;
      padding: 30px;
      background-color: #fff;
      box-shadow: 0 6px 12px rgba(0, 0, 0, 0.1);
    }
    .card {
      border-radius: 10px;
      box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
      margin-bottom: 20px;
    }
    
    .chart-container {
    height: 350px;
    display: flex;
  align-items: center;
  justify-content: center;
  }

  .chart-container-category {
  width: 100%;
  overflow-x: auto;
  text-align: center;
}

.profile-header {
    background: #4A1DB9;
    color: white;
    text-align: center;
    padding: 10px 40px;
    font-weight: bold;
    font-size: 30px;
    margin-top: -3px;
    position: relative;
    width: 100%; /* Gumamit ng full width */
    max-width: 2000px; /* O set ng maximum width */
    height: 70px;
   
}

/* Ensure the filter section is displayed in one row */
.filter-row {
  display: flex;
  justify-content: space-between; /* Ensure elements are spread out evenly */
  gap: 20px; /* Adds space between the form elements */
}

/* Style each column to take equal space and appear next to each other */
.filter-row .col-md-6,
.filter-row .col-lg-4 {
  flex: 1; /* Make each column flexible to fit the container */
  margin-top: 20px;
  display: flex;
  flex-direction: column; /* Stack label and select vertically */
}

/* Ensure form labels and select fields take 100% width */
.form-label, .form-select {
  width: 100%; /* Make sure both label and select take full width */
  display: block; /* Ensure block-level for label and select */
}

/* Optional styling for the select box */
.form-select {
  padding: 10px;
  font-size: 16px;
  margin-bottom: 10px; /* Space between select and next element */
}

/* Optional styling for the label */
.form-label {
  margin-bottom: 5px; /* Space between label and select */
}



/* Custom gradient background for the primary card */
.custom-card-gradient-primary {
  background: linear-gradient(to right,rgb(8, 105, 170),rgb(165, 206, 236)); /* Blue gradient */
  transition: background 0.3s ease-in-out;
}

/* Custom gradient background for the warning card */
.custom-card-gradient-warning {
  background: linear-gradient(to right,rgb(17, 55, 193),rgb(207, 192, 242)); /* Orange gradient */
  transition: background 0.3s ease-in-out;
}

/* Flexbox layout for card */
.card-body {
  display: flex;
  align-items: center;
  padding: 20px;
}

/* Circle for the icon */
.icon-circle {
  width: 80px;
  height: 80px;
  background-color:rgba(255, 255, 255, 0.29);
  border-radius: 50%;
  display: flex;
  justify-content: center;
  align-items: center;
  margin-right: 20px; /* Space between the icon and the count */
  box-shadow: 0 4px 10px rgba(0, 0, 0, 0.1); /* Light shadow for the circle */
}

/* Icon styling */
.icon-left {
  color:rgb(255, 255, 255); /* Icon color */
}

/* Count styling in the center */
.card-count {
  font-size: 2.5rem; /* Large count number */
  color: #ffffff; /* White color for count number */
  margin-bottom: 10px; /* Space between count and title */
}

/* Title below the count */
.card-title {
  font-size: 0.9rem;
  color: #ffffff;
}

/* Smooth hover effect on the cards */
.card {
  transition: transform 0.3s ease, box-shadow 0.3s ease; /* Add transition for smoothness */
}

/* Hover effect */
.card:hover {
  transform: scale(1.05);
  box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
}

.birthday-card-custom {
    background: linear-gradient(90deg, #7B2FF7, #E29BF9); /* Purple to light violet gradient */
    border-radius: 12px;
    padding: 16px;
    color: white;
    font-family: 'Montserrat', sans-serif;
    box-shadow: 0 4px 10px rgba(0,0,0,0.1);
  }

  .birthday-card-custom .name-text {
    font-weight: 700;
    font-size: 1.2rem;
    color: white;
  }

  .birthday-card-custom .barangay-text {
    font-size: 0.9rem;
    color: rgba(255, 255, 255, 0.7);
    text-align: right;
  }

  .birthday-card-custom .info-text {
    font-size: 0.95rem;
    color: rgba(255, 255, 255, 0.85);
  }


/* Bubble Button Style */
.filter-btn {
  position: fixed; /* Fix the button in the viewport */
  top: 30%; /* Adjust vertical position */
  right: 30px; /* Adjust horizontal position */
  padding: 15px;
  border-radius: 50%; /* Make the button circular */
  background-color: rgb(21, 31, 168); /* Custom purple color */
  color: white; /* Icon color */
  box-shadow: 0 4px 8px rgba(0, 0, 0, 0.2); /* Subtle shadow for bubble effect */
  border: none;
  font-size: 20px;
  z-index: 10; /* Ensure it's above other elements */
  transition: all 0.3s ease; /* Smooth transition on hover */
}

/* Hover Effect */
.filter-btn:hover {
  background-color: #3a1a80; /* Darker shade of purple when hovered */
  transform: scale(1.1); /* Slightly enlarge the button on hover */
}

/* Font Awesome Icon Style */
.filter-btn i {
  font-size: 20px; /* Icon size */
}

/* Modal Filter Customization */
.modal-header {
  background-color: rgb(21, 31, 168); /* Custom purple color */
  color: white; /* White text */
  border-bottom: 2px solid #ddd; /* Slight separation */
}

/* Close Button */
.custom-close {
  position: absolute; /* Move to the top-right corner */
  top: 10px; /* Adjust the vertical position */
  right: 10px; /* Adjust the horizontal position */
  width: 20px; /* Adjust the button size */
  height: 20px;
  z-index: 10; /* Ensure it stays above other elements */
  filter: brightness(0) saturate(100%) invert(14%) sepia(82%) saturate(3524%) hue-rotate(252deg) brightness(88%) contrast(92%);
}

/* Modal Title */
.modal-title-custom {
  font-size: 24px;  /* Adjust the font size */
  font-weight: bold; /* Make it bold */
  text-align: center; /* Center align the text */
  width: 100%; /* Make sure it takes the full width */
  color: rgb(21, 31, 168); /* Custom purple color */
  margin: 0; /* Remove default margins */
  padding: 10px 0; /* Adjust spacing */
}

/* Button Styles for Filter Form */
.btn-purple {
  background-color: rgb(21, 31, 168); /* Custom purple color */
  color: #ffffff; /* White text */
  font-weight: bold; /* Bold text */
  font-size: 18px; /* Adjust text size */
  padding: 12px; /* Padding for a larger button */
  border-radius: 5px; /* Rounded edges */
  border: none; /* Remove default border */
}

/* Button Hover Effect */
.btn-purple:hover {
  background-color: #3a1a80; /* Darker shade of purple on hover */
  color: white;
}

/* Filter Inputs */
.input-underline {
  border: none;
  border-bottom: 2px solid #ddd;
  border-radius: 0;
  padding: 8px;
  font-size: 16px;
}

.input-underline:focus {
  outline: none;
  border-bottom: 2px solid rgb(21, 31, 168);
  box-shadow: none;
}

.filter-chips {
    display: flex;
    flex-wrap: wrap;
    gap: 0.5rem;
  }

  .filter-chips .chip {
    padding: 0.35rem 0.75rem;
    border-radius: 999px;
    border: 1px solid #ced4da;
    background-color: #ffffff;
    font-size: 0.875rem;
    color: #495057;
    cursor: pointer;
    transition: background-color 0.15s, color 0.15s, border-color 0.15s;
  }

  .filter-chips .chip:hover {
    background-color: #f8f9fa;
  }

  .filter-chips .chip.active {
    background-color: #0d6efd;
    border-color: #0d6efd;
    color: #ffffff;
  }

  .filter-chips .chip:focus {
    outline: none;
  }

  .btn-secondary {
  border-radius: 50px;
  background-color: blue;
  color: white;
}

.btn-secondary:hover {
  background-color: darkblue;

}




  </style>
</head>
<body>
<!-- Filter Button Outside the Container -->
<button type="button" class="btn btn-outline-primary mb-3 filter-btn" data-bs-toggle="modal" data-bs-target="#filterModal">
  <i class="fas fa-filter"></i> <!-- Icon for the button -->
</button>

<div class="container page-container">
    <div class="profile-header">WELCOME TO SENIOR CITIZEN DASHBOARD</div>    

  
<!-- Filter Modal -->
<div class="modal fade" id="filterModal" tabindex="-1" aria-hidden="true">
  <div class="modal-dialog modal-lg">
    <form method="GET" class="modal-content p-4">
      <!-- Title inside body -->
      <div class="mb-4">
        <h5 class="fw-semibold mb-3">Filter Records</h5>
      </div>

      <div class="modal-body p-0">
        <!-- Barangay Filter -->
        <div class="mb-4">
          <label class="form-label fw-semibold">Filter by Barangay:</label>
          <div class="filter-chips" id="barangay-chips">
            <button type="submit" name="barangay" value="" class="chip <?= empty($selected_barangay) ? 'active' : '' ?>">
              All
            </button>
            <?php while ($row = mysqli_fetch_assoc($result_barangays)): ?>
              <button type="submit" name="barangay" value="<?= htmlspecialchars($row['barangay']); ?>"
                      class="chip <?= ($selected_barangay == $row['barangay']) ? 'active' : '' ?>">
                <?= htmlspecialchars($row['barangay']); ?>
              </button>
            <?php endwhile; ?>
          </div>
        </div>
      </div>

      <div class="modal-footer border-0 pt-0">
        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">
          Close
        </button>
      </div>
    </form>
  </div>
</div>



<!-- Info Cards -->
<div class="row mb-4 pt-3">
  <div class="col-md-6">
    <div class="card custom-card-gradient-primary text-white">
      <div class="card-body d-flex align-items-center justify-content-start">
        <!-- Icon circle on the left side -->
        <div class="icon-circle">
          <i class="fas fa-users fa-3x icon-left"></i>
        </div>
        <!-- Count in the center -->
        <div class="text-center ml-3">
          <h2 class="card-count"><?php echo $total_seniors; ?></h2>
          <h6 class="card-title">Total Seniors</h6>
        </div>
      </div>
    </div>
  </div>
  <div class="col-md-6">
    <div class="card custom-card-gradient-warning text-dark">
      <div class="card-body d-flex align-items-center justify-content-start">
        <!-- Icon circle on the left side -->
        <div class="icon-circle">
          <i class="fas fa-exclamation fa-3x icon-left"></i>
        </div>
        <!-- Count in the center -->
        <div class="text-center ml-3">
          <h2 class="card-count"><?php echo $priority_count; ?></h2>
          <h6 class="card-title">Priority Seniors</h6>
        </div>
      </div>
    </div>
  </div>
</div>








<!-- Age and Gender Charts -->
<div class="row">
  <div class="col-md-6">
    <div class="card p-3">
      <h5 class="text-center">Age Distribution</h5>
      <div class="chart-container">
        <canvas id="ageChart" width="400" height="200"></canvas>
      </div>
    </div>
  </div>
  <div class="col-md-6">
    <div class="card p-3">
      <h5 class="text-center">Gender Distribution</h5>
      <div class="chart-container">
        <canvas id="genderChart" width="400" height="200"></canvas>
      </div>
    </div>
  </div>
</div>

<!-- Category Chart and Birthday Table in One Row   <div class="col-md-6">
    <div class="card p-3 h-100">
      <h5 class="text-center">Category Chart</h5>
      <div class="chart-container-category">
        <canvas id="categoryChart" width="400" height="200"></canvas>
      </div>
    </div>
  </div> -->
<div class="row mt-4">


  <!-- Birthday Table (Right Side) -->
  <div class="col-md-20">
    <div class="card p-3 h-100">
      <h6 class="text-center mb-3">Seniors with Birthdays This Month</h6>
      <div class="scrollable-birthday-list" style="max-height: 280px; overflow-y: auto;">
        <?php while($row = mysqli_fetch_assoc($result_birthdays)): ?>
          <div class="birthday-card-custom mb-3">
            <div class="d-flex justify-content-between align-items-start">
              <div>
                <strong class="name-text"><?php echo $row['last_name'] . ', ' . $row['first_name']; ?></strong>
              </div>
              <div class="barangay-text">
                Barangay <?php echo $row['barangay']; ?>
              </div>
            </div>
            <div class="d-flex gap-3 mt-2 flex-wrap">
              <div class="info-text">
                <?php
                  $birthDate = new DateTime($row['birthdate']);
                  $today = new DateTime();
                  echo $today->diff($birthDate)->y . " Years Old";
                ?>
              </div>
              <div class="info-text">
                <?php echo date("F d, Y", strtotime($row['birthdate'])); ?>
              </div>
            </div>
          </div>
        <?php endwhile; ?>
      </div>
    </div>
  </div>

</div>



</body>
</html>



<script>
    // Age Distribution Chart
    var ctxAge = document.getElementById('ageChart').getContext('2d');

// Create vertical gradient color
var gradient = ctxAge.createLinearGradient(0, 0, 0, 400);
gradient.addColorStop(0, '#17a2b8');   // top color
gradient.addColorStop(1, '#6f42c1');   // bottom color

var ageChart = new Chart(ctxAge, {
    type: 'bar',
    data: {
        labels: ['60-64', '65-69', '70-74', '75-79', '80+'],
        datasets: [{
            label: 'Number of Seniors',
            data: [
              <?php echo $row_age['age_60_64']; ?>,
              <?php echo $row_age['age_65_69']; ?>,
              <?php echo $row_age['age_70_74']; ?>,
              <?php echo $row_age['age_75_79']; ?>,
              <?php echo $row_age['age_80_above']; ?>
            ],
            backgroundColor: gradient,
            borderRadius: 10, // Rounded corners
            barPercentage: 0.6, // Optional: adjust thickness
            categoryPercentage: 0.8
        }]
    },
    options: {
        responsive: true,
        scales: {
            y: {
                beginAtZero: true,
                grid: {
                    drawBorder: false
                }
            },
            x: {
                grid: {
                    display: false,      // Remove x-axis grid lines
                    drawBorder: false    // Remove x-axis border line
                }
            }
        },
        plugins: {
            legend: {
                display: false // Hide legend if not needed
            }
        }
    }
});

    // Gender Distribution Doughnut Chart
    var ctxGender = document.getElementById('genderChart').getContext('2d');
var genderChart = new Chart(ctxGender, {
    type: 'doughnut',  // Changed from 'pie' to 'doughnut'
    data: {
        labels: ['Male', 'Female'],
        datasets: [{
            label: 'Gender Distribution',
            data: [<?php echo $row_gender['male_count']; ?>, <?php echo $row_gender['female_count']; ?>],
            backgroundColor: ['#007bff', '#ff6384'],
            borderWidth: 1,  // Optional: you can adjust the border width for a clean look
            borderColor: '#fff',  // Adding a white border for separation between slices
        }]
    },
    options: {
        responsive: true,
        cutoutPercentage: 50,  // Controls the size of the hole in the center (adjust as needed)
        elements: {
            arc: {
                borderRadius: 8,  // Adjusts the corner radius of the slices (optional)
                borderWidth: 2,  // Thicker border between slices
                borderColor: '#ffffff',  // White border for separation
            }
        },
        plugins: {
            legend: {
                position: 'top',  // Adjust the position of the legend
            }
        }
    }
});


var ctxCategory = document.getElementById('categoryChart').getContext('2d');

// Create the gradient
var gradient = ctxCategory.createLinearGradient(0, 0, 0, 400); // Vertical gradient (0 to 400)
gradient.addColorStop(0, '#7BD5F5');  // Start color (yellow)
gradient.addColorStop(1, '#1F2F98');  // End color (orange)

var categoryChart = new Chart(ctxCategory, {
    type: 'bar',
    data: {
        labels: <?php echo json_encode($labels); ?>,
        datasets: [{
            label: '<?php echo ucfirst($selected_category); ?> Count',
            data: <?php echo json_encode($data); ?>,
            backgroundColor: gradient,  // Apply the gradient as the background color
        }]
    },
    options: {
        responsive: true,
        scales: {
            y: {
                beginAtZero: true,
                grid: {
                    display: true  // Removes the standing grid lines on the y-axis
                }
            },

            x: {
                grid: {
                    display: false,      // Remove x-axis grid lines
                    drawBorder: false    // Remove x-axis border line
                }
            }
        },
        elements: {
            bar: {
                borderRadius: 10,  // Adjust this value to round the corners of the bars
            }
        }
    }
});



    
    $(document).ready(function() {
    // When either filter is changed
    $('#filterForm select').change(function() {
      var selectedBarangay = $('#barangay').val();
      var selectedCategory = $('#category').val();
      
      // Send AJAX request to update the charts
      $.ajax({
        url: 'dashboard.php',  // Replace with the correct URL to your PHP script
        method: 'GET',
        data: {
          barangay: selectedBarangay,
          category: selectedCategory
        },
        success: function(response) {
          // Parse the response JSON to get the updated chart data
          var responseData = JSON.parse(response);
          
          // Update Age Distribution Chart
          ageChart.data.datasets[0].data = responseData.ageData;
          ageChart.update();
          
          // Update Gender Distribution Chart
          genderChart.data.datasets[0].data = responseData.genderData;
          genderChart.update();
          
          // Update Category Chart
          categoryChart.data.datasets[0].data = responseData.categoryData;
          categoryChart.update();
        },
        error: function(xhr, status, error) {
          console.error('Error fetching data: ', error);
        }
      });
    });
  });



    
</script>
</body>
</html>