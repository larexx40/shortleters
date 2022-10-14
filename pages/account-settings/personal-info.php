<!DOCTYPE html>
<html lang="en">
	<head>
		<meta charset="utf-8" />
		<meta name="viewport" content="width=device-width, initial-scale=1" />
		<title>Personal Info</title>
		<link
			href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.1/dist/css/bootstrap.min.css"
			rel="stylesheet"
			integrity="sha384-iYQeCzEYFbKjA/T2uDLTpkwGzCiq6soy8tYaI1GyVh/UjpbCx/TYkiZhlZB6+fzT"
			crossorigin="anonymous" />
		<link rel="stylesheet" href="../../assets/fonts/bootstrap-icons.css" />
		<link rel="stylesheet" href="../../assets/css/layout.css" />
		<link rel="stylesheet" href="../../assets/css/footer.css" />
		<link rel="stylesheet" href="../../assets/css/nav.css" />
	</head>
	
	<style>
			.header-inner {
				border: none !important;
			}
			.container {
				max-width: 1140px;
			}
			main.container {
				display: flex;
				flex-direction: column;
				align-items: flex-start;
				row-gap: 2rem;
				width: 100%;
			}
			.page-title h2 {
				font-weight: bold;
			}
			.page-inner {
				width: 100%;
			}
			.page-inner .form-wrapper {
				display: flex;
				align-items: flex-start;
				flex-direction: column;
				row-gap: 10px;
			}
			.page-inner h4 {
				font-weight: 600;
			}
			.page-inner form {
				width: 100%;
				margin-top: 2rem;
			}
			.page-inner > .row {
				row-gap: 3rem;
			}

			/* content wrapper */
			.content-wrapper {
				border: 1px solid rgb(228, 228, 228);
				padding: 24px;
				border-radius: 1rem;
			}
			.content-wrapper-inner {
				margin: 0px;
				background-color: rgb(255, 255, 255);
				display: flex;
				align-items: flex-start;
				row-gap: 2em;
				flex-direction: column;
			}
			.each-content {
				display: flex;
				align-items: flex-start;
				flex-direction: column;
				-ms-flex-direction: column;
				row-gap: 1.5rem;
				padding: 1.2rem 0 1.5rem;
			}
			.each-form-content {
				display: flex;
				align-items: flex-start;
				flex-direction: column;
				-ms-flex-direction: column;
				row-gap: 0.7rem;
				width: 100%;
				border-bottom: 1px solid #ebebeb;
				padding-bottom: 1.3rem;
				margin-top: 0.8rem;
			}
			.each-form-content strong {
				font-size: 1.1rem;
			}
			.each-form-content.variant {
				display: flex;
				flex-direction: row;
			}
			.each-form-content.variant .title-button {
				display: flex;
				flex-direction: column;
				align-items: flex-start;
			}
			.each-form-content .title-button {
				display: flex;
				align-items: center;
				justify-content: space-between;
				width: 100%;
			}
			* .each-form-content button {
				font-size: 1rem;
				color: #000;
				font-weight: 600;
				text-decoration: underline;
			}
			.each-content.border--top {
				border-top: 1px solid rgb(221, 221, 221) !important;
			}
			:is(.breadcrumb-item, .breadcrumb-item a) {
				color: #484871;
			}
			.breadcrumb-item a {
				font-weight: 600;
				color: #000;
				font-size: 1rem;
			}
			.breadcrumb-item a:hover {
				text-decoration: underline;
			}
			/* modal form */
			.modal-body form {
				margin-top: 1.5rem;
			}
			.modal-body .form-select {
				min-height: 3rem;
				border-radius: 6px;
				font-size: 15px;
			}
			.modal-body .form-select:focus {
				box-shadow: none;
				border: 2px solid #008489;
			}
			.modal-body form .submit-btn {
				padding-top: 2rem;
			}
			.modal-body form button {
				background: rgba(0, 132, 137, 0.3);
				border-color: transparent;
				color: rgb(255, 255, 255);
				display: inline-block;
				padding: 10px 22px;
				min-width: 71.1935px;
				border-style: solid;
				border-color: transparent;
				border-radius: 4px;
				display: flex;
				align-items: center;
				font-weight: 600;
				justify-content: center;
			}
			.modal-body form button:hover {
				background: #008489;
				color: #fff;
			}
	</style>

	<body>
		<div id="user" v-cloak>
			<div class="body-wrapper">
				<header>
					<div class="header-inner">
						<div class="row col-12 m-0 align-items-center justify-content-around">
							<div class="p-0 col-md-1 col-lg-5 logo text-md-start d-none d-md-inline-flex">
								<div class="lg-screen-logo d-none d-lg-inline-flex">
									<a href="#">
										<img style="width:100%;" src="../assets/images/GREEN_LOGO_HORIZONTAL_1.png" /> 
									</a>
								</div>
								<div class="sm-screen-logo d-lg-none">
									<a href="#">
										<img style="width:100%;" src="../assets/images/GREEN_LOGO_VERTICAL_1.png" />
									</a>
								</div>
							</div>
							<div class="p-0 col-md-4 col-lg-5 menu d-none d-md-inline-flex justify-content-md-end">
								<div class="end-tabs">
									<div class="host">
										<a href="#" class="host-link"><span>Become a Host</span></a>
										<a href="#" class="host-icon"><em class="bi bi-globe"></em></a>
									</div>
									<div class="menu-link">
										<div class="dropdown">
											<button class="dropdown-toggle" type="button" data-bs-toggle="dropdown" aria-expanded="false">
												<div class="svg">
													<svg
														xmlns="http://www.w3.org/2000/svg"
														width="16"
														height="16"
														preserveAspectRatio="xMidYMid meet"
														viewBox="0 0 24 24">
														<path
															fill="currentColor"
															d="M2 6a1 1 0 0 1 1-1h18a1 1 0 1 1 0 2H3a1 1 0 0 1-1-1Zm0 6.032a1 1 0 0 1 1-1h18a1 1 0 1 1 0 2H3a1 1 0 0 1-1-1Zm1 5.032a1 1 0 1 0 0 2h18a1 1 0 0 0 0-2H3Z" />
													</svg>
												</div>
												<div class="user-icon">
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
												<li><a class="dropdown-item" href="#">Messages</a></li>
												<li><a class="dropdown-item" href="#">Notifications</a></li>
												<li><a class="dropdown-item" href="#">Trips</a></li>
												<li><a class="dropdown-item" href="#">Wishlists</a></li>
												<div class="sub-menu-links">
													<li><a class="dropdown-item" href="#">Host your Home</a></li>
													<li><a class="dropdown-item" href="#">Host an experience</a></li>
													<li><a class="dropdown-item" href="#">Account</a></li>
												</div>
												<div class="sub-menu-links">
													<li><a class="dropdown-item" href="#">Help</a></li>
													<li><a class="dropdown-item" href="#">Log out</a></li>
												</div>
											</ul>
										</div>
									</div>
								</div>
							</div>
						</div>
					</div>
				</header>

				<main class="container justify-content-center" style="margin: auto; margin-bottom: 60px; margin-top: 120px">
					<!-- bread crumbs -->
					<nav style="--bs-breadcrumb-divider: '>'" aria-label="breadcrumb">
						<ol class="breadcrumb">
							<li class="breadcrumb-item"><a href="#">Account</a></li>
							<li class="breadcrumb-item active" aria-current="page">Personal info</li>
						</ol>
					</nav>
					<!-- breadcrumbs end -->
					<div class="page-title">
						<h2>Personal info</h2>
					</div>
					<div class="page-inner">
						<div class="row align-items-start justify-content-between m-0">
							<div v-if='userDetails' class="form-wrapper col-md-7 p-0">
								<div class="each-form-content">
									<div class="title-button">
										<strong>Legal name</strong>
										<button type="button" class="" data-bs-toggle="modal" data-bs-target="#editName">Edit</button>
									</div>
									<div class="value"><span>{{userDetails.fullname}}</span></div>
								</div>
								<div class="each-form-content">
									<div class="title-button">
										<strong>Gender</strong>
										<button type="button" class="" data-bs-toggle="modal" data-bs-target="#editGender">Edit</button>
									</div>
									<div class="value"><span>{{userDetails.gender}}</span></div>
								</div>
								<div class="each-form-content">
									<div class="title-button">
										<strong>Date of birth</strong>
										<button type="button" class="" data-bs-toggle="modal" data-bs-target="#editDOB">Edit</button>
									</div>
									<div class="value"><span>{{userDetails.dob}}</span></div>
								</div>
								<div class="each-form-content">
									<div class="title-button">
										<strong>Email address</strong>
										<!-- <button type="button" class="" data-bs-toggle="modal" data-bs-target="#currency">Edit</button> -->
									</div>
									<div class="value"><span>{{userDetails.Email}}</span></div>
								</div>
								<div class="each-form-content variant">
									<div class="title-button">
										<strong>Phone numbers</strong>
										<div class="value">
											<span
												>Add a number so confirmed guests and Airbnb can get in touch. You can add other numbers and choose how
												they’re used.</span
											>
										</div>
									</div>
									<button type="button" class="" data-bs-toggle="modal" data-bs-target="#currency">Add</button>
								</div>
								<div class="each-form-content">
									<div class="title-button">
										<strong>Government Id</strong>
										<button type="button" class="" data-bs-toggle="modal" data-bs-target="#editValidid">Add</button>
									</div>
									<div class="value"><span>{{userDetails.identity}}</span></div>
								</div>
								<div class="each-form-content">
									<div class="title-button">
										<strong>Address</strong>
										<button type="button" class="" data-bs-toggle="modal" data-bs-target="#editAddress">Edit</button>
									</div>
									<div v-if='userDetails.address' class="value"><span>{{userDetails.address}}, {{userDetails.state}}, {{userDetails.country}}</span></div>
									<div v-else class="value"><span>Not provided</span></div>
								</div>
								<div class="each-form-content">
									<div class="title-button">
										<strong>Emergency contact</strong>
										<button type="button" class="" data-bs-toggle="modal" data-bs-target="#currency">Add</button>
									</div>
									<div class="value"><span>Not provided</span></div>
								</div>
							</div>
							<div class="content-wrapper col-md-4 d-none d-md-inline-flex">
								<div class="content-wrapper-inner">
									<div class="each-content">
										<div class="icon-wrapper">
											<svg
												viewBox="0 0 48 48"
												xmlns="http://www.w3.org/2000/svg"
												aria-hidden="true"
												role="presentation"
												focusable="false"
												style="display: block; height: 48px; width: 48px; fill: rgb(227, 28, 95); stroke: currentcolor">
												<g>
													<g stroke="none">
														<path
															d="M27 5l.585.005c4.29.076 8.837.984 13.645 2.737l.77.288V35.4l-.008.13a1 1 0 0 1-.47.724l-.116.06L27 42.716V25a1 1 0 0 0-.883-.993L26 24H12V8.029l.77-.286c4.797-1.75 9.336-2.658 13.62-2.737L27 5z"
															fill-opacity=".2"></path>
														<path
															d="M27 1c5.599 0 11.518 1.275 17.755 3.816a2 2 0 0 1 1.239 1.691L46 6.67V35.4a5 5 0 0 1-2.764 4.472l-.205.097-15.594 6.93L27 47l-2.461-1h2.451a.01.01 0 0 0 .007-.003L27 45.99v-1.085l15.218-6.763a3 3 0 0 0 1.757-2.351l.019-.194.006-.196V6.669l-.692-.278C37.557 4.128 32.121 3 27 3S16.443 4.128 10.692 6.391L10 6.67 9.999 24H8V6.669a2 2 0 0 1 1.098-1.786l.147-.067C15.483 2.275 21.401 1 27 1z"></path>
													</g>
													<g fill="none" stroke-width="2">
														<path
															d="M4 24h22a1 1 0 0 1 1 1v20.99a.01.01 0 0 1-.01.01H4a1 1 0 0 1-1-1V25a1 1 0 0 1 1-1z"></path>
														<path d="M21 25v-5a6 6 0 1 0-12 0v5"></path>
														<circle cx="15" cy="35" r="2"></circle>
													</g>
												</g>
											</svg>
										</div>
										<div class="title">
											<strong>Why isn’t my info shown here?</strong>
										</div>
										<div class="body"><span>We’re hiding some account details to protect your identity.</span></div>
									</div>
									<div class="each-content border--top">
										<div class="icon-wrapper">
											<svg
												viewBox="0 0 48 48"
												xmlns="http://www.w3.org/2000/svg"
												aria-hidden="true"
												role="presentation"
												focusable="false"
												style="display: block; height: 48px; width: 48px; fill: rgb(227, 28, 95); stroke: currentcolor">
												<g stroke="none">
													<path d="m39 15.999v28.001h-30v-28.001z" fill-opacity=".2"></path>
													<path
														d="m24 0c5.4292399 0 9.8479317 4.32667079 9.9961582 9.72009516l.0038418.27990484v2h7c1.0543618 0 1.9181651.8158778 1.9945143 1.8507377l.0054857.1492623v32c0 1.0543618-.8158778 1.9181651-1.8507377 1.9945143l-.1492623.0054857h-34c-1.0543618 0-1.91816512-.8158778-1.99451426-1.8507377l-.00548574-.1492623v-32c0-1.0543618.81587779-1.9181651 1.85073766-1.9945143l.14926234-.0054857h7v-2c0-5.5228475 4.4771525-10 10-10zm17 14h-34v32h34zm-17 14c1.6568542 0 3 1.3431458 3 3s-1.3431458 3-3 3-3-1.3431458-3-3 1.3431458-3 3-3zm0 2c-.5522847 0-1 .4477153-1 1s.4477153 1 1 1 1-.4477153 1-1-.4477153-1-1-1zm0-28c-4.3349143 0-7.8645429 3.44783777-7.9961932 7.75082067l-.0038068.24917933v2h16v-2c0-4.418278-3.581722-8-8-8z"></path>
												</g>
											</svg>
										</div>
										<div class="title">
											<strong>Which details can be edited?</strong>
										</div>
										<div class="body">
											<span
												>Details Airbnb uses to verify your identity can’t be changed. Contact info and some personal details can
												be edited, but we may ask you verify your identity the next time you book or create a listing.</span
											>
										</div>
									</div>
									<div class="each-content border--top">
										<div class="icon-wrapper">
											<svg
												viewBox="0 0 48 48"
												xmlns="http://www.w3.org/2000/svg"
												aria-hidden="true"
												role="presentation"
												focusable="false"
												style="display: block; height: 48px; width: 48px; fill: rgb(227, 28, 95); stroke: currentcolor">
												<g stroke="none">
													<path
														d="M24 9C14.946 9 7.125 15.065 4.74 23.591L4.63 24l.013.054c2.235 8.596 9.968 14.78 18.99 14.943L24 39c9.053 0 16.875-6.064 19.26-14.59l.11-.411-.013-.052c-2.234-8.597-9.968-14.78-18.99-14.944L24 9z"
														fill-opacity=".2"></path>
													<path
														d="M24 5c11.18 0 20.794 7.705 23.346 18.413l.133.587-.133.587C44.794 35.295 35.181 43 24 43 12.82 43 3.206 35.295.654 24.588l-.133-.587.048-.216C2.985 12.884 12.69 5 24 5zm0 2C13.88 7 5.16 13.887 2.691 23.509l-.12.492.032.14c2.288 9.564 10.728 16.513 20.65 16.846l.377.01L24 41c10.243 0 19.052-7.056 21.397-16.861l.031-.14-.031-.138c-2.288-9.566-10.728-16.515-20.65-16.848l-.377-.01L24 7zm0 10a7 7 0 1 1 0 14 7 7 0 0 1 0-14zm0 2a5 5 0 1 0 0 10 5 5 0 0 0 0-10z"></path>
												</g>
											</svg>
										</div>
										<div class="title">
											<strong>What info is shared with others?</strong>
										</div>
										<div class="body">
											<span>Airbnb only releases contact information for Hosts and guests after a reservation is confirmed.</span>
										</div>
									</div>
								</div>
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

				<footer class="pt-5 mb-0 mt-5 position-static d-none d-md-block" style="background-color: #f7f7f7; border-top: 1px solid #dddddd">
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
							<!-- <li class="ms-3">
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
							</li> -->
						</ul>
					</div>
				</footer>

				<!-- modalllllllsssssssss -->

				<!--EditName Modal -->
				<div class="modal fade" id="editName" tabindex="-1" aria-labelledby="lang-modal" aria-hidden="true">
					<div class="modal-dialog modal-dialog-centered">
						<div v-if= 'userDetails' class="modal-content">
							<div class="modal-header">
								<h5 class="modal-title" id="lang-modal">Edit Fullname</h5>
								<button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
							</div>
							<div class="modal-body">
								<div class="pre">
									<h6>Legal name</h6>
									<small>This is the name on your travel document, which could be a license or a passport.</small>
								</div>
								<form @submit.prevent="updateUserInfo">
									<div class="form-floating">
										<input
											type="text"
											class="form-control"
											id="floatingInputValue1"
											v-model="userDetails.Firstname" />
										<label for="floatingInputValue1">Firstname</label>
									</div>
									<br>
									<div class="form-floating">
										<input
											type="text"
											class="form-control"
											id="floatingInputValue1"
											v-model="userDetails.Lastname" />
										<label for="floatingInputValue1">Lastname</label>
									</div>						
									
									
									<div class="submit-btn">
										<button type="submit" class="btn" style="background-color: #000; color: #fff; padding: 14px 1.8rem">Save</button>
									</div>
								</form>
							</div>
						</div>
					</div>
				</div>
				<!-- EditGender Modal -->
				<div class="modal fade" id="editGender" tabindex="-1" aria-labelledby="currency-modal" aria-hidden="true">
					<div class="modal-dialog modal-dialog-centered">
						<div v-if= 'userDetails' class="modal-content">
							<div class="modal-header">
								<h5 class="modal-title" id="currency-modal">Edit Gender</h5>
								<button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
							</div>
							<div class="modal-body">
								<form @submit.prevent='updateUserInfo' action="" method="">
									<div class="form-input">
						    			<label class="form-label" for="currency_tag">Gender</label>
										<select v-model='userDetails.sex 'class="form-select" aria-label="Default select example" required>
											<option value="">Select Gender</option>
											<option value="1">Male</option>
											<option value="2">Female</option>
											<option value="3">Others</option>
										</select>
									</div>
									<div class="submit-btn">
										<button>Save</button>
									</div>
								</form>
							</div>
						</div>
					</div>
				</div>
				<!--EditDOB Modal -->
				<div class="modal fade" id="editDOB" tabindex="-1" aria-labelledby="lang-modal" aria-hidden="true">
					<div class="modal-dialog modal-dialog-centered">
						<div v-if= 'userDetails' class="modal-content">
							<div class="modal-header">
								<h5 class="modal-title" id="lang-modal">Edit Date of Birth</h5>
								<button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
							</div>
							<div class="modal-body">
								
								<form @submit.prevent='updateUserInfo' action="" method="" >
									<div >
										<label for="floatingInputValue1">DOB</label>
										<input type="date" v-model="userDetails.dob" class="form-control" data-date-format="yyyy-mm-dd" placeholder="yyyy-mm-dd">
										<!-- <input
											type="text"
											class="form-control"
											id="floatingInputValue1"
											v-model="userDetails.Firstname" />
										<label for="floatingInputValue1">DOB</label> -->
									</div>
									<div class="submit-btn">
										<button class="btn" style="background-color: #000; color: #fff; padding: 14px 1.8rem">Save</button>
									</div>
								</form>
							</div>
						</div>
					</div>
				</div>
				<!-- Currency Modal -->
				<div class="modal fade" id="currency" tabindex="-1" aria-labelledby="currency-modal" aria-hidden="true">
					<div class="modal-dialog modal-dialog-centered">
						<div v-if= 'userDetails' class="modal-content">
							<div class="modal-header">
								<h5 class="modal-title" id="currency-modal">Preference currency</h5>
								<button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
							</div>
							<div class="modal-body">
								<form @submit.prevent='updateDetails()' action="" method="">
									<div class="form-input">
										<select class="form-select" aria-label="Default select example">
											<option selected>Open this select menu</option>
											<option value="1">One</option>
											<option value="2">Two</option>
											<option value="3">Three</option>
										</select>
									</div>
									<div class="submit-btn">
										<button>Save</button>
									</div>
								</form>
							</div>
						</div>
					</div>
				</div>
				<!--EditValidid Modal -->
				<div class="modal fade" id="editValidid" tabindex="-1" aria-labelledby="lang-modal" aria-hidden="true">
					<div class="modal-dialog modal-dialog-centered">
						<div v-if= 'userDetails' class="modal-content">
							<div class="modal-header">
								<h5 class="modal-title" id="lang-modal">Upload Valid Identity</h5>
								<button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
							</div>
							<div class="modal-body">
								<div class="pre">
									<h6>Legal name</h6>
									<small>This is the name on your travel document, which could be a license or a passport.</small>
								</div>
								<form @submit.prevent="addValidIdentity">
									<div class="form-floating">
										<input
											type="text"
											class="form-control"
											id="floatingInputValue1"
											v-model="identity_no" />
										<label for="floatingInputValue1">Identity id</label>
									</div>
									<br>
									
									<div class="form-input">
										<label class="form-label" for="currency_tag">Identity Type</label>
										<select v-model="user_validid_type" class="form-select" aria-label="Default select example">
											<option value="null" >Select an Identity Card</option>
											<option value="NIMC">NIN Slip / Card</option>
											<option value="Voters Card">Voters Card</option>
											<option value="Valid Id card">Valid Id card</option>
											<option value="International Passport">International Passport</option>
										</select>
									</div><br>

                                    <div class="form-input">
                                        <label class="form-label" for="quantity-add">Identity Image</label>
                                        <div class="form-control-wrap">        
                                            <div class="form-file">            
                                                <input type="file" @change='uploadImage' class="form-file-input" id="customFile">         
                                            </div>    
                                        </div>
                                        <!-- <input type="text" v-model="amenities_icon" class="form-control" id="quantity-add" placeholder="Quantity"> -->
                                    </div>
									
									
									<div class="submit-btn">
										<button type="submit" class="btn" style="background-color: #000; color: #fff; padding: 14px 1.8rem">Save</button>
									</div>
								</form>
							</div>
						</div>
					</div>
				</div>
				<!--EditAddress Modal -->
				<div class="modal fade" id="editAddress" tabindex="-1" aria-labelledby="lang-modal" aria-hidden="true">
					<div class="modal-dialog modal-dialog-centered">
						<div v-if= 'userDetails' class="modal-content">
							<div class="modal-header">
								<h5 class="modal-title" id="lang-modal">Edit Your Address</h5>
								<button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
							</div>
							<div class="modal-body">
								<div class="pre">
									<h6>Legal name</h6>
									<small>This is the name on your travel document, which could be a license or a passport.</small>
								</div>
								<form @submit.prevent="updateUserInfo">
									<div class="form-floating">
										<input
											type="text"
											class="form-control"
											id="floatingInputValue1"
											v-model="userDetails.address" />
										<label for="floatingInputValue1">Street Address</label>
									</div>
									<br>
									<div class="form-floating">
										<input
											type="text"
											class="form-control"
											id="floatingInputValue1"
											v-model="userDetails.state" />
										<label for="floatingInputValue1">State</label>
									</div><br>	
									<div class="form-floating">
										<input
											type="text"
											class="form-control"
											id="floatingInputValue1"
											v-model="userDetails.country" />
										<label for="floatingInputValue1">Country</label>
									</div>
									<br>
									<div class="form-floating">
										<input
											type="number"
											class="form-control"
											id="floatingInputValue1"
											v-model="userDetails.zipcode" />
										<label for="floatingInputValue1">Zip Code</label>
									</div>
									<br>					
									
									
									<div class="submit-btn">
										<button type="submit" class="btn" style="background-color: #000; color: #fff; padding: 14px 1.8rem">Save</button>
									</div>
								</form>
							</div>
						</div>
					</div>
				</div>
			</div>
		</div>

		<script src="../../assets/js/bootstrap.min.js"></script>
		<script src="../../assets/js/bootstrap.bundle.min.js"></script>
		<script src="../../assets/js/jquery-3.6.1.min.js"></script>
		<script src="../../assets/js/custom.js"></script>
		<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>
		
		<script src="https://unpkg.com/axios/dist/axios.min.js"></script>
		<script src="https://unpkg.com/vue@3"></script>
		<script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>
		<script src="../js/toasteur.min.js"></script>
		<script src="../../vuecode/user.js" ></script>
	</body>
</html>