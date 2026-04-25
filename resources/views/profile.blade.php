@extends('layouts.app')

@section('content')
<div class="container py-5">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <h2 class="mb-4 fw-bold">Profile Settings</h2>

            <!-- Public Info & Preferences -->
            <div class="card border-0 shadow-sm mb-4 rounded-4 overflow-hidden">
                <div class="card-header bg-white border-bottom py-3">
                    <h5 class="mb-0 fw-bold">Public Info & Preferences</h5>
                </div>
                <div class="card-body p-4">
                    <form method="POST" action="{{ route('profile.update') }}" enctype="multipart/form-data">
                        @csrf
                        
                        <div class="mb-4 d-flex align-items-center gap-4">
                            <div>
                                @if (auth()->user()->avatar)
                                    @if(str_starts_with(auth()->user()->avatar, 'http'))
                                        <img src="{{ auth()->user()->avatar }}" alt="Avatar" class="rounded-circle object-fit-cover shadow-sm" width="80" height="80">
                                    @else
                                        <img src="{{ asset('storage/' . auth()->user()->avatar) }}" alt="Avatar" class="rounded-circle object-fit-cover shadow-sm" width="80" height="80">
                                    @endif
                                @else
                                    <div class="rounded-circle bg-light d-flex align-items-center justify-content-center text-muted shadow-sm" style="width: 80px; height: 80px;">
                                        <i class="bi bi-person fs-1"></i>
                                    </div>
                                @endif
                            </div>
                            <div class="flex-grow-1">
                                <label for="avatar" class="form-label fw-medium">Profile Picture</label>
                                <input type="file" class="form-control @error('avatar') is-invalid @enderror" id="avatar" name="avatar" accept="image/*">
                                @error('avatar')<div class="invalid-feedback">{{ $message }}</div>@enderror
                            </div>
                        </div>

                        <div class="mb-3">
                            <label for="name" class="form-label fw-medium">Name</label>
                            <input type="text" class="form-control @error('name') is-invalid @enderror" id="name" name="name" value="{{ old('name', auth()->user()->name) }}" required>
                            @error('name')<div class="invalid-feedback">{{ $message }}</div>@enderror
                        </div>

                        <div class="mb-4">
                            <label for="bio" class="form-label fw-medium">Bio</label>
                            <textarea class="form-control @error('bio') is-invalid @enderror" id="bio" name="bio" rows="3">{{ old('bio', auth()->user()->bio) }}</textarea>
                            @error('bio')<div class="invalid-feedback">{{ $message }}</div>@enderror
                        </div>

                        <div class="mb-4">
                            <div class="form-check form-switch">
                                <input class="form-check-input" type="checkbox" role="switch" id="skip_delete_confirm" name="skip_delete_confirm" {{ auth()->user()->skip_delete_confirm ? 'checked' : '' }}>
                                <label class="form-check-label ms-2" for="skip_delete_confirm">
                                    <strong>Skip Delete Confirmations</strong><br>
                                    <small class="text-muted">If enabled, deleting your recipes will happen immediately without asking for confirmation.</small>
                                </label>
                            </div>
                        </div>

                        <button type="submit" class="btn btn-primary fw-bold">Save Settings</button>
                    </form>
                </div>
            </div>

            <!-- Password Change -->
            <div class="card border-0 shadow-sm rounded-4 overflow-hidden">
                <div class="card-header bg-white border-bottom py-3">
                    <h5 class="mb-0 fw-bold">Change Password</h5>
                </div>
                <div class="card-body p-4">
                    @if(auth()->user()->google_id && !auth()->user()->password)
                        <div class="alert alert-info border-0 rounded-3">
                            <i class="bi bi-info-circle me-2"></i> You signed in with Google, so you don't have a password set to change.
                        </div>
                    @else
                        <form method="POST" action="{{ route('profile.password') }}">
                            @csrf
                            
                            <div class="mb-3">
                                <label for="current_password" class="form-label fw-medium">Current Password</label>
                                <input type="password" class="form-control @error('current_password') is-invalid @enderror" id="current_password" name="current_password" required>
                                @error('current_password')<div class="invalid-feedback">{{ $message }}</div>@enderror
                            </div>

                            <div class="mb-3">
                                <label for="password" class="form-label fw-medium">New Password</label>
                                <input type="password" class="form-control @error('password') is-invalid @enderror" id="password" name="password" required>
                                @error('password')<div class="invalid-feedback">{{ $message }}</div>@enderror
                            </div>

                            <div class="mb-4">
                                <label for="password_confirmation" class="form-label fw-medium">Confirm New Password</label>
                                <input type="password" class="form-control" id="password_confirmation" name="password_confirmation" required>
                            </div>

                            <button type="submit" class="btn btn-secondary fw-bold">Update Password</button>
                        </form>
                    @endif
                </div>
            </div>

        </div>
    </div>
</div>
@endsection
