<template>
  <div class="relative inline-block text-left">
    <button 
      @click="toggleDropdown" 
      class="flex items-center text-gray-700 hover:text-gray-900 dark:text-gray-300 dark:hover:text-white"
    >
      <span class="mr-1">{{ currentLanguageText }}</span>
      <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7"></path>
      </svg>
    </button>
    
    <div 
      v-if="isOpen" 
      class="absolute right-0 mt-2 w-32 bg-white dark:bg-gray-800 rounded-md shadow-lg py-1 z-50"
    >
      <button 
        v-for="lang in languages" 
        :key="lang.code"
        @click="changeLanguage(lang.code)"
        class="block w-full text-left px-4 py-2 text-sm text-gray-700 hover:bg-gray-100 dark:text-gray-300 dark:hover:bg-gray-700"
        :class="{ 'font-medium': lang.code === currentLanguage }"
      >
        {{ lang.name }}
      </button>
    </div>
  </div>
</template>

<script setup>
import { ref, onMounted, onUnmounted } from 'vue'
import { useI18n } from 'vue-i18n'
import { switchLanguage } from '../../i18n'

const { locale } = useI18n()
const isOpen = ref(false)
const languages = [
  { code: 'en', name: 'English' },
  { code: 'zh', name: '中文' }
]

const currentLanguage = ref(locale.value)
const currentLanguageText = ref(languages.find(lang => lang.code === currentLanguage.value)?.name || 'English')

const toggleDropdown = () => {
  isOpen.value = !isOpen.value
}

const changeLanguage = (lang) => {
  currentLanguage.value = lang
  currentLanguageText.value = languages.find(l => l.code === lang)?.name || 'English'
  switchLanguage(lang)
  isOpen.value = false
}

const handleClickOutside = (event) => {
  if (!event.target.closest('.relative')) {
    isOpen.value = false
  }
}

onMounted(() => {
  document.addEventListener('click', handleClickOutside)
})

onUnmounted(() => {
  document.removeEventListener('click', handleClickOutside)
})
</script>