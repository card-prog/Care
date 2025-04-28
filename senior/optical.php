<?php
session_start();
require 'connect.php'; // Database connection
include 'navbar.php';

// Handle CRUD Operations
if ($_SERVER["REQUEST_METHOD"] === "POST") {
    $action = $_POST['action'] ?? '';

    if ($action === "add") {
        $optical = $_POST['optical'] ?? '';
        if (!empty($optical)) { // Fixed: Correct variable name
            $stmt = $conn->prepare("INSERT INTO optical (optical) VALUES (?)");
            $stmt->bind_param("s", $optical);
            $stmt->execute();
            $stmt->close();
        }
    } elseif ($action === "update") {
        $id = $_POST['id'] ?? '';
        $optical = $_POST['optical'] ?? '';
        if (!empty($id) && !empty($optical)) {
            $stmt = $conn->prepare("UPDATE optical SET optical=? WHERE id=?");
            $stmt->bind_param("si", $optical, $id);
            $stmt->execute();
            $stmt->close();
        }
    } elseif ($action === "delete") {
        $id = $_POST['id'] ?? '';
        if (!empty($id)) {
            $stmt = $conn->prepare("DELETE FROM optical WHERE id=?");
            $stmt->bind_param("i", $id);
            $stmt->execute();
            $stmt->close();
        }
    }
    exit;
}

// Get all optical records
$opticalQuery = $conn->query("SELECT * FROM optical");
?>

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>optical Management</title>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
  <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
  <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.5/font/bootstrap-icons.css" rel="stylesheet">
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>


  <style>
    body {
      background-color: #f8f9fa;
    }

    h2, h4 {
      font-family: 'Segoe UI', sans-serif;
      font-weight: 600;
    }

    .form-label {
      font-weight: 500;
    }

    .table th, .table td {
      vertical-align: middle;
    }

    .btn i {
      margin-right: 5px;
    }

    .form-control:focus {
      box-shadow: none;
      border-color:rgb(67, 39, 189);
    }

    .card {
      border: none;
      box-shadow: 0 0 10px rgba(0,0,0,0.05);
    }

    .table-hover tbody tr:hover {
      background-color: #f1f1f1;
    }

    .profile-header {
    background: #4A1DB9;
    color: white;
    text-align: center;
    padding: 10px 40px;
    font-weight: bold;
    font-size: 24px;
    margin-top: -3px;
    position: relative;
    width: 100%; /* Gumamit ng full width */
    max-width: 2000px; /* O set ng maximum width */
   
}

.table-wrapper {
  max-height: 300px;
  overflow-y: auto;
  border: 1px solid #ddd;
  border-radius: 5px;
}

.sticky-header th {
  position: sticky;
  top: 0;
  background-color:rgb(120, 123, 174); /* Custom header color */
  color: white;
  z-index: 10;
  font-family: 'Montserrat', sans-serif;
  font-weight: bold;
  text-align: center;
  white-space: nowrap;
  padding: 20px;
}

.table td, 
.table th {
  vertical-align: middle;
  text-align: center;
  padding: 15px;
  font-size: 14px;
  font-family: 'Montserrat', sans-serif;
  white-space: nowrap;
  overflow: hidden;
  text-overflow: ellipsis;
  max-width: 150px;
}

.icon-btn {
  width: 35px;
  height: 35px;
  border-radius: 50%;
  display: inline-flex;
  align-items: center;
  justify-content: center;
  font-size: 15px;
  border: none;
  padding: 0;
  transition: 0.3s ease;
  color: #fff;
}

.btn-edit {
  background-color: #ffc107; /* Bootstrap warning color */
}

.btn-edit:hover {
  background-color: #e0a800;
}

.btn-delete {
  background-color: #dc3545; /* Bootstrap danger color */
}

.btn-delete:hover {
  background-color: #bd2130;
}

/* Purple Theme */
.text-purple {
    color:rgb(21, 31, 168);
}

.btn-purple {
    background-color:rgb(21, 31, 168); /* Custom purple color */
    color: #ffffff; /* White text */
    font-weight: bold; /* Bold text */
    font-size: 18px; /* Adjust text size */
    padding: 12px; /* Padding for a larger button */
    border-radius: 5px; /* Rounded edges */
    border: none; /* Remove default border */
    
}

.btn-purple:hover {
    background-color: #3a1a80; /* Darker shade of purple on hover */
    color: white;
    
}


/* Close Button */
.close-purple {
    filter: brightness(0) saturate(100%) invert(14%) sepia(82%) saturate(3524%) hue-rotate(252deg) brightness(88%) contrast(92%);
}

.custom-close {
    position: absolute; /* Move to the top-right corner */
    top: 10px; /* Adjust the vertical position */
    right: 10px; /* Adjust the horizontal position */
    width: 20px; /* Adjust the button size */
    height: 20px;
    z-index: 10; /* Ensure it stays above other elements */
}


/* Underline Inputs */
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

.modal-title-custom {
    font-size: 24px;  /* Adjust the font size */
    font-weight: bold; /* Make it bold */
    text-align: center; /* Center align the text */
    width: 100%; /* Make sure it takes the full width */
    color:rgb(21, 31, 168); /* Custom purple color */
    margin: 0; /* Remove default margins */
    padding: 10px 0; /* Adjust spacing */
}

  </style>
</head>
<body>

<div class="container mt-5">
  <div class="card p-4">
    <div class="profile-header">Optical Concern</div>

    

    <!-- Add optical Form and Dropdown in a Row -->
    <form id="addopticalForm" class="row g-3 mt-3">
    <!-- Input for New optical -->
    <div class="col-md-6">
        <label for="opticalName" class="form-label">Add New Optical</label>
        <input type="text" class="form-control" id="opticalName" placeholder="Enter new optical..." required>
    </div>

    <!-- Submit Button -->
    <div class="col-md-2 d-flex align-items-end">
        <button type="submit" class="btn w-100 text-white" style="background-color:rgb(92, 103, 201);">
            <i class="bi bi-plus-circle"></i> Add
        </button>
    </div>


    <!-- optical Dropdown -->
    <div class="col-md-4">
        <label for="opticalSelect" class="form-label">Select Optical</label>
        <select id="opticalSelect" class="form-select">
        <option value="">-- Select optical --</option>
        <?php while ($row = $opticalQuery->fetch_assoc()): ?>
            <option value="<?= htmlspecialchars($row['id']) ?>">
            <?= htmlspecialchars($row['optical']) ?>
            </option>
        <?php endwhile; ?>
        </select>
    </div>
</form>


    

    <!-- optical List Table -->
<div class="mt-2">
    <div class="table-container">
        <div class="table-wrapper">
            <table class="table table-hover border" id="dataTable">
                <thead class="sticky-header">
                <tr>
                    <th style="width: 10%;">ID</th>
                    <th style="width: 60%;">Optical</th>
                    <th style="width: 30%;">Actions</th>
                </tr>
                </thead>
                <tbody id="opticalList">
                <?php
                $opticalQuery->data_seek(0);
                while ($row = $opticalQuery->fetch_assoc()): ?>
                    <tr data-id="<?= htmlspecialchars($row['id']) ?>">
                    <td><?= htmlspecialchars($row['id']) ?></td>
                    <td><?= htmlspecialchars($row['optical']) ?></td>
                    <td>
                        <!-- Edit Button -->
                        <button class="icon-btn btn-edit editoptical"
                                data-id="<?= htmlspecialchars($row['id']) ?>" 
                                data-name="<?= htmlspecialchars($row['optical']) ?>">
                        <i class="fas fa-edit"></i>
                        </button>

                        <!-- Delete Button -->
                        <button class="icon-btn btn-delete deleteoptical" 
                                data-id="<?= htmlspecialchars($row['id']) ?>">
                        <i class="fas fa-trash"></i>
                        </button>

                    </td>
                    </tr>
                <?php endwhile; ?>
                </tbody>
            </table>
        </div>
    </div>
</div>

<!-- Edit optical Modal -->
<div class="modal fade" id="editopticalModal" tabindex="-1" aria-labelledby="editopticalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content p-4">
            <!-- Modal Header -->
            <div class="d-flex justify-content-between align-items-center">
                <h5 class="modal-title-custom">Edit Optical</h5>
                <button type="button" class="btn-close close-purple custom-close" data-bs-dismiss="modal"></button>
            </div>

            <!-- Modal Body -->
            <div class="modal-body">
                <form id="editopticalForm">
                    <input type="hidden" id="editopticalId">

                    <div class="mb-4">
                        <label for="editopticalName" class="form-label fw-bold text-purple">Optical Name:</label>
                        <input type="text" class="form-control input-underline" id="editopticalName" required>
                    </div>

                    <div class="d-grid">
                        <button type="submit" class="btn btn-purple">SAVE CHANGES</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>

<script>
$(document).ready(function() {
    // Add optical
    $("#addopticalForm").submit(function(e) {
        e.preventDefault();
        let opticalName = $("#opticalName").val(); // Fixed variable
        $.post("", { action: "add", optical: opticalName }, function() {
            location.reload();
        });
    });

    // Delete optical
    $(".deleteoptical").click(function() {
        let id = $(this).data("id");
        if (confirm("Are you sure you want to delete this optical?")) {
            $.post("", { action: "delete", id: id }, function() {
                location.reload();
            });
        }
    });

    // Edit optical (Show Modal)
    $(".editoptical").click(function() {
        $("#editopticalId").val($(this).data("id"));
        $("#editopticalName").val($(this).data("name"));
        $("#editopticalModal").modal("show");
    });

    // Update optical
    $("#editopticalForm").submit(function(e) {
        e.preventDefault();
        let id = $("#editopticalId").val();
        let opticalName = $("#editopticalName").val(); // Fixed variable
        $.post("", { action: "update", id: id, optical: opticalName }, function() {
            location.reload();
        });
    });
});
</script>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>

<?php $conn->close(); ?>
