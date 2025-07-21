<?php
include('dbConfig.php'); // make sure this file correctly sets $link

$unid = 'TEST-DEBUG-123'; // 🔁 Replace this with a real test ID

$sql2 = "INSERT INTO edctn (id) VALUES (?)";

// 1. Check DB connection
if (!$link) {
  echo "❌ DB connection invalid: " . mysqli_connect_error() . "<br>";
  exit;
}

// 2. Check UNID
if (empty($unid)) {
  echo "❌ unid is empty or not set<br>";
  exit;
} else {
  echo "✅ unid = $unid<br>";
}

// 3. Prepare statement
$stmt2 = mysqli_prepare($link, $sql2);
if (!$stmt2) {
  echo "❌ Prepare failed: " . mysqli_error($link) . "<br>";
  exit;
} else {
  echo "✅ Prepare succeeded<br>";
}

// 4. Bind parameter
$bind = mysqli_stmt_bind_param($stmt2, "s", $unid);
if (!$bind) {
  echo "❌ Bind failed: " . mysqli_error($link) . "<br>";
  exit;
} else {
  echo "✅ Bind succeeded<br>";
}

// 5. Execute statement
$result2 = mysqli_stmt_execute($stmt2);
if (!$result2) {
  echo "❌ Execute failed: " . mysqli_stmt_error($stmt2) . "<br>";
  exit;
} else {
  echo "✅ Inserted into edctn<br>";
}
