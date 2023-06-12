@extends('layout')
@section('contenu')
    <div class="container">
        <div class="logo">
            <img src="{{ asset('/images/1-l.jpeg') }}" alt="Logo" width="150">
        </div>
        <p class="message">Bonjour Monsieur,</p>
        <p>Vous avez été ajouté avec succès.</p>
        <div class="credentials">
            <p>E-mail: <strong>{{ $user->email }}</strong></p>
            <p>Mot de passe: <strong>{{ $password }}</strong></p>
        </div>
        <p>Vous pouvez vous connecter à l'application en utilisant ces informations.</p>
        <div class="button">
            <a href="#" target="_blank">Connect</a>
        </div>
    </div>
@endsection

