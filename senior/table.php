<?php
session_start();
include 'connect.php';
include 'navbar.php';

if (isset($_SESSION['imported']) && $_SESSION['imported'] === true) {
    unset($_SESSION['imported']);
}

// Fetch records
$sql = "SELECT * FROM senior_citizens";
$result = $conn->query($sql);

// Handle delete request
if (isset($_GET['delete_id'])) {
    $id = intval($_GET['delete_id']); // Convert to integer for security

    $stmt = $conn->prepare("DELETE FROM senior_citizens WHERE id = ?");
    $stmt->bind_param("i", $id);

    if ($stmt->execute()) {
        echo "<script>alert('Record deleted successfully!'); window.location.href='table.php';</script>";
        exit();
    } else {
        echo "<script>alert('Error deleting record!');</script>";
    }
}

$remarks = isset($_GET['remarks']) ? strtoupper(trim($_GET['remarks'])) : '';

$where = '';
if (!empty($remarks)) {
    $where = "WHERE UPPER(TRIM(remarks)) = '$remarks'";
}

$sql = "SELECT * FROM senior_citizens $where";
$result = $conn->query($sql);


// Fetch distinct barangays for the filter
$barangayQuery = "SELECT DISTINCT barangay FROM barangay ORDER BY barangay ASC";
$barangayResult = $conn->query($barangayQuery);

$sourceQuery = "SELECT DISTINCT source FROM source ORDER BY source ASC";
$sourceResult = $conn->query($sourceQuery);

$problemQuery = "SELECT DISTINCT problem FROM problem ORDER BY problem ASC";
$problemResult = $conn->query($problemQuery);

$incomeQuery = "SELECT DISTINCT income FROM income ORDER BY income ASC";
$incomeResult = $conn->query($incomeQuery);

$hearingQuery = "SELECT DISTINCT hearing FROM hearing ORDER BY hearing ASC";
$hearingResult = $conn->query($hearingQuery);

$dentalQuery = "SELECT DISTINCT dental FROM dental ORDER BY dental ASC";
$dentalResult = $conn->query($dentalQuery);

$opticalQuery = "SELECT DISTINCT optical FROM optical ORDER BY optical ASC";
$opticalResult = $conn->query($opticalQuery);

$socialQuery = "SELECT DISTINCT social FROM social ORDER BY social ASC";
$socialResult = $conn->query($socialQuery);

$areaQuery = "SELECT DISTINCT area FROM area ORDER BY area ASC";
$areaResult = $conn->query($areaQuery);




?>



<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Senior Citizen Data</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons/font/bootstrap-icons.css">
    <!-- Bootstrap 5 JS (with Popper) -->
<script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.8/dist/umd/popper.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.min.js"></script>


</head>
<style>
    .thead-custom {
        background-color: #0C2D0B;
        color: white;
    }

    

 

    /* Header Styles */
    .table thead th {
        white-space: nowrap;
        background-color: rgb(21, 31, 168); /* Your preferred color */
        color: white;
        padding: 20px;
        font-family: 'Montserrat', sans-serif;
        font-weight: bold;
        text-align: center;
        
    }

    .table td, 
    .table th {
        vertical-align: middle;
        padding: 10px;
        text-align: center;
        font-size: 14px; /* Ensuring uniform font size */
        max-width: 150px; /* Limiting width */
        white-space: nowrap;
        overflow: hidden;
        text-overflow: ellipsis; /* Shows '...' if text is too long */
       
    }

    /* Custom Width for "Action" Column */
    .table th:first-child,
    .table td:first-child {
        width: 60%;
        min-width: 200px;
        text-align: center;
    }

    /* Hover Effect */
    .table tbody tr:hover {
        background-color: #f5f5f5;
        transition: 0.3s;
    }

    /* General Icon Button Styling */
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
  margin: 0 5px;
}

/* View Button - Blue */
.btn-view {
  background-color: #3498db;
  border: 2px solid #2980b9;
}

.btn-view:hover {
  background-color: #2980b9;
  border-color: #1c6690;
}

/* Edit Button - Yellow */
.btn-edit {
  background-color: #ffc107;
  border: 2px solid #e0a800;
}

.btn-edit:hover {
  background-color: #e0a800;
}

/* Delete Button - Red */
.btn-delete {
  background-color: #dc3545;
  border: 2px solid #bd2130;
}

.btn-delete:hover {
  background-color: #bd2130;
}

    /* Modal Background */
.modal { 
    display: none; 
    position: fixed; 
    z-index: 1; 
    left: 0; 
    top: 0; 
    width: 100%; 
    height: 100%; 
    background-color: rgba(0,0,0,0.4);
}

/* Modal Content */
.modal-content { 
    background-color: #fff; 
    margin: 10% auto; 
    padding: 20px; 
    border-radius: 8px; 
    width: 30%; 
    max-width: 400px; /* Set a max width for larger screens */
    text-align: left; 
    position: relative; 
    box-shadow: 0px 4px 10px rgba(0, 0, 0, 0.2);
}

/* Custom Close Button */
.close-purple {
    filter: brightness(0) saturate(100%) invert(14%) sepia(82%) saturate(3524%) hue-rotate(252deg) brightness(88%) contrast(92%);
}

.custom-close {
    position: absolute; 
    top: 10px; 
    right: 10px; 
    width: 20px; 
    height: 20px; 
    z-index: 10; 
    cursor: pointer;
}

/* Underline Inputs */
.input-underline {
    border: none;
    border-bottom: 2px solid #ddd;
    border-radius: 0;
    padding: 8px;
    font-size: 16px;
    width: 100%;
}

.input-underline:focus {
    outline: none;
    border-bottom: 2px solid rgb(21, 31, 168);
    box-shadow: none;
}

/* Modal Title */
.modal-title-custom {
    font-size: 24px;
    font-weight: bold;
    text-align: center;
    width: 100%;
    color: rgb(21, 31, 168);
    margin: 0;
    padding: 10px 0;
}

/* Purple Theme */
.text-purple {
    color: rgb(21, 31, 168);
}

.btn-purple {
    background-color: rgb(21, 31, 168);
    color: #ffffff;
    font-weight: bold;
    font-size: 18px;
    padding: 12px;
    border-radius: 5px;
    border: none;
}

.btn-purple:hover {
    background-color: #3a1a80;
    color: white;
}

.custom-import-section {
    padding-top: 15px; /* Adjust spacing */
    
    
}

.row {
    align-items: center; /* Ensures all elements align properly */
}



.custom-container {
    max-width: 1500px; /* Customize this value */
    padding: 20px;      /* Optional: Adds spacing inside */
    
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
  margin-top: 20px;
  max-height: 400px;         /* Set max height of the table container */
  overflow-y: auto;          /* Enable vertical scroll */
  top: 5px;

}

.sticky-header th {
  position: sticky;
  top: 0;
  background-color: #ffffff; /* Make sure background is set */
  

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




</style>
<body>
<div class="container mb-4">
    <div class="container-fluid bg-white mt-3 rounded-lg pb-2 border custom-container">

            <div class="profile-header">Senior Citizens Data</div>

            <!-- Search, Filter, Import, and Export Section -->
            <div class="row mb-3 mt-2 align-items-center">
            
            <!-- Search Input -->
            <div class="col-md-3">
                <input type="text" id="search" class="form-control" placeholder="Search records...">
            </div>

            <!-- Import Section -->
            <div class="col-md-5 custom-import-section">
                <form action="" enctype="multipart/form-data" method="post" class="d-flex">
                    <input type="file" name="excel" class="form-control me-2" required>
                    <button type="submit" name="import" class="btn btn-primary">Import</button>
                    <button type="button" class="btn btn-success custom-export-btn ms-2" onclick="showExportModal()">Export</button>
                </form>
            </div>


            <!-- Filter Dropdown -->
            <div class="col-md-4 row-custom">
                <div class="dropdown">
                    <button class="btn btn-primary dropdown-toggle w-100" type="button" data-bs-toggle="dropdown" aria-expanded="false">
                        Filter Options
                    </button>

                    <div class="dropdown-menu p-3" style="width: 350px; max-height: 350px; overflow-y: auto;">
                        <label class="form-label">Barangay</label>
                        <select id="barangayFilter" class="form-control mb-2">
                            <option value="">Select Barangay</option>
                            <?php while ($row = $barangayResult->fetch_assoc()) { ?>
                                <option value="<?php echo $row['barangay']; ?>"><?php echo strtoupper($row['barangay']); ?></option>
                            <?php } ?>
                        </select>

                        <label class="form-label">Source of Income</label>
                        <select id="sourceFilter" class="form-control mb-2">
                            <option value="">Select Source of Income</option>
                            <?php while ($row = $sourceResult->fetch_assoc()) { ?>
                                <option value="<?php echo $row['source']; ?>"><?php echo strtoupper($row['source']); ?></option>
                            <?php } ?>
                        </select>

                        <label class="form-label">Problem / Needs Encountered</label>
                        <select id="problemFilter" class="form-control mb-2">
                            <option value="">Select Problem</option>
                            <?php while ($row = $problemResult->fetch_assoc()) { ?>
                                <option value="<?php echo $row['problem']; ?>"><?php echo strtoupper($row['problem']); ?></option>
                            <?php } ?>
                        </select>

                        <label class="form-label">Income Level</label>
                        <select id="incomeFilter" class="form-control mb-2">
                            <option value="">Select Income Level</option>
                            <?php while ($row = $incomeResult->fetch_assoc()) { ?>
                                <option value="<?php echo $row['income']; ?>"><?php echo strtoupper($row['income']); ?></option>
                            <?php } ?>
                        </select>

                        <label class="form-label">Hearing Concern</label>
                        <select id="hearingFilter" class="form-control mb-2">
                            <option value="">Select Hearing Concern</option>
                            <?php while ($row = $hearingResult->fetch_assoc()) { ?>
                                <option value="<?php echo $row['hearing']; ?>"><?php echo strtoupper($row['hearing']); ?></option>
                            <?php } ?>
                        </select>

                        <label class="form-label">Dental Concern</label>
                        <select id="dentalFilter" class="form-control mb-2">
                            <option value="">Select Dental Concern</option>
                            <?php while ($row = $dentalResult->fetch_assoc()) { ?>
                                <option value="<?php echo $row['dental']; ?>"><?php echo strtoupper($row['dental']); ?></option>
                            <?php } ?>
                        </select>

                        <label class="form-label">Optical Concern</label>
                        <select id="opticalFilter" class="form-control mb-2">
                            <option value="">Select Optical Concern</option>
                            <?php while ($row = $opticalResult->fetch_assoc()) { ?>
                                <option value="<?php echo $row['optical']; ?>"><?php echo strtoupper($row['optical']); ?></option>
                            <?php } ?>
                        </select>

                        <label class="form-label">Social & Emotional Concern</label>
                        <select id="socialFilter" class="form-control mb-2">
                            <option value="">Select Social Concern</option>
                            <?php while ($row = $socialResult->fetch_assoc()) { ?>
                                <option value="<?php echo $row['social']; ?>"><?php echo strtoupper($row['social']); ?></option>
                            <?php } ?>
                        </select>

                        <label class="form-label">Area of Difficulties</label>
                        <select id="areaFilter" class="form-control mb-2">
                            <option value="">Select Area of Difficulties</option>
                            <?php while ($row = $areaResult->fetch_assoc()) { ?>
                                <option value="<?php echo $row['area']; ?>"><?php echo strtoupper($row['area']); ?></option>
                            <?php } ?>
                        </select>

                        <form method="GET" class="mb-3">
                            <label class="form-label">Remarks</label>
                            <select name="remarks" class="form-control" onchange="this.form.submit()">
                                <option value="">Select Remarks</option>
                                <option value="YES" <?= isset($_GET['remarks']) && $_GET['remarks'] === 'YES' ? 'selected' : '' ?>>YES</option>
                                <option value="NO" <?= isset($_GET['remarks']) && $_GET['remarks'] === 'NO' ? 'selected' : '' ?>>NO</option>
                            </select>
                        </form>




                        <!-- Reset Filters Button -->
                        <button class="btn btn-danger w-100 mt-3" id="resetFilters">Reset Filters</button>
                    </div>
                </div>
            </div>
                


            




                
            

                
        





            <div class="table-container">
                <div class="table-wrapper">
                    <table class="table table-hover border" id="dataTable">
                        <thead class="sticky-header">
                            <tr>
                                <th>Action</th>
                                <th>Last Name</th>
                                <th>First Name</th>
                                <th>Middle Name</th>
                                <th>Region</th>
                                <th>Province</th>
                                <th>Municipality</th>
                                <th class="barangay">Barangay</th>
                                <th>Address</th>
                                <th>Birthdate</th>
                                <th>Age</th>
                                <th>Birthplace</th>
                                <th>Marital Status</th>
                                <th>Gender</th>
                                <th>Contact Number</th>
                                <th>Religion</th>
                                <th>Ethnic</th>
                                <th>Language</th>
                                <th>OSCA ID</th>
                                <th>RRN</th>
                                <th>SSS/GSIS</th>
                                <th>TIN</th>
                                <th>PhilHealth</th>
                                <th>Other Govt ID</th>
                                <th>Travel</th>
                                <th>Service</th>
                                <th>Pension</th>
                                <th>Spouse Last Name</th>
                                <th>Spouse First Name</th>
                                <th>Spouse Middle Name</th>
                                <th>Children Last Name</th>
                                <th>Children First Name</th>
                                <th>Children Middle Name</th>
                                <th>Child Age</th>
                                <th>Employment Status</th>
                                <th>Working</th>
                                <th>Education</th>
                                <th>Mastery</th>
                                <th>Residency</th>
                                <th>Household</th>
                                <th class="source">Source</th>
                                <th>Properties</th>
                                <th>Asset</th>
                                <th class="income">Income</th>
                                <th class="problem">Problem</th>
                                <th>Blood</th>
                                <th>Medical</th>
                                <th class="hearing">Hearing</th>
                                <th class="optical">Optical</th>
                                <th class="dental">Dental</th>
                                <th class="social">Social</th>
                                <th class="area">Area</th>
                                <th>Medicines</th>
                                <th>Checkup</th>
                                <th>Done</th>
                                <th class="remarks">Remarks</th>

                            </tr>
                    
                    </thead>
                    <tbody>
                        <?php while ($row = $result->fetch_assoc()): ?>
                            <tr>
                                <td>
                                    <!-- View Button -->
                                    <a href="view.php?id=<?= $row['id']; ?>" class="icon-btn btn-view">
                                        <i class="fas fa-eye"></i>
                                    </a>

                                    <!-- Edit Button -->
                                    <a href="update.php?id=<?= $row['id']; ?>" class="icon-btn btn-edit">
                                        <i class="fas fa-edit"></i>
                                    </a>
                                    <a href="?delete_id=<?= htmlspecialchars($row['id']); ?>" class="icon-btn btn-delete" onclick="return confirmDelete();"><i class="fas fa-trash"></i></a>
                                </td>

                                <td><?= htmlspecialchars($row['last_name']); ?></td>
                                <td><?= htmlspecialchars($row['first_name']); ?></td>
                                <td><?= htmlspecialchars($row['middle_name']); ?></td>
                                <td><?= htmlspecialchars($row['region']); ?></td>
                                <td><?= htmlspecialchars($row['province']); ?></td>
                                <td><?= htmlspecialchars($row['municipality']); ?></td>
                                <td class="barangay"><?= htmlspecialchars($row['barangay']); ?></td>
                                <td><?= htmlspecialchars($row['address']); ?></td>
                                <td><?= htmlspecialchars($row['birthdate']); ?></td>
                                <td><?= htmlspecialchars($row['age']); ?></td>
                                <td><?= htmlspecialchars($row['birthplace']); ?></td>
                                <td><?= htmlspecialchars($row['marital_status']); ?></td>
                                <td><?= htmlspecialchars($row['gender']); ?></td>
                                <td><?= htmlspecialchars($row['contact_number']); ?></td>
                                <td><?= htmlspecialchars($row['religion']); ?></td>
                                <td><?= htmlspecialchars($row['ethnic']); ?></td>
                                <td><?= htmlspecialchars($row['language']); ?></td>
                                <td><?= htmlspecialchars($row['osca_id']); ?></td>
                                <td><?= htmlspecialchars($row['rrn']); ?></td>
                                <td><?= htmlspecialchars($row['sss_gsis']); ?></td>
                                <td><?= htmlspecialchars($row['tin']); ?></td>
                                <td><?= htmlspecialchars($row['philhealth']); ?></td>
                                <td><?= htmlspecialchars($row['other_govt_id']); ?></td>
                                <td><?= htmlspecialchars($row['travel']); ?></td>
                                <td><?= htmlspecialchars($row['service']); ?></td>
                                <td><?= htmlspecialchars($row['pension']); ?></td>
                                <td><?= htmlspecialchars($row['spouse_name']); ?></td>
                                <td><?= htmlspecialchars($row['fspouse']); ?></td>
                                <td><?= htmlspecialchars($row['mspouse']); ?></td>
                                <td><?= htmlspecialchars($row['children']); ?></td>
                                <td><?= htmlspecialchars($row['fchild']); ?></td>
                                <td><?= htmlspecialchars($row['mchild']); ?></td>
                                <td><?= htmlspecialchars($row['childage']); ?></td>
                                <td><?= htmlspecialchars($row['occhild']); ?></td>
                                <td><?= htmlspecialchars($row['working']); ?></td>
                                <td><?= htmlspecialchars($row['education']); ?></td>
                                <td><?= htmlspecialchars($row['mastery']); ?></td>
                                <td><?= htmlspecialchars($row['residency']); ?></td>
                                <td><?= htmlspecialchars($row['household']); ?></td>
                                <td class="source"><?= htmlspecialchars($row['source']); ?></td>
                                <td><?= htmlspecialchars($row['properties']); ?></td>
                                <td><?= htmlspecialchars($row['asset']); ?></td>
                                <td class="income"><?= htmlspecialchars($row['income']); ?></td>
                                <td class="problem"><?= htmlspecialchars($row['problem']); ?></td>
                                <td><?= htmlspecialchars($row['blood']); ?></td>
                                <td><?= htmlspecialchars($row['medical']); ?></td>
                                <td class="hearing"><?= htmlspecialchars($row['hearing']); ?></td>
                                <td class="optical"><?= htmlspecialchars($row['optical']); ?></td>
                                <td class="dental"><?= htmlspecialchars($row['dental']); ?></td>
                                <td class="social"><?= htmlspecialchars($row['social']); ?></td>
                                <td class="area"><?= htmlspecialchars($row['area']); ?></td>
                                <td><?= htmlspecialchars($row['medicines']); ?></td>
                                <td><?= htmlspecialchars($row['checkup']); ?></td>
                                <td><?= htmlspecialchars($row['done']); ?></td>
                                <td class="remarks"><?= htmlspecialchars($row['remarks']); ?></td>
                            </tr>
                        <?php endwhile; ?>
                    </tbody>
                </table>
            </div>
        </div>
        <!-- Export Modal -->
        <div id="exportModal" class="modal">
            <div class="modal-content">
                <!-- Close Button -->
                <button type="button" class="btn-close close-purple custom-close" onclick="closeExportModal()" aria-label="Close"></button>

                <h3 class="modal-title-custom">Export Data</h3>

                <div class="modal-body">
                    <form>
                        <input type="hidden" name="export_excel" value="1">
                        
                        <!-- Filename Input -->
                        <div class="mb-4">
                            <label class="form-label fw-bold text-purple">File Name:</label>
                            <input type="text" id="fileNameInput" class="form-control input-underline" placeholder="Enter file name..." required>
                        </div>
                        
                        <!-- Download Button -->
                        <div class="d-grid">
                            <button type="button" class="btn btn-purple" onclick="exportToExcel()">DOWNLOAD</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>




<?php
if (isset($_POST["import"])) {
    $filename = $_FILES["excel"]["name"];
    $fileExtension = pathinfo($filename, PATHINFO_EXTENSION);
    $newFileName = date("Y.m.d") . "_" . date("h.i.sa") . "." . $fileExtension;

    $targetDirectory = "uploads/" . $newFileName;
    
    if (move_uploaded_file($_FILES["excel"]["tmp_name"], $targetDirectory)) {
        error_reporting(0);
        ini_set('display_errors', 0);

        require "excelreader/excel_reader2.php";
        require "excelreader/SpreadsheetReader.php";

        $reader = new SpreadsheetReader($targetDirectory);
        $rowCount = 0;

        foreach ($reader as $row) {
            if ($rowCount < 2) {
                $rowCount++;
                continue;
            }

            // sanitize each field
            $lastname = strtoupper(mysqli_real_escape_string($conn, $row[0]));
            $firstname = strtoupper(mysqli_real_escape_string($conn, $row[1]));
            $middlename = strtoupper(mysqli_real_escape_string($conn, $row[2]));
            $region = strtoupper(mysqli_real_escape_string($conn, $row[3]));
            $province = strtoupper(mysqli_real_escape_string($conn, $row[4]));
            $municipality = strtoupper(mysqli_real_escape_string($conn, $row[5]));
            $barangay = strtoupper(mysqli_real_escape_string($conn, $row[6]));
            $address = strtoupper(mysqli_real_escape_string($conn, $row[7]));
            $birthdate = strtoupper(mysqli_real_escape_string($conn, $row[8]));
            $age = strtoupper(mysqli_real_escape_string($conn, $row[9]));
            $birthplace = strtoupper(mysqli_real_escape_string($conn, $row[10]));
            $marital_status = strtoupper(mysqli_real_escape_string($conn, $row[11]));
            $gender = strtoupper(mysqli_real_escape_string($conn, $row[12]));
            $contact_number = strtoupper(mysqli_real_escape_string($conn, $row[13]));
            $religion = strtoupper(mysqli_real_escape_string($conn, $row[14]));
            $ethnic = strtoupper(mysqli_real_escape_string($conn, $row[15]));
            $language = strtoupper(mysqli_real_escape_string($conn, $row[16]));
            $osca_id = strtoupper(mysqli_real_escape_string($conn, $row[17]));
            $rrn = strtoupper(mysqli_real_escape_string($conn, $row[18]));
            $sss_gsis = strtoupper(mysqli_real_escape_string($conn, $row[19]));
            $tin = strtoupper(mysqli_real_escape_string($conn, $row[20]));
            $philhealth = strtoupper(mysqli_real_escape_string($conn, $row[21]));
            $other_govt_id = strtoupper(mysqli_real_escape_string($conn, $row[22]));
            $travel = strtoupper(mysqli_real_escape_string($conn, $row[23]));
            $service = strtoupper(mysqli_real_escape_string($conn, $row[24]));
            $pension = strtoupper(mysqli_real_escape_string($conn, $row[25]));
            $spouse_name = strtoupper(mysqli_real_escape_string($conn, $row[26]));
            $fspouse = strtoupper(mysqli_real_escape_string($conn, $row[27]));
            $mspouse = strtoupper(mysqli_real_escape_string($conn, $row[28]));
            $children = strtoupper(mysqli_real_escape_string($conn, $row[29]));
            $fchild = strtoupper(mysqli_real_escape_string($conn, $row[30]));
            $mchild = strtoupper(mysqli_real_escape_string($conn, $row[31]));
            $childage = strtoupper(mysqli_real_escape_string($conn, $row[32]));
            $occhild = strtoupper(mysqli_real_escape_string($conn, $row[33]));
            $working = strtoupper(mysqli_real_escape_string($conn, $row[34]));
            $education = strtoupper(mysqli_real_escape_string($conn, $row[35]));
            $mastery = strtoupper(mysqli_real_escape_string($conn, $row[36]));
            $residency = strtoupper(mysqli_real_escape_string($conn, $row[37]));
            $household = strtoupper(mysqli_real_escape_string($conn, $row[38]));
            $source = strtoupper(mysqli_real_escape_string($conn, $row[39]));
            $properties = strtoupper(mysqli_real_escape_string($conn, $row[40]));
            $asset = strtoupper(mysqli_real_escape_string($conn, $row[41]));
            $income = strtoupper(mysqli_real_escape_string($conn, $row[42]));
            $problem = strtoupper(mysqli_real_escape_string($conn, $row[43]));
            $blood = strtoupper(mysqli_real_escape_string($conn, $row[44]));
            $medical = strtoupper(mysqli_real_escape_string($conn, $row[45]));
            $hearing = strtoupper(mysqli_real_escape_string($conn, $row[46]));
            $optical = strtoupper(mysqli_real_escape_string($conn, $row[47]));
            $dental = strtoupper(mysqli_real_escape_string($conn, $row[48]));
            $social = strtoupper(mysqli_real_escape_string($conn, $row[49]));
            $area = strtoupper(mysqli_real_escape_string($conn, $row[50]));
            $medicines = strtoupper(mysqli_real_escape_string($conn, $row[51]));
            $checkup = strtoupper(mysqli_real_escape_string($conn, $row[52]));
            $done = strtoupper(mysqli_real_escape_string($conn, $row[53]));
            $remarks = strtoupper(mysqli_real_escape_string($conn, $row[54]));


            $sql = "INSERT INTO senior_citizens (
                last_name, first_name, middle_name, region, province, municipality, barangay, address, birthdate, age,
                birthplace, marital_status, gender, contact_number, religion, ethnic, language, osca_id, rrn, sss_gsis, tin,
                philhealth, other_govt_id, travel, service, pension, spouse_name, fspouse, mspouse, children, fchild, mchild,
                childage, occhild, working, education, mastery, residency, household, source, properties, asset, income,
                problem, blood, medical, hearing, optical, dental, social, area, medicines, checkup, done, remarks
            ) VALUES (
                '$lastname', '$firstname', '$middlename', '$region', '$province', '$municipality', '$barangay', '$address', '$birthdate', '$age',
                '$birthplace', '$marital_status', '$gender', '$contact_number', '$religion', '$ethnic', '$language', '$osca_id', '$rrn', '$sss_gsis', '$tin',
                '$philhealth', '$other_govt_id', '$travel', '$service', '$pension', '$spouse_name', '$fspouse', '$mspouse', '$children', '$fchild', '$mchild',
                '$childage', '$occhild', '$working', '$education', '$mastery', '$residency', '$household', '$source', '$properties', '$asset', '$income',
                '$problem', '$blood', '$medical', '$hearing', '$optical', '$dental', '$social', '$area', '$medicines', '$checkup', '$done', '$remarks'
            )";

            mysqli_query($conn, $sql);
        }

        $_SESSION['imported'] = true;
        echo "<script>alert('Successfully imported'); document.location.href='';</script>";
        exit;
    } else {
        echo "<script>alert('File upload failed');</script>";
    }
}
?>


<script src="https://cdnjs.cloudflare.com/ajax/libs/xlsx/0.17.0/xlsx.full.min.js"></script>
<script>


$(document).ready(function() { 
    function filterTable() {
        let searchText = $('#search').val().toLowerCase();
        let selectedBarangay = $('#barangayFilter').val().toLowerCase();
        let selectedSource = $('#sourceFilter').val().toLowerCase();
        let selectedProblem = $('#problemFilter').val().toLowerCase();
        let selectedIncome = $('#incomeFilter').val().toLowerCase(); 
        let selectedHearing = $('#hearingFilter').val().toLowerCase(); 
        let selectedDental = $('#dentalFilter').val().toLowerCase(); 
        let selectedOptical = $('#opticalFilter').val().toLowerCase();
        let selectedSocial = $('#socialFilter').val().toLowerCase(); // Added Social Filter
        let selectedArea = $('#areaFilter').val().toLowerCase(); // Added Area Filter
        
        $('#dataTable tbody tr').filter(function() {
            let rowText = $(this).text().toLowerCase();
            let barangay = $(this).find('.barangay').text().toLowerCase();
            let sourceText = $(this).find('.source').text().toLowerCase();
            let problemText = $(this).find('.problem').text().toLowerCase();
            let incomeText = $(this).find('.income').text().toLowerCase();
            let hearingText = $(this).find('.hearing').text().toLowerCase();
            let dentalText = $(this).find('.dental').text().toLowerCase(); 
            let opticalText = $(this).find('.optical').text().toLowerCase(); 
            let socialText = $(this).find('.social').text().toLowerCase(); // Get Social Text
            let areaText = $(this).find('.area').text().toLowerCase(); // Get Area Text
            
            let sourceList = sourceText.split(',').map(item => item.trim().toLowerCase());
            let problemList = problemText.split(',').map(item => item.trim().toLowerCase());
            let incomeList = incomeText.split(',').map(item => item.trim().toLowerCase());
            let hearingList = hearingText.split(',').map(item => item.trim().toLowerCase());
            let dentalList = dentalText.split(',').map(item => item.trim().toLowerCase());
            let opticalList = opticalText.split(',').map(item => item.trim().toLowerCase());
            let socialList = socialText.split(',').map(item => item.trim().toLowerCase());
            let areaList = areaText.split(',').map(item => item.trim().toLowerCase());

            let matchSearch = rowText.includes(searchText);
            let matchBarangay = selectedBarangay === "" || barangay === selectedBarangay;
            let matchSource = selectedSource === "" || sourceList.includes(selectedSource);
            let matchProblem = selectedProblem === "" || problemList.includes(selectedProblem);
            let matchIncome = selectedIncome === "" || incomeList.includes(selectedIncome); 
            let matchHearing = selectedHearing === "" || hearingList.includes(selectedHearing); 
            let matchDental = selectedDental === "" || dentalList.includes(selectedDental); 
            let matchOptical = selectedOptical === "" || opticalList.includes(selectedOptical);
            let matchSocial = selectedSocial === "" || socialList.includes(selectedSocial); // Check Social
            let matchArea = selectedArea === "" || areaList.includes(selectedArea); // Check Area

            $(this).toggle(matchSearch && matchBarangay && matchSource && matchProblem && matchIncome && matchHearing && matchDental && matchOptical && matchSocial && matchArea);
        });
    }

    $('#search').on('keyup', filterTable);
    $('#barangayFilter, #sourceFilter, #problemFilter, #incomeFilter, #hearingFilter, #dentalFilter, #opticalFilter, #socialFilter, #areaFilter').on('change', filterTable); // Added socialFilter & areaFilter
});


document.getElementById("resetFilters").addEventListener("click", function(event) {
        event.stopPropagation(); // Prevent closing dropdown

        document.getElementById("search").value = "";
        document.getElementById("barangayFilter").value = "";
        document.getElementById("sourceFilter").value = "";
        document.getElementById("problemFilter").value = "";
        document.getElementById("incomeFilter").value = "";
        document.getElementById("hearingFilter").value = "";
        document.getElementById("dentalFilter").value = "";
        document.getElementById("opticalFilter").value = "";
        document.getElementById("socialFilter").value = "";
        document.getElementById("areaFilter").value = "";
    });




 
function showExportModal() {
    document.getElementById("exportModal").style.display = "block";
}

function closeExportModal() {
    document.getElementById("exportModal").style.display = "none";
}

function exportToExcel() {
    let fileName = document.getElementById("fileNameInput").value.trim();
    if (fileName === "") {
        alert("Please enter a file name!");
        return;
    }

    let table = document.getElementById("dataTable");
    let wb = XLSX.utils.book_new();
    let wsData = [];

    let rows = table.querySelectorAll("tr");
    rows.forEach((row, rowIndex) => {
        let rowData = [];
        let cells = row.querySelectorAll("th, td");

        cells.forEach((cell, cellIndex) => {
            if (cellIndex !== 0) { // Exclude first column (Action)
                rowData.push(cell.innerText);
            }
        });

        wsData.push(rowData);
    });

    let ws = XLSX.utils.aoa_to_sheet(wsData);
    XLSX.utils.book_append_sheet(wb, ws, "Data");
    XLSX.writeFile(wb, fileName + ".xlsx");

    closeExportModal(); // Close modal after export
}

    function confirmDelete() {
        return confirm('Are you sure you want to delete this record?');
    }

    function showExportModal() {
    document.getElementById("exportModal").style.display = "block";
}

function closeExportModal() {
    document.getElementById("exportModal").style.display = "none";
}

function exportToExcel() {
    let fileName = document.getElementById("fileNameInput").value.trim();
    if (fileName === "") {
        alert("Please enter a file name!");
        return;
    }

    let table = document.getElementById("dataTable");
    let wb = XLSX.utils.book_new();
    let wsData = [];

    let rows = table.querySelectorAll("tr");
    rows.forEach((row, rowIndex) => {
        let rowData = [];
        let cells = row.querySelectorAll("th, td");

        cells.forEach((cell, cellIndex) => {
            if (cellIndex !== 0) { // Exclude first column
                rowData.push(cell.innerText);
            }
        });

        wsData.push(rowData);
    });

    let ws = XLSX.utils.aoa_to_sheet(wsData);
    XLSX.utils.book_append_sheet(wb, ws, "Data");
    XLSX.writeFile(wb, fileName + ".xlsx");

    closeExportModal(); // Close modal after export
}

document.getElementById("search").addEventListener("keyup", function () {
        let input = this.value.toLowerCase();
        let rows = document.querySelectorAll("#datatable tbody tr");

        rows.forEach(function (row) {
            let text = row.textContent.toLowerCase();
            row.style.display = text.includes(input) ? "" : "none";
        });
    });

    $(document).ready(function () {
    var table = $('#dataTable').DataTable();

    $('#remarksFilter').on('change', function () {
        var value = $(this).val().trim().toUpperCase();
        table.column(54).search(value).draw(); // Adjust index if needed
    });
});

</script>

</body>
</html>

<?php $conn->close(); ?>
