async function renderChart(chartId, endpoint) {
    const ctx = document.getElementById(chartId).getContext('2d');

    try {
        // Ambil data dari endpoint
        const response = await fetch(endpoint);
        const data = await response.json();

        // Render Chart
        new Chart(ctx, {
            type: 'bar', // Ganti dengan tipe chart lain jika perlu
            data: {
                labels: data.labels,
                datasets: data.datasets
            },
            options: {
                responsive: true,
                plugins: {
                    legend: {
                        display: true,
                        position: 'top'
                    }
                },
                scales: {
                    y: {
                        beginAtZero: true
                    }
                }
            }
        });
    } catch (error) {
        console.error('Error loading chart data:', error);
    }
}

export { renderChart };
