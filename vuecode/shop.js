let shopApp = Vue.createApp({
    data(){
        return {
            totalOrder: null,
            shopStatistics: null,
            recentOrders: null,
            // Shop Parameters
            shop_initials: null,
            shop_details: null,
            baseurl: "http://localhost/cart.ng2/",  
            // Product Parameters
            products: null,
            product: null,
            product_image: null,
            product_index: null,
            image_files: [],
            files_url: [],
            categories: null,
            selectedCategory: "",
            sub_cat: null,
            selectedSub: "",
            // Brand Parameters
            brands: null,
            brand: null,
            brandSelected: "",
            selectedType: "",
            brand_name: null,
            // Location Parameters
            locations: null,
            location: null,
            location_name: null,
            location_latitude: "",
            location_longitude: "",
            // Product Parameters
            product_name: null,
            cost_price: null,
            sell_price: null,
            qty: null,
            weight: null,
            made_in: null,
            special_price: "",
            discount_qty: "",
            discount_price: "",
            description: null,
            // Search and pagination parameters
            search: null,
            sort: null,
            sorttype: null,
            page: null,
            total_page: null,
            totalData: null,
            currentPage: 1,
            per_page: 5,
            // Auth Parameters
            currentPass: null,
            password: null,
            confirmPass: null,
            // State Management Parameters
            loading: null,
            error: "",
            success: "",
            accessToken: "",
        }
    },
    async created() {
        if(webPage == 'index.php'){
            await this.getRecentOrder();
            await this.getTopProductOrdered();
            await this.getShopStatistics();
        }
    },
    methods: {
        //lareWAju's methods
        async getRecentOrder(){
            const url = `${this.baseUrl}api/order/getShopOrder.php?noPerPage=5`;
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
                    this.recentOrders=response.data.data.shopOrders;
                    this.totalOrder = response.data.data.total_data;
                    console.log('APIrecentOrders', response.data.data.shopOrders);

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
        async getShopStatistics(){
            const url = `${this.baseUrl}api/admin/storeStatistics.php`;
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
                    this.storeStatistics = response.data.data.storeStatistics;
                    console.log('storeStatistics', response.data.data.storeStatistics);
                    

                }else {
                    this.storeStatistics=null;
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
        //end of lanre's method
        async getShopDetails(load = 1){
            const headers = {
                "Authorization": `Bearer ${this.accessToken}`,
                "Content-type": "application/json"
            }

            const path = window.location.pathname.split("/");
            const length = path.length;
            const location = path[length -1];

            try {
                if (load == 1){
                    this.loading = true;
                }
                const response = await axios.get(`${this.baseurl}api/shops/getShopById.php`, {headers} );

                if ( response.data.status ){
                    this.shop_details = response.data.data.shop;
                    const strings = this.shop_details.name.split(" ");
                    const initials = `${strings[0].charAt(0)} ${strings[1].charAt(0)}`;
                    this.shop_initials = initials;

                    if (location === "location.php"){
                        console.log(location);
                        await this.getAllLocations();
                    }

                    if (location === "products.php"){
                        console.log(location);
                        await this.getAllProducts();
                        await this.getAllCategories();
                        await this.getAllBrands();

                    }

                    if (location === "brands.php"){
                        console.log(location);
                        await this.getAllShopBrands();
                    }

                    if (location === "category.php"){
                        console.log(location);
                    } 
                    
                    if (location === "sub_categories.php"){
                        console.log(location);
                    }
                    
                    
                }else{
                    this.products = null;
                }
                
            } catch (error) {
                if (error.response){
                    if (error.response.status == 400){
                        this.error = error.response.data.text;
                        Swal.fire(this.error);
                        return
                    }
    
                    if (error.response.status == 401){
                        this.error = "User not Authorized";
                        Swal.fire(this.error);
                        // window.location.href ="../login.php";
                        return
                    }
    
                    if (error.response.status == 405){
                        this.error = error.response.data.text;
                        Swal.fire(this.error);
                        return
                    }
    
                    if (error.response.status == 500){
                        this.error = error.response.data.text;
                        Swal.fire(this.error);
                        return
                    }
                }else{
                    this.error = error.message || "Error Processing Request"
                    Swal.fire(this.error);
                }
            }finally{
                this.loading = false
            }
        },
        async changePass(){
            const headers = {
                "Authorization": `Bearer ${this.accessToken}`,
                "Content-type": "application/json"
            }
            
            if (!this.currentPass || !this.password || !this.confirmPass){
                Swal.fire("Insert All Fields");
                return;
            }

            if (this.password !== this.confirmPass){
                Swal.fire("Password Does not match");
                return;
            }

            const data = new FormData();
            data.append('currentpassword', this.currentPass);
            data.append('newpassword', this.password);

            try {
                this.loading = true;
                const response = await axios.post(`${this.baseurl}api/shops/changeShopPass.php`, data ,{headers} );

                if ( response.data.status ){
                    this.success = response.data.text;
                    console.log(this.success);
                    Swal.fire(`${this.success}`);
                }
                
            } catch (error) {
                if (error.response){
                    if (error.response.status == 400){
                        this.error = error.response.data.text;
                        Swal.fire(this.error);
                        return
                    }
    
                    if (error.response.status == 401){
                        this.error = "User not Authorized";
                        Swal.fire(this.error);
                        window.location.href ="../login.php";
                        return
                    }
    
                    if (error.response.status == 405){
                        this.error = error.response.data.text;
                        Swal.fire(this.error);
                        return
                    }
    
                    if (error.response.status == 500){
                        this.error = error.response.data.text;
                        Swal.fire(this.error);
                        return
                    }
                }
                
                this.error = error.message || "Error Processing Request"
                Swal.fire(this.error);
                
            }finally{
                this.loading = false
            }
        },
        async EditDetails(){
            if (!this.shop_details.country || !this.shop_details.city || !this.shop_details.office_phone || !this.shop_details.office_whatapp 
                || !this.shop_details.type_code || !this.shop_details.address || !this.shop_details.mincost || !this.shop_details.open_time 
                || !this.shop_details.close_time || !this.shop_details.description || !this.shop_details.username){

                  new Toasteur().error("Insert All fields");
                  return;
          }

          if (!validatePhoneNumber(this.shop_details.office_phone)){
            new Toasteur().error("Office Phone Number is Invalid");
            return;
          }

          if (!validatePhoneNumber(this.shop_details.office_whatapp)){
            new Toasteur().error("Office WhatsApp Number is Invalid");
            return;
          }

          const headers = {
              "Authorization": `Bearer ${this.accessToken}`,
              "Content-type": "application/json"
          }

          const data = new FormData();
          data.append("shop_country", this.shop_details.country);
          data.append("shop_city", this.shop_details.city);
          data.append("shop_phone", this.shop_details.office_phone);
          data.append("shop_whatsapp", this.shop_details.office_whatapp);
          data.append("shop_type", this.shop_details.type_code);
          data.append("shop_address", this.shop_details.address);
          data.append("min_cost", this.shop_details.mincost);
          data.append("open_time", this.shop_details.open_time);
          data.append("close_time", this.shop_details.close_time);
          data.append("shop_username", this.shop_details.username);
          data.append("description", this.shop_details.description);

          

          try {
              this.loading = true;
              const response = await axios.post(`${this.baseurl}api/shops/updateShop.php`, data ,{headers} );

              if ( response.data.status ){
                  this.success = response.data.text;
                  new Toasteur().success(this.success);
                  this.getShopDetails(2)
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
                      window.location.href ="../login.php";
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
          }finally{
              this.loading = false;
          }
        },
        async getAllProducts(load= 1){
            let type;
            let search = (this.search) ? `&search=${this.search}` : ""; 
            let sort = (this.sort !== null) ? `&sort=1&sortstatus=${this.sort}` : "";
            let page = ( this.currentPage )? this.currentPage : 1;
            let per_page = ( this.per_page ) ? this.per_page : 5;

            if (this.sorttype && this.sort){
                 type = `&sorttype=${this.sorttype}`;
            } 
            if ( this.sorttype && !this.sor ){
                type = `&sort=1&sorttype=${this.sorttype}`;
            }
            if (!this.sorttype){
                type = "";
            }
            
            const headers = {
                "Authorization": `Bearer ${this.accessToken}`,
                "Content-type": "application/json"
            }

            let url = `${this.baseurl}api/product/getAllShopProducts.php?page=${page}&per_page=${per_page}${search}${sort}${type}`;

            this.total_page = null
            try {
                if(load == 1){
                    this.loading = true;
                }
                const response = await axios.get(url, {headers} );
                if ( response.data.status ){
                    if (response.data.data.page){
                        this.products = response.data.data.products;
                        this.currentPage = response.data.data.page;
                        this.total_page = response.data.data.totalPage;
                        this.per_page = response.data.data.per_page;
                        this.totalData = response.data.data.total_data;   
                    }
                }else{
                    this.products = null
                }          
            } catch (error) {
                if (error.response){
                    if (error.response.status == 400){
                        this.error = error.response.data.text;
                        Swal.fire(this.error);
                        return
                    }
    
                    if (error.response.status == 401){
                        this.error = "User not Authorized";
                        Swal.fire(this.error);
                        return
                    }
    
                    if (error.response.status == 405){
                        this.error = error.response.data.text;
                        Swal.fire(this.error);
                        return
                    }
    
                    if (error.response.status == 500){
                        this.error = error.response.data.text;
                        Swal.fire(this.error);
                        return
                    }
                }

                this.error = error.message || "Error Processing Request"
                Swal.fire(this.error);
                
            } finally {
                this.loading = false;
            }
        },
        async getAllLocations(load= 1){
            let search = (this.search) ? `&search=${this.search}` : ""; 
            let sort = (this.sort !== null) ? `&sort=1&sortstatus=${this.sort}` : "";
            let page = ( this.currentPage )? this.currentPage : 1;
            let per_page = ( this.per_page ) ? this.per_page : 5;

            
            const headers = {
                "Authorization": `Bearer ${this.accessToken}`,
                "Content-type": "application/json"
            }

            let url = `${this.baseurl}api/shops/getAllShopLocation.php?page=${page}&per_page=${per_page}${search}${sort}`;

            this.total_page = null
            try {
                if(load == 1){
                    this.loading = true;
                }
                const response = await axios.get(url, {headers} );
                if ( response.data.status ){
                    if (response.data.data.page){
                        this.locations = response.data.data.Location;
                        this.currentPage = response.data.data.page;
                        this.total_page = response.data.data.totalPage;
                        this.per_page = response.data.data.per_page;
                        this.totalData = response.data.data.total_data;   
                    }
                }else{
                    this.locations = null
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
        },
        async getAllCategories(){
            const headers = {
                "Authorization": `Bearer ${this.accessToken}`,
                "Content-type": "application/json"
            }

            try {
                this.loading = true;
                const response = await axios.get(`${this.baseurl}api/product/getProductCategory.php`, {headers} );

                if ( response.data.status ){
                    this.categories = response.data.data.productCategories;
                }else{
                    this.categories = null
                }
            }catch(error){
                if (error.response){
                    if (error.response.status == 400){
                        this.error = error.response.data.text;
                        Swal.fire(this.error);
                        return
                    }
    
                    if (error.response.status == 401){
                        this.error = "User not Authorized";
                        Swal.fire(this.error);
                        window.location.href ="../login.php";
                        return
                    }
    
                    if (error.response.status == 405){
                        this.error = error.response.data.text;
                        Swal.fire(this.error);
                        return
                    }
    
                    if (error.response.status == 500){
                        this.error = error.response.data.text;
                        Swal.fire(this.error);
                        return
                    }
                }else{
                    this.error = error.message || "Error Processing Request"
                    Swal.fire(this.error);
                }
            }finally{
                this.loading = false;
            }

        },
        async getAllBrands(){
            const headers = {
                "Authorization": `Bearer ${this.accessToken}`,
                "Content-type": "application/json"
            }
            try {
                this.loading = true;
                const response = await axios.get(`${this.baseurl}api/product/getProductBrandByShopid.php`, {headers} );

                if ( response.data.status ){
                    this.brands = response.data.data.productBrand;
                }else{
                    this.brands = null;
                }
            }catch(error){
                if (error.response){
                    if (error.response.status == 400){
                        this.error = error.response.data.text;
                        Swal.fire(this.error);
                        return
                    }
    
                    if (error.response.status == 401){
                        this.error = "User not Authorized";
                        Swal.fire(this.error);
                        window.location.href ="../login.php";
                        return
                    }
    
                    if (error.response.status == 405){
                        this.error = error.response.data.text;
                        Swal.fire(this.error);
                        return
                    }
    
                    if (error.response.status == 500){
                        this.error = error.response.data.text;
                        Swal.fire(this.error);
                        return
                    }
                }else{
                    this.error = error.message || "Error Processing Request"
                    Swal.fire(this.error);
                }
            }finally{
                this.loading = false;
            }

        },
        async getAllShopBrands(load= 1){
            const headers = {
                "Authorization": `Bearer ${this.accessToken}`,
                "Content-type": "application/json"
            }
            let search = (this.search) ? `&search=${this.search}` : ""; 
            let sort = (this.sort !== null) ? `&sort=1&sortstatus=${this.sort}` : "";
            let page = ( this.currentPage )? this.currentPage : 1;
            let per_page = ( this.per_page ) ? this.per_page : 5;

            try {
                if(load == 1){
                    this.loading = true;
                }
                const response = await axios.get(`${this.baseurl}api/product/getProductBrandByShopid.php?page=${page}&noPerPage=${per_page}${search}`, {headers} );

                if ( response.data.status ){
                    this.brands = response.data.data.productBrand;
                    this.currentPage = response.data.data.page;
                    this.total_page = response.data.data.totalPage;
                    this.per_page = response.data.data.per_page;
                    this.totalData = response.data.data.total_data;
                }else{
                    this.brands = null;
                }
            }catch(error){
                if (error.response){
                    if (error.response.status == 400){
                        this.error = error.response.data.text;
                        Swal.fire(this.error);
                        return
                    }
    
                    if (error.response.status == 401){
                        this.error = "User not Authorized";
                        Swal.fire(this.error);
                        window.location.href ="../login.php";
                        return
                    }
    
                    if (error.response.status == 405){
                        this.error = error.response.data.text;
                        Swal.fire(this.error);
                        return
                    }
    
                    if (error.response.status == 500){
                        this.error = error.response.data.text;
                        Swal.fire(this.error);
                        return
                    }
                }else{
                    this.error = error.message || "Error Processing Request"
                    Swal.fire(this.error);
                }
            }finally{
                this.loading = false;
            }
        },
        async getProduct(index){
            const path = window.location.pathname.split("/");
            const length = path.length;
            const location = path[length -1];

            if (location === "products.php"){
                this.product = this.products[index];
                this.product_index = index;
                this.fetchSubCat(this.product.cat_code);
            }

            if (location === "brands.php"){
                this.brand = this.brands[index];
                console.log(this.brand);
            }

            if (location === "location.php"){
                this.location = this.locations[index];
                console.log(this.location);
            }
            
        },
        async fetchSubCat(category){
            
            const headers = {
                "Authorization": `Bearer ${this.accessToken}`,
                "Content-type": "application/json"
            }

            try {
                this.loading = true;
                const response = await axios.get(`${this.baseurl}api/product/getCategorySubCategory.php?cat_id=${category}`, {headers} );

                if ( response.data.status ){
                    this.sub_cat = response.data.data.sub_cat;
                }else{
                    this.sub_cat = null
                }
            }catch(error){
                if (error.response){
                    if (error.response.status == 400){
                        this.error = error.response.data.text;
                        Swal.fire(this.error);
                        return
                    }
    
                    if (error.response.status == 401){
                        this.error = "User not Authorized";
                        Swal.fire(this.error);
                        window.location.href ="../login.php";
                        return
                    }
    
                    if (error.response.status == 405){
                        this.error = error.response.data.text;
                        Swal.fire(this.error);
                        return
                    }
    
                    if (error.response.status == 500){
                        this.error = error.response.data.text;
                        Swal.fire(this.error);
                        return
                    }
                }else{
                    this.error = error.message || "Error Processing Request"
                    Swal.fire(this.error);
                }
            }finally{
                this.loading = false;
            }
        },
        async change_Product_Image(event){
            this.product_image = event.target.files[0];
        },
        async addProduct(){

            if (this.selectedType == "" || this.brandSelected == "" || this.selectedCategory == "" || this.selectedSub == "" 
                  || !this.product_name || !this.qty || !this.cost_price || !this.sell_price || !this.product_image  ){

                    new Toasteur().error("Insert All fields");
                    return;
            }

            const headers = {
                "Authorization": `Bearer ${this.accessToken}`,
                "Content-type": "application/json"
            }

            const data = new FormData();
            data.append("productname", this.product_name);
            data.append("product_type", this.selectedType);
            data.append("cost_price", this.cost_price);
            data.append("selling_price", this.sell_price);
            data.append("qty_available", this.qty);
            data.append("category_id", this.selectedCategory);
            data.append("sub_category_id", this.selectedSub);
            data.append("brand_id", this.brandSelected);
            data.append("special_price", this.special_price);
            data.append("discount_qty", this.discount_qty);
            data.append("discount_price", this.discount_price);
            data.append("made_in", this.made_in);
            data.append("weight", this.weight);
            data.append("description", this.description);
            data.append("image", this.product_image);

            

            try {
                this.loading = true;
                const response = await axios.post(`${this.baseurl}api/product/AddProduct.php`, data ,{headers} );

                if ( response.data.status ){
                    this.success = response.data.text;
                    new Toasteur().success(this.success);
                    this.getAllProducts();
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
                        window.location.href ="../login.php";
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
            }finally{
                this.loading = false;
            }


        },
        async addProductImages(){
            if (this.image_files.length < 1){
                new Toasteur().error("Kindly Add an Image");
                return
            }

            let data = new FormData;
            data.append("product_id", this.product.id);
            for (var i=0; i < this.image_files.length; i++ ){
                console.log(this.image_files[i]);
                data.append('images[]', this.image_files[i]);
            }

            const headers = {
                "Authorization": `Bearer ${this.accessToken}`,
                "Content-type": "application/json"
            }

            try {
                // this.loading = true;
                const response = await axios.post(`${this.baseurl}api/product/addProductImages.php`, data ,{headers} );

                if ( response.data.status ){
                    this.success = response.data.text;
                    new Toasteur().success(this.success);
                    this.getAllProducts(4);
                    this.getProduct(this.product_index);
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
                        window.location.href ="../login.php";
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
            }finally{
                this.loading = false;
            }
        },
        async addBrand(){
            if (!this.brand_name || !this.product_image ){
                new Toasteur().error("Insert Brand Name");
                return;
            }

            const headers = {
                "Authorization": `Bearproduct_imageer ${this.accessToken}`,
                "Content-type": "application/json"
            }

            const data = new FormData();
            data.append("name", this.brand_name); 
            data.append("image", this.product_image);

            try {
                this.loading = true;
                const response = await axios.post(`${this.baseurl}api/product/addProductBrand.php`, data ,{headers} );

                if ( response.data.status ){
                    this.success = response.data.text;
                    new Toasteur().success(this.success);
                    this.getAllShopBrands();
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
                        window.location.href ="../login.php";
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
            }finally{
                this.loading = false;
            }


        },
        async addLocation(){
            if (!this.location_name || !this.location_latitude || !this.location_longitude ){
                new Toasteur().error("Insert Location");
                return;
            }

            const headers = {
                "Authorization": `Bearer ${this.accessToken}`,
                "Content-type": "application/json"
            }

            const data = new FormData();
            data.append("location_name", this.location_name); 
            data.append("shop_latitude", this.location_latitude); 
            data.append("shop_longtitude", this.location_longitude); 

            try {
                this.loading = true;
                const response = await axios.post(`${this.baseurl}api/shops/addShopLocation.php`, data ,{headers} );

                if ( response.data.status ){
                    this.success = response.data.text;
                    new Toasteur().success(this.success);
                    this.getAllLocations();
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
                        window.location.href ="../login.php";
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
            }finally{
                this.loading = false;
            }
        },
        async deleteProduct(id){
            const headers = {
                "Authorization": `Bearer ${this.accessToken}`,
                "Content-type": "application/json"
            }
            
            const data = new FormData();
            data.append('product_id', id);

            try {
                this.loading = true;
                const response = await axios.post(`${this.baseurl}api/product/deleteProduct.php`, data ,{headers} );

                if ( response.data.status ){
                    this.success = response.data.text;
                    new Toasteur().success(this.success);
                    this.getAllProducts();
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
                        window.location.href ="../login.php";
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
                
            }finally{
                this.loading = false
            }
        },
        async deleteProductImage(product_id, image_name){
            console.log("Image: ", image_name);
            console.log("Product: ", product_id);
            const headers = {
                "Authorization": `Bearer ${this.accessToken}`,
                "Content-type": "application/json"
            }
            
            const data = new FormData();
            data.append('product_id', product_id);
            data.append('image_name', image_name);

            try {
                this.loading = true;
                const response = await axios.post(`${this.baseurl}api/product/deleteProductImage.php`, data ,{headers} );

                if ( response.data.status ){
                    this.success = response.data.text;
                    new Toasteur().success(this.success);
                    this.getAllProducts(4);
                    this.getProduct(this.product_index);
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
                        window.location.href ="../login.php";
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
                
            }finally{
                this.loading = false
            }
        },
        async deleteBrand(id){
            const headers = {
                "Authorization": `Bearer ${this.accessToken}`,
                "Content-type": "application/json"
            }
            
            

            try {
                this.loading = true;
                const response = await axios.get(`${this.baseurl}api/product/deleteProductBrand.php?id=${id}`, {headers} );

                if ( response.data.status ){
                    this.success = response.data.text;
                    new Toasteur().success(this.success);
                    this.getAllShopBrands();
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
                        window.location.href ="../login.php";
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
                
            }finally{
                this.loading = false
            }
        },
        async deleteLocation(id){
            const headers = {
                "Authorization": `Bearer ${this.accessToken}`,
                "Content-type": "application/json"
            }
            
            

            try {
                this.loading = true;
                const response = await axios.get(`${this.baseurl}api/shops/deleteShopLocation.php?loc_id=${id}`, {headers} );

                if ( response.data.status ){
                    this.success = response.data.text;
                    new Toasteur().success(this.success);
                    this.getAllLocations(2);
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
                        window.location.href ="../login.php";
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
                
            }finally{
                this.loading = false
            }
        },
        async updateProduct(){
            if (!this.product.type_code || !this.product.brand_code || !this.product.cat_code || !this.product.sub_cat_code 
                  || !this.product.name || !this.product.qty_available || !this.product.cost || !this.product.price ){

                    new Toasteur().error("Insert All fields");
                    return;
            }

            const headers = {
                "Authorization": `Bearer ${this.accessToken}`,
                "Content-type": "application/json"
            }

            const data = new FormData();
            data.append("product_id", this.product.id);
            data.append("productname", this.product.name);
            data.append("product_type", this.product.type_code);
            data.append("cost_price", this.product.cost);
            data.append("selling_price", this.product.price);
            data.append("qty_available", this.product.qty_available);
            data.append("category_id", this.product.cat_code);
            data.append("sub_category_id", this.product.sub_cat_code);
            data.append("brand_id", this.product.brand_code);
            data.append("special_price", this.product.special_price);
            data.append("discount_qty", this.product.discount_qty);
            data.append("discount_price", this.product.discount_price);
            data.append("made_in", this.product.made);
            data.append("weight", this.product.weight);
            data.append("description", this.product.description);

            

            try {
                this.loading = true;
                const response = await axios.post(`${this.baseurl}api/product/updateProduct.php`, data ,{headers} );

                if ( response.data.status ){
                    this.success = response.data.text;
                    new Toasteur().success(this.success);
                    window.location.reload();
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
                        window.location.href ="../login.php";
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
            }finally{
                this.loading = false;
            }


        },
        async updateProductStatus(id, status){
            const headers = {
                "Authorization": `Bearer ${this.accessToken}`,
                "Content-type": "application/json"
            }

            const data = new FormData();
            data.append("product_id", id);
            data.append("status", status);

            

            try {
                // this.loading = true;
                const response = await axios.post(`${this.baseurl}api/product/changeProductStatus.php`, data ,{headers} );

                if ( response.data.status ){
                    this.success = response.data.text;
                    new Toasteur().success(this.success);
                    await this.getAllProducts(2);
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
                        window.location.href ="../login.php";
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
            }finally{
                this.loading = false;
            }


        },
        async updateBrand(){
            if (!this.brand.name ){
                    new Toasteur().error("Insert Brand Name");
                    return;
            }

            if (!this.product_image && !this.brand.image){
                new Toasteur().error("Insert Brand Image");
                return;
            }

            const headers = {
                "Authorization": `Bearer ${this.accessToken}`,
                "Content-type": "application/json"
            }

            const data = new FormData();
            data.append("id", this.brand.id);
            data.append("name", this.brand.name);
            if (this.product_image){
                data.append("image", this.product_image);
            }else{
                data.append("image", this.brand.image);
            }            

            try {
                this.loading = true;
                const response = await axios.post(`${this.baseurl}api/product/updateProductBrand.php`, data ,{headers} );

                if ( response.data.status ){
                    this.success = response.data.text;
                    new Toasteur().success(this.success);
                    await this.getAllShopBrands();
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
                        window.location.href ="../login.php";
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
            }finally{
                this.loading = false;
            }


        },
        async updateLocation(){
            if (!this.location.location ){
                    new Toasteur().error("Insert Location Name");
                    return;
            }

            const headers = {
                "Authorization": `Bearer ${this.accessToken}`,
                "Content-type": "application/json"
            }

            const data = new FormData();
            data.append("loc_id", this.location.id);
            data.append("location_name", this.location.location);
            data.append("shop_latitude", this.location.latitude || 4.99999);
            data.append("shop_longtitude", this.location.longitude || 6.4549);

            

            try {
                this.loading = true;
                const response = await axios.post(`${this.baseurl}api/shops/updateShopLocation.php`, data ,{headers} );

                if ( response.data.status ){
                    this.success = response.data.text;
                    new Toasteur().success(this.success);
                    await this.getAllLocations();
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
                        window.location.href ="../login.php";
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
            }finally{
                this.loading = false;
            }


        },
        async updateLocationStatus(id, status){
            const headers = {
                "Authorization": `Bearer ${this.accessToken}`,
                "Content-type": "application/json"
            }

            const data = new FormData();
            data.append("loc_id", id);
            data.append("status", status);

            

            try {
                // this.loading = true;
                const response = await axios.post(`${this.baseurl}api/shops/updateLocStatus.php`, data ,{headers} );

                if ( response.data.status ){
                    this.success = response.data.text;
                    new Toasteur().success(this.success);
                    await this.getAllLocations(2);
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
                        window.location.href ="../login.php";
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
            }finally{
                this.loading = false;
            }


        },
        async addFile(e){
            let files = e.dataTransfer.files;
            [...files].forEach(file => {
                this.image_files.push(file);
                this.files_url.push(URL.createObjectURL(file));
                console.log(this.files_url);
                console.log(this.image_files);
            });
        },
        async fileSelected(e){
            let files = e.target.files;
            [...files].forEach(file => {
                this.image_files.push(file);
                this.files_url.push(URL.createObjectURL(file));
                console.log(this.files_url);
                console.log(this.image_files);
            });
        },
        async removeFile(index){
            this.image_files.pop(index);
            this.files_url.pop(index);
        },
        async removeSort() {
            this.sort = null;
            const path = window.location.pathname.split("/");
            const length = path.length;
            const location = path[length -1];
            if (location === "products.php"){
                await this.getAllProducts(2);
            }

            if (location === "location.php"){
                await this.getAllLocations(2);
            }
        },
        async removeSortType() {
            this.sorttype = null;
            const path = window.location.pathname.split("/");
            const length = path.length;
            const location = path[length -1];
            if (location === "products.php"){
                await this.getAllProducts(3);
            }
        },
        async addSortType(type){
            this.sorttype = type;
            const path = window.location.pathname.split("/");
            const length = path.length;
            const location = path[length -1];
            if (location === "products.php"){
                await this.getAllProducts(3);
            }
        },
        async setActive() {
            this.sort = 1;
            const path = window.location.pathname.split("/");
            const length = path.length;
            const location = path[length -1];
            if (location === "products.php"){
                await this.getAllProducts(2);
            }
            if (location === "location.php"){
                await this.getAllLocations(2);
            }
        },
        async setInactive() {
            this.sort = 0;
            
            const path = window.location.pathname.split("/");
            const length = path.length;
            const location = path[length -1];
            if (location === "products.php"){
                await this.getAllProducts(2);
            }
            if (location === "location.php"){
                await this.getAllLocations(2);
            }
        },
        async nextPage(){
            // Get window current location
            const path = window.location.pathname.split("/");
            const length = path.length;
            const location = path[length -1];
            // Increase Current page 
            this.currentPage = parseInt(this.currentPage) + 1;
            this.total_page = null
            this.totalData = null;

            if (location === "products.php"){
                await this.getAllProducts(2);
            }
            if (location === "brands.php"){
                await this.getAllShopBrands(3);
            }
            if (location === "location.php"){
                await this.getAllLocations(2);
            }
           
        },
        async previousPage(){
             // Get window current location
             const path = window.location.pathname.split("/");
             const length = path.length;
             const location = path[length -1];
             // Decrease Current Page
            this.currentPage = parseInt(this.currentPage) - 1;
            this.total_page = null
            this.totalData = null
            if (location === "products.php"){
                await this.getAllProducts(1);
            }
            if (location === "brands.php"){
                await this.getAllShopBrands(2);
            }
            if (location === "location.php"){
                await this.getAllLocations(2);
            }
        },
        async selectPage(page){
            // Get window current location
            const path = window.location.pathname.split("/");
            const length = path.length;
            const location = path[length -1];
            // Decrease Current Page
           this.currentPage = page;
           this.total_page = null
           this.totalData = null
           if (location === "products.php"){
               await this.getAllProducts(2);
           }
           if (location === "brands.php"){
                await this.getAllShopBrands(2);
           }
           if (location === "location.php"){
            await this.getAllLocations(2);
        }
        },
        async getToken(){
            this.loading= true
            this.accessToken = window.localStorage.getItem("authToken");
        },
        async logout(){
            window.localStorage.removeItem("authToken");
            window.location.href="./login.php"
        }
    },
    async beforeMount(){
        this.loading = true;
        await this.getToken();
        
    },
    async mounted(){
        await this.getShopDetails();
    }
});

shopApp.mount('#shop');

// function to validate phone number
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