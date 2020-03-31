<template>
   <div>
      <button style="float : left" @click="gotohome">Accueil</button>
      <center>
         <h1 style="color:white">Top 10 scores</h1>
         <table>
            <tr>
            </tr>
            <tr>
               <th>Player</th>
               <th>Score</th>
               <th>Série</th>
            </tr>
            <tr  v-for="(s,index) in scores"
               v-bind:key="index">
               <td>{{s.player}}</td>
               <td>{{s.score}}</td>
               <td>{{s.serie.city}}</td>
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
       scores:''
           }
           
       },
       mounted()
       {
           this.$store.state.testnav=false
           this.getScores()
       },
       methods :{
            getScores(){
         axios.get("scores").then(response => {
           console.log(response.data.result)
            this.scores=response.data.result;
         }).catch(error => console.log(error))
        },
       
           gotohome()
           {
               this.$router.push("/");
           
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