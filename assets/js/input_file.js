document.getElementById('fileInput').addEventListener('change', function () {
    var fileName = this.files[0] ? this.files[0].name : 'Tidak ada file yang dipilih';
    document.getElementById('file-name').textContent = fileName;
});
