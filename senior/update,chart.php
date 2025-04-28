<?php
// Include database connection
include 'db_connection.php';

// Get the barangay filter from the AJAX request
$barangay = isset($_POST['barangay']) ? $_POST['barangay'] : '';

// SQL Queries to get filtered data
$where_clause = $barangay ? "WHERE barangay = '$barangay'" : '';

$query_age = "SELECT 
    SUM(CASE WHEN age BETWEEN 60 AND 64 THEN 1 ELSE 0 END) AS age_60_64,
    SUM(CASE WHEN age BETWEEN 65 AND 69 THEN 1 ELSE 0 END) AS age_65_69,
    SUM(CASE WHEN age BETWEEN 70 AND 74 THEN 1 ELSE 0 END) AS age_70_74,
    SUM(CASE WHEN age BETWEEN 75 AND 79 THEN 1 ELSE 0 END) AS age_75_79,
    SUM(CASE WHEN age >= 80 THEN 1 ELSE 0 END) AS age_80_above
    FROM senior_citizens $where_clause";
$result_age = mysqli_query($conn, $query_age);
$row_age = mysqli_fetch_assoc($result_age);

$query_gender = "SELECT 
    SUM(CASE WHEN gender = 'Male' THEN 1 ELSE 0 END) AS male,
    SUM(CASE WHEN gender = 'Female' THEN 1 ELSE 0 END) AS female
    FROM senior_citizens $where_clause";
$result_gender = mysqli_query($conn, $query_gender);
$row_gender = mysqli_fetch_assoc($result_gender);

$query_category = "SELECT 
    SUM(CASE WHEN category = 'Dental' THEN 1 ELSE 0 END) AS dental,
    SUM(CASE WHEN category = 'Hearing' THEN 1 ELSE 0 END) AS hearing
    FROM senior_citizens $where_clause";
$result_category = mysqli_query($conn, $query_category);
$row_category = mysqli_fetch_assoc($result_category);

// Prepare the data for the charts
$response = [
    'ageData' => [
        $row_age['age_60_64'], $row_age['age_65_69'], $row_age['age_70_74'], $row_age['age_75_79'], $row_age['age_80_above']
    ],
    'genderData' => [
        $row_gender['male'], $row_gender['female']
    ],
    'categoryData' => [
        $row_category['dental'], $row_category['hearing']
    ]
];

// Send the data back as JSON
echo json_encode($response);
?>
