<template>
 <div>

      <h1>Expenses Management</h1>
      <table class="table table-hover">
          <thead>

                <th>Expenses Category</th>
                <th>Amount</th>
                 <th>Entry Date</th>
                <th>Created_at</th>



              </thead>
        <tbody>
            <tr v-for="(item, index) in expostings" :key ="index">
                <td data-toggle="modal" data-target="#Modalupdate" @click="updatefrm(index,item.id,item.entrydate,item.categoryname,item.amount)" >{{item.categoryname}} </td>
                  <td data-toggle="modal" data-target="#Modalupdate" @click="updatefrm(index,item.id,item.entrydate,item.categoryname,item.amount)" >{{item.amount}} </td>
                  
                    <td data-toggle="modal" data-target="#Modalupdate" @click="updatefrm(index,item.id,item.entrydate,item.categoryname,item.amount)" >{{item.entrydate}} </td>
                <td data-toggle="modal" data-target="#Modalupdate" @click="updatefrm(index,item.id,item.entrydate,item.categoryname,item.amount)" >{{item.created_at}} </td>
              
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
 Expense Category:<select  id="role" class="form-control" v-model="formup.categoryname">
                                 <option v-for="(items ,index) in catpostings" :key="index" v-bind:value="items.categoryname">
                                        {{ items.categoryname }}
                                   </option>
                                
            
                                </select>
     
Amount:<input id="amount" type="text" class="form-control"    v-model="formup.amount">
                        
                                
Entry Date:<input id="desc" type="Date" class="form-control"    v-model="formup.entrydate">
            
                                

                </form>
                 <button class="btn btn-primary"  @click="upexp()" > Update Expense Category</button>
                  <button class="btn btn-danger"  @click="remexp()"  > Delete</button>
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

                           
          <input id="uid"  v-model="form.uid" type="hidden"> 
          
 Expense Category:<select  id="role" class="form-control" v-model="form.categoryname">
                                 <option v-for="(items ,index) in catpostings" :key="index" v-bind:value="items.categoryname">
                                        {{ items.categoryname }}
                                   </option>
                                
            
                                </select>
     
Amount:<input id="amount" type="text" class="form-control"    v-model="form.amount">
                        
                                
Entry Date:<input id="desc" type="Date" class="form-control"    v-model="form.entrydate">
            
                                

                        
       </form>    
           <button class="btn btn-primary"  @click="submit()"  > Add Expense Category</button>
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
 props: ['exposting','catposting','currentid'],
 data(){
     return{
           expostings:this.exposting,
           catpostings:this.catposting,
            
            formup:{
           
            
             categoryname:'',
             amount:'',
             entrydate:'',
             description:'',
               uid:'',
            
            },
         form:{
           

                  categoryname:'',
             amount:'',
             entrydate:'',
             description:'',
              uid:'',

         }

     }
 },
     methods: {
               updatefrm($ind,$id,$date,$cat,$amount){
                   // alert($ind);
                   const vm = this;
                    this.formup.indexs =$ind ;
                    this.formup.id = $id;
                   vm.formup.categoryname = $cat;
                   vm.formup.amount = $amount;
                    vm.formup.entrydate = $date;
                    
                   
                   
                   
              
            },
              remexp($count){
                  const pr = this;
                   // alert(pr.formup.indexs);

                     var X = confirm(`Are you sure you want to Delete ${pr.formup.categoryname}`);
        if (X == true) {
                   axios.delete(`/expense/${pr.formup.id}`)
                .then(function (response) {
                      $('#botsup').click();
                        $('#botsup').click();
                 pr.expostings.splice(pr.formup.indexs,1);
                
                           

                             
                            
                })
        }
                console.log(this.form);
               
                },


                 upexp(){
               const pr = this;
    pr.formup.uid = pr.currentid.id;
               var c = confirm(`Are you sure you want to Update ${this.formup.categoryname}`);
        if (c == true) {
                  axios.put(`/expense/${pr.formup.id}`,pr.formup)
                .then(function (response) {
                 
                 location.reload();
                //    
                      console.log(pr.formup); 
            
                  
                 
                })
            }
              
                 },

             
            submit(){
               const pr = this;
               pr.form.uid = pr.currentid.id;
              // alert(pr.currentid.id);
               var X = confirm(`Are you sure you want to add role:  ${pr.form.categoryname}`);
        if (X == true) {
                axios.post('/expense',this.form)
                .then(function (response) {
                 
                   pr.expostings.push(response.data.data);
                    
                     
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