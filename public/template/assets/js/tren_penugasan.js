const tren_penugasan = document.getElementById('tren_penugasan');

  new Chart(tren_penugasan, {
    type: 'bar',
    data: {
      labels: ['Januari', 'Februari', 'Maret', 'April', 'Mei', 'Juni', 'Juli', 'Agustus', 'September', 'Oktober', 'November', 'Desember'],
      datasets: [{
        label: "Tren Penugasan",
        data: [4, 3, 6, 3, 10, 28, 3, 5, 6, 7,11,14],
        borderWidth: 1
      }]
    },
    options: {
      scales: {
        y: {
          beginAtZero: true
        }
      }
    }
    });
