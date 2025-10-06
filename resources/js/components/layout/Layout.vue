<template>
  <div class="min-h-screen bg-gray-100 dark:bg-gray-900">
    <Header />
    
    <div class="flex">
      <Sidebar />
      
      <div class="flex-1 md:ml-64">
        <main class="py-6">
          <div class="max-w-7xl mx-auto px-4 sm:px-6 md:px-8">
            <slot />
          </div>
        </main>
      </div>
    </div>
  </div>
</template>

<script setup>
import Header from './Header.vue'
import Sidebar from './Sidebar.vue'
</script>