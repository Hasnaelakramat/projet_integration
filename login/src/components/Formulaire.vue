<template>
	<head>
	
<!--===============================================================================================-->	
	<link rel="icon" type="image/png" href="images/icons/favicon.ico"/>
<!--===============================================================================================-->
	<link rel="stylesheet" type="text/css" href="vendor/bootstrap/css/bootstrap.min.css">
<!--===============================================================================================-->
	<link rel="stylesheet" type="text/css" href="fonts/font-awesome-4.7.0/css/font-awesome.min.css">
<!--===============================================================================================-->
	<link rel="stylesheet" type="text/css" href="fonts/Linearicons-Free-v1.0.0/icon-font.min.css">
<!--===============================================================================================-->
	<link rel="stylesheet" type="text/css" href="vendor/animate/animate.css">
<!--===============================================================================================-->	
	<link rel="stylesheet" type="text/css" href="vendor/css-hamburgers/hamburgers.min.css">
<!--===============================================================================================-->
	<link rel="stylesheet" type="text/css" href="vendor/animsition/css/animsition.min.css">
<!--===============================================================================================-->
	<link rel="stylesheet" type="text/css" href="vendor/select2/select2.min.css">
<!--===============================================================================================-->	
	<link rel="stylesheet" type="text/css" href="vendor/daterangepicker/daterangepicker.css">
<!--===============================================================================================-->
	<link rel="stylesheet" type="text/css" href="css/util.css">
	<link rel="stylesheet" type="text/css" href="css/main.css">
<!--===============================================================================================-->
</head>
	
	<div class="limiter">
		<div class="container-login100">
			<div class="wrap-login100">
				<div class="login100-form-title" style="background-image: url(Login_v15/images/uae.png);">
					<span class="login100-form-title-1">
						CONNECTION A VOTRE COMPTE
					</span>
				</div>

				<form @submit.prevent="submitForm" class="login100-form validate-form">
					<div class="wrap-input100 validate-input m-b-26" data-validate="Username is required">
						<span class="label-input100" style="display: inline;" >Adresse Email :</span>
						<input class="input100" type="email" name="email" placeholder="Entrer votre email" v-model="email"
							required>
							
						<span class="focus-input100"></span>
					</div>

					<div class="wrap-input100 validate-input m-b-18" data-validate="Password is required">
						<span class="label-input100">Mot de passe :</span>
						<input class="input100" type="password" name="pass" placeholder="Entrer votre mot de passe"
							v-model="password" required>
						<div v-if="passwordError" class="error">{{ passwordError }}</div>
						<span class="focus-input100"></span>
					</div>

					<div class="flex-sb-m w-full p-b-30">

						<div>
							<a class="txt1" @click.prevent="ReinitialiserMDP" href="#">Mot de passe oublié?</a>

						</div>
					</div>

					<div class="container-login100-form-btn">
						<router-link :to="platform" class="router-link"> <button type="submit" class="login100-form-btn">
								Se Connecter
							</button></router-link>
					</div>
				</form>
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
			platform: '/platform'
			
		}
	},

	methods: {

		
		HandleSubmit() {
			axios.post('/api/login', {
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
.login100-form-btn {
	display: -webkit-box;
	display: -webkit-flex;
	display: -moz-box;
	display: -ms-flexbox;
	display: flex;
	justify-content: center;
	align-items: center;
	padding: 0 20px;
	min-width: 160px;
	height: 50px;
	background-color: orange;
	border-radius: 25px;

	font-family: Poppins-Regular;
	font-size: 16px;
	color: #fff;
	line-height: 1.2;

	-webkit-transition: all 0.4s;
	-o-transition: all 0.4s;
	-moz-transition: all 0.4s;
	transition: all 0.4s;
	text-decoration: none;
}

.login100-form-btn:hover {
	background-color: blue;
}
</style>





















