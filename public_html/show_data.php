<?php
$host = 'db';
$db = 'sample_db';
$user = 'admin';
$pass = '1234';
$charset = 'utf8mb4';

$dsn = "mysql:host=$host;dbname=$db;charset=$charset";

$options = [
    PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
    PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC,
    PDO::ATTR_EMULATE_PREPARES => false,
];

try {
    $pdo = new PDO($dsn, $user, $pass, $options);

    // ดึงข้อมูลจากตาราง titanic
    $sql = "SELECT * FROM titanic";
    $stmt = $pdo->prepare($sql);
    $stmt->execute();
    $rows = $stmt->fetchAll();

} catch (PDOException $e) {
    die("Connection failed: " . $e->getMessage());
}
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Titanic Data</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
</head>

<body>
    <div class="container-fluid mt-5 px-4">
        <h2 class="text-center mb-4">Titanic Passenger Data</h2>

        <?php if (count($rows) > 0): ?>
            <div class="table-responsive">
                <table class="table table-striped table-bordered align-middle">
                    <thead class="table-dark">
                        <tr>
                            <th>Index</th>
                            <th>Passenger ID</th>
                            <th>Survived</th>
                            <th>Pclass</th>
                            <th>Name</th>
                            <th>Sex</th>
                            <th>Age</th>
                            <th>SibSp</th>
                            <th>Parch</th>
                            <th>Ticket</th>
                            <th>Fare</th>
                            <th>Cabin</th>
                            <th>Embarked</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php foreach ($rows as $row): ?>
                            <tr>
                                <td><?php echo htmlspecialchars($row['index'] ?? ''); ?></td>
                                <td><?php echo htmlspecialchars($row['PassengerId'] ?? ''); ?></td>
                                <td><?php echo htmlspecialchars($row['Survived'] ?? ''); ?></td>
                                <td><?php echo htmlspecialchars($row['Pclass'] ?? ''); ?></td>
                                <td><?php echo htmlspecialchars($row['Name'] ?? ''); ?></td>
                                <td><?php echo htmlspecialchars($row['Sex'] ?? ''); ?></td>
                                <td><?php echo htmlspecialchars($row['Age'] ?? ''); ?></td>
                                <td><?php echo htmlspecialchars($row['SibSp'] ?? ''); ?></td>
                                <td><?php echo htmlspecialchars($row['Parch'] ?? ''); ?></td>
                                <td><?php echo htmlspecialchars($row['Ticket'] ?? ''); ?></td>
                                <td><?php echo htmlspecialchars($row['Fare'] ?? ''); ?></td>
                                <td><?php echo htmlspecialchars($row['Cabin'] ?? ''); ?></td>
                                <td><?php echo htmlspecialchars($row['Embarked'] ?? ''); ?></td>
                            </tr>
                        <?php endforeach; ?>
                    </tbody>
                </table>
            </div>
        <?php else: ?>
            <p class="text-center">No records found in the Titanic table.</p>
        <?php endif; ?>
    </div>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>

</html>