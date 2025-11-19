{{-- resources/views/admin/tasks/task-board.blade.php --}}
@extends('layouts.admin')

@section('content')
@php
$tasks = [
    ['id'=>1,'title'=>'Update marketing materials','status'=>'Completed','priority'=>'High','assignee'=>'Sarah','dueDate'=>'2025-01-15'],
    ['id'=>2,'title'=>'Review booking reports','status'=>'In Progress','priority'=>'High','assignee'=>'Mike','dueDate'=>'2025-01-20'],
    ['id'=>3,'title'=>'Process guest feedback','status'=>'In Progress','priority'=>'Medium','assignee'=>'Emma','dueDate'=>'2025-01-22'],
    ['id'=>4,'title'=>'Prepare sustainability report','status'=>'Pending','priority'=>'Medium','assignee'=>'John','dueDate'=>'2025-01-25'],
    ['id'=>5,'title'=>'Conduct employee training','status'=>'Pending','priority'=>'Low','assignee'=>'Alex','dueDate'=>'2025-02-01'],
    ['id'=>6,'title'=>'Analyze revenue trends','status'=>'Completed','priority'=>'High','assignee'=>'Lisa','dueDate'=>'2025-01-18'],
];

$statusColors = [
    'Completed' => 'text-success bg-success bg-opacity-10',
    'In Progress' => 'text-primary bg-primary bg-opacity-10',
    'Pending' => 'text-warning bg-warning bg-opacity-10',
];

$priorityColors = [
    'High' => 'text-danger',
    'Medium' => 'text-warning',
    'Low' => 'text-success',
];

$stats = [
    'total' => count($tasks),
    'completed' => count(array_filter($tasks, fn($t) => $t['status']=='Completed')),
    'inProgress' => count(array_filter($tasks, fn($t) => $t['status']=='In Progress')),
    'pending' => count(array_filter($tasks, fn($t) => $t['status']=='Pending')),
];
@endphp

<div class="container-fluid py-4">

    {{-- Header --}}
    <div class="mb-4">
        <h1 class="display-5 fw-bold">Digital Task Board</h1>
        <p class="text-muted">Manage and track all team tasks and projects</p>
    </div>


    {{-- Stats --}}
    <div class="row g-3 mb-4">
        <div class="col-md-3">
            <div class="card shadow-sm">
                <div class="card-body">
                    <h6>Total Tasks</h6>
                    <h3 class="fw-bold">{{ $stats['total'] }}</h3>
                    <small class="text-muted">Active tasks</small>
                </div>
            </div>
        </div>
        <div class="col-md-3">
            <div class="card shadow-sm">
                <div class="card-body">
                    <h6>Completed</h6>
                    <h3 class="fw-bold text-success">{{ $stats['completed'] }}</h3>
                    <small class="text-muted">{{ round(($stats['completed'] / $stats['total'])*100) }}% completion</small>
                </div>
            </div>
        </div>
        <div class="col-md-3">
            <div class="card shadow-sm">
                <div class="card-body">
                    <h6>In Progress</h6>
                    <h3 class="fw-bold text-primary">{{ $stats['inProgress'] }}</h3>
                    <small class="text-muted">Currently working</small>
                </div>
            </div>
        </div>
        <div class="col-md-3">
            <div class="card shadow-sm">
                <div class="card-body">
                    <h6>Pending</h6>
                    <h3 class="fw-bold text-warning">{{ $stats['pending'] }}</h3>
                    <small class="text-muted">Awaiting action</small>
                </div>
            </div>
        </div>
    </div>

    {{-- Task Filters --}}
    <div class="mb-3">
        <div class="btn-group" role="group">
            <button class="btn btn-outline-secondary btn-sm">All Tasks</button>
            <button class="btn btn-outline-success btn-sm">Completed</button>
            <button class="btn btn-outline-primary btn-sm">In Progress</button>
            <button class="btn btn-outline-warning btn-sm">Pending</button>
        </div>
    </div>

    {{-- Task List --}}
    <div class="card shadow-sm">
        <div class="card-header">
            <h5 class="mb-0">Tasks Overview</h5>
            <small class="text-muted">All team tasks and assignments</small>
        </div>
        <div class="card-body p-0">
            <div class="list-group list-group-flush">
                @foreach($tasks as $task)
                <div class="list-group-item d-flex align-items-center justify-content-between py-3">
                    <div class="d-flex align-items-start gap-3">
                        {{-- Status Icon --}}
                        @if($task['status']=='Completed')
                            <i class="bi bi-check-circle-fill text-success fs-5 mt-1"></i>
                        @elseif($task['status']=='In Progress')
                            <i class="bi bi-arrow-repeat text-primary fs-5 mt-1"></i>
                        @else
                            <i class="bi bi-exclamation-circle-fill text-warning fs-5 mt-1"></i>
                        @endif

                        <div>
                            <div class="d-flex align-items-center gap-2 mb-1">
                                <span class="fw-medium">{{ $task['title'] }}</span>
                                <span class="badge {{ $statusColors[$task['status']] }}">{{ $task['status'] }}</span>
                            </div>
                            <div class="text-muted small d-flex gap-3">
                                <span>Assigned to: <span class="fw-medium text-dark">{{ $task['assignee'] }}</span></span>
                                <span><i class="bi bi-clock me-1"></i>{{ $task['dueDate'] }}</span>
                            </div>
                        </div>
                    </div>
                    <span class="fw-bold {{ $priorityColors[$task['priority']] }}">{{ $task['priority'] }}</span>
                </div>
                @endforeach
            </div>
        </div>
    </div>

</div>
@endsection
