<template>
    <div class="container">
        <div class="row">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header d-flex p-0">
                        <h3 class="card-title p-3">Admin Settings</h3>
                        <ul class="nav nav-pills ml-auto p-2">
                            <li class="nav-item">
                                <a class="nav-link" href="#skills" data-toggle="tab">Skills</a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link" href="#tab_2" data-toggle="tab">Tab 2</a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link" href="#tab_3" data-toggle="tab">Tab 3</a>
                            </li>
                        </ul>
                    </div>
                    <div class="card-body">
                        <div class="tab-content">
                            <div class="tab-pane active" id="skills">
                                <button class="btn btn-success" data-toggle="modal" @click="newSkill"><i class="fas fa-plus-square"> Add Skill</i></button>
                                <div class="card">
                                    <div class="card-header">
                                        <h3 class="card-title"></h3>
                                    </div>
                                    <!-- /.card-header -->
                                    <div class="card-body p-0">
                                        <table class="table table-striped">
                                            <tbody>
                                                <tr>
                                                    <!-- <th style="width: 10px">#</th> -->
                                                    <th>Skill</th>
                                                    <th>Modify</th>
                                                </tr>
                                                <tr v-for="skill in skills" :key="skill.id">
                                                    <!-- <td>{{skill.id}}</td> -->
                                                    <td>{{skill.skill_name}}</td>
                                                    <td>
                                                        <button class="btn btn-primary btn-sm" @click="editSkill(skill)"><i class="fas fa-edit"></i></button>
                                                        <button class="btn btn-danger btn-sm" @click="deleteSkill(skill.id)"><i class="fas fa-trash"></i></button>
                                                    </td>
                                                </tr>
                                            </tbody>
                                        </table>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="modal fade" id="addNewSkill" tabindex="-1" role="dialog" aria-labelledby="addNewSkillModal" aria-hidden="true">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                <div class="modal-header">
                    <h5 v-show="!editmode" class="modal-title" id="addNewSkillModal">New Skill</h5>
                    <h5 v-show="editmode" class="modal-title" id="addNewSkillModal">Update Skill</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <form @submit.prevent="editmode ? updateSkill() : createSkill()">
                    <div class="modal-body">
                        <div class="row">
                            <div class="col-md-12">
                                <div class="form-group">
                                    <input v-model="skill.skill_name" type="text" name="skill_name" class="form-control" placeholder="Skill Name">
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
        data() {
            return {
                editmode: false,
                skills: {},
                skill : new Form({
                    id: '',
                    skill_name: ''
                }) 
            }
        },
        created() {
            this.loadSkills();
            Fire.$on('loadAllSkills', () => {
                this.loadSkills();
            })
        },
        methods: {
            loadSkills() {
                axios.get('api/admin-settings')
                .then((response) => {
                    this.skills = response.data;
                })
            },
            editSkill(user) {
                this.skill.reset();
                this.editmode = true;
                this.skill.fill(user);
                $('#addNewSkill').modal('show');
            },
            newSkill() {
                this.skill.reset();
                this.editmode = false;
                $('#addNewSkill').modal('show');
            },
            createSkill() {
                this.$Progress.start();
                    this.skill.post('api/admin-settings')
                    .then(function (response) {
                        $('#addNewSkill').modal('hide');
                        Toast.fire({
                            type: 'success',
                            title: 'Skill Created Successfully'
                        })
                        Fire.$emit('loadAllSkills');
                        this.$Progress.finish();
                    })
                    .catch(() => {

                    })
                this.$Progress.finish();
            },
            updateSkill() {
                this.$Progress.start()
                    this.skill.put('api/admin-settings/' + this.skill.id)
                    .then((response) => {
                        $('#addNewSkill').modal('hide');
                        Toast.fire({
                            type:'success',
                            title :'Skill Updated Successfully'
                        })
                        Fire.$emit('loadAllSkills');
                        this.$Progress.finish();
                    })
                    .catch((error) => {

                    })
                this.$Progress.finish();
            },
            deleteSkill(id) {
                
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
                        this.skill.delete('api/admin-settings/' + id)
                        .then((response) => {
                            Toast.fire({
                                type: 'success',
                                title: 'Record Deleted Successfully'
                            })
                            Fire.$emit('loadAllSkills');
                        })
                    })
                    .catch((error) => {
                        swal(
                            "Failed!",
                            "There was something wrong",
                            "warning"
                        )
                    })
                    
                this.$Progress.finish();
            }
        },
        mounted() {
            
        }
    }
</script>
