@extends('layouts/contentNavbarLayout')

@section('title', 'SPJ | Publication Management')

@section('vendor-script')
    <script src="{{ asset('assets/vendor/libs/masonry/masonry.js') }}"></script>
@endsection

@section('content')
    <h4 class="py-3 mb-4"><span class="text-muted fw-light">SPJ /</span> Publication Management</h4>

    <div class="card">
        <h5 class="card-header">Publication List</h5>
        <div class="table-responsive">
            <table class="table">
                <thead>
                    <tr>
                        <th>Title</th>
                        <th>Type</th>
                        <th>Author</th>
                        <th>Date Created</th>
                        <th>Status</th>
                        <th>Manage</th>
                    </tr>
                </thead>
                <tbody class="table-border-bottom-0">
                    @foreach ($items as $item)
                        <tr>
                            <td>{{ $item['title'] }}</td>
                            <td>{{ $item['type'] }}</td>
                            <td>{{ $item['author'] }}</td>
                            <td>{{ $item['date'] }}</td>
                            <td><span class="badge bg-label-primary">{{ $item['status'] }}</span></td>
                            <td>
                                <!-- Manage button/modal goes here -->
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>

    <!-- Modal -->
    <div class="modal fade" id="statusModal" tabindex="-1" aria-hidden="true">
        <div class="modal-dialog modal-lg modal-dialog-centered">
            <div class="modal-content">
                <form method="POST" action="">
                    @csrf
                    @method('PATCH')

                    <div class="modal-header">
                        <h5 class="modal-title">Update Publication Status</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                    </div>

                    <div class="modal-body">
                        <input type="hidden" name="id" id="modalItemId">

                        <p><strong>Title:</strong> <span id="modalItemTitle"></span></p>

                        <!-- Status Select -->
                        <div class="mb-3">
                            <label for="status" class="form-label">Select Status</label>
                            <select class="form-select" name="status" id="statusSelect" required>
                                <option value="">-- Select --</option>
                                <option value="publish">Publish</option>
                                <option value="revision">Revision</option>
                                <option value="declined">Declined</option>
                            </select>
                        </div>

                        <!-- Date (only for publish) -->
                        <div class="mb-3 d-none" id="publishDateField">
                            <label for="publish_date" class="form-label">Publication Date</label>
                            <input type="date" class="form-control" name="publish_date" id="publish_date">
                        </div>

                        <!-- Remarks (for revision or declined) -->
                        <div class="mb-3 d-none" id="remarksField">
                            <label for="remarks" class="form-label">Remarks</label>
                            <textarea class="form-control" name="remarks" id="remarks" rows="3"></textarea>
                        </div>
                    </div>

                    <div class="modal-footer">
                        <button type="button" class="btn btn-outline-secondary" data-bs-dismiss="modal">Cancel</button>
                        <button type="submit" class="btn btn-primary">Save Status</button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <!-- Scripts -->
    <script>
        const statusSelect = document.getElementById('statusSelect');
        const publishDateField = document.getElementById('publishDateField');
        const remarksField = document.getElementById('remarksField');

        // Toggle fields based on status
        statusSelect.addEventListener('change', function() {
            publishDateField.classList.add('d-none');
            remarksField.classList.add('d-none');

            if (this.value === 'publish') {
                publishDateField.classList.remove('d-none');
            } else if (this.value === 'revision' || this.value === 'declined') {
                remarksField.classList.remove('d-none');
            }
        });

        // Fill modal with item data
        const statusModal = document.getElementById('statusModal');
        statusModal.addEventListener('show.bs.modal', function(event) {
            const button = event.relatedTarget;
            const id = button.getAttribute('data-id');
            const title = button.getAttribute('data-title');
            const status = button.getAttribute('data-status');

            document.getElementById('modalItemId').value = id;
            document.getElementById('modalItemTitle').innerText = title;
            statusSelect.value = status ?? '';
            statusSelect.dispatchEvent(new Event('change'));
        });
    </script>
@endsection
