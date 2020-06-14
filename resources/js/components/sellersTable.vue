<template>
    <div>
        <div  class="btn text-white" style="background-color: #37a000;margin-top: 20px;margin-bottom:20px">
            Sellers <span class="badge badge-light ">{{pagination.total}}</span>
        </div>
        <form class="inline">
            <input type="text" class="form-control-sm " placeholder="Name" v-model="name">
            <input type="text" class="form-control-sm" placeholder="Email" v-model="email">
            <input type="text" class="form-control-sm" placeholder="Id Number" v-model="idNumber">
            <input type="text" class="form-control-sm" placeholder="Phone" v-model="phone">
            <input type="text" class="form-control-sm" placeholder="Total Amount "v-model="totalAmount">
            <div class="float-right">
                <button type="button" class=" btn text-white"
                        style="background-color: #37a000;" @click.prevent="searchseller">
                    <b-icon-search></b-icon-search> Search</button>
            </div>
        </form>
        <hr>
        <nav aria-label="Page navigation example">
            <ul class="pagination justify-content-end">
                <li v-bind:class="[{disabled: !pagination.prev_page_url}]" class="page-item"><a class="page-link" href="#" @click.prevent="fetchsellers(pagination.prev_page_url)">Previous</a></li>
                <li class="page-item disabled"><a class="page-link text-dark" href="#">Page {{ pagination.current_page }} of {{ pagination.last_page }}</a></li>
                <li v-bind:class="[{disabled: !pagination.next_page_url}]" class="page-item"><a class="page-link" href="#" @click.prevent="fetchsellers(pagination.next_page_url)">Next</a></li>
            </ul>
        </nav>
        <table class="table table-striped">
            <thead>
            <tr>
                <th scope="col">#</th>
                <th scope="col">Name</th>
                <th scope="col">Email</th>
                <th scope="col">Shop Name</th>
                <th scope="col">Id Number</th>
                <th scope="col">Phone</th>
                <th scope="col">Address</th>
                <th scope="col">Birth Date</th>
                <th scope="col">Products Count</th>
                <th scope="col">Total Amount</th>
                <th scope="col">Notes</th>
                <th scope="col">Action</th>
                <th scope="col">Created at</th>
                <th scope="col">Updated at</th>
            </tr>
            </thead>
            <tbody>
            <tr v-for="seller in sellers" v-bind:key="sellers.id">
                <th scope="row">
                    <div class="text-center">
                        <img :src="'/images/users/'+seller.image" class="rounded " alt="" style="width: 60px;height: 60px "scoped>
                    </div>
                </th>
                <td>{{seller.name}}</td>
                <td>{{seller.email}}</td>
                <td>{{seller.shopName}}</td>
                <td>{{seller.id_number}}</td>
                <td>{{seller.phone}}</td>
                <td>{{seller.city}}/{{seller.area}}/{{seller.street}}/{{seller.buildingNumber}}</td>
                <td>{{seller.birthDate}}</td>
                <td>{{seller.productsCount}}</td>
                <td>{{seller.totalAmount}}</td>
                <td>{{seller.notes}}</td>
                <td>
                    <div class="btn-group mr-2" role="group" aria-label="First group">
                        <button @click="editSeller(seller)" data-toggle="modal" data-target="#editModal" class="btn btn-primary btn-sm" style="width: 67px"><b-icon-pencil></b-icon-pencil>Edit</button>
                        <button @click="sellerO = seller" data-toggle="modal" data-target="#deleteModal"  class="btn btn-danger btn-sm"style="width: 80px"><b-icon-trash></b-icon-trash>Delete</button>
                    </div>
                </td>
                <td>{{seller.created_at}}</td>
                <td>{{seller.updated_at}}</td>
            </tr>
            </tbody>
        </table>
        <div class="modal fade" id="deleteModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <div class="modal-body">
                        <h2>Are you sure delete ?</h2> Name: {{sellerO.name}},Shop Name:{{sellerO.shopName}}, Email: {{sellerO.email}}
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                        <button  @click="deleteseller(sellerO.id)" class="btn btn-danger">I'am sure, Delete</button>
                    </div>
                </div>
            </div>
        </div>
        <div class="modal fade " id="editModal" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel" aria-hidden="true">
            <div class="modal-dialog modal-lg">
                <div class="modal-content">
                    <form @submit.prevent="updatseller(sellerO.id)" class="modal-body">
                        <div class="row">
                            <div class="col">
                                <label>Name
                                    <input type="text" class="form-control" placeholder="Name" v-model="sellerO.name">
                                </label>
                                <div v-if="errors.name" class="alert-danger">{{errors.name[0]}}</div>
                            </div>
                            <div class="col">
                                <label>Shop Name
                                    <input type="text" class="form-control" placeholder="Shop Name" v-model="sellerO.shopName">
                                </label>
                                <div v-if="errors.shopName" class="alert-danger">{{errors.shopName[0]}}</div>
                            </div>
                            <div class="col">
                                <label>Email
                                    <input type="text" class="form-control" placeholder="Email" v-model="sellerO.email">
                                </label>
                                <div v-if="errors.email" class="alert-danger">{{errors.email[0]}}</div>
                            </div>
                            <div class="col">
                                <label>Id Number
                                    <input type="text" class="form-control" placeholder="Id Number" v-model="sellerO.id_number">
                                </label>
                                <div v-if="errors.id_number" class="alert-danger">{{errors.id_number[0]}}</div>
                            </div>
                        </div>
                        <hr>
                        <div class="row">
                            <div class="col">
                                <label>Phone (059|056).xxxxxxx
                                    <input type="text" class="form-control" placeholder="Phone" v-model="sellerO.phone">
                                </label>
                                <div v-if="errors.phone" class="alert-danger">{{errors.phone[0]}}</div>
                            </div>
                            <div class="col">
                                <label>Birth Date
                                    <input type="date" class="form-control" placeholder="Birth Date" v-model="sellerO.birthDate">
                                </label>
                                <div v-if="errors.birthDate" class="alert-danger">{{errors.birthDate[0]}}</div>
                            </div>
                            <div class="col">
                                <label>Products count
                                    <input type="number" class="form-control" placeholder="Products count" v-model="sellerO.productsCount">
                                </label>
                                <div v-if="errors.productsCount" class="alert-danger">{{errors.productsCount[0]}}</div>
                            </div>
                            <div class="col">
                                <label>Total Amount
                                    <input type="number" class="form-control" placeholder="Total Amount" v-model="sellerO.totalAmount">
                                </label>
                                <div v-if="errors.totalAmount" class="alert-danger">{{errors.totalAmount[0]}}</div>
                            </div>
                        </div>
                        <hr>
                        <div class="row">

                            <div class="col">
                                <label>City
                                    <input type="text" class="form-control" placeholder="Address" v-model="sellerO.city">
                                </label>
                                <div v-if="errors.city" class="alert-danger">{{errors.city[0]}}</div>
                            </div>
                            <div class="col">
                                <label>Area
                                    <input type="text" class="form-control" placeholder="Address" v-model="sellerO.area">
                                </label>
                                <div v-if="errors.area" class="alert-danger">{{errors.area[0]}}</div>
                            </div>
                            <div class="col">
                                <label>Street
                                    <input type="text" class="form-control" placeholder="Address" v-model="sellerO.street">
                                </label>
                                <div v-if="errors.street" class="alert-danger">{{errors.street[0]}}</div>
                            </div>
                            <div class="col">
                                <label>Building Number
                                    <input type="text" class="form-control" placeholder="Address" v-model="sellerO.buildingNumber">
                                </label>
                                <div v-if="errors.buildingNumber" class="alert-danger">{{errors.buildingNumber[0]}}</div>
                            </div>
                        </div>
                        <hr>
                        <div class="row">
                            <div class="col">
                                <label>Notes
                                    <textarea type="text" rows="4" cols="80" class="form-control" placeholder="Notes" v-model="sellerO.notes"></textarea >
                                </label>
                            </div>
                            <div class="col-3">
                                <label>Permissions:</label>
                                <b-form-checkbox value="manage products" v-model="sellerO.manageProducts">Manage Products</b-form-checkbox>
                                <b-form-checkbox value="manage offers" v-model="sellerO.manageOffers">Manage Offers</b-form-checkbox>
                            </div>
                        </div>

                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                            <button  type="submit" class="btn btn-success">Update</button>
                        </div>
                    </form>

                </div>

            </div>
        </div>

    </div>
</template>

<script>
    export default {
        name: "sellersTable",
        data() {
            return {
                sellers:[],
                sellerO:{
                    id:'',
                    name:'',
                    shopName:'',
                    email:'',
                    id_number:'',
                    phone:'',
                    city:'',
                    area:'',
                    street:'',
                    buildingNumber:'',
                    birthDate:'',
                    productsCount:'',
                    totalAmount:'',
                    notes:'',
                    manageProducts:'',
                    manageOffers:''
                },
                errors:[],
                pagination: {},
                name:'',
                email:'',
                idNumber:'',
                phone:'',
                totalAmount:'',
            }
        },
        created() {
            this.fetchsellers();
        },
        methods:{
            fetchsellers(page_url) {
                let vm = this;
                page_url = page_url || '/api/admin/sellers';
                fetch(page_url)
                    .then(res => res.json())
                    .then(res => {
                        this.sellers = res.data;
                        vm.makePagination(res);
                    })
                    .catch(err => console.log(err));
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
            deleteseller(id) {
                fetch('/api/admin/sellers/'+id, {
                    method: 'delete'
                })
                    .then(data => {
                        this.fetchsellers();
                        $("#deleteModal").modal( 'hide' ).data( 'bs.modal', null );
                        $( '.modal-backdrop' ).remove();
                        this.makeToast(
                            'success',
                            'The seller [ '+this.sellerO.name+' ] was deleted',
                            'Delete successfully');
                    })
                    .catch(err => {
                        this.makeToast(
                            'danger',
                            'An error occurred, process did not complete',
                            '');
                        console.log(err)
                    });
            },
            editSeller(seller){
                    this.sellerO.id=seller.id;
                    this.sellerO.name=seller.name;
                    this.sellerO.shopName=seller.shopName;
                    this.sellerO.email=seller.email;
                    this.sellerO.id_number=seller.id_number;
                    this.sellerO.phone=seller.phone;
                    this.sellerO.city=seller.city;
                    this.sellerO.area=seller.area;
                    this.sellerO.street=seller.street;
                    this.sellerO.buildingNumber=seller.buildingNumber;
                    this.sellerO.birthDate=seller.birthDate;
                    this.sellerO.productsCount=seller.productsCount;
                    this.sellerO.totalAmount=seller.totalAmount;
                    this.sellerO.notes=seller.notes;
                    this.sellerO.manageProducts=seller.permissions.filter(el=>el.name === 'manage products').map(el=>el.name) == 'manage products'?'manage products':false;
                    this.sellerO.manageOffers=seller.permissions.filter(el=>el.name === 'manage offers').map(el=>el.name) == 'manage offers'?'manage offers':false;
            },
            updatseller(id){
                this.errors=[];
                axios.patch('/api/admin/sellers/'+id,this.sellerO)
                    .then(data => {
                        this.fetchsellers();
                        console.log(data.data)
                        $("#editModal").modal( 'hide' ).data( 'bs.modal', null );
                        $( '.modal-backdrop' ).remove();
                        this.makeToast(
                            'success',
                            'The seller was updated',
                            'Update successfully');
                    })
                    .catch(err => {
                        if (err.response.status == 422){
                            this.errors = err.response.data.errors;
                        }
                    });
            },
            searchseller(){
                fetch('/api/admin/searchseller', {
                    method:'POST',
                    body: JSON.stringify([{
                        name: this.name,
                        email: this.email,
                        idNumber: this.idNumber,
                        phone: this.phone,
                        totalAmount: this.totalAmount,
                    }]),
                    headers:{
                        'content-type': 'application/json'
                    }
                })
                    .then(response => {
                        console.log(response)
                    })
                    .catch(error =>{
                        console.log(error)
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
