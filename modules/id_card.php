<?php
$data = StudentRepository::find($_GET['id'] ?? '');
$registrar = new Staff('School', 'Registrar', 'Registrar');
?>
<main class="content">
    <h2>Student ID Card (Front &amp; Back)</h2>
    <?php if (empty($data)) : ?>
        <p>Student not found.</p>
        <a href="index.php?page=students" class="btn btn-secondary">Back to Students</a>
    <?php else : ?>
        <?php $s = Student::fromArray($data); ?>
        <div class="d-flex flex-wrap gap-4 mb-4">
            <div id="id-front" class="id-card">
                <div class="id-card-header"><img src="images/bcc-logo.png" alt=""><span>IRACC BCC</span></div>
                <div class="id-card-main">
                    <div class="id-photo"><span>No photo</span></div>
                    <div class="id-info">
                        <p class="id-name"><?php echo htmlspecialchars($s->idCardName()); ?></p>
                        <p class="id-course"><?php echo htmlspecialchars($s->getCourse()); ?></p>
                        <p class="id-year"><?php echo htmlspecialchars($s->roleLabel()); ?></p>
                        <p class="id-number"><?php echo htmlspecialchars($s->getIdNumber()); ?></p>
                    </div>
                </div>
                <div class="id-card-barcode"><svg id="barcode" data-code="<?php echo htmlspecialchars($s->getIdNumber()); ?>"></svg></div>
            </div>

            <div id="id-back" class="id-card id-card-back">
                <div>
                    <p class="id-back-title">STUDENT INFORMATION</p>
                    <p class="id-back-text">Date of Birth: <?php echo htmlspecialchars($s->dateOfBirth()); ?></p>
                    <p class="id-back-text">ID Status: <?php echo htmlspecialchars($s->getIdStatus()); ?></p>
                    <p class="id-back-note">This ID card is non-transferable and must be worn inside the campus at all times.</p>
                </div>
                <div class="id-back-sign"><?php echo htmlspecialchars($registrar->roleLabel()); ?></div>
            </div>
        </div>

        <div class="no-print d-flex flex-wrap gap-2">
            <button class="btn btn-primary btn-download" data-target="id-front" data-file="<?php echo $s->getIdNumber(); ?>-front.png">Download Front PNG</button>
            <button class="btn btn-primary btn-download" data-target="id-back" data-file="<?php echo $s->getIdNumber(); ?>-back.png">Download Back PNG</button>
            <button class="btn btn-success" id="btn-print">Print ID</button>
            <a href="index.php?page=students" class="btn btn-secondary">Back to Students</a>
        </div>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/jsbarcode/3.11.6/JsBarcode.all.min.js"></script>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/html2canvas/1.4.1/html2canvas.min.js"></script>
        <script src="assets/js/id-card.js"></script>
    <?php endif; ?>
</main>