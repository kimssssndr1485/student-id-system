<?php $data = StudentRepository::find($_GET['id'] ?? ''); ?>
<main class="content">
    <h2>Student ID Card</h2>

    <?php if (empty($data)) : ?>

        <p>Student not found.</p>
        <a href="index.php?page=students" class="btn btn-secondary">Back to Students</a>

    <?php else : ?>

        <?php
        $student = Student::fromArray($data);
        // The photo is found by student number, for example images/photos/2026-0001.jpg
        $photo = 'images/photos/' . $student->getIdNumber() . '.jpg';
        ?>

        <div class="id-card mb-4">
            <div class="id-card-header">
                <img src="images/bcc-logo.png" alt="" onerror="this.style.display='none'">
                <span>IRACC BCC</span>
            </div>

            <div class="id-card-main">
                <div class="id-photo">
                    <?php if (file_exists($photo)) : ?>
                        <img src="<?php echo $photo; ?>" alt="Student photo">
                    <?php else : ?>
                        <span>No photo</span>
                    <?php endif; ?>
                </div>
                <div class="id-info">
                    <p class="id-name"><?php echo $student->idCardName(); ?></p>
                    <p class="id-course"><?php echo $student->getCourse(); ?></p>
                    <p class="id-year"><?php echo $student->getYearLevel(); ?></p>
                    <p class="id-number"><?php echo $student->getIdNumber(); ?></p>
                </div>
            </div>

            <div class="id-card-barcode">
                <svg id="barcode"></svg>
            </div>
        </div>

        <div class="no-print">
            <button class="btn btn-success" onclick="window.print()">Print ID</button>
            <a href="index.php?page=students" class="btn btn-secondary">Back to Students</a>
        </div>

        <script src="https://cdnjs.cloudflare.com/ajax/libs/jsbarcode/3.11.6/JsBarcode.all.min.js"></script>
        <script>
            JsBarcode("#barcode", "<?php echo $student->getIdNumber(); ?>", {
                format: "CODE128",
                displayValue: false,
                height: 26,
                width: 1.2,
                margin: 0
            });
        </script>

    <?php endif; ?>
</main>