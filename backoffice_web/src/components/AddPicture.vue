<template>
   <div class="container">
      <div class="divform" style="float:left; width:50%;height:100%">
         <form id="app" style="background-color:gray; margin-left:5%;margin-top:6%;   width:20%;height:350px;">
            <center>
               <h2>Ajouter Photo</h2>
            </center>
            <br>
            <p>
               <label>
            <h5 style="">Veuillez saisir la photo</h5>
            <img  v-bind:src="srcImg" style="height:100px; width:50%; ">
            <input 
               style=" width:50%; "
               type="file"  
               class="form-control" 
               v-on:change="handleFileUpload($event.target.files)" 
               accept="image/*" />
            </label>
            <label>
               <h5 style="">Déscription</h5>
               <input style=" width:50%; " type="text" v-model="description" />
            </label>
            </p>
            <p>
               <label>
            <h5 style="">Série</h5>
            <select v-model="selected" @change="onChange($event)" style="height:30px; width:60%; "> 
            <option v-for="(s,index) in $store.state.series"
               v-bind:key="index" :value="s.id" style=" height: 60%;"> {{s.city}}
            </option>
            </select>
            </label>
            </p>
            <br>
            <button @click="addPicture" >Ajouter</button>
         </form>
      </div>
      <center>
         <h3 style="margin-left:40%;color:white;margin-top:2%"  >Veuillez Choisir la position exacte du photo</h3>
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
</template>
<script>
   import axios from 'axios'
     export default {
       /*
         Defines the data used by the component
       */
       data(){
         return {
           file: '',
           description:"",
           serieId:"",
           srcImg:'https://image.flaticon.com/icons/svg/190/190737.svg',
           idSerie: null,
            image: {desc: '', pos: '', url:''},
            cloudinary: {
            uploadPreset: 'zd3qooug',
           apiKey: '723938656429625',
           cloudName: 'kelmoua1u'
       }, f:'',
       thumb: {
         url: ''
       },
       thumbs: [],
       maps_refs:"",
       selected:"",
       latitude:"",
       longitude :"",
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
      }
   
         },
    computed: {
      clUrl: function() {
          return `https://api.cloudinary.com/v1_1/kelmoua1u/image/upload`  
          },                
    }
       ,mounted(){
         if(this.$store.state.token == "")
         {
           alert("Connectez-vous Svp ! ")
           this.$router.push("/");
         }else{
           
         this.getSeries();
         this.geolocate();
         this.$store.state.isConnect= true;
           
         }
       },
     
       methods: {
         handleFileUpload: function(file) {
        const formData = new FormData()
        formData.append('file', file[0]);
        formData.append('upload_preset', this.cloudinary.uploadPreset);
        formData.append('tags', 'gs-vue,gs-vue-uploaded');
        // For debug purpose only
        // Inspects the content of formData
        for(var pair of formData.entries()) {
          console.log(pair[0]+', '+pair[1]);
        }
        axios.post(this.clUrl, formData).then(res => {
          
          this.f=res.data.secure_url
        }).catch(error => console.log(error))
      },
    
    getSeries(){
        axios.get("series").then(response => {
          this.$store.commit("setSeries", response.data.result);
          console.log(response.data)
          
          
        }).catch(error => console.log(error));
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
       },
       addPicture(){
         if(this.description && this.f && this.idSerie)           
         if(!this.description) alert("description required.");
         if(!this.f) alert("Image required.");
         
   
         axios.post('photos',{
                        userId :  this.$store.state.user.id,
                        description :     this.description,
                        url:this.f,
                        lng:this.center.lat,
                        lat:this.center.lng,
                        serieId : this.serieId,
                      },{
                          headers: {
                          Authorization: 'Bearer ' + this.$store.state.token,
                          }
                        }).then(response => {
                        console.log(response.data)
                        alert("Loading...........")
                        this.$router.go();
                      }).catch(error => console.log(error))
         
       },geolocate: function() {
         navigator.geolocation.getCurrentPosition(position => {
           this.center = {
             lat: position.coords.latitude,
             lng: position.coords.longitude
           };
         });
       }
       
         
       ,
       onChange(event){
          this.serieId =event.target.value
          axios.get("series/"+this.serieId).then(response => {
          console.log(response.data),
          this.maps_refs=response.data.result.map_refs
        
         let str = this.maps_refs.replace(/\[/g,"")
         str=str.replace(/\]/g,"") 
        
         let t =str.split(',')
         this.latitude = parseFloat(t[0])
        this.longitude =  parseFloat(t[1])
         const marker = {
            lat: this.latitude,
            lng: this.longitude
          };
          this.center = marker;
          this.currentPlace = null;
          alert("Veuillez svp choisir la position exacte du photo dans la Map")
       
        }).catch(error => console.log(error));
   
   
       }
    }
       }
     
</script>