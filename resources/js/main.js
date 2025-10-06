import { createApp } from 'vue'
import { createRouter, createWebHistory } from 'vue-router'
import App from './App.vue'
import i18n from './i18n'
import './styles/main.css'

// 导入路由组件
import Dashboard from '../views/user/Dashboard.vue'
import Login from '../views/auth/Login.vue'
import Register from '../views/auth/Register.vue'

// 路由配置
const routes = [
  { path: '/', component: Dashboard },
  { path: '/login', component: Login },
  { path: '/register', component: Register }
]

const router = createRouter({
  history: createWebHistory(),
  routes
})

// 创建 Vue 应用
const app = createApp(App)

// 使用插件
app.use(router)
app.use(i18n)

// 挂载应用
app.mount('#app')