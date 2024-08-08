document.addEventListener('DOMContentLoaded', function () {
    const deleteButtons = document.querySelectorAll('.nav-logout');

    deleteButtons.forEach(button => {
        button.addEventListener('click', function (event) {
            event.preventDefault(); // Prevent the default action (navigation)

            Swal.fire({
                title: 'Apakah anda yakin ingin logout?',
                icon: 'warning',
                showCancelButton: true,
                confirmButtonText: 'Ya, Logout',
                cancelButtonText: 'Tidak',
                reverseButtons: true,
                customClass: {
                    confirmButton: 'swal2-confirm',
                    // cancelButton: 'swal2-cancel'
                }
            }).then((result) => {
                if (result.isConfirmed) {
                    window.location.href = this.href; // Proceed to the link's href if confirmed twice
                }
            });
        });
    });
});
