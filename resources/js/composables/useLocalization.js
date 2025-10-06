import { formatDate, formatNumber, formatCurrency, formatPercentage } from '../utils/localization'

// 可组合函数：提供本地化功能
export function useLocalization() {
  return {
    formatDate,
    formatNumber,
    formatCurrency,
    formatPercentage
  }
}