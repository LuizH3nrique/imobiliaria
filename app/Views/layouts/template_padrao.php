<!-- application/views/layouts/default.php -->

<!DOCTYPE html>
<html lang="pt-br">

<head>
	<meta charset="utf-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<meta name="description" content="">
	<meta name="author" content="">

	<title>IMOBI - DOHNCODE</title>


	<script src="https://code.jquery.com/jquery-3.7.1.min.js" integrity="sha256-/JqT3SQfawRcv/BIHPThkBvs0OEvtFFmqPF/lYI/Cxo=" crossorigin="anonymous"></script>
	<script src="<?php echo base_url('public/themes/dist/js/app.js') ?>"></script>
	<link href="<?php echo base_url('public/themes/dist/css/modern.css') ?>" rel="stylesheet">
	<!-- Seus estilos, scripts, meta tags, etc. aqui -->

	<!-- MASK jquery-->
	<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery.mask/1.14.16/jquery.mask.min.js" integrity="sha512-pHVGpX7F/27yZ0ISY+VVjyULApbDlD0/X0rgGbTqCE7WFW5MezNTWG/dnhtbBuICzsd0WQPgpE4REBLv+UqChw==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
	<script src="https://cdn.jsdelivr.net/npm/jquery-mask-plugin@1.14.16/dist/jquery.mask.min.js"></script>
	<!-- CDN select2-->
	<link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet" />
	<script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>

	<link rel="stylesheet" href="https://cdn.datatables.net/1.13.7/css/jquery.dataTables.min.css">
	<script src="https://cdn.datatables.net/1.13.7/js/jquery.dataTables.min.js"></script>

	<link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/responsive/2.2.9/css/responsive.dataTables.min.css">
	<script type="text/javascript" src="https://cdn.datatables.net/responsive/2.2.9/js/dataTables.responsive.min.js"></script>


</head>
<style>
	@import url('https://fonts.googleapis.com/css2?family=Montserrat:wght@400;700&display=swap');

	/* Aplicar a fonte a todos os elementos <h> */
	h1,
	h2 {
		font-family: 'Montserrat', sans-serif;
		font-weight: bold;
		font-size: 20px;
	}

	h3,
	h4,
	h5,
	h6 {
		font-family: 'Montserrat', sans-serif;
		font-size: 14px;
	}

	.card-title {
		font-family: 'Montserrat', sans-serif;
		font-weight: bold;
	}

	label {
		font-family: 'Montserrat', sans-serif;
		font-size: 13px;
		font-weight: bold;
	}

	/* Aplicar a fonte a todos os parágrafos <p> */
	p {
		font-family: 'Montserrat', sans-serif;
		font-size: 14px;
	}

	/* Aplicar a fonte a todos os outros textos */
	body {
		font-family: 'Montserrat', sans-serif;
	}
</style>

<body>


	<div class="splash active">
		<div class="splash-icon"></div>
	</div>

	<div class="wrapper">
		<nav id="sidebar" class="sidebar">
			<a class='sidebar-brand' href='<?php echo base_url('/') ?>'>
				<svg>
					<use xlink:href="#ion-ios-pulse-strong"></use>
				</svg>
				IMOBI
			</a>
			<div class="sidebar-content">
				<div class="sidebar-user">
					<!-- <img src="img/avatars/avatar.jpg" class="img-fluid rounded-circle mb-2" alt="Linda Miller" /> -->
					<div class="fw-bold"><?php echo auth()->user()->username; ?></div>
					<small>Front-end Developer</small>
				</div>

				<ul class="sidebar-nav">
					<li class="sidebar-header">
						Principal
					</li>
					<li class="sidebar-item">
						<a data-bs-target="#dashboards" data-bs-toggle="collapse" class="sidebar-link">
							<i class="align-middle me-2 fas fa-home"></i> <span class="align-middle">Cadastro</span>
						</a>
						<ul id="dashboards" class="sidebar-dropdown list-unstyled collapse show" data-bs-parent="#sidebar">
							<li class="sidebar-item"><a class='sidebar-link' href='<?php echo base_url('company') ?>'><i class="align-middle me-2 fas fa-solid fa-shop"></i> Empresa</a></li>
							<li class="sidebar-item"><a class='sidebar-link' href='<?php echo base_url('predio') ?>'><i class="align-middle me-2 fas fa-solid fa-building"></i> Prédios</a></li>
							<li class="sidebar-item"><a class='sidebar-link' href='<?php echo base_url('sala') ?>'><i class="align-middle me-2 fas fa-solid fa-kaaba"></i> Salas</a></li>
							<li class="sidebar-item"><a class='sidebar-link' href='<?php echo base_url('cliente') ?>'><i class="align-middle me-2 fas fa-solid fa-people-group"></i></i> Clientes</a></li>
							<li class="sidebar-item"><a class='sidebar-link' href='<?php echo base_url('contrato') ?>'><i class="align-middle me-2 fas fa-solid fa-file-contract"></i> Contratos</a></li>
						</ul>
					</li>
					<li class="sidebar-item">
						<a data-bs-target="#pages" data-bs-toggle="collapse" class="sidebar-link collapsed">
							<i class="align-middle me-2 fas fa-fw fa-file"></i> <span class="align-middle">Notas Fiscais</span>
						</a>
						<ul id="pages" class="sidebar-dropdown list-unstyled collapse " data-bs-parent="#sidebar">
							<li class="sidebar-item"><a class='sidebar-link' href='<?php echo base_url('notas-fiscais/entrada') ?>'>Entrada</a></li>
							<li class="sidebar-item"><a class='sidebar-link' href='<?php echo base_url('notas-fiscais/saida') ?>'>Saída <span class="sidebar-badge badge rounded-pill bg-primary">New</span></a></li>
							<!-- <li class="sidebar-item"><a class='sidebar-link' href='/pages-invoice'>Invoice</a></li>
							<li class="sidebar-item"><a class='sidebar-link' href='/pages-pricing'>Pricing</a></li>
							<li class="sidebar-item"><a class='sidebar-link' href='/pages-tasks'>Tasks</a></li>
							<li class="sidebar-item"><a class='sidebar-link' href='/pages-chat'>Chat <span class="sidebar-badge badge rounded-pill bg-primary">New</span></a></li>
							<li class="sidebar-item"><a class='sidebar-link' href='/pages-blank'>Blank Page</a></li> -->
						</ul>
					</li>
					<!-- <li class="sidebar-item">
						<a data-bs-target="#auth" data-bs-toggle="collapse" class="sidebar-link collapsed">
							<i class="align-middle me-2 fas fa-fw fa-sign-in-alt"></i> <span class="align-middle">Auth</span>
						</a>
						<ul id="auth" class="sidebar-dropdown list-unstyled collapse " data-bs-parent="#sidebar">
							<li class="sidebar-item"><a class='sidebar-link' href='/pages-sign-in'>Sign
									In</a></li>
							<li class="sidebar-item"><a class='sidebar-link' href='/pages-sign-up'>Sign
									Up</a></li>
							<li class="sidebar-item"><a class='sidebar-link' href='/pages-reset-password'>Reset Password</a></li>
							<li class="sidebar-item"><a class='sidebar-link' href='/pages-404'>404
									Page</a></li>
							<li class="sidebar-item"><a class='sidebar-link' href='/pages-500'>500
									Page</a></li>
						</ul>
					</li> -->

					<!-- <li class="sidebar-header">
						Elements
					</li> -->
					<!-- <li class="sidebar-item">
						<a data-bs-target="#ui" data-bs-toggle="collapse" class="sidebar-link collapsed">
							<i class="align-middle me-2 fas fa-fw fa-flask"></i> <span class="align-middle">User Interface</span>
						</a>
						<ul id="ui" class="sidebar-dropdown list-unstyled collapse " data-bs-parent="#sidebar">
							<li class="sidebar-item"><a class='sidebar-link' href='/ui-alerts'>Alerts</a></li>
							<li class="sidebar-item"><a class='sidebar-link' href='/ui-buttons'>Buttons</a></li>
							<li class="sidebar-item"><a class='sidebar-link' href='/ui-cards'>Cards</a></li>
							<li class="sidebar-item"><a class='sidebar-link' href='/ui-general'>General</a></li>
							<li class="sidebar-item"><a class='sidebar-link' href='/ui-grid'>Grid</a>
							</li>
							<li class="sidebar-item"><a class='sidebar-link' href='/ui-modals'>Modals</a></li>
							<li class="sidebar-item"><a class='sidebar-link' href='/ui-offcanvas'>Offcanvas</a></li>
							<li class="sidebar-item"><a class='sidebar-link' href='/ui-placeholders'>Placeholders</a></li>
							<li class="sidebar-item"><a class='sidebar-link' href='/ui-notifications'>Notifications</a></li>
							<li class="sidebar-item"><a class='sidebar-link' href='/ui-tabs'>Tabs</a>
							</li>
							<li class="sidebar-item"><a class='sidebar-link' href='/ui-typography'>Typography</a></li>
						</ul>
					</li> -->
					<!-- <li class="sidebar-item">
						<a data-bs-target="#charts" data-bs-toggle="collapse" class="sidebar-link collapsed">
							<i class="align-middle me-2 fas fa-fw fa-chart-pie"></i> <span class="align-middle">Charts</span>
							<span class="sidebar-badge badge rounded-pill bg-primary">New</span>
						</a>
						<ul id="charts" class="sidebar-dropdown list-unstyled collapse " data-bs-parent="#sidebar">
							<li class="sidebar-item"><a class='sidebar-link' href='/charts-chartjs'>Chart.js</a></li>
							<li class="sidebar-item"><a class='sidebar-link' href='/charts-apexcharts'>ApexCharts</a></li>
						</ul>
					</li> -->

					<!-- <li class="sidebar-item">
						<a data-bs-target="#forms" data-bs-toggle="collapse" class="sidebar-link collapsed">
							<i class="align-middle me-2 fas fa-fw fa-check-square"></i> <span class="align-middle">Forms</span>
						</a>
						<ul id="forms" class="sidebar-dropdown list-unstyled collapse " data-bs-parent="#sidebar">
							<li class="sidebar-item"><a class='sidebar-link' href='/forms-layouts'>Layouts</a></li>
							<li class="sidebar-item"><a class='sidebar-link' href='/forms-basic-elements'>Basic Elements</a></li>
							<li class="sidebar-item"><a class='sidebar-link' href='/forms-advanced-elements'>Advanced Elements</a></li>
							<li class="sidebar-item"><a class='sidebar-link' href='/forms-floating-labels'>Floating Labels</a></li>
							<li class="sidebar-item"><a class='sidebar-link' href='/forms-input-groups'>Input Groups</a></li>
							<li class="sidebar-item"><a class='sidebar-link' href='/forms-editors'>Editors</a></li>
							<li class="sidebar-item"><a class='sidebar-link' href='/forms-validation'>Validation</a></li>
							<li class="sidebar-item"><a class='sidebar-link' href='/forms-wizard'>Wizard</a></li>
						</ul>
					</li> -->
					<!-- <li class="sidebar-item">
						<a class='sidebar-link' href='/tables-bootstrap'>
							<i class="align-middle me-2 fas fa-fw fa-list"></i> <span class="align-middle">Tables</span>
						</a>
					</li>
					<li class="sidebar-item">
						<a data-bs-target="#datatables" data-bs-toggle="collapse" class="sidebar-link collapsed">
							<i class="align-middle me-2 fas fa-fw fa-table"></i> <span class="align-middle">DataTables</span>
						</a>
						<ul id="datatables" class="sidebar-dropdown list-unstyled collapse " data-bs-parent="#sidebar">
							<li class="sidebar-item"><a class='sidebar-link' href='/tables-datatables-responsive'>Responsive Table</a></li>
							<li class="sidebar-item"><a class='sidebar-link' href='/tables-datatables-buttons'>Table with Buttons</a></li>
							<li class="sidebar-item"><a class='sidebar-link' href='/tables-datatables-column-search'>Column Search</a></li>
							<li class="sidebar-item"><a class='sidebar-link' href='/tables-datatables-fixed-header'>Fixed Header</a></li>
							<li class="sidebar-item"><a class='sidebar-link' href='/tables-datatables-multi'>Multi Selection</a></li>
							<li class="sidebar-item"><a class='sidebar-link' href='/tables-datatables-ajax'>Ajax Sourced Data</a></li>
						</ul>
					</li> -->

				</ul>
			</div>
		</nav>
		<div class="main">
			<nav class="navbar navbar-expand navbar-theme">
				<a class="sidebar-toggle d-flex me-2">
					<i class="hamburger align-self-center"></i>
				</a>

				<form class="d-none d-sm-inline-block">
					<input class="form-control form-control-lite" type="text" placeholder="Search projects...">
				</form>

				<div class="navbar-collapse collapse">
					<ul class="navbar-nav ms-auto">
						<li class="nav-item dropdown active">
							<a class="nav-link dropdown-toggle position-relative" href="#" id="messagesDropdown" data-bs-toggle="dropdown">
								<i class="align-middle fas fa-envelope-open"></i>
							</a>
							<div class="dropdown-menu dropdown-menu-lg dropdown-menu-end py-0" aria-labelledby="messagesDropdown">
								<div class="dropdown-menu-header">
									<div class="position-relative">
										4 New Messages
									</div>
								</div>
								<div class="list-group">

									<div class="dropdown-menu-footer">
										<a href="#" class="text-muted">Show all messages</a>
									</div>
								</div>
						</li>
						<li class="nav-item dropdown ms-lg-2">
							<a class="nav-link dropdown-toggle position-relative" href="#" id="alertsDropdown" data-bs-toggle="dropdown">
								<i class="align-middle fas fa-bell"></i>
								<span class="indicator"></span>
							</a>
							<div class="dropdown-menu dropdown-menu-lg dropdown-menu-end py-0" aria-labelledby="alertsDropdown">
								<div class="dropdown-menu-header">
									4 New Notifications
								</div>
								<div class="list-group">
									<a href="#" class="list-group-item">
										<div class="row g-0 align-items-center">
											<div class="col-2">
												<i class="ms-1 text-danger fas fa-fw fa-bell"></i>
											</div>
											<div class="col-10">
												<div class="text-dark">Update completed</div>
												<div class="text-muted small mt-1">Restart server 12 to complete the update.</div>
												<div class="text-muted small mt-1">2h ago</div>
											</div>
										</div>
									</a>
									<a href="#" class="list-group-item">
										<div class="row g-0 align-items-center">
											<div class="col-2">
												<i class="ms-1 text-warning fas fa-fw fa-envelope-open"></i>
											</div>
											<div class="col-10">
												<div class="text-dark">Lorem ipsum</div>
												<div class="text-muted small mt-1">Aliquam ex eros, imperdiet vulputate hendrerit et.</div>
												<div class="text-muted small mt-1">6h ago</div>
											</div>
										</div>
									</a>
									<a href="#" class="list-group-item">
										<div class="row g-0 align-items-center">
											<div class="col-2">
												<i class="ms-1 text-primary fas fa-fw fa-building"></i>
											</div>
											<div class="col-10">
												<div class="text-dark">Login from 192.186.1.1</div>
												<div class="text-muted small mt-1">8h ago</div>
											</div>
										</div>
									</a>
									<a href="#" class="list-group-item">
										<div class="row g-0 align-items-center">
											<div class="col-2">
												<i class="ms-1 text-success fas fa-fw fa-bell-slash"></i>
											</div>
											<div class="col-10">
												<div class="text-dark">New connection</div>
												<div class="text-muted small mt-1">Anna accepted your request.</div>
												<div class="text-muted small mt-1">12h ago</div>
											</div>
										</div>
									</a>
								</div>
								<div class="dropdown-menu-footer">
									<a href="#" class="text-muted">Show all notifications</a>
								</div>
							</div>
						</li>
						<li class="nav-item dropdown ms-lg-2">
							<a class="nav-link dropdown-toggle position-relative" href="#" id="userDropdown" data-bs-toggle="dropdown">
								<i class="align-middle fas fa-cog"></i>
							</a>
							<div class="dropdown-menu dropdown-menu-end" aria-labelledby="userDropdown">
								<!-- <a class="dropdown-item" href="#"><i class="align-middle me-1 fas fa-fw fa-user"></i> View Profile</a>
								<a class="dropdown-item" href="#"><i class="align-middle me-1 fas fa-fw fa-comments"></i> Contacts</a>
								<a class="dropdown-item" href="#"><i class="align-middle me-1 fas fa-fw fa-chart-pie"></i> Analytics</a> -->
								<a class="dropdown-item" href="<?php echo base_url('/settings') ?>"><i class="align-middle me-1 fas fa-fw fa-cogs"></i> Settings</a>
								<div class="dropdown-divider"></div>
								<a class="dropdown-item" href="<?php echo base_url('/logout'); ?>"><i class="align-middle me-1 fas fa-fw fa-arrow-alt-circle-right"></i> Sign out</a>
							</div>
						</li>
					</ul>
				</div>
			</nav>
			<main class="content">
				<?php echo $content ?>
			</main>
			<footer class="footer">
				<div class="container-fluid">
					<div class="row text-muted">
						<div class="col-8 text-start">
							<ul class="list-inline">
								<li class="list-inline-item">
									<a class="text-muted" href="#">Support</a>
								</li>
								<li class="list-inline-item">
									<a class="text-muted" href="#">Privacy</a>
								</li>
								<li class="list-inline-item">
									<a class="text-muted" href="#">Terms of Service</a>
								</li>
								<li class="list-inline-item">
									<a class="text-muted" href="#">Contact</a>
								</li>
							</ul>
						</div>
						<div class="col-4 text-end">
							<p class="mb-0">
								&copy; 2023 - <a class='text-muted' href='/dashboard-default'>Spark</a>
							</p>
						</div>
					</div>
				</div>
			</footer>
		</div>
	</div>

	<svg width="0" height="0" style="position:absolute">
		<defs>
			<symbol viewBox="0 0 512 512" id="ion-ios-pulse-strong">
				<path d="M448 273.001c-21.27 0-39.296 13.999-45.596 32.999h-38.857l-28.361-85.417a15.999 15.999 0 0 0-15.183-10.956c-.112 0-.224 0-.335.004a15.997 15.997 0 0 0-15.049 11.588l-44.484 155.262-52.353-314.108C206.535 54.893 200.333 48 192 48s-13.693 5.776-15.525 13.135L115.496 306H16v31.999h112c7.348 0 13.75-5.003 15.525-12.134l45.368-182.177 51.324 307.94c1.229 7.377 7.397 11.92 14.864 12.344.308.018.614.028.919.028 7.097 0 13.406-3.701 15.381-10.594l49.744-173.617 15.689 47.252A16.001 16.001 0 0 0 352 337.999h51.108C409.973 355.999 427.477 369 448 369c26.511 0 48-22.492 48-49 0-26.509-21.489-46.999-48-46.999z">
				</path>
			</symbol>
		</defs>
	</svg>

	<script>
		$(document).ready(function() {
			toastr.options = {
				"closeButton": true,
				"debug": false,
				"newestOnTop": false,
				"progressBar": true,
				"positionClass": "toast-top-right",
				"preventDuplicates": false,
				"showDuration": "300",
				"hideDuration": "1000",
				"timeOut": "5000",
				"extendedTimeOut": "1000",
				"showEasing": "swing",
				"hideEasing": "linear",
				"showMethod": "fadeIn",
				"hideMethod": "fadeOut"
			}

			<?php if (session()->has('success')) : ?>
				toastr.success('<?php echo session('success'); ?>')
			<?php endif; ?>

			<?php if (session()->has('error')) : ?>
				toastr.error('<?php echo session('error'); ?>')
			<?php endif; ?>

		});
	</script>
	<script>
		document.addEventListener("DOMContentLoaded", function() {
			// Datatables Responsive
			$("#tabelaResponsivaDataTable").DataTable({
				responsive: true
			});
		});
	</script>
	<script>
		document.addEventListener("DOMContentLoaded", function() {
			// Pie chart
			new Chart(document.getElementById("chartjs-dashboard-pie"), {
				type: 'pie',
				data: {
					labels: ["Chrome", "Firefox", "IE", "Other"],
					datasets: [{
						data: [4401, 4003, 1589],
						backgroundColor: [
							window.theme.primary,
							window.theme.warning,
							window.theme.danger,
							"#E8EAED"
						],
						borderColor: "transparent"
					}]
				},
				options: {
					responsive: !window.MSInputMethodContext,
					maintainAspectRatio: false,
					legend: {
						display: false
					},
					cutoutPercentage: 75
				}
			});
		});
	</script>
	<script>
		document.addEventListener("DOMContentLoaded", function() {
			// Bar chart
			new Chart(document.getElementById("chartjs-dashboard-bar"), {
				type: 'bar',
				data: {
					labels: ["Jan", "Feb", "Mar", "Apr", "May", "Jun", "Jul", "Aug", "Sep", "Oct", "Nov", "Dec"],
					datasets: [{
						label: "This year",
						backgroundColor: window.theme.primary,
						borderColor: window.theme.primary,
						hoverBackgroundColor: window.theme.primary,
						hoverBorderColor: window.theme.primary,
						data: [54, 67, 41, 55, 62, 45, 55, 73, 60, 76, 48, 79],
						barPercentage: .75,
						categoryPercentage: .5
					}]
				},
				options: {
					maintainAspectRatio: false,
					legend: {
						display: false
					},
					scales: {
						yAxes: [{
							gridLines: {
								display: false
							},
							stacked: false,
							ticks: {
								stepSize: 20
							}
						}],
						xAxes: [{
							stacked: false,
							gridLines: {
								color: "transparent"
							}
						}]
					}
				}
			});
		});
	</script>
	<script>
		document.addEventListener("DOMContentLoaded", function() {
			var map = new jsVectorMap({
				map: "world",
				selector: "#world_map",
				zoomButtons: true,
				selectedRegions: [
					'US',
					'SA',
					'DE',
					'FR',
					'CN',
					'AU',
					'BR',
					'IN',
					'GB'
				],
				regionStyle: {
					initial: {
						fill: '#e4e4e4',
						"fill-opacity": 0.9,
						stroke: 'none',
						"stroke-width": 0,
						"stroke-opacity": 0
					},
					selected: {
						fill: window.theme.primary,
					}
				},
				zoomOnScroll: false
			});
			window.addEventListener("resize", () => {
				map.updateSize();
			});
			setTimeout(function() {
				map.updateSize();
			}, 250);
		});
	</script>
	<script>
		$(function() {
			$('#datatables-dashboard-projects').DataTable({
				pageLength: 6,
				lengthChange: false,
				bFilter: false,
				autoWidth: false
			});
		});
	</script>
	<script>
		$(function() {
			$('#datetimepicker-dashboard').datetimepicker({
				inline: true,
				sideBySide: false,
				format: 'L'
			});
		});


		$(document).ready(function() {
			$('.date').mask('00/00/0000');
			$('.time').mask('00:00:00');
			$('.date_time').mask('00/00/0000 00:00:00');
			$('.cep').mask('00000-000');
			$('.phone').mask('0000-0000');
			$('.telefone').mask('(00) 0 0000-0000');
			$('.phone_us').mask('(000) 000-0000');
			$('.mixed').mask('AAA 000-S0S');
			$('.cpf').mask('000.000.000-00', {
				reverse: true
			});
			$('.cnpj').mask('00.000.000/0000-00', {
				reverse: true
			});
			$('.money').mask('000.000.000.000.000,00', {
				reverse: true
			});
			$('.money2').mask("#.##0,00", {
				reverse: true
			});
			$('.ip_address').mask('0ZZ.0ZZ.0ZZ.0ZZ', {
				translation: {
					'Z': {
						pattern: /[0-9]/,
						optional: true
					}
				}
			});
			$('.ip_address').mask('099.099.099.099');
			$('.percent').mask('##0,00%', {
				reverse: true
			});
			$('.clear-if-not-match').mask("00/00/0000", {
				clearIfNotMatch: true
			});
			$('.placeholder').mask("00/00/0000", {
				placeholder: "__/__/____"
			});
			$('.fallback').mask("00r00r0000", {
				translation: {
					'r': {
						pattern: /[\/]/,
						fallback: '/'
					},
					placeholder: "__/__/____"
				}
			});
			$('.selectonfocus').mask("00/00/0000", {
				selectOnFocus: true
			});
		});
	</script>
	<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
</body>

</html>