<main class="content">
    <h2>Student Information</h2>
    <div class="container">
        <div class="row">
            <div class="col-lg-12">
                <button class="btn btn-success mb-4">Add Student</button>

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
                                <a class="btn btn-success" href="index.php?page=idcard&id=<?php echo $student->getIdNumber(); ?>">View ID</a>
                                <button class="btn btn-info">Edit</button>
                                <button class="btn btn-danger">Delete</button>
                            </td>
                        </tr>
                    <?php endforeach; ?>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</main>