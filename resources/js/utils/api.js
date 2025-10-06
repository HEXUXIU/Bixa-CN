import axios from 'axios'

// 创建 axios 实例
const api = axios.create({
  baseURL: '/api',
  headers: {
    'X-Requested-With': 'XMLHttpRequest',
    'Content-Type': 'application/json'
  }
})

// 请求拦截器：添加认证令牌
api.interceptors.request.use(
  (config) => {
    const token = document.querySelector('meta[name="csrf-token"]')?.getAttribute('content')
    if (token) {
      config.headers['X-CSRF-TOKEN'] = token
    }
    return config
  },
  (error) => Promise.reject(error)
)

// 响应拦截器：处理错误
api.interceptors.response.use(
  (response) => response,
  (error) => {
    if (error.response?.status === 401) {
      // 未授权，重定向到登录页面
      window.location.href = '/login'
    }
    return Promise.reject(error)
  }
)

export default api