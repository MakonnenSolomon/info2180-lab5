<?php
$host = 'localhost';
$username = 'lab5_user';
$password = 'password123';
$dbname = 'world';

try{
$conn = new PDO("mysql:host=$host;dbname=$dbname;charset=utf8mb4", $username, $password);
$stmt = $conn->query("SELECT * FROM countries");

$results = $stmt->fetchAll(PDO::FETCH_ASSOC);
$country = $_GET['country'] ??'';
$stmt = $conn->prepare("SELECT * FROM countries WHERE name LIKE :country");
$stmt->execute(['country' => "%$country%"]);
$results = $stmt ->fetchAll(PDO::FETCH_ASSOC);

echo "<table><tr><th>Name</th><th>Continent</th><th>Independence Year</th><th></th><th>Head of State</th></tr>";
foreach($results as $row)
{
  echo "<tr><td>{$row['name']}</td><td>{$row['continent']}</td><td>{$row['independence_year']}</td><td>{$row['head_of_state']}</td></tr>";
}
  echo"</table>";
if ($_GET['lookup'] == 'cities')
{
  $stmt = $conn->prepare("SELECT cities.name, cities.district, cities.population FROM cities JOIN countries on cities.country_code WHERE countries.name LIKE :country");
}
}
catch (PDOException $e)
{
  echo "error: ".$e->getMessage();
}

?>
<ul>
<?php foreach ($results as $row): ?>
  <li><?= $row['name'] . ' is ruled by ' . $row['head_of_state']; ?></li>
<?php endforeach; ?>
</ul>
