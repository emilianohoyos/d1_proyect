@extends('layout.default')

@section('title', 'Modal & Notifications')

@push('js')
	<script src="/assets/plugins/@highlightjs/cdn-assets/highlight.min.js"></script>
	<script src="/assets/js/demo/highlightjs.demo.js"></script>
	<script src="/assets/js/demo/ui-modal-notification.demo.js"></script>
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
							<li class="breadcrumb-item active">MODAL & NOTIFICATION</li>
						</ul>
						
						<h1 class="page-header">
							Modal & Notification <small>page header description goes here...</small>
						</h1>
				
						<hr>
						
						<!-- BEGIN #modal -->
						<div id="modal" class="mb-5">
							<h4>Modal</h4>
							<p>Use Bootstrap’s JavaScript modal plugin to add dialogs to your site for lightboxes, user notifications, or completely custom content. Please read the <a href="https://getbootstrap.com/docs/5.3/components/modal/" target="_blank">official Bootstrap documentation</a> for the full list of options.</p>
							<div class="card">
								<div class="card-body">
									<div class="modal position-static d-block">
										<div class="modal-dialog">
											<div class="modal-content">
												<div class="modal-header">
													<h5 class="modal-title">Modal Title</h5>
													<button type="button" class="btn-close" data-bs-dismiss="modal"></button>
												</div>
												<div class="modal-body">
													<p>Modal body text goes here.</p>
												</div>
												<div class="modal-footer">
													<button type="button" class="btn btn-default" data-bs-dismiss="modal">Close</button>
													<button type="button" class="btn btn-primary">Save changes</button>
												</div>
											</div>
										</div>
									</div>
								</div>
								<div class="hljs-container rounded-bottom">
									<pre><code class="xml" data-url="/assets/data/ui-modal-notification/code-1.json"></code></pre>
								</div>
							</div>
						</div>
						<!-- END #modal -->
						
						<!-- BEGIN #modalSizes -->
						<div id="modalSizes" class="mb-5">
							<h4>Modal Sizes</h4>
							<p>Modals have three optional sizes, available via modifier classes to be placed on a <code>.modal-dialog</code>. These sizes kick in at certain breakpoints to avoid horizontal scrollbars on narrower viewports.</p>
							<div class="card">
								<div class="card-body">
									<!-- modal-xl -->
									<button type="button" class="btn btn-primary me-2" data-bs-toggle="modal" data-bs-target="#modalXl">Extra large modal</button>
									
									<!-- modal-lg -->
									<button type="button" class="btn btn-primary me-2" data-bs-toggle="modal" data-bs-target="#modalLg">Large modal</button>
									
									<!-- modal-sm -->
									<button type="button" class="btn btn-primary me-2" data-bs-toggle="modal" data-bs-target="#modalSm">Small modal</button>
								</div>
								<div class="hljs-container rounded-bottom">
									<pre><code class="xml" data-url="/assets/data/ui-modal-notification/code-2.json"></code></pre>
								</div>
							</div>
						</div>
						<!-- END #modalSizes -->
						
						<!-- BEGIN #modalCover -->
						<div id="modalCover" class="mb-5">
							<h4>Modal Cover</h4>
							<p>Modal cover is an extended feature from Bootstrap modal. It provide the same background color as the modal content. Place a <code>.modal-cover</code> css class on <code>.modal</code> for full cover modal.</p>
							<div class="card">
								<div class="card-body">
									<!-- modal-cover -->
									<button type="button" class="btn btn-primary me-2" data-bs-toggle="modal" data-bs-target="#modalCoverExample">Modal Cover</button>
								</div>
								<div class="hljs-container rounded-bottom">
									<pre><code class="xml" data-url="/assets/data/ui-modal-notification/code-3.json"></code></pre>
								</div>
							</div>
						</div>
						<!-- END #modalCover -->
						
						<!-- BEGIN #toastsNotification -->
						<div id="toastsNotification" class="mb-5">
							<h4>Toasts Notification</h4>
							<p>Push notifications to your visitors with a toast, a lightweight and easily customizable alert message. Please read the <a href="https://getbootstrap.com/docs/5.3/components/toasts/" target="_blank">official Bootstrap documentation</a> for the full list of options.</p>
							<div class="card">
								<div class="card-body">
									<div class="toast show">
										<div class="toast-header">
											<i class="far fa-bell text-muted me-2"></i>
											<strong class="me-auto">Bootstrap</strong>
											<small>11 mins ago</small>
											<button type="button" class="btn-close" data-bs-dismiss="toast"></button>
										</div>
										<div class="toast-body">
											Hello, world! This is a toast message.
										</div>
									</div>
								</div>
								<div class="hljs-container rounded-bottom">
									<pre><code class="xml" data-url="/assets/data/ui-modal-notification/code-4.json"></code></pre>
								</div>
							</div>
						</div>
						<!-- END #toastsNotification -->
						
						<!-- BEGIN #toastsContainer -->
						<div id="toastsContainer" class="mb-5">
							<h4>Toasts Container</h4>
							<p>Toasts container is an extended ui from Bootstrap toasts. Wrap the toasts with <code>.toasts-container</code> will allow toast to float within the right top position.</p>
							<div class="card">
								<div class="card-body">
									<a href="#" class="btn btn-primary me-2" data-toggle="toast" data-target="#toast-1">Show toast 1</a>
									<a href="#" class="btn btn-primary" data-toggle="toast" data-target="#toast-2">Show toast 2</a>
								</div>
								<div class="hljs-container rounded-bottom">
									<pre><code class="xml" data-url="/assets/data/ui-modal-notification/code-5.json"></code></pre>
								</div>
							</div>
						</div>
						<!-- END #toastsNotification -->
					</div>
					<!-- END col-9 -->
					<!-- BEGIN col-3 -->
					<div class="col-xl-3">
						<!-- BEGIN #sidebar-bootstrap -->
						<nav id="sidebar-bootstrap" class="navbar navbar-sticky d-none d-xl-block">
							<nav class="nav">
								<a class="nav-link" href="#modal" data-toggle="scroll-to">Modal</a>
								<a class="nav-link" href="#modalSizes" data-toggle="scroll-to">Modal Sizes</a>
								<a class="nav-link" href="#modalCover" data-toggle="scroll-to">Modal Cover</a>
								<a class="nav-link" href="#toastsNotification" data-toggle="scroll-to">Toasts Notification</a>
								<a class="nav-link" href="#toastsContainer" data-toggle="scroll-to">Toasts Container</a>
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


@section('outter_content')
	<div class="modal modal-cover fade" id="modalCoverExample">
		<div class="modal-dialog">
			<div class="modal-content">
				<div class="modal-header">
					<h3 class="modal-title">Sign Up!</h3>
					<button type="button" class="btn-close" data-bs-dismiss="modal"></button>
				</div>
				<div class="modal-body">
					<p class="mb-3">
						25% Off On Your First Purchase* Enter code WELCOME at checkout<br>
						Discover new apps, things to do & more great news added daily!
					</p>
					<div class="row mb-5">
						<div class="col-md-9">
							<input type="text" placeholder="Your email address here" class="form-control form-control-lg" name="icon-filter">
						</div>
						<div class="col-md-3">
							<button type="button" class="btn btn-primary btn-lg btn-block">Continue</button>
						</div>
					</div>
					<div class="pt-3">
						<a href="#" class="text-muted fs-12px">What is it? Terms and conditions</a>
					</div>
				</div>
			</div>
		</div>
	</div>
	<div class="modal fade" id="modalXl">
		<div class="modal-dialog modal-xl">
			<div class="modal-content">
				<div class="modal-header">
					<h5 class="modal-title">Extra Large Modal</h5>
					<button type="button" class="btn-close" data-bs-dismiss="modal"></button>
				</div>
				<div class="modal-body">
					...
				</div>
			</div>
		</div>
	</div>
	<div class="modal fade" id="modalLg">
		<div class="modal-dialog modal-lg">
			<div class="modal-content">
				<div class="modal-header">
					<h5 class="modal-title">Large Modal</h5>
					<button type="button" class="btn-close" data-bs-dismiss="modal"></button>
				</div>
				<div class="modal-body">
					...
				</div>
			</div>
		</div>
	</div>
	<div class="modal fade" id="modalSm">
		<div class="modal-dialog modal-sm">
			<div class="modal-content">
				<div class="modal-header">
					<h5 class="modal-title">Small Modal</h5>
					<button type="button" class="btn-close" data-bs-dismiss="modal"></button>
				</div>
				<div class="modal-body">
					...
				</div>
			</div>
		</div>
	</div>
	
	<!-- BEGIN toasts-container -->
	<div class="toasts-container">
		<div class="toast fade hide mb-3" data-autohide="false" id="toast-1">
			<div class="toast-header">
				<i class="far fa-bell text-muted me-2"></i>
				<strong class="me-auto">Bootstrap</strong>
				<small>11 mins ago</small>
				<button type="button" class="btn-close" data-bs-dismiss="toast"></button>
			</div>
			<div class="toast-body">
				Hello, world! This is a toast message.
			</div>
		</div>
		<div class="toast fade hide mb-3" data-autohide="false" id="toast-2">
			<div class="toast-header">
				<i class="far fa-bell text-muted me-2"></i>
				<strong class="me-auto">Bootstrap</strong>
				<small>2 seconds ago</small>
				<button type="button" class="btn-close" data-bs-dismiss="toast"></button>
			</div>
			<div class="toast-body">
				See? Just like this.
			</div>
		</div>
	</div>
	<!-- END toasts-container -->
@endsection