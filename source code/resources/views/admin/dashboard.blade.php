@extends('layouts.panel')

@section('title', 'Admin Dashboard')

@section('content')
<div class="container-fluid" style="margin-top: 20px;">

    <div class="row">
        <div class="col-md-12">
            <div class="card">
                <div class="card-body" style="background-color: #c5e3f4;">
                    <div class="d-flex justify-content-between align-items-center">
                        <div>
                            <h3 class="card-title mb-1">Welcome back, {{ $LoggedAdminInfo->name }}!</h3>
                            <p class="card-category">Here's what's happening with your platform today.</p>
                        </div>
                        <div class="text-right d-none d-md-block">
                            <div style="color: #2d1d61; font-weight: bold;">
                                <?php echo date('l, F j, Y'); ?>
                            </div>
                            <div style="color: #666; font-size: 0.9em;">
                                <?php echo date('g:i:s A'); ?>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

<div class="row g-3">
    @php
    $stats = [
        ['title' => 'Students', 'value' => $totalStudents, 'icon' => 'fas fa-users', 'bg' => 'linear-gradient(135deg, #2193b0, #6dd5ed)'],
        ['title' => 'Societies', 'value' => $totalSocieties, 'icon' => 'fas fa-building', 'bg' => 'linear-gradient(135deg, #11998e, #38ef7d)'],
        ['title' => 'Elections', 'value' => $totalElections, 'icon' => 'fas fa-vote-yea', 'bg' => 'linear-gradient(135deg, #7f00ff, #e100ff)'],
        ['title' => 'Applications', 'value' => $totalApplications, 'icon' => 'fas fa-file-alt', 'bg' => 'linear-gradient(135deg, #f7971e, #ffd200)'],
        ['title' => 'Candidates', 'value' => $totalCandidates, 'icon' => 'fas fa-user-tie', 'bg' => 'linear-gradient(135deg, #f00000, #ffb199)'],
        ['title' => 'Votes', 'value' => $totalVotes, 'icon' => 'fas fa-chart-bar', 'bg' => 'linear-gradient(135deg, #43cea2, #185a9d)']
    ];
    @endphp

    @foreach($stats as $stat)
    <div class="col-12 col-sm-6 col-lg-3">
        <div class="card stat-card shadow-sm border-0 h-100">
            <div class="card-body p-3 d-flex flex-column justify-content-between">
                <div class="d-flex justify-content-between align-items-center">
                    <div>
                        <h6 class="card-title mb-1 text-muted">{{ $stat['title'] }}</h6>
                        <h3 class="fw-bold text-dark">{{ number_format($stat['value']) }}</h3>
                    </div>
                    <div class="stat-icon" style="background: {{ $stat['bg'] }}">
                        <i class="{{ $stat['icon'] }}"></i>
                    </div>
                </div>
                <div class="mt-3 text-success small">
                    <i class="fas fa-chart-line"></i> Platform total
                </div>
            </div>
        </div>
    </div>
    @endforeach
</div>



<style>

    .stat-card {
    border-radius: 16px;
    transition: all 0.3s ease;
}
.stat-card:hover {
    transform: translateY(-6px);
    box-shadow: 0 8px 20px rgba(0,0,0,0.15);
}

.stat-icon {
    width: 55px;
    height: 55px;
    border-radius: 14px;
    display: flex;
    align-items: center;
    justify-content: center;
    color: #fff;
    font-size: 22px;
    box-shadow: 0 4px 10px rgba(0,0,0,0.2);
}

</style>

    <div class="row">
        <div class="col-xl-4 col-lg-6 col-md-6 mb-4">
            <div class="card h-100" style="border-radius: 15px; border: none;">
                <div class="card-header bg-transparent border-0 py-3">
                    <h5 class="card-title mb-0 d-flex align-items-center">
                        <i class="fas fa-chart-pie me-2 text-warning"></i>
                        Application Status
                    </h5>
                </div>
                <div class="card-body d-flex align-items-center justify-content-center">
                    <div style="position: relative; height: 250px; width: 100%;">
                        <canvas id="applicationChart"></canvas>
                    </div>
                </div>
            </div>
        </div>

        <div class="col-xl-4 col-lg-6 col-md-6 mb-4">
            <div class="card h-100" style="border-radius: 15px; border: none;">
                <div class="card-header bg-transparent border-0 py-3">
                    <h5 class="card-title mb-0 d-flex align-items-center">
                        <i class="fas fa-chart-bar me-2 text-danger"></i>
                        Active Elections per Society
                    </h5>
                </div>
                <div class="card-body">
                    <div style="position: relative; height: 250px; width: 100%;">
                        <canvas id="activeElectionsChart"></canvas>
                    </div>
                </div>
            </div>
        </div>
<div class="row mb-4">

    <!-- Pending Applications -->
    <div class="col-md-3 col-sm-6 mb-3">
        <div class="card h-100 shadow-sm border-0 stat-card" style="border-radius: 18px;">
            <div class="card-body text-center p-4" style="background: linear-gradient(135deg, #ffb75e 0%, #ed8f03 100%); border-radius: 18px;">
                <i class="fas fa-clock text-white mb-2 fa-lg"></i>
                <h6 class="text-white fw-semibold mb-1">Pending</h6>
                <h4 class="text-white fw-bold mb-0">{{ $applicationStats['pending'] }}</h4>
            </div>
        </div>
    </div>

    <!-- Approved -->
    <div class="col-md-3 col-sm-6 mb-3">
        <div class="card h-100 shadow-sm border-0 stat-card" style="border-radius: 18px;">
            <div class="card-body text-center p-4" style="background: linear-gradient(135deg, #56ab2f 0%, #a8e063 100%); border-radius: 18px;">
                <i class="fas fa-check-circle text-white mb-2 fa-lg"></i>
                <h6 class="text-white fw-semibold mb-1">Approved</h6>
                <h4 class="text-white fw-bold mb-0">{{ $applicationStats['approved'] }}</h4>
            </div>
        </div>
    </div>

    <!-- Rejected -->
    <div class="col-md-3 col-sm-6 mb-3">
        <div class="card h-100 shadow-sm border-0 stat-card" style="border-radius: 18px;">
            <div class="card-body text-center p-4" style="background: linear-gradient(135deg, #cb2d3e 0%, #ef473a 100%); border-radius: 18px;">
                <i class="fas fa-times-circle text-white mb-2 fa-lg"></i>
                <h6 class="text-white fw-semibold mb-1">Rejected</h6>
                <h4 class="text-white fw-bold mb-0">{{ $applicationStats['rejected'] }}</h4>
            </div>
        </div>
    </div>

    <!-- Approval Rate -->
    <div class="col-md-3 col-sm-6 mb-3">
        <div class="card h-100 shadow-sm border-0 stat-card" style="border-radius: 18px;">
            <div class="card-body text-center p-4" style="background: linear-gradient(135deg, #36d1dc 0%, #5b86e5 100%); border-radius: 18px;">
                <i class="fas fa-percentage text-white mb-2 fa-lg"></i>
                <h6 class="text-white fw-semibold mb-1">Approval Rate</h6>
                <h4 class="text-white fw-bold mb-0">
                    {{ $totalApplications > 0 ? round(($applicationStats['approved'] / $totalApplications) * 100) : 0 }}%
                </h4>
            </div>
        </div>
    </div>

</div>

    </div>

    <div class="row">
        <div class="col-12 mb-4">
            <div class="card" style="border-radius: 15px; border: none;">
                <div class="card-header bg-transparent border-0 py-3">
                    <h5 class="card-title mb-0 d-flex align-items-center">
                        <i class="fas fa-chart-line me-2 text-success"></i>
                        Votes per Candidate
                    </h5>
                </div>
                <div class="card-body">
                    <div style="position: relative; height: 300px; width: 100%;">
                        <canvas id="votesPerCandidateChart"></canvas>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="row">
        <div class="col-12">
            <div class="card" style="border-radius: 15px; border: none;">
                <div class="card-header bg-transparent border-0 py-3 d-flex justify-content-between align-items-center">
                    <h5 class="card-title mb-0 d-flex align-items-center">
                        <i class="fas fa-list-alt me-2 text-primary"></i>
                        Recent Applications
                    </h5>
                </div>
                <div class="card-body">
                    <div class="content table-responsive">
                        <table class="table table-striped">
                            <thead style="background: linear-gradient(135deg, var(--primary-dark) 0%, #667eea 100%);">
                                <tr>
                                    <th class="text-white">Applicant</th>
                                    <th class="text-white">Election</th>
                                    <th class="text-white">Status</th>
                                    <th class="text-white">Submitted At</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($recentApplications as $app)
                                <tr>
                                    <td>
                                        {{ $app->student->name ?? 'N/A' }}
                                    </td>
                                    <td>{{ $app->election->election_name ?? 'N/A' }}</td>
                                    <td>
                                        @php
                                        $status = $app->status;
                                        $badgeClass = 'badge ';
                                        $style = '';

                                        if ($status == 'pending') {
                                        $badgeClass .= 'bg-warning';

                                        } elseif ($status == 'approved') {
                                        $badgeClass .= 'bg-success';

                                        } elseif ($status == 'rejected') {
                                        $badgeClass .= 'bg-danger';

                                        }
                                        @endphp
                                        <span class="{{ $badgeClass }}" style="{{ $style }} padding: 0.35em 0.65em; border-radius: 0.375rem; font-size: 0.875em;">
                                            {{ ucfirst($status) }}
                                        </span>
                                    </td>
                                    <td>{{ $app->created_at->format('d M Y, H:i') }}</td>
                                </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>

</div>
@endsection

@section('scripts')
<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
<script>
    // Wait for DOM to be fully loaded
    document.addEventListener('DOMContentLoaded', function() {

        // Application Status Pie Chart
        const appChartEl = document.getElementById('applicationChart');
        if (appChartEl) {
            new Chart(appChartEl, {
                type: 'doughnut',
                data: {
                    labels: ['Pending', 'Approved', 'Rejected'],
                    datasets: [{
                        data: [
                            {{ $applicationStats['pending'] }},
                            {{ $applicationStats['approved'] }},
                            {{ $applicationStats['rejected'] }}
                        ],
                        backgroundColor: ['#ffc107', '#28a745', '#dc3545'],
                        borderWidth: 2,
                        borderColor: '#fff',
                        hoverOffset: 15
                    }]
                },
                options: {
                    responsive: true,
                    maintainAspectRatio: false,
                    cutout: '70%',
                    plugins: {
                        legend: {
                            position: 'bottom',
                            labels: {
                                padding: 20,
                                usePointStyle: true,
                                font: {
                                    size: 12,
                                    family: 'Poppins'
                                }
                            }
                        },
                        tooltip: {
                            backgroundColor: 'rgba(45, 29, 97, 0.9)',
                            titleFont: { family: 'Poppins' },
                            bodyFont: { family: 'Poppins' }
                        }
                    },
                    animation: {
                        animateScale: true,
                        animateRotate: true
                    }
                }
            });
        }

        // Active Elections per Society Bar Chart
        const activeElectionsEl = document.getElementById('activeElectionsChart');
        if (activeElectionsEl) {
            new Chart(activeElectionsEl, {
                type: 'bar',
                data: {
                    labels: {!! json_encode($activeElectionsPerSociety->pluck('society_name')) !!},
                    datasets: [{
                        label: 'Active Elections',
                        data: {!! json_encode($activeElectionsPerSociety->pluck('active_elections_count')) !!},
                        backgroundColor: 'rgba(40, 167, 69, 0.8)',
                        borderColor: 'rgba(40, 167, 69, 1)',
                        borderWidth: 1,
                        borderRadius: 8,
                        borderSkipped: false,
                    }]
                },
                options: {
                    responsive: true,
                    maintainAspectRatio: false,
                    scales: {
                        y: {
                            beginAtZero: true,
                            ticks: {
                                precision: 0,
                                font: { family: 'Poppins' }
                            },
                            grid: {
                                drawBorder: false,
                                color: 'rgba(0, 0, 0, 0.05)'
                            }
                        },
                        x: {
                            grid: { display: false },
                            ticks: { font: { family: 'Poppins' } }
                        }
                    },
                    plugins: {
                        legend: { display: false },
                        tooltip: {
                            backgroundColor: 'rgba(45, 29, 97, 0.9)',
                            titleFont: { family: 'Poppins' },
                            bodyFont: { family: 'Poppins' }
                        }
                    },
                    animation: {
                        duration: 1000,
                        easing: 'easeInOutQuart'
                    }
                }
            });
        }

        // Votes per Candidate Bar Chart
        const votesChartEl = document.getElementById('votesPerCandidateChart');
        if (votesChartEl) {
            new Chart(votesChartEl, {
                type: 'bar',
                data: {
                    labels: {!! json_encode($votesPerCandidate->pluck('student.name')) !!},
                    datasets: [{
                        label: 'Votes',
                        data: {!! json_encode($votesPerCandidate->pluck('votes_count')) !!},
                        backgroundColor: 'rgba(255, 193, 7, 0.8)',
                        borderColor: 'rgba(255, 193, 7, 1)',
                        borderWidth: 1,
                        borderRadius: 8,
                        borderSkipped: false,
                    }]
                },
                options: {
                    responsive: true,
                    maintainAspectRatio: false,
                    scales: {
                        y: {
                            beginAtZero: true,
                            ticks: {
                                precision: 0,
                                font: { family: 'Poppins' }
                            },
                            grid: {
                                drawBorder: false,
                                color: 'rgba(0, 0, 0, 0.05)'
                            }
                        },
                        x: {
                            grid: { display: false },
                            ticks: {
                                font: { family: 'Poppins' },
                                maxRotation: 45,
                                minRotation: 45
                            }
                        }
                    },
                    plugins: {
                        legend: { display: false },
                        tooltip: {
                            backgroundColor: 'rgba(45, 29, 97, 0.9)',
                            titleFont: { family: 'Poppins' },
                            bodyFont: { family: 'Poppins' }
                        }
                    },
                    animation: {
                        duration: 1000,
                        easing: 'easeInOutQuart'
                    }
                }
            });
        }

        // Add interactive effects to stat cards
        const statCards = document.querySelectorAll('.stat-card');
        statCards.forEach(card => {
            card.addEventListener('mouseenter', function() {
                this.style.transform = 'translateY(-5px)';
                this.style.boxShadow = '0 12px 25px rgba(0, 0, 0, 0.15)';
                this.style.transition = 'all 0.3s ease';
            });
            card.addEventListener('mouseleave', function() {
                this.style.transform = 'translateY(0)';
                this.style.boxShadow = '0 4px 15px rgba(0, 0, 0, 0.08)';
            });
        });

        // Add loading animation to charts
        const chartContainers = document.querySelectorAll('.card-body canvas');
        chartContainers.forEach(container => {
            container.style.opacity = '0';
            container.style.transition = 'opacity 0.5s ease';

            setTimeout(() => {
                container.style.opacity = '1';
            }, 300);
        });

        // Handle window resize for charts
        let resizeTimer;
        window.addEventListener('resize', function() {
            clearTimeout(resizeTimer);
            resizeTimer = setTimeout(function() {
                console.log('Window resized - charts updated');
            }, 250);
        });
    });

    // Error handling for charts
    window.addEventListener('error', function(e) {
        console.error('Chart error:', e.error);
    });
</script>
@endsection
