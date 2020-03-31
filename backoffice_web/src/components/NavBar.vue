<template>
   <div id="main">
      <nav v-bind:class="active" v-on:click.prevent v-if=" $store.state.isConnect==true">
         <a href="#" class="home" v-on:click="linktoMenu('home')">Home</a>
         <a href="#" class="projects" v-on:click="linktoSerie('projects')">Serie</a>
         <a href="#" class="services" v-on:click="linktoPictures('services')">Photo</a>
         <a href="#" class="photo" v-on:click="linktoPicturesMobile('photo')">Photo Mobile</a>
         <a href="#" class="contact"  style="float:right" v-on:click="logout()"><img src="../assets/power.png" style="width:30px;height:30px ; margin-top:-10px;"></a>
      </nav>
   </div>
</template>
<script>
   export default {
        data() {
            return{
       active: 'home'
     }},
     methods: {
       makeActive: function(item){
           this.active = item;
       },
       logout (){
           this.$store.commit("Logout");
           this.$router.push("/");
       },
       linktoSerie: function(item) {
           this.active = item;
           this.$router.push("/series");
         
       },
       linktoPictures: function(item) {
           this.active = item;
         this.$router.push("/pictures");
       }
       ,
       linktoPicturesMobile: function(item) {
           this.active = item;
         this.$router.push("/oldpictures");
       },
       linktoMenu: function() {
         this.$router.push("/home");
       }
     }
   }
</script>
<style>
   *{
   margin:0;
   padding:0;
   }
   a, a:visited {
   outline:none;
   color:#389dc1;
   }
   a:hover{
   text-decoration:none;
   }
   section, footer, header, aside, nav{
   display: block;
   }
   /*-------------------------
   The menu
   --------------------------*/
   nav{
   display:inline-block;
   background-color:#383838;
   box-shadow:0 1px 1px #0f0f0f;
   border-radius:2px;
   width: 100%;
   height: 70px;
   font:15px/1.3 'Open Sans', sans-serif;
   color: #5e5b64;
   text-align:center;
   }
   nav a{
   display:inline-block;
   padding: 18px 30px;
   color:#D39736 !important;
   font-size:14px;
   font-family: 'Trebuchet MS';
   text-decoration:none !important;
   line-height:1;
   text-transform: uppercase;
   background-color:transparent;
   border-radius: 10%;
   -webkit-transition:background-color 0.25s;
   -moz-transition:background-color 0.25s;
   transition:background-color 0.25s;
   }
   nav a:first-child{
   border-radius:2px 0 0 2px;
   }
   nav a:last-child{
   border-radius:0 2px 2px 0;
   }
   nav.home .home,
   nav.projects .projects,
   nav.services .services,
   nav.photo .photo,
   nav.contact .contact :hover{
   background-color:#1E1E1E;
   }
   p{
   font-size:22px;
   font-weight:bold;
   color:#7d9098;
   }
   p b{
   color:#ffffff;
   display:inline-block;
   padding:5px 10px;
   background-color:#c4d7e0;
   border-radius:2px;
   text-transform:uppercase;
   font-size:18px;
   }
</style>