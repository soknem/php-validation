<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <title>Form Validation</title>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body class="p-5">

<form class="row g-3" id="myForm" novalidate>
  <div class="col-md-4">
    <label for="firstName" class="form-label">First name</label>
    <input type="text" name="first-name" class="form-control" id="firstName">
    <div class="invalid-feedback" id="first-name-error"></div>
  </div>

  <div class="col-md-4">
    <label for="lastName" class="form-label">Last name</label>
    <input type="text" name="last-name" class="form-control" id="lastName">
    <div class="invalid-feedback" id="last-name-error"></div>
  </div>

  <div class="col-md-4">
    <label for="email" class="form-label">Email</label>
    <input type="text" name="email" class="form-control" id="email">
    <div class="invalid-feedback" id="email-error"></div>
  </div>

  <div class="col-md-6">
    <label for="city" class="form-label">City</label>
    <input type="text" name="city" class="form-control" id="city">
    <div class="invalid-feedback" id="city-error"></div>
  </div>

  <div class="col-md-3">
    <label for="state" class="form-label">State</label>
    <select name="state" class="form-select" id="state">
      <option value="" selected disabled>Choose...</option>
      <option>Phnom Penh</option>
      <option>Siem Reap</option>
    </select>
    <div class="invalid-feedback" id="state-error"></div>
  </div>

  <div class="col-md-3">
    <label for="zip" class="form-label">Zip</label>
    <input type="text" name="zip" class="form-control" id="zip">
    <div class="invalid-feedback" id="zip-error"></div>
  </div>

  <div class="col-12">
    <div class="form-check">
      <input class="form-check-input" type="checkbox" name="agree" id="agree">
      <label class="form-check-label" for="agree">Agree to terms</label>
      <div class="invalid-feedback" id="agree-error">You must agree before submitting.</div>
    </div>
  </div>

  <div class="col-12">
    <button class="btn btn-primary" type="submit">Submit form</button>
  </div>
</form>

<script>
  const form = document.getElementById("myForm");

  form.addEventListener("submit", async function (e) {
    e.preventDefault();

    document.querySelectorAll(".form-control, .form-select, .form-check-input").forEach(input => {
      input.classList.remove("is-invalid", "is-valid");
    });
    document.querySelectorAll(".invalid-feedback").forEach(div => div.innerText = "");

    const formData = new FormData(form);

    const response = await fetch("process.php", {
      method: "POST",
      body: formData
    });

    const result = await response.json();

    if (result.success) {
      alert("Form submitted successfully!");
      form.reset();
    } else {
      Object.entries(result.errors).forEach(([field, message]) => {
        const input = document.querySelector(`[name="${field}"]`);
        const errorDiv = document.getElementById(`${field}-error`);
        if (input && errorDiv) {
          input.classList.add("is-invalid");
          errorDiv.innerText = message;
        }
      });
    }
  });
</script>

</body>
</html>
