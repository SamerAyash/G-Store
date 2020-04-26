<template>
    <div>
        <b-sidebar id="sidebar-1" right shadow width="700px">
            <product-sidebar :id="productId"></product-sidebar>
        </b-sidebar>
        <br>
        <div class="row contanier">
            <div class="col">
                <select class="float-left custom-select custom-select-sm" v-model="condition" v-bind:style="{width:200+'px'}">
                    <option @click="fetchoffers">All</option>
                    <option>Accepted products</option>
                    <option>Unacceptable products</option>
                </select>
                <span class="m-2"><b>Total: </b>{{pagination.total}}</span>
            </div>
            <div class="col"></div>
            <nav aria-label="Page navigation " class="float-right col">
                <ul class="pagination justify-content-end">
                    <li v-bind:class="[{disabled: !pagination.prev_page_url}]" class="page-item"><a class="page-link" href="#" @click="fetchoffers(pagination.prev_page_url)">Previous</a></li>
                    <li class="page-item disabled"><a class="page-link text-dark" href="#">Page {{ pagination.current_page }} of {{ pagination.last_page }}</a></li>
                    <li v-bind:class="[{disabled: !pagination.next_page_url}]" class="page-item"><a class="page-link" href="#" @click="fetchoffers(pagination.next_page_url)">Next</a></li>
                </ul>
            </nav>
        </div>
        <table class="table table-bordered">
            <thead>
            <tr>
                <th scope="col">#</th>
                <th scope="col">Discount</th>
                <th scope="col">Duration (Day)</th>
                <th scope="col">Price after discount</th>
                <th scope="col">Data</th>
                <th scope="col" style="width: 10px">Action</th>
            </tr>
            </thead>
            <tbody>
            <tr class="trow" v-for="offer in offers" v-bind:key="offers.id">
                <th scope="row" v-b-toggle.sidebar-1 @click="productId =offer.product_id">
                </th>
                <th scope="row" v-b-toggle.sidebar-1 @click="productId =offer.product_id">{{offer.discount}}%</th>
                <th scope="row" v-b-toggle.sidebar-1 @click="productId =offer.product_id">{{offer.duration}}</th>
                <th scope="row" v-b-toggle.sidebar-1 @click="productId =offer.product_id">{{priceAfter(offer.discount,200)}}</th>
                <th scope="row" v-b-toggle.sidebar-1 @click="productId =offer.product_id">{{offer.updated_at}}</th>
                <th>
                    <div class="btn-group mr-2" role="group" aria-label="First group">
                        <button  @click="editOffer(offer)" data-toggle="modal" data-target="#editModal"
                                class="btn btn-primary btn-sm" style="width: 67px"><b-icon-pencil></b-icon-pencil></button>
                        <button @click="offerId =offer.id" data-toggle="modal" data-target="#deleteModal"
                                class="btn btn-danger btn-sm" style="width: 80px"><b-icon-trash></b-icon-trash></button>
                    </div>
                </th>
            </tr>
            </tbody>
        </table>
        <div class="modal fade" id="deleteModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <div class="modal-body">
                        <h2>Are you sure delete ?</h2>
                    </div>
                    <div class="modal-footer">
                        <button  @click="productId=''"type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                        <button  @click="deleteOffer()" class="btn btn-danger">I'am sure, Delete</button>
                    </div>
                </div>
            </div>
        </div>
        <div class="modal fade" id="editModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <form @submit.prevent="updateOffer">
                        <div class="modal-body container row">
                            <label class="col">
                                Discount (%):
                                <input type="number" class="form-control" name="discount" placeholder="Discount" v-model="offer.discount" required>
                                <div v-if="errors && errors.discount" class="text-danger">{{ errors.discount[0] }}</div>
                            </label>
                            <label class="col">
                                Duration (Day):
                                <select class="custom-select" name="duration" v-model="offer.duration">
                                    <option  v-for="day in days" v-bind:key="day" v-bind:selected="offer.duration == day" >
                                        {{day}}
                                    </option>
                                </select>
                                <div v-if="errors && errors.duration" class="text-danger">{{ errors.duration[0] }}</div>
                            </label>
                        </div>
                        <div class="modal-footer">
                            <button  @click="offer={}"type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                            <button  type="submit" class="btn btn-light text-white" style="background-color: #37a000">Update</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</template>

<script>
    import productSidebar from "./productSidebar";
    export default {
        name: "offerTable",
        components:{productSidebar},
        data(){
            return{
                condition:'All',
                errors:{},
                offers: {
                    discount:'',
                    duration:'',
                    id:''
                },
                pagination:[],
                productId:'',
                offerId:'',
                days:[],
                offer: {}
            }
        },
        created() {
            this.fetchoffers();
        },
        watch:{
            condition:function () {
              this.fetchoffers()
          }
        },
        methods:{
            fetchoffers(page_url) {
                page_url = page_url || '/api/admin/offers';
                axios.post(page_url,{
                    'condition':this.condition
                })
                    .then(res => {
                        console.log(res.data.data)
                        this.offers = res.data.data;
                        this.makePagination(res.data);
                        console.log(res)
                    })
                    .catch(err => console.info(err));
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
            priceAfter(discount,price){
                return price*(100-discount)/100
            },
            deleteOffer(){
                    axios.delete('/api/admin/offers/'+this.offerId)
                        .then(data => {
                            this.fetchoffers();
                            $("#deleteModal").modal( 'hide' ).data( 'bs.modal', null );
                            $( '.modal-backdrop' ).remove();
                            this.makeToast(
                                'success',
                                'The offer deleted',
                                'Delete successfully');
                        })
                        .catch(err => {
                            this.makeToast(
                                'danger',
                                'An error occurred, process did not complete',
                                '');
                        });
                },
            editOffer(offer){
                this.offer.id=offer.id;
                this.offer.discount=offer.discount;
                this.offer.duration=offer.duration;
                for (var $i=1;$i<31;$i++){
                    this.days.push($i);
                }
            },
            updateOffer(){
                axios.put('/api/admin/offers/'+this.offer.id,{
                    'discount':this.offer.discount,
                    'duration':this.offer.duration
                })
                .then(res=>{
                    this.fetchoffers();
                    $("#editModal").modal( 'hide' ).data( 'bs.modal', null );
                    $( '.modal-backdrop' ).remove();
                    this.makeToast(
                        'success',
                        'The offer updated',
                        'Update successfully');
                    console.log(res.data)
                })
                .catch(err=>{
                    this.makeToast(
                        'danger',
                        'An error occurred, process did not complete',
                        '');
                    if (err.response.status === 422) {
                        this.errors = err.response.data.errors || {};
                    }
                });
            },
            makeToast(variant = null,message,title) {
                this.$bvToast.toast(message, {
                    title: title,
                    variant: variant,
                    solid: true,
                    autoHideDelay:'1500',
                })
            },
        }
    }
</script>

<style scoped>

</style>
