<?php 

    function get_teachers() {
        global $db;
        $query = 'SELECT * FROM teachers ORDER BY TEACHER_ID';
        $statement = $db->prepare($query);
        $statement->execute();
        $teachers = $statement->fetchAll();
        $statement->closeCursor();
        return $teachers;
    }

    function get_teacher_name($teacher_id) {
        if (!$teacher_id) {
            return "All Teachers";
        }
        global $db;
        $query = 'SELECT * FROM teachers WHERE TEACHER_ID = :teacher_id';
        $statement = $db->prepare($query);
        $statement->bindValue(':teacher_id', $teacher_id);
        $statement->execute();
        $teacher = $statement->fetch();
        $statement->closeCursor();
        $teacher_name = $teacher['TEACHER_NAME'];
        return $teacher_name;
    }

    function delete_teacher($teacher_id) {
        global $db;
        $query = 'DELETE FROM teachers WHERE TEACHER_ID = :teacher_id';
        $statement = $db->prepare($query);
        $statement->bindValue(':teacher_id', $teacher_id);
        $statement->execute();
        $statement->closeCursor();
    }

    function add_teacher($teacher_name) {
        global $db;
        $query = 'INSERT INTO teachers (teacher_name) VALUES(:teacher_name)';
        $statement = $db->prepare($query);
        $statement->bindValue(':teacher_name', $teacher_name);
        $statement->execute();
        $statement->closeCursor();
    }