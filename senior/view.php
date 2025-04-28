<?php
session_start();
include 'connect.php';


if (!isset($_GET['id'])) {
    echo "Invalid Request!";
    exit;
}

$id = $_GET['id'];
$sql = "SELECT * FROM senior_citizens WHERE id = ?";
$stmt = $conn->prepare($sql);
$stmt->bind_param("i", $id);
$stmt->execute();
$result = $stmt->get_result();

if ($result->num_rows === 0) {
    echo "Record not found!";
    exit;
}

$row = $result->fetch_assoc();

include 'navbar.php';
?>

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>View Senior Citizen</title>
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css">
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>

  <style>
    body {
      font-family: Arial, sans-serif;
    }

    .section-header {
      background-color:rgb(21, 31, 168);
      color: white;
      padding: 10px;
      font-weight: bold;
      margin-top: 20px;
    }

    .form-group {
      margin-bottom: 10px;
    }

    .label {
      font-weight: 600;
    }

    .value {
      background: #f8f9fa;
      border: 1px solid #dee2e6;
      padding: 6px 10px;
      border-radius: 4px;
    }

    .grid-3 {
      display: grid;
      grid-template-columns: repeat(3, 1fr);
      gap: 10px;
    }

    .grid-4 {
      display: grid;
      grid-template-columns: repeat(4, 1fr);
      gap: 10px;
    }

    .grid-2 {
      display: grid;
      grid-template-columns: 1fr 1fr;
      gap: 10px;
    }

    .border-box {
      border: 1px solid #dee2e6;
      padding: 15px;
      border-radius: 5px;
    }

    .container {
      max-width: 1000px;
    }

    @media print {
  body * {
    visibility: hidden;
  }

  .print-area, .print-area * {
    visibility: visible;
  }

  .print-area {
    position: absolute;
    left: 0;
    top: 0;
    width: 100%;
  }

  /* Optional: hide print button */
  .btn, .no-print {
    display: none !important;
  }

  .section-header {
    -webkit-print-color-adjust: exact;
    print-color-adjust: exact;
    background-color: rgb(21, 31, 168); /* or whatever color you want */
    color: white; /* for better contrast */
  }

  .no-print {
    display: none !important;
  }
}
  </style>
</head>
<body>
  <div class="container mt-4 print-area">
    <h2 class="text-center mb-4">Senior Citizen Data Form</h2>

    <!-- IDENTIFYING INFORMATION -->
    <div class="section-header">I. IDENTIFYING INFORMATION</div>
    <div class="border-box">
      <div class="grid-3">
        <div><span class="label">Last Name</span><div class="value"><?= htmlspecialchars($row['last_name']); ?></div></div>
        <div><span class="label">First Name</span><div class="value"><?= htmlspecialchars($row['first_name']); ?></div></div>
        <div><span class="label">Middle Name</span><div class="value"><?= htmlspecialchars($row['middle_name']); ?></div></div>
      </div>

      <div class="grid-4 mt-3">
        <div><span class="label">Region</span><div class="value"><?= htmlspecialchars($row['region']); ?></div></div>
        <div><span class="label">Province</span><div class="value"><?= htmlspecialchars($row['province']); ?></div></div>
        <div><span class="label">Municipality</span><div class="value"><?= htmlspecialchars($row['municipality']); ?></div></div>
        <div><span class="label">Barangay</span><div class="value"><?= htmlspecialchars($row['barangay']); ?></div></div>
      </div>

      <div class="grid-3 mt-3">
        <div><span class="label">Birthdate</span><div class="value"><?= htmlspecialchars($row['birthdate']); ?></div></div>
        <div><span class="label">Age</span><div class="value"><?= htmlspecialchars($row['age']); ?></div></div>
        <div><span class="label">Birthplace</span><div class="value"><?= htmlspecialchars($row['birthplace']); ?></div></div>
        
      </div>

      <div class="grid-3 mt-3">
        <div><span class="label">Marital Status</span><div class="value"><?= htmlspecialchars($row['marital_status']); ?></div></div>
        <div><span class="label">Gender</span><div class="value"><?= htmlspecialchars($row['gender']); ?></div></div>
        <div><span class="label">Contact Number</span><div class="value"><?= htmlspecialchars($row['contact_number']); ?></div></div>
        
      </div>

      <div class="grid-3 mt-3">
        <div><span class="label">Religion</span><div class="value"><?= htmlspecialchars($row['religion']); ?></div></div>
        <div><span class="label">Ethnic</span><div class="value"><?= htmlspecialchars($row['ethnic']); ?></div></div>
        <div><span class="label">Language</span><div class="value"><?= htmlspecialchars($row['language']); ?></div></div>
      </div>

      <div class="grid-3 mt-3">
        <div><span class="label">OSCA ID</span><div class="value"><?= htmlspecialchars($row['osca_id']); ?></div></div>
        <div><span class="label">RRN</span><div class="value"><?= htmlspecialchars($row['rrn']); ?></div></div>
        <div><span class="label">SSS/GSIS</span><div class="value"><?= htmlspecialchars($row['sss_gsis']); ?></div></div>
      </div>

      <div class="grid-3 mt-3">
        <div><span class="label">PhilHealth</span><div class="value"><?= htmlspecialchars($row['philhealth']); ?></div></div>
        <div><span class="label">Pension</span><div class="value"><?= htmlspecialchars($row['pension']); ?></div></div>
        <div><span class="label">Other Gov ID</span><div class="value"><?= htmlspecialchars($row['other_govt_id']); ?></div></div>
      </div>

      <div class="grid-3 mt-3">
        <div><span class="label">Capability to Travel</span><div class="value"><?= htmlspecialchars($row['travel']); ?></div></div>
        <div><span class="label">Service and Business</span><div class="value"><?= htmlspecialchars($row['service']); ?></div></div>
        <div><span class="label">Pension</span><div class="value"><?= htmlspecialchars($row['pension']); ?></div></div>
      </div>

      <div class="section-header">II. Family Composition</div>

      <div class="grid-1 mt-1">
        <div><span class="label">Name of Spouse</span><div class="value"><?= htmlspecialchars($row['spouse_name'] . ', ' . $row['fspouse'] . ' ' . $row['mspouse']); ?></div></div>
      </div>

      <div class="grid-4 mt-4" style="display: flex; gap: 12px; flex-wrap: wrap;">
        <div style="flex: 1;"><span class="label">Name of Children</span><div class="value" style="border: 1px solid #ccc; padding: 6px 10px; border-radius: 4px;"><?= htmlspecialchars($row['children'] . ', ' . $row['fchild'] . ' ' . $row['mchild']); ?></div></div>
        <div style="width: 80px;"><span class="label">Age</span><div class="value" style="border: 1px solid #ccc; padding: 6px 10px; border-radius: 4px; "><?= htmlspecialchars($row['age']); ?></div></div>
        <div style="flex: 1;"><span class="label">Occupation</span><div class="value" style="border: 1px solid #ccc; padding: 6px 10px; border-radius: 4px;"><?= htmlspecialchars($row['occhild']); ?></div></div>
        <div style="flex: 1;"><span class="label">Working? Yes or No</span><div class="value" style="border: 1px solid #ccc; padding: 6px 10px; border-radius: 4px;"><?= htmlspecialchars($row['working']); ?></div></div>
      </div>


      <div class="section-header">III. Educational Background</div>

      <div class="grid-2 mt-2">
        <div><span class="label">Educational Attainment</span><div class="value"><?= htmlspecialchars($row['education']); ?></div></div>
        <div><span class="label">Area of Specialization</span><div class="value"><?= htmlspecialchars($row['area']); ?></div></div>
      </div>

      <div class="section-header">IV. Dependency Profile</div>

      <div class="grid-2 mt-2">
        <div><span class="label">Residency & Residing</span><div class="value"><?= htmlspecialchars($row['residency']); ?></div></div>
        <div><span class="label">Household Condition</span><div class="value"><?= htmlspecialchars($row['household']); ?></div></div>
      </div>

      <div class="section-header">V. Economic Background</div>

      <div class="grid-3 mt-3">
        <div><span class="label">Source of Income</span><div class="value"><?= htmlspecialchars($row['source']); ?></div></div>
        <div><span class="label">Real and Immovable Asset</span><div class="value"><?= htmlspecialchars($row['properties']); ?></div></div>
        <div><span class="label">Personal Movable Asset</span><div class="value"><?= htmlspecialchars($row['asset']); ?></div></div>
      </div>

      <div class="grid-2 mt-2">
        <div><span class="label">Problem Needs Commonly Encoutered</span><div class="value"><?= htmlspecialchars($row['problem']); ?></div></div>
        <div><span class="label">Montly Income</span><div class="value"><?= htmlspecialchars($row['income']); ?></div></div>
      </div>

      <div class="section-header">VI. Health Concern</div>

      <div class="grid-2 mt-2">
        <div><span class="label">Blood Type</span><div class="value"><?= htmlspecialchars($row['blood']); ?></div></div>
        <div><span class="label">Medical Concern</span><div class="value"><?= htmlspecialchars($row['medical']); ?></div></div>
      </div>

      <div class="grid-3 mt-3">
        <div><span class="label">Optical Concern</span><div class="value"><?= htmlspecialchars($row['optical']); ?></div></div>
        <div><span class="label">Hearing Concern</span><div class="value"><?= htmlspecialchars($row['hearing']); ?></div></div>
        <div><span class="label">Dental Concern</span><div class="value"><?= htmlspecialchars($row['dental']); ?></div></div>
      </div>

      <div class="grid-2 mt-2">
        <div><span class="label">Social and Emmotional Concern</span><div class="value"><?= htmlspecialchars($row['social']); ?></div></div>
        <div><span class="label">Area of Difficulties</span><div class="value"><?= htmlspecialchars($row['area']); ?></div></div>
      </div>

      <div class="grid-1 mt-1">
        <div><span class="label">Medicines</span><div class="value"><?= htmlspecialchars($row['medicines']); ?></div></div>
      </div>

      <div class="grid-3 mt-3">
        <div><span class="label">Checkup</span><div class="value"><?= htmlspecialchars($row['checkup']); ?></div></div>
        <div><span class="label">If Yes when its Done</span><div class="value"><?= htmlspecialchars($row['done']); ?></div></div>
        <div><span class="label">Remarks</span><div class="value"><?= htmlspecialchars($row['remarks']); ?></div></div>
      </div>
    </div>

    <div class="mt-4 d-flex gap-2">
      <a href="table.php" class="btn btn-secondary">Back</a>
      <a href="update.php?id=<?= $row['id']; ?>" class="btn btn-primary">Edit</a>
      <button onclick="window.print()" class="btn btn-success">Print</button>
    </div>

    
  </div>
</body>
</html>

