const urlPath = window.location.pathname.split("/");
const length = urlPath.length;
const page = urlPath[length -1];

let userApp = Vue.createApp({
    data(){
        return{
            // Lanre data
            carts: [],
            orders:[],
            refNo: null,
            trackid: null,
            track_id: null,
            order_status: null,
            total_weight: null,
            total_paid: null,
            cartIndex: '',
            orderIndex: '',
            addresses:[],
            address_details: null,
            address: null,
            addressno: null,
            lga: null,
            zipcode: null,
            username: null,
            firstname: null,
            lastname: null,
            fullname: null,
            phoneno: null,
            state: null,
            resetToken: '',
            userpubkey: '',
            country: null,
            // End Lanre Data
            // Korede Data

            // End Korede
            user_detais: null,
            user_address: null,
            shipping_address: "",
            ref_link: null,
            defaultAddress: null,
            notifications: null,
            weight: null,
            price: null,
            logistics: null,
            selectedLogistics: "",
            locations: null,
            selectedLocation: "",
            username: null,
            total_wallet_balance: null,
            activities: null,
            complains: null,
            each_complain: null,
            complain: null,
            currentpassword: null,
            wallets: null,
            transactions: null,
            password: null,
            authToken: null,
            confirmPassword: null,
            loading: false,
            search: null,
            sort: null,
            page: null,
            total_page: null,
            currentPage: 1,
            totalData: null,
            per_page: 6,
            error: null,
            baseurl: "http://localhost/cart.ng2/"
        }
    },
    created() {
        this.getToken()
        //to save data for serverside rendering
        if(page == 'shipment1.php' || page == 'shipment2.php'){
            //get refno and carts cartIndex from localStorage
            let carts = (localStorage.getItem("carts")) ? JSON.parse(localStorage.getItem("carts")): null;
            let orderRef = (localStorage.getItem("refno")) ? localStorage.getItem("refno"): null;
            let cartIndex = (localStorage.getItem("cartIndex")) ? localStorage.getItem("cartIndex"): null;
            let trackid = (localStorage.getItem("trackid")) ? localStorage.getItem("trackid"): null;
            this.loading = true;
            if(carts && orderRef && cartIndex && trackid){
                //set dataObject to localStorage
                this.refNo = orderRef;
                this.cartIndex = cartIndex
                this.trackid = trackid;
                this.carts = carts

                let orderStatus = this.carts[this.cartIndex].orderStatusid
                this.order_status = orderStatus;

                let track_id = this.carts[this.cartIndex].trackid
                this.track_id = track_id;

                let totalweightlbs = this.carts[this.cartIndex].totalweightlbs
                this.total_weight =  totalweightlbs;

                let totalPaid = this.carts[this.cartIndex].totalPaid
                this.total_paid =  totalPaid;

                this.getOrderByOrderRefno(this.refNo)//will set it to orders

                console.log(`Am on shipment${page}, i need order details and make call to api`);
                console.log('onCreatedCarts', this.carts);
                console.log("Refno",this.refNo);
                console.log('onCreatedCartIndex', this.cartIndex);
                console.log('onCreatedCartStatus',orderStatus);
                console.log('onCreatedtrackid',this.trackid);
                console.log('onCreatedtrack_id',this.track_id);
                console.log('onCreatedDOCartStatus',this.order_status);
                console.log('onCreatedOrder', this.orders);
                
            }else{
                if(page == 'shipment1.php'){
                    window.location.href = 'shipment.php'
                }
                if(page == 'shipment2.php'){
                    window.location.href = 'orders.php'
                } 
            }

        }
        
        if(page == 'address.php'){
            this.loading= true;
            this.getUserAddress();
        }

        if(page == 'shipment.php' || page == 'orders.php'){
            this.loading= true;
            this.getUserCarts();
        }
    },
    methods: {
        async redirectOrder(page,orderRefno, trackid, cartIndex){
            this.refNo = null;
            this.trackid = null;
            this.cartIndex = null;
            localStorage.setItem("refno", orderRefno);
            localStorage.setItem("cartIndex", cartIndex);
            localStorage.setItem("trackid", trackid);
            window.location.href= page;
        },
        async sortCartByStatus(cartStatus){
            console.log('status', cartStatus);
            this.getUserCartByOrderStatus()
        },
        async allCart(){
            this.sort = null;
            this.currentPage =null;
            this.totalData =null;
            this.total_page =null;
            this.getUserCarts();
        },

        redirectAddress(){
            this.addresses = null;
            window.location.href= 'address.php';
        },
        async redirectOrder(page,orderRefno, trackid, cartIndex){
            this.refNo = null;
            this.trackid = null;
            this.cartIndex = null;
            localStorage.setItem("refno", orderRefno);
            localStorage.setItem("cartIndex", cartIndex);
            localStorage.setItem("trackid", trackid);
            window.location.href= page;
        },
        async sortCartByStatus(cartStatus){
            console.log('status', cartStatus);
            this.getUserCartByOrderStatus()
        },
        async allCart(){
            this.sort = null;
            this.currentPage =null;
            this.totalData =null;
            this.total_page =null;
            this.getUserCarts();
        },

        redirectAddress(){
            this.addresses = null;
            window.location.href= 'address.php';
        },
        
        async nextPage(){
            this.currentPage = parseInt(this.currentPage) + 1;
            this.totalData =null;
            this.total_page =null;
            if(page == 'orders.php' || page == 'shipment.php'){
                this.getUserCarts()
            }
            if(page == 'address.php'){
                this.getUserAddress()
            }

        },
        async previousPage(){
            this.currentPage = parseInt(this.currentPage) - 1;
            this.totalData =null;
            this.total_page =null;
            if(page == 'orders.php' || page == 'shipment.php'){
                this.getUserCarts()
            }
            if(page == 'address.php'){
                this.getUserAddress()
            }

        },  
        async sortByOrderStatus(sortStatus){
            this.sort = sortStatus;
            this.currentPage =null;
            this.totalData =null;
            this.total_page =null;
            console.log('SortStatus', sortStatus);
            this.getUserCarts()

        },
        async getUserCarts(){
            let search = (this.search)? `&search=${this.search}`: '';
            let sort = (this.sort != null) ? `&sort=1&sortStatus=${this.sort}` : "";  
            let page = ( this.currentPage )? this.currentPage : 1;
            let noPerPage = ( this.per_page ) ? this.per_page : 5;
            const url = `${this.baseurl}api/cart/getUserCart.php?noPerPage=${noPerPage}&page=${page}${search}${sort}`;
            console.log('URL', url);
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
                if(response.data.status){
                    this.carts=response.data.data.productCarts;
                    this.currentPage =response.data.data.page
                    this.totalData =response.data.data.total_data
                    this.total_page =response.data.data.totalPage
                    window.localStorage.setItem("carts", JSON.stringify(response.data.data.productCarts))                              
                }else{
                    this.carts= null
                    this.currentPage = null
                    this.totalData =null
                    this.total_page =null;
                }
                console.log(this.total_page);     
            } catch (error) {
                // console.log(error);
                if (error.response){
                    if (error.response.status == 400){
                        const errorMsg = error.response.data.text;
                        swal(errorMsg);
                        return
                    }
    
                    if (error.response.status == 401){
                        const errorMsg = "User not Authorized";
                        swal(errorMsg);
                        return
                    }
    
                    if (error.response.status == 405){
                        const errorMsg = error.response.data.text;
                        swal(errorMsg);
                        return
                    }
    
                    if (error.response.status == 500){
                        const errorMsg = error.response.data.text;
                        swal(errorMsg);
                        return
                    }
                }

                swal(error.message || "Error processing request")

                
            }finally {
                this.loading = false;
            }
        },
        async getUserCartByOrderStatus(status){
            console.log("status is ", status);
            const url = `${this.baseurl}api/cart/getUserCartByOrderStatus.php?status=${status}`;
            console.log('URL', url);
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
                if(response.data.status){
                    this.carts=response.data.data.productCarts;
                    //console.log("carts", response.data.data.productCarts);
                    
                    
                }
                console.log(response);     
            } catch (error) {
                //console.log(error);
                if (error.response){
                    if (error.response.status == 400){
                        const errorMsg = error.response.data.text;
                        swal(errorMsg);
                        return
                    }
    
                    if (error.response.status == 401){
                        const errorMsg = "User not Authorized";
                        swal(errorMsg);
                        return
                    }
    
                    if (error.response.status == 405){
                        const errorMsg = error.response.data.text;
                        swal(errorMsg);
                        return
                    }
    
                    if (error.response.status == 500){
                        const errorMsg = error.response.data.text;
                        swal(errorMsg);
                        return
                    }
                }

                swal(error.message || "Error processing request")

                
            }finally {
                this.loading = false;
            }
        },
        async getAddressByid(id){
            console.log("addressid", id);
            const url = `${this.baseurl}api/deliveryAddress/getAddressByid.php?id=${id}`;
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
                    this.address_details = response.data.data;
                    console.log(response.data.data);
                }
            } catch (error) {
                // console.log(error);
                if (error.response){
                    if (error.response.status == 400){
                        const errorMsg = error.response.data.text;
                        swal(errorMsg);
                        return
                    }
    
                    if (error.response.status == 401){
                        const errorMsg = "User not Authorized";
                        swal(errorMsg);
                        return
                    }
    
                    if (error.response.status == 405){
                        const errorMsg = error.response.data.text;
                        swal(errorMsg);
                        return
                    }
    
                    if (error.response.status == 500){
                        const errorMsg = error.response.data.text;
                        swal(errorMsg);
                        return
                    }
                }else{
                    swal(error.message || "Error processing request");
                }
                
            }finally {
                this.loading = false;
            }

        },
        async addDeliveryAddress(){
            this.addresses= null
            this.currentPage = null
            this.totalData =null
            this.total_page =null

            let inputs = {
                name: this.fullname,
                phone: this.phoneno,
                lga: this.lga,
                state: this.state,
                zipcode: this.zipcode,
                addressno: this.addressno,
                address: this.address,
                country: this.country,
            }
            console.log('inputs', inputs);
            if ( !this.fullname || !this.phoneno || !this.lga || !this.state
                || !this.country || !this.address || !this.addressno || !this.zipcode ){
                this.error = "Insert all Fields";
                swal(this.error);
                return
            }
            //validate phone 

            const data = new FormData();
            data.append('name', this.fullname);
            data.append('phone', this.phoneno);
            data.append('lga', this.lga);
            data.append('state', this.state);
            data.append('country', this.country);
            data.append('address', this.address);
            data.append('addressno', this.addressno);
            data.append('zipcode', this.zipcode);

            const url = `${this.baseurl}api/deliveryAddress/addDeliveryAddress.php`;
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
                if (response.data.status) {
                    swal("Delivery address added")
                    this.getUserAddress();
                    console.log(response.data.text);
                }else{
                    swal(response.data.text)
                }
                
            } catch (error) {
                // console.log(error);
                if (error.response){
                    if (error.response.status == 400){
                        const errorMsg = error.response.data.text;
                        swal(errorMsg);
                        return
                    }

                    if (error.response.status == 401){
                        const errorMsg = "User not Authorized";
                        swal(errorMsg);
                        return
                    }

                    if (error.response.status == 405){
                        const errorMsg = error.response.data.text;
                        swal(errorMsg);
                        return
                    }

                    if (error.response.status == 500){
                        const errorMsg = error.response.data.text;
                        swal(errorMsg);
                        return
                    }
                }else{
                    swal(error.message || "Error processing request");
                } 
            }finally {
                this.loading = false;
            }

        },
        async deleteDeliveryAddress(id){
            console.log("addressid", id);
            const url = `${this.baseurl}api/deliveryAddress/deleteDeliveryAddress.php?id=${id}`;
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
                    swal("Address deleted");
                    this.getUserAddress();
                }else{
                    this.getUserAddress();
                }
            } catch (error) {
                // console.log(error);
                if (error.response){
                    if (error.response.status == 400){
                        const errorMsg = error.response.data.text;
                        swal(errorMsg);
                        return
                    }
    
                    if (error.response.status == 401){
                        const errorMsg = "User not Authorized";
                        swal(errorMsg);
                        return
                    }
    
                    if (error.response.status == 405){
                        const errorMsg = error.response.data.text;
                        swal(errorMsg);
                        return
                    }
    
                    if (error.response.status == 500){
                        const errorMsg = error.response.data.text;
                        swal(errorMsg);
                        return
                    }
                }else{
                    swal(error.message || "Error processing request");
                }
                
            }finally {
                this.loading = false;
            }
        },
        async getOrderByOrderRefno(orderRefno){
            //this.saveProduct(index);
            console.log(orderRefno);
            const url = `${this.baseurl}api/order/getOrderByOrderref.php?orderrefno=${orderRefno}`;
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
                if(response.data.status){
                    this.orders=response.data.data.orders;
                    console.log("apiOrder", response.data.data.orders);
                    localStorage.setItem("orders", JSON.stringify(response.data.data.orders));                   
                }     
            } catch (error) {
                // console.log(error);
                if (error.response){
                    if (error.response.status == 400){
                        const errorMsg = error.response.data.text;
                        swal(errorMsg);
                        return
                    }
    
                    if (error.response.status == 401){
                        const errorMsg = "User not Authorized";
                        swal(errorMsg);
                        return
                    }
    
                    if (error.response.status == 405){
                        const errorMsg = error.response.data.text;
                        swal(errorMsg);
                        return
                    }
    
                    if (error.response.status == 500){
                        const errorMsg = error.response.data.text;
                        swal(errorMsg);
                        return
                    }
                }

                swal(error.message || "Error processing request")

                
            }finally {
                this.loading = false;
            }
        },
        async updateAddress(){
            if ( !this.address_details.id || !this.address_details.fullname || !this.address_details.phoneno || !this.address_details.lga || !this.address_details.state
                || !this.address_details.country || !this.address_details.address || !this.address_details.addressno || !this.address_details.zipcode ){

                this.error = "Insert all Fields";
                swal(this.error);
                return
            }
            
            const data = new FormData();
            data.append('id', this.address_details.id);
            data.append('name', this.address_details.fullname);
            data.append('phone', this.address_details.phoneno);
            data.append('lga', this.address_details.lga);
            data.append('state', this.address_details.state);
            data.append('country', this.address_details.country);
            data.append('address', this.address_details.address);
            data.append('addressno', this.address_details.addressno);
            data.append('zipcode', this.address_details.zipcode);
            
            const url = `${this.baseurl}api/deliveryAddress/updateDeliveryAddress.php`;
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
                if (response.data.status) {
                    swal("Address updated")
                    this.getUserAddress();
                    console.log("getAddonUpdate", this.addresses);
                    console.log(response.data.text);
                }
                
            } catch (error) {
                // console.log(error);
                if (error.response){
                    if (error.response.status == 400){
                        const errorMsg = error.response.data.text;
                        swal(errorMsg);
                        return
                    }

                    if (error.response.status == 401){
                        const errorMsg = "User not Authorized";
                        swal(errorMsg);
                        return
                    }

                    if (error.response.status == 405){
                        const errorMsg = error.response.data.text;
                        swal(errorMsg);
                        return
                    }

                    if (error.response.status == 500){
                        const errorMsg = error.response.data.text;
                        swal(errorMsg);
                        return
                    }
                }else{
                    swal(error.message || "Error processing request");
                } 
            }finally {
                this.loading = false;
            }

        },
        // Lanre Methods End
        async logout() {
            try {
                this.loading = true;
                // delete token from storage
                localStorage.removeItem("token");
                window.location.href ="../login.php";
                
            } catch (error) {
                this.error = error.message || "Error processing request";
                swal(this.error);
            }finally{
                this.loading = false
            }
        },
        async fetchLocation(){
            const headers = {
                "Authorization": `Bearer ${this.authToken}`,
                "Content-type": "application/json"
            }

            try {
                this.loading = true
                const response = await axios.get(`${this.baseurl}api/logistics/getActiveLocationById.php?logistic_id=${this.selectedLogistics}`,  {headers});
                if ( response.data.status ){
                    this.locations = response.data.data.locations;
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
        async calculatePrice(load = 1) {
            const headers = {
                "Authorization": `Bearer ${this.authToken}`,
                "Content-type": "application/json"
            }

            if (this.selectedLocation && this.selectedLogistics && this.weight && this.weight > 0){
                try {
                    if (load == 1){
                        this.loading = true;
                    }
                    if (!this.weight){
                        this.error = "Kindly Enter weight Value";
                        swal(this.error);
                        return;
                    }
                    const url = `${this.baseurl}api/logistics/getShipmentPrice.php?logistic_id=${this.selectedLogistics}&loc_id=${this.selectedLocation}&weight=${this.weight}`;
                    const response = await axios.get(url,  {headers});
                    if ( response.data.status ){
                        this.price = response.data.data.price;
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
                    
                }finally{
                    this.loading = false;
                }
            }
            
        },
        async updateDetails() {
            if ( !this.user_detais.Firstname || !this.user_detais.Lastname || !this.user_detais.phone || !this.user_detais.dob
                || !this.user_detais.sex || !this.user_detais.State || !this.user_detais.Country ){

                   this.error = "Insert all Fields";
                   swal(this.error);
                   return
           }

           const data = new FormData();
           data.append('firstname', this.user_detais.Firstname);
           data.append('lastname', this.user_detais.Lastname);
           data.append('phoneno', this.user_detais.phone);
           data.append('dob', this.user_detais.dob);
           data.append('sex', this.user_detais.sex);
           data.append('state', this.user_detais.State);
           data.append('country', this.user_detais.Country);

            const headers = {
                "Authorization": `Bearer ${this.authToken}`,
                "Content-type": "application/json"
            }

           try {
               this.loading = true
               const response = await axios.post(`${this.baseurl}api/accounts/updateuserinfo.php`, data ,{headers} );
               
               // 
               if ( response.data.status ){
                   this.success = response.data.text;
                   swal(this.success);
                   window.location.reload();
               }          
           } catch (error) {
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

               this.error = error.message || "Error Processing Request"
               swal(this.error);
               
           } finally {
               this.loading = false;
           }
        },
        async changePassword(){
            if (!this.currentpassword || !this.password || !this.confirmPassword){
                swal("Kindly Insert all Fields");
                return;
            }
            if (this.password !== this.confirmPassword){
                swal("Password Does not Match");
                return
            }


            const data = new FormData();
            data.append('currentpassword', this.currentpassword);
            data.append('newpassword', this.password);

            const headers = {
                "Authorization": `Bearer ${this.authToken}`,
                "Content-type": "application/json"
            }
            
            try {
                this.loading = true
                const response = await axios.post(`${this.baseurl}api/accounts/changepass.php`, data, {headers});
                if ( response.data.status ){
                    this.success = response.data.text;
                    swal(this.success);
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
        async getAllAddress(){

            const headers = {
                "Authorization": `Bearer ${this.authToken}`,
                "Content-type": "application/json"
            }

            
            try {
                this.loading = true
                const response = await axios.get(`${this.baseurl}api/accounts/getAllUserAddress.php`, {headers} );
                if ( response.data.status ){
                    if (response.data.data.length > 0){
                        this.user_address = response.data.data;
                    }  
                }          
            } catch (error) {
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

                this.error = error.message || "Error Processing Request"
                swal(this.error);
                
            } finally {
                this.loading = false;
            }

        },
        async setDefaultAddress(id){
            const headers = {
                "Authorization": `Bearer ${this.authToken}`,
                "Content-type": "application/json"
            }

            let data = new FormData();
            data.append('id', id);
            

            try {
                this.loading = true
                const response = await axios.post(`${this.baseurl}api/deliveryAddress/setDefaultAddress.php`, data, {headers});

                if (response.data.status) {
                    this.success = response.data.text;
                    swal(this.success);
                }
            } catch (error) {
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

                this.error = error.message || "Error Processing Request"
                swal(this.error);
            } finally {
                this.loading = false
            }
        },
        async deleteAddress(id){
            const headers = {
                "Authorization": `Bearer ${this.authToken}`,
                "Content-type": "application/json"
            }

            let data = new FormData();
            data.append('id', id);
            

            try {
                this.loading = true
                const response = await axios.post(`${this.baseurl}api/accounts/deleteAddress.php`, data, {headers});

                if (response.data.status) {
                    this.success = response.data.text;
                    swal(this.success);
                }
            } catch (error) {
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

                this.error = error.message || "Error Processing Request"
                swal(this.error);
            } finally {
                this.loading = false
            }
        },
        async addWalletAddress(){

            if (!this.cointype || !this.useraddress || !this.producttrackid || !this.memo 
                || !this.systemlivewallet || !this.liveaddressid || !this.redeemscript || !this.wallettrackid) {
                    this.error = "Insert all Fields";
                    swal(this.error);
            }

            const data = FormData();
            data.append('cointype', this.cointype );
            data.append('useraddress', this.useraddress );
            data.append('producttrackid', this.producttrackid );
            data.append('memo', this.memo );
            data.append('systemlivewallet', this.systemlivewallet );
            data.append('liveaddressid', this.liveaddressid );
            data.append('redeemscript', this.redeemscript );
            data.append('wallettrackid', this.wallettrackid );

            try {
                this.loading = true
                const response = await axios.post(`${this.baseurl}api/userwalletaddress/addWallet.php`, data , {headers} );
                if ( response.data.status ){ 
                    this.success = response.data.text;
                    swal(this.success);
                }          
            } catch (error) {
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

                this.error = error.message || "Error Processing Request"
                swal(this.error);
                
            } finally {
                this.loading = false;
            }
        },
        async getAllLogistics(){
            const headers = {
                "Authorization": `Bearer ${this.authToken}`,
                "Content-type": "application/json"
            }

            try {
                this.loading = true
                const response = await axios.get(`${this.baseurl}api/logistics/getAllActiveLogistics.php`, {headers} );
                if ( response.data.status ){
                    if (response.data.data.length > 0){
                        this.logistics = response.data.data;
                        return
                    }
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
                }else{
                    this.error = error.message || "Error Processing Request"
                    swal(this.error);
                }
    
            } finally {
                this.loading = false;
            }
        },
        async getDefaultAddress(){
            const headers = {
                "Authorization": `Bearer ${this.authToken}`,
                "Content-type": "application/json"
            }

            try {
                this.loading = true
                const response = await axios.get(`${this.baseurl}api/accounts/getDefaultAddress.php`, {headers} );
                if ( response.data.status ){
                    this.defaultAddress = response.data.data;
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
                }else{
                    this.error = error.message || "Error Processing Request"
                    swal(this.error);
                }
    
            } finally {
                this.loading = false;
            }
        },
        async getUserTotalBalance(){
            const headers = {
                "Authorization": `Bearer ${this.authToken}`,
                "Content-type": "application/json"
            }
            try {
                this.loading = true
                const response = await axios.get(`${this.baseurl}api/userwalletaddress/getUserTotalWalletBalance.php`, {headers} );
                if ( response.data.status ){
                    this.total_wallet_balance = response.data.data.totalBalance;
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
                }else{
                    this.error = error.message || "Error Processing Request"
                    swal(this.error);
                }
    
            } finally {
                this.loading = false;
            }
        },
        async getUserAddress(){
            let search = (this.search)? `&search=${this.search}`: ''; 
            let page = ( this.currentPage )? this.currentPage : 1;
            let noPerPage = ( this.per_page ) ? this.per_page : 3;
            const url = `${this.baseurl}api/deliveryAddress/getUserAddress.php?noPerPage=${noPerPage}&page=${page}${search}`;
            console.log('URL', url);
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
                if(response.data.status){
                    this.addresses=response.data.data.deliveryAddress;
                    this.currentPage =response.data.data.page
                    this.totalData =response.data.data.total_data
                    this.total_page =response.data.data.totalPage                    
                }else{
                    this.addresses= null
                    this.currentPage = null
                    this.totalData =null
                    this.total_page =null;
                }     
            } catch (error) {
                // console.log(error);
                if (error.response){
                    if (error.response.status == 400){
                        const errorMsg = error.response.data.text;
                        swal(errorMsg);
                        return
                    }
    
                    if (error.response.status == 401){
                        const errorMsg = "User not Authorized";
                        swal(errorMsg);
                        return
                    }
    
                    if (error.response.status == 405){
                        const errorMsg = error.response.data.text;
                        swal(errorMsg);
                        return
                    }
    
                    if (error.response.status == 500){
                        const errorMsg = error.response.data.text;
                        swal(errorMsg);
                        return
                    }
                }

                swal(error.message || "Error processing request")
            }finally {
                this.loading = false;
            }
        },

        getToken(){
            this.loading= true
            const token = window.localStorage.getItem("token");
            this.authToken = token;
        },
        async display(id){
            this.loading = true;
            this.address_details = null;
            console.log("View Clicked");
            this.getAddressByid(id);
        },
        async saveRef(ref, cartIndex){
            this.loading = false
            localStorage.setItem("ref", ref);
            localStorage.setItem("cartIndex", cartIndex);
            window.location.href=`shipment2.php?`;
        
        },
        async redirect(){
            let carts = (localStorage.getItem("carts")) ? JSON.parse(localStorage.getItem("carts")): null;
            let order = (localStorage.getItem("ref")) ? localStorage.getItem("ref"): null;
            let cartIndex = (localStorage.getItem("cartIndex")) ? localStorage.getItem("cartIndex"): null;
            this.loading = true;
            if (order){
                this.refNo = order;
                this.cartIndex = cartIndex
                this.carts = carts
                let orderStatus = this.carts[this.cartIndex].orderStatusid
                this.order_status = orderStatus;
                this.getOrderByOrderRefno(this.refNo)
                console.log('redirectOrder', this.orders);
            }

            //get location incase refresh will not clear all item
            const path = window.location.pathname.split("/");
            const length = path.length;
            const location = path[length -1];
            //clear order and cartIndex localStorage when done
            if (order){
                if (location !== "shipment2.php"){
                    localStorage.removeItem("ref");
                    this.refNo = null;
                }
            }
            if (cartIndex){
                if (location !== "shipment2.php"){
                    localStorage.removeItem("cartIndex");
                    this.cartIndex = null;
                }
                
            }
        },
        async getUserDetails(){
            const headers = {
                "Authorization": `Bearer ${this.authToken}`,
                "Content-type": "application/json"
            }

            const path = window.location.pathname.split("/");
            const length = path.length;
            const location = path[length -1];
            
            try {
                this.loading = true
                const response = await axios.get(`${this.baseurl}api/accounts/getdetails.php`, {headers} );
                if ( response.data.status ){
                    this.user_detais = response.data.data
                    this.ref_link = `${this.baseurl}register.php?code=${this.user_detais.refcode}`;

                    if (location === "index.php"){
                        this.getUserAddress();
                        this.getUserTotalBalance();
                        this.getDefaultAddress();
                        this.getAllLogistics();
                            
                    }

                    if (location === "activities.php"){
                        this.getAllActivity();
                    }

                    if (location === "complain.php"){
                        this.getAllComplain();
                    }


                    if (location === "notifications.php"){
                        this.getAllUserNotification();
                    } 
                    
                    if (location === "wallet.php"){
                        await this.getAllTransactions();
                        await this.getAllWallets();
                    }

                    if (location === 'address.php'){
                        await this.getUserAddress();
                    }
                    
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
                        window.location.href ="../login.php";
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
                }else{
                    this.error = error.message || "Error Processing Request"
                    swal(this.error);
                }    
                
            } finally {
                this.loading = false;
            }
        },
        async getAllUserNotification(){
            const headers = {
                "Authorization": `Bearer ${this.authToken}`,
                "Content-type": "application/json"
            }

            let page = ( this.currentPage )? this.currentPage : 1;
            let per_page = ( this.per_page ) ? this.per_page : 5;

            this.total_page = null;
            
            try {
                this.loading = true
                const response = await axios.get(`${this.baseurl}api/notifications/getNotificationByUserId.php?page=${page}&per_page=${per_page}`, {headers} );
                if ( response.data.status ){
                    this.notifications = response.data.data.notification;
                    this.currentPage = response.data.data.page;
                    this.total_page = response.data.data.totalPage;
                    this.per_page = response.data.data.per_page;
                    this.totalData = response.data.data.total_data; 
                }else{
                    this.notifications = null;
                }          
            } catch (error) {
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

                this.error = error.message || "Error Processing Request"
                swal(this.error);
                
            } finally {
                this.loading = false;
            }
        },
        async addNotification(text, type, product, order,status){
            const headers = {
                "Authorization": `Bearer ${this.authToken}`,
                "Content-type": "application/json"
            }
            
            const data = new FormData();
            data.append('notificationtext', text);
            data.append('notificationtype', type);
            data.append('productid', product);
            data.append('orderrefid', order);
            data.append('notificationstatus', status);

            try {
                this.loading = true
                const response = await axios.get(`${this.baseurl}api/notifications/getNotificationByUserId.php`, {headers} );
                if ( response.data.status ){
                    return
                }
            } catch (error) {
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

                this.error = error.message || "Error Processing Request"
                swal(this.error);
            } finally {
                this.loading = false;
            }
        },
        async getAllActivity() {
            const headers = {
                "Authorization": `Bearer ${this.authToken}`,
                "Content-type": "application/json"
            }
            let page = ( this.currentPage )? this.currentPage : 1;
            let per_page = ( this.per_page ) ? this.per_page : 5;

            this.total_page = null;

            try {
                this.loading = true
                const response = await axios.get(`${this.baseurl}api/accounts/getAllUserActivities.php?per_page=${per_page}&page=${page}`, {headers} );
                if ( response.data.status ){
                    this.activities = response.data.data.totalSession; 
                    this.currentPage = response.data.data.page;
                    this.total_page = response.data.data.totalPage;
                    this.totalData = response.data.data.total_data;
                }   
                console.log(this.total_page);       
            } catch (error) {
                if (error.response){
                    if (error.response.status == 400){
                        this.error = error.response.data.text;
                        this.activities = null;
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
        async makeComplain() {
            if (!this.complain){
                this.error = "Kindly Enter a complain"
                swal(this.error);
            }

            const headers = {
                "Authorization": `Bearer ${this.authToken}`,
                "Content-type": "application/json"
            }

            const data = new FormData();
            data.append('complaint', this.complain);

            try {
                this.loading = true
                const response = await axios.post(`${this.baseurl}api/complains/addComplain.php`, data ,{headers} );
                if ( response.data.status ){ 
                    this.success = response.data.text;
                    swal(this.success);
                    this.getAllComplain();
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
        async getAllComplain() {
            let sort = (this.sort) ? `&sort=1&sortStatus=${this.sort}` : "";  
            let page = ( this.currentPage )? this.currentPage : 1;
            let per_page = ( this.per_page ) ? this.per_page : 5;
            const headers = {
                "Authorization": `Bearer ${this.authToken}`,
                "Content-type": "application/json"
            }

            let url = `${this.baseurl}api/complains/getAllUserComplain.php?page=${page}&per_page=${per_page}${sort}`

            this.total_page = null
            try {
                this.loading = true
                const response = await axios.get(url, {headers} );
                if ( response.data.status ){
                    if (response.data.data.page){
                        this.complains = response.data.data.complains;
                        this.currentPage = response.data.data.page;
                        this.total_page = response.data.data.totalPage;
                        this.per_page = response.data.data.per_page;
                        this.totalData = response.data.data.total_data;   
                    }
                }else{
                    this.complains = null
                }          
            } catch (error) {
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

                this.error = error.message || "Error Processing Request"
                swal(this.error);
                
            } finally {
                this.loading = false;
            }
        },
        async getComplain(index){
            this.each_complain = this.complains[index];
        },
        async removeSort() {
            this.sort = null;
            this.getAllComplain();
        },
        async setPending() {
            this.sort = 0;
            this.getAllComplain();
        },
        async setActive() {
            this.sort = 1;
            this.getAllComplain();
        },
        async increasePage(){
            // Get window current location
            const path = window.location.pathname.split("/");
            const length = path.length;
            const location = path[length -1];
            // 
            // Increase Current page 
            this.currentPage = parseInt(this.currentPage) + 1;
            this.total_page = null
            this.loading = true;
            this.totalData = null
            if (location === "activities.php"){
                await this.getAllActivity();
            }

            if (location === "complain.php"){
                await this.getAllComplain();
            }
        },
        async decreasePage(){
             // Get window current location
             const path = window.location.pathname.split("/");
             const length = path.length;
             const location = path[length -1];
             // Decrease Current Page
            this.currentPage = parseInt(this.currentPage) - 1;
            this.total_page = null
            this.loading = true;
            this.totalData = null
            if (location === "activities.php"){
                await this.getAllActivity();
            }

            if (location === "complain.php"){
                await this.getAllComplain();
            }
        },
        async getAllTransactions(){
            let search = (this.search) ? `&search=${this.search}` : "";  
            let page = ( this.currentPage )? this.currentPage : 1;
            let per_page = ( this.per_page ) ? this.per_page : 5;
            const headers = {
                "Authorization": `Bearer ${this.authToken}`,
                "Content-type": "application/json"
            }

            let url = `${this.baseurl}api/userwallettrans/getTransactionByUserId.php?page=${page}&per_page=${per_page}${search}`;

            this.total_page = null
            try {
                this.loading = true
                const response = await axios.get(url, {headers} );
                if ( response.data.status ){
                    if (response.data.data.page){
                        this.transactions = response.data.data.transactions;
                        this.currentPage = response.data.data.page;
                        this.total_page = response.data.data.totalPage;
                        this.per_page = response.data.data.per_page;
                        this.totalData = response.data.data.total_data;   
                    }
                }else{
                    this.transactions = null
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
        async getAllWallets(){ 
            let page = ( this.currentPage )? this.currentPage : 1;
            let per_page = ( this.per_page ) ? this.per_page : 5;
            const headers = {
                "Authorization": `Bearer ${this.authToken}`,
                "Content-type": "application/json"
            }

            let url = `${this.baseurl}api/userwalletaddress/getWalletByUserid.php?page=${page}&per_page=${per_page}`;

            this.total_page = null
            try {
                this.loading = true
                const response = await axios.get(url, {headers} );
                if ( response.data.status ){
                    if (response.data.data.page){
                        this.wallets = response.data.data.wallets;
                        this.currentPage = response.data.data.page;
                        this.total_page = response.data.data.totalPage;
                        this.per_page = response.data.data.per_page;
                        this.totalData = response.data.data.total_data;   
                    }
                }else{
                    this.wallets = null
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
        copyText(){
            this.$refs.myinput.focus();
            document.execCommand('copy');
            new Toasteur().success("Link Copied");
            
        }
    },
    async mounted(){
        this.getToken();
        this.getUserDetails();
        this.getDefaultAddress();
        
    }
});

userApp.mount("#user");


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