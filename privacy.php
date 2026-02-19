<!DOCTYPE html>
<html lang="ja">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=no">
<title>プライバシーポリシー - wholphin</title>
<link rel="preconnect" href="https://fonts.googleapis.com">
<link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
<link href="https://fonts.googleapis.com/css2?family=Merriweather+Sans:ital,wght@0,300..800;1,300..800&family=Noto+Sans+JP:wght@400..700&display=swap" rel="stylesheet">
<link rel="stylesheet" href="about.css">

<!-- GSAP & Lenis -->
<script src="https://cdnjs.cloudflare.com/ajax/libs/gsap/3.12.5/gsap.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/gsap/3.12.5/ScrollTrigger.min.js"></script>
<script src="https://unpkg.com/@studio-freight/lenis@1.0.42/dist/lenis.min.js"></script>

<style>
/* プライバシーポリシー専用スタイル */
.privacy-hero {
    min-height: 40vh;
    padding-top: 120px;
    padding-bottom: 60px;
}

.privacy-hero .hero-sub {
    font-size: 12px;
    font-weight: 600;
    color: var(--primary);
    letter-spacing: 0.08em;
    text-transform: uppercase;
    margin-bottom: 16px;
    opacity: 0;
    animation: slideUp 0.6s var(--ease-out) 0.1s forwards;
}

.privacy-hero .hero-title {
    font-size: 48px;
    font-weight: 700;
    line-height: 1.2;
    letter-spacing: -0.03em;
    margin-bottom: 20px;
    opacity: 0;
    animation: slideUp 0.6s var(--ease-out) 0.2s forwards;
}

.privacy-hero .hero-desc {
    font-size: 16px;
    color: var(--text-sub);
    max-width: 600px;
    line-height: 1.7;
    opacity: 0;
    animation: slideUp 0.6s var(--ease-out) 0.3s forwards;
}

.privacy-content {
    max-width: 720px;
    margin: 0 auto;
    padding: 40px 24px 100px;
}

.privacy-section {
    margin-bottom: 56px;
    opacity: 0;
    transform: translateY(20px);
    transition: opacity 0.6s var(--ease-out), transform 0.6s var(--ease-out);
}

.privacy-section.visible {
    opacity: 1;
    transform: translateY(0);
}

.privacy-section h2 {
    font-size: 24px;
    font-weight: 700;
    margin-bottom: 16px;
    letter-spacing: -0.02em;
    color: var(--text-main);
    position: relative;
    padding-left: 16px;
}

.privacy-section h2::before {
    content: '';
    position: absolute;
    left: 0;
    top: 4px;
    width: 4px;
    height: 24px;
    background: var(--primary);
    border-radius: 2px;
}

.privacy-section h3 {
    font-size: 18px;
    font-weight: 600;
    margin-bottom: 12px;
    margin-top: 24px;
    color: var(--text-main);
}

.privacy-section p {
    font-size: 15px;
    line-height: 1.8;
    color: var(--text-main);
    margin-bottom: 16px;
}

.privacy-section ul {
    list-style: none;
    padding-left: 0;
    margin-bottom: 16px;
}

.privacy-section li {
    font-size: 15px;
    line-height: 1.8;
    color: var(--text-main);
    padding-left: 24px;
    margin-bottom: 8px;
    position: relative;
}

.privacy-section li::before {
    content: '•';
    position: absolute;
    left: 8px;
    color: var(--primary);
    font-weight: bold;
}

.privacy-highlight {
    background: rgba(26, 115, 232, 0.08);
    border-left: 3px solid var(--primary);
    padding: 20px 24px;
    border-radius: 8px;
    margin: 24px 0;
}

.privacy-highlight p {
    margin-bottom: 0;
    font-weight: 500;
}

.privacy-date {
    font-size: 13px;
    color: var(--text-sub);
    margin-top: 60px;
    padding-top: 24px;
    border-top: 1px solid var(--border-subtle);
}

@media (max-width: 600px) {
    .privacy-hero .hero-title {
        font-size: 36px;
    }
    
    .privacy-section h2 {
        font-size: 20px;
    }
    
    .privacy-section h3 {
        font-size: 16px;
    }
}
</style>

</head>
<body>

<div style="position:fixed; top:-20%; right:-10%; width:60vw; height:60vw; background:radial-gradient(circle, rgba(26,115,232,0.03) 0%, transparent 60%); pointer-events:none; z-index:-1;"></div>

<nav class="nav-header">
    <a href="index.php" class="brand-logo">wholphin</a>
    <a href="about.php" class="back-btn">About に戻る</a>
</nav>

<!-- Hero -->
<section class="hero privacy-hero">
    <span class="hero-sub">Privacy Policy</span>
    
    <h1 class="hero-title">プライバシーポリシー</h1>
    
    <p class="hero-desc">
        wholphinは、あなたのプライバシーを尊重し、透明性のある検索体験を提供します。このポリシーでは、私たちが収集する情報とその取り扱いについて説明します。
    </p>
</section>

<!-- Privacy Content -->
<div class="privacy-content">
    <div class="privacy-section">
        <h2>基本方針</h2>
        <div class="privacy-highlight">
            <p>wholphinは、ユーザーの検索履歴を保存せず、個人を追跡しません。あなたのプライバシーは、私たちにとって最優先事項です。</p>
        </div>
    </div>

    <div class="privacy-section">
        <h2>収集する情報</h2>
        
        <h3>1. 検索クエリ</h3>
        <p>検索結果を提供するために、入力された検索クエリを一時的に処理します。これらのクエリは個人と紐付けられず、統計的な分析にのみ使用されます。</p>
        
        <h3>2. 技術情報</h3>
        <p>サービスの改善とセキュリティ維持のため、以下の技術情報を収集する場合があります：</p>
        <ul>
            <li>IPアドレス（匿名化処理済み）</li>
            <li>ブラウザの種類とバージョン</li>
            <li>デバイスの種類</li>
            <li>アクセス日時</li>
        </ul>
        
        <h3>3. Cookie</h3>
        <p>wholphinは、基本的な機能提供のために最小限のCookieを使用します。これらは検索設定の保持や、セッション管理に限定されます。トラッキング目的でのCookie使用は一切行いません。</p>
    </div>

    <div class="privacy-section">
        <h2>情報の使用目的</h2>
        <p>収集した情報は、以下の目的でのみ使用されます：</p>
        <ul>
            <li>検索結果の提供と精度向上</li>
            <li>サービスの安定性とセキュリティの維持</li>
            <li>統計的な利用状況の分析（個人を特定しない形式）</li>
            <li>法的義務の遵守</li>
        </ul>
    </div>

    <div class="privacy-section">
        <h2>情報の保管と保護</h2>
        <p>収集された情報は、業界標準のセキュリティ対策により保護されます。検索クエリは処理後速やかに匿名化され、個人識別可能な形式での長期保管は行いません。</p>
        <p>技術情報は、サービス運用に必要な最短期間のみ保管され、定期的に削除されます。</p>
    </div>

    <div class="privacy-section">
        <h2>第三者への情報提供</h2>
        <p>wholphinは、以下の場合を除き、ユーザー情報を第三者に提供、販売、または共有することはありません：</p>
        <ul>
            <li>法的要請に基づく場合</li>
            <li>サービス提供に必要な技術パートナー（厳格な守秘義務契約下）</li>
            <li>ユーザーの明示的な同意がある場合</li>
        </ul>
    </div>

    <div class="privacy-section">
        <h2>外部サービスとの連携</h2>
        <p>検索結果には外部ウェブサイトへのリンクが含まれます。これらの外部サイトは独自のプライバシーポリシーを持ち、wholphinの管理下にはありません。外部サイトへのアクセスについては、各サイトのポリシーをご確認ください。</p>
    </div>

    <div class="privacy-section">
        <h2>ユーザーの権利</h2>
        <p>ユーザーは以下の権利を有します：</p>
        <ul>
            <li>収集された情報へのアクセス権</li>
            <li>情報の訂正または削除の要求</li>
            <li>データ処理への異議申し立て</li>
            <li>Cookieの管理と拒否</li>
        </ul>
        <p>これらの権利行使については、フッターに記載の連絡先までお問い合わせください。</p>
    </div>

    <div class="privacy-section">
        <h2>子どものプライバシー</h2>
        <p>wholphinは、13歳未満の子どもから意図的に個人情報を収集することはありません。保護者の方が、お子様が個人情報を提供したと思われる場合は、速やかにご連絡ください。</p>
    </div>

    <div class="privacy-section">
        <h2>ポリシーの変更</h2>
        <p>このプライバシーポリシーは、法令の変更やサービスの改善に伴い、予告なく更新される場合があります。重要な変更がある場合は、サイト上で通知いたします。</p>
        <p>定期的にこのページを確認し、最新のポリシーをご確認ください。</p>
    </div>

    <div class="privacy-section">
        <h2>お問い合わせ</h2>
        <p>プライバシーポリシーに関するご質問やご意見は、以下の方法でお問い合わせください：</p>
        <p style="margin-top: 16px;">
            <strong>メール：</strong> privacy@wholphin.net<br>
            <strong>運営：</strong> wholphin 開発チーム
        </p>
    </div>

    <div class="privacy-date">
        <p>最終更新日：2026年2月19日</p>
    </div>
</div>

<footer class="app-footer">
    <div class="footer-inner">
        <div class="footer-links">
            <a href="about.php" class="footer-link">About</a>
            <a href="#" class="footer-link">ヘルプ</a>
            <a href="privacy.php" class="footer-link">プライバシー</a>
            <a href="#" class="footer-link">利用規約</a>
        </div>
        <div class="copyright">© 2026 wholphin</div>
    </div>
</footer>

<script>
gsap.registerPlugin(ScrollTrigger);

// --- Lenis Setup ---
const lenis = new Lenis({
  smooth: true,
  lerp: 0.08
});
lenis.on('scroll', ScrollTrigger.update);
gsap.ticker.add((time) => {
  lenis.raf(time * 1000);
});
gsap.ticker.lagSmoothing(0);

// --- Section Reveal on Scroll ---
const sections = document.querySelectorAll('.privacy-section');
const sectionObserver = new IntersectionObserver((entries) => {
    entries.forEach(entry => {
        if (entry.isIntersecting) {
            entry.target.classList.add('visible');
        }
    });
}, { threshold: 0.1 });

sections.forEach(section => sectionObserver.observe(section));

// --- Header Scroll Effect ---
const header = document.querySelector('.nav-header');
window.addEventListener('scroll', () => {
    if (window.scrollY > 20) {
        header.classList.add('scrolled');
    } else {
        header.classList.remove('scrolled');
    }
});
</script>

</body>
</html>