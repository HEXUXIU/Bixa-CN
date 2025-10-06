# Bixa-CN 项目大纲文档

## 文件结构

```
Bixa-CN/
├── app/                    # Laravel 后端业务逻辑
├── bootstrap/              # Laravel 引导文件
├── config/                 # Laravel 配置文件
├── database/               # 数据库迁移和种子文件
├── public/                 # 公共资源文件
├── resources/
│   ├── fonts/              # 字体文件
│   ├── images/             # 图片资源
│   ├── js/                 # 前端 JavaScript 代码
│   │   ├── app.js          # 应用入口点
│   │   ├── main.js         # Vue 应用初始化
│   │   ├── router/         # 路由配置
│   │   ├── stores/         # Pinia 状态管理
│   │   ├── composables/    # 可组合函数
│   │   ├── utils/          # 工具函数
│   │   ├── i18n/           # 国际化配置
│   │   └── components/     # 全局组件
│   ├── lang/               # 语言包
│   │   ├── en/             # 英文语言包 (PHP)
│   │   ├── zh/             # 中文语言包 (PHP)
│   │   ├── en.json         # 英文语言包 (JSON)
│   │   └── zh.json         # 中文语言包 (JSON)
│   ├── libs/               # 第三方库
│   ├── scss/               # SCSS 样式文件
│   └── views/              # Blade 视图模板
├── routes/                 # 路由定义
├── storage/                # 存储目录
├── tests/                  # 测试文件
├── vendor/                 # Composer 依赖
├── .env.example            # 环境变量示例
├── artisan                 # Laravel 命令行工具
├── composer.json           # PHP 依赖配置
├── package.json            # 前端依赖配置
├── vite.config.js          # Vite 配置文件
├── install.sh              # Linux 安装脚本
├── install.bat             # Windows 安装脚本
├── README.md               # 英文 README
├── README_zh.md            # 中文 README
└── frontend-architecture.md # 前端架构设计文档
```

## 模块功能

### 1. 用户认证模块
- 登录/注册/密码重置
- 双因素认证 (2FA)
- 社交登录 (Google, GitHub, Facebook)
- 邮箱验证

### 2. 仪表盘模块
- 账户概览
- 快速操作
- 系统状态监控

### 3. 主机管理模块
- 创建/查看/管理主机账户
- cPanel 集成
- 文件管理器 (WebFTP)
- 数据库管理
- 子域名管理

### 4. SSL 证书模块
- SSL 证书申请
- DNS 验证
- 证书状态监控
- 证书撤销

### 5. 支持工单模块
- 工单创建/回复/关闭
- 工单分类
- 员工评分
- 知识库集成

### 6. 知识库模块
- 文章分类
- 文章搜索
- 文章评分
- 相关文章推荐

### 7. 通知系统模块
- 系统公告
- 弹窗通知
- 邮件通知
- 通知标记/清除

### 8. 工具模块
- 大小写转换器
- 代码美化器
- 颜色工具
- Base64 编码/解码
- SQL 格式化
- CSS 网格生成器
- CDN 搜索
- 网站速度测试
- WHOIS 查询

### 9. 管理员模块
- 用户管理
- 主机管理
- 工单管理
- 知识库管理
- 系统设置
- 通知管理
- 广告管理
- 认证日志
- 数据迁移

## 语言包

### 支持的语言
- English (en)
- Chinese (zh)

### 语言包结构
- **PHP 语言包**: 用于 Laravel 后端验证消息和系统消息
  - `resources/lang/en/`
  - `resources/lang/zh/`
- **JSON 语言包**: 用于 Vue 前端界面翻译
  - `resources/lang/en.json`
  - `resources/lang/zh.json`

### 语言切换
- 支持动态语言切换
- 语言偏好保存在 localStorage
- 自动检测浏览器语言

## 依赖说明

### 后端依赖 (PHP)
- Laravel 11
- PHP 8.1+
- MySQL 5.7+

### 前端依赖 (JavaScript)
- Vue 3 (Composition API)
- Vue Router
- Pinia (状态管理)
- Vue I18n (国际化)
- Axios (HTTP 客户端)
- VeeValidate (表单验证)
- Chart.js (数据可视化)
- date-fns (日期处理)
- Tailwind CSS (CSS 框架)
- Headless UI (UI 组件)

### 开发依赖
- Vite (构建工具)
- Laravel Vite Plugin
- @vitejs/plugin-vue

### 系统依赖
- Node.js 18.x+
- Composer 2.x+
- NPM 8.x+

## 安装说明

### 自动安装
- Linux: 运行 `install.sh` 脚本
- Windows: 运行 `install.bat` 脚本

### 手动安装
1. 克隆仓库
2. 安装 PHP 依赖: `composer install`
3. 安装前端依赖: `npm install`
4. 复制环境文件: `cp .env.example .env`
5. 生成应用密钥: `php artisan key:generate`
6. 配置数据库连接
7. 运行数据库迁移: `php artisan migrate`
8. 构建前端资源: `npm run build`
9. 设置文件权限

## API 接口

### 认证 API
- POST /login - 用户登录
- POST /register - 用户注册
- POST /password/reset - 密码重置
- GET /user - 获取当前用户信息

### 主机 API
- GET /hosting - 获取主机账户列表
- POST /hosting - 创建主机账户
- GET /hosting/{id} - 获取主机账户详情
- PUT /hosting/{id} - 更新主机账户
- DELETE /hosting/{id} - 删除主机账户

### SSL API
- GET /ssl - 获取 SSL 证书列表
- POST /ssl - 创建 SSL 证书
- GET /ssl/{id} - 获取 SSL 证书详情
- POST /ssl/{id}/verify - 验证 SSL 证书
- POST /ssl/{id}/revoke - 撤销 SSL 证书

### 工单 API
- GET /tickets - 获取工单列表
- POST /tickets - 创建工单
- GET /tickets/{id} - 获取工单详情
- POST /tickets/{id}/reply - 回复工单
- POST /tickets/{id}/status - 更新工单状态

### 通知 API
- GET /notifications - 获取通知列表
- POST /notifications/{id}/mark-as-read - 标记通知为已读
- POST /notifications/mark-all-read - 标记所有通知为已读

## 前端架构

### 技术栈
- **框架**: Vue 3 (Composition API)
- **UI 组件库**: Tailwind CSS + Headless UI
- **状态管理**: Pinia
- **路由**: Vue Router
- **HTTP 客户端**: Axios
- **表单验证**: VeeValidate
- **图表库**: Chart.js
- **国际化**: vue-i18n
- **日期/数字本地化**: Intl API + date-fns

### 组件化设计
- **布局组件**: Header, Sidebar, Footer
- **UI 基础组件**: Button, Card, Table, Form, Modal
- **通用组件**: LanguageSwitcher, Notification, Loading
- **页面视图组件**: 按功能模块划分的页面组件

### 状态管理
- **authStore**: 用户认证状态、用户信息
- **userStore**: 用户相关数据和操作
- **adminStore**: 管理员相关数据和操作
- **notificationStore**: 通知系统状态
- **languageStore**: 语言设置和切换
- **uiStore**: UI 状态（加载状态、主题等）

## 国际化实现

### 语言检测
- 优先使用 localStorage 中保存的语言
- 其次使用浏览器语言
- 默认语言为英语

### 语言切换
- 通过 LanguageSwitcher 组件切换语言
- 切换后更新 localStorage 和 HTML lang 属性
- 使用 vue-i18n 实现动态翻译

### 本地化
- 日期格式化: 使用 date-fns 库
- 数字格式化: 使用 Intl.NumberFormat
- 货币格式化: 使用 Intl.NumberFormat
- 百分比格式化: 使用 Intl.NumberFormat

## 响应式设计

### 断点
- **sm**: 640px
- **md**: 768px
- **lg**: 1024px
- **xl**: 1280px
- **2xl**: 1536px

### 布局适配
- 移动端: 单列布局，侧边栏折叠
- 平板: 双列布局，部分组件调整
- 桌面: 多列布局，充分利用屏幕空间

## 微交互效果

### 按钮悬停
- 颜色变化
- 阴影效果
- 缩放动画

### 表单提示
- 实时验证反馈
- 错误高亮
- 成功状态指示

### 页面滚动
- 平滑滚动
- 滚动进度条
- 返回顶部按钮

## 数据可视化

### 图表类型
- 折线图: 用于趋势分析
- 柱状图: 用于比较数据
- 饼图: 用于比例展示
- 雷达图: 用于多维数据

### 概念图
- 系统架构图
- 数据流程图
- 用户旅程图

### 时间线
- 用户活动时间线
- 系统事件时间线
- 项目进度时间线