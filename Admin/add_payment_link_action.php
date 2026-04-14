<?php
session_start();
include '../dbConfig.php';

// ✅ 1. Toggle status if GET request (e.g., for "Active"/"Inactive" button click)
if (isset($_GET['toggle_id']) && isset($_GET['status'])) {
  $id = intval($_GET['toggle_id']);
  $current_status = $_GET['status'] === 'active' ? 'active' : 'inactive';
  $new_status = $current_status === 'active' ? 'inactive' : 'active';

  if ($new_status === 'active') {
    // Check if any other active link exists (excluding the one being toggled)
    $check = mysqli_query($link, "SELECT id FROM payment_links WHERE status = 'active' AND id != $id LIMIT 1");
    if (mysqli_num_rows($check) > 0) {
      $_SESSION['errors'][] = "Another active payment link exists. Please deactivate it before activating this one.";
      header("Location: payment_link.php");
      exit();
    }
  }

  // Proceed to update status
  $update = "UPDATE payment_links SET status = '$new_status' WHERE id = $id";
  if (mysqli_query($link, $update)) {
    $_SESSION['success'] = "Status changed to <strong>$new_status</strong>.";
  } else {
    $_SESSION['errors'][] = "Failed to update status.";
  }

  header("Location: payment_link.php");
  exit();
}

// ✅ 2. Proceed only if POST request (for insert/update form submission)
if ($_SERVER['REQUEST_METHOD'] === 'POST') {

  function convertDateTime($dateStr)
  {
    if (!$dateStr) return null;
    $parts = explode(' ', $dateStr);
    $dateParts = explode('/', $parts[0]);
    if (count($dateParts) == 3) {
      return $dateParts[2] . '-' . $dateParts[1] . '-' . $dateParts[0] . (isset($parts[1]) ? ' ' . $parts[1] : '');
    }
    return null;
  }

  $errors = [];

  $id = isset($_POST['id']) ? intval($_POST['id']) : 0;
  $payment_url = trim($_POST['payment_url']);
  $valid_from_raw = trim($_POST['valid_from']);
  $valid_to_raw = trim($_POST['valid_to']);

  $valid_from = convertDateTime($valid_from_raw);
  $valid_to = convertDateTime($valid_to_raw);
  $created_at = date('Y-m-d H:i:s');

  // ✅ Validate inputs
  if ($payment_url && !filter_var($payment_url, FILTER_VALIDATE_URL)) {
    $errors[] = "Invalid payment URL.";
  }
  if ($payment_url && (!$valid_from || !$valid_to)) {
    $errors[] = "Both validity dates are required if URL is provided.";
  }

  if (!empty($errors)) {
    $_SESSION['errors'] = $errors;
    header("Location: payment_link.php");
    exit();
  }

  // ✅ 3. If editing (ID > 0), update record
  if ($id > 0) {
    $stmt = $link->prepare("UPDATE payment_links SET payment_url=?, valid_from=?, valid_to=? WHERE id=?");
    if ($stmt === false) {
      die("Prepare failed: " . htmlspecialchars($link->error));
    }
    $stmt->bind_param("sssi", $payment_url, $valid_from, $valid_to, $id);
    if ($stmt->execute()) {
      $_SESSION['success'] = "Payment link updated successfully.";
    } else {
      $_SESSION['errors'] = ["Failed to update record: " . $stmt->error];
    }
    $stmt->close();
  } else {
    // ✅ 4. Check if an active link already exists
    $check = mysqli_query($link, "SELECT id FROM payment_links WHERE status = 'active' LIMIT 1");
    if (mysqli_num_rows($check) > 0) {
      $_SESSION['errors'][] = "An active payment link already exists. Please deactivate it before adding a new one.";
      header("Location: payment_link.php");
      exit();
    }

    // ✅ 5. Insert new active payment link
    $stmt = $link->prepare("INSERT INTO payment_links (payment_url, valid_from, valid_to, status, created_at) VALUES (?, ?, ?, 'active', ?)");
    if ($stmt === false) {
      die("Prepare failed: " . htmlspecialchars($link->error));
    }
    $stmt->bind_param("ssss", $payment_url, $valid_from, $valid_to, $created_at);
    if ($stmt->execute()) {
      $_SESSION['success'] = "Payment link added successfully.";
    } else {
      $_SESSION['errors'] = ["Failed to insert record: " . $stmt->error];
    }
    $stmt->close();
  }

  $link->close();
  header("Location: payment_link.php");
  exit();
}
