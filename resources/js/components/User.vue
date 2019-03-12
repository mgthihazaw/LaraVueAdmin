<template>
	
    <div class="container-fluid">
        <div class="col-md-12 mt-4">
            <div class="card">
              <div class="card-header">
                <h3 class="card-title">
                User Table</h3>

                <div class="card-tools">
               
                  
                <button 
                type="button" class="btn btn-success" data-toggle="modal" data-target="#addNewModal">Add New <i class="fa fa-user-plus"></i></button>                   
                  
                </div>
              </div>
              <!-- /.card-header -->
              <div class="card-body table-responsive p-0">
                <table class="table table-hover">
                  <tbody><tr>
                    <th>ID</th>
                    <th>User Name</th>
                    <th>Email</th>
                    <th>Type</th>
                    <th>Register_at </th>
                    <th>Action</th>
                  </tr>
                  
                  <tr v-for="(user,index) in users.data" :keys="user.id">
                    <td>{{index+1}}</td>
                    <td>{{user.name | upText}}</td>
                    <td>{{user.email }}</td>
                    <td><span class="tag tag-success">{{user.type | upText}}</span></td>
                    <td>{{user.created_at | myDate}}</td>
                    <td>
                    	<a href="">
                    		<i class="fa fa-edit fa-1x success "></i>
                    	</a>
                      /
                    	<a href="">
                    		<i class="fa fa-trash fa-1x red "></i>
                    	</a>
                    </td>
                  </tr>

                  
                </tbody></table>
              </div>
              <!-- /.card-body -->
            </div>
            <!-- /.card -->
          </div>


          <!------------------Modal------------------->
          <div class="modal fade" id="addNewModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalScrollableTitle" aria-hidden="true">
		  <div class="modal-dialog modal-dialog-scrollable" role="document">
		    <div class="modal-content">
		      <div class="modal-header">
		        <h5 class="modal-title" id="exampleModalScrollableTitle">Add New User</h5>
		        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
		          <span aria-hidden="true">&times;</span>
		        </button>
		      </div>

		      <form @submit.prevent="createUser">
		      <div class="modal-body">
		        
		        	<!---- Name------>
			    <div class="form-group">
			      
			      <input v-model="form.name" type="text" name="name" placeholder="UserName"
			        class="form-control" :class="{ 'is-invalid': form.errors.has('name') }">
			      <has-error :form="form" field="name"></has-error>
			    </div>
			    <!---- Name------>

                <!---- Email------>
                <div class="form-group">
			    <input v-model="form.email" type="text" name="email" placeholder="Email"
			        class="form-control" :class="{ 'is-invalid': form.errors.has('email') }">
			      <has-error :form="form" field="email"></has-error>
			    </div>
                <!---- Email------>

                <!---- Bio------>
                <div class="form-group">
			    <textarea v-model="form.bio" type="text" name="bio" placeholder="Short Bio for user(optinal"
			        class="form-control" :class="{ 'is-invalid': form.errors.has('bio') }">
			    </textarea>
			      <has-error :form="form" field="bio"></has-error>
			    </div>
                <!---- Bio------>

                 <!---- Type------>
                <div class="form-group">
			       <select name="type" v-model="form.type" id="type" class="form-control" :class="{ 'is-invalid': form.errors.has('type') }">
			       	<option value="">Select User Role</option>
			       	<option value="admin">Admin</option>
			       	<option value="user">Standard</option>
			       	<option value="author">Author</option>
			       </select>
			       <has-error :form="form" field="type"></has-error>
			    </div>
                <!---- Type------>

                <!---- Password------>
			    <div class="form-group">
			      
			      <input v-model="form.password" type="password" name="password" placeholder="Password"
			        class="form-control" :class="{ 'is-invalid': form.errors.has('password') }">
			      <has-error :form="form" field="password"></has-error>
			    </div>
			    <!---- Password------>

			    
			  
		      </div>
		      <div class="modal-footer">
		        <button type="button" class="btn btn-danger" data-dismiss="modal">Close</button>
		        <button type="submit" class="btn btn-success">Save</button>
		      </div>

		      </form>

		    </div>
		  </div>
		</div>
<!------------------Modal------------------->
    </div>



</template>



<script>
    export default {
    	data(){
    		return {
    			users:[],
                form:new form({
                	  name: '',
                	  email:'',
				      password: '',
				      type: '',
				      bio: '',
				      photo:'',
                })
    		}
    	},
    	methods:{
    		loadUsers(){
              axios.get('api/user')
              .then(res=>{
              	this.users=res.data
              	
              })
    		},
          createUser(){
          	this.$Progress.start()
          	this.form.post('/api/user')
        .then(res => {
         this.users.data.unshift(res.data)
         if(this.users.data.length>=10){
         	this.users.data.splice(10,1)
         }
         this.$Progress.finish();
         $('#addNewModal').modal('hide'); 
         toast.fire({
		  type: 'success',
		  title: 'User created successfully'
		})
         
       })


    
          }
    	},
        created() {
            this.loadUsers();
        }
    }
</script>