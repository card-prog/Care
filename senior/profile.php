<?php
session_start();
include 'connect.php';


// Check if user is logged in
if (!isset($_SESSION['admin_id'])) {
    header("Location: login.php");
    exit();
}

$admin_id = $_SESSION['admin_id'];

// Fetch admin details
$query = "SELECT * FROM admin WHERE id = ?";
$stmt = $conn->prepare($query);
$stmt->bind_param("i", $admin_id);
$stmt->execute();
$result = $stmt->get_result();
$admin = $result->fetch_assoc();

// Handle profile update
if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['update_profile'])) {
    $firstname = $_POST['firstname'];
    $middlename = $_POST['middlename'];
    $lastname = $_POST['lastname'];
    $position = $_POST['position'];
    $age = $_POST['age'];
    $sex = $_POST['sex'];
    $address = $_POST['address'];
    $picture = $admin['picture'];
    
    // Handle profile picture upload
    if (!empty($_FILES['picture']['name'])) {
        $target_dir = "uploads/";
        $file_name = basename($_FILES["picture"]["name"]);
        $target_file = $target_dir . time() . "_" . $file_name;
        $imageFileType = strtolower(pathinfo($target_file, PATHINFO_EXTENSION));
        
        // Check if file is an actual image
        $check = getimagesize($_FILES["picture"]["tmp_name"]);
        if ($check !== false) {
            if (move_uploaded_file($_FILES["picture"]["tmp_name"], $target_file)) {
                $picture = $target_file;
            } else {
                $error = "Error uploading file.";
            }
        } else {
            $error = "File is not an image.";
        }
    }
    
    $updateQuery = "UPDATE admin SET firstname=?, middlename=?, lastname=?, position=?, age=?, sex=?, address=?, picture=? WHERE id=?";
    $stmt = $conn->prepare($updateQuery);
    $stmt->bind_param("ssssisssi", $firstname, $middlename, $lastname, $position, $age, $sex, $address, $picture, $admin_id);
    
    if ($stmt->execute()) {
        header("Location: profile.php?updated=true");
        exit();
    } else {
        $error = "Error updating profile.";
    }
}

// Handle Add Admin
if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['add_admin'])) {
    $username = $_POST['username'];
    $password = password_hash($_POST['password'], PASSWORD_DEFAULT);
    $firstname = $_POST['firstname'];
    $lastname = $_POST['lastname'];
    $position = $_POST['position'];

    $addQuery = "INSERT INTO admin (username, password, firstname, lastname, position) VALUES (?, ?, ?, ?, ?)";
    $stmt = $conn->prepare($addQuery);
    $stmt->bind_param("sssss", $username, $password, $firstname, $lastname, $position);
    
    if ($stmt->execute()) {
        header("Location: profile.php?admin_added=true");
        exit();
    } else {
        $error = "Error adding new admin.";
    }
}
include 'navbar.php';
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>User Profile</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
    <style>
       @import url("https://fonts.googleapis.com/css2?family=Inter:wght@400;700&display=swap");
    body {
        background-color: #f8f9fa;
    }
    .profile-container {
        max-width: 900px;
        margin: 40px auto;
        background: white;
       
    
        box-shadow: 0px 4px 6px rgba(0, 0, 0, 0.1);
    }
   
    .profile-header {
    background: #4A1DB9;
    color: white;
    text-align: center;
    padding: 10px 40px;
    font-weight: bold;
    font-size: 24px;
    margin-top: -20px;
    position: relative;
    width: 100%; /* Gumamit ng full width */
    max-width: 900px; /* O set ng maximum width */
    margin-left: auto;
    margin-right: auto; /* Para naka-center */
}


    .profile-content {
        display: flex;
        align-items: center;
        padding: 20px;
        margin-left: 10%;
    }
    .profile-image {
        flex: 1;
        text-align: center;
    }
    .profile-image img {
        width: 300px;
        height: 250px;
        border-radius: 10px;
        
    }
    .profile-info {
        flex: 2;
        padding-left: 20px;
    }
    .profile-info p {
        margin: 10px 0;
        font-size: 15px;  /* Mas malaking text */
        font-weight: bold;
    }
    .profile-info strong {
        color: #4A1DB9;
    }
    .profile-actions {
        text-align: center;
        padding: 20px;
    }
    .profile-actions .btn {
    width: 340px;
    margin-top: 0; /* Binawasan ang margin para tumaas */
    font-size: 18px; /* Pinalaki ang text ng buttons */
    padding: 5px;
    position: relative;
    top: -25px; /* Inangat ang button ng 10px */
    background-color: #5A20CB; /* Custom color */
    border: none;
    color: white; /* Text color */
   
}

.profile-actions .btn:hover {
    background-color:rgb(52, 20, 131); /* Darker shade on hover */
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

    </style>
</head>
<body>

<div class="container">
    <div class="profile-container">
            <div class="profile-header">USER PROFILE</div>
        <div class="profile-content">
            <div class="profile-image">
                <img src="<?php echo !empty($admin['picture']) ? $admin['picture'] : 'default.png'; ?>" alt="Profile Picture">
            </div>
            <div class="profile-info">
                
                <p style="font-size: 20px; font-weight: bold; margin-top: -20px;"><strong>Name:</strong> <?php echo $admin['firstname'] . " " . $admin['lastname']; ?></p>

                <div class="row">
                    <div class="col-md-6">
                        <p><strong>Username:</strong> <?php echo $admin['username'] ?? 'N/A'; ?></p>
                    </div>
                    <div class="col-md-6">
                        <p><strong>Position:</strong> <?php echo $admin['position'] ?? 'N/A'; ?></p>
                    </div>
                </div>

                <div class="row">
                    <div class="col-md-6">
                        <p><strong>Phone Number:</strong> <?php echo $admin['phone'] ?? 'N/A'; ?></p>
                    </div>
                    <div class="col-md-6">
                        <p><strong>Age:</strong> <?php echo $admin['age'] ?? 'N/A'; ?></p>
                    </div>
                </div>

                <div class="row">
                    <div class="col-md-6">
                        <p><strong>Address:</strong> <?php echo $admin['address'] ?? 'N/A'; ?></p>
                    </div>
                    <div class="col-md-6">
                        <p><strong>Sex:</strong> <?php echo $admin['sex'] ?? 'N/A'; ?></p>
                    </div>
                </div>

            </div>
        </div>
        <div class="profile-actions">
            <button class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#updateProfileModal">Edit Profile</button>
            <button class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#addAdminModal">Add Admin</button>
        </div>
    </div>
</div>

<div class="modal fade" id="updateProfileModal" tabindex="-1" aria-labelledby="updateProfileLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content p-4">
            <!-- Modal Header -->
            <div class="d-flex justify-content-between align-items-center">
                <h5 class="modal-title-custom">Update Profile</h5>
                <button type="button" class="btn-close close-purple custom-close" data-bs-dismiss="modal"></button>
            </div>

            <!-- Modal Body -->
            <div class="modal-body">
                <form method="POST" enctype="multipart/form-data">
                    <input type="hidden" name="update_profile" value="1">
                    
                    <div class="mb-4">
                        <label class="form-label fw-bold text-purple">First Name:</label>
                        <input type="text" name="firstname" class="form-control input-underline" value="<?php echo $admin['firstname']; ?>" required>
                    </div>
                    
                    <div class="mb-4">
                        <label class="form-label fw-bold text-purple">Middle Name:</label>
                        <input type="text" name="middlename" class="form-control input-underline" value="<?php echo $admin['middlename']; ?>">
                    </div>
                    
                    <div class="mb-4">
                        <label class="form-label fw-bold text-purple">Last Name:</label>
                        <input type="text" name="lastname" class="form-control input-underline" value="<?php echo $admin['lastname']; ?>" required>
                    </div>
                    
                    <div class="mb-4">
                        <label class="form-label fw-bold text-purple">Position:</label>
                        <input type="text" name="position" class="form-control input-underline" value="<?php echo $admin['position']; ?>">
                    </div>
                    
                    <div class="mb-4">
                        <label class="form-label fw-bold text-purple">Age:</label>
                        <input type="number" name="age" class="form-control input-underline" value="<?php echo $admin['age']; ?>">
                    </div>
                    
                    <div class="mb-4">
                        <label class="form-label fw-bold text-purple">Sex:</label>
                        <select name="sex" class="form-control input-underline">
                            <option value="Male" <?php if ($admin['sex'] == 'Male') echo 'selected'; ?>>Male</option>
                            <option value="Female" <?php if ($admin['sex'] == 'Female') echo 'selected'; ?>>Female</option>
                        </select>
                    </div>
                    
                    <div class="mb-4">
                        <label class="form-label fw-bold text-purple">Address:</label>
                        <input type="text" name="address" class="form-control input-underline" value="<?php echo $admin['address']; ?>">
                    </div>
                    
                    <div class="mb-4">
                        <label class="form-label fw-bold text-purple">Profile Picture:</label>
                        <input type="file" name="picture" class="form-control input-underline" id="pictureInput" onchange="previewImage(event)">
                        
                        <!-- Image preview container -->
                        <div id="imagePreview" style="margin-top: 15px;">
                            <img id="preview" src="#" alt="Image Preview" style="max-width: 300px; max-height: 270px; display: none; ">
                        </div>
                    </div>
                    
                    <div class="d-grid">
                        <button type="submit" class="btn btn-purple">Save Changes</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>


<!-- Add Admin Modal -->
<div class="modal fade" id="addAdminModal" tabindex="-1" aria-labelledby="addAdminLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content p-4">
            <!-- Modal Header -->
            <div class="d-flex justify-content-between align-items-center">
                <h5 class="modal-title-custom">Add Admin</h5>

                <button type="button" class="btn-close close-purple custom-close" data-bs-dismiss="modal"></button>

            </div>

            <!-- Modal Body -->
            <div class="modal-body">
                <form method="POST">
                    <input type="hidden" name="add_admin" value="1">
                    
                    <div class="mb-4">
                        <label class="form-label fw-bold text-purple">Username:</label>
                        <input type="text" name="username" class="form-control input-underline" required>
                    </div>
                    
                    <div class="mb-4">
                        <label class="form-label fw-bold text-purple">Password:</label>
                        <input type="password" name="password" class="form-control input-underline" required>
                    </div>
                    
                    <div class="d-grid">
                        <button type="submit" class="btn btn-purple">SUBMIT</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
</body>

<script>
    function previewImage(event) {
        const file = event.target.files[0];
        const preview = document.getElementById('preview');
        const imagePreviewContainer = document.getElementById('imagePreview');

        if (file) {
            const reader = new FileReader();
            reader.onload = function() {
                preview.src = reader.result;
                preview.style.display = 'block'; // Show the image preview
            };
            reader.readAsDataURL(file);
        } else {
            preview.style.display = 'none'; // Hide the preview if no file is selected
        }
    }
</script>
</html>