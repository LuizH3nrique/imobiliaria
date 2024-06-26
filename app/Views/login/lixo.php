// Calcular a soma acumulada dos valores mensais
	// $totalAcumulado = 0;
	// $projecaoMensal = [];
	// foreach ($contrato as $val) {
	// 	$totalAcumulado += $val;
	// 	$projecaoMensal[] = $totalAcumulado;
	// }

	// document.addEventListener("DOMContentLoaded", function() {

	// 	// Projeção mês a mês somando os valores recebidos nos meses anteriores
	// 	var projectionValues = [<?php //foreach ($projecaoMensal as $val) echo $val . ','; 
	// 							?>];
	// 	// Line chart
	// 	new Chart(document.getElementById("chartjs-dashboard-line"), {
	// 		type: 'line',
	// 		data: {
	// 			labels: ["Jan", "Feb", "Mar", "Apr", "May", "Jun", "Jul", "Aug", "Sep", "Oct", "Nov", "Dec"],
	// 			datasets: [{
	// 				label: "Projection", // Nome do dataset da projeção
	// 				fill: true,
	// 				backgroundColor: window.theme.primary,
	// 				borderColor: window.theme.primary,
	// 				borderWidth: 2,
	// 				data: projectionValues // Usar os valores da projeção aqui
	// 			}]
	// 		},
	// 		options: {
	// 			maintainAspectRatio: false,
	// 			legend: {
	// 				display: false
	// 			},
	// 			tooltips: {
	// 				intersect: false
	// 			},
	// 			hover: {
	// 				intersect: true
	// 			},
	// 			plugins: {
	// 				filler: {
	// 					propagate: false
	// 				}
	// 			},
	// 			elements: {
	// 				point: {
	// 					radius: 0
	// 				}
	// 			},
	// 			scales: {
	// 				xAxes: [{
	// 					reverse: true,
	// 					gridLines: {
	// 						color: "rgba(0,0,0,0.0)"
	// 					}
	// 				}],
	// 				yAxes: [{
	// 					ticks: {
	// 						stepSize: 100000
	// 					},
	// 					display: true,
	// 					gridLines: {
	// 						color: "rgba(0,0,0,0)",
	// 						fontColor: "#fff"
	// 					}
	// 				}]
	// 			}
	// 		}
	// 	});
	// });