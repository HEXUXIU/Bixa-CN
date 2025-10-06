<template>
  <div class="min-h-screen flex items-center justify-center bg-gray-50 py-12 px-4 sm:px-6 lg:px-8">
    <div class="max-w-md w-full space-y-8">
      <div>
        <img class="mx-auto h-12 w-auto" src="/build/images/logo.svg" alt="Bixa">
        <h2 class="mt-6 text-center text-3xl font-extrabold text-gray-900">
          {{ $t('auth.login') }}
        </h2>
        <p class="mt-2 text-center text-sm text-gray-600">
          {{ $t('auth.no_account') }}
          <a href="/register" class="font-medium text-blue-600 hover:text-blue-500">
            {{ $t('auth.register_now') }}
          </a>
        </p>
      </div>
      <form class="mt-8 space-y-6" @submit.prevent="login">
        <div class="rounded-md shadow-sm -space-y-px">
          <div>
            <label for="email" class="sr-only">{{ $t('auth.email') }}</label>
            <input 
              id="email" 
              v-model="email" 
              name="email" 
              type="email" 
              required 
              class="appearance-none rounded-none relative block w-full px-3 py-2 border border-gray-300 placeholder-gray-500 text-gray-900 rounded-t-md focus:outline-none focus:ring-blue-500 focus:border-blue-500 focus:z-10 sm:text-sm"
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
              class="appearance-none rounded-none relative block w-full px-3 py-2 border border-gray-300 placeholder-gray-500 text-gray-900 rounded-b-md focus:outline-none focus:ring-blue-500 focus:border-blue-500 focus:z-10 sm:text-sm"
              :placeholder="$t('auth.password')"
            >
          </div>
        </div>

        <div class="flex items-center justify-between">
          <div class="flex items-center">
            <input 
              id="remember-me" 
              v-model="remember" 
              name="remember-me" 
              type="checkbox" 
              class="h-4 w-4 text-blue-600 focus:ring-blue-500 border-gray-300 rounded"
            >
            <label for="remember-me" class="ml-2 block text-sm text-gray-900">
              {{ $t('auth.remember_me') }}
            </label>
          </div>

          <div class="text-sm">
            <a href="/password/reset" class="font-medium text-blue-600 hover:text-blue-500">
              {{ $t('auth.forgot_password') }}
            </a>
          </div>
        </div>

        <div>
          <button 
            type="submit" 
            class="group relative w-full flex justify-center py-2 px-4 border border-transparent text-sm font-medium rounded-md text-white bg-blue-600 hover:bg-blue-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-blue-500"
            :disabled="loading"
          >
            <span v-if="!loading">{{ $t('common.login') }}</span>
            <span v-else>{{ $t('common.loading') }}</span>
          </button>
        </div>
      </form>
      
      <!-- Social Login Options -->
      <div class="mt-6">
        <div class="relative">
          <div class="absolute inset-0 flex items-center">
            <div class="w-full border-t border-gray-300"></div>
          </div>
          <div class="relative flex justify-center text-sm">
            <span class="px-2 bg-gray-50 text-gray-500">
              {{ $t('common.or') }}
            </span>
          </div>
        </div>

        <div class="mt-6 grid grid-cols-3 gap-3">
          <div>
            <a href="/auth/google" class="w-full inline-flex justify-center py-2 px-4 border border-gray-300 rounded-md shadow-sm bg-white text-sm font-medium text-gray-500 hover:bg-gray-50">
              <img class="h-5 w-5" src="/build/images/social/google.svg" alt="Google">
            </a>
          </div>
          <div>
            <a href="/auth/github" class="w-full inline-flex justify-center py-2 px-4 border border-gray-300 rounded-md shadow-sm bg-white text-sm font-medium text-gray-500 hover:bg-gray-50">
              <img class="h-5 w-5" src="/build/images/social/github.svg" alt="GitHub">
            </a>
          </div>
          <div>
            <a href="/auth/facebook" class="w-full inline-flex justify-center py-2 px-4 border border-gray-300 rounded-md shadow-sm bg-white text-sm font-medium text-gray-500 hover:bg-gray-50">
              <img class="h-5 w-5" src="/build/images/social/facebook.svg" alt="Facebook">
            </a>
          </div>
        </div>
      </div>
    </div>
  </div>
</template>

<script setup>
import { ref } from 'vue'
import { useI18n } from 'vue-i18n'
import api from '../../utils/api'

const { t } = useI18n()
const email = ref('')
const password = ref('')
const remember = ref(false)
const loading = ref(false)

const login = async () => {
  loading.value = true
  try {
    const response = await api.post('/login', {
      email: email.value,
      password: password.value,
      remember: remember.value
    })
    
    // 登录成功后重定向
    window.location.href = response.data.redirect || '/dashboard'
  } catch (error) {
    console.error('Login failed:', error)
    alert(t('auth.failed'))
  } finally {
    loading.value = false
  }
}
</script>