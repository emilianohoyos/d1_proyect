@extends('layout.default')

@section('title', 'Form Elements')

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
							<li class="breadcrumb-item"><a href="#">FORMS</a></li>
							<li class="breadcrumb-item active">FORM ELEMENTS</li>
						</ul>
						
						<h1 class="page-header">
							Form Elements <small>page header description goes here...</small>
						</h1>
						
						<hr class="mb-4">
						
						<!-- BEGIN #formControls -->
						<div id="formControls" class="mb-5">
							<h4>Form controls</h4>
							<p>Textual form controls—like <code>&lt;input&gt;</code>s, <code>&lt;select&gt;</code>s, and <code>&lt;textarea&gt;</code>s—are styled with the .form-control class. Included are styles for general appearance, focus state, sizing, and more. Please read the <a href="https://getbootstrap.com/docs/5.3/components/forms/" target="_blank">official Bootstrap documentation</a> for the full list of options.</p>
							<div class="card">
								<div class="card-body pb-2">
									<form>
										<div class="row">
											<div class="col-xl-6">
												<div class="form-group mb-3">
													<label class="form-label" for="exampleFormControlInput1">Text input</label>
													<input type="email" class="form-control" id="exampleFormControlInput1" placeholder="name@example.com">
												</div>
												<div class="form-group mb-3">
													<label class="form-label" for="exampleFormControlTextarea1">Textarea</label>
													<textarea class="form-control" id="exampleFormControlTextarea1" rows="3"></textarea>
												</div>
												<div class="form-group mb-3">
													<label class="form-label" for="exampleFormControlFile1">File input</label>
													<input type="file" class="form-control" id="exampleFormControlFile1">
												</div>
											</div>
											<div class="col-xl-6">
												<div class="form-group mb-3">
													<label class="form-label" for="exampleFormControlSelect1">Select dropdown</label>
													<select class="form-select" id="exampleFormControlSelect1">
														<option>1</option>
														<option>2</option>
														<option>3</option>
														<option>4</option>
														<option>5</option>
													</select>
												</div>
												<div class="form-group mb-3">
													<label class="form-label" for="exampleFormControlSelect2">Multiple select</label>
													<select multiple class="form-select" id="exampleFormControlSelect2">
														<option>1</option>
														<option>2</option>
														<option>3</option>
														<option>4</option>
														<option>5</option>
													</select>
												</div>
											</div>
										</div>
									</form>
								</div>
								<div class="hljs-container rounded-bottom">
									<pre><code class="xml" data-url="/assets/data/form-elements/code-1.json"></code></pre>
								</div>
							</div>
						</div>
						<!-- END #formControls -->
						
						<!-- BEGIN #sizing -->
						<div id="sizing" class="mb-5">
							<h4>Sizing</h4>
							<p>Set heights using classes like <code>.form-control-lg</code> and <code>.form-control-sm</code>.</p>
							<div class="card">
								<div class="card-body">
									<div class="row mb-n3">
										<div class="col-xl-6">
											<input class="form-control form-control-lg mb-3" type="text" placeholder=".form-control-lg">
											<input class="form-control mb-3" type="text" placeholder="Default input">
											<input class="form-control form-control-sm mb-3" type="text" placeholder=".form-control-sm">
										</div>
										<div class="col-xl-6">
											<select class="form-select form-select-lg mb-3">
												<option>Large select</option>
											</select>
											<select class="form-select mb-3">
												<option>Default select</option>
											</select>
											<select class="form-select form-select-sm mb-3">
												<option>Small select</option>
											</select>
										</div>
									</div>
								</div>
								<div class="hljs-container rounded-bottom">
									<pre><code class="xml" data-url="/assets/data/form-elements/code-2.json"></code></pre>
								</div>
							</div>
						</div>
						<!-- END #sizing -->
						
						<!-- BEGIN #readonly -->
						<div id="readonly" class="mb-5">
							<h4>Readonly</h4>
							<p>Add the readonly boolean attribute on an input to prevent modification of the input’s value. Read-only inputs appear lighter (just like disabled inputs), but retain the standard cursor.</p>
							<div class="card">
								<div class="card-body">
									<input class="form-control" type="text" placeholder="Readonly input here..." readonly>
								</div>
								<div class="hljs-container rounded-bottom">
									<pre><code class="xml" data-url="/assets/data/form-elements/code-3.json"></code></pre>
								</div>
							</div>
						</div>
						<!-- END #readonly -->
						
						<!-- BEGIN #readonlyPlainText -->
						<div id="readonlyPlainText" class="mb-5">
							<h4>Readonly plain text</h4>
							<p>If you want to have <code>&lt;input readonly&gt;</code> elements in your form styled as plain text, use the .form-control-plaintext class to remove the default form field styling and preserve the correct margin and padding.</p>
							<div class="card">
								<div class="card-body">
									<form>
										<div class="form-group row mb-3">
											<label for="staticEmail" class="col-sm-2 col-form-label">Email</label>
											<div class="col-sm-10">
												<input type="text" readonly class="form-control-plaintext" id="staticEmail" value="email@example.com">
											</div>
										</div>
										<div class="form-group row mb-2">
											<label for="inputPassword" class="col-sm-2 col-form-label">Password</label>
											<div class="col-sm-10">
												<input type="password" class="form-control" id="inputPassword">
											</div>
										</div>
									</form>
								</div>
								<div class="hljs-container rounded-bottom">
									<pre><code class="xml" data-url="/assets/data/form-elements/code-4.json"></code></pre>
								</div>
							</div>
						</div>
						<!-- END #readonlyPlainText -->
						
						<!-- BEGIN #rangeInputs -->
						<div id="rangeInputs" class="mb-5">
							<h4>Range inputs</h4>
							<p>Set horizontally scrollable range inputs using <code>.form-range</code>.</p>
							<div class="card">
								<div class="card-body">
									<div class="row mb-n3">
										<div class="col-xl-6">
											<div class="form-group mb-3">
												<label for="formControlRange" class="form-label">Example range input</label>
												<input type="range" class="form-range" id="formControlRange">
											</div>
										</div>
										<div class="col-xl-6">
											<div class="form-group mb-3">
												<label for="disabledRange" class="form-label">Disabled range</label>
												<input type="range" class="form-range" id="disabledRange" disabled>
											</div>
										</div>
									</div>
								</div>
								<div class="hljs-container rounded-bottom">
									<pre><code class="xml" data-url="/assets/data/form-elements/code-5.json"></code></pre>
								</div>
							</div>
						</div>
						<!-- END #rangeInputs -->
						
						<!-- BEGIN #checkboxes -->
						<div id="checkboxes" class="mb-5">
							<h4>Checkboxes</h4>
							<p>Default checkboxes are improved upon with the help of <code>.form-check</code>, a single class for both input types that improves the layout and behavior of their HTML elements.</p>
							<div class="card">
								<div class="card-body">
									<div class="row mb-n3">
										<div class="col-xl-6">
											<div class="small text-inverse text-opacity-50 mb-2"><b class="fw-bold">DEFAULT CHECKBOX</b></div>
											<div class="form-group mb-4">
												<div class="form-check">
													<input class="form-check-input" type="checkbox" value="" id="defaultCheck1">
													<label class="form-check-label" for="defaultCheck1">Default checkbox</label>
												</div>
												<div class="form-check">
													<input class="form-check-input" type="checkbox" value="" id="defaultCheck2" checked>
													<label class="form-check-label" for="defaultCheck2">Checked checkbox</label>
												</div>
												<div class="form-check">
													<input class="form-check-input" type="checkbox" value="" id="defaultCheck3" disabled>
													<label class="form-check-label" for="defaultCheck3">Disabled checkbox</label>
												</div>
											</div>
										</div>
										<div class="col-xl-6">
											<div class="small text-inverse text-opacity-50 mb-2"><b class="fw-bold">INLINE CHECKBOX</b></div>
											<div class="form-group mb-3">
												<div class="form-check form-check-inline">
													<input class="form-check-input" type="checkbox" id="inlineCheckbox1" value="option1">
													<label class="form-check-label" for="inlineCheckbox1">1</label>
												</div>
												<div class="form-check form-check-inline">
													<input class="form-check-input" type="checkbox" id="inlineCheckbox2" value="option2" checked>
													<label class="form-check-label" for="inlineCheckbox2">2</label>
												</div>
												<div class="form-check form-check-inline">
													<input class="form-check-input" type="checkbox" id="inlineCheckbox3" value="option3" disabled>
													<label class="form-check-label" for="inlineCheckbox3">3 (disabled)</label>
												</div>
											</div>
										</div>
									</div>
								</div>
								<div class="hljs-container rounded-bottom">
									<pre><code class="xml" data-url="/assets/data/form-elements/code-6.json"></code></pre>
								</div>
							</div>
						</div>
						<!-- END #checkboxes -->
						
						<!-- BEGIN #radios -->
						<div id="radios" class="mb-5">
							<h4>Radios</h4>
							<p>Default radios are improved upon with the help of <code>.form-check</code>, a single class for both input types that improves the layout and behavior of their HTML elements. You can use Bootstrap custom radio for styled radio button.</p>
							<div class="card">
								<div class="card-body">
									<div class="row mb-n3">
										<div class="col-xl-6">
											<div class="small text-inverse text-opacity-50 mb-2"><b class="fw-bold">DEFAULT RADIO</b></div>
											<div class="form-group mb-4">
												<div class="form-check">
													<input class="form-check-input" type="radio" value="" name="radio_1" id="defaultRadio1">
													<label class="form-check-label" for="defaultRadio1">Default radio button</label>
												</div>
												<div class="form-check">
													<input class="form-check-input" type="radio" value="" name="radio_1" id="defaultRadio2" checked>
													<label class="form-check-label" for="defaultRadio2">Checked radio button</label>
												</div>
												<div class="form-check">
													<input class="form-check-input" type="radio" value="" name="radio_1" id="defaultRadio3" disabled>
													<label class="form-check-label" for="defaultRadio3">Disabled radio button</label>
												</div>
											</div>
										</div>
										<div class="col-xl-6">
											<div class="small text-inverse text-opacity-50 mb-2"><b class="fw-bold">INLINE RADIO</b></div>
											<div class="form-group mb-3">
												<div class="form-check form-check-inline">
													<input class="form-check-input" name="default_radio" type="radio" id="inlineRadio1" value="option1">
													<label class="form-check-label" for="inlineRadio1">1</label>
												</div>
												<div class="form-check form-check-inline">
													<input class="form-check-input" name="default_radio" type="radio" id="inlineRadio2" value="option2" checked>
													<label class="form-check-label" for="inlineRadio2">2</label>
												</div>
												<div class="form-check form-check-inline">
													<input class="form-check-input" name="default_radio" type="radio" id="inlineRadio3" value="option3" disabled>
													<label class="form-check-label" for="inlineRadio3">3 (disabled)</label>
												</div>
											</div>
										</div>
									</div>
								</div>
								<div class="hljs-container rounded-bottom">
									<pre><code class="xml" data-url="/assets/data/form-elements/code-7.json"></code></pre>
								</div>
							</div>
						</div>
						<!-- END #radios -->
						
						<!-- BEGIN #switches -->
						<div id="switches" class="mb-5">
							<h4>Switches</h4>
							<p>A switch has the markup of a custom checkbox but uses the <code>.form-switch</code> class to render a toggle switch. Switches also support the disabled attribute.</p>
							<div class="card">
								<div class="card-body">
									<div class="form-check form-switch">
										<input type="checkbox" class="form-check-input" id="customSwitch1">
										<label class="form-check-label" for="customSwitch1">Toggle this switch element</label>
									</div>
									<div class="form-check form-switch">
										<input type="checkbox" class="form-check-input" checked id="customSwitch2">
										<label class="form-check-label" for="customSwitch2">Checked switch element</label>
									</div>
									<div class="form-check form-switch">
										<input type="checkbox" class="form-check-input" disabled id="customSwitch3">
										<label class="form-check-label" for="customSwitch3">Disabled switch element</label>
									</div>
								</div>
								<div class="hljs-container rounded-bottom">
									<pre><code class="xml" data-url="/assets/data/form-elements/code-8.json"></code></pre>
								</div>
							</div>
						</div>
						<!-- END #switches -->
						
						<!-- BEGIN #selectMenu -->
						<div id="selectMenu" class="mb-5">
							<h4>Select menu</h4>
							<p>Custom &lt;select&gt; menus need only a custom class, .form-select to trigger the custom styles. Custom styles are limited to the &lt;select&gt;’s initial appearance and cannot modify the &lt;option&gt;s due to browser limitations.</p>
							<div class="card">
								<div class="card-body">
									<div class="row">
										<div class="col-xl-6">
											<div class="small text-inverse text-opacity-50 mb-2"><b class="fw-bold">DEFAULT</b></div>
											<select class="form-select">
												<option selected>Open this select menu</option>
												<option value="1">One</option>
												<option value="2">Two</option>
												<option value="3">Three</option>
											</select>
										</div>
										<div class="col-xl-6">
											<div class="small text-inverse text-opacity-50 mb-2"><b class="fw-bold">SIZING</b></div>
											<select class="form-select form-select-lg mb-3">
												<option selected>Open this select menu</option>
												<option value="1">One</option>
												<option value="2">Two</option>
												<option value="3">Three</option>
											</select>

											<select class="form-select form-select-sm">
												<option selected>Open this select menu</option>
												<option value="1">One</option>
												<option value="2">Two</option>
												<option value="3">Three</option>
											</select>
										</div>
									</div>
								</div>
								<div class="hljs-container rounded-bottom">
									<pre><code class="xml" data-url="/assets/data/form-elements/code-9.json"></code></pre>
								</div>
							</div>
						</div>
						<!-- END #selectMenu -->
						
						<!-- BEGIN #fileBrowser -->
						<div id="fileBrowser" class="mb-5">
							<h4>File browser</h4>
							<p>The file input is the most gnarly of the bunch and requires additional JavaScript if you’d like to hook them up with functional Choose file… and selected file name text.</p>
							<div class="card">
								<div class="card-body">
									<div class="row">
										<div class="col-xl-6">
											<div class="mb-3">
												<label class="form-label" for="defaultFile">Default file input example</label>
												<input type="file" class="form-control" id="defaultFile">
											</div>
											<div class="mb-3">
												<label class="form-label" for="multipleFile">Multiple files input example</label>
												<input type="file" class="form-control" id="multipleFile" multiple>
											</div>
											<div class="mb-3">
												<label class="form-label" for="disabledFile">Disabled files input example</label>
												<input type="file" class="form-control" id="disabledFile" disabled>
											</div>
										</div>
										<div class="col-xl-6">
											<div class="mb-3">
												<label class="form-label" for="smFile">Small file input example</label>
												<input type="file" class="form-control form-control-sm" id="smFile">
											</div>
											<div class="mb-3">
												<label class="form-label" for="lgFile">Large file input example</label>
												<input type="file" class="form-control form-control-lg" id="lgFile">
											</div>
										</div>
									</div>
								</div>
								<div class="hljs-container rounded-bottom">
									<pre><code class="xml" data-url="/assets/data/form-elements/code-10.json"></code></pre>
								</div>
							</div>
						</div>
						<!-- END #fileBrowser -->
						
						<!-- BEGIN #formGrid -->
						<div id="formGrid" class="mb-5">
							<h4>Form grid</h4>
							<p>More complex forms can be built using bootstrap grid classes. Use these for form layouts that require multiple columns, varied widths, and additional alignment options.</p>
							<div class="card">
								<div class="card-body">
									<form>
										<div class="mb-3 row">
											<label for="inputEmail3" class="col-sm-2 col-form-label">Email</label>
											<div class="col-sm-10">
												<input type="email" class="form-control" id="inputEmail3">
											</div>
										</div>
										<div class="mb-3 row">
											<label for="inputPassword3" class="col-sm-2 col-form-label">Password</label>
											<div class="col-sm-10">
												<input type="password" class="form-control" id="inputPassword3">
											</div>
										</div>
										<fieldset class="mb-2">
											<div class="row">
												<label class="col-form-label col-sm-2 pt-0">Radios</label>
												<div class="col-sm-10">
													<div class="form-check">
														<input class="form-check-input" type="radio" name="gridRadios" id="gridRadios1" value="option1" checked>
														<label class="form-check-label" for="gridRadios1">
															First radio
														</label>
													</div>
													<div class="form-check">
														<input class="form-check-input" type="radio" name="gridRadios" id="gridRadios2" value="option2">
														<label class="form-check-label" for="gridRadios2">
															Second radio
														</label>
													</div>
													<div class="form-check disabled">
														<input class="form-check-input" type="radio" name="gridRadios" id="gridRadios3" value="option3" disabled>
														<label class="form-check-label" for="gridRadios3">
															Third disabled radio
														</label>
													</div>
												</div>
											</div>
										</fieldset>
										<div class="row mb-2">
											<label class="col-sm-2 col-form-label pt-0">Checkbox</label>
											<div class="col-sm-10">
												<div class="form-check">
													<input class="form-check-input" type="checkbox" id="gridCheck1">
													<label class="form-check-label" for="gridCheck1">
														Example checkbox
													</label>
												</div>
											</div>
										</div>
										<div class="form-group row">
											<div class="col-sm-10 offset-sm-2">
												<button type="submit" class="btn btn-outline-theme">Sign in</button>
											</div>
										</div>
									</form>
								</div>
								<div class="hljs-container rounded-bottom">
									<pre><code class="xml" data-url="/assets/data/form-elements/code-11.json"></code></pre>
								</div>
							</div>
						</div>
						<!-- END #formGrid -->
						
						<!-- BEGIN #helpText -->
						<div id="helpText" class="mb-5">
							<h4>Help text</h4>
							<p>Block-level help text in forms can be created using <code>.form-text</code>. Inline help text can be flexibly implemented using any inline HTML element and utility classes like <code>.text-muted</code>.</p>
							<div class="card">
								<div class="card-body">
									<label for="inputPassword5" class="form-label">Password</label>
									<input type="password" id="inputPassword5" class="form-control" aria-describedby="passwordHelpBlock">
									<small id="passwordHelpBlock" class="form-text text-muted">
										Your password must be 8-20 characters long, contain letters and numbers, and must not contain spaces, special characters, or emoji.
									</small>
								</div>
								<div class="hljs-container rounded-bottom">
									<pre><code class="xml" data-url="/assets/data/form-elements/code-12.json"></code></pre>
								</div>
							</div>
						</div>
						<!-- END #helpText -->
						
						<!-- BEGIN #inputGroup -->
						<div id="inputGroup" class="mb-5">
							<h4>Input group</h4>
							<p>Place one add-on or button on either side of an input. You may also place one on both sides of an input. Remember to place <code>&lt;label&gt;</code> outside the input group.</p>
							<div class="card">
								<div class="card-body">
									<div class="input-group flex-nowrap">
										<span class="input-group-text" id="addon-wrapping">@</span>
										<input type="text" class="form-control" placeholder="Username">
										<span class="input-group-text">.com</span>
									</div>
								</div>
								<div class="hljs-container rounded-bottom">
									<pre><code class="xml" data-url="/assets/data/form-elements/code-13.json"></code></pre>
								</div>
							</div>
						</div>
						<!-- END #inputGroup -->
						
						<!-- BEGIN #validation -->
						<div id="validation" class="mb-5">
							<h4>Validation</h4>
							<p>Provide valuable, actionable feedback to your users with HTML5 form validation. Choose from the browser default validation feedback, or implement custom messages with our built-in classes and starter JavaScript.</p>
							<div class="card">
								<div class="card-body">
									<form class="was-validated">
										<div class="row mb-n3">
											<div class="col-md-6 mb-3">
												<label for="validationValidInput" class="form-label">Valid input</label>
												<input type="text" class="form-control is-valid" id="validationValidInput" value="Mark" required>
												<div class="valid-feedback">
													Looks good!
												</div>
											</div>
											<div class="col-md-6 mb-3">
												<label for="validationInvalidInput" class="form-label">Invalid input</label>
												<input type="text" class="form-control is-invalid" id="validationInvalidInput" value="" required>
												<div class="invalid-feedback" id="validationInvalidInputFeedback">
													Please provide a name
												</div>
											</div>
											<div class="col-md-6 mb-3">
												<label for="validationInvalidInputGroup" class="form-label">Input group</label>
												<div class="input-group has-validation">
													<span class="input-group-text">@</span>
													<input type="text" class="form-control is-invalid" id="validationInvalidInputGroup" required>
													<div class="invalid-feedback">
														Please choose a username.
													</div>
												</div>
											</div>
											<div class="col-md-6 mb-3">
												<label for="validationSelectInvalid" class="form-label">Select dropdown</label>
												<select class="form-select is-invalid" id="validationSelectInvalid" required>
													<option selected disabled value="">Choose...</option>
													<option>...</option>
												</select>
												<div class="invalid-feedback">
													Please select a valid state.
												</div>
											</div>
											<div class="col-md-6 mb-3">
												<label for="validationTextarea" class="form-label">Textarea</label>
												<textarea class="form-control is-invalid" id="validationTextarea" placeholder="Required example textarea" required></textarea>
												<div class="invalid-feedback">
													Please enter a message in the textarea.
												</div>
											</div>
											<div class="col-md-6 mb-3">
												<div class="form-check pt-md-3 mt-md-2">
													<input class="form-check-input is-invalid" type="checkbox" value="" id="validationInvalidCheckbox" required>
													<label class="form-check-label" for="validationInvalidCheckbox">
														Agree to terms and conditions
													</label>
													<div class="invalid-feedback">
														You must agree before submitting.
													</div>
												</div>
											</div>
										</div>
									</form>
									<hr>
									<form class="was-validated" novalidate>
										<div class="row mb-n3">
											<div class="col-md-6 mb-5 position-relative">
												<label for="validationTooltip01">Tooltip valid</label>
												<input type="text" class="form-control" id="validationTooltip01" value="Mark" required>
												<div class="valid-tooltip">
													Looks good!
												</div>
											</div>
											<div class="col-md-6 mb-5 position-relative">
												<label for="validationTooltip02">Tooltip invalid</label>
												<div class="input-group">
													<div class="input-group-text">@</div>
													<input type="text" class="form-control" id="validationTooltip02" required>
													<div class="invalid-tooltip">
														Field is required
													</div>
												</div>
											</div>
											<div class="col-md-6 mb-5 position-relative">
												<label for="validationTooltip03">Tooltip dropdown</label>
												<select class="form-select" id="validationTooltip03" required>
													<option selected disabled value="">Choose...</option>
													<option>...</option>
												</select>
												<div class="invalid-tooltip">
													Please select a valid state.
												</div>
											</div>
										</div>
									</form>
								</div>
								<div class="hljs-container rounded-bottom">
									<pre><code class="xml" data-url="/assets/data/form-elements/code-14.json"></code></pre>
								</div>
							</div>
						</div>
						<!-- END #validation -->
					</div>
					<!-- END col-9-->
					<!-- BEGIN col-3 -->
					<div class="col-xl-3">
						<!-- BEGIN #sidebar-bootstrap -->
						<nav id="sidebar-bootstrap" class="navbar navbar-sticky d-none d-xl-block">
							<nav class="nav">
								<a class="nav-link" href="#formControls" data-toggle="scroll-to">Form controls</a>
								<a class="nav-link" href="#sizing" data-toggle="scroll-to">Sizing</a>
								<a class="nav-link" href="#readonly" data-toggle="scroll-to">Readonly</a>
								<a class="nav-link" href="#readonlyPlainText" data-toggle="scroll-to">Readonly plain text</a>
								<a class="nav-link" href="#rangeInputs" data-toggle="scroll-to">Range inputs</a>
								<a class="nav-link" href="#checkboxes" data-toggle="scroll-to">Checkboxes</a>
								<a class="nav-link" href="#radios" data-toggle="scroll-to">Radios</a>
								<a class="nav-link" href="#switches" data-toggle="scroll-to">Switches</a>
								<a class="nav-link" href="#selectMenu" data-toggle="scroll-to">Select menu</a>
								<a class="nav-link" href="#fileBrowser" data-toggle="scroll-to">File browser</a>
								<a class="nav-link" href="#formGrid" data-toggle="scroll-to">Form grid</a>
								<a class="nav-link" href="#helpText" data-toggle="scroll-to">Help text</a>
								<a class="nav-link" href="#inputGroup" data-toggle="scroll-to">Input group</a>
								<a class="nav-link" href="#validation" data-toggle="scroll-to">Validation</a>
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
