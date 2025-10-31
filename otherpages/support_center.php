<?php
include 'header.php';
include "../connection.php";
// Handle form submission
$successMsg = "";
if ($_SERVER["REQUEST_METHOD"] == "POST") {
  $name = $db->real_escape_string($_POST['name']);
  $email = $db->real_escape_string($_POST['email']);
  $issue = $db->real_escape_string($_POST['issue']);

  $sql = "INSERT INTO support_tickets (name, email, issue) VALUES ('$name', '$email', '$issue')";
  
  if ($db->query($sql) === TRUE) {
    $successMsg = "✅ Your support ticket has been submitted successfully!";
  } else {
    $successMsg = "❌ Error: " . $db->error;
  }
}
?>

<div class="container mt-5">
  <h2><i class="fas fa-headset text-primary me-2"></i>Support Center</h2>
  <div class="card mt-4 p-4 bg-dark text-light border-0 shadow-lg rounded-4">
    <p>
      Welcome to the Library Support Center! We're here to help students, faculty, and visitors with any issues related to borrowing, reading, account access, or system navigation.
    </p>

    <?php if (!empty($successMsg)): ?>
      <div class="alert alert-info mt-3"><?php echo $successMsg; ?></div>
    <?php endif; ?>

    <h5 class="mt-4">Submit a Ticket</h5>
    <form method="post">
      <div class="mb-3">
        <label for="name" class="form-label">Your Name</label>
        <input type="text" name="name" class="form-control bg-light text-dark" required>
      </div>
      <div class="mb-3">
        <label for="email" class="form-label">Your Email</label>
        <input type="email" name="email" class="form-control bg-light text-dark" required>
      </div>
      <div class="mb-3">
        <label for="issue" class="form-label">Describe Your Issue</label>
        <textarea name="issue" rows="4" class="form-control bg-light text-dark" required></textarea>
      </div>
      <button type="submit" class="btn btn-primary">
        <i class="fas fa-paper-plane me-1"></i> Submit Ticket
      </button>
    </form>
  </div>
</div>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
