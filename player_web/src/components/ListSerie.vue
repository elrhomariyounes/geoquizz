<template>
   <div>
      <link
         rel="stylesheet"
         href="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css"
         integrity="sha384-Vkoo8x4CGsO3+Hhxv8T/Q5PaXtkKtu6ug5TOeNV6gBiFeWPGFN9MuhOf23Q9Ifjh"
         crossorigin="anonymous"
         />
      <div class="row justify-content-start">
         <div
            v-for="(p,index) in series"
            v-bind:key="index"
            class="col 12 "
            style="padding-top:2.5%;padding-left:3%"
            >
            <div class=".col-6 .col-md-4" >
               <div class=" divgl" style="width: 18rem; border-radius: 10px;">
                  <br />
                  <div class="text-center ">
                     <img :src="p.photo.url" class="rounded" style="height: 100px; width: 100px;" />
                  </div>
                  <div class="card-body">
                     <h6 class="card-title">
                        <p> Ville : <b>{{p.serie.city}}</b></p>
                     </h6>
                     <select v-model="p.serie.difficulty.id"  @change="onChange(p.serie.difficulty.id)">
                        <option v-for="(diff,index) in $store.state.difficulty"
                           v-bind:key="index" :value="diff.id"> {{diff.description}}
                        </option>
                     </select>
                     <center><button class="btn btn-danger" @click="goToGame(p.serie,p.serie.difficulty)" >Jouer</button></center>
                  </div>
               </div>
            </div>
         </div>
      </div>
   </div>
</template>
<script>
   import axios from "axios"
   
   export default {
     name: 'Singup',
     data() {
       return {
           selected:"Choisissez une serie",
           diffId:"",
           pictures:"",
           series:""
        
       }
     },
     mounted(){
       this.$store.state.testnav=true
         this.getSeries();
     },
     methods : {
         
     getSeries(){
         axios.get("series").then(response => {
           this.$store.commit("setSeries", response.data.result);
           console.log(response.data.result.series)
            this.series=response.data.result.series;
         }).catch(error => console.log(error));
         this.onChange(event)
        },
        getDifficulty(){
            axios.get("difficulties").then(response => {
           this.$store.commit("setDifficulty", response.data.result);
           console.log(response.data)
           
           
         }).catch(error => console.log(error));
        },
     onChange:function(id){
          
          this.$store.state.difgame = id;
          
          
          
       },
       goToGame(sr,dif){
           this.$store.state.difgame=dif
           this.$store.state.serie=sr
           axios.post("games",{
              player : this.$store.state.pseudo,
              serieId : this.$store.state.serie.id
            }).then(response => {
           this.$store.commit("setGame", response.data.result);
           console.log(response.data.result)
           this.$router.push("/game");
         }).catch(error => console.log(error));
   
           
       }
   
     }
     }
     
   
</script>
<style scoped>
   .divgl{
   background-color:#0774AF;
   }
</style>