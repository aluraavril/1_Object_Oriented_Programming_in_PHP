<?php
require_once "core/models.php";
$student = new Student();
$students = $student->read();
?>
<!DOCTYPE html>
<html>

<head>
    <title>Add Attendance</title>
</head>

<body>
    <h1>Add Attendance</h1>
    <form action="core/handleForms.php" method="POST">
        <select name="student_id" required>
            <option value="">Select Student</option>
            <?php foreach ($students as $s): ?>
                <option value="<?= $s['id'] ?>"><?= $s['name'] ?></option>
            <?php endforeach; ?>
        </select>
        <input type="date" name="date" required>
        <select name="status" required>
            <option value="Present">Present</option>
            <option value="Absent">Absent</option>
        </select>
        <button type="submit" name="add_attendance">Save</button>
    </form>
</body>

</html>