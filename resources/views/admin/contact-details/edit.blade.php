@extends('admin.layouts.app')

@section('content_header')
    <h1>Contact Details</h1>
@stop

@section('content')
    <x-admin.flash />

    <div class="card">
        <form action="{{ route('admin.contact-details.update') }}" method="POST">
            @csrf
            @method('PUT')
            <div class="card-body">
                <div class="row">
                    <div class="col-md-6 form-group">
                        <label>Phone <span class="text-danger">*</span></label>
                        <input type="text" name="phone" value="{{ old('phone', $contactDetail->phone) }}" class="form-control @error('phone') is-invalid @enderror">
                        @error('phone') <div class="invalid-feedback">{{ $message }}</div> @enderror
                    </div>

                    <div class="col-md-6 form-group">
                        <label>Alternate Phone</label>
                        <input type="text" name="alt_phone" value="{{ old('alt_phone', $contactDetail->alt_phone) }}" class="form-control @error('alt_phone') is-invalid @enderror">
                        @error('alt_phone') <div class="invalid-feedback">{{ $message }}</div> @enderror
                    </div>

                    <div class="col-md-6 form-group">
                        <label>Email</label>
                        <input type="email" name="email" value="{{ old('email', $contactDetail->email) }}" class="form-control @error('email') is-invalid @enderror">
                        @error('email') <div class="invalid-feedback">{{ $message }}</div> @enderror
                    </div>

                    <div class="col-md-12 form-group">
                        <label>Address</label>
                        <textarea name="address" rows="2" class="form-control @error('address') is-invalid @enderror">{{ old('address', $contactDetail->address) }}</textarea>
                        @error('address') <div class="invalid-feedback">{{ $message }}</div> @enderror
                    </div>

                    <div class="col-md-4 form-group">
                        <label>Business Hours (Mon - Sat)</label>
                        <input type="text" name="business_hours[monday_saturday]" value="{{ old('business_hours.monday_saturday', $contactDetail->business_hours['monday_saturday'] ?? '') }}" class="form-control">
                    </div>

                    <div class="col-md-4 form-group">
                        <label>Business Hours (Sunday)</label>
                        <input type="text" name="business_hours[sunday]" value="{{ old('business_hours.sunday', $contactDetail->business_hours['sunday'] ?? '') }}" class="form-control">
                    </div>

                    <div class="col-md-4 form-group">
                        <label>Hours Note</label>
                        <input type="text" name="business_hours[note]" value="{{ old('business_hours.note', $contactDetail->business_hours['note'] ?? '') }}" class="form-control">
                    </div>

                    <div class="col-md-12 form-group">
                        <label>Google Map Embed (iframe code)</label>
                        <textarea name="map_iframe" rows="3" class="form-control @error('map_iframe') is-invalid @enderror">{{ old('map_iframe', $contactDetail->map_iframe) }}</textarea>
                        @error('map_iframe') <div class="invalid-feedback">{{ $message }}</div> @enderror
                    </div>
                </div>
            </div>
            <div class="card-footer">
                <button type="submit" class="btn btn-primary">Save Contact Details</button>
            </div>
        </form>
    </div>
@stop
