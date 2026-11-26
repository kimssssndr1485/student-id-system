<?php
$students = StudentRepository::all();
$courseCounts = CourseRepository::countByCourse();
$unclaimed = StudentRepository::countByStatus('Unclaimed');
$released = StudentRepository::countByStatus('Released');
?>
<main class="content">
    <h2>Dashboard Analytics</h2>
    <div class="row g-3 mb-4">
        <div class="col-md-4"><div class="card p-3"><div>Total Students</div><h3><?php echo count($students); ?></h3></div></div>
        <div class="col-md-4"><div class="card p-3"><div>Unclaimed IDs</div><h3 class="text-warning"><?php echo $unclaimed; ?></h3></div></div>
        <div class="col-md-4"><div class="card p-3"><div>Released IDs</div><h3 class="text-success"><?php echo $released; ?></h3></div></div>
    </div>

    <h4>Students per Department</h4>
    <table class="table table-bordered dept-table">
        <thead class="table-dark">
            <tr><th>Department / Course</th><th>Students</th></tr>
        </thead>
        <tbody>
            <?php foreach ($courseCounts as $row) : ?>
                <tr>
                    <td><?php echo htmlspecialchars($row['name']); ?></td>
                    <td class="fw-bold"><?php echo $row['total']; ?></td>
                </tr>
            <?php endforeach; ?>
        </tbody>
    </table>
</main>