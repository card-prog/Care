<?php
include 'connect.php'; 
include 'navbar.php'; 

$message = "";  

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $last_name = $_POST['last_name'] ?? '';
    $first_name = $_POST['first_name'] ?? '';
    $middle_name = $_POST['middle_name'] ?? '';
    $birthdate = $_POST['birthdate'] ?? '';
    $age = $_POST['age'] ?? '';
    $address = $_POST['address'] ?? '';
    $barangay = $_POST['barangay'] ?? '';
    $birthplace = $_POST['birthplace'] ?? '';
    $marital_status = $_POST['marital_status'] ?? '';
    $gender = $_POST['gender'] ?? '';
    $contact_number = $_POST['contact_number'] ?? '';
    $religion = $_POST['religion'] ?? '';
    $ethnic = $_POST['ethnic'] ?? '';
    $language = $_POST['language'] ?? '';
    $rrn = $_POST['rrn'] ?? '';
    $service = $_POST['service'] ?? '';
    $osca_id = $_POST['osca_id'] ?? '';
    $sss_gsis = $_POST['sss_gsis'] ?? '';
    $tin = $_POST['tin'] ?? '';
    $philhealth = $_POST['philhealth'] ?? '';
    $other_govt_id = $_POST['other_govt_id'] ?? '';
    $travel = $_POST['travel'] ?? '';
    $pension = $_POST['pension'] ?? '';
    $spouse_name = $_POST['spouse_name'] ?? '';
    $fspouse = $_POST['fspouse'] ?? '';
    $mspouse = $_POST['mspouse'] ?? '';
    $children = $_POST['children'] ?? '';
    $fchild = $_POST['fchild'] ?? '';
    $mchild = $_POST['mchild'] ?? '';
    $childage = $_POST['childage'] ?? '';
    $occhild = $_POST['occhild'] ?? '';
    $working = $_POST['working'] ?? '';
    $education = $_POST['education'] ?? '';
    $mastery = $_POST['mastery'] ?? '';

    $household = $_POST['household'] ?? '';
    $residency = $_POST['residency'] ?? '';
    $source = $_POST['source'] ?? '';
    $properties = $_POST['properties'] ?? '';
    $asset = $_POST['asset'] ?? '';
    $income = $_POST['income'] ?? '';
    $problem = $_POST['problem'] ?? '';
    $blood = $_POST['blood'] ?? '';
    $hearing = $_POST['hearing'] ?? '';
    $dental = $_POST['dental'] ?? '';
    $optical = $_POST['optical'] ?? '';
    $social = $_POST['social'] ?? '';
    $area = $_POST['area'] ?? '';
    $medicines = $_POST['medicines'] ?? '';
    $remarks = $_POST['remarks'] ?? '';
    $checkup = $_POST['checkup'] ?? '';
    $done = $_POST['done'] ?? '';
    $region = $_POST['region'] ?? '';
    $province = $_POST['province'] ?? '';
    $municipality = $_POST['municipality'] ?? '';
    $medical = $_POST['medical'] ?? '';















    
    $sql = "INSERT INTO senior_citizens (
        last_name, first_name, middle_name, region, province, municipality, barangay, address, 
        birthdate, age, birthplace, marital_status, gender, contact_number, religion, ethnic, language, 
        osca_id, rrn, sss_gsis, tin, philhealth, other_govt_id, travel, service, pension, spouse_name, 
        fspouse, mspouse, children, fchild, mchild, childage, occhild, working, education, 
        mastery, residency, household, source, properties, asset, income, problem, blood, 
        hearing, dental, optical, social, area, medical, medicines, checkup, done, remarks
    ) VALUES (
        '$last_name', '$first_name', '$middle_name', '$region', '$province', '$municipality', '$barangay', '$address', 
        '$birthdate', '$age', '$birthplace', '$marital_status', '$gender', '$contact_number', '$religion', '$ethnic', '$language', 
        '$osca_id', '$rrn', '$sss_gsis', '$tin', '$philhealth', '$other_govt_id', '$travel', '$service', '$pension', '$spouse_name', 
        '$fspouse', '$mspouse', '$children', '$fchild', '$mchild', '$childage', '$occhild', '$working', '$education', 
        '$mastery', '$residency', '$household', '$source', '$properties', '$asset', '$income', '$problem', '$blood', 
        '$hearing', '$dental', '$optical', '$social', '$area', '$medical', '$medicines', '$checkup', '$done', '$remarks'
    )";

    // Execute SQL query
    if ($conn->query($sql) === TRUE) {
        $message = "<div class='alert alert-success'>Successfully Registered!</div>";
        header("Location: ".$_SERVER['PHP_SELF']);
        exit();
    } else {
        $message = "<div class='alert alert-danger'>Error: " . $conn->error . "</div>";
    }
}



// Kunin ang mga education attainment mula sa database
$education_options = [];
$query = "SELECT educational FROM educational";
$result = $conn->query($query);
if ($result->num_rows > 0) {
    while ($row = $result->fetch_assoc()) {
        $education_options[] = $row['educational'];
    }
}



$mastery_options = [];
$query = "SELECT mastery FROM mastery";
$result = $conn->query($query);
if ($result->num_rows > 0) {
    while ($row = $result->fetch_assoc()) {
        $mastery_options[] = $row['mastery'];
    }
}

$residency_options = [];
$query = "SELECT residency FROM residency";
$result = $conn->query($query);
if ($result->num_rows > 0) {
    while ($row = $result->fetch_assoc()) {
        $residency_options[] = $row['residency'];
    }
}

$household_options = [];
$query = "SELECT household FROM household";
$result = $conn->query($query);
if ($result->num_rows > 0) {
    while ($row = $result->fetch_assoc()) {
        $household_options[] = $row['household'];
    }
}

$source_options = [];
$query = "SELECT source FROM source";
$result = $conn->query($query);
if ($result->num_rows > 0) {
    while ($row = $result->fetch_assoc()) {
        $source_options[] = $row['source'];
    }
}

$asset_options = [];
$query = "SELECT asset FROM asset";
$result = $conn->query($query);
if ($result->num_rows > 0) {
    while ($row = $result->fetch_assoc()) {
        $asset_options[] = $row['asset'];
    }
}

$properties_options = [];
$query = "SELECT properties FROM properties";
$result = $conn->query($query);
if ($result->num_rows > 0) {
    while ($row = $result->fetch_assoc()) {
        $properties_options[] = $row['properties'];
    }
}

$social_options = [];
$query = "SELECT social FROM social";
$result = $conn->query($query);
if ($result->num_rows > 0) {
    while ($row = $result->fetch_assoc()) {
        $social_options[] = $row['social'];
    }
}

$problem_options = [];
$query = "SELECT problem FROM problem";
$result = $conn->query($query);
if ($result->num_rows > 0) {
    while ($row = $result->fetch_assoc()) {
        $problem_options[] = $row['problem'];
    }
}

$income_options = [];
$query = "SELECT income FROM income";
$result = $conn->query($query);
if ($result->num_rows > 0) {
    while ($row = $result->fetch_assoc()) {
        $income_options[] = $row['income'];
    }
}


$hearing_options = [];
$query = "SELECT hearing FROM hearing";
$result = $conn->query($query);
if ($result->num_rows > 0) {
    while ($row = $result->fetch_assoc()) {
        $hearing_options[] = $row['hearing'];
    }
}

$optical_options = [];
$query = "SELECT optical FROM optical";
$result = $conn->query($query);
if ($result->num_rows > 0) {
    while ($row = $result->fetch_assoc()) {
        $optical_options[] = $row['optical'];
    }
}

$dental_options = [];
$query = "SELECT dental FROM dental";
$result = $conn->query($query);
if ($result->num_rows > 0) {
    while ($row = $result->fetch_assoc()) {
        $dental_options[] = $row['dental'];
    }
}

$area_options = [];
$query = "SELECT area FROM area";
$result = $conn->query($query);
if ($result->num_rows > 0) {
    while ($row = $result->fetch_assoc()) {
        $area_options[] = $row['area'];
    }
}

$done_options = [];
$query = "SELECT done FROM done";
$result = $conn->query($query);
if ($result->num_rows > 0) {
    while ($row = $result->fetch_assoc()) {
        $done_options[] = $row['done'];
    }
}

$problem_options = [];
$query = "SELECT problem FROM problem";
$result = $conn->query($query);
if ($result->num_rows > 0) {
    while ($row = $result->fetch_assoc()) {
        $problem_options[] = $row['problem'];
    }
}

$pension_options = [];
$query = "SELECT pension FROM pension";
$result = $conn->query($query);
if ($result->num_rows > 0) {
    while ($row = $result->fetch_assoc()) {
        $pension_options[] = $row['pension'];
    }
}



?>
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>

<style>
        body {
            background-color: #f8f9fa;
        }
        .section-header {
            background-color:rgb(120, 123, 174);
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
            background-color:rgb(34, 84, 246);
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

    .medicine-input {
  width: 100%;     /* full column width */
  max-width: 500px;/* or whatever max you want */
  height: 3rem;    /* ~48px tall */
  padding: 0.5rem; /* adjust inner spacing */
  margin-top: 10px;/* if you need space above */
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
    margin-bottom: 20px;
   
}


    </style>

<!-- Senior Citizen Data Table Modal -->
<div class="modal fade" id="seniorCitizenModal" tabindex="-1" aria-labelledby="seniorCitizenModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="seniorCitizenModalLabel">Senior Citizen List</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <!-- Search Input -->
                <input type="text" id="searchInput" class="form-control mb-3" placeholder="Search by name..." onkeyup="searchTable()">
                
                <table class="table table-striped" id="seniorTable">
                    <thead>
                        <tr>
                            <th>ID</th>
                            <th>Last Name</th>
                            <th>First Name</th>
                            <th>Age</th>
                            <th>Gender</th>
                            <th>Contact</th>
                            <th>Address</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                        $query = "SELECT * FROM senior_citizens ORDER BY last_name ASC";
                        $result = $conn->query($query);
                        if ($result->num_rows > 0) {
                            while ($row = $result->fetch_assoc()) {
                                echo "<tr>
                                    <td>{$row['id']}</td>
                                    <td>{$row['last_name']}</td>
                                    <td>{$row['first_name']}</td>
                                    <td>{$row['age']}</td>
                                    <td>{$row['gender']}</td>
                                    <td>{$row['contact_number']}</td>
                                    <td>{$row['address']}</td>
                                </tr>";
                            }
                        } else {
                            echo "<tr><td colspan='7' class='text-center'>No data available</td></tr>";
                        }
                        ?>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>



<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Registration Form</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</head>
<body class="bg-light">
    <div class="container mt-4">
        <div class="form-container">
        <form id="registrationForm" action="form.php" method="POST">
            <div class="profile-header">Senior Citizens Data Form</div>
            <div class="section-header">Personal Information</div>
            <div class="row g-2 mt-2">
                <div class="col-md-4"><input type="text" name="last_name" class="form-control" placeholder="Lastname"></div>
                <div class="col-md-4"><input type="text" name="first_name" class="form-control" placeholder="Firstname"></div>
                <div class="col-md-4"><input type="text" name="middle_name" class="form-control" placeholder="Middlename"></div>
            </div>
            <div class="row g-2 mt-2">
                <div class="col-md-6"><input type="text" name="region" class="form-control" placeholder="Region"></div>
                <div class="col-md-6"><input type="text" name="province" class="form-control" placeholder="Province"></div>
            </div>
            <div class="row g-2 mt-2">
                <div class="col-md-4"><input type="text" name="municipality" class="form-control" placeholder="Municipality"></div>
                <div class="col-md-4"><input type="text" name="barangay" class="form-control" placeholder="Barangay"></div>
                <div class="col-md-4"><input type="text" name="address" class="form-control" placeholder="Sitio"></div>
            </div>
            <div class="row g-2 mt-2">
                <div class="col-md-4"><input type="date" name="birthdate" class="form-control" placeholder="Birthday"></div>
                <div class="col-md-4"><input type="text" name="age" class="form-control" placeholder="Age"></div>
                <div class="col-md-4"><input type="text" name="birthplace" class="form-control" placeholder="Birthplace"></div>
            </div>
            <div class="row g-2 mt-2">
                <div class="col-md-4">
                    <select name="gender" class="form-control">
                        <option value="" disabled selected>Select Gender</option>
                        <option value="Male">Male</option>
                        <option value="Female">Female</option>
                    </select>
                </div>
                <div class="col-md-4">
                    <select name="marital_status" class="form-control">
                        <option value="" disabled selected>Select Marital Status</option>
                        <option value="Single">Single</option>
                        <option value="Married">Married</option>
                        <option value="Divorced">Divorced</option>
                        <option value="Widowed">Widowed</option>
                        <option value="Separated">Separated</option>
                    </select>
                </div>
                    <div class="col-md-4"><input type="text" name="contact_number" class="form-control" placeholder="Contact Number"></div>
            </div>

            <div class="row g-2 mt-2">
                <div class="col-md-4"><input type="text" name="religion" class="form-control" placeholder="Religion"></div>
                <div class="col-md-4"><input type="text" name="ethnic" class="form-control" placeholder="Ethnic Status"></div>
                <div class="col-md-4"><input type="text" name="language" class="form-control" placeholder="Language"></div>
            </div>
            <div class="row g-2 mt-2">
                <div class="col-md-4"><input type="text" name="osca_id" class="form-control" placeholder="Osca Id"></div>
                <div class="col-md-4"><input type="text" name="rrn" class="form-control" placeholder="RRN Number"></div>
                <div class="col-md-4"><input type="text" name="sss_gsis" class="form-control" placeholder="SSS & GSIS"></div>
            </div>
            <div class="row g-2 mt-2">
                <div class="col-md-4"><input type="text" name="tin" class="form-control" placeholder="Tin Id"></div>
                <div class="col-md-4"><input type="text" name="philhealth" class="form-control" placeholder="Philhealth"></div>
                <div class="col-md-4"><input type="text" name="other_gov_id" class="form-control" placeholder="Other Gov Id"></div>
            </div>
            <div class="row g-2 mt-2">
                <div class="col-md-4"><input type="text" name="travel" class="form-control" placeholder="Capability to Travel"></div>
                <div class="col-md-4"><input type="text" name="service" class="form-control" placeholder="Service & Busines"></div>
                
                    <div class="col-md-4 position-relative">
                            <select name="pension" class="form-control">
                                <option value="">Select Pension</option>
                                <?php foreach ($pension_options as $option) : ?>
                                    <option value="<?= htmlspecialchars($option) ?>"><?= htmlspecialchars($option) ?></option>
                                <?php endforeach; ?>
                            </select>
                    </div>
              
            
            <div class="section-header mt-3">Family Information</div>
            <div class="row g-2 mt-2">
                <div class="col-md-4"><input type="text" name="spouse_name" class="form-control" placeholder="Lastname of Spouse"></div>
                <div class="col-md-4"><input type="text" name="fspouse" class="form-control" placeholder="Firstname of Spouse"></div>
                <div class="col-md-4"><input type="text" name="mspouse" class="form-control" placeholder="Middlename of Spouse"></div>
            </div>
            <div class="row g-2 mt-2">
                <div class="col-md-4"><input type="text" name="children" class="form-control" placeholder="Lastname of Children"></div>
                <div class="col-md-4"><input type="text" name="fchild" class="form-control" placeholder="Firstname of Children"></div>
                <div class="col-md-4"><input type="text" name="mchild" class="form-control" placeholder="Middlename of Children"></div>
            </div>
            <div class="row g-2 mt-2">
                <div class="col-md-4"><input type="text" name="childage" class="form-control" placeholder="Age"></div>
                <div class="col-md-4"><input type="text" name="occhild" class="form-control" placeholder="Occupation"></div>
                <div class="col-md-4"><input type="text" name="working" class="form-control" placeholder="Working / Not Working"></div>
            </div>
            


            
            <div class="section-header mt-3">Education Background</div>
                <div class="row g-2 mt-2">
                    <div class="col-md-6 position-relative">
                            <select name="education" class="form-control">
                                <option value="">Select Educational Attainment</option>
                                <?php foreach ($education_options as $option) : ?>
                                    <option value="<?= htmlspecialchars($option) ?>"><?= htmlspecialchars($option) ?></option>
                                <?php endforeach; ?>
                            </select>
                    </div>
                

                    <div class="col-md-6 position-relative">
                        <input type="text" class="form-control" id="dropdownInputmastery" placeholder="Select Areas of Spealization /Technical Skills" readonly>
                        <div class="dropdown-menu w-100" id="dropdownMenumastery">
                            <?php foreach ($mastery_options as $option) : ?>
                                <label class="dropdown-item">
                                    <input type="checkbox" class="mastery-option" value="<?= htmlspecialchars($option) ?>"> <?= htmlspecialchars($option) ?>
                                </label>
                            <?php endforeach; ?>
                        </div>
                        <input type="hidden" name="mastery" id="selectedOptionsmastery">
                    
                </div>
            </div>

            <!-- Dependency Background -->
            <div class="section-header mt-3">Dependency Profile</div>
                <div class="row g-2 mt-2">
                    <!-- Residency -->
                    <div class="col-md-6 position-relative">
                        <input type="text" class="form-control" id="dropdownInputresidency" placeholder="Select residency & Residing" readonly>
                        <div class="dropdown-menu w-100" id="dropdownMenuresidency">
                            <?php foreach ($residency_options as $option) : ?>
                                <label class="dropdown-item">
                                    <input type="checkbox" class="residency-option" value="<?= htmlspecialchars($option) ?>"> <?= htmlspecialchars($option) ?>
                                </label>
                            <?php endforeach; ?>
                        </div>
                        <input type="hidden" name="residency" id="selectedOptionsresidency">
                    </div>

                    <!-- Household Condition -->
                    <div class="col-md-6 position-relative">
                        <input type="text" class="form-control" id="dropdownInputhousehold" placeholder="Select Household Condition" readonly>
                        <div class="dropdown-menu w-100" id="dropdownMenuhousehold">
                            <?php foreach ($household_options as $option) : ?>
                                <label class="dropdown-item">
                                    <input type="checkbox" class="household-option" value="<?= htmlspecialchars($option) ?>"> <?= htmlspecialchars($option) ?>
                                </label>
                            <?php endforeach; ?>
                        </div>
                        <input type="hidden" name="household" id="selectedOptionshousehold">
                </div>
            </div>

            <!-- economic Background -->
            <div class="section-header mt-3">Economic Profile</div>
                <div class="row g-2 mt-2">
                    <!-- source -->
                    <div class="col-md-4 position-relative">
                        <input type="text" class="form-control" id="dropdownInputsource" placeholder="Select Source of Income" readonly>
                        <div class="dropdown-menu w-100" id="dropdownMenusource">
                            <?php foreach ($source_options as $option) : ?>
                                <label class="dropdown-item">
                                    <input type="checkbox" class="source-option" value="<?= htmlspecialchars($option) ?>"> <?= htmlspecialchars($option) ?>
                                </label>
                            <?php endforeach; ?>
                        </div>
                        <input type="hidden" name="source" id="selectedOptionssource">
                    </div>

                    <!-- properties Condition -->
                    <div class="col-md-4 position-relative">
                        <input type="text" class="form-control" id="dropdownInputproperties" placeholder="Select Real and Immovable Properties" readonly>
                        <div class="dropdown-menu w-100" id="dropdownMenuproperties">
                            <?php foreach ($properties_options as $option) : ?>
                                <label class="dropdown-item">
                                    <input type="checkbox" class="properties-option" value="<?= htmlspecialchars($option) ?>"> <?= htmlspecialchars($option) ?>
                                </label>
                            <?php endforeach; ?>
                        </div>
                        <input type="hidden" name="properties" id="selectedOptionsproperties">
                    </div>

                    <div class="col-md-4 position-relative">
                        <input type="text" class="form-control" id="dropdownInputasset" placeholder="Select Personal and Movable Properties" readonly>
                        <div class="dropdown-menu w-100" id="dropdownMenuasset">
                            <?php foreach ($asset_options as $option) : ?>
                                <label class="dropdown-item">
                                    <input type="checkbox" class="asset-option" value="<?= htmlspecialchars($option) ?>"> <?= htmlspecialchars($option) ?>
                                </label>
                            <?php endforeach; ?>
                        </div>
                        <input type="hidden" name="asset" id="selectedOptionsasset">
                    </div>
            </div>

            

            <div class="row g-2 mt-2">
                    <!-- problem -->
                    <div class="col-md-6 position-relative">
                        <input type="text" class="form-control" id="dropdownInputproblem" placeholder="Select Problem Needs Commonly Encoutered" readonly>
                        <div class="dropdown-menu w-100" id="dropdownMenuproblem">
                            <?php foreach ($problem_options as $option) : ?>
                                <label class="dropdown-item">
                                    <input type="checkbox" class="problem-option" value="<?= htmlspecialchars($option) ?>"> <?= htmlspecialchars($option) ?>
                                </label>
                            <?php endforeach; ?>
                        </div>
                        <input type="hidden" name="problem" id="selectedOptionsproblem">
                    </div>

                    <!-- montly income -->
                    <div class="col-md-6 position-relative">
                        <select name="income" class="form-control">
                            <option value="">Select Monthly Income</option>
                            <?php foreach ($income_options as $option) : ?>
                                <option value="<?= htmlspecialchars($option) ?>"><?= htmlspecialchars($option) ?></option>
                            <?php endforeach; ?>
                        </select>
                    </div>
                    
            </div>
                        
            <div class="section-header mt-3">Health Background</div>
                <div class="row g-2 mt-2">
                    <div class="col-md-6">
                        <select name="blood" class="form-control">
                            <option value="">Select Blood Type</option>
                            <option value="A+">A+</option>
                            <option value="A-">A-</option>
                            <option value="B+">B+</option>
                            <option value="B-">B-</option>
                            <option value="O+">O+</option>
                            <option value="O-">O-</option>
                            <option value="AB+">AB+</option>
                            <option value="AB-">AB-</option>
                        </select>
                    </div>

                <div class="col-md-6"><input type="text" name="medical" class="form-control" placeholder="Medical Concern"></div>
            </div>

                <div class="row g-2 mt-2">
                        <!-- Optical -->
                        <div class="col-md-4 position-relative">
                            <input type="text" class="form-control dropdown-toggle" id="dropdownInputoptical" placeholder="Select Optical" readonly>
                            <div class="dropdown-menu w-100" id="dropdownMenuoptical">
                                <?php foreach ($optical_options as $option) : ?>
                                    <label class="dropdown-item">
                                        <input type="checkbox" class="optical-option" value="<?= htmlspecialchars($option) ?>"> 
                                        <?= htmlspecialchars($option) ?>
                                    </label>
                                <?php endforeach; ?>
                            </div>
                            <input type="hidden" name="optical" id="selectedOptionsoptical">
                        </div>

                        <!-- Hearing -->
                        <div class="col-md-4 position-relative">
                            <input type="text" class="form-control dropdown-toggle" id="dropdownInputhearing" placeholder="Select Hearing Concern" readonly>
                            <div class="dropdown-menu w-100" id="dropdownMenuhearing">
                                <?php foreach ($hearing_options as $option) : ?>
                                    <label class="dropdown-item">
                                        <input type="checkbox" class="hearing-option" value="<?= htmlspecialchars($option) ?>"> 
                                        <?= htmlspecialchars($option) ?>
                                    </label>
                                <?php endforeach; ?>
                            </div>
                            <input type="hidden" name="hearing" id="selectedOptionshearing">
                        </div>

                        <!-- Dental -->
                        <div class="col-md-4 position-relative">
                            <input type="text" class="form-control dropdown-toggle" id="dropdownInputdental" placeholder="Select Dental Concern" readonly>
                            <div class="dropdown-menu w-100" id="dropdownMenudental">
                                <?php foreach ($dental_options as $option) : ?>
                                    <label class="dropdown-item">
                                        <input type="checkbox" class="dental-option" value="<?= htmlspecialchars($option) ?>"> 
                                        <?= htmlspecialchars($option) ?>
                                    </label>
                                <?php endforeach; ?>
                            </div>
                            <input type="hidden" name="dental" id="selectedOptionsdental">
                        </div>
                    </div>
                

                <div class="row g-2 mt-2">
                    <!-- social -->
                    <div class="col-md-6 position-relative">
                        <input type="text" class="form-control" id="dropdownInputsocial" placeholder="Select Social of Difficulties" readonly>
                        <div class="dropdown-menu w-100" id="dropdownMenusocial">
                            <?php foreach ($social_options as $option) : ?>
                                <label class="dropdown-item">
                                    <input type="checkbox" class="social-option" value="<?= htmlspecialchars($option) ?>"> <?= htmlspecialchars($option) ?>
                                </label>
                            <?php endforeach; ?>
                        </div>
                        <input type="hidden" name="social" id="selectedOptionssocial">
                    </div>

                    <!-- Household Condition -->
                    <div class="col-md-6 position-relative">
                        <input type="text" class="form-control" id="dropdownInputarea" placeholder="Select Area of Difficulties" readonly>
                        <div class="dropdown-menu w-100" id="dropdownMenuarea">
                            <?php foreach ($area_options as $option) : ?>
                                <label class="dropdown-item">
                                    <input type="checkbox" class="area-option" value="<?= htmlspecialchars($option) ?>"> <?= htmlspecialchars($option) ?>
                                </label>
                            <?php endforeach; ?>
                        </div>
                        <input type="hidden" name="area" id="selectedOptionsarea">
                </div>
            </div>

            <div class="row g-2 mt-2">
                <div class="col-md-15"><input type="text" name="medicines" class="form-control" placeholder="List of Medicines or Maintenance"></div>
                
            </div>

           
                


            

            <div class="row g-2 mt-2">
                <div class="col-md-4"><input type="text" name="checkup" class="form-control" placeholder="Do you a Schedule Checkup"></div>
                <div class="col-md-4"><input type="text" name="done" class="form-control" placeholder="If Yes When its Done"></div>
                <div class="col-md-4">
                    <select name="remarks" class="form-control">
                            <option value="" disabled selected>Select Yes or No</option>
                            <option value="YES">YES</option>
                            <option value="NO">NO</option>
                    </select>
                </div>
            </div>



            
            
  

            
            
                <div class="text-center mt-4">
                    <button type="button" class="btn btn-primary w-100"
                        style="background-color:rgb(81, 0, 255); color: white; font-weight: bold; padding: 10px; font-size: 16px; border-radius: 5px; transition: background-color 0.3s ease;"
                        onclick="confirmSubmit()">
                        SUBMIT
                    </button>

                </div>

            </form>
        </div>
    </div>
</body>
</html>
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
<script>
document.addEventListener("DOMContentLoaded", function () {
    function setupMultiSelect(inputId, dropdownId, checkboxClass, hiddenInputId) {
        const inputBox = document.getElementById(inputId);
        const dropdownMenu = document.getElementById(dropdownId);
        const selectedOptionsInput = document.getElementById(hiddenInputId);

        if (!inputBox || !dropdownMenu || !selectedOptionsInput) return;

        function getCheckboxes() {
            return document.querySelectorAll("." + checkboxClass);
        }

        inputBox.addEventListener("click", function () {
            dropdownMenu.classList.toggle("show");
        });

        document.addEventListener("click", function (event) {
            if (!inputBox.contains(event.target) && !dropdownMenu.contains(event.target)) {
                dropdownMenu.classList.remove("show");
            }
        });

        function updateSelection() {
            let selectedValues = [];
            getCheckboxes().forEach(cb => {
                if (cb.checked) {
                    selectedValues.push(cb.value);
                }
            });
            inputBox.value = selectedValues.length > 0 ? selectedValues.join(", ") : "";
            selectedOptionsInput.value = selectedValues.join(",");
        }

        document.addEventListener("change", function (event) {
            if (event.target.classList.contains(checkboxClass)) {
                updateSelection();
            }
        });
    }

    function setupDropdown(inputId, menuId, hiddenInputId, optionClass) {
        var inputField = document.getElementById(inputId);
        var dropdownMenu = document.getElementById(menuId);
        var hiddenInput = document.getElementById(hiddenInputId);

        if (!inputField || !dropdownMenu || !hiddenInput) return;

        inputField.addEventListener("click", function () {
            dropdownMenu.classList.toggle("show");
        });

        document.addEventListener("click", function (event) {
            if (!inputField.contains(event.target) && !dropdownMenu.contains(event.target)) {
                dropdownMenu.classList.remove("show");
            }
        });

        dropdownMenu.querySelectorAll("." + optionClass).forEach(function (option) {
            option.addEventListener("change", function () {
                var selectedOptions = Array.from(dropdownMenu.querySelectorAll("." + optionClass + ":checked"))
                    .map(option => option.value)
                    .join(", ");
                inputField.value = selectedOptions;
                hiddenInput.value = selectedOptions;
            });
        });
    }

    // Initialize multi-select dropdowns
    const multiSelects = [
        ["dropdownInputmastery", "dropdownMenumastery", "mastery-option", "selectedOptionsmastery"],
        ["dropdownInputresidency", "dropdownMenuresidency", "residency-option", "selectedOptionsresidency"],
        ["dropdownInputhousehold", "dropdownMenuhousehold", "household-option", "selectedOptionshousehold"],
        ["dropdownInputsource", "dropdownMenusource", "source-option", "selectedOptionssource"],
        ["dropdownInputproperties", "dropdownMenuproperties", "properties-option", "selectedOptionsproperties"],
        ["dropdownInputasset", "dropdownMenuasset", "asset-option", "selectedOptionsasset"],
        ["dropdownInputproblem", "dropdownMenuproblem", "problem-option", "selectedOptionsproblem"],
        ["dropdownInputincome", "dropdownMenuincome", "income-option", "selectedOptionsincome"],
        ["dropdownInputsocial", "dropdownMenusocial", "social-option", "selectedOptionssocial"],
        ["dropdownInputarea", "dropdownMenuarea", "area-option", "selectedOptionsarea"]
    ];
    
    multiSelects.forEach(([input, menu, checkbox, hidden]) => {
        setupMultiSelect(input, menu, checkbox, hidden);
    });

    // Initialize single dropdowns
    const dropdowns = [
        ["dropdownInputoptical", "dropdownMenuoptical", "selectedOptionsoptical", "optical-option"],
        ["dropdownInputhearing", "dropdownMenuhearing", "selectedOptionshearing", "hearing-option"],
        ["dropdownInputdental", "dropdownMenudental", "selectedOptionsdental", "dental-option"]
    ];

    dropdowns.forEach(([input, menu, hidden, optionClass]) => {
        setupDropdown(input, menu, hidden, optionClass);
    });

    function computeAge() {
        let birthdate = document.querySelector('input[name="birthdate"]').value;
        if (birthdate) {
            let today = new Date();
            let birth = new Date(birthdate);
            let age = today.getFullYear() - birth.getFullYear();
            let month = today.getMonth() - birth.getMonth();
            if (month < 0 || (month === 0 && today.getDate() < birth.getDate())) {
                age--;
            }
            document.getElementById('age').value = age;
        } else {
            document.getElementById('age').value = '';
        }
    }

    function searchTable() {
        let input = document.getElementById("searchInput").value.toLowerCase();
        let table = document.getElementById("seniorTable");
        let rows = table.getElementsByTagName("tr");

        for (let i = 1; i < rows.length; i++) {
            let lastName = rows[i].getElementsByTagName("td")[1]?.textContent.toLowerCase();
            let firstName = rows[i].getElementsByTagName("td")[2]?.textContent.toLowerCase();
            if (lastName.includes(input) || firstName.includes(input)) {
                rows[i].style.display = "";
            } else {
                rows[i].style.display = "none";
            }
        }
    }

    document.querySelector('input[name="birthdate"]').addEventListener("change", computeAge);
    document.getElementById("searchInput").addEventListener("keyup", searchTable);

    // Ensure hidden inputs are updated before form submission
    document.querySelector("form").addEventListener("submit", function (event) {
        multiSelects.forEach(([_, __, ___, hidden]) => {
            let hiddenInput = document.getElementById(hidden);
            if (!hiddenInput.value) {
                hiddenInput.value = ""; // Set empty string to avoid submission issues
            }
        });

        dropdowns.forEach(([_, __, hidden]) => {
            let hiddenInput = document.getElementById(hidden);
            if (!hiddenInput.value) {
                hiddenInput.value = ""; // Set empty string to avoid submission issues
            }
        });
    });
});


  function confirmSubmit() {
    Swal.fire({
      title: 'Submit Form?',
      text: 'Are you sure you want to submit this data?',
      icon: 'question',
      showCancelButton: true,
      confirmButtonText: 'Yes, submit it!',
      cancelButtonText: 'Cancel'
    }).then((result) => {
      if (result.isConfirmed) {
        Swal.fire({
          icon: 'success',
          title: 'Submitted!',
          text: 'Your form was submitted successfully!',
          timer: 2000,
          showConfirmButton: false
        }).then(() => {
          document.getElementById('registrationForm').submit();
        });
      }
    });
  }


</script>
