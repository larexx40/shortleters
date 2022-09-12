<?php

    // send some CORS headers so the API can be called from anywhere
    header("Access-Control-Allow-Origin: *");
    header("Content-Type: application/json; charset=UTF-8");
    header("Access-Control-Allow-Methods: GET");// OPTIONS,GET,POST,PUT,DELETE
    header("Access-Control-Allow-Headers: Content-Type, Access-Control-Allow-Headers, Authorization, X-Requested-With");
    Header("Cache-Control: no-cache");
    // header("Access-Control-Max-Age: 3600");//3600 seconds
    // 1)private,max-age=60 (browser is only allowed to cache) 2)no-store(public),max-age=60 (all intermidiary can cache, not browser alone)  3)no-cache (no ceaching at all)

    include "../cartsfunction.php";

    $method = getenv('REQUEST_METHOD');
    $endpoint = basename($_SERVER['PHP_SELF']);
    $maindata=[];

    if($method =='GET'){
        //get company details to decode usertoken
        $detailsID =1;
        $getCompanyDetails = $connect->prepare("SELECT * FROM apidatatable WHERE id=?");
        $getCompanyDetails->bind_param('i', $detailsID);
        $getCompanyDetails->execute();
        $result = $getCompanyDetails->get_result();
        $companyDetails = $result->fetch_assoc();
        $companyprivateKey = $companyDetails['privatekey'];
        $minutetoend = $companyDetails['tokenexpiremin'];
        $serverName = $companyDetails['servername'];

        $decodeToken = ValidateAPITokenSentIN($serverName,$companyprivateKey,$method,$endpoint);
        $userPubKey = $decodeToken->usertoken;

        if (isset($_GET['sort'])) {
            $sort = cleanme($_GET['sort']); //sort if > 0
        } else {
            $sort = "";
        }
        if (isset($_GET['sortDraft'])) {
            $draftStatus = cleanme($_GET['sortDraft']); //draft =1 or 0
        } else {
            $draftStatus = "";
        }
        

        //sort with days
        if (isset($_GET['sortDays'] ) && is_numeric($_GET['sortDays']) ) {//draft =1 or 0
            $days =$_GET['sortDays'] ;
        } else {
            $days = '';
        }

        if (isset($_GET['search'])) {
            $search = cleanme($_GET['search']);
        } else {
            $search = "";
        }
    
        if (isset ($_GET['page']) ) { 
            if(!empty($_GET['page']) && is_numeric($_GET['page']) ){
                $page_no = $_GET['page']; 
            }else{
                $page_no = 1;
            }
        } else {  
            $page_no = 1;  
        }

        if (isset ($_GET['noPerPage']) ) {  
            if(!empty($_GET['noPerPage']) && is_numeric($_GET['noPerPage']) ){
                $noPerPage = $_GET['noPerPage']; 
            }else{
                $noPerPage =4;
            }
        } else {  
            $noPerPage =4;  
        } 
        $offset = ($page_no - 1) * $noPerPage;


        //check if its admin
        if(checkIfIsAdmin($connect, $userPubKey)){//admin can get all blog
            //get all blog content (sort with draft and/or days)
            if($sort > 0){
                //......sort with draft and/or days.......
                //if only draft passed 
                if(is_numeric($draftStatus) && !is_numeric($days)){//get where draft is passed
                    if (!empty($search) && $search!="" && $search!=' '){
                        //search productCategory from database get noOfpage for pagination 
                        $searchParam = "%{$search}%";
                        $searchQuery = "SELECT blog.`id`, blog.`adminid`, admin.name AS admin_name, blog.`dateadded`, blog.`blogimage`, blog.`blogheadline`, blog.`howmanyminread`, blog.`blogcontent`, blog.`draft` 
                                    FROM `blog` LEFT JOIN admin ON blog.adminid = admin.id 
                                    WHERE (blog.`blogheadline` Like ? OR admin.name like ? OR blog.`dateadded` like ? OR blog.`blogcontent` like ? OR blog.`howmanyminread` like ?) AND blog.draft = ?";
                        $stmt= $connect->prepare($searchQuery);
                        $stmt->bind_param("ssssss", $searchParam, $searchParam, $searchParam, $searchParam, $searchParam, $draftStatus);
                        $stmt->execute();
                        $result= $stmt->get_result();
                        $total_numRow = $result->num_rows;
                        $pages = ceil($total_numRow / $noPerPage);

                        $searchQuery = "$searchQuery ORDER BY blog.id DESC LIMIT ?,?";
                        $stmt= $connect->prepare($searchQuery);
                        $stmt->bind_param("ssssssss", $searchParam, $searchParam, $searchParam, $searchParam, $searchParam, $draftStatus, $offset, $noPerPage);
                        $stmt->execute();
                        $result= $stmt->get_result();
                        $numRow = $result->num_rows;  
                    
                    }else{
                        //get without search
                        $sqlQuery = "SELECT blog.`id`, blog.`adminid`, admin.name AS admin_name, blog.`dateadded`, blog.`blogimage`, blog.`blogheadline`, blog.`howmanyminread`, blog.`blogcontent`, blog.`draft` 
                                    FROM `blog` LEFT JOIN admin ON blog.adminid = admin.id
                                    WHERE blog.draft = ?";
                        $stmt= $connect->prepare($sqlQuery);
                        $stmt->bind_param("s", $draftStatus);
                        $stmt->execute();
                        $result= $stmt->get_result();
                        $total_numRow = $result->num_rows;
                        $pages = ceil($total_numRow / $noPerPage);

                        $sqlQuery = "$sqlQuery ORDER BY blog.id DESC LIMIT ?,?";
                        $stmt= $connect->prepare($sqlQuery);
                        $stmt->bind_param("sss", $draftStatus,$offset, $noPerPage);
                        $stmt->execute();
                        $result= $stmt->get_result();
                        $numRow = $result->num_rows; 

                    }

                }
                //if only days passed
                if(is_numeric($days) && !is_numeric($draftStatus)){//get where days is passed
                    if (!empty($search) && $search!="" && $search!=' '){
                        //search productCategory from database get noOfpage for pagination 
                        $searchParam = "%{$search}%";
                        $searchQuery = "SELECT blog.`id`, blog.`adminid`, admin.name AS admin_name, blog.`dateadded`, blog.`blogimage`, blog.`blogheadline`, blog.`howmanyminread`, blog.`blogcontent`, blog.`draft` 
                                    FROM `blog` LEFT JOIN admin ON blog.adminid = admin.id 
                                    WHERE (blog.`blogheadline` Like ? OR admin.name like ? OR blog.`dateadded` like ? OR blog.`blogcontent` like ? OR blog.`howmanyminread` like ?) AND FROM_UNIXTIME(blog.dateadded) >= (DATE(NOW()) - INTERVAL ? DAY)";
                        $stmt= $connect->prepare($searchQuery);
                        $stmt->bind_param("ssssss", $searchParam, $searchParam, $searchParam, $searchParam, $searchParam, $days);
                        $stmt->execute();
                        $result= $stmt->get_result();
                        $total_numRow = $result->num_rows;
                        $pages = ceil($total_numRow / $noPerPage);

                        $searchQuery = "$searchQuery ORDER BY blog.id DESC LIMIT ?,?";
                        $stmt= $connect->prepare($searchQuery);
                        $stmt->bind_param("ssssssss", $searchParam, $searchParam, $searchParam, $searchParam, $searchParam, $days, $offset, $noPerPage);
                        $stmt->execute();
                        $result= $stmt->get_result();
                        $numRow = $result->num_rows;  
                    
                    }else{
                        //get without search
                        $sqlQuery = "SELECT blog.`id`, blog.`adminid`, admin.name AS admin_name, blog.`dateadded`, blog.`blogimage`, blog.`blogheadline`, blog.`howmanyminread`, blog.`blogcontent`, blog.`draft` 
                                    FROM `blog` LEFT JOIN admin ON blog.adminid = admin.id
                                    WHERE FROM_UNIXTIME(blog.dateadded) >= (DATE(NOW()) - INTERVAL ? DAY)";
                        $stmt= $connect->prepare($sqlQuery);
                        $stmt->bind_param("s", $days);
                        $stmt->execute();
                        $result= $stmt->get_result();
                        $total_numRow = $result->num_rows;
                        $pages = ceil($total_numRow / $noPerPage);

                        $sqlQuery = "$sqlQuery ORDER BY blog.id DESC LIMIT ?,?";
                        $stmt= $connect->prepare($sqlQuery);
                        $stmt->bind_param("sss", $days,$offset, $noPerPage);
                        $stmt->execute();
                        $result= $stmt->get_result();
                        $numRow = $result->num_rows; 

                    }
                }
                //if draft and days passed
                if(is_numeric($draftStatus) && is_numeric($days)){//get where both draft and sort is passed
                    if (!empty($search) && $search!="" && $search!=' '){
                        //search productCategory from database get noOfpage for pagination 
                        $searchParam = "%{$search}%";
                        $searchQuery = "SELECT blog.`id`, blog.`adminid`, admin.name AS admin_name, blog.`dateadded`, blog.`blogimage`, blog.`blogheadline`, blog.`howmanyminread`, blog.`blogcontent`, blog.`draft` 
                                    FROM `blog` LEFT JOIN admin ON blog.adminid = admin.id 
                                    WHERE (blog.`blogheadline` Like ? OR admin.name like ? OR blog.`dateadded` like ? OR blog.`blogcontent` like ? OR blog.`howmanyminread` like ?) AND blog.draft = ? AND FROM_UNIXTIME(blog.dateadded) >= (DATE(NOW()) - INTERVAL ? DAY)";
                        $stmt= $connect->prepare($searchQuery);
                        $stmt->bind_param("sssssss", $searchParam, $searchParam, $searchParam, $searchParam, $searchParam, $draftStatus, $days);
                        $stmt->execute();
                        $result= $stmt->get_result();
                        $total_numRow = $result->num_rows;
                        $pages = ceil($total_numRow / $noPerPage);

                        $searchQuery = "$searchQuery ORDER BY blog.id DESC LIMIT ?,?";
                        $stmt= $connect->prepare($searchQuery);
                        $stmt->bind_param("sssssssss", $searchParam, $searchParam, $searchParam, $searchParam, $searchParam, $draftStatus, $days, $offset, $noPerPage);
                        $stmt->execute();
                        $result= $stmt->get_result();
                        $numRow = $result->num_rows;  
                    
                    }else{
                        //get without search
                        $sqlQuery = "SELECT blog.`id`, blog.`adminid`, admin.name AS admin_name, blog.`dateadded`, blog.`blogimage`, blog.`blogheadline`, blog.`howmanyminread`, blog.`blogcontent`, blog.`draft` 
                                    FROM `blog` LEFT JOIN admin ON blog.adminid = admin.id
                                    WHERE blog.draft = ? AND FROM_UNIXTIME(blog.dateadded) >= (DATE(NOW()) - INTERVAL ? DAY)";
                        $stmt= $connect->prepare($sqlQuery);
                        $stmt->bind_param("ss", $draftStatus, $days);
                        $stmt->execute();
                        $result= $stmt->get_result();
                        $total_numRow = $result->num_rows;
                        $pages = ceil($total_numRow / $noPerPage);

                        $sqlQuery = "$sqlQuery ORDER BY blog.id DESC LIMIT ?,?";
                        $stmt= $connect->prepare($sqlQuery);
                        $stmt->bind_param("ssss", $draftStatus,$days, $offset, $noPerPage);
                        $stmt->execute();
                        $result= $stmt->get_result();
                        $numRow = $result->num_rows; 

                    }
                }
                if(!is_numeric($draftStatus) && !is_numeric($days)){
                    $errordesc="Pass in draft or days";
                    $linktosolve="htps://";
                    $hint=["Ensure you pass a valid Email","Ensure that all data specified in the API is sent","Ensure that all data sent is not empty","Ensure that the exact data type specified in the documentation is sent."];
                    $errordata=returnError7003($errordesc,$linktosolve,$hint);
                    $text="pass in draft or days";
                    $method=getenv('REQUEST_METHOD');
                    $data=returnErrorArray($text,$method,$endpoint,$errordata);
                    respondBadRequest($data);
                }
                
            }else{
                //no need to sort
                if (!empty($search) && $search!="" && $search!=' '){
                    //search productCategory from database 
                    $searchParam = "%{$search}%";
                    $searchQuery = "SELECT blog.`id`, blog.`adminid`, admin.name AS admin_name, blog.`dateadded`, blog.`blogimage`, blog.`blogheadline`, blog.`howmanyminread`, blog.`blogcontent`, blog.`draft` 
                                FROM `blog` LEFT JOIN admin ON blog.adminid = admin.id 
                                WHERE blog.`blogheadline` Like ? OR admin.name like ? OR blog.`dateadded` like ? OR blog.`blogcontent` like ? OR blog.`howmanyminread` like ?";
                    $stmt= $connect->prepare($searchQuery);
                    $stmt->bind_param("sssss", $searchParam, $searchParam, $searchParam, $searchParam, $searchParam);
                    $stmt->execute();
                    $result= $stmt->get_result();
                    $total_numRow = $result->num_rows;
                    $pages = ceil($total_numRow / $noPerPage);
        
                    //paginate the fetch data
                    $searchQuery = "SELECT blog.`id`, blog.`adminid`, admin.name AS admin_name, blog.`dateadded`, blog.`blogimage`, blog.`blogheadline`, blog.`howmanyminread`, blog.`blogcontent`, blog.`draft` 
                                FROM `blog` LEFT JOIN admin ON blog.adminid = admin.id 
                                WHERE (blog.`blogheadline` Like ? OR admin.name like ? OR blog.`dateadded` like ? OR blog.`blogcontent` like ? OR blog.`howmanyminread` like ?) ORDER BY blog.id DESC LIMIT ?,?";
                    $stmt= $connect->prepare($searchQuery);
                    $stmt->bind_param("sssssss", $searchParam, $searchParam, $searchParam, $searchParam, $searchParam, $offset, $noPerPage);
                    $stmt->execute();
                    $result= $stmt->get_result();
                    $numRow = $result->num_rows;  
                }else {
                    //get all data
                    $sqlQuery = "SELECT blog.`id`, blog.`adminid`, admin.name AS admin_name, blog.`dateadded`, blog.`blogimage`, blog.`blogheadline`, blog.`howmanyminread`, blog.`blogcontent`, blog.`draft` 
                                FROM `blog` LEFT JOIN admin ON blog.adminid = admin.id";
                    $stmt= $connect->prepare($sqlQuery);
                    $stmt->execute();
                    $result= $stmt->get_result();
                    $total_numRow = $result->num_rows;
                    $pages = ceil($total_numRow / $noPerPage);
        
                    $sqlQuery = "SELECT blog.`id`, blog.`adminid`, admin.name AS admin_name, blog.`dateadded`, blog.`blogimage`, blog.`blogheadline`, blog.`howmanyminread`, blog.`blogcontent`, blog.`draft` 
                                FROM `blog` LEFT JOIN admin ON blog.adminid = admin.id ORDER BY blog.id DESC LIMIT ?,?";
                    $stmt= $connect->prepare($sqlQuery);
                    $stmt->bind_param("ss", $offset, $noPerPage);
                    $stmt->execute();
                    $result= $stmt->get_result();
                    $numRow = $result->num_rows;
                }
    
            }

        }else{//for other users where draft = 1
            //get blog where draft = 1
            $draftStatus = 1;
            if($sort > 0){//sort with days
                //sort with days
                if (!empty($search) && $search!="" && $search!=' '){
                    //search productCategory from database 
                    $searchParam = "%{$search}%";
                    $searchQuery = "SELECT blog.`id`, blog.`adminid`, admin.name AS admin_name, blog.`dateadded`, blog.`blogimage`, blog.`blogheadline`, blog.`howmanyminread`, blog.`blogcontent`, blog.`draft` 
                                FROM `blog` LEFT JOIN admin ON blog.adminid = admin.id 
                                WHERE (blog.`blogheadline` Like ? OR admin.name like ? OR blog.`dateadded` like ? OR blog.`blogcontent` like ? OR blog.`howmanyminread` like ?) AND blog.`draft` = ? AND FROM_UNIXTIME(blog.dateadded) >= (DATE(NOW()) - INTERVAL ? DAY)";
                    $stmt= $connect->prepare($searchQuery);
                    $stmt->bind_param("sssssss", $searchParam, $searchParam, $searchParam, $searchParam, $searchParam, $draftStatus, $days);
                    $stmt->execute();
                    $result= $stmt->get_result();
                    $total_numRow = $result->num_rows;
                    $pages = ceil($total_numRow / $noPerPage);

                    $searchParam = "$searchParam ORDER BY blog.id DESC LIMIT ?,?";
                    $stmt= $connect->prepare($searchQuery);
                    $stmt->bind_param("sssssssss", $searchParam, $searchParam, $searchParam, $searchParam, $searchParam, $draftStatus, $days, $offset, $noPerPage);
                    $stmt->execute();
                    $result= $stmt->get_result();
                    $numRow = $result->num_rows; 
                }else{
                    //get without search
                    $sqlQuery = "SELECT blog.`id`, blog.`adminid`, admin.name AS admin_name, blog.`dateadded`, blog.`blogimage`, blog.`blogheadline`, blog.`howmanyminread`, blog.`blogcontent`, blog.`draft` 
                                FROM `blog` LEFT JOIN admin ON blog.adminid = admin.id
                                WHERE blog.`draft` = ? AND FROM_UNIXTIME(blog.dateadded) >= (DATE(NOW()) - INTERVAL ? DAY)";
                    $stmt= $connect->prepare($sqlQuery);
                    $stmt->bind_param("ss", $draftStatus, $days);
                    $stmt->execute();
                    $result= $stmt->get_result();
                    $total_numRow = $result->num_rows;
                    $pages = ceil($total_numRow / $noPerPage);

                    $sqlQuery = "$sqlQuery ORDER BY blog.id DESC LIMIT ?,?";
                    $stmt= $connect->prepare($sqlQuery);
                    $stmt->bind_param("ssss", $draftStatus, $days, $offset, $noPerPage);
                    $stmt->execute();
                    $result= $stmt->get_result();
                    $numRow = $result->num_rows;
                
                }

            }else{//no need to sort with days
                //no need to  with days sort
                if (!empty($search) && $search!="" && $search!=' '){
                    //search productCategory from database 
                    $searchParam = "%{$search}%";
                    $searchQuery = "SELECT blog.`id`, blog.`adminid`, admin.name AS admin_name, blog.`dateadded`, blog.`blogimage`, blog.`blogheadline`, blog.`howmanyminread`, blog.`blogcontent`, blog.`draft` 
                                FROM `blog` LEFT JOIN admin ON blog.adminid = admin.id 
                                WHERE (blog.`blogheadline` Like ? OR admin.name like ? OR blog.`dateadded` like ? OR blog.`blogcontent` like ? OR blog.`howmanyminread` like ?) AND blog.`draft` = ?";
                    $stmt= $connect->prepare($searchQuery);
                    $stmt->bind_param("ssssss", $searchParam, $searchParam, $searchParam, $searchParam, $searchParam, $draftStatus);
                    $stmt->execute();
                    $result= $stmt->get_result();
                    $total_numRow = $result->num_rows;
                    $pages = ceil($total_numRow / $noPerPage);
        
                    //paginate the fetch data
                    $searchQuery = "SELECT blog.`id`, blog.`adminid`, admin.name AS admin_name, blog.`dateadded`, blog.`blogimage`, blog.`blogheadline`, blog.`howmanyminread`, blog.`blogcontent`, blog.`draft` 
                                FROM `blog` LEFT JOIN admin ON blog.adminid = admin.id 
                                WHERE (blog.`blogheadline` Like ? OR admin.name like ? OR blog.`dateadded` like ? OR blog.`blogcontent` like ? OR blog.`howmanyminread` like ?) AND blog.`draft` = ? ORDER BY blog.id DESC LIMIT ?,?";
                    $stmt= $connect->prepare($searchQuery);
                    $stmt->bind_param("ssssssss", $searchParam, $searchParam, $searchParam, $searchParam, $searchParam, $draftStatus, $offset, $noPerPage);
                    $stmt->execute();
                    $result= $stmt->get_result();
                    $numRow = $result->num_rows;  
                }else {//get all data
                    $sqlQuery = "SELECT blog.`id`, blog.`adminid`, admin.name AS admin_name, blog.`dateadded`, blog.`blogimage`, blog.`blogheadline`, blog.`howmanyminread`, blog.`blogcontent`, blog.`draft` 
                                FROM `blog` LEFT JOIN admin ON blog.adminid = admin.id
                                WHERE blog.`draft` = ?";
                    $stmt= $connect->prepare($sqlQuery);
                    $stmt->bind_param("s", $draftStatus);
                    $stmt->execute();
                    $result= $stmt->get_result();
                    $total_numRow = $result->num_rows;
                    $pages = ceil($total_numRow / $noPerPage);
        
                    $sqlQuery = "SELECT blog.`id`, blog.`adminid`, admin.name AS admin_name, blog.`dateadded`, blog.`blogimage`, blog.`blogheadline`, blog.`howmanyminread`, blog.`blogcontent`, blog.`draft` 
                                FROM `blog` LEFT JOIN admin ON blog.adminid = admin.id 
                                WHERE  blog.`draft` = ? ORDER BY blog.id DESC LIMIT ?,?";
                    $stmt= $connect->prepare($sqlQuery);
                    $stmt->bind_param("sss", $draftStatus, $offset, $noPerPage);
                    $stmt->execute();
                    $result= $stmt->get_result();
                    $numRow = $result->num_rows;
                }

            }
            
        }
        
        //check for database connection 
        if(!$stmt->execute()){
            //DB error || invalid input
            $errordesc=$stmt->error;
            $linktosolve="htps://";
            $hint=["Ensure database connection is on","Ensure that all data specified in the API is sent","Ensure that all data sent is not empty","Ensure that the exact data type specified in the documentation is sent."];
            $errordata=returnError7003($errordesc,$linktosolve,$hint);
            $text="Database comection error";
            $method=getenv('REQUEST_METHOD');
            $data=returnErrorArray($text,$method,$endpoint,$errordata);
            respondInternalError($data);
        }
        //return fetched data as array
        
        if($numRow > 0){
            $allResponse = [];
            while($row = $result->fetch_assoc()){
                $id = $row['id'];
                $adminid = $row['adminid'];
                $adminName = $row['admin_name'];
                $strings = explode(" ", $adminName);
                $adminInitials = '';
                foreach($strings as $string){
                    $adminInitials.=strtoupper(substr($string,0,1));
                }
                $dateAdded = gettheTimeAndDate($row['dateadded']);
                $blogImage = $row['blogimage'];
                $blogHeadline = $row['blogheadline'];
                $howManyMinRead = $row['howmanyminread'];
                $blogContent = $row['blogcontent'];
                $draft = $row['draft'];
                array_push($allResponse, array("id"=>$id, "adminid"=>$adminid, "adminName"=>$adminName, "adminInitials"=>$adminInitials, "dateAdded"=>$dateAdded, "blogImage"=>$blogImage, "blogHeadline"=>$blogHeadline, "howManyMinRead"=>$howManyMinRead, "blogContent"=>$blogContent, "draft"=>$draft));

            }
            $maindata = [
                'page' => $page_no,
                'per_page' => $noPerPage,
                'total_data' => $total_numRow,
                'totalPage' => $pages,
                'blogs'=> $allResponse
            ];
            $errordesc = " ";
            $linktosolve = "htps://";
            $hint = [];
            $errordata = [];
            $text = "Data found";
            $method = getenv('REQUEST_METHOD');
            $status = true;
            $data = returnSuccessArray($text, $method, $endpoint, $errordata, $maindata, $status);
            respondOK($data);
        }else{
            //not found
            $errordesc = " ";
            $linktosolve = "htps://";
            $hint = [];
            $errordata = [];
            $text = "Record Not Found";
            $method = getenv('REQUEST_METHOD');
            $status = false;
            $data = returnSuccessArray($text, $method, $endpoint, $errordata, $maindata, $status);
            respondOK($data);
        }


    }else {
        // method not allowed
        $errordesc="Method not allowed";
        $linktosolve="htps://";
        $hint=["Ensure to use the method stated in the documentation."];
        $errordata=returnError7003($errordesc,$linktosolve,$hint);
        $text="Method used not allowed";
        $method=getenv('REQUEST_METHOD');
        $data=returnErrorArray($text,$method,$endpoint,$errordata);
        respondMethodNotAlowed($data);
    }
?>