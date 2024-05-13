function init() {

}

document.addEventListener("DOMContentLoaded", function () {

    let xhr = new XMLHttpRequest();
    xhr.open(
        'GET',
        '../../Controller/ctrTareas.php?op_tarea=get_total_tareas_grafico',
        true);

    xhr.onreadystatechange = function () {
        if (xhr.readyState == 4 && xhr.status == 200) {
            let data = xhr.responseText;
            data = JSON.parse(data);
            let servicio = data.map(elem => elem.servicio);
            let total = data.map(elem => elem.total);

            function barTareas() {
                const barTareas = document.getElementById('barTareas');
                new Chart(barTareas, {
                    type: 'bar',
                    data: {
                        labels: servicio,
                        datasets: [{
                            label: 'Total de servicios realizados',
                            data: total,
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
            }
            barTareas()

            function donutTareas() {

                var datos = {
                    labels: servicio,
                    datasets: [{
                        data: total,
                        backgroundColor: ['gold', 'lightcoral', 'lightskyblue', 'lightgreen', '#FF6384', '#36A2EB', '#FFCE56', '#4BC0C0', '#9966FF', '#FF9F40', '#FF5733']
                    }]
                };

                var opciones = {
                    title: {
                        display: true,
                        text: 'Gráfico de Dona',
                        fontSize: 18
                    }
                };
                var ctx = document.getElementById('donutTareas').getContext('2d');

                // Crear el gráfico de dona
                var donutTareas = new Chart(ctx, {
                    type: 'doughnut',
                    data: datos,
                    options: opciones
                });
            }
            donutTareas()

        }
    }

    xhr.send();
});


init();