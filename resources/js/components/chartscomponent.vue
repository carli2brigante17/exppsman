
<script>
import { Pie } from 'vue-chartjs';

export default {
   props: ['currentid'],
   extends: Pie,
   mounted() {
   
         let catname = new Array();
         let Labels = new Array();
         let amount = new Array();
         axios.get('/charts').then((response) => {
            let data = response.data;
            if(data) {
               data.forEach(element => {
               catname.push(element.categoryname);
             //  Labels.push(element.categoryname);
               amount.push(element.amount);
               });
               this.renderChart({
               labels: catname,
               datasets: [{
                  label: 'Expenses',
                  backgroundColor: ["#0074D9", "#FF4136", "#2ECC40", "#FF851B", "#7FDBFF", "#B10DC9", "#FFDC00", "#001f3f", "#39CCCC", "#01FF70", "#85144b", "#F012BE", "#3D9970", "#111111", "#AAAAAA"],
                  data: amount
            },
            
            
            
            
            ]
         }, {responsive: true, maintainAspectRatio: false})
       }
       else {
          console.log('No data');
       }
      });            
   }
}
</script>
