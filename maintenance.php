<!DOCTYPE html>
<html lang="ja">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=no">
<title>メンテナンス中 - wholphin</title>
<link rel="preconnect" href="https://fonts.googleapis.com">
<link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
<link href="https://fonts.googleapis.com/css2?family=Merriweather+Sans:ital,wght@0,300..800;1,300..800&family=Noto+Sans+JP:wght@400..700&display=swap" rel="stylesheet">
<link rel="stylesheet" href="about.css">

<style>
/* メンテナンスページ専用スタイル */
.maintenance-container {
    min-height: 100vh;
    display: flex;
    flex-direction: column;
    justify-content: center;
    align-items: center;
    padding: 40px 24px;
    text-align: center;
}

.maintenance-icon {
    font-size: 100px;
    margin-bottom: 32px;
    opacity: 0;
    animation: fadeIn 0.8s var(--ease-out) 0.1s forwards, rotate 2s linear infinite;
}

@keyframes rotate {
    from { transform: rotate(0deg); }
    to { transform: rotate(360deg); }
}

.maintenance-title {
    font-size: 42px;
    font-weight: 700;
    color: var(--text-main);
    margin-bottom: 20px;
    opacity: 0;
    animation: fadeIn 0.8s var(--ease-out) 0.2s forwards;
}

.maintenance-subtitle {
    font-size: 18px;
    color: var(--text-sub);
    margin-bottom: 40px;
    opacity: 0;
    animation: fadeIn 0.8s var(--ease-out) 0.3s forwards;
}

.maintenance-info-card {
    background: var(--bg-surface);
    border: 2px solid rgba(251, 191, 36, 0.3);
    border-radius: 16px;
    padding: 32px;
    max-width: 600px;
    width: 100%;
    margin-bottom: 40px;
    opacity: 0;
    animation: fadeIn 0.8s var(--ease-out) 0.4s forwards;
}

.maintenance-info-card h2 {
    font-size: 20px;
    font-weight: 600;
    color: var(--text-main);
    margin-bottom: 20px;
    display: flex;
    align-items: center;
    justify-content: center;
    gap: 10px;
}

.info-item {
    display: flex;
    align-items: flex-start;
    text-align: left;
    margin-bottom: 20px;
    padding: 16px;
    background: rgba(251, 191, 36, 0.05);
    border-radius: 8px;
}

.info-item:last-child {
    margin-bottom: 0;
}

.info-icon {
    font-size: 24px;
    margin-right: 12px;
    flex-shrink: 0;
}

.info-content {
    flex: 1;
}

.info-label {
    font-size: 13px;
    font-weight: 600;
    color: var(--text-sub);
    text-transform: uppercase;
    letter-spacing: 0.05em;
    margin-bottom: 4px;
}

.info-value {
    font-size: 16px;
    color: var(--text-main);
    line-height: 1.6;
}

.progress-container {
    margin-top: 32px;
    opacity: 0;
    animation: fadeIn 0.8s var(--ease-out) 0.5s forwards;
}

.progress-label {
    font-size: 14px;
    color: var(--text-sub);
    margin-bottom: 12px;
}

.progress-bar {
    width: 100%;
    height: 8px;
    background: var(--bg-base);
    border-radius: 4px;
    overflow: hidden;
}

.progress-fill {
    height: 100%;
    background: linear-gradient(90deg, #fbbf24, #f59e0b);
    border-radius: 4px;
    animation: progress 2s ease-in-out infinite;
}

@keyframes progress {
    0% { width: 0%; }
    50% { width: 70%; }
    100% { width: 0%; }
}

.maintenance-actions {
    display: flex;
    gap: 16px;
    flex-wrap: wrap;
    justify-content: center;
    opacity: 0;
    animation: fadeIn 0.8s var(--ease-out) 0.6s forwards;
}

.maintenance-btn {
    display: inline-flex;
    align-items: center;
    gap: 8px;
    height: 48px;
    padding: 0 28px;
    border-radius: 24px;
    font-size: 15px;
    font-weight: 600;
    text-decoration: none;
    transition: transform 0.2s, box-shadow 0.2s;
    cursor: pointer;
    border: none;
}

.maintenance-btn-primary {
    background: var(--primary);
    color: white;
}

.maintenance-btn-primary:hover {
    transform: translateY(-2px);
    box-shadow: 0 4px 12px rgba(26, 115, 232, 0.3);
}

.maintenance-btn-secondary {
    background: var(--bg-surface);
    color: var(--text-main);
    border: 1px solid var(--border);
}

.maintenance-btn-secondary:hover {
    background: var(--bg-hover);
    transform: translateY(-1px);
}

.maintenance-updates {
    margin-top: 48px;
    max-width: 600px;
    opacity: 0;
    animation: fadeIn 0.8s var(--ease-out) 0.7s forwards;
}

.maintenance-updates h3 {
    font-size: 18px;
    font-weight: 600;
    color: var(--text-main);
    margin-bottom: 16px;
}

.update-item {
    background: var(--bg-surface);
    border: 1px solid var(--border-subtle);
    border-radius: 12px;
    padding: 16px 20px;
    margin-bottom: 12px;
    text-align: left;
}

.update-time {
    font-size: 12px;
    color: var(--text-sub);
    margin-bottom: 6px;
}

.update-text {
    font-size: 14px;
    color: var(--text-main);
    line-height: 1.6;
}

@keyframes fadeIn {
    from {
        opacity: 0;
        transform: translateY(10px);
    }
    to {
        opacity: 1;
        transform: translateY(0);
    }
}

@media (max-width: 600px) {
    .maintenance-title {
        font-size: 32px;
    }
    
    .maintenance-info-card {
        padding: 24px 20px;
    }
    
    .maintenance-actions {
        flex-direction: column;
        width: 100%;
    }
    
    .maintenance-btn {
        width: 100%;
        justify-content: center;
    }
    
    .info-item {
        flex-direction: column;
        align-items: center;
        text-align: center;
    }
    
    .info-icon {
        margin-right: 0;
        margin-bottom: 8px;
    }
}

@media (prefers-color-scheme: dark) {
    .maintenance-btn-primary:hover {
        box-shadow: 0 4px 12px rgba(26, 115, 232, 0.5);
    }
    
    .info-item {
        background: rgba(251, 191, 36, 0.08);
    }
}
</style>

</head>
<body>

<div style="position:fixed; top:-20%; right:-10%; width:60vw; height:60vw; background:radial-gradient(circle, rgba(251,191,36,0.03) 0%, transparent 60%); pointer-events:none; z-index:-1;"></div>

<nav class="nav-header">
    <a href="index.php" class="brand-logo">wholphin</a>
</nav>

<div class="maintenance-container">
    <div class="maintenance-icon">🛠️</div>
    
    <h1 class="maintenance-title">メンテナンス中</h1>
    
    <p class="maintenance-subtitle">
        現在、wholphin はメンテナンス中です。<br>
        ご不便をおかけして申し訳ございません。
    </p>

    <div class="maintenance-info-card">
        <h2>📅 メンテナンス情報</h2>
        
        <div class="info-item">
            <div class="info-icon">⏰</div>
            <div class="info-content">
                <div class="info-label">予定期間</div>
                <div class="info-value" id="maintenanceSchedule">2026年3月1日 02:00 - 04:00 (JST)</div>
            </div>
        </div>
        
        <div class="info-item">
            <div class="info-icon">📝</div>
            <div class="info-content">
                <div class="info-label">作業内容</div>
                <div class="info-value" id="maintenanceDetails">
                    システムの定期メンテナンスを実施しています。データベースの最適化とセキュリティアップデートを行っています。
                </div>
            </div>
        </div>
        
        <div class="info-item">
            <div class="info-icon">ℹ️</div>
            <div class="info-content">
                <div class="info-label">お知らせ</div>
                <div class="info-value">
                    メンテナンス終了後、通常通りご利用いただけます。最新情報はステータスページでご確認ください。
                </div>
            </div>
        </div>
        
        <div class="progress-container">
            <div class="progress-label">作業進行中...</div>
            <div class="progress-bar">
                <div class="progress-fill"></div>
            </div>
        </div>
    </div>

    <div class="maintenance-actions">
        <a href="status.php" class="maintenance-btn maintenance-btn-primary">
            <svg width="20" height="20" viewBox="0 0 24 24" fill="currentColor">
                <path d="M12 2C6.48 2 2 6.48 2 12s4.48 10 10 10 10-4.48 10-10S17.52 2 12 2zm-2 15l-5-5 1.41-1.41L10 14.17l7.59-7.59L19 8l-9 9z"/>
            </svg>
            ステータス確認
        </a>
        <button onclick="location.reload()" class="maintenance-btn maintenance-btn-secondary">
            <svg width="20" height="20" viewBox="0 0 24 24" fill="currentColor">
                <path d="M17.65 6.35C16.2 4.9 14.21 4 12 4c-4.42 0-7.99 3.58-7.99 8s3.57 8 7.99 8c3.73 0 6.84-2.55 7.73-6h-2.08c-.82 2.33-3.04 4-5.65 4-3.31 0-6-2.69-6-6s2.69-6 6-6c1.66 0 3.14.69 4.22 1.78L13 11h7V4l-2.35 2.35z"/>
            </svg>
            ページを更新
        </button>
    </div>

    <div class="maintenance-updates">
        <h3>最新の更新</h3>
        
        <div class="update-item" id="latestUpdate">
            <div class="update-time">2026年3月1日 02:30</div>
            <div class="update-text">メンテナンス作業を開始しました。予定通り04:00に終了する見込みです。</div>
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
            
            if (data.message) {
                document.getElementById('maintenanceDetails').textContent = data.message;
            }
            
            if (data.updates && data.updates.length > 0) {
                // 最新の更新を表示
                const latest = data.updates[0];
                document.querySelector('#latestUpdate .update-time').textContent = latest.time;
                document.querySelector('#latestUpdate .update-text').textContent = latest.text;
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

// --- Header Scroll Effect ---
const header = document.querySelector('.nav-header');
if (header) {
    window.addEventListener('scroll', () => {
        if (window.scrollY > 20) {
            header.classList.add('scrolled');
        } else {
            header.classList.remove('scrolled');
        }
    });
}
</script>

</body>
</html>