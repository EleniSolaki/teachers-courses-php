<?php include('view/header.php') ?>

<?php if($teachers) { ?>

<section id="list" class="list">
    <header class="list__row list__header">
        <h1>
            Teachers List
        </h1>
    </header>


    <?php foreach ($teachers as $teacher) : ?>
    <div class="list__row">
        <div class="list__item">
            <p class="bold"><?= $teacher['TEACHER_NAME'] ?></p>
        </div>
        <div class="list__removeItem">
            <form action="." method="post">
                <input type="hidden" name="action" value="delete_teacher">
                <input type="hidden" name="teacher_id" value="<?= $teacher['TEACHER_ID']; ?>">
                <button class="remove-button">❌</button>
            </form>
        </div>
    </div>
    <?php endforeach; ?>
</section>
<?php } else { ?>
<p>No categories exist yet.</p>
<?php } ?>

<section id="add" class="add">
    <h2>Add Teacher</h2>
    <form action="." method="post" id="add__form" class="add__form">
        <input type="hidden" name="action" value="add_teacher">
        <div class="add__inputs">
            <label>Teacher name:</label>
            <input type="text" name="teacher_name" maxlength="30" placeholder="Name" autofocus required>
        </div>
        <div class="add__addItem">
            <button class="add-button bold">Add</button>
        </div>
    </form>
</section>

<br>
<p><a href=".">View &amp; Add Courses</a></p>

<?php include('view/footer.php') ?>