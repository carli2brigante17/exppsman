<template>
 <div>

      <h1>User Management</h1>
      <table class="table table-hover">
          <thead>

                <th>Name</th>
                <th>Email</th>
                <th>Role</th>
                <th>Created_at</th>



              </thead>
        <tbody>
            <tr v-for="(item, index) in postings" :key ="index">
                <td data-toggle="modal" data-target="#Modalupdate" @click="updatefrm(index,item.id,item.name,item.email,item.role)" >{{item.name}} </td>
                <td data-toggle="modal" data-target="#Modalupdate" @click="updatefrm(index,item.id,item.name,item.email,item.role)">{{item.email}}</td>
                <td data-toggle="modal" data-target="#Modalupdate" @click="updatefrm(index,item.id,item.name,item.email,item.role)">{{item.role}}</td>
                <td data-toggle="modal" data-target="#Modalupdate" @click="updatefrm(index,item.id,item.name,item.email,item.role)">{{item.created_at}}</td>
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
Name:<input id="uname" type="text" class="form-control"    v-model="formup.name">
                         
Email:<input id="uemail" type="email" class="form-control"   v-model="formup.email">
                        
          
 Role:<select  id="urole" class="form-control" v-model="formup.role">
                                
                              <option v-for="(items ,index) in rolepostings" :key="index" v-bind:value="items.role">
                                        {{ items.role }}
                                   </option>
                                </select>
     
                
                </form>
                 <button class="btn btn-primary"  @click="upuser()" > Update User</button>
                  <button class="btn btn-danger"  @click="remvuser()"  > Delete User</button>
                    </div>

                </div>
                 </div>
                  </div>


  <div class="modal fade" id="addu" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Add Users</h5>
                    <button type="button" id="botadd"  class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">×</span>
                    </button>
                </div>
                <div class="modal-body">
<form id="add">

     Name:<input id="name" type="text" class="form-control"  required autocomplete="name" autofocus v-model="form.name">
                         
                           
 Role:<select  id="role" class="form-control" v-model="form.role">
                                 <option v-for="(items ,index) in rolepostings" :key="index" v-bind:value="items.role">
                                        {{ items.role }}
                                   </option>
                                </select>
                        
                              
Email:<input id="email" type="email" class="form-control"   required autocomplete="email" v-model="form.email">
                        
                          
 Password:<input id="password" type="password" class="form-control" v-model="form.password" required autocomplete="new-password">
       </form>    
           <button class="btn btn-primary"  @click="submit()" value="Add User" > Add User</button>
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
 props: ['posting','roleposting'],
 data(){
     return{
           postings:this.posting,
           rolepostings:this.roleposting,
            formup:{
           
            
             name:'',
             email:'',
             role:'',
            },
         form:{
           

             name:'',
             email:'',
             role:'',
             password:'',
         }

     }
 },
     methods: {
               updatefrm($ind,$id,$name,$email,$role){
               
                   const vm = this;
                       // alert();
                    this.formup.indexs =$ind ;
                    this.formup.id = $id;
                   vm.formup.name = $name;
                   vm.formup.role  = $role;
                   vm.formup.email = $email;
                   
              
            },
              remvuser($count){
                  const pr = this;
                   // alert(pr.formup.indexs);
                    if(pr.formup.id=="1"){
                        return alert("cannot delete Administrator");

                    }
                     var X = confirm(`Are you sure you want to Delete ${pr.formup.name}`);
        if (X == true) {
                   axios.delete(`/usermanager/${pr.formup.id}`)
                .then(function (response) {
                      $('#botsup').click();
                        $('#botsup').click();
                 pr.postings.splice(pr.formup.indexs,1);
                
                           

                             
                            
                })
        }
                console.log(this.form);
               
                },
                 upuser(){
                     
               const pr = this;
              
                     if(pr.formup.id=="1"){
                            
                        if(pr.formup.role != "Administrator"){

                        return alert("cannot Change the Role of main Administrator");
                        }
                       

                    }
             
               var r = confirm(`Are you sure you want to Update to ${this.formup.name}`);
        if (r == true) {
                  axios.put(`/usermanager/${pr.formup.id}`,pr.formup)
                  
                .then(function (response) {
                 
                  location.reload();
                    
                     
                   $('#botadd').click();
                   $('#botadd').click();
                  
                 
                })
                
            }
              
                 },

             
            submit(){
               const pr = this;
               if(pr.form.name==""){
                   return;
               }
               var X = confirm(`Are you sure you want to Create ${pr.form.name}`);
        if (X == true) {
                axios.post('/usermanager',this.form)
                .then(function (response) {
                 pr.form.name="";
                   pr.postings.push(response.data.data);
                    
                     
                   $('#botadd').click();
                   $('#botadd').click();
                   //console.log(this.form);
                })

                .catch(function (error) {
                        alert("Incorrect Entry or Email Already taken");
                })
                
                
                
               
        }
            }

     }
 }

</script>

<style>

</style>