import { createI18n } from 'vue-i18n'
import en from '../../lang/en.json'
import zh from '../../lang/zh.json'

// 获取浏览器语言或 localStorage 中保存的语言
const getBrowserLocale = () => {
  const locale = localStorage.getItem('bixa-language') || navigator.language || navigator.userLanguage
  return locale.slice(0, 2)
}

// 创建 i18n 实例
const i18n = createI18n({
  locale: getBrowserLocale(),
  fallbackLocale: 'en',
  messages: {
    en,
    zh
  }
})

// 语言切换函数
export const switchLanguage = (lang) => {
  i18n.global.locale = lang
  localStorage.setItem('bixa-language', lang)
  document.documentElement.setAttribute('lang', lang)
}

export default i18n