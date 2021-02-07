<template>
 <div>

      <h1>Expense Category Management</h1>
      <table class="table table-hover">
          <thead>

                <th>Expense Name</th>
                <th>Description</th>
                <th>Created_at</th>



              </thead>
        <tbody>
            <tr v-for="(item, index) in catpostings" :key ="index">
                <td data-toggle="modal" data-target="#Modalupdate" @click="updatefrm(index,item.id,item.description,item.categoryname)" >{{item.categoryname}} </td>
                <td data-toggle="modal" data-target="#Modalupdate" @click="updatefrm(index,item.description,item.categoryname)">{{item.description}}</td>
    
                <td data-toggle="modal" data-target="#Modalupdate" @click="updatefrm(index,item.description,item.categoryname)">{{item.created_at}}</td>
                </tr>

            </tbody>

          </table>
          <div class="modal fade" id="Modalupdate" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                   <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Update Expense Category</h5>
                    <button type="button" id="botsup" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">×</span>
                    </button>
                </div>
                <div class="modal-body">
  <form id="uppfrm">
                    <input id="uid" v-model="formup.id" type="hidden">
                     <input id="ind" v-model="formup.indexs" type="hidden">
Expense Category:<input id="ucat" type="text" class="form-control"    v-model="formup.categoryname">
                         
Description:<input id="udesc" type="text" class="form-control"   v-model="formup.description">
 
                
                </form>
                 <button class="btn btn-primary"  @click="upcat()" > Update Expense Category</button>
                  <button class="btn btn-danger"  @click="remcat()"  > Delete</button>
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

                          
                           
 Expense Category:<input type="text"  id="cat" class="form-control" v-model="form.categoryname">
                                
Description:<input id="desc" type="text" class="form-control"   required autocomplete="email" v-model="form.description">
                        
       </form>    
           <button class="btn btn-primary"  @click="submit()" value="Add User" > Add Expense Category</button>
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
 props: ['catposting'],
 data(){
     return{
           catpostings:this.catposting,
            formup:{
           
            
             categoryname:'',
             description:'',
            
            },
         form:{
           

             categoryname:'',
             description:'',
         
         }

     }
 },
     methods: {
               updatefrm($ind,$id,$description,$cat){
                   // alert($ind);
                   const vm = this;
                    this.formup.indexs =$ind ;
                    this.formup.id = $id;
                   vm.formup.categoryname = $cat;
                   vm.formup.description  = $description;
                   
                   
              
            },
              remcat($count){
                  const pr = this;
                   // alert(pr.formup.indexs);

                     var X = confirm(`Are you sure you want to Delete ${pr.formup.categoryname}`);
        if (X == true) {
                   axios.delete(`/expense-cat/${pr.formup.id}`)
                .then(function (response) {
                      $('#botsup').click();
                        $('#botsup').click();
                 pr.catpostings.splice(pr.formup.indexs,1);
                
                           

                             
                            
                })
        }
                console.log(this.form);
               
                },


                 upcat(){
               const pr = this;

               var c = confirm(`Are you sure you want to Update ${this.formup.categoryname}`);
        if (c == true) {
                  axios.put(`/expense-cat/${pr.formup.id}`,pr.formup)
                .then(function (response) {
                 
                 location.reload();
                //    
                      console.log(pr.formup); 
            
                  
                 
                })
            }
              
                 },

             
            submit(){
               const pr = this;
               var X = confirm(`Are you sure you want to add role:  ${pr.form.categoryname}`);
        if (X == true) {
                axios.post('/expense-cat',this.form)
                .then(function (response) {
                 
                   pr.catpostings.push(response.data.data);
                    
                     
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