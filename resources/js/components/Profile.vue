
<style type="text/css">
    .widget-user-header{
       background-position: center center; 
       background-size: cover;
       height:180px !important;

    }
    .widget-user .widget-user-image > img {
       height:100px !important;
       width:100px !important;
    }
</style>
<template>
	
    <div class="container">
        <div class="row justify-content-center">
            <!-------------------Profile----------------->
            <div class="col-md-12 mt-5">
                
                    <!-- Widget: user widget style 1 -->
                    <div class="card card-widget widget-user">
                      <!-- Add the bg color to the header using any of the bg-* classes -->
                      <div class="widget-user-header text-white" style="background-image:url('/img/bgg4.jpg')">
                        <h3 class="widget-user-username ">{{form.name}}</h3>
                        <h5 class="widget-user-desc">{{form.bio}}</h5>
                      </div>
                      <div class="widget-user-image">
                        <img class="img-circle" :src="userprofile" alt="User Avatar">
                      </div>
                      <div class="card-footer navblue">
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
                            <!-- /.description-block -->
                          </div>
                          <!-- /.col -->
                          <div class="col-sm-4">
                            <div class="description-block">
                              <h5 class="description-header">35</h5>
                              <span class="description-text">PRODUCTS</span>
                            </div>
                            <!-- /.description-block -->
                          </div>
                          <!-- /.col -->
                        </div>
                        <!-- /.row -->
                      </div>
                    
                    <!-- /.widget-user -->
                  </div>
            </div>
            <!--------------------Profile-------------->

            <div class="col-md-12">
            <div class="card">
              <div class="card-header p-2">
                <ul class="nav nav-pills">
                  <li class="nav-item"><a class="nav-link" href="#activity" data-toggle="tab">Activity</a></li>
                 
                  <li class="nav-item"><a class="nav-link active show" href="#settings" data-toggle="tab">Settings</a></li>
                </ul>
              </div><!-- /.card-header -->
              <div class="card-body">
                <div class="tab-content">
                  <div class="tab-pane" id="activity">
                    <!-- Post -->
                    <div class="post">
                      <div class="user-block">
                        <img class="img-circle img-bordered-sm" src="/img/cele2.jpg" alt="user image">
                        <span class="username">
                          <a href="#">Jonathan Burke Jr.</a>
                          <a href="#" class="float-right btn-tool"><i class="fa fa-times"></i></a>
                        </span>
                        <span class="description">Shared publicly - 7:30 PM today</span>
                      </div>
                      <!-- /.user-block -->
                      <p>
                        Lorem ipsum represents a long-held tradition for designers,
                        typographers and the like. Some people hate it and argue for
                        its demise, but others ignore the hate as they create awesome
                        tools to help create filler text for everyone from bacon lovers
                        to Charlie Sheen fans.
                      </p>

                      <p>
                        <a href="#" class="link-black text-sm mr-2"><i class="fa fa-share mr-1"></i> Share</a>
                        <a href="#" class="link-black text-sm"><i class="fa fa-thumbs-o-up mr-1"></i> Like</a>
                        <span class="float-right">
                          <a href="#" class="link-black text-sm">
                            <i class="fa fa-comments-o mr-1"></i> Comments (5)
                          </a>
                        </span>
                      </p>

                      <input class="form-control form-control-sm" type="text" placeholder="Type a comment">
                    </div>
                    <!-- /.post -->

 
                  </div>
                 

                  <div class="tab-pane active show" id="settings">
                    <form class="form-horizontal" enctype="multipart/form-data">
                       
                      <div class="modal-body">
                        
                            <!---- Name------>
                        <div class="form-group">
                          <label for="name">Name</label>
                          <input v-model="form.name" type="text" name="name" placeholder="UserName"
                            class="form-control" :class="{ 'is-invalid': form.errors.has('name') }">
                          <has-error :form="form" field="name"></has-error>
                        </div>
                        <!---- Name------>

                        <!---- Email------>
                        <div class="form-group">
                            <label for="email">Email</label>
                        <input v-model="form.email" type="text" name="email" placeholder="Email"
                            class="form-control" :class="{ 'is-invalid': form.errors.has('email') }">
                          <has-error :form="form" field="email"></has-error>
                        </div>
                        <!---- Email------>

                        <!---- Bio------>
                        <div class="form-group">
                            <label for="bio">Experience</label>
                        <textarea v-model="form.bio" type="text" name="bio" placeholder="Experience"
                            class="form-control" :class="{ 'is-invalid': form.errors.has('bio') }">
                        </textarea>
                          <has-error :form="form" field="bio"></has-error>
                        </div>
                        <!---- Bio------>



                        <!---------Photo-------->
                        <div class="form-group">
                            <label for="photo">Image</label>
                            <div class="input-group">
                              <div class="custom-file">
                                <input type="file" class="custom-file-input" id="photo"
                                 @change="updateProfile"
                                >
                                <label class="custom-file-label" for="photo">Choose Image</label>
                              </div>
                              
                            </div>
                          </div>
                  <!---------Photo-------->

                        <!---- Password------>
                        <div class="form-group">
                          <label for="password">Password</label>
                          <input v-model="form.password" type="password" name="password" placeholder="Password" @keydown.space.prevent
                            class="form-control" :class="{ 'is-invalid': form.errors.has('password') }">
                          <has-error :form="form" field="password"></has-error>
                        </div>
                        <!---- Password------>

                        
                      
                      </div>
                      <div class="modal-footer">
                        
                        <button type="submit" class="btn btn-primary btn-block" @click.prevent="updateInfo">Update</button>
                      </div>

              
                    </form>
                  </div>
                  <!-- /.tab-pane -->
                </div>
                <!-- /.tab-content -->
              </div><!-- /.card-body -->
            </div>
            <!-- /.nav-tabs-custom -->
          </div>
        </div>
    </div>
</template>



<script>
    export default {
        data(){
            return {
                userprofile:'',
                form:new form({
                       id:'',
                      name: '',
                      email:'',
                      password: '',
                      type: '',
                      bio: '',
                      photo:'',
                })

            }
        },
        created() {
          
        
           this.getInfo();

           EventBus.$on('profileUpdated',()=>{
            this.getInfo();
           })


        },
        methods:{
            updateProfile(e){
                 

               var file = e.target.files[0];
               // console.log(file)
               var reader = new FileReader();
               if(file['size']<2111775){
                reader.onloadend = (file)=> {
               // console.log('RESULT', reader.result)
                this.form.photo=reader.result;
               }
               reader.readAsDataURL(file);

               }else{
                  toast.fire({
                  type: 'error',
                  title: 'Your image is more than 2MB',
                    })
               }
               
               
             
              
            },
            updateInfo(){
                this.$Progress.start()
                this.form.put('api/profile')
                .then(res=>{
                  
                   toast.fire({
                  type: 'success',
                  title: res.data.message,
                    })
                  this.$Progress.finish();
                  EventBus.$emit('profileUpdated')
                })
                .catch(err=>{
                    this.$Progress.fail();
                })
            },
            getInfo(){
                 axios.get('/api/profile')
                 .then(res=>{this.form.fill(res.data)
                 this.userprofile='/img/profile/'+res.data.photo})

            }
        },
        
    }
</script>
