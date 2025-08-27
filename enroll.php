<?php
class Student
{
    private $name;
    private $courses = [];
    private $courseFee = 1450;

    public function __construct($name)
    {
        $this->name = $name;
    }

    // add a course func
    public function addCourse($courseName)
    {
        if (!in_array($courseName, $this->courses)) {
            $this->courses[] = $courseName;
            echo "Course '$courseName' added successfully.\n";
        } else {
            echo "Course '$courseName' is already enrolled.\n";
        }
    }

    // remove course func
    public function removeCourse($courseName)
    {
        $key = array_search($courseName, $this->courses);
        if ($key !== false) {
            unset($this->courses[$key]);
            $this->courses = array_values($this->courses); // reindex
            echo "Course '$courseName' removed successfully.\n";
        } else {
            echo "Course '$courseName' not found.\n";
        }
    }

    // get all enrolled courses
    public function getCourses()
    {
        return $this->courses;
    }

    // total fee func
    public function getTotalFee()
    {
        return count($this->courses) * $this->courseFee;
    }

    // display student info func
    public function displayInfo()
    {
        echo "\n\n" . "Student: {$this->name}\n";
        echo "Enrolled Courses:\n";
        if (empty($this->courses)) {
            echo "No courses enrolled.\n";
        } else {
            foreach ($this->courses as $index => $course) {
                echo ($index + 1) . ". $course\n";
            }
        }
        echo "\n\n" . "Total Enrollment Fee: PHP " . number_format($this->getTotalFee(), 2) . "\n\n";
    }
}

// sample
$student = new Student("Juan Dela Cruz");

// try to add courses
$student->addCourse("Software Development");
$student->addCourse("Professional Elective 1");
$student->addCourse("Art Appreciation");
$student->addCourse("Thesis 1");

// remove a course
$student->removeCourse("Art Appreciation");

// display student innfo
$student->displayInfo();

//try uli
$student->addCourse("Physical Education 2");
$student->displayInfo();
