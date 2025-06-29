<?php
session_start();
$formData = isset($_SESSION['formData']) ? $_SESSION['formData'] : [
    'first-name' => '',
    'last-name' => '',
    'email' => '',
    'city' => '',
    'state' => '',
    'zip' => '',
    'agree' => ''
];
$errors = isset($_SESSION['errors']) ? $_SESSION['errors'] : [];
$success = isset($_SESSION['success']) ? $_SESSION['success'] : false;

// Clear session data after displaying
unset($_SESSION['formData']);
unset($_SESSION['errors']);
unset($_SESSION['success']);
?>

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <title>Form Validation</title>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body class="p-5">

<?php if ($success): ?>
  <div class="alert alert-success" role="alert">
    Form submitted successfully!
  </div>
<?php endif; ?>

<form class="row g-3" method="POST" action="process.php" novalidate>
  <div class="col-md-4">
    <label for="firstName" class="form-label">First name</label>
    <input type="text" name="first-name" class="form-control <?php echo isset($errors['first-name']) ? 'is-invalid' : ''; ?>" id="firstName" value="<?php echo htmlspecialchars($formData['first-name']); ?>">
    <div class="invalid-feedback" id="first-name-error"><?php echo isset($errors['first-name']) ? $errors['first-name'] : ''; ?></div>
  </div>

  <div class="col-md-4">
    <label for="lastName" class="form-label">Last name</label>
    <input type="text" name="last-name" class="form-control <?php echo isset($errors['last-name']) ? 'is-invalid' : ''; ?>" id="lastName" value="<?php echo htmlspecialchars($formData['last-name']); ?>">
    <div class="invalid-feedback" id="last-name-error"><?php echo isset($errors['last-name']) ? $errors['last-name'] : ''; ?></div>
  </div>

  <div class="col-md-4">
    <label for="email" class="form-label">Email</label>
    <input type="text" name="email" class="form-control <?php echo isset($errors['email']) ? 'is-invalid' : ''; ?>" id="email" value="<?php echo htmlspecialchars($formData['email']); ?>">
    <div class="invalid-feedback" id="email-error"><?php echo isset($errors['email']) ? $errors['email'] : ''; ?></div>
  </div>

  <div class="col-md-6">
    <label for="city" class="form-label">City</label>
    <input type="text" name="city" class="form-control <?php echo isset($errors['city']) ? 'is-invalid' : ''; ?>" id="city" value="<?php echo htmlspecialchars($formData['city']); ?>">
    <div class="invalid-feedback" id="city-error"><?php echo isset($errors['city']) ? $errors['city'] : ''; ?></div>
  </div>

  <div class="col-md-3">
    <label for="state" class="form-label">State</label>
    <select name="state" class="form-select <?php echo isset($errors['state']) ? 'is-invalid' : ''; ?>" id="state">
      <option value="" <?php echo empty($formData['state']) ? 'selected' : ''; ?> disabled>Choose...</option>
      <option value="Phnom Penh" <?php echo $formData['state'] === 'Phnom Penh' ? 'selected' : ''; ?>>Phnom Penh</option>
      <option value="Siem Reap" <?php echo $formData['state'] === 'Siem Reap' ? 'selected' : ''; ?>>Siem Reap</option>
    </select>
    <div class="invalid-feedback" id="state-error"><?php echo isset($errors['state']) ? $errors['state'] : ''; ?></div>
  </div>

  <div class="col-md-3">
    <label for="zip" class="form-label">Zip</label>
    <input type="text" name="zip" class="form-control <?php echo isset($errors['zip']) ? 'is-invalid' : ''; ?>" id="zip" value="<?php echo htmlspecialchars($formData['zip']); ?>">
    <div class="invalid-feedback" id="zip-error"><?php echo isset($errors['zip']) ? $errors['zip'] : ''; ?></div>
  </div>

  <div class="col-12">
    <div class="form-check">
      <input class="form-check-input <?php echo isset($errors['agree']) ? 'is-invalid' : ''; ?>" type="checkbox" name="agree" id="agree" <?php echo $formData['agree'] ? 'checked' : ''; ?>>
      <label class="form-check-label" for="agree">Agree to terms</label>
      <div class="invalid-feedback" id="agree-error"><?php echo isset($errors['agree']) ? $errors['agree'] : ''; ?></div>
    </div>
  </div>

  <div class="col-12">
    <button class="btn btn-primary" type="submit">Submit form</button>
  </div>
</form>

</body>
</html>