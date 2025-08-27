<!DOCTYPE html>
<html>

<head>
    <title>Add Student</title>
</head>

<body>
    <h1>Add Student</h1>
    <form action="core/handleForms.php" method="POST">
        <input type="text" name="name" placeholder="Name" required>
        <input type="email" name="email" placeholder="Email" required>
        <button type="submit" name="add_student">Save</button>
    </form>
</body>

</html>