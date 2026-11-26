<?php
$data = StudentRepository::find($_GET['id'] ?? '');
$admin = new Staff('Ma. Johanna Ann', 'Bayoneta', 'College Administrator');
?>
<main class="content">
    <h2>Student ID Card (Front &amp; Back)</h2>
    <?php if (empty($data)) : ?>
        <p>Student not found.</p>
        <a href="index.php?page=students" class="btn btn-secondary">Back to Students</a>
    <?php else : ?>
        <?php
        $s = Student::fromArray($data);
        $photoPath = 'images/photos/' . $s->getIdNumber() . '.jpg';
        ?>
        <div class="d-flex flex-wrap gap-4 mb-4">
            <div id="id-front" class="bcc-card bcc-front">
                <div class="bcc-header">
                    <div class="bcc-title-wrap">
                        <div class="bcc-rep">Republic of the Philippines</div>
                        <div class="bcc-school">BACOLOD</div>
                        <div class="bcc-sub">CITY COLLEGE</div>
                        <div class="bcc-city">Bacolod City</div>
                    </div>
                    <img src="images/bcc-logo.png" alt="BCC" class="bcc-logo">
                </div>
                <div class="bcc-body">
                    <div class="bcc-photo">
                        <?php if (file_exists($photoPath)) : ?>
                            <img src="<?php echo htmlspecialchars($photoPath); ?>" alt="Student Photo">
                        <?php else : ?>
                            <span>No photo</span>
                        <?php endif; ?>
                    </div>
                    <div class="bcc-side">
                        <div class="bcc-blank-box"></div>
                        <div class="bcc-id-lbl">Student ID No.</div>
                        <div class="bcc-id-num"><?php echo htmlspecialchars($s->getIdNumber()); ?></div>
                    </div>
                </div>
                <div class="bcc-name-bar"><?php echo strtoupper(htmlspecialchars($s->idCardName())); ?></div>
                <div class="bcc-course-bar"><?php echo htmlspecialchars($s->getCourse()); ?></div>
            </div>

            <div id="id-back" class="bcc-card bcc-back">
                <div class="bcc-back-top">
                    <div><strong>NAME:</strong> <?php echo strtoupper(htmlspecialchars($s->idCardName())); ?></div>
                    <div><strong>BIRTHDAY:</strong> <?php echo htmlspecialchars($s->dateOfBirth()); ?></div>
                </div>
                <div class="bcc-emerg-hdr">In case of emergency please notify:</div>
                <div class="bcc-emerg-box">
                    <div class="bcc-emerg-name">GUARDIAN / PARENT</div>
                    <div>Bacolod City, Negros Occidental</div>
                    <div class="bcc-emerg-tel">09XXXXXXXXX</div>
                </div>
                <p class="bcc-note">This CARD is NON-TRANSFERABLE and VALID ONLY for the semester last validated. Must be worn within school premises <strong>AT ALL TIMES.</strong></p>
                <p class="bcc-note">In CASE LOSS, finder is requested to surrender this card to:<br><strong>THE REGISTRAR'S OFFICE</strong><br>Bacolod City College.</p>
                <div class="bcc-sign">
                    <strong>DR. MA. JOHANNA ANN R. BAYONETA</strong><br>
                    <span><?php echo htmlspecialchars($admin->roleLabel()); ?></span>
                </div>
            </div>
        </div>

        <div class="no-print d-flex flex-wrap gap-2">
            <button class="btn btn-primary btn-download" data-target="id-front" data-file="<?php echo $s->getIdNumber(); ?>-front.png">Download Front PNG</button>
            <button class="btn btn-primary btn-download" data-target="id-back" data-file="<?php echo $s->getIdNumber(); ?>-back.png">Download Back PNG</button>
            <button class="btn btn-success" id="btn-print">Print ID</button>
            <a href="index.php?page=students" class="btn btn-secondary">Back to Students</a>
        </div>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/html2canvas/1.4.1/html2canvas.min.js"></script>
        <script src="assets/js/id-card.js"></script>
    <?php endif; ?>
</main>