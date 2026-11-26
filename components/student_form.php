<?php $courses = CourseRepository::getCourses(); ?>
<form method="POST" action="<?php echo $formAction ?? ''; ?>" class="student-form">
    <label class="form-label">ID Number (00-0000)</label>
    <input type="text" name="student_number" placeholder="26-0001" class="form-control mb-3"
           value="<?php echo htmlspecialchars($formData['student_number'] ?? ''); ?>" required>

    <label class="form-label">Firstname</label>
    <input type="text" name="firstname" class="form-control mb-3"
           value="<?php echo htmlspecialchars($formData['firstname'] ?? ''); ?>" required>

    <label class="form-label">Middle Initial (optional)</label>
    <input type="text" name="middle_initial" maxlength="1" class="form-control mb-3"
           value="<?php echo htmlspecialchars($formData['middle_initial'] ?? ''); ?>">

    <label class="form-label">Lastname</label>
    <input type="text" name="lastname" class="form-control mb-3"
           value="<?php echo htmlspecialchars($formData['lastname'] ?? ''); ?>" required>

    <label class="form-label">Date of Birth</label>
    <input type="date" name="date_of_birth" class="form-control mb-3"
           value="<?php echo htmlspecialchars($formData['date_of_birth'] ?? ''); ?>" required>

    <label class="form-label">Department / Course</label>
    <select name="course_id" class="form-select mb-3" required>
        <option value="">-- Select --</option>
        <?php foreach ($courses as $c) : ?>
            <option value="<?php echo $c['id']; ?>" <?php echo ($formData['course_id'] ?? '') == $c['id'] ? 'selected' : ''; ?>>
                <?php echo htmlspecialchars($c['name']); ?>
            </option>
        <?php endforeach; ?>
    </select>

    <label class="form-label">Year Level</label>
    <select name="year_level" class="form-select mb-3" required>
        <?php foreach (Student::YEAR_LEVELS as $y) : ?>
            <option value="<?php echo $y; ?>" <?php echo ($formData['year_level'] ?? '') === $y ? 'selected' : ''; ?>><?php echo $y; ?></option>
        <?php endforeach; ?>
    </select>

    <label class="form-label">ID Status</label>
    <select name="id_status" class="form-select mb-4" required>
        <?php foreach (Student::ID_STATUSES as $st) : ?>
            <option value="<?php echo $st; ?>" <?php echo ($formData['id_status'] ?? 'Unclaimed') === $st ? 'selected' : ''; ?>><?php echo $st; ?></option>
        <?php endforeach; ?>
    </select>

    <button type="submit" class="btn btn-success"><?php echo $buttonText; ?></button>
    <a href="index.php?page=students" class="btn btn-secondary">Cancel</a>
</form>