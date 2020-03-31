<template>
   <div>
      <center>
         <h1 style="color:white">Top score par série</h1>
         <table>
            <tr>
               <th>Player</th>
               <th>Score</th>
               <th>Série</th>
            </tr>
            <tr  v-for="(s,index) in scores"
               v-bind:key="index">
               <td>{{s.player}}</td>
               <td>{{s.score}}</td>
               <td>{{city}}</td>
            </tr>
         </table>
      </center>
   </div>
</template>
<script>
   import axios from 'axios'
   export default {
       data(){
           return{
       scores:'',
       city :this.$store.state.serie.city
           }
           
       },
       mounted()
       {
           this.$store.state.testnav=false
           this.getScores()
       },
       methods :{
            getScores(){
                let id =this.$store.state.serie.id
         axios.get("series/"+id+"/scores").then(response => {
           console.log(response.data.result)
            this.scores=response.data.result;
         }).catch(error => console.log(error))
        }
       }
   }
</script>
<style lang="scss">
   table {
   border-collapse: collapse;
   width: 50%;
   }
   th, td {
   text-align: left;
   padding: 8px;
   background-color: #f2f2f2
   }
   th {
   background-color: #4CAF50;
   color: white;
   }
</style>