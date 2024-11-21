<?php
$host = 'localhost';
$username = 'lab5_user';
$password = 'password123';
$dbname = 'world';

$conn = new PDO("mysql:host=$host;dbname=$dbname;charset=utf8mb4", $username, $password);

// Check if there is a country name set as the  parameter
if (isset($_GET['country'])) {
    $country = $_GET['country'];
} else {
    $country=' '; //set parameter as blank if none is given
}

// Check if there is a lookup city and set as the  parameter
if (isset($_GET['lookup'])) {
    $lookup = $_GET['lookup']; 
} else {
    $lookup ='country'; // set to country if none is given
}


//Handle country lookup
if ($lookup === 'country') {
    //SQL query using country's name
    if ($country) {
        $query = "SELECT * FROM countries WHERE name LIKE '%$country%'";
        $stmt = $conn->query($query);
    } 
    else {
        // query for all countries if no country name is given 
        $stmt = $conn->query("SELECT * FROM countries");
    }
    //get results of query 
    $results = $stmt->fetchAll(PDO::FETCH_ASSOC);

    // show results in HTML table
    echo "<table>
        <tr>
            <th>Name</th>
            <th>Continent</th>
            <th>Independence</th>
            <th>Head of State</th>
        </tr>";
    foreach ($results as $row) {
        echo "<tr>
            <td>{$row['name']}</td>
                <td>{$row['continent']}</td>
                <td>{$row['independence_year']}</td>
                <td>{$row['head_of_state']}</td>
            </tr>";
    }
    echo "</table>";
}

//Handle city lookup
elseif ($lookup === 'cities') {
    // query for country's cities
    if ($country) {
        $query = "SELECT cities.name, cities.district, cities.population 
                  FROM cities 
                  JOIN countries ON cities.country_code = countries.code 
                  WHERE countries.name LIKE '%$country%'";
        $stmt = $conn->query($query);
    } 
    else {
        //query for all cities if no country name given
        $stmt = $conn->query("SELECT * FROM cities");
    }
    //get results of query 
    $results = $stmt->fetchAll(PDO::FETCH_ASSOC);

    // show results in HTML table
    echo "<table>
            <tr>
                <th>Name</th>
                <th>District</th>
                <th>Population</th>
            </tr>";
    foreach ($results as $row) {
        echo "<tr>
                <td>{$row['name']}</td>
                <td>{$row['district']}</td>
                <td>{$row['population']}</td>
              </tr>";
    }
    echo "</table>";
} 

?>

