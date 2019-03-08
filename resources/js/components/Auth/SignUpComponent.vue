<template>
    <div>
        <a class="flex flex-col items-center" @click="isOpenModal = true">
            <svg xmlns="http://www.w3.org/2000/svg" class="h-8 w-8">
                <use class="text-orange-dark fill-current" href="/svg/icons.svg#login"></use>
            </svg>
            <h4 class="opacity-75 font-normal">Se connecter</h4>
        </a>
        <modal-component @closeModal="isOpenModal = false" v-if="isOpenModal">
            <login-component @forgotPassword="activeComponent = 'forgot-pass'" @showRegister="activeComponent = 'register'" v-if="activeComponent === 'login'"></login-component>
            <register-component @showLogin="activeComponent = 'login'" v-if="activeComponent === 'register'"></register-component>
            <forgot-pass-component @showLogin="activeComponent = 'login'" v-if="activeComponent === 'forgot-pass'"></forgot-pass-component>
        </modal-component>
    </div>
</template>

<script>
import ModalComponent from '../ModalComponent'
import LoginComponent from './LoginComponent'
import RegisterComponent from './RegisterComponent'
import ForgotPassComponent from './ForgotPassComponent'

export default {
    components: {ModalComponent, LoginComponent, RegisterComponent, ForgotPassComponent},
    data() {
        return {
            isOpenModal: false,
            activeComponent: 'login'
        }
    },
}
</script>
