@extends('layouts.app')

@section('content')
<style>
    * {
        margin: 0;
        padding: 0;
        box-sizing: border-box;
    }

    body {
        font-family: 'Montserrat', sans-serif;
        line-height: 1.6;
        color: #333;
        background-color: white;
        margin: 0;
        padding: 0;
    }

    .container {
        max-width: 1200px;
        margin: 0 auto;
        padding: 0 20px;
    }

    /* Hero Section with Gradient */
    .profile-header {
        height: 300px;
        background: linear-gradient(135deg, #927c84ff 0%, #828273ff 50%, #a0b5beff 100%);
        position: relative;
        display: flex;
        align-items: flex-end;
        padding: 40px;
        width: 100%;
    }

    .profile-info {
        display: flex;
        align-items: center;
        gap: 20px;
        color: white;
    }

    .profile-avatar {
        width: 80px;
        height: 80px;
        border-radius: 50%;
        background: white;
        overflow: hidden;
        border: 4px solid white;
        box-shadow: 0 4px 12px rgba(0, 0, 0, 0.15);
    }

    .profile-avatar img {
        width: 100%;
        height: 100%;
        object-fit: cover;
    }

    .profile-details h1 {
        font-size: 28px;
        font-weight: 600;
        margin-bottom: 5px;
        text-shadow: 0 2px 4px rgba(0, 0, 0, 0.1);
    }

    .profile-email {
        font-size: 16px;
        opacity: 0.9;
    }

    /* Content Area */
    .tab-content {
        max-width: 900px;
        margin: 0 auto;
        padding: 40px;
        background: white;
    }

    .content-section h2 {
        font-size: 24px;
        font-weight: 600;
        color: #1f2937;
        margin-bottom: 8px;
    }

    .content-section p {
        color: #6b7280;
        margin-bottom: 30px;
        font-size: 14px;
    }

    /* Form Styles */
    .form-section {
        margin-bottom: 30px;
    }

    .radio-group {
        display: flex;
        gap: 20px;
        margin-bottom: 25px;
    }

    .radio-option {
        display: flex;
        align-items: center;
        gap: 8px;
        cursor: pointer;
    }

    .radio-option input[type="radio"] {
        width: 18px;
        height: 18px;
        cursor: pointer;
        accent-color: #3b82f6;
    }

    .radio-option label {
        font-size: 14px;
        color: #374151;
        cursor: pointer;
        font-weight: 500;
    }

    .form-row {
        display: flex;
        margin-left: px;
        gap: 20px
    }

    .form-group {
        flex: 1;
        margin-bottom: 20px;
    }

    .form-label {
        display: block;
        font-size: 14px;
        font-weight: 500;
        color: #374151;
        margin-bottom: 8px;
    }

    .form-input {
        width: 100%;
        padding: 12px 16px;
        border: 1px solid #d1d5db;
        border-radius: 8px;
        font-size: 14px;
        background: white;
        transition: all 0.2s;
    }

    .form-input:focus {
        outline: none;
        border-color: #3b82f6;
        box-shadow: 0 0 0 3px rgba(59, 130, 246, 0.1);
    }

    .form-select {
        width: 100%;
        padding: 12px 16px;
        border: 1px solid #d1d5db;
        border-radius: 8px;
        font-size: 14px;
        background: white;
        cursor: pointer;
        appearance: none;
        background-image: url("data:image/svg+xml,%3Csvg width='12' height='8' viewBox='0 0 12 8' fill='none' xmlns='http://www.w3.org/2000/svg'%3E%3Cpath d='M1 1.5L6 6.5L11 1.5' stroke='%236B7280' stroke-width='1.5' stroke-linecap='round' stroke-linejoin='round'/%3E%3C/svg%3E");
        background-repeat: no-repeat;
        background-position: right 16px center;
        padding-right: 50px;
    }

    .verified-icon {
        width: 16px;
        height: 16px;
        fill: #10b981;
    }

    .delete-btn {
        position: absolute;
        right: 10px;
        top: 50%;
        transform: translateY(-50%);
        background: none;
        border: none;
        color: #9ca3af;
        cursor: pointer;
        padding: 5px;
        border-radius: 4px;
        transition: color 0.2s;
    }

    .delete-btn:hover {
        color: #ef4444;
    }

    .date-input-wrapper {
        position: relative;
    }

    .form-actions {
        display: flex;
        gap: 15px;
        margin-top: 40px;
        justify-content: flex-end;
    }

    .btn {
        padding: 12px 24px;
        border-radius: 8px;
        font-size: 14px;
        font-weight: 500;
        cursor: pointer;
        transition: all 0.2s;
        border: 1px solid transparent;
    }

    .btn-secondary {
        background: #f9fafb;
        color: #374151;
        border-color: #d1d5db;
    }

    .btn-secondary:hover {
        background: #f3f4f6;
        border-color: #9ca3af;
    }

    .btn-primary {
        background: #ff6b6b;
        color: white;
        border-color: #ff6b6b;
    }

    .btn-primary:hover {
        background: #ff6b6b;
        border-color: #ff6b6b;
    }

    /* Password Form Styles for demonstration */
    .password-form {
        display: none;
    }

    .password-form.active {
        display: block;
    }

    .password-input-group {
        margin-bottom: 20px;
    }

    .password-help {
        font-size: 12px;
        color: #6b7280;
        margin-top: 5px;
    }

    /* Responsive Styles */
    @media (max-width: 1024px) {
        .container {
            padding: 0 15px;
        }
        
        .profile-header {
            padding: 35px 25px;
        }
        
        .tab-content {
            padding: 35px 25px;
        }
    }

    @media (max-width: 768px) {
        .profile-header {
            padding: 30px 20px;
            height: 250px;
        }

        .tab-content {
            padding: 30px 20px;
        }

        .form-row {
            flex-direction: column;
            gap: 0;
        }

        .form-actions {
            flex-direction: column-reverse;
        }
        
        .profile-details h1 {
            font-size: 24px;
        }
        
        .profile-email {
            font-size: 15px;
        }
        
        .content-section h2 {
            font-size: 22px;
        }
    }

    @media (max-width: 640px) {
        .profile-header {
            padding: 25px 15px;
            height: 220px;
        }

        .profile-info {
            gap: 15px;
        }

        .profile-avatar {
            width: 70px;
            height: 70px;
        }

        .profile-details h1 {
            font-size: 22px;
        }

        .profile-email {
            font-size: 14px;
        }

        .tab-content {
            padding: 25px 15px;
        }

        .content-section h2 {
            font-size: 20px;
        }

        .radio-group {
            gap: 15px;
        }

        .btn {
            width: 100%;
            margin-bottom: 10px;
        }

        .form-actions {
            gap: 10px;
        }
    }

    @media (max-width: 480px) {
        .profile-header {
            padding: 20px 15px;
            height: 200px;
        }

        .profile-avatar {
            width: 60px;
            height: 60px;
        }

        .profile-details h1 {
            font-size: 20px;
        }

        .profile-email {
            font-size: 13px;
        }

        .tab-content {
            padding: 20px 15px;
        }

        .content-section h2 {
            font-size: 18px;
        }

        .form-input, .form-select {
            padding: 10px 12px;
            font-size: 16px;
        }

        .form-select {
            padding-right: 40px;
        }

        .radio-group {
            flex-wrap: wrap;
            gap: 10px;
        }

        .btn {
            padding: 14px 20px;
            font-size: 16px;
        }

        .form-actions {
            margin-top: 30px;
        }
    }

    @media (max-width: 360px) {
        .container {
            padding: 0 10px;
        }

        .profile-header {
            padding: 15px 10px;
            height: 180px;
        }

        .profile-info {
            gap: 12px;
        }

        .profile-avatar {
            width: 50px;
            height: 50px;
        }

        .profile-details h1 {
            font-size: 18px;
        }

        .profile-email {
            font-size: 12px;
        }

        .tab-content {
            padding: 15px 10px;
        }

        .content-section h2 {
            font-size: 16px;
        }

        .form-input, .form-select {
            padding: 8px 10px;
        }

        .btn {
            padding: 12px 16px;
            font-size: 14px;
        }
    }
</style>

<div class="profile-container">
    <!-- Header with Gradient Background -->
    <div class="profile-header">
        <div class="profile-info">
            <div class="profile-avatar">
                <img src="data:image/svg+xml,%3Csvg width='80' height='80' viewBox='0 0 80 80' fill='none' xmlns='http://www.w3.org/2000/svg'%3E%3Ccircle cx='40' cy='40' r='40' fill='%23e2e8f0'/%3E%3Ccircle cx='40' cy='30' r='12' fill='%236b7280'/%3E%3Cpath d='M20 65c0-11 9-20 20-20s20 9 20 20' fill='%236b7280'/%3E%3C/svg%3E" alt="Profile">
            </div>
            <div class="profile-details">
                <h1>Username</h1>
                <div class="profile-email">firman6@mail.com</div>
            </div>
        </div>
    </div>

    <!-- Tab Content -->
    <div class="tab-content">
        <!-- Personal Information Form (Default Active) -->
        <div class="content-section personal-info active">
            <h2>Profile</h2>

            <div class="radio-group">
                <div class="radio-option">
                    <input type="radio" id="male" name="gender" value="male">
                    <label for="male">Male</label>
                </div>
                <div class="radio-option">
                    <input type="radio" id="female" name="gender" value="female">
                    <label for="female">Female</label>
                </div>
            </div>

            <form class="personal-form">
                <div class="form-row">
                    <div class="form-group">
                        <label class="form-label" for="firstName">Name</label>
                        <input type="text" id="firstName" class="form-input" value="Roland">
                    </div>
                    <div class="form-group">
                        <label class="form-label" for="email">Email</label>
                        <input type="email" id="email" class="form-input">
                    </div>
                </div>
                <div class="form-group">
                    <label class="form-label" for="address">Address</label>
                    <input type="text" id="address" class="form-input">
                </div>

                <div class="form-row">
                    <div class="form-group">
                        <label class="form-label" for="phone">Phone Number</label>
                        <input type="number" id="phone" class="form-input">
                    </div>
                    <div class="form-group">

                        <label class="form-label" for="dob">Date of Birth</label>
                        <div class="date-input-wrapper">
                            <input type="date" id="dob" class="form-input">
                        </div>
                    </div>
                </div>

                <div class="form-row">
                    <div class="form-group">
                        <label class="form-label" for="location">Location</label>
                        <select id="location" class="form-select">
                            <option value="atlanta">Malang</option>
                            <option value="new-york"> Surabaya</option>
                            <option value="los-angeles">Semarang</option>
                        </select>
                    </div>
                    <div class="form-group">
                        <label class="form-label" for="postalCode">Post Code</label>
                        <input type="text" id="postalCode" class="form-input" value="30301">
                    </div>
                </div>

                <div class="form-actions">
                    <button type="button" class="btn btn-secondary">Cancel</button>
                    <button type="submit" class="btn btn-primary">Save Changes</button>
                </div>
            </form>
        </div>

        <!-- Password Form (Hidden by default, shown when Password tab is clicked) -->
        <div class="content-section password-form">
            <h2>Password</h2>
            <p>Please enter your current password to change your password.</p>

            <form>
                <div class="form-group">
                    <label class="form-label" for="currentPassword">Current password</label>
                    <input type="password" id="currentPassword" class="form-input" placeholder="••••••••">
                </div>

                <div class="form-group">
                    <label class="form-label" for="newPassword">New password</label>
                    <input type="password" id="newPassword" class="form-input" placeholder="••••••••">
                    <div class="password-help">Your new password must be more than 8 characters.</div>
                </div>

                <div class="form-group">
                    <label class="form-label" for="confirmPassword">Confirm new password</label>
                    <input type="password" id="confirmPassword" class="form-input" placeholder="••••••••">
                </div>

                <div class="form-actions">
                    <button type="button" class="btn btn-secondary">Cancel</button>
                    <button type="submit" class="btn btn-primary">Update password</button>
                </div>
            </form>
        </div>
    </div>
</div>

<script>
    document.addEventListener('DOMContentLoaded', function() {
        // Tab switching functionality
        const tabItems = document.querySelectorAll('.tab-item');
        const personalInfo = document.querySelector('.personal-info');
        const passwordForm = document.querySelector('.password-form');

        tabItems.forEach(tab => {
            tab.addEventListener('click', function() {
                // Remove active class from all tabs
                tabItems.forEach(t => t.classList.remove('active'));
                // Add active class to clicked tab
                this.classList.add('active');

                // Handle content switching
                const tabText = this.textContent.trim();

                if (tabText.startsWith('Password')) {
                    personalInfo.style.display = 'none';
                    passwordForm.style.display = 'block';
                } else {
                    personalInfo.style.display = 'block';
                    passwordForm.style.display = 'none';
                }
            });
        });

        // Cancel buttons
        const cancelBtns = document.querySelectorAll('.btn-secondary');
        cancelBtns.forEach(btn => {
            btn.addEventListener('click', function() {
                if (confirm('Are you sure you want to cancel? Any unsaved changes will be lost.')) {
                    // Reset form or navigate away
                    const form = this.closest('form');
                    if (form) {
                        form.reset();
                    }
                }
            });
        });

        // Delete date button
        const deleteBtn = document.querySelector('.delete-btn');
        if (deleteBtn) {
            deleteBtn.addEventListener('click', function() {
                document.getElementById('birthDate').value = '';
            });
        }
    });
</script>
@endsection