<template>
    <div>
        <b-sidebar id="sidebar-1" right shadow width="700px">
            <product-sidebar :id="productId"></product-sidebar>
        </b-sidebar>
        <br>
        <span class="m-2"><b>Total: </b>{{pagination.total}}</span>
        <nav aria-label="Page navigation example">
            <ul class="pagination justify-content-end">
                <li v-bind:class="[{disabled: !pagination.prev_page_url}]" class="page-item"><a class="page-link" href="#" @click="fetchProducts(pagination.prev_page_url)">Previous</a></li>
                <li class="page-item disabled"><a class="page-link text-dark" href="#">Page {{ pagination.current_page }} of {{ pagination.last_page }}</a></li>
                <li v-bind:class="[{disabled: !pagination.next_page_url}]" class="page-item"><a class="page-link" href="#" @click="fetchProducts(pagination.next_page_url)">Next</a></li>
            </ul>
        </nav>
        <table class="table table-bordered">
            <thead>
            <tr>
                <th scope="col" style="width:10px">Image</th>
                <th scope="col" style="width:40px">Title</th>
                <th scope="col" style="width:20px">Price</th>
                <th scope="col" style="width:15px">Shop/Seller Name</th>
                <th scope="col" style="width:40px">Category-Sub category</th>
                <th scope="col" style="width:20px">Reviews</th>
                <th scope="col" style="width:20px">Data</th>
            </tr>
            </thead>
            <tbody>
            <tr v-b-toggle.sidebar-1 class="trow" v-for="product in products" v-bind:key="products.id" @click="productId =product.id">
                <th scope="row">
                    <img :src="'/images/products/'+product.mainImage" class="img-fluid img-thumbnail" style="width: 80px;height: 80px "scoped>
                </th>
                <th scope="row">{{product.title}}</th>
                <th scope="row">{{product.price}}</th>
                <th scope="row">{{product.shopName}}/{{product.seller}}</th>
                <th scope="row">{{product.category}} - {{product.subCategory}}</th>
                <th scope="row">
                    <i class="fas fa-star" v-bind:class="[{'golden-star': product.rate >=1}]"></i>
                    <i class="fas fa-star" v-bind:class="[{'golden-star': product.rate >=2}]"></i>
                    <i class="fas fa-star" v-bind:class="[{'golden-star': product.rate >=3}]"></i>
                    <i class="fas fa-star" v-bind:class="[{'golden-star': product.rate >=4}]"></i>
                    <i class="fas fa-star" v-bind:class="[{'golden-star': product.rate ==5}]"></i>

                </th>
                <th scope="row">{{product.updated_at}}</th>
            </tr>
            </tbody>
        </table>
    </div>
</template>

<script>
    import productSidebar from "./productSidebar";
    export default {
        name: "productsTable",
        components: {productSidebar},
        data(){
            return{
                products:[],
                pagination:[],
                productId:''
            }
        },
        created() {
            this.fetchProducts();
        },
        methods:{
            fetchProducts(page_url) {
                let vm = this;
                page_url = page_url || '/api/admin/outProducts';
                axios.get(page_url)
                    .then(res => {
                        this.products = res.data.data;
                        vm.makePagination(res.data);
                    })
                    .catch();
            },
            makePagination(res) {
                let pagination = {
                    current_page: res.current_page,
                    last_page: res.last_page,
                    total:res.total,
                    next_page_url: res.next_page_url,
                    prev_page_url: res.prev_page_url
                };
                this.pagination = pagination;
            },
            isGolden($num){
                product.rate ==$num ?true :false
            }
        }
    }
</script>

<style scoped>

</style>
