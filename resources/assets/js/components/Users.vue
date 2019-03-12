<template>
    <div class="container">
        <div class="row mt-5">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header">
                        <h3 class="table-title">Users Table</h3>

                        <div class="card-tools">
                            <button class="btn btn-success btn-sm" data-toggle="modal" data-target="#addNewUser"><i class="fas fa-user-plus"> Add User</i> </button>
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
                                    <td>{{user.status == 1 ? 'Admin' : 'Standard user'}}  </td>
                                    <td class="form-inline">
                                        <button class="btn btn-primary btn-sm"><i class="fas fa-user-edit"></i></button>&nbsp;
                                        <button class="btn btn-danger btn-sm"><i class="fas fa-user-times"></i></button>
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
                    <h5 class="modal-title" id="addNewUserModal">Add User</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <form @submit.prevent="createUser">
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
                        <button type="submit" class="btn btn-primary">Save changes</button>
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
                users: {},
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
            loadUsers() {
                axios.get('api/user')
                    .then(response => {
                        this. users = response.data.data;
                    })
            },
            createUser() {
                this.form.post('api/user');      
            }
        },
        created() {
            this.loadUsers();
        }
    }
</script>
