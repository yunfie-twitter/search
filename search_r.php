<?php
// search-3.php (既存仕様維持・完全版 + Misskey画像対応)

// クエリ取得
$q = isset($_GET['q']) ? $_GET['q'] : '';
$q = trim($q);
?>
<!DOCTYPE html>
<html lang="ja">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=5.0, user-scalable=yes">
<title><?= htmlspecialchars($_GET['q'] ?? '') ?> - wholphin 検索</title>

<link rel="preconnect" href="https://fonts.googleapis.com">
<link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <meta name="description" content="wholphin は高速でシンプルな検索体験を提供する日本語対応の検索サービスです。ウェブ、画像、動画、ニュース、ソーシャルメディアを素早く検索できます。">
    <meta name="keywords" content="検索, 検索エンジン, wholphin, 日本語検索, 高速検索, ニュース検索, SNS検索">

    <meta property="og:type" content="website">
    <meta property="og:url" content="https://wholphin.net/">
    <meta property="og:title" content="wholphin - 高速でシンプルな検索体験">
    <meta property="og:description" content="wholphin は高速でシンプルな検索体験を提供する日本語対応の検索サービスです。">
    <meta property="og:site_name" content="wholphin">
    <meta property="og:locale" content="ja_JP">
    <link rel="manifest" href="/manifest.json">
    <meta name="theme-color" content="#ffffff">
    <link rel="apple-touch-icon" href="/android-chrome-192x192.png">
    <link rel="shortcut icon" href="/favicon.ico">
<link rel="icon" href="/favicon.ico" type="image/x-icon">
    <meta name="twitter:card" content="summary_large_image">
    <meta name="twitter:url" content="https://cf866966.cloudfree.jp/">
    <meta name="twitter:title" content="wholphin - 高速でシンプルな検索体験">
    <meta name="twitter:description" content="wholphin は高速でシンプルな検索体験を提供する日本語対応の検索サービスです。">

    <link rel="canonical" href="https://wholphin.net/">
<!-- CLS対策: display=optional と preload -->
<link rel="preload" href="https://fonts.gstatic.com/s/merriweathersans/v28/2-c79IRs1JiJN1FRAMjTN5zd9vgsFHXwcjfj9zlcxZI.woff2" as="font" type="font/woff2" crossorigin>
<link href="https://fonts.googleapis.com/css2?family=Merriweather+Sans:ital,wght@0,300..800;1,300..800&family=Noto+Sans+JP:wght@100..900&display=optional" rel="stylesheet">
<link rel="shortcut icon" href="/favicon.ico">
<style>
/* --- Design Token & Reset (Light Mode Default) --- */
:root {
    --primary: #1a73e8;
    --primary-hover: #1557b0;
    --text-main: #202124;
    --text-sub: #5f6368;
    --text-link: #1a0dab;
    --bg-body: #ffffff;
    --bg-surface: #ffffff;
    --bg-hover: #f1f3f4;
    --border: #dfe1e5;
    --icon-color: #9aa0a6;
    --shadow-soft: 0 1px 6px rgba(32,33,36,0.18);
    --radius-l: 24px;
    --radius-m: 12px;
    --header-bg: rgba(255,255,255,0.98);
    --footer-bg: #f2f2f2;
}

/* --- Dark Mode Overrides --- */
@media (prefers-color-scheme: dark) {
    :root {
        --primary: #8ab4f8;
        --primary-hover: #aecbfa;
        --text-main: #e8eaed;
        --text-sub: #bdc1c6;
        --text-link: #8ab4f8;
        --bg-body: #202124;
        --bg-surface: #303134;
        --bg-hover: #3c4043;
        --border: #5f6368;
        --icon-color: #9aa0a6;
        --shadow-soft: 0 1px 6px rgba(0,0,0,0.3);
        --header-bg: rgba(32,33,36,0.98);
        --footer-bg: #171717;
    }
}

* { box-sizing: border-box; -webkit-tap-highlight-color: transparent; outline: none; }
html, body { height: 100%; margin: 0; }

body {
    font-family: 'Noto Sans JP', sans-serif;
    color: var(--text-main);
    background: var(--bg-body);
    display: flex;
    flex-direction: column;
    overflow-y: scroll;
    transition: background 0.3s, color 0.3s;
}

a { text-decoration: none; color: inherit; }
button { border: none; background: none; cursor: pointer; padding: 0; }

/* --- Layout Structure --- */
.app-wrapper {
    flex: 1;
    display: flex;
    flex-direction: column;
}

/* --- Header --- */
header {
    position: sticky; top: 0; z-index: 1000;
    background: var(--header-bg);
    border-bottom: 1px solid var(--border);
    transition: background 0.3s, border-color 0.3s;
}

.header-inner {
    display: flex; align-items: center; gap: 24px;
    padding: 20px 24px 0; max-width: 1200px; margin: 0;
}

.logo {
    font-size: 24px; font-weight: 700; color: var(--text-main);
    white-space: nowrap; user-select: none; cursor: pointer;
    letter-spacing: -0.5px;
    font-family: "Merriweather Sans", sans-serif;
    font-optical-sizing: auto;
    font-style: italic;
    flex-shrink: 0;
}
@media (prefers-color-scheme: dark) { .logo { color: #fff; } }

/* --- Search Box --- */
.search-container {
    flex: 1; max-width: 690px; position: relative;
}

.search-box-wrap {
    position: relative;
    border-radius: var(--radius-l);
    background: var(--bg-surface);
    border: 1px solid var(--border);
    z-index: 101;
    display: flex;
    align-items: center;
    padding-left: 14px;
    height: 44px;
    transition: box-shadow 0.2s, background 0.2s, border-color 0.2s;
}

.search-box-wrap:hover { box-shadow: var(--shadow-soft); border-color: transparent; }

.search-box-wrap.active.has-suggestions {
    box-shadow: var(--shadow-soft);
    border-color: transparent;
    border-bottom-left-radius: 0;
    border-bottom-right-radius: 0;
    background: var(--bg-surface);
}

.search-icon-left {
    width: 20px; height: 20px; fill: var(--icon-color);
    flex-shrink: 0; margin-right: 8px;
    pointer-events: none;
    display: block;
}

.mobile-back-btn {
    display: none;
    width: 24px; height: 24px; padding: 2px;
    margin-right: 8px; cursor: pointer;
    fill: var(--text-sub);
}

.search-input {
    flex: 1; height: 100%; padding: 0 8px 0 0;
    border: none; background: transparent;
    font-size: 16px; color: var(--text-main);
    border-radius: var(--radius-l);
    min-width: 0;
}
.search-input::placeholder { color: var(--text-sub); opacity: 0.8; }

/* Right Actions */
.action-btn-area {
    height: 44px;
    display: flex; align-items: center;
    margin-right: 4px;
    gap: 4px;
}

.icon-btn {
    width: 36px; height: 36px;
    display: flex; align-items: center; justify-content: center;
    border-radius: 50%;
    cursor: pointer;
    transition: background 0.2s;
}
.icon-btn:hover { background: var(--bg-hover); }

.clear-btn, .mic-btn {
    display: none;
    width: 24px; height: 24px;
}
.clear-btn svg, .mic-btn svg { width: 100%; height: 100%; fill: var(--icon-color); }

/* Mic & Clear Logic */
.mic-btn { display: flex; }
.mic-btn svg { fill: var(--primary); }

.search-box-wrap.has-value .mic-btn { display: none; }
.search-box-wrap.has-value .clear-btn { display: flex; }

/* Voice Active State */
.mic-btn.listening svg { display: none; }
.mic-btn.listening::after {
    content: ''; width: 14px; height: 14px;
    background: #ea4335; border-radius: 50%;
    animation: pulse-red 1.5s infinite;
}
@keyframes pulse-red {
    0% { transform: scale(0.95); box-shadow: 0 0 0 0 rgba(234, 67, 53, 0.7); }
    70% { transform: scale(1); box-shadow: 0 0 0 6px rgba(234, 67, 53, 0); }
    100% { transform: scale(0.95); box-shadow: 0 0 0 0 rgba(234, 67, 53, 0); }
}

/* Suggest Dropdown */
.suggest-list {
    position: absolute; top: 100%; left: 0; right: 0;
    background: var(--bg-surface);
    border-radius: 0 0 24px 24px;
    padding-bottom: 8px;
    box-shadow: var(--shadow-soft);
    display: none;
    z-index: 100;
    overflow: hidden;
    max-height: 50vh;
    overflow-y: auto;
    margin: -1px;
}

.search-box-wrap.active.has-suggestions .suggest-list { display: block; }

.suggest-item {
    padding: 0 16px; height: 48px;
    font-size: 16px; cursor: pointer;
    display: flex; align-items: center; gap: 14px;
    color: var(--text-main);
}
.suggest-item:hover, .suggest-item.selected { background: var(--bg-hover); }
.suggest-icon { width: 18px; height: 18px; fill: var(--icon-color); flex-shrink: 0; }
.suggest-text { white-space: nowrap; overflow: hidden; text-overflow: ellipsis; flex: 1; }

/* --- Tabs --- */
.tabs {
    display: flex; gap: 24px; margin-left: 105px; padding-top: 16px;
    overflow-x: auto;
    scrollbar-width: none;
    -ms-overflow-style: none;
}
.tabs::-webkit-scrollbar { display: none; }

.tab {
    padding: 0 4px 12px; font-size: 14px; color: var(--text-sub);
    cursor: pointer; border-bottom: 3px solid transparent;
    font-weight: 500; white-space: nowrap; flex-shrink: 0;
}
.tab:hover { color: var(--primary); }
.tab.active { color: var(--primary); border-bottom-color: var(--primary); }

/* --- Main Content --- */
main {
    width: 100%; max-width: 1200px; padding: 24px;
}

.content-area {
    margin-left: 105px;
    max-width: 650px;
    min-height: 40vh;
}

.stats { font-size: 14px; color: var(--text-sub); margin-bottom: 24px; height: 20px; }

/* --- Results Items (Web, Video, Image, News, Social) --- */
.web-item { margin-bottom: 36px; }
.web-cite {
    display: flex; align-items: center; gap: 10px;
    font-size: 14px; margin-bottom: 8px;
}
.web-cite img {
    width: 18px; height: 18px; border-radius: 50%;
    background: #f1f3f4; object-fit: cover;
    border: 1px solid rgba(0,0,0,0.1);
}
.web-cite span { color: var(--text-main); font-size: 14px; }
.web-title {
    display: block; font-size: 20px; color: var(--text-link);
    line-height: 1.3; margin-bottom: 8px; letter-spacing: 0.2px;
}
.web-title:hover { text-decoration: underline; }
.web-desc {
    font-size: 14px; line-height: 1.6; color: var(--text-sub);
    word-break: break-all;
}
@media (prefers-color-scheme: dark) {
    .web-desc { color: #bdc1c6; }
    .web-cite img { border: 1px solid #5f6368; }
}

.video-item { display: flex; gap: 16px; margin-bottom: 24px; cursor: pointer; }
.video-item:hover .video-title { color: var(--primary); }
.video-thumb {
    width: 180px; aspect-ratio: 16/9; flex-shrink: 0;
    border-radius: var(--radius-m); background: #000;
    overflow: hidden; position: relative;
    box-shadow: 0 1px 3px rgba(0,0,0,0.1);
}
.video-thumb img { width: 100%; height: 100%; object-fit: cover; }
.video-info { flex: 1; min-width: 0; }
.video-title {
    font-size: 18px; color: var(--text-link); line-height: 1.3;
    margin-bottom: 6px; display: -webkit-box; -webkit-line-clamp: 2;
    -webkit-box-orient: vertical; overflow: hidden;
}
.video-meta { font-size: 13px; color: var(--text-sub); display: flex; flex-wrap: wrap; align-items: center; gap: 6px; }
.video-desc {
    font-size: 13px; color: var(--text-sub); margin-top: 8px;
    display: -webkit-box; -webkit-line-clamp: 2; -webkit-box-orient: vertical; overflow: hidden;
}

/* News Item Style */
.news-item { margin-bottom: 24px; padding-bottom: 16px; border-bottom: 1px solid var(--border); }
.news-item:last-child { border-bottom: none; }
.news-source { font-size: 12px; color: var(--text-sub); margin-bottom: 4px; display: flex; align-items: center; gap: 6px; }
.news-title { font-size: 18px; color: var(--text-link); text-decoration: none; margin-bottom: 6px; display: block; }
.news-title:hover { text-decoration: underline; }
.news-date { font-size: 12px; color: var(--text-sub); }

/* Social Item Style */
.social-item { 
    margin-bottom: 20px; padding: 16px; 
    border: 1px solid var(--border); border-radius: var(--radius-m);
    background: var(--bg-surface);
}
.social-header { display: flex; align-items: center; gap: 10px; margin-bottom: 8px; }
.social-avatar { width: 32px; height: 32px; border-radius: 50%; background: #eee; object-fit: cover; }
.social-author { font-weight: bold; font-size: 14px; }
.social-date { font-size: 12px; color: var(--text-sub); margin-left: auto; }
.social-content { font-size: 14px; line-height: 1.5; color: var(--text-main); white-space: pre-wrap; }

/* Misskey画像グリッド（新規追加） */
.social-images {
    display: grid;
    gap: 8px;
    margin-top: 12px;
}
.social-images.count-1 { grid-template-columns: 1fr; }
.social-images.count-2, .social-images.count-3, .social-images.count-4 { grid-template-columns: repeat(2, 1fr); }

.social-img-wrap {
    aspect-ratio: 16/9;
    border-radius: 8px;
    overflow: hidden;
    background: #f0f0f0;
    cursor: pointer;
    position: relative;
}
.social-img-wrap img {
    width: 100%;
    height: 100%;
    object-fit: cover;
    transition: transform 0.2s;
}
.social-img-wrap:hover img {
    transform: scale(1.05);
}

.social-img-more {
    font-size: 12px;
    color: var(--text-sub);
    margin-top: 4px;
}


.image-grid {
    display: grid; grid-template-columns: repeat(auto-fill, minmax(180px, 1fr));
    gap: 16px; padding-bottom: 24px;
}
.img-card {
    cursor: pointer; position: relative; overflow: hidden;
    border-radius: var(--radius-m); aspect-ratio: 16/10;
    background: var(--bg-surface);
}
.img-card img { width: 100%; height: 100%; object-fit: cover; }
.img-card:hover img { transform: scale(1.05); transition: transform 0.2s; }
.img-card .overlay {
    position: absolute; bottom: 0; left: 0; right: 0;
    background: linear-gradient(to top, rgba(0,0,0,0.8), transparent);
    padding: 24px 12px 12px; color: #fff; opacity: 0; transition: opacity .2s;
}
.img-card:hover .overlay { opacity: 1; }

/* --- Footer --- */
.app-footer {
    background: var(--footer-bg);
    padding: 16px 24px;
    border-top: 1px solid var(--border);
    font-size: 14px; color: var(--text-sub);
    transition: background 0.3s, border-color 0.3s;
}
.footer-inner {
    max-width: 1200px; margin-left: 105px;
    display: flex; gap: 24px; flex-wrap: wrap;
}
.footer-link { cursor: pointer; }
.footer-link:hover { color: var(--text-main); }


/* ===== Mobile Responsiveness & Full Screen Search ===== */
@media (max-width: 820px) {
    .header-inner { flex-direction: column; padding: 16px 16px 0; gap: 12px; }
    .logo { margin: 0 auto; }
    .search-container { width: 100%; max-width: 100%; }
    .tabs { margin-left: 0; gap: 20px; justify-content: flex-start; overflow-x: auto; padding-left: 16px; padding-right: 16px; }
    main { padding: 16px; }
    .content-area { margin-left: 0; max-width: 100%; }
    .footer-inner { margin-left: 0; justify-content: center; }
    .video-item { flex-direction: column; gap: 10px; }
    .video-thumb { width: 100%; aspect-ratio: 16/9; }
    .image-grid { grid-template-columns: repeat(2, 1fr); gap: 8px; }

    /* --- Mobile Full Screen Search --- */
    body.mobile-search-active { overflow: hidden; }

    body.mobile-search-active .logo,
    body.mobile-search-active .tabs,
    body.mobile-search-active main,
    body.mobile-search-active .app-footer {
        display: none;
    }

    body.mobile-search-active header {
        position: fixed; inset: 0;
        background: var(--bg-body);
        z-index: 9999;
        padding: 0;
        border: none;
        display: flex; flex-direction: column;
    }

    body.mobile-search-active .header-inner {
        padding: 0; margin: 0;
        flex-direction: column;
        width: 100%; height: 100%;
        max-width: none;
    }

    body.mobile-search-active .search-container {
        width: 100%; height: 100%;
        display: flex; flex-direction: column;
    }

    body.mobile-search-active .search-box-wrap {
        border-radius: 0;
        border: none;
        border-bottom: 1px solid var(--border);
        box-shadow: none;
        height: 60px;
        flex-shrink: 0;
        background: var(--bg-surface);
    }
    
    body.mobile-search-active .search-box-wrap.active.has-suggestions {
        border-bottom-left-radius: 0; border-bottom-right-radius: 0;
        border-color: transparent; border-bottom: 1px solid var(--border);
        box-shadow: none;
    }

    body.mobile-search-active .mobile-back-btn { display: block; }
    body.mobile-search-active .search-icon-left { display: none; }

    body.mobile-search-active .suggest-list {
        display: block !important;
        width: 100%; height: auto; flex: 1;
        overflow-y: auto; max-height: none;
        box-shadow: none; border-radius: 0;
        padding: 0; background: var(--bg-body);
    }
}

/* --- Loader & Modal --- */
.skeleton { background: #eee; border-radius: 4px; }
@media (prefers-color-scheme: dark) { .skeleton { background: #3c4043; } }
.sk-line { height: 14px; margin-bottom: 8px; }
.sk-title { height: 22px; width: 60%; margin-bottom: 12px; }
.loader-trigger { height: 80px; display: flex; align-items: center; justify-content: center; opacity: 0; transition: opacity .3s; }
.loader-trigger.visible { opacity: 1; }
.spinner { width: 28px; height: 28px; border: 3px solid var(--border); border-top-color: var(--primary); border-radius: 50%; animation: spin 0.8s linear infinite; }
@keyframes spin { to { transform: rotate(360deg); } }
.modal {
    position: fixed; inset: 0; z-index: 2000;
    background: rgba(0,0,0,0.92); display: none; align-items: center; justify-content: center;
}
.modal.open { display: flex; }
.modal-content { max-width: 95vw; max-height: 90vh; display: flex; flex-direction: column; align-items: center; }
.modal-img-wrapper img { max-width: 90vw; max-height: 80vh; display: block; object-fit: contain; border-radius: 4px; }
.close-btn { position: absolute; top: 16px; right: 24px; color: #fff; font-size: 36px; cursor: pointer; opacity: 0.7; z-index: 2001; }
</style>
</head>
<body>

<div class="app-wrapper">
    <header>
        <div class="header-inner">
            <div class="logo" onclick="window.location.assign('/')">wholphin</div>
            <div class="search-container">
                <div class="search-box-wrap" id="searchBoxWrap">
                    <div class="mobile-back-btn" id="mobileBackBtn">
                        <svg viewBox="0 0 24 24"><path d="M20 11H7.83l5.59-5.59L12 4l-8 8 8 8 1.41-1.41L7.83 13H20v-2z"/></svg>
                    </div>

                    <svg class="search-icon-left" viewBox="0 0 24 24"><path d="M15.5 14h-.79l-.28-.27A6.471 6.471 0 0 0 16 9.5 6.5 6.5 0 1 0 9.5 16c1.61 0 3.09-.59 4.23-1.57l.27.28v.79l5 4.99L20.49 19l-4.99-5zm-6 0C7.01 14 5 11.99 5 9.5S7.01 5 9.5 5 14 7.01 14 9.5 11.99 14 9.5 14z"/></svg>
                    
                    <input type="text" id="searchInput" class="search-input" placeholder="検索" autocomplete="off">
                    
                    <div class="action-btn-area">
                        <div id="micBtn" class="icon-btn mic-btn" title="音声検索">
                            <svg viewBox="0 0 24 24"><path d="M12 14c1.66 0 3-1.34 3-3V5c0-1.66-1.34-3-3-3S9 3.34 9 5v6c0 1.66 1.34 3 3 3z"/><path d="M17 11c0 2.76-2.24 5-5 5s-5-2.24-5-5H5c0 3.53 2.61 6.43 6 6.92V21h2v-3.08c3.39-.49 6-3.39 6-6.92h-2z"/></svg>
                        </div>
                        <div id="clearBtn" class="icon-btn clear-btn" tabindex="-1">
                            <svg viewBox="0 0 24 24"><path d="M19 6.41L17.59 5 12 10.59 6.41 5 5 6.41 10.59 12 5 17.59 6.41 19 12 13.41 17.59 19 19 17.59 13.41 12z"/></svg>
                        </div>
                    </div>
                    
                    <div class="suggest-list" id="suggestList"></div>
                </div>
            </div>
        </div>
        <div class="tabs">
            <div class="tab" data-type="web" onclick="app.switchTab('web')">すべて</div>
            <div class="tab" data-type="image" onclick="app.switchTab('image')">画像</div>
            <div class="tab" data-type="video" onclick="app.switchTab('video')">動画</div>
            <div class="tab" data-type="news" onclick="app.switchTab('news')">ニュース</div>
            <div class="tab" data-type="social" onclick="app.switchTab('social')">ソーシャル</div>
        </div>
    </header>

    <main id="main">
        <div class="content-area">
            <div id="stats" class="stats"></div>
            <div id="resultsContainer"></div>
            <div id="loader" class="loader-trigger">
                <div class="spinner"></div>
            </div>
        </div>
    </main>

    <footer class="app-footer">
        <div class="footer-inner">
            <span class="footer-link">wholphin について</span>
            <span class="footer-link">ヘルプ</span>
            <span class="footer-link">プライバシー</span>
            <span class="footer-link">利用規約</span>
            <span style="flex:1"></span>
            <span>© 2026 wholphin search</span>
        </div>
    </footer>
</div>

<!-- Modal -->
<div id="modal" class="modal" onclick="if(event.target===this) modal.close()">
    <div class="close-btn" onclick="modal.close()">×</div>
    <div class="modal-content">
        <div class="modal-img-wrapper"><img id="modalImg" src=""></div>
        <div style="color:#e8eaed; margin-top:16px; font-size:15px; text-align:center; padding:0 16px;" id="modalTitle"></div>
    </div>
</div>

<script>
const API_ENDPOINT = 'https://api.p2pear.asia/search';

const app = {
    state: {
        q: '',
        type: 'web',
        pages: { web: 1, image: 1, video: 1, news: 1, social: 1 },
        results: { web: [], image: [], video: [], news: [], social: [] },
        hasMore: { web: true, image: true, video: true, news: true, social: true },
        loading: false,
        totalCount: 0,
        suggestIndex: -1,
        suggestions: [],
        isListening: false,
        pendingFetch: null  // ロード中のタブ切替を保持: {q, type, reset} or null
    },

    refs: {
        input: document.getElementById('searchInput'),
        clearBtn: document.getElementById('clearBtn'),
        micBtn: document.getElementById('micBtn'),
        boxWrap: document.getElementById('searchBoxWrap'),
        suggestList: document.getElementById('suggestList'),
        container: document.getElementById('resultsContainer'),
        stats: document.getElementById('stats'),
        loader: document.getElementById('loader'),
        main: document.getElementById('main'),
        mobileBackBtn: document.getElementById('mobileBackBtn')
    },

    init() {
        const params = new URLSearchParams(window.location.search);
        this.state.q = params.get('q') || '';
        this.state.type = params.get('type') || 'web';
        
        this.refs.input.value = this.state.q;
        this.toggleClearBtn();
        this.updateTabUI();
        
        if (this.state.q) this.fetchData(true);

        this.setupEventListeners();
        this.setupVoiceInput();
        
        this.observer = new IntersectionObserver((entries) => {
            if (entries[0].isIntersecting && !this.state.loading) this.loadMore();
        }, { rootMargin: '200px' });
        this.observer.observe(this.refs.loader);
    },

    setupEventListeners() {
        this.refs.input.addEventListener('input', (e) => {
            this.handleInput(e);
            this.toggleClearBtn();
        });
        
        this.refs.input.addEventListener('focus', (e) => {
            if (window.innerWidth <= 820) {
                document.body.classList.add('mobile-search-active');
            }
            this.refs.boxWrap.classList.add('active');

            if (this.refs.input.value.trim().length > 0) {
                 if (this.state.suggestions.length > 0) {
                     this.renderSuggestions(this.state.suggestions);
                 } else {
                     this.fetchSuggestions(this.refs.input.value.trim());
                 }
            }
        });

        this.refs.input.addEventListener('keydown', (e) => this.handleKeydown(e));
        
        this.refs.clearBtn.addEventListener('click', () => {
            this.refs.input.value = '';
            this.refs.input.focus();
            this.toggleClearBtn();
            this.closeSuggest();
        });

        this.refs.mobileBackBtn.addEventListener('click', (e) => {
            e.stopPropagation();
            this.closeSearchMode();
        });

        document.addEventListener('click', (e) => {
            const isMobile = document.body.classList.contains('mobile-search-active');
            if (!this.refs.boxWrap.contains(e.target) && !isMobile) {
                this.closeSuggest();
                this.refs.boxWrap.classList.remove('active');
            }
        });

        window.onpopstate = (e) => {
            if (e.state) {
                this.state.q = e.state.q;
                this.state.type = e.state.type;
                this.refs.input.value = this.state.q;
                this.toggleClearBtn();
                this.resetResults();
                this.updateTabUI();
                this.fetchData(true);
            }
        };
    },

    closeSearchMode() {
        document.body.classList.remove('mobile-search-active');
        this.refs.boxWrap.classList.remove('active');
        this.refs.input.blur();
        this.closeSuggest();
    },

    setupVoiceInput() {
        const SpeechRecognition = window.SpeechRecognition || window.webkitSpeechRecognition;
        if (!SpeechRecognition) {
            this.refs.micBtn.style.display = 'none';
            return;
        }

        const recognition = new SpeechRecognition();
        recognition.lang = 'ja-JP';
        recognition.interimResults = false;
        recognition.maxAlternatives = 1;

        recognition.onstart = () => {
            this.state.isListening = true;
            this.refs.micBtn.classList.add('listening');
            this.refs.input.placeholder = "お話しください...";
        };

        recognition.onend = () => {
            this.state.isListening = false;
            this.refs.micBtn.classList.remove('listening');
            this.refs.input.placeholder = "検索";
        };

        recognition.onresult = (event) => {
            const transcript = event.results[0][0].transcript;
            if (transcript) {
                this.refs.input.value = transcript;
                this.toggleClearBtn();
                this.performSearch();
            }
        };

        recognition.onerror = (e) => {
            console.error('Voice Error:', e.error);
            this.state.isListening = false;
            this.refs.micBtn.classList.remove('listening');
            this.refs.input.placeholder = "エラーが発生しました";
            setTimeout(() => { this.refs.input.placeholder = "検索"; }, 2000);
        };

        this.refs.micBtn.addEventListener('click', () => {
            if (this.state.isListening) {
                recognition.stop();
            } else {
                recognition.start();
            }
        });
    },

    toggleClearBtn() {
        const hasVal = this.refs.input.value.length > 0;
        this.refs.boxWrap.classList.toggle('has-value', hasVal);
    },

    handleInput(e) {
        const val = e.target.value.trim();
        if (val.length === 0) {
            this.closeSuggest();
            return;
        }
        clearTimeout(this.suggestTimer);
        this.suggestTimer = setTimeout(() => this.fetchSuggestions(val), 250);
    },

    async fetchSuggestions(query) {
        try {
            const res = await fetch(`${API_ENDPOINT}?q=${encodeURIComponent(query)}&type=suggest`);
            const data = await res.json();
            
            let list = [];
            if (Array.isArray(data.results)) list = data.results;
            else if (Array.isArray(data)) list = data;
            else if (data.suggestions) list = data.suggestions;

            this.state.suggestions = list;
            this.renderSuggestions(list);
        } catch (e) { console.error('Suggest error', e); }
    },

    getSuggestText(item) {
        if (!item) return '';
        if (typeof item === 'string') return item;
        return item.title || item.text || item.value || '';
    },

    renderSuggestions(list) {
        if (!list || list.length === 0) {
            this.closeSuggest();
            return;
        }

        const html = list.map((item, idx) => {
            const text = this.getSuggestText(item);
            if (!text) return '';
            return `
                <div class="suggest-item" data-idx="${idx}" onclick="app.selectSuggest(${idx})">
                    <svg class="suggest-icon" viewBox="0 0 24 24"><path d="M15.5 14h-.79l-.28-.27A6.471 6.471 0 0 0 16 9.5 6.5 6.5 0 1 0 9.5 16c1.61 0 3.09-.59 4.23-1.57l.27.28v.79l5 4.99L20.49 19l-4.99-5zm-6 0C7.01 14 5 11.99 5 9.5S7.01 5 9.5 5 14 7.01 14 9.5 11.99 14 9.5 14z"/></svg>
                    <span class="suggest-text">${text}</span>
                </div>
            `;
        }).join('');

        if (html) {
            this.refs.suggestList.innerHTML = html;
            this.refs.boxWrap.classList.add('has-suggestions');
        } else {
            this.closeSuggest();
        }
        this.state.suggestIndex = -1;
    },

    selectSuggest(index) {
        const item = this.state.suggestions[index];
        const text = this.getSuggestText(item);
        if (text) {
            this.refs.input.value = text;
            this.toggleClearBtn();
            this.closeSearchMode();
            this.performSearch();
        }
    },

    closeSuggest() {
        this.refs.boxWrap.classList.remove('has-suggestions');
        this.refs.suggestList.innerHTML = '';
        this.state.suggestIndex = -1;
    },

    handleKeydown(e) {
        const items = document.querySelectorAll('.suggest-item');
        if (e.key === 'Enter') {
            if (this.state.suggestIndex >= 0 && items[this.state.suggestIndex]) {
                items[this.state.suggestIndex].click();
            } else {
                this.closeSearchMode();
                this.performSearch();
            }
        } else if (e.key === 'ArrowDown' && items.length > 0) {
            e.preventDefault();
            this.state.suggestIndex = Math.min(this.state.suggestIndex + 1, items.length - 1);
            this.updateSuggestSelection(items);
        } else if (e.key === 'ArrowUp' && items.length > 0) {
            e.preventDefault();
            this.state.suggestIndex = Math.max(this.state.suggestIndex - 1, -1);
            this.updateSuggestSelection(items);
        }
    },

    updateSuggestSelection(items) {
        items.forEach(i => i.classList.remove('selected'));
        if (this.state.suggestIndex >= 0) {
            const item = items[this.state.suggestIndex];
            item.classList.add('selected');
            const idx = parseInt(item.dataset.idx);
            this.refs.input.value = this.getSuggestText(this.state.suggestions[idx]);
        }
    },

    updateTabUI() {
        document.querySelectorAll('.tab').forEach(t => {
            t.classList.toggle('active', t.dataset.type === this.state.type);
        });
        this.refs.main.setAttribute('data-mode', this.state.type);
    },

    switchTab(type) {
        if (this.state.type === type) return;
        this.state.type = type;
        this.updateTabUI();
        this.updateURL();
        this.renderResults();
        
        if (this.state.results[type].length === 0 && this.state.q) {
            // [修正] ロード中ならpendingFetchに積み、そうでなければ即座にfetchData
            if (this.state.loading) {
                this.state.pendingFetch = { q: this.state.q, type: this.state.type, reset: true };
            } else {
                this.fetchData(true);
            }
        }
    },

    performSearch() {
        const val = this.refs.input.value.trim();
        if (!val) return;
        this.state.q = val;
        this.resetResults();
        this.updateURL();
        this.fetchData(true);
    },

    resetResults() {
        this.state.pages = { web: 1, image: 1, video: 1, news: 1, social: 1 };
        this.state.results = { web: [], image: [], video: [], news: [], social: [] };
        this.state.hasMore = { web: true, image: true, video: true, news: true, social: true };
        this.refs.container.innerHTML = '';
        this.refs.stats.textContent = '';
    },

    updateURL() {
        const url = `?q=${encodeURIComponent(this.state.q)}&type=${this.state.type}`;
        history.pushState({ q: this.state.q, type: this.state.type }, '', url);
    },

    async fetchData(isInitial = false) {
        if (this.state.loading) return;
        const type = this.state.type;
        const page = this.state.pages[type];

        if (page > 5) {
            this.state.hasMore[type] = false;
            this.toggleLoader(false);
            return;
        }

        this.state.loading = true;
        this.toggleLoader(true);

        if (isInitial && this.state.results[type].length === 0) {
            this.renderSkeleton();
        }

        try {
            const res = await fetch(`${API_ENDPOINT}?q=${encodeURIComponent(this.state.q)}&type=${type}&pages=${page}`);
            const data = await res.json();
            
            const newItems = data.results || [];
            this.state.results[type] = [...this.state.results[type], ...newItems];
            this.state.totalCount = data.count || this.state.results[type].length;

            if (newItems.length === 0) this.state.hasMore[type] = false;
            else this.state.pages[type]++;

            this.renderResults();
        } catch (e) {
            console.error(e);
            this.refs.stats.textContent = "読み込みエラーが発生しました";
        } finally {
            this.state.loading = false;
            if (this.state.pages[type] > 5) this.toggleLoader(false);
            this.flushPendingFetch();  // [修正] ロード完了後にpendingFetchを処理
        }
    },

    loadMore() {
        if (this.state.hasMore[this.state.type]) this.fetchData();
        else {
            this.toggleLoader(false);
            this.flushPendingFetch();  // [修正] 追加ロード終了時もpendingFetchを処理
        }
    },

    flushPendingFetch() {
        // ロード中に積まれた切替要求を処理（ロード終了後に呼ばれる）
        const p = this.state.pendingFetch;
        if (!p) return;

        // 古い要求は捨てる（現在の状態と一致しているかチェック）
        if (p.q === this.state.q && p.type === this.state.type && !this.state.loading) {
            this.state.pendingFetch = null;
            // 再入を避けるため、0ms で次タスク側に逃がす
            setTimeout(() => this.fetchData(!!p.reset), 0);
        }
    },

    toggleLoader(show) {
        this.refs.loader.classList.toggle('visible', show);
    },

    renderSkeleton() {
        const type = this.state.type;
        let html = '';
        if (type === 'web' || type === 'news') {
            for(let i=0; i<4; i++) html += `<div class="web-item"><div class="sk-title skeleton"></div><div class="sk-line skeleton"></div><div class="sk-line skeleton" style="width:80%"></div></div>`;
        } else if (type === 'image') {
            html = '<div class="image-grid">';
            for(let i=0; i<10; i++) html += '<div class="img-card skeleton"></div>';
            html += '</div>';
        } else if (type === 'video') {
            for(let i=0; i<4; i++) html += `<div class="video-item"><div class="video-thumb skeleton"></div><div style="flex:1"><div class="sk-title skeleton"></div><div class="sk-line skeleton"></div></div></div>`;
        } else if (type === 'social') {
            for(let i=0; i<4; i++) html += `<div class="social-item"><div class="social-header"><div class="social-avatar skeleton"></div><div class="sk-title skeleton" style="width:30%;height:16px;margin:0"></div></div><div class="sk-line skeleton"></div></div>`;
        }
        this.refs.container.innerHTML = html;
    },

    isInvalid(str) {
        if (!str) return true;
        const s = String(str).trim();
        return s === 'null' || s === 'undefined' || s === '';
    },

    renderResults() {
        const type = this.state.type;
        const list = this.state.results[type];
        
        if (list.length > 0) {
            this.refs.stats.textContent = `約 ${this.state.totalCount.toLocaleString()} 件`;
        } else if (!this.state.loading) {
            this.refs.stats.textContent = '見つかりませんでした';
        }

        if (type === 'web') this.renderWebList(list);
        else if (type === 'image') this.renderImageGrid(list);
        else if (type === 'video') this.renderVideoList(list);
        else if (type === 'news') this.renderNewsList(list);
        else if (type === 'social') this.renderSocialList(list);
    },

    renderWebList(list) {
        this.refs.container.innerHTML = list.map(item => {
            if (this.isInvalid(item.title) && this.isInvalid(item.summary)) return '';
            return `
            <div class="web-item">
                <div class="web-cite">
                    ${item.favicon ? `<img src="${item.favicon}" onerror="this.style.display='none'">` : ''}
                    <span>${new URL(item.url).hostname}</span>
                </div>
                <a href="${item.url}" target="_blank" class="web-title">${item.title || 'No Title'}</a>
                <div class="web-desc">${item.summary || ''}</div>
            </div>
            `;
        }).join('');
    },

    renderVideoList(list) {
        this.refs.container.innerHTML = list.map(item => {
            if (this.isInvalid(item.title)) return '';
            return `
            <div class="video-item" onclick="window.open('${item.url}')">
                <div class="video-thumb">
                    <img src="${item.thumbnail || ''}" onerror="this.src='//placehold.co/320x180/eee/999?text=No+Thumb'">
                </div>
                <div class="video-info">
                    <div class="video-title">${item.title || 'No Title'}</div>
                    <div class="video-meta">
                        <span>${new URL(item.url).hostname}</span>
                        ${item.duration ? `• ${item.duration}` : ''}
                        ${item.publishedDate ? `• ${item.publishedDate}` : ''}
                    </div>
                    <div class="video-desc">${item.summary || ''}</div>
                </div>
            </div>
            `;
        }).join('');
    },

    renderNewsList(list) {
        this.refs.container.innerHTML = list.map(item => {
             return `
            <div class="news-item">
                <div class="news-source">
                    ${item.favicon ? `<img src="${item.favicon}" style="width:16px;height:16px;">` : ''}
                    <span>${new URL(item.url).hostname}</span>
                </div>
                <a href="${item.url}" target="_blank" class="news-title">${item.title || 'No Title'}</a>
                <div class="web-desc">${item.summary || ''}</div>
                <div class="news-date" style="margin-top:4px;color:#70757a">${item.publishedDate || ''}</div>
            </div>
            `;
        }).join('');
    },


    renderSocialList(list) {
        // テキスト整形関数（内部定義または外出し）
        const formatText = (text) => {
            if (!text) return '';
            // XSS対策エスケープ
            let t = text.replace(/&/g, "&amp;").replace(/</g, "&lt;").replace(/>/g, "&gt;").replace(/"/g, "&quot;").replace(/'/g, "&#039;");
            // URLリンク化
            t = t.replace(/(https?:\/\/[^\s]+)/g, '<a href="$1" target="_blank" rel="noopener noreferrer" onclick="event.stopPropagation()" style="color:#1a0dab;text-decoration:none;">$1</a>');
            // 改行対応
            t = t.replace(/\n/g, '<br>');
            return t;
        };

        this.refs.container.innerHTML = list.map(item => {
            // 画像グリッド処理（既存コード）
            let imagesHtml = '';
            if (item.hasImages && item.images && item.images.length > 0) {
                const imgCount = item.images.length;
                const displayImages = item.images.slice(0, 4);
                const gridClass = `count-${Math.min(imgCount, 4)}`;

                imagesHtml = `
                <div class="social-images ${gridClass}">
                    ${displayImages.map(img => `
                        <div class="social-img-wrap" onclick="event.stopPropagation(); modal.openImage('${img.url}')">
                            <img src="${img.thumbnailUrl}" alt="" loading="lazy" onerror="this.style.display='none'">
                        </div>
                    `).join('')}
                </div>
                ${imgCount > 4 ? `<div class="social-img-more">+${imgCount - 4}枚の画像</div>` : ''}
                `;
            }

            // 本文の整形（formatText適用）
            const contentHtml = formatText(item.summary || item.content || item.title);

            return `
            <div class="social-item" style="cursor:pointer" onclick="window.open('${item.url}')">
                <div class="social-header">
                    ${item.favicon ? `<img src="${item.favicon}" class="social-avatar" onerror="this.style.display='none'">` : '<div class="social-avatar"></div>'}
                    <span class="social-author">${item.author || new URL(item.url).hostname}</span>
                    <span class="social-date">${item.publishedDate || ''}</span>
                </div>
                <!-- ここを変更: formatText適用済みHTMLを出力 -->
                <div class="social-content">${contentHtml}</div>
                ${imagesHtml}
            </div>
            `;
        }).join('');
    },


    renderImageGrid(list) {
        let html = '<div class="image-grid">';
        html += list.map((item, index) => {
            if (this.isInvalid(item.thumbnail)) return '';
            return `
            <div class="img-card" onclick="modal.open(${index})">
                <img src="${item.thumbnail}" loading="lazy">
                <div class="overlay"><div style="font-size:12px">${item.title || ''}</div></div>
            </div>
            `;
        }).join('');
        html += '</div>';
        this.refs.container.innerHTML = html;
    }
};

const modal = {
    el: document.getElementById('modal'),
    img: document.getElementById('modalImg'),
    title: document.getElementById('modalTitle'),
    open(index) {
        const item = app.state.results.image[index];
        if(!item) return;
        this.img.src = item.thumbnail;
        this.title.textContent = item.title;
        this.el.classList.add('open');
        document.body.style.overflow = 'hidden';
    },
    openImage(url) {
        this.img.src = url;
        this.title.textContent = '';
        this.el.classList.add('open');
        document.body.style.overflow = 'hidden';
    },
    close() {
        this.el.classList.remove('open');
        document.body.style.overflow = '';
    }
};



/* ===== wholphin Advanced Params Extension (Refined) ===== */
(function() {
    // Safety check
    if (!window.app || !app.state) return;

    // 1. EXTEND STATE (Add-only)
    const s = app.state;
    if (typeof s.excludeDomains === 'undefined') s.excludeDomains = [];
    if (typeof s.siteDomains === 'undefined') s.siteDomains = [];
    if (typeof s.theme === 'undefined') s.theme = 'auto';
    if (typeof s.showKnowledgePanel === 'undefined') s.showKnowledgePanel = false;
    if (typeof s.knowledgePanel === 'undefined') s.knowledgePanel = null;
    if (typeof s.highlightKeywords === 'undefined') s.highlightKeywords = false;

    // 2. UTILS
    function getParams() { return new URLSearchParams(window.location.search); }

    function parseDomains(str) {
        if (!str) return [];
        return str.split(',').map(d => {
            return d.trim().replace(/^https?:\/\//, '').split('/')[0];
        }).filter(Boolean);
    }

    function injectStyles() {
        if (document.getElementById('wholphin-advanced-style')) return;
        const css = `
:root { --hl-bg: #fff8dc; --hl-text: #000; }
@media (prefers-color-scheme: dark) { :root { --hl-bg: #4a4a00; --hl-text: #ff9; } }
[data-theme="light"] { --hl-bg: #fff8dc; --hl-text: #000; }
[data-theme="dark"] { --hl-bg: #4a4a00; --hl-text: #ff9; }
[data-theme="amoled"] { 
  --hl-bg: #333300; --hl-text: #ff9; 
  --bg-body: #000; --bg-surface: #000; --bg-hover: #111; --border: #333;
  --text-main: #fff; --text-sub: #ccc; --header-bg: #000; --footer-bg: #000;
}
mark.hl { background: var(--hl-bg); color: var(--hl-text); padding: 0 2px; border-radius: 2px; font-weight: bold; }
.k-panel { 
  background: var(--bg-surface); border: 1px solid var(--border); 
  border-radius: 12px; padding: 16px; margin-bottom: 24px; display: flex; gap: 16px;
}
.k-img { width: 60px; height: 60px; object-fit: cover; border-radius: 8px; background: #333; flex-shrink: 0; }
.k-body { flex: 1; min-width: 0; }
.k-title { font-size: 18px; font-weight: 700; color: var(--text-link); margin-bottom: 4px; }
.k-desc { font-size: 13px; color: var(--text-main); line-height: 1.5; }
.k-meta { font-size: 11px; color: var(--text-sub); margin-bottom: 4px; }
`;
        const style = document.createElement('style');
        style.id = 'wholphin-advanced-style';
        style.textContent = css;
        document.head.appendChild(style);
    }

    // 3. APPLY SETTINGS
    const p = getParams();
    const exclude = p.get('exclude');
    const site = p.get('site');
    const theme = p.get('theme');
    const panel = p.get('show_panel');
    const hl = p.get('highlight');

    // Domain Filters
    if (exclude) s.excludeDomains = parseDomains(exclude);
    if (site) s.siteDomains = parseDomains(site);

    // Theme (Priority: Param > LocalStorage > Auto)
    const savedTheme = localStorage.getItem('wholphin_theme');
    const targetTheme = theme || savedTheme;
    if (targetTheme && ['light','dark','amoled'].includes(targetTheme)) {
        injectStyles(); // Ensure CSS vars exist
        s.theme = targetTheme;
        document.documentElement.setAttribute('data-theme', targetTheme);
        if (theme) localStorage.setItem('wholphin_theme', theme); // Save if explicitly set via param
    } else {
        document.documentElement.removeAttribute('data-theme');
    }

    // Flags
    if (panel === '1') { injectStyles(); s.showKnowledgePanel = true; }
    if (hl === '1') { injectStyles(); s.highlightKeywords = true; }

    // 4. OVERRIDE RENDER (Hook)
    if (!app._hooked) {
        const originalRender = app.renderWebList.bind(app);
        app.renderWebList = function(list) {
            let final = list || [];

            // Filter
            if (s.excludeDomains.length || s.siteDomains.length) {
                final = final.filter(item => {
                    try {
                        const h = new URL(item.url).hostname;
                        if (s.siteDomains.length && !s.siteDomains.some(d => h.includes(d))) return false;
                        if (s.excludeDomains.length && s.excludeDomains.some(d => h.includes(d))) return false;
                        return true;
                    } catch(e) { return true; }
                });
            }

            // Highlight
            if (s.highlightKeywords && s.q) {
                const terms = s.q.split(/\s+/).filter(Boolean);
                if (terms.length) {
                    const esc = terms.map(t => t.replace(/[.*+?^${}()|[\]\\]/g, '\\$&')).join('|');
                    const re = new RegExp(`(${esc})`, 'gi');
                    // Map to new objects to avoid mutating raw data
                    final = final.map(it => ({
                        ...it,
                        title: (it.title||'').replace(re, '<mark class="hl">$1</mark>'),
                        summary: (it.summary||'').replace(re, '<mark class="hl">$1</mark>')
                    }));
                }
            }

            // Render
            originalRender(final);

            // Panel (Insert after render)
            if (s.showKnowledgePanel && final.length > 0) {
                const top = final[0];
                const kHtml = `
<div class="k-panel">
    ${top.favicon ? `<img src="${top.favicon}" class="k-img" onerror="this.style.display='none'">` : ''}
    <div class="k-body">
        <div class="k-meta">ナレッジパネル (Top Result)</div>
        <div class="k-title">${top.title}</div>
        <div class="k-desc">${top.summary}</div>
        <a href="${top.url}" style="font-size:12px; margin-top:8px; display:inline-block;">詳細 ></a>
    </div>
</div>`;
                // Insert as first child
                this.refs.container.insertAdjacentHTML('afterbegin', kHtml);
            }
        };
        app._hooked = true;
    }
})();

app.init();
</script>

</body>
</html>