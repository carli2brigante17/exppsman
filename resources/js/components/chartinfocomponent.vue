<template>
 <div>
  <h3> My Expenses </h3>
                                
      <h4 v-for="(items ,index) in catpostings" :key="index" v-bind:value="items.CATEGORY">
                                  {{items.CATEGORY}}:{{ items.AMOUNT }} 
                                   


                                   </h4>


                                

  
           

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
    created: function () {

        //alert (axios.get('/list'));
      
    }
     
            

     
 }

</script>


