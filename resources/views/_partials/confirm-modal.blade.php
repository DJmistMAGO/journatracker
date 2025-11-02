<div class="modal fade show" id="confirmModal" tabindex="-1" data-bs-backdrop="static" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header" id="confirmModalHeader">
                <h5 class="modal-title text-white" id="confirmModalTitle"></h5>
                <button type="button" class="btn-close btn-text-white" data-bs-dismiss="modal"></button>
            </div>
            <div class="modal-body" id="confirmModalBody"></div>
            <div class="modal-footer">
                <button type="button" class="btn btn-outline-secondary" data-bs-dismiss="modal">Cancel</button>
                <form id="confirmModalForm" method="POST" class="d-inline">
					@method('POST')
                    @csrf
                    <input type="hidden" name="_method" id="confirmModalMethod">
                    <button type="submit" id="confirmModalBtn" class="btn"></button>
                </form>
            </div>
        </div>
    </div>
</div>
