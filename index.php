<?php
    require('model/database.php');
    require('model/teachers_db.php');
    require('model/courses_db.php');

    $course_id = filter_input(INPUT_POST, 'course_id', FILTER_VALIDATE_INT);
    $course_name = filter_input(INPUT_POST, 'course_name', FILTER_SANITIZE_STRING);
    $teacher_name = filter_input(INPUT_POST, 'teacher_name', FILTER_SANITIZE_STRING);

    $teacher_id = filter_input(INPUT_POST, 'teacher_id', FILTER_VALIDATE_INT);
    if (!$teacher_id) {
        $teacher_id = filter_input(INPUT_GET, 'teacher_id', FILTER_VALIDATE_INT);
    }

    $action = filter_input(INPUT_POST, 'action', FILTER_SANITIZE_STRING);
    if (!$action) {
        $action = filter_input(INPUT_GET, 'action', FILTER_SANITIZE_STRING);
        if (!$action) {
            $action = 'list_courses';
        }
    }

    switch($action) {
        case "list_teachers": 
            $teachers = get_teachers();
            include('view/teachers_list.php');
            break;
        case "add_teacher":
            add_teacher($teacher_name);
            header("Location: .?action=list_teachers");
            break;
        case "add_course":
            if ($teacher_id && $course_name) {
                add_course($teacher_id, $course_name);
                header("Location: .?teacher_id=$teacher_id");
            } else {
                $error = "Invalid course data. Check all fields and try again.";
                include('view/error.php');
                exit();
            }
            break;
        case "delete_teacher":
            if ($teacher_id) {
                try {
                    delete_teacher($teacher_id);
                } catch (PDOException $e) {
                    $error = "You cannot delete a teacher if course exist for it.";
                    include('view/error.php');
                    exit();
                }
                header("Location: .?action=list_teachers");
            }
            break;
        case "delete_course":
            if ($course_id) {
                delete_course($course_id);
                header("Location: .?teacher_id=$teacher_id");
            } else {
                $error = "Missing or incorrect course id.";
                include('view/error.php');
            }
            break;
        default:
            $teacher_name = get_teacher_name($teacher_id);
            $teachers = get_teachers();
            $courses = get_courses_by_teacher($teacher_id);
            include('view/courses_list.php');
    }