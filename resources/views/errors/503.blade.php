<!DOCTYPE html>
<html lang="ar" dir="rtl">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="robots" content="noindex">
    <title>تحت الصيانة — إتقان لتقنية المعلومات</title>
    <link rel="icon" type="image/svg+xml" href="/images/favicon.svg">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=IBM+Plex+Mono:wght@400;500&family=IBM+Plex+Sans+Arabic:wght@300;400;500;600;700&display=swap" rel="stylesheet">
    <style>
        :root{ --bg:#0a141d; --ink:#eaf1f6; --muted:#8194a3; --line:rgba(255,255,255,.10);
               --b1:#226b9f; --b2:#27abe3; }
        *{ margin:0; padding:0; box-sizing:border-box; }
        html,body{ height:100%; }
        body{
            font-family:'IBM Plex Sans Arabic', system-ui, sans-serif;
            background:var(--bg); color:var(--ink); -webkit-font-smoothing:antialiased;
            background-image:
                linear-gradient(rgba(255,255,255,.022) 1px, transparent 1px),
                linear-gradient(90deg, rgba(255,255,255,.022) 1px, transparent 1px);
            background-size:46px 46px;
        }
        .mono{ font-family:'IBM Plex Mono', monospace; }
        .sheet{ position:relative; min-height:100vh; max-width:1180px; margin:0 auto;
            padding:36px clamp(22px,5.5vw,68px); display:flex; flex-direction:column; overflow:hidden; }
        .glow{ position:absolute; inset-block-start:-26%; inset-inline-start:-14%;
            width:min(60vw,640px); aspect-ratio:1; border-radius:50%; z-index:0; pointer-events:none;
            background:radial-gradient(circle, rgba(39,171,227,.16), transparent 62%); }
        .row{ position:relative; z-index:1; display:flex; align-items:center; justify-content:space-between; gap:18px; }
        .row.head{ padding-bottom:20px; border-bottom:1px solid var(--line); }
        .brand{ display:inline-flex; align-items:center; gap:11px; }
        .brand svg{ height:30px; width:auto; color:var(--b2); }
        .brand b{ font-weight:700; font-size:21px; letter-spacing:.5px; color:#fff; }
        .status{ display:inline-flex; align-items:center; gap:9px; font-size:12.5px; color:var(--muted); letter-spacing:1px; }
        .status .dot{ width:7px; height:7px; border-radius:50%; background:var(--b2); }
        main{ position:relative; z-index:1; flex:1; display:flex; flex-direction:column; justify-content:center; padding:60px 0; }
        .kicker{ font-size:13.5px; color:var(--b2); letter-spacing:2px; margin-bottom:26px; }
        h1{ font-weight:700; font-size:clamp(46px,12vw,128px); line-height:1; letter-spacing:-1.5px; margin-bottom:30px; }
        h1 em{ font-style:normal; color:var(--b2); }
        .lead{ font-size:clamp(16px,2vw,19px); font-weight:300; line-height:2; color:#aab8c4; max-width:44ch; }
        .track{ margin-top:42px; width:min(280px,70%); height:3px; background:rgba(255,255,255,.08);
            border-radius:99px; overflow:hidden; }
        .track i{ display:block; height:100%; width:42%; border-radius:99px;
            background:linear-gradient(90deg,var(--b1),var(--b2)); animation:slide 1.9s ease-in-out infinite; }
        .row.foot{ padding-top:20px; border-top:1px solid var(--line); margin-top:auto;
            font-size:13px; color:var(--muted); letter-spacing:.3px; flex-wrap:wrap; }
        .foot a{ color:var(--ink); text-decoration:none; border-bottom:1px solid var(--line); padding-bottom:2px; transition:.2s; }
        .foot a:hover{ color:var(--b2); border-color:var(--b2); }
        .reveal{ opacity:0; transform:translateY(16px); animation:rise .9s cubic-bezier(.2,.7,.2,1) forwards; }
        .d1{ animation-delay:.05s } .d2{ animation-delay:.15s } .d3{ animation-delay:.28s } .d4{ animation-delay:.4s }
        @keyframes rise{ to{ opacity:1; transform:none } }
        @keyframes slide{ 0%{transform:translateX(120%)} 100%{transform:translateX(-320%)} }
        @media (max-width:560px){ .status .label{ display:none } main{ padding:40px 0 } h1{ letter-spacing:-.5px } }
        @media (prefers-reduced-motion:reduce){ .reveal{ animation:none; opacity:1; transform:none } .track i,.status .dot{ animation:none } }
    </style>
</head>
<body>
    <div class="sheet">
        <div class="glow"></div>

        <header class="row head reveal d1">
            <span class="brand">
                <svg viewBox="0 0 64 64" xmlns="http://www.w3.org/2000/svg" aria-hidden="true">
                    <path fill="currentColor" d="M30 2C14.5 2 2 14.5 2 30s12.5 28 28 28c5.2 0 10-1.4 14.2-3.9l8 8a5 5 0 0 0 7.1-7.1l-7.6-7.6A27.9 27.9 0 0 0 58 30C58 14.5 45.5 2 30 2Zm0 16a12 12 0 1 1 0 24 12 12 0 0 1 0-24Z"/>
                </svg>
                <b>ITQAAN</b>
            </span>
            <span class="status"><span class="dot"></span><span class="label mono">MAINTENANCE · 503</span></span>
        </header>

        <main>
            <p class="kicker mono reveal d2">// نُحدّث المنصّة</p>
            <h1 class="reveal d2">تحت <em>الصيانة</em></h1>
            <p class="lead reveal d3">
                نُجري تحديثاتٍ جوهرية على الموقع لنعود بتجربةٍ أحدث وأسرع.
                نشكر لكم صبركم — لن يطول الانتظار.
            </p>
            <div class="track reveal d4"><i></i></div>
        </main>

        <footer class="row foot reveal d4">
            <span>للتواصل: <a href="mailto:info@itqaanit.com">info@itqaanit.com</a></span>
            <span class="mono">© ٢٠٢٦ ITQAAN</span>
        </footer>
    </div>
</body>
</html>
