<!DOCTYPE html>
<html lang="ja">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=no">
<title>メンテナンス中 - wholphin</title>
<link rel="preconnect" href="https://fonts.googleapis.com">
<link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
<link href="https://fonts.googleapis.com/css2?family=Noto+Sans+JP:wght@400;500;700&display=swap" rel="stylesheet">
<link rel="stylesheet" href="about.css">

<style>
* {
    margin: 0;
    padding: 0;
    box-sizing: border-box;
}

body {
    font-family: 'Noto Sans JP', -apple-system, BlinkMacSystemFont, sans-serif;
    background: #f5f7fa;
    color: #333;
    line-height: 1.6;
}

.maintenance-wrapper {
    min-height: 100vh;
    display: flex;
    flex-direction: column;
}

.maintenance-header {
    padding: 24px 32px;
    background: white;
    border-bottom: 1px solid #e8ecef;
}

.logo {
    font-size: 22px;
    font-weight: 700;
    color: #333;
    text-decoration: none;
    display: flex;
    align-items: center;
    gap: 8px;
}

.logo::before {
    content: '';
    width: 6px;
    height: 24px;
    background: linear-gradient(135deg, #1a73e8, #4285f4);
    border-radius: 3px;
}

.maintenance-content {
    flex: 1;
    display: flex;
    align-items: center;
    justify-content: center;
    padding: 60px 24px;
}

.maintenance-card {
    background: white;
    border-radius: 12px;
    padding: 64px 48px;
    max-width: 680px;
    width: 100%;
    box-shadow: 0 2px 8px rgba(0,0,0,0.04);
    text-align: center;
}

.maintenance-title {
    font-size: 28px;
    font-weight: 700;
    color: #1a1a1a;
    margin-bottom: 32px;
    letter-spacing: -0.02em;
}

.maintenance-description {
    font-size: 15px;
    color: #4a5568;
    line-height: 1.8;
    margin-bottom: 24px;
}

.maintenance-schedule {
    background: #f8f9fa;
    border: 1px solid #e8ecef;
    border-radius: 8px;
    padding: 20px 24px;
    margin: 32px 0;
    text-align: left;
}

.schedule-label {
    font-size: 13px;
    font-weight: 500;
    color: #6b7280;
    margin-bottom: 8px;
}

.schedule-time {
    font-size: 16px;
    font-weight: 600;
    color: #1a1a1a;
}

.maintenance-divider {
    height: 1px;
    background: #e8ecef;
    margin: 32px 0;
}

.maintenance-contact {
    font-size: 14px;
    color: #6b7280;
    line-height: 1.8;
}

.maintenance-contact a {
    color: #1a73e8;
    text-decoration: none;
    font-weight: 500;
}

.maintenance-contact a:hover {
    text-decoration: underline;
}

.maintenance-actions {
    margin-top: 32px;
    display: flex;
    gap: 12px;
    justify-content: center;
}

.maintenance-btn {
    display: inline-flex;
    align-items: center;
    justify-content: center;
    height: 44px;
    padding: 0 24px;
    border-radius: 8px;
    font-size: 14px;
    font-weight: 500;
    text-decoration: none;
    transition: all 0.2s;
    cursor: pointer;
    border: none;
}

.btn-primary {
    background: #1a73e8;
    color: white;
}

.btn-primary:hover {
    background: #1557b0;
}

.btn-secondary {
    background: white;
    color: #333;
    border: 1px solid #e8ecef;
}

.btn-secondary:hover {
    background: #f8f9fa;
}

.english-notice {
    margin-top: 32px;
    padding-top: 32px;
    border-top: 1px solid #e8ecef;
    font-size: 14px;
    color: #6b7280;
    line-height: 1.8;
}

@media (max-width: 600px) {
    .maintenance-header {
        padding: 20px 24px;
    }
    
    .maintenance-card {
        padding: 40px 28px;
    }
    
    .maintenance-title {
        font-size: 24px;
    }
    
    .maintenance-actions {
        flex-direction: column;
        width: 100%;
    }
    
    .maintenance-btn {
        width: 100%;
    }
}

/* Loading animation */
.loading-indicator {
    display: inline-block;
    width: 4px;
    height: 4px;
    background: #1a73e8;
    border-radius: 50%;
    animation: loading 1.4s infinite both;
    margin: 0 2px;
}

.loading-indicator:nth-child(2) {
    animation-delay: 0.2s;
}

.loading-indicator:nth-child(3) {
    animation-delay: 0.4s;
}

@keyframes loading {
    0%, 80%, 100% {
        opacity: 0.3;
        transform: scale(1);
    }
    40% {
        opacity: 1;
        transform: scale(1.3);
    }
}
</style>

</head>
<body>

<div class="maintenance-wrapper">
    <header class="maintenance-header">
        <a href="index.php" class="logo">wholphin</a>
    </header>

    <div class="maintenance-content">
        <div class="maintenance-card">
            <h1 class="maintenance-title">ただいまメンテナンス中です</h1>
            
            <div class="maintenance-description">
                <p>wholphin をご利用いただきまして、誠にありがとうございます。</p>
                <p>現在システムメンテナンスを行っております。</p>
                <p>ご不便をおかけいたしますが、メンテナンス終了までしばらくお待ちください。</p>
            </div>

            <div class="maintenance-schedule">
                <div class="schedule-label">Maintenance schedule:</div>
                <div class="schedule-time" id="maintenanceSchedule">2026年3月1日 02:00 - 04:00 (JST)</div>
            </div>

            <div style="text-align: center; margin: 24px 0;">
                <span class="loading-indicator"></span>
                <span class="loading-indicator"></span>
                <span class="loading-indicator"></span>
            </div>

            <div class="maintenance-divider"></div>

            <div class="maintenance-contact">
                <p>お問い合わせ先：<a href="mailto:privacy@wholphin.net">privacy@wholphin.net</a></p>
            </div>

            <div class="maintenance-actions">
                <a href="status.php" class="maintenance-btn btn-primary">ステータス確認</a>
                <button onclick="location.reload()" class="maintenance-btn btn-secondary">ページを更新</button>
            </div>

            <div class="english-notice">
                <p><strong>Our service is currently not available due to ongoing maintenance.</strong></p>
                <p>We apologize for any inconveniences caused. Thank you for your understanding.</p>
                <p>Contact: <a href="mailto:privacy@wholphin.net">privacy@wholphin.net</a></p>
            </div>
        </div>
    </div>
</div>

<script>
// --- maintenance.json から情報を読み込む ---
async function loadMaintenanceInfo() {
    try {
        const response = await fetch('maintenance.json');
        if (response.ok) {
            const data = await response.json();
            
            if (data.schedule) {
                document.getElementById('maintenanceSchedule').textContent = data.schedule;
            }
        }
    } catch (e) {
        console.log('Could not load maintenance info:', e);
    }
}

loadMaintenanceInfo();

// --- 自動リロード (30秒ごと) ---
setTimeout(() => {
    location.reload();
}, 30000);
</script>

</body>
</html>