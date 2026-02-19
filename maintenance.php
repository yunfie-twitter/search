<!DOCTYPE html>
<html lang="ja">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=no">
<title>メンテナンス中 - wholphin</title>
<link rel="preconnect" href="https://fonts.googleapis.com">
<link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
<link href="https://fonts.googleapis.com/css2?family=Merriweather+Sans:ital,wght@0,300..800;1,300..800&family=Noto+Sans+JP:wght@400..700&display=swap" rel="stylesheet">
<link href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined:opsz,wght,FILL,GRAD@24,400,0,0" rel="stylesheet">
<link rel="stylesheet" href="about.css">

<style>
/* Material Symbols */
.material-symbols-outlined {
    font-family: 'Material Symbols Outlined';
    font-weight: normal;
    font-style: normal;
    font-size: 24px;
    line-height: 1;
    letter-spacing: normal;
    text-transform: none;
    display: inline-block;
    white-space: nowrap;
    word-wrap: normal;
    direction: ltr;
    -webkit-font-smoothing: antialiased;
}

/* メンテナンスページスタイル */
.maintenance-container {
    min-height: 100vh;
    display: flex;
    flex-direction: column;
    justify-content: center;
    align-items: center;
    padding: 60px 24px;
    text-align: center;
}

.maintenance-icon-wrapper {
    width: 120px;
    height: 120px;
    background: linear-gradient(135deg, rgba(251, 191, 36, 0.2), rgba(251, 191, 36, 0.05));
    border-radius: 50%;
    display: flex;
    align-items: center;
    justify-content: center;
    margin-bottom: 40px;
    opacity: 0;
    animation: fadeIn 0.8s var(--ease-out) 0.1s forwards;
}

.maintenance-icon-wrapper .material-symbols-outlined {
    font-size: 64px;
    color: #f59e0b;
    animation: rotate 3s linear infinite;
}

@keyframes rotate {
    from { transform: rotate(0deg); }
    to { transform: rotate(360deg); }
}

.maintenance-header {
    margin-bottom: 48px;
    opacity: 0;
    animation: fadeIn 0.8s var(--ease-out) 0.2s forwards;
}

.maintenance-title {
    font-size: 48px;
    font-weight: 700;
    color: var(--text-main);
    margin-bottom: 16px;
    letter-spacing: -0.02em;
}

.maintenance-subtitle {
    font-size: 18px;
    color: var(--text-sub);
    line-height: 1.6;
    max-width: 500px;
    margin: 0 auto;
}

.maintenance-content {
    max-width: 700px;
    width: 100%;
}

.info-grid {
    display: grid;
    grid-template-columns: repeat(auto-fit, minmax(280px, 1fr));
    gap: 20px;
    margin-bottom: 40px;
    opacity: 0;
    animation: fadeIn 0.8s var(--ease-out) 0.3s forwards;
}

.info-card {
    background: var(--bg-surface);
    border: 1px solid var(--border-subtle);
    border-radius: 16px;
    padding: 28px 24px;
    text-align: left;
    transition: transform 0.2s, box-shadow 0.2s;
}

.info-card:hover {
    transform: translateY(-4px);
    box-shadow: 0 8px 24px rgba(0,0,0,0.08);
}

.info-card-header {
    display: flex;
    align-items: center;
    gap: 12px;
    margin-bottom: 16px;
}

.info-card-icon {
    width: 40px;
    height: 40px;
    background: rgba(251, 191, 36, 0.1);
    border-radius: 10px;
    display: flex;
    align-items: center;
    justify-content: center;
}

.info-card-icon .material-symbols-outlined {
    font-size: 24px;
    color: #f59e0b;
}

.info-card-title {
    font-size: 14px;
    font-weight: 600;
    color: var(--text-sub);
    text-transform: uppercase;
    letter-spacing: 0.05em;
}

.info-card-content {
    font-size: 16px;
    color: var(--text-main);
    line-height: 1.7;
}

.progress-section {
    background: var(--bg-surface);
    border: 1px solid var(--border-subtle);
    border-radius: 16px;
    padding: 32px;
    margin-bottom: 40px;
    opacity: 0;
    animation: fadeIn 0.8s var(--ease-out) 0.4s forwards;
}

.progress-header {
    display: flex;
    align-items: center;
    gap: 12px;
    margin-bottom: 20px;
}

.progress-header .material-symbols-outlined {
    font-size: 28px;
    color: var(--primary);
}

.progress-title {
    font-size: 18px;
    font-weight: 600;
    color: var(--text-main);
}

.progress-bar-wrapper {
    background: var(--bg-base);
    border-radius: 12px;
    height: 12px;
    overflow: hidden;
    position: relative;
}

.progress-bar-fill {
    height: 100%;
    background: linear-gradient(90deg, #fbbf24, #f59e0b);
    border-radius: 12px;
    position: relative;
    overflow: hidden;
}

.progress-bar-fill::after {
    content: '';
    position: absolute;
    top: 0;
    left: 0;
    right: 0;
    bottom: 0;
    background: linear-gradient(90deg, transparent, rgba(255,255,255,0.3), transparent);
    animation: shimmer 2s infinite;
}

@keyframes shimmer {
    0% { transform: translateX(-100%); }
    100% { transform: translateX(100%); }
}

.progress-text {
    font-size: 14px;
    color: var(--text-sub);
    margin-top: 12px;
    text-align: center;
}

.actions-section {
    display: flex;
    gap: 16px;
    justify-content: center;
    flex-wrap: wrap;
    margin-bottom: 48px;
    opacity: 0;
    animation: fadeIn 0.8s var(--ease-out) 0.5s forwards;
}

.action-btn {
    display: inline-flex;
    align-items: center;
    gap: 10px;
    height: 52px;
    padding: 0 32px;
    border-radius: 26px;
    font-size: 16px;
    font-weight: 600;
    text-decoration: none;
    transition: all 0.2s;
    cursor: pointer;
    border: none;
}

.action-btn .material-symbols-outlined {
    font-size: 22px;
}

.action-btn-primary {
    background: var(--primary);
    color: white;
}

.action-btn-primary:hover {
    background: #1557b0;
    transform: translateY(-2px);
    box-shadow: 0 6px 20px rgba(26, 115, 232, 0.3);
}

.action-btn-secondary {
    background: var(--bg-surface);
    color: var(--text-main);
    border: 2px solid var(--border);
}

.action-btn-secondary:hover {
    background: var(--bg-hover);
    border-color: var(--primary);
    transform: translateY(-2px);
}

.updates-section {
    opacity: 0;
    animation: fadeIn 0.8s var(--ease-out) 0.6s forwards;
}

.updates-header {
    font-size: 20px;
    font-weight: 600;
    color: var(--text-main);
    margin-bottom: 20px;
    display: flex;
    align-items: center;
    justify-content: center;
    gap: 10px;
}

.updates-header .material-symbols-outlined {
    font-size: 24px;
    color: var(--primary);
}

.update-item {
    background: var(--bg-surface);
    border: 1px solid var(--border-subtle);
    border-left: 4px solid var(--primary);
    border-radius: 12px;
    padding: 20px 24px;
    margin-bottom: 16px;
    text-align: left;
}

.update-time {
    display: flex;
    align-items: center;
    gap: 8px;
    font-size: 13px;
    color: var(--text-sub);
    margin-bottom: 8px;
}

.update-time .material-symbols-outlined {
    font-size: 16px;
}

.update-text {
    font-size: 15px;
    color: var(--text-main);
    line-height: 1.7;
}

@keyframes fadeIn {
    from {
        opacity: 0;
        transform: translateY(20px);
    }
    to {
        opacity: 1;
        transform: translateY(0);
    }
}

@media (max-width: 600px) {
    .maintenance-title {
        font-size: 36px;
    }
    
    .info-grid {
        grid-template-columns: 1fr;
    }
    
    .actions-section {
        flex-direction: column;
        width: 100%;
    }
    
    .action-btn {
        width: 100%;
        justify-content: center;
    }
    
    .progress-section {
        padding: 24px 20px;
    }
}

@media (prefers-color-scheme: dark) {
    .info-card:hover {
        box-shadow: 0 8px 24px rgba(0,0,0,0.3);
    }
    
    .action-btn-primary:hover {
        box-shadow: 0 6px 20px rgba(26, 115, 232, 0.5);
    }
}
</style>

</head>
<body>

<div style="position:fixed; top:-20%; right:-10%; width:60vw; height:60vw; background:radial-gradient(circle, rgba(251,191,36,0.04) 0%, transparent 60%); pointer-events:none; z-index:-1;"></div>

<nav class="nav-header">
    <a href="index.php" class="brand-logo">wholphin</a>
</nav>

<div class="maintenance-container">
    <div class="maintenance-icon-wrapper">
        <span class="material-symbols-outlined">construction</span>
    </div>
    
    <div class="maintenance-header">
        <h1 class="maintenance-title">メンテナンス中</h1>
        <p class="maintenance-subtitle">
            現在、wholphin のシステムメンテナンスを実施しています。<br>
            ご不便をおかけして申し訳ございません。
        </p>
    </div>

    <div class="maintenance-content">
        <div class="info-grid">
            <div class="info-card">
                <div class="info-card-header">
                    <div class="info-card-icon">
                        <span class="material-symbols-outlined">schedule</span>
                    </div>
                    <div class="info-card-title">予定期間</div>
                </div>
                <div class="info-card-content" id="maintenanceSchedule">
                    2026年3月1日 02:00 - 04:00 (JST)
                </div>
            </div>
            
            <div class="info-card">
                <div class="info-card-header">
                    <div class="info-card-icon">
                        <span class="material-symbols-outlined">settings</span>
                    </div>
                    <div class="info-card-title">作業内容</div>
                </div>
                <div class="info-card-content" id="maintenanceDetails">
                    システムの定期メンテナンスとアップデートを行っています
                </div>
            </div>
        </div>

        <div class="progress-section">
            <div class="progress-header">
                <span class="material-symbols-outlined">sync</span>
                <div class="progress-title">作業進行中</div>
            </div>
            <div class="progress-bar-wrapper">
                <div class="progress-bar-fill" id="progressBar" style="width: 45%;"></div>
            </div>
            <div class="progress-text">メンテナンス終了までしばらくお待ちください</div>
        </div>

        <div class="actions-section">
            <a href="status.php" class="action-btn action-btn-primary">
                <span class="material-symbols-outlined">info</span>
                ステータス確認
            </a>
            <button onclick="location.reload()" class="action-btn action-btn-secondary">
                <span class="material-symbols-outlined">refresh</span>
                ページを更新
            </button>
        </div>

        <div class="updates-section">
            <div class="updates-header">
                <span class="material-symbols-outlined">notifications</span>
                最新の更新
            </div>
            
            <div class="update-item" id="latestUpdate">
                <div class="update-time">
                    <span class="material-symbols-outlined">access_time</span>
                    <span>2026年3月1日 02:30</span>
                </div>
                <div class="update-text">
                    メンテナンス作業を開始しました。予定通り04:00に終了する見込みです。
                </div>
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
            
            if (data.message) {
                document.getElementById('maintenanceDetails').textContent = data.message;
            }
            
            if (data.progress) {
                document.getElementById('progressBar').style.width = data.progress + '%';
            }
            
            if (data.updates && data.updates.length > 0) {
                const latest = data.updates[0];
                document.querySelector('#latestUpdate .update-time span:last-child').textContent = latest.time;
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