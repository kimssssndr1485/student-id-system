<div class="row">
    <div class="col-lg-6">
        <form method="POST" action="">

            <label class="form-label">ID Number</label>
            <input type="text" name="student_number" class="form-control mb-3"
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

            <label class="form-label">Course</label>
            <select name="course" class="form-select mb-3" required>
                <option value="">-- Select --</option>
                <?php foreach (Student::COURSES as $c) : ?>
                    <option value="<?php echo $c; ?>" <?php echo ($formData['course'] ?? '') === $c ? 'selected' : ''; ?>>
                        <?php echo $c; ?>
                    </option>
                <?php endforeach; ?>
            </select>

            <label class="form-label">Year Level</label>
            <select name="year_level" class="form-select mb-4" required>
                <option value="">-- Select --</option>
                <?php foreach (Student::YEAR_LEVELS as $y) : ?>
                    <option value="<?php echo $y; ?>" <?php echo ($formData['year_level'] ?? '') === $y ? 'selected' : ''; ?>>
                        <?php echo $y; ?>
                    </option>
                <?php endforeach; ?>
            </select>

            <button type="submit" class="btn btn-success"><?php echo $buttonText; ?></button>
            <a href="index.php?page=students" class="btn btn-secondary">Cancel</a>
        </form>
    </div>
</div>