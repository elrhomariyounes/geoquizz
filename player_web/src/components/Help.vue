<template>
   <div>
      <center>
         <button style="float : left"  @click="gotohome">Accueil</button>
         <div style="background-color:#03AA6F; width:40%; padding:40px; color: white ">
            <h1>GeoQuizz ?</h1>
            <p class="pp">
               Un jeu amusant où vous devez positionner une image sur la carte de votre ville sans faire d'erreurs et plus vite que les autres!
            </p>
            <h1>Règles:</h1>
            <p class="pp">
               <br>=> Saisissez votre pseudo 
               <br>=> Choisir la ville et le niveau souhaité
               <br>=> Trouvez l'emplacement de la photo sur la carte
               <br>=> Cliquez sur la position
               <br>=> Zoomez si vous en avez besoin
               <br>=> Plus la position est proche, plus il y a de points!
               <br>=> Plus vous êtes rapide, plus de points!
            </p>
            <h1>Calcul de points:</h1>
            <p class="pp">
               <br>=> pour 1 réponse placée à une distance inférieur à D : 5 points
               <br>=> pour 1 réponse placée à une distance inférieur à 2D : 3 points
               <br>=> pour 1 réponse placée à une distance inférieur à 3D : 1point!
               <br>
               <br>=> les points sont multipliés par 4 pour une réponse en moins de 5s
               <br>=> les points sont multipliés par 2 pour une réponse en moins de 10s
               <br>=> les points sont multipliés par 2 pour une réponse en moins de 20s
               <br>=> les points ne sont pas acquis pour 1 réponse en plus de 20s
            </p>
         </div>
      </center>
   </div>
</template>
<script>
   export default {
       mounted(){
           this.$store.state.testnav=false
       },
       methods:
       {
           gotohome()
           {
               this.$router.push("/");
           }
       }
   }
</script>
<style lang="scss">
   .pp{
   text-align :left
   }
</style>