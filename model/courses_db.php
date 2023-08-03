<?php 

    function get_courses_by_teacher($teacher_id) {
        global $db;
        if ($teacher_id) {
            $query = 'SELECT C.COURSE_ID, C.COURSE_NAME, T.TEACHER_NAME FROM courses C LEFT JOIN teachers T ON C.TEACHER_ID = T.TEACHER_ID WHERE C.TEACHER_ID = :teacher_id ORDER BY C.COURSE_ID';
        } else {
            $query = 'SELECT C.COURSE_ID, C.COURSE_NAME, T.TEACHER_NAME FROM courses C LEFT JOIN teachers T ON C.TEACHER_ID = T.TEACHER_ID ORDER BY T.TEACHER_ID';
        }
        $statement = $db->prepare($query);
        if ($teacher_id) {
            $statement->bindValue(':teacher_id', $teacher_id);
        }
        $statement->execute();
        $courses = $statement->fetchAll();
        $statement->closeCursor();
        return $courses;
    }

    function delete_course($course_id) {
        global $db;
        $query = 'DELETE FROM courses WHERE COURSE_ID = :course_id';
        $statement = $db->prepare($query);
        $statement->bindValue(':course_id', $course_id);
        $statement->execute();
        $statement->closeCursor();
    }

    function add_course($teacher_id, $course_name) {
        global $db;
        $query = 'INSERT INTO courses (course_name, teacher_id) VALUES (:course_name, :teacher_id)';
        $statement = $db->prepare($query);
        $statement->bindValue(':course_name', $course_name);
        $statement->bindValue(':teacher_id', $teacher_id);
        $statement->execute();
        $statement->closeCursor();
    }
