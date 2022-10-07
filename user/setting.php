<?php  
    include "./header.php"; 
?>

  <title>Package</title>

</head>
<body>

<div id="user" v-cloak>

    <div class="loadingScreen" v-if="loading">
        <div class="fa-5x" style="color: darkolivegreen">
            <i class="fas fa-spinner fa-pulse"></i>
        </div>
    </div>

    <?php
        include "sidebar_navbar.php";
    ?>
    
    

    <div class="main">
    <div class="main__inner">
            <div class="main__header text-center text-lg-start">
                <div class="text-center name d-lg-none">
                    <h3 v-if="user_detais">{{user_detais.Firstname.charAt(0)}} {{user_detais.Lastname.charAt(0)}}</h3>
                </div>  
                <h3 v-if="user_detais">{{user_detais.Fullname}}</h3>
                <small v-if="user_detais">{{user_detais.Email}}</small>
            </div>
        <div class="main__body">
            <div class="main__body__inner row col-12 m-0">
                <div class="each__card col-lg-4">
                        <button type="button" data-bs-toggle="modal" data-bs-target="#exampleModal1">
                            <div class="each__card__inner">
                                <div class="top">
                                    <div class="icon"><em class="bi bi-person-fill"></em> </div>
                                </div>
                                <div class="bottom">
                                    <span>Personal Information</span>
                                    <div class="p">Edit your name, phone number and other personal info.</div>
                                </div>
                            </div>
                        </button>
                    </div>

                <!-- Modal -->
                <div class="modal fade" v-if="!loading" id="exampleModal1" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                <div class="modal-dialog">
                    <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="exampleModalLabel">Personal Information</h5>
                    </div>
                    <div class="modal-body">
                        <form @submit.prevent="updateDetails" class="personal__info">
                            <div class="each__form">
                                <label class="form-label">First Name</label>
                                <input type="text" v-if='user_detais' v-model="user_detais.Firstname" class="form-control" placeholder="">
                            </div>
                            <div class="each__form">
                                <label class="form-label">Last Name</label>
                                <input type="text" v-if='user_detais' v-model="user_detais.Lastname" class="form-control" placeholder="">
                            </div>
                            <div class="each__form">
                                <label class="form-label">User Name</label>
                                <input type="text" v-if='user_detais' v-model="user_detais.Username" class="form-control" placeholder="">
                            </div>
                            <div class="each__form">
                                <label class="form-label">Email address</label>
                                <input type="email" v-if='user_detais' v-model="user_detais.Email" disabled class="form-control" placeholder="">
                            </div>
                            <div class="each__form">
                                <label class="form-label">Phone number</label>
                                <input type="tel" v-if='user_detais' v-model="user_detais.phone" class="form-control" placeholder="eg. 2349073734025">
                            </div>
                            <div class="each__form">
                                <label class="form-label">Date of birth</label>
                                <input type="date" v-if='user_detais' v-model="user_detais.dob" class="form-control" placeholder="">
                            </div>
                            <div class="each__form">
                                <label class="form-label">Sex</label>
                                <input type="text" v-if='user_detais' v-model="user_detais.sex" class="form-control" placeholder="eg. Male, Female">
                            </div>
                            <div class="each__form">
                                <label class="form-label">State</label>
                                <input type="text" v-if='user_detais' v-model="user_detais.State" class="form-control" placeholder="eg. Male, Female">
                            </div>
                            <div class="each__form">
                                <label class="form-label">Country</label>
                                <input type="text" v-if='user_detais' v-model="user_detais.Country" class="form-control" placeholder="eg. Male, Female">
                            </div>
                            <div class="each__form">
                                <button type="submit">Submit</button>
                            </div>
                        </form>
                    </div>
                    
                    </div>
                </div>
                </div>



                
                <div class="each__card col-lg-4">
                    <button type="button" data-bs-toggle="modal" data-bs-target="#exampleModal2">
                        <div class="each__card__inner">
                            <div class="top">
                                <div class="icon"><em class="bi bi-lock-fill"></em> </div>
                            </div>
                            <div class="bottom">
                                <span>Login & Security</span>
                                <div class="p">Update your password. Keep your account safe.</div>
                            </div>
                        </div>
                    </button>
                </div>

                <!-- Modal -->
                <div class="modal fade" v-if="!loading" id="exampleModal2" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                <div class="modal-dialog">
                    <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="exampleModalLabel">Password</h5>
                        <button type="button" data-bs-dismiss="modal" aria-label="Close">Cancel</button>
                    </div>
                    <div class="modal-body">
                        <form  @submit.prevent="changePassword" class="password__form second">
                            <div class="each__form">
                                <div class="position-relative">
                                    <input type="password" v-model='currentpassword' id="floatingInput5" class="form-control" placeholder="Current Password">
                                    <em class="bi bi-eye password"></em>
                                </div>
                            </div>
                            <div class="each__form">
                                <div class="position-relative">
                                    <input type="password" v-model='password' id="floatingInput6" class="form-control" placeholder="New Password">
                                    <em id="pass" class="bi bi-eye password"></em>
                                </div>
                            </div>
                            <div class="each__form">
                                <div class="position-relative">
                                    <input type="password" v-model='confirmPassword' id="" class="form-control" placeholder="Repeat New Password">
                                    <em id="confirm" class="bi bi-eye password"></em>
                                </div>
                            </div>
                            <div class="each__form">
                                <button type="submit">Submit</button>
                            </div>
                        </form>
                    </div>
                    
                    </div>
                </div>
                </div>



                <div class="each__card col-lg-4">
                        <button type="button" data-bs-toggle="modal" data-bs-target="#exampleModal3">
                            <div class="each__card__inner">
                                <div class="top">
                                    <div class="icon"><em class="bi bi-journal"></em> </div>
                                </div>
                                <div class="bottom">
                                    <span>Address Book</span>
                                    <div class="p">Edit, delete and add new addresses.</div>
                                </div>
                            </div>
                    </button>
                </div>
                    <!-- Modal -->
            
                    <div class="modal fade" id="exampleModal3" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                        <div class="modal-dialog">
                            <div class="modal-content">
                            <div class="modal-header">
                                <h4 class="modal-title" id="exampleModalLabel">Add new address</h4>
                            </div>
                            <div class="modal-body">
                                <form action="">
                                    <div class="each__form">
                                        <input type="text" class="form-control" id="exampleFormControlInput1" placeholder="Recipient Name">
                                    </div>
                                    <div class="each__form">
                                        <input type="text" class="form-control" id="exampleFormControlInput1" placeholder="Recipient Number (eg. 2349073734025)">
                                    </div>
                                    <div class="each__form select">
                                        <input type="text" class="form-control" id="exampleFormControlInput1" placeholder="name@example.com">
                                    </div>
                                    <div class="each__form">
                                        <input type="text" class="form-control" id="exampleFormControlInput1" placeholder="City">
                                    </div>
                                    <div class="each__form">
                                        <input type="text" class="form-control" id="exampleFormControlInput1" placeholder="Street">
                                    </div>
                                    <div class="each__form">
                                        <input type="text" class="form-control" id="exampleFormControlInput1" placeholder="LGA">
                                    </div>
                                    <div class="each__form">
                                        <button type="submit">Submit</button>
                                    </div>
                                </form>
                            </div>
                            
                            </div>
                        </div>
                    </div>


                <div class="each__card col-lg-4">
                        <div  iv class="each__card__inner">
                            <div class="top">
                                <div class="icon"><em class="bi bi-hdd-rack-fill"></em> </div>
                            </div>
                            <div class="bottom">
                                <span>General Preferences</span>
                                <div class="p">Set your notifications and other preferences.</div>
                            </div>
                        </div>
                </div>
            
                <div class="each__card col-lg-4">
                        <div class="each__card__inner">
                            <div class="top">
                                <div class="icon"><em class="bi bi-question-circle-fill"></em> </div>
                            </div>
                            <div class="bottom">
                                <span>Help & Support</span>
                                <div class="p">Visit our help center. We are always happy to help.</div>
                            </div>
                        </div>
                </div>
            </div>
        </div>
    </div>
    </div>

    </main>

</div>

<script src="https://unpkg.com/vue@3"></script>
<script src="https://cdn.jsdelivr.net/npm/axios/dist/axios.min.js"></script>
<script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>
<script src="../vuecode/user.js" ></script>
<script src="../assets/js/toasteur.min.js"></script>


<script>
    const body = document.querySelector('body'),
          showIcons = body.querySelectorAll('em.password');
          
        for(let showIcon of showIcons){
            showIcon.addEventListener('click', () => {
                showIcon.onclick = () => {
                    if(showIcon.previousElementSibling.type == 'password'){
                        showIcon.previousElementSibling.type = 'text';
                        showIcon.classList.add('bi-eye-slash');
                        showIcon.classList.remove('bi-eye');
                    }else{
                        showIcon.previousElementSibling.type = 'password';
                        showIcon.classList.remove('bi-eye-slash');
                        showIcon.classList.add('bi-eye');
                    }
                }
            })
        }
</script>


<script src="../assets/js/jquery-3.6.0.min.js"></script>
<script src="../assets/js/bootstrap.bundle.min.js"></script>
<!-- Custom JS -->
<script src="../assets/js/script.js"></script>
<script>
    function myFunction(x) {
      x.classList.toggle("change");
      $('.navbar-aside').toggleClass('active-d');
    }
    </script>
</body>
</html>