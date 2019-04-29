<template>
    <div>
        <div class="cursor-pointer flex flex-col items-center" @click="isOpenModal = true">
            <slot></slot>
        </div>
        <modal-component @closeModal="isOpenModal = false" v-if="isOpenModal" contentWidth="25vw">
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
