@extends('admin.layouts.app')

@section('content_header')
    <h1>Website Settings</h1>
@stop

@section('content')
    <x-admin.flash />

    <div class="card">
        <form action="{{ route('admin.settings.update') }}" method="POST" enctype="multipart/form-data">
            @csrf
            @method('PUT')
            <div class="card-body">
                <h5 class="mb-3">General</h5>
                <div class="row">
                    <div class="col-md-6 form-group">
                        <label>Site Name <span class="text-danger">*</span></label>
                        <input type="text" name="site_name" value="{{ old('site_name', $settings['site_name']) }}" class="form-control @error('site_name') is-invalid @enderror" required>
                        @error('site_name') <div class="invalid-feedback">{{ $message }}</div> @enderror
                    </div>

                    <div class="col-md-6 form-group">
                        <label>Tagline</label>
                        <input type="text" name="site_tagline" value="{{ old('site_tagline', $settings['site_tagline']) }}" class="form-control @error('site_tagline') is-invalid @enderror">
                        @error('site_tagline') <div class="invalid-feedback">{{ $message }}</div> @enderror
                    </div>

                    <div class="col-md-6">
                        <x-admin.image-input name="site_logo" label="Site Logo" :current="null" />
                        @if ($settings['site_logo_url'])
                            <img src="{{ $settings['site_logo_url'] }}" class="img-thumbnail mt-1" style="max-height: 60px;">
                        @endif
                    </div>

                    <div class="col-md-6">
                        <x-admin.image-input name="site_favicon" label="Favicon" :current="null" />
                        @if ($settings['site_favicon_url'])
                            <img src="{{ $settings['site_favicon_url'] }}" class="img-thumbnail mt-1" style="max-height: 40px;">
                        @endif
                    </div>
                </div>

                <hr>
                <h5 class="mb-3">Contact & Notifications</h5>
                <div class="row">
                    <div class="col-md-4 form-group">
                        <label>WhatsApp Number</label>
                        <input type="text" name="whatsapp_number" value="{{ old('whatsapp_number', $settings['whatsapp_number']) }}" class="form-control @error('whatsapp_number') is-invalid @enderror" placeholder="+91XXXXXXXXXX">
                        @error('whatsapp_number') <div class="invalid-feedback">{{ $message }}</div> @enderror
                    </div>

                    <div class="col-md-4 form-group">
                        <label>Primary Phone</label>
                        <input type="text" name="primary_phone" value="{{ old('primary_phone', $settings['primary_phone']) }}" class="form-control @error('primary_phone') is-invalid @enderror">
                        @error('primary_phone') <div class="invalid-feedback">{{ $message }}</div> @enderror
                    </div>

                    <div class="col-md-4 form-group">
                        <label>Admin Notification Email</label>
                        <input type="email" name="admin_notification_email" value="{{ old('admin_notification_email', $settings['admin_notification_email']) }}" class="form-control @error('admin_notification_email') is-invalid @enderror">
                        @error('admin_notification_email') <div class="invalid-feedback">{{ $message }}</div> @enderror
                        <small class="text-muted">New booking/enquiry notifications are sent here.</small>
                    </div>
                </div>

                <hr>
                <h5 class="mb-3">Social Links</h5>
                <div class="row">
                    <div class="col-md-3 form-group">
                        <label>Facebook URL</label>
                        <input type="text" name="facebook_url" value="{{ old('facebook_url', $settings['facebook_url']) }}" class="form-control @error('facebook_url') is-invalid @enderror">
                        @error('facebook_url') <div class="invalid-feedback">{{ $message }}</div> @enderror
                    </div>
                    <div class="col-md-3 form-group">
                        <label>Instagram URL</label>
                        <input type="text" name="instagram_url" value="{{ old('instagram_url', $settings['instagram_url']) }}" class="form-control @error('instagram_url') is-invalid @enderror">
                        @error('instagram_url') <div class="invalid-feedback">{{ $message }}</div> @enderror
                    </div>
                    <div class="col-md-3 form-group">
                        <label>Twitter / X URL</label>
                        <input type="text" name="twitter_url" value="{{ old('twitter_url', $settings['twitter_url']) }}" class="form-control @error('twitter_url') is-invalid @enderror">
                        @error('twitter_url') <div class="invalid-feedback">{{ $message }}</div> @enderror
                    </div>
                    <div class="col-md-3 form-group">
                        <label>YouTube URL</label>
                        <input type="text" name="youtube_url" value="{{ old('youtube_url', $settings['youtube_url']) }}" class="form-control @error('youtube_url') is-invalid @enderror">
                        @error('youtube_url') <div class="invalid-feedback">{{ $message }}</div> @enderror
                    </div>
                </div>

                <hr>
                <h5 class="mb-3">Footer</h5>
                <div class="row">
                    <div class="col-md-12 form-group">
                        <label>Footer About Text</label>
                        <textarea name="footer_about" rows="3" class="form-control @error('footer_about') is-invalid @enderror">{{ old('footer_about', $settings['footer_about']) }}</textarea>
                        @error('footer_about') <div class="invalid-feedback">{{ $message }}</div> @enderror
                    </div>
                    <div class="col-md-12 form-group">
                        <label>Footer Copyright Text</label>
                        <input type="text" name="footer_copyright" value="{{ old('footer_copyright', $settings['footer_copyright']) }}" class="form-control @error('footer_copyright') is-invalid @enderror">
                        @error('footer_copyright') <div class="invalid-feedback">{{ $message }}</div> @enderror
                    </div>
                </div>

                <hr>
                <h5 class="mb-3">Default SEO</h5>
                <div class="row">
                    <div class="col-md-6 form-group">
                        <label>Default Meta Title</label>
                        <input type="text" name="meta_title" value="{{ old('meta_title', $settings['meta_title']) }}" class="form-control @error('meta_title') is-invalid @enderror">
                        @error('meta_title') <div class="invalid-feedback">{{ $message }}</div> @enderror
                    </div>
                    <div class="col-md-6 form-group">
                        <label>Default Meta Keywords</label>
                        <input type="text" name="meta_keywords" value="{{ old('meta_keywords', $settings['meta_keywords']) }}" class="form-control @error('meta_keywords') is-invalid @enderror">
                        @error('meta_keywords') <div class="invalid-feedback">{{ $message }}</div> @enderror
                    </div>
                    <div class="col-md-12 form-group">
                        <label>Default Meta Description</label>
                        <textarea name="meta_description" rows="2" maxlength="500" class="form-control @error('meta_description') is-invalid @enderror">{{ old('meta_description', $settings['meta_description']) }}</textarea>
                        @error('meta_description') <div class="invalid-feedback">{{ $message }}</div> @enderror
                    </div>
                </div>
            </div>
            <div class="card-footer">
                <button type="submit" class="btn btn-primary">Save Settings</button>
            </div>
        </form>
    </div>
@stop
