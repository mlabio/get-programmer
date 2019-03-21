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

                                <strong><i class="fa fa-pencil margin-r-5"></i> Skills</strong>
                                <p>
                                    <span class="label label-danger">UI Design</span>
                                    <span class="label label-success">Coding</span>
                                    <span class="label label-info">Javascript</span>
                                    <span class="label label-warning">PHP</span>
                                    <span class="label label-primary">Node.js</span>
                                </p>

                                <hr>

                                <strong><i class="fa fa-file-text-o margin-r-5"></i> Notes</strong>

                                <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Etiam fermentum enim neque.</p>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-9">
                        <div class="nav-tabs-custom">
                            <ul class="nav nav-tabs">
                                <li class="active"><a href="#skills" data-toggle="tab">Skills</a></li>
                                <li><a href="#projects" data-toggle="tab">Porfolio/Projects</a></li>
                            </ul>
                            <div class="tab-content">
                                <div class="active tab-pane" id="skills">
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
                                                                :close-on-select="false"
                                                                :options="options" 
                                                                :multiple="true">
                                                    </multiselect>
                                                </div>
                                            </div>
                                            <div class="card-footer">
                                                <button type="submit" class="btn btn-primary">Save Changes</button>
                                            </div>
                                        </form>
                                    </div>
                                    <div class="card card-info">
                                        <div class="card-header">
                                            <h4>Skills</h4>
                                        </div>
                                        <div class="card-body">
                                            <div class="card">
                                               <div class="card-body" v-for="skill in currentSkills" :key="skill.id">
                                                   <div class="card-header">
                                                        <h3 class="card-title">
                                                            {{skill.skill_name}}
                                                        </h3>
                                                   </div>
                                               </div>
                                            </div>  
                                        </div>
                                    </div>
                                </div>
                                <div class="tab-pane" id="projects">
                                    
                                </div>
                            </div>
                        </div>
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
                skillSelected: {},
                options: [],
                userSkills:{
                    id: '',
                    user_id: 1,
                    skills: []
                },
                currentSkills: {}   
            }
        },
        created () {
            this.loadAllSkills();
            this.loadUserSkills();

            Fire.$on('loadAllUserSkills', () => {
                this.loadUserSkills();
            })
        },
        methods : {
            loadAllSkills() {
                axios.get('api/admin-settings')
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
                    this.skillSelected = {};
                    Fire.$emit('loadAllUserSkills');
                    
                })
            }
        },
        mounted () {
        }
    }
</script>
