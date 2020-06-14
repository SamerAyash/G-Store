<template>
    <div>
        <div  class="btn text-white" style="background-color: #37a000;margin-top: 20px;margin-bottom:20px">
            Supervisors <span class="badge badge-light ">{{pagination.total}}</span>
        </div>
        <form class="inline">
            <input type="text" class="form-control-sm " placeholder="Name" v-model="name">
            <input type="text" class="form-control-sm" placeholder="Email" v-model="email">
            <input type="text" class="form-control-sm" placeholder="Id Number" v-model="idNumber">
            <input type="text" class="form-control-sm" placeholder="Phone" v-model="phone">
            <div class="float-right">
                <button type="button" class=" btn text-white"
                        style="background-color: #37a000;" @click.prevent="searchsupervisor">
                    <b-icon-search></b-icon-search>Search</button>
            </div>
        </form>
        <hr>
        <button @click="edit =false,supervisorO={}" type="button" class="btn btn-primary float-left" data-toggle="modal" data-target="#formModal"><i class="fas fa-plus"></i> Create supervisor</button>
        <nav aria-label="Page navigation example">
            <ul class="pagination justify-content-end">
                <li v-bind:class="[{disabled: !pagination.prev_page_url}]" class="page-item"><a class="page-link" href="#" @click.prevent="fetchSupervisors(pagination.prev_page_url)">Previous</a></li>
                <li class="page-item disabled"><a class="page-link text-dark" href="#">Page {{ pagination.current_page }} of {{ pagination.last_page }}</a></li>
                <li v-bind:class="[{disabled: !pagination.next_page_url}]" class="page-item"><a class="page-link" href="#" @click.prevent="fetchSupervisors(pagination.next_page_url)">Next</a></li>
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
                <th scope="col">Permissions</th>
                <th scope="col">Birth Date</th>
                <th scope="col">Notes</th>
                <th scope="col">Action</th>
                <th scope="col">Created at</th>
                <th scope="col">Updated at</th>
            </tr>
            </thead>
            <tbody>
            <tr v-for="supervisor in supervisors" v-bind:key="supervisors.id">
                <th scope="row">
                    <div class="text-center">
                        <img :src="'/images/admins/'+supervisor.image" class="rounded " alt="" style="width: 60px;height: 60px "scoped>
                    </div>
                </th>
                <td>{{supervisor.name}}</td>
                <td>{{supervisor.email}}</td>
                <td>{{supervisor.id_number}}</td>
                <td>{{supervisor.phone}}</td>
                <td>{{supervisor.city}}/{{supervisor.area}}/{{supervisor.street}}/{{supervisor.buildingNumber}}</td>
                <td >
                        <p v-for="permission in supervisor.permissions" :key="permission.name" >
                            {{permission.name.replace(/^./, permission.name[0].toUpperCase())}}
                        </p>
                </td>
                <td>{{supervisor.birthDate}}</td>
                <td>{{supervisor.notes}}</td>
                <td>
                    <div class="btn-group mr-2" role="group" aria-label="First group">
                        <button @click="editSupervisor(supervisor)" data-toggle="modal" data-target="#formModal"
                                class="btn btn-primary btn-sm" style="width: 67px"><b-icon-pencil></b-icon-pencil>Edit</button>
                        <button @click="supervisorO = supervisor" data-toggle="modal" data-target="#deleteModal"
                                class="btn btn-danger btn-sm"style="width: 80px"><b-icon-trash></b-icon-trash>Delete</button>
                    </div>
                </td>
                <td>{{supervisor.created_at}}</td>
                <td>{{supervisor.updated_at}}</td>
            </tr>
            </tbody>
        </table>
        <div class="modal fade" id="deleteModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <div class="modal-body">
                        <h2>Are you sure delete ?</h2> Name: {{supervisorO.name}}, Email: {{supervisorO.email}}
                    </div>
                    <div class="modal-footer">
                        <button @click="supervisorO={}" type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                        <button  @click="deleteSupervisor(supervisorO.id)" class="btn btn-danger">I'am sure, Delete</button>
                    </div>
                </div>
            </div>
        </div>
        <div class="modal fade" id="formModal" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel" aria-hidden="true">
            <div class="modal-dialog modal-lg">
                <div class="modal-content">
                    <form class="modal-body">
                        <div class="row">
                            <div class="col">
                                <label>Name
                                    <input type="text" class="form-control" placeholder="Name" v-model="supervisorO.name" >
                                </label>
                                <div v-if="errors.name" class="alert-danger">{{errors.name[0]}}</div>
                            </div>
                            <div class="col">
                                <label>Email
                                    <input type="text" class="form-control" placeholder="Email" v-model="supervisorO.email">
                                </label>
                                <div v-if="errors.email" class="alert-danger">{{errors.email[0]}}</div>
                            </div>
                            <div class="col">
                                <label>Id Number
                                    <input type="text" class="form-control" placeholder="Id Number" v-model="supervisorO.id_number">
                                </label>
                                <div v-if="errors.id_number" class="alert-danger">{{errors.id_number[0]}}</div>
                            </div>
                        </div>
                        <hr>
                        <div class="row">
                            <div class="col">
                                <div class="row">
                                    <div class="col">
                                        <label>Phone (059|056).xxxxxxx
                                            <input type="text" class="form-control" placeholder="Phone" v-model="supervisorO.phone">
                                        </label>
                                        <div v-if="errors.phone" class="alert-danger">{{errors.phone[0]}}</div>
                                    </div>
                                </div>
                                <div class="row" v-if="!edit">
                                    <div class="col">
                                        <label>Password
                                            <input type="password" class="form-control" placeholder="Password" v-model="supervisorO.password">
                                        </label>
                                        <div v-if="errors.password" class="alert-danger">{{errors.password[0]}}</div>
                                    </div>
                                </div>
                            </div>
                            <div class="col">
                                <div class="row">
                                    <label>Birth Date
                                        <input type="date" class="form-control" placeholder="Birth Date" v-model="supervisorO.birthDate">
                                    </label>
                                    <div v-if="errors.birthDate" class="alert-danger">{{errors.birthDate[0]}}</div>
                                </div>
                                <div class="row" v-if="!edit">
                                    <label>Password confirm
                                        <input type="password" class="form-control" placeholder="Password confirm" v-model="supervisorO.password_confirmation">
                                    </label>
                                    <div v-if="errors.password_confirmation" class="alert-danger">{{errors.password_confirmation[0]}}</div>
                                </div>
                            </div>
                            <div class="col">
                                <label>Notes
                                    <textarea type="text" rows="4" cols="80" class="form-control" placeholder="Notes" v-model="supervisorO.notes"></textarea >
                                </label>
                            </div>
                        </div>
                        <hr>
                        <div class="row">

                            <div class="col">
                                <label>City
                                    <input type="text" class="form-control" placeholder="City" v-model="supervisorO.city">
                                </label>
                                <div v-if="errors.city" class="alert-danger">{{errors.city[0]}}</div>
                            </div>
                            <div class="col">
                                <label>Area
                                    <input type="text" class="form-control" placeholder="Area" v-model="supervisorO.area">
                                </label>
                                <div v-if="errors.area" class="alert-danger">{{errors.area[0]}}</div>
                            </div>
                            <div class="col">
                                <label>Street
                                    <input type="text" class="form-control" placeholder="Street" v-model="supervisorO.street">
                                </label>
                                <div v-if="errors.street" class="alert-danger">{{errors.street[0]}}</div>
                            </div>
                            <div class="col">
                                <label>Building Number
                                    <input type="text" class="form-control" placeholder="Building Number" v-model="supervisorO.buildingNumber">
                                </label>
                                <div v-if="errors.buildingNumber" class="alert-danger">{{errors.buildingNumber[0]}}</div>
                            </div>
                        </div>
                        <hr>
                        <label>Permissions:</label>
                        <div class="row">
                            <div class="col">
                                        <b-form-checkbox value="manage customers" v-model="supervisorO.manageCustomers">Manage Customers</b-form-checkbox>
                                        <b-form-checkbox value="manage products" v-model="supervisorO.manageProducts">Manage Products</b-form-checkbox>
                                    </div>
                                    <div class="col">
                                        <b-form-checkbox value="manage offers" v-model="supervisorO.manageOffers">Manage Offers</b-form-checkbox>
                                        <b-form-checkbox value="manage orders" v-model="supervisorO.manageOrders">Manage Orders</b-form-checkbox>
                                    </div>
                        </div>
                        <div class="modal-footer">
                            <button @click="function(){supervisorO={};edit=false;errors=[]}" type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                            <button v-if="edit" @click="updatSupervisor(supervisorO.id)" type="button" class="btn btn-success">Update</button>
                            <button v-if="!edit" @click="addSupervisor()" type="button" class="btn btn-success">Add</button>
                        </div>
                    </form>

                </div>

            </div>
        </div>

    </div>
</template>

<script>
    export default {
        name: "supervisorsTable",
        data() {
            return {
                supervisors:[],
                supervisorO:{
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
                    notes:'',
                    password:'',
                    password_confirmation:'',
                    manageOrders :'',
                    manageCustomers :'',
                    manageProducts :'',
                    manageOffers :'',

                },
                errors:[],
                pagination: {},
                name:'',
                email:'',
                idNumber:'',
                phone:'',
                edit:false,
            }
        },
        created() {
            this.fetchSupervisors();
        },
        methods:{
            fetchSupervisors(page_url) {
                let vm = this;
                page_url = page_url || '/api/admin/supervisors';
                fetch(page_url)
                    .then(res => res.json())
                    .then(res => {
                        this.supervisors = res.data;
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
            deleteSupervisor(id) {
                fetch('/api/admin/supervisors/'+id, {
                    method: 'delete'
                })
                    .then(data => {
                        this.fetchSupervisors();
                        $("#deleteModal").modal( 'hide' ).data( 'bs.modal', null );
                        $( '.modal-backdrop' ).remove();
                        this.makeToast(
                            'success',
                            'The supervisor [ '+this.supervisorO.name+' ] was deleted',
                            'Delete successfully');
                        this.supervisorO={};
                    })
                    .catch(err => {
                        this.makeToast(
                            'danger',
                            'An error occurred, process did not complete',
                            '');
                        console.log(err)
                    });
            },
            editSupervisor(supervisor){
              this.edit=true;
              this.supervisorO.id=supervisor.id;
              this.supervisorO.name=supervisor.name;
              this.supervisorO.email=supervisor.email;
              this.supervisorO.id_number=supervisor.id_number;
              this.supervisorO.phone=supervisor.phone;
              this.supervisorO.birthDate=supervisor.birthDate;
              this.supervisorO.notes=supervisor.notes;
              this.supervisorO.city=supervisor.city;
              this.supervisorO.area=supervisor.area;
              this.supervisorO.street=supervisor.street;
              this.supervisorO.buildingNumber=supervisor.buildingNumber;
              this.supervisorO.manageOrders= supervisor.permissions.filter(el=>el.name ==='manage orders').map(x=>x.name) == 'manage orders'? 'manage orders':false ;
              this.supervisorO.manageCustomers=supervisor.permissions.filter(el=>el.name ==='manage customers').map(x=>x.name) == 'manage customers'? 'manage customers':false ;
              this.supervisorO.manageProducts=supervisor.permissions.filter(el=>el.name ==='manage products').map(x=>x.name) == 'manage products'? 'manage products':false ;
              this.supervisorO.manageOffers=supervisor.permissions.filter(el=>el.name ==='manage offers').map(x=>x.name) == 'manage offers'? 'manage offers':false ;

            },
            updatSupervisor(id){
                this.errors=[];
                axios.patch('/api/admin/supervisors/'+id,this.supervisorO)
                    .then(data => {
                        this.fetchSupervisors();
                        $("#formModal").modal( 'hide' ).data( 'bs.modal', null );
                        $( '.modal-backdrop' ).remove();
                        this.makeToast(
                            'success',
                            'The supervisor was updated',
                            'Update successfully');
                        console.log(data);
                        this.supervisorO={};
                    })
                    .catch(err => {
                        if (err.response.status == 422){
                            this.errors = err.response.data.errors;
                        }
                    });
            },
            addSupervisor(){
                this.errors=[];
                axios.post('/api/admin/supervisors',this.supervisorO)
                    .then(data => {
                        this.fetchSupervisors();
                        $("#formModal").modal( 'hide' ).data( 'bs.modal', null );
                        $( '.modal-backdrop' ).remove();
                        this.makeToast(
                            'success',
                            'The supervisor was added',
                            'Add successfully');
                            this.edit=false;
                            this.supervisorO={};
                    })
                    .catch(err => {
                        if (err.response.status == 422){
                            this.errors = err.response.data.errors;
                        }
                    });
            },
            searchsupervisor(){
                fetch('/api/admin/searchSupervisor', {
                    method:'POST',
                    body: JSON.stringify([{
                        name: this.name,
                        email: this.email,
                        idNumber: this.idNumber,
                        phone: this.phone,
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
