<x-modal name="enquiry-modal" maxWidth="md">
    <div class="d-flex justify-content-between align-items-start mb-3">
        <h4 class="fw-semibold text-brand-primary mb-0">Send an Enquiry</h4>
        <button type="button" class="btn-close" data-modal-dismiss aria-label="Close"></button>
    </div>

    <form id="enquiry-form" novalidate>
        @csrf
        <div id="enquiry-alert"></div>

        <div class="mb-3">
            <label class="form-label">Name <span class="text-danger">*</span></label>
            <input type="text" name="name" class="form-control" required>
        </div>

        <div class="mb-3">
            <label class="form-label">Phone <span class="text-danger">*</span></label>
            <input type="text" name="phone" class="form-control" required>
        </div>

        <div class="mb-3">
            <label class="form-label">Email</label>
            <input type="email" name="email" class="form-control">
        </div>

        <div class="mb-3">
            <label class="form-label">Message</label>
            <textarea name="message" rows="3" class="form-control"></textarea>
        </div>

        <button type="submit" class="btn btn-primary w-100">Send Enquiry</button>
    </form>
</x-modal>
