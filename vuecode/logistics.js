const urlPath = window.location.pathname.split("/");
const length = urlPath.length;
const webPage = urlPath[length -1];

let app = Vue.createApp({
    data() {
        return{
            logisticStatistics: null,
            recentOrders: null,
            itemDetails: null,
            logisticLocations: null,
            logisticPrices: null,
            location_details: null,
            price_details: null,
            order_details: null,
            carts: [],
            orders: null,
            refNo: null,
            trackid: null,
            track_id: null,
            order_status: null,
            currentPage: null,
            totalData: null,
            totalPage: null,
            sort: null,
            search: null,
            per_page: null,
            error: null,
            authToken: null,
            resetToken: '',
            userpubkey: '',
            baseUrl:'http://localhost/cart.ng2/',
            email: null,
            ref_link: null,
            logistics_details: null,
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
            locationid: null,
            minWeight: null,
            maxWeight: null,
            price: null,
            locationName: null,
            longitude: null,
            latitude: null,
            loading: false,
        }
    },
    async created() {
        this.getToken();
        this.logisticPrices = null;
        this.logisticLocations = null;
        this.orders = null;
        this.order_details = null;
        this.loading = true;
        if(webPage == 'prices.php' ){
            await this.getLogisticPrices();
            await this.getLogisticLocations();
        }
        if (webPage == 'location.php'){
            await this.getLogisticLocations();
            
        }
        if(webPage == 'orders.php'){
            await this.getCartByLogisticid()
        }

        if(webPage == 'invoice-details.php'){
            //get cartid localStorage
            let orderRefno = (localStorage.getItem("orderRefno")) ? localStorage.getItem("orderRefno"): null;
            //let cartIndex = (localStorage.getItem("cartIndex")) ? localStorage.getItem("cartIndex"): null;
            if(orderRefno){
                console.log('orderRefno ', orderRefno);
                this.loading = true;
                await this.getCartByOrderRefno(orderRefno);
                await this.getOrderByOrderRefno(orderRefno);
            }else{
                window.location.href = 'orders.php';
            }
        }
        if(webPage == 'index.php'){
            await this.getRecentOrder();
            await this.getlogisticStatistics();
        }
    },
    methods: {
        async login(){
            let input = {
                email: this.email,
                password: this.password
            }
            const url = `${baseUrl}api/logistics/login.php`;
            const options = {
                method: "POST",
                data: input,
                url
            }
            try {
                this.loading = true
                const response = await axios(options);
                Swal.fire(response.data.message);
                if (response.data.status) {
                    this.authToken = response.data.authtoken;
                    window.localStorage.setItem("authToken", response.data.authtoken);
                    //small delay to show message
                    window.location.href = "../index.html"
                }
                console.log(response.data);
            } catch (error) {
                //console.log(error);
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
            }finally {
                this.loading = false;
            }
        },
        async resetPassword(){},
        async updateDetails(){},

        async getLogisticDetails(){
            const userpubkey = this.userpubkey;
            const url = `http://localhost/cartynew/api/logistics/getLogisticDetails.php?`;
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
                    console.log('logisticDetails', response.data.data);
                    this.logistics_details = response.data.data;
                    const strings = this.logistics_details.name.split(" ");
                    const initials = `${strings[0].charAt(0)} ${strings[1].charAt(0)}`;
                    this.logistics_initials = initials.toUpperCase();
                }
                
            } catch (error) {
                if (error.response){
                    if (error.response.status === 400){
                        this.error = error.response.data.error.text
                        Swal.fire(this.error);
                    }
                    if (error.response.status === 405){
                        this.error = error.response.data.error.text
                        Swal.fire(this.error);
                    }
                    if (error.response.status === 500){
                        this.error = error.response.data.error.text
                        Swal.fire(this.error);
                    }
                }else{
                    this.error = error.message || "Error processing request"
                    Swal.fire(this.error);
                }
            }finally {
                this.loading = false;
            }
        },
        async getlogisticStatistics(){
            const url = `${this.baseUrl}api/logistics/logisticStatistics.php`;
            console.log("storestatUrl", url);
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
                    this.logisticStatistics = response.data.data.logisticStatistics;
                    console.log('logisticStatistics', response.data.data.logisticStatistics);
                    

                }
                
            } catch (error) {
                if (error.response){
                    if (error.response.status === 400){
                        this.error = error.response.data.error.text
                        new Toasteur().error(this.error);;
                        console.log("error", this.error);
                    }
                    if (error.response.status === 405){
                        this.error = error.response.data.error.text
                        new Toasteur().error(this.error);;
                        console.log("error", this.error);
                    }
                    if (error.response.status === 500){
                        this.error = error.response.data.error.text
                        new Toasteur().error(this.error);;
                        console.log("error", this.error);
                    }
                }else{
                    this.error = error.message || "Error processing request"
                    new Toasteur().error(this.error);;
                    console.log("error", this.error);
                }
            }finally {
                this.loading = false;
            }
        },

        //..logistic
        async updateLogistic(){},
        async getLogisticByid(){},
        async changeLogisticPassword(){

            if(!this.newPassword || !this.newPassword1 || !this.currentPassword){
                Swal.fire("Input all fields")
            }

            if(this.newPassword !== this.newPassword1){
                Swal.fire("Password not the same")
            }else{
                const data = new FormData();
                data.append('currentPassword', this.currentPassword);
                data.append('newPassword', this.newPassword);

                const url = `${this.baseUrl}api/logistics/changePassword.php`;
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
                        Swal.fire('Password Changed');
                    }
                    
                } catch (error) {
                    if (error.response){
                        if (error.response.status === 400){
                            this.error = error.response.data.error.text
                            Swal.fire(this.error);
                        }
                        if (error.response.status === 405){
                            this.error = error.response.data.error.text
                            Swal.fire(this.error);
                        }
                        if (error.response.status === 500){
                            this.error = error.response.data.error.text
                            Swal.fire(this.error);
                        }
                    }else{
                        this.error = error.message || "Error processing request"
                        Swal.fire(this.error);
                    }
                }finally {
                    this.loading = false;
                }
            }

            
        },

        //....logistic location
        async addLocation(){
            let input ={
                locationname: this.locationName,
                longitude: this.longitude, 
                latitude: this.latitude
            }
            console.log('input', input);
            if(!this.locationName || !this.longitude || !this.latitude){
                new Toasteur().error("Input all fields")
            }

            const data = new FormData();
            data.append('locationName', this.locationName);
            data.append('longitude', this.longitude);
            data.append('latitude', this.latitude);
            const url = `${this.baseUrl}api/logistics/location/addLocation.php`;
            console.log('URL', url);
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
                    new Toasteur().success("Location Added")
                    this.getLogisticLocations();
                    console.log(response.data.text);
                }else{
                    new Toasteur().error(response.data.text)
                }
                
            } catch (error) {
                // console.log(error);
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
                    Swal.fire(error.message || "Error processing request");
                } 
            }finally {
                this.loading = false;
            }
            
        },
        async deleteLocation(id){
            console.log("deleteByid", id);
            const url = `${this.baseUrl}api/logistics/location/deleteLocation.php?id=${id}`;
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
                    this.getLogisticLocations();
                }
            } catch (error) {
                // console.log(error);
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
                    Swal.fire(error.message || "Error processing request");
                }
                
            }finally {
                this.loading = false;
            }
        },
        async updateLocation(){
            let input ={
                locationname: this.itemDetails.locationName,
                longitude: this.itemDetails.longitude, 
                latitude: this.itemDetails.latitude
            }
            console.log('input', input);
            if(!this.itemDetails.id || !this.itemDetails.locationName || !this.itemDetails.longitude || !this.itemDetails.latitude){
                new Toasteur().error("Input all fields")
            }

            const data = new FormData();
            data.append('id', this.itemDetails.id);
            data.append('locationName', this.itemDetails.locationName);
            data.append('longitude', this.itemDetails.longitude);
            data.append('latitude', this.itemDetails.latitude); 

            console.log("id", this.itemDetails.id);
            console.log("locationName", this.itemDetails.locationName);
            console.log("longitude", this.itemDetails.longitude);
            console.log("latitude", this.itemDetails.latitude)

            const url = `${this.baseUrl}api/logistics/location/updateLocation.php`;
            console.log('URL', url);
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
                    Swal.fire("Location Updated")
                    this.getLogisticLocations();
                    console.log(response.data.text);
                }else{
                    this.getLogisticLocations();
                    Swal.fire(response.data.text)

                }
                
            } catch (error) {
                // console.log(error);
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
                    Swal.fire(error.message || "Error processing request");
                } 
            }finally {
                this.loading = false;
            }
        },
        async getLogisticLocations(load = 1){
            let search = (this.search)? `&search=${this.search}`: '';
            let sort = (this.sort != null) ? `&sort=1&sortStatus=${this.sort}` : "";  
            let page = ( this.currentPage )? this.currentPage : 1;
            let noPerPage = ( this.per_page ) ? this.per_page : 4;
            const url = `${this.baseUrl}api/logistics/location/getLocationByLogisticid.php?noPerPage=${noPerPage}&page=${page}${search}${sort}`;
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
                if(load ==1 ){
                    this.loading = true
                }
                const response = await axios(options);
                if(response.data.status){
                    this.logisticLocations=response.data.data.locations;
                    console.log('ApiLocation', response.data.data.locations); 
                    if(webPage == 'location.php'){
                        this.currentPage =response.data.data.page;
                        this.totalData =response.data.data.total_data;
                        this.totalPage =response.data.data.totalPage;    
                        console.log('APITotalPage', response.data.data.totalPage);
                        console.log('APICurrentPage', response.data.data.page);
                    }            
                }else{
                    this.logisticLocations= null;
                    if(webPage == 'location.php'){
                        this.logisticLocations= null
                        this.currentPage = 0
                        this.totalData =0
                        this.totalPage =0;
                    }                    
                }     
            } catch (error) {
                // console.log(error);
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

                Swal.fire(error.message || "Error processing request")

                
            }finally {
                this.loading = false;
            }
        },
        async getLocationByid(id){
            console.log("getByid", id);
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
                    this.location_details= response.data.data;
                    console.log(response.data.data);
                }
            } catch (error) {
                // console.log(error);
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
                    Swal.fire(error.message || "Error processing request");
                }
                
            }finally {
                this.loading = false;
            }
        },
        async changeLogisticLocationStatus(id, status){
            const url = `${this.baseUrl}api/logistics/location/changeLocationStatus.php?`;
            console.log('URL', url);
            console.log('id & status', id, status);
            if(!id && !status){
                new Toasteur().error("Undefined")
            }else{
                //pass your data to api  your data
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
                        Swal.fire("Status Changed")
                        this.getLogisticLocations();      
                    }else{
                        this.getLogisticLocations();
                    }     
                } catch (error) {
                    // console.log(error);
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

                    Swal.fire(error.message || "Error processing request")

                    
                }finally {
                    this.loading = false;
                }

            }
            
        },

        //.....logistic price...
        async addLogisticPrice(){
            let input ={
                locationid: this.locationid,
                minweight: this.minweight, 
                maxWeight: this.maxWeight,
                price: this.price,
            }
            console.log('input', input);

            if(isNaN(this.minWeight) || isNaN(this.maxWeight)){
                new Toasteur().error('Invalid weight ')
            }
            if(this.minWeight < this.maxWeight){
                new Toasteur().error('Minimum weight cannot be grater than maximum weight')
            }

            if(!this.locationid || !this.minWeight || !this.maxWeight || !this.price){
                new Toasteur().error("Input all fields")
            }else{
            const data = new FormData();
            data.append('locationid', this.locationid);
            data.append('minWeight', this.minWeight);
            data.append('maxWeight', this.maxWeight);
            data.append('price', this.price);

            const url = `${this.baseUrl}api/logistics/location/addLogisticPrice.php`;
            console.log('URL', url);
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
                    Swal.fire("Location Price Added")
                    this.getLogisticPrices();
                    console.log(response.data.text);
                }else{
                    Swal.fire(response.data.text)
                }
                
            } catch (error) {
                // console.log(error);
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
                    Swal.fire(error.message || "Error processing request");
                } 
            }finally {
                this.loading = false;
            }
            }

            
        },
        async deleteLogisticPrice(id){
            console.log("price", id);
            const url = `${this.baseUrl}api/logistics/price/deleteLogisticPrice.php?id=${id}`;
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
                    this.getLogisticPrices();
                }
            } catch (error) {
                // console.log(error);
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
                    Swal.fire(error.message || "Error processing request");
                }
                
            }finally {
                this.loading = false;
            }
        },
        async getLogisticPrices(load = 1){
            let search = (this.search)? `&search=${this.search}`: '';
            let sort = (this.sort != null) ? `&sort=1&sortStatus=${this.sort}` : "";  
            let page = ( this.currentPage )? this.currentPage : 1;
            let noPerPage = ( this.per_page ) ? this.per_page : 4;
            const url = `${this.baseUrl}api/logistics/price/getPriceByLogisticid.php?noPerPage=${noPerPage}&page=${page}${search}${sort}`;
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
                if(load ==1 ){
                    this.loading = true
                }
                const response = await axios(options);
                if(response.data.status){
                    this.logisticPrices=response.data.data.logisticPrices;
                    this.currentPage =response.data.data.page;
                    this.totalData =response.data.data.total_data;
                    this.totalPage =response.data.data.totalPage;      
                    console.log('ApiPrices', response.data.data.logisticPrices);
                    console.log('APITotalPage', response.data.data.totalPage);
                    console.log('APICurrentPage', response.data.data.page);

                }else{
                    this.logisticPrices= null
                    this.currentPage = 0
                    this.totalData =0
                    this.totalPage =0;
                }     
            } catch (error) {
                // console.log(error);
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

                Swal.fire(error.message || "Error processing request")

                
            }finally {
                this.loading = false;
            }
        },
        async getLogisticPriceByid(id){
            console.log("addressid", id);
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
                    this.price_details= response.data.data;
                    console.log(response.data.data);
                }
            } catch (error) {
                // console.log(error);
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
                    Swal.fire(error.message || "Error processing request");
                }
                
            }finally {
                this.loading = false;
            }
        },
        async updateLogisticPrice(){

            if(isNaN(this.minWeight) || isNaN(this.maxWeight)){
                new Toasteur().error('Invalid weight ')
            }
            if(this.minWeight < this.maxWeight){
                new Toasteur().error('Minimum weight cannot be grater than maximum weight')
            }

            if(this.price_details.id || this.price_details.minWeight || this.price_details.maxWeight || !this.price_details.price){
                new Toasteur().error("Input all fields")
            }else{
                const data = new FormData();
                data.append('id', this.price_details.id);
                data.append('minWeight', this.price_details.minWeight);
                data.append('maxWeight', this.price_details.maxWeight);
                data.append('price', this.price_details.price);

                const url = `${this.baseUrl}api/logistics/location/addLogisticPrice.php`;
                console.log('URL', url);
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
                        Swal.fire("Location Updated")
                        await this.getLogisticPrices();
                        console.log(response.data.text);
                    }else{
                        await this.getLogisticPrices();
                        Swal.fire(response.data.text)
    
                    }
                    
                } catch (error) {
                    // console.log(error);
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
                        Swal.fire(error.message || "Error processing request");
                    } 
                }finally {
                    this.loading = false;
                }
            }
        },
        async changeLogisticPriceStatus(id, status){
            const url = `${this.baseUrl}api/logistics/price/changePriceStatus.php??`;
            console.log('URL', url);
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
                        Swal.fire("Status Changed")
                        this.getLogisticPrices();      
                    }else{
                        this.getLogisticPrices();
                    }     
                } catch (error) {
                    // console.log(error);
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

                    Swal.fire(error.message || "Error processing request")

                    
                }finally {
                    this.loading = false;
                }

            }
            
        },

        //cart
        async getCartByLogisticid(load =1){
            let search = (this.search)? `&search=${this.search}`: '';
            let sort = (this.sort != null) ? `&sort=1&sortStatus=${this.sort}` : "";  
            let page = ( this.currentPage )? this.currentPage : 1;
            let noPerPage = ( this.per_page ) ? this.per_page : 4;
            const url = `${this.baseUrl}api/cart/getCartByLogisticid.php?noPerPage=${noPerPage}&page=${page}${search}${sort}`;
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
                if(load ==1 ){
                    this.loading = true
                }
                const response = await axios(options);
                if(response.data.status){
                    this.orders=response.data.data.productCarts;
                    this.currentPage =response.data.data.page;
                    this.totalData =response.data.data.total_data;
                    this.totalPage =response.data.data.totalPage;      
                    console.log('ApiPrices', response.data.data.productCarts);
                    console.log('APITotalPage', response.data.data.totalPage);
                    console.log('APICurrentPage', response.data.data.page);

                }else{
                    this.orders= null
                    this.currentPage = 0;
                    this.totalData =0;
                    this.totalPage =0;
                }     
            } catch (error) {
                // console.log(error);
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
        async getRecentOrder(){
            const url = `${this.baseUrl}api/cart/getCartByLogisticid.php?noPerPage=5`;
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
                    this.recentOrders=response.data.data.productCarts;
                    console.log('APIrecentOrders', response.data.data.page);

                }else{
                    this.recentOrders= null
                }     
            } catch (error) {
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
        async getCartByOrderRefno(orderRefno){
            console.log("orderRefno", orderRefno);
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
                    console.log(response.data.data);
                }
            } catch (error) {
                // console.log(error);
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
                    Swal.fire(error.message || "Error processing request");
                }
                
            }finally {
                this.loading = false;
            }
        },
        async getUserCartByOrderStatus(status){
            console.log("status is ", status);
            const url = `${this.baseUrl}api/cart/getUserCartByOrderStatus.php?status=${status}`;
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
                    this.orders=response.data.data.productCarts;
                    //console.log("carts", response.data.data.productCarts);
                    
                    
                }
                console.log(response);     
            } catch (error) {
                //console.log(error);
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

                Swal.fire(error.message || "Error processing request")

                
            }finally {
                this.loading = false;
            }
        },

        //order
        async getOrderByOrderRefno(orderRefno){
            console.log('refnoMethod',orderRefno);
            const url = `${this.baseUrl}api/order/getOrderByOrderref.php?orderrefno=${orderRefno}`;
            console.log("orderRefURL", url);
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
                    console.log(response.data.data.orders);
                }else{
                    this.orders = null;
                }    
            } catch (error) {
                // console.log(error);
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

                Swal.fire(error.message || "Error processing request")

                
            }finally {
                this.loading = false;
            }
        },

        //.....utilities..............
        getToken(){
            this.loading= true
            const token = window.localStorage.getItem("authToken");
            this.authToken = token;
        },
        async nextPage(){
            this.currentPage = parseInt(this.currentPage) + 1;
            this.totalData =null;
            this.totalPage =null;
            if(webPage == 'orders.php'){
                this.getCartByLogisticid();
            }
            if(webPage == 'prices.php'){
                this.getLogisticPrices();
            }
            if(webPage == 'location.php'){
                this.getLogisticLocations();
            }
        },
        async previousPage(){
            this.currentPage = parseInt(this.currentPage) - 1;
            this.totalData =null;
            this.totalPage =null;
            if(webPage == 'orders.php'){
                this.getCartByLogisticid();                
            }
            if(webPage == 'prices.php'){
                this.getLogisticPrices()
            }
            if(webPage == 'location.php'){
                this.getLogisticLocations()
            }
        },
        async noSort(){
            this.sort = null;
            this.currentPage =null;
            this.totalData =null;
            this.totalPage =null;
            if(webPage == 'prices.php'){
               await this.getLogisticPrices()
            }
            if(webPage == 'location.php'){
                this.getLogisticLocations();
            }
            if(webPage == "orders.php"){
                await this.getCartByLogisticid();
            }
        }, 
        async sortByStatus(status){
            this.sort = status;
            this.currentPage =null;
            this.totalData =null;
            this.totalPage =null;
            console.log('SortStatus', status);
            if(webPage == 'prices.php'){
               await this.getLogisticPrices()
            }
            if(webPage == 'location.php'){
                this.getLogisticLocations();
            }
            if(webPage == "orders.php"){
                await this.getCartByLogisticid();
            }
            
        },
        async sortByOrderStatus(sortStatus){
            this.sort = sortStatus;
            this.currentPage =null;
            this.totalData =null;
            this.totalPage =null;
            console.log('SortStatus', sortStatus);
            if(webPage == "orders.php"){
                await this.getCartByLogisticid();
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
            if(webPage == 'prices.php'){
                await this.changeLogisticPriceStatus(id, status)
            }
            if(webPage == 'location.php'){
                this.changeLogisticLocationStatus(id, status);
            }
        },

        async saveRefno(orderRefno){
            this.loading = false
            localStorage.setItem("orderRefno", orderRefno);
            //localStorage.setItem("cartIndex", cartIndex);
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
                    console.log('location id', id);
                    this.deleteLocation(id);
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
        async changeCartStatus(id, status){
            const url = `${this.baseUrl}api/cart/changeCartStatus.php??`;
            console.log('URL', url);
            console.log('id', id);
            console.log('status', status);
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
                        this.getCartByLogisticid();      
                    }else{
                        this.getCartByLogisticid();
                    }     
                } catch (error) {
                    // console.log(error);
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
        async getIndex(index){
            console.log("arrayIndex", index);    
            if(webPage == 'location.php'){
                this.itemDetails = this.logisticLocations[index];
            }
        },


        log(){
            this.loading = false;
            let input ={
                locationid: this.locationid,
                minweight: this.minWeight, 
                maxWeight: this.maxWeight,
                price: this.price,
            }
            console.log('input', input);
        },
        async logout(){
            window.localStorage.removeItem("authToken");
            window.location.href="./login.php"
        }
        
        
    },
    mounted() {
        //this.getToken()
        this.getLogisticDetails()
        //this.log()
    },
})

app.mount("#logistics")