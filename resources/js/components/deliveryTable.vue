<template>
    <div>
        <div  class="btn text-white" style="background-color: #37a000;margin-top: 20px;margin-bottom:20px">
            Delivery <span class="badge badge-light ">{{pagination.total}}</span>
        </div>
        <form class="inline">
            <input type="text" class="form-control-sm " placeholder="Name" v-model="name">
            <input type="text" class="form-control-sm" placeholder="Email" v-model="email">
            <input type="text" class="form-control-sm" placeholder="Id Number" v-model="idNumber">
            <input type="text" class="form-control-sm" placeholder="Phone" v-model="phone">
            <div class="float-right">
                <button type="button" class=" btn text-white"
                        style="background-color: #37a000;" @click="searchDelivery">
                    <b-icon-search></b-icon-search>Search</button>
            </div>
        </form>
        <hr>
        <button type="button" @click="edit =false,deliveryO={}" class="btn btn-primary float-left" data-toggle="modal" data-target="#formModal"><i class="fas fa-plus"></i> Create delivery</button>
        <nav aria-label="Page navigation example">
            <ul class="pagination justify-content-end">
                <li v-bind:class="[{disabled: !pagination.prev_page_url}]" class="page-item"><a class="page-link" href="#" @click.prevent="fetchDeliverys(pagination.prev_page_url)">Previous</a></li>
                <li class="page-item disabled"><a class="page-link text-dark" href="#">Page {{ pagination.current_page }} of {{ pagination.last_page }}</a></li>
                <li v-bind:class="[{disabled: !pagination.next_page_url}]" class="page-item"><a class="page-link" href="#" @click.prevent="fetchDeliverys(pagination.next_page_url)">Next</a></li>
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
            <tr v-for="delivery in deliverys" v-bind:key="deliverys.id">
                <th scope="row">
                    <div class="text-center">
                        <img :src="'/images/admins/'+delivery.image" class="rounded " alt="" style="width: 60px;height: 60px " scoped>
                    </div>
                </th>
                <td>{{delivery.name}}</td>
                <td>{{delivery.email}}</td>
                <td>{{delivery.id_number}}</td>
                <td>{{delivery.phone}}</td>
                <td>{{delivery.city}}/{{delivery.area}}/{{delivery.street}}/{{delivery.buildingNumber}}</td>
                <td >
                    <p v-for="permission in delivery.permissions" :key="permission.name" >
                        {{permission.name.replace(/^./, permission.name[0].toUpperCase())}}
                    </p>
                </td>
                <td>{{delivery.birthDate}}</td>
                <td>{{delivery.notes}}</td>
                <td>
                    <div class="btn-group mr-2" role="group" aria-label="First group">
                        <button @click="editDelivery(delivery)" data-toggle="modal" data-target="#formModal"
                                class="btn btn-primary btn-sm" style="width: 67px"><b-icon-pencil></b-icon-pencil>Edit</button>
                        <button @click="deliveryO = delivery" data-toggle="modal" data-target="#deleteModal"
                                class="btn btn-danger btn-sm" style="width: 80px"><b-icon-trash></b-icon-trash>Delete</button>
                    </div>
                </td>
                <td>{{delivery.created_at}}</td>
                <td>{{delivery.updated_at}}</td>
            </tr>
            </tbody>
        </table>
        <div class="modal fade" id="deleteModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <div class="modal-body">
                        <h2>Are you sure delete ?</h2> Name: {{deliveryO.name}}, Email: {{deliveryO.email}}
                    </div>
                    <div class="modal-footer">
                        <button @click="this.deliveryO={}" type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                        <button  @click="deleteDelivery(deliveryO.id)" class="btn btn-danger">I'am sure, Delete</button>
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
                                    <input type="text" class="form-control" placeholder="Name" v-model="deliveryO.name" >
                                </label>
                                <div v-if="errors.name" class="alert-danger">{{errors.name[0]}}</div>
                            </div>
                            <div class="col">
                                <label>Email
                                    <input type="text" class="form-control" placeholder="Email" v-model="deliveryO.email">
                                </label>
                                <div v-if="errors.email" class="alert-danger">{{errors.email[0]}}</div>
                            </div>
                            <div class="col">
                                <label>Id Number
                                    <input type="text" class="form-control" placeholder="Id Number" v-model="deliveryO.id_number">
                                </label>
                                <div v-if="errors.id_number" class="alert-danger">{{errors.id_number[0]}}</div>
                            </div>
                        </div>
                        <hr>
                        <div class="row">
                            <div class="col">
                                <div class="row">
                                    <label>Phone (059|056).xxxxxxx
                                        <input type="text" class="form-control" placeholder="Phone" v-model="deliveryO.phone">
                                    </label>
                                    <div v-if="errors.phone" class="alert-danger">{{errors.phone[0]}}</div>
                                </div>
                                <div class="row" v-if="!edit">
                                    <label>Password
                                        <input type="password" class="form-control" placeholder="Password" v-model="deliveryO.password">
                                    </label>
                                    <div v-if="errors.password" class="alert-danger">{{errors.password[0]}}</div>
                                </div>
                            </div>
                            <div class="col">
                                <div class="row">
                                    <label>Birth Date
                                        <input type="date" class="form-control" placeholder="Birth Date" v-model="deliveryO.birthDate">
                                    </label>
                                    <div v-if="errors.birthDate" class="alert-danger">{{errors.birthDate[0]}}</div>
                                </div>
                                <div class="row" v-if="!edit">
                                    <label>Password confirm
                                        <input type="password" class="form-control" placeholder="Password confirm" v-model="deliveryO.password_confirmation">
                                    </label>
                                    <div v-if="errors.password_confirmation" class="alert-danger">{{errors.password_confirmation[0]}}</div>
                                </div>
                            </div>
                            <div class="col">
                                <label>Notes
                                    <textarea type="text" rows="4" cols="80" class="form-control" placeholder="Notes" v-model="deliveryO.notes"></textarea >
                                </label>
                            </div>
                        </div>
                        <hr>
                        <div class="row">

                            <div class="col">
                                <label>City
                                    <input type="text" class="form-control" placeholder="City" v-model="deliveryO.city">
                                </label>
                                <div v-if="errors.city" class="alert-danger">{{errors.city[0]}}</div>
                            </div>
                            <div class="col">
                                <label>Area
                                    <input type="text" class="form-control" placeholder="Area" v-model="deliveryO.area">
                                </label>
                                <div v-if="errors.area" class="alert-danger">{{errors.area[0]}}</div>
                            </div>
                            <div class="col">
                                <label>Street
                                    <input type="text" class="form-control" placeholder="Street" v-model="deliveryO.street">
                                </label>
                                <div v-if="errors.street" class="alert-danger">{{errors.street[0]}}</div>
                            </div>
                            <div class="col">
                                <label>Building Number
                                    <input type="text" class="form-control" placeholder="Building Number" v-model="deliveryO.buildingNumber">
                                </label>
                                <div v-if="errors.buildingNumber" class="alert-danger">{{errors.buildingNumber[0]}}</div>
                            </div>
                        </div>
                            <hr>
                            <div class="row">
                                <div class="col">
                                    <label>Permissions:</label>
                                    <b-form-checkbox value="active" v-model="deliveryO.active">Active</b-form-checkbox>
                                </div>
                            </div>
                        <div class="modal-footer">
                            <button @click="function(){deliveryO={};edit=false;errors=[]}" type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                            <button v-if="edit" @click="updatDelivery(deliveryO.id)" type="button" class="btn btn-success">Update</button>
                            <button v-if="!edit" @click="addDelivery()" type="button" class="btn btn-success">Add</button>
                        </div>
                    </form>

                </div>

            </div>
        </div>

    </div>
</template>

<script>
    export default {
        name: "deliverysTable",
        data() {
            return {
                deliverys:[],
                deliveryO:{
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
                    active:'',
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
            this.fetchDeliverys();
        },
        methods:{
            fetchDeliverys(page_url) {
                let vm = this;
                page_url = page_url || '/api/admin/delivery';
                fetch(page_url)
                    .then(res => res.json())
                    .then(res => {
                        this.deliverys = res.data;
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
            deleteDelivery(id) {
                fetch('/api/admin/delivery/'+id, {
                    method: 'delete'
                })
                    .then(data => {
                        this.fetchDeliverys();
                        $("#deleteModal").modal( 'hide' ).data( 'bs.modal', null );
                        $( '.modal-backdrop' ).remove();
                        this.makeToast(
                            'success',
                            'The delivery [ '+this.deliveryO.name+' ] was deleted',
                            'Delete successfully');
                        this.deliveryO={};
                    })
                    .catch(err => {
                        this.makeToast(
                            'danger',
                            'An error occurred, process did not complete',
                            '');
                        console.log(err)
                    });
            },
            editDelivery(delivery){
                this.edit=true;
                this.deliveryO.id=delivery.id;
                this.deliveryO.name=delivery.name;
                this.deliveryO.email=delivery.email;
                this.deliveryO.id_number=delivery.id_number;
                this.deliveryO.phone=delivery.phone;
                this.deliveryO.birthDate=delivery.birthDate;
                this.deliveryO.notes=delivery.notes;
                this.deliveryO.city=delivery.city;
                this.deliveryO.area=delivery.area;
                this.deliveryO.street=delivery.street;
                this.deliveryO.buildingNumber=delivery.buildingNumber;
                this.deliveryO.active= delivery.permissions.filter(el=>el.name === 'active').map(el=>el.name) =='active'?'active':false;
            },
            updatDelivery(id){
                this.errors=[];
                axios.patch('/api/admin/delivery/'+id,this.deliveryO)
                    .then(data => {
                        this.fetchDeliverys();
                        $("#formModal").modal( 'hide' ).data( 'bs.modal', null );
                        $( '.modal-backdrop' ).remove();
                        this.makeToast(
                            'success',
                            'The delivery was updated',
                            'Update successfully');
                        this.deliveryO={};
                    })
                    .catch(err => {
                        if (err.response.status == 422){
                            this.errors = err.response.data.errors;
                        }
                    });
            },
            addDelivery(){
                this.errors=[];
                axios.post('/api/admin/delivery',this.deliveryO)
                    .then(data => {
                        this.fetchDeliverys();
                        $("#formModal").modal( 'hide' ).data( 'bs.modal', null );
                        $( '.modal-backdrop' ).remove();
                        this.makeToast(
                            'success',
                            'The delivery was added',
                            'Add successfully');
                        this.edit=false;
                        this.deliveryO={};
                    })
                    .catch(err => {
                        if (err.response.status == 422){
                            this.errors = err.response.data.errors;
                        }
                    });
            },
            searchDelivery(){
                fetch('/api/admin/searchDelivery', {
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
