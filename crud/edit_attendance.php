<?php
require_once "core/models.php";
$attendance = new Attendance();
$student = new Student();

$id = isset($_GET['id']) ? (int)$_GET['id'] : 0;
$record = $attendance->read($id);
if (!$record) {
    header("Location: index.php");
    exit;
}

$students = $student->read();
?>
<!DOCTYPE html>
<html>

<head>
    <meta charset="UTF-8">
    <title>Edit Attendance</title>
    <link rel="stylesheet" href="style.css">
    <style>
        .wrap {
            max-width: 700px;
            margin: 24px auto;
            font-family: Arial, Helvetica, sans-serif
        }

        .card {
            border: 1px solid #e5e7eb;
            border-radius: 14px;
            box-shadow: 0 2px 10px rgba(0, 0, 0, .04)
        }

        .card h2 {
            margin: 0;
            padding: 14px 16px;
            border-bottom: 1px solid #eee;
            background: #fafafa
        }

        .card .body {
            padding: 16px
        }

        .row {
            display: flex;
            gap: 10px;
            margin-bottom: 10px
        }

        input,
        select {
            padding: 10px;
            border: 1px solid #ccc;
            border-radius: 8px;
            width: 100%
        }

        button {
            padding: 10px 14px;
            border: 0;
            border-radius: 10px;
            background: #2563eb;
            color: #fff;
            cursor: pointer
        }

        a.link {
            color: #2563eb;
            text-decoration: none;
            margin-left: 10px
        }
    </style>
</head>

<body>
    <div class="wrap">
        <div class="card">
            <h2>Edit Attendance</h2>
            <div class="body">
                <form action="core/handleForms.php" method="POST">
                    <input type="hidden" name="id" value="<?= htmlspecialchars($record['id']) ?>">
                    <div class="row">
                        <select name="student_id" required>
                            <?php foreach ($students as $s): ?>
                                <option value="<?= htmlspecialchars($s['id']) ?>"
                                    <?= ($s['id'] == $record['student_id']) ? 'selected' : '' ?>>
                                    <?= htmlspecialchars($s['name']) ?>
                                </option>
                            <?php endforeach; ?>
                        </select>
                        <input type="date" name="date" value="<?= htmlspecialchars($record['date']) ?>" required />
                        <select name="status" required>
                            <option value="Present" <?= $record['status'] === 'Present' ? 'selected' : '' ?>>Present</option>
                            <option value="Absent" <?= $record['status'] === 'Absent' ? 'selected' : '' ?>>Absent</option>
                        </select>
                    </div>
                    <button type="submit" name="update_attendance">Update</button>
                    <a class="link" href="index.php">Back</a>
                </form>
            </div>
        </div>
    </div>
</body>

</html>