<template>
  <div class="container-xxl">
    <div class="authentication-wrapper authentication-basic container-p-y">
      <div class="authentication-inner py-4">
        <!-- Login -->
        <div class="card">
          <div class="card-body">
            <!-- Logo -->
            <div class="app-brand justify-content-center mb-4 mt-2">
            </div>
              <form class="mt-8 bg-white rounded-lg shadow-xl overflow-hidden" @submit.prevent="submit" id="login-form">
                <div class="px-10 py-12">
                  <h1 class="text-center font-bold text-3xl">Welcome Back!</h1>
                  <div class="mx-auto mt-6 w-24 border-b-2"/>
                  <text-input v-model="form.email" :errors="$page.errors.email || []" class="mt-10" label="Email" type="email"
                              autofocus autocapitalize="off"/>
                  <text-input v-model="form.password" class="mt-6" label="Password" type="password"/>
                  <label class="mt-6 select-none flex items-center" for="remember">
                    <input id="remember" v-model="form.remember" class="mr-1" type="checkbox">
                    <span class="text-sm">Remember Me</span>
                  </label>
                </div>
                <div class="px-10 py-4 bg-gray-100 border-t border-gray-200 flex justify-between items-center">
                  <a class="hover:underline" tabindex="-1" href="#reset-password">Forget password?</a>
                  <loading-button :loading="sending" class="btn-indigo" type="submit">Login</loading-button>
                </div>
              </form>
          </div>
        </div>
      </div>
    </div>
  </div>
</template>

<script>
import LoadingButton from '@/Shared/LoadingButton'
import Logo from '@/Shared/Logo'
import TextInput from '@/Shared/TextInput'

export default {
  metaInfo: {title: 'Login'},
  components: {
    LoadingButton,
    Logo,
    TextInput,
  },
  props: {
    errors: Object,
  },
  data() {
    return {
      sending: false,
      form: {
        email: 'johndoe@example.com',
        password: 'secret',
        remember: null,
      },
    }
  },
  methods: {
    submit() {
      this.sending = true
      this.$inertia.post(this.route('login.attempt'), {
        email: this.form.email,
        password: this.form.password,
        remember: this.form.remember,
      }).then(() => this.sending = false)
    },
  },
}
</script>
