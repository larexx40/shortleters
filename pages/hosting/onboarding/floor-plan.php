<?php include "../includes/header.php"; ?>
    <title>Floor Plan</title>
</head>

<style>
    .video-container ul li {
        min-height: 88px;
        max-width: 75%;
        align-items: center;
        width: 100%;
        margin: auto;
        display: grid;
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
        min-height: calc(100vh - 150px);
        overflow: hidden;
        overflow: auto;
        padding-bottom: 70px;
        display: grid;
        align-items: center;
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
    
    ._ul9u8c {
        -webkit-box-pack: center !important;
        -webkit-box-align: center !important;
        -webkit-box-flex: 0 !important;
        width: 32px !important;
        height: 32px !important;
        flex-grow: 0 !important;
        flex-shrink: 0 !important;
        cursor: pointer !important;
        display: inline-flex !important;
        margin: 0px !important;
        padding: 0px !important;
        text-align: center !important;
        text-decoration: none !important;
        border-width: 1px !important;
        border-style: solid !important;
        border-color: rgb(176, 176, 176) !important;
        color: rgb(113, 113, 113) !important;
        font-family: inherit !important;
        outline: none !important;
        touch-action: manipulation !important;
        align-items: center !important;
        justify-content: center !important;
        background: rgb(255, 255, 255) !important;
        border-radius: 50% !important;
    }
</style>

<body>
    <div id="user" v-cloak>
        <?php include "../includes/loading.php"; ?>
        <div class="body-wrapper row m-0 p-0 position-relative">
            <div class="col-md-6 video-container p-0 position-relative" style="background-image: linear-gradient(#4d1ca4, #a7238f);">

                <div style="height: 100%;display:flex;align-items: center;justify-content: center;">
                    <div class="_e5xjym4">
                        <h1 class="_1eg7jkhx text-white">How many guests would you like to welcome?</h1>
                    </div>

                </div>
                <a href="../index.php" class="btn d-md-none d-flex close _qa0cc5 position-absolute" style="top: 20px;
                    right: 160px;">Back</a>
                <a href="../index.php" class="btn d-md-none d-flex close _qa0cc5 position-absolute" style="top: 20px;
                    right: 20px;">Save and Exit</a>

            </div>
            <div class="col-md-6 video-container p-0 pt-md-5 position-relative" style="background-color: white !important;">
                <div class="w-md-100 w-auto pt-5" style="display:flex;align-items: center;justify-content: center;">
                    <ul class="question-tag">
                        <div>
                            <div class="d-flex justify-content-between align-items-center px-3 mb-5">
                                <h3><b>Guests</b></h3>
                                <h3><b>
                                <div class="d-flex gap-3 align-items-center">
                                    <span class="_ul9u8c prev">-</span>
                                    <span class="counter">5</span>
                                    <span class="_ul9u8c next">+</span>
                                </div>
                            </b></h3>
                            </div>
                            <div class="d-flex justify-content-between align-items-center px-3 mb-5">
                                <h3><b>Beds</b></h3>
                                <h3><b>
                                <div class="d-flex gap-3 align-items-center">
                                    <span class="_ul9u8c prev">-</span>
                                    <span class="counter">5</span>
                                    <span class="_ul9u8c next">+</span>
                                </div>
                            </b></h3>
                            </div>
                            <div class="d-flex justify-content-between align-items-center px-3 mb-5">
                                <h3><b>Bathrooms</b></h3>
                                <h3><b>
                                <div class="d-flex gap-3 align-items-center">
                                    <span class="_ul9u8c prev">-</span>
                                    <span class="counter">5</span>
                                    <span class="_ul9u8c next">+</span>
                                </div>
                            </b></h3>
                            </div>

                        </div>


                    </ul>
                    <div class=" hovvvv justify-content-evenly">
                        <div class="progress" style="height:5px;">
                            <div class="progress-bar" role="progressbar" style="width: 60%;" aria-valuenow="25" aria-valuemin="0" aria-valuemax="100"></div>
                        </div>
                        <div class="d-flex justify-content-evenly" style="padding-top: 10px;">
                            <a href="./is_location.php" class="btn _kaq6tx w-120" style="background-color: transparent;background-image: none !important;color: black;">Back</a>
                            <a href="./amenities.php" class="btn _kaq6tx  w-120" style="background-color: #dddddd;background-image: none !important;">Next</a>
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
    <script>
        $('.next').click(function() {
            let no = $(this).prev().text();
            $(this).prev().text(parseInt(no) + 1);
        });
        $('.prev').click(function() {
            let no = $(this).next().text();
            if (no == 0) {
                $(this).next().text(0);
            } else {
                $(this).next().text(parseInt(no) - 1);
            }

        });
    </script>
</body>

</html>