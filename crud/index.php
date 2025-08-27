<?php
require_once "core/models.php";
$student = new Student();
$attendance = new Attendance();

$students = $student->read();
$attendances = $attendance->readAttendanceWithStudent();
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8" />
    <title>Dashboard — Students & Attendance</title>
    <link rel="stylesheet" href="style.css" />
    <style>
        .container {
            max-width: 1100px;
            margin: 24px auto;
            font-family: Arial, Helvetica, sans-serif
        }

        .grid {
            display: grid;
            grid-template-columns: 1fr 1fr;
            gap: 24px
        }

        .card {
            border: 1px solid #e5e7eb;
            border-radius: 14px;
            box-shadow: 0 2px 10px rgba(0, 0, 0, .04);
            overflow: hidden;
            background: #fffbe6;

        }

        .card h2 {
            margin: 0;
            padding: 14px 16px;
            border-bottom: 1px solid #fcd34d;
            background: #fde047;
            color: #000;
            font-weight: bold;
        }

        .card table {
            background: #ffffff;
        }

        .card table th,
        .card table td {
            background: #ffffff;
        }

        .attendance-card {
            background: #eff6ff;
        }

        .attendance-card h2 {
            background: #93c5fd;
            border-bottom: 1px solid #60a5fa;
            color: #000;
            font-weight: bold;
        }

        .attendance-btn {
            background: #3b82f6;
            color: #fff;
        }

        .attendance-btn:hover {
            background: #2563eb;
        }

        .delete-link {
            color: #dc2626;
            font-weight: bold;
        }

        .delete-link:hover {
            color: #b91c1c;
            text-decoration: underline;
        }

        .edit-link {
            color: #1e3a8a;
            font-weight: bold;
        }

        .edit-link:hover {
            color: #1d4ed8;
            text-decoration: underline;
        }

        .card .body {
            padding: 16px
        }

        form .row {
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
            background: #facc15;
            color: #000;
            cursor: pointer;
            font-weight: bold;
            transition: background 0.2s;
        }

        button:hover {
            background: #eab308;
        }

        button.link {
            background: transparent;
            color: #2563eb;
            padding: 0
        }

        table {
            width: 100%;
            border-collapse: collapse;
            margin-top: 12px
        }

        th,
        td {
            padding: 10px;
            border-bottom: 1px solid #eee;
            text-align: left;
            font-size: 14px
        }

        .actions a {
            margin-right: 8px
        }

        .muted {
            color: #6b7280
        }

        @media (max-width:900px) {
            .grid {
                grid-template-columns: 1fr
            }
        }
    </style>
</head>

<body>
    <div class="container">
        <h1>Students & Attendance Dashboard</h1>

        <div class="grid">
            <!-- Students Card -->
            <div class="card">
                <h2>Students</h2>
                <div class="body">

                    <!-- Add Student -->
                    <form action="core/handleForms.php" method="POST">
                        <div class="row">
                            <input type="text" name="name" placeholder="Full name" required />
                            <input type="email" name="email" placeholder="Email" required />
                            <button type="submit" name="add_student">Add</button>
                        </div>
                    </form>

                    <!-- Student List -->
                    <?php if (empty($students)): ?>
                        <p class="muted">No students yet.</p>
                    <?php else: ?>
                        <table>
                            <thead>
                                <tr>
                                    <th>#</th>
                                    <th>Name</th>
                                    <th>Email</th>
                                    <th>Actions</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php foreach ($students as $s): ?>
                                    <tr>
                                        <td><?= htmlspecialchars($s['id']) ?></td>
                                        <td><?= htmlspecialchars($s['name']) ?></td>
                                        <td><?= htmlspecialchars($s['email']) ?></td>
                                        <td class="actions">
                                            <a class="edit-link" href="edit_student.php?id=<?= urlencode($s['id']) ?>">Edit</a>
                                            <a class="delete-link" href="core/handleForms.php?delete_student=<?= urlencode($s['id']) ?>"
                                                onclick="return confirm('Delete this student? This will also remove their attendance.');">
                                                Delete
                                            </a>

                                        </td>
                                    </tr>
                                <?php endforeach; ?>
                            </tbody>
                        </table>
                    <?php endif; ?>

                </div>
            </div>

            <!-- Attendance Card -->
            <div class="card attendance-card">
                <h2>Attendance</h2>
                <div class="body">

                    <!-- Add Attendance -->
                    <form action="core/handleForms.php" method="POST">
                        <div class="row">
                            <select name="student_id" required>
                                <option value="">Select student</option>
                                <?php foreach ($students as $s): ?>
                                    <option value="<?= htmlspecialchars($s['id']) ?>"><?= htmlspecialchars($s['name']) ?></option>
                                <?php endforeach; ?>
                            </select>
                            <input type="date" name="date" required />
                            <select name="status" required>
                                <option value="Present">Present</option>
                                <option value="Absent">Absent</option>
                            </select>
                            <button type="submit" name="add_attendance" class="attendance-btn">Add</button>

                        </div>
                    </form>

                    <!-- Attendance List -->
                    <?php if (empty($attendances)): ?>
                        <p class="muted">No attendance records yet.</p>
                    <?php else: ?>
                        <table>
                            <thead>
                                <tr>
                                    <th>#</th>
                                    <th>Student</th>
                                    <th>Date</th>
                                    <th>Status</th>
                                    <th>Actions</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php foreach ($attendances as $a): ?>
                                    <tr>
                                        <td><?= htmlspecialchars($a['id']) ?></td>
                                        <td><?= htmlspecialchars($a['name']) ?></td>
                                        <td><?= htmlspecialchars($a['date']) ?></td>
                                        <td><?= htmlspecialchars($a['status']) ?></td>
                                        <td class="actions">
                                            <a class="edit-link" href="edit_attendance.php?id=<?= urlencode($a['id']) ?>">Edit</a>
                                            <a class="delete-link" href="core/handleForms.php?delete_attendance=<?= urlencode($a['id']) ?>"
                                                onclick="return confirm('Delete this attendance record?');">
                                                Delete
                                            </a>

                                        </td>
                                    </tr>
                                <?php endforeach; ?>
                            </tbody>
                        </table>
                    <?php endif; ?>

                </div>
            </div>
        </div>

    </div>
</body>

</html>