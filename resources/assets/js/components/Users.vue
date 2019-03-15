<template>
    <div class="container">
        <div class="row mt-5">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header">
                        <h3 class="table-title">Users Table</h3>

                        <div class="card-tools">
                            <button class="btn btn-success btn-sm" data-toggle="modal" @click="newModal"><i class="fas fa-user-plus"> Add User</i> </button>
                        </div>
                    </div>
                    <!-- /.card-header -->
                    <div class="card-body table-responsive p-0">
                        <table class="table table-hover">
                            <thead>
                                <tr>
                                    <th>ID</th>
                                    <th>Name</th>
                                    <th>Email</th>
                                    <th>Bio</th>
                                    <th>Registered At</th>
                                    <th>Status</th>
                                    <th>Modify</th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr v-for="user in users" :key="user.id">
                                    <td>{{user.id}}</td>
                                    <td>{{user.name}}</td>
                                    <td>{{user.email}}</td>
                                    <td>{{user.bio}}</td>
                                    <td>{{user.created_at | filterDate}}</td>
                                    <td>{{user.status == 1 ? 'Admin' : 'Standard user'}}  </td>
                                    <td class="form-inline">
                                        <button class="btn btn-primary btn-sm" @click="editModal(user)"><i class="fas fa-user-edit"></i></button>&nbsp;
                                        <button class="btn btn-danger btn-sm" @click="deleteUser(user.id)"><i class="fas fa-user-times"></i></button>
                                    </td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                </div>
          </div>
        </div>
        <div class="modal fade" id="addNewUser" tabindex="-1" role="dialog" aria-labelledby="addNewUserModal" aria-hidden="true">
            <div class="modal-dialog modal-dialog-centered" role="document">
                <div class="modal-content">
                <div class="modal-header">
                    <h5 v-show="!editmode" class="modal-title" id="addNewUserModal">Add User</h5>
                    <h5 v-show="editmode" class="modal-title" id="addNewUserModal">Update User</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <form @submit.prevent="editmode ? updateUser() : createUser()">
                    <div class="modal-body">
                        <div class="row">
                            <div class="col-md-12">
                                <div class="form-group">
                                    <input v-model="form.name" type="text" name="name" placeholder="Name" class="form-control" :class="{ 'is-invalid': form.errors.has('name') }">
                                    <has-error :form="form" field="name"></has-error>
                                </div>
                                <div class="form-group">
                                    <input v-model="form.email" type="email" name="email" placeholder="Email Address" class="form-control" :class="{'is-invalid' : form.errors.has('email')}">
                                    <has-error :form="form" field="email"></has-error>
                                </div>
                                <div class="form-group">
                                    <textarea v-model="form.bio" name="bio" rows="3" placeholder="(optional) Add skills" class="form-control" :class="{'is-invalid' : form.errors.has('bio')}"></textarea>
                                    <has-error :form="form" field="bio"></has-error>
                                </div>
                                <div class="form-group">
                                    <select v-model="form.status" name="status" class="form-control form-control-lg" :class="{ 'is-invalid': form.errors.has('status') }">
                                        <option value="1">Admin</option>
                                        <option value="2">Standard User</option>
                                    </select>
                                    <has-error :form="form" field="status"></has-error>
                                </div>
                                <div class="form-group">
                                    <input v-model="form.password" type="password" class="form-control" placeholder="Password" :class="{'is-invalid' : form.errors.has('password')}">
                                    <has-error :form="form" field="password"></has-error>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                        <button v-show="!editmode" type="submit" class="btn btn-primary">Add</button>
                        <button v-show="editmode" type="submit" class="btn btn-primary">Update</button>
                    </div>
                </form>
                </div>
            </div>
        </div>
    </div>
</template>

<script>
    export default {
        data () {
            return {
                editmode: false,
                users: {},
                errors: [],
                form: new Form({
                    id: '',
                    name: '',
                    email: '',
                    password: '',
                    bio: '',
                    status: 1
                })
            }
        },
        methods: {
            editModal(user) {   
                this.form.reset();
                this.editmode = true;
                this.form.fill(user);
                $('#addNewUser').modal('show');
            },
            newModal() {
                this.form.reset();
                this.editmode = false;
                $('#addNewUser').modal('show');
            },
            loadUsers() {
                axios.get('api/user')
                .then(response => {
                    this.users = response.data.data;
                })
            },
            createUser() {
                this.$Progress.start();
                this.form.post('api/user')
                .then(function (response) {
                    if(response.data.id != null) {
                        $('#addNewUser').modal('hide');
                        Fire.$emit('loadAllUsers');
                        Toast.fire({
                            type: 'success',
                            title: 'User Created Successfully'
                        })
                        this.$Progress.finish();
                    }
                })
                .catch((error) => {})
            },
            updateUser() {
                this.$Progress.start();
                this.form.put('api/user/'+ this.form.id)
                .then((response) => {
                    $('#addNewUser').modal('hide');
                    Fire.$emit('loadAllUsers');
                    Toast.fire({
                        type: 'success',
                        title: 'User Updated Successfully'
                    })
                    this.$Progress.finish();
                })
                .catch(() => {
                    this.$Progress.fail();
                })
            },
            deleteUser(id) {
                this.$Progress.start();
                Swal.fire({
                    title: 'Are you sure?',
                    text: "You won't be able to revert this!",
                    type: 'warning',
                    showCancelButton: true,
                    confirmButtonColor: '#3085d6',
                    cancelButtonColor: '#d33',
                    confirmButtonText: 'Yes, delete it!'
                })
                .then((result) => {
                    this.$Progress.start()
                        this.form.delete('api/user/'+id)
                        .then(()=> {
                            Swal.fire(
                            'Deleted',
                            'Record has been deleted',
                            'success'
                            )
                            Fire.$emit('loadAllUsers');
                        })
                    this.$Progress.finish()
                })
                .catch(() => {
                    swal(
                        "Failed!",
                        "There was something wrong",
                        "warning"
                    )
                })
            }
        },
        filters :{
            capitalize : function (value) {
                value = value.toString();
                return value.charAt(0).toUpperCase() + value.slice(1);                
            },
            filterDate: function (date) {
               return moment(date).format('MMMM Do YYYY, h:mm:ss a');
            }
        },
        created() {
            this.loadUsers();
            Fire.$on('loadAllUsers', () => {
                this.loadUsers();
            })
        }
    }
</script>
