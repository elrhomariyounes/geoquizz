<template>
   <div style="width:100%; height:100%">
      <center>
         <div style="width:30%; height:60%; background-color:#514545 ; border-radius:10%; color:white" >
            <br>
            <h2>
               <p> Mr :{{this.$store.state.pseudo}}</p>
            </h2>
            <h2>
               <p> Votre score est  : {{this.$store.state.score}}</p>
            </h2>
            <h2>
               <p> Temps écoulé  :{{tm}} min</p>
            </h2>
            <br><br>
         </div>
         <br>
      </center>
      <center>
         <button @click="save">Sauvegarder votre score</button><br><br><br>
         <button @click="goToList">Jouer une autre partie</button><br><br><br>
         <button @click="goToScore">Top Scores</button><br><br><br>
         <button @click="goToHome">Annuler</button>
      </center>
   </div>
</template>
<script>
   import axios from 'axios'
   export default {
       data(){
           return{
             tm:0
   
           }
           
       },
       mounted(){
           this.$store.state.testnav=false
           this.tm = Math.round(this.$store.state.timeGame/60)
           
       },
       methods:
       {
           save()
           {
                axios.put("games/"+this.$store.state.game.id+"?token="+this.$store.state.game.token,{
                score : this.$store.state.score,
                }).then(response => {
                console.log(response.data.result)
                this.$router.go();
                }).catch(error => console.log(error));
           },
           goToHome()
           {
              this.vider(),
              this.$store.state.pseudo = null,
              this.$router.push("/");
           },
           goToList(){
               this.vider()
               this.$router.push("/list");
           },
           goToScore()
           {
               this.$router.push("/score");
           },
           vider()
           {
               this.$store.state.score = '',
               this.$store.state.game='',
               this.$store.state.serie='',
               this.$store.state.difgame='',
               this.$store.state.timeGame=''
              
           }
       }
       
   }
</script>
<style lang="scss">
   button{
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