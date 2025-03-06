<x-dashboard>
    <div class="flex flex-col md:flex-row items-center justify-between mb-6">
        <h2 class="text-xl font-bold text-gray-800 mb-4 md:mb-0">Data Visualisation</h2>
    </div>

    <div class="bg-white shadow-md rounded-sm overflow-hidden">

        <div class="overflow-x-auto">

            <!-- Afficher des informations -->
            <div class="grid grid-cols-1 md:grid-cols-4 gap-4 mb-8 text-gray-700">
                <div class="bg-white p-6 rounded-lg shadow-md flex items-center gap-1">
                    <p class="text-lg">{{ $annoncesCount }}</p>
                    <h2 class="text-sm font-semibold">annonces</h2>
                </div>
                <div class="bg-white p-6 rounded-lg shadow-md flex items-center gap-1">
                    <p class="text-lg">{{ $usersCount }}</p>
                    <h2 class="text-sm font-semibold">utilisateurs</h2>
                </div>
                <div class="bg-white p-6 rounded-lg shadow-md flex items-center gap-1">
                    <p class="text-lg">{{ $categoriesCount }}</p>
                    <h2 class="text-sm font-semibold">catégories</h2>
                </div>
                <div class="bg-white p-6 rounded-lg shadow-md flex items-center gap-1">
                    <p class="text-lg">{{ $reservations }}</p>
                    <h2 class="text-sm font-semibold">reservations</h2>
                </div>
            </div>

            <div class="flex w-full gap-8">
                <!-- Graphique : Annonces par catégorie -->
                <div class="bg-white p-6 rounded-lg shadow-md w-2/3">
                    <h2 class="text-xl font-semibold mb-4">Annonces par catégorie</h2>
                    <canvas id="annoncesByCategoryChart" height="100"></canvas>
                </div>

                <div class="bg-white p-6 rounded-lg shadow-md w-1/3">
                    <h2 class="text-xl font-semibold mb-4">Répartition des annonces par catégorie</h2>
                    <canvas id="annoncesByCategoryPieChart" height="50"></canvas>
                </div>
            </div>

            <!-- Inclure Chart.js -->
            <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
            <script>
                // Données pour le graphique
                const annoncesByCategoryData = {
                    labels: {!! json_encode($annoncesByCategory->pluck('name')) !!},
                    datasets: [{
                        label: 'Annonces par catégorie',
                        data: {!! json_encode($annoncesByCategory->pluck('annonces_count')) !!},
                        backgroundColor: [
                            'rgba(255, 99, 132, 0.2)',
                            'rgba(54, 162, 235, 0.2)',
                            'rgba(255, 206, 86, 0.2)',
                            'rgba(75, 192, 192, 0.2)',
                            'rgba(153, 102, 255, 0.2)',
                        ],
                        borderColor: [
                            'rgba(255, 99, 132, 1)',
                            'rgba(54, 162, 235, 1)',
                            'rgba(255, 206, 86, 1)',
                            'rgba(75, 192, 192, 1)',
                            'rgba(153, 102, 255, 1)',
                        ],
                        borderWidth: 1
                    }]
                };

                // Configuration du graphique
                const config = {
                    type: 'bar',
                    data: annoncesByCategoryData,
                    options: {
                        scales: {
                            y: {
                                beginAtZero: true
                            }
                        }
                    },
                };

                // Initialiser le graphique
                const annoncesByCategoryChart = new Chart(
                    document.getElementById('annoncesByCategoryChart'),
                    config
                );
            </script>

            <script>
                const annoncesByCategoryPieData = {
                    labels: {!! json_encode($annoncesByCategory->pluck('name')) !!},
                    datasets: [{
                        label: 'Répartition des annonces',
                        data: {!! json_encode($annoncesByCategory->pluck('annonces_count')) !!},
                        backgroundColor: [
                            'rgba(255, 99, 132, 0.2)',
                            'rgba(54, 162, 235, 0.2)',
                            'rgba(255, 206, 86, 0.2)',
                            'rgba(75, 192, 192, 0.2)',
                            'rgba(153, 102, 255, 0.2)',
                        ],
                        borderColor: [
                            'rgba(255, 99, 132, 1)',
                            'rgba(54, 162, 235, 1)',
                            'rgba(255, 206, 86, 1)',
                            'rgba(75, 192, 192, 1)',
                            'rgba(153, 102, 255, 1)',
                        ],
                        borderWidth: 1
                    }]
                };

                const pieConfig = {
                    type: 'pie',
                    data: annoncesByCategoryPieData,
                };

                const annoncesByCategoryPieChart = new Chart(
                    document.getElementById('annoncesByCategoryPieChart'),
                    pieConfig
                );
            </script>

            <div class="flex items-center justify-between w-full gap-2 mt-6">
                <!-- Reservations Over Time Chart -->
                <div class="chart-container bg-white p-6 rounded-lg w-1/2">
                    <h2 class="text-xl font-semibold mb-4">Reservations Over Time</h2>
                    <canvas id="reservationsChart"></canvas>
                </div>

                <!-- Revenue Over Time Chart -->
                <div class="chart-container bg-white p-6 rounded-lg w-1/2">
                    <h2 class="text-xl font-semibold mb-4">Revenue Over Time</h2>
                    <canvas id="revenueChart"></canvas>
                </div>
            </div>

            <script>
                // Pass PHP data to JavaScript
                const dates = @json($dates);
                const reservationsData = @json($reservationsCount);
                const revenueData = @json($revenue);

                // Render Reservations Chart
                const reservationsCtx = document.getElementById('reservationsChart').getContext('2d');
                new Chart(reservationsCtx, {
                    type: 'line',
                    data: {
                        labels: dates,
                        datasets: [{
                            label: 'Number of Reservations',
                            data: reservationsData,
                            borderColor: 'rgba(75, 192, 192, 1)',
                            backgroundColor: 'rgba(75, 192, 192, 0.2)',
                            borderWidth: 2,
                            fill: true
                        }]
                    },
                    options: {
                        scales: {
                            x: {
                                title: {
                                    display: true,
                                    text: 'Date'
                                }
                            },
                            y: {
                                title: {
                                    display: true,
                                    text: 'Reservations'
                                },
                                beginAtZero: true
                            }
                        }
                    }
                });

                // Render Revenue Chart
                const revenueCtx = document.getElementById('revenueChart').getContext('2d');
                new Chart(revenueCtx, {
                    type: 'bar',
                    data: {
                        labels: dates,
                        datasets: [{
                            label: 'Revenue ($)',
                            data: revenueData,
                            backgroundColor: 'rgba(153, 102, 255, 0.2)',
                            borderColor: 'rgba(153, 102, 255, 1)',
                            borderWidth: 2
                        }]
                    },
                    options: {
                        scales: {
                            x: {
                                title: {
                                    display: true,
                                    text: 'Date'
                                }
                            },
                            y: {
                                title: {
                                    display: true,
                                    text: 'Revenue ($)'
                                },
                                beginAtZero: true
                            }
                        }
                    }
                });
            </script>
        </div>
    </div>
</x-dashboard>
