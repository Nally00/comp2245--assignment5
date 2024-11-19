<?php
$host = 'localhost';
$username = 'lab5_user';
$password = 'password123';
$dbname = 'world';

$conn = new PDO("mysql:host=$host;dbname=$dbname;charset=utf8mb4", $username, $password);

// Check if there is a country name set as the  parameter
if (isset($_GET['country'])) {

  // Get query parameter country name from URL
  $country = $_GET['country'];

  //SQL query using country name
  $query = "SELECT * FROM countries WHERE name LIKE '%$country%'";

  $stmt = $conn->query($query);
} else {
  // query for all countries if no country name is given 
  $stmt = $conn->query("SELECT * FROM countries");
}

$results = $stmt->fetchAll(PDO::FETCH_ASSOC);
?>

<ul>
<?php foreach ($results as $row): ?>
  <li><?= $row['name'] . ' is ruled by ' . $row['head_of_state']; ?></li>
<?php endforeach; ?>
</ul>
