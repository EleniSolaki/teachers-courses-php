<?php include('view/header.php') ?>

<section id="list" class="list">
    <header class="list__row list__header">
        <h1>
            Teachers/Courses
        </h1>
        <form action="." method="get" id="list__header_select" class="list__header_select">
            <input type="hidden" name="action" value="list_courses">
            <select name="teacher_id" required>
                <option value="0">View All</option>
                <?php foreach ($teachers as $teacher) : ?>
                <?php if ($teacher_id == $teacher['TEACHER_ID']) { ?>
                <option value="<?= $teacher['TEACHER_ID'] ?>" selected>
                    <?php } else { ?>
                <option value="<?= $teacher['TEACHER_ID'] ?>">
                    <?php } ?>
                    <?= $teacher['TEACHER_NAME'] ?>
                </option>
                <?php endforeach; ?>
            </select>
            <button class="add-button bold">View</button>
        </form>
    </header>
    <?php if($courses) { ?>
    <?php foreach ($courses as $course) : ?>
    <div class="list__row">
        <div class="list__item">
            <p class="bold"><?= "{$course['TEACHER_NAME']}" ?></p>
            <p><?= $course['COURSE_NAME']; ?></p>
        </div>
        <div class="list__removeItem">
            <form action="." method="post">
                <input type="hidden" name="action" value="delete_course">
                <input type="hidden" name="course_id" value="<?= $course['COURSE_ID']; ?>">
                <button class="remove-button">❌</button>
            </form>
        </div>
    </div>
    <?php endforeach; ?>
    <?php } else { ?>
    <br>
    <?php if ($teacher_id) { ?>
    <p>No courses exist for this teacher yet.</p>
    <?php } else { ?>
    <p>No courses exist yet.</p>
    <?php } ?>
    <br>
    <?php } ?>
</section>

<section id="add" class="add">
    <h2>Add Course</h2>
    <form action="." method="post" id="add__form" class="add__form">
        <input type="hidden" name="action" value="add_course">
        <div class="add__inputs">
            <label>teacher:</label>
            <select name="teacher_id" required>
                <option value="">Please select a teacher</option>
                <?php foreach ($teachers as $teacher) : ?>
                <option value="<?= $teacher['TEACHER_ID']; ?>">
                    <?= $teacher['TEACHER_NAME']; ?>
                </option>
                <?php endforeach; ?>
            </select>
            <label>Course:</label>
            <input type="text" name="course_name" maxlength="120" placeholder="course name" required>
        </div>
        <div class="add__addItem">
            <button class="add-button bold">Add</button>
        </div>
    </form>
</section>
<br>
<p><a href=".?action=list_teachers">View/Edit Teachers</a></p>
<?php include('view/footer.php') ?>