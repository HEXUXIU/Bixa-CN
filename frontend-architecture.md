# Bixa-CN 前端 SPA 架构设计

## 技术栈选择
- **框架**: Vue 3 (Composition API)
- **UI 组件库**: Tailwind CSS + Headless UI
- **状态管理**: Pinia
- **路由**: Vue Router
- **HTTP 客户端**: Axios
- **表单验证**: VeeValidate
- **图表库**: Chart.js
- **国际化**: vue-i18n
- **日期/数字本地化**: Intl API + date-fns

## 目录结构
```
resources/
  ├── js/
  │   ├── app.js                 # 应用入口点
  │   ├── main.js                # Vue 应用初始化
  │   ├── router/                # 路由配置
  │   ├── stores/                # Pinia 状态管理
  │   ├── composables/           # 可组合函数
  │   ├── utils/                 # 工具函数
  │   ├── i18n/                  # 国际化配置
  │   └── components/            # 全局组件
  │       ├── layout/            # 布局组件
  │       │   ├── Header.vue     # 顶部导航栏
  │       │   ├── Sidebar.vue    # 侧边栏
  │       │   └── Footer.vue     # 页脚
  │       ├── ui/                # UI 基础组件
  │       │   ├── Button.vue     # 按钮
  │       │   ├── Card.vue       # 卡片
  │       │   ├── Table.vue      # 表格
  │       │   ├── Form.vue       # 表单
  │       │   └── Modal.vue      # 模态框
  │       └── common/            # 通用组件
  │           ├── LanguageSwitcher.vue  # 语言切换器
  │           ├── Notification.vue      # 通知组件
  │           └── Loading.vue           # 加载指示器
  └── views/                     # 页面视图组件
      ├── auth/                  # 认证相关页面
      ├── user/                  # 用户页面
      ├── admin/                 # 管理员页面
      └── shared/                # 共享页面
```

## 组件化模块划分

### 1. 布局组件 (Layout Components)
- **Header.vue**: 顶部导航栏，包含用户信息、通知、语言切换
- **Sidebar.vue**: 侧边栏导航，根据用户角色动态显示菜单项
- **Footer.vue**: 页脚，包含版权信息和链接

### 2. UI 基础组件 (UI Base Components)
- **Button.vue**: 按钮组件，支持多种样式和状态
- **Card.vue**: 卡片容器，用于内容分组
- **Table.vue**: 数据表格，支持分页、排序和筛选
- **Form.vue**: 表单容器，集成表单验证
- **Modal.vue**: 模态框，用于弹出内容

### 3. 通用组件 (Common Components)
- **LanguageSwitcher.vue**: 语言切换器，支持动态切换并保存用户偏好
- **Notification.vue**: 通知组件，显示系统通知和用户消息
- **Loading.vue**: 加载指示器，用于异步操作时的视觉反馈

### 4. 页面视图组件 (Page View Components)

#### 认证相关页面 (Auth)
- Login.vue
- Register.vue
- ForgotPassword.vue
- ResetPassword.vue
- TwoFactor.vue

#### 用户页面 (User)
- Dashboard.vue
- Profile.vue
- Hosting/
  - Index.vue
  - Create.vue
  - View.vue
  - Settings.vue
- SSL/
  - Index.vue
  - Create.vue
  - Show.vue
- Tickets/
  - Index.vue
  - Create.vue
  - Show.vue
- Knowledge/
  - Index.vue
  - Category.vue
  - Article.vue
- Tools/
  - CaseConverter.vue
  - CodeBeautifier.vue
  - ColorTools.vue
  - Base64.vue
  - SqlFormatter.vue
  - CssGridGenerator.vue
  - CdnSearch.vue
  - WebsiteSpeedTest.vue
- WebFtp/
  - Index.vue
  - FileManager.vue
- Announcements/
  - Index.vue
  - Show.vue
- Notifications/
  - Index.vue

#### 管理员页面 (Admin)
- Dashboard.vue
- Users/
  - Index.vue
  - Create.vue
  - Edit.vue
- Hosting/
  - Index.vue
  - View.vue
  - Settings.vue
- Tickets/
  - Index.vue
  - Show.vue
  - Categories.vue
- Knowledge/
  - Categories/
    - Index.vue
    - Create.vue
    - Edit.vue
  - Articles/
    - Index.vue
    - Create.vue
    - Edit.vue
- Settings/
  - General.vue
  - OAuth.vue
  - Smtp.vue
  - Acme.vue
  - Cloudflare.vue
  - SitePro.vue
  - Domains.vue
  - EmailTemplates.vue
  - Mofh.vue
  - WebFtp.vue
- Notifications/
  - Announcements.vue
  - Popups.vue
  - BulkEmail.vue
  - Settings.vue
- Advertisements/
  - AdSlots.vue
  - Advertisements.vue
  - Statistics.vue
- AuthenticationLogs.vue
- Migration.vue

## 状态管理设计
- **authStore**: 用户认证状态、用户信息
- **userStore**: 用户相关数据和操作
- **adminStore**: 管理员相关数据和操作
- **notificationStore**: 通知系统状态
- **languageStore**: 语言设置和切换
- **uiStore**: UI 状态（加载状态、主题等）

## 路由设计
- 使用 Vue Router 实现前端路由
- 基于角色的路由守卫（用户、管理员、支持人员）
- 动态路由加载
- 嵌套路由支持

## API 集成
- 使用 Axios 作为 HTTP 客户端
- 全局请求拦截器处理认证令牌
- 全局响应拦截器处理错误
- API 服务模块化组织