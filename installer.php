<?php
/**
 * Bixa-CN 自动安装程序
 * 单文件 PHP 安装脚本，用于自动配置数据库连接和部署应用
 */

// 设置错误报告
error_reporting(E_ALL);
ini_set('display_errors', 1);

// 检查是否已安装
if (file_exists(__DIR__ . '/.env') && filesize(__DIR__ . '/.env') > 0) {
    die("错误：应用似乎已经安装。如需重新安装，请删除 .env 文件后重试。");
}

// 检查 PHP 版本
if (version_compare(PHP_VERSION, '8.1.0', '<')) {
    die("错误：需要 PHP 8.1.0 或更高版本。当前版本: " . PHP_VERSION);
}

// 检查必要扩展
$requiredExtensions = ['pdo', 'pdo_mysql', 'mbstring', 'tokenizer', 'xml', 'curl', 'zip', 'bcmath', 'gd'];
$missingExtensions = [];
foreach ($requiredExtensions as $extension) {
    if (!extension_loaded($extension)) {
        $missingExtensions[] = $extension;
    }
}

if (!empty($missingExtensions)) {
    die("错误：缺少必要的 PHP 扩展: " . implode(', ', $missingExtensions));
}

// 处理表单提交
if ($_POST) {
    $dbHost = $_POST['db_host'] ?? 'localhost';
    $dbPort = $_POST['db_port'] ?? '3306';
    $dbName = $_POST['db_name'] ?? '';
    $dbUser = $_POST['db_user'] ?? '';
    $dbPass = $_POST['db_pass'] ?? '';
    $dbPrefix = $_POST['db_prefix'] ?? '';
    $appUrl = $_POST['app_url'] ?? '';
    $adminEmail = $_POST['admin_email'] ?? '';
    $adminPassword = $_POST['admin_password'] ?? '';
    
    // 验证必填字段
    $errors = [];
    if (empty($dbName)) $errors[] = "数据库名称不能为空";
    if (empty($dbUser)) $errors[] = "数据库用户名不能为空";
    if (empty($appUrl)) $errors[] = "应用 URL 不能为空";
    if (empty($adminEmail)) $errors[] = "管理员邮箱不能为空";
    if (empty($adminPassword)) $errors[] = "管理员密码不能为空";
    if (strlen($adminPassword) < 8) $errors[] = "管理员密码至少需要8个字符";
    
    if (empty($errors)) {
        try {
            // 测试数据库连接
            $dsn = "mysql:host=$dbHost;port=$dbPort;charset=utf8mb4";
            $pdo = new PDO($dsn, $dbUser, $dbPass, [
                PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
                PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC
            ]);
            
            // 创建数据库（如果不存在）
            $pdo->exec("CREATE DATABASE IF NOT EXISTS `$dbName` CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci");
            $pdo->exec("USE `$dbName`");
            
            // 读取并处理 .env.example 文件
            $envExample = file_get_contents(__DIR__ . '/.env.example');
            $envContent = str_replace(
                [
                    'DB_HOST=localhost',
                    'DB_PORT=3306',
                    'DB_DATABASE=laravel',
                    'DB_USERNAME=root',
                    'DB_PASSWORD=',
                    'DB_PREFIX=',
                    'APP_URL=http://localhost',
                ],
                [
                    "DB_HOST=$dbHost",
                    "DB_PORT=$dbPort",
                    "DB_DATABASE=$dbName",
                    "DB_USERNAME=$dbUser",
                    "DB_PASSWORD=$dbPass",
                    "DB_PREFIX=$dbPrefix",
                    "APP_URL=$appUrl",
                ],
                $envExample
            );
            
            // 生成应用密钥
            $appKey = 'base64:' . base64_encode(random_bytes(32));
            $envContent = preg_replace('/APP_KEY=.*/', "APP_KEY=$appKey", $envContent);
            
            // 保存 .env 文件
            file_put_contents(__DIR__ . '/.env', $envContent);
            
            // 运行数据库迁移
            require_once __DIR__ . '/vendor/autoload.php';
            require_once __DIR__ . '/bootstrap/app.php';
            
            $kernel = $app->make(Illuminate\Contracts\Console\Kernel::class);
            
            // 执行迁移
            $kernel->call('migrate', ['--force' => true]);
            
            // 创建管理员用户
            $kernel->call('db:seed', ['--class' => 'AdminSeeder', '--force' => true]);
            
            // 更新管理员凭据
            $pdo->prepare("UPDATE users SET email = ?, password = ? WHERE role = 'admin' LIMIT 1")
                ->execute([$adminEmail, password_hash($adminPassword, PASSWORD_DEFAULT)]);
            
            // 安装完成
            $success = true;
            
        } catch (Exception $e) {
            $errors[] = "安装失败: " . $e->getMessage();
        }
    }
}
?>

<!DOCTYPE html>
<html lang="zh-CN">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Bixa-CN 安装程序</title>
    <style>
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }
        
        body {
            font-family: -apple-system, BlinkMacSystemFont, 'Segoe UI', Roboto, sans-serif;
            background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
            min-height: 100vh;
            display: flex;
            align-items: center;
            justify-content: center;
            padding: 20px;
        }
        
        .container {
            background: white;
            border-radius: 12px;
            box-shadow: 0 10px 30px rgba(0, 0, 0, 0.2);
            width: 100%;
            max-width: 600px;
            overflow: hidden;
        }
        
        .header {
            background: #4f46e5;
            color: white;
            padding: 24px;
            text-align: center;
        }
        
        .header h1 {
            font-size: 24px;
            font-weight: 600;
            margin-bottom: 8px;
        }
        
        .header p {
            opacity: 0.9;
            font-size: 14px;
        }
        
        .content {
            padding: 32px;
        }
        
        .form-group {
            margin-bottom: 24px;
        }
        
        .form-group label {
            display: block;
            margin-bottom: 8px;
            font-weight: 500;
            color: #374151;
        }
        
        .form-group input {
            width: 100%;
            padding: 12px 16px;
            border: 1px solid #d1d5db;
            border-radius: 8px;
            font-size: 16px;
            transition: border-color 0.2s;
        }
        
        .form-group input:focus {
            outline: none;
            border-color: #4f46e5;
            box-shadow: 0 0 0 3px rgba(79, 70, 229, 0.1);
        }
        
        .form-row {
            display: flex;
            gap: 16px;
        }
        
        .form-row .form-group {
            flex: 1;
        }
        
        .btn {
            width: 100%;
            padding: 14px;
            background: #4f46e5;
            color: white;
            border: none;
            border-radius: 8px;
            font-size: 16px;
            font-weight: 600;
            cursor: pointer;
            transition: background 0.2s;
        }
        
        .btn:hover {
            background: #4338ca;
        }
        
        .error {
            background: #fee2e2;
            color: #b91c1c;
            padding: 16px;
            border-radius: 8px;
            margin-bottom: 24px;
        }
        
        .success {
            background: #dcfce7;
            color: #166534;
            padding: 16px;
            border-radius: 8px;
            margin-bottom: 24px;
            text-align: center;
        }
        
        .requirements {
            background: #f9fafb;
            border: 1px solid #e5e7eb;
            border-radius: 8px;
            padding: 16px;
            margin-bottom: 24px;
        }
        
        .requirements h3 {
            font-size: 16px;
            font-weight: 600;
            margin-bottom: 12px;
            color: #374151;
        }
        
        .requirements ul {
            list-style: none;
        }
        
        .requirements li {
            padding: 4px 0;
            display: flex;
            align-items: center;
        }
        
        .requirements li::before {
            content: "✓";
            color: #10b981;
            margin-right: 8px;
            font-weight: bold;
        }
        
        .note {
            font-size: 12px;
            color: #6b7280;
            margin-top: 8px;
        }
    </style>
</head>
<body>
    <div class="container">
        <div class="header">
            <h1>Bixa-CN 安装程序</h1>
            <p>请填写以下信息以完成自动安装</p>
        </div>
        
        <div class="content">
            <?php if (!empty($errors)): ?>
                <div class="error">
                    <?php foreach ($errors as $error): ?>
                        <div><?php echo htmlspecialchars($error); ?></div>
                    <?php endforeach; ?>
                </div>
            <?php endif; ?>
            
            <?php if (!empty($success)): ?>
                <div class="success">
                    <h3>🎉 安装成功！</h3>
                    <p>Bixa-CN 已成功安装并配置。</p>
                    <p>管理员邮箱: <?php echo htmlspecialchars($adminEmail); ?></p>
                    <p>现在可以访问您的应用了！</p>
                </div>
            <?php else: ?>
                <div class="requirements">
                    <h3>系统要求</h3>
                    <ul>
                        <li>PHP 8.1.0 或更高版本</li>
                        <li>MySQL 5.7 或更高版本</li>
                        <li>必要的 PHP 扩展: pdo, pdo_mysql, mbstring, tokenizer, xml, curl, zip, bcmath, gd</li>
                    </ul>
                </div>
                
                <form method="POST">
                    <div class="form-group">
                        <label for="app_url">应用 URL *</label>
                        <input type="url" id="app_url" name="app_url" value="<?php echo isset($appUrl) ? htmlspecialchars($appUrl) : 'http://localhost'; ?>" required>
                        <div class="note">例如: https://yourdomain.com</div>
                    </div>
                    
                    <div class="form-row">
                        <div class="form-group">
                            <label for="db_host">数据库主机</label>
                            <input type="text" id="db_host" name="db_host" value="<?php echo isset($dbHost) ? htmlspecialchars($dbHost) : 'localhost'; ?>">
                        </div>
                        <div class="form-group">
                            <label for="db_port">数据库端口</label>
                            <input type="number" id="db_port" name="db_port" value="<?php echo isset($dbPort) ? htmlspecialchars($dbPort) : '3306'; ?>">
                        </div>
                    </div>
                    
                    <div class="form-group">
                        <label for="db_name">数据库名称 *</label>
                        <input type="text" id="db_name" name="db_name" value="<?php echo isset($dbName) ? htmlspecialchars($dbName) : ''; ?>" required>
                        <div class="note">数据库将自动创建（如果不存在）</div>
                    </div>
                    
                    <div class="form-group">
                        <label for="db_user">数据库用户名 *</label>
                        <input type="text" id="db_user" name="db_user" value="<?php echo isset($dbUser) ? htmlspecialchars($dbUser) : ''; ?>" required>
                    </div>
                    
                    <div class="form-group">
                        <label for="db_pass">数据库密码</label>
                        <input type="password" id="db_pass" name="db_pass" value="<?php echo isset($dbPass) ? htmlspecialchars($dbPass) : ''; ?>">
                    </div>
                    
                    <div class="form-group">
                        <label for="db_prefix">数据库表前缀</label>
                        <input type="text" id="db_prefix" name="db_prefix" value="<?php echo isset($dbPrefix) ? htmlspecialchars($dbPrefix) : ''; ?>">
                        <div class="note">可选，用于多站点共享数据库</div>
                    </div>
                    
                    <div class="form-group">
                        <label for="admin_email">管理员邮箱 *</label>
                        <input type="email" id="admin_email" name="admin_email" value="<?php echo isset($adminEmail) ? htmlspecialchars($adminEmail) : ''; ?>" required>
                    </div>
                    
                    <div class="form-group">
                        <label for="admin_password">管理员密码 *</label>
                        <input type="password" id="admin_password" name="admin_password" value="" required>
                        <div class="note">至少8个字符</div>
                    </div>
                    
                    <button type="submit" class="btn">开始安装</button>
                </form>
            <?php endif; ?>
        </div>
    </div>
</body>
</html>