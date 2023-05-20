<template>

<div class="custom-bg-color ">
        <div id="layoutAuthentication bg-warning">
            <div id="layoutAuthentication_content  ">
                <main>
                    <div class="container ">
                        <div class="row justify-content-center">
                            <div class="col-lg-5">
                                <div class="card shadow-lg border-0 rounded-lg mt-5 ">
                                    <div class="card-header" ><h3 class="text-center font-weight-light my-4">CONNEXION A VOTRE COMPTE</h3></div>
                                    <div class="card-body">
                                        <form  @submit="HandleSubmit">
												<label for="inputEmail" class="mb-2">Adresse E-mail : </label><br>
                                                <input class="form-control  mb-3" style="height: 50px;" id="inputEmail" type="email" placeholder="nom@exemple.com" autocomplete="off" v-model="email" required />

                                            
												<label for="inputPassword" class="mb-2">Mot de passe :</label><br>
                                                <input class="form-control" style="height: 50px;" id="inputPassword" type="password" placeholder="********" autocomplete="off" v-model="password" required />
                                            
                                            <div class="d-flex align-items-center justify-content-between mt-4 mb-0">
												
												<router-link :to="Password"> <a href="#" class="small ">Mot de passe oublié?</a></router-link>

												<router-link :to="platform"> <a href="#" class="btn " id="submit">Se Connecter</a></router-link>

												
                                            </div>
                                        </form>
                                    </div>
                                    
                                </div>
                            </div>
                        </div>
                    </div>
                </main>
            </div>
            
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
			platform: '/platform',
			Password:'/Password',
			home:'/',
			checkemail:'checkemail'
			
		}
	},

	methods: {

		
		HandleSubmit() {
			axios.post('/api/', {
				email: this.email,
				password: this.password
			})
				.then(response => {
					const user = response.data.user
					const token = response.data.token
					localStorage.setItem('user', JSON.stringify(user))
					localStorage.setItem('token', token)
					this.$router.push('/platform')
				})
				.catch(error => {
					console.log(error)
				})
		}

		
	}




}



</script>


<style>
       /* <script src="https://use.fontawesome.com/releases/v6.3.0/js/all.js" crossorigin="anonymous"></script>

	    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.bundle.min.js" crossorigin="anonymous"></script>
        <script src="js/scripts.js"></script>
*/
/*submit botton*/
/* #submit:hover{ */
	/* background-color:red; */
/* } */
</style>





















