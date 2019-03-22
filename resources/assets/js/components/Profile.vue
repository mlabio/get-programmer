<template>
    <div class="container">
        <div class="row">
            <div class="col-md-12">
                <div class="card card-widget widget-user">
                    <div class="widget-user-header bg-info-active">
                        <h3 class="widget-user-username">Alexander Pierce</h3>
                        <h5 class="widget-user-desc">Founder &amp; CEO</h5>
                    </div>
                    <div class="widget-user-image">
                        <img class="img-circle elevation-2" src="img/boy.png" alt="User Avatar">
                    </div>
                    <div class="card-footer">
                        <div class="row">
                        <div class="col-sm-4 border-right">
                            <div class="description-block">
                            <h5 class="description-header">3,200</h5>
                            <span class="description-text">SALES</span>
                            </div>
                            <!-- /.description-block -->
                        </div>
                        <!-- /.col -->
                        <div class="col-sm-4 border-right">
                            <div class="description-block">
                            <h5 class="description-header">13,000</h5>
                            <span class="description-text">FOLLOWERS</span>
                            </div>
                        </div>
                        <div class="col-sm-4">
                            <div class="description-block">
                            <h5 class="description-header">35</h5>
                            <span class="description-text">PRODUCTS</span>
                            </div>
                        </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-md-12">
                <div class="row">
                    <div class="col-md-3">
                        <div class="box box-primary">
                            <div class="box-header with-border">
                                <h3 class="box-title">About Me</h3>
                            </div>
                            <div class="box-body">
                                <strong><i class="fa fa-book margin-r-5"></i> Education</strong>

                                <p class="text-muted">
                                    B.S. in Computer Science from the University of Tennessee at Knoxville
                                </p>

                                <hr>

                                <strong><i class="fa fa-map-marker margin-r-5"></i> Location</strong>

                                <p class="text-muted">Malibu, California</p>

                                <hr>

                                <strong><i class="fas fa-pencil-alt"></i> Skills</strong>
                                <p class="text-muted">
                                    <span class="label label-info col-sm-3" v-for="skill in currentSkills" :key="skill.id">
                                        {{skill.skill_name}}
                                    </span>
                                </p>                              
                            </div>
                        </div>
                    </div>
                    <div class="col-md-9">
                        <div class="nav-tabs-custom">
                            <ul class="nav nav-tabs">
                                <li class=""><a href="#skills" data-toggle="tab">Skills</a></li>
                                <li class="active"><a href="#projects" data-toggle="tab">Porfolio/Projects</a></li>
                            </ul>
                            <div class="tab-content">
                                <div class="tab-pane" id="skills">
                                    <div class="card">
                                        <div class="card-header">
                                            <h3>
                                                Your Skills
                                            </h3>
                                        </div>
                                        <form @submit.prevent="addUserSkills">
                                            <div class="card-body">
                                                <div class="form-group">
                                                    <multiselect v-model="skillSelected" 
                                                                placeholder="Select Skills" 
                                                                label="skill_name" 
                                                                track-by="id" 
                                                                :options="options" 
                                                                :multiple="true">
                                                    </multiselect>
                                                </div>
                                            </div>
                                            <div class="card-footer">
                                                <button type="submit" class="btn btn-primary">Add Skill</button>
                                            </div>
                                        </form>
                                    </div>
                                </div>
                                <div class="active tab-pane" id="projects">
                                    <div class="card">
                                        <div class="card-header">
                                            <button class="btn btn-primary" data-toggle="modal" @click="newProject"><i class="fas fa-plus-square"> Add Project</i></button>
                                        </div>
                                        <div class="card-body">
                                            <div id="accordion">
                                            
                                                <div class="card card-primary">
                                                    <div class="card-header">
                                                    <h4 class="card-title">
                                                        <a data-toggle="collapse" data-parent="#accordion" href="#collapseOne">
                                                        Collapsible Group Item #1
                                                        </a>
                                                    </h4>
                                                    </div>
                                                    <div id="collapseOne" class="panel-collapse collapse">
                                                    <div class="card-body">
                                                        Anim pariatur cliche reprehenderit, enim eiusmod high life accusamus terry richardson ad squid.
                                                        3
                                                        wolf moon officia aute, non cupidatat skateboard dolor brunch. Food truck quinoa nesciunt
                                                        laborum
                                                        eiusmod. Brunch 3 wolf moon tempor, sunt aliqua put a bird on it squid single-origin coffee
                                                        nulla
                                                        assumenda shoreditch et. Nihil anim keffiyeh helvetica, craft beer labore wes anderson cred
                                                        nesciunt sapiente ea proident. Ad vegan excepteur butcher vice lomo. Leggings occaecat craft
                                                        beer
                                                        farm-to-table, raw denim aesthetic synth nesciunt you probably haven't heard of them accusamus
                                                        labore sustainable VHS.
                                                    </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <!-- /.card-body -->
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="modal fade" id="addNewProject" tabindex="-1" role="dialog" aria-labelledby="addNewProjectlabel" aria-hidden="true">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="addNewProjectlabel" v-show="!editmode">New Project</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <form @submit.prevent="addNewProject"></form>
                    <div class="modal-body">
                        <div class="row">
                            <div class="col-md-12">
                                <div class="form-group">
                                    <input type="text" name="project_name" class="form-control" placeholder="Project Name">
                                </div>
                                <div class="form-group">
                                    <textarea name="project_description" rows="10" class="form-control" placeholder="Project Description"></textarea>
                                </div>
                                <div class="form-group">
                                   <textarea name="project_tools" rows="10" class="form-control" placeholder="Tools and Technologies used"></textarea> 
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                        <button v-show="!editmode"  type="submit" class="btn btn-primary">Add</button>
                    </div>
                </div>
            </div>
        </div>
    </div>
</template>

<style scoped>
    .color-palette {
      height: 35px;
      line-height: 35px;
      text-align: center;
    }
</style>


<script>
    export default {
        data () {
            return {
                skillSelected: null,
                editmode: false,
                options: [],
                userSkills:{
                    id: '',
                    user_id: 1,
                    skills: []
                },
                currentSkills: {},
                skillsArr: []   
            }
        },
        created () {
            this.loadAllSkills();
            this.loadUserSkills();
            this.getSomething();

            Fire.$on('loadAllSkills', function () {
                this.loadAllSkills();
            })
            Fire.$on('loadAllUserSkills', () => {
                this.loadUserSkills();
            })
        },
        methods : {
            getSomething() {
                axios.get('api/custom');
            },
            loadAllSkills() {
                axios.get('api/admin-settings/'+ this.userSkills.user_id)
                .then((response) => {
                    this.options = response.data;
                })
            },
            loadUserSkills() {
                axios.get('api/profile/' + this.userSkills.user_id)
                .then((response) => {
                    this.currentSkills = response.data.user_skill;
                })
            },
            addUserSkills() {
                this.userSkills.skills = this.skillSelected;
                
                axios.post('api/profile', this.userSkills)
                .then((response) => {
                    Toast.fire({
                        type: 'success',
                        title: 'Successfully added User Skills'
                    })
                    this.skillSelected = null;
                    Fire.$emit('loadAllUserSkills');
                    Fire.$emit('loadAllSkills');
                })
            },
            newProject() {
                this.editmode = false;
                $('#addNewProject').modal('show');
            }
        },
        mounted () {
        }
    }
</script>
