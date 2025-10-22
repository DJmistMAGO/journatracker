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

            // ✅ Reset previous modal states
            modalHeader.className = 'modal-header'; // remove all color classes first
            modalBtn.className = 'btn'; // reset button style
            modalMethod.value = ''; // reset method
            modalBody.innerHTML = ''; // clear old body

            // ✅ Apply header color
            if (headerClass) {
                modalHeader.classList.add(...headerClass.split(' '));
            }

            // ✅ Apply form action
            modalForm.setAttribute('action', actionUrl);

            // ✅ Define default modal values
            let title = 'Confirm Action';
            let body = '';
            let btnText = 'Confirm';
            let btnClass = 'btn btn-primary';
            let method = '';

            switch (type) {
                case 'reset':
                    title = 'Confirm Reset Password';
                    body = `Are you sure you want to reset the password for <strong>${username}</strong>?`;
                    btnText = 'Yes, Reset';
                    btnClass = 'btn btn-warning';
                    method = 'PATCH';
                    break;

                case 'delete':
                    title = 'Confirm Delete';
                    body = `This will <strong>permanently delete</strong> user <strong>${username}</strong>. Are you sure?`;
                    btnText = 'Yes, Delete';
                    btnClass = 'btn btn-danger';
                    method = 'DELETE';
                    break;
            }

            modalMethod.value = method || 'POST';

            // ✅ Apply modal values
            modalTitle.textContent = title;
            modalBody.innerHTML = body;
            modalBtn.textContent = btnText;
            modalBtn.className = btnClass + ' rounded-pill px-3';
            modalMethod.value = method;

            // ✅ Show modal
            confirmModal.show();
        });
    });
});
