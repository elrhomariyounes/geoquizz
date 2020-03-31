<template>
   <div class="global">
      <div class="Menu">
         <link
            rel="stylesheet"
            href="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css"
            integrity="sha384-Vkoo8x4CGsO3+Hhxv8T/Q5PaXtkKtu6ug5TOeNV6gBiFeWPGFN9MuhOf23Q9Ifjh"
            crossorigin="anonymous"
            />
         <center>
            <div class="conv">
               <button class="btnmenu btnconv" @click="linktoSerie">
                  <img class="imgbtn" src="../assets/serie.png"><br> 
                  <h2>Serie</h2>
               </button>
               <button class="btnmenu btnmemb" @click="linktoPictures">
                  <img class="imgbtn" src="../assets/photo.png"><br> 
                  <h2>Photo</h2>
               </button>
               <button class="btnmenu btnmemb" @click="linktoPicturesMobile">
                  <img class="imgbtn" src="../assets/mobile.png"><br> 
                  <h2>PhotoMobile</h2>
               </button>
            </div>
         </center>
      </div>
   </div>
</template>
<script>
   export default {
     components: {
      
     },
     name: "Menu",
     mounted() {
       if(this.$store.state.token == "")
         {
           alert("Connectez-vous Svp ! ")
           this.$router.push("/");
         }else{
   
         this.$store.state.isConnect= false;
         }
     },
     methods: {
       
       linktoSerie: function() {
         this.$router.push("/series");
       },
       linktoPictures: function() {
         this.$router.push("/pictures");
       }
       ,
       linktoPicturesMobile: function() {
         this.$router.push("/oldpictures");
       }
     }
   };
</script>
<style>
   .btnmenu{
   background-color: #DEE3E4;
   width: 20%;
   border: none;
   color: rgb(82, 69, 49);
   padding: 20px;
   text-align: center;
   text-decoration: none;
   display: inline-block;
   margin:20px;
   border-radius: 10%;
   }
   .imgbtn{
   width: 80px;
   height: 80px;
   }
   .conv{
   padding-top: 12%;
   }
</style>