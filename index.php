<?php
require_once "student.php";
$student = new Student();

// Handle form actions
if (isset($_POST['add'])) {
    $student->addStudent($_POST['name'], $_POST['course']);
}
if (isset($_POST['update'])) {
    $student->updateStudent($_POST['id'], $_POST['name'], $_POST['course']);
}
if (isset($_GET['delete'])) {
    $student->deleteStudent($_GET['delete']);
}

$students = $student->getStudents();
?>

<!DOCTYPE html>
<html>
<head>
    <title>Student CRUD</title>
</head>
<body>
    <nav style="margin-bottom:15px;">
        <a href="index.php">Students</a> | 
        <a href="attendance_index.php">Attendance</a>
    </nav>
    <h2>Student Enrollment CRUD</h2>

    <!-- Add Form -->
    <form method="POST">
        <input type="text" name="name" placeholder="Student Name" required>
        <input type="text" name="course" placeholder="Course" required>
        <button type="submit" name="add">Add Student</button>
    </form>
    <br>

    <!-- Student List -->
    <table border="1" cellpadding="5">
        <tr>
            <th>ID</th>
            <th>Name</th>
            <th>Course</th>
            <th>Actions</th>
        </tr>
        <?php foreach ($students as $s): ?>
        <tr>
            <td><?= $s['id'] ?></td>
            <td><?= htmlspecialchars($s['name']) ?></td>
            <td><?= htmlspecialchars($s['course']) ?></td>
            <td>
                <!-- Update Form -->
                <form method="POST" style="display:inline;">
                    <input type="hidden" name="id" value="<?= $s['id'] ?>">
                    <input type="text" name="name" value="<?= $s['name'] ?>">
                    <input type="text" name="course" value="<?= $s['course'] ?>">
                    <button type="submit" name="update">Update</button>
                </form>
                <!-- Delete -->
                <a href="?delete=<?= $s['id'] ?>" onclick="return confirm('Delete this student?')">Delete</a>
            </td>
        </tr>
        <?php endforeach; ?>
    </table>
</body>
</html>
