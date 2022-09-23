<?php include "header.php"; ?>
    <!-- Page Title  -->
    <title>OneApp</title>
</head>

<body class="nk-body bg-lighter npc-general has-sidebar ">
    <div id="admin">
        <?php include "loading.php"; ?>
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
                                                <h3 class="nk-block-title page-title">OneApp</h3>
                                            </div><!-- .nk-block-head-content -->
                                            <div class="nk-block-head-content">
                                                <div class="toggle-wrap nk-block-tools-toggle">
                                                    <a href="#" class="btn btn-icon btn-trigger toggle-expand me-n1" data-target="pageMenu"><em class="icon ni ni-more-v"></em></a>
                                                    <div class="toggle-expand-content" data-content="pageMenu">
                                                        <ul class="nk-block-tools g-3">
                                                            <li>
                                                                <div class="form-control-wrap">
                                                                    <div class="form-icon form-icon-right">
                                                                        <em class="icon ni ni-search"></em>
                                                                    </div>
                                                                    <input type="text" class="form-control" id="default-04" @keyup='getAllOneapp(4)' v-model ='search' placeholder="Quick search by api name">
                                                                </div>
                                                            </li>
                                                            <li>
                                                                <div class="drodown">
                                                                    <a href="#" class="dropdown-toggle dropdown-indicator btn btn-outline-light btn-white" data-bs-toggle="dropdown">Status</a>
                                                                    <div class="dropdown-menu dropdown-menu-end">
                                                                        <ul class="link-list-opt no-bdr">
                                                                            <li @click.prevent ="noSort(0)"><a href=""><span>All</span></a></li>
                                                                            <li @click.prevent ="sortByStatus(1)"><a href=""><span>Active</span></a></li>
                                                                            <li @click.prevent ="sortByStatus(0)"><a href=""><span>Inactive</span></a></li>
                                                                        </ul>
                                                                    </div>
                                                                </div>
                                                            </li>
                                                            <li class="nk-block-tools-opt">
                                                                <a href="#" class="btn btn-icon btn-primary d-md-none"><em class="icon ni ni-plus"></em></a>
                                                                <a class="btn btn-primary d-none d-md-inline-flex" data-bs-toggle="modal" href="#addModal"><em class="icon ni ni-plus"></em><span>Add</span></a>
                                                            </li>
                                                        </ul>
                                                    </div>
                                                </div>
                                            </div><!-- .nk-block-head-content -->
                                        </div><!-- .nk-block-between -->
                                    </div><!-- .nk-block-head -->
                                    <div class="nk-block">
                                        <div class="nk-tb-list is-separate is-medium mb-3">
                                            <div class="nk-tb-item nk-tb-head">
                                                <!-- <div class="nk-tb-col nk-tb-col-check">
                                                    <div class="custom-control custom-control-sm custom-checkbox notext">
                                                        <input type="checkbox" class="custom-control-input" id="oid">
                                                        <label class="custom-control-label" for="oid"></label>
                                                    </div>
                                                </div> -->
                                                <div class="nk-tb-col"><span>Name</span></div>
                                                <div class="nk-tb-col tb-col-md"><span>Api Key</span></div>
                                                <div class="nk-tb-col"><span class="d-none d-sm-block">Secret Key</span></div>
                                                <div class="nk-tb-col tb-col-sm"><span>Status</span></div>
                                                <div class="nk-tb-col nk-tb-col-tools">
                                                    <ul class="nk-tb-actions gx-1 my-n1">
                                                        <!-- <li>
                                                            <div class="drodown">
                                                                <a href="#" class="dropdown-toggle btn btn-icon btn-trigger" data-bs-toggle="dropdown"><em class="icon ni ni-more-h"></em></a>
                                                                <div class="dropdown-menu dropdown-menu-end">
                                                                    <ul class="link-list-opt no-bdr">
                                                                        <li><a href="#"><em class="icon ni ni-mail"></em><span>Send Email to All</span></a></li>
                                                                        <li><a href="#"><em class="icon ni ni-na"></em><span>Suspend Selected</span></a></li>
                                                                        <li><a href="#"><em class="icon ni ni-trash"></em><span>Remove Seleted</span></a></li>
                                                                    </ul>
                                                                </div>
                                                            </div>
                                                        </li> -->
                                                    </ul>
                                                </div>
                                                <!-- <div class="nk-tb-col nk-tb-col-tools">
                                                    <ul class="nk-tb-actions gx-1 my-n1">
                                                        <li>
                                                            <div class="drodown">
                                                                <a href="#" class="dropdown-toggle btn btn-icon btn-trigger mame-n1" data-bs-toggle="dropdown" aria-expanded="false"><em class="icon ni ni-more-h"></em></a>
                                                                <div class="dropdown-menu dropdown-menu-end" >
                                                                    <ul class="link-list-opt no-bdr">
                                                                        <li><a href="#"><em class="icon ni ni-edit"></em><span>Update Status</span></a></li>
                                                                        <li><a href="#"><em class="icon ni ni-truck"></em><span>Mark as Delivered</span></a></li>
                                                                        <li>
                                                                            <a href="#" data-bs-toggle="dropdown"><em class="icon ni ni-truck" ></em><span>Mark as Delivered</span></a>
                                                                            <div class="dropdown-menu dropdown-menu-end" >
                                                                                <ul class="link-list-opt no-bdr">
                                                                                    <li><a href="#"><em class="icon ni ni-money"></em><span>Mark as Paid</span></a></li>
                                                                                    <li><a href="#"><em class="icon ni ni-money"></em><span>Mark as Paid</span></a></li>
                                                                                </ul>
                                                                            </div>
                                                                        </li>

                                                                        <li class="nk-menu-item has-sub">
                                                                            <a href="#" class="nk-menu-link nk-menu-toggle" data-bs-original-title="" title="">
                                                                                <span class="nk-menu-icon"><em class="icon ni ni-package-fill"></em></span>
                                                                                <span class="nk-menu-text">Products</span>
                                                                            </a>
                                                                            
                                                                        </li>
                                                                        
                                                                        <li><a href="#"><em class="icon ni ni-report-profit"></em><span>Send Invoice</span></a></li>
                                                                        <li><a href="#"><em class="icon ni ni-trash"></em><span>Remove Orders</span></a></li>
                                                                    </ul>
                                                                </div>
                                                            </div>
                                                        </li>
                                                    </ul>
                                                </div> -->
                                            </div><!-- .nk-tb-item -->
                                            <div v-if= 'oneApps' v-for ='(item, index) in oneApps' class="nk-tb-item">
                                                <!-- <div class="nk-tb-col nk-tb-col-check">
                                                    <div class="custom-control custom-control-sm custom-checkbox notext">
                                                        <input type="checkbox" class="custom-control-input" id="oid01">
                                                        <label class="custom-control-label" for="oid01"></label>
                                                    </div>
                                                </div> -->
                                                <div class="nk-tb-col">
                                                    <span class="tb-lead"><a href="#">{{item.name}}</a></span>
                                                </div>
                                                <div class="nk-tb-col tb-col-md">
                                                    <span class="tb-sub">{{item.apikey}}</span>
                                                </div>
                                                <div class="nk-tb-col tb-col-sm">
                                                    <span class="tb-sub">{{item.secretekey}}</span>
                                                </div>
                                                <div class="nk-tb-col tb-col-md">
                                                    <span v-if='item.status === "Inactive" || item.status == "0" ' class="badge badge-sm badge-dot has-bg bg-danger d-none d-sm-inline-flex">{{item.status}}</span>
                                                    <span v-if='item.status === "Active" || item.status == "1" ' class="badge badge-sm badge-dot has-bg bg-success d-none d-sm-inline-flex">{{item.status}}</span>
                                                </div>
                                                <div class="nk-tb-col nk-tb-col-tools">
                                                    <ul class="nk-tb-actions gx-1">
                                                        <li>
                                                            <div class="drodown me-n1">
                                                                <a href="#" class="dropdown-toggle btn btn-icon btn-trigger" data-bs-toggle="dropdown"><em class="icon ni ni-more-h"></em></a>
                                                                <div class="dropdown-menu dropdown-menu-end">
                                                                    <ul class="link-list-opt no-bdr">
                                                                        <li @click.prevent = 'getIndex(index)'><a data-bs-toggle="modal" href="#viewModal"><em class="icon ni ni-eye"></em><span>View Details</span></a></li>
                                                                        <li @click.prevent = 'changeOneappStatus(item.id)' v-if='item.status === "Inactive" || item.status == "0"'><a href="#"><em class="icon ni ni-report-profit"></em><span>Set Active</span></a></li>
                                                                        <li @click.prevent = 'changeOneappStatus(item.id)' v-if='item.status === "Active" || item.status == "1" ' ><a href="#"><em class="icon ni ni-report-loss"></em><span>Set Inactive</span></a></li>
                                                                        <li @click.prevent = 'getIndex(index)'><a data-bs-toggle="modal" href="#editModal"><em class="icon ni ni-edit"></em><span>Edit</span></a></li>
                                                                        <li @click.prevent= 'deleteByid(item.id)'><a href="#"><em class="icon ni ni-trash"></em><span>Delete</span></a></li>
                                                                    </ul>
                                                                </div>
                                                            </div>
                                                        </li>
                                                    </ul>
                                                </div>
                                            </div><!-- .nk-tb-item -->
                                            <div v-else  >No Item Found </div>
                                            
                                        </div><!-- .nk-tb-list -->
                                        <div class="card">
                                            <div class="card-inner">
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
                                                            <a v-on:click.prevent="nextPage()" class="page-link"><em class="icon ni ni-chevrons-right"></em></a>
                                                        </li>
                                                        <li v-else class="page-item disabled">
                                                            <a class="page-link"><em class="icon ni ni-chevrons-right"></em></a>
                                                        </li>
                                                    </ul>
                                                    <!-- .pagination -->
                                                    </div>
                                                    <!-- .pagination-goto -->
                                                </div><!-- .nk-block-between -->
                                            </div>
                                        </div>
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
		<div class="modal fade " id="addModal" style="padding-left: 0px;" aria-modal="true" role="dialog">
			<div class="modal-dialog" role="document">
			<div class="modal-content">
				<div class="modal-header">
					<h5 class="modal-title">Add OneApp</h5>
					<a href="#" class="close" data-bs-dismiss="modal" aria-label="Close"><em class="icon ni ni-cross"></em></a>
				</div>
				<div class="modal-body">
					<form action=""  @submit.prevent='addOneapp' id= 'addLocation'>
						<div class="form-group">
						<label class="form-label" for="full-name">Name</label>
						<div class="form-control-wrap"><input type="text" v-model= "apiName" class="form-control" id="full-name" required=""></div>
						</div>
						<div class="form-group">
						<label class="form-label" for="">Api Key</label>
						<div class="form-control-wrap"><input type="text" v-model= "apiKey" class="form-control" id="email-address" required=""></div>
						</div>
						<div class="form-group">
						<label class="form-label" for="phone-no">Secret Key</label>
						<div class="form-control-wrap"><input type="text" v-model= "secretKey" class="form-control" id="phone-no"></div>
						</div>
						<div class="form-group"><button data-bs-dismiss="modal" type="submit" class="btn btn-lg btn-primary">Add OneApp</button></div>
					</form>
				</div>
				<div class="modal-footer bg-light"><span class="sub-text">Modal Footer Text</span></div>
			</div>
			</div>
		</div>
        <!--View Modal-->
		<div  class="modal fade" tabindex="-1" id="viewModal" aria-modal="true" role="dialog">
			<div class="modal-dialog modal-lg" role="document">
				<div class="modal-content">
					<div class="modal-header">
						<h5 class="modal-title">OneApp Details</h5>
						<a href="#" class="close" data-bs-dismiss="modal" aria-label="Close">
							<em class="icon ni ni-cross"></em>
						</a>
					</div>
					<div v-if='itemDetails' class="modal-body">
						<div class="card h-100">
							
							<div class="nk-tb-list is-compact">
								<div class="nk-tb-item nk-tb-head">
									<div class="nk-tb-col"><span>Name</span></div>
									<div class="nk-tb-col text-end" ><span >{{itemDetails.name}}</span></div>
								</div><!-- .nk-tb-head -->
								
								<div class="nk-tb-item">
									<div class="nk-tb-col">
										<span class="tb-sub"><span>Api Key</span></span>
									</div>
									<div class="nk-tb-col text-end">
										<span class="tb-sub tb-amount" ><span>{{itemDetails.apikey}}</span></span>
									</div>
								</div><!-- .nk-tb-item -->
                                <div class="nk-tb-item">
									<div class="nk-tb-col">
										<span class="tb-sub"><span>Secret Key</span></span>
									</div>
									<div class="nk-tb-col text-end">
										<span class="tb-sub tb-amount" ><span>{{itemDetails.secretekey}}</span></span>
									</div>
								</div><!-- .nk-tb-item -->
								<div class="nk-tb-item">
									<div class="nk-tb-col">
										<span class="tb-sub"><span>Status</span></span>
									</div>
									<div class="nk-tb-col text-end">
										<span v-if='itemDetails.status === "active" || itemDetails.status === "Active" || itemDetails.status == "1" ' class="text-success" ><span>{{itemDetails.status}}</span></span>
                                        <span v-if='itemDetails.status === "inactive" || itemDetails.status === "Inactive" || itemDetails.status == "0" ' class="text-danger" ><span>{{itemDetails.status}}</span></span>
									</div>
								</div><!-- .nk-tb-item -->
								<!-- .nk-tb-item -->
							</div><!-- .nk-tb-list -->
						</div></div>
					<div class="modal-footer bg-light">
						<span class="sub-text">Modal Footer Text</span>
					</div>
				</div>
			</div>
		</div>
        <!-- Edit Modal -->
        <div class="modal fade " id="editModal" style="padding-left: 0px;" aria-modal="true" role="dialog">
			<div class="modal-dialog" role="document">
			<div class="modal-content">
				<div class="modal-header">
					<h5 class="modal-title">Update Oneapp</h5>
					<a href="#" class="close" data-bs-dismiss="modal" aria-label="Close"><em class="icon ni ni-cross"></em></a>
				</div>
				<div class="modal-body">
					<form action=""  @submit.prevent='updateOneapp()' id= 'addLocation'>
						<div class="form-group">
						<label class="form-label" for="full-name">Name</label>
						<div class="form-control-wrap"><input type="text" v-if='itemDetails' v-model="itemDetails.name" class="form-control" id="full-name" required=""></div>
						</div>
						<div class="form-group">
						<label class="form-label" for="">Api Key</label>
						<div class="form-control-wrap"><input type="text" v-if='itemDetails' v-model="itemDetails.apikey" class="form-control" id="email-address" required=""></div>
						</div>
						<div class="form-group">
						<label class="form-label" for="phone-no">Secret Key</label>
						<div class="form-control-wrap"><input type="text" v-if='itemDetails' v-model="itemDetails.secretekey" class="form-control" ></div>
						</div>
						<div class="form-group"><button data-bs-dismiss="modal" type="submit" class="btn btn-lg btn-primary">Edit</button></div>
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