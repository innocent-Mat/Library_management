<?php
include '../connection.php';
include 'header.php';

// Example session user_id (replace with your auth logic)
session_start();
$user_id = $_SESSION['user_id'] ?? 1; // use 1 as fallback

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $analytics = isset($_POST['analyticsCookies']) ? 1 : 0;
    $ads = isset($_POST['adsCookies']) ? 1 : 0;
    $pref = isset($_POST['preferenceCookies']) ? 1 : 0;

    $sql = "INSERT INTO cookie_settings (user_id, analytics_cookies, ads_cookies, preference_cookies)
            VALUES (?, ?, ?, ?)
            ON DUPLICATE KEY UPDATE
            analytics_cookies = VALUES(analytics_cookies),
            ads_cookies = VALUES(ads_cookies),
            preference_cookies = VALUES(preference_cookies)";

    $stmt = $db->prepare($sql);
    $stmt->bind_param("iiii", $user_id, $analytics, $ads, $pref);
    $stmt->execute();
}
?>


<div class="container mt-5">
  <h2><i class="fas fa-cookie-bite text-warning me-2"></i>Cookie Settings</h2>
  <div class="card mt-4 p-4 bg-dark text-light border-0 shadow-lg rounded-4">

    <p>
      We use cookies to personalize your experience and improve our Library Management System. Here you can manage your cookie preferences.
    </p>

    <h5 class="mt-4"><i class="fas fa-sliders-h me-2 text-info"></i>Manage Preferences</h5>

    <form method="post">
      <div class="form-check form-switch text-light mb-3">
        <input class="form-check-input" type="checkbox" id="essentialCookies" checked disabled>
        <label class="form-check-label" for="essentialCookies">
          Essential Cookies (Required) – <small class="text-muted">These are necessary for core functionalities like login, navigation, and session security.</small>
        </label>
      </div>

      <div class="form-check form-switch text-light mb-3">
        <input class="form-check-input" type="checkbox" id="analyticsCookies" checked>
        <label class="form-check-label" for="analyticsCookies">
          Analytics Cookies – <small class="text-muted">Helps us understand how users interact with the site and improve the experience.</small>
        </label>
      </div>

      <div class="form-check form-switch text-light mb-3">
        <input class="form-check-input" type="checkbox" id="adsCookies">
        <label class="form-check-label" for="adsCookies">
          Advertising Cookies – <small class="text-muted">Used to deliver personalized ads based on your preferences.</small>
        </label>
      </div>

      <div class="form-check form-switch text-light mb-3">
        <input class="form-check-input" type="checkbox" id="preferenceCookies">
        <label class="form-check-label" for="preferenceCookies">
          Preference Cookies – <small class="text-muted">Stores your language, theme, and layout preferences.</small>
        </label>
      </div>

      <button type="submit" class="btn btn-success mt-3">
        <i class="fas fa-save me-1"></i> Save Settings
      </button>
    </form>

    <h5 class="mt-5"><i class="fas fa-info-circle me-2 text-primary"></i>More About Cookies</h5>
    <p>
      For more information on how we use cookies, read our <a href="privacy.php" class="text-info text-decoration-underline">Privacy Policy</a>.
    </p>
  </div>
</div>

<!-- Bootstrap Bundle JS -->
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
