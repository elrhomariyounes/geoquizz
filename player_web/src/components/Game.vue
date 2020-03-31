<template>
   <div>
      <br>
      <div>
         <gmap-map 
            id="map"
            :center="center"
            :zoom="zm"
            :options="mapOptions"
            @click="getResult"
            style="width:40%;  height: 400px; margin-left:100px; float:left; "
            >
            <gmap-marker
               :key="index"
               v-for="(m, index) in markers"
               :position="m.position"
               @click="center=m.position"
               ></gmap-marker>
         </gmap-map>
         <img v-bind:src="this.pictures[this.cpt].url" style="width:40%; height:400px; margin-left:120px;"> 
         <center>
            <h5 style="color:black; background-color:white; width:300px;height:20px; padding :4px ">{{this.pictures[this.cpt].description}}</h5>
         </center>
      </div>
      <br> <br> 
      <div style="float:left; font-size:22px; margin-top:-5%">
         <div style="background-color:#DD5145; padding: 10px;color :white"  > Distance :{{distance}} </div>
         <div style="background-color:#03AA6F; padding: 10px; color :white"> score  :{{score}}  </div>
      </div>
      <button @click="goToNext" style="float :right">Suivant</button>
      <button @click="pauseGame" class="btnPause" style="float :right; background-color:#DD5145; border-color:#DD5145">Pause</button>
   </div>
</template>
<script>
   import axios from 'axios'
   export default {
     name: "GoogleMap",
     data() {
       return {
         // default to Montreal to keep it simple
         // change this to whatever makes sense
         pictures:'',
         center: { lat: 45.508, lng: -73.587 },
         markers: [],
         zm:11,
         places: [],
         currentPlace: null,
         mapOptions: {
         controlSize: 20,
         clickableIcons: false,
         draggable: true,
         zoomControl: true,
         mapTypeControl: true,
         scaleControl: false,
         streetViewControl: false,
         rotateControl: false,
         fullscreenControl: false,
         styles: [
           {
             featureType: "poi",
             stylers: [{ visibility: "off" }]
           }
         ]
       },
       ltPicture:'',
       lgPicture:'',
       distance:0,
       cpt:0,
       isSaving: false,
       showPause: true,
       showNext: false,
       startTime: Date.now(),
       score: 0,
       scoreProvisoire:0,
       pauseTime: null,
       timePaused: 0,
       focuses: [],
       isPaused: true,
       timer: '',
       seconds: 25 * 60,
       testbtn:true
       };
     },
   
     mounted() {
       this.$store.state.testnav=true
      this.getGame()
      
       
      
     },
   
     methods: {
       
       getGame(){
   
           axios.get("games/"+this.$store.state.game.id+"/photos?token="+this.$store.state.game.token).then(response => {
           this.$store.commit("setPhotos", response.data.result);
           this.pictures=response.data.result;
           console.log(response.data.result)
           this.geoPicture()
         }).catch(error => console.log(error));
   
       },
       setPlace(place) {
         this.currentPlace = place;
       },
       goToNext(){
         
         if(this.cpt < this.pictures.length-1)
         {
         this.cpt=this.cpt+1
         this.markers=[]
         this.geoPicture()
         
         }else{
           this.$store.state.timeGame=this.timer
           this.$store.state.score=this.score
            this.$router.push("/result");
         }
       },
       geoPicture(){
           let str = this.pictures[this.cpt].position.replace(/\[/g,"")
            str=str.replace(/\]/g,"") 
           
            let t =str.split(',')
            this.ltPicture = parseFloat(t[1])
           this.lgPicture =  parseFloat(t[0])
            let map = this.$store.state.serie.map_refs.replace(/\[/g,"")
            map=map.replace(/\]/g,"") 
           
            let m =map.split(',')
            let lt = parseFloat(m[1])
            let lg =  parseFloat(m[0])
            const marker = {
               lat: lg ,
               lng: lt
             };
             this.center = marker;
             this.currentPlace = null;
             
   
       },
       loadMap() {
          
           this.center = {
             lat: this.currentPlace.geometry.location.lat(),
             lng: this.currentPlace.geometry.location.lng()
             
           };
         
       },
       geolocate: function() {
         navigator.geolocation.getCurrentPosition(position => {
           this.center = {
             lat: position.coords.latitude,
             lng: position.coords.longitude
           };
         });
       },
       
       async getResult(cursorPos) {
           const marker={
               lat: cursorPos.latLng.lat(),
             lng:cursorPos.latLng.lng()
           };
           this.markers.push({ position: marker});
           this.places.push(this.currentPlace);
           this.currentPlace = null;
           this.getDistance(marker);
           this.stopTimer();
           this.calculScore();
           
           
        /* alert(cursorPos.latLng.lat()+" et"+cursorPos.latLng.lng());*/
       },
       getDistance(p1) {
         const rad = function(x) {
           return (x * Math.PI) / 180;
         };
         /*alert(this.lgPicture);*/
         const R = 6378137; // Earth’s mean radius in meter
         const dLat = rad(this.ltPicture - p1.lat);
         const dLong = rad(this.lgPicture - p1.lng);
         
         const a =
           Math.sin(dLat / 2) * Math.sin(dLat / 2) +
           Math.cos(rad(p1.lat)) *
             Math.cos(rad(this.ltPicture)) *
             Math.sin(dLong / 2) *
             Math.sin(dLong / 2);
         const c = 2 * Math.atan2(Math.sqrt(a), Math.sqrt(1 - a));
       this.distance= Math.round(R * c); // returns the distance in meter
       const marker={
               lat: this.ltPicture,
             lng:this.lgPicture
           };
           this.markers.push({ position: marker,icon: {
         url: "http://maps.google.com/mapfiles/ms/icons/yellow-dot.png"
       } });
           this.places.push(this.currentPlace);
           this.center = marker;
           this.currentPlace = null;
       
       },
       calculScore() {
          var d = this.$store.state.difgame.distance
          
         if (this.distance < d) {
           this.scoreProvisoire += 5;
         } else if (this.distance < 2 * d) {
            this.scoreProvisoire += 3;
         } else if (this.distance < 3 * d) {
            this.scoreProvisoire += 1;
         }
   
         const timePlayed = this.seconds - this.timePaused;
         this.$store.state.timeGame +=timePlayed
         
   
         if (timePlayed < 5) {
            this.scoreProvisoire *= 4;
         } else if (timePlayed >= 5 && timePlayed < 10) {
            this.scoreProvisoire *= 2;
         } else if (timePlayed >= 10 && timePlayed < 20) {
           this.scoreProvisoire *= 1;
         } else if (timePlayed > 20) {
            this.scoreProvisoire = 0;
         }
       this.score += this.scoreProvisoire
       this.scoreProvisoire=0
        
       },
       stopTimer() {
         let millis = Date.now() - this.startTime;
         this.seconds = Math.floor(millis / 1000);
         //alert(this.seconds)
         this.startTime=Date.now();
       },
       stopPause() {
         let millis = Date.now() - this.pauseTime;
         this.timePaused = Math.floor(millis / 1000);
         this.pauseTime = null;
         this.isPaused = !this.isPaused;
       },
       pauseGame() {
         if (this.testbtn == true){
         document.getElementsByClassName("btnPause")[0].style.backgroundColor = "#149F5B"; 
         this.pauseTime = Date.now();
         this.isPaused = !this.isPaused;
         alert("Cliquez sur button Pause pour continuer le jeu.")
         this.testbtn = false
         }else{
           document.getElementsByClassName("btnPause")[0].style.backgroundColor = "#DD5145";
           this.stopPause()
           this.testbtn=true
         }
       }
   
     }
   };
</script>