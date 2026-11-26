document.querySelectorAll('.btn-delete').forEach(function (btn) {
    btn.addEventListener('click', function () {
        if (confirm('Do you want to delete this student?')) {
            window.location = 'modules/student_delete.php?id=' + btn.dataset.id;
        }
    });
});