<template>
   <div id="m" style="width:100%; height:10%">
      <nav v-bind:class="active" v-on:click.prevent v-if=" $store.state.testnav !== false">
         <div style="width :95%;height:90%;  ">
            <img src="../assets/logo.png" style="width 90%;height:90%;float: left;margin-top:0.5%">
            <h1 style="  color: white; float: left; margin-left:2%;margin-top:1%;">GéoQuizz</h1>
            <h6 style="float:right;margin-top:1%" >Player : {{$store.state.pseudo}}</h6>
         </div>
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
           this.$router.push("/register");
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
         this.$router.push("/");
       }
     }
   }
</script>
<style>
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
   font: 'Open Sans', sans-serif;
   color:03AA6F
   }
   nav h6{
   display:inline-block;
   color:#03AA6F !important;
   font-size:22px;
   font-family: 'Trebuchet MS';
   text-decoration:none !important;
   line-height:1;
   background-color:transparent;
   border-radius: 10%;
   -webkit-transition:background-color 0.25s;
   -moz-transition:background-color 0.25s;
   transition:background-color 0.25s;
   }
</style>