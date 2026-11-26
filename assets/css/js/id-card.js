var barcode = document.getElementById('barcode');
if (barcode) {
    JsBarcode('#barcode', barcode.dataset.code, {
        format: 'CODE128',
        displayValue: false,
        height: 26,
        width: 1.2,
        margin: 0
    });
}

document.querySelectorAll('.btn-download').forEach(function (btn) {
    btn.addEventListener('click', function () {
        var el = document.getElementById(btn.dataset.target);
        html2canvas(el, { scale: 3 }).then(function (canvas) {
            var link = document.createElement('a');
            link.download = btn.dataset.file;
            link.href = canvas.toDataURL('image/png');
            link.click();
        });
    });
});

var printBtn = document.getElementById('btn-print');
if (printBtn) {
    printBtn.addEventListener('click', function () {
        window.print();
    });
}