@extends('layouts.admin')

@section('content')
<div class="role-container" style="max-width: 950px;">
    <div class="glass-card glass-card-dark">
        <!-- Header -->
        <div style="display: flex; justify-content: space-between; align-items: center; margin-bottom: 3.5rem; border-bottom: 1px solid rgba(255,255,255,0.05); padding-bottom: 1.5rem;">
            <div class="d-flex align-items-center gap-3">
                <div class="logo-vms" style="width: 44px; height: 44px; font-size: 1.2rem;">V</div>
                <div>
                    <h6 class="fw-800 mb-0 text-white text-shadow-white" style="font-size: 1.1rem;">UCB BANK</h6>
                    <span class="permission-title" style="font-size: 0.7rem; margin: 0; text-shadow-blue">VISITOR SYSTEM</span>
                </div>
            </div>
            <h2 class="fw-800 mb-0 text-white letter-spacing-1 text-shadow-white" style="font-size: 2rem;">Visitor Registration</h2>
        </div>

        <form action="{{ route('admin.visitor.registration.store') }}" method="POST" id="registrationForm">
            @csrf

            <!-- Section 1: Personal Information -->
            <div class="permission-title">Personal Information</div>
            <div class="row g-4 mb-5">
                <div class="col-md-6">
                    <label class="form-label">Full Name *</label>
                    <div class="position-relative">
                        <input type="text" name="name" class="input-dark input-custom" placeholder="Enter your full name" required>
                        <i class="fas fa-user" style="position: absolute; right: 18px; top: 45px; color: var(--accent-blue); opacity: 0.6; font-size: 0.8rem; pointer-events: none;"></i>
                    </div>
                </div>
                <div class="col-md-6">
                    <label class="form-label">Email Address *</label>
                    <div class="position-relative">
                        <input type="email" name="email" class="input-dark input-custom" placeholder="name@email.com" required>
                        <i class="fas fa-envelope" style="position: absolute; right: 18px; top: 45px; color: var(--accent-blue); opacity: 0.6; font-size: 0.8rem; pointer-events: none;"></i>
                    </div>
                </div>
                <div class="col-md-6">
                    <label class="form-label">Phone Number</label>
                    <div class="position-relative">
                        <input type="tel" name="phone" class="input-dark input-custom" placeholder="+880 1XXX-XXXXXX">
                        <i class="fas fa-phone" style="position: absolute; right: 18px; top: 45px; color: var(--accent-blue); opacity: 0.6; font-size: 0.8rem; pointer-events: none;"></i>
                    </div>
                </div>
                <div class="col-md-6">
                    <label class="form-label">Company/Organization</label>
                    <div class="position-relative">
                        <input type="text" name="company" class="input-dark input-custom" placeholder="Enter company name">
                        <i class="fas fa-building" style="position: absolute; right: 18px; top: 45px; color: var(--accent-blue); opacity: 0.6; font-size: 0.8rem; pointer-events: none;"></i>
                    </div>
                </div>
            </div>

            <!-- Section 2: Visit Details -->
            <div class="permission-title">Visit Details</div>
            <div class="row g-4 mb-5">
                <div class="col-md-6">
                    <label class="form-label">Host Name *</label>
                    <div class="position-relative">
                        <input type="text" name="host_name" class="input-dark input-custom" placeholder="Meeting with whom?" required>
                        <i class="fas fa-user-tie" style="position: absolute; right: 18px; top: 45px; color: var(--accent-blue); opacity: 0.6; font-size: 0.8rem; pointer-events: none;"></i>
                    </div>
                </div>
                <div class="col-md-6">
                    <label class="form-label">Visit Type *</label>
                    <select name="visit_type_id" class="input-dark input-custom" required>
                        <option value="" disabled selected>Select visit type</option>
                        @foreach($visitTypes as $type)
                        <option value="{{ $type->id }}">{{ $type->name }}</option>
                        @endforeach
                    </select>
                </div>
                <div class="col-md-6">
                    <label class="form-label">Purpose of Visit *</label>
                    <div class="position-relative">
                        <input type="text" name="purpose" class="input-dark input-custom" placeholder="Nature of visit" required>
                        <i class="fas fa-briefcase" style="position: absolute; right: 18px; top: 45px; color: var(--accent-blue); opacity: 0.6; font-size: 0.8rem; pointer-events: none;"></i>
                    </div>
                </div>
                <div class="col-md-6">
                    <label class="form-label">Visit Date *</label>
                    <div class="position-relative">
                        <input type="date" name="visit_date" class="input-dark input-custom" id="visitDate" required>
                    </div>
                </div>
            </div>

            <!-- Section 3: Face Authentication -->
            <div class="permission-title">Face Authentication</div>
            <div class="webcam-card" id="webcamBtn" style="background: #020617; border: 2px dashed rgba(255,255,255,0.1); border-radius: 16px; height: 240px; display: flex; flex-direction: column; align-items: center; justify-content: center; cursor: pointer; transition: 0.3s; overflow: hidden; position: relative;">
                <video id="video" autoplay playsinline style="width: 100%; height: 100%; object-fit: cover; display: none;"></video>
                <div id="webcamPlaceholder" class="text-center">
                    <i class="fa-solid fa-camera" style="font-size: 48px; color: var(--accent-blue); text-shadow: 0 0 20px var(--accent-blue), 0 0 40px var(--accent-blue); margin-bottom: 20px; transition: transform 0.4s cubic-bezier(0.175, 0.885, 0.32, 1.275);"></i>
                    <p style="color: var(--text-muted); font-size: 13px; font-weight: 500; margin: 0;">Click to activate secure face authentication</p>
                </div>
            </div>

            <!-- Terms -->
            <div class="form-check mt-4" style="display: flex; align-items: flex-start; gap: 10px;">
                <input class="form-check-input" type="checkbox" id="terms" name="terms" value="accepted" required style="margin-top: 5px; width: 20px; height: 20px; cursor: pointer;">
                <label class="form-check-label" for="terms" style="font-size: 13px; color: var(--text-muted);">
                    I agree to the <a href="#" style="color: var(--accent-blue); text-decoration: none;">visitor terms and conditions</a> and privacy policy.
                </label>
            </div>

            <!-- Actions -->
            <div class="d-flex justify-content-end gap-3 mt-5 pt-4" style="border-top: 1px solid rgba(255,255,255,0.05);">
                <a href="{{ route('admin.dashboard') }}" class="btn-outline btn-reset" style="text-decoration: none;">
                    Cancel
                </a>
                <button type="submit" class="btn-gradient btn-create" id="registerBtn">
                    <i class="fas fa-check-circle"></i> Approve
                </button>
            </div>
        </form>
    </div>
</div>

@push('scripts')
    <style>
        #webcamBtn:hover { border-color: var(--accent-blue) !important; background: #111827; }
        #webcamBtn:hover #webcamPlaceholder i { transform: scale(1.15); }
        .form-check-input { background-color: rgba(0, 0, 0, 0.3); border: 1px solid rgba(255,255,255,0.1); cursor: pointer; }
        .form-check-input:checked { background-color: var(--accent-blue); border-color: var(--accent-blue); }
    </style>

    <script>
        // Set today as min date
        document.getElementById('visitDate').min = new Date().toISOString().split('T')[0];
        document.getElementById('visitDate').valueAsDate = new Date();

        // Webcam Logic
        const webcamBtn = document.getElementById('webcamBtn');
        const video = document.getElementById('video');
        const placeholder = document.getElementById('webcamPlaceholder');
        let stream = null;

        webcamBtn.addEventListener('click', async () => {
            if (!stream) {
                try {
                    stream = await navigator.mediaDevices.getUserMedia({ video: true });
                    video.srcObject = stream;
                    video.style.display = 'block';
                    placeholder.style.display = 'none';
                    webcamBtn.style.borderStyle = 'solid';
                } catch (err) {
                    console.error("Camera access failed:", err);
                    Swal.fire({
                        title: 'Camera Access Denied',
                        text: 'Please allow camera access for face authentication.',
                        icon: 'error',
                        confirmButtonText: 'OK',
                        confirmButtonColor: '#ef4444'
                    });
                }
            }
        });

        // Form Submission
        const registrationForm = document.getElementById('registrationForm');
        registrationForm.addEventListener('submit', function(e) {
            e.preventDefault();

            if (!stream) {
                Swal.fire({
                    title: 'Face Authentication Required',
                    text: 'Please enable webcam for face authentication before submitting.',
                    icon: 'warning',
                    confirmButtonText: 'OK',
                    confirmButtonColor: '#f59e0b'
                });
                return;
            }

            const btn = document.getElementById('registerBtn');
            btn.innerHTML = '<i class="fas fa-spinner fa-spin"></i> Processing...';
            btn.disabled = true;

            // Submit form
            registrationForm.submit();
        });
    </script>

    @if(session('success'))
        <script>
            Swal.fire({
                title: 'Success!',
                text: "{{ session('success') }}",
                icon: 'success',
                confirmButtonText: 'OK',
                confirmButtonColor: '#3b82f6',
                timer: 2000,
                timerProgressBar: true,
                showCloseButton: true,
                closeButtonAriaLabel: 'Close this alert'
            });
        </script>
    @endif

    @if($errors->any())
        <script>
            Swal.fire({
                title: 'Error!',
                text: "{{ $errors->first() }}",
                icon: 'error',
                confirmButtonText: 'OK',
                confirmButtonColor: '#ef4444',
                showCloseButton: true,
                closeButtonAriaLabel: 'Close this alert'
            });
        </script>
    @endif
@endpush
@endsection
