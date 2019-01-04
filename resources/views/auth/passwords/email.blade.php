@extends('layouts.app')

@section('content')
<div class="container">
    <div class="flex justify-center">
        <form action="{{ route('forgot_password') }}" method="POST" class="w-1/3 bg-white shadow-md rounded px-8 pt-6 pb-8 mb-4">
            @csrf
            <div class="mb-4">
                <label class="block text-grey-darker text-sm font-bold mb-2" for="email">
                    Email
                </label>
                <input class="shadow appearance-none border rounded w-full py-2 px-3 text-grey-darker leading-tight focus:outline-none focus:shadow-outline" name="email" id="email" type="email" placeholder="Votre email">
            </div>
            <button type="submit" class="bg-blue hover:bg-blue-dark text-white font-bold py-2 px-4 rounded focus:outline-none focus:shadow-outline">
                Réinitialiser son mot de passe
            </button>
        </form>
    </div>
</div>
@endsection
