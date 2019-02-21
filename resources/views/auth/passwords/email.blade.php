@extends('layouts.app')

@section('content')
    <div class="flex justify-center mt-16">
        <form action="{{ route('forgot_password') }}" method="POST" class="w-1/5 px-8 pt-6 pb-8 mb-4">
            @csrf
            <div class="mb-4">
                <label class="block text-grey-darker text-sm font-bold mb-2" for="email">
                    Email
                </label>
                <input class="shadow appearance-none border rounded w-full py-2 px-3 text-grey-darker leading-tight focus:outline-none focus:border-grey" name="email" id="email" type="email" placeholder="Votre email">
            </div>
            <button type="submit" class="translateY focus:outline-none bg-orange-dark hover:bg-orange text-white font-bold py-3 px-4 rounded">
                Réinitialiser son mot de passe
            </button>
        </form>
    </div>
@endsection
