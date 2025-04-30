<?php
include 'connect.php';
include 'navbar.php';

// Fetch education data from the educational table
$query = "SELECT * FROM educational";
$result = $conn->query($query);

if (isset($_GET['id'])) {
    $id = $_GET['id'];
} elseif (isset($_POST['id'])) {
    $id = $_POST['id'];
} else {
    die("Walang ID na ipinasa.");
}

// Fetch the current record to pre-populate the form for editing
if (isset($id)) {
    $query = "SELECT * FROM senior_citizens WHERE id = ?";
    $stmt = $conn->prepare($query);
    $stmt->bind_param("i", $id);
    $stmt->execute();
    $result = $stmt->get_result();
    $row = $result->fetch_assoc();
}

// Handle form submission and update the record
if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['update'])) {
    // Get all form input values
    $last_name = $_POST['last_name'];
    $first_name = $_POST['first_name'];
    $middle_name = $_POST['middle_name'];
    $region = $_POST['region'];
    $province = $_POST['province'];
    $municipality = $_POST['municipality'];
    $barangay = $_POST['barangay'];
    $address = $_POST['address'];
    $birthdate = $_POST['birthdate'];
    $age = $_POST['age'];
    $birthplace = $_POST['birthplace'];
    $gender = $_POST['gender'];
    $marital_status = $_POST['marital_status'];
    $contact_number = $_POST['contact_number'];
    $religion = htmlspecialchars(trim($_POST['religion'] ?? ''));
    $ethnic = htmlspecialchars(trim($_POST['ethnic'] ?? ''));
    $language = htmlspecialchars(trim($_POST['language'] ?? ''));
    $rrn = htmlspecialchars(trim($_POST['rrn'] ?? ''));
    $service = htmlspecialchars(trim($_POST['service'] ?? ''));
    $osca_id = htmlspecialchars(trim($_POST['osca_id'] ?? ''));
    $sss_gsis = htmlspecialchars(trim($_POST['sss_gsis'] ?? ''));
    $tin = htmlspecialchars(trim($_POST['tin'] ?? ''));
    $philhealth = htmlspecialchars(trim($_POST['philhealth'] ?? ''));
    $other_govt_id = htmlspecialchars(trim($_POST['other_govt_id'] ?? ''));
    $travel = htmlspecialchars(trim($_POST['travel'] ?? ''));
    $pension = htmlspecialchars(trim($_POST['pension'] ?? ''));
    $spouse_name = htmlspecialchars(trim($_POST['spouse_name'] ?? ''));
    $fspouse = htmlspecialchars(trim($_POST['fspouse'] ?? ''));
    $mspouse = htmlspecialchars(trim($_POST['mspouse'] ?? ''));
    $children = htmlspecialchars(trim($_POST['children'] ?? ''));
    $fchild = htmlspecialchars(trim($_POST['fchild'] ?? ''));
    $mchild = htmlspecialchars(trim($_POST['mchild'] ?? ''));
    $childage = htmlspecialchars(trim($_POST['childage'] ?? ''));
    $occhild = htmlspecialchars(trim($_POST['occhild'] ?? ''));
    $working = htmlspecialchars(trim($_POST['working'] ?? ''));
    $education = htmlspecialchars(trim($_POST['education_new'] ?? ''));
    $mastery = htmlspecialchars(trim($_POST['mastery'] ?? ''));
    $household = htmlspecialchars(trim($_POST['household'] ?? ''));
    $residency = htmlspecialchars(trim($_POST['residency'] ?? ''));
    $source = htmlspecialchars(trim($_POST['source'] ?? ''));
    $properties = htmlspecialchars(trim($_POST['properties'] ?? ''));
    $asset = htmlspecialchars(trim($_POST['asset'] ?? ''));
    $income = htmlspecialchars(trim($_POST['income'] ?? ''));
    $problem = htmlspecialchars(trim($_POST['problem'] ?? ''));
    $blood = htmlspecialchars(trim($_POST['blood'] ?? ''));
    $hearing = htmlspecialchars(trim($_POST['hearing'] ?? ''));
    $dental = htmlspecialchars(trim($_POST['dental'] ?? ''));
    $optical = htmlspecialchars(trim($_POST['optical'] ?? ''));
    $social = htmlspecialchars(trim($_POST['social'] ?? ''));
    $area = htmlspecialchars(trim($_POST['area'] ?? ''));
    $medicines = htmlspecialchars(trim($_POST['medicines'] ?? ''));
    $remarks = htmlspecialchars(trim($_POST['remarks'] ?? ''));
    $checkup = htmlspecialchars(trim($_POST['checkup'] ?? ''));
    $done = htmlspecialchars(trim($_POST['done'] ?? ''));
    $medical = htmlspecialchars(trim($_POST['medical'] ?? ''));

    // Update the record in the database
    $query = "UPDATE senior_citizens 
              SET education=? 
              WHERE id=?";
    $stmt = $conn->prepare($query);
    $stmt->bind_param("si",
        $education,
        $id
    );

    if ($stmt->execute()) {
        echo "<script>alert('Record updated successfully!'); window.location.href='table.php';</script>";
    } else {
        echo "Error updating record.";
    }
}
?>


<style>
    body {
        background-color: #f8f9fa;
    }

    .section-header {
        background-color: rgb(21, 31, 168);
        color: white;
        padding: 10px;
        font-weight: bold;
    }

    .form-container {
        background: white;
        padding: 20px;
        border-radius: 8px;
        box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
    }

    .btn-submit {
        background-color: rgb(34, 84, 246);
        color: white;
        font-weight: bold;
    }

    .dropdown-menu {
        max-height: 200px;
        overflow-y: auto;
        display: none;
        position: absolute;
        top: 100%;
        left: 0;
        z-index: 1000;
    }

    .dropdown-menu.show {
        display: block;
    }
</style>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Registration Form</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</head>

<body class="bg-light">
    <div class="container mt-4">
        <div class="form-container">
            <form action="" method="POST">
                <div class="section-header">Personal Information</div>
                <div class="row g-2 mt-2">
                    <div class="col-md-4"><input type="text" name="last_name" class="form-control"
                            placeholder="Lastname" value="<?= htmlspecialchars($row['last_name']); ?>" required></div>
                    <div class="col-md-4"><input type="text" name="first_name" class="form-control"
                            placeholder="Firstname" value="<?= htmlspecialchars($row['first_name']); ?>" required></div>
                    <div class="col-md-4"><input type="text" name="middle_name" class="form-control"
                            placeholder="Middlename" value="<?= htmlspecialchars($row['middle_name']); ?>" required>
                    </div>
                </div>
                <div class="row g-2 mt-2">
                    <div class="col-md-6"><input type="text" name="region" class="form-control" placeholder="Region"
                            value="<?= htmlspecialchars($row['region']); ?>"></div>
                    <div class="col-md-6"><input type="text" name="province" class="form-control" placeholder="Province"
                            value="<?= htmlspecialchars($row['province']); ?>"></div>
                </div>
                <div class="row g-2 mt-2">
                    <div class="col-md-4"><input type="text" name="municipality" class="form-control"
                            placeholder="Municipality" value="<?= htmlspecialchars($row['municipality']); ?>"></div>
                    <div class="col-md-4"><input type="text" name="barangay" class="form-control" placeholder="Barangay"
                            value="<?= htmlspecialchars($row['barangay']); ?>"></div>
                    <div class="col-md-4"><input type="text" name="address" class="form-control" placeholder="Sitio"
                            value="<?= htmlspecialchars($row['address']); ?>"></div>
                </div>
                <div class="row g-2 mt-2">
                    <div class="col-md-4"><input type="text" name="birthdate" class="form-control"
                            placeholder="Birthday" value="<?= htmlspecialchars($row['birthdate']); ?>"></div>
                    <div class="col-md-4"><input type="text" name="age" class="form-control" placeholder="Age"
                            value="<?= htmlspecialchars($row['age']); ?>"></div>
                    <div class="col-md-4"><input type="text" name="birthplace" class="form-control"
                            placeholder="Birthplace" value="<?= htmlspecialchars($row['birthplace']); ?>"></div>
                </div>
                <div class="row g-2 mt-2">
                    <div class="col-md-4">
                        <select name="gender" class="form-control">
                            <option value="" disabled>Select Gender</option>
                            <option value="Male" <?= ($row['gender'] == 'Male') ? 'selected' : ''; ?>>Male</option>
                            <option value="Female" <?= ($row['gender'] == 'Female') ? 'selected' : ''; ?>>Female</option>
                        </select>
                    </div>
                    <div class="col-md-4">
                        <select name="marital_status" class="form-control">
                            <option value="Single" <?= ($row['marital_status'] == 'Single') ? 'selected' : ''; ?>>Single
                            </option>
                            <option value="Married" <?= ($row['marital_status'] == 'Married') ? 'selected' : ''; ?>>Married
                            </option>
                            <option value="Divorced" <?= ($row['marital_status'] == 'Divorced') ? 'selected' : ''; ?>>
                                Divorced</option>
                            <option value="Widowed" <?= ($row['marital_status'] == 'Widowed') ? 'selected' : ''; ?>>Widowed
                            </option>
                            <option value="Separated" <?= ($row['marital_status'] == 'Separated') ? 'selected' : ''; ?>>
                                Separated</option>
                        </select>
                    </div>
                    <div class="col-md-4"><input type="text" name="contact_number" class="form-control"
                            placeholder="Contact Number" value="<?= htmlspecialchars($row['contact_number']); ?>"></div>
                </div>

                <div class="row g-2 mt-2">
                    <div class="col-md-4"><input type="text" name="religion" class="form-control" placeholder="Religion"
                            value="<?= htmlspecialchars($row['religion']); ?>"></div>
                    <div class="col-md-4"><input type="text" name="ethnic" class="form-control"
                            placeholder="Ethnic Status" value="<?= htmlspecialchars($row['ethnic']); ?>"></div>
                    <div class="col-md-4"><input type="text" name="language" class="form-control" placeholder="Language"
                            value="<?= htmlspecialchars($row['language']); ?>"></div>
                </div>
                <div class="row g-2 mt-2">
                    <div class="col-md-4"><input type="text" name="osca_id" class="form-control" placeholder="Osca Id"
                            value="<?= htmlspecialchars($row['osca_id']); ?>"></div>
                    <div class="col-md-4"><input type="text" name="rrn" class="form-control" placeholder="RRN Number"
                            value="<?= htmlspecialchars($row['rrn']); ?>"></div>
                    <div class="col-md-4"><input type="text" name="sss_gsis" class="form-control"
                            placeholder="SSS & GSIS" value="<?= htmlspecialchars($row['sss_gsis']); ?>"></div>
                </div>
                <div class="row g-2 mt-2">
                    <div class="col-md-4"><input type="text" name="tin" class="form-control" placeholder="Tin Id"
                            value="<?= htmlspecialchars($row['tin']); ?>"></div>
                    <div class="col-md-4"><input type="text" name="philhealth" class="form-control"
                            placeholder="Philhealth" value="<?= htmlspecialchars($row['philhealth']); ?>"></div>
                    <div class="col-md-4"><input type="text" name="other_govt_id" class="form-control"
                            placeholder="Other Gov Id" value="<?= htmlspecialchars($row['other_govt_id']); ?>"></div>
                </div>
                <div class="row g-2 mt-2">
                    <div class="col-md-4"><input type="text" name="travel" class="form-control"
                            placeholder="Capability to Travel" value="<?= htmlspecialchars($row['travel']); ?>"></div>
                    <div class="col-md-4"><input type="text" name="service" class="form-control"
                            placeholder="Service & Business" value="<?= htmlspecialchars($row['service']); ?>"></div>
                    <div class="col-md-4"><input type="text" name="pension" class="form-control"
                            placeholder="Current Pension" value="<?= htmlspecialchars($row['pension']); ?>"></div>
                </div>

                <div class="section-header mt-3">Family Information</div>
                <div class="row g-2 mt-2">
                    <div class="col-md-4"><input type="text" name="spouse_name" class="form-control"
                            placeholder="Lastname of Spouse" value="<?= htmlspecialchars($row['spouse_name']); ?>">
                    </div>
                    <div class="col-md-4"><input type="text" name="fspouse" class="form-control"
                            placeholder="Firstname of Spouse" value="<?= htmlspecialchars($row['fspouse']); ?>"></div>
                    <div class="col-md-4"><input type="text" name="mspouse" class="form-control"
                            placeholder="Middlename of Spouse" value="<?= htmlspecialchars($row['mspouse']); ?>"></div>
                </div>
                <div class="row g-2 mt-2">
                    <div class="col-md-4"><input type="text" name="children" class="form-control"
                            placeholder="Lastname of Children" value="<?= htmlspecialchars($row['children']); ?>"></div>
                    <div class="col-md-4"><input type="text" name="fchild" class="form-control"
                            placeholder="Firstname of Children" value="<?= htmlspecialchars($row['fchild']); ?>"></div>
                    <div class="col-md-4"><input type="text" name="mchild" class="form-control"
                            placeholder="Middlename of Children" value="<?= htmlspecialchars($row['mchild']); ?>"></div>
                </div>
                <div class="row g-2 mt-2">
                    <div class="col-md-4"><input type="text" name="childage" class="form-control" placeholder="Age"
                            value="<?= htmlspecialchars($row['childage']); ?>"></div>
                    <div class="col-md-4"><input type="text" name="occhild" class="form-control"
                            placeholder="Occupation" value="<?= htmlspecialchars($row['occhild']); ?>"></div>
                    <div class="col-md-4"><input type="text" name="working" class="form-control"
                            placeholder="Working / Not Working" value="<?= htmlspecialchars($row['working']); ?>"></div>
                </div>

                <div class="col-md-4">
    <label for="education" class="form-label">Education</label>
    <select name="education_new" class="form-control" required>
        <option value="">Select Education Level</option>
        <?php
        // Fetch data from the educational table
        $sql = "SELECT * FROM educational";
        $result = $conn->query($sql);

        // Loop through the results and output each option in the dropdown
        while ($edu = $result->fetch_assoc()) {
            $selected = ($edu['educational'] == $row['education']) ? 'selected' : '';
            echo '<option value="' . htmlspecialchars($edu['educational']) . '" ' . $selected . '>' . htmlspecialchars($edu['educational']) . '</option>';
        }

        $conn->close();
        ?>
    </select>
</div>


                <div class="text-center mt-4">
                    <button type="submit" name="update" class="btn btn-primary w-100"
                        style="background-color:rgb(81, 0, 255); color: white; font-weight: bold; padding: 10px; font-size: 16px; border-radius: 5px; transition: background-color 0.3s ease;">
                        SUBMIT
                    </button>

                </div>

            </form>
        </div>
    </div>
</body>

</html>