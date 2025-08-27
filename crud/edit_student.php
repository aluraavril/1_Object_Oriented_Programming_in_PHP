<?php
require_once "core/models.php";
$student = new Student();
$data = $student->read($_GET['id']);
?>
<!DOCTYPE html>
<html>

<head>
    <title>Edit Student</title>
</head>

<body>
    <h1>Edit Student</h1>
    <form action="core/handleForms.php" method="POST">
        <input type="hidden" name="id" value="<?= $data['id'] ?>">
        <input type="text" name="name" value="<?= $data['name'] ?>" required>
        <input type="email" name="email" value="<?= $data['email'] ?>" required>
        <button type="submit" name="update_student">Update</button>
    </form>
</body>

</html>