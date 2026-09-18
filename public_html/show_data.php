<?php
// 1. ปรับค่าการเชื่อมต่อให้ตรงกับ docker-compose.yml
$host = 'db';           // ใช้ชื่อ Service 'db' ใน Docker
$dbname = 'sample_db';    // เปลี่ยนเป็น sample_db ตามไฟล์ .yml ล่าสุด
$username = 'admin';
$password = '1234';
$charset = 'utf8mb4';

$dsn = "mysql:host=$host;dbname=$dbname;charset=$charset";

$options = [
    PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
    PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC,
    PDO::ATTR_EMULATE_PREPARES => false,
];

try {
    // 2. สร้างการเชื่อมต่อแบบ PDO
    $pdo = new PDO($dsn, $username, $password, $options);

    // 3. ดึงข้อมูลด้วย Prepared Statement
    $sql = "SELECT * FROM titanic";
    $stmt = $pdo->prepare($sql);
    $stmt->execute();

    // ดึงข้อมูลทั้งหมดมาไว้ในตัวแปร $rows
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
    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
</head>

<body>
    <div class="container-fluid mt-5 px-4">
        <h2 class="text-center mb-4">Titanic Passenger Data</h2>

        <!-- 4. เปลี่ยนเงื่อนไขเช็คจำนวนแถว -->
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
                        <!-- 5. เปลี่ยนมาใช้ foreach ในการวนลูป -->
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
    <!-- Bootstrap JS -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>

</html>