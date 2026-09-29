@extends('layouts.admin')

@section('page_title', 'Users')
@section('page_subtitle', 'Manage the signed-in administrator account.')

@section('content')
<div class="admin-grid two">
    <section class="admin-card">
        <h2>Current User</h2>
        <p><strong>{{ auth()->user()->name }}</strong></p>
        <p class="muted">{{ auth()->user()->email }}</p>
    </section>

    <form method="post" action="{{ route('admin.users.password') }}" class="form-card">
        @csrf @method('put')
        <section class="form-section">
            <h2>Change Password</h2>
            <p class="help">Use a strong password and store it securely.</p>
            <label>Current Password
                <input type="password" name="current_password" required>
                @error('current_password')<span class="field-error">{{ $message }}</span>@enderror
            </label>
            <label>New Password
                <input type="password" name="password" required>
                @error('password')<span class="field-error">{{ $message }}</span>@enderror
            </label>
            <label>Confirm New Password
                <input type="password" name="password_confirmation" required>
            </label>
        </section>
        <div class="form-actions">
            <button class="btn" type="submit">Change Password</button>
        </div>
    </form>
</div>
@endsection
