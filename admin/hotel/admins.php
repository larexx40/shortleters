<?php

use function Composer\Autoload\includeFile;

    include "header.php";
?>
    <title>Admin</title>
    <!-- StyleSheets  -->
    <link rel="stylesheet" href="../assets/css/dashlite.css?ver=3.0.3">
    <link id="skin-default" rel="stylesheet" href="../assets/css/theme.css?ver=3.0.3">
</head>

<body class="nk-body bg-lighter npc-general has-sidebar ">
    <div id="admin" v-cloak>
        <?php 
            include "loading.php"
        ?>
        <div class="nk-app-root">
        <!-- main @s -->
            <div class="nk-main ">
                <!-- sidebar @s -->
                <?php include "sidebar.php"; ?>
                <!-- sidebar @e -->
                <!-- wrap @s -->
                <div class="nk-wrap ">
                    <!-- main header @s -->
                    <?php include "content-header.php"; ?>
                    <!-- main header @e -->
                    <!-- content @s -->
                    <div class="nk-content ">
                        <div class="container-fluid">
                            <div class="nk-content-inner">
                                <div class="nk-content-body">
                                    <div class="nk-block-head nk-block-head-sm">
                                        <div class="nk-block-between">
                                            <div class="nk-block-head-content">
                                                <h3 class="nk-block-title page-title">Admins</h3>
                                            </div>
                                            <div class="nk-block-head-content">
                                                <div class="toggle-wrap nk-block-tools-toggle">
                                                    <a href="#" class="btn btn-icon btn-trigger toggle-expand me-n1" data-target="more-options"><em class="icon ni ni-more-v"></em></a>
                                                    <div class="toggle-expand-content" data-content="more-options">
                                                        <ul class="nk-block-tools g-3">
                                                            <li>
                                                                <div class="form-control-wrap">
                                                                    <div class="form-icon form-icon-right">
                                                                        <em class="icon ni ni-search"></em>
                                                                    </div>
                                                                    <input v-model='search' type="text" @keyup='getAllAdmin(4)' class="form-control" id="default-04" placeholder="Search by name">
                                                                </div>
                                                            </li>
                                                            <li>
                                                                <div class="drodown">
                                                                    <a href="#" class="dropdown-toggle dropdown-indicator btn btn-outline-light btn-white" data-bs-toggle="dropdown">Status</a>
                                                                    <div class="dropdown-menu dropdown-menu-end">
                                                                        <ul class="link-list-opt no-bdr">
                                                                            <li  @click.prevent = 'noSort()'><a href="#"><span>All</span></a></li>
                                                                            <li @click.prevent = 'sortByStatus(1)'><a href="#"><span>Active</span></a></li>
                                                                            <li @click.prevent = 'sortByStatus(0)'><a href="#"><span>Banned</span></a></li>
                                                                            <li @click.prevent = 'sortByStatus(2)'><a href="#"><span>Suspended</span></a></li>
                                                                            <li @click.prevent = 'sortByStatus(3)'><a href="#"><span>Frozen</span></a></li>
                                                                        </ul>
                                                                    </div>
                                                                </div>
                                                            </li>
                                                            <li class="nk-block-tools-opt">
                                                                <a href="#" class="btn btn-icon btn-primary d-md-none"><em class="icon ni ni-plus"></em></a>
                                                                <a v-if='superAdmin == "yes" || superAdmin == "Yes" || superAdmin == "1" ' class="btn btn-primary d-none d-md-inline-flex" data-bs-toggle="modal" href="#addAdminModal"><em class="icon ni ni-plus"></em><span>Add</span></a>
                                                            </li>
                                                        </ul>
                                                    </div>
                                                </div>
                                            </div><!-- .nk-block-head-content -->
                                        </div><!-- .nk-block-between -->
                                    </div><!-- .nk-block-head -->
                                    <div class="nk-block">
                                        <div class="card">
                                            <div class="card-inner-group">
                                                <div class="card-inner p-0">
                                                    <div class="nk-tb-list nk-tb-ulist">
                                                        <div class="nk-tb-item nk-tb-head">
                                                            <!-- <div class="nk-tb-col nk-tb-col-check">
                                                                <div class="custom-control custom-control-sm custom-checkbox notext">
                                                                    <input type="checkbox" class="custom-control-input" id="uid">
                                                                    <label class="custom-control-label" for="uid"></label>
                                                                </div>
                                                            </div> -->
                                                            <div class="nk-tb-col"><span class="sub-text">Name</span></div>
                                                            <div class="nk-tb-col tb-col-md"><span class="sub-text">Username</span></div>
                                                            <div class="nk-tb-col tb-col-md"><span class="sub-text">Status</span></div>
                                                            <div class="nk-tb-col tb-col-lg"><span class="sub-text">Superadmin</span></div>
                                                            <div class="nk-tb-col nk-tb-col-tools">
                                                                
                                                            </div>
                                                        </div><!-- .nk-tb-item -->
                                                        <div v-if='admins' v-for ='(value, index) in admins' class="nk-tb-item">
                                                            <!-- <div class="nk-tb-col nk-tb-col-check">
                                                                <div class="custom-control custom-control-sm custom-checkbox notext">
                                                                    <input type="checkbox" class="custom-control-input" id="uid1">
                                                                    <label class="custom-control-label" for="uid1"></label>
                                                                </div>
                                                            </div> -->
                                                            <div class="nk-tb-col">
                                                                <a @click.prevent='getUserid(value.id)' href="./admin-details.php">
                                                                    <div class="user-card">
                                                                        <div class="user-avatar bg-primary">
                                                                            <span>{{value.initials}}</span>
                                                                        </div>
                                                                        <div class="user-info">
                                                                            <span class="tb-lead">{{value.name}} <span class="dot dot-success d-md-none ms-1"></span></span>
                                                                            <span>{{value.email}}</span>
                                                                        </div>
                                                                    </div>
                                                                </a>
                                                            </div>
                                                            <div class="nk-tb-col tb-col-md">
                                                                <span v-if ='value.username'>{{value.username}}</span>
                                                            </div>
                                                            <div class="nk-tb-col tb-col-md">
                                                                <span class="tb-status">{{value.status}}</span>
                                                            </div>
                                                            <div class="nk-tb-col tb-col-lg">
                                                                <span v-if ='value.superAdmin == "no" || value.superAdmin == "No" || value.superAdmin == "0" ' class="tb-status text-success">{{value.superAdmin }} </span>
                                                                <span v-if ='value.superAdmin == "yes" || value.superAdmin == "Yes" || value.superAdmin == "1" ' class="tb-status text-danger">{{value.superAdmin }} </span>
                                                            </div>
                                                            <div class="nk-tb-col nk-tb-col-tools">
                                                                <ul class="nk-tb-actions gx-1">
                                                                    <li>
                                                                        <div class="drodown">
                                                                            <a href="#" class="dropdown-toggle btn btn-icon btn-trigger" data-bs-toggle="dropdown"><em class="icon ni ni-more-h"></em></a>
                                                                            <div class="dropdown-menu dropdown-menu-end">
                                                                               
                                                                                <ul class="link-list-opt no-bdr">
                                                                                    <li @click.prevent='getUserid(value.id)'><a href="./admins-details.php"><em class="icon ni ni-eye"></em><span>View Details</span></a></li>
                                                                                    <!-- <li><a href="#"><em class="icon ni ni-activity-round"></em><span>Set as SuperAdmin</span></a></li> -->
                                                                                    <li  @click.prevent='changeAdminStatus(value.id, 0)' v-if='value.statusCode != 0' ><a href="#"><em class="icon fa-solid fa-ban"></em><span>Ban</span></a></li>
                                                                                    <li @click.prevent='changeAdminStatus(value.id, 1)' v-if='value.statusCode != 1' style="--hover-color: var(--bs-success)"><a href="#"><em class="icon fa-solid fa-toggle-on"></em><span>Activate</span></a></li>
                                                                                    <li @click.prevent='changeAdminStatus(value.id, 2)' v-if='value.statusCode != 2' style="--hover-color: var(--bs-warning)"><a href="#"><em class="icon fa-solid fa-pause"></em><span>Suspend</span></a></li>
                                                                                    <li @click.prevent='changeAdminStatus(value.id, 3)' v-if='value.statusCode != 3'><a href="#"><em class="icon fa-solid fa-user-lock"></em><span>Freeze</span></a></li>
                                                                                </ul>
                                                                                
                                                                            </div>
                                                                        </div>
                                                                    </li>
                                                                </ul>
                                                            </div>
                                                        </div><!-- .nk-tb-item -->
                                                        <div v-else class="nk-tb-item">No record found </div>
                                                        
                                                    </div><!-- .nk-tb-list -->
                                                </div>
                                                <div v-if='admins' class="card-inner">
                                                    <div class="nk-block-between-md g-3">
                                                        <div class="g">
                                                        <ul class="pagination justify-content-end">
                                                            <li v-if="currentPage == 1" class="page-item disabled">
                                                                <a class="page-link"><em class="icon ni ni-chevrons-left"></em></a>
                                                            </li>
                                                            <li v-else class="page-item">
                                                                <a @click.prevent="previousPage()" class="page-link"><em class="icon ni ni-chevrons-left"></em></a>
                                                            </li>
                                                            <li class="page-item"><a class="page-link">{{currentPage}} of {{totalPage}}</a></li>
                                                            <li v-if="currentPage < totalPage" class="page-item">
                                                                <a @click.prevent="nextPage()" class="page-link"><em class="icon ni ni-chevrons-right"></em></a>
                                                            </li>
                                                            <li v-else class="page-item disabled">
                                                                <a class="page-link"><em class="icon ni ni-chevrons-right"></em></a>
                                                            </li>
                                                        </ul><!-- .pagination -->
                                                        </div>
                                                        <!-- <div class="g">
                                                            <div class="pagination-goto d-flex justify-content-center justify-content-md-start gx-3">
                                                                <div>Page</div>
                                                                <div>
                                                                    <select class="form-select js-select2 select2-hidden-accessible" data-search="on" data-dropdown="xs center" data-select2-id="1" tabindex="-1" aria-hidden="true">
                                                                        <option value="page-1" data-select2-id="3">1</option>
                                                                        <option value="page-2">2</option>
                                                                        <option value="page-4">4</option>
                                                                        <option value="page-5">5</option>
                                                                        <option value="page-6">6</option>
                                                                        <option value="page-7">7</option>
                                                                        <option value="page-8">8</option>
                                                                        <option value="page-9">9</option>
                                                                    </select>
                                                                </div>
                                                                <div>OF 102</div>
                                                            </div>
                                                        </div> -->
                                                        <!-- .pagination-goto -->
                                                    </div><!-- .nk-block-between -->
                                                </div>
                                                <!--card inner-->
                                            </div>
                                        </div>
                                        <!--card-->
                                    </div><!-- .nk-block -->
                                </div>
                            </div>
                        </div>
                    </div>
                    <!-- content @e -->
                    <!-- footer @s -->
                    <?php include "content-footer.php"; ?>
                    <!-- footer @e -->
                </div>
                <!-- wrap @e -->
            </div>
        <!-- main @e -->
        </div>

        <!-- Add Modal (Information Modal) -->
		<div class="modal fade " id="addAdminModal" style="padding-left: 0px;" aria-modal="true" role="dialog">
			<div class="modal-dialog" role="document">
			<div class="modal-content">
				<div class="modal-header">
					<h5 class="modal-title">Add admin</h5>
					<a href="#" class="close" data-bs-dismiss="modal" aria-label="Close"><em class="icon ni ni-cross"></em></a>
				</div>
				<div class="modal-body">
					<form action=""  @submit.prevent='addadmin()' id= 'addLocation'>
						<div class="form-group">
						<label class="form-label" for="full-name">admin Name</label>
						<div class="form-control-wrap"><input type="text" v-model= "adminName" class="form-control" id="full-name" required=""></div>
						</div>
						<div class="form-group">
						<label class="form-label" for="email-address">Email</label>
						<div class="form-control-wrap"><input type="text" v-model= "adminEmail" class="form-control" id="email-address" required=""></div>
						</div>
						<div class="form-group">
						<label class="form-label" for="password">Password</label>
						<div class="form-control-wrap"><input type="password" v-model= "newPassword" class="form-control" id="phone-no"></div>
                        
						</div>
						<div class="form-group"><button data-bs-dismiss="modal" type="submit" class="btn btn-lg btn-primary">Add admin</button></div>
					</form>
				</div>
				<div class="modal-footer bg-light"><span class="sub-text">Modal Footer Text</span></div>
			</div>
			</div>
		</div>
   </div>
    <!-- app-root @e -->
    <!-- JavaScript -->
    <script src="../assets/js/bundle.js?ver=3.0.3"></script>
    <script src="../assets/js/scripts.js?ver=3.0.3"></script>
    <?php include "vue-script.php"; ?>
</body>

</html>