<template>
	
    <div class="container-fluid">
        <div class="col-md-12 mt-4">
            <div class="card">
              <div class="card-header">
                <h3 class="card-title">
                User Table</h3>

                <div class="card-tools">
               
                  
                <button 
                type="button" class="btn btn-success" @click="newModal">Add New <i class="fa fa-user-plus"></i></button>                   
                  
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
                    	<button @click="editModal(user)" >
                    		<i class="fa fa-edit fa-1x orange "></i>
                    	</button>
                     &nbsp;
                    	<button @click="deleteUser(user.id)">
                    		<i class="fa fa-trash fa-1x red "></i>
                    	</button>
                    </td>
                  </tr>

                  
                </tbody></table>
              </div>
              <!-- /.card-body -->
            </div>
            <!-- /.card -->
          </div>


          <!------------------New Modal------------------->
          <div class="modal fade" id="addNewModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalScrollableTitle" aria-hidden="true">
		  <div class="modal-dialog modal-dialog-scrollable" role="document">
		    <div class="modal-content">
		      <div class="modal-header">
		        <h5 class="modal-title" id="exampleModalScrollableTitle"
		         v-if="!editMode">Add New User</h5>
		         <h5 class="modal-title" id="exampleModalScrollableTitle" v-else>Edit User</h5>
		        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
		          <span aria-hidden="true">&times;</span>
		        </button>
		      </div>

		      <form @submit.prevent="submit">
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
			    <textarea v-model="form.bio" type="text" name="bio" placeholder="Short Bio for user(optinal)"
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
		        <button type="submit" class="btn btn-success" v-if="!editMode">Save</button>
		        <button type="submit" class="btn btn-success" v-else>Update</button>
		      </div>

		      </form>

		    </div>
		  </div>
		</div>
<!------------------New Modal------------------->
    </div>



</template>



<script>
    export default {
    	data(){
    		return {
    			editMode:false,
    			users:[],
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
    	methods:{
    		newModal(){
    			this.editMode=false;
    			this.form.reset()
    			$('#addNewModal').modal('show');
    		},
    		editModal(user){
    			this.editMode=true;
    			this.form.reset()
    			$('#addNewModal').modal('show');
    			this.form.fill(user)
    		},
    		loadUsers(){
              axios.get('api/user')
              .then(res=>{
              	this.users=res.data
              	
              })
    		},
    		submit(){
              if(!this.editMode){
              	this.createUser()
              }
              else{
              	this.updateUser()
              }
    		},
          createUser(){
          	this.$Progress.start()

          	this.form.post('/api/user')
            .then(res => {
	        	
		         EventBus.$emit('AfterCreated');
		         this.$Progress.finish();
		         $('#addNewModal').modal('hide'); 
		         toast.fire({
				  type: 'success',
				  title: res.data.message,
				    })
	            })
            .catch(err=>{
            	
            	toast.fire({
				  type: 'error',
				  title: err.response.data.message,
				    })
            })
           },
           updateUser(){
           	
               this.$Progress.start()

          	this.form.put('/api/user/'+this.form.id)
            .then(res => {
	        	
		         EventBus.$emit('AfterUpdated');
		         this.$Progress.finish();
		         $('#addNewModal').modal('hide'); 
		         toast.fire({
				  type: 'success',
				  title: res.data.message,
				    })
	            })
            .catch(err=>{
            	
            	toast.fire({
				  type: 'error',
				  title: err.response.data.message,
				    })
            })
            },
    	  
           deleteUser(id){
              swal.fire({
			  title: 'Are you sure?',
			  text: "Are you sure to delete",
			  type: 'warning',
			  showCancelButton: true,
			  confirmButtonColor: '#3085d6',
			  cancelButtonColor: '#d33',
			  confirmButtonText: 'Yes, delete it!'
			}).then((result) => {
			  if (result.value) {

               //Send Delete Request to sever
               axios.delete('/api/user/'+id)
               .then(res=>
               {
               	 EventBus.$emit('AfterDeleted');
               	swal.fire(
			      'Deleted!',
			      res.data.message,
			      'success'
			    )
               })

			    
			  }
			})
			.catch(err=>{
            	
            	toast.fire({
				  type: 'error',
				  title: err.response.data.message,
				    })
            })
            },

           },
           
        created() {
            this.loadUsers();

            EventBus.$on('AfterCreated',()=>{
            	this.loadUsers();
            })
            EventBus.$on('AfterDeleted',()=>{
            	this.loadUsers();
            });
            EventBus.$on('AfterUpdated',()=>{
            	this.loadUsers();
            });
        }
    }
</script>