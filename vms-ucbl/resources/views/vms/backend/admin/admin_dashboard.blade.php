@extends('layouts.admin')

@section('content')
            <!-- Header -->
            <div class="header-section">
                <div>
                    <h3 class="fw-800 mb-1 text-white letter-spacing-1"> Main Dashboard</h3>
                    <p class="sub-label mb-0">System Status & Monitoring</p>
                </div>
                <div class="header-profile-box glass-card">
                    <div class="avatar bg-primary">
                        <i class="fas fa-user-tie text-white small"></i>
                    </div>
                    <div>
                        <p class="small fw-800 mb-0 text-white">Admin Pankaj</p>
                        <span class="sub-label fs-9">Security Lead</span>
                    </div>
                </div>
            </div>

            <!-- Stats Row -->
            <div class="row g-3 mb-4">
                <div class="col-6 col-xl">
                    <div class="glass-card summary-card">
                        <div>
                            <span class="sub-label d-block mb-1">Expected</span>
                            <h2>20</h2>
                        </div>
                        <div class="summary-icon"><i class="fas fa-user"></i></div>
                    </div>
                </div>
                <div class="col-6 col-xl">
                    <div class="glass-card summary-card">
                        <div>
                            <span class="sub-label d-block mb-1">Meetings</span>
                            <h2>10</h2>
                        </div>
                        <div class="summary-icon"><i class="fas fa-users"></i></div>
                    </div>
                </div>
                <div class="col-6 col-xl">
                    <div class="glass-card summary-card">
                        <div>
                            <span class="sub-label d-block mb-1">Defaulted</span>
                            <h2>05</h2>
                        </div>
                        <div class="summary-icon text-danger" style="background:rgba(220,53,69,0.1)"><i class="fas fa-user-xmark"></i></div>
                    </div>
                </div>
                <div class="col-6 col-xl">
                    <div class="glass-card summary-card">
                        <div>
                            <span class="sub-label d-block mb-1">Pending</span>
                            <h2>21</h2>
                        </div>
                        <div class="summary-icon text-warning" style="background:rgba(255,193,7,0.1)"><i class="fas fa-signal"></i></div>
                    </div>
                </div>
                <div class="col-12 col-xl">
                    <div class="glass-card summary-card justify-content-center cursor-pointer border-dashed" style="border-width: 2px;">
                        <div class="d-flex align-items-center gap-2">
                            <i class="fas fa-plus"></i>
                            <span class="fw-bold text-uppercase fs-9">Add New Visitor</span>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Visitor Statistics -->
            <div class="row g-4 mb-4">
                <div class="col-12 col-lg-8">
                    <div class="glass-card p-4">
                        <h6 class="fw-800 sub-label mb-4">Visitor Statistics</h6>
                        <div class="bar-chart-wrapper">
                            <div class="bar-chart">
                                <div class="bar-col" style="height: 70%;"></div>
                                <div class="bar-col" style="height: 90%;"></div>
                                <div class="bar-col" style="height: 30%;"></div>
                                <div class="bar-col" style="height: 60%;"></div>
                                <div class="bar-col" style="height: 80%;"></div>
                                <div class="bar-col" style="height: 95%;"></div>
                                <div class="bar-col" style="height: 50%;"></div>
                            </div>
                        </div>
                        <div class="d-flex justify-content-between sub-label mt-3 fs-9" style="min-width: 500px;">
                            <span>Mon</span><span>Tue</span><span>Wed</span><span>Thu</span><span>Fri</span><span>Sat</span><span>Sun</span>
                        </div>
                    </div>
                </div>
                <div class="col-12 col-lg-4">
                    <div class="glass-card p-4 h-100 text-center">
                        <h6 class="fw-800 sub-label text-start mb-4">Visit Categories</h6>
                        <div class="donut-container mx-auto mb-4">
                            <div class="donut-inner">
                                <span class="fw-800 fs-4 text-white">250</span>
                                <span class="sub-label" style="font-size: 8px; color: #fff !important;">Total</span>
                            </div>
                        </div>
                        <div class="row g-2 text-start small">
                            <div class="col-6 text-white"><i class="fas fa-circle me-1 text-primary"></i> Delivery</div>
                            <div class="col-6 text-white"><i class="fas fa-circle me-1 text-success"></i> Medical</div>
                            <div class="col-6 text-white"><i class="fas fa-circle me-1 text-warning"></i> Vendor</div>
                            <div class="col-6 text-white"><i class="fas fa-circle me-1 text-danger"></i> Clients</div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Table Section (Log Container with Font Force) -->
            <div class="glass-card log-container p-4">
                <h6 class="fw-800 sub-label mb-4">Recent Visits Log</h6>
                <div class="table-responsive">
                    <table class="table align-middle">
                        <thead>
                            <tr>
                                <th>Visitor</th>
                                <th>Host</th>
                                <th>Dept</th>
                                <th>Duration</th>
                                <th>Date</th>
                                <th>Status</th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr>
                                <td>
                                    <div class="d-flex align-items-center gap-2">
                                        <div class="bg-opacity-10 rounded-circle" style="width: 25px; height: 25px;"></div>
                                        <span class="small fw-800">Adela Parkson</span>
                                    </div>
                                </td>
                                <td class="small">Vipul Gupta</td>
                                <td class="small">EPD</td>
                                <td class="small">1h 45m</td>
                                <td class="small">24/04/24</td>
                                <td><span class="status-badge">Completed</span></td>
                            </tr>
                            <tr>
                                <td>
                                    <div class="d-flex align-items-center gap-2">
                                        <div class="bg-opacity-10 rounded-circle" style="width: 25px; height: 25px;"></div>
                                        <span class="small fw-800">Jason Statham</span>
                                    </div>
                                </td>
                                <td class="small">Vipul Gupta</td>
                                <td class="small">Sales</td>
                                <td class="small">Active</td>
                                <td class="small">24/04/24</td>
                                <td><span class="status-badge text-warning border-orange">On-Site</span></td>
                            </tr>
                        </tbody>
                    </table>
                </div>
            </div>
@endsection
