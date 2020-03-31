<template>
   <div>
      <center>
         <div style="position:relative; 
            display:inline-block; 
            float:right; width:100%;"> 
            <button style="float:right;width:8%; margin-right:0.5%; padding: 8px 15px;" @click="goToHelp">Help </button>
            <button style="float:right;width:8%; margin-right:0.5%;padding: 8px 15px; " @click="goToTop"> Top </button>
         </div>
         <div style="widht:50%;height:50%">
            <img src="../assets/logo.png" style="width:20%;height:20%">
            <h1 style="color:white">GéoQuizz</h1>
            <input type="text" placeholder="Pseudo" v-model="pseudo"><br>
            <button  class ="btnHome" @click="goToGame">Jouer</button>
         </div>
      </center>
   </div>
</template>
<script>
   export default {
      
     data() {
       return {
           pseudo:''
       }
       
   },
   mounted()
   {
     this.$store.state.testnav=false
   },
   methods:{
   
       goToGame(){
           
           this.$store.state.pseudo=this.pseudo
           this.$router.push("/list");
       },
       goToTop()
       {
           this.$router.push("/topscore");
       },
       goToHelp()
       {
           this.$router.push("/help");
       }
   }
   }
</script>
<style lang="scss">
   body{
   background-image: url("../assets/map.jpg");
   background-size: cover;
   }
   input {
   background-color: #eee;
   border: none;
   padding: 8px 15px;
   margin: 6px 0;
   width: 20%;
   border-radius: 15px;
   border-bottom: 1px solid #ddd;
   box-shadow: inset 0 1px 2px rgba(0, 0, 0, .4), 
   0 -1px 1px #fff, 
   0 1px 0 #fff;
   overflow: hidden;
   &:focus {
   outline: none;
   background-color: #fff;
   }
   }
   .btnHome{
   border-radius: 20px;
   border: 1px solid #03AA6F;
   background-color: #03AA6F;
   color: #fff;
   font-size: 1rem;
   font-weight: bold;
   padding: 10px 40px;
   letter-spacing: 1px;
   text-transform: uppercase;
   cursor: pointer;
   transition: transform .1s ease-in;
   &:active {
   transform: scale(.9);
   }
   &:focus {
   outline: none;
   }
   }
</style>