@extends('layout.default')

@section('title', 'Bootstrap')

@push('js')
	<script src="/assets/plugins/@highlightjs/cdn-assets/highlight.min.js"></script>
	<script src="/assets/js/demo/highlightjs.demo.js"></script>
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
							<li class="breadcrumb-item"><a href="#">UI KITS</a></li>
							<li class="breadcrumb-item active">BOOTSTRAP</li>
						</ul>

						<h1 class="page-header">
							Bootstrap <small>page header description goes here...</small>
						</h1>

						<hr class="mb-4">

						<!-- BEGIN #alert -->
						<div id="alert" class="mb-5">
							<h4>Alerts</h4>
							<p>
								Wrap any text and an optional dismiss button in <code>.alert</code> and one of the four contextual classes for basic alert messages.
								Please read the <a href="https://getbootstrap.com/docs/5.3/components/alerts/" target="_blank">official Bootstrap documentation</a> for the full list of options.
							</p>
							<div class="card">
								<div class="card-body">
									<div class="alert alert-primary">
										<strong>Primary!</strong> A simple primary alert check it out!
									</div>
									<div class="alert alert-secondary">
										<strong>Secondary Alert!</strong> This alert is not important, but it's beautiful.
									</div>
									<div class="alert alert-success">
										<strong>Well done!</strong> You successfully read this important alert message.
									</div>
									<div class="alert alert-danger">
										<strong>Oh snap!</strong> Change a few things up and try submitting again.
									</div>
									<div class="alert alert-warning">
										<strong>Warning!</strong> Better check yourself, you're not looking too good.
									</div>
									<div class="alert alert-info">
										<strong>Heads up!</strong> This alert needs your attention, but it's not super important.
									</div>
									<div class="alert alert-dark">
										<strong>Dark!</strong>  A simple dark alert—check it out!
									</div>
									<div class="alert alert-light mb-0">
										<strong>Light!</strong> A simple light alert—check it out!
									</div>
								</div>
								<div class="hljs-container rounded-bottom">
									<pre><code class="xml" data-url="/assets/data/ui-bootstrap/code-1.json"></code></pre>
								</div>
							</div>
						</div>
						<!-- END #alert -->

						<!-- BEGIN #badge -->
						<div id="badge" class="mb-5">
							<h4>Badges</h4>
							<p>Documentation and examples for badges, our small count and labeling component. Please read the <a href="https://getbootstrap.com/docs/5.3/components/badge/" target="_blank">official Bootstrap documentation</a> for the full list of options.</p>
							<div class="card">
								<div class="card-body">
									<div>
										<span class="badge bg-primary">Primary</span>
										<span class="badge bg-secondary">Secondary</span>
										<span class="badge bg-success">Success</span>
										<span class="badge bg-danger">Danger</span>
										<span class="badge bg-warning">Warning</span>
										<span class="badge bg-info">Info</span>
										<span class="badge bg-light">Light</span>
										<span class="badge bg-dark">Dark</span>
									</div>
								</div>
								<div class="hljs-container rounded-bottom">
									<pre><code class="xml" data-url="/assets/data/ui-bootstrap/code-2.json"></code></pre>
								</div>
							</div>
						</div>
						<!-- END #badge -->

						<!-- BEGIN #breadcrumb -->
						<div id="breadcrumb" class="mb-5">
							<h4>Breadcrumb</h4>
							<p>Indicate the current page’s location within a navigational hierarchy that automatically adds separators via CSS. Please read the <a href="https://getbootstrap.com/docs/5.3/components/breadcrumb/" target="_blank">official Bootstrap documentation</a> for the full list of options.</p>
							<div class="card">
								<div class="card-body">
									<ol class="breadcrumb py-1 mb-0">
										<li class="breadcrumb-item"><a href="#">HOME</a></li>
										<li class="breadcrumb-item"><a href="#">LIBRARY</a></li>
										<li class="breadcrumb-item active">DATA</li>
									</ol>
								</div>
								<div class="hljs-container rounded-bottom">
									<pre><code class="xml" data-url="/assets/data/ui-bootstrap/code-3.json"></code></pre>
								</div>
							</div>
						</div>
						<!-- END #breadcrumb -->

						<!-- BEGIN #carousel -->
						<div id="carousel" class="mb-5">
							<h4>Carousel</h4>
							<p>A slideshow component for cycling through elements—images or slides of text—like a carousel. Please read the <a href="https://getbootstrap.com/docs/5.3/components/carousel/" target="_blank">official Bootstrap documentation</a> for the full list of options.</p>
							<div class="card">
								<div class="card-body">
									<div id="carouselExample" class="carousel slide" data-ride="carousel">
										<ol class="carousel-indicators">
											<li data-bs-target="#carouselExample" data-bs-slide-to="0" class="active"></li>
											<li data-bs-target="#carouselExample" data-bs-slide-to="1"></li>
											<li data-bs-target="#carouselExample" data-bs-slide-to="2"></li>
										</ol>
										<div class="carousel-inner">
											<div class="carousel-item active">
												<img src="https://placehold.co/728x400/c9d2e3/212837" alt="" class="d-block w-100">
												<div class="carousel-caption d-none d-md-block">
													<h5 class="text-dark">First slide label</h5>
													<p class="text-dark">Nulla vitae elit libero, a pharetra augue mollis interdum.</p>
												</div>
											</div>
											<div class="carousel-item">
												<img src="https://placehold.co/728x400/c9d2e3/212837" alt="" class="d-block w-100">
												<div class="carousel-caption d-none d-md-block">
													<h5 class="text-dark">Second slide label</h5>
													<p class="text-dark">Lorem ipsum dolor sit amet, consectetur adipiscing elit.</p>
												</div>
											</div>
											<div class="carousel-item">
												<img src="https://placehold.co/728x400/c9d2e3/212837" alt="" class="d-block w-100">
												<div class="carousel-caption d-none d-md-block">
													<h5 class="text-dark">Third slide label</h5>
													<p class="text-dark">Praesent commodo cursus magna, vel scelerisque nisl consectetur.</p>
												</div>
											</div>
										</div>
										<a class="carousel-control-prev" href="#carouselExample" data-bs-slide="prev">
											<span class="carousel-control-prev-icon"></span>
										</a>
										<a class="carousel-control-next" href="#carouselExample" data-bs-slide="next">
											<span class="carousel-control-next-icon"></span>
										</a>
									</div>
								</div>
								<div class="hljs-container rounded-bottom">
									<pre><code class="xml" data-url="/assets/data/ui-bootstrap/code-4.json"></code></pre>
								</div>
							</div>
						</div>
						<!-- END #carousel -->

						<!-- BEGIN #jumbotron -->
						<div id="jumbotron" class="mb-5">
							<h4>Jumbotron</h4>
							<p>Lightweight, flexible component for showcasing hero unit style content by using Bootstrap utilities.</p>
							<div class="card">
								<div class="card-body">
									<div class="p-5 bg-light-subtle mb-0 rounded-3">
										<h1 class="display-4">Hello, world!</h1>
										<p class="lead">This is a simple hero unit, a simple jumbotron-style component for calling extra attention to featured content or information.</p>
										<hr class="my-4">
										<p>It uses utility classes for typography and spacing to space content out within the larger container.</p>
										<a class="btn btn-theme btn-lg" href="#" role="button">Learn more</a>
									</div>
								</div>
								<div class="hljs-container rounded-bottom">
									<pre><code class="xml" data-url="/assets/data/ui-bootstrap/code-5.json"></code></pre>
								</div>
							</div>
						</div>
						<!-- END #jumbotron -->

						<!-- BEGIN #listGroup -->
						<div id="listGroup" class="mb-5">
							<h4>List Group</h4>
							<p>List groups are a flexible and powerful component for displaying a series of content. Please read the <a href="https://getbootstrap.com/docs/5.3/components/list-group/" target="_blank">official Bootstrap documentation</a> for the full list of options.</p>
							<div class="card">
								<div class="card-body">
									<div class="row">
										<div class="col-xl-6">
											<div class="list-group">
												<a href="#" class="list-group-item list-group-item-action active">Cras justo odio</a>
												<a href="#" class="list-group-item list-group-item-action">Dapibus ac facilisis in</a>
												<a href="#" class="list-group-item list-group-item-action">Morbi leo risus</a>
												<a href="#" class="list-group-item list-group-item-action">Porta ac consectetur ac</a>
												<a href="#" class="list-group-item list-group-item-action disabled">Vestibulum at eros</a>
											</div>
										</div>
									</div>
								</div>
								<div class="hljs-container rounded-bottom">
									<pre><code class="xml" data-url="/assets/data/ui-bootstrap/code-6.json"></code></pre>
								</div>
							</div>
						</div>
						<!-- END #listGroup -->

						<!-- BEGIN #mediaObject -->
						<div id="mediaObject" class="mb-5">
							<h4>Media Object</h4>
							<p>Media object is created by using Bootstrap utilities class and it is construct highly repetitive components like blog comments, tweets, and the like.</p>
							<div class="card">
								<div class="card-body">
									<div class="d-flex align-items-start">
										<img src="https://placehold.co/128x128/c9d2e3/212837" alt="" width="64" class="rounded">
										<div class="ms-3">
											<h5 class="mt-0 mb-1">Media heading</h5>
											Cras sit amet nibh libero, in gravida nulla. Nulla vel metus scelerisque ante sollicitudin. Cras purus odio, vestibulum in vulputate at, tempus viverra turpis. Fusce condimentum nunc ac nisi vulputate fringilla. Donec lacinia congue felis in faucibus.

											<div class="d-flex align-items-start mt-3">
												<a href="#">
													<img src="https://placehold.co/128x128/c9d2e3/212837" alt="" width="64" class="rounded">
												</a>
												<div class="ms-3">
													<h5 class="mt-0 mb-1">Media heading</h5>
													Cras sit amet nibh libero, in gravida nulla. Nulla vel metus scelerisque ante sollicitudin. Cras purus odio, vestibulum in vulputate at, tempus viverra turpis. Fusce condimentum nunc ac nisi vulputate fringilla. Donec lacinia congue felis in faucibus.
												</div>
											</div>
										</div>
									</div>
								</div>
								<div class="hljs-container rounded-bottom">
									<pre><code class="xml" data-url="/assets/data/ui-bootstrap/code-7.json"></code></pre>
								</div>
							</div>
						</div>
						<!-- END #mediaObject -->

						<!-- BEGIN #navs -->
						<div id="navs" class="mb-5">
							<h4>Navs</h4>
							<p>Navigation available in Bootstrap share general markup and styles, from the base .nav class to the active and disabled states. Swap modifier classes to switch between each style. Please read the <a href="https://getbootstrap.com/docs/5.3/components/navs/" target="_blank">official Bootstrap documentation</a> for the full list of options.</p>
							<div class="card">
								<div class="card-body">
									<div class="row">
										<div class="col-xl-6 mb-xl-0 mb-3">
											<div class="mb-2 small text-body text-opacity-75"><b class="fw-bold">BASE NAV</b></div>
											<nav class="nav mb-4">
												<a class="nav-link active" href="#">Active</a>
												<a class="nav-link" href="#">Link</a>
												<a class="nav-link" href="#">Link</a>
												<a class="nav-link disabled" href="#">Disabled</a>
											</nav>
											<div class="mb-2 small text-body text-opacity-75"><b class="fw-bold">UNDERLINE NAV</b></div>
											<nav class="nav nav-underline mb-3">
												<a class="nav-link ms-3 active" href="#">Active</a>
												<a class="nav-link ms-3" href="#">Link</a>
												<a class="nav-link ms-3" href="#">Link</a>
												<a class="nav-link ms-3 disabled" href="#">Disabled</a>
											</nav>
										</div>
										<div class="col-xl-6">
											<div class="mb-2 small text-body text-opacity-75"><b class="fw-bold">VERTICAL NAV</b></div>
											<nav class="nav flex-column">
												<a class="nav-link active" href="#">Active</a>
												<a class="nav-link" href="#">Link</a>
												<a class="nav-link" href="#">Link</a>
												<a class="nav-link disabled" href="#">Disabled</a>
											</nav>
										</div>
									</div>
								</div>
								<div class="hljs-container rounded-bottom">
									<pre><code class="xml" data-url="/assets/data/ui-bootstrap/code-8.json"></code></pre>
								</div>
							</div>
						</div>
						<!-- END #navs -->

						<!-- BEGIN #navbar -->
						<div id="navbar" class="mb-5">
							<h4>Narbar</h4>
							<p>Includes support for branding, navigation, and more, including support for collapse plugin. Please read the <a href="https://getbootstrap.com/docs/5.3/components/navbar/" target="_blank">official Bootstrap documentation</a> for the full list of options.</p>
							<div class="card">
								<div class="card-body">
									<nav class="navbar navbar-expand-lg bg-light mb-3 rounded theme-primary" data-bs-theme="light">
										<div class="container-fluid">
											<button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarLight">
												<span class="navbar-toggler-icon"></span>
											</button>
											<div class="collapse navbar-collapse" id="navbarLight">
												<a class="navbar-brand" href="#">Navbar</a>
												<ul class="navbar-nav me-auto mt-2 mt-lg-0">
													<li class="nav-item active">
														<a class="nav-link" href="#">Home</a>
													</li>
													<li class="nav-item">
														<a class="nav-link" href="#">Link</a>
													</li>
													<li class="nav-item">
														<a class="nav-link disabled" href="#">Disabled</a>
													</li>
												</ul>
												<form class="d-flex">
													<input class="form-control me-sm-2" type="search" placeholder="Search">
													<button class="btn btn-outline-theme my-2 my-sm-0" type="submit">Search</button>
												</form>
											</div>
										</div>
									</nav>
									<nav class="navbar navbar-expand-lg bg-gray-900 rounded theme-info" data-bs-theme="dark">
										<div class="container-fluid">
											<button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarDark">
												<span class="navbar-toggler-icon"></span>
											</button>
											<div class="collapse navbar-collapse" id="navbarDark">
												<a class="navbar-brand" href="#">Navbar</a>
												<ul class="navbar-nav me-auto mt-2 mt-lg-0">
													<li class="nav-item active">
														<a class="nav-link" href="#">Home</a>
													</li>
													<li class="nav-item">
														<a class="nav-link" href="#">Link</a>
													</li>
													<li class="nav-item">
														<a class="nav-link disabled" href="#">Disabled</a>
													</li>
												</ul>
												<form class="d-flex">
													<input class="form-control me-sm-2" type="search" placeholder="Search">
													<button class="btn btn-outline-info my-2 my-sm-0" type="submit">Search</button>
												</form>
											</div>
										</div>
									</nav>
								</div>
								<div class="hljs-container rounded-bottom">
									<pre><code class="xml" data-url="/assets/data/ui-bootstrap/code-9.json"></code></pre>
								</div>
							</div>
						</div>
						<!-- END #navs -->

						<!-- BEGIN #pagination -->
						<div id="pagination" class="mb-5">
							<h4>Pagination</h4>
							<p>Documentation and examples for showing pagination to indicate a series of related content exists across multiple pages. Please read the <a href="https://getbootstrap.com/docs/5.3/components/pagination/" target="_blank">official Bootstrap documentation</a> for the full list of options.</p>
							<div class="card">
								<div class="card-body">
									<ul class="pagination mb-0">
										<li class="page-item disabled"><a class="page-link">Previous</a></li>
										<li class="page-item"><a class="page-link" href="#">1</a></li>
										<li class="page-item active"><a class="page-link" href="#">2</a></li>
										<li class="page-item"><a class="page-link" href="#">3</a></li>
										<li class="page-item"><a class="page-link" href="#">Next</a></li>
									</ul>
								</div>
								<div class="hljs-container rounded-bottom">
									<pre><code class="xml" data-url="/assets/data/ui-bootstrap/code-10.json"></code></pre>
								</div>
							</div>
						</div>
						<!-- END #pagination -->

						<!-- BEGIN #progress -->
						<div id="progress" class="mb-5">
							<h4>Progress</h4>
							<p>Documentation and examples for using Bootstrap custom progress bars featuring support for stacked bars, animated backgrounds, and text labels. Please read the <a href="https://getbootstrap.com/docs/5.3/components/progress/" target="_blank">official Bootstrap documentation</a> for the full list of options.</p>
							<div class="card">
								<div class="card-body">
									<div class="row">
										<div class="col-xl-6">
											<div class="mb-3">
												<div class="mb-2 small text-body text-opacity-75"><b class="fw-bold">DEFAULT</b></div>
												<div class="progress">
													<div class="progress-bar" style="width: 50%">50%</div>
												</div>
											</div>
											<div class="mb-3">
												<div class="mb-2 small text-body text-opacity-75"><b class="fw-bold">MULTIPLE BARS</b></div>
												<div class="progress">
													<div class="progress-bar" style="width: 33%">33%</div>
													<div class="progress-bar bg-warning" style="width: 20%">20%</div>
													<div class="progress-bar bg-danger" style="width: 20%">20%</div>
												</div>
											</div>
										</div>
										<div class="col-xl-6">
											<div class="mb-3">
												<div class="mb-2 small text-body text-opacity-75"><b class="fw-bold">STRIPED</b></div>
												<div class="progress">
													<div class="progress-bar progress-bar-striped" style="width: 66%">66%</div>
												</div>
											</div>
											<div class="mb-3">
												<div class="mb-2 small text-body text-opacity-75"><b class="fw-bold">ANIMATED</b></div>
												<div class="progress">
													<div class="progress-bar progress-bar-striped progress-bar-animated bg-success" style="width: 33%">33%</div>
												</div>
											</div>
										</div>
									</div>
								</div>
								<div class="hljs-container rounded-bottom">
									<pre><code class="xml" data-url="/assets/data/ui-bootstrap/code-11.json"></code></pre>
								</div>
							</div>
						</div>
						<!-- END #progress -->

						<!-- BEGIN #spinners -->
						<div id="spinners" class="mb-5">
							<h4>Spinners</h4>
							<p>Indicate the loading state of a component or page with Bootstrap spinners, built entirely with HTML, CSS, and no JavaScript. Please read the <a href="https://getbootstrap.com/docs/5.1/components/spinners/" target="_blank">official Bootstrap documentation</a> for the full list of options.</p>
							<div class="card">
								<div class="card-body pb-0">
									<div class="row">
										<div class="col-xl-6">
											<div class="mb-4">
												<div class="mb-2 small text-body text-opacity-75"><b class="fw-bold">BORDER SPINNER</b></div>
												<div class="spinner-border"></div>
											</div>
											<div class="mb-4">
												<div class="mb-2 small text-body text-opacity-75"><b class="fw-bold">COLORS</b></div>
												<div class="spinner-border text-primary"></div>
												<div class="spinner-border text-secondary"></div>
												<div class="spinner-border text-success"></div>
												<div class="spinner-border text-danger"></div>
												<div class="spinner-border text-warning"></div>
												<div class="spinner-border text-info"></div>
												<div class="spinner-border text-light"></div>
												<div class="spinner-border text-dark"></div>
											</div>
											<div class="mb-4">
												<div class="mb-2 small text-body text-opacity-75"><b class="fw-bold">SIZE</b></div>
												<div class="spinner-border spinner-border-sm"></div>
												<div class="spinner-border spinner-border-sm text-primary"></div>
											</div>
										</div>
										<div class="col-xl-6">
											<div class="mb-4">
												<div class="mb-2 small text-body text-opacity-75"><b class="fw-bold">GROWING SPINNER</b></div>
												<div class="spinner-grow"></div>
											</div>
											<div class="mb-4">
												<div class="mb-2 small text-body text-opacity-75"><b class="fw-bold">COLORS</b></div>
												<div class="spinner-grow text-primary"></div>
												<div class="spinner-grow text-secondary"></div>
												<div class="spinner-grow text-success"></div>
												<div class="spinner-grow text-danger"></div>
												<div class="spinner-grow text-warning"></div>
												<div class="spinner-grow text-info"></div>
												<div class="spinner-grow text-light"></div>
												<div class="spinner-grow text-dark"></div>
											</div>
											<div class="mb-4">
												<div class="mb-2 small text-body text-opacity-75"><b class="fw-bold">SIZE</b></div>
												<div class="spinner-grow spinner-grow-sm"></div>
												<div class="spinner-grow spinner-grow-sm text-primary"></div>
											</div>
										</div>
									</div>
								</div>
								<div class="hljs-container rounded-bottom">
									<pre><code class="xml" data-url="/assets/data/ui-bootstrap/code-12.json"></code></pre>
								</div>
							</div>
						</div>
						<!-- END #spinners -->
					</div>
					<!-- END col-9-->
					<!-- BEGIN col-3 -->
					<div class="col-xl-3">
						<!-- BEGIN #sidebar-bootstrap -->
						<nav id="sidebar-bootstrap" class="navbar navbar-sticky d-none d-xl-block">
							<nav class="nav">
								<a class="nav-link" href="#alert" data-toggle="scroll-to">Alert</a>
								<a class="nav-link" href="#badge" data-toggle="scroll-to">Badge</a>
								<a class="nav-link" href="#breadcrumb" data-toggle="scroll-to">Breadcrumb</a>
								<a class="nav-link" href="#carousel" data-toggle="scroll-to">Carousel</a>
								<a class="nav-link" href="#jumbotron" data-toggle="scroll-to">Jumbotron</a>
								<a class="nav-link" href="#listGroup" data-toggle="scroll-to">List group</a>
								<a class="nav-link" href="#mediaObject" data-toggle="scroll-to">Media object</a>
								<a class="nav-link" href="#navs" data-toggle="scroll-to">Navs</a>
								<a class="nav-link" href="#navbar" data-toggle="scroll-to">Navbar</a>
								<a class="nav-link" href="#pagination" data-toggle="scroll-to">Pagination</a>
								<a class="nav-link" href="#progress" data-toggle="scroll-to">Progress</a>
								<a class="nav-link" href="#spinners" data-toggle="scroll-to">Spinners</a>
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
