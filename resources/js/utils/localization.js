import { format, parseISO } from 'date-fns'
import { zhCN, enUS } from 'date-fns/locale'

// 获取当前语言环境
const getCurrentLocale = () => {
  const lang = localStorage.getItem('bixa-language') || 'en'
  return lang === 'zh' ? zhCN : enUS
}

// 日期格式化
export const formatDate = (date, formatStr = 'PP') => {
  if (!date) return ''
  const locale = getCurrentLocale()
  return typeof date === 'string' ? format(parseISO(date), formatStr, { locale }) : format(date, formatStr, { locale })
}

// 数字格式化
export const formatNumber = (number, options = {}) => {
  if (number === null || number === undefined) return ''
  const lang = localStorage.getItem('bixa-language') || 'en'
  return new Intl.NumberFormat(lang, options).format(number)
}

// 货币格式化
export const formatCurrency = (amount, currency = 'USD', options = {}) => {
  if (amount === null || amount === undefined) return ''
  const lang = localStorage.getItem('bixa-language') || 'en'
  return new Intl.NumberFormat(lang, { style: 'currency', currency, ...options }).format(amount)
}

// 百分比格式化
export const formatPercentage = (value, options = {}) => {
  if (value === null || value === undefined) return ''
  const lang = localStorage.getItem('bixa-language') || 'en'
  return new Intl.NumberFormat(lang, { style: 'percent', ...options }).format(value)
}