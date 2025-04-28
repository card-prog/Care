<?php
session_start();
require 'connect.php'; // Database connection
include 'navbar.php';

// Handle CRUD Operations
if ($_SERVER["REQUEST_METHOD"] === "POST") {
    $action = $_POST['action'] ?? '';

    if ($action === "add") {
        $medical = $_POST['medical'] ?? '';
        if (!empty($medical)) { // Fixed: Correct variable name
            $stmt = $conn->prepare("INSERT INTO medical (medical) VALUES (?)");
            $stmt->bind_param("s", $medical);
            $stmt->execute();
            $stmt->close();
        }
    } elseif ($action === "update") {
        $id = $_POST['id'] ?? '';
        $medical = $_POST['medical'] ?? '';
        if (!empty($id) && !empty($medical)) {
            $stmt = $conn->prepare("UPDATE medical SET medical=? WHERE id=?");
            $stmt->bind_param("si", $medical, $id);
            $stmt->execute();
            $stmt->close();
        }
    } elseif ($action === "delete") {
        $id = $_POST['id'] ?? '';
        if (!empty($id)) {
            $stmt = $conn->prepare("DELETE FROM medical WHERE id=?");
            $stmt->bind_param("i", $id);
            $stmt->execute();
            $stmt->close();
        }
    }
    exit;
}

// Get all medical records
$medicalQuery = $conn->query("SELECT * FROM medical");
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>medical Management</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</head>
<body class="bg-light">
<div class="container mt-4">
    <h2>Manage medical Attainment</h2>

    <!-- medical Dropdown -->
    <label for="medicalSelect">Select medical:</label>
    <select id="medicalSelect" class="form-control">
        <option value="">-- Select medical --</option>
        <?php while ($row = $medicalQuery->fetch_assoc()): ?> <!-- Fixed variable -->
            <option value="<?= htmlspecialchars($row['id']) ?>">
                <?= htmlspecialchars($row['medical']) ?> <!-- Fixed field name -->
            </option>
        <?php endwhile; ?>
    </select>

    <!-- Add medical Form -->
    <form id="addmedicalForm" class="mt-3">
        <div class="form-group">
            <label for="medicalName">Add medical:</label>
            <input type="text" class="form-control" id="medicalName" required>
        </div>
        <button type="submit" class="btn btn-success mt-2">Add</button>
    </form>

    <!-- medical List with Edit/Delete -->
    <h4 class="mt-4">medical List</h4>
    <table class="table table-bordered mt-2">
        <thead>
            <tr>
                <th>ID</th>
                <th>medical</th>
                <th>Actions</th>
            </tr>
        </thead>
        <tbody id="medicalList">
            <?php
            $medicalQuery->data_seek(0);
            while ($row = $medicalQuery->fetch_assoc()): ?>
                <tr data-id="<?= htmlspecialchars($row['id']) ?>">
                    <td><?= htmlspecialchars($row['id']) ?></td>
                    <td><?= htmlspecialchars($row['medical']) ?></td>
                    <td>
                        <button class="btn btn-warning btn-sm editmedical" 
                                data-id="<?= htmlspecialchars($row['id']) ?>" 
                                data-name="<?= htmlspecialchars($row['medical']) ?>">Edit</button>
                        <button class="btn btn-danger btn-sm deletemedical" 
                                data-id="<?= htmlspecialchars($row['id']) ?>">Delete</button>
                    </td>
                </tr>
            <?php endwhile; ?>
        </tbody>
    </table>
</div>

<!-- Edit Modal -->
<div class="modal fade" id="editmedicalModal" tabindex="-1">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Edit medical</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
            </div>
            <div class="modal-body">
                <form id="editmedicalForm">
                    <input type="hidden" id="editmedicalId">
                    <div class="row">
                        <div class="col-md-12">
                            <label for="editmedicalName" class="form-label">medical Name:</label>
                            <input type="text" class="form-control" id="editmedicalName" required>
                        </div>
                    </div>
                    <button type="submit" class="btn btn-primary mt-3 w-100">Save Changes</button>
                </form>
            </div>
        </div>
    </div>
</div>

<script>
$(document).ready(function() {
    // Add medical
    $("#addmedicalForm").submit(function(e) {
        e.preventDefault();
        let medicalName = $("#medicalName").val(); // Fixed variable
        $.post("", { action: "add", medical: medicalName }, function() {
            location.reload();
        });
    });

    // Delete medical
    $(".deletemedical").click(function() {
        let id = $(this).data("id");
        if (confirm("Are you sure you want to delete this medical?")) {
            $.post("", { action: "delete", id: id }, function() {
                location.reload();
            });
        }
    });

    // Edit medical (Show Modal)
    $(".editmedical").click(function() {
        $("#editmedicalId").val($(this).data("id"));
        $("#editmedicalName").val($(this).data("name"));
        $("#editmedicalModal").modal("show");
    });

    // Update medical
    $("#editmedicalForm").submit(function(e) {
        e.preventDefault();
        let id = $("#editmedicalId").val();
        let medicalName = $("#editmedicalName").val(); // Fixed variable
        $.post("", { action: "update", id: id, medical: medicalName }, function() {
            location.reload();
        });
    });
});
</script>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>

<?php $conn->close(); ?>
