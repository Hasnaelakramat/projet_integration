

<template >
<div class="body">
  <div class="container">
    <h1>Réinitialisation du mot de passe</h1>
    <img src="../assets/checkmail1.jpeg" alt="Image de réinitialisation du mot de passe">
    <p>Un e-mail de réinitialisation de votre mot de passe devrait vous parvenir prochainement.</p>
    <p class="warning">Si vous ne le recevez pas, veuillez vérifier votre dossier de courrier indésirable (spam), car il peut parfois s'y trouver !</p>
  </div>
</div>
</template>
  
<script>
export default {

  data() {
    return {
      email: '',
      password: '',
      passwordError: '',
      home: '/',
      checkemail:'checkemail'

    }
  },

  methods: {
    ForgotPassword(){

    }




  }




}



</script>

<style>


.body {
      font-family: Arial, sans-serif;
      text-align: center;
      background-color: #f7f7f7;
    }
    .container {
     
      max-width: 500px;
      margin: 0 auto;
      padding: 20px;
      background-color: #fff;
      border-radius: 5px;
      box-shadow: 0 2px 5px rgba(0, 0, 0, 0.1);
    }

    h1 {
      color: #333;
      margin-top: 0;
    }

    p {
      margin: 20px 0;
      line-height: 1.5;
     line-height: 1.5;
    }

    .warning {
      color: #ff0000;
      font-weight: bold;
    }
  </style>
 