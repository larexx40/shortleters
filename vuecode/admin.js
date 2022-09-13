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

function WordCount(str) {
    return str.split(' ')
           .filter(function(n) { return n != '' })
           .length;
}

const generatePassword = () => {
    var chars = "0123456789abcdefghijklmnopqrstuvwxyz!@#$%^&*()ABCDEFGHIJKLMNOPQRSTUVWXYZ";
    var passwordLength = 12;
    var password = "";

    for (var i = 0; i <= passwordLength; i++) {
        var randomNumber = Math.floor(Math.random() * chars.length);
        password += chars.substring(randomNumber, randomNumber +1);
    }

    return password;
}

const urlPath = window.location.pathname.split("/");
const length = urlPath.length;
const webPage = urlPath[length -1];

let admin = Vue.createApp({
    data(){
        return{
            length: null,
            storeStatistics: null,
            topProductOrdered: null,
            recentOrders: null,
            productReviews: null,
            //secondmerge
            superAdmin: null,
            sortPost: null,
            sortDays: null,
            sortDraft: null,
            blog_details: null,
            arrayIndex: null,
            itemDetails: null,
            addresses: null,
            //lanre data @S 
            minsToRead: null,
            blogContent: null,
            blogHeadline: null,
            apiName: null,
            secretKey: null,
            apiKey: null,
            apiWallet: null,
            apiMerchant: null,
            apiAccno: null,
            apiUsername: null,
            apiPassword: null,
            sendFrom: null,
            emailFrom: null,
            sendType: null,
            apiToken: null,
            routing: null,
            smsChannel: null,
            smsType: null,
            monifys: null,
            monify_details: null,
            kudis: null,
            kudi_details: null,
            payStacks: null,
            payStack_details: null,
            sendGrids: null,
            sendGrid_details: null,
            termiApis: null,
            termiApi_details: null,
            smartSolutions: null,
            smartSolution_details: null,
            logisticLocations: null,
            logisticPrices: null,
            logisticLocation_details: null,
            logisticPrice_details: null,
            order_details: null,
            getAdmin_details:null,
            admin_details: null,
            admin_initials: null,
            price_currentPage: null,
            price_totalData: null,
            price_totalPage: null,
            location_currentPage: null,
            location_totalData: null,            
            location_totalPage: null,
            currentPage: null,
            totalData: null,
            totalPage: null,
            sort: null,
            search: null,
            per_page: null,
            blogs: null,
            blogCount: null,
            logistics:null,
            admins:null,
            shops: null,
            customers: null,
            carts: [],
            orders: null,
            refNo: null,
            trackid: null,
            track_id: null,
            order_status: null,
            baseUrl:'http://localhost/shortleters/',
            authToken: null,
            email: null,
            ref_link: null,
            admin_details: null,
            logistics_initials: null,
            currentPassword: null,
            newPassword: null,
            newPassword1: null,
            username: null,
            firstname: null,
            lastname: null,
            fullname: null,
            phoneno: null,
            state: null,
            locationid: "",
            minWeight: null,
            maxWeight: null,
            price: null,
            locationName: null,
            longitude: null,
            latitude: null,
            loading: false,
            success: null,
            error: null,
            // korede data
            kor_page: 1,
            kor_total_page: null,
            kor_total_data: null,
            kor_per_page: 8,
            kor_sort: null,
            kor_search: null,
            complains: null,
            complain: null,
            kor_file: null,
            sliders: null,
            slider: null,
            slider_name: null,
            slider_type: null,
            slider_product: null,
            slider_desc: null,
            shops: null,
            shop: null,
            shop_details: null,
            shop_locations: null,
            shop_location: null,
            shop_products: null,
            shop_product: null,
            shopname: null,
            shop_country: null,
            shop_city: null,
            shop_password: null,
            shop_email: null,
            shop_phone: null,
            shop_whatsapp: null,
            shop_type: null,
            shop_currency: "Naira",
            users: null,
            user: null,
            user_details: null,
            user_orders: null,
            user_order: null,
            user_notifications: null,
            user_notification: null,
            user_complains: null,
            user_complain: null,
            user_activities: null,
            user_activity: null,
            user_addresses: null,
            user_address: null,
            user_transactions: null,
            user_transaction: null,
            all_transactions: null,
            transaction: null,
            all_products: null,
            product: null,
            all_categories: null,
            category_name: null,
            category_description: null,
            category: null,
            all_sub_categories: null,
            sub_category: null,
            sub_category_name: null,
            category_id: null,
            all_brands: null,
            brand: null
        }
    },
    async created() {
        this.getToken();
        let adminid = (localStorage.getItem("adminid")) ? localStorage.getItem("adminid"): null;
        let logisticid = (localStorage.getItem("logisticid")) ? localStorage.getItem("logisticid"): null;
        let orderRefno = (localStorage.getItem("orderRefno")) ? localStorage.getItem("orderRefno"): null;
        //console.log('page', webPage);
        this.loading = true;
        this.blogs = null;
        this.logistics = null;
        this.admins = null;
        this.orders = null;
        this.order_details = null;
        if(webPage == 'posts.php'){
            //console.log('token', this.authToken);
            //console.log("in posts");
            await this.getAllBlog();
        }

        if(webPage == 'logistics.php'){
            //console.log("in logistics");
            await this.getAllLogistics();
        }

        if(webPage == "admins.php"){ 
            //console.log("in Admin");
            await this.getAllAdmin();
        }
        if(webPage == 'orders.php'){
            //console.log("in orders");
            await this.getAllCarts();
        }

        if(webPage == 'admin-details.php'){
            //get adminid from localstorage
            if(adminid){
                await this.getAdminByid(adminid)
            }else{
                window.location.href = 'admins.php'
            }
            
        }
        if(webPage == 'logistics-details.php'){
            //get logisticid from localstorage
            if(logisticid){
                await this.getLogisticByid(logisticid)
            }else{
                window.location.href = 'logistics.php'
            }
        }
        if(webPage == 'invoice-details.php' || webPage == 'invoice-print.php' ){
            //get orderrefno from localStorage
            if(orderRefno){
                //console.log('orderRefno ', orderRefno);
                this.loading = true;
                await this.getCartByOrderRefno(orderRefno);
                await this.getOrderByOrderRefno(orderRefno);
            }else{
                window.location.href = 'orders.php';
            }
        }
        if(webPage =='monify.php'){
            await this.getAllMonify()
        }
        if(webPage =='paystack.php'){
            await this.getAllPaystack()
        }
        if(webPage =='kudi.php' ){
            await this.getAllKudi();
        }
        if(webPage =='smartsolution.php'){
            await this.getAllSmartSolution();
        }
        if(webPage =='sendgrid.php'){
            await this.getAllSendGrid()
        }
        if(webPage == 'termiapi.php'){
            await this.getTermiApi();
        }
        if(webPage == 'addresses.php'){
            await this.getAllAddresses();
        }
        //end of 2nd merge
        if(webPage == 'single-product.php'){
            if(productid){
                await this.getProductReview(id);
            }else{
                window.location.href=""
            }
        }
        if(webPage == 'index.php'){
            await this.getRecentOrder();
            await this.getTopProductOrdered();
            await this.getstoreStatistics();
        }
        
    },
    methods: {
        //LanreWaju Method
          //address
          async getAllAddresses(){
            let search = (this.search)? `&search=${this.search}`: '';
            let sort = (this.sort != null) ? `&sort=1&sortStatus=${this.sort}` : "";  
            let page = ( this.currentPage )? this.currentPage : 1;
            let noPerPage = ( this.per_page ) ? this.per_page : 4;
            const url = `${this.baseUrl}api/deliveryAddress/getAllAddress.php?noPerPage=${noPerPage}&page=${page}${search}${sort}`;
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
                    this.addresses = response.data.data.deliveryAddress;
                    this.currentPage =response.data.data.page;
                    this.totalData =response.data.data.total_data;
                    this.totalPage =response.data.data.totalPage;
                    //console.log("ApiDelivery address", response.data.data.deliveryAddress);
                }else{
                    this.addresses = null;
                    this.currentPage =0;
                    this.totalData =0;
                    this.totalPage =0;
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
                        // window.location.href="/login.php"
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
        //admin
        async adminLogin(){
            const email = this.email;
            const password = this.password
            if(email == null || password == null){
                this.error = "Kindly Enter all Fields"
                new Toasteur().error(this.error);;
            }

            let data = new FormData();
            data.append('email', this.email);
            data.append('password', this.password);

            const url = `${this.baseUrl}/api/admin/adminLogin`;

            const options = {
                method: "POST",
                data: data,
                url
            }


            try {
                const response = await axios(options);
                Swal.fire(response.data.text);
                if(response.data.status){
                    this.adminid = response.data.data.id;
                    this.name = response.data.data.name;
                    this.username = response.data.data.username;
                    this.email = response.data.data.email;
                    this.authToken = response.data.data.authToken;
                    this.superAdmin = response.data.data.superAdmin;
                    this.status = response.data.data.status;

                    window.localStorage.setItem("authToken", response.data.data.authToken);
                    //redirect to index
                    window.location.href = "../index.html"
                }
                //console.log(response.data);

            } catch (error) {
                ////console.log(error);
                if (error.response.status == 400){
                    const errorMsg = error.response.data.text;
                    new Toasteur().error(errorMsg);
                    return
                }

                if (error.response.status == 401){
                    const errorMsg = "User not Authorized";
                    new Toasteur().error(errorMsg);
                    // // // window.location.href="./login.php"
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
        },
        async addAdmin(){
            if(this.email == null || this.username == null || this.name == null ||this.password == null){
                new Toasteur().error("Kindly fill all fields")
            }

            let data = new FormData();
            data.append('email', this.email );
            data.append('username', this.username );
            data.append('password', this.password );
            data.append('name', this.name );

            const url = `${this.baseUrl}api/admin/addAdmin.php`;

            const options = {
                method: "POST",
                data: data,
                url,
                headers: { 
                    //"Content-type": "application/json",
                    "Authorization": `Bearer ${this.authToken}`
                }
            }

            try {
                this.loading = true;
                const response = await axios(options); 
                if(response.data.data.status){
                    Swal.fire(response.data.text);
                }
            }catch (error) {
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
                        // // window.location.href="./login.php"
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
        async getstoreStatistics(){
            const url = `${this.baseUrl}api/admin/storeStatistics.php`;
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
                let response = await axios(options)
                if ( response.data.status ){
                    this.storeStatistics = response.data.data.storeStatistics;
                    

                }else {
                    this.storeStatistics=null;
                }
                
            } catch (error) {
                if (error.response){
                    if (error.response.status === 400){
                        this.error = error.response.data.error.text
                        new Toasteur().error(this.error);;
                        //console.log("error", this.error);
                    }
                    if (error.response.status === 405){
                        this.error = error.response.data.error.text
                        new Toasteur().error(this.error);;
                        //console.log("error", this.error);
                    }
                    if (error.response.status === 500){
                        this.error = error.response.data.error.text
                        new Toasteur().error(this.error);;
                        //console.log("error", this.error);
                    }
                }else{
                    this.error = error.message || "Error processing request"
                    new Toasteur().error(this.error);;
                    //console.log("error", this.error);
                }
            }finally {
                this.loading = false;
            }
        },
        async getAdminDetails(){
            const url = `${this.baseUrl}api/admin/getAdminDetails.php`;
            const options = {
                method: "GET",
                headers: { 
                    //"Content-type": "application/json",
                    "Authorization": `Bearer ${this.authToken}`
                },
                url
            }

            try {
                this.admin_details = null;
                this.loading = true;
                let response = await axios(options)
                if ( response.data.status ){
                    this.admin_details = response.data.data;
                    this.superAdmin = response.data.data.superadmin;
                    const strings = this.admin_details.name.split(" ");
                    const initials = `${strings[0].charAt(0)} ${strings[1].charAt(0)}`;
                    this.admin_initials = initials.toUpperCase();
                    await this.getRecentOrder();

                    if ( webPage === "complaints.php"){
                        await this.comp_getAllComplains();
                    }
                    if (webPage === "sliders.php"){
                        await this.getAllSliders();
                        await this.getAllProducts(3, 4);
                    }
                    if (webPage === "shops.php"){
                        await this.getAllShops();
                    }
                    if (webPage === "customers.php"){
                        await this.getAllUsers();
                    }
                    if (webPage === "transactions.php"){
                        await this.getAllTransactions();
                    }
                    if (webPage === "products.php"){
                        await this.getAllProducts();
                    }
                    if ( webPage === "category.php" ){
                        await this.getAllCategories();
                    }
                    if ( webPage === "sub_categories.php" ){
                        await this.getAllCategories(4,4);
                        await this.getAllSubCategories();
                    }
                    if ( webPage === "brands.php" ){
                        await this.getAllBrands();
                    }
                }
                
            } catch (error) {
                if (error.response){
                    if (error.response.status === 400){
                        this.error = error.response.data.error.text
                        new Toasteur().error(this.error);;
                        //console.log("error", this.error);
                    }
                    if (error.response.status === 401){
                        this.error = error.response.data.error.text
                        // new Toasteur().error(this.error);
                        // window.location.href = "./login.php"
                    }
                    if (error.response.status === 405){
                        this.error = error.response.data.error.text
                        new Toasteur().error(this.error);;
                        //console.log("error", this.error);
                    }
                    if (error.response.status === 500){
                        this.error = error.response.data.error.text
                        new Toasteur().error(this.error);;
                        //console.log("error", this.error);
                    }
                }else{
                    this.error = error.message || "Error processing request"
                    new Toasteur().error(this.error);;
                    //console.log("error", this.error);
                }
            }finally {
                this.loading = false;
            }
        },
        async deleteAdmin(id){
            let data = new FormData();
            data.append('id', id );

            const url = `${this.baseUrl}api/admin/deleteAdmin.php`;

            const options = {
                method: "POST",
                data: data,
                headers: { 
                    //"Content-type": "application/json",
                    "Authorization": `Bearer ${this.authToken}`
                },
                url
            }
            try {
                const response = await axios(options);
                if(response.data.status){
                    Swal.fire(response.data.text)
                }    
            } catch (error) {
                if (error.response.status == 400){
                    const errorMsg = error.response.data.text;
                    new Toasteur().error(errorMsg);
                    return
                }

                if (error.response.status == 401){
                    const errorMsg = "User not Authorized";
                    new Toasteur().error(errorMsg);
                    // // window.location.href="./login.php"
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
        },
        async changeAdminPassword(){

            if(!this.newPassword || !this.newPassword1 || !this.currentPassword){
                new Toasteur().error("Input all fields")
            }

            if(this.newPassword !== this.newPassword1){
                new Toasteur().error("Password not the same")
            }else{
                const data = new FormData();
                data.append('currentPassword', this.currentPassword);
                data.append('newPassword', this.newPassword);

                const url = `${this.baseUrl}api/admin/changePassword.php`;
                const options = {
                    method: "POST",
                    headers: { 
                        //"Content-type": "application/json",
                        "Authorization": `Bearer ${this.authToken}`
                    },
                    data,
                    url
                }
                try {
                    this.loading = true;
                    let response = await axios(options)
                    if ( response.data.status ){
                        new Toasteur().success('Password Changed');
                    }
                    
                } catch (error) {
                    if (error.response){
                        if (error.response.status === 400){
                            this.error = error.response.data.error.text
                            new Toasteur().error(this.error);;
                        }
                        if (error.response.status === 405){
                            this.error = error.response.data.error.text
                            new Toasteur().error(this.error);;
                        }
                        if (error.response.status === 500){
                            this.error = error.response.data.error.text
                            new Toasteur().error(this.error);;
                        }
                    }else{
                        this.error = error.message || "Error processing request"
                        new Toasteur().error(this.error);;
                    }
                }finally {
                    this.loading = false;
                }
            }

            
        },
        async changeAdminStatus(id){
            let data = new FormData();
            data.append('id', id );

            const url = `${this.baseUrl}api/admin/changeAdminStatus.php`;

            const options = {
                method: "POST",
                data,
                headers: { 
                    //"Content-type": "application/json",
                    "Authorization": `Bearer ${this.authToken}`
                },
                url
            }
            try {
                const response = await axios(options);
                if(response.data.status){
                    Swal.fire(response.data.text)
                }     
            } catch (error) {
                if (error.response.status == 400){
                    const errorMsg = error.response.data.text;
                    new Toasteur().error(errorMsg);
                    return
                }

                if (error.response.status == 401){
                    const errorMsg = "User not Authorized";
                    new Toasteur().error(errorMsg);
                    // // window.location.href="./login.php"
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
        },
        async getAllAdmin(load = 1){
            let search = (this.search)? `&search=${this.search}`: '';
            let sort = (this.sort != null) ? `&sort=1&sortStatus=${this.sort}` : "";  
            let page = ( this.currentPage )? this.currentPage : 1;
            let noPerPage = ( this.per_page ) ? this.per_page : 4;
            const url = `${this.baseUrl}api/admin/getAllAdmin.php?noPerPage=${noPerPage}&page=${page}${search}${sort}`;
            //console.log('URL', url);
            const options = {
                method: "GET",
                headers: { 
                    //"Content-type": "application/json",
                    "Authorization": `Bearer ${this.authToken}`
                },
                url
            }
            try {
                if(load == 1){
                    this.loading = true;
                }
                const response = await axios(options);
                if(response.data.status){
                    this.admins = response.data.data.admins;
                    this.currentPage =response.data.data.page;
                    this.totalData =response.data.data.total_data;
                    this.totalPage =response.data.data.totalPage;
                    //console.log("APIadmins", response.data.data.admins);
                }else{
                    this.admins = null;
                    this.currentPage =0;
                    this.totalData =0;
                    this.totalPage =0;
                }         
            } catch (error) {
                ////console.log(error);
                if (error.response.status == 400){
                    const errorMsg = error.response.data.text;
                    new Toasteur().error(errorMsg);
                    return
                }

                if (error.response.status == 401){
                    const errorMsg = "User not Authorized";
                    new Toasteur().error(errorMsg);
                    // // window.location.href="./login.php"
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
            }finally{
                this.loading = false;
            }
        },
        async getAdminByid(adminid){
            //console.log("adminid",adminid);
            const url = `${this.baseUrl}api/admin/getAdminbyid.php?id=${adminid}`;
            const options = {
                method: "GET",
                headers: { 
                    //"Content-type": "application/json",
                    "Authorization": `Bearer ${this.authToken}`
                },
                url
            }

            try {
                this.getAdmin_details = null;
                this.loading = true;
                let response = await axios(options)
                if ( response.data.status ){
                    //console.log('getAdmin_details', response.data.data);
                    this.getAdmin_details = response.data.data;
                    const strings = this.getAdmin_details.name.split(" ");
                    const initials = `${strings[0].charAt(0)} ${strings[1].charAt(0)}`;
                    this.getAdmin_details.initials = initials.toUpperCase();
                    //console.log("initials", this.getAdmin_details.initials);
                }
                
            } catch (error) {
                if (error.response){
                    if (error.response.status === 400){
                        this.error = error.response.data.error.text
                        new Toasteur().error(this.error);;
                        //console.log("error", this.error);
                    }
                    if (error.response.status === 405){
                        this.error = error.response.data.error.text
                        new Toasteur().error(this.error);;
                        //console.log("error", this.error);
                    }
                    if (error.response.status === 500){
                        this.error = error.response.data.error.text
                        new Toasteur().error(this.error);;
                        //console.log("error", this.error);
                    }
                }else{
                    this.error = error.message || "Error processing request"
                    new Toasteur().error(this.error);;
                    //console.log("error", this.error);
                }
            }finally {
                this.loading = false;
            }
        },
        async updateAdmin(){
            if(this.admin_details.name == null ||this.admin_details.username == null ){
                new Toasteur().error("Kindly fill all fields")
            }else{
                let data = new FormData();
                data.append('name', this.admin_details.name );
                data.append('username', this.admin_details.username );

                const url = `${this.baseUrl}api/admin/updateAdmin.php`;

                const options = {
                    method: "POST",
                    data,
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
                        Swal.fire(response.data.text)
                        this.getAdminDetails();
                    }
                            
                } catch (error) {
                    ////console.log(error);
                    if (error.response.status == 400){
                        const errorMsg = error.response.data.text;
                        new Toasteur().error(errorMsg);
                        return
                    }

                if (error.response.status == 401){
                    const errorMsg = "User not Authorized";
                    new Toasteur().error(errorMsg);
                    // // window.location.href="./login.php"
                    return
                }

                    if (error.response.status == 401){
                        const errorMsg = "User not Authorized";
                        new Toasteur().error(errorMsg);
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
                }finally{

                }
            }
            
        },

        //logistics
        async addLogistic(){
            if(this.logisticEmail == null || this.logisticName == null ||this.logisticPassword == null){
                new Toasteur().error("Kindly fill all fields")
            }

            let data = new FormData();
            data.append('email', this.logisticEmail );
            data.append('password', this.logisticPassword );
            data.append('name', this.logisticName );

            const url = `${this.baseUrl}api/logistics/addLogistic.php`;

            const options = {
                method: "POST",
                data,
                url,
                headers: { 
                    //"Content-type": "application/json",
                    "Authorization": `Bearer ${this.authToken}`
                }
            }

            try {
                this.loading = true;
                const response = await axios(options); 
                if(response.data.status){
                    await this.getAllLogistics();
                    Swal.fire(response.data.text);
                    
                }
            } catch (error) {
                ////console.log(error);
                if (error.response.status == 400){
                    const errorMsg = error.response.data.text;
                    new Toasteur().error(errorMsg);
                    return
                }

                if (error.response.status == 401){
                    const errorMsg = "User not Authorized";
                    new Toasteur().error(errorMsg);
                    // // window.location.href="./login.php"
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
            }finally {
                this.loading = false;
            }
        },
        async deleteLogistics(id){
            let data = new FormData();
            data.append('id', id );

            const url = `${this.baseUrl}api/admin/deleteAdmin.php`;

            const options = {
                method: "POST",
                data: data,
                headers: { 
                    //"Content-type": "application/json",
                    "Authorization": `Bearer ${this.authToken}`
                },
                url
            }
            try {
                const response = await axios(options);
                if(response.data.status){
                    Swal.fire(response.data.text)
                }    
            } catch (error) {
                ////console.log(error);
                if (error.response.status == 400){
                    const errorMsg = error.response.data.text;
                    new Toasteur().error(errorMsg);
                    return
                }

                if (error.response.status == 401){
                    const errorMsg = "User not Authorized";
                    new Toasteur().error(errorMsg);
                    // // window.location.href="./login.php"
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
            }finally {
                this.loading = false;
            }
        },
        async getAllLogistics(){
            let search = (this.search)? `&search=${this.search}`: '';
            let sort = (this.sort != null) ? `&sort=1&sortStatus=${this.sort}` : "";  
            let page = ( this.currentPage )? this.currentPage : 1;
            let noPerPage = ( this.per_page ) ? this.per_page : 4;
            const url = `${this.baseUrl}api/logistics/getAllLogistic.php?noPerPage=${noPerPage}&page=${page}${search}${sort}`;
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
                    this.logistics = response.data.data.logistics;
                    this.currentPage =response.data.data.page;
                    this.totalData =response.data.data.total_data;
                    this.totalPage =response.data.data.totalPage;
                    //console.log("ApiLogistics", response.data.data.logistics);
                }else{
                    this.logistics = null;
                    this.currentPage =0;
                    this.totalData =0;
                    this.totalPage =0;
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
                        // // window.location.href="./login.php"
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
        async getLogisticByid(logisticid){
            //console.log("logisticid", logisticid);
            const url = `http://localhost/cartynew/api/logistics/getLogisticDetails.php?logisticid=${logisticid}`;
            //console.log("URL", url);
            const options = {
                method: "GET",
                headers: { "Authorization": `Bearer ${this.authToken}` },
                url
            }
            try {
                this.logistics_details = null;
                this.loading = true;
                let response = await axios(options)
                if ( response.data.status ){
                    //console.log('logisticDetails', response.data.data);
                    this.logistic_details = response.data.data;
                }
                
            } catch (error) {
                //console.log(error);
                if (error.response){
                    if (error.response.status === 400){
                        this.error = error.response.data.error.text
                        new Toasteur().error(this.error);;
                    }
                    if (error.response.status === 405){
                        this.error = error.response.data.error.text
                        new Toasteur().error(this.error);;
                    }
                    if (error.response.status === 500){
                        this.error = error.response.data.error.text
                        new Toasteur().error(this.error);;
                    }
                }else{
                    this.error = error.message || "Error processing request"
                    new Toasteur().error(this.error);;
                }
            }finally {
                this.loading = false;
            }
        },

        //.....locations.....
        async getLogisticLocations(logisticid, load = 1){
            let search = (this.search)? `&search=${this.search}`: '';
            let sort = (this.sort != null) ? `&sort=1&sortStatus=${this.sort}` : "";  
            let page = ( this.location_currentPage )? this.location_currentPage : 1;
            let noPerPage = ( this.per_page ) ? this.per_page : 2;
            const url = `${this.baseUrl}api/logistics/location/getLocationByLogisticid.php?logisticid=${logisticid}&noPerPage=${noPerPage}&page=${page}${search}${sort}`;
            //console.log('URL', url);
            //console.log('page', page);
            const options = {
                method: "GET",
                headers: { 
                    //"Content-type": "application/json",
                    "Authorization": `Bearer ${this.authToken}`
                },
                url
            }
            try {
                if(load ==1 ){
                    this.loading = true
                }
                const response = await axios(options);
                if(response.data.status){
                    this.logisticLocations=response.data.data.locations;
                    //console.log('ApiLocation', response.data.data.locations); 
                    this.location_currentPage =response.data.data.page;
                    this.location_totalData =response.data.data.total_data;
                    this.location_totalPage =response.data.data.totalPage;    
                    //console.log('location_totalPage', this.location_totalPage);
                    //console.log('location_currentPage', this.location_currentPage);           
                }else{
                    this.logisticLocations= null;
                    //console.log("Location not found");
                    this.location_currentPage = 0
                    this.location_totalData =0
                    this.location_totalPage =0;          
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
                        // // window.location.href="./login.php"
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
        async getLogisticPrices(logisticid, load =1){
            let search = (this.search)? `&search=${this.search}`: '';
            let sort = (this.sort != null) ? `&sort=1&sortStatus=${this.sort}` : "";  
            let page = ( this.price_currentPage )? this.price_currentPage : 1;
            let noPerPage = ( this.per_page ) ? this.per_page : 2;
            const url = `${this.baseUrl}api/logistics/price/getPriceByLogisticid.php?logisticid=${logisticid}&noPerPage=${noPerPage}&page=${page}${search}${sort}`;
            //console.log('URL', url);
            //console.log('log', page);
            const options = {
                method: "GET",
                headers: { 
                    //"Content-type": "application/json",
                    "Authorization": `Bearer ${this.authToken}`
                },
                url
            }
            try {
                if(load ==1 ){
                    this.loading = true
                }
                const response = await axios(options);
                if(response.data.status){
                    this.logisticPrices=response.data.data.logisticPrices;
                    //console.log('APIPrices', response.data.data.logisticPrices); 
                    this.price_currentPage =response.data.data.page;
                    this.price_totalData =response.data.data.total_data;
                    this.price_totalPage =response.data.data.totalPage;    
                    //console.log('price_totalPage', this.price_totalPage);
                    //console.log('price_totalData', this.price_totalData);           
                }else{
                    this.logisticPrices= null;
                    //console.log("Location not found");
                    this.price_currentPage = 0
                    this.price_totalData =0
                    this.price_totalPage =0;          
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
                        // // window.location.href="./login.php"
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
        async getLocationByid(id){
            //console.log("getByid", id);
            const url = `${this.baseUrl}api/logistics/location/getLocationByid.php?locationid=${id}`;
            const options = {
                method: "GET",
                headers: { 
                    //"Content-type": "application/json",
                    "Authorization": `Bearer ${this.authToken}`
                },
                url
            }
            try {
                this.loading = true
                const response = await axios(options);
                if (response.data.status) {
                    this.logisticLocation_details= response.data.data;
                    //console.log(response.data.data);
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
                        // // window.location.href="./login.php"
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
                }else{
                    new Toasteur().error(error.message || "Error processing request");
                }
                
            }finally {
                this.loading = false;
            }
        },
        async getPriceByid(id){
            //console.log("addressid", id);
            const url = `${this.baseUrl}api/logistics/price/getLogisticPriceByid.php?id=${id}`;
            const options = {
                method: "GET",
                headers: { 
                    //"Content-type": "application/json",
                    "Authorization": `Bearer ${this.authToken}`
                },
                url
            }
            try {
                this.loading = true
                const response = await axios(options);
                if (response.data.status) {
                    this.logisticPrice_details= response.data.data;
                    //console.log(response.data.data);
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
                        // // window.location.href="./login.php"
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
                }else{
                    new Toasteur().error(error.message || "Error processing request");
                }
                
            }finally {
                this.loading = false;
            }
        },


        //cart
        async getAllCarts(load=1){
            let search = (this.search)? `&search=${this.search}`: '';
            let sort = (this.sort != null) ? `&sort=1&sortStatus=${this.sort}` : "";  
            let page = ( this.currentPage )? this.currentPage : 1;
            let noPerPage = ( this.per_page ) ? this.per_page : 4;
            const url = `${this.baseUrl}api/cart/getAllCart.php?noPerPage=${noPerPage}&page=${page}${search}${sort}`;
            //console.log('URL', url);
            const options = {
                method: "GET",
                headers: { 
                    //"Content-type": "application/json",
                    "Authorization": `Bearer ${this.authToken}`
                },
                url
            }
            try {
                if(load ==1 ){
                    this.loading = true
                }
                const response = await axios(options);
                if(response.data.status){
                    this.orders=response.data.data.productCarts;
                    this.currentPage =response.data.data.page;
                    this.totalData =response.data.data.total_data;
                    this.totalPage =response.data.data.totalPage;      
                    //console.log('ApiPrices', response.data.data.productCarts);
                    //console.log('APITotalPage', response.data.data.totalPage);
                    //console.log('APICurrentPage', response.data.data.page);
                    //console.log("APIOrders", response.data.data.productCarts);

                }else{
                    this.orders= null
                    this.currentPage = 0;
                    this.totalData =0;
                    this.totalPage =0;
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
                        // // window.location.href="./login.php"
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
        async changeCartStatus(id, status){
            const url = `${this.baseUrl}api/logistics/price/changePriceStatus.php??`;
            //console.log('URL', url);
            if(!id && !status){
                new Toasteur().error("undefined")
            }else{
                const data = new FormData();
                data.append('id', id);
                data.append('status', status);
                const options = {
                    method: "POST",
                    headers: { 
                        //"Content-type": "application/json",
                        "Authorization": `Bearer ${this.authToken}`
                    },
                    data,
                    url
                }
                try {
                    this.loading = true
                    const response = await axios(options);
                    if(response.data.status){
                        new Toasteur().success("Status Changed")
                        this.getLogisticPrices();      
                    }else{
                        this.getLogisticPrices();
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
                            // // window.location.href="./login.php"
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

            }
            
        },
        
        async getRecentOrder(){
            const url = `${this.baseUrl}api/cart/getAllCart.php?noPerPage=5`;
            //console.log('URL', url);
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
                    this.recentOrders=response.data.data.productCarts;     
                    //console.log("RecentOrders", this.recentOrders);

                }else{
                    this.recentOrders= null;
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
        async getTopProductOrdered(){
            const url = `${this.baseUrl}api/order/topOrders.php`;
            //console.log('URL', url);
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
                    this.topProductOrdered=response.data.data.topOrders;     
                    //console.log("TopOrders", this.topProductOrdered);

                }else{
                    this.topProductOrdered= null;
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
        async changeCartStatus(id, status){
            const url = `${this.baseUrl}api/cart/changeCartStatus.php?`;
            //console.log('URL', url);
            if(!id && !status){
                new Toasteur().error("undefined")
            }else{
                const data = new FormData();
                data.append('id', id);
                data.append('status', status);
                const options = {
                    method: "POST",
                    headers: { 
                        //"Content-type": "application/json",
                        "Authorization": `Bearer ${this.authToken}`
                    },
                    data,
                    url
                }
                try {
                    this.loading = true
                    const response = await axios(options);
                    if(response.data.status){
                        new Toasteur().success("Status Changed")
                        this.getLogisticPrices();      
                    }else{
                        this.getLogisticPrices();
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

            }
            
        },
        async getCartByOrderRefno(orderRefno){
            //console.log("orderRefno", orderRefno);
            const url = `${this.baseUrl}api/cart/getCartByOrderref.php?orderref=${orderRefno}`;
            const options = {
                method: "GET",
                headers: { 
                    //"Content-type": "application/json",
                    "Authorization": `Bearer ${this.authToken}`
                },
                url
            }
            try {
                this.loading = true
                const response = await axios(options);
                if (response.data.status) {
                    this.order_details= response.data.data;
                    //console.log(response.data.data);
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
                       // // window.location.href="./login.php"
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
                }else{
                    new Toasteur().error(error.message || "Error processing request");
                }
                
            }finally {
                this.loading = false;
            }
        },
        async getOrderByOrderRefno(orderRefno){
            //console.log('refnoMethod',orderRefno);
            const url = `${this.baseUrl}api/order/getOrderByOrderref.php?orderrefno=${orderRefno}`;
            //console.log("orderRefURL", url);
            const options = {
                method: "GET",
                headers: { 
                    //"Content-type": "application/json",
                    "Authorization": `Bearer ${this.authToken}`
                },
                url
            }
            try {
                this.loading = true
                const response = await axios(options);
                if (response.data.status) {
                    this.orders= response.data.data.orders;
                    //console.log(response.data.data.orders);
                }else{
                    this.orders = null;
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
                        // // window.location.href="./login.php"
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


        //...blog
        async getAllBlog(load = 1){
            let search = (this.search)? `&search=${this.search}`: '';
            let sort = (this.sort != null) ? `&sort=1&sortDays=${this.sortDays}&sortDraft=${this.sortDraft}` : "";  
            let page = ( this.currentPage )? this.currentPage : 1;
            let noPerPage = ( this.per_page ) ? this.per_page : 4;

            const url = `${this.baseUrl}api/blog/getBlog.php?noPerPage=${noPerPage}&page=${page}${search}${sort}`;
            //console.log("getBlogUrl",url);
            const options = {
                method: "GET",
                headers: { 
                    //"Content-type": "application/json",
                    "Authorization": `Bearer ${this.authToken}`
                },
                url
            }
            try {
                if(load == 1){
                    this.loading = true;
                }
                this.blogs = null;
                let response = await axios(options)
                if ( response.data.status ){
                    //console.log('blogs', response.data.data.blogs);
                    this.currentPage =response.data.data.page;
                    this.totalData =response.data.data.total_data;
                    this.totalPage =response.data.data.totalPage;  
                    this.blogs = response.data.data.blogs;
                    this.blogCount = response.data.data.total_data;
                }else{
                    this.blogs= null;
                    if(webPage == 'location.php'){
                        this.currentPage = 0
                        this.totalData =0
                        this.totalPage =0;
                    }   
                }
                
            } catch (error) {
                if (error.response){
                    if (error.response.status === 400){
                        this.error = error.response.data.error.text
                        new Toasteur().error(this.error);;
                        //console.log("error", this.error);
                    }
                    if (error.response.status === 405){
                        this.error = error.response.data.error.text
                        new Toasteur().error(this.error);;
                        //console.log("error", this.error);
                    }
                    if (error.response.status === 500){
                        this.error = error.response.data.error.text
                        new Toasteur().error(this.error);;
                        //console.log("error", this.error);
                    }
                }else{
                    this.error = error.message || "Error processing request"
                    new Toasteur().error(this.error);;
                    //console.log("error", this.error);
                }
            }finally {
                this.loading = false;
            }
        },
        async blogImage(event){
            this.blogImage = event.target.files[0];
        },
        async addBlog(){
            //console.log("Headline",this.blogHeadline);
            //console.log("content", this.blogContent);
            //console.log("minto read", this.minsToRead);
            //console.log('blogImage', this.blogImage );
            if(this.blogHeadline == null || this.blogContent == null || this.minsToRead == null || this.blogImage == null){
                new Toasteur().error("Kindly fill all fields")
            }else{
                let data = new FormData();
                // blogImage, blogHeadline, howManyMinRead, blogContent, 
                data.append('blogHeadline', this.blogHeadline );
                data.append('howManyMinRead', this.minsToRead );
                data.append('blogContent', this.blogContent );
                data.append('blogImage', this.blogImage );

                const url = `${this.baseUrl}api/blog/addBlog.php`;
                //console.log("URL", url);
                
                const options = {
                    method: "POST",
                    data,
                    url,
                    headers: { 
                        //"Content-type": "application/json",
                        "Authorization": `Bearer ${this.authToken}`
                    }
                }

                try {
                    this.loading = true;
                    const response = await axios(options); 
                    if(response.data.status){
                        window.location.href='posts.php'
                        new Toasteur().success(response.data.text);
                        
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
                            // // window.location.href="./login.php"
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
            }
        },
        async getBlogByid(id){
            //console.log("blog", id);
            const url = `${this.baseUrl}api/blog/getBlogByid.php?id=${id}`;
            const options = {
                method: "GET",
                headers: { 
                    //"Content-type": "application/json",
                    "Authorization": `Bearer ${this.authToken}`
                },
                url
            }
            try {
                this.loading = true
                const response = await axios(options);
                if (response.data.status) {
                    this.blog_details= response.data.data;
                    //console.log(response.data.data);
                }else{
                    new Toasteur().error(response.data.text);
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
                }else{
                    new Toasteur().error(error.message || "Error processing request");
                }
                
            }finally {
                this.loading = false;
            }
        },
        async deleteBlog(id){
            const url = `${this.baseUrl}api/blog/deleteBlog.php?id=${id}`;
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
                    this.getAllBlog();
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
        async updateBlog(){

        },

        //......3rd party API
        //monify
        async getAllMonify(load=1){
            let search = (this.search)? `&search=${this.search}`: '';
            let sort = (this.sort != null) ? `&sort=1&sortStatus=${this.sort}` : "";  
            let page = ( this.currentPage )? this.currentPage : 1;
            let noPerPage = ( this.per_page ) ? this.per_page : 4;
            const url = `${this.baseUrl}api/thirdPartyApi/getMonifyApi.php?noPerPage=${noPerPage}&page=${page}${search}${sort}`;
            const options = {
                method: "GET",
                headers: { 
                    //"Content-type": "application/json",
                    "Authorization": `Bearer ${this.authToken}`
                },
                url
            }
            try {
                if(load == 1){
                    this.loading = true;
                }
                const response = await axios(options);
                if(response.data.status){
                    this.monifys = response.data.data.monifys;
                    this.currentPage =response.data.data.page;
                    this.totalData =response.data.data.total_data;
                    this.totalPage =response.data.data.totalPage;
                    //console.log("APiMonify", response.data.data.monifys);
                }else{
                    this.monifys = null;
                    this.currentPage =0;
                    this.totalData =0;
                    this.totalPage =0;
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
                        // // window.location.href="./login.php"
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
        async getMonifyByid(id){
            //console.log("monifyid", id);
            const url = `${this.baseUrl}api/thirdPartyApi/getMonifyApiByid.php?id=${id}`;
            const options = {
                method: "GET",
                headers: { 
                    //"Content-type": "application/json",
                    "Authorization": `Bearer ${this.authToken}`
                },
                url
            }
            try {
                this.loading = true
                const response = await axios(options);
                if (response.data.status) {
                    this.monify_details= response.data.data;
                    //console.log(response.data.data);
                }else{
                    new Toasteur().error(response.data.text);
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
                        // // window.location.href="./login.php"
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
                }else{
                    new Toasteur().error(error.message || "Error processing request");
                }
                
            }finally {
                this.loading = false;
            }
        },
        async addMonify(){
            //console.log("apidetails", this.apiWallet);
            //console.log("apidetails", this.apiMerchant);
            //console.log("apidetails", this.apiAccno);
            //console.log("apidetails", this.apiKey);
            //console.log("apidetails", this.apiName);
            //console.log("apidetails", this.secretKey);
            if(this.apiWallet == null || this.apiMerchant== null || this.apiAccno== null || this.apiKey == null ||this.apiName == null || this.secretKey == null){
                new Toasteur().error("Kindly fill all fields")
            }

            let data = new FormData();
            data.append('apiKey', this.apiKey );
            data.append('name', this.apiName );
            data.append('secreteKey', this.secretKey );
            data.append('apiMerchant', this.apiMerchant );
            data.append('apiWallet', this.apiWallet );
            data.append('apiAccno', this.secretKey );

            const url = `${this.baseUrl}api/thirdPartyApi/addMonifyApi.php`;
            
            const options = {
                method: "POST",
                data,
                url,
                headers: { 
                    //"Content-type": "application/json",
                    "Authorization": `Bearer ${this.authToken}`
                }
            }

            try {
                this.loading = true;
                const response = await axios(options); 
                if(response.data.status){
                    await this.getAllMonify();
                    Swal.fire(response.data.text);
                    
                }
            } catch (error) {
                ////console.log(error);
                if (error.response.status == 400){
                    const errorMsg = error.response.data.text;
                    new Toasteur().error(errorMsg);
                    return
                }

                if (error.response.status == 401){
                    const errorMsg = "User not Authorized";
                    new Toasteur().error(errorMsg);
                    // // window.location.href="./login.php"
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
            }finally {
                this.loading = false;
            }

        },
        async deleteMonify(id){
            const url = `${this.baseUrl}api/thirdPartyApi/deleteMonifyApi.php?id=${id}`;
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
                    this.getAllMonify();
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
                       // // window.location.href="./login.php"
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
        async changeMonifyStatus(id){
            const url = `${this.baseUrl}api/thirdPartyApi/changeMonifyApiStatus.php?`;
            //console.log('URL', url);
            if(!id){
                new Toasteur().error("undefined")
            }else{
                const data = new FormData();
                data.append('id', id);;
                const options = {
                    method: "POST",
                    headers: { 
                        //"Content-type": "application/json",
                        "Authorization": `Bearer ${this.authToken}`
                    },
                    data,
                    url
                }
                try {
                    this.loading = true
                    const response = await axios(options);
                    if(response.data.status){
                        new Toasteur().success("Status Changed")
                        this.getAllMonify();      
                    }else{
                        this.getAllMonify();
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
                            // // window.location.href="./login.php"
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

            }
            
        },
        async updateMonify(){
            
            //console.log("monify_detailsid", this.monify_details.id);
            //console.log("monify_details.name", this.monify_details.name);
            //console.log("monify_details.wallet", this.monify_details.apiwallet);
            //console.log("monify_details.password", this.monify_details.apimerchant);
            //console.log("monify_details.account", this.monify_details.apiaccno);
            //console.log("monify_details.secret", this.monify_details.secretkey);
            //console.log("monify_details.apikey", this.monify_details.apikey);
            if(this.monify_details.apiwallet == null || this.monify_details.apimerchant== null || this.monify_details.apiaccno== null || this.monify_details.apikey == null ||this.monify_details.name == null || this.monify_details.secretkey == null){
                new Toasteur().error("Kindly fill all fields")
            }else{

                let data = new FormData();
                data.append('id', this.monify_details.id );
                data.append('apikey', this.monify_details.apikey );
                data.append('name', this.monify_details.name );
                data.append('secretkey', this.monify_details.secretkey );
                data.append('apimerchant', this.monify_details.apimerchant );
                data.append('apiwallet', this.monify_details.apiwallet);
                data.append('apiaccno', this.monify_details.apiaccno );


                const url = `${this.baseUrl}api/thirdPartyApi/updateMonifyApi.php`;
                
                const options = {
                    method: "POST",
                    data,
                    url,
                    headers: { 
                        //"Content-type": "application/json",
                        "Authorization": `Bearer ${this.authToken}`
                    }
                }

                try {
                    this.loading = true;
                    const response = await axios(options); 
                    if(response.data.status){
                        await this.getAllMonify();
                        Swal.fire(response.data.text);
                        
                    }
                } catch (error) {
                    ////console.log(error);
                    if (error.response.status == 400){
                        const errorMsg = error.response.data.text;
                        new Toasteur().error(errorMsg);
                        return
                    }

                    if (error.response.status == 401){
                        const errorMsg = "User not Authorized";
                        new Toasteur().error(errorMsg);
                        // // window.location.href="./login.php"
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
                }finally {
                    this.loading = false;
                }
            }

        },

        //paystack
        async getAllPaystack(load = 1){
            let search = (this.search)? `&search=${this.search}`: '';
            let sort = (this.sort != null) ? `&sort=1&sortStatus=${this.sort}` : "";  
            let page = ( this.currentPage )? this.currentPage : 1;
            let noPerPage = ( this.per_page ) ? this.per_page : 4;
            const url = `${this.baseUrl}api/thirdPartyApi/getPaystackApi.php?noPerPage=${noPerPage}&page=${page}${search}${sort}`;
            const options = {
                method: "GET",
                headers: { 
                    //"Content-type": "application/json",
                    "Authorization": `Bearer ${this.authToken}`
                },
                url
            }
            try {
                if(load == 1){
                    this.loading = true;
                }
                const response = await axios(options);
                if(response.data.status){
                    this.payStacks = response.data.data.payStacks;
                    this.currentPage =response.data.data.page;
                    this.totalData =response.data.data.total_data;
                    this.totalPage =response.data.data.totalPage;
                    //console.log("ApiPayStacks", response.data.data.payStacks);
                }else{
                    this.payStacks = null;
                    this.currentPage =0;
                    this.totalData =0;
                    this.totalPage =0;
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
                        // // window.location.href="./login.php"
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
        async getPayStaskByid(id){
            //console.log("paystackid", id);
            const url = `${this.baseUrl}api/thirdPartyApi/getPaystackApiByid.php?id=${id}`;
            const options = {
                method: "GET",
                headers: { 
                    //"Content-type": "application/json",
                    "Authorization": `Bearer ${this.authToken}`
                },
                url
            }
            try {
                this.loading = true
                const response = await axios(options);
                if (response.data.status) {
                    this.payStack_details= response.data.data;
                    //console.log(response.data.data);
                }else{
                    new Toasteur().error(response.data.text);
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
                        // // window.location.href="./login.php"
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
                }else{
                    new Toasteur().error(error.message || "Error processing request");
                }
                
            }finally {
                this.loading = false;
            }
        },
        async addPayStack(){
            if(this.apiKey == null || this.apiName == null || this.secretKey == null){
                new Toasteur().error("Kindly fill all fields")
            }

            let data = new FormData();
            data.append('apiKey', this.apiKey );
            data.append('name', this.apiName );
            data.append('secreteKey', this.secretKey );

            const url = `${this.baseUrl}api/thirdPartyApi/addPaystackApi.php`;
            //console.log("URL", url);
            
            const options = {
                method: "POST",
                data,
                url,
                headers: { 
                    //"Content-type": "application/json",
                    "Authorization": `Bearer ${this.authToken}`
                }
            }

            try {
                this.loading = true;
                const response = await axios(options); 
                if(response.data.status){
                    await this.getAllPaystack();
                    new Toasteur().success(response.data.text);
                    
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
                       // // window.location.href="./login.php"
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
        async deletePaystack(id){
            let data = new FormData();
            data.append('id', id );

            const url = `${this.baseUrl}api/thirdPartyApi/deletePaystackApi.php?id=${id}`;

            const options = {
                method: "GET",
                headers: { 
                    //"Content-type": "application/json",
                    "Authorization": `Bearer ${this.authToken}`
                },
                url
            }
            try {
                const response = await axios(options);
                if(response.data.status){
                    this.getAllPaystack();
                }    
            } catch (error) {
                ////console.log(error);
                if (error.response.status == 400){
                    const errorMsg = error.response.data.text;
                    new Toasteur().error(errorMsg);
                    return
                }

                if (error.response.status == 401){
                    const errorMsg = "User not Authorized";
                    new Toasteur().error(errorMsg);
                    // // window.location.href="./login.php"
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
        },
        async changePaystackStatus(id){
            const url = `${this.baseUrl}api/thirdPartyApi/changePaystackApiStatus.php?`;
            //console.log('URL', url);
            if(!id){
                new Toasteur().error("undefined")
            }else{
                const data = new FormData();
                data.append('id', id);;
                const options = {
                    method: "POST",
                    headers: { 
                        //"Content-type": "application/json",
                        "Authorization": `Bearer ${this.authToken}`
                    },
                    data,
                    url
                }
                try {
                    this.loading = true
                    const response = await axios(options);
                    if(response.data.status){
                        new Toasteur().success("Status Changed")
                        this.getAllPaystack();      
                    }else{
                        this.getAllPaystack();
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
                            // // window.location.href="./login.php"
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

            }
            
        },
        async updatePayStack(){
            if(this.payStack_details.apikey == null ||this.payStack_details.name == null || this.payStack_details.secretekey == null){
                new Toasteur().error("Kindly fill all fields")
            }

            let data = new FormData();
            data.append('id', this.payStack_details.id );
            data.append('apikey', this.payStack_details.apikey );
            data.append('name', this.payStack_details.name );
            data.append('secretekey', this.payStack_details.secretekey );

            const url = `${this.baseUrl}api/thirdPartyApi/updatePaystackApi.php`;
            
            const options = {
                method: "POST",
                data,
                url,
                headers: { 
                    //"Content-type": "application/json",
                    "Authorization": `Bearer ${this.authToken}`
                }
            }

            try {
                this.loading = true;
                const response = await axios(options); 
                if(response.data.status){
                    await this.getAllPaystack();
                    new Toasteur().success(response.data.text);
                    
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
                       // // window.location.href="./login.php"
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

        //Kudi api
        async getAllKudi(load =1){
            let search = (this.search)? `&search=${this.search}`: '';
            let sort = (this.sort != null) ? `&sort=1&sortStatus=${this.sort}` : "";  
            let page = ( this.currentPage )? this.currentPage : 1;
            let noPerPage = ( this.per_page ) ? this.per_page : 4;
            let url = `${this.baseUrl}api/thirdPartyApi/getKudiApi.php?noPerPage=${noPerPage}&page=${page}${search}${sort}`;
            //console.log('KudiUrl', url);
            const options = {
                method: "GET",
                headers: { 
                    //"Content-type": "application/json",
                    "Authorization": `Bearer ${this.authToken}`
                },
                url
            }
            try {
                if(load == 1){
                    this.loading = true;
                }
                const response = await axios(options);
                if(response.data.status){
                    this.kudis = response.data.data.kudis;
                    this.currentPage =response.data.data.page;
                    this.totalData =response.data.data.total_data;
                    this.totalPage =response.data.data.totalPage;
                    //console.log("ApiKudis", response.data.data.kudis);
                }else{
                    this.kudis = null;
                    this.currentPage =0;
                    this.totalData =0;
                    this.totalPage =0;
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
                        // // window.location.href="./login.php"
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
        async getKudiByid(id){
            //console.log("KudiID", id);
            const url = `${this.baseUrl}api/thirdPartyApi/getKudiApiByid.php?id=${id}`;
            const options = {
                method: "GET",
                headers: { 
                    //"Content-type": "application/json",
                    "Authorization": `Bearer ${this.authToken}`
                },
                url
            }
            try {
                this.loading = true
                const response = await axios(options);
                if (response.data.status) {
                    this.kudi_details = response.data.data;
                    //console.log('DOKudi_details', this.kudi_details);
                    //console.log("DOKudi_details.name", this.kudi_details.name);
                }else{
                    new Toasteur().error(response.data.text);
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
                        // // window.location.href="./login.php"
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
                }else{
                    new Toasteur().error(error.message || "Error processing request");
                }
                
            }finally {
                this.loading = false;
            }
        },
        async addKudi(){
            if(this.apiKey == null ||this.apiName == null || this.secretKey == null){
                new Toasteur().error("Kindly fill all fields")
            }

            let data = new FormData();
            data.append('sendFrom', this.sendFrom );
            data.append('name', this.apiName );
            data.append('username', this.apiUsername );
            data.append('password', this.apiPassword );

            const url = `${this.baseUrl}api/thirdPartyApi/addKudiApi.php`;
            
            const options = {
                method: "POST",
                data,
                url,
                headers: { 
                    //"Content-type": "application/json",
                    "Authorization": `Bearer ${this.authToken}`
                }
            }

            try {
                this.loading = true;
                const response = await axios(options); 
                if(response.data.status){
                    await this.getAllKudi();
                    new Toasteur().success(response.data.text);
                    
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
                       // // window.location.href="./login.php"
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
        async deleteKudi(id){

            const url = `${this.baseUrl}api/thirdPartyApi/deleteKudiApi.php?id=${id}`;

            const options = {
                method: "GET",
                headers: { 
                    //"Content-type": "application/json",
                    "Authorization": `Bearer ${this.authToken}`
                },
                url
            }
            try {
                const response = await axios(options);
                if(response.data.status){
                    this.getAllKudi();
                }    
            } catch (error) {
                ////console.log(error);
                if (error.response.status == 400){
                    const errorMsg = error.response.data.text;
                    new Toasteur().error(errorMsg);
                    return
                }

                if (error.response.status == 401){
                    const errorMsg = "User not Authorized";
                    new Toasteur().error(errorMsg);
                    // // window.location.href="./login.php"
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
        },
        async changeKudiStatus(id){
            const url = `${this.baseUrl}api/thirdPartyApi/changeKudiApiStatus.php?`;
            //console.log('URL', url);
            if(!id){
                new Toasteur().error("undefined")
            }else{
                const data = new FormData();
                data.append('id', id);;
                const options = {
                    method: "POST",
                    headers: { 
                        //"Content-type": "application/json",
                        "Authorization": `Bearer ${this.authToken}`
                    },
                    data,
                    url
                }
                try {
                    this.loading = true
                    const response = await axios(options);
                    if(response.data.status){
                        new Toasteur().success("Status Changed");
                        this.getAllKudi();      
                    }else{
                        this.getAllKudi();
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
                            // // window.location.href="./login.php"
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

            }
            
        },
        async updateKudi(){

            if(this.kudi_details.id == null || this.kudi_details.sendfrom == null || this.kudi_details.name == null || this.kudi_details.username == null || this.kudi_details.password == null ){
                new Toasteur().error("Kindly fill all fields")
            }else{

                let data = new FormData();
                data.append('id', this.kudi_details.id );
                data.append('sendFrom', this.kudi_details.sendfrom );
                data.append('name', this.kudi_details.name );
                data.append('username', this.kudi_details.username );
                data.append('password', this.kudi_details.password );

                const url = `${this.baseUrl}api/thirdPartyApi/updateKudiApi.php`;
                
                const options = {
                    method: "POST",
                    data,
                    url,
                    headers: { 
                        //"Content-type": "application/json",
                        "Authorization": `Bearer ${this.authToken}`
                    }
                }

                try {
                    this.loading = true;
                    const response = await axios(options); 
                    if(response.data.status){
                        await this.getAllKudi();
                        new Toasteur().success(response.data.text);
                        
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
                           // // window.location.href="./login.php"
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
            }

        },
        

        //sendgrid
        async getAllSendGrid(load = 1){
            let search = (this.search)? `&search=${this.search}`: '';
            let sort = (this.sort != null) ? `&sort=1&sortStatus=${this.sort}` : "";  
            let page = ( this.currentPage )? this.currentPage : 1;
            let noPerPage = ( this.per_page ) ? this.per_page : 4;
            const url = `${this.baseUrl}api/thirdPartyApi/getAllSendGrid.php?noPerPage=${noPerPage}&page=${page}${search}${sort}`;
            //console.log("sendgrid url", url);
            const options = {
                method: "GET",
                headers: { 
                    //"Content-type": "application/json",
                    "Authorization": `Bearer ${this.authToken}`
                },
                url
            }
            try {
                if(load == 1){
                    this.loading = true;
                }
                const response = await axios(options);
                if(response.data.status){
                    this.sendGrids = response.data.data.details;
                    this.currentPage =response.data.data.page;
                    this.totalData =response.data.data.total_data;
                    this.totalPage =response.data.data.totalPage;
                    //console.log("APIsendGrids", response.data.data.details);
                }else{
                    this.sendGrids = null;
                    this.currentPage =0;
                    this.totalData =0;
                    this.totalPage =0;
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
                        // // window.location.href="./login.php"
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
        async getSendGridByid(id){
            //console.log("snedGrid", id);
            const url = `${this.baseUrl}api/thirdPartyApi/getSendGridByID.php?id=${id}`;
            const options = {
                method: "GET",
                headers: { 
                    //"Content-type": "application/json",
                    "Authorization": `Bearer ${this.authToken}`
                },
                url
            }
            try {
                this.loading = true
                const response = await axios(options);
                if (response.data.status) {
                    this.sendGrid_details= response.data.data;
                    //console.log('DOSendGrid',this.sendGrid_details);
                    //console.log("APISendGrid", response.data.data);
                }else{
                    new Toasteur().error(response.data.text);
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
                        // // window.location.href="./login.php"
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
                }else{
                    new Toasteur().error(error.message || "Error processing request");
                }
                
            }finally {
                this.loading = false;
            }
        },
        async addSendGrid(){
            if(this.sendFrom == null || this.apiKey == null ||this.apiName == null || this.secretKey == null){
                new Toasteur().error("Kindly fill all fields")
            }

            let data = new FormData();
            data.append('sender', this.sendFrom );
            data.append('apikey', this.apiKey );
            data.append('name', this.apiName );
            data.append('secreteid', this.secretKey );

            const url = `${this.baseUrl}api/thirdPartyApi/addSendGridApi.php`;
            
            const options = {
                method: "POST",
                data,
                url,
                headers: { 
                    //"Content-type": "application/json",
                    "Authorization": `Bearer ${this.authToken}`
                }
            }

            try {
                this.loading = true;
                const response = await axios(options); 
                if(response.data.status){
                    await this.getAllSendGrid();
                    new Toasteur().success(response.data.text);
                    
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
                       // // window.location.href="./login.php"
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
        async deleteSendGrid(id){
            let data = new FormData();
            data.append('id', id );

            const url = `${this.baseUrl}api/thirdPartyApi/deleteSendGrid.php?`;

            const options = {
                method: "POST",
                data: data,
                headers: { 
                    //"Content-type": "application/json",
                    "Authorization": `Bearer ${this.authToken}`
                },
                url
            }
            try {
                const response = await axios(options);
                if(response.data.status){
                    this.getAllSendGrid();
                }    
            } catch (error) {
                ////console.log(error);
                if (error.response.status == 400){
                    const errorMsg = error.response.data.text;
                    new Toasteur().error(errorMsg);
                    return
                }

                if (error.response.status == 401){
                    const errorMsg = "User not Authorized";
                    new Toasteur().error(errorMsg);
                    // // window.location.href="./login.php"
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
        },
        async changeSendGridStatus(id){
            const url = `${this.baseUrl}api/thirdPartyApi/changeSendGridApiStatus.php?`;
            //console.log('URL', url);
            //console.log("id", id);
            if(!id){
                new Toasteur().error("undefined")
            }else{
                const data = new FormData();
                data.append('api_id', id);;
                const options = {
                    method: "POST",
                    headers: { 
                        //"Content-type": "application/json",
                        "Authorization": `Bearer ${this.authToken}`
                    },
                    data,
                    url
                }
                try {
                    this.loading = true
                    const response = await axios(options);
                    if(response.data.status){
                        new Toasteur().success("Status Changed")
                        this.getAllSendGrid();      
                    }else{
                        this.getAllSendGrid();
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
                            // // window.location.href="./login.php"
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

            }
            
        },
        async updateSendGrid(){
            if(this.sendGrid_details.id == null || this.sendGrid_details.email_from == null || this.sendGrid_details.api_key == null ||this.sendGrid_details.name == null || this.sendGrid_details.secret_id == null){
                new Toasteur().error("Kindly fill all fields")
            }else{

                let data = new FormData();
                data.append('send_grid_id', this.sendGrid_details.id );
                data.append('sender', this.sendGrid_details.email_from );
                data.append('apikey', this.sendGrid_details.api_key );
                data.append('name', this.sendGrid_details.name );
                data.append('secret_id', this.sendGrid_details.secret_id );

                const url = `${this.baseUrl}api/thirdPartyApi/updateSendGridApi.php`;
                
                const options = {
                    method: "POST",
                    data,
                    url,
                    headers: { 
                        //"Content-type": "application/json",
                        "Authorization": `Bearer ${this.authToken}`
                    }
                }

                try {
                    this.loading = true;
                    const response = await axios(options); 
                    if(response.data.status){
                        await this.getAllSendGrid();
                        new Toasteur().success(response.data.text);
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
                           // // window.location.href="./login.php"
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
            }

        },

        //SmartSMS
        async getAllSmartSolution(load = 1){
            let search = (this.search)? `&search=${this.search}`: '';
            let sort = (this.sort != null) ? `&sort=1&sortStatus=${this.sort}` : "";  
            let page = ( this.currentPage )? this.currentPage : 1;
            let noPerPage = ( this.per_page ) ? this.per_page : 4;
            const url = `${this.baseUrl}api/thirdPartyApi/getAllSmartSolutions.php?noPerPage=${noPerPage}&page=${page}${search}${sort}`;
            const options = {
                method: "GET",
                headers: { 
                    //"Content-type": "application/json",
                    "Authorization": `Bearer ${this.authToken}`
                },
                url
            }
            try {
                if(load == 1){
                    this.loading = true;
                }
                const response = await axios(options);
                if(response.data.status){
                    this.smartSolutions = response.data.data.smart;
                    this.currentPage =response.data.data.page;
                    this.totalData =response.data.data.total_data;
                    this.totalPage =response.data.data.totalPage;
                    //console.log("APIsmartsms", response.data.data.smart);
                }else{
                    this.smartSolutions = null;
                    this.currentPage =0;
                    this.totalData =0;
                    this.totalPage =0;
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
                        // // window.location.href="./login.php"
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
        async getSmartSolutionByid(id){
            //console.log("snedGrid", id);
            const url = `${this.baseUrl}api/thirdPartyApi/getSmartSolutionsById.php?smart_id=${id}`;
            const options = {
                method: "GET",
                headers: { 
                    //"Content-type": "application/json",
                    "Authorization": `Bearer ${this.authToken}`
                },
                url
            }
            try {
                this.loading = true
                const response = await axios(options);
                if (response.data.status) {
                    this.smartSolution_details= response.data.data;
                    //console.log(response.data.data);
                }else{
                    new Toasteur().error(response.data.text);
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
                        // // window.location.href="./login.php"
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
                }else{
                    new Toasteur().error(error.message || "Error processing request");
                }
                
            }finally {
                this.loading = false;
            }
        },
        async addSmartSolution(){
            if(this.sendFrom == null || this.apiToken == null ||this.apiName == null || this.sendType == null || this.routing == null){
                new Toasteur().error("Kindly fill all fields")
            }else{

                let data = new FormData();
                data.append('sender', this.sendFrom );
                data.append('apitoken', this.apiToken );
                data.append('name', this.apiName );
                data.append('sendtype', this.sendType );
                data.append('routing', this.routing );

                const url = `${this.baseUrl}api/thirdPartyApi/addSmartSolutionsApi.php`;
                
                const options = {
                    method: "POST",
                    data,
                    url,
                    headers: { 
                        //"Content-type": "application/json",
                        "Authorization": `Bearer ${this.authToken}`
                    }
                }

                try {
                    this.loading = true;
                    const response = await axios(options); 
                    if(response.data.status){
                        await this.getAllSmartSolution();
                        new Toasteur().success(response.data.text);
                        
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
                            // // window.location.href="./login.php"
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
            }

        },
        async deleteSmartSolution(id){
            let data = new FormData();
            data.append('id', id );

            const url = `${this.baseUrl}api/thirdPartyApi/deleteSmartSolutions.php?`;

            const options = {
                method: "POST",
                data: data,
                headers: { 
                    //"Content-type": "application/json",
                    "Authorization": `Bearer ${this.authToken}`
                },
                url
            }
            try {
                const response = await axios(options);
                if(response.data.status){
                    this.getAllSmartSolution();
                }    
            } catch (error) {
                ////console.log(error);
                if (error.response.status == 400){
                    const errorMsg = error.response.data.text;
                    new Toasteur().error(errorMsg);
                    return
                }

                if (error.response.status == 401){
                    const errorMsg = "User not Authorized";
                    new Toasteur().error(errorMsg);
                    // // window.location.href="./login.php"
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
        },
        async changeSmartSolutionStatus(id){
            const url = `${this.baseUrl}api/thirdPartyApi/setActiveSmartApiStatus.php?`;
            //console.log('URL', url);
            if(!id){
                new Toasteur().error("undefined")
            }else{
                const data = new FormData();
                data.append('smart_id', id);;
                const options = {
                    method: "POST",
                    headers: { 
                        //"Content-type": "application/json",
                        "Authorization": `Bearer ${this.authToken}`
                    },
                    data,
                    url
                }
                try {
                    this.loading = true
                    const response = await axios(options);
                    if(response.data.status){
                        new Toasteur().success("Status Changed")
                        this.getAllSmartSolution();      
                    }else{
                        this.getAllSmartSolution();
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
                            // // window.location.href="./login.php"
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

            }
            
        },
        async updateSmartSolution(){
            //console.log("sendtype", this.smartSolution_details.sendtype);
            if(this.smartSolution_details.id ==null ||this.smartSolution_details.sendFrom == null || this.smartSolution_details.apiToken == null ||this.smartSolution_details.name == null || this.smartSolution_details.sendtype == null || this.smartSolution_details.routing == null){
                new Toasteur().error("Kindly fill all fields")
            }else{

                let data = new FormData();
                data.append('smart_id', this.smartSolution_details.id );
                data.append('sender', this.smartSolution_details.sendFrom );
                data.append('apitoken', this.smartSolution_details.apiToken );
                data.append('name', this.smartSolution_details.name );
                data.append('sendtype', this.smartSolution_details.sendtype );
                data.append('routing', this.smartSolution_details.routing );

                const url = `${this.baseUrl}api/thirdPartyApi/updateSmartSolutionsApi.php`;
                //console.log("URL", url);
                
                const options = {
                    method: "POST",
                    data,
                    url,
                    headers: { 
                        //"Content-type": "application/json",
                        "Authorization": `Bearer ${this.authToken}`
                    }
                }

                try {
                    this.loading = true;
                    const response = await axios(options); 
                    if(response.data.status){
                        await this.getAllSmartSolution();
                        new Toasteur().success(response.data.text);
                        
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
                           // // window.location.href="./login.php"
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
            }

        },
        //TermiApi
        async getTermiApi(load = 1){
            let search = (this.search)? `&search=${this.search}`: '';
            let sort = (this.sort != null) ? `&sort=1&sortStatus=${this.sort}` : "";  
            let page = ( this.currentPage )? this.currentPage : 1;
            let noPerPage = ( this.per_page ) ? this.per_page : 4;
            const url = `${this.baseUrl}api/thirdPartyApi/getAllTermiTable.php?noPerPage=${noPerPage}&page=${page}${search}${sort}`;
            const options = {
                method: "GET",
                headers: { 
                    //"Content-type": "application/json",
                    "Authorization": `Bearer ${this.authToken}`
                },
                url
            }
            try {
                if(load == 1){
                    this.loading = true;
                }
                const response = await axios(options);
                if(response.data.status){
                    this.termiApis = response.data.data.termi;
                    this.currentPage =response.data.data.page;
                    this.totalData =response.data.data.total_data;
                    this.totalPage =response.data.data.totalPage;
                    //console.log("TermiApi", response.data.data.termi);
                }else{
                    this.termiApis = null;
                    this.currentPage =0;
                    this.totalData =0;
                    this.totalPage =0;
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
                        // // window.location.href="./login.php"
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
        async getTermiApiByid(id){
            //console.log("snedGrid", id);
            const url = `${this.baseUrl}api/thirdPartyApi/getTermiByid.php?termi_id=${id}`;
            const options = {
                method: "GET",
                headers: { 
                    //"Content-type": "application/json",
                    "Authorization": `Bearer ${this.authToken}`
                },
                url
            }
            try {
                this.loading = true
                const response = await axios(options);
                if (response.data.status) {
                    this.termiApi_details= response.data.data.termi;
                    //console.log(response.data.data.termi);
                }else{
                    new Toasteur().error(response.data.text);
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
                        // // window.location.href="./login.php"
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
                }else{
                    new Toasteur().error(error.message || "Error processing request");
                }
                
            }finally {
                this.loading = false;
            }
        },
        async addTermiApi(){
            if(this.sendFrom == null || this.apiKey == null ||this.apiName == null || this.smsType == null || this.smsChannel == null){
                new Toasteur().error("Kindly fill all fields")
            }

            let data = new FormData();
            data.append('sender', this.sendFrom );
            data.append('apikey', this.apiKey );
            data.append('name', this.apiName );
            data.append('smstype', this.smsType );
            data.append('smschannel', this.smsChannel );

            const url = `${this.baseUrl}api/thirdPartyApi/addTermiApi.php`;
            
            const options = {
                method: "POST",
                data,
                url,
                headers: { 
                    //"Content-type": "application/json",
                    "Authorization": `Bearer ${this.authToken}`
                }
            }

            try {
                this.loading = true;
                const response = await axios(options); 
                if(response.data.status){
                    await this.getTermiApi();
                    new Toasteur().success(response.data.text);
                    
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
                       // // window.location.href="./login.php"
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
        async deleteTermiApi(id){
            let data = new FormData();
            data.append('termi_id', id );

            const url = `${this.baseUrl}api/thirdPartyApi/deleteTermiApi.php?`;

            const options = {
                method: "POST",
                data: data,
                headers: { 
                    //"Content-type": "application/json",
                    "Authorization": `Bearer ${this.authToken}`
                },
                url
            }
            try {
                const response = await axios(options);
                if(response.data.status){
                    this.getTermiApi();
                }    
            } catch (error) {
                ////console.log(error);
                if (error.response.status == 400){
                    const errorMsg = error.response.data.text;
                    new Toasteur().error(errorMsg);
                    return
                }

                if (error.response.status == 401){
                    const errorMsg = "User not Authorized";
                    new Toasteur().error(errorMsg);
                    // // window.location.href="./login.php"
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
        },
        async changeTermiStatus(id){
            const url = `${this.baseUrl}api/thirdPartyApi/setActiveTermiApiStatus.php?`;
            //console.log('URL', url);
            if(!id){
                new Toasteur().error("undefined")
            }else{
                const data = new FormData();
                data.append('termi_id', id);;
                const options = {
                    method: "POST",
                    headers: { 
                        //"Content-type": "application/json",
                        "Authorization": `Bearer ${this.authToken}`
                    },
                    data,
                    url
                }
                try {
                    this.loading = true
                    const response = await axios(options);
                    if(response.data.status){
                        new Toasteur().success("Status Changed")
                        this.getTermiApi();      
                    }else{
                        this.getTermiApi();
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
                            // // window.location.href="./login.php"
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

            }
            
        },
        async updateTermiApi(){
            if(this.termiApi_details.sendFrom == null || this.termiApi_details.id == null ||this.termiApi_details.name == null || this.termiApi_details.smstype == null || this.termiApi_details.smschannel == null){
                new Toasteur().error("Kindly fill all fields")
            }else{

                let data = new FormData();
                data.append('termi_id', this.termiApi_details.id );
                data.append('sender', this.termiApi_details.sendFrom );
                data.append('apikey', this.termiApi_details.key );
                data.append('name', this.termiApi_details.name );
                data.append('smstype', this.termiApi_details.smstype );
                data.append('smschannel', this.termiApi_details.smschannel );

                const url = `${this.baseUrl}api/thirdPartyApi/updateTermiApi.php`;
                
                const options = {
                    method: "POST",
                    data,
                    url,
                    headers: { 
                        //"Content-type": "application/json",
                        "Authorization": `Bearer ${this.authToken}`
                    }
                }

                try {
                    this.loading = true;
                    const response = await axios(options); 
                    if(response.data.status){
                        await this.getTermiApi();
                        Swal.fire(response.data.text);
                        
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
                           // // window.location.href="./login.php"
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
            }

        },

        //.....utilities..............
        async getLocations(){
            let logisticid = (localStorage.getItem("logisticid")) ? localStorage.getItem("logisticid"): null;
            if(logisticid){
                await this.getLogisticLocations(logisticid)
            }else{
                window.location.href = 'logistics.php'
            }
        },
        async getPrices(){
            let logisticid = (localStorage.getItem("logisticid")) ? localStorage.getItem("logisticid"): null;
            if(logisticid){
                await this.getLogisticPrices(logisticid)
            }else{
                window.location.href = 'logistics.php'
            }
        },
        async getToken(){
            this.loading= true
            const token = window.localStorage.getItem("authToken");
            this.authToken = token;
            //console.log("token gotten", this.authToken);
            
        },
        async nextPage(){
            this.currentPage = parseInt(this.currentPage) + 1;
            this.totalData =null;
            this.totalPage =null;
            if(webPage == "logistics.php"){
                this.getAllLogistics();
            }
            if(webPage == "admins.php"){
                this.getAllAdmin();
            }
            if(webPage == 'orders.php'){
                this.getAllCarts();
            }
            if(webPage == 'prices.php'){
                this.getLogisticPrices();
            }
            if(webPage == 'location.php'){
                this.getLogisticLocations();
            }if(webPage =='monify.php'){
                await this.getAllMonify()
            }
            if(webPage =='paystack.php'){
                await this.getAllPaystack()
            }
            if(webPage =='kudi.php' ){
                await this.getAllKudi();
            }
            if(webPage =='smartsolution.php'){
                await this.getAllSmartSolution();
            }
            if(webPage =='sendgrid.php'){
                await this.getAllSendGrid()
            }
            if(webPage == 'termiapi.php'){
                await this.getTermiApi();
            }
            if(webPage == 'addresses.php'){
                await this.getAllAddresses();
            }
            if(webPage == 'posts.php'){
                await this.getAllBlog();
            }
        },
        async previousPage(){
            this.currentPage = parseInt(this.currentPage) - 1;
            this.totalData =null;
            this.totalPage =null;
            if(webPage == "logistics.php"){
                this.getAllLogistics();
            }
            if(webPage == "admins.php"){
                this.getAllAdmin();
            }
            if(webPage == 'orders.php'){
                this.getAllCarts();                
            }
            if(webPage == 'prices.php'){
                this.getLogisticPrices()
            }
            if(webPage == 'location.php'){
                this.getLogisticLocations()
            }

            if(webPage =='monify.php'){
                await this.getAllMonify()
            }
            if(webPage =='paystack.php'){
                await this.getAllPaystack()
            }
            if(webPage =='kudi.php' ){
                await this.getAllKudi();
            }
            if(webPage =='smartsolution.php'){
                await this.getAllSmartSolution();
            }
            if(webPage =='sendgrid.php'){
                await this.getAllSendGrid()
            }
            if(webPage == 'termiapi.php'){
                await this.getTermiApi();
            }
            if(webPage == 'addresses.php'){
                await this.getAllAddresses();
            }
            if(webPage == 'posts.php'){
                await this.getAllBlog();
            }
        },
        async tab_nextPage(item){
            let logisticid = (localStorage.getItem("logisticid")) ? localStorage.getItem("logisticid"): null;
            if(logisticid){
                if(item === 'prices'){
                    this.price_currentPage = parseInt(this.price_currentPage) + 1;
                    //console.log("clickTab currentPage", this.price_currentPage);
                    this.price_totalData =null;
                    this.price_totalPage =null;
                    await this.getLogisticPrices(logisticid)
                }
                if(item ==='locations'){
                    this.location_currentPage = parseInt(this.location_currentPage) + 1;
                    //console.log("clickTab currentPage", this.location_currentPage);
                    this.location_totalData =null;
                    this.location_totalPage =null;
                    await this.getLogisticLocations(logisticid);
                }
            }else{
                window.location.href = 'logistics.php'
            }
        },
        async tab_previousPage(item){
            let logisticid = (localStorage.getItem("logisticid")) ? localStorage.getItem("logisticid"): null;
            if(logisticid){
                if(item === 'prices'){
                    this.price_currentPage = parseInt(this.price_currentPage) - 1;
                    this.price_totalData =null;
                    this.price_totalPage =null;
                    await this.getLogisticPrices(logisticid)
                }
                if(item ==='locations'){
                    this.location_currentPage = parseInt(this.location_currentPage) - 1;
                    this.location_totalData =null;
                    this.location_totalPage =null;
                    await this.getLogisticLocations(logisticid);
                }
            }else{
                window.location.href = 'logistics.php'
            }
        },
        async noSort(){
            this.loading = true
            this.sort = null;
            this.currentPage =null;
            this.totalData =null;
            this.totalPage =null;
            this.sortDraft = null;
            this.sortDays = null;
            if(webPage == "logistics.php"){
                await this.getAllLogistics();
            }
            if(webPage == "admins.php"){
                this.getAllAdmin();
            }
            if(webPage == 'prices.php'){
               await this.getLogisticPrices()
            }
            if(webPage == 'location.php'){
                this.getLogisticLocations();
            }
            if(webPage == "orders.php"){
                await this.getAllCarts();
            }
            if(webPage == "orders.php"){
                await this.getAllCarts();
            }

            if(webPage =='monify.php'){
                await this.getAllMonify()
            }
            if(webPage =='paystack.php'){
                await this.getAllPaystack()
            }
            if(webPage =='kudi.php' ){
                await this.getAllKudi();
            }
            if(webPage =='smartsolution.php'){
                await this.getAllSmartSolution();
            }
            if(webPage =='sendgrid.php'){
                await this.getAllSendGrid()
            }
            if(webPage == 'termiapi.php'){
                await this.getTermiApi();
            }
            if(webPage == 'posts.php'){
                await this.getAllBlog();
            }
            if(webPage == 'addresses.php'){
                await this.getAllAddresses();
            }
        }, 
        async sortByStatus(status){
            this.loading = true;
            this.sort = status;
            this.currentPage =null;
            this.totalData =null;
            this.totalPage =null;
            //console.log('SortStatus', status);
            if(webPage == "logistics.php"){
                await this.getAllLogistics();
            }
            if(webPage == "admins.php"){
                this.getAllAdmin();
            }
            if(webPage == 'prices.php'){
               await this.getLogisticPrices()
            }
            if(webPage == 'location.php'){
                this.getLogisticLocations();
            }
            if(webPage == "orders.php"){
                await this.getAllCarts();
            }

            if(webPage =='monify.php'){
                await this.getAllMonify()
            }
            if(webPage =='paystack.php'){
                await this.getAllPaystack()
            }
            if(webPage =='kudi.php' ){
                await this.getAllKudi();
            }
            if(webPage =='smartsolution.php'){
                await this.getAllSmartSolution();
            }
            if(webPage =='sendgrid.php'){
                await this.getAllSendGrid()
            }
            if(webPage == 'termiapi.php'){
                await this.getTermiApi();
            }
            if(webPage == 'addresses.php'){
                await this.getAllAddresses();
            }
            
        },
        async sortByDays(days){
            this.sort =1;
            this.loading = true;
            this.sortDays = days
            this.currentPage =null;
            this.totalData =null;
            this.totalPage =null;
            //console.log('sortByDays', days);
            if(webPage == "posts.php"){
                await this.getAllBlog();
            }
        },
        async sortByDraft(draft){
            this.sort =1;
            this.loading = true;
            this.sortDraft = draft
            this.currentPage =null;
            this.totalData =null;
            this.totalPage =null;
            //console.log('SortByDraft', draft);
            if(webPage == "posts.php"){
                await this.getAllBlog();
            }
        },
        async sortByOrderStatus(sortStatus){
            this.sort = sortStatus;
            this.currentPage =null;
            this.totalData =null;
            this.totalPage =null;
            //console.log('SortStatus', sortStatus);
            if(webPage == "orders.php"){
                await this.getAllCarts();
            }

        },
        async getByid(id){
            this.loading = true;
            this.location_details = null;
            this.price_details = null;
            this.order_details = null;
            if(webPage == 'orders.php'){
                this.getCartByid(id)
            }
            if(webPage == 'prices.php'){
                this.getLogisticPriceByid(id)
            }
            if(webPage == 'location.php'){
                this.getLocationByid(id)
            }

        },
        async changeStatus(id,status){
            this.currentPage =null;
            this.totalData =null;
            this.totalPage =null;
            if(webPage == 'orders.php'){
                await this.changeOrderStatus(id, status)
            }
            if(webPage == 'prices.php'){
                await this.changeLogisticPriceStatus(id, status)
            }
            if(webPage == 'location.php'){
                this.changeLogisticLocationStatus(id, status);
            }
        },

        async getUserid(userid){
            this.loading = false
            if(webPage =='admins.php'){
                localStorage.setItem("adminid", userid);
                window.location.href=`admin-details.php?`;
            }
            if(webPage =='logistics.php'){
                localStorage.setItem("logisticid", userid);
                window.location.href=`logistics-details.php?`;
            }
        
        },
        async saveRefno(orderRefno){
            this.loading = false
            localStorage.setItem("orderRefno", orderRefno);
            window.location.href=`invoice-details.php?`;
        
        },
        async deleteByid(id){
            const swalWithBootstrapButtons = Swal.mixin({
            customClass: {
                confirmButton: 'btn btn-success',
                cancelButton: 'btn btn-danger'
            },
            buttonsStyling: false
            })
            
            swalWithBootstrapButtons.fire({
            title: 'Are you sure?',
            text: "You won't be able to revert this!",
            icon: 'warning',
            showCancelButton: true,
            confirmButtonText: 'Yes, delete it!',
            cancelButtonText: 'No, cancel!',
            reverseButtons: true
            }).then((result) => {
            if (result.isConfirmed) {
                if(webPage == 'prices.php'){
                    this.deleteLogisticPrice(id)
                }
                if(webPage == 'location.php'){
                    //console.log('location id', id);
                    this.deleteLocation(id);
                }

                if(webPage =='monify.php'){
                    this.deleteMonify(id)
                }
                if(webPage =='paystack.php'){
                    this.deletePaystack(id)
                }
                if(webPage =='kudi.php' ){
                    this.deleteKudi(id);
                }
                if(webPage =='smartsolution.php'){
                    this.deleteSmartSolution(id);
                }
                if(webPage =='sendgrid.php'){
                    this.deleteSendGrid(id)
                }
                if(webPage == 'termiapi.php'){
                    this.deleteTermiApi(id);
                }
                if(webPage == 'posts.php'){
                    this.deleteBlog(id);
                }
                swalWithBootstrapButtons.fire(
                'Deleted!',
                'Record deleted succesfully.',
                'success'
                )
            } else if (
                /* Read more about handling dismissals below */
                result.dismiss === Swal.DismissReason.cancel
            ) {
                swalWithBootstrapButtons.fire(
                'Cancelled',
                'Record not deleted',
                'error'
                )
            }
            })
            
        },
        async getIndex(index){
            //console.log("arrayIndex", index);
            if(webPage == 'posts.php'){
                this.itemDetails = this.blogs[index];
            }
    
            if(webPage == 'logistics.php'){
                this.itemDetails = this.logistics[index];
            }
    
            if(webPage == "admins.php"){ 
                this.itemDetails = this.admins[index];
            }
            if(webPage == 'orders.php'){
                this.itemDetails = this.orders[index];
            }
            if(webPage == 'addresses.php'){
                this.itemDetails = this.addresses[index];
            }
        },
        async generateUserPassword(){
            this.newPassword = generatePassword();
        },
        //end of LanreWaju methods

        // Korede's Functions

        async comp_getAllComplains(load = 1){
            let search = (this.kor_search) ? `&search=${this.kor_search}` : ""; 
            let sort = (this.kor_sort !== null) ? `&sort=1&sortStatus=${this.kor_sort}` : "";
            let page = ( this.kor_page )? this.kor_page : 1;
            let per_page = ( this.kor_per_page ) ? this.kor_per_page : 5;
            
            const headers = {
                "Authorization": `Bearer ${this.authToken}`,
                "Content-type": "application/json"
            }

            let url = `${this.baseUrl}api/complains/getAllComplains.php?page=${page}&per_page=${per_page}${search}${sort}`;

            this.kor_total_page = null
            try {
                if(load == 1){
                    this.loading = true;
                }
                const response = await axios.get(url, {headers} );
                if ( response.data.status ){
                    if (response.data.data.page){
                        this.complains = response.data.data.complains;
                        this.kor_page = response.data.data.page;
                        this.kor_total_page= response.data.data.totalPage;
                        this.kor_per_page = response.data.data.per_page;
                        this.kor_total_data = response.data.data.total_data;
                        //console.log(this.complains);
                    }
                }else{
                    this.complains = null
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
                        // // window.location.href="./login.php"
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
        async getComplain(index){
            //console.log(this.complains);
            this.complain = this.complains[parseInt(index)];
            //console.log(this.complain);
        },
        async changeComplainStatus(comlain_id, user_id, status){

            const headers = {
                "Authorization": `Bearer ${this.authToken}`,
                "Content-type": "application/json"
            }

            const data = new FormData();
            data.append('id', comlain_id);
            data.append('user_id', user_id);
            data.append('status', status);

            let url = `${this.baseUrl}api/complains/changeStatus.php`;


            try {
                const response = await axios.post(url, data, {headers});
                if ( response.data.status ){
                    this.success = response.data.text;
                    new Toasteur().success(this.success);
                    await this.comp_getAllComplains(7);
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
                        // // window.location.href="./login.php"
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
        async changeReadStatus(comlain_id, user_id, index){
            //console.log(index);
            this.getComplain(index);
            const headers = {
                "Authorization": `Bearer ${this.authToken}`,
                "Content-type": "application/json"
            }

            const data = new FormData();
            data.append('id', comlain_id);
            data.append('user_id', user_id);

            let url = `${this.baseUrl}api/complains/changeReadStatus.php`;


            try {
                const response = await axios.post(url, data, {headers});
                if ( response.data.status ){
                    this.success = response.data.text;
                    await this.comp_getAllComplains(7);
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
                        // // window.location.href="./login.php"
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
        async deleteComplain(id){
            const headers = {
                "Authorization": `Bearer ${this.authToken}`,
                "Content-type": "application/json"
            }

            

            const data = new FormData();
            data.append('id', id);

            let url = `${this.baseUrl}api/complains/deleteComplain.php`;


            try {
                const response = await axios.post(url, data, {headers});
                if ( response.data.status ){
                    this.success = response.data.text;
                    new Toasteur().success(this.success);
                    await this.comp_getAllComplains(7);
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
                        // // window.location.href="./login.php"
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
        async getAllSliders(load = 1){
            let search = (this.kor_search) ? `&search=${this.kor_search}` : ""; 
            let sort = (this.kor_sort !== null) ? `&sort=1&sortstatus=${this.kor_sort}` : "";
            let page = ( this.kor_page )? this.kor_page : 1;
            let per_page = ( this.kor_per_page ) ? this.kor_per_page : 3;
            
            const headers = {
                "Authorization": `Bearer ${this.authToken}`,
                "Content-type": "application/json"
            }

            let url = `${this.baseUrl}api/slider/getAllSlider.php?page=${page}&per_page=${per_page}${search}${sort}`;

            this.kor_total_page = null
            try {
                if(load == 1){
                    this.loading = true;
                }
                const response = await axios.get(url, {headers} );
                if ( response.data.status ){
                    if (response.data.data.page){
                        this.sliders = response.data.data.sliders;
                        this.kor_page = response.data.data.page;
                        this.kor_total_page= response.data.data.totalPage;
                        this.kor_per_page = response.data.data.per_page;
                        this.kor_total_data = response.data.data.total_data;
                    }
                }else{
                    this.sliders = null
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
                        // // window.location.href="./login.php"
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
        async getSlider(index){
            this.slider = this.sliders[index];
            //console.log(this.slider);
        },
        async changeSliderImage(event){
            this.kor_file = event.target.files[0];
            //console.log(this.kor_file);
        },
        async addSliderImage(){
            if (!this.slider_name || !this.slider_type || !this.kor_file || !this.slider_desc || !this.slider_product ){
                Swal.fire("Insert all Fields");
            }



            

            const headers = {
                "Authorization": `Bearer ${this.authToken}`,
                "Content-type": "application/json"
            }

            const data = new FormData();
            data.append('name', this.slider_name);
            data.append('type', this.slider_type);
            data.append('image', this.kor_file);
            data.append('shortdesc', this.slider_desc);
            data.append('product_id', this.slider_product.id);
            data.append('product_image', this.slider_product.images[0].image);

            let url = `${this.baseUrl}api/slider/addSlider.php`;

            try {
                this.loading = true;
                const response = await axios.post(url, data, {headers});
                if ( response.data.status ){
                    this.success = response.data.text;
                    new Toasteur().success(this.success);
                    this.kor_file = null;
                    await this.getAllSliders(7);
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
                        // // window.location.href="./login.php"
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
        async updateSlider(){
            if (!this.slider.name || !this.slider.type_code || !this.slider.description || !this.slider.product_id){
                Swal.fire("Insert all Fields");
            }

            const id = this.slider.product_id;

            var found = this.all_products.find(function(element) {
                return element.id === id;
            });

        

            const headers = {
                "Authorization": `Bearer ${this.authToken}`,
                "Content-type": "application/json"
            }

            const data = new FormData();
            data.append('slider_id', this.slider.id);
            data.append('name', this.slider.name);
            data.append('type', this.slider.type_code);
            if (this.kor_file){
                data.append('image', this.kor_file);
            }else{
                data.append('image', this.slider.img_link);
            }
            
            data.append('shortdesc', this.slider.description);
            data.append("product_id", id);
            data.append("product_image", found.images[0].image);

            let url = `${this.baseUrl}api/slider/updateSlider.php`;

            try {
                const response = await axios.post(url, data, {headers});
                if ( response.data.status ){
                    this.success = response.data.text;
                    new Toasteur().success(this.success);
                    await this.getAllSliders(7);
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
                        // // window.location.href="./login.php"
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
        async deleteSlider(id){
            const headers = {
                "Authorization": `Bearer ${this.authToken}`,
                "Content-type": "application/json"
            }

            

            const data = new FormData();
            data.append('slider_id', id);

            let url = `${this.baseUrl}api/slider/deleteSlider.php`;


            try {
                const response = await axios.post(url, data, {headers});
                if ( response.data.status ){
                    this.success = response.data.text;
                    new Toasteur().success(this.success);
                    await this.getAllSliders(7);
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
                        // // window.location.href="./login.php"
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
        async generatePass(){
            this.shop_password = generatePassword();
        },
        async addShop(){
            if (!this.shopname || !this.shop_city || !this.shop_country || !this.shop_currency || !this.shop_email || !this.shop_password 
                 || !this.shop_phone || !this.shop_whatsapp || !this.shop_type){
                new Toasteur().error("Insert All Fields");
                return
            }

            if (!validatePhoneNumber(this.shop_phone)){
                new Toasteur().error("Invalid Phone Number");
                return
            }
            if (!validatePhoneNumber(this.shop_whatsapp)){
                new Toasteur().error("Invalid Phone Number");
                return
            }

            const data = new FormData();
            data.append('shopname', this.shopname);
            data.append('shop_country', this.shop_country);
            data.append('shop_city', this.shop_city);
            data.append('shop_password', this.shop_password);
            data.append('shop_email', this.shop_email);
            data.append('shop_phone', validatePhoneNumber(this.shop_phone));
            data.append('shop_whatsapp', validatePhoneNumber(this.shop_whatsapp) );
            data.append('shop_type', this.shop_type);
            data.append('shop_currency', this.shop_currency);

            const headers = {
                "Authorization": `Bearer ${this.authToken}`,
                "Content-type": "application/json"
            }

            let url = `${this.baseUrl}api/shops/addShop.php`;


            try {
                const response = await axios.post(url, data, {headers});
                if ( response.data.status ){
                    this.success = response.data.text;
                    new Toasteur().success(this.success);
                    await this.getAllShops();
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
                        // // window.location.href="./login.php"
                        return
                    }
    
                    if (error.response.status == 405){
                        this.error = error.response.data.text;
                        new Toasteur().error(this.error);
                        // // window.location.href="./login.php"
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
        async getAllShops(load = 1){
            let search = (this.kor_search) ? `&search=${this.kor_search}` : ""; 
            let sort = (this.kor_sort !== null) ? `&sort=1&sortstatus=${this.kor_sort}` : "";
            let page = ( this.kor_page )? this.kor_page : 1;
            let per_page = ( this.kor_per_page ) ? this.kor_per_page : 5;
            
            const headers = {
                "Authorization": `Bearer ${this.authToken}`,
                "Content-type": "application/json"
            }

            let url = `${this.baseUrl}api/shops/getAllShops.php?page=${page}&per_page=${per_page}${search}${sort}`;

            this.kor_total_page = null
            try {
                if(load == 1){
                    this.loading = true;
                }
                const response = await axios.get(url, {headers} );
                if ( response.data.status ){
                    if (response.data.data.page){
                        this.shops = response.data.data.shop;
                        this.kor_page = response.data.data.page;
                        this.kor_total_page= response.data.data.totalPage;
                        this.kor_per_page = response.data.data.per_page;
                        this.kor_total_data = response.data.data.total_data;
                    }
                }else{
                    this.shops = null
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
                        // // window.location.href="./login.php"
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
        async getShop(index){
            this.shop = this.shops[index];
            //console.log(this.shop);
        },
        async setShopId(id){
            //console.log(id);
            window.localStorage.setItem("shop_id", id);
        },
        async getShopDetails(load = 1){
            let shop_id = (window.localStorage.getItem("shop_id"))? window.localStorage.getItem("shop_id") : "";

            const headers = {
                "Authorization": `Bearer ${this.authToken}`,
                "Content-type": "application/json"
            }

            let url = `${this.baseUrl}api/shops/getShopById.php?shop_id=${shop_id}`;

            this.kor_total_page = null
            try {
                if (load == 1){
                    this.loading = true;
                }
                const response = await axios.get(url, {headers} );
                if ( response.data.status ){
                    this.shop_details = response.data.data.shop;
                    //console.log(this.shop_details);
                }else{
                    this.shop_details = null
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
                        // // window.location.href="./login.php"
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
        async getShopLocations(load = 1){
            let shop_id = (window.localStorage.getItem("shop_id"))? window.localStorage.getItem("shop_id") : "";
            let page = ( this.kor_page )? this.kor_page : 1;
            let per_page = ( this.kor_per_page ) ? this.kor_per_page : 5;
            

            const headers = {
                "Authorization": `Bearer ${this.authToken}`,
                "Content-type": "application/json"
            }

            let url = `${this.baseUrl}api/shops/getAllShopLocation.php?shopid=${shop_id}&page=${page}&per_page=${per_page}`;

            this.kor_total_page = null
            try {
                if (load == 1){
                    this.loading = true;
                }
                const response = await axios.get(url, {headers} );
                if ( response.data.status ){
                    if (response.data.data.page){
                        this.shop_locations = response.data.data.Location;
                        this.kor_page = response.data.data.page;
                        this.kor_total_page= response.data.data.totalPage;
                        this.kor_per_page = response.data.data.per_page;
                        this.kor_total_data = response.data.data.total_data;
                    }
                }else{
                    this.shop_locations = null
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
                        // // window.location.href="./login.php"
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
        async getShopLocation(index){
            this.shop_location = this.shop_locations[index];
            //console.log(this.shop_location);
        },
        async getShopProducts(load = 1){
            let shop_id = (window.localStorage.getItem("shop_id"))? window.localStorage.getItem("shop_id") : "";
            let page = ( this.kor_page )? this.kor_page : 1;
            let per_page = ( this.kor_per_page ) ? this.kor_per_page : 5;
            

            const headers = {
                "Authorization": `Bearer ${this.authToken}`,
                "Content-type": "application/json"
            }

            let url = `${this.baseUrl}api/product/getAllShopProducts.php?shop_id=${shop_id}&page=${page}&per_page=${per_page}`;

            this.kor_total_page = null
            try {
                if (load == 1){
                    this.loading = true;
                }
                const response = await axios.get(url, {headers} );
                if ( response.data.status ){
                    if (response.data.data.page){
                        this.shop_products = response.data.data.products;
                        this.kor_page = response.data.data.page;
                        this.kor_total_page= response.data.data.totalPage;
                        this.kor_per_page = response.data.data.per_page;
                        this.kor_total_data = response.data.data.total_data;
                    }
                }else{
                    this.shop_locations = null
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
                        // // window.location.href="./login.php"
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
        async getProduct(index){
            this.shop_product = this.shop_products[index];
            //console.log(this.shop_product)
        },
        async changeShopStatus(shop_id, status){
            const headers = {
                "Authorization": `Bearer ${this.authToken}`,
                "Content-type": "application/json"
            }

            const data = new FormData();
            data.append('shop_id', shop_id);
            data.append('status', status);

            let url = `${this.baseUrl}api/shops/changeShopStatus.php`;


            try {
                const response = await axios.post(url, data, {headers});
                if ( response.data.status ){
                    this.success = response.data.text;
                    new Toasteur().success(this.success);
                    await this.getAllShops();
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
                        // // window.location.href="./login.php"
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
        async deleteShop(id){
            const headers = {
                "Authorization": `Bearer ${this.authToken}`,
                "Content-type": "application/json"
            }

            

            const data = new FormData();
            data.append('shop_id', id);

            let url = `${this.baseUrl}api/shops/deleteShop.php`;


            try {
                const response = await axios.post(url, data, {headers});
                if ( response.data.status ){
                    this.success = response.data.text;
                    new Toasteur().success(this.success);
                    await this.getAllSliders(7);
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
                        // // window.location.href="./login.php"
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
        async getAllUsers(load = 1){
            let search = (this.kor_search) ? `&search=${this.kor_search}` : ""; 
            let sort = (this.kor_sort !== null) ? `&sort=1&sortstatus=${this.kor_sort}` : "";
            let page = ( this.kor_page )? this.kor_page : 1;
            let per_page = ( this.kor_per_page ) ? this.kor_per_page : 5;
            
            const headers = {
                "Authorization": `Bearer ${this.authToken}`,
                "Content-type": "application/json"
            }

            let url = `${this.baseUrl}api/accounts/getAllUsers.php?page=${page}&per_page=${per_page}${search}${sort}`;

            this.kor_total_page = null
            try {
                if(load == 1){
                    this.loading = true;
                }
                const response = await axios.get(url, {headers} );
                if ( response.data.status ){
                    if (response.data.data.page){
                        this.users = response.data.data.users;
                        this.kor_page = response.data.data.page;
                        this.kor_total_page= response.data.data.totalPage;
                        this.kor_per_page = response.data.data.per_page;
                        this.kor_total_data = response.data.data.total_data;
                    }
                }else{
                    this.users = null
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
                        // // window.location.href="./login.php"
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
        async getUser(index){
            this.user = this.users[index]
        },
        async setUserId(id){
            //console.log(id);
            window.localStorage.setItem("user_id", id);
        },
        async getUserDetails(load = 1){
            let shop_id = (window.localStorage.getItem("user_id"))? window.localStorage.getItem("user_id") : "";

            const headers = {
                "Authorization": `Bearer ${this.authToken}`,
                "Content-type": "application/json"
            }

            let url = `${this.baseUrl}api/accounts/getAllUserById.php?user_id=${shop_id}`;

            this.kor_total_page = null
            try {
                if (load == 1){
                    this.loading = true;
                }
                const response = await axios.get(url, {headers} );
                if ( response.data.status ){
                    this.user_details = response.data.data.user;
                    //console.log(this.user_details);
                }else{
                    this.user_details = null
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
                        // // window.location.href="./login.php"
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
        async getUserOrders(load = 1, loadpage = 1){
            let user_id = (window.localStorage.getItem("user_id"))? window.localStorage.getItem("user_id") : "";
            let page = ( this.kor_page )? this.kor_page : 1;
            let per_page = ( this.kor_per_page ) ? this.kor_per_page : 5;
            

            const headers = {
                "Authorization": `Bearer ${this.authToken}`,
                "Content-type": "application/json"
            }

            let url = `${this.baseUrl}api/order/getUserOrder.php?user_id=${user_id}&page=${page}&noPerPage=${per_page}`;

            this.kor_total_page = null
            try {
                if (load == 1){
                    this.loading = true;
                }
                const response = await axios.get(url, {headers} );
                if ( response.data.status ){
                    if (response.data.data.page){
                        this.user_orders = response.data.data.orders;
                        if (loadpage == 1){
                            this.kor_page = response.data.data.page;
                            this.kor_total_page= response.data.data.totalPage;
                            this.kor_per_page = response.data.data.per_page;
                            this.kor_total_data = response.data.data.total_data;
                        }
                        
                    }
                }else{
                    this.user_orders = null
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
                        // // window.location.href="./login.php"
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
        async getOrder(index){
            this.user_order = this.user_orders[index];
        },
        async getUserNotifications(load = 1){
            let user_id = (window.localStorage.getItem("user_id"))? window.localStorage.getItem("user_id") : "";
            let page = ( this.kor_page )? this.kor_page : 1;
            let per_page = ( this.kor_per_page ) ? this.kor_per_page : 5;
            

            const headers = {
                "Authorization": `Bearer ${this.authToken}`,
                "Content-type": "application/json"
            }

            let url = `${this.baseUrl}api/notifications/getNotificationByUserId.php?userid=${user_id}&page=${page}&per_page=${per_page}`;

            this.kor_total_page = null
            try {
                if (load == 1){
                    this.loading = true;
                }
                const response = await axios.get(url, {headers} );
                if ( response.data.status ){
                    if (response.data.data.page){
                        this.user_notifications = response.data.data.notification;
                        this.kor_page = response.data.data.page;
                        this.kor_total_page= response.data.data.totalPage;
                        this.kor_per_page = response.data.data.per_page;
                        this.kor_total_data = response.data.data.total_data;
                    }
                }else{
                    this.user_notifications = null
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
                        // // window.location.href="./login.php"
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
        async getNotification(index){
            this.user_notification = this.user_notifications[index];
        },
        async getAllUserAddress(load = 1){
            let user_id = (window.localStorage.getItem("user_id"))? window.localStorage.getItem("user_id") : "";
            let page = ( this.kor_page )? this.kor_page : 1;
            let per_page = ( this.kor_per_page ) ? this.kor_per_page : 5;
            

            const headers = {
                "Authorization": `Bearer ${this.authToken}`,
                "Content-type": "application/json"
            }

            let url = `${this.baseUrl}api/deliveryAddress/getUserAddress.php?userid=${user_id}&page=${page}&noPerPage=${per_page}`;

            this.kor_total_page = null
            try {
                if (load == 1){
                    this.loading = true;
                }
                const response = await axios.get(url, {headers} );
                if ( response.data.status ){
                    if (response.data.data.page){
                        this.user_addresses = response.data.data.deliveryAddress;
                        this.kor_page = response.data.data.page;
                        this.kor_total_page= response.data.data.totalPage;
                        this.kor_per_page = response.data.data.per_page;
                        this.kor_total_data = response.data.data.total_data;
                    }
                }else{
                    this.user_addresses = null
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
                        // // window.location.href="./login.php"
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
        async getAddress(index){
            this.user_address = this.user_addresses[index];
        },
        async getUserTransactions(load = 1, loadpage = 1){
            let user_id = (window.localStorage.getItem("user_id"))? window.localStorage.getItem("user_id") : "";
            let page = ( this.kor_page )? this.kor_page : 1;
            let per_page = ( this.kor_per_page ) ? this.kor_per_page : 5;
            

            const headers = {
                "Authorization": `Bearer ${this.authToken}`,
                "Content-type": "application/json"
            }

            let url = `${this.baseUrl}api/userwallettrans/getTransactionByUserId.php?userid=${user_id}&page=${page}&per_page=${per_page}`;

            this.kor_total_page = null
            try {
                if (load == 1){
                    this.loading = true;
                }
                const response = await axios.get(url, {headers} );
                if ( response.data.status ){
                    if (response.data.data.page){
                        this.user_transactions = response.data.data.transactions;
                        if (loadpage == 1 ){
                            this.kor_page = response.data.data.page;
                            this.kor_total_page= response.data.data.totalPage;
                            this.kor_per_page = response.data.data.per_page;
                            this.kor_total_data = response.data.data.total_data;
                        }
                    }
                }else{
                    this.user_transactions = null
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
                        // // window.location.href="./login.php"
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
        async getAllTransactions(load = 1, loadpage = 1){
            let search = (this.kor_search) ? `&search=${this.kor_search}` : ""; 
            let sort = (this.kor_sort !== null) ? `&sort=1&sortstatus=${this.kor_sort}` : "";
            let page = ( this.kor_page )? this.kor_page : 1;
            let per_page = ( this.kor_per_page ) ? this.kor_per_page : 5;
            

            const headers = {
                "Authorization": `Bearer ${this.authToken}`,
                "Content-type": "application/json"
            }

            let url = `${this.baseUrl}api/userwallettrans/getAllTransaction.php?page=${page}&per_page=${per_page}${search}${sort}`;

            this.kor_total_page = null
            try {
                if (load == 1){
                    this.loading = true;
                }
                const response = await axios.get(url, {headers} );
                if ( response.data.status ){
                    if (response.data.data.page){
                        this.user_transactions = response.data.data.transactions;
                        if (loadpage == 1 ){
                            this.kor_page = response.data.data.page;
                            this.kor_total_page= response.data.data.totalPage;
                            this.kor_per_page = response.data.data.per_page;
                            this.kor_total_data = response.data.data.total_data;
                        }
                    }
                }else{
                    this.user_transactions = null
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
                        // // window.location.href="./login.php"
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
        async getAllProducts(load = 1, show_page = 1){
            let type;
            let search = (this.kor_search) ? `&search=${this.kor_search}` : ""; 
            let sort = (this.kor_sort !== null) ? `&sort=1&sortstatus=${this.kor_sort}` : "";
            let page = ( this.kor_page )? this.kor_page : 1;
            let per_page = ( this.kor_per_page ) ? this.kor_per_page : 8;

            if (this.kor_sorttype && this.kor_sort){
                type = `&sorttype=${this.kor_sorttype}`;
           } 
           if ( this.kor_sorttype && !this.kor_sort ){
               type = `&sort=1&sorttype=${this.kor_sorttype}`;
           }
           if (!this.kor_sorttype){
               type = "";
           }
            

            const headers = {
                "Authorization": `Bearer ${this.authToken}`,
                "Content-type": "application/json"
            }

            let url = `${this.baseUrl}api/product/getAllProducts.php?page=${page}&per_page=${per_page}${search}${sort}${type}`;

            this.kor_total_page = null
            try {
                if (load == 1){
                    this.loading = true;
                }
                const response = await axios.get(url, {headers} );
                if ( response.data.status ){
                    if (response.data.data.page){
                        this.all_products = response.data.data.products;
                        if (show_page == 1){
                            this.kor_page = response.data.data.page;
                            this.kor_total_page= response.data.data.totalPage;
                            this.kor_per_page = response.data.data.per_page;
                            this.kor_total_data = response.data.data.total_data;
                        }
                    }
                }else{
                    this.all_products = null
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
                        // // window.location.href="./login.php"
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
        async get_product(index){
            this.product = this.all_products[index];
            //console.log(this.product);
        },
        async getTransaction(index){
            if ( webPage == "customer-details.php" ){
                this.user_transaction = this.user_transactions[index];
            }

            if ( webPage == "transactions.php" ){
                this.transaction = this.all_transactions[index]
            }
            
        },
        async getUserComplains(load = 1){
            let user_id = (window.localStorage.getItem("user_id"))? window.localStorage.getItem("user_id") : "";
            let page = ( this.kor_page )? this.kor_page : 1;
            let per_page = ( this.kor_per_page ) ? this.kor_per_page : 5;
            

            const headers = {
                "Authorization": `Bearer ${this.authToken}`,
                "Content-type": "application/json"
            }

            let url = `${this.baseUrl}api/complains/getAllUserComplain.php?userid=${user_id}&user_type=4&page=${page}&per_page=${per_page}`;

            this.kor_total_page = null
            try {
                if (load == 1){
                    this.loading = true;
                }
                const response = await axios.get(url, {headers} );
                if ( response.data.status ){
                    if (response.data.data.page){
                        this.user_complains = response.data.data.complains;
                        this.kor_page = response.data.data.page;
                        this.kor_total_page= response.data.data.totalPage;
                        this.kor_per_page = response.data.data.per_page;
                        this.kor_total_data = response.data.data.total_data;
                    }
                }else{
                    this.user_complains = null
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
                        // // window.location.href="./login.php"
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
        async getUserComplain(index){
            this.user_complain = this.user_complains[index];
        },
        async getOrderAndTransaction(){
            await this.getUserOrders(2, 3);
            await this.getUserTransactions(3, 4)
        },
        async getUserActivities(load = 1){
            let user_email = (this.user_details)? this.user_details.email : "";
            let page = ( this.kor_page )? this.kor_page : 1;
            let per_page = ( this.kor_per_page ) ? this.kor_per_page : 5;
            

            const headers = {
                "Authorization": `Bearer ${this.authToken}`,
                "Content-type": "application/json"
            }

            let url = `${this.baseUrl}api/accounts/getAllUserActivities.php?email=${user_email}&user_type=4&page=${page}&per_page=${per_page}`;

            this.kor_total_page = null
            try {
                if (load == 1){
                    this.loading = true;
                }
                const response = await axios.get(url, {headers} );
                if ( response.data.status ){
                    if (response.data.data.page){
                        this.user_activities = response.data.data.totalSession;
                        this.kor_page = response.data.data.page;
                        this.kor_total_page= response.data.data.totalPage;
                        this.kor_per_page = response.data.data.per_page;
                        this.kor_total_data = response.data.data.total_data;
                    }
                }else{
                    this.user_activities = null
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
                        // // window.location.href="./login.php"
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
        async getActivity(index){
            this.user_activity = this.user_activities[index];
        },
        async changeUserStatus(user_id, status){
            const headers = {
                "Authorization": `Bearer ${this.authToken}`,
                "Content-type": "application/json"
            }

            const data = new FormData();
            data.append('user_id', user_id);
            data.append('status', status);

            let url = `${this.baseUrl}api/accounts/changeUserStatus.php`;


            try {
                const response = await axios.post(url, data, {headers});
                if ( response.data.status ){
                    this.success = response.data.text;
                    new Toasteur().success(this.success);
                    await this.getAllUsers(3);
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
                        // // window.location.href="./login.php"
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
        async deleteUser(id){
            const headers = {
                "Authorization": `Bearer ${this.authToken}`,
                "Content-type": "application/json"
            }

            

            const data = new FormData();
            data.append('userid', id);

            let url = `${this.baseUrl}api/accounts/deleteUser.php`;


            try {
                const response = await axios.post(url, data, {headers});
                if ( response.data.status ){
                    this.success = response.data.text;
                    new Toasteur().success(this.success);
                    await this.getAllUsers(4);
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
                        // // window.location.href="./login.php"
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
        async deleteProduct(id){
            const headers = {
                "Authorization": `Bearer ${this.authToken}`,
                "Content-type": "application/json"
            }

            

            const data = new FormData();
            data.append('product_id', id);

            let url = `${this.baseUrl}api/product/getAllProducts.php`;


            try {
                const response = await axios.post(url, data, {headers});
                if ( response.data.status ){
                    this.success = response.data.text;
                    new Toasteur().success(this.success);
                    await this.getAllProducts(4);
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
                        // // window.location.href="./login.php"
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
        async changeProductStatus(id, status){
            const headers = {
                "Authorization": `Bearer ${this.authToken}`,
                "Content-type": "application/json"
            }

            

            const data = new FormData();
            data.append('product_id', id);
            data.append('status', status);

            let url = `${this.baseUrl}api/product/changeProductStatus.php`;


            try {
                const response = await axios.post(url, data, {headers});
                if ( response.data.status ){
                    this.success = response.data.text;
                    new Toasteur().success(this.success);
                    await this.getAllProducts(4);
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
                        // // window.location.href="./login.php"
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
        async changeFeaturedStatus(id, status){
            const headers = {
                "Authorization": `Bearer ${this.authToken}`,
                "Content-type": "application/json"
            }

            

            const data = new FormData();
            data.append('product_id', id);
            data.append('status', status);

            let url = `${this.baseUrl}api/product/set_as_featured.php`;


            try {
                const response = await axios.post(url, data, {headers});
                if ( response.data.status ){
                    this.success = response.data.text;
                    new Toasteur().success(this.success);
                    await this.getAllProducts(4);
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
                        // // window.location.href="./login.php"
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
        async getAllCategories(load = 1, loadpage = 1){
            let search = (this.kor_search) ? `&search=${this.kor_search}` : "";
            let page = ( this.kor_page )? this.kor_page : 1;
            let per_page = ( this.kor_per_page ) ? this.kor_per_page : 5;
            

            const headers = {
                "Authorization": `Bearer ${this.authToken}`,
                "Content-type": "application/json"
            }

            let url = `${this.baseUrl}api/product/getProductCategory.php?page=${page}&noPerPage=${per_page}${search}`;

            this.kor_total_page = null
            try {
                if (load == 1){
                    this.loading = true;
                }
                const response = await axios.get(url, {headers} );
                if ( response.data.status ){
                    if (response.data.data.page){
                        this.all_categories = response.data.data.productCategories;
                        if (loadpage == 1){
                            this.kor_page = response.data.data.page;
                            this.kor_total_page= response.data.data.totalPage;
                            this.kor_per_page = response.data.data.per_page;
                            this.kor_total_data = response.data.data.total_data;
                        }   
                    }
                }else{
                    this.all_categories = null
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
                        // // window.location.href="./login.php"
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
        async getAllSubCategories(load = 1, loadpage = 1){
            let search = (this.kor_search) ? `&search=${this.kor_search}` : "";
            let page = ( this.kor_page )? this.kor_page : 1;
            let per_page = ( this.kor_per_page ) ? this.kor_per_page : 5;
            

            const headers = {
                "Authorization": `Bearer ${this.authToken}`,
                "Content-type": "application/json"
            }

            let url = `${this.baseUrl}api/product/getAllSubCategory.php?page=${page}&noPerPage=${per_page}${search}`;

            this.kor_total_page = null
            try {
                if (load == 1){
                    this.loading = true;
                }
                const response = await axios.get(url, {headers} );
                if ( response.data.status ){
                    if (response.data.data.page){
                        this.all_sub_categories = response.data.data.sub_categories;
                        if (loadpage == 1){
                            this.kor_page = response.data.data.page;
                            this.kor_total_page= response.data.data.totalPage;
                            this.kor_per_page = response.data.data.per_page;
                            this.kor_total_data = response.data.data.total_data;
                        }
                        
                    }
                }else{
                    this.all_sub_categories = null
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
                        // // window.location.href="./login.php"
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
        async getCategory(index){
            this.category = this.all_categories[index];
        },
        async getSubCategory(index){
            this.sub_category = this.all_sub_categories[index];
        },
        async getAllBrands(load = 1){
            let search = (this.kor_search) ? `&search=${this.kor_search}` : "";
            let page = ( this.kor_page )? this.kor_page : 1;
            let per_page = ( this.kor_per_page ) ? this.kor_per_page : 5;
            

            const headers = {
                "Authorization": `Bearer ${this.authToken}`,
                "Content-type": "application/json"
            }

            let url = `${this.baseUrl}api/product/getProductBrand.php?page=${page}&noPerPage=${per_page}${search}`;

            this.kor_total_page = null
            try {
                if (load == 1){
                    this.loading = true;
                }
                const response = await axios.get(url, {headers} );
                if ( response.data.status ){
                    if (response.data.data.page){
                        this.all_brands = response.data.data.productBrands;
                        this.kor_page = response.data.data.page;
                        this.kor_total_page= response.data.data.totalPage;
                        this.kor_per_page = response.data.data.per_page;
                        this.kor_total_data = response.data.data.total_data;
                    }
                }else{
                    this.all_brands = null
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
                        // // window.location.href="./login.php"
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
        async getBrand(index){
            this.brand = this.all_brands[index];
        },
        async updateCategory(){
            const headers = {
                "Authorization": `Bearer ${this.authToken}`,
                "Content-type": "application/json"
            }

            const data = new FormData();
            data.append("id", this.category.id);
            data.append("name", this.category.name);
            data.append("description", this.category.description);
            if (this.kor_file){
                data.append('image', this.kor_file);
            }else{
                data.append('image', this.category.image);
            }

            let url = `${this.baseUrl}api/product/updateProductCategory.php`;


            try {
                const response = await axios.post(url, data ,{headers});
                if ( response.data.status ){
                    this.success = response.data.text;
                    new Toasteur().success(this.success);
                    await this.getAllCategories();
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
                        // // window.location.href="./login.php"
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
        async addCategory(){
            const headers = {
                "Authorization": `Bearer ${this.authToken}`,
                "Content-type": "application/json"
            }

            const data = new FormData();
            data.append("name", this.category_name);
            data.append("description", this.category_description);
            data.append("images", this.kor_file);

            let url = `${this.baseUrl}api/product/addProductCategory.php`;


            try {
                const response = await axios.post(url, data ,{headers});
                if ( response.data.status ){
                    this.success = response.data.text;
                    new Toasteur().success(this.success);
                    await this.getAllCategories();
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
                        // // window.location.href="./login.php"
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
        async addSubCategory(){
            const headers = {
                "Authorization": `Bearer ${this.authToken}`,
                "Content-type": "application/json"
            }

            if (!this.sub_category_name || !this.category_id || !this.kor_file){
                new Toasteur().error("Insert all Fields");
            }

            const data = new FormData();
            data.append("sub_cat_name", this.sub_category_name);
            data.append("category_id", this.category_id);
            data.append("images", this.kor_file);


            let url = `${this.baseUrl}api/product/AddProductSub_Category.php`;


            try {
                const response = await axios.post(url, data ,{headers});
                if ( response.data.status ){
                    this.success = response.data.text;
                    new Toasteur().success(this.success);
                    await this.getAllSubCategories();
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
                        // // window.location.href="./login.php"
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
        async updateSubCategory(){
            const headers = {
                "Authorization": `Bearer ${this.authToken}`,
                "Content-type": "application/json"
            }

            if (!this.sub_category.cat_id || !this.sub_category.name ){
                new Toasteur().error("Insert name and Category");
            }
            if (!this.kor_file && !this.sub_category.image){
                new Toasteur().error("Insert a Category Image");
            }

            const data = new FormData();
            data.append("sub_cat_id", this.sub_category.id);
            data.append("category_id", this.sub_category.cat_id);
            data.append("sub_cat_name", this.sub_category.name);
            if (this.kor_file){
                data.append('image', this.kor_file);
            }else{
                data.append('image', this.sub_category.image);
            }

            let url = `${this.baseUrl}api/product/updateProductSub_Category.php`;


            try {
                const response = await axios.post(url, data ,{headers});
                if ( response.data.status ){
                    this.success = response.data.text;
                    new Toasteur().success(this.success);
                    await this.getAllSubCategories();
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
                        // // window.location.href="./login.php"
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
        async deleteCategory(id){
            const headers = {
                "Authorization": `Bearer ${this.authToken}`,
                "Content-type": "application/json"
            }

            let url = `${this.baseUrl}api/product/deleteProductCategory.php?id=${id}`;


            try {
                const response = await axios.get(url, {headers});
                if ( response.data.status ){
                    this.success = response.data.text;
                    new Toasteur().success(this.success);
                    await this.getAllCategories();
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
                        // // window.location.href="./login.php"
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
        async deleteSubCategory(id){
            const headers = {
                "Authorization": `Bearer ${this.authToken}`,
                "Content-type": "application/json"
            }

            const data = new FormData();
            data.append("sub_cat_id", id);

            let url = `${this.baseUrl}api/product/deleteSubCategory.php`;


            try {
                const response = await axios.post(url, data ,{headers});
                if ( response.data.status ){
                    this.success = response.data.text;
                    new Toasteur().success(this.success);
                    await this.getAllSubCategories(4);
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
                        // // window.location.href="./login.php"
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
        async kor_remove_sort(){
            this.kor_sort = null;
            if ( webPage == "complaints.php"){
                await this.comp_getAllComplains(5);
            }
            if ( webPage == "sliders.php"){
                await this.getAllSliders(4);
            }
            if ( webPage == "shops.php"){
                await this.getAllShops(3)
            }
            if ( webPage == "customers.php"){
                await this.getAllUsers(3)
            }
            if ( webPage == "transactions.php"){
                await this.getAllTransactions(3);
            }
            if ( webPage == "products.php"){
                await this.getAllProducts(3);
            }
        },
        async kor_add_sort(status){
            this.kor_sort = status;
            if ( webPage == "complaints.php"){
                await this.comp_getAllComplains(5);
            }
            if ( webPage == "sliders.php"){
                await this.getAllSliders(4);
            }
            if ( webPage == "shops.php"){
                await this.getAllShops(3)
            }
            if ( webPage == "customers.php"){
                await this.getAllUsers(3)
            }
            if ( webPage == "transactions.php"){
                await this.getAllTransactions(3);
            }
            if ( webPage == "products.php"){
                await this.getAllProducts(3);
            }
        },
        async nav_nextPage(){
            this.kor_page = parseInt(this.kor_page) + 1;
            if (webPage === "complaints.php"){
                this.comp_getAllComplains(2);
            }
            if ( webPage == "sliders.php"){
                await this.getAllSliders(4);
            }
            if ( webPage == "shops.php"){
                await this.getAllShops(3)
            }
            if ( webPage == "customers.php"){
                await this.getAllUsers(3)
            }
            if ( webPage == "products.php"){
                await this.getAllProducts(4);
            }
            if ( webPage == "category.php"){
                await this.getAllCategories(3)
            }
            if ( webPage == "sub_categories.php"){
                await this.getAllSubCategories(3)
            }
            if ( webPage == "brands.php"){
                await this.getAllBrands(5)
            }

        },
        async nav_previousPage(){
            this.kor_page = parseInt(this.kor_page) - 1;
            if (webPage === "complaints.php"){
                this.comp_getAllComplains(2);
            }
            if ( webPage == "sliders.php"){
                await this.getAllSliders(4);
            }
            if ( webPage == "shops.php"){
                await this.getAllShops(3)
            }
            if ( webPage == "customers.php"){
                await this.getAllUsers(3)
            }
            if ( webPage == "products.php"){
                await this.getAllProducts(4);
            }
            if ( webPage == "category.php"){
                await this.getAllCategories(3)
            }
            if ( webPage == "sub_categories.php"){
                await this.getAllSubCategories(3)
            }
            if ( webPage == "brands.php"){
                await this.getAllBrands(5)
            }
        },
        async nav_selectPage(page){
            this.kor_page = page;
            if (webPage === "complaints.php"){
                this.comp_getAllComplains(2);
            }
            if ( webPage == "sliders.php"){
                await this.getAllSliders(4);
            }
            if ( webPage == "shops.php"){
                await this.getAllShops(3)
            }
            if ( webPage == "customers.php" ){
                await this.getAllUsers(3)
            }
            if ( webPage == "products.php"){
                await this.getAllProducts(4);
            }
            if ( webPage == "category.php"){
                await this.getAllCategories(3)
            }
            if ( webPage == "sub_categories.php"){
                await this.getAllSubCategories(3)
            }
            if ( webPage == "brands.php"){
                await this.getAllBrands(5)
            }
        },
        async nav_dynamic_nextPage(item){
            this.kor_page = parseInt(this.kor_page) + 1;
            
            if (item == "shop_product"){
                await this.getShopProducts(3);
            }
            if (item == "shop_location"){
                await this.getShopLocations(3);
            }

            if ( item == "user_orders"){
                await this.getUserOrders(3);
            }
            if ( item == "user_notification"){
                await this.getUserNotifications(3);
            }
            if ( item == "user_activity"){
                await this.getUserActivities(3);
            }
            if ( item == "user_address"){
                await this.getAllUserAddress(3);
            }
            if ( item == "user_transaction"){
                await this.getUserTransactions(3);
            }
            if ( item == "user_complain"){
                await this.getUserComplains(3);
            }
        },
        async nav_dynamic_previousPage(item){
            this.kor_page = parseInt(this.kor_page) - 1;

            if (item == "shop_product"){
                await this.getShopProducts(3);
            }
            if (item == "shop_location"){
                await this.getShopLocations(3);
            }

            if ( item == "user_orders"){
                await this.getUserOrders(3);
            }
            if ( item == "user_notification"){
                await this.getUserNotifications(3);
            }
            if ( item == "user_activity"){
                await this.getUserActivities(3);
            }
            if ( item == "user_address"){
                await this.getAllUserAddress(3);
            }
            if ( item == "user_transaction"){
                await this.getUserTransactions(3);
            }
            if ( item == "user_complain"){
                await this.getUserComplains(3);
            }
        },
        async nav_dynamic_selectPage(item ,page){
            this.kor_page = page;
            
            if (item == "shop_product"){
                await this.getShopProducts(3);
            }

            if (item == "shop_location"){
                await this.getShopLocations(3);
            }

            if ( item == "user_orders"){
                await this.getUserOrders(3);
            }
            if ( item == "user_notification"){
                await this.getUserNotifications(3);
            }
            if ( item == "user_activity"){
                await this.getUserActivities(3);
            }
            if ( item == "user_address"){
                await this.getAllUserAddress(3);
            }
            if ( item == "user_transaction"){
                await this.getUserTransactions(3);
            }
            if ( item == "user_complain"){
                await this.getUserComplains(3);
            }
            
        },
        async wordCount(){
            this.length = WordCount(this.slider_desc);
            if ( this.length == 15 ){
                new Toasteur().error("Maximum Words Reached");
            }
        },
        async logout(){
            window.localStorage.removeItem("authToken");
            // // window.location.href="./login.php"
        }        
    },
    beforeMount(){
        this.loading = true;
    },
    async mounted(){
        this.getToken();
        this.getAdminDetails();
        //......lareWaju...........
        if (webPage !== "logistics-detail.php" && webPage !== "logistics.php"){
            if ( window.localStorage.getItem("Logistic_id") ){
                window.localStorage.removeItem("Logistic_id")
            }
        }
        if ( webPage !== "invoice-details.php" && webPage !== 'invoice-print.php'){
            if ( window.localStorage.getItem("orderRefno") ){
                window.localStorage.removeItem("orderRefno")
            }
        }

        if (webPage !== "admin-details.php" && webPage !== "admins.php"){
            if ( window.localStorage.getItem("admin_id") ){
                window.localStorage.removeItem("admin_id")
            }
        }
        // End larewaju

        if (webPage !== "shop-detail.php" && webPage !== "shops.php"){
            if ( window.localStorage.getItem("shop_id") ){
                window.localStorage.removeItem("shop_id")
            }
        }
        if ( webPage === "shop-detail.php"){
            await this.getShopDetails();
        }

        if (webPage !== "customer-details.php" && webPage !== "customers.php"){
            if ( window.localStorage.getItem("user_id") ){
                window.localStorage.removeItem("user_id")
            }
        }
        if ( webPage === "customer-details.php"){
            await this.getUserDetails();
        }
    }

});

admin.mount('#admin');