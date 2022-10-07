let authApp = Vue.createApp({
    data(){
        return{
            email: null,
            username: null,
            firstname: null,
            lastname: null,
            phone: null,
            password: null,
            ref_code: null,
            accessToken: null,
            confirmPassword: null,
            confirm_password: null,
            loading: null,
            error: null,
            baseurl: "http://localhost/shortleters/"
        }
    },
    methods: { 
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
                    // if(response.data.data.googleStatus ==1){
                    //     //already logged in
                    //     window.location.href='../user/index.php'
                    // }else{
                    //     //click on the link
                    //     const uri = response.data.data.redirectLink;
                    //     console.log("uri", uri);
                    //     window.location.href= uri;

                    // }
                    console.log(response.data);
                    this.success = response.data.text;;
                    const token = response.data.authtoken;
                    localStorage.setItem("token", token);
                    swal(this.success);
                    window.location.href ="/index.php";
                
                    
                }else{
                    this.user_booking = null;
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
        async log(name){
            console.log("name", name)
        },
        async loginUser() {
            if (!this.email || !this.password){
                this.error = "Kindly Enter all Fields"
                swal(this.error);
                return
            }
           

            let data = new FormData();
            data.append('email', this.email);
            data.append('password', this.password);

            try {
                this.loading = true
                const response = await axios.post(`http://localhost/cart.ng2/api/accounts/login.php`, data, {
                    headers: { "Content-type": "application/json"}
                });

                if (response.data.status) {
                    console.log(response.data);
                    this.success = response.data.text;
                    const dataValues = response.data.data;
                    const token = dataValues.authtoken;
                    localStorage.setItem("token", token);
                    swal(this.success);
                    window.location.href ="user/index.php";
                }
            } catch (error) {
               if (error.response){
                    if (error.response.status == 400){
                        this.error = error.response.data.text;
                        swal(this.error);
                        return;
                    }

                    if (error.response.status == 405){
                        this.error = error.response.data.text;
                        swal(this.error);
                        return;
                    }

                    if (error.response.status == 500){
                        this.error = error.response.data.text;
                        swal(this.error);
                        return;
                    }

               }else{
                    this.error = error.message || "Error processing request"
                    swal(this.error);
               }
                
                
            } finally {
                this.loading = false
            }
        },
        async adminLogin() {
            if (!this.email || !this.password){
                this.error = "Kindly Enter all Fields"
                swal(this.error);
                return
            }
           

            let data = new FormData();
            data.append('email', this.email);
            data.append('password', this.password);

            try {
                this.loading = true
                const response = await axios.post(`http://localhost/shortleters/api/admin/adminLogin.php`, data, {
                    headers: { "Content-type": "application/json"}
                });

                if (response.data.status) {
                    console.log(response.data);
                    this.success = response.data.text;
                    const dataValues = response.data.data;
                    const token = dataValues.authtoken;
                    localStorage.setItem("authToken", token);
                    swal(this.success);
                    window.location.href ="./index.php";
                }
            } catch (error) {
               if (error.response){
                    if (error.response.status == 400){
                        this.error = error.response.data.text;
                        swal(this.error);
                        return;
                    }

                    if (error.response.status == 405){
                        this.error = error.response.data.text;
                        swal(this.error);
                        return;
                    }

                    if (error.response.status == 500){
                        this.error = error.response.data.text;
                        swal(this.error);
                        return;
                    }

               }else{
                    this.error = error.message || "Error processing request"
                    swal(this.error);
               }
                
                
            } finally {
                this.loading = false
            }
        },
        async adminForgotPass(){
            if (!this.username){
                this.error = "Insert all fields"
                swal(this.error);
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
                        swal(this.error);
                        return
                    }
    
                    if (error.response.status == 405){
                        this.error = error.response.data.text;
                        swal(this.error);
                        return
                    }
    
                    if (error.response.status == 500){
                        this.error = error.response.data.text;
                        swal(this.error);
                        return
                    }
                }
                this.error = error.message || "Error Processing Request"
                swal(this.error);
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
                swal(this.error);
                return
            }

            if (!this.confirm_password || !this.password){
                this.error = "Kindly Enter all fields"
                swal(this.error);

            }
            if (this.confirm_password !== this.password){
                this.error = "Password Does not match"
                swal(this.error);

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
                        swal(this.error);
                        return
                    }
    
                    if (error.response.status == 405){
                        this.error = error.response.data.text;
                        swal(this.error);
                        return
                    }
    
                    if (error.response.status == 500){
                        this.error = error.response.data.text;
                        swal(this.error);
                        return
                    }
                }

                this.error = error.message || "Error Processing Request"
                swal(this.error);
                
            } finally {
                this.loading = false;
            }
        },
        async shopLogin() {
            if (!this.email || !this.password){
                this.error = "Kindly Enter all Fields"
                swal(this.error);
                return
            }
           

            let data = new FormData();
            data.append('shop_email', this.email);
            data.append('shop_password', this.password);

            try {
                this.loading = true
                const response = await axios.post(`http://localhost/cart.ng2/api/shops/shopLogin.php`, data, {
                    headers: { "Content-type": "application/json"}
                });

                if (response.data.status) {
                    console.log(response.data);
                    this.success = response.data.text;
                    const dataValues = response.data.data;
                    const token = dataValues.authToken;
                    localStorage.setItem("authToken", token);
                    swal(this.success);
                    window.location.href ="./index.php";
                }
            } catch (error) {
               if (error.response){
                    if (error.response.status == 400){
                        this.error = error.response.data.text;
                        swal(this.error);
                        return;
                    }

                    if (error.response.status == 405){
                        this.error = error.response.data.text;
                        swal(this.error);
                        return;
                    }

                    if (error.response.status == 500){
                        this.error = error.response.data.text;
                        swal(this.error);
                        return;
                    }

               }else{
                    this.error = error.message || "Error processing request"
                    swal(this.error);
               }
                
                
            } finally {
                this.loading = false
            }
        },
        async shopForgotPass(){
            if (!this.username){
                this.error = "Insert all fields"
                swal(this.error);
            }
            const data = new FormData();
            data.append('username', this.username);

            const headers = {
                "Content-type": "application/json"
            }

            try {
                this.loading = true
                const response = await axios.post(`${this.baseurl}api/shops/forgotpass.php`, data, {headers});

                if (response.data.data) {
                    this.success = response.data.text;
                    new Toasteur().success(this.success);
                }
            } catch (error) {
                // console.log(error);
                if (error.response){
                    if (error.response.status == 400){
                        this.error = error.response.data.text;
                        swal(this.error);
                        return
                    }
    
                    if (error.response.status == 405){
                        this.error = error.response.data.text;
                        swal(this.error);
                        return
                    }
    
                    if (error.response.status == 500){
                        this.error = error.response.data.text;
                        swal(this.error);
                        return
                    }
                }
                this.error = error.message || "Error Processing Request"
                swal(this.error);
            } finally {
                this.loading = false
            }


        },
        async shop_resetPassword(){

            const urlParams = new URLSearchParams(window.location.search);
            const token = (urlParams.get('token'))? urlParams.get('token') : null ;

            if (!token){
                this.error = "Kindly check your mail for the valid rest password link"
                swal(this.error);
                return
            }

            if (!this.confirm_password || !this.password){
                this.error = "Kindly Enter all fields"
                swal(this.error);

            }
            if (this.confirm_password !== this.password){
                this.error = "Password Does not match"
                swal(this.error);

            }

            const headers = { "Content-type": "application/json"}

            const data = new FormData();
            data.append('password', this.password);
            data.append('token', token);

            
            try {
                this.loading = true
                const response = await axios.post(`${this.baseurl}api/shops/resetPassword.php`, data, {headers});
                if ( response.data.status ){
                    this.success = response.data.text;
                    window.location.href="./auth-success.php";
                }          
            } catch (error) {
                if (error.response){
                    if (error.response.status == 400){
                        this.error = error.response.data.text;
                        swal(this.error);
                        return
                    }
    
                    if (error.response.status == 405){
                        this.error = error.response.data.text;
                        swal(this.error);
                        return
                    }
    
                    if (error.response.status == 500){
                        this.error = error.response.data.text;
                        swal(this.error);
                        return
                    }
                }

                this.error = error.message || "Error Processing Request"
                swal(this.error);
                
            } finally {
                this.loading = false;
            }
        },
        async logisticsLogin() {
            if (!this.email || !this.password){
                this.error = "Kindly Enter all Fields"
                swal(this.error);
                return
            }
           

            let data = new FormData();
            data.append('email', this.email);
            data.append('password', this.password);

            try {
                this.loading = true
                const response = await axios.post(`http://localhost/cart.ng2/api/logistics/logisticLogin.php`, data, {
                    headers: { "Content-type": "application/json"}
                });

                if (response.data.status) {
                    console.log(response.data);
                    this.success = response.data.text;
                    const dataValues = response.data.data;
                    const token = dataValues.authtoken;
                    localStorage.setItem("authToken", token);
                    swal(this.success);
                    window.location.href ="./index.php";
                }
            } catch (error) {
               if (error.response){
                    if (error.response.status == 400){
                        this.error = error.response.data.text;
                        swal(this.error);
                        return;
                    }

                    if (error.response.status == 405){
                        this.error = error.response.data.text;
                        swal(this.error);
                        return;
                    }

                    if (error.response.status == 500){
                        this.error = error.response.data.text;
                        swal(this.error);
                        return;
                    }

               }else{
                    this.error = error.message || "Error processing request"
                    swal(this.error);
               }
                
                
            } finally {
                this.loading = false
            }
        },
        async logisticsForgotPass(){
            if (!this.username){
                this.error = "Insert all fields"
                swal(this.error);
            }
            const data = new FormData();
            data.append('username', this.username);

            const headers = {
                "Content-type": "application/json"
            }

            try {
                this.loading = true
                const response = await axios.post(`${this.baseurl}api/logistics/forgotpass.php`, data, {headers});

                if (response.data.data) {
                    this.success = response.data.text;
                    new Toasteur().success(this.success);
                }
            } catch (error) {
                // console.log(error);
                if (error.response){
                    if (error.response.status == 400){
                        this.error = error.response.data.text;
                        swal(this.error);
                        return
                    }
    
                    if (error.response.status == 405){
                        this.error = error.response.data.text;
                        swal(this.error);
                        return
                    }
    
                    if (error.response.status == 500){
                        this.error = error.response.data.text;
                        swal(this.error);
                        return
                    }
                }
                this.error = error.message || "Error Processing Request"
                swal(this.error);
            } finally {
                this.loading = false
            }


        },
        async logistics_resetPassword(){

            const urlParams = new URLSearchParams(window.location.search);
            const token = (urlParams.get('token'))? urlParams.get('token') : null ;

            if (!token){
                this.error = "Kindly check your mail for the valid rest password link"
                swal(this.error);
                return
            }

            if (!this.confirm_password || !this.password){
                this.error = "Kindly Enter all fields"
                swal(this.error);

            }
            if (this.confirm_password !== this.password){
                this.error = "Password Does not match"
                swal(this.error);

            }

            const headers = { "Content-type": "application/json"}

            const data = new FormData();
            data.append('password', this.password);
            data.append('token', token);

            
            try {
                this.loading = true
                const response = await axios.post(`${this.baseurl}api/logistics/resetPassword.php`, data, {headers});
                if ( response.data.status ){
                    this.success = response.data.text;
                    window.location.href="./auth-success.php";
                }          
            } catch (error) {
                if (error.response){
                    if (error.response.status == 400){
                        this.error = error.response.data.text;
                        swal(this.error);
                        return
                    }
    
                    if (error.response.status == 405){
                        this.error = error.response.data.text;
                        swal(this.error);
                        return
                    }
    
                    if (error.response.status == 500){
                        this.error = error.response.data.text;
                        swal(this.error);
                        return
                    }
                }

                this.error = error.message || "Error Processing Request"
                swal(this.error);
                
            } finally {
                this.loading = false;
            }
        },
        async registerUser() {
            if (!this.email || !this.username || !this.firstname || !this.lastname || !this.phone || !this.password){
                this.error = "Kindly insert all fields";
                swal(this.error);
                return;
            }

            if (this.password !== this.confirmPassword){
                this.error = "Password does not match";
                swal(this.error);
                return;
            }

            if ( !validatePhoneNumber(this.phone) ){
                swal("Invalid Phone Number");
                return;
            }

            let data = new FormData();

            data.append('email', this.email);
            data.append('firstname', this.firstname);
            data.append('lastname', this.lastname);
            data.append('username', this.username);
            data.append('phone', validatePhoneNumber(this.phone));
            data.append('refer_code', this.ref_code);
            data.append('password', this.password);

            try {
                this.loading = true
                const response = await axios.post(`http://localhost/cart.ng2/api/accounts/register.php`, data, {
                    headers: { "Content-type": "application/json"}
                });

                if (response.data.data) {
                    const dataValues = response.data.data;
                    this.success =response.data.text;
                    const token = dataValues.auth.token;
                    localStorage.setItem("token", token);
                    swal(this.success);
                    window.location.href ="user/index.php";
                    
                }
            } catch (error) {
                if (error.response){
                    if (error.response.status == 400){
                        this.error = error.response.data.text;
                        swal(this.error);
                        return
                    }
    
                    if (error.response.status == 500){
                        this.error = error.response.data.text;
                        swal(this.error);
                        return
                    }
                }

                this.error = error.message || "Error Processing Request"
                swal(this.error);
            } finally {
                this.loading = false
            }
            
        },
        async forgotPassword(){
            if (!this.username){
                this.error = "Insert all fields"
                swal(this.error);
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
                    swal(this.success);
                    window.location.href="login.php"; 
                }
            } catch (error) {
                // console.log(error);
                if (error.response){
                    if (error.response.status == 400){
                        this.error = error.response.data.text;
                        swal(this.error);
                        return
                    }
    
                    if (error.response.status == 401){
                        this.error = "User not Authorized";
                        swal(this.error);
                        return
                    }
    
                    if (error.response.status == 405){
                        this.error = error.response.data.text;
                        swal(this.error);
                        return
                    }
    
                    if (error.response.status == 500){
                        this.error = error.response.data.text;
                        swal(this.error);
                        return
                    }
                }
                this.error = error.message || "Error Processing Request"
                swal(this.error);
            } finally {
                this.loading = false
            }


        },
        async resetPassword(){

            const urlParams = new URLSearchParams(window.location.search);
            const token = (urlParams.get('token'))? urlParams.get('token') : null ;

            if (!token){
                this.error = "Kindly check your mail for the valid rest password link"
            }

            const headers = { "Content-type": "application/json"}

            const data = new FormData();
            data.append('password', this.password);

            
            try {
                this.loading = true
                const response = await axios.post(`${this.baseurl}api/accounts/resetpassword.php?token=${token}`, data, {headers});
                if ( response.data.status ){
                    this.success = response.data.text;
                    swal(this.success);
                    window.location.href="login.php";
                }          
            } catch (error) {
                if (error.response){
                    if (error.response.status == 400){
                        this.error = error.response.data.text;
                        swal(this.error);
                        return
                    }
    
                    if (error.response.status == 401){
                        this.error = "User not Authorized";
                        swal(this.error);
                        return
                    }
    
                    if (error.response.status == 405){
                        this.error = error.response.data.text;
                        swal(this.error);
                        return
                    }
    
                    if (error.response.status == 500){
                        this.error = error.response.data.text;
                        swal(this.error);
                        return
                    }
                }

                this.error = error.message || "Error Processing Request"
                swal(this.error);
                
            } finally {
                this.loading = false;
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
            swal(this.error);
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