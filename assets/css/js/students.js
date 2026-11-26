document.addEventListener("DOMContentLoaded", function () {
    document.querySelectorAll(".btn-delete").forEach(function (btn) {
        btn.addEventListener("click", function () {
            var id = btn.getAttribute("data-id");
            if (confirm("Do you want to delete this student?")) {
                window.location.href = "modules/student_delete.php?id=" + encodeURIComponent(id);
            }
        });
    });
});