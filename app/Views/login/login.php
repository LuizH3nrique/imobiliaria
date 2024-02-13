<div class="container-fluid">

	<div class="header">
		<h1 class="header-title">
			Welcome back, <?php echo auth()->user()->username; ?>
		</h1>
	</div>

	<div class="row">
		<div class="col-xl-8 col-xxl-9">
			<div class="card flex-fill w-100">
				<div class="card-header">
					<div class="card-actions float-end">
						<a href="#" class="me-1">
							<i class="align-middle" data-feather="refresh-cw"></i>
						</a>
						<div class="d-inline-block dropdown show">
							<a href="#" data-bs-toggle="dropdown" data-bs-display="static">
								<i class="align-middle" data-feather="more-vertical"></i>
							</a>

							<div class="dropdown-menu dropdown-menu-end">
								<a class="dropdown-item" href="#">Action</a>
								<a class="dropdown-item" href="#">Another action</a>
								<a class="dropdown-item" href="#">Something else here</a>
							</div>
						</div>
					</div>
					<h5 class="card-title mb-0">Recent Movement</h5>
				</div>
				<div class="card-body py-3">
					<div class="chart chart-sm">
						<canvas id="chartjs-dashboard-line"></canvas>
					</div>
				</div>
			</div>
		</div>

		<div class="col-xl-2 col-xxl-3 d-flex">
			<div class="w-100">
				<div class="row">
					<div class="col-sm-12">
						<div class="card">
							<div class="card-body">
								<div class="row">
									<div class="col mt-0">
										<h5 class="card-title">Projeção</h5>
									</div>

									<div class="col-auto">
										<div class="avatar">
											<div class="avatar-title rounded-circle bg-primary-dark">
												<i class="align-middle" data-feather="dollar-sign"></i>
											</div>
										</div>
									</div>
								</div>
								<h1 class="display-5 mt-1 mb-3 money"><?php echo $totalAnual = array_sum($contrato); ?></h1>
								<div class="mb-0">
									<span class="text-dark">Arrecadação Anual</span>
								</div>
							</div>
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>

	<div class="row">
		<div class="col-12 col-md-6 col-xxl-3 d-flex order-1 order-xxl-1">
			<div class="card flex-fill">
				<div class="card-header">
					<div class="card-actions float-end">
						<a href="#" class="me-1">
							<i class="align-middle" data-feather="refresh-cw"></i>
						</a>
						<div class="d-inline-block dropdown show">
							<a href="#" data-bs-toggle="dropdown" data-bs-display="static">
								<i class="align-middle" data-feather="more-vertical"></i>
							</a>

							<div class="dropdown-menu dropdown-menu-end">
								<a class="dropdown-item" href="#">Action</a>
								<a class="dropdown-item" href="#">Another action</a>
								<a class="dropdown-item" href="#">Something else here</a>
							</div>
						</div>
					</div>
					<h5 class="card-title mb-0">Calendar</h5>
				</div>
				<div class="card-body d-flex">
					<div class="align-self-center w-100">
						<div class="chart">
							<div id="datetimepicker-dashboard"></div>
						</div>
					</div>
				</div>
			</div>
		</div>
		<div class="col-12 col-md-12 col-xxl-6 d-flex order-3 order-xxl-2">
			<div class="card flex-fill w-100">
				<div class="card-header">
					<div class="card-actions float-end">
						<a href="#" class="me-1">
							<i class="align-middle" data-feather="refresh-cw"></i>
						</a>
						<div class="d-inline-block dropdown show">
							<a href="#" data-bs-toggle="dropdown" data-bs-display="static">
								<i class="align-middle" data-feather="more-vertical"></i>
							</a>

							<div class="dropdown-menu dropdown-menu-end">
								<a class="dropdown-item" href="#">Action</a>
								<a class="dropdown-item" href="#">Another action</a>
								<a class="dropdown-item" href="#">Something else here</a>
							</div>
						</div>
					</div>
					<h5 class="card-title mb-0">Current Visitors</h5>
				</div>
				<div class="card-body px-4">
					<div id="world_map" style="height:350px;"></div>
				</div>
			</div>
		</div>
		<div class="col-12 col-md-6 col-xxl-3 d-flex order-2 order-xxl-3">
			<div class="card flex-fill w-100">
				<div class="card-header">
					<div class="card-actions float-end">
						<a href="#" class="me-1">
							<i class="align-middle" data-feather="refresh-cw"></i>
						</a>
						<div class="d-inline-block dropdown show">
							<a href="#" data-bs-toggle="dropdown" data-bs-display="static">
								<i class="align-middle" data-feather="more-vertical"></i>
							</a>

							<div class="dropdown-menu dropdown-menu-end">
								<a class="dropdown-item" href="#">Action</a>
								<a class="dropdown-item" href="#">Another action</a>
								<a class="dropdown-item" href="#">Something else here</a>
							</div>
						</div>
					</div>
					<h5 class="card-title mb-0">Browser Usage</h5>
				</div>
				<div class="card-body d-flex">
					<div class="align-self-center w-100">
						<div class="py-3">
							<div class="chart chart-xs">
								<canvas id="chartjs-dashboard-pie"></canvas>
							</div>
						</div>

						<table class="table mb-0">
							<tbody>
								<tr>
									<td><i class="fas fa-circle text-primary fa-fw"></i> Chrome</td>
									<td class="text-end">4401</td>
								</tr>
								<tr>
									<td><i class="fas fa-circle text-warning fa-fw"></i> Firefox</td>
									<td class="text-end">4003</td>
								</tr>
								<tr>
									<td><i class="fas fa-circle text-danger fa-fw"></i> IE</td>
									<td class="text-end">1589</td>
								</tr>
							</tbody>
						</table>
					</div>
				</div>
			</div>
		</div>
	</div>
</div>