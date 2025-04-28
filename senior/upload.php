<?php
session_start();
require 'connect.php';

$swalScript = '';

// Upload success
if (isset($_SESSION['upload_success']) && $_SESSION['upload_success']) {
    $swalScript .= "<script>
        document.addEventListener('DOMContentLoaded', function () {
            Swal.fire({
                icon: 'success',
                title: 'Uploaded!',
                text: 'Announcement uploaded successfully!',
                confirmButtonColor: '#3085d6'
            });
        });
    </script>";
    unset($_SESSION['upload_success']);
}

// Delete success
if (isset($_SESSION['delete_success']) && $_SESSION['delete_success']) {
    $swalScript .= "<script>
        document.addEventListener('DOMContentLoaded', function () {
            Swal.fire({
                icon: 'success',
                title: 'Deleted!',
                text: 'Announcement deleted successfully.',
                confirmButtonColor: '#3085d6'
            });
        });
    </script>";
    unset($_SESSION['delete_success']);
}

// Handle upload logic BEFORE output
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    if (isset($_POST['edit_id'])) {
        $edit_id = $_POST['edit_id'];
        $caption = htmlspecialchars(trim($_POST['caption']));

        if (!empty($_FILES['image']['name'])) {
            $image = $_FILES['image'];
            $allowedTypes = ['image/jpeg', 'image/png', 'image/jpg', 'image/gif'];
            $maxFileSize = 5 * 1024 * 1024;

            if (in_array($image['type'], $allowedTypes) && $image['size'] <= $maxFileSize) {
                $targetDir = "uploads/";
                $uniqueFileName = time() . "_" . basename($image["name"]);
                $targetPath = $targetDir . $uniqueFileName;

                if (move_uploaded_file($image["tmp_name"], $targetPath)) {
                    $stmt = $conn->prepare("UPDATE announcement SET pic=?, captions=? WHERE id=?");
                    $stmt->bind_param("ssi", $targetPath, $caption, $edit_id);
                }
            }
        } else {
            $stmt = $conn->prepare("UPDATE announcement SET captions=? WHERE id=?");
            $stmt->bind_param("si", $caption, $edit_id);
        }

        if (isset($stmt) && $stmt->execute()) {
            $_SESSION['upload_success'] = true;
            header("Location: " . $_SERVER['PHP_SELF']);
            exit();
        }
    } elseif (isset($_FILES['image'])) {
        $caption = htmlspecialchars(trim($_POST['caption']));
        $image = $_FILES['image'];
        $allowedTypes = ['image/jpeg', 'image/png', 'image/jpg', 'image/gif'];
        $maxFileSize = 5 * 1024 * 1024;

        if (in_array($image['type'], $allowedTypes) && $image['size'] <= $maxFileSize) {
            $targetDir = "uploads/";
            $uniqueFileName = time() . "_" . basename($image["name"]);
            $targetPath = $targetDir . $uniqueFileName;

            if (move_uploaded_file($image["tmp_name"], $targetPath)) {
                $stmt = $conn->prepare("INSERT INTO announcement (pic, captions) VALUES (?, ?)");
                $stmt->bind_param("ss", $targetPath, $caption);
                if ($stmt->execute()) {
                    $_SESSION['upload_success'] = true;
                    header("Location: " . $_SERVER['PHP_SELF']);
                    exit();
                }
            }
        }
    }
}

// Handle delete before output
if (isset($_GET['delete'])) {
    $id = intval($_GET['delete']);

    // Optional: delete image file from server
    $getImage = $conn->query("SELECT pic FROM announcement WHERE id=$id");
    if ($getImage && $getImage->num_rows > 0) {
        $imgData = $getImage->fetch_assoc();
        if (file_exists($imgData['pic'])) {
            unlink($imgData['pic']);
        }
    }

    $conn->query("DELETE FROM announcement WHERE id=$id");
    $_SESSION['delete_success'] = true;
    header("Location: " . strtok($_SERVER["REQUEST_URI"], '?'));
    exit();
}

$result = $conn->query("SELECT * FROM announcement ORDER BY id DESC");

include 'navbar.php';
?>


<!-- SweetAlert2 -->
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
<?php echo $swalScript; ?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Upload Announcement</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.5/font/bootstrap-icons.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.5/font/bootstrap-icons.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
    <style>
        body { background-color: #f8f9fa; }
        .profile-header {
            background: #4A1DB9; color: white; text-align: center;
            padding: 10px; font-weight: bold; font-size: 24px;
        }
        .btn-purple {
            background-color: #151FA8; color: #fff;
            font-weight: bold; font-size: 16px;
        }
        .btn-purple:hover { background-color: #3a1a80; }
        .sticky-header th {
            position: sticky; top: 0; background-color: rgb(120, 123, 174);
            color: white;
        }
        .table td, .table th {
            vertical-align: middle; text-align: center; font-size: 14px;
        }
        .table-wrapper {
            max-height: 400px; overflow-y: auto; border-radius: 5px;
        }
        img.announcement-img { max-height: 80px; border-radius: 5px; }
        .modal-title-custom {
            font-size: 24px; font-weight: bold; text-align: center;
            color: #151FA8;
        }
        .input-underline {
            border: none;
            border-bottom: 2px solid #ddd;
            border-radius: 0;
            padding: 8px;
            font-size: 16px;
        }
        .input-underline:focus {
            outline: none;
            border-bottom: 2px solid #151FA8;
            box-shadow: none;
        }
        .btn-purple {
            font-size: 18px;
            padding: 12px;
            border-radius: 5px;
            border: none;
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
</head>
<body>
<div class="container mt-5">
    <div class="card p-4">
        <div class="profile-header">Upload Announcement</div>

        <!-- Upload Button -->
        <button type="button" class="btn btn-purple mt-3 mb-4" data-bs-toggle="modal" data-bs-target="#uploadModal">
            <i class="bi bi-upload"></i> Upload Announcement
        </button>

        <!-- Upload Modal -->
        <div class="modal fade" id="uploadModal" tabindex="-1" aria-hidden="true">
            <div class="modal-dialog modal-dialog-centered modal-md">
                <div class="modal-content p-4">
                    <div class="d-flex justify-content-between align-items-center">
                        <h5 class="modal-title-custom">Upload Announcement</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                    </div>
                    <div class="modal-body">
                        <form action="" method="POST" enctype="multipart/form-data">
                            <div class="mb-3">
                                <label for="image" class="form-label fw-bold">Upload Image:</label>
                                <input type="file" name="image" id="image" class="form-control input-underline" accept="image/*">
                            </div>
                            <div class="mb-3">
                                <label for="caption" class="form-label fw-bold">Caption:</label>
                                <textarea name="caption" id="caption" rows="3" class="form-control" required></textarea>
                            </div>
                            <div class="d-grid">
                                <button type="submit" class="btn btn-purple">
                                    <i class="bi bi-upload"></i> Upload Announcement
                                </button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>

        <!-- Announcements Table -->
        <div class="table-wrapper mt-4">
            <table class="table table-hover table-bordered">
                <thead class="sticky-header">
                    <tr>
                        <th>Image</th>
                        <th>Caption</th>
                        <th>Actions</th>
                    </tr>
                </thead>
                <tbody>
                <?php if ($result && $result->num_rows > 0): ?>
                    <?php while ($row = $result->fetch_assoc()): ?>
                        <tr>
                            <td><img src="<?= htmlspecialchars($row['pic']); ?>" class="announcement-img"></td>
                            <td><?= htmlspecialchars($row['captions']); ?></td>
                            <td>
                               <!-- Edit Button -->
                                <button class="icon-btn btn-edit" data-bs-toggle="modal" data-bs-target="#editModal<?= $row['id']; ?>">
                                    <i class="fas fa-edit"></i>
                                </button>

                                <a href="?delete=<?= $row['id']; ?>" class="icon-btn btn-delete swal-confirm" data-id="<?= $row['id']; ?>">
                                    <i class="fas fa-trash"></i>
                                </a>



                                <!-- Edit Modal -->
                                <div class="modal fade" id="editModal<?= $row['id']; ?>" tabindex="-1" aria-hidden="true">
                                <div class="modal-dialog modal-dialog-centered modal-md">
                                    <div class="modal-content p-4">
                                        <div class="d-flex justify-content-between align-items-center">
                                            <h5 class="modal-title-custom">Edit Announcement</h5>
                                            <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                                        </div>
                                        <div class="modal-body">
                                            <form action="" method="POST" enctype="multipart/form-data">
                                                <input type="hidden" name="edit_id" value="<?= $row['id']; ?>">

                                                <div class="mb-3 text-start">
                                                    <label class="form-label fw-bold">Upload New Image:</label>
                                                    <input type="file" name="image" class="form-control input-underline" accept="image/*">
                                                </div>

                                                <div class="mb-3 text-start">
                                                    <label class="form-label fw-bold">Caption:</label>
                                                    <textarea name="caption" rows="3" class="form-control" required><?= htmlspecialchars($row['captions']); ?></textarea>
                                                </div>

                                                <div class="mb-3 text-start">
                                                    <label class="form-label fw-bold">Current Image:</label><br>
                                                    <img src="<?= htmlspecialchars($row['pic']); ?>" class="img-fluid rounded mt-2" style="max-height: 250px; object-fit: contain;">
                                                </div>

                                                <div class="d-grid">
                                                    <button type="submit" class="btn btn-purple">
                                                        Update
                                                    </button>
                                                </div>
                                            </form>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            </td>
                        </tr>
                    <?php endwhile; ?>
                <?php else: ?>
                    <tr><td colspan="3">No announcements yet.</td></tr>
                <?php endif; ?>
                </tbody>
            </table>
        </div>
    </div>
</div>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
<?php $conn->close(); ?>
