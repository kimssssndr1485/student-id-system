<main class="content">
    <h2>Student Information</h2>

    <?php $msg = $_GET['msg'] ?? ''; ?>
    <?php if ($msg === 'added') : ?><div class="alert alert-success">Student added successfully.</div>
    <?php elseif ($msg === 'updated') : ?><div class="alert alert-success">Student updated successfully.</div>
    <?php elseif ($msg === 'deleted') : ?><div class="alert alert-danger">The data has been successfully deleted.</div>
    <?php elseif ($msg === 'status') : ?><div class="alert alert-info">ID status updated.</div>
    <?php endif; ?>

    <a href="index.php?page=add" class="btn btn-success mb-3">Add Student</a>

    <div class="table-responsive">
        <table class="table table-bordered">
            <thead class="table-dark">
                <tr>
                    <th>Student Number</th><th>Complete Name</th><th>Course</th>
                    <th>Year Level</th><th>Date of Birth</th><th>ID Status</th><th>Action</th>
                </tr>
            </thead>
            <tbody>
            <?php foreach (StudentRepository::all() as $s) : ?>
                <?php $next = $s->getIdStatus() === 'Released' ? 'Unclaimed' : 'Released'; ?>
                <tr>
                    <td><?php echo htmlspecialchars($s->getIdNumber()); ?></td>
                    <td><?php echo htmlspecialchars($s->completeName()); ?></td>
                    <td><?php echo htmlspecialchars($s->getCourse()); ?></td>
                    <td><?php echo htmlspecialchars($s->getYearLevel()); ?></td>
                    <td><?php echo htmlspecialchars($s->dateOfBirth()); ?></td>
                    <td><span class="badge <?php echo $next === 'Unclaimed' ? 'bg-success' : 'bg-warning text-dark'; ?>"><?php echo htmlspecialchars($s->getIdStatus()); ?></span></td>
                    <td>
                        <a class="btn btn-success btn-sm" href="index.php?page=idcard&id=<?php echo $s->getIdNumber(); ?>">ID Card</a>
                        <a class="btn btn-info btn-sm" href="index.php?page=edit&id=<?php echo $s->getIdNumber(); ?>">Edit</a>
                        <a class="btn btn-outline-dark btn-sm" href="modules/student_status.php?id=<?php echo $s->getIdNumber(); ?>&status=<?php echo $next; ?>">Mark <?php echo $next; ?></a>
                        <a class="btn btn-danger btn-sm"
                            href="modules/student_delete.php?id=<?php echo urlencode($s->getIdNumber()); ?>"
                            onclick="return confirm('Do you want to delete this student?');">Delete</a>
                    </td>
                </tr>
            <?php endforeach; ?>
            </tbody>
        </table>
    </div>
</main>
<script src="assets/js/students.js"></script>