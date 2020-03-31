<template>
   <div>
      <center>
         <table border="1" bordercolor="black"  align="center" style="width:70%; background-color:#efefef; margin-top:5%">
            <tr>
               <th colspan="4" style="height:100px;"> <img src="../assets/mobile.png" style="width:60px;height:60px ; margin-top:-10px;"> <br>Photo Mobile</th>
            </tr>
            <tr>
               <th>Photo</th>
               <th>Description</th>
               <th>url</th>
               <th>Série</th>
            </tr>
            <tr v-for="(p,index) in pictures"
               v-bind:key="index" >
               <td><img :src="p.url" style="width:100px; height:100px"></td>
               <td>{{p.description}}</td>
               <td border="1" height=100 width=100><a>{{p.url}}</a></td>
               <td>
                  <select v-model="selected" @change="onChange($event)">
                     <option v-for="(s,index) in $store.state.series"
                        v-bind:key="index" :value="s.id"> {{s.city}}
                     </option>
                  </select>
                  <center>
                    <button style=" margin-top:5px;" @click="addSerieToPicture(p.id)">Affecter</button>
                  </center>
               </td>
            </tr>
         </table>
      </center>
   </div>
</template>
<script>
   import axios from "axios"
   
   export default {
     name: 'Singup',
     data() {
       return {
           selected:"Choisissez une serie",
           serieId:"",
           pictures:""
        
       }
     },
     mounted(){
       if(this.$store.state.token == "")
         {
           alert("Connectez-vous Svp ! ")
           this.$router.push("/");
         }else{
         this.getPictures();
         this.getSeries();
         this.$store.state.isConnect= true;
         }
     },
     methods : {
         getPictures(){
          axios.get("users/"+this.$store.state.user.id+"/photos",
                        {
                           headers: {
                           Authorization: 'Bearer ' + this.$store.state.token,
                           }
                         }).then(response => {
           this.$store.commit("setPhotos", "");
           this.pictures=response.data.result;
           console.log(response.data)
           
           
         }).catch(error => console.log(error));
        },
     getSeries(){
         axios.get("series").then(response => {
           this.$store.commit("setSeries", response.data.result);
           console.log(response.data)
           
           
         }).catch(error => console.log(error));
        },
     addSerieToPicture(id){
         
          axios.put('photos/'+id,{
              
                         userId :  this.$store.state.user.id,
                         serieId:this.serieId
                       },{
                           headers: {
                           Authorization: 'Bearer ' + this.$store.state.token,
                           }
                         }).then(response => {
                         alert(response.result.serie_id)
                       }).catch()
                       
     },
     onChange:function(event){
          
          this.serieId=event.target.value;
          
       }
   
     }
     }
     
   
</script>
<style scoped>
</style>