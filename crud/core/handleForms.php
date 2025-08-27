<?php
require_once "models.php";

$student = new Student();
$attendance = new Attendance();

if ($_SERVER['REQUEST_METHOD'] == 'POST') {

    if (isset($_POST['add_student'])) {
        $student->create([
            'name' => $_POST['name'],
            'email' => $_POST['email']
        ]);
        header("Location: ../index.php");
        exit;
    }

    if (isset($_POST['update_student'])) {
        $student->update($_POST['id'], [
            'name' => $_POST['name'],
            'email' => $_POST['email']
        ]);
        header("Location: ../index.php");
        exit;
    }

    if (isset($_POST['add_attendance'])) {
        $student_id = $_POST['student_id'];
        $date = $_POST['date'];
        $status = $_POST['status'];

        //if may attendance na for the same student on the same date
        $stmt = $attendance->conn->prepare(
            "SELECT COUNT(*) FROM attendance WHERE student_id = :sid AND date = :date"
        );
        $stmt->execute(['sid' => $student_id, 'date' => $date]);
        $exists = $stmt->fetchColumn();

        if ($exists > 0) {
            header("Location: ../index.php?error=duplicate");
            exit;
        }

        $attendance->create([
            'student_id' => $student_id,
            'date' => $date,
            'status' => $status
        ]);
        header("Location: ../index.php?success=added");
        exit;
    }

    if (isset($_POST['update_attendance'])) {
        $attendance->update($_POST['id'], [
            'student_id' => $_POST['student_id'],
            'date' => $_POST['date'],
            'status' => $_POST['status']
        ]);
        header("Location: ../index.php?success=updated");
        exit;
    }
}

// deletes
if (isset($_GET['delete_student'])) {
    $student->delete($_GET['delete_student']);
    header("Location: ../index.php");
    exit;
}

if (isset($_GET['delete_attendance'])) {
    $attendance->delete($_GET['delete_attendance']);
    header("Location: ../index.php");
    exit;
}
