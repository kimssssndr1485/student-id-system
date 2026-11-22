<main class="content">
    <h2>Student Information</h2>

    <?php $msg = $_GET['msg'] ?? ''; ?>
    <?php if ($msg === 'added') : ?>
        <div class="alert alert-success">Student added successfully.</div>
    <?php elseif ($msg === 'updated') : ?>
        <div class="alert alert-success">Student updated successfully.</div>
    <?php elseif ($msg === 'deleted') : ?>
        <div class="alert alert-success">Student deleted successfully.</div>
    <?php endif; ?>

    <div class="container">
        <div class="row">
            <div class="col-lg-12">
                <a href="index.php?page=add" class="btn btn-success mb-4">Add Student</a>

                <table class="table table-bordered table-responsive text-center">
                    <thead class="table-dark">
                        <tr>
                            <th>Student Number</th>
                            <th>Complete Name</th>
                            <th>Course</th>
                            <th>Year Level</th>
                            <th>Date of Birth</th>
                            <th>Action</th>
                        </tr>
                    </thead>
                    <tbody>
                    <?php foreach (StudentRepository::all() as $student) : ?>
                        <tr>
                            <td><?php echo $student->getIdNumber(); ?></td>
                            <td><?php echo $student->completeName(); ?></td>
                            <td><?php echo $student->getCourse(); ?></td>
                            <td><?php echo $student->getYearLevel(); ?></td>
                            <td><?php echo $student->dateOfBirth(); ?></td>
                            <td>
                                <a class="btn btn-success" href="index.php?page=idcard&id=<?php echo $student->getIdNumber(); ?>">ID Card</a>
                                <a class="btn btn-info" href="index.php?page=edit&id=<?php echo $student->getIdNumber(); ?>">Edit</a>
                                <button class="btn btn-danger" onclick="deleteData('<?php echo $student->getIdNumber(); ?>')">Delete</button>
                            </td>
                        </tr>
                    <?php endforeach; ?>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</main>

<script>
function deleteData(id) {
    if (confirm('Do you want to delete data?')) {
        window.location = "modules/student_delete.php?id=" + id;
    }
}
</script>