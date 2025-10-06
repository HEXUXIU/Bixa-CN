<div align="center">
    <img src="public/build/images/logo.svg" width="250px">
</div>

# Bixa - 主机管理平台

> **注意：开发目前已暂停！**
> 欢迎提交 Pull Request，我们仍然会接受。如果您想看到某个功能，请随时贡献。

## 👀 什么是 Bixa？
Bixa 是一个全面的主机账户和支持管理系统，主要面向 MOFH (MyOwnFreeHost)。基于 Laravel 11 构建，它提供了一个强大的平台来管理主机账户、支持工单、SSL 证书等。

[![License](https://img.shields.io/badge/License-GPL_2.0-orange)](LICENSE)
[![Version](https://img.shields.io/badge/Version-v2.0.2-informational)](https://github.com/bixacloud/bixa/releases/latest)
![Build](https://img.shields.io/badge/Build-Passed-brightgreen)
![Framework](https://img.shields.io/badge/Framework-Laravel_11-red)
![Interface](https://img.shields.io/badge/Interface-Tabler-lightgreen)
![Development](https://img.shields.io/badge/Development-Paused-brightgreen)

### 🎮 用户功能
- **仪表盘**：中央枢纽，提供账户概览和快速服务访问
- **主机管理**：创建和管理最多 3 个主机账户
- **SSL 证书**：使用免费 SSL 证书保护网站
- **支持工单**：通过工单系统获得技术支持
- **知识库**：访问有用的文章和文档
- **个人资料管理**：更新个人信息和安全设置
- **双因素认证**：增强账户安全性
- **通知**：及时了解账户活动
- **Web FTP**：直接通过浏览器管理网站文件
- **工具**：大小写转换器、代码美化器、Base64 编码/解码器等
- **WHOIS 查询**：检查域名注册信息

### 👑 管理员功能
- **管理员仪表盘**：系统性能监控和统计
- **用户管理**：创建、编辑和管理所有用户账户
- **主机管理**：配置 MOFH API 和服务器设置
- **工单系统**：处理支持工单并监控员工绩效
- **知识库管理**：为用户创建和组织文章
- **通知系统**：通过公告与用户沟通
- **系统设置**：配置平台行为和外观
- **广告管理**：控制网站广告
- **域名管理**：管理允许的域名扩展
- **邮件模板**：自定义系统生成的邮件
- **数据迁移**：从旧平台版本导入数据

### 🔌 集成
- MOFH (MyOwnFreeHost)
- Iconcaptcha 表单保护
- ACMEv2 SSL 证书提供商 (Let's Encrypt)
- Site.Pro 网站构建器
- SMTP 邮件服务

## 🚀 快速开始

### 🚅 系统要求
您的服务器需要满足以下最低要求：
- PHP v8.1 或更高版本
- MySQL v5.7 或更高版本
- 兼容 Laravel 11 的服务器
- 有效的、受信任的 SSL 证书

### 💾 安装步骤
详细安装说明请参考我们的完整文档：[https://bixa.app/docs/#/install](https://bixa.app/docs/#/install)。

简要步骤：
1. 从我们的 [GitHub 仓库](https://github.com/bixacloud/bixa/releases/latest) 下载最新版本
2. 使用 Composer 安装 PHP 依赖（请参阅安装指南了解 VPS 与 cPanel 的说明）
3. 上传到您的 Web 主机账户并创建数据库
4. 手动配置 `.env` 文件，填写数据库设置
5. 配置 `.htaccess` 文件以实现正确的 URL 路由
6. 使用 phpMyAdmin 将包含的 `bixa.sql` 文件导入到您的数据库
7. 使用包含的演示账户登录，然后更改您的凭据

没有自动安装程序 - 必须按照我们的 [安装指南](https://bixa.app/docs/#/install/) 中的描述手动配置。

### 📧 SMTP 服务
以下是一些推荐的带有免费套餐的 SMTP 服务，与 Bixa 配合良好：

- [Mailtrap](https://mailtrap.io/)：每月 500 封邮件（测试），每月 1,000 封邮件（生产）
- [Mailjet](https://mailjet.com/)：每月 6,000 封邮件免费
- [SendGrid](https://sendgrid.com/free/)：每天 1000 封邮件免费

## 📚 文档

有关使用和管理 Bixa 的全面文档，请访问我们的官方文档：[bixa.app/docs](https://bixa.app/docs)。

文档包括：
- [用户指南](https://bixa.app/docs/#/user/)
- [管理员指南](https://bixa.app/docs/#/admin/)
- [API 文档](https://bixa.app/docs/#/api/)

## 🤔 需要帮助？

- 如果您发现错误或有功能请求，请[提交问题](https://github.com/bixacloud/bixa/issues/new)
- 加入我们的 [Telegram 群组](https://t.me/bixacloud) 获取社区支持和讨论
- 英语是主要的沟通语言

### 👍 喜欢 Bixa？
如果您觉得 Bixa 有用，请考虑[捐款](https://bixa.app/DONATE.md) 支持其开发。

## ©️ 版权
代码在 [GPL-2.0 许可证](LICENSE) 下发布。