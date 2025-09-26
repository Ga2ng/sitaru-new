@extends('layouts.app')

@section('title', 'Dashboard')
@section('subtitle', 'Plan, prioritize, and accomplish your tasks with ease')

@section('content')
<div class="max-w-7xl mx-auto space-y-6">
    <!-- Header -->
    <div class="flex justify-between items-center">
        <div>
            <h1 class="text-3xl font-bold text-gray-900">Dashboard</h1>
            <p class="text-gray-600 mt-1">Plan, prioritize, and accomplish your tasks with ease</p>
        </div>
        <div class="flex space-x-3">
            <button class="bg-[#185B3C] text-white px-6 py-2.5 rounded-lg font-medium hover:bg-[#0F3D26] transition-colors shadow-sm">
                <i class="fas fa-plus mr-2"></i>
                Add Project
            </button>
            <button class="bg-white text-gray-700 px-6 py-2.5 rounded-lg font-medium border border-gray-200 hover:bg-gray-50 transition-colors shadow-sm">
                <i class="fas fa-upload mr-2"></i>
                Import Data
            </button>
        </div>
    </div>

    <!-- Stats Cards -->
    <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-6">
        <!-- Total Projects -->
        <div class="bg-white rounded-xl p-6 shadow-sm border border-gray-100 hover:shadow-md transition-shadow">
            <div class="flex items-center justify-between">
                <div>
                    <div class="flex items-center space-x-2 mb-2">
                        <div class="w-8 h-8 bg-[#185B3C]/10 rounded-lg flex items-center justify-center">
                            <i class="fas fa-project-diagram text-[#185B3C] text-sm"></i>
                        </div>
                        <span class="text-xs font-medium text-gray-500">Total Projects</span>
                    </div>
                    <p class="text-3xl font-bold text-gray-900">24</p>
                    <p class="text-xs text-[#185B3C] mt-1 flex items-center">
                        <i class="fas fa-arrow-up mr-1"></i>
                        +2% from last month
                    </p>
                </div>
                <div class="w-12 h-12 bg-[#185B3C] rounded-full flex items-center justify-center">
                    <span class="text-white font-bold text-sm">24</span>
                </div>
            </div>
        </div>

        <!-- Ended Projects -->
        <div class="bg-white rounded-xl p-6 shadow-sm border border-gray-100 hover:shadow-md transition-shadow">
            <div class="flex items-center justify-between">
                <div>
                    <div class="flex items-center space-x-2 mb-2">
                        <div class="w-8 h-8 bg-blue-100 rounded-lg flex items-center justify-center">
                            <i class="fas fa-check-circle text-blue-600 text-sm"></i>
                        </div>
                        <span class="text-xs font-medium text-gray-500">Ended Projects</span>
                    </div>
                    <p class="text-3xl font-bold text-gray-900">10</p>
                    <p class="text-xs text-[#185B3C] mt-1 flex items-center">
                        <i class="fas fa-arrow-up mr-1"></i>
                        +5% from last month
                    </p>
                </div>
                <div class="w-12 h-12 bg-blue-600 rounded-full flex items-center justify-center">
                    <span class="text-white font-bold text-sm">10</span>
                </div>
            </div>
        </div>

        <!-- Running Projects -->
        <div class="bg-white rounded-xl p-6 shadow-sm border border-gray-100 hover:shadow-md transition-shadow">
            <div class="flex items-center justify-between">
                <div>
                    <div class="flex items-center space-x-2 mb-2">
                        <div class="w-8 h-8 bg-orange-100 rounded-lg flex items-center justify-center">
                            <i class="fas fa-clock text-orange-600 text-sm"></i>
                        </div>
                        <span class="text-xs font-medium text-gray-500">Running Projects</span>
                    </div>
                    <p class="text-3xl font-bold text-gray-900">12</p>
                    <p class="text-xs text-[#185B3C] mt-1 flex items-center">
                        <i class="fas fa-arrow-up mr-1"></i>
                        +2% from last month
                    </p>
                </div>
                <div class="w-12 h-12 bg-orange-600 rounded-full flex items-center justify-center">
                    <span class="text-white font-bold text-sm">12</span>
                </div>
            </div>
        </div>

        <!-- Pending Projects -->
        <div class="bg-white rounded-xl p-6 shadow-sm border border-gray-100 hover:shadow-md transition-shadow">
            <div class="flex items-center justify-between">
                <div>
                    <div class="flex items-center space-x-2 mb-2">
                        <div class="w-8 h-8 bg-red-100 rounded-lg flex items-center justify-center">
                            <i class="fas fa-exclamation-circle text-red-600 text-sm"></i>
                        </div>
                        <span class="text-xs font-medium text-gray-500">Pending Projects</span>
                    </div>
                    <p class="text-3xl font-bold text-gray-900">2</p>
                    <p class="text-xs text-gray-500 mt-1">On Review</p>
                </div>
                <div class="w-12 h-12 bg-red-600 rounded-full flex items-center justify-center">
                    <span class="text-white font-bold text-sm">2</span>
                </div>
            </div>
        </div>
    </div>

    <!-- Charts and Analytics Section -->
    <div class="grid grid-cols-1 lg:grid-cols-3 gap-6">
        <!-- Project Analytics Chart -->
        <div class="lg:col-span-2">
            <div class="bg-white rounded-xl p-6 shadow-sm border border-gray-100">
                <div class="flex justify-between items-center mb-6">
                    <h3 class="text-lg font-semibold text-gray-900">Project Analytics</h3>
                    <button class="text-sm text-[#185B3C] hover:text-[#0F3D26] font-medium">View Details</button>
                </div>
                <div class="h-64 flex items-end space-x-2">
                    <!-- Chart bars -->
                    <div class="flex-1 bg-gray-200 h-16 rounded-t-lg"></div>
                    <div class="flex-1 bg-[#185B3C] h-48 rounded-t-lg"></div>
                    <div class="flex-1 bg-[#22C55E] h-44 rounded-t-lg"></div>
                    <div class="flex-1 bg-[#185B3C] h-52 rounded-t-lg"></div>
                    <div class="flex-1 bg-gray-200 h-20 rounded-t-lg"></div>
                    <div class="flex-1 bg-gray-200 h-24 rounded-t-lg"></div>
                    <div class="flex-1 bg-gray-200 h-28 rounded-t-lg"></div>
                </div>
                <div class="mt-4 flex items-center justify-between text-sm text-gray-600">
                    <span>Jan</span>
                    <span>Feb</span>
                    <span>Mar</span>
                    <span>Apr</span>
                    <span>May</span>
                    <span>Jun</span>
                    <span>Jul</span>
                </div>
            </div>
        </div>

        <!-- Project Progress -->
        <div class="space-y-6">
            <!-- Progress Circle -->
            <div class="bg-white rounded-xl p-6 shadow-sm border border-gray-100">
                <h3 class="text-lg font-semibold text-gray-900 mb-4">Project Progress</h3>
                <div class="flex items-center justify-center">
                    <div class="relative w-32 h-32">
                        <svg class="w-32 h-32" viewBox="0 0 36 36">
                            <path class="text-gray-200" stroke="currentColor" stroke-width="3" fill="none" d="M18 2.0845a 15.9155 15.9155 0 0 1 0 31.831a 15.9155 15.9155 0 0 1 0 -31.831"></path>
                            <path class="text-[#185B3C] progress-ring" stroke="currentColor" stroke-width="3" fill="none" stroke-dasharray="41, 100" d="M18 2.0845a 15.9155 15.9155 0 0 1 0 31.831a 15.9155 15.9155 0 0 1 0 -31.831"></path>
                        </svg>
                        <div class="absolute inset-0 flex items-center justify-center">
                            <span class="text-2xl font-bold text-gray-900">41%</span>
                        </div>
                    </div>
                </div>
                <div class="text-center mt-4">
                    <p class="text-sm text-gray-600">Project completed</p>
                </div>
            </div>

            <!-- Time Tracker -->
            <div class="bg-gradient-to-br from-[#185B3C] to-[#0F3D26] rounded-xl p-6 text-white">
                <div class="flex items-center justify-between mb-4">
                    <h3 class="text-lg font-semibold">Time Tracker</h3>
                    <button class="text-white/80 hover:text-white">
                        <i class="fas fa-ellipsis-h"></i>
                    </button>
                </div>
                <div class="text-center">
                    <p class="text-3xl font-bold mb-2">01:24:08</p>
                    <div class="flex justify-center space-x-2">
                        <button class="w-8 h-8 bg-white/20 rounded-full flex items-center justify-center hover:bg-white/30">
                            <i class="fas fa-play text-sm"></i>
                        </button>
                        <button class="w-8 h-8 bg-white/20 rounded-full flex items-center justify-center hover:bg-white/30">
                            <i class="fas fa-pause text-sm"></i>
                        </button>
                        <button class="w-8 h-8 bg-red-500/80 rounded-full flex items-center justify-center hover:bg-red-500">
                            <i class="fas fa-stop text-sm"></i>
                        </button>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Team Collaboration & Reminders -->
    <div class="grid grid-cols-1 lg:grid-cols-2 gap-6">
        <!-- Team Collaboration -->
        <div class="bg-white rounded-xl p-6 shadow-sm border border-gray-100">
            <div class="flex justify-between items-center mb-6">
                <h3 class="text-lg font-semibold text-gray-900">Team Collaboration</h3>
                <button class="text-sm text-[#185B3C] hover:text-[#0F3D26] font-medium">+ Add Member</button>
            </div>
            <div class="space-y-4">
                <div class="flex items-center space-x-3">
                    <div class="w-10 h-10 bg-[#185B3C] rounded-full flex items-center justify-center">
                        <span class="text-white text-sm font-medium">AA</span>
                    </div>
                    <div class="flex-1">
                        <p class="font-medium text-gray-900">Alexandria Abell</p>
                        <p class="text-sm text-gray-500">Product Manager</p>
                    </div>
                    <div class="flex space-x-1">
                        <div class="w-3 h-3 bg-green-400 rounded-full"></div>
                        <div class="w-3 h-3 bg-blue-400 rounded-full"></div>
                        <div class="w-3 h-3 bg-yellow-400 rounded-full"></div>
                    </div>
                </div>
                
                <div class="flex items-center space-x-3">
                    <div class="w-10 h-10 bg-blue-600 rounded-full flex items-center justify-center">
                        <span class="text-white text-sm font-medium">EA</span>
                    </div>
                    <div class="flex-1">
                        <p class="font-medium text-gray-900">Ethan Andrews</p>
                        <p class="text-sm text-gray-500">UI/UX Designer</p>
                    </div>
                    <div class="flex space-x-1">
                        <div class="w-3 h-3 bg-green-400 rounded-full"></div>
                        <div class="w-3 h-3 bg-purple-400 rounded-full"></div>
                    </div>
                </div>
                
                <div class="flex items-center space-x-3">
                    <div class="w-10 h-10 bg-orange-600 rounded-full flex items-center justify-center">
                        <span class="text-white text-sm font-medium">NS</span>
                    </div>
                    <div class="flex-1">
                        <p class="font-medium text-gray-900">Nolan Siphron</p>
                        <p class="text-sm text-gray-500">Full Stack Developer</p>
                    </div>
                    <div class="flex space-x-1">
                        <div class="w-3 h-3 bg-green-400 rounded-full"></div>
                        <div class="w-3 h-3 bg-red-400 rounded-full"></div>
                        <div class="w-3 h-3 bg-blue-400 rounded-full"></div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Reminders & Tasks -->
        <div class="bg-white rounded-xl p-6 shadow-sm border border-gray-100">
            <div class="flex justify-between items-center mb-6">
                <h3 class="text-lg font-semibold text-gray-900">Reminders</h3>
                <button class="text-sm text-[#185B3C] hover:text-[#0F3D26] font-medium">+ New</button>
            </div>
            <div class="space-y-4">
                <div class="flex items-start space-x-3 p-3 bg-[#185B3C]/5 rounded-xl">
                    <div class="w-2 h-2 bg-[#185B3C] rounded-full mt-2"></div>
                    <div class="flex-1">
                        <p class="font-medium text-gray-900">Meeting with Arc Company</p>
                        <p class="text-sm text-gray-500">Thursday 2:30 PM</p>
                        <button class="mt-2 bg-[#185B3C] text-white px-4 py-1.5 rounded-lg text-sm hover:bg-[#0F3D26]">Start Meeting</button>
                    </div>
                </div>
                
                <div class="flex items-start space-x-3 p-3 hover:bg-gray-50 rounded-xl transition-colors">
                    <div class="w-2 h-2 bg-blue-400 rounded-full mt-2"></div>
                    <div class="flex-1">
                        <p class="font-medium text-gray-900">Develop API Endpoints</p>
                        <p class="text-sm text-gray-500">Due tomorrow</p>
                    </div>
                </div>
                
                <div class="flex items-start space-x-3 p-3 hover:bg-gray-50 rounded-xl transition-colors">
                    <div class="w-2 h-2 bg-green-400 rounded-full mt-2"></div>
                    <div class="flex-1">
                        <p class="font-medium text-gray-900">Onboarding Flow</p>
                        <p class="text-sm text-gray-500">In progress</p>
                    </div>
                </div>
                
                <div class="flex items-start space-x-3 p-3 hover:bg-gray-50 rounded-xl transition-colors">
                    <div class="w-2 h-2 bg-yellow-400 rounded-full mt-2"></div>
                    <div class="flex-1">
                        <p class="font-medium text-gray-900">Build Dashboard</p>
                        <p class="text-sm text-gray-500">Next week</p>
                    </div>
                </div>
                
                <div class="flex items-start space-x-3 p-3 hover:bg-gray-50 rounded-xl transition-colors">
                    <div class="w-2 h-2 bg-purple-400 rounded-full mt-2"></div>
                    <div class="flex-1">
                        <p class="font-medium text-gray-900">Optimize Page Load</p>
                        <p class="text-sm text-gray-500">This month</p>
                    </div>
                </div>
                
                <div class="flex items-start space-x-3 p-3 hover:bg-gray-50 rounded-xl transition-colors">
                    <div class="w-2 h-2 bg-red-400 rounded-full mt-2"></div>
                    <div class="flex-1">
                        <p class="font-medium text-gray-900">Create Browser Testing</p>
                        <p class="text-sm text-gray-500">Pending</p>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Recent Activity Feed -->
    <div class="bg-white rounded-xl p-6 shadow-sm border border-gray-100">
        <div class="flex justify-between items-center mb-6">
            <h3 class="text-lg font-semibold text-gray-900">Recent Activity</h3>
            <button class="text-sm text-gray-500 hover:text-gray-700 font-medium">View All</button>
        </div>
        
        <div class="space-y-4">
            <div class="flex items-start space-x-4">
                <div class="w-10 h-10 bg-[#185B3C]/10 rounded-full flex items-center justify-center flex-shrink-0">
                    <i class="fas fa-check text-[#185B3C]"></i>
                </div>
                <div class="flex-1">
                    <p class="text-sm text-gray-900"><span class="font-medium">KKPR Service</span> has been completed successfully</p>
                    <p class="text-xs text-gray-500 mt-1">2 hours ago</p>
                </div>
            </div>
            
            <div class="flex items-start space-x-4">
                <div class="w-10 h-10 bg-blue-100 rounded-full flex items-center justify-center flex-shrink-0">
                    <i class="fas fa-user-plus text-blue-600"></i>
                </div>
                <div class="flex-1">
                    <p class="text-sm text-gray-900"><span class="font-medium">New user</span> registered to the system</p>
                    <p class="text-xs text-gray-500 mt-1">4 hours ago</p>
                </div>
            </div>
            
            <div class="flex items-start space-x-4">
                <div class="w-10 h-10 bg-orange-100 rounded-full flex items-center justify-center flex-shrink-0">
                    <i class="fas fa-clock text-orange-600"></i>
                </div>
                <div class="flex-1">
                    <p class="text-sm text-gray-900"><span class="font-medium">Document review</span> is pending approval</p>
                    <p class="text-xs text-gray-500 mt-1">6 hours ago</p>
                </div>
            </div>
            
            <div class="flex items-start space-x-4">
                <div class="w-10 h-10 bg-purple-100 rounded-full flex items-center justify-center flex-shrink-0">
                    <i class="fas fa-database text-purple-600"></i>
                </div>
                <div class="flex-1">
                    <p class="text-sm text-gray-900"><span class="font-medium">System backup</span> completed successfully</p>
                    <p class="text-xs text-gray-500 mt-1">8 hours ago</p>
                </div>
            </div>
            
            <div class="flex items-start space-x-4">
                <div class="w-10 h-10 bg-red-100 rounded-full flex items-center justify-center flex-shrink-0">
                    <i class="fas fa-exclamation-triangle text-red-600"></i>
                </div>
                <div class="flex-1">
                    <p class="text-sm text-gray-900"><span class="font-medium">Security alert:</span> Failed login attempts detected</p>
                    <p class="text-xs text-gray-500 mt-1">12 hours ago</p>
                </div>
            </div>
        </div>
    </div>
</div>

<style>
    .progress-ring {
        transition: stroke-dashoffset 0.35s;
        transform: rotate(-90deg);
        transform-origin: 50% 50%;
    }
</style>

<script>
    document.addEventListener('DOMContentLoaded', function() {
        // Add some animation to cards on load
        const cards = document.querySelectorAll('.bg-white');
        cards.forEach((card, index) => {
            card.style.opacity = '0';
            card.style.transform = 'translateY(20px)';
            setTimeout(() => {
                card.style.transition = 'all 0.5s ease';
                card.style.opacity = '1';
                card.style.transform = 'translateY(0)';
            }, index * 100);
        });

        // Simulate real-time updates for stats
        setInterval(() => {
            const timeTracker = document.querySelector('.text-3xl.font-bold.mb-2');
            if (timeTracker && timeTracker.textContent.includes(':')) {
                let time = timeTracker.textContent.split(':');
                let hours = parseInt(time[0]);
                let minutes = parseInt(time[1]);
                let seconds = parseInt(time[2]);
                
                seconds++;
                if (seconds >= 60) {
                    seconds = 0;
                    minutes++;
                    if (minutes >= 60) {
                        minutes = 0;
                        hours++;
                    }
                }
                
                timeTracker.textContent = 
                    String(hours).padStart(2, '0') + ':' + 
                    String(minutes).padStart(2, '0') + ':' + 
                    String(seconds).padStart(2, '0');
            }
        }, 1000);
    });
</script>
@endsection