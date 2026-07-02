<x-modal name="booking-modal" maxWidth="lg">
    <div class="d-flex justify-content-between align-items-start mb-3">
        <h4 class="fw-semibold text-brand-primary mb-0">Book Your Ride</h4>
        <button type="button" class="btn-close" data-modal-dismiss aria-label="Close"></button>
    </div>

    <form id="booking-form" novalidate>
        @csrf
        <div id="booking-alert"></div>

        <div class="row g-3">
            <div class="col-md-6">
                <label class="form-label">Trip Type <span class="text-danger">*</span></label>
                <select name="trip_type" class="form-select" required>
                    <option value="one_way">One Way</option>
                    <option value="round_trip">Round Trip</option>
                </select>
            </div>

            <div class="col-md-6">
                <label class="form-label">Vehicle</label>
                <select name="vehicle_id" class="form-select">
                    <option value="">-- Any Vehicle --</option>
                    @foreach ($bookingModalVehicles as $vehicle)
                        <option value="{{ $vehicle->id }}">{{ $vehicle->name }}</option>
                    @endforeach
                </select>
            </div>

            <div class="col-md-6">
                <label class="form-label">Pickup Location <span class="text-danger">*</span></label>
                <input type="text" name="pickup_location" class="form-control" required>
            </div>

            <div class="col-md-6">
                <label class="form-label">Drop Location <span class="text-danger">*</span></label>
                <input type="text" name="drop_location" class="form-control" required>
            </div>

            <div class="col-md-4">
                <label class="form-label">Journey Date <span class="text-danger">*</span></label>
                <input type="date" name="journey_date" class="form-control" required min="{{ date('Y-m-d') }}">
            </div>

            <div class="col-md-4">
                <label class="form-label">Journey Time <span class="text-danger">*</span></label>
                <input type="time" name="journey_time" class="form-control" required>
            </div>

            <div class="col-md-4 d-none" id="return-date-wrapper">
                <label class="form-label">Return Date</label>
                <input type="date" name="return_date" class="form-control" min="{{ date('Y-m-d') }}">
            </div>

            <div class="col-md-6">
                <label class="form-label">Your Name <span class="text-danger">*</span></label>
                <input type="text" name="customer_name" class="form-control" required>
            </div>

            <div class="col-md-6">
                <label class="form-label">Phone Number <span class="text-danger">*</span></label>
                <input type="text" name="phone" class="form-control" required>
            </div>

            <div class="col-md-12">
                <label class="form-label">Email</label>
                <input type="email" name="email" class="form-control">
            </div>

            <div class="col-md-12">
                <label class="form-label">Special Message</label>
                <textarea name="message" rows="2" class="form-control"></textarea>
            </div>
        </div>

        <button type="submit" class="btn btn-primary w-100 mt-4">Submit Booking Request</button>
    </form>
</x-modal>

@once
    @push('scripts')
        <script>
            document.addEventListener('DOMContentLoaded', function () {
                var tripType = document.querySelector('#booking-form select[name="trip_type"]');
                var returnWrapper = document.getElementById('return-date-wrapper');

                if (tripType) {
                    tripType.addEventListener('change', function () {
                        returnWrapper.classList.toggle('d-none', this.value !== 'round_trip');
                    });
                }
            });
        </script>
    @endpush
@endonce
