<template>
  <div class="body">
    <div class="container">
      <h1>Vérifier votre boite de réception</h1>
      <img src="../assets/checkmail1.jpeg" alt="Image de réinitialisation du mot de passe">
      <p>Un e-mail de réinitialisation de votre mot de passe devrait vous parvenir prochainement.</p>
      <p class="warning">Si vous ne le recevez pas, veuillez vérifier votre dossier de courrier indésirable (spam), car il
        peut parfois s'y trouver !</p>
      <hr>


      <form @submit.prevent="resetPassword">
        <h5>Veuillez saisr le code confidentiel que vous avez reçu: </h5>
        <input class="form-control  mb-3" style="height: 50px;" id="inputEmail" type="text"
          placeholder="Code confidentiel" v-model="code" autocomplete="off" required />

        <div class="d-flex align-items-center justify-content-between mt-4 mb-0">

          <router-link :to="Password"> <a href="#" class="small">Revenir</a></router-link>

          <router-link :to="ResetPassword"> <a href='#' class="btn " type="submit"  style="text-decoration: none;">Réinitialiser le mot de passe</a>
          </router-link>
        </div>


      </form>
    </div>
  </div>
</template>

<script>
import Password from './Password.vue';

export default {
  data() {
    return {
      code: '',
      email: '',
      Password: '/Password',
      password: '',
      passwordError: '',
      home: '/',
      checkemail: 'checkemail',
      ResetPassword: 'ResetPassword',
    };
  },
  methods: {
    resetPassword() {
      // Code pour réinitialiser le mot de passe
      // Utilisez this.code pour accéder au code confidentiel entré
    }
  }
};
</script>

<style>
.body {
  font-family: Arial, sans-serif;
  text-align: center;
  background-color: #343090;
}

.container {
  max-width: 600px;
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
}

.warning {
  color: #ff0000;
  font-weight: bold;
}

form {
  margin-top: 20px;
}

input[type="text"] {
  width: 100%;
  padding: 10px;
  border: 1px solid #ccc;
  border-radius: 5px;
  box-sizing: border-box;
  margin-bottom: 10px;
}

button[type="submit"] {
  padding: 10px 20px;
  background-color: #007bff;
  color: #fff;
  border: none;
  border-radius: 5px;
  cursor: pointer;
}

button[type="submit"]:hover {
  background-color: #0056b3;
}

h5 {
  text-align: left;
  color: #343090;
}
</style>
