<template>
  <div class="p-6">
    <h1 class="text-2xl font-bold mb-4">{{ $t('dashboard.welcome', { name: user.name }) }}</h1>
    <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
      <!-- Hosting Accounts Card -->
      <div class="bg-white dark:bg-gray-800 rounded-lg shadow p-6">
        <h2 class="text-lg font-semibold mb-2">{{ $t('dashboard.hosting_accounts') }}</h2>
        <p class="text-3xl font-bold">{{ hostingCount }}</p>
        <button 
          @click="createHosting" 
          class="mt-4 bg-blue-500 hover:bg-blue-600 text-white px-4 py-2 rounded"
        >
          {{ $t('dashboard.create_hosting') }}
        </button>
      </div>
      
      <!-- Active Tickets Card -->
      <div class="bg-white dark:bg-gray-800 rounded-lg shadow p-6">
        <h2 class="text-lg font-semibold mb-2">{{ $t('dashboard.active_tickets') }}</h2>
        <p class="text-3xl font-bold">{{ ticketCount }}</p>
        <button 
          @click="openTicket" 
          class="mt-4 bg-green-500 hover:bg-green-600 text-white px-4 py-2 rounded"
        >
          {{ $t('dashboard.open_ticket') }}
        </button>
      </div>
      
      <!-- Unread Notifications Card -->
      <div class="bg-white dark:bg-gray-800 rounded-lg shadow p-6">
        <h2 class="text-lg font-semibold mb-2">{{ $t('dashboard.unread_notifications') }}</h2>
        <p class="text-3xl font-bold">{{ notificationCount }}</p>
        <button 
          @click="viewNotifications" 
          class="mt-4 bg-purple-500 hover:bg-purple-600 text-white px-4 py-2 rounded"
        >
          {{ $t('common.notifications') }}
        </button>
      </div>
    </div>
    
    <!-- System Status Section -->
    <div class="mt-8 bg-white dark:bg-gray-800 rounded-lg shadow p-6">
      <h2 class="text-lg font-semibold mb-4">{{ $t('dashboard.system_status') }}</h2>
      <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
        <div>
          <p class="font-medium">{{ $t('dashboard.server_status') }}</p>
          <p class="text-green-500">{{ $t('common.success') }}</p>
        </div>
        <div>
          <p class="font-medium">{{ $t('dashboard.uptime') }}</p>
          <p>99.9%</p>
        </div>
        <div>
          <p class="font-medium">{{ $t('dashboard.response_time') }}</p>
          <p>{{ formatNumber(responseTime) }}ms</p>
        </div>
        <div>
          <p class="font-medium">{{ $t('dashboard.last_updated') }}</p>
          <p>{{ formatDate(lastUpdated) }}</p>
        </div>
      </div>
    </div>
  </div>
</template>

<script setup>
import { ref, onMounted } from 'vue'
import { useI18n } from 'vue-i18n'
import api from '../../utils/api'
import { useLocalization } from '../../composables/useLocalization'

const { t } = useI18n()
const { formatDate, formatNumber } = useLocalization()

// 用户数据
const user = ref({
  name: 'John Doe'
})

// 仪表盘数据
const hostingCount = ref(0)
const ticketCount = ref(0)
const notificationCount = ref(0)
const responseTime = ref(120)
const lastUpdated = ref(new Date())

// 获取用户数据
const fetchUserData = async () => {
  try {
    const response = await api.get('/user')
    user.value = response.data
  } catch (error) {
    console.error('Failed to fetch user data:', error)
  }
}

// 获取仪表盘统计数据
const fetchDashboardStats = async () => {
  try {
    const [hostingRes, ticketRes, notificationRes] = await Promise.all([
      api.get('/hosting'),
      api.get('/tickets'),
      api.get('/notifications')
    ])
    
    hostingCount.value = hostingRes.data.length
    ticketCount.value = ticketRes.data.filter(ticket => ticket.status === 'open').length
    notificationCount.value = notificationRes.data.filter(notification => !notification.read).length
  } catch (error) {
    console.error('Failed to fetch dashboard stats:', error)
  }
}

// 操作方法
const createHosting = () => {
  // 导航到创建主机页面
  console.log('Create hosting account')
}

const openTicket = () => {
  // 导航到创建工单页面
  console.log('Open support ticket')
}

const viewNotifications = () => {
  // 导航到通知页面
  console.log('View notifications')
}

// 组件挂载时获取数据
onMounted(() => {
  fetchUserData()
  fetchDashboardStats()
})
</script>