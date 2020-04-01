<template>
    <div class="container">
    <table class="table table-responsive  table-striped table-light">
        <thead class="">
        <tr>
            <th scope="col">#</th>
            <th scope="col">Email</th>
            <th scope="col">Description</th>
            <th scope="col">Action</th>
            <th scope="col" style="width: 100px">Created at</th>
        </tr>
        </thead>
        <tbody>
        <tr v-for="request in requests" v-bind:key="requests.id">
            <td></td>
            <td>{{request.email}}</td>
            <td>{{request.description}}</td>
            <td>
                <div class="btn-group mr-2" role="group" aria-label="First group">
                    <button v-if="request.important == 0" @click="updateRequest(request.id,request.important)" class="btn btn-dark btn-sm" style="width: 50px">
                        <i  style="color: white" class="fas fa-star"></i>
                    </button>
                    <button v-if="request.important == 1" @click="updateRequest(request.id,request.important)" class="btn btn-dark btn-sm" style="width: 50px">
                        <i  style="color: gold" class="fas fa-star"></i>
                    </button>
                    <button @click="request_id = request.id" data-toggle="modal" data-target="#deleteModal"
                            class="btn btn-danger btn-sm"style="width: 50px"><b-icon-trash></b-icon-trash></button>
                </div>
            </td>
            <td  style="width: 180px">{{request.created_at}}</td>
        </tr>
        </tbody>
    </table>
        <div class="modal fade" id="deleteModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <div class="modal-body">
                        <h4>Are you sure delete ?</h4>
                    </div>
                    <div class="modal-footer">
                        <button @click="request_id =''" type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                        <button  @click="deleteRequest(request_id)" class="btn btn-danger">I'am sure, Delete</button>
                    </div>
                </div>
            </div>
        </div>
    </div>
</template>

<script>
    export default {
        name: "requestsTable",
        data(){
            return{
                requests:[],
                pagination:[],
                request_id:'',
                isImportant:false
            }
        },
        created() {
            this.fetchRequests();
        },
        methods:{
            fetchRequests(page_url){
                page_url = page_url || '/api/admin/requests';
                axios.get(page_url)
                .then(res=>{
                    this.requests=res.data;
/*
                    this.makePagination(res.data);
*/
                })
                .catch(err => console.log(err));
                },
/*            makePagination(res) {
                let pagination = {
                    current_page: res.current_page,
                    last_page: res.last_page,
                    total:res.total,
                    next_page_url: res.next_page_url,
                    prev_page_url: res.prev_page_url
                };
                this.pagination = pagination;
            },*/
            updateRequest(id,isImportant){
                axios.patch("/api/admin/requests/"+id,{isImportant:isImportant})
                    .then(res=> {
                        this.fetchRequests();
                    })
                    .catch(errors=>{
                        console.log(errors)}
                        );
            },
            deleteRequest(id){
                axios.delete("/api/admin/requests/"+id)
                    .then(res=> {
                        this.fetchRequests();
                            $("#deleteModal").modal('hide').data('bs.modal', null);
                            $('.modal-backdrop').remove();
                        request_id ='';
                    })
                    .catch(errors=> {
                        console.log(errors)
                    });
            },
        },
    }
</script>

<style scoped>
    .column{
        width: 55px
    }
</style>
