{{-- resources/views/admin/employee/index.blade.php --}}
@extends('layouts.admin')

@section('content')
<div class="container py-5">

    <div class="mb-4">
        <h1 class="display-5 fw-bold">Employee Management System</h1>
        <p class="text-muted">Manage team members and track HR metrics</p>
    </div>

    {{-- Top Stats Cards --}}
    <div class="row g-3 mb-4">
        <div class="col-md-3">
            <div class="card text-center">
                <div class="card-body">
                    <div class="mb-2">
                        <i class="bi bi-people-fill fs-4"></i>
                        <span class="fw-medium">Total Employees</span>
                    </div>
                    <h4 class="fw-bold">6</h4>
                    <small class="text-muted">Company-wide</small>
                </div>
            </div>
        </div>

        <div class="col-md-3">
            <div class="card text-center">
                <div class="card-body">
                    <div class="mb-2">
                        <i class="bi bi-person-check-fill fs-4"></i>
                        <span class="fw-medium">Active</span>
                    </div>
                    <h4 class="fw-bold">5</h4>
                    <small class="text-success">83% active</small>
                </div>
            </div>
        </div>

        <div class="col-md-3">
            <div class="card text-center">
                <div class="card-body">
                    <div class="mb-2">
                        <i class="bi bi-person-x-fill fs-4"></i>
                        <span class="fw-medium">On Leave</span>
                    </div>
                    <h4 class="fw-bold">1</h4>
                    <small class="text-muted">Currently away</small>
                </div>
            </div>
        </div>

        <div class="col-md-3">
            <div class="card text-center">
                <div class="card-body">
                    <div class="mb-2">
                        <i class="bi bi-diagram-3-fill fs-4"></i>
                        <span class="fw-medium">Departments</span>
                    </div>
                    <h4 class="fw-bold">5</h4>
                    <small class="text-muted">Active teams</small>
                </div>
            </div>
        </div>
    </div>

    {{-- Department Overview --}}
    <div class="row g-3 mb-4">
        <div class="col-lg-4">
            <div class="card">
                <div class="card-header">
                    <h5 class="mb-0">Department Overview</h5>
                    <small class="text-muted">Team distribution</small>
                </div>
                <div class="card-body">
                    {{-- Static department stats --}}
                    <div class="mb-3">
                        <div class="d-flex justify-content-between mb-1">
                            <span>Operations</span>
                            <small class="text-muted">31/32</small>
                        </div>
                        <div class="progress" style="height: 8px;">
                            <div class="progress-bar bg-info" role="progressbar" style="width: 97%"></div>
                        </div>
                    </div>

                    <div class="mb-3">
                        <div class="d-flex justify-content-between mb-1">
                            <span>Marketing</span>
                            <small class="text-muted">18/18</small>
                        </div>
                        <div class="progress" style="height: 8px;">
                            <div class="progress-bar bg-info" role="progressbar" style="width: 100%"></div>
                        </div>
                    </div>

                    <div class="mb-3">
                        <div class="d-flex justify-content-between mb-1">
                            <span>Sales</span>
                            <small class="text-muted">23/24</small>
                        </div>
                        <div class="progress" style="height: 8px;">
                            <div class="progress-bar bg-info" role="progressbar" style="width: 96%"></div>
                        </div>
                    </div>

                    <div class="mb-3">
                        <div class="d-flex justify-content-between mb-1">
                            <span>HR</span>
                            <small class="text-muted">8/8</small>
                        </div>
                        <div class="progress" style="height: 8px;">
                            <div class="progress-bar bg-info" role="progressbar" style="width: 100%"></div>
                        </div>
                    </div>

                    <div class="mb-3">
                        <div class="d-flex justify-content-between mb-1">
                            <span>Finance</span>
                            <small class="text-muted">11/12</small>
                        </div>
                        <div class="progress" style="height: 8px;">
                            <div class="progress-bar bg-info" role="progressbar" style="width: 92%"></div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        {{-- Employee List --}}
        <div class="col-lg-8">
            <div class="card">
                <div class="card-header">
                    <h5 class="mb-0">Team Members</h5>
                    <small class="text-muted">All employees and their status</small>
                </div>
                <div class="card-body">
                    <ul class="list-group list-group-flush">
                        {{-- Static Employee List --}}
                        <li class="list-group-item d-flex justify-content-between align-items-center">
                            <div>
                                <div class="fw-medium">Sarah Connor</div>
                                <small class="text-muted">Manager • Operations</small>
                            </div>
                            <span class="badge bg-success">Active</span>
                        </li>

                        <li class="list-group-item d-flex justify-content-between align-items-center">
                            <div>
                                <div class="fw-medium">Mike Johnson</div>
                                <small class="text-muted">Coordinator • Marketing</small>
                            </div>
                            <span class="badge bg-success">Active</span>
                        </li>

                        <li class="list-group-item d-flex justify-content-between align-items-center">
                            <div>
                                <div class="fw-medium">Emma Davis</div>
                                <small class="text-muted">Specialist • HR</small>
                            </div>
                            <span class="badge bg-success">Active</span>
                        </li>

                        <li class="list-group-item d-flex justify-content-between align-items-center">
                            <div>
                                <div class="fw-medium">Alex Brown</div>
                                <small class="text-muted">Analyst • Finance</small>
                            </div>
                            <span class="badge bg-warning text-dark">On Leave</span>
                        </li>

                        <li class="list-group-item d-flex justify-content-between align-items-center">
                            <div>
                                <div class="fw-medium">Lisa Anderson</div>
                                <small class="text-muted">Director • Sales</small>
                            </div>
                            <span class="badge bg-success">Active</span>
                        </li>

                        <li class="list-group-item d-flex justify-content-between align-items-center">
                            <div>
                                <div class="fw-medium">John Wilson</div>
                                <small class="text-muted">Specialist • Operations</small>
                            </div>
                            <span class="badge bg-success">Active</span>
                        </li>
                    </ul>
                </div>
            </div>
        </div>
    </div>

</div>
@endsection
