<?php
    include "../cartsfunction.php";

    if (isset($_POST['search'])) {
        $search = cleanme($_POST['search']);
    } else {
        $search = "";
    }

    if (isset($_POST['sort'])) {
        $sort = cleanme($_POST['sort']); //sort result by status if > 0
    } else {
        $sort = "";
    }

    if (isset($_POST['sortstatus'])) {
        $status = cleanme($_POST['sortstatus']); //sort result by status if > 0
    } else {
        $status = "";
    }

    if (!isset ($_GET['page']) ) {  
        $page_no = 1;  
    } else {  
        $page_no = $_GET['page'];  
    }
    $noPerPage = 4;  
    $offset = ($page_no - 1) * $noPerPage;

    if (!empty($search) && $search!="" && $search!=' '){
        $searchParam = "%{$search}%";


        $searchQuery = "SELECT fname, lname, phoneno, state, country, dob, sex FROM users WHERE fname like ? OR lname like ?";
        $stmt= $connect->prepare($searchQuery);
        $stmt->bind_param("ss", $searchParam, $searchParam);
        $stmt->execute();
        $result= $stmt->get_result();
        $numRow = $result->num_rows;
        $pages = ceil($numRow / $noPerPage);

        $searchQuery = "SELECT fname, lname, phoneno, state, country, dob, sex FROM users WHERE fname like ? OR lname like ? LIMIT ?,?";
        $stmt= $connect->prepare($searchQuery);
        $stmt->bind_param("ssss", $searchParam, $searchParam, $offset, $noPerPage);
        $stmt->execute();
        $result= $stmt->get_result();
        $numRow = $result->num_rows;

        if($numRow > 0){
            $allResponse = [];
            while($users = $result->fetch_assoc()){
                $firstName = $users['fname'];
                $lastName = $users['lname'];
                $state = $users['state'];
                $phoneno = $users['phoneno'];
                array_push($allResponse,array("Firstname"=>$firstName, "LastName"=>$lastName, "State"=>$state, "Phoneno"=>$phoneno));
            }
            //echo json_encode($allResponse);
            $maindata['userdata']=$allResponse;
            //$maindata=[$maindata];
            $errordesc = " ";
            $linktosolve = "htps://";
            $hint = [];
            $errordata = [];
            $text = "Data found";
            $method = getenv('REQUEST_METHOD');
            $status = true;
            $data = returnSuccessArray($text, $method, $endpoint, $errordata, $maindata, $status);
            respondOK($data);
        }
    }else{
        $sqlQuery = "SELECT fname, lname, phoneno, state, country, dob, sex FROM users";
        $stmt= $connect->prepare($sqlQuery);
        $stmt->execute();
        $result= $stmt->get_result();
        $numRow = $result->num_rows;
        $pages = ceil($numRow / $noPerPage);
        //echo $numRow;

        $sqlQuery = "SELECT fname, lname, phoneno, state FROM users LIMIT ?,?";
        $stmt= $connect->prepare($sqlQuery);
        $stmt->bind_param("ss", $offset, $noPerPage);
        $stmt->execute();
        $result= $stmt->get_result();
        $numRow = $result->num_rows;

        if($numRow > 0){
            $allResponse = [];
            while($users = $result->fetch_assoc()){
                $firstName = $users['fname'];
                $lastName = $users['lname'];
                $state = $users['state'];
                $phoneno = $users['phoneno'];
                array_push($allResponse,array("Firstname"=>$firstName, "LastName"=>$lastName, "State"=>$state, "Phoneno"=>$phoneno));
            }
            //echo json_encode($allResponse);
            $maindata['userdata']=$allResponse;
            //$maindata=[$maindata];
            $errordesc = " ";
            $linktosolve = "htps://";
            $hint = [];
            $errordata = [];
            $text = "Data found";
            $method = getenv('REQUEST_METHOD');
            $status = true;
            $data = returnSuccessArray($text, $method, $endpoint, $errordata, $maindata, $status);
            respondOK($data);
        }
    }
    
?>