<template>
   <div style="width:100%;height:100%">
      <div class="addserie" >
         <center>
            <form id="app"  style="background-color:gray; margin-left:5%;margin-top:6%;   width:20%;height:350px;">
               <h1>Créer une série</h1>
               <img  src="https://image.flaticon.com/icons/svg/2580/2580777.svg" style="height:100px; width:50%; ">

               <p>
                 <br>
                  <label>
               <h5 style="">Veuillez saisir la Ville</h5>
               <gmap-autocomplete style="height:30px" 
                  @place_changed="setPlace"  :value="city"
                  @input="value = $event.target.value">
               </gmap-autocomplete>
              
                 </label>
               </p>
              
               
               <p>
                 <label>
                    <h5 style="">Difficulté</h5>
                  <select v-model="selected"  @change="onChange($event)">
                      <option v-for="(diff,index) in $store.state.difficulty"
                      v-bind:key="index"  :value="diff.id"> {{diff.description}}
                      </option>
                  </select>
                  </label>
               </p>
                
               <p>
                  <button @click="addSerie()">Creer</button>
               </p>
            </form>
         </center>
         <div>
            <center>
               <h3 style="margin-left:40%; margin-top:2%;color:white"  >Veuillez cliquer dans le centre de la zone choisi</h3>
               <gmap-map 
                  id="map"
                  :center="center"
                  :zoom="13"
                  :options="mapOptions"
                  @click="getZone"
                  style="width:40%;  height: 400px; float:right; margin-right:8%;margin-top:3%;"
                  >
                  <gmap-marker
                     :key="index"
                     v-for="(m, index) in markers"
                     :position="m.position"
                     @click="center=m.position"
                     ></gmap-marker>
               </gmap-map>
            </center>
         </div>
      </div>
   </div>
</template>
<script>
import axios from "axios"
   export default {
     data() {
       return {
         selected: 'A',
    options: "",
         errors:[],
     city:"",
     dif:null,
     center: { lat: 45.508, lng: -73.587 },
       markers: [],
       places: [],
       currentPlace: null,
       mapOptions: {
       controlSize: 20,
       clickableIcons: true,
       draggable: true,
       zoomControl: true,
       mapTypeControl: true,
       scaleControl: true,
       
       streetViewControl: true,
       rotateControl: true,
       fullscreenControl: true,
       styles: [
         {
           featureType: "poi",
           stylers: [{ visibility: "off" }]
         }
       ]
     }
       }},mounted(){
         if(this.$store.state.token == "")
         {
           alert("Connectez-vous Svp ! ")
           this.$router.push("/");
         }else{
           
         this.getDifficulties();
         this.$store.state.isConnect= true;
         }
          
       },
   methods:{
     addSerie:function() {
      
       if(this.city && this.dif)           
       if(!this.city) alert("City required.");
       if(!this.dif) alert("Difficulté required.");

       axios.post('series',{
                      userId :  this.$store.state.user.id,
                      city :     this.city,
                      difficultyId : this.dif,
                      map_refs:"["+this.center.lat+" , "+this.center.lng+"]"
                    },{
                        headers: {
                        Authorization: 'Bearer ' + this.$store.state.token,
                        }
                      }).then(response => {
                      console.log(response.data)
                      this.$router.go();
                    }).catch(error => console.log(error))
       
     },
     onInput (val) {
       
         this.city = val;
         
       
     },
  onChange:function(event){
       
       this.dif=event.target.value;
       
    },
     getDifficulties(){
       axios.get("difficulties").then(response => {
        this.$store.commit("setDifficulty", response.data.result);
        console.log(response.data)
        
        
      }).catch(error => console.log(error));
     },
     
     geolocate: function() {
       navigator.geolocation.getCurrentPosition(position => {
         this.center = {
           lat: position.coords.latitude,
           lng: position.coords.longitude
         };
       });
     },
     setPlace(place) {
       this.city=place.formatted_address
       this.currentPlace = place;
        this.center = {
           lat: this.currentPlace.geometry.location.lat(),
           lng: this.currentPlace.geometry.location.lng()
           
         };
         
        
       
     },
     getZone(cursorPos){
         const marker={
             lat: cursorPos.latLng.lat(),
           lng:cursorPos.latLng.lng()
         };
         
         this.markers.push({ position: marker });
         this.places.push(this.currentPlace);
         this.center = marker;
         this.currentPlace = null;
     }
     }
     }
     
   
</script>
<style scoped>
   select {
   width:200px;
   padding: 16px 20px;
   border: none;
   border-radius: 4px;
   background-color: #f1f1f1;
   }
   option {
   background-repeat: no-repeat;
   padding-left: 22px;
   height : 21px;
   }
</style>