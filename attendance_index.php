<?php
require_once "attendance.php";
$attendance = new Attendance();

// handle actions
if (isset($_POST['add'])) {
    $attendance->addAttendance($_POST['student_id'], $_POST['date'], $_POST['status']);
}
if (isset($_POST['update'])) {
    $attendance->updateAttendance($_POST['id'], $_POST['student_id'], $_POST['date'], $_POST['status']);
}
if (isset($_GET['delete'])) {
    $attendance->deleteAttendance($_GET['delete']);
}

$records = $attendance->getAttendance();
?>

<!DOCTYPE html>
<html>
<head>
    <title>Attendance CRUD</title>
</head>
<body>
    <h2>Attendance Records CRUD</h2>

    <!-- Add Attendance -->
    <form method="POST">
        <input type="number" name="student_id" placeholder="Student ID" required>
        <input type="date" name="date" required>
        <select name="status">
            <option value="Present">Present</option>
            <option value="Absent">Absent</option>
        </select>
        <button type="submit" name="add">Add Record</button>
    </form>
    <br>

    <!-- Attendance List -->
    <table border="1" cellpadding="5">
        <tr>
            <th>ID</th>
            <th>Student ID</th>
            <th>Date</th>
            <th>Status</th>
            <th>Actions</th>
        </tr>
        <?php foreach ($records as $r): ?>
        <tr>
            <td><?= $r['id'] ?></td>
            <td><?= $r['student_id'] ?></td>
            <td><?= $r['date'] ?></td>
            <td><?= $r['status'] ?></td>
            <td>
                <!-- Update Form -->
                <form method="POST" style="display:inline;">
                    <input type="hidden" name="id" value="<?= $r['id'] ?>">
                    <input type="number" name="student_id" value="<?= $r['student_id'] ?>">
                    <input type="date" name="date" value="<?= $r['date'] ?>">
                    <select name="status">
                        <option value="Present" <?= $r['status']=="Present"?"selected":"" ?>>Present</option>
                        <option value="Absent" <?= $r['status']=="Absent"?"selected":"" ?>>Absent</option>
                    </select>
                    <button type="submit" name="update">Update</button>
                </form>
                <!-- Delete -->
                <a href="?delete=<?= $r['id'] ?>" onclick="return confirm('Delete this record?')">Delete</a>
            </td>
        </tr>
        <?php endforeach; ?>
    </table>
</body>
</html>
