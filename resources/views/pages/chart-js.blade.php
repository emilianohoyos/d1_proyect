@extends('layout.default')

@section('title', 'Chart.js')

@push('js')
	<script src="/assets/plugins/@highlightjs/cdn-assets/highlight.min.js"></script>
	<script src="/assets/js/demo/highlightjs.demo.js"></script>
	<script src="/assets/plugins/chart.js/dist/chart.umd.js"></script>
	<script src="/assets/js/demo/chart-js.demo.js"></script>
	<script src="/assets/js/demo/sidebar-scrollspy.demo.js"></script>
@endpush

@section('content')
	<!-- BEGIN container -->
	<div class="container">
		<!-- BEGIN row -->
		<div class="row justify-content-center">
			<!-- BEGIN col-10 -->
			<div class="col-xl-10">
				<!-- BEGIN row -->
				<div class="row">
					<!-- BEGIN col-9 -->
					<div class="col-xl-9">
						<ul class="breadcrumb">
							<li class="breadcrumb-item"><a href="#">Charts</a></li>
							<li class="breadcrumb-item active">Chart.js</li>
						</ul>
						
						<h1 class="page-header">
							Chart.js <small>page header description goes here...</small>
						</h1>
						
						<hr class="mb-4">
						
						<!-- BEGIN #chartJs -->
						<div id="chartJs">
							<h4>Basic Example</h4>
							<p>Chart.js is a simple yet flexible JavaScript charting for designers & developers. Please read the <a href="https://www.chartjs.org/" target="_blank">official documentation</a> for the full list of options.</p>
						</div>
						<!-- END #chartJs -->
						
						<!-- BEGIN #chartJsLineChart -->
						<div id="chartJsLineChart" class="mb-5">
							<div class="card">
								<div class="card-body">
									<h6 class="mb-3">Line Chart</h6>
									<canvas id="lineChart"></canvas>
								</div>
								<div class="hljs-container">
									<pre><code data-url="/assets/data/chart-js/code-1.json"></code></pre>
								</div>
							</div>
						</div>
						<!-- END #chartJsLineChart -->
						
						<!-- BEGIN #chartJsBarChart -->
						<div id="chartJsBarChart" class="mb-5">
							<div class="card">
								<div class="card-body">
									<h6 class="mb-3">Bar Chart</h6>
									<canvas id="barChart"></canvas>
								</div>
								<div class="hljs-container">
									<pre><code data-url="/assets/data/chart-js/code-2.json"></code></pre>
								</div>
							</div>
						</div>
						<!-- END #chartJsBarChart -->
						
						<!-- BEGIN #chartJsRadarChart -->
						<div id="chartJsRadarChart" class="mb-5">
							<div class="card">
								<div class="card-body">
									<h6 class="mb-3">Radar Chart</h6>
									<canvas id="radarChart"></canvas>
								</div>
								<div class="hljs-container">
									<pre><code data-url="/assets/data/chart-js/code-3.json"></code></pre>
								</div>
							</div>
						</div>
						<!-- END #chartJsRadarChart -->
						
						<!-- BEGIN #chartJsPolarAreaChart -->
						<div id="chartJsPolarAreaChart" class="mb-5">
							<div class="card">
								<div class="card-body">
									<h6 class="mb-3">Polar Area Chart</h6>
									<div class="h-300px w-300px mx-auto">
										<canvas id="polarAreaChart"></canvas>
									</div>
								</div>
								<div class="hljs-container">
									<pre><code data-url="/assets/data/chart-js/code-4.json"></code></pre>
								</div>
							</div>
						</div>
						<!-- END #chartJsPolarAreaChart -->
						
						<!-- BEGIN #chartJsPieChart -->
						<div id="chartJsPieChart" class="mb-5">
							<div class="card">
								<div class="card-body">
									<h6 class="mb-3">Pie Chart</h6>
									<div class="h-300px w-300px mx-auto">
										<canvas id="pieChart"></canvas>
									</div>
								</div>
								<div class="hljs-container">
									<pre><code data-url="/assets/data/chart-js/code-5.json"></code></pre>
								</div>
							</div>
						</div>
						<!-- END #chartJsPieChart -->
						
						<!-- BEGIN #chartJsDoughnutChart -->
						<div id="chartJsDoughnutChart" class="mb-5">
							<div class="card">
								<div class="card-body">
									<h6 class="mb-3">Doughnut Chart</h6>
									<div class="h-300px w-300px mx-auto">
										<canvas id="doughnutChart"></canvas>
									</div>
								</div>
								<div class="hljs-container">
									<pre><code data-url="/assets/data/chart-js/code-6.json"></code></pre>
								</div>
							</div>
						</div>
						<!-- END #chartJsDoughnutChart -->
					</div>
					<!-- END col-9-->
					<!-- BEGIN col-3 -->
					<div class="col-xl-3">
						<!-- BEGIN #sidebar-bootstrap -->
						<nav id="sidebar-bootstrap" class="navbar navbar-sticky d-none d-xl-block">
							<nav class="nav">
								<a class="nav-link" href="#chartJs" data-toggle="scroll-to">Chart.js</a>
								<a class="nav-link" href="#chartJsLineChart" data-toggle="scroll-to"> - line chart</a>
								<a class="nav-link" href="#chartJsBarChart" data-toggle="scroll-to"> - bar chart</a>
								<a class="nav-link" href="#chartJsRadarChart" data-toggle="scroll-to"> - radar chart</a>
								<a class="nav-link" href="#chartJsPolarAreaChart" data-toggle="scroll-to"> - polar area chart</a>
								<a class="nav-link" href="#chartJsPieChart" data-toggle="scroll-to"> - pie chart</a>
								<a class="nav-link" href="#chartJsDoughnutChart" data-toggle="scroll-to"> - doughnut chart</a>
							</nav>
						</nav>
						<!-- END #sidebar-bootstrap -->
					</div>
					<!-- END col-3 -->
				</div>
				<!-- END row -->
			</div>
			<!-- END col-10 -->
		</div>
		<!-- END row -->
	</div>
	<!-- END container -->
@endsection
