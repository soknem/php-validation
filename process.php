<?php
$errors = [];

if ($_SERVER['REQUEST_METHOD'] === 'POST') {

    // First name: just required
    if (!isset($_POST['first-name']) || trim($_POST['first-name']) === '') {
        $errors['first-name'] = "First name is required.";
    }

    // Last name: just required
    if (!isset($_POST['last-name']) || trim($_POST['last-name']) === '') {
        $errors['last-name'] = "Last name is required.";
    }

    // Email validation
    if (!isset($_POST['email']) || trim($_POST['email']) === '') {
        $errors['email'] = "Email is required.";
    } else {
        $email = trim($_POST['email']);
        if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
            $errors['email'] = "Invalid email format.";
        }
    }

    // City validation
    if (!isset($_POST['city']) || trim($_POST['city']) === '') {
        $errors['city'] = "City is required.";
    } else {
        $city = trim($_POST['city']);
        if (!preg_match("/^[a-zA-Z\s'-]{2,}$/", $city)) {
            $errors['city'] = "City must be at least 2 letters and valid.";
        }
    }

    // State validation
    if (!isset($_POST['state']) || trim($_POST['state']) === '') {
        $errors['state'] = "Please select a state.";
    } else {
        $state = $_POST['state'];
        $validStates = ['Phnom Penh', 'Siem Reap'];
        if (!in_array($state, $validStates)) {
            $errors['state'] = "Invalid state selected.";
        }
    }

    // Zip (just numeric)
    if (empty($_POST['zip'])) {
        $errors['zip'] = "Zip code is required.";
    } elseif (!is_numeric($_POST['zip'])) {
        $errors['zip'] = "Zip code must be a number.";
    }

    // Agreement validation
    if (!isset($_POST['agree'])) {
        $errors['agree'] = "You must agree to the terms.";
    }

    // Response
    header('Content-Type: application/json');
    if (!empty($errors)) {
        echo json_encode([
            'success' => false,
            'errors' => $errors
        ]);
    } else {
        echo json_encode([
            'success' => true,
            'message' => 'Form validated successfully.'
        ]);
    }
}
