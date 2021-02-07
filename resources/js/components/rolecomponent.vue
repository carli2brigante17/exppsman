<template>
 <div>

      <h1>Role Management</h1>
      <table class="table table-hover">
          <thead>

                <th>Role</th>
                <th>Description</th>
                <th>Created_at</th>



              </thead>
        <tbody>
            <tr v-for="(item, index) in rolepostings" :key ="index">
                <td data-toggle="modal" data-target="#Modalupdate" @click="updatefrm(index,item.id,item.description,item.role)" >{{item.role}} </td>
                <td data-toggle="modal" data-target="#Modalupdate" @click="updatefrm(index,item.id,item.description,item.role)">{{item.description}}</td>
    
                <td data-toggle="modal" data-target="#Modalupdate" @click="updatefrm(index,item.id,item.description,item.role)">{{item.created_at}}</td>
                </tr>

            </tbody>

          </table>
          <div class="modal fade" id="Modalupdate" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                   <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">User Update</h5>
                    <button type="button" id="botsup" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">×</span>
                    </button>
                </div>
                <div class="modal-body">
  <form id="uppfrm">
                    <input id="uid" v-model="formup.id" type="hidden">
                     <input id="ind" v-model="formup.indexs" type="hidden">
Role:<input id="urole" type="text" class="form-control"    v-model="formup.role">
                         
Description:<input id="udesc" type="email" class="form-control"   v-model="formup.description">
 
                
                </form>
                 <button class="btn btn-primary"  @click="uprol()" > Update Role</button>
                  <button class="btn btn-danger"  @click="remrol()"  > Delete</button>
                    </div>

                </div>
                 </div>
                  </div>


  <div class="modal fade" id="addu" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Add Role</h5>
                    <button type="button" id="botadd"  class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">×</span>
                    </button>
                </div>
                <div class="modal-body">
<form id="add">

                          
                           
 Role:<input type="text"  id="role" class="form-control" v-model="form.role">
                                
Description:<input id="desc" type="text" class="form-control"   required autocomplete="email" v-model="form.description">
                        
       </form>    
           <button class="btn btn-primary"  @click="submit()" value="Add User" > Add Role</button>
           </div>   
  </div>
                <div class="modal-footer">
                   
                    
                </div>
            </div>
        </div>
    </div>

</template>

<script>
export default {
 props: ['roleposting'],
 data(){
     return{
           rolepostings:this.roleposting,
            formup:{
           
            
             role:'',
             description:'',
            
            },
         form:{
           

             role:'',
             description:'',
         
         }

     }
 },
     methods: {
               updatefrm($ind,$id,$description,$role){
                   // alert($ind);
                   const vm = this;
                    this.formup.indexs =$ind ;
                    this.formup.id = $id;
                   vm.formup.role = $role;
                   vm.formup.description  = $description;
                   
                   
              
            },
              remrol($count){
                  const pr = this;
                   // alert(pr.formup.indexs);

                     var X = confirm(`Are you sure you want to Delete ${pr.formup.role}`);
        if (X == true) {
                   axios.delete(`/role/${pr.formup.id}`)
                .then(function (response) {
                      $('#botsup').click();
                        $('#botsup').click();
                 pr.rolepostings.splice(pr.formup.indexs,1);
                
                           

                             
                            
                })
        }
                console.log(this.form);
               
                },
                 uprol(){
               const pr = this;

               var r = confirm(`Are you sure you want to Update to ${this.formup.role}`);
        if (r == true) {
                  axios.put(`/role/${pr.formup.id}`,pr.formup)
                .then(function (response) {
                 
                  location.reload();
                    
                     
                   $('#botadd').click();
                   $('#botadd').click();
                  
                 
                })
            }
              
                 },

             
            submit(){
               const pr = this;
               var X = confirm(`Are you sure you want to add role:  ${pr.form.role}`);
        if (X == true) {
                axios.post('/role',this.form)
                .then(function (response) {
                 
                   pr.rolepostings.push(response.data.data);
                    
                     
                   $('#botadd').click();
                   $('#botadd').click();
                   console.log(this.form);
                })
                
                
                
               
        }
            }

     }
 }

</script>

<style>

</style>