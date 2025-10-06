<template>
  <header class="bg-white dark:bg-gray-800 shadow">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
      <div class="flex justify-between h-16">
        <div class="flex">
          <div class="flex-shrink-0 flex items-center">
            <img class="h-8 w-auto" src="/build/images/logo.svg" alt="Bixa">
            <span class="ml-2 text-xl font-bold text-gray-900 dark:text-white">{{ $t('common.dashboard') }}</span>
          </div>
          <div class="hidden sm:ml-6 sm:flex sm:space-x-8">
            <!-- Current page: "border-blue-500 text-gray-900", Default: "border-transparent text-gray-500 hover:border-gray-300 hover:text-gray-700" -->
            <a href="#" class="border-blue-500 text-gray-900 dark:text-white inline-flex items-center px-1 pt-1 border-b-2 text-sm font-medium">
              {{ $t('common.dashboard') }}
            </a>
            <a href="#" class="border-transparent text-gray-500 dark:text-gray-300 hover:border-gray-300 hover:text-gray-700 dark:hover:text-gray-200 inline-flex items-center px-1 pt-1 border-b-2 text-sm font-medium">
              {{ $t('common.hosting') }}
            </a>
            <a href="#" class="border-transparent text-gray-500 dark:text-gray-300 hover:border-gray-300 hover:text-gray-700 dark:hover:text-gray-200 inline-flex items-center px-1 pt-1 border-b-2 text-sm font-medium">
              {{ $t('common.tickets') }}
            </a>
            <a href="#" class="border-transparent text-gray-500 dark:text-gray-300 hover:border-gray-300 hover:text-gray-700 dark:hover:text-gray-200 inline-flex items-center px-1 pt-1 border-b-2 text-sm font-medium">
              {{ $t('common.knowledge') }}
            </a>
          </div>
        </div>
        <div class="hidden sm:ml-6 sm:flex sm:items-center">
          <!-- Notification button -->
          <button type="button" class="bg-white dark:bg-gray-800 p-1 rounded-full text-gray-400 hover:text-gray-500 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-blue-500">
            <span class="sr-only">{{ $t('common.notifications') }}</span>
            <!-- Heroicon name: outline/bell -->
            <svg class="h-6 w-6" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor" aria-hidden="true">
              <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 17h5l-1.405-1.405A2.032 2.032 0 0118 14.158V11a6.002 6.002 0 00-4-5.659V5a2 2 0 10-4 0v.341C7.67 6.165 6 8.388 6 11v3.159c0 .538-.214 1.055-.595 1.436L4 17h5m6 0v1a3 3 0 11-6 0v-1m6 0H9" />
            </svg>
          </button>

          <!-- Language switcher -->
          <LanguageSwitcher class="ml-3" />

          <!-- Profile dropdown -->
          <div class="ml-3 relative">
            <div>
              <button type="button" class="bg-white dark:bg-gray-800 flex text-sm rounded-full focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-blue-500" id="user-menu-button" aria-expanded="false" aria-haspopup="true">
                <span class="sr-only">{{ $t('common.profile') }}</span>
                <img class="h-8 w-8 rounded-full" src="https://ui-avatars.com/api/?name=John+Doe&background=0D8ABC&color=fff" alt="">
              </button>
            </div>
          </div>
        </div>
        <div class="-mr-2 flex items-center sm:hidden">
          <!-- Mobile menu button -->
          <button type="button" class="bg-white dark:bg-gray-800 inline-flex items-center justify-center p-2 rounded-md text-gray-400 hover:text-gray-500 hover:bg-gray-100 dark:hover:bg-gray-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-blue-500" aria-controls="mobile-menu" aria-expanded="false">
            <span class="sr-only">{{ $t('common.open_main_menu') }}</span>
            <!-- Heroicon name: outline/menu -->
            <svg class="block h-6 w-6" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor" aria-hidden="true">
              <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16" />
            </svg>
            <!-- Heroicon name: outline/x -->
            <svg class="hidden h-6 w-6" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor" aria-hidden="true">
              <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" />
            </svg>
          </button>
        </div>
      </div>
    </div>

    <!-- Mobile menu, show/hide based on menu state. -->
    <div class="sm:hidden" id="mobile-menu">
      <div class="pt-2 pb-3 space-y-1">
        <!-- Current page: "bg-blue-50 border-blue-500 text-blue-700", Default: "border-transparent text-gray-600 hover:bg-gray-50 hover:border-gray-300 hover:text-gray-800" -->
        <a href="#" class="bg-blue-50 border-blue-500 text-blue-700 dark:bg-gray-900 dark:border-gray-700 dark:text-blue-400 block pl-3 pr-4 py-2 border-l-4 text-base font-medium">{{ $t('common.dashboard') }}</a>
        <a href="#" class="border-transparent text-gray-600 dark:text-gray-300 hover:bg-gray-50 dark:hover:bg-gray-900 hover:border-gray-300 hover:text-gray-800 dark:hover:text-gray-200 block pl-3 pr-4 py-2 border-l-4 text-base font-medium">{{ $t('common.hosting') }}</a>
        <a href="#" class="border-transparent text-gray-600 dark:text-gray-300 hover:bg-gray-50 dark:hover:bg-gray-900 hover:border-gray-300 hover:text-gray-800 dark:hover:text-gray-200 block pl-3 pr-4 py-2 border-l-4 text-base font-medium">{{ $t('common.tickets') }}</a>
        <a href="#" class="border-transparent text-gray-600 dark:text-gray-300 hover:bg-gray-50 dark:hover:bg-gray-900 hover:border-gray-300 hover:text-gray-800 dark:hover:text-gray-200 block pl-3 pr-4 py-2 border-l-4 text-base font-medium">{{ $t('common.knowledge') }}</a>
      </div>
      <div class="pt-4 pb-3 border-t border-gray-200 dark:border-gray-700">
        <div class="flex items-center px-4">
          <div class="flex-shrink-0">
            <img class="h-10 w-10 rounded-full" src="https://ui-avatars.com/api/?name=John+Doe&background=0D8ABC&color=fff" alt="">
          </div>
          <div class="ml-3">
            <div class="text-base font-medium text-gray-800 dark:text-white">John Doe</div>
            <div class="text-sm font-medium text-gray-500 dark:text-gray-300">john@example.com</div>
          </div>
          <button type="button" class="ml-auto bg-white dark:bg-gray-800 flex-shrink-0 p-1 rounded-full text-gray-400 hover:text-gray-500 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-blue-500">
            <span class="sr-only">{{ $t('common.notifications') }}</span>
            <!-- Heroicon name: outline/bell -->
            <svg class="h-6 w-6" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor" aria-hidden="true">
              <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 17h5l-1.405-1.405A2.032 2.032 0 0118 14.158V11a6.002 6.002 0 00-4-5.659V5a2 2 0 10-4 0v.341C7.67 6.165 6 8.388 6 11v3.159c0 .538-.214 1.055-.595 1.436L4 17h5m6 0v1a3 3 0 11-6 0v-1m6 0H9" />
            </svg>
          </button>
        </div>
        <div class="mt-3 space-y-1">
          <a href="#" class="block px-4 py-2 text-base font-medium text-gray-500 dark:text-gray-300 hover:text-gray-800 dark:hover:text-gray-200 hover:bg-gray-100 dark:hover:bg-gray-900">{{ $t('common.profile') }}</a>
          <a href="#" class="block px-4 py-2 text-base font-medium text-gray-500 dark:text-gray-300 hover:text-gray-800 dark:hover:text-gray-200 hover:bg-gray-100 dark:hover:bg-gray-900">{{ $t('common.settings') }}</a>
          <a href="#" class="block px-4 py-2 text-base font-medium text-gray-500 dark:text-gray-300 hover:text-gray-800 dark:hover:text-gray-200 hover:bg-gray-100 dark:hover:bg-gray-900">{{ $t('common.logout') }}</a>
        </div>
      </div>
    </div>
  </header>
</template>

<script setup>
import LanguageSwitcher from '../common/LanguageSwitcher.vue'
import { useI18n } from 'vue-i18n'

const { t } = useI18n()
</script>