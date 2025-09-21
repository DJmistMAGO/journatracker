document.addEventListener('DOMContentLoaded', function () {
    const confirmModal = new bootstrap.Modal(document.getElementById('confirmModal'));
    const modalHeader = document.getElementById('confirmModalHeader');
    const modalTitle = document.getElementById('confirmModalTitle');
    const modalBody = document.getElementById('confirmModalBody');
    const modalBtn = document.getElementById('confirmModalBtn');
    const modalForm = document.getElementById('confirmModalForm');
    const modalMethod = document.getElementById('confirmModalMethod');

    document.querySelectorAll('.confirm-action').forEach(button => {
        button.addEventListener('click', function () {
            const actionUrl = this.getAttribute('data-action');
            const type = this.getAttribute('data-type');
            const username = this.getAttribute('data-username');
            const headerClass = this.getAttribute('data-header');

            modalHeader.className = 'modal-header ' + headerClass;

            modalForm.setAttribute('action', actionUrl);

            if (type === 'reset') {
                modalTitle.textContent = 'Confirm Reset Password';
                modalBody.innerHTML = `Are you sure you want to reset the password for <strong>${username}</strong>?`;
                modalBtn.textContent = 'Yes, Reset';
                modalBtn.className = 'btn btn-warning';
                modalMethod.value = '';
            }

            if (type === 'delete') {
                modalTitle.textContent = 'Confirm Delete';
                modalBody.innerHTML = `This will <strong>permanently delete</strong> user <strong>${username}</strong>. Are you sure?`;
                modalBtn.textContent = 'Yes, Delete';
                modalBtn.className = 'btn btn-danger';
                modalMethod.value = 'DELETE';
            }

            confirmModal.show();
        });
    });
});
