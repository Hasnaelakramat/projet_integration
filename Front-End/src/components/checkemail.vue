<template>
  <div class="custom-bg-color">
    <div class="body">
      <div class="container mb-4">
        <div class="row justify-content-center">
              <div class="col">
                <div class="card border-0 rounded-lg ">
        <div class="card-header">
          <h3 class="my-4 text-nontransparent">Vérifiez votre boite de réception</h3>
        </div>
        <div class="card-body" style="background-color: white;">
          <form>
            <img src="../assets/checkmail1.jpeg" alt="Image de réinitialisation du mot de passe">
            <p>Un e-mail de réinitialisation de votre mot de passe devrait vous parvenir prochainement.</p>
            <p class="warning">Si vous ne le recevez pas, veuillez vérifier votre dossier de courrier indésirable (spam),
              car il peut parfois s'y trouver !</p>

            <div class="d-flex align-items-center justify-content-between mt-4 mb-0">
              <router-link :to="Password"><a href="#" class="small">Revenir</a></router-link>
              <router-link :to="ResetPassword"><a href='#' class="btn" type="submit"
                  style="text-decoration: none;">Suivant</a></router-link>
            </div>
          </form>
        </div>
        </div>
      </div>
    </div>

      </div>

      <footer class="py-3  mt-auto ">
                                        <div class="container-fluid px-4">
                                            <div class="d-flex align-items-center justify-content-between ">
                                                <div> Copyright &copy; <strong>HSup.UAE 2023</strong> </div>
                                                <div> Dévelopé par <em style="font-weight: bold;"> Guerriers</em>
                                                    <div>Made with 💜</div>

                                                </div>
                                            </div>

                                        </div>
                                    </footer>
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
      
    }
  }
};
</script>

<style>
.body {
  font-family: Arial, sans-serif;
  text-align: center;
}

.container {
  max-width: 600px;
  margin: 0 auto;
  padding: 20px;
  background-color: #fff;
  border-radius: 10px;
  box-shadow: 0 2px 5px rgba(0, 0, 0, 0.1);
}

/* .contain{
  max-width: 600px;
  max-height: 600px;
  margin-bottom: 100px;
  margin: 0 auto;
  padding: 20px;
  background-color: #fff;
  border-radius: 5px;
  box-shadow: 0 2px 5px rgba(0, 0, 0, 0.1);
} */
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





button[type="submit"] {
  padding: 10px 20px;
  background-color: #007bff;
  color: #fff;
  border: none;
  border-radius: 5px;
  cursor: pointer;
}



h5 {
  text-align: left;
  color: #343090;
}</style>
