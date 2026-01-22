@extends('layouts.receptionist')

@section('title', 'Visitor Details - UCB Bank')

@section('content')
<div class="role-container" style="max-width: 950px;">
    <div class="glass-card glass-card-dark">
        <!-- Header -->
        <div style="display: flex; justify-content: space-between; align-items: center; margin-bottom: 3.5rem; border-bottom: 1px solid rgba(255,255,255,0.05); padding-bottom: 1.5rem;">
            <div class="d-flex align-items-center gap-3">
                <div class="logo-vms" style="width: 44px; height: 44px; font-size: 1.2rem;">V</div>
                <div>
                    <h6 class="fw-800 mb-0 text-white" style="font-size: 1.1rem;">UCB BANK</h6>
                    <span class="permission-title" style="font-size: 0.7rem; margin: 0;">VISITOR SYSTEM</span>
                </div>
            </div>
            <h2 class="fw-800 mb-0 text-white letter-spacing-1" style="font-size: 2rem;">Visitor Details</h2>
        </div>

        <!-- Visitor Info -->
        <div class="glass-card-light p-4 mb-4" style="background: rgba(255, 255, 255, 0.03);">
            <div class="d-flex align-items-center gap-4 mb-4">
                <div class="bg-opacity-10 rounded-circle d-flex align-items-center justify-content-center" style="width: 80px; height: 80px; background: rgba(59, 130, 246, 0.2);">
                    <span class="fw-800" style="font-size: 2rem;">{{ substr($visit->visitor->name, 0, 1) }}</span>
                </div>
                <div>
                    <h4 class="fw-800 mb-1 text-white">{{ $visit->visitor->name }}</h4>
                    <p class="mb-0 text-white-50 small">{{ $visit->visitor->email }}</p>
                    @if($visit->visitor->phone)
                    <p class="mb-0 text-white-50 small"><i class="fas fa-phone me-2"></i>{{ $visit->visitor->phone }}</p>
                    @endif
                </div>
            </div>

            <div class="row g-3">
                <div class="col-md-6">
                    <div class="p-3" style="background: rgba(255, 255, 255, 0.02); border-radius: 8px;">
                        <p class="mb-1 text-white-50 small fw-800">Company/Organization</p>
                        <p class="mb-0">{{ $visit->visitor->address ?? 'N/A' }}</p>
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="p-3" style="background: rgba(255, 255, 255, 0.02); border-radius: 8px;">
                        <p class="mb-1 text-white-50 small fw-800">Visit Status</p>
                        <p class="mb-0">
                            @if($visit->status == 'approved')
                                <span class="status-badge text-success">Approved</span>
                            @elseif($visit->status == 'pending')
                                <span class="status-badge text-warning border-orange">Pending</span>
                            @elseif($visit->status == 'completed')
                                <span class="status-badge">Completed</span>
                            @else
                                <span class="status-badge text-danger">Cancelled</span>
                            @endif
                        </p>
                    </div>
                </div>
            </div>
        </div>

        <!-- Visit Details -->
        <div class="glass-card-light p-4 mb-4" style="background: rgba(255, 255, 255, 0.03);">
            <h5 class="fw-800 mb-4 text-white">Visit Information</h5>
            <div class="row g-3">
                <div class="col-md-6">
                    <p class="mb-1 text-white-50 small fw-800">Host</p>
                    <p class="mb-0"><i class="fas fa-user-tie me-2 text-info"></i>{{ $visit->meetingUser->name }}</p>
                </div>
                <div class="col-md-6">
                    <p class="mb-1 text-white-50 small fw-800">Visit Type</p>
                    <p class="mb-0"><i class="fas fa-list me-2 text-info"></i>{{ $visit->type->name ?? 'N/A' }}</p>
                </div>
                <div class="col-md-6">
                    <p class="mb-1 text-white-50 small fw-800">Scheduled Date</p>
                    <p class="mb-0"><i class="fas fa-calendar-alt me-2 text-info"></i>{{ \Carbon\Carbon::parse($visit->schedule_time)->format('F j, Y - g:i A') }}</p>
                </div>
                <div class="col-md-12">
                    <p class="mb-1 text-white-50 small fw-800">Purpose</p>
                    <p class="mb-0"><i class="fas fa-briefcase me-2 text-info"></i>{{ $visit->purpose }}</p>
                </div>
            </div>
        </div>

        <!-- Timestamps -->
        <div class="glass-card-light p-4 mb-4" style="background: rgba(255, 255, 255, 0.03);">
            <h5 class="fw-800 mb-4 text-white">Timestamps</h5>
            <div class="row g-3">
                <div class="col-md-6">
                    <p class="mb-1 text-white-50 small fw-800">Created At</p>
                    <p class="mb-0">{{ \Carbon\Carbon::parse($visit->created_at)->format('F j, Y - g:i A') }}</p>
                </div>
                <div class="col-md-6">
                    <p class="mb-1 text-white-50 small fw-800">Last Updated</p>
                    <p class="mb-0">{{ \Carbon\Carbon::parse($visit->updated_at)->format('F j, Y - g:i A') }}</p>
                </div>
            </div>
        </div>

        <!-- Actions -->
        <div class="d-flex justify-content-end gap-3 mt-4 pt-4" style="border-top: 1px solid rgba(255,255,255,0.05);">
            <a href="{{ route('visitor.index') }}" class="btn-outline btn-reset" style="text-decoration: none;">
                <i class="fas fa-arrow-left"></i> Back to List
            </a>
            @can('edit visitors')
            <a href="{{ route('visitor.edit', $visit->id) }}" class="btn-gradient" style="text-decoration: none; padding: 12px 30px;">
                <i class="fas fa-edit"></i> Edit Visit
            </a>
            @endcan
        </div>
    </div>
</div>
@endsection
