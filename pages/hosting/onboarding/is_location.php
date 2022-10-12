<?php include "../includes/header.php"; ?>
    <title>Location</title>
</head>

<style>
    .video-container ul li {
        min-height: 88px;
        max-width: 75%;
        align-items: center;
        justify-content: space-between;
        width: 100%;
        margin: auto;
        display: flex;
        border: 1px solid #DDDDDD;
        margin-bottom: 15px;
        border-radius: 10px;
        padding-right: 15px;
        padding-left: 15px;
        cursor: pointer;
    }
    
    .video-container ul li:hover {
        border: 2px solid black;
    }
    
    @media all and (max-width:769px) {
        .video-container {
            height: 250px;
        }
    }
    
    .hovvvv {
        width: 100%;
        bottom: 0;
        height: 85px;
        display: block;
        background-color: white;
        right: 0;
        border-top: 1px solid grey;
        justify-content: end;
        padding-right: 0;
        padding-top: 0;
        position: absolute;
    }
    
    .question-tag {
        width: 90%;
        height: 500px;
        overflow: hidden;
        overflow: auto;
        background-color: white;
        border-radius: 20px;
        padding-bottom: 70px;
    }
    
    @media all and (max-width:769px) {
        .hovvvv {
            position: fixed;
            left: 0;
            padding-left: 0;
        }
        .question-tag {
            height: auto;
            width: 100%;
        }
    }
    
    .map-question {
        display: flex;
        align-items: center;
        justify-content: center;
        position: absolute;
        width: 100%;
        top: 0;
        height: 100vh;
    }
    
    .mapouter {
        position: relative;
        text-align: right;
        height: 100vh;
        width: 100%;
    }
    
    input,
    select {
        outline: none;
        box-shadow: none !important;
    }
    
    .gmap_canvas {
        overflow: hidden;
        background: none!important;
        height: 100vh;
        width: 100%;
    }
</style>

<body>

    <div id="user" v-cloak>
        <?php include "../includes/loading.php"; ?>
        <div class="body-wrapper row m-0 p-0 position-relative">
            <div class="col-md-6 video-container p-0 position-relative" style="background-image: linear-gradient(rgb(28 107 164), rgb(35 167 57));">

                <div style="height: 100%;display:flex;align-items: center;justify-content: center;">
                    <div class="_e5xjym4">
                        <h1 class="_1eg7jkhx text-white">Is the pin in the right spot?</h1>
                    </div>

                </div>
                <a href="../index.php" class="btn d-md-none d-flex close _qa0cc5 position-absolute" style="top: 20px;
                    right: 160px;">Back</a>
                <a href="../index.php" class="btn d-md-none d-flex close _qa0cc5 position-absolute" style="top: 20px;
                    right: 20px;">Save and Exit</a>

            </div>
            <div class="col-md-6 video-container p-0 position-relative" style="background-color: white !important;">
                <div class="mapouter">
                    <div class="gmap_canvas">
                        <iframe width="100%" height="100%" id="gmap_canvas" src="https://maps.google.com/maps?q=2880%20Broadway,%20New%20York&t=&z=9&ie=UTF8&iwloc=&output=embed" frameborder="0" scrolling="no" marginheight="0" marginwidth="0"></iframe><a href="https://www.whatismyip-address.com/divi-discount/">divi discount</a><br>

                    </div>
                </div>
                <div class=" map-question">

                    <div class=" hovvvv justify-content-evenly">
                        <div class="progress" style="height:5px;">
                            <div class="progress-bar" role="progressbar" style="width: 50%;" aria-valuenow="25" aria-valuemin="0" aria-valuemax="100"></div>
                        </div>
                        <div class="d-flex justify-content-evenly" style="padding-top: 10px;">
                            <a href="./location.php" class="_kaq6tx w-120">Back</a>
                            <a href="./floor-plan.php" class="_kaq6tx  w-120">Next</a>
                        </div>

                    </div>
                    <a href="../index.php" class="btn  d-none d-md-flex close _qa0cc5 position-absolute" style="top: 20px;
                    right: 160px;">Back</a>
                    <a href="../index.php" class="btn  d-none d-md-flex close _qa0cc5 position-absolute" style="top: 20px;
                    right: 20px;">Save and Exit</a>
                </div>

            </div>

        </div>
    </div>
    <?php include "../includes/vue-script.php"; ?>    

</body>

</html>