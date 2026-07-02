@php
    $booking = $booking ?? null;
@endphp

<div class="row">
    <div class="col-md-6 form-group">
        <label>Trip Type <span class="text-danger">*</span></label>
        <select name="trip_type" class="form-control @error('trip_type') is-invalid @enderror" required>
            <option value="one_way" @selected(old('trip_type', $booking?->trip_type) === 'one_way')>One Way</option>
            <option value="round_trip" @selected(old('trip_type', $booking?->trip_type) === 'round_trip')>Round Trip</option>
        </select>
        @error('trip_type') <div class="invalid-feedback">{{ $message }}</div> @enderror
    </div>

    <div class="col-md-6 form-group">
        <label>Vehicle</label>
        <select name="vehicle_id" class="form-control @error('vehicle_id') is-invalid @enderror">
            <option value="">-- Not Assigned --</option>
            @foreach ($vehicles as $vehicle)
                <option value="{{ $vehicle->id }}" @selected((string) old('vehicle_id', $booking?->vehicle_id) === (string) $vehicle->id)>{{ $vehicle->name }}</option>
            @endforeach
        </select>
        @error('vehicle_id') <div class="invalid-feedback">{{ $message }}</div> @enderror
    </div>

    <div class="col-md-6 form-group">
        <label>Pickup Location <span class="text-danger">*</span></label>
        <input type="text" name="pickup_location" value="{{ old('pickup_location', $booking?->pickup_location) }}" class="form-control @error('pickup_location') is-invalid @enderror" required>
        @error('pickup_location') <div class="invalid-feedback">{{ $message }}</div> @enderror
    </div>

    <div class="col-md-6 form-group">
        <label>Drop Location <span class="text-danger">*</span></label>
        <input type="text" name="drop_location" value="{{ old('drop_location', $booking?->drop_location) }}" class="form-control @error('drop_location') is-invalid @enderror" required>
        @error('drop_location') <div class="invalid-feedback">{{ $message }}</div> @enderror
    </div>

    <div class="col-md-4 form-group">
        <label>Journey Date <span class="text-danger">*</span></label>
        <input type="date" name="journey_date" value="{{ old('journey_date', $booking?->journey_date?->format('Y-m-d')) }}" class="form-control @error('journey_date') is-invalid @enderror" required>
        @error('journey_date') <div class="invalid-feedback">{{ $message }}</div> @enderror
    </div>

    <div class="col-md-4 form-group">
        <label>Journey Time <span class="text-danger">*</span></label>
        <input type="time" name="journey_time" value="{{ old('journey_time', $booking?->journey_time ? \Illuminate\Support\Carbon::parse($booking->journey_time)->format('H:i') : '') }}" class="form-control @error('journey_time') is-invalid @enderror" required>
        @error('journey_time') <div class="invalid-feedback">{{ $message }}</div> @enderror
    </div>

    <div class="col-md-4 form-group">
        <label>Return Date</label>
        <input type="date" name="return_date" value="{{ old('return_date', $booking?->return_date?->format('Y-m-d')) }}" class="form-control @error('return_date') is-invalid @enderror">
        @error('return_date') <div class="invalid-feedback">{{ $message }}</div> @enderror
    </div>

    <div class="col-md-4 form-group">
        <label>Customer Name <span class="text-danger">*</span></label>
        <input type="text" name="customer_name" value="{{ old('customer_name', $booking?->customer_name) }}" class="form-control @error('customer_name') is-invalid @enderror" required>
        @error('customer_name') <div class="invalid-feedback">{{ $message }}</div> @enderror
    </div>

    <div class="col-md-4 form-group">
        <label>Phone <span class="text-danger">*</span></label>
        <input type="text" name="phone" value="{{ old('phone', $booking?->phone) }}" class="form-control @error('phone') is-invalid @enderror" required>
        @error('phone') <div class="invalid-feedback">{{ $message }}</div> @enderror
    </div>

    <div class="col-md-4 form-group">
        <label>Email</label>
        <input type="email" name="email" value="{{ old('email', $booking?->email) }}" class="form-control @error('email') is-invalid @enderror">
        @error('email') <div class="invalid-feedback">{{ $message }}</div> @enderror
    </div>

    <div class="col-md-6 form-group">
        <label>Status <span class="text-danger">*</span></label>
        <select name="status" class="form-control @error('status') is-invalid @enderror" required>
            @foreach (['new', 'pending', 'confirmed', 'completed', 'cancelled'] as $status)
                <option value="{{ $status }}" @selected(old('status', $booking?->status ?? 'new') === $status)>{{ ucfirst($status) }}</option>
            @endforeach
        </select>
        @error('status') <div class="invalid-feedback">{{ $message }}</div> @enderror
    </div>

    <div class="col-md-12 form-group">
        <label>Special Message</label>
        <textarea name="message" rows="3" class="form-control @error('message') is-invalid @enderror">{{ old('message', $booking?->message) }}</textarea>
        @error('message') <div class="invalid-feedback">{{ $message }}</div> @enderror
    </div>
</div>
