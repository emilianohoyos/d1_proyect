@extends('layout.default', [
	'appClass' => 'app-content-full-height',
	'appContentClass' => 'p-0'
])

@section('title', 'Inbox (20+)')

@section('content')
	<!-- BEGIN mailbox -->
	<div class="mailbox">
		<!-- BEGIN mailbox-toolbar -->
		<div class="mailbox-toolbar">
			<div class="mailbox-toolbar-item"><span class="mailbox-toolbar-text">Mailboxes</span></div>
			<div class="mailbox-toolbar-item"><a href="/email/inbox" class="mailbox-toolbar-link active">Inbox</a></div>
			<div class="mailbox-toolbar-item"><a href="/email/inbox" class="mailbox-toolbar-link">Sent</a></div>
			<div class="mailbox-toolbar-item"><a href="/email/inbox" class="mailbox-toolbar-link">Drafts (1)</a></div>
			<div class="mailbox-toolbar-item"><a href="/email/inbox" class="mailbox-toolbar-link">Junk</a></div>
			<div class="mailbox-toolbar-item"><a href="/email/compose" class="mailbox-toolbar-link text-theme bg-theme bg-opacity-10">New Message <i class="fa fa-pen fs-12px ms-1"></i></a></div>
		</div>
		<!-- END mailbox-toolbar -->
		<!-- BEGIN mailbox-body -->
		<div class="mailbox-body">
			<!-- BEGIN mailbox-sidebar -->
			<div class="mailbox-sidebar">
				<div data-scrollbar="true" data-height="100%" data-skip-mobile="true">
					<div class="mailbox-list">
						<div class="mailbox-list-item unread has-attachment">
							<div class="mailbox-checkbox">
								<div class="form-check">
									<input class="form-check-input" type="checkbox" value="" id="mailCheckbox1">
									<label class="form-check-label" for="mailCheckbox1"></label>
								</div>
							</div>
							<div class="mailbox-message">
								<a href="/email/detail" class="mailbox-list-item-link">
									<div class="mailbox-sender">
										<span class="mailbox-sender-name">Apple</span>
										<span class="mailbox-time">1 hour ago</span>
									</div>
									<div class="mailbox-title">Your payment is received</div>
									<div class="mailbox-desc">
										Praesent id pulvinar orci. Donec ac metus non ligula faucibus venenatis. Suspendisse tortor est, placerat eu dui sed...
									</div>
								</a>
							</div>
						</div>
						<div class="mailbox-list-item unread has-attachment">
							<div class="mailbox-checkbox">
								<div class="form-check">
									<input class="form-check-input" type="checkbox" value="" id="mailCheckbox2">
									<label class="form-check-label" for="mailCheckbox2"></label>
								</div>
							</div>
							<div class="mailbox-message">
								<a href="/email/detail" class="mailbox-list-item-link">
									<div class="mailbox-sender">
										<span class="mailbox-sender-name">Chance Graham</span>
										<span class="mailbox-time">5 hours ago</span>
									</div>
									<div class="mailbox-title">Trip to South America</div>
									<div class="mailbox-desc">
										Quisque luctus sapien sodales pulvinar porta. In pretium accumsan elit, vitae blandit arcu suscipit eu. Ut tortor libero, gravida ut nisl tincidunt, efficitur laoreet mauris.
									</div>
								</a>
							</div>
						</div>
						<div class="mailbox-list-item has-attachment">
							<div class="mailbox-checkbox">
								<div class="form-check">
									<input class="form-check-input" type="checkbox" value="" id="mailCheckbox3">
									<label class="form-check-label" for="mailCheckbox3"></label>
								</div>
							</div>
							<div class="mailbox-message">
								<a href="/email/detail" class="mailbox-list-item-link">
									<div class="mailbox-sender">
										<span class="mailbox-sender-name">Paypal Inc</span>
										<span class="mailbox-time">Aug 11</span>
									</div>
									<div class="mailbox-title">Important information about your order #019244</div>
									<div class="mailbox-desc">
										Waltz, bad nymph, for quick jigs vex! Fox nymphs grab quick-jived waltz. Brick quiz whangs jumpy veldt fox. Bright vixens jump; dozy fowl quack. Quick wafting zephyrs vex bold Jim. Quick zephyrs blow, vexing daft Jim.
									</div>
								</a>
							</div>
						</div>
						<div class="mailbox-list-item">
							<div class="mailbox-checkbox">
								<div class="form-check">
									<input class="form-check-input" type="checkbox" value="" id="mailCheckbox4">
									<label class="form-check-label" for="mailCheckbox4"></label>
								</div>
							</div>
							<div class="mailbox-message">
								<a href="/email/detail" class="mailbox-list-item-link">
									<div class="mailbox-sender">
										<span class="mailbox-sender-name">Fitbit</span>
										<span class="mailbox-time">Aug 09</span>
									</div>
									<div class="mailbox-title">Stylish accessories for your Charge 2</div>
									<div class="mailbox-desc">
										How quickly daft jumping zebras vex. Two driven jocks help fax my big quiz. Quick, Baz, get my woven flax jodhpurs! "Now fax quiz Jack!" my brave ghost pled. 
									</div>
								</a>
							</div>
						</div>
						<div class="mailbox-list-item">
							<div class="mailbox-checkbox">
								<div class="form-check">
									<input class="form-check-input" type="checkbox" value="" id="mailCheckbox5">
									<label class="form-check-label" for="mailCheckbox5"></label>
								</div>
							</div>
							<div class="mailbox-message">
								<a href="/email/detail" class="mailbox-list-item-link">
									<div class="mailbox-sender">
										<span class="mailbox-sender-name">Apple</span>
										<span class="mailbox-time">Aug 09</span>
									</div>
									<div class="mailbox-title">Your invoice from Apple.</div>
									<div class="mailbox-desc">
										Flummoxed by job, kvetching W. zaps Iraq. Cozy sphinx waves quart jug of bad milk. A very bad quack might jinx zippy fowls. 
									</div>
								</a>
							</div>
						</div>
						<div class="mailbox-list-item">
							<div class="mailbox-checkbox">
								<div class="form-check">
									<input class="form-check-input" type="checkbox" value="" id="mailCheckbox6">
									<label class="form-check-label" for="mailCheckbox6"></label>
								</div>
							</div>
							<div class="mailbox-message">
								<a href="/email/detail" class="mailbox-list-item-link">
									<div class="mailbox-sender">
										<span class="mailbox-sender-name">Hotels.com</span>
										<span class="mailbox-time">Aug 09</span>
									</div>
									<div class="mailbox-title">[Ends tonight!] 48 Hour Sale - Save up to 50% + save an extra 10%</div>
									<div class="mailbox-desc">
										Phasellus vulputate, ligula ac hendrerit euismod, nunc metus maximus tellus, aliquam finibus justo lorem a augue. 
									</div>
								</a>
							</div>
						</div>
						<div class="mailbox-list-item">
							<div class="mailbox-checkbox">
								<div class="form-check">
									<input class="form-check-input" type="checkbox" value="" id="mailCheckbox7">
									<label class="form-check-label" for="mailCheckbox7"></label>
								</div>
							</div>
							<div class="mailbox-message">
								<a href="/email/detail" class="mailbox-list-item-link">
									<div class="mailbox-sender">
										<span class="mailbox-sender-name">Google Calendar</span>
										<span class="mailbox-time">Aug 08</span>
									</div>
									<div class="mailbox-title">Daily schedule on Tuesday, May 9, 2017</div>
									<div class="mailbox-desc">
										Suspendisse potenti. Praesent ac ullamcorper sem. Mauris luctus accumsan felis
									</div>
								</a>
							</div>
						</div>
						<div class="mailbox-list-item">
							<div class="mailbox-checkbox">
								<div class="form-check">
									<input class="form-check-input" type="checkbox" value="" id="mailCheckbox8">
									<label class="form-check-label" for="mailCheckbox8"></label>
								</div>
							</div>
							<div class="mailbox-message">
								<a href="/email/detail" class="mailbox-list-item-link">
									<div class="mailbox-sender">
										<span class="mailbox-sender-name">Facebook Blueprint</span>
										<span class="mailbox-time">Aug 08</span>
									</div>
									<div class="mailbox-title">April 2017 – Blueprint Highlights</div>
									<div class="mailbox-desc">
										Phasellus pretium viverra tortor, eu sagittis erat aliquam nec. Nunc et volutpat ligula. Duis viverra posuere enim, ac bibendum massa viverra id.
									</div>
								</a>
							</div>
						</div>
						<div class="mailbox-list-item">
							<div class="mailbox-checkbox">
								<div class="form-check">
									<input class="form-check-input" type="checkbox" value="" id="mailCheckbox9">
									<label class="form-check-label" for="mailCheckbox9"></label>
								</div>
							</div>
							<div class="mailbox-message">
								<a href="/email/detail" class="mailbox-list-item-link">
									<div class="mailbox-sender">
										<span class="mailbox-sender-name">Customer Care</span>
										<span class="mailbox-time">Aug 08</span>
									</div>
									<div class="mailbox-title">Re: [Case #1567940] - Re: [Important] Exabytes</div>
									<div class="mailbox-desc">
										Nam imperdiet molestie arcu, et gravida quam lacinia lobortis.
									</div>
								</a>
							</div>
						</div>
						<div class="mailbox-list-item">
							<div class="mailbox-checkbox">
								<div class="form-check">
									<input class="form-check-input" type="checkbox" value="" id="mailCheckbox10">
									<label class="form-check-label" for="mailCheckbox10"></label>
								</div>
							</div>
							<div class="mailbox-message">
								<a href="/email/detail" class="mailbox-list-item-link">
									<div class="mailbox-sender">
										<span class="mailbox-sender-name">Flight Status</span>
										<span class="mailbox-time">Aug 07</span>
									</div>
									<div class="mailbox-title">[Case#2017022137015743] *FLIGHT RETIMED* **MH2713/15JUL17**</div>
									<div class="mailbox-desc">
										Etiam condimentum orci ut velit suscipit, ut accumsan elit aliquet. Nulla cursus mi at augue vestibulum suscipit. Aenean ut risus euismod, laoreet justo non, convallis quam.
									</div>
								</a>
							</div>
						</div>
					</div>
				</div>
			</div>
			<!-- END mailbox-sidebar -->
			<!-- BEGIN mailbox-content -->
			<div class="mailbox-content d-none d-lg-block">
				<div data-scrollbar="true" data-height="100%" data-skip-mobile="true">
					<div class="mailbox-empty-message">
						<div class="mailbox-empty-message-img"><img src="/assets/img/page/email.svg" alt=""></div>
						<div class="mailbox-empty-message-title">No message selected</div>
					</div>
				</div>
			</div>
			<!-- END mailbox-content -->
		</div>
		<!-- END mailbox-body -->
	</div>
	<!-- END mailbox -->
@endsection
