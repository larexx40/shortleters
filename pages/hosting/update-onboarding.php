<!DOCTYPE html>

<html>
	<head>
		<meta charset="utf-8" />
		<meta http-equiv="X-UA-Compatible" content="IE=edge" />
		<meta name="viewport" content="width=device-width, initial-scale=1" />
		<link rel="stylesheet" href="../../assets/fonts/bootstrap-icons.css" />
		<link rel="stylesheet" href="../../assets/css/bootstrap.min.css" />
		<link rel="stylesheet" href="../../assets/css/nav.css" />
		<link rel="stylesheet" href="../../assets/css/footer.css" />
		<link rel="stylesheet" href="../../assets/css/layout.css" />
		<link rel="stylesheet" href="../../assets/css/hosting.css" />
		<title>Account Settings</title>
	</head>
	<style>
		.photo-stack h5 {
			font-weight: 900;
			font-size: 1.2rem;
		}
		.image-wrapper {
			display: flex;
			align-items: center;
			column-gap: 1rem;
			white-space: nowrap;
			flex-wrap: nowrap;
			margin-top: 2rem;
			overflow-x: auto;
			padding-bottom: 2rem;
		}
		.image-wrapper::-webkit-scrollbar {
			width: 4px;
			height: 4px;
			background-color: #ddd;
			border-radius: 6px;
			cursor: pointer;
		}
		.image-wrapper::-webkit-scrollbar-thumb {
			height: 3px;
			background-color: #000;
			border-radius: 6px;
			cursor: pointer;
		}
		.image-wrapper .img {
			min-width: 280px;
		}
		.image-wrapper .img img {
			border-radius: 5px;
		}
		@media all and (max-width: 600px) {
			._reigil {
				flex-direction: column;
				row-gap: 1rem;
				margin-bottom: 2rem;
			}
			.nav#v-pills-tab {
				margin: 2rem 0 3rem !important;
				column-gap: 1rem;
			}
		}
	</style>
	<body>
		<div class="body-wrapper">
			<header class="d-flex align-items-center">
				<div class="header-inner d-flex align-items-center w-100 justify-content-between px-md-5 px-3">
					<div class="first-div">
						<div class="lg-screen-logo" style="width:30%;">
							<a href="#">
								<img style="width:100%;" src="../../assets/images/GREEN_LOGO_HORIZONTAL_1.png" /> 
							</a>
						</div>
					</div>
					<div class="second-div">
						<div class="end-tabs">
							<ul class="host d-none d-lg-flex gap-5">
								<li>
									<a href="./index.php" class="host-link"><span>Today</span></a>
								</li>
								<li>
									<a href="./message.php" class="host-link"><span>Inbox</span></a>
								</li>
								<li>
									<a href="./onboarding/index.php" class="host-link"><span>Calendar</span></a>
								</li>
								<li>
									<a href="./insights.php" class="host-link"><span>Insights</span></a>
								</li>
								<li class="dropdown menu-link w-auto h-auto border-0 d-block" style="border: none">
									<a href="#" class="host-link dropdown-toggle" data-bs-toggle="dropdown" aria-expanded="false"
										><span>Menu</span></a
									>
									<ul class="dropdown-menu">
										<li><a class="dropdown-item" href="./listing.php">Listing</a></li>
										<li><a class="dropdown-item active" href="./reservations.php">Reservations</a></li>
										<li><a class="dropdown-item" href="./onboarding/index.php">Create a new listing</a></li>
										<div class="sub-menu-links">
											<li><a class="dropdown-item" href="./transactions.php">Transaction History</a></li>
										</div>
									</ul>
								</li>
							</ul>
						</div>
					</div>
					<div class="third-div">
						<div class="end-tabs d-flex gap-3 align-items-center">
							<div class="menu-link d-none d-lg-flex">
								<div class="dropdown">
									<a
										href="#"
										class="host-icon"
										class="dropdown-toggle"
										type="button"
										data-bs-toggle="dropdown"
										aria-expanded="false"
										><em class="bi bi-bell" style="font-size: 20px"></em
									></a>
									<ul class="dropdown-menu" style="min-height: 300px"></ul>
								</div>
							</div>
							<div class="menu-link d-none d-lg-flex">
								<div class="dropdown">
									<button class="dropdown-toggle _1u0z83f5" type="button" data-bs-toggle="dropdown" aria-expanded="false">
										<div class="user-icon mx-0">
											<svg
												xmlns="http://www.w3.org/2000/svg"
												width="32"
												height="32"
												preserveAspectRatio="xMidYMid meet"
												viewBox="0 0 1792 1792">
												<path
													fill="currentColor"
													d="M1523 1339q-22-155-87.5-257.5T1251 963q-67 74-159.5 115.5T896 1120t-195.5-41.5T541 963q-119 16-184.5 118.5T269 1339q106 150 271 237.5t356 87.5t356-87.5t271-237.5zm-243-699q0-159-112.5-271.5T896 256T624.5 368.5T512 640t112.5 271.5T896 1024t271.5-112.5T1280 640zm512 256q0 182-71 347.5t-190.5 286T1245 1721t-349 71q-182 0-348-71t-286-191t-191-286T0 896t71-348t191-286T548 71T896 0t348 71t286 191t191 286t71 348z" />
											</svg>
										</div>
									</button>
									<ul class="dropdown-menu">
										<li><a class="dropdown-item" href="#">Sign up</a></li>
										<li><a class="dropdown-item" href="#">Log in</a></li>
										<div class="sub-menu-links">
											<li><a class="dropdown-item" href="#">Host your Home</a></li>
											<li><a class="dropdown-item" href="#">Host an experience</a></li>
											<li><a class="dropdown-item" href="#">Help</a></li>
										</div>
									</ul>
								</div>
							</div>
							<div
								class="menu-link d-flex d-lg-none"
								data-bs-toggle="offcanvas"
								data-bs-target="#offcanvasTop"
								aria-controls="offcanvasTop">
								<div class="svg">
									<svg
										xmlns="http://www.w3.org/2000/svg"
										width="20"
										height="20"
										preserveAspectRatio="xMidYMid meet"
										viewBox="0 0 24 24">
										<path
											fill="currentColor"
											d="M2 6a1 1 0 0 1 1-1h18a1 1 0 1 1 0 2H3a1 1 0 0 1-1-1Zm0 6.032a1 1 0 0 1 1-1h18a1 1 0 1 1 0 2H3a1 1 0 0 1-1-1Zm1 5.032a1 1 0 1 0 0 2h18a1 1 0 0 0 0-2H3Z" />
									</svg>
								</div>
							</div>
						</div>
					</div>
				</div>
			</header>
			<main class="p-0 mx-0 justify-content-center row" style="margin-top: 80px">
				<div class="px-md-5 my-5">
					<div class="_reigil">
						<div class="_17hydb6">
							<h1 tabindex="-1" class="_14i3z6h" elementtiming="LCP-target" style="font-weight: 900b">Lovely Condole bedspace</h1>
						</div>
						<div class="d-flex gap-2 align-items-center">
							<a href="/manage-your-space/718921680261877081/details#availability-status" class="_1e5q4qoz">
								<span class="_escvzw">
									<svg
										viewBox="0 0 16 16"
										role="img"
										aria-hidden="false"
										aria-label="Listed"
										focusable="false"
										style="height: 10px; width: 10px; fill: rgb(0, 138, 5)">
										<ellipse cx="8" cy="8" fill-rule="evenodd" rx="8" ry="8"></ellipse>
									</svg>
								</span>
								<span class="_3hmsj">Listed</span>
							</a>
							<a
								href="/manage-your-space/718921680261877081/policies-and-rules#how-guests-book"
								class="_1e5q4qoz d-flex gap-2 align-items-center">
								<span class="_escvzw">
									<svg
										xmlns="http://www.w3.org/2000/svg"
										viewBox="0 0 16 16"
										aria-hidden="true"
										role="presentation"
										focusable="false"
										style="display: block; height: 16px; width: 16px; fill: rgb(255, 175, 15)">
										<path
											d="M8.903 1.037A.23.23 0 0 1 9 1.225V7h3.556a.23.23 0 0 1 .188.363l-5.326 7.545A.23.23 0 0 1 7 14.775V9H3.444a.23.23 0 0 1-.188-.363l5.326-7.545a.23.23 0 0 1 .32-.055z"></path>
									</svg>
								</span>
								<span class="_3hmsj">Instant Book on</span>
							</a>
						</div>
						<div class="_1bmsi4o mx-3">
							<div class="_1wf1ivm">
								<a target="_blank" href="/rooms/718921680261877081?preview_for_ml=true" class="_1ju7xj0j">Preview listing</a>
							</div>
						</div>
					</div>
					<div class="d-md-flex align-items-start">
						<div class="nav flex-md-column pe-md-5 nav-pills me-3 d-flex" id="v-pills-tab" role="tablist" aria-orientation="vertical">
							<button
								class="nav-link active"
								id="v-pills-home-tab"
								data-bs-toggle="pill"
								data-bs-target="#v-pills-home"
								type="button"
								role="tab"
								aria-controls="v-pills-home"
								aria-selected="true">
								Listing details
							</button>
							<button
								class="nav-link"
								id="v-pills-profile-tab"
								data-bs-toggle="pill"
								data-bs-target="#v-pills-profile"
								type="button"
								role="tab"
								aria-controls="v-pills-profile"
								aria-selected="false">
								Pricing and availability
							</button>
							<button
								class="nav-link"
								id="v-pills-disabled-tab"
								data-bs-toggle="pill"
								data-bs-target="#v-pills-disabled"
								type="button"
								role="tab"
								aria-controls="v-pills-disabled"
								aria-selected="false">
								Policies and rules
							</button>
							<button
								class="nav-link"
								id="v-pills-messages-tab"
								data-bs-toggle="pill"
								data-bs-target="#v-pills-messages"
								type="button"
								role="tab"
								aria-controls="v-pills-messages"
								aria-selected="false">
								Info for guests
							</button>
							<button
								class="nav-link"
								id="v-pills-settings-tab"
								data-bs-toggle="pill"
								data-bs-target="#v-pills-settings"
								type="button"
								role="tab"
								aria-controls="v-pills-settings"
								aria-selected="false">
								Co-hosts
							</button>
						</div>

						<!-- ✅❎✅✅✅❎❎❎❎ -->
						<!-- ! MODAL TO WORK WITH -->
						<!-- <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#exampleModal">Launch demo modal</button> -->

						<!-- Modal -->
						<!-- <div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
							<div class="modal-dialog">
								<div class="modal-content">
									<div class="modal-header">
										<h5 class="modal-title" id="exampleModalLabel">Modal title</h5>
										<button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
									</div>
									<div class="modal-body">...</div>
									<div class="modal-footer">
										<button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
										<button type="button" class="btn btn-primary">Save changes</button>
									</div>
								</div>
							</div>
						</div> -->
						<!-- ✅❎✅✅✅❎❎❎❎ -->

						<!-- tab content -->
						<div class="tab-content w-100 px-md-5" id="v-pills-tabContent">
							<!-- each tab pane -->
							<div class="tab-pane fade show active" id="v-pills-home" role="tabpanel" aria-labelledby="v-pills-home-tab" tabindex="0">
								<section class="listing-details">
									<ul class="listing-basics">
										<label class="_14i3z6h">Listing basics</label>
										<li>
											<div class="d-flex justify-content-between align-items-start photo-stack">
												<div class="d-grid">
													<h5>Photos</h5>
													<div class="image-wrapper position-relative">
														<div class="img">
															<img
																src="../../assets/images/e52597a0-a7cb-46bd-9218-eab08e304d46.jpeg"
																alt=""
																class="img-fluid" />
														</div>
														<div class="img">
															<img
																src="../../assets/images/cd0a7bb3-d480-4062-8904-2525b3afb4d2.jpg"
																alt=""
																class="img-fluid" />
														</div>
														<div class="img">
															<img
																src="../../assets/images/5c54ae55-efdc-4b5e-85c0-e76c42d8f98d.jpg"
																alt=""
																class="img-fluid" />
														</div>
														<div class="img">
															<img
																src="../../assets/images/8b6f1855-fb19-475b-bdff-54d971315808.jpg"
																alt=""
																class="img-fluid" />
														</div>
														<div class="img">
															<img
																src="../../assets/images/a99d723b-5920-4e3c-bbf1-51e1ac0f6ddb.jpeg"
																alt=""
																class="img-fluid" />
														</div>
														<div class="img">
															<img
																src="../../assets/images/257759d7-2ff9-4967-a6e7-cb5165253b7d.jpg"
																alt=""
																class="img-fluid" />
														</div>
													</div>
												</div>
												<a href="./manage-your-space.php" class="_1e5q4qoz">Edit</a>
											</div>
										</li>
										<hr />
									</ul>
									<hr />
									<ul class="listing-basics">
										<label class="_14i3z6h">Listing basics</label>
										<li>
											<div class="d-flex justify-content-between align-items-start">
												<div class="d-grid">
													<b>Listing title</b>
													<small>Lovely condol bedspace</small>
												</div>
												<a href="#" class="_1e5q4qoz">Edit</a>
											</div>
										</li>
										<hr />
										<li>
											<div class="d-flex justify-content-between align-items-start">
												<div class="d-grid">
													<b>Listing description</b>
													<small>Relax with the whole family at this peaceful place to stay.</small>
												</div>
												<a href="#" class="_1e5q4qoz">Edit</a>
											</div>
										</li>
										<hr />
										<li>
											<div class="d-flex justify-content-between align-items-start">
												<div class="d-grid">
													<b>Number of guests</b>
													<small>22.</small>
												</div>
												<a href="#" class="_1e5q4qoz">Edit</a>
											</div>
										</li>
										<hr />
										<li>
											<div class="d-flex justify-content-between align-items-start">
												<div class="d-grid">
													<b>Custom link</b>
													<small>Not Set.</small>
												</div>
												<a href="#" class="_1e5q4qoz">Edit</a>
											</div>
										</li>
										<hr />
										<li>
											<div class="d-flex justify-content-between align-items-start">
												<div class="d-grid">
													<b>Languages</b>
													<small>English (Default).</small>
												</div>
												<a href="#" class="_1e5q4qoz">Edit</a>
											</div>
										</li>
										<hr />
										<li>
											<div class="d-flex justify-content-between align-items-start">
												<div class="d-grid">
													<b>Listing status</b>
													<small><em class="b"></em></small>
												</div>
												<a href="#" class="_1e5q4qoz">Edit</a>
											</div>
										</li>
										<hr />
									</ul>
									<ul class="amenities">
										<li>
											<div class="d-flex my-4 justify-content-between align-items-start">
												<div class="d-grid">
													<label class="_14i3z6h mb-0">Amenities</label>
													<small>Exercise equipment</small>
												</div>
												<a href="#" class="_1e5q4qoz">Edit</a>
											</div>
										</li>
										<hr />
									</ul>
								</section>
							</div>
							<!-- end of each tab pane -->
							<!-- each tab pane -->
							<div class="tab-pane fade" id="v-pills-profile" role="tabpanel" aria-labelledby="v-pills-profile-tab" tabindex="0">
								<section class="pricing-and-availability">
									<ul class="pricing">
										<label class="_14i3z6h">Pricing</label>
										<li>
											<div class="d-flex justify-content-between align-items-start">
												<div class="d-grid">
													<b>Check-in window</b>
													<small>After 3:00 PM</small>
												</div>
												<a href="#" data-bs-toggle="modal" data-bs-target="#guests-payment" class="_1e5q4qoz" role="button"
													>Show</a
												>
											</div>
										</li>
										<hr />
										<li>
											<div class="d-flex justify-content-between align-items-start">
												<div class="d-grid">
													<b>Nightly price</b>
													<small
														>You are responsible for choosing the listing price.
														<a href="" style="text-decoration: underline; color: #000; font-size: 15px">
															Learn more
														</a></small
													>
													<small class="mt-3"
														>Smart Pricing off <br />
														Base price: $39</small
													>
												</div>
												<a href="#" class="_1e5q4qoz" data-bs-toggle="modal" data-bs-target="#smart-pricing" role="button"
													>Edit</a
												>
											</div>
										</li>
										<hr />
										<li>
											<div class="d-flex justify-content-between align-items-start">
												<div class="d-grid">
													<b>Listing currency</b>
													<small>USD</small>
												</div>
												<a href="#" class="_1e5q4qoz" data-bs-toggle="modal" data-bs-target="#listing-currency" role="button"
													>Edit</a
												>
											</div>
										</li>
										<hr />
									</ul>
									<ul class="discount">
										<label class="_14i3z6h">Discounts</label>
										<li>
											<div class="d-flex my-4 justify-content-between align-items-start">
												<div class="d-grid">
													<b>Weekly discount</b>
													<small>Not set</small>
												</div>
												<a href="#" class="_1e5q4qoz" data-bs-toggle="modal" data-bs-target="#weekly-discount" role="button"
													>Edit</a
												>
											</div>
										</li>
										<hr />
										<li>
											<div class="d-flex my-4 justify-content-between align-items-start">
												<div class="d-grid">
													<b>Monthly discount</b>
													<small>Not set</small>
												</div>
												<a href="#" class="_1e5q4qoz" role="button" data-bs-toggle="modal" data-bs-target="#monthly-discount"
													>Edit</a
												>
											</div>
										</li>
										<hr />
										<li>
											<div class="d-flex my-4 justify-content-between align-items-start">
												<div class="d-grid">
													<b>Custom length-of-stay discounts</b>
													<small>Not set</small>
												</div>
												<a
													href="#"
													class="_1e5q4qoz"
													data-bs-toggle="modal"
													role="button"
													data-bs-target="#custom-length-of-stay-discounts"
													>Edit</a
												>
											</div>
										</li>
										<hr />
										<li>
											<div class="d-flex my-4 justify-content-between align-items-start">
												<div class="d-grid">
													<b>Early bird discounts</b>
													<small>Not set</small>
												</div>
												<a
													href="#"
													class="_1e5q4qoz"
													data-bs-toggle="modal"
													data-bs-target="#early-bird-discounts"
													role="button"
													>Edit</a
												>
											</div>
										</li>
										<hr />
										<li>
											<div class="d-flex my-4 justify-content-between align-items-start">
												<div class="d-grid">
													<b>Last-minute discounts</b>
													<small>Not set</small>
												</div>
												<a
													href="#"
													class="_1e5q4qoz"
													data-bs-toggle="modal"
													data-bs-target="#last-minute-discounts"
													role="button"
													>Edit</a
												>
											</div>
										</li>
										<hr />
									</ul>
									<ul class="additional-charges">
										<label class="_14i3z6h">Additional charges</label>
										<li>
											<div class="d-flex my-4 justify-content-between align-items-start">
												<div class="d-grid">
													<b>Cleaning fee</b>
													<small>No charge for cleaning</small>
												</div>
												<a href="#" role="button" data-bs-toggle="modal" data-bs-target="#cleaning-fee" class="_1e5q4qoz"
													>Edit</a
												>
											</div>
										</li>
										<hr />
										<li>
											<div class="d-flex my-4 justify-content-between align-items-start">
												<div class="d-grid">
													<b>Pet fee</b>
													<small>Pets are not currently allowed</small>
												</div>
												<a href="#" class="_1e5q4qoz" role="button" data-bs-toggle="modal" data-bs-target="#pet-fee">Edit</a>
											</div>
										</li>
										<hr />
										<li>
											<div class="d-flex my-4 justify-content-between align-items-start">
												<div class="d-grid">
													<b>Extra guest fee</b>
													<small>Not set</small>
												</div>
												<a href="#" class="_1e5q4qoz" role="button" data-bs-toggle="modal" data-bs-target="#extra-guest-fee"
													>Edit</a
												>
											</div>
										</li>
										<hr />
										<li>
											<div class="d-flex my-4 justify-content-between align-items-start">
												<div class="d-grid">
													<b>Weekend nightly price</b>
													<small>Not set</small>
												</div>
												<a
													href="#"
													class="_1e5q4qoz"
													role="button"
													data-bs-toggle="modal"
													data-bs-target="#weekend-nightly-price"
													>Edit</a
												>
											</div>
										</li>
										<hr />
									</ul>
									<ul class="trip-length">
										<label class="_14i3z6h">Trip length</label>
										<li>
											<div class="d-flex my-4 justify-content-between align-items-start">
												<div class="d-grid">
													<b>Minimum stay</b>
													<small>1 night</small>
												</div>
												<a href="#" class="_1e5q4qoz">Edit</a>
											</div>
										</li>
										<hr />
										<li>
											<div class="d-flex my-4 justify-content-between align-items-start">
												<div class="d-grid">
													<b>Maximum stay</b>
													<small>365 nights</small>
												</div>
												<a href="#" class="_1e5q4qoz">Edit</a>
											</div>
										</li>
										<hr />
										<li>
											<div class="d-flex my-4 justify-content-between align-items-start">
												<div class="d-grid">
													<b>Custom trip lengths</b>
													<small>None</small>
												</div>
												<a href="#" class="_1e5q4qoz">Edit</a>
											</div>
										</li>
										<hr />
									</ul>
									<ul class="calendar-availability">
										<label class="_14i3z6h">Calendar availability</label>
										<li>
											<div class="d-flex my-4 justify-content-between align-items-start">
												<div class="d-grid">
													<b>Advance notice</b>
													<small>Same day, until 12:00 AM</small>
												</div>
												<a href="#" class="_1e5q4qoz" role="button" data-bs-target="#advance-notice" data-bs-dismiss="modal"
													>Edit</a
												>
											</div>
										</li>
										<hr />
										<li>
											<div class="d-flex my-4 justify-content-between align-items-start">
												<div class="d-grid">
													<b>Preparation time</b>
													<small>None</small>
												</div>
												<a href="#" class="_1e5q4qoz" role="button" data-bs-target="#preparation-time" data-bs-toggle="modal"
													>Edit</a
												>
											</div>
										</li>
										<hr />
										<li>
											<div class="d-flex my-4 justify-content-between align-items-start">
												<div class="d-grid">
													<b>Availability window</b>
													<small>12 months in advance</small>
												</div>
												<a
													href="#"
													class="_1e5q4qoz"
													role="button"
													data-bs-target="#availability-window"
													data-bs-toggle="modal"
													>Edit</a
												>
											</div>
										</li>
										<hr />
										<li>
											<div class="d-flex my-4 justify-content-between align-items-start">
												<div class="d-grid">
													<b>Restricted check-in days</b>
													<small>Not set</small>
												</div>
												<a
													href="#"
													class="_1e5q4qoz"
													data-bs-toggle="modal"
													role="button"
													data-bs-target="#restricted-check-in"
													>Edit</a
												>
											</div>
										</li>
										<hr />
									</ul>
									<ul class="calendar-sync">
										<label class="_14i3z6h">Calendar sync</label>
										<li>
											<div class="d-flex my-4 justify-content-between align-items-start">
												<div class="d-grid">
													<small>Automatically block days for this listing when you link to another calendar.</small>
													<a
														href="#"
														role="button"
														style="
															font-size: 15px;
															border: 2px solid rgb(0, 132, 137);
															border-radius: 5px;
															padding: 12px 2rem;
															width: max-content;
															margin-top: 1rem;
															color: rgb(0, 132, 137);
															font-weight: 900;
														"
														>Import a calendar</a
													>
												</div>
												<a href="#" class="_1e5q4qoz">Edit</a>
											</div>
										</li>
										<hr />
										<li>
											<div class="d-flex my-4 justify-content-between align-items-center">
												<div class="d-grid">
													<b>Linked Airbnb calendars</b>
												</div>
												<a href="#" class="_1e5q4qoz">Edit</a>
											</div>
										</li>
										<hr />
									</ul>
									<ul class="sharing-settings">
										<li>
											<div class="d-flex my-4 justify-content-between align-items-start">
												<div class="d-grid">
													<b>Sharing settings</b>
													<small
														>Other Hosts will get either your listing photo and title, or your booked prices, dates, and
														number of guests.</small
													>
												</div>
												<a href="#" class="_1e5q4qoz" data-bs-toggle="modal" data-bs-target="#sharing-settings" role="button"
													>Edit</a
												>
											</div>
										</li>
										<hr />
									</ul>
								</section>
							</div>
							<!-- end of each tab pane -->
							<!-- each tab pane -->
							<div class="tab-pane fade" id="v-pills-disabled" role="tabpanel" aria-labelledby="v-pills-disabled-tab" tabindex="0">
								<section class="pricing-and-availability">
									<ul class="policies">
										<label class="_14i3z6h">Policies</label>
										<li>
											<div class="d-flex justify-content-between align-items-start">
												<div class="d-grid">
													<b>Cancellation policy</b>
													<small>Flexible: Full refund 1 day prior to arrival</small>
												</div>
												<a href="#" data-bs-toggle="modal" data-bs-target="#guests-payment" class="_1e5q4qoz" role="button"
													>Show</a
												>
											</div>
										</li>
										<hr />
										<li>
											<div class="d-flex justify-content-between align-items-start">
												<div class="d-grid">
													<b>Instant Book</b>
													<small
														>Instant Book on - Guests who meet all your requirements can book instantly. Others will need
														to send a reservation request</small
													>
												</div>
												<a href="#" class="_1e5q4qoz">Edit</a>
											</div>
										</li>
										<hr />
										<li>
											<div class="d-flex justify-content-between align-items-start">
												<div class="d-grid">
													<b>Check-in window</b>
													<small>After 3:00 PM</small>
												</div>
												<a href="#" class="_1e5q4qoz">Edit</a>
											</div>
										</li>
										<hr />
										<li>
											<div class="d-flex justify-content-between align-items-start">
												<div class="d-grid">
													<b>Checkout time</b>
													<small>Select a time</small>
												</div>
												<a href="#" class="_1e5q4qoz">Edit</a>
											</div>
										</li>
										<hr />
									</ul>
									<ul class="house-rules">
										<label class="_14i3z6h">Discounts</label>
										<li>
											<div class="d-flex my-4 justify-content-between align-items-start">
												<div class="d-grid">
													<b>Weekly discount</b>
													<small>Not set</small>
												</div>
												<a href="#" class="_1e5q4qoz">Edit</a>
											</div>
										</li>
										<hr />
										<li>
											<div class="d-flex my-4 justify-content-between align-items-start">
												<div class="d-grid">
													<b>Monthly discount</b>
													<small>Not set</small>
												</div>
												<a href="#" class="_1e5q4qoz">Edit</a>
											</div>
										</li>
										<hr />
										<li>
											<div class="d-flex my-4 justify-content-between align-items-start">
												<div class="d-grid">
													<b>Custom length-of-stay discounts</b>
													<small>Not set</small>
												</div>
												<a href="#" class="_1e5q4qoz">Edit</a>
											</div>
										</li>
										<hr />
										<li>
											<div class="d-flex my-4 justify-content-between align-items-start">
												<div class="d-grid">
													<b>Early bird discounts</b>
													<small>Not set</small>
												</div>
												<a href="#" class="_1e5q4qoz">Edit</a>
											</div>
										</li>
										<hr />
										<li>
											<div class="d-flex my-4 justify-content-between align-items-start">
												<div class="d-grid">
													<b>Last-minute discounts</b>
													<small>Not set</small>
												</div>
												<a href="#" class="_1e5q4qoz">Edit</a>
											</div>
										</li>
										<hr />
									</ul>
									<ul class="guest-requirements">
										<label class="_14i3z6h">Guest requirements</label>
										<li>
											<div class="d-flex my-4 justify-content-between align-items-start">
												<div class="d-grid">
													<small
														>All guests are required to follow Airbnb standard requirements, which includes confirmed
														phone number, email address, payment information, and agreement to your house rules.
														<a href="" style="color: #000; text-decoration: underline; font-size: 15px"
															>Learn more</a
														></small
													>
												</div>
											</div>
										</li>
										<hr />
										<li>
											<div class="d-flex my-4 justify-content-between align-items-start">
												<div class="d-grid">
													<b>Profile photo required</b>
													<small
														>If you turn on this requirement, you’ll be able to see guests’ profile photos after a booking
														is confirmed, but not before.
														<a href="" style="color: #000; text-decoration: underline; font-size: 15px"
															>Learn more</a
														></small
													>
												</div>
												<div class="form-check form-switch">
													<input class="form-check-input" type="checkbox" role="switch" id="" />
												</div>
											</div>
										</li>
										<hr />
										<li>
											<div class="d-flex my-4 justify-content-between align-items-start">
												<div class="d-grid">
													<a href="#" class="_1e5q4qoz">Give feedbacks</a>
												</div>
											</div>
										</li>
										<hr />
									</ul>
									<ul class="laws-and-regulation">
										<label class="_14i3z6h">Laws and regulations</label>
										<li>
											<div class="d-flex my-4 justify-content-between align-items-center">
												<div class="d-grid">
													<b>Local laws</b>
												</div>
												<a href="#" class="_1e5q4qoz">View</a>
											</div>
										</li>
										<hr />
										<li>
											<div class="d-flex my-4 justify-content-between align-items-start">
												<div class="d-grid">
													<b>Primary use of listing</b>
													<small>The space is primarily set up for guests</small>
												</div>
												<a href="#" class="_1e5q4qoz">Edit</a>
											</div>
										</li>
										<hr />
									</ul>
									<div style="margin-top: 3rem">
										<a href="#" style="color: #000; text-decoration: underline; font-size: 15px">Give feedback</a>
									</div>
								</section>
							</div>
							<!-- end of each tab pane -->
							<!-- each tab pane -->
							<div class="tab-pane fade" id="v-pills-messages" role="tabpanel" aria-labelledby="v-pills-messages-tab" tabindex="0">
								<section class="info-for-guest">
									<ul class="pre-booking">
										<label class="_14i3z6h">Pre-booking details</label>
										<li>
											<div class="d-flex justify-content-between align-items-start">
												<div class="d-grid">
													<b>Check-in window</b>
													<small>After 3:00 PM</small>
												</div>
												<a href="#" class="_1e5q4qoz" data-bs-toggle="modal" data-bs-target="#check-in-window">Edit</a>
											</div>
										</li>
										<hr />
										<li>
											<div class="d-flex justify-content-between align-items-start">
												<div class="d-grid">
													<b>Checkout time</b>
													<small>Select a time</small>
												</div>
												<a href="#" class="_1e5q4qoz" data-bs-toggle="modal" data-bs-target="#check-out-time">Edit</a>
											</div>
										</li>
										<hr />
										<li>
											<div class="d-flex justify-content-between align-items-center">
												<div class="d-grid">
													<b>Guidebooks</b>
												</div>
												<a href="#" class="_1e5q4qoz">Edit</a>
											</div>
										</li>
										<hr />
										<li>
											<div class="d-flex justify-content-between align-items-center">
												<div class="d-grid">
													<b>Interaction with guests</b>
												</div>
												<a href="#" class="_1e5q4qoz" data-bs-toggle="modal" data-bs-target="#interaction-with-guests"
													>Edit</a
												>
											</div>
										</li>
										<hr />
									</ul>
									<ul class="post-booking">
										<label class="_14i3z6h">Post-booking details</label>
										<li>
											<div class="d-flex my-4 justify-content-between align-items-start">
												<div class="d-grid">
													<b>Address</b>
													<small>Abuja Zone, Ifako Agege 101232, Agege, Nigeria</small>
												</div>
												<a href="#" class="_1e5q4qoz" role="button" data-bs-toggle="modal" data-bs-target="#address">Edit</a>
											</div>
										</li>
										<hr />
										<li>
											<div class="d-flex my-4 justify-content-between align-items-start">
												<div class="d-grid">
													<b>Directions</b>
													<small>Not set</small>
												</div>
												<a href="#" class="_1e5q4qoz" role="button" data-bs-toggle="modal" data-bs-target="#directions"
													>Edit</a
												>
											</div>
										</li>
										<hr />
										<li>
											<div class="d-flex my-4 justify-content-between align-items-start">
												<div class="d-grid">
													<b>Guest manual</b>
													<small>Not set</small>
												</div>
												<a href="#" class="_1e5q4qoz" role="button" data-bs-toggle="modal" data-bs-target="#guest-manual"
													>Edit</a
												>
											</div>
										</li>
										<hr />
									</ul>
									<ul class="arrival-details">
										<label class="_14i3z6h">Arrival details</label>
										<li>
											<div class="d-flex my-4 justify-content-between align-items-start">
												<div class="d-grid">
													<b>Check-in instructions</b>
													<small>Not set</small>
												</div>
												<a
													href="#"
													class="_1e5q4qoz"
													role="button"
													data-bs-toggle="modal"
													data-bs-target="#check-in-instructions"
													>Edit</a
												>
											</div>
										</li>
										<hr />
										<li>
											<div class="d-flex my-4 justify-content-between align-items-center">
												<div class="d-grid">
													<b>Wi-fi details</b>
												</div>
												<a href="#" class="_1e5q4qoz" role="button" data-bs-toggle="modal" data-bs-target="#wifi-details"
													>Edit</a
												>
											</div>
										</li>
										<hr />
										<li>
											<div class="d-flex my-4 justify-content-between align-items-center">
												<div class="d-grid">
													<a href="#" class="_1e5q4qoz">Give feedbacks</a>
												</div>
											</div>
										</li>
										<hr />
									</ul>
								</section>
							</div>
							<!-- end of each tab pane -->
							<!-- each tab pane -->
							<div class="tab-pane fade" id="v-pills-settings" role="tabpanel" aria-labelledby="v-pills-settings-tab" tabindex="0">
								<section class="co-host">
									<ul>
										<li>
											<div class="d-flex my-4 justify-content-between align-items-start">
												<div class="d-grid">
													<label class="_14i3z6h mb-0">Listing admin</label>
													<div class="user-info">
														<div class="image" role="img">
															<img src="../../assets/images/user_pic-225x225.png" alt="" class="img-fluid" />
														</div>
														<div class="user-name">
															<b>User Name</b>
															<small> Listing admin </small>
														</div>
													</div>
												</div>
											</div>
										</li>
										<hr />
										<li>
											<div class="d-flex my-5 justify-content-between align-items-start">
												<div class="d-grid">
													<label class="_14i3z6h mb-0"
														><b
															>Listing Co-Host
															<span
																style="
																	background-color: #000;
																	color: #fff;
																	padding: 5px 8px;
																	border-radius: 6px;
																	font-size: 12.5px;
																"
																><small>UPDATED</small></span
															></b
														></label
													>
													<small style="margin-top: 5px; color: #212529"
														>Add up to 3 Co-Hosts who can help you manage listing details, reservations and Resolution
														Center requests using their own account. The primary host will be shown as the host on a
														reservation.
														<a href="" style="font-size: 15px; color: #000; text-decoration: underline"
															>Learn more</a
														></small
													>
												</div>
											</div>
											<a
												href="#"
												style="
													background-color: #000;
													color: #fff;
													padding: 13.5px 2rem;
													font-weight: 600;
													border-radius: 6px;
													font-size: 16px;
													margin-top: 1rem;
												"
												class="button"
												role="button"
												data-bs-toggle="modal"
												data-bs-target="#co-host"
												>Add a Co-host</a
											>
										</li>
										<br />
										<li class="bordered">
											<div class="d-flex justify-content-between align-items-start">
												<div class="d-grid">
													<label class="_14i3z6h mb-0"
														><b
															>Activity
															<span
																style="
																	background-color: #000;
																	color: #fff;
																	padding: 5px 8px;
																	border-radius: 6px;
																	font-size: 12.5px;
																"
																><small>UPDATED</small></span
															></b
														></label
													>
													<small style="margin: 5px 0; color: #212529"
														>Add up to 3 Co-Hosts who can help you manage listing details, reservations and Resolution
														Center requests using their own account. The primary host will be shown as the host on a
														reservation.
													</small>
													<small
														><a href="" style="font-size: 15px; color: #000; text-decoration: underline"
															>See listing activity</a
														></small
													>
												</div>
											</div>
										</li>
										<br />
										<br />
										<a href="" style="text-decoration: underline; font-size: 15px; color: #000">Give feedback</a>
									</ul>
								</section>
							</div>
							<!-- end of each tab pane -->
						</div>
						<!-- end of tab content -->
					</div>
				</div>
			</main>
			<!-- end of main -->

			<!--  ===================== PILES OF MODALS ====================== -->
			<!--  todo 🚗🚗🚗 LISTING DETAILS 🚗🚗🚗 -->
			<!-- === MODALS FOR LISTING BASICS ===-->
			<!-- ==== END OF MODALS FOR LISTING BASICS ==== -->

			<!-- ==== MODALS FOR AMENITIES ===== -->
			<!--===== END OF MODALS FOR AMENITIES ===== -->

			<!-- ===== MODALS FOR LOCATION ===== -->
			<!-- ===== END OF MODALS FOR LOCATION  ===== -->

			<!-- ==== MODALS FOR PROPERTY ===== -->
			<!-- ==== END OF MODALS FOR PROPERTY ===== -->

			<!-- ==== MODALS FOR ACCESSIBILITY ===== -->
			<!-- ==== END OF MODALS FOR ACCESSIBILITY ===== -->

			<!-- ==== MODALS FOR GUEST SAFETY ===== -->
			<!-- ==== END OF MODALS FOR GUEST SAFETY ===== -->

			<!-- todo 🚗🚗🚗  END OF LISTING DETAILS 🚗🚗🚗 -->

			<!--  ? 🚗🚗🚗 PRICING AND AVAILABILITY 🚗🚗🚗 -->

			<!-- modal for nightly pricing -->
			<div class="modal fade" id="smart-pricing" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
				<div class="modal-dialog modal-dialog-centered">
					<div class="modal-content">
						<div class="modal-header">
							<h5 class="modal-title"><b>Smart pricing</b></h5>
							<button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
						</div>
						<form action="">
							<div class="modal-body">
								<div class="my-3">
									<div class="d-flex justify-content-between align-items-start">
										<div class="d-grid">
											<b>Smart pricing</b>
											<small
												>Automatically adjust your price based on demand. Your price stays within the range you set, and you
												can change it at any time.
												<a href="" style="text-decoration: underline; color: #000; font-size: 15px">Learn more</a></small
											>
										</div>
										<div class="form-check form-switch">
											<input class="form-check-input" type="checkbox" role="switch" id="" />
										</div>
									</div>
								</div>
								<hr />
								<div class="my-3">
									<label for="" class="form-label">Base price</label>
									<input type="number" class="form-control for-value-input text" id="" value="27" />
									<small
										><a href="" style="text-decoration: underline; color: #000; font-size: 15px"
											>Tip: $23. Set your Base price to this amount.</a
										></small
									>
								</div>
								<div
									class="bordered d-flex align-items-start"
									style="padding: 1rem; border-radius: 12px; border: 1px solid #d7d7d7; margin-top: 4rem">
									<span
										><svg
											viewBox="0 0 48 48"
											xmlns="http://www.w3.org/2000/svg"
											aria-hidden="true"
											role="presentation"
											focusable="false"
											style="display: block; height: 48px; width: 48px; fill: rgb(227, 28, 95); stroke: currentcolor">
											<g stroke="none">
												<path
													d="M24 4c-7.076 0-12.831 5.653-12.997 12.654l-.003.31.003.31c.101 4.2 2.574 8.341 7.666 12.447l.351.279h9.96l.35-.277c5.081-4.097 7.554-8.225 7.666-12.396l.004-.298-.002-.286C36.86 9.673 31.084 4 24 4z"
													fill-opacity=".2"></path>
												<path
													d="M24 0c9.157 0 16.642 7.247 16.988 16.353l.009.322L41 17c0 5.781-3.228 11.178-9.589 16.177l-.411.319V44a2 2 0 0 1-1.85 1.995L29 46h-4v2h-2v-2h-4a2 2 0 0 1-1.995-1.85L17 44V33.497l-.01-.008c-6.351-4.875-9.705-10.131-9.973-15.77l-.013-.36L7 17C7 7.611 14.611 0 24 0zm5 40H19v4h10v-4zm0-6H19v4h10v-4zM24 2C15.82 2 9.17 8.547 9.003 16.675L9 16.988l.004.334c.122 5.082 3.156 9.937 9.198 14.576l.135.102h1.662L20 17a4 4 0 0 1 3.8-3.995L24 13a4 4 0 0 1 3.995 3.8L28 17l-.001 15h1.664l.533-.411c5.642-4.439 8.543-9.074 8.787-13.91l.013-.338.004-.331-.003-.306C38.84 8.545 32.174 2 24 2zm0 13a2 2 0 0 0-1.995 1.85L22 17l-.001 15h4L26 17a2 2 0 0 0-1.697-1.977l-.154-.018L24 15z"></path>
											</g></svg
									></span>
									<div class="ms-3">
										<b>Activate Smart Pricing to increase your total income</b><br />
										<small>We’ll help you set competitive prices that get you booked, maximizing your long-term earnings.</small>
										<a href="" style="text-decoration: underline; color: #000; font-size: 15px">Turn on Smart Pricing</a>
									</div>
								</div>
							</div>
							<div class="modal-footer">
								<button type="button" class="cancel" data-bs-dismiss="modal">Close</button>
								<button type="button" class="save">Save</button>
							</div>
						</form>
					</div>
				</div>
			</div>
			<!-- modal for smart nightly pricing -->

			<!-- modal for weekly pricing -->
			<div class="modal fade" id="weekly-discount" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
				<div class="modal-dialog modal-dialog-centered">
					<div class="modal-content">
						<div class="modal-header">
							<h5 class="modal-title"><b>Weekly discount</b></h5>
							<button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
						</div>
						<form action="">
							<div class="modal-body">
								<div class="">
									<input type="number" class="form-control for-value-input text" id="" value="" />
									<small
										><a href="" style="text-decoration: underline; color: #000; font-size: 15px"
											>Tip: 21%. Set your weekly discount to this percentage.</a
										></small
									>
									<div class="small mt-2" style="color: #71738c">Your average price with a 0% discount is $189 per week.</div>
								</div>
								<br />
								<hr />
								<br />
								<div class="">
									<b>Custom weekly prices</b><br />
									<small style="color: #71738c"
										>Custom prices don’t just apply to trips that match these exact date ranges. When a guest books a reservation
										that’s 7-28 nights long, we’ll apply your custom weekly price on a prorated basis for any nights that overlap.
										Keep in mind, if you’ve also set a weekly long-term price, we’ll apply it for the additional nights of the
										reservation.</small
									>
									<div class="mt-2">
										<a href="" style="text-decoration: underline; color: #000; font-size: 15px">Add</a>
									</div>
								</div>
							</div>
							<div class="modal-footer">
								<button type="button" class="cancel" data-bs-dismiss="modal">Close</button>
								<button type="button" class="save">Save</button>
							</div>
						</form>
					</div>
				</div>
			</div>
			<!-- modal for weekly pricing-->

			<!-- modal for monthly pricing -->
			<div class="modal fade" id="monthly-discount" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
				<div class="modal-dialog modal-dialog-centered">
					<div class="modal-content">
						<div class="modal-header">
							<h5 class="modal-title"><b>Monthly pricing</b></h5>
							<button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
						</div>
						<form action="">
							<div class="modal-body">
								<div class="my-3">
									<small
										>Monthly discounts apply to reservations that are 28 days or longer. If you offer multiple length-of-stay
										discounts, we'll apply the discount for the longest trip length.
									</small>
									<input type="number" class="form-control for-value-input text" id="" value="27" />
									<small
										><a href="" style="text-decoration: underline; color: #000; font-size: 15px"
											>Tip: 49%. Set your monthly discount to this percentage.</a
										></small
									>
									<div class="small" style="color: #71738c">Your average price with a 0% discount is $821 per month.</div>
								</div>
								<br />
								<hr />
								<br />
								<div
									class="bordered d-flex align-items-center"
									style="padding: 1rem; border-radius: 12px; border: 1px solid #d7d7d7; margin-top: 0.5rem">
									<span
										><svg
											viewBox="0 0 48 48"
											xmlns="http://www.w3.org/2000/svg"
											aria-hidden="true"
											role="presentation"
											focusable="false"
											style="display: block; height: 48px; width: 48px; fill: rgb(227, 28, 95); stroke: currentcolor">
											<g stroke="none">
												<path
													d="M24 4c-7.076 0-12.831 5.653-12.997 12.654l-.003.31.003.31c.101 4.2 2.574 8.341 7.666 12.447l.351.279h9.96l.35-.277c5.081-4.097 7.554-8.225 7.666-12.396l.004-.298-.002-.286C36.86 9.673 31.084 4 24 4z"
													fill-opacity=".2"></path>
												<path
													d="M24 0c9.157 0 16.642 7.247 16.988 16.353l.009.322L41 17c0 5.781-3.228 11.178-9.589 16.177l-.411.319V44a2 2 0 0 1-1.85 1.995L29 46h-4v2h-2v-2h-4a2 2 0 0 1-1.995-1.85L17 44V33.497l-.01-.008c-6.351-4.875-9.705-10.131-9.973-15.77l-.013-.36L7 17C7 7.611 14.611 0 24 0zm5 40H19v4h10v-4zm0-6H19v4h10v-4zM24 2C15.82 2 9.17 8.547 9.003 16.675L9 16.988l.004.334c.122 5.082 3.156 9.937 9.198 14.576l.135.102h1.662L20 17a4 4 0 0 1 3.8-3.995L24 13a4 4 0 0 1 3.995 3.8L28 17l-.001 15h1.664l.533-.411c5.642-4.439 8.543-9.074 8.787-13.91l.013-.338.004-.331-.003-.306C38.84 8.545 32.174 2 24 2zm0 13a2 2 0 0 0-1.995 1.85L22 17l-.001 15h4L26 17a2 2 0 0 0-1.697-1.977l-.154-.018L24 15z"></path>
											</g></svg
									></span>
									<div class="ms-3">
										<small style="color: #71738c"
											>Most monthly discounts in Agege are for at least 49%. Setting a more competitive discount can grab
											guests' attention on the search results page.</small
										>
									</div>
								</div>
								<br />
								<hr />
								<br />
								<div class="">
									<b>Custom monthly prices</b><br />
									<small style="color: #71738c"
										>Custom prices don’t just apply to trips that match these exact date ranges. When a guest books a reservation
										that’s longer than 28 nights, we’ll apply your custom monthly price on a prorated basis for any nights that
										overlap. Keep in mind, if you’ve also set a monthly long-term price, we’ll apply it for the additional nights
										of the reservation.</small
									>
									<div class="mt-2">
										<a href="" style="text-decoration: underline; color: #000; font-size: 15px">Add</a>
									</div>
								</div>
							</div>
							<div class="modal-footer">
								<button type="button" class="cancel" data-bs-dismiss="modal">Close</button>
								<button type="button" class="save">Save</button>
							</div>
						</form>
					</div>
				</div>
			</div>
			<!-- modal for smart nightly pricing -->

			<!-- ==== MODALS FOR AVAILABILITY WINDOW ===== -->
			<div class="modal fade" id="preparation-time" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
				<div class="modal-dialog modal-dialog-centered modal-dialog-scrollable">
					<div class="modal-content">
						<div class="modal-header">
							<h5 class="modal-title" id="exampleModalLabel">Preparation Time</h5>
							<button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
						</div>
						<form action="">
							<div class="modal-body">
								<br />
								<div class="form-input my-4">
									<b>Availability window</b>
									<select class="form-select text" aria-label="Default select example">
										<option value="">None</option>
										<option value="">Block 1 night before and after reservation</option>
										<option value="">Block 2 nights before and after reservation</option>
									</select>
								</div>
							</div>
							<div class="modal-footer">
								<button type="button" class="cancel" data-bs-dismiss="modal">Cancel</button>
								<button type="button" class="save">Save</button>
							</div>
						</form>
					</div>
				</div>
			</div>
			<!-- ==== END OF MODALS FOR AVAILABILITY WINDOW ===== -->
			<!-- modal for preparation time  end-->

			<!-- ==== MODALS FOR listing currency ===== -->
			<div class="modal fade" id="listing-currency" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
				<div class="modal-dialog modal-dialog-centered">
					<div class="modal-content">
						<div class="modal-header">
							<h5 class="modal-title" id="exampleModalLabel">Listing currency</h5>
							<button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
						</div>
						<form action="">
							<div class="modal-body">
								<div class="form-input mb-4">
									<select class="form-select text" aria-label="Default select example">
										<option selected>USD</option>
										<option value="1">One</option>
										<option value="2">Two</option>
										<option value="3">Three</option>
									</select>
									<small
										>This is the currency you’ll use to set your prices and discounts. Guests are shown prices in their own
										currency.</small
									>
								</div>
							</div>
							<div class="modal-footer">
								<button type="button" class="cancel" data-bs-dismiss="modal">Close</button>
								<button type="button" class="save">Save</button>
							</div>
						</form>
					</div>
				</div>
			</div>
			<!-- ==== END OF MODALS FOR listing currency ===== -->

			<!-- ==== MODALS FOR custom length of discount ===== -->
			<div class="modal fade" id="early-bird-discounts" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
				<div class="modal-dialog modal-dialog-centered">
					<div class="modal-content">
						<div class="modal-header">
							<h5 class="modal-title" id="exampleModalLabel">Early bird discounts</h5>
							<button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
						</div>
						<form action="">
							<div class="modal-body">
								<span class="my-3">Discount ends</span>
								<div class="form-floating">
									<input type="email" class="form-control text" id="floatingInput" placeholder="%" />
									<label for="floatingInput">Months before arrival</label>
								</div>
								<div class="form-floating">
									<input type="email" class="form-control text" id="floatingInput" placeholder="%" />
									<label for="floatingInput">Discount</label>
								</div>
							</div>
							<div class="modal-footer">
								<button type="button" class="cancel" data-bs-dismiss="modal">Close</button>
								<button type="button" class="save">Save</button>
							</div>
						</form>
					</div>
				</div>
			</div>
			<!-- ==== END OF MODALS FOR custom length of discount ===== -->

			<!-- ==== MODALS FOR last-minute-discounts ===== -->
			<div class="modal fade" id="last-minute-discounts" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
				<div class="modal-dialog modal-dialog-centered">
					<div class="modal-content">
						<div class="modal-header">
							<h5 class="modal-title" id="exampleModalLabel">Last-minute discounts</h5>
							<button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
						</div>
						<form action="">
							<div class="modal-body">
								<span class="my-3">Discount ends</span>
								<div class="form-floating">
									<input type="email" class="form-control text" id="floatingInput" placeholder="%" />
									<label for="floatingInput">Months before arrival</label>
								</div>
								<div class="form-floating">
									<input type="email" class="form-control text" id="floatingInput" placeholder="%" />
									<label for="floatingInput">Discount</label>
								</div>
								<a href="#" disbabled style="text-decoration: underline; color: #a09e9e; margin: 0 0 4px; display: block">Remove</a>
								<br />
								<a href="#" style="font-size: 1rem; text-decoration: underline; color: #000; margin: 4px 0; display: block">Add</a>
								<div class="bordered">
									<b>About last-minute discounts</b><br />
									<span style="font-size: 15px; color: #9d9d9d; margin-bottom: 10px">
										Last-minute discounts must be less than 28 days. You can add multiple last-minute discounts. These discounts
										won’t be shown to guests.</span
									>
									<span style="font-size: 15px; color: #9d9d9d">
										When a last-minute discount only applies to some nights within a reservation, it’ll be applied to those nights
										but not the others.</span
									>
								</div>
							</div>
							<div class="modal-footer">
								<button type="button" class="cancel" data-bs-dismiss="modal">Close</button>
								<button type="button" class="save">Save</button>
							</div>
						</form>
					</div>
				</div>
			</div>
			<!-- ==== END OF MODALS FOR last-minute-discounts ===== -->

			<!-- ==== MODALS FOR custom length of discount ===== -->
			<div class="modal fade" id="custom-length-of-stay-discounts" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
				<div class="modal-dialog modal-dialog-centered">
					<div class="modal-content">
						<div class="modal-header">
							<h5 class="modal-title" id="exampleModalLabel">Custom length-of-stay discounts</h5>
							<button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
						</div>
						<form action="">
							<div class="modal-body">
								<div class="form-input">
									<select class="form-select text" aria-label="Default select example">
										<option selected>Length of stay</option>
										<option value="">Weekly (1 week)</option>
										<option value="">Monthly (4 weeks)</option>
										<option value="">8 weeks</option>
										<option value="">12 weeks</option>
									</select>
								</div>
								<div class="form-floating">
									<input type="email" class="form-control text" id="floatingInput" placeholder="%" />
									<label for="floatingInput">Discount</label>
								</div>
								<a href="#" disbabled style="text-decoration: underline; color: #a09e9e; margin: 0 0 4px; display: block">Remove</a>
								<br />
								<a href="#" style="font-size: 1rem; text-decoration: underline; color: #000; margin: 4px 0; display: block"
									>Add another length-of-stay</a
								>
							</div>
							<div class="modal-footer">
								<button type="button" class="cancel" data-bs-dismiss="modal">Close</button>
								<button type="button" class="save">Save</button>
							</div>
						</form>
					</div>
				</div>
			</div>
			<!-- ==== END OF MODALS FOR custom length of discount ===== -->

			<!-- ==== MODALS FOR AVAILABILITY WINDOW ===== -->
			<div class="modal fade" id="availability-window" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
				<div class="modal-dialog modal-dialog-centered modal-dialog-scrollable">
					<div class="modal-content">
						<div class="modal-header">
							<h5 class="modal-title" id="exampleModalLabel">Availability window</h5>
							<button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
						</div>
						<form action="">
							<div class="modal-body">
								<div class="form-input my-4">
									<b>Availability window</b>
									<select class="form-select text" aria-label="Default select example">
										<option selected>12 months advance</option>
										<option value="">All future dates</option>
										<option value="">12 months in advance</option>
										<option value="">9 months in advance</option>
										<option value="">6 months in advance</option>
										<option value="">3 months in advance</option>
										<option value="">Dates unavailable by default</option>
									</select>
								</div>
							</div>
							<div class="modal-footer">
								<button type="button" class="cancel" data-bs-dismiss="modal">Cancel</button>
								<button type="button" class="save">Save</button>
							</div>
						</form>
					</div>
				</div>
			</div>
			<!-- ==== END OF MODALS FOR AVAILABILITY WINDOW ===== -->

			<!-- ==== MODALS FOR restricted check-in ===== -->
			<div class="modal fade" id="restricted-check-in" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
				<div class="modal-dialog modal-dialog-centered modal-lg">
					<div class="modal-content">
						<div class="modal-header">
							<h5 class="modal-title" id="exampleModalLabel">Restricted check-in days</h5>
							<button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
						</div>
						<form action="">
							<div class="modal-body">
								<h5 class="fw-bolder">Restricted check-in days</h5>
								<small>Guests won't be able to book your place if their stay starts on these days.</small>
								<div class="mt-3 has-form-checks">
									<div class="form-check">
										<input class="form-check-input" type="checkbox" value="" id="flexCheckDefault" />
										<label class="form-check-label" for="flexCheckDefault"> Sunday </label>
									</div>
									<div class="form-check">
										<input class="form-check-input" type="checkbox" value="" id="flexCheckDefault" />
										<label class="form-check-label" for="flexCheckDefault"> Monday </label>
									</div>
									<div class="form-check">
										<input class="form-check-input" type="checkbox" value="" id="flexCheckDefault" />
										<label class="form-check-label" for="flexCheckDefault"> Tuesday </label>
									</div>
									<div class="form-check">
										<input class="form-check-input" type="checkbox" value="" id="flexCheckDefault" />
										<label class="form-check-label" for="flexCheckDefault"> Wednesday </label>
									</div>
									<div class="form-check">
										<input class="form-check-input" type="checkbox" value="" id="flexCheckDefault" />
										<label class="form-check-label" for="flexCheckDefault"> Thursday </label>
									</div>
									<div class="form-check">
										<input class="form-check-input" type="checkbox" value="" id="flexCheckDefault" />
										<label class="form-check-label" for="flexCheckDefault"> Friday </label>
									</div>
									<div class="form-check">
										<input class="form-check-input" type="checkbox" value="" id="flexCheckDefault" />
										<label class="form-check-label" for="flexCheckDefault"> Saturday </label>
									</div>
								</div>
							</div>
							<div class="modal-footer">
								<button type="button" class="cancel" data-bs-dismiss="modal">Cancel</button>
								<button type="button" class="save">Save</button>
							</div>
						</form>
					</div>
				</div>
			</div>
			<!-- ==== END OF MODALS FOR restricted check-in ===== -->

			<!-- ==== END OF MODALS FOR  calendar availability ===== -->
			<div class="modal fade" id="advance-notice" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
				<div class="modal-dialog modal-dialog-centered modal-dialog-scrollable">
					<div class="modal-content">
						<div class="modal-header">
							<h5 class="modal-title" id="exampleModalLabel">Advance notice</h5>
							<button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
						</div>
						<form action="">
							<div class="modal-body">
								<br />
								<div class="form-input my-4">
									<b>Advance notice</b>
									<select class="form-select text" aria-label="Default select example">
										<option selected>Same day (customizable cutoff hour)</option>
										<option value="">At least 1 day's notice</option>
										<option value="">At least 2 day's notice</option>
										<option value="">At least 3 day's notice</option>
										<option value="">At least 7 day's notice</option>
									</select>
								</div>
								<div class="form-input mb-4">
									<h6>Guests can book same day until:</h6>
									<select class="form-select text" aria-label="Default select example">
										<option selected>12:00 AM</option>
										<option value="">1:00 AM</option>
										<option value="">2:00 AM</option>
										<option value="">3:00 AM</option>
										<option value="">4:00 AM</option>
										<option value="">5:00 AM</option>
										<option value="">6:00 AM</option>
										<option value="">7:00 AM</option>
										<option value="">8:00 AM</option>
										<option value="">9:00 AM</option>
										<option value="">10:00 AM</option>
										<option value="">11:00 AM</option>
										<option value="">12:00 PM</option>
										<option value="">1:00 PM</option>
										<option value="">1:00 PM</option>
										<option value="">2:00 PM</option>
										<option value="">3:00 PM</option>
										<option value="">4:00 PM</option>
										<option value="">5:00 PM</option>
										<option value="">6:00 PM</option>
									</select>
								</div>
							</div>
							<div class="modal-footer">
								<button type="button" class="cancel" data-bs-dismiss="modal">Cancel</button>
								<button type="button" class="save">Save</button>
							</div>
						</form>
					</div>
				</div>
			</div>
			<!-- ==== MODALS FOR availability ====-->

			<!-- ==== MODALS FOR SHARING SAFETY ===== -->
			<div class="modal fade" id="sharing-settings" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
				<div class="modal-dialog modal-dialog-centered modal-lg modal-dialog-scrollable">
					<div class="modal-content">
						<div class="modal-header">
							<h5 class="modal-title" id="exampleModalLabel">Sharing settings</h5>
							<button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
						</div>
						<div class="modal-body">
							<form action="">
								<h4 class="fw-bolder mt-3">Sharing settings</h4>
								<small
									>Find out more about the listings your potential guests are checking out. If you share some details about your
									listing and bookings with other Hosts, you can see the listings that guests end up booking after checking out your
									place.</small
								>
								<div class="form-input my-4">
									<div class="form-check">
										<input class="form-check-input" type="radio" name="flexRadioDefault" id="flexRadioDefault1" />
										<label class="form-check-label" for="flexRadioDefault1">
											<span>Listing and booking details</span>
											<br />
											<small
												>You’ll see the listing titles and photos, and the booking details (booked prices, dates, and number
												of guests). Other hosts will get this same information from you.</small
											>
										</label>
									</div>
								</div>
								<div class="form-input my-4">
									<div class="form-check">
										<input class="form-check-input" type="radio" name="flexRadioDefault" id="flexRadioDefault1" />
										<label class="form-check-label" for="flexRadioDefault1">
											<span
												>Booking details <small style="color: #000; background-color: #ebebeb; font-size: 12px"></small>
											</span>
											<br />
											<small
												>You’ll see the booking details (booked prices, dates, and number of guests), but not the listing
												titles and photos. Other Hosts will get either your listing details or your booking details, but not
												both at the same time.</small
											>
										</label>
									</div>
								</div>
								<div class="form-input my-4">
									<div class="form-check">
										<input class="form-check-input" type="radio" name="flexRadioDefault" id="flexRadioDefault1" />
										<label class="form-check-label" for="flexRadioDefault1">
											<span>None</span> <br />
											<small>You won’t get or share any information.</small>
										</label>
									</div>
								</div>
								<div
									class="bordered d-flex align-items-start"
									style="padding: 1rem; border-radius: 12px; border: 1px solid #d7d7d7; margin-top: 4rem">
									<span
										><svg
											viewBox="0 0 48 48"
											xmlns="http://www.w3.org/2000/svg"
											aria-hidden="true"
											role="presentation"
											focusable="false"
											style="display: block; height: 48px; width: 48px; fill: rgb(227, 28, 95); stroke: currentcolor">
											<g stroke="none">
												<path
													d="M24 4c-7.076 0-12.831 5.653-12.997 12.654l-.003.31.003.31c.101 4.2 2.574 8.341 7.666 12.447l.351.279h9.96l.35-.277c5.081-4.097 7.554-8.225 7.666-12.396l.004-.298-.002-.286C36.86 9.673 31.084 4 24 4z"
													fill-opacity=".2"></path>
												<path
													d="M24 0c9.157 0 16.642 7.247 16.988 16.353l.009.322L41 17c0 5.781-3.228 11.178-9.589 16.177l-.411.319V44a2 2 0 0 1-1.85 1.995L29 46h-4v2h-2v-2h-4a2 2 0 0 1-1.995-1.85L17 44V33.497l-.01-.008c-6.351-4.875-9.705-10.131-9.973-15.77l-.013-.36L7 17C7 7.611 14.611 0 24 0zm5 40H19v4h10v-4zm0-6H19v4h10v-4zM24 2C15.82 2 9.17 8.547 9.003 16.675L9 16.988l.004.334c.122 5.082 3.156 9.937 9.198 14.576l.135.102h1.662L20 17a4 4 0 0 1 3.8-3.995L24 13a4 4 0 0 1 3.995 3.8L28 17l-.001 15h1.664l.533-.411c5.642-4.439 8.543-9.074 8.787-13.91l.013-.338.004-.331-.003-.306C38.84 8.545 32.174 2 24 2zm0 13a2 2 0 0 0-1.995 1.85L22 17l-.001 15h4L26 17a2 2 0 0 0-1.697-1.977l-.154-.018L24 15z"></path>
											</g></svg
									></span>
									<div>
										<b>What do guests compare </b><br />
										<small
											>Guests consider more than just price when they’re deciding where to stay. Learn more about what your
											potential guests want by checking out the listings that they end up booking.</small
										>
									</div>
								</div>
								<div class="modal-footer border-0">
									<button type="button" class="cancel" data-bs-dismiss="modal">Cancel</button>
									<button type="button" class="save">Save</button>
								</div>
							</form>
						</div>
					</div>
				</div>
			</div>
			<!-- ====== END OF MODALS FOR SHARING SAFETY -->

			<!-- inner modal for preview guest pay start -->
			<div class="modal fade" id="guests-payment" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
				<div class="modal-dialog modal-dialog-scrollable modal-dialog-centered modal-lg">
					<div class="modal-content">
						<div class="modal-header">
							<button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
						</div>
						<div class="modal-body">
							<h2 style="font-weight: 600; margin-bottom: 5px">Preview what guests pay</h2>
							<span style="color: #898989; line-height: 1.2; display: flex"
								>Select any combination of nights, guests, and pets, and we’ll show you the final price.</span
							>
							<div class="list-of-dropdowns">
								<div class="each-dropdown">
									<div class="dropdown">
										<button class="dropdown-toggle has-border" type="button" data-bs-toggle="dropdown" aria-expanded="false">
											<small>1 night</small>
											<small><em class="bi bi-chevron-down"></em></small>
										</button>
										<ul class="dropdown-menu">
											<li><a class="dropdown-item" href="#">1 night</a></li>
											<li><a class="dropdown-item" href="#">2 nights</a></li>
											<li><a class="dropdown-item" href="#">3 nights</a></li>
											<li><a class="dropdown-item" href="#">1 week</a></li>
											<li><a class="dropdown-item" href="#">1 month</a></li>
											<li>
												<a class="dropdown-item" href="#"><input type="date" /></a>
											</li>
										</ul>
									</div>
								</div>
								<div class="each-dropdown">
									<div class="dropdown">
										<button class="dropdown-toggle has-border" type="button" data-bs-toggle="dropdown" aria-expanded="false">
											<small>1 guest</small> <small><em class="bi bi-chevron-down"></em></small>
										</button>
										<ul class="dropdown-menu">
											<li><a class="dropdown-item" href="#">Action</a></li>
											<li><a class="dropdown-item" href="#">Another action</a></li>
											<li><a class="dropdown-item" href="#">Something else here</a></li>
										</ul>
									</div>
								</div>
								<div class="each-dropdown">
									<div class="dropdown">
										<button
											href="#"
											role="button"
											class="dropdown-toggle"
											type="button"
											data-bs-toggle="dropdown"
											aria-expanded="false">
											<small>No pets</small>
											<small><em class="bi bi-chevron-down"></em></small>
										</button>
										<ul class="dropdown-menu">
											<form action="" class="dropdown-item">
												<div><span>Pets</span></div>
												<div>
													<button type="button"><em class="bi bi-dash-lg"></em></button>
													<input type="number" value="0" />
													<button type="button"><em class="bi bi-plus-lg"></em></button>
												</div>
											</form>
										</ul>
									</div>
								</div>
							</div>
							<div class="inner-body">
								<div class="top">
									<div class="d-flex justify-content-between my-4">
										<span>
											<span>$39 x 1 night</span>
											<small class="d-block">Your base price</small>
										</span>
										<span>$39</span>
									</div>
									<div class="d-flex justify-content-between my-4">
										<b>Guest service fee</b>
										<b>$6</b>
									</div>
								</div>
								<hr />
								<div class="bottom">
									<div class="d-flex justify-content-between my-4">
										<b>Total</b>
										<b>$45</b>
									</div>
									<div class="d-flex justify-content-between my-4">
										<span>Your earnings</span>
										<span>$35</span>
									</div>
								</div>
							</div>
						</div>
						<div class="modal-footer">
							<button
								type="button"
								style="
									background-color: #000;
									color: #fff;
									padding: 13.5px 3rem;
									font-weight: 600;
									border-radius: 6px;
									font-size: 16px;
								"
								data-bs-dismiss="modal">
								Close
							</button>
						</div>
					</div>
				</div>
			</div>
			<!-- inner modal for preview guest pay end -->
			<!-- ==== END OF MODALS FOR PRICING ==== -->

			<!-- ==== MODALS FOR CLEANING FEE ===== -->
			<div class="modal fade" id="cleaning-fee" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
				<div class="modal-dialog modal-dialog-centered modal-lg">
					<div class="modal-content">
						<div class="modal-header">
							<h5 class="modal-title" id="exampleModalLabel">Pet fee</h5>
							<button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
						</div>
						<form action="">
							<div class="modal-body">
								<div class="form-input">
									<h3 class="fw-bolder">Cleaning fee</h3>
									<label for="night-plan" class="form-label"
										>Set a fee to cover cleaning after each stay. For any excess cleaning, there’s AirCover.
										<br />
										<a href="">Learn about cleaning fees</a></label
									><br />
									<h5 class="fw-bolder mt-4">Cleaning fee</h5>
									<input type="number" class="form-control for-value-input" id="night-plan" value="" />
									<small>Service animals stay for free.</small>
								</div>
								<hr />
								<div class="d-flex my-4 justify-content-between align-items-start">
									<div class="d-grid">
										<b>Short-stay cleaning fee</b>
										<small>Attract guests booking 1 or 2 nights by setting a lower cleaning fee. </small>
									</div>
									<div class="form-check form-switch">
										<input class="form-check-input" type="checkbox" role="switch" id="" />
									</div>
								</div>
							</div>
							<div class="modal-footer">
								<button type="button" class="save">Save</button>
							</div>
						</form>
					</div>
				</div>
			</div>
			<!--===== END OF MODALS FOR CLEANING FEE ===== -->

			<!-- ===== MODALS FOR PET FEE ===== -->
			<div class="modal fade" id="pet-fee" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
				<div class="modal-dialog modal-dialog-centered modal-lg">
					<div class="modal-content">
						<div class="modal-header">
							<h5 class="modal-title" id="exampleModalLabel">Pet fee</h5>
							<button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
						</div>
						<form action="">
							<div class="modal-body">
								<div class="form-input">
									<label for="night-plan" class="form-label"
										>Set a fee for costs specific to hosting pets. Any unfortunate accidents can be reimbursed through
										AirCover.<br />
										<a href="">Learn about pet fees</a></label
									>
									<input type="number" class="form-control for-value-input" id="night-plan" value="" />
									<small>Service animals stay for free.</small>
								</div>
							</div>
							<div class="modal-footer">
								<button type="button" class="save">Save</button>
							</div>
						</form>
					</div>
				</div>
			</div>
			<!-- ===== END OF MODALS FOR PET FEE  ===== -->

			<!-- ==== MODALS FOR EXTRA GUEST FEE ===== -->
			<!-- extra guest fee -->
			<div class="modal fade" id="extra-guest-fee" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
				<div class="modal-dialog modal-dialog-centered modal-lg">
					<div class="modal-content">
						<div class="modal-header">
							<h5 class="modal-title" id="exampleModalLabel">Extra guest fee</h5>
							<button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
						</div>
						<form action="">
							<div class="modal-body">
								<div class="form-input">
									<label for="charge" class="form-label"><small>Charge this amount per extra, per night</small></label>
									<input type="number" class="form-control for-value-input" id="charge" value="0" />
								</div>
								<hr />
								<div class="form-input d-flex justify-content-between align-items-center">
									<span>For each guest after</span>
									<div class="guest-value d-flex align-items-center">
										<button type="button" class="inc"><em class="bi bi-dash-lg"></em></button>
										<input type="number" disabled class="for-value-change" value="1" />
										<button type="button" class="dec"><em class="bi bi-plus-lg"></em></button>
									</div>
								</div>
							</div>
							<div class="modal-footer">
								<button type="button" class="cancel" data-bs-dismiss="modal">Cancel</button>
								<button type="button" class="save">Save</button>
							</div>
						</form>
					</div>
				</div>
			</div>
			<!-- extra guest fee end -->
			<!-- ==== END OF MODALS FOR EXTRA GUEST FEE ===== -->

			<!-- ==== MODALS FOR WEEKEND NIGHTLY PRICE ===== -->
			<div class="modal fade" id="weekend-nightly-price" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
				<div class="modal-dialog modal-dialog-centered modal-lg">
					<div class="modal-content">
						<div class="modal-header">
							<h5 class="modal-title" id="exampleModalLabel">Weekend nightly price</h5>
							<button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
						</div>
						<form action="">
							<div class="modal-body">
								<div class="form-input">
									<label for="night-plan" class="form-label"
										><small
											>This nightly price will replace your base price for every Friday and Saturday. It won't apply if Smart
											Pricing is on.</small
										></label
									>
									<input type="number" class="form-control for-value-input" id="night-plan" value="0" />
								</div>
							</div>
							<div class="modal-footer">
								<button type="button" class="cancel" data-bs-dismiss="modal">Cancel</button>
								<button type="button" class="save">Save</button>
							</div>
						</form>
					</div>
				</div>
			</div>
			<!-- ==== END OF MODALS FOR WEEKEND NIGHTLY PRICE ===== -->

			<!-- ==== MODALS FOR CALENDAR SYNC ===== -->
			<!-- ==== END OF MODALS FOR CALENDAR SYNC ===== -->

			<!-- ? 🚗🚗🚗 END OF PRICING AND AVAILABILITY 🚗🚗🚗 -->

			<!--  * 🚗🚗🚗 POLICIES AND RULES 🚗🚗🚗 -->
			<!-- ==== MODALS FOR PRICING ====-->
			<!-- ==== END OF MODALS FOR PRICING ==== -->

			<!-- ==== MODALS FOR DISCOUNT ===== -->
			<!--===== END OF MODALS FOR DISCOUNT ===== -->

			<!-- ===== MODALS FOR ADDITIONAL CHARGES ===== -->
			<!-- ===== END OF MODALS FOR ADDITIONAL CHARGES  ===== -->

			<!-- ==== MODALS FOR TRIP LENGTH ===== -->
			<!-- ==== END OF MODALS FOR TRIP LENGTH ===== -->

			<!-- ==== MODALS FOR CALENDAR AVAILABILITY ===== -->
			<!-- ==== END OF MODALS FOR CALENDAR AVAILABILITY ===== -->

			<!-- ==== MODALS FOR CALENDAR SYNC ===== -->
			<!-- ==== END OF MODALS FOR CALENDAR SYNC ===== -->

			<!-- ==== MODALS FOR SHARING SETTINGS SAFETY ===== -->
			<!-- ==== END OF MODALS FOR SHARING SETTINGS SAFETY ===== -->

			<!-- * 🚗🚗🚗 END OF POLICIES AND RULES 🚗🚗🚗 -->

			<!--  ! 🚗🚗🚗 INFO FOR GUESTS 🚗🚗🚗 -->
			<!-- ==== MODALS FOR PRE-BOOKING DETAILS ====-->
			<div class="modal fade" id="check-in-window" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
				<div class="modal-dialog modal-dialog-centered modal-dialog-scrollable">
					<div class="modal-content">
						<div class="modal-header">
							<h5 class="modal-title" id="exampleModalLabel">Check-in window</h5>
							<button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
						</div>
						<form action="">
							<div class="modal-body">
								<h5 class="fw-bolder">Check-in window</h5>
								<div class="form-input my-4">
									<select class="form-select text" aria-label="Default select example">
										<option selected>3:00 PM</option>
										<option value="">8:00 AM</option>
										<option value="">9:00 AM</option>
										<option value="">10:00 AM</option>
										<option value="">11:00 AM</option>
										<option value="">12:00 PM</option>
										<option value="">1:00 PM</option>
										<option value="">2:00 PM</option>
										<option value="">3:00 PM</option>
										<option value="">4:00 PM</option>
										<option value="">5:00 PM</option>
										<option value="">6:00 PM</option>
										<option value="">7:00 PM</option>
										<option value="">8:00 PM</option>
										<option value="">9:00 PM</option>
										<option value="">10:00 PM</option>
										<option value="">11:00 PM</option>
										<option value="">12:00 AM</option>
										<option value="">1:00 AM (next day)</option>
									</select>
								</div>
								<div class="form-input mb-4">
									<select class="form-select text" aria-label="Default select example">
										<option selected>Flexible</option>
										<option value="">5:00 PM</option>
										<option value="">6:00 PM</option>
										<option value="">7:00 PM</option>
										<option value="">8:00 PM</option>
										<option value="">9:00 PM</option>
										<option value="">10:00 PM</option>
										<option value="">11:00 PM</option>
										<option value="">1:00 AM (next day)</option>
										<option value="">12:00 AM (next day)</option>
									</select>
								</div>
							</div>
							<div class="modal-footer">
								<button type="button" class="cancel" data-bs-dismiss="modal">Cancel</button>
								<button type="button" class="save">Save changes</button>
							</div>
						</form>
					</div>
				</div>
			</div>

			<div class="modal fade" id="check-out-time" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
				<div class="modal-dialog modal-dialog-centered modal-dialog-scrollable">
					<div class="modal-content">
						<div class="modal-header">
							<h5 class="modal-title" id="exampleModalLabel">Checkout time</h5>
							<button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
						</div>
						<form action="">
							<div class="modal-body">
								<div class="form-input mb-2">
									<select class="form-select text" aria-label="Default select example">
										<option selected>12:00 AM</option>
										<option value="">12:00 AM</option>
										<option value="">1:00 AM</option>
										<option value="">2:00 AM</option>
										<option value="">3:00 AM</option>
										<option value="">4:00 AM</option>
										<option value="">5:00 AM</option>
										<option value="">6:00 AM</option>
										<option value="">7:00 AM</option>
										<option value="">8:00 AM</option>
										<option value="">9:00 AM</option>
										<option value="">10:00 AM</option>
										<option value="">11:00 AM</option>
										<option value="">12:00 PM</option>
										<option value="">1:00 PM</option>
										<option value="">2:00 PM</option>
										<option value="">3:00 PM</option>
										<option value="">4:00 PM</option>
										<option value="">5:00 PM</option>
										<option value="">6:00 PM</option>
										<option value="">7:00 PM</option>
										<option value="">8:00 PM</option>
										<option value="">9:00 PM</option>
										<option value="">10:00 PM</option>
										<option value="">11:00 PM</option>
									</select>
								</div>
							</div>
							<div class="modal-footer">
								<button type="button" class="cancel" data-bs-dismiss="modal">Cancel</button>
								<button type="button" class="save">Save</button>
							</div>
						</form>
					</div>
				</div>
			</div>

			<div class="modal fade" id="interaction-with-guests" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
				<div class="modal-dialog modal-dialog-centered modal-lg modal-dialog-scrollable">
					<div class="modal-content">
						<div class="modal-header">
							<h5 class="modal-title" id="exampleModalLabel">Check-in instructions</h5>
							<button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
						</div>
						<div class="modal-body">
							<form action="">
								<small class=""
									>Tell guests if you’ll be available to offer help throughout their stay and how you'll keep in touch with them.
								</small>
								<div class="form-input mb-2">
									<div class="form-check">
										<input class="form-check-input" type="radio" name="flexRadioDefault" id="flexRadioDefault1" />
										<label class="form-check-label" for="flexRadioDefault1"> I plan to socialize with my guests </label>
									</div>
								</div>
								<div class="form-input mb-2">
									<div class="form-check">
										<input class="form-check-input" type="radio" name="flexRadioDefault" id="flexRadioDefault1" />
										<label class="form-check-label" for="flexRadioDefault1">
											I give my guests space but am available when needed
										</label>
									</div>
								</div>
								<div class="form-input mb-2">
									<div class="form-check">
										<input class="form-check-input" type="radio" name="flexRadioDefault" id="flexRadioDefault1" />
										<label class="form-check-label" for="flexRadioDefault1"> I won’t be available in person </label>
									</div>
								</div>
								<br />
								<hr />
								<br />
								<div class="form-input">
									<textarea class="form-control text" id="check-insss" rows="3" style="min-height: 4rem"></textarea>
								</div>
								<div class="modal-footer border-0">
									<button type="button" class="cancel" data-bs-dismiss="modal">Cancel</button>
									<button type="button" class="save">Save changes</button>
								</div>
							</form>
						</div>
					</div>
				</div>
			</div>
			<!-- ==== END OF MODALS FOR PRE-BOOKING DETAILS ==== -->

			<!-- ==== MODALS FOR POST-BOOKING DETAILS ===== -->
			<div class="modal fade" id="address" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
				<div class="modal-dialog modal-lg">
					<div class="modal-content">
						<div class="modal-header">
							<h5 class="modal-title" id="exampleModalLabel">Guest manual</h5>
							<button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
						</div>
						<form action="">
							<div class="modal-body">
								<a
									href="#"
									class="location d-flex align-items-center justify-content-center"
									style="
										padding: 5px 3rem;
										border: 1px solid #000;
										color: #000;
										width: max-content;
										column-gap: 0.5rem;
										border-radius: 5px;
										margin-bottom: 1em;
									">
									<span><em class="bi bi-geo-alt-fill"></em></span>
									<span>Use current location</span>
								</a>
								<div class="form-input mb-3">
									<label for="country" class="form-label">Country / Region</label>
									<input type="email" class="form-control text" id="country" disabled value="Nigeria" />
								</div>
								<div class="form-input mb-3">
									<label for="country" class="form-label">Street</label>
									<input type="email" class="form-control text" id="country" value="Abuja zone" />
									<small>House name/number + street/road</small>
								</div>
								<div class="form-input mb-3">
									<label for="country" class="form-label">Apt, Suite. (optional)</label>
									<input type="email" class="form-control text" id="country" />
									<small>Apt., suite, building access code</small>
								</div>
								<div class="row g-3">
									<div class="col-md-6">
										<label for="city" class="form-label">City</label>
										<input type="text" class="form-control text" id="city" value="Agege" />
									</div>
									<div class="col-md-6">
										<label for="state" class="form-label">State</label>
										<input type="text" class="form-control text" id="state" value="Lagos" />
									</div>
									<div class="col-md-6">
										<label for="zip-code" class="form-label">ZIP code</label>
										<input type="text" class="form-control text" id="zip-code" value="101232" />
									</div>
								</div>
							</div>
							<div class="modal-footer">
								<button type="button" class="cancel" data-bs-dismiss="modal">Close</button>
								<button type="button" class="save">Save</button>
							</div>
						</form>
					</div>
				</div>
			</div>
			<div class="modal fade" id="directions" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
				<div class="modal-dialog modal-lg modal-dialog-centered">
					<div class="modal-content">
						<div class="modal-header">
							<h5 class="modal-title" id="exampleModalLabel">Directions</h5>
							<button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
						</div>
						<form action="">
							<div class="modal-body">
								<label for="" class="form-label">Directions</label>
								<textarea class="form-control text" id="" rows="3" style="min-height: 4rem"></textarea>
							</div>
							<div class="modal-footer">
								<button type="button" class="cancel" data-bs-dismiss="modal">Close</button>
								<button type="button" class="save">Save</button>
							</div>
						</form>
					</div>
				</div>
			</div>

			<div class="modal fade" id="guest-manual" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
				<div class="modal-dialog">
					<div class="modal-content">
						<div class="modal-header">
							<h5 class="modal-title" id="exampleModalLabel">Guest manual</h5>
							<button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
						</div>
						<form action="">
							<div class="modal-body">
								<label for="" class="form-label"
									><small
										>Give guests tips about your listing, like how to access the internet or turn on the hot water</small
									></label
								>
								<textarea class="form-control text" id="" rows="3" style="min-height: 4rem"></textarea>
							</div>
							<div class="modal-footer">
								<button type="button" class="cancel" data-bs-dismiss="modal">Close</button>
								<button type="button" class="save">Save</button>
							</div>
						</form>
					</div>
				</div>
			</div>

			<div class="modal fade" id="check-in-instructions" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
				<div class="modal-dialog modal-dialog-centered modal-lg modal-dialog-scrollable">
					<div class="modal-content">
						<div class="modal-header">
							<h5 class="modal-title" id="exampleModalLabel">Check-in instructions</h5>
							<button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
						</div>
						<div class="modal-body">
							<form action="">
								<h4 class="fw-bolder my-4">Check-in method</h4>
								<div class="form-input mb-2">
									<div class="form-check">
										<input class="form-check-input" type="radio" name="flexRadioDefault" id="flexRadioDefault1" />
										<label class="form-check-label" for="flexRadioDefault1">
											<span>Smart lock</span> <br />
											<small>Guests can open the door with a code</small>
										</label>
									</div>
								</div>
								<div class="form-input mb-2">
									<div class="form-check">
										<input class="form-check-input" type="radio" name="flexRadioDefault" id="flexRadioDefault1" />
										<label class="form-check-label" for="flexRadioDefault1">
											<span>Lockbox</span> <br />
											<small>The key is stored in a small safe, which guests can open with a code</small>
										</label>
									</div>
								</div>
								<div class="form-input mb-2">
									<div class="form-check">
										<input class="form-check-input" type="radio" name="flexRadioDefault" id="flexRadioDefault1" />
										<label class="form-check-label" for="flexRadioDefault1">
											<span> Building staff</span> <br />
											<small>Someone is available 24 hours a day to let guests in</small>
										</label>
									</div>
								</div>
								<div class="form-input mb-2">
									<div class="form-check">
										<input class="form-check-input" type="radio" name="flexRadioDefault" id="flexRadioDefault1" />
										<label class="form-check-label" for="flexRadioDefault1">
											<span>Host greets you</span> <br />
											<small>A host or co-host will meet guests to exchange the key</small>
										</label>
									</div>
								</div>
								<div class="form-input mb-2">
									<div class="form-check">
										<input class="form-check-input" type="radio" name="flexRadioDefault" id="flexRadioDefault1" />
										<label class="form-check-label" for="flexRadioDefault1">
											<span>Other</span> <br />
											<small>Guests can use a different method not listed above</small>
										</label>
									</div>
								</div>
								<br />
								<hr />
								<br />
								<div class="form-input">
									<label for="check-insss" class="form-label">Check-in instructions </label>
									<textarea class="form-control text" id="check-insss" rows="3" style="min-height: 4rem"></textarea>
								</div>
								<div class="modal-footer border-0">
									<button type="button" class="cancel" data-bs-dismiss="modal">Cancel</button>
									<button type="button" class="save">Save changes</button>
								</div>
							</form>
						</div>
					</div>
				</div>
			</div>
			<!--===== END OF MODALS FOR POST-BOOKING DETAILS ===== -->

			<!-- ===== MODALS FOR ARRIVAL DETAILS ===== -->
			<div class="modal fade" id="wifi-details" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
				<div class="modal-dialog modal-dialog-centered modal-lg">
					<div class="modal-content">
						<div class="modal-header">
							<h5 class="modal-title" id="exampleModalLabel">Wifi details</h5>
							<button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
						</div>
						<form action="">
							<div class="modal-body">
								<div class="form-input">
									<label for="wifi" class="form-label">Wifi network name</label>
									<input type="email" class="form-control text" id="wifi" />
								</div>
								<hr />
								<div class="form-input">
									<label for="wifi-pass" class="form-label">Wifi password</label>
									<input type="email" class="form-control text" id="wifi-pass" />
								</div>
							</div>
							<div class="modal-footer">
								<button type="button" class="cancel" data-bs-dismiss="modal">Cancel</button>
								<button type="button" class="save">Save changes</button>
							</div>
						</form>
					</div>
				</div>
			</div>
			<!-- ===== END OF MODALS FOR ARRIVAL DETAILS  ===== -->

			<!-- ! 🚗🚗🚗 END OF INFO FOR GUESTS 🚗🚗🚗 -->

			<!--  ? 🚎🚎🚎🚎🚎🚎🚎🚎🚎🚎🚎 CO-HOST 🚎🚎🚎🚎🚎🚎🚎🚎🚎🚎🚎 -->
			<!-- ==== MODALS FOR CO-HOST ==== -->

			<div class="modal fade" id="co-host" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
				<div class="modal-dialog modal-dialog-centered">
					<div class="modal-content">
						<div class="modal-header">
							<h5 class="modal-title" id="exampleModalLabel" style="font-weight: bolder">Invite a friend</h5>
							<button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
						</div>
						<form action="">
							<div class="modal-body">
								<div class="form-input form-floating">
									<input type="email" class="form-control" id="floatingInputValue" placeholder="name@example.com" value="" />
									<label for="floatingInputValue">Email address</label>
								</div>
								<div class="form-check mt-1">
									<input class="form-check-input" type="checkbox" value="" id="flexCheckDefault" />
									<label class="form-check-label" for="flexCheckDefault"
										>I agree to the terms of Co-host
										<a href="" style="color: #000; font-size: 16px; text-decoration: underline">Terms and service</a>
									</label>
									<div>
										<small style="color: #757575; font-size: 12px; display: flex"
											>When you add a co-host, they can act on your behalf. You’re responsible for actions they take when
											they’re hosting your space.</small
										>
									</div>
								</div>
							</div>
							<div class="modal-footer">
								<button
									type="button"
									style="
										background-color: #000;
										color: #fff;
										padding: 13.5px 3rem;
										font-weight: 600;
										border-radius: 6px;
										font-size: 16px;
									">
									Invite
								</button>
							</div>
						</form>
					</div>
				</div>
			</div>
			<!-- ==== END OF MODALS FOR CO-HOST ==== -->

			<!-- ? 🚎🚎🚎🚎🚎🚎🚎🚎🚎🚎🚎 END OF CO-HOST 🚎🚎🚎🚎🚎🚎🚎🚎🚎🚎🚎 -->

			<!-- ================  END OF PILES OF MODALS ======================= -->

			<!-- mobile view footer -->
			<footer>
				<div class="row col-12 m-0 align-items-center justify-content-center d-md-none mobile-view">
					<div class="p-0 col-2 each-link">
						<a href="#" class="active">
							<div class="svg-icon">
								<svg
									xmlns="http://www.w3.org/2000/svg"
									width="32"
									height="32"
									preserveAspectRatio="xMidYMid meet"
									viewBox="0 0 24 24">
									<path
										fill="currentColor"
										d="M10 18a7.952 7.952 0 0 0 4.897-1.688l4.396 4.396l1.414-1.414l-4.396-4.396A7.952 7.952 0 0 0 18 10c0-4.411-3.589-8-8-8s-8 3.589-8 8s3.589 8 8 8zm0-14c3.309 0 6 2.691 6 6s-2.691 6-6 6s-6-2.691-6-6s2.691-6 6-6z" />
								</svg>
							</div>
							<div class="text"><small>Explore</small></div>
						</a>
					</div>
					<div class="p-0 col-2 each-link">
						<a href="#">
							<div class="svg-icon">
								<svg
									xmlns="http://www.w3.org/2000/svg"
									width="32"
									height="32"
									preserveAspectRatio="xMidYMid meet"
									viewBox="0 0 36 36">
									<path
										fill="currentColor"
										d="M18 32.43a1 1 0 0 1-.61-.21C11.83 27.9 8 24.18 5.32 20.51C1.9 15.82 1.12 11.49 3 7.64c1.34-2.75 5.19-5 9.69-3.69A9.87 9.87 0 0 1 18 7.72a9.87 9.87 0 0 1 5.31-3.77c4.49-1.29 8.35.94 9.69 3.69c1.88 3.85 1.1 8.18-2.32 12.87c-2.68 3.67-6.51 7.39-12.07 11.71a1 1 0 0 1-.61.21ZM10.13 5.58A5.9 5.9 0 0 0 4.8 8.51c-1.55 3.18-.85 6.72 2.14 10.81A57.13 57.13 0 0 0 18 30.16a57.13 57.13 0 0 0 11.06-10.83c3-4.1 3.69-7.64 2.14-10.81c-1-2-4-3.59-7.34-2.65a8 8 0 0 0-4.94 4.2a1 1 0 0 1-1.85 0a7.93 7.93 0 0 0-4.94-4.2a7.31 7.31 0 0 0-2-.29Z"
										class="clr-i-outline clr-i-outline-path-1" />
									<path fill="none" d="M0 0h36v36H0z" />
								</svg>
							</div>
							<div class="text"><small>Wishlists</small></div>
						</a>
					</div>
					<div class="p-0 col-2 each-link">
						<a href="#">
							<div class="svg-icon">
								<svg
									xmlns="http://www.w3.org/2000/svg"
									width="32"
									height="32"
									preserveAspectRatio="xMidYMid meet"
									viewBox="0 0 256 256">
									<path
										fill="currentColor"
										d="M232 128a104 104 0 1 0-174.2 76.7l1.3 1.2a104 104 0 0 0 137.8 0l1.3-1.2A103.7 103.7 0 0 0 232 128Zm-192 0a88 88 0 1 1 153.8 58.4a79.2 79.2 0 0 0-36.1-28.7a48 48 0 1 0-59.4 0a79.2 79.2 0 0 0-36.1 28.7A87.6 87.6 0 0 1 40 128Zm56-8a32 32 0 1 1 32 32a32.1 32.1 0 0 1-32-32Zm-21.9 77.5a64 64 0 0 1 107.8 0a87.8 87.8 0 0 1-107.8 0Z" />
								</svg>
							</div>
							<div class="text"><small>Log in</small></div>
						</a>
					</div>
				</div>
			</footer>

			<!-- end of mobile footer view -->
			<footer class="pt-5 mb-0 mt-0 position-static d-none d-md-block" style="background-color: #f7f7f7; border-top: 1px solid #dddddd">
				<div class="container px-3">
					<div class="row m-0">
						<div class="col-lg-3">
							<h5>Support</h5>
							<ul class="nav row flex-lg-column">
								<li class="nav-item mb-2 col-lg-12 col-md-4 col-sm-6"><a href="#" class="nav-link p-0 text-muted">Newsroom</a></li>
								<li class="nav-item mb-2 col-lg-12 col-md-4 col-sm-6">
									<a href="#" class="nav-link p-0 text-muted">Learn about new features</a>
								</li>
								<li class="nav-item mb-2 col-lg-12 col-md-4 col-sm-6">
									<a href="#" class="nav-link p-0 text-muted">Letter from our founders</a>
								</li>
								<li class="nav-item mb-2 col-lg-12 col-md-4 col-sm-6"><a href="#" class="nav-link p-0 text-muted">Careers</a></li>
								<li class="nav-item mb-2 col-lg-12 col-md-4 col-sm-6"><a href="#" class="nav-link p-0 text-muted">Investors</a></li>
							</ul>
						</div>

						<div class="col-lg-3">
							<h5>Community</h5>
							<ul class="nav row flex-lg-column">
								<li class="nav-item mb-2 col-lg-12 col-md-4 col-sm-6"><a href="#" class="nav-link p-0 text-muted">Newsroom</a></li>
								<li class="nav-item mb-2 col-lg-12 col-md-4 col-sm-6">
									<a href="#" class="nav-link p-0 text-muted">Learn about new features</a>
								</li>
								<li class="nav-item mb-2 col-lg-12 col-md-4 col-sm-6">
									<a href="#" class="nav-link p-0 text-muted">Letter from our founders</a>
								</li>
								<li class="nav-item mb-2 col-lg-12 col-md-4 col-sm-6"><a href="#" class="nav-link p-0 text-muted">Careers</a></li>
								<li class="nav-item mb-2 col-lg-12 col-md-4 col-sm-6"><a href="#" class="nav-link p-0 text-muted">Investors</a></li>
							</ul>
						</div>

						<div class="col-lg-3">
							<h5>Hosting</h5>
							<ul class="nav row flex-lg-column">
								<li class="nav-item mb-2 col-lg-12 col-md-4 col-sm-6"><a href="#" class="nav-link p-0 text-muted">Newsroom</a></li>
								<li class="nav-item mb-2 col-lg-12 col-md-4 col-sm-6">
									<a href="#" class="nav-link p-0 text-muted">Learn about new features</a>
								</li>
								<li class="nav-item mb-2 col-lg-12 col-md-4 col-sm-6">
									<a href="#" class="nav-link p-0 text-muted">Letter from our founders</a>
								</li>
								<li class="nav-item mb-2 col-lg-12 col-md-4 col-sm-6"><a href="#" class="nav-link p-0 text-muted">Careers</a></li>
								<li class="nav-item mb-2 col-lg-12 col-md-4 col-sm-6"><a href="#" class="nav-link p-0 text-muted">Investors</a></li>
							</ul>
						</div>

						<div class="col-lg-3">
							<h5>Hosting</h5>
							<ul class="nav row flex-lg-column">
								<li class="nav-item mb-2 col-lg-12 col-md-4 col-sm-6"><a href="#" class="nav-link p-0 text-muted">Newsroom</a></li>
								<li class="nav-item mb-2 col-lg-12 col-md-4 col-sm-6">
									<a href="#" class="nav-link p-0 text-muted">Learn about new features</a>
								</li>
								<li class="nav-item mb-2 col-lg-12 col-md-4 col-sm-6">
									<a href="#" class="nav-link p-0 text-muted">Letter from our founders</a>
								</li>
								<li class="nav-item mb-2 col-lg-12 col-md-4 col-sm-6"><a href="#" class="nav-link p-0 text-muted">Careers</a></li>
								<li class="nav-item mb-2 col-lg-12 col-md-4 col-sm-6"><a href="#" class="nav-link p-0 text-muted">Investors</a></li>
							</ul>
						</div>
					</div>
				</div>
				<div class="d-flex px-4 justify-content-between py-4 mt-4 border-top">
					<p>© 2021 Company, Inc. All rights reserved.</p>
					<ul class="list-unstyled d-flex">
						<li class="ms-3">
							<a class="link-dark" href="#"
								><svg class="bi" width="24" height="24"><use xlink:href="#twitter"></use></svg
							></a>
						</li>
						<li class="ms-3">
							<a class="link-dark" href="#"
								><svg class="bi" width="24" height="24"><use xlink:href="#instagram"></use></svg
							></a>
						</li>
						<li class="ms-3">
							<a class="link-dark" href="#"
								><svg class="bi" width="24" height="24"><use xlink:href="#facebook"></use></svg
							></a>
						</li>
					</ul>
				</div>
			</footer>
		</div>

        <!--This is Menu Bar-->
        <div class="offcanvas offcanvas-top" style="height: 100vh;" tabindex="-1" id="offcanvasTop" aria-labelledby="offcanvasTopLabel">
            <div class="offcanvas-header">
                <h5 class="offcanvas-title" id="offcanvasTopLabel">
                    <div class="sm-screen-logo " style="width:30%;">
                        <a href="#">
                            <img style="width:100%;" src="../../assets/images/GREEN_LOGO_HORIZONTAL_1.png" /> 
                        </a>
                    </div>
                </h5>
                <button type="button" class="btn-close" data-bs-dismiss="offcanvas" aria-label="Close"></button>
            </div>
            <div class="offcanvas-body">
                <div role="dialog" class="_1if7r9j">
                    <ul class="_yr78ke">
                        <div class="_17rwvlx">Menu</div>
                        <a class="_1lqi869l" href="/hosting" theme="[object Object]">
                            <div class="_3hmsj">
                                <div class="_1lejuyz"><svg viewBox="0 0 32 32" xmlns="http://www.w3.org/2000/svg" aria-hidden="true" role="presentation" focusable="false" style="display: block; height: 24px; width: 24px; fill: currentcolor;"><path d="M13.92 1.112a3 3 0 0 1 4.017-.129l.142.13 11.307 10.871a2 2 0 0 1 .606 1.261l.008.18V27a3 3 0 0 1-2.824 2.995L27 30H5a3 3 0 0 1-2.995-2.824L2 27V13.426a2 2 0 0 1 .49-1.311l.124-.13L13.92 1.111zm2.773 1.442a1 1 0 0 0-1.293-.08l-.093.08L4 13.426V27a1 1 0 0 0 .883.993L5 28h22a1 1 0 0 0 .993-.883L28 27V13.426L16.693 2.554zM22 12.586L23.414 14 14 23.414 8.586 18 10 16.586l4 3.999 8-8z"></path></svg></div>
                            </div>
                            <div class="_ojs7nk">Today</div>
                        </a>
                        <a class="_1lqi869l" href="/hosting/inbox" theme="[object Object]">
                            <div class="_3hmsj">
                                <div class="_1lejuyz"><svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 32 32" aria-hidden="true" role="presentation" focusable="false" style="display: block; height: 24px; width: 24px; fill: currentcolor;"><path d="M16.00049,31.0791,11.84326,26H6a5.00588,5.00588,0,0,1-5-5V7A5.00588,5.00588,0,0,1,6,2H26a5.00588,5.00588,0,0,1,5,5V21a5.00588,5.00588,0,0,1-5,5H20.1543ZM6,4A3.00328,3.00328,0,0,0,3,7V21a3.00328,3.00328,0,0,0,3,3h6.79053l3.209,3.9209L19.207,24H26a3.00328,3.00328,0,0,0,3-3V7a3.00328,3.00328,0,0,0-3-3Z"></path></svg></div>
                            </div>
                            <div class="_ojs7nk">Inbox</div>
                        </a>
                        <a class="_1lqi869l" href="/calendar-router" theme="[object Object]">
                            <div class="_3hmsj">
                                <div class="_1lejuyz"><svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 32 32" aria-hidden="true" role="presentation" focusable="false" style="display: block; height: 24px; width: 24px; fill: currentcolor;"><path d="M28,2H22V0H20V2H12V0H10V2H4A2.002,2.002,0,0,0,2,4V25a5.00588,5.00588,0,0,0,5,5H19.58594A2.0144,2.0144,0,0,0,21,29.41406L29.41406,21A2.0144,2.0144,0,0,0,30,19.58594V4A2.00229,2.00229,0,0,0,28,2ZM20,27.58594V23a3.00328,3.00328,0,0,1,3-3h4.58594ZM28,10H4v2H28v6H23a5.00588,5.00588,0,0,0-5,5v5H7a3.00328,3.00328,0,0,1-3-3L3.99854,4H10V6h2V4h8V6h2V4h6Z"></path></svg></div>
                            </div>
                            <div class="_ojs7nk">Calendar</div>
                        </a>
                        <a class="_1lqi869l" href="/progress/opportunity-hub" theme="[object Object]">
                            <div class="_3hmsj">
                                <div class="_1lejuyz"><svg viewBox="0 0 32 32" xmlns="http://www.w3.org/2000/svg" aria-hidden="true" role="presentation" focusable="false" style="display: block; height: 24px; width: 24px; fill: currentcolor;"><path d="m27 5h-4a2.00229 2.00229 0 0 0 -2 2v4h-4v-8a2.002 2.002 0 0 0 -2-2h-4a2.002 2.002 0 0 0 -2 2v8h-4a2.002 2.002 0 0 0 -2 2v16a2.00229 2.00229 0 0 0 2 2h22a2.0026 2.0026 0 0 0 2-2v-22a2.00229 2.00229 0 0 0 -2-2zm-18 24h-4l-.00146-16h4.00146zm6 0h-4v-16l-.00092-.00891-.00054-9.99109h4.00146zm6 0h-4v-16h4zm6 0h-4v-16l-.00073-.007-.00027-5.993h4.001z"></path></svg></div>
                            </div>
                            <div class="_ojs7nk">Insights</div>
                        </a>
                        <a class="_1lqi869l" href="/hosting/listings" theme="[object Object]">
                            <div class="_3hmsj">
                                <div class="_1lejuyz"><svg viewBox="0 0 32 32" xmlns="http://www.w3.org/2000/svg" aria-hidden="true" role="presentation" focusable="false" style="display: block; height: 24px; width: 24px; fill: currentcolor;"><path d="m17.9772237 1.90551573.1439807.13496509 13.2525 13.25240998-1.4142088 1.4142184-.9603513-.9603098.0008557 12.5832006c0 1.0543618-.8158778 1.9181651-1.8507377 1.9945143l-.1492623.0054857h-22c-1.0543618 0-1.91816512-.8158778-1.99451426-1.8507377l-.00548574-.1492623-.00085571-12.5822006-.95878858.9593098-1.41421142-1.414217 13.25247161-13.25243161c1.1247615-1.1246896 2.9202989-1.16967718 4.0986078-.13494486zm-2.5902053 1.46599297-.0942127.08318915-10.29366141 10.29310155.00085571 14.5822006h5.9991443l.0008557-9.9966c0-1.0543764.8158639-1.9181664 1.8507358-1.9945144l.1492642-.0054856h6c1.0543764 0 1.9181664.8158639 1.9945144 1.8507358l.0054856.1492642-.0008557 9.9966h6.0008557l-.0008557-14.5832006-10.2921737-10.29212525c-.3604413-.36046438-.9276436-.38819241-1.3199522-.08316545zm3.6129816 14.9618913h-6l-.0008557 9.9963994h6z"></path></svg></div>
                            </div>
                            <div class="_ojs7nk">Listings</div>
                        </a>
                        <a class="_1lqi869l" href="/hosting/reservations" theme="[object Object]">
                            <div class="_3hmsj">
                                <div class="_1lejuyz"><svg viewBox="0 0 32 32" xmlns="http://www.w3.org/2000/svg" aria-hidden="true" role="presentation" focusable="false" style="display: block; height: 24px; width: 24px; fill: currentcolor;"><path d="m26 6h-4v-2a2.00229 2.00229 0 0 0 -2-2h-8a2.002 2.002 0 0 0 -2 2v2h-4a5.00588 5.00588 0 0 0 -5 5v14a5.00588 5.00588 0 0 0 5 5h20a5.00588 5.00588 0 0 0 5-5v-14a5.00588 5.00588 0 0 0 -5-5zm-14.00146-2h8.00146v2h-8.00134zm-5.99854 24a3.00328 3.00328 0 0 1 -3-3v-14a3.00328 3.00328 0 0 1 3-3h4v20zm6 0-.00122-20h8.00122v20zm17-3a3.00328 3.00328 0 0 1 -3 3h-4v-20h4a3.00328 3.00328 0 0 1 3 3z"></path></svg></div>
                            </div>
                            <div class="_ojs7nk">Reservations</div>
                        </a>
                        <a class="_1lqi869l" href="/manage-guidebook?s=host_profile_menu" theme="[object Object]">
                            <div class="_3hmsj">
                                <div class="_1lejuyz"><svg viewBox="0 0 32 32" xmlns="http://www.w3.org/2000/svg" aria-hidden="true" role="presentation" focusable="false" style="display: block; height: 24px; width: 24px; fill: currentcolor;"><path d="m1.66675 2.67728c0-1.29010774 1.19757945-2.22892485 2.43214873-1.95293212l.14254843.03728562 11.76455284 3.5293665 11.7747926-3.3852093c1.1836744-.3403064 2.3638086.45712676 2.5321485 1.63303369l.0152796.14287691.0051793.1462187v23.09468c0 .8279727-.5091718 1.5640524-1.2698418 1.8619846l-.155411.0536419-12.6207 3.7862c-.1499506.0449851-.3078242.0539821-.4609439.026991l-.1137505-.026991-12.62071315-3.786204c-.79308169-.2379357-1.35183119-.937138-1.41857691-1.7513494l-.00671274-.1642731zm1.99999664.00000464v23.24528886l12.33325336 3.6994265 12.3334-3.6994076v-23.0946724l-12.0569924 3.46639925c-.1474472.0423911-.3021582.05014891-.4521925.02334213l-.1114623-.02658488zm21.66607876 17.47821536v2.088l-9.333 2.8v-2.087zm0-6v2.088l-9.333 2.8v-2.087zm0-5.999v2.087l-9.333 2.8v-2.087z"></path></svg></div>
                            </div>
                            <div class="_ojs7nk">Guidebooks</div>
                        </a>
                        <a class="_1lqi869l" href="/users/transaction_history" theme="[object Object]">
                            <div class="_3hmsj">
                                <div class="_1lejuyz"><svg viewBox="0 0 32 32" xmlns="http://www.w3.org/2000/svg" aria-hidden="true" role="presentation" focusable="false" style="display: block; height: 24px; width: 24px; fill: currentcolor;"><path d="m26 5c1.0543618 0 1.9181651.81587779 1.9945143 1.85073766l.0054857.14926234.0013298 11.255617c1.8127343 1.2650459 2.9986702 3.3662194 2.9986702 5.744383 0 3.8659932-3.1340068 7-7 7-3.7854517 0-6.8690987-3.0047834-6.995941-6.7593502l-.004059-.2406498h-14c-1.0543618 0-1.91816512-.8158778-1.99451426-1.8507377l-.00548574-.1492623v-15c0-1.0543618.81587779-1.91816512 1.85073766-1.99451426l.14926234-.00548574zm-2 14c-2.7614237 0-5 2.2385763-5 5s2.2385763 5 5 5 5-2.2385763 5-5-2.2385763-5-5-5zm1 1v3.464l2.5547002 1.7039497-1.1094004 1.6641006-3.4452998-2.2968665v-4.5351838zm1-13h-23v15h14.2898925c.860564-2.8915115 3.5391038-5 6.7101075-5 .695354 0 1.3670274.1013887 2.0010432.2901893zm-11.5 3c2.4852814 0 4.5 2.0147186 4.5 4.5s-2.0147186 4.5-4.5 4.5-4.5-2.0147186-4.5-4.5 2.0147186-4.5 4.5-4.5zm0 2c-1.3807119 0-2.5 1.1192881-2.5 2.5s1.1192881 2.5 2.5 2.5 2.5-1.1192881 2.5-2.5-1.1192881-2.5-2.5-2.5zm-8.5-3c.55228475 0 1 .44771525 1 1 0 .5522847-.44771525 1-1 1s-1-.4477153-1-1c0-.55228475.44771525-1 1-1z"></path></svg></div>
                            </div>
                            <div class="_ojs7nk">Transaction history</div>
                        </a>
                        <div class="_1a7n56z">
                            <div class="_ipygq"></div>
                        </div>
                        <div class="_17rwvlx">Account</div>
                        <a class="_1lqi869l" href="/users/show" theme="[object Object]">
                            <div class="_3hmsj">
                                <div class="_1lejuyz"><svg viewBox="0 0 32 32" xmlns="http://www.w3.org/2000/svg" aria-hidden="true" role="presentation" focusable="false" style="display: block; height: 24px; width: 24px; fill: currentcolor;"><path d="m16 1a15 15 0 1 0 15 15 15.017 15.017 0 0 0 -15-15zm-9.08307 24.28351a10.93393 10.93393 0 0 1 7.08307-4.59558v-2.122a4.9975 4.9975 0 1 1 4 .0022v2.12182a10.9291 10.9291 0 0 1 7.08307 4.59339 12.95749 12.95749 0 0 1 -18.16614.00018zm19.51251-1.55615a12.90782 12.90782 0 0 0 -5.87573-4.41095 7.00008 7.00008 0 1 0 -9.1084-.001 12.91422 12.91422 0 0 0 -5.87469 4.41223 12.9918 12.9918 0 1 1 23.42938-7.72764 12.91372 12.91372 0 0 1 -2.57056 7.72736z"></path></svg></div>
                            </div>
                            <div class="_ojs7nk">Your profile</div>
                        </a>
                        <a class="_1lqi869l" href="/account-settings" theme="[object Object]">
                            <div class="_3hmsj">
                                <div class="_1lejuyz"><svg viewBox="0 0 32 32" xmlns="http://www.w3.org/2000/svg" aria-hidden="true" role="presentation" focusable="false" style="display: block; fill: none; height: 24px; width: 24px; stroke: currentcolor; stroke-width: 1.33333; overflow: visible;"><path d="m19.38 27a4.14 4.14 0 0 1 3.05-2.54 4.06 4.06 0 0 1 3.17.71 1 1 0 0 0 1.47-.33l2.11-3.64a1 1 0 0 0 -.46-1.44 4.1 4.1 0 0 1 0-7.48 1 1 0 0 0 .46-1.44l-2.11-3.66a1 1 0 0 0 -1.47-.33 4.07 4.07 0 0 1 -3.17.71 4.14 4.14 0 0 1 -3.05-2.56 4 4 0 0 1 -.27-1.87 1 1 0 0 0 -1-1.15h-4.2a1 1 0 0 0 -1 1.15 4.11 4.11 0 0 1 -3.34 4.43 4.06 4.06 0 0 1 -3.17-.71 1 1 0 0 0 -1.47.33l-2.11 3.64a1 1 0 0 0 .46 1.44 4.1 4.1 0 0 1 0 7.48 1 1 0 0 0 -.46 1.44l2.11 3.64a1 1 0 0 0 1.47.33 4.06 4.06 0 0 1 3.17-.71 4.1 4.1 0 0 1 3 2.53 4 4 0 0 1 .28 1.88 1 1 0 0 0 1 1.15h4.18a1 1 0 0 0 1-1.15 4 4 0 0 1 .35-1.85zm-7.38-11a4 4 0 1 1 4 4 4 4 0 0 1 -4-4z" vector-effect="non-scaling-stroke" transform="translate(0,0)scale(1,1)" fill="none"></path></svg></div>
                            </div>
                            <div class="_ojs7nk">Account settings</div>
                        </a>
                        <a class="_1lqi869l" href="/alerts" theme="[object Object]">
                            <div class="_3hmsj">
                                <div class="_1lejuyz"><svg viewBox="0 0 32 32" xmlns="http://www.w3.org/2000/svg" aria-hidden="true" role="presentation" focusable="false" style="display: block; height: 24px; width: 24px; fill: currentcolor;"><g vector-effect="non-scaling-stroke" transform="translate(0,0)scale(1,1)" fill="none" stroke="#000" stroke-width="2"><path d="m5.00135366 26c-.20958675 0-.41387603-.0658516-.58400769-.1882519-.44831611-.3225385-.55027898-.9474397-.22774044-1.3957558l2.80967332-3.9069923.00072115-7.509.00383711-.2653623c.14037147-4.84782402 4.11436019-8.7346377 8.99616289-8.7346377 4.9705627 0 9 4.02943725 9 9l-.0007211 7.508 2.8111156 3.9079923c.0979202.1361053.1596493.2940715.1804241.4591222l.0078277.1248855c0 .5522847-.4477152 1-1 1z"></path><path d="m15.3333333 30.6666667c1.4727594 0 2.6666667-1.1939074 2.6666667-2.6666667s-1.1939073-2.6666667-2.6666667-2.6666667h-1.3333333v5.3333334z" transform="matrix(0 1 -1 0 44 12)"></path><path d="m16 1v4"></path></g></svg>
                                    <div class="_1xhrozh2" aria-label="1 notification">1</div>
                                </div>
                            </div>
                            <div class="_ojs7nk">Notifications</div>
                        </a>
                        <a class="_1lqi869l" href="/become-a-host" theme="[object Object]">
                            <div class="_3hmsj">
                                <div class="_1lejuyz"><svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 32 32" aria-hidden="true" role="presentation" focusable="false" style="display: block; height: 24px; width: 24px; fill: currentcolor;"><path d="M31.707,15.293,29,12.58594,18.12109,1.707a3.07251,3.07251,0,0,0-4.24218,0L3,12.58594.293,15.293,1.707,16.707,3,15.41406V28a2.00229,2.00229,0,0,0,2,2H27a2.0026,2.0026,0,0,0,2-2V15.41406l1.293,1.293ZM27,28H5V13.41406l10.293-10.293a1.00142,1.00142,0,0,1,1.41406,0L27,13.41406ZM17,12v5h5v2H17v5H15V19H10V17h5V12Z"></path></svg></div>
                            </div>
                            <div class="_ojs7nk">Create a new listing</div>
                        </a>
                        <div class="_1a7n56z">
                            <div class="_ipygq"></div>
                        </div>
                        <div class="_17rwvlx">Resources &amp; Support</div>
                        <a class="_1lqi869l" href="https://community.withairbnb.com/t5/Get-Local/ct-p/en_clubs" theme="[object Object]">
                            <div class="_3hmsj">
                                <div class="_1lejuyz"><svg viewBox="0 0 32 32" xmlns="http://www.w3.org/2000/svg" aria-hidden="true" role="presentation" focusable="false" style="display: block; height: 24px; width: 24px; fill: currentcolor;"><path d="M26 1a5 5 0 0 1 4.995 4.783L31 6v10.68a5 5 0 0 1-4.783 4.995l-.217.004a5 5 0 0 1-4.783 4.996l-.217.004-3.782-.001-3.718 4.364-3.72-4.364-3.78.001a5 5 0 0 1-4.981-4.562l-.014-.22L1 21.678V11a5 5 0 0 1 4.783-4.995L6 6a5 5 0 0 1 4.783-4.995L11 1h15zm-5 7H6a3 3 0 0 0-2.995 2.824L3 11v10.68a3 3 0 0 0 2.824 2.994L6 24.68h4.705l2.794 3.278 2.795-3.278H21a3 3 0 0 0 2.995-2.823L24 21.68V11a3 3 0 0 0-3-3zm-1 10v2H6v-2h14zm6-15H11a3 3 0 0 0-2.995 2.824L8 6h13a5 5 0 0 1 4.995 4.783L26 11v8.68a3 3 0 0 0 2.995-2.824l.005-.177V6a3 3 0 0 0-2.824-2.995L26 3zM15 13v2H6v-2h9z"></path></svg></div>
                            </div>
                            <div class="_ojs7nk">Connect with Hosts near you</div>
                        </a>
                        <a class="_1lqi869l" href="/resources/hosting-homes" theme="[object Object]">
                            <div class="_3hmsj">
                                <div class="_1lejuyz"><svg viewBox="0 0 32 32" xmlns="http://www.w3.org/2000/svg" aria-hidden="true" role="presentation" focusable="false" style="display: block; height: 24px; width: 24px; fill: currentcolor;"><path d="M25 3a2 2 0 0 1 1.995 1.85L27 5v2h2a2 2 0 0 1 1.995 1.85L31 9v17a3 3 0 0 1-3 3H4a3 3 0 0 1-2.995-2.824L1 26V5a2 2 0 0 1 1.85-1.995L3 3zm4 6h-2v17a1 1 0 0 0 1.993.117L29 26zm-4-4H3v21a1 1 0 0 0 .883.993L4 27h21zM13 21v2H7v-2zm8 0v2h-6v-2zm-8-4v2H7v-2zm8 0v2h-6v-2zm0-8v6H7V9zm-2 2H9v2h10z"></path></svg></div>
                            </div>
                            <div class="_ojs7nk">Explore hosting resources</div>
                        </a>
                        <a class="_1lqi869l" href="/help/hosting" theme="[object Object]">
                            <div class="_3hmsj">
                                <div class="_1lejuyz"><svg viewBox="0 0 32 32" xmlns="http://www.w3.org/2000/svg" aria-hidden="true" role="presentation" focusable="false" style="display: block; height: 24px; width: 24px; fill: currentcolor;"><path d="m16 1a15 15 0 1 0 15 15 15.017 15.017 0 0 0 -15-15zm0 28a13 13 0 1 1 13-13 13.01474 13.01474 0 0 1 -13 13zm1.5-5.5a1.5 1.5 0 1 1 -1.5-1.5 1.5 1.5 0 0 1 1.5 1.5zm4.0791-11.5c0 2.52832-1.69336 4.57764-4.57226 5.58984l-.00684 2.41309-2-.00586.01025-3.90723.73487-.20068c1.15283-.31445 3.834-1.32324 3.834-3.88916a3.189 3.189 0 0 0 -3.44775-3.16846 3.6753 3.6753 0 0 0 -3.53516 2.72071l-1.92285-.55079a5.65909 5.65909 0 0 1 5.458-4.16992 5.19687 5.19687 0 0 1 5.44774 5.16846z"></path></svg></div>
                            </div>
                            <div class="_ojs7nk">Get help</div>
                        </a>
                        <div class="_1a7n56z">
                            <div class="_ipygq"></div>
                        </div>
                        <div class="_17rwvlx">Settings</div>
                        <a class="_1lqi869l" href="/account-settings/preferences" theme="[object Object]">
                            <div class="_3hmsj">
                                <div class="_1lejuyz"><svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 32 32" aria-hidden="true" role="presentation" focusable="false" style="display: block; height: 24px; width: 24px; fill: currentcolor;"><path d="M16 1c8.284 0 15 6.716 15 15 0 8.284-6.716 15-15 15-8.284 0-15-6.716-15-15C1 7.716 7.716 1 16 1zm4.398 21.001h-8.796C12.488 26.177 14.23 29 16 29c1.77 0 3.512-2.823 4.398-6.999zm-10.845 0H4.465a13.039 13.039 0 0 0 7.472 6.351c-1.062-1.58-1.883-3.782-2.384-6.351zm17.982 0h-5.088c-.5 2.57-1.322 4.77-2.384 6.352A13.042 13.042 0 0 0 27.535 22zM9.238 12H3.627A12.99 12.99 0 0 0 3 16c0 1.396.22 2.74.627 4h5.61A33.063 33.063 0 0 1 9 16c0-1.383.082-2.724.238-4zm11.502 0h-9.482A30.454 30.454 0 0 0 11 16c0 1.4.092 2.743.26 4.001h9.48C20.908 18.743 21 17.4 21 16a30.31 30.31 0 0 0-.26-4zm7.632 0h-5.61c.155 1.276.237 2.617.237 4s-.082 2.725-.238 4h5.61A12.99 12.99 0 0 0 29 16c0-1.396-.22-2.74-.627-4zM11.937 3.647l-.046.016A13.04 13.04 0 0 0 4.464 10h5.089c.5-2.57 1.322-4.77 2.384-6.353zM16 3l-.129.005c-1.725.133-3.405 2.92-4.269 6.995h8.796C19.512 5.824 17.77 3 16 3zm4.063.648l.037.055C21.144 5.28 21.952 7.46 22.447 10h5.089a13.039 13.039 0 0 0-7.473-6.352z"></path></svg></div>
                            </div>
                            <div class="_ojs7nk">Language and translation</div>
                        </a>
                        <a class="_1lqi869l" href="/account-settings/preferences" theme="[object Object]">
                            <div class="_3hmsj">
                                <div class="_1lejuyz"><svg viewBox="0 0 32 32" xmlns="http://www.w3.org/2000/svg" aria-hidden="true" role="presentation" focusable="false" style="display: block; height: 24px; width: 24px; fill: currentcolor;"><path d="M25 4a2 2 0 0 1 1.995 1.85L27 6v2h2.04c1.042 0 1.88.824 1.955 1.852L31 10v16c0 1.046-.791 1.917-1.813 1.994L29.04 28H6.96c-1.042 0-1.88-.824-1.955-1.852L5 26v-2H3a2 2 0 0 1-1.995-1.85L1 22V6a2 2 0 0 1 1.85-1.995L3 4zm2 18a2 2 0 0 1-1.85 1.995L25 24H7v2h22V10h-2zM25 6H3v16h22zm-3 12a1 1 0 1 1 0 2 1 1 0 0 1 0-2zm-8-8a4 4 0 1 1 0 8 4 4 0 0 1 0-8zm0 2a2 2 0 1 0 0 4 2 2 0 0 0 0-4zM6 8a1 1 0 1 1 0 2 1 1 0 0 1 0-2z"></path></svg></div>
                            </div>
                            <div class="_ojs7nk">$ USD</div>
                        </a>
                        <div class="_1a7n56z">
                            <div class="_ipygq"></div>
                        </div>
                        <div class="_23gp2n"><a href="/mobile" class="_erlr5pz">Download the app</a></div>
                        <div class="_23gp2n"><a href="/" class="_erlr5pz">Switch to traveling</a></div>
                        <div class="_23gp2n"><a href="/host/experiences" class="_erlr5pz">Host an Experience</a></div>
                        <div class="_23gp2n"><a href="/host/experiences" class="_erlr5pz">Logout</a></div>
                    </ul>
                </div>
            </div>
        </div>
        <!-- End of Menu Bar-->  
				
		<script src="../../assets/js/bootstrap.bundle.min.js"></script>
		<script src="../../assets/js/jquery-3.6.1.min.js"></script>
		<script src="../../assets/js/custom.js"></script>
	</body>
</html>
