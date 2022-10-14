<?php include "../includes/header.php"; ?>
    <title>Photos</title>
</head>
<style>
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
        height: calc(100vh - 150px);
        overflow: hidden;
        overflow: auto;
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

    #wrapper #image_preview{
        margin-top: 15px;
        display: grid;
        grid-template-columns: auto auto;
        gap: 10px;
    }

    #wrapper #image_preview .img_container{
        position:relative;
        display:flex;
        justify-content:center;
        align-items:center;
        overflow:hidden;
    }

    #wrapper #image_preview .img_container img{
        flex-shrink:0;
        width:250px;
        object-fit: fill;
        height: 200px;
        border-radius: 10px;
    }

    ._4793j_upload_btn{
        display: initial;
        background-color:#212529;
        color: white;
        padding: 10px 6px;
        border-radius: 5px;
    }
</style>

<body>
    <div id="user" v-cloak>
        <?php include "../includes/loading.php"; ?>
        <div class="body-wrapper row m-0 p-0">
            <div class="col-md-6 video-container p-0 position-relative" style="overflow:hidden;">
                <video class="_e2l2kr" autoplay muted loop aria-label="A Host waves from their living room and adjusts their sofa. Another Host takes a photo in their plant-filled space. Finally, two Hosts sit beside each other and wave hello." crossorigin="anonymous"
                    playsinline="" preload="auto" style="object-fit: cover; object-position: 0px 25%;"><source src="https://a0.muscache.com/v/8b/04/8b0456c7-13f8-54bc-889a-7cf549f144a3/8b0456c713f854bc889a7cf549f144a3_4000k_1.mp4?imformat=h265" type="video/mp4; codecs=hevc"><source src="https://a0.muscache.com/v/8b/04/8b0456c7-13f8-54bc-889a-7cf549f144a3/8b0456c713f854bc889a7cf549f144a3_4000k_1.mp4" type="video/mp4"></video>

                <a href="../index.php" data-bs-toggle="modal" data-bs-target="#exampleModal" class="btn close _qa0cc5 position-absolute" style="bottom:20px !important; left:20px;">Watch full Video</a>
                <!-- Button trigger modal -->
                <a href="../index.php" class="btn d-md-none d-flex close _qa0cc5 position-absolute" style="top: 20px;
                    right: 20px;">Exit</a>
                <!-- Modal -->
                <div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true" style="background-color: black;">
                    <div class="modal-dialog modal-lg">
                        <div class="modal-content" style="height: 100vh;">
                            <div class="modal-header">
                                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                            </div>
                            <div class="modal-body" style="height: calc(100vh - 100px);">
                                <video controls autoplay muted loop aria-label="A Host waves from their living room and adjusts their sofa. Another Host takes a photo in their plant-filled space. Finally, two Hosts sit beside each other and wave hello." crossorigin="anonymous" playsinline=""
                                    preload="auto" style="object-fit: cover; object-position: 0px 25%;"><source src="https://a0.muscache.com/v/8b/04/8b0456c7-13f8-54bc-889a-7cf549f144a3/8b0456c713f854bc889a7cf549f144a3_4000k_1.mp4?imformat=h265" type="video/mp4; codecs=hevc"><source src="https://a0.muscache.com/v/8b/04/8b0456c7-13f8-54bc-889a-7cf549f144a3/8b0456c713f854bc889a7cf549f144a3_4000k_1.mp4" type="video/mp4"></video>
                            </div>

                        </div>
                    </div>
                </div>
            </div>
            <div class="col-md-6 video-container p-0 pt-md-5 position-relative">
                <div style="height: 100%;display:flex;align-items: center;justify-content: center;">
                    <ul class="question-tag px-4">
                        <h2 class="text-center pt-4 mb-4"><b>
                            Now for the fun part—set your price</b>
                            <small style="font-size: 14px !important;display:block">Upload at least 5 Photos</small>
                        </h2>

                        <br>

                        <div id="wrapper">
                            <div style="text-align:center" >
                                <div class="_4793j_upload_btn" onclick="document.getElementById('upload_file').click()" >Choose Images</div> 
                            </div>
                            
                            <form action="" method="post" enctype="multipart/form-data">
                                <input type="file"  style="display:none" id="upload_file" name="upload_file[]" onchange="preview_image();" multiple/>
                            </form>
                            <div id="image_preview"></div>
                        </div> 
                    </ul>
                    <div class="hovvvv justify-content-evenly">
                        <div class="progress" style="height:5px;">
                            <div class="progress-bar" role="progressbar" style="width: 60%;" aria-valuenow="25" aria-valuemin="0" aria-valuemax="100"></div>
                        </div>
                        <div class="d-flex justify-content-evenly" style="padding-top: 10px;">
                            <a href="./amenities.php" class="_kaq6tx w-120" >Back</a>
                            <a href="./title.php" class="_kaq6tx  w-120">Next</a>
                        </div>

                    </div>
                    <a href="../index.php" class="btn  d-none d-md-flex close _qa0cc5 position-absolute" style="top: 20px;
                    right: 20px;">Exit</a>
                </div>

            </div>
        </div>

    </div>

    
    <?php include "../includes/vue-script.php"; ?>

    <script>
        function preview_image(){
            var total_file=document.getElementById("upload_file").files.length;
            for(var i=0;i<total_file;i++)
            {
                $('#image_preview').append("<div class='img_container' ><img src='"+URL.createObjectURL(event.target.files[i])+"'></div>");
            }
        }
    </script>
</head>
<body>
      
</body>

</html>