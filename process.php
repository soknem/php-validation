<?php
session_start();
$errors = [];

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Collect form data
    $formData = [
        'first-name' => isset($_POST['first-name']) ? trim($_POST['first-name']) : '',
        'last-name' => isset($_POST['last-name']) ? trim($_POST['last-name']) : '',
        'email' => isset($_POST['email']) ? trim($_POST['email']) : '',
        'city' => isset($_POST['city']) ? trim($_POST['city']) : '',
        'state' => isset($_POST['state']) ? trim($_POST['state']) : '',
        'zip' => isset($_POST['zip']) ? trim($_POST['zip']) : '',
        'agree' => isset($_POST['agree']) ? $_POST['agree'] : ''
    ];

    // First name
    if (empty($formData['first-name'])) {
        $errors['first-name'] = "First name is required.";
    }

    // Last name
    if (empty($formData['last-name'])) {
        $errors['last-name'] = "Last name is required.";
    }

    // Email validation
    if (empty($formData['email'])) {
        $errors['email'] = "Email is required.";
    } elseif (!filter_var($formData['email'], FILTER_VALIDATE_EMAIL)) {
        $errors['email'] = "Invalid email format.";
    }

    // City validation
    if (empty($formData['city'])) {
        $errors['city'] = "City is required.";
    } elseif (!preg_match("/^[a-zA-Z\s'-]{2,}$/", $formData['city'])) {
        $errors['city'] = "City must be at least 2 letters and valid.";
    }

    // State validation
    if (empty($formData['state'])) {
        $errors['state'] = "Please select a state.";
    } else {
        $validStates = ['Phnom Penh', 'Siem Reap'];
        if (!in_array($formData['state'], $validStates)) {
            $errors['state'] = "Invalid state selected.";
        }
    }

    // Zip (just numeric)
    if (empty($formData['zip'])) {
        $errors['zip'] = "Zip code is required.";
    } elseif (!is_numeric($formData['zip'])) {
        $errors['zip'] = "Zip code must be a number.";
    }

    // Agreement validation
    if (!isset($_POST['agree'])) {
        $errors['agree'] = "You must agree to the terms.";
    }

    // Store form data and errors in session
    $_SESSION['formData'] = $formData;
    $_SESSION['errors'] = $errors;
    $_SESSION['success'] = empty($errors);

    // Redirect back to index.php
    header('Location: index.php');
    exit;
}
?>