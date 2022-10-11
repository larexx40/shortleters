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
		<title>Manage Your Space</title>
	</head>
	<style>
		.content-image .image img {
			border-radius: 10px;
			overflow: hidden;
		}
		.content-image .content {
			display: flex;
			flex-direction: column;
			row-gap: 10px;
		}
		.content-image .content button {
			color: black;
			border-radius: 0.6rem;
			border: 1px solid #000;
			width: max-content;
			padding: 5px 1rem;
		}
		.content-image .content span {
			color: #7a7171;
			font-size: 14px;
		}
		.other-image-tags a.role-button {
			color: black;
			border-radius: 0.6rem;
			border: 1px solid #000;
			width: max-content;
			padding: 6px 1.2rem;
		}
		.other-image-tags input#file-image {
			display: none;
		}
		.other-image-tags .image-wrapper {
			display: grid;
			grid-template-columns: repeat(3, 1fr);
			gap: 2em;
		}
		.other-image-tags .image-wrapper img {
			border-radius: 5px;
			min-height: 215px;
		}
		.other-image-tags .image-container > a.add-caption {
			text-decoration: underline;
			color: #000;
			font-size: 15px;
		}
		.image-container.has-dashed-borders .custom-file-input {
			border: 1px dashed #000;
		}
		.custom-file-input svg {
			width: 3rem;
			height: 3rem;
		}
		.other-image-tags .image-container.has-dashed-borders input {
			display: none;
		}
		* .modal .modal-body > div {
			justify-content: space-between;
		}
		* .modal .image-container img {
			max-width: 580px;
			border-radius: 12px;
		}
		* .modal .some-tabs-and-pills {
			width: 350px;
		}
		.modal .some-tabs-and-pills .form-control:focus {
			border: 2px solid #000;
			box-shadow: none;
		}
		.modal:has(.some-tabs-and-pills) .nav-pills .nav-link {
			margin-right: 1.5rem;
		}
		.modal:has(.some-tabs-and-pills) .nav-pills .nav-link:hover {
			background-color: transparent;
		}
		.modal:has(.some-tabs-and-pills) .nav-pills .nav-link.active {
			width: max-content;
			background-color: transparent;
			border-radius: 0;
			border-bottom: 2px solid #000;
		}
		.modal .some-tabs-and-pills textarea.form-control {
			min-height: calc(5rem + 5rem);
		}
		.modal .grid-image-wrapper {
			display: grid;
			grid-template-columns: repeat(3, 1fr);
			column-gap: 1rem;
			row-gap: 1rem;
		}
		.modal:has(.grid-image-wrapper) .modal-footer button.update-photo {
			text-decoration: underline;
			color: #000;
			font-size: 1rem;
		}
		.modal.modal:has(.grid-image-wrapper) img {
			border-radius: 5px;
			width: 300px;
		}
		a.back-to-prev {
			display: flex;
			align-items: center;
			column-gap: 1rem;
			color: #000;
			font-size: 1rem;
			margin-bottom: 1rem;
			font-weight: 600;
		}
		a.back-to-prev em::before {
			font-weight: 900 !important;
		}
		@media all and (max-width: 768px) {
			.other-image-tags .image-wrapper {
				grid-template-columns: 1fr 1fr;
				margin-bottom: 3rem;
			}
			.nav-pills .nav-link.active,
			.nav-pills .show > .nav-link {
				background: transparent;
				border: 1px solid #000;
				color: #fff;
				background-color: #000;
				padding-right: 2rem;
				padding-left: 2rem;
			}
			.content-image .content {
				margin-top: 2rem;
			}
		}
		@media all and (max-width: 600px) {
			.content-image {
				flex-direction: column;
				row-gap: 2rem;
			}
			.other-image-tags .image-wrapper {
				grid-template-columns: 1fr;
				margin-bottom: 3rem;
			}
			._reigil {
				flex-direction: column;
				row-gap: 1rem;
				margin-bottom: 2rem;
			}
		}
	</style>

	<body>
		<div class="body-wrapper">
			<header class="d-flex align-items-center">
				<div class="header-inner d-flex align-items-center w-100 justify-content-between px-md-5 px-3">
					<div class="first-div">
						<div class="lg-screen-logo">
							<a href="#">
								<img style="width:100%;" src="../assets/images/GREEN_LOGO_HORIZONTAL_1.png" /> 
							</a>
						</div>
					</div>
					<div class="second-div">
						<div class="end-tabs">
							<ul class="host d-none d-lg-flex gap-5">
								<li>
									<a href="./index.html" class="host-link"><span>Today</span></a>
								</li>
								<li>
									<a href="./message.html" class="host-link"><span>Inbox</span></a>
								</li>
								<li>
									<a href="./onboarding/index.html" class="host-link"><span>Calendar</span></a>
								</li>
								<li>
									<a href="./insights.html" class="host-link"><span>Insights</span></a>
								</li>
								<li class="dropdown menu-link w-auto h-auto border-0 d-block p-0" style="border: none">
									<a href="#" class="host-link dropdown-toggle" data-bs-toggle="dropdown" aria-expanded="false"
										><span>Menu</span></a
									>
									<ul class="dropdown-menu">
										<li><a class="dropdown-item" href="./listing.html">Listing</a></li>
										<li><a class="dropdown-item active" href="./reservations.html">Reservations</a></li>
										<li><a class="dropdown-item" href="./onboarding/index.html">Create a new listing</a></li>
										<div class="sub-menu-links">
											<li><a class="dropdown-item" href="./transactions.html">Transaction History</a></li>
											<li><a class="dropdown-item" href="./community.html">Connect with Hosts near you.</a></li>
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
					<a href="./update-onboarding.html" class="back-to-prev"><em class="bi bi-chevron-left"></em><span>Back</span></a>
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
								Photos
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
									<div class="content-image row align-items-start">
										<div class="content col">
											<b>Cover photo</b>
											<span>Your cover photo is a guest's first impression of your listing</span>
											<br />
											<button data-bs-toggle="modal" data-bs-target="#change-photo">Change photo</button>
										</div>
										<div class="image col">
											<img src="../../assets/images/cb5e0e48-0e8d-4101-af49-12e72d8e30ab.jpg" alt="" class="img-fluid" />
										</div>
									</div>
									<br />
									<hr />
									<br />
									<div class="other-image-tags">
										<div class="title">
											<div class="d-flex justify-content-between align-items-start">
												<div class="d-grid">
													<label class="_14i3z6h mb-0">All photos</label>
													<small class="text-truncate" style="color: #7a7171"
														>Drag and drop your photos to change the order.</small
													>
												</div>
												<form action="">
													<a
														href="#"
														class="role-button"
														id="role-button"
														role="button"
														data-bs-toggle="modal"
														data-bs-target="#"
														>Upload photos</a
													>
													<input type="file" id="file-image" />
												</form>
											</div>
										</div>
										<div class="mt-5 pt-3">
											<div class="image-wrapper">
												<!-- each image start -->
												<div class="image-container position-relative">
													<div class="image-layer">
														<img
															src="../../assets/images/0af6ce14-581c-4056-aa6b-58f4b267816b.jfif"
															alt=""
															class="img-fluid" />
													</div>
													<div class="dropdown">
														<button
															class="position-absolute"
															type="button"
															data-bs-toggle="dropdown"
															aria-expanded="false">
															<em class="three-dots-vertical"></em>
														</button>
														<ul class="dropdown-menu">
															<li><a class="dropdown-item" href="#">Action</a></li>
															<li><a class="dropdown-item" href="#">Another action</a></li>
															<li><a class="dropdown-item" href="#">Something else here</a></li>
														</ul>
													</div>
													<a href="#" role="button" class="add-caption" data-bs-target="#each-image" data-bs-toggle="modal"
														>Add caption</a
													>
												</div>
												<!-- each image ends-->
												<!-- each image start -->
												<div class="image-container position-relative">
													<div class="image-layer">
														<img
															src="../../assets/images/cb5e0e48-0e8d-4101-af49-12e72d8e30ab.jpg"
															alt=""
															class="img-fluid" />
													</div>
													<div class="dropdown">
														<button
															class="position-absolute"
															type="button"
															data-bs-toggle="dropdown"
															aria-expanded="false">
															<em class="three-dots-vertical"></em>
														</button>
														<ul class="dropdown-menu">
															<li><a class="dropdown-item" href="#">Action</a></li>
															<li><a class="dropdown-item" href="#">Another action</a></li>
															<li><a class="dropdown-item" href="#">Something else here</a></li>
														</ul>
													</div>
													<a href="#" role="button" class="add-caption" data-bs-target="#each-image" data-bs-toggle="modal"
														>Add caption</a
													>
												</div>
												<!-- each image ends-->
												<!-- each image start -->
												<div class="image-container position-relative">
													<div class="image-layer">
														<img
															src="../../assets/images/2c5bb7b8-a775-4edb-8e97-eeb5b72283e0.jpeg"
															alt=""
															class="img-fluid" />
													</div>
													<div class="dropdown">
														<button
															class="position-absolute"
															type="button"
															data-bs-toggle="dropdown"
															aria-expanded="false">
															<em class="three-dots-vertical"></em>
														</button>
														<ul class="dropdown-menu">
															<li><a class="dropdown-item" href="#">Action</a></li>
															<li><a class="dropdown-item" href="#">Another action</a></li>
															<li><a class="dropdown-item" href="#">Something else here</a></li>
														</ul>
													</div>
													<a href="#" role="button" class="add-caption" data-bs-target="#each-image" data-bs-toggle="modal"
														>Add caption</a
													>
												</div>
												<!-- each image ends-->
												<!-- each image start -->
												<div class="image-container position-relative">
													<div class="image-layer">
														<img
															src="../../assets/images/e52597a0-a7cb-46bd-9218-eab08e304d46.jpeg"
															alt=""
															class="img-fluid" />
													</div>
													<div class="dropdown">
														<button
															class="position-absolute"
															type="button"
															data-bs-toggle="dropdown"
															aria-expanded="false">
															<em class="three-dots-vertical"></em>
														</button>
														<ul class="dropdown-menu">
															<li><a class="dropdown-item" href="#">Action</a></li>
															<li><a class="dropdown-item" href="#">Another action</a></li>
															<li><a class="dropdown-item" href="#">Something else here</a></li>
														</ul>
													</div>
													<a href="#" role="button" class="add-caption" data-bs-target="#each-image" data-bs-toggle="modal"
														>Add caption</a
													>
												</div>
												<!-- each image ends-->
												<!-- each image start -->
												<div class="image-container position-relative">
													<div class="image-layer">
														<img
															src="../../assets/images/f5910bd8-1140-46cf-b357-f6bbaa78b2a7.jpg"
															alt=""
															class="img-fluid" />
													</div>
													<div class="dropdown">
														<button
															class="position-absolute"
															type="button"
															data-bs-toggle="dropdown"
															aria-expanded="false">
															<em class="three-dots-vertical"></em>
														</button>
														<ul class="dropdown-menu">
															<li><a class="dropdown-item" href="#">Action</a></li>
															<li><a class="dropdown-item" href="#">Another action</a></li>
															<li><a class="dropdown-item" href="#">Something else here</a></li>
														</ul>
													</div>
													<a href="#" role="button" class="add-caption" data-bs-target="#each-image" data-bs-toggle="modal"
														>Add caption</a
													>
												</div>
												<!-- each image ends-->
												<!-- each image start -->
												<div class="image-container has-dashed-borders">
													<input type="file" id="border-file-input" />
													<div
														class="custom-file-input"
														style="
															display: flex;
															align-items: center;
															justify-content: center;
															height: 215px;
															border-radius: 6px;
															flex-direction: column;
														">
														<svg
															xmlns="http://www.w3.org/2000/svg"
															width="1em"
															height="1em"
															preserveAspectRatio="xMidYMid meet"
															viewBox="0 0 512 512">
															<g transform="translate(512 0) scale(-1 1)">
																<rect
																	width="416"
																	height="352"
																	x="48"
																	y="80"
																	fill="none"
																	stroke="currentColor"
																	stroke-linejoin="round"
																	stroke-width="32"
																	rx="48"
																	ry="48" />
																<circle
																	cx="336"
																	cy="176"
																	r="32"
																	fill="none"
																	stroke="currentColor"
																	stroke-miterlimit="10"
																	stroke-width="32" />
																<path
																	fill="none"
																	stroke="currentColor"
																	stroke-linecap="round"
																	stroke-linejoin="round"
																	stroke-width="32"
																	d="m304 335.79l-90.66-90.49a32 32 0 0 0-43.87-1.3L48 352m176 80l123.34-123.34a32 32 0 0 1 43.11-2L464 368" />
															</g>
														</svg>
														<a href="#" role="button" style="color: #000; font-size: 15px">Add more</a>
													</div>
												</div>
												<!-- each image ends-->
											</div>
										</div>
									</div>
								</section>
							</div>
							<!-- end of each tab pane -->
						</div>
					</div>
				</div>
			</main>
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

			<div class="modal fade" id="each-image" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
				<div class="modal-dialog modal-xl modal-dialog-center">
					<div class="modal-content">
						<div class="modal-header">
							<h6 class="modal-title" id="exampleModalLabel">Edit photo</h6>
							<button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
						</div>
						<form action="">
							<div class="modal-body">
								<div class="d-flex align-items-center">
									<div class="image-container">
										<img src="../../assets/images/cb5e0e48-0e8d-4101-af49-12e72d8e30ab.jpg" alt="" class="img-flud" />
									</div>
									<div class="some-tabs-and-pills">
										<ul class="nav nav-pills mb-3" id="pills-tab" role="tablist">
											<li class="nav-item" role="presentation">
												<button
													class="nav-link active"
													id="pills-details-tab"
													data-bs-toggle="pill"
													data-bs-target="#pills-details"
													type="button"
													role="tab"
													aria-controls="pills-details"
													aria-selected="true">
													Details
												</button>
											</li>
											<li class="nav-item" role="presentation">
												<button
													class="nav-link"
													id="pills-edit-tab"
													data-bs-toggle="pill"
													data-bs-target="#pills-edit"
													type="button"
													role="tab"
													aria-controls="pills-edit"
													aria-selected="false">
													Edit
												</button>
											</li>
										</ul>
										<div class="tab-content" id="pills-tabContent">
											<div
												class="tab-pane fade show active"
												id="pills-details"
												role="tabpanel"
												aria-labelledby="pills-details-tab"
												tabindex="0">
												<div class="context">
													<span class="title">Caption</span>
													<small
														>Mention what’s special about this space like comfortable furniture or favorite
														details.</small
													>
													<div class="mb-3">
														<textarea class="form-control" rows="3"></textarea>
													</div>
												</div>
											</div>
											<div class="tab-pane fade" id="pills-edit" role="tabpanel" aria-labelledby="pills-edit-tab" tabindex="0">
												...
											</div>
										</div>
									</div>
								</div>
							</div>
							<div class="modal-footer">
								<button type="button" class="cancel" data-bs-dismiss="modal">Delete photo</button>
								<button type="button" class="save">Save</button>
							</div>
						</form>
					</div>
				</div>
			</div>
			<div class="modal fade" id="change-photo" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
				<div class="modal-dialog modal-xl modal-dialog-center">
					<div class="modal-content">
						<div class="modal-header">
							<h6 class="modal-title" id="exampleModalLabel">Select a cover photo</h6>
							<button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
						</div>
						<form action="">
							<div class="modal-body">
								<div class="d-flex align-items-center">
									<div class="grid-image-wrapper">
										<div class="img">
											<img src="../../assets/images/cb5e0e48-0e8d-4101-af49-12e72d8e30ab.jpg" alt="" class="img-fluid" />
										</div>
										<div class="img">
											<img src="../../assets/images/cb5e0e48-0e8d-4101-af49-12e72d8e30ab.jpg" alt="" class="img-fluid" />
										</div>
										<div class="img">
											<img src="../../assets/images/cb5e0e48-0e8d-4101-af49-12e72d8e30ab.jpg" alt="" class="img-fluid" />
										</div>
										<div class="img">
											<img src="../../assets/images/cb5e0e48-0e8d-4101-af49-12e72d8e30ab.jpg" alt="" class="img-fluid" />
										</div>
										<div class="img">
											<img src="../../assets/images/cb5e0e48-0e8d-4101-af49-12e72d8e30ab.jpg" alt="" class="img-fluid" />
										</div>
									</div>
								</div>
							</div>
							<div class="modal-footer">
								<div>
									<button class="update-photo">Update photo</button>
								</div>
								<div>
									<button
										type="button"
										class="cancel"
										data-bs-dismiss="modal"
										style="
											border: 1px solid #000;
											padding: 13px 23px;
											color: #000;
											border-radius: 8px;
											font-size: 1rem;
											text-decoration: none;
										">
										Cancel
									</button>
									<button
										type="button"
										class="save"
										style="border: 1px solid #000; padding: 13px 23px; border-radius: 8px; font-size: 1rem">
										Save
									</button>
								</div>
							</div>
						</form>
					</div>
				</div>
			</div>
		</div>
		<script src="../../assets/js/bootstrap.bundle.min.js"></script>
		<script src="../../assets/js/jquery-3.6.1.min.js"></script>
		<script src="../../assets/js/custom.js"></script>
	</body>
</html>
