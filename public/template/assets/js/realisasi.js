const realisasi = document.getElementById('realisasi');

  new Chart(realisasi, {
    type: 'doughnut',
    data: {
      labels: ['Surat Tugas', 'Laporan'],
      datasets: [{
        data: [194, 170],
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
