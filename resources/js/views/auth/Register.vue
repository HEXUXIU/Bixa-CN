<template>
  <div class="min-h-screen flex items-center justify-center bg-gray-50 py-12 px-4 sm:px-6 lg:px-8">
    <div class="max-w-md w-full space-y-8">
      <div>
        <img class="mx-auto h-12 w-auto" src="/build/images/logo.svg" alt="Bixa">
        <h2 class="mt-6 text-center text-3xl font-extrabold text-gray-900">
          {{ $t('auth.register') }}
        </h2>
        <p class="mt-2 text-center text-sm text-gray-600">
          {{ $t('auth.already_registered') }}
          <a href="/login" class="font-medium text-blue-600 hover:text-blue-500">
            {{ $t('auth.login_now') }}
          </a>
        </p>
      </div>
      <form class="mt-8 space-y-6" @submit.prevent="register">
        <div class="rounded-md shadow-sm -space-y-px">
          <div>
            <label for="name" class="sr-only">{{ $t('auth.name') }}</label>
            <input 
              id="name" 
              v-model="name" 
              name="name" 
              type="text" 
              required 
              class="appearance-none rounded-none relative block w-full px-3 py-2 border border-gray-300 placeholder-gray-500 text-gray-900 rounded-t-md focus:outline-none focus:ring-blue-500 focus:border-blue-500 focus:z-10 sm:text-sm"
              :placeholder="$t('auth.name')"
            >
          </div>
          <div>
            <label for="email" class="sr-only">{{ $t('auth.email') }}</label>
            <input 
              id="email" 
              v-model="email" 
              name="email" 
              type="email" 
              required 
              class="appearance-none relative block w-full px-3 py-2 border border-gray-300 placeholder-gray-500 text-gray-900 focus:outline-none focus:ring-blue-500 focus:border-blue-500 focus:z-10 sm:text-sm"
              :placeholder="$t('auth.email')"
            >
          </div>
          <div>
            <label for="password" class="sr-only">{{ $t('auth.password') }}</label>
            <input 
              id="password" 
              v-model="password" 
              name="password" 
              type="password" 
              required 
              class="appearance-none relative block w-full px-3 py-2 border border-gray-300 placeholder-gray-500 text-gray-900 focus:outline-none focus:ring-blue-500 focus:border-blue-500 focus:z-10 sm:text-sm"
              :placeholder="$t('auth.password')"
            >
          </div>
          <div>
            <label for="password_confirmation" class="sr-only">{{ $t('auth.confirm_password') }}</label>
            <input 
              id="password_confirmation" 
              v-model="passwordConfirmation" 
              name="password_confirmation" 
              type="password" 
              required 
              class="appearance-none rounded-none relative block w-full px-3 py-2 border border-gray-300 placeholder-gray-500 text-gray-900 rounded-b-md focus:outline-none focus:ring-blue-500 focus:border-blue-500 focus:z-10 sm:text-sm"
              :placeholder="$t('auth.confirm_password')"
            >
          </div>
        </div>

        <div>
          <button 
            type="submit" 
            class="group relative w-full flex justify-center py-2 px-4 border border-transparent text-sm font-medium rounded-md text-white bg-blue-600 hover:bg-blue-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-blue-500"
            :disabled="loading"
          >
            <span v-if="!loading">{{ $t('common.register') }}</span>
            <span v-else>{{ $t('common.loading') }}</span>
          </button>
        </div>
      </form>
    </div>
  </div>
</template>

<script setup>
import { ref } from 'vue'
import { useI18n } from 'vue-i18n'
import api from '../../utils/api'

const { t } = useI18n()
const name = ref('')
const email = ref('')
const password = ref('')
const passwordConfirmation = ref('')
const loading = ref(false)

const register = async () => {
  loading.value = true
  try {
    const response = await api.post('/register', {
      name: name.value,
      email: email.value,
      password: password.value,
      password_confirmation: passwordConfirmation.value
    })
    
    // 注册成功后重定向
    window.location.href = response.data.redirect || '/dashboard'
  } catch (error) {
    console.error('Registration failed:', error)
    alert(t('auth.failed'))
  } finally {
    loading.value = false
  }
}
</script>