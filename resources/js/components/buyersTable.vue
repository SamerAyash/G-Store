<template>
    <div>
        <div  class="btn text-white" style="background-color: #37a000;margin-top: 20px;margin-bottom:20px">
            Buyers <span class="badge badge-light ">{{pagination.total}}</span>
        </div>
        <form class="inline">
            <input type="text" class="form-control-sm " placeholder="Name" v-model="name">
            <input type="text" class="form-control-sm" placeholder="Email" v-model="email">
            <input type="text" class="form-control-sm" placeholder="Id Number" v-model="idNumber">
            <input type="text" class="form-control-sm" placeholder="Phone" v-model="phone">
            <input type="text" class="form-control-sm" placeholder="Total Amount "v-model="totalAmount">
            <div class="float-right">
                <button type="button" class=" btn text-white"
                       style="background-color: #37a000;" @click="searchbuyer">
                    <b-icon-search></b-icon-search> Search</button>
            </div>
        </form>
        <hr>
        <nav aria-label="Page navigation example">
            <ul class="pagination justify-content-end">
                <li v-bind:class="[{disabled: !pagination.prev_page_url}]" class="page-item"><a class="page-link" href="#" @click="fetchBuyers(pagination.prev_page_url)">Previous</a></li>
                <li class="page-item disabled"><a class="page-link text-dark" href="#">Page {{ pagination.current_page }} of {{ pagination.last_page }}</a></li>
                <li v-bind:class="[{disabled: !pagination.next_page_url}]" class="page-item"><a class="page-link" href="#" @click="fetchBuyers(pagination.next_page_url)">Next</a></li>
            </ul>
        </nav>
        <table class="table table-striped">
            <thead>
            <tr>
                <th scope="col">#</th>
                <th scope="col">Name</th>
                <th scope="col">Email</th>
                <th scope="col">Id Number</th>
                <th scope="col">Phone</th>
                <th scope="col">Address</th>
                <th scope="col">Birth Date</th>
                <th scope="col">Total Amount</th>
                <th scope="col">Notes</th>
                <th scope="col">Action</th>
            </tr>
            </thead>
            <tbody>
            <tr v-for="buyer in buyers" v-bind:key="buyers.id">
                <th scope="row">
                    <div class="text-center">
                        <img :src="'/images/users/'+buyer.image" class="rounded " alt="" style="width: 60px;height: 60px "scoped>
                    </div>
                </th>
                <td>{{buyer.name}}</td>
                <td>{{buyer.email}}</td>
                <td>{{buyer.id_number}}</td>
                <td>{{buyer.phone}}</td>
                <td>{{buyer.city}}/{{buyer.area}}/{{buyer.street}}/{{buyer.buildingNumber}}</td>
                <td>{{buyer.birthDate}}</td>
                <td>{{buyer.totalAmount}}</td>
                <td>{{buyer.notes}}</td>
                <td>
                    <div class="btn-group mr-2" role="group" aria-label="First group">
                        <button @click="editBuyer(buyer)" data-toggle="modal" data-target="#editModal"
                                class="btn btn-primary btn-sm" style="width: 67px"><b-icon-pencil></b-icon-pencil>Edit</button>
                        <button @click="buyerO = buyer" data-toggle="modal" data-target="#deleteModal"
                                class="btn btn-danger btn-sm"style="width: 80px"><b-icon-trash></b-icon-trash>Delete</button>
                    </div>
                </td>
            </tr>
            </tbody>
        </table>
        <div class="modal fade" id="deleteModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <div class="modal-body">
                        <h2>Are you sure delete ?</h2> Name: {{buyerO.name}}, Email: {{buyerO.email}}
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                        <button  @click="deleteBuyer(buyerO.id)" class="btn btn-danger">I'am sure, Delete</button>
                    </div>
                </div>
            </div>
        </div>
        <div class="modal fade " id="editModal" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel" aria-hidden="true">
            <div class="modal-dialog modal-lg">
                <div class="modal-content">
                    <form @submit.prevent="updatBuyer(buyerO.id)" class="modal-body">
                        <div class="row">
                            <div class="col">
                                <label>Name
                                    <input type="text" class="form-control" placeholder="Name" v-model="buyerO.name" >
                                </label>
                                <div v-if="errors.name" class="alert-danger">{{errors.name[0]}}</div>
                            </div>
                            <div class="col">
                                <label>Email
                                    <input type="text" class="form-control" placeholder="Email" v-model="buyerO.email">
                                </label>
                                <div v-if="errors.email" class="alert-danger">{{errors.email[0]}}</div>
                            </div>
                            <div class="col">
                                <label>Id Number
                                    <input type="text" class="form-control" placeholder="Id Number" v-model="buyerO.id_number">
                                </label>
                                <div v-if="errors.id_number" class="alert-danger">{{errors.id_number[0]}}</div>
                            </div>
                        </div>
                        <hr>
                        <div class="row">
                            <div class="col">
                                <label>Phone (059|056).xxxxxxx
                                    <input type="text" class="form-control" placeholder="Phone" v-model="buyerO.phone">
                                </label>
                                <div v-if="errors.phone" class="alert-danger">{{errors.phone[0]}}</div>
                            </div>
                            <div class="col">
                                <label>Birth Date
                                    <input type="date" class="form-control" placeholder="Birth Date" v-model="buyerO.birthDate">
                                </label>
                                <div v-if="errors.birthDate" class="alert-danger">{{errors.birthDate[0]}}</div>
                            </div>
                            <div class="col" style="margin-right: 50px">
                                <label>Total Amount
                                    <input type="number" class="form-control" placeholder="Total Amount" v-model="buyerO.totalAmount">
                                </label>
                                <div v-if="errors.totalAmount" class="alert-danger">{{errors.totalAmount[0]}}</div>
                            </div>
                        </div>
                        <hr>
                            <div class="row">

                                <div class="col">
                                    <label>City
                                        <input type="text" class="form-control" placeholder="City" v-model="buyerO.city">
                                    </label>
                                    <div v-if="errors.city" class="alert-danger">{{errors.city[0]}}</div>
                                </div>
                                <div class="col">
                                    <label>Area
                                        <input type="text" class="form-control" placeholder="Area" v-model="buyerO.area">
                                    </label>
                                    <div v-if="errors.area" class="alert-danger">{{errors.area[0]}}</div>
                                </div>
                                <div class="col">
                                    <label>Street
                                        <input type="text" class="form-control" placeholder="Street" v-model="buyerO.street">
                                    </label>
                                    <div v-if="errors.street" class="alert-danger">{{errors.street[0]}}</div>
                                </div>
                                <div class="col">
                                    <label>Building Number
                                        <input type="text" class="form-control" placeholder="Building Number" v-model="buyerO.buildingNumber">
                                    </label>
                                    <div v-if="errors.buildingNumber" class="alert-danger">{{errors.buildingNumber[0]}}</div>
                                </div>
                            </div>
                        <hr>
                        <div class="row">
                            <div class="col">
                                <label>Notes
                                    <textarea type="text" rows="4" cols="80" class="form-control" placeholder="Notes" v-model="buyerO.notes"></textarea >
                                </label>
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
        name: "buyersTable",
        data() {
            return {
                buyers:[],
                buyerO:{
                    id:'',
                    name:'',
                    email:'',
                    id_number:'',
                    phone:'',
                    city:'',
                    area:'',
                    street:'',
                    buildingNumber:'',
                    birthDate:'',
                    totalAmount:'',
                    notes:'',
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
            this.fetchBuyers();
        },
        methods:{
            fetchBuyers(page_url) {
                let vm = this;
                page_url = page_url || '/api/admin/buyers';
                fetch(page_url)
                    .then(res => res.json())
                    .then(res => {
                        this.buyers = res.data;
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
            deleteBuyer(id) {
                fetch('/api/admin/buyers/'+id, {
                        method: 'delete'
                    })
                        .then(data => {
                            this.fetchBuyers();
                            $("#deleteModal").modal( 'hide' ).data( 'bs.modal', null );
                            $( '.modal-backdrop' ).remove();
                            this.makeToast(
                                'success',
                                'The buyer [ '+this.buyerO.name+' ] was deleted',
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
            editBuyer(buyer){
                this.buyerO.id=buyer.id;
                this.buyerO.name=buyer.name;
                this.buyerO.email=buyer.email;
                this.buyerO.id_number=buyer.id_number;
                this.buyerO.phone=buyer.phone;
                this.buyerO.city=buyer.city;
                this.buyerO.area=buyer.area;
                this.buyerO.street=buyer.street;
                this.buyerO.buildingNumber=buyer.buildingNumber;
                this.buyerO.birthDate=buyer.birthDate;
                this.buyerO.totalAmount=buyer.totalAmount;
                this.buyerO.notes=buyer.notes;
            },
            updatBuyer(id){
                this.errors=[];
                axios.patch('/api/admin/buyers/'+id,this.buyerO)
                    .then(data => {
                        this.fetchBuyers();
                        console.log(data.data)
                        $("#editModal").modal( 'hide' ).data( 'bs.modal', null );
                        $( '.modal-backdrop' ).remove();
                        this.makeToast(
                            'success',
                            'The buyer was updated',
                            'Update successfully');
                    })
                    .catch(err => {
                        if (err.response.status == 422){
                            this.errors = err.response.data.errors;
                        }
                    });
            },
            searchbuyer(){
                fetch('/api/admin/searchBuyer', {
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
