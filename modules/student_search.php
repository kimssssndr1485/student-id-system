<?php
$q = trim($_GET['q'] ?? '');
$results = $q !== '' ? StudentRepository::search($q) : [];
?>
<main class="content">
    <h2>Search Student</h2>
    <form method="GET" action="index.php" class="d-flex gap-2 mb-4 search-form">
        <input type="hidden" name="page" value="search">
        <input type="text" name="q" class="form-control" placeholder="Search ID, name, or course..." value="<?php echo htmlspecialchars($q); ?>" required>
        <button type="submit" class="btn btn-success">Search</button>
    </form>

    <?php if ($q !== '') : ?>
        <table class="table table-bordered">
            <thead class="table-dark">
                <tr><th>Student Number</th><th>Complete Name</th><th>Course</th><th>Year Level</th><th>ID Status</th><th>Action</th></tr>
            </thead>
            <tbody>
                <?php if (empty($results)) : ?>
                    <tr><td colspan="6">No matching student found.</td></tr>
                <?php else : ?>
                    <?php foreach ($results as $s) : ?>
                        <tr>
                            <td><?php echo htmlspecialchars($s->getIdNumber()); ?></td>
                            <td><?php echo htmlspecialchars($s->completeName()); ?></td>
                            <td><?php echo htmlspecialchars($s->getCourse()); ?></td>
                            <td><?php echo htmlspecialchars($s->getYearLevel()); ?></td>
                            <td><?php echo htmlspecialchars($s->getIdStatus()); ?></td>
                            <td><a class="btn btn-success btn-sm" href="index.php?page=idcard&id=<?php echo $s->getIdNumber(); ?>">ID Card</a></td>
                        </tr>
                    <?php endforeach; ?>
                <?php endif; ?>
            </tbody>
        </table>
    <?php endif; ?>
</main>