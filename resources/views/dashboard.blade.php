<x-panel-layout>
    <div class="space-y-8">
        <!-- Header -->
        <div class="flex items-center justify-between">
            <div>
                <h1 class="text-3xl font-bold text-white">Bonjour, {{ Auth::user()->name }} 👋</h1>
                <p class="text-gray-400 mt-1">Voici un aperçu de vos performances influenceur.</p>
            </div>
        </div>

        <!-- Stats Grid -->
        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-6">
            <!-- Portée -->
            <div class="bg-[#1C1C1C] rounded-2xl p-6 border border-white/5">
                <div class="flex items-start justify-between mb-4">
                    <p class="text-gray-400 text-sm font-medium">Portée Totale</p>
                    <div class="p-2 bg-primary/20 rounded-lg text-primary">
                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4.354a4 4 0 110 5.292M15 21H3v-1a6 6 0 0112 0v1zm0 0h6v-1a6 6 0 00-9-5.197M13 7a4 4 0 11-8 0 4 4 0 018 0z"></path>
                        </svg>
                    </div>
                </div>
                <h3 class="text-3xl font-bold text-white">1223</h3>
            </div>

            <!-- Engagement -->
            <div class="bg-[#1C1C1C] rounded-2xl p-6 border border-white/5">
                <div class="flex items-start justify-between mb-4">
                    <p class="text-gray-400 text-sm font-medium">Engagement Moyen</p>
                    <div class="p-2 bg-accent/20 rounded-lg text-accent">
                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 7h8m0 0v8m0-8l-8 8-4-4-6 6"></path>
                        </svg>
                    </div>
                </div>
                <h3 class="text-3xl font-bold text-white">0.00%</h3>
            </div>

            <!-- CTR -->
            <div class="bg-[#1C1C1C] rounded-2xl p-6 border border-white/5">
                <div class="flex items-start justify-between mb-4">
                    <p class="text-gray-400 text-sm font-medium">CTR Moyen</p>
                    <div class="p-2 bg-primary/20 rounded-lg text-primary">
                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 15l-2 5L9 9l11 4-5 2zm0 0l5 5M7.188 2.239l.777 2.897M5.136 7.965l-2.898-.777M13.95 4.05l-2.122 2.122m-5.657 5.656l-2.12 2.122"></path>
                        </svg>
                    </div>
                </div>
                <h3 class="text-3xl font-bold text-white">183.57%</h3>
            </div>

            <!-- Conversions -->
            <div class="bg-[#1C1C1C] rounded-2xl p-6 border border-white/5">
                <div class="flex items-start justify-between mb-4">
                    <p class="text-gray-400 text-sm font-medium">Conversions</p>
                    <div class="p-2 bg-accent/20 rounded-lg text-accent">
                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8c-1.657 0-3 .895-3 2s1.343 2 3 2 3 .895 3 2-1.343 2-3 2m0-8c1.11 0 2.08.402 2.599 1M12 8V7m0 1v8m0 0v1m0-1c-1.11 0-2.08-.402-2.599-1M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                        </svg>
                    </div>
                </div>
                <h3 class="text-3xl font-bold text-white">245</h3>
            </div>
        </div>

        <!-- Charts Section -->
        <div class="grid grid-cols-1 lg:grid-cols-3 gap-8">
            <!-- Main Chart -->
            <div class="lg:col-span-2 bg-[#1C1C1C] rounded-2xl p-8 border border-white/5">
                <h3 class="text-lg font-bold text-white mb-6">Performance par Campagne</h3>
                <div class="w-full h-80">
                    <canvas id="campaignChart"></canvas>
                </div>
            </div>

            <!-- Donut Chart -->
            <div class="bg-[#1C1C1C] rounded-2xl p-8 border border-white/5">
                <h3 class="text-lg font-bold text-white mb-6">Répartition par Plateforme</h3>
                <div class="w-full h-64 flex items-center justify-center relative">
                    <canvas id="platformChart"></canvas>
                </div>
                <div class="flex justify-center gap-4 mt-6">
                    <div class="flex items-center gap-2">
                        <span class="w-3 h-3 rounded-full bg-[#FF4FA2]"></span>
                        <span class="text-sm text-gray-400">Instagram</span>
                    </div>
                    <div class="flex items-center gap-2">
                        <span class="w-3 h-3 rounded-full bg-[#1C1C1C] border border-gray-600"></span>
                        <span class="text-sm text-gray-400">TikTok</span>
                    </div>
                    <div class="flex items-center gap-2">
                        <span class="w-3 h-3 rounded-full bg-red-500"></span>
                        <span class="text-sm text-gray-400">YouTube</span>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <script>
        document.addEventListener('DOMContentLoaded', function() {
            // Campaign Bar Chart
            const ctx = document.getElementById('campaignChart').getContext('2d');
            new Chart(ctx, {
                type: 'bar',
                data: {
                    labels: ['Nike'],
                    datasets: [{
                        label: 'Performance',
                        data: [1200],
                        backgroundColor: '#00D084',
                        borderRadius: 4,
                        barThickness: 150
                    }]
                },
                options: {
                    responsive: true,
                    maintainAspectRatio: false,
                    plugins: {
                        legend: {
                            display: false
                        }
                    },
                    scales: {
                        y: {
                            beginAtZero: true,
                            grid: {
                                color: 'rgba(255, 255, 255, 0.1)'
                            },
                            ticks: {
                                color: '#9CA3AF'
                            }
                        },
                        x: {
                            grid: {
                                display: false
                            },
                            ticks: {
                                color: '#9CA3AF'
                            }
                        }
                    }
                }
            });

            // Platform Donut Chart
            const ctxDonut = document.getElementById('platformChart').getContext('2d');
            new Chart(ctxDonut, {
                type: 'doughnut',
                data: {
                    labels: ['Instagram', 'TikTok', 'YouTube'],
                    datasets: [{
                        data: [60, 25, 15],
                        backgroundColor: ['#FF4FA2', '#000000', '#EF4444'],
                        borderColor: 'transparent',
                        hoverOffset: 4
                    }]
                },
                options: {
                    responsive: true,
                    maintainAspectRatio: false,
                    cutout: '70%',
                    plugins: {
                        legend: {
                            display: false
                        }
                    }
                }
            });
        });
    </script>
</x-panel-layout>