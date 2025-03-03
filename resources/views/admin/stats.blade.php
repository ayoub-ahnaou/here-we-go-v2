<x-dashboard>
    <div class="flex flex-col md:flex-row items-center justify-between mb-6">
        <h2 class="text-xl font-bold text-gray-800 mb-4 md:mb-0">Data Visualisation</h2>
    </div>

    <div class="bg-white shadow-md rounded-sm overflow-hidden">

        <div class="overflow-x-auto">

            <!-- Afficher des informations -->
            <div class="grid grid-cols-1 md:grid-cols-3 gap-4 mb-8">
                <div class="bg-white p-6 rounded-lg shadow-md">
                    <h2 class="text-xl font-semibold">Nombre d'annonces</h2>
                    <p class="text-3xl">{{ $annoncesCount }}</p>
                </div>
                <div class="bg-white p-6 rounded-lg shadow-md">
                    <h2 class="text-xl font-semibold">Nombre d'utilisateurs</h2>
                    <p class="text-3xl">{{ $usersCount }}</p>
                </div>
                <div class="bg-white p-6 rounded-lg shadow-md">
                    <h2 class="text-xl font-semibold">Nombre de catégories</h2>
                    <p class="text-3xl">{{ $categoriesCount }}</p>
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
        </div>
    </div>
</x-dashboard>
