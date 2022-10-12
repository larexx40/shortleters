const urlPath = window.location.pathname.split("/");
const length = urlPath.length;
const page = urlPath[length -1];

let authApp = Vue.createApp({
    data(){
        return{
            loginField: true,
            regField: null,
            token: null,
            email: null,
            userIdentity: null,
            show_phone: null,
            show_email: true,
            username: null,
            firstname: null,
            lastname: null,
            birthday: null,
            phone: null,
            password: null,
            password1: null,
            ref_code: null,
            accessToken: null,
            confirmPassword: null,
            confirm_password: null,
            loading: null,
            error: null,
            baseurl: "http://localhost/shortleters/",
            is_show_login: true,
        }
    },
    async created() {
        if (page == "resetpassword.php"){
            const urlParams = new URLSearchParams(window.location.search);
            const otpToken = (urlParams.get('token'))? urlParams.get('token') : null ;
            this.token = otpToken;
            console.log(otpToken);
        }
    },
    methods: { 
        loginWithPhone(){
            this.show_phone = false;
            this.show_email = true;
        },
        loginWithEmail(){
            this.show_email = false;
            this.show_phone = true;
        },
        newUser (){
            this.regField = true;
            this.loginField= false;
            this.is_show_login = false;

        },
        oldUser (){
            this.loginField = true;
            this.regField = false;
            this.is_show_login = true;

        },
        //google oauth
        async googleOauth(){
            console.log("proceed to oauth");
            const url = 'http://localhost/shortleters/api/accounts/redirect.php';
            const options = {
                method: "GET",
                headers: { 
                    //"Content-type": "application/json",
                    "Authorization": `Bearer ${this.authToken}`
                },
                url
            }
            try {
                this.loading = true;
                const response = await axios(options);
                if(response.data.status){
                    if(response.data.data.googleLink){
                        console.log(response.data.data.googleLink);
                        window.location.href= response.data.data.googleLink;
                    }
                    if(response.data.data.authtoken){
                        //go index
                        this.success = response.data.text;
                        const dataValues = response.data.data;
                        const token = dataValues.authtoken;
                        localStorage.setItem("token", token);
                        new Toasteur().success(this.success);
                        console.log(token);
                        window.location.href ="./index.php";
                    }
                   
                }else{

                }     
            } catch (error) {
                // //console.log(error);
                if (error.response){
                    if (error.response.status == 400){
                        const errorMsg = error.response.data.text;
                        new Toasteur().error(errorMsg);
                        return
                    }
    
                    if (error.response.status == 401){
                        const errorMsg = "User not Authorized";
                        new Toasteur().error(errorMsg);
                        // window.location.href="./login.php"
                        return
                    }
    
                    if (error.response.status == 405){
                        const errorMsg = error.response.data.text;
                        new Toasteur().error(errorMsg);
                        return
                    }
    
                    if (error.response.status == 500){
                        const errorMsg = error.response.data.text;
                        new Toasteur().error(errorMsg);
                        return
                    }
                }

                new Toasteur().error(error.message || "Error processing request")

                
            }finally {
                this.loading = false;
            }
        },
        async loginUser() {
            if (!this.email || !this.password){
                this.error = "Kindly Enter all Fields"
                new Toasteur().error(this.error);
                return
            }
            // const url = `${this.baseUrl}api/accounts/login.php`
            const url = `${this.baseurl}api/accounts/login.php`;
            let data = new FormData();
            data.append('email', this.email);
            data.append('password', this.password);
            const options = {
                method: "POST",
                url,
                data
            }
            try {
                this.loading = true
                const response = await axios(options)

                if (response.data.status) {
                    console.log(response.data);
                    this.success = response.data.text;
                    const dataValues = response.data.data;
                    const token = dataValues.authtoken;
                    localStorage.setItem("token", token);
                    new Toasteur().success(this.success);
                    console.log(token);
                    window.location.href ="./index.php";
                }else{
                    new Toasteur().error("Invalid email or password");   
                }
            } catch (error) {
               if (error.response){
                    if (error.response.status == 400){
                        this.error = error.response.data.text;
                        new Toasteur().error(this.error);
                        return;
                    }

                    if (error.response.status == 405){
                        this.error = error.response.data.text;
                        new Toasteur().error(this.error);
                        return;
                    }

                    if (error.response.status == 500){
                        this.error = error.response.data.text;
                        new Toasteur().error(this.error);
                        return;
                    }

               }else{
                    this.error = error.message || "Error processing request"
                    new Toasteur().error(this.error);
               }
                
                
            } finally {
                this.loading = false
            }
        },
        async adminLogin() {
            if (!this.email || !this.password){
                this.error = "Kindly Enter all Fields"
                new Toasteur().error(this.error);
                return
            }
           

            let data = new FormData();
            data.append('email', this.email);
            data.append('password', this.password);

            try {
                this.loading = true
                const response = await axios.post(`http://localhost/shortleters/api/admin/adminLogin.php`, data, {
                    // headers: { "Content-type": "application/json"}
                });

                if (response.data.status) {
                    console.log(response.data);
                    this.success = response.data.text;
                    const dataValues = response.data.data;
                    const token = dataValues.authtoken;
                    localStorage.setItem("authToken", token);
                    new Toasteur().success(this.success);
                    window.location.href ="./index.php";
                }
            } catch (error) {
               if (error.response){
                    if (error.response.status == 400){
                        this.error = error.response.data.text;
                        new Toasteur().error(this.error);
                        return;
                    }

                    if (error.response.status == 405){
                        this.error = error.response.data.text;
                        new Toasteur().error(this.error);
                        return;
                    }

                    if (error.response.status == 500){
                        this.error = error.response.data.text;
                        new Toasteur().error(this.error);
                        return;
                    }

               }else{
                    this.error = error.message || "Error processing request"
                    new Toasteur().error(this.error);
               }
                
                
            } finally {
                this.loading = false
            }
        },
        async adminForgotPass(){
            if (!this.username){
                this.error = "Insert all fields"
                new Toasteur().error(this.error);
            }
            const data = new FormData();
            data.append('username', this.username);

            const headers = {
                "Content-type": "application/json"
            }

            try {
                this.loading = true
                const response = await axios.post(`${this.baseurl}api/admin/forgotpass.php`, data, {headers});

                if (response.data.data) {
                    this.success = response.data.text;
                    new Toasteur().success(this.success);
                }
            } catch (error) {
                // console.log(error);
                if (error.response){
                    if (error.response.status == 400){
                        this.error = error.response.data.text;
                        new Toasteur().error(this.error);
                        return
                    }
    
                    if (error.response.status == 405){
                        this.error = error.response.data.text;
                        new Toasteur().error(this.error);
                        return
                    }
    
                    if (error.response.status == 500){
                        this.error = error.response.data.text;
                        new Toasteur().error(this.error);
                        return
                    }
                }
                this.error = error.message || "Error Processing Request"
                new Toasteur().error(this.error);
            } finally {
                this.loading = false
            }


        },
        async admin_resetPassword(){
            console.log("clicked");

            const urlParams = new URLSearchParams(window.location.search);
            const token = (urlParams.get('token'))? urlParams.get('token') : null ;


            if (!token){
                this.error = "Kindly check your mail for the valid rest password link"
                new Toasteur().error(this.error);
                return
            }

            if (!this.confirm_password || !this.password){
                this.error = "Kindly Enter all fields"
                new Toasteur().error(this.error);

            }
            if (this.confirm_password !== this.password){
                this.error = "Password Does not match"
                new Toasteur().error(this.error);

            }

            const headers = { "Content-type": "application/json"}

            const data = new FormData();
            data.append('password', this.password);
            data.append('token', token);

            
            try {
                this.loading = true
                const response = await axios.post(`${this.baseurl}api/admin/resetPassword.php`, data, {headers});
                if ( response.data.status ){
                    this.success = response.data.text;
                    window.location.href="./auth-success.php";
                }          
            } catch (error) {
                if (error.response){
                    if (error.response.status == 400){
                        this.error = error.response.data.text;
                        new Toasteur().error(this.error);
                        return
                    }
    
                    if (error.response.status == 405){
                        this.error = error.response.data.text;
                        new Toasteur().error(this.error);
                        return
                    }
    
                    if (error.response.status == 500){
                        this.error = error.response.data.text;
                        new Toasteur().error(this.error);
                        return
                    }
                }

                this.error = error.message || "Error Processing Request"
                new Toasteur().error(this.error);
                
            } finally {
                this.loading = false;
            }
        },
        async userForgotPassword(){
            if(!this.userIdentity){
                new Toasteur().error("Pass in valid email")
            }else{
                const data = new FormData();
                data.append('userIdentity', this.userIdentity);
                const url = `${this.baseurl}api/accounts/forgotpass.php`;

                const options = {
                    method: "POST",
                    url,
                    data
                }

                
                try {
                    this.loading = true
                    const response = await axios(options)
                    if ( response.data.status ){
                        new Toasteur().success(response.data.text);
                    }else{
                        new Toasteur().error(response.data.text);
                    }
                }catch (error) {
                    // console.log(error);
                    if (error.response){
                        if (error.response.status == 400){
                            this.error = error.response.data.text;
                            new Toasteur().error(this.error);
                            return
                        }
        
                        if (error.response.status == 401){
                            this.error = "User not Authorized";
                            new Toasteur().error(this.error);
                            return
                        }
        
                        if (error.response.status == 405){
                            this.error = error.response.data.text;
                            new Toasteur().error(this.error);
                            return
                        }
        
                        if (error.response.status == 500){
                            this.error = error.response.data.text;
                            new Toasteur().error(this.error);
                            return
                        }
                    }
                    this.error = error.message || "Error Processing Request"
                    new Toasteur().error(this.error);
                } finally {
                    this.loading = false
                }
            }
        },
        
        async resetUserPassword(){

            const urlParams = new URLSearchParams(window.location.search);
            const token = (urlParams.get('token'))? urlParams.get('token') : null ;
            this.token = (token)? token : this.token;

            //validate pasword
            let validPassword = validatePassword(this.password);

            if (!this.token){
                this.error = "Kindly check your mail for the valid rest password token or resetlink"
                return
            }
            if(this.password !== this.password1){
                new Toasteur().error("password does not match");
                return
            }
            if(!validPassword){
                new Toasteur().error("password too weak");
            }else{
                const url = `${this.baseurl}api/accounts/resetpassword.php?token=${token}`;
                const data = new FormData();
                data.append('password', this.password);
                data.append('token', this.token);
                const options = {
                    method: "POST",
                    url,
                    data
                }

                
                try {
                    this.loading = true
                    const response = await axios(options)
                    if ( response.data.status ){
                        this.success = response.data.text;
                        new Toasteur().success(this.success);
                        window.location.href="login.php";
                    }else{
                        new Toasteur().error(response.data.text);
                    }        
                } catch (error) {
                    if (error.response){
                        if (error.response.status == 400){
                            this.error = error.response.data.text;
                            new Toasteur().error(this.error);
                            return
                        }
        
                        if (error.response.status == 401){
                            this.error = "User not Authorized";
                            new Toasteur().error(this.error);
                            return
                        }
        
                        if (error.response.status == 405){
                            this.error = error.response.data.text;
                            new Toasteur().error(this.error);
                            return
                        }
        
                        if (error.response.status == 500){
                            this.error = error.response.data.text;
                            new Toasteur().error(this.error);
                            return
                        }
                    }

                    this.error = error.message || "Error Processing Request"
                    new Toasteur().error(this.error);
                    
                } finally {
                    this.loading = false;
                }
            }
            
        },

        async registerUser() {
            let validPassword = validatePassword(this.password);
            if(this.password !== this.password1){
                new Toasteur().error("password does not match");
                return
            }
            if (!this.email || !this.firstname || !this.lastname || !this.phone || !this.password){
                this.error = "Kindly insert all fields";
                new Toasteur().error(this.error);
                return;
            }
            if(!validPassword){
                new Toasteur().error("password too weak");
                return
            }

            if ( !validatePhoneNumber(this.phone) ){
                swal("Invalid Phone Number");
                return;
            }

            let data = new FormData();

            data.append('email', this.email);
            data.append('firstname', this.firstname);
            data.append('lastname', this.lastname);
            data.append('phone', validatePhoneNumber(this.phone));
            data.append('refer_code', this.ref_code);
            data.append('password', this.password);

            const url = `${this.baseurl}api/accounts/register.php`;
            const options = {
                method: "POST",
                url,
                data
            }
                
            try {
                this.loading = true
                const response = await axios(options);

                if (response.data.data) {
                    const dataValues = response.data.data;
                    this.success =response.data.text;
                    const token = dataValues.auth.token;
                    localStorage.setItem("token", token);
                    new Toasteur().success(this.success);
                    window.location.href ="./index.php";
                    
                }
            } catch (error) {
                if (error.response){
                    if (error.response.status == 400){
                        this.error = error.response.data.text;
                        new Toasteur().error(this.error);
                        return
                    }
    
                    if (error.response.status == 500){
                        this.error = error.response.data.text;
                        new Toasteur().error(this.error);
                        return
                    }
                }

                this.error = error.message || "Error Processing Request"
                new Toasteur().error(this.error);
            } finally {
                this.loading = false
            }
            
        },
        async forgotPassword(){
            if (!this.username){
                this.error = "Insert all fields"
                new Toasteur().error(this.error);
            }
            const data = new FormData();
            data.append('username', this.username);

            const headers = {
                "Content-type": "application/json"
            }

            try {
                this.loading = true
                const response = await axios.post(`${this.baseurl}api/accounts/forgotpass.php`, data, {headers});

                if (response.data.data) {
                    this.success = response.data.text;
                    new Toasteur().success(this.success);
                    window.location.href="login.php"; 
                }
            } catch (error) {
                // console.log(error);
                if (error.response){
                    if (error.response.status == 400){
                        this.error = error.response.data.text;
                        new Toasteur().error(this.error);
                        return
                    }
    
                    if (error.response.status == 401){
                        this.error = "User not Authorized";
                        new Toasteur().error(this.error);
                        return
                    }
    
                    if (error.response.status == 405){
                        this.error = error.response.data.text;
                        new Toasteur().error(this.error);
                        return
                    }
    
                    if (error.response.status == 500){
                        this.error = error.response.data.text;
                        new Toasteur().error(this.error);
                        return
                    }
                }
                this.error = error.message || "Error Processing Request"
                new Toasteur().error(this.error);
            } finally {
                this.loading = false
            }


        },
    },
    async mounted(){
        try {
            this.loading = true
            const urlParams = new URLSearchParams(window.location.search);
            const myParam = urlParams.get('code');

            this.ref_code =  (myParam)? myParam : "";
            
        } catch (error) {
            this.error = error.message || "Error Fetching Request"
            new Toasteur().error(this.error);
        }finally{
            this.loading = false
        }
    }
});

authApp.mount("#auth");

const validatePhoneNumber = (input) => {
    const regExp = /^[0-9,+]+$/
    const phone = input;
    const validate = phone.match(regExp);
    var number;
    var bool;
    if (validate){
        const test = phone.includes("+234");
        const secondTest = (test) ? phone.includes("+2340") : false;
        
        (test && secondTest) ? number = phone.replace("+2340", "0") : "";
        (test && !secondTest) ? number = phone.replace("+234", "0"): ""  
        
        const thirdTest = (!test && !secondTest)? phone.includes("234") : false;
        const fourthTest = (thirdTest) ? phone.includes("2340") : false;

        (thirdTest && fourthTest) ? number = phone.replace("2340", "0"):  "";
        (thirdTest && !fourthTest) ? number = phone.replace("234", "0"):  "";


       
        if (!number){
            const finalTest = phone.startsWith("0")
            if (finalTest){
                (phone.length < 11 || phone.length > 11) ? number = false : number = phone; 
                return number
            }else{
                bool = false
                return bool
            }
        }else{
            (number.length < 11 || number.length > 11) ? number = false : number = number;
            return number 
        } 

    } else {  
        bool = false
        return bool;
    }
}

const validatePassword = (input)=>{
    let lowerletters = /[a-z]/g;
    let numbers = /[0-9]/g ;
    let uppercase =  /[A-Z]/g;
    let specialChar = /[^A-Za-z0-9]/g
    let charLength = /^.{6,}$/g
    
    const isNumbers = input.match(numbers)
    const isLowerCase = input.match(lowerletters)
    const isUpperCase = input.match(uppercase)
    const isSpecialChar = input.match(specialChar)
    const isCharLength = input.match(charLength)
    if(isLowerCase && isUpperCase && isSpecialChar && isNumbers && isCharLength){
        return true
    }else{
        return false
    }
}

const validatePassword1 =(input)=>{
//     let passwordRegex = /^[a-zA-Z0-9!@#\$%\^\&*\)\(+=._-]{6,}$/g;
//     const valid = input.match(passwordRegex)
    var strongRegex = new RegExp("^(?=.*[a-z])(?=.*[A-Z])(?=.*[0-9])(?=.*[!@#\$%\^&\*])(?=.{8,})");
    var mediumRegex = new RegExp("^(((?=.*[a-z])(?=.*[A-Z]))|((?=.*[a-z])(?=.*[0-9]))|((?=.*[A-Z])(?=.*[0-9])))(?=.{6,})");
    const strongPass = input.match(strongRegex)
    const mediumPass = input.match(mediumRegex)
    if(valid){
        return true;
    }else{
        return false;
    }
}