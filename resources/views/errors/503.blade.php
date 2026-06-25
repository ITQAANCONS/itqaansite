<!DOCTYPE html>
<html lang="ar" dir="rtl">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="robots" content="noindex">
    <title>الموقع تحت الصيانة — إتقان لتقنية المعلومات</title>
    <link rel="icon" type="image/svg+xml" href="/images/favicon.svg">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Tajawal:wght@400;500;700;800&display=swap" rel="stylesheet">
    <style>
        :root { --brand-600:#226b9f; --brand-400:#27abe3; }
        * { margin:0; padding:0; box-sizing:border-box; }
        body {
            min-height:100vh; display:flex; align-items:center; justify-content:center;
            font-family:'Tajawal', system-ui, sans-serif; color:#1c405c;
            background:#f5fbfe; position:relative; overflow:hidden; padding:24px;
        }
        .blob { position:absolute; border-radius:50%; filter:blur(80px); opacity:.32; z-index:0; }
        .blob-1 { width:420px; height:420px; background:#74c8ef; top:-120px; inset-inline-end:-80px; }
        .blob-2 { width:360px; height:360px; background:#addff6; bottom:-120px; inset-inline-start:-80px; }
        .dots {
            position:absolute; inset:0; z-index:0; opacity:.05;
            background-image:radial-gradient(#226b9f 1.5px, transparent 1.5px); background-size:30px 30px;
        }
        .card {
            position:relative; z-index:1; width:100%; max-width:560px; text-align:center;
            background:rgba(255,255,255,.78); backdrop-filter:blur(12px);
            border:1px solid rgba(39,171,227,.18); border-radius:28px;
            padding:56px 40px; box-shadow:0 30px 60px -20px rgba(34,107,159,.25);
            animation:enter .8s cubic-bezier(.2,.7,.2,1) both;
        }
        .logo { display:inline-flex; align-items:center; gap:12px; margin-bottom:8px; }
        .logo svg { height:56px; width:auto; animation:float 5s ease-in-out infinite; }
        .logo .word { display:flex; flex-direction:column; line-height:1; align-items:flex-start; }
        .logo .word b { font-size:34px; font-weight:800; letter-spacing:-1px;
            background:linear-gradient(to left,var(--brand-600),var(--brand-400));
            -webkit-background-clip:text; background-clip:text; color:transparent; }
        .logo .word span { font-size:11px; font-weight:600; letter-spacing:3px; color:var(--brand-400); text-transform:uppercase; margin-top:3px; }
        .badge {
            display:inline-flex; align-items:center; gap:9px; margin:30px 0 20px;
            background:#eef8fd; color:var(--brand-600); font-weight:700; font-size:13px;
            padding:9px 20px; border-radius:999px;
        }
        .badge .pulse { width:8px; height:8px; border-radius:50%; background:var(--brand-400); position:relative; }
        .badge .pulse::after { content:''; position:absolute; inset:0; border-radius:50%; background:var(--brand-400); animation:ping 2s cubic-bezier(0,0,.2,1) infinite; }
        h1 { font-size:30px; font-weight:800; color:#1c405c; margin-bottom:14px; line-height:1.45; }
        p { font-size:17px; line-height:1.95; color:#5b7185; max-width:430px; margin:0 auto; }
        .footer { margin-top:34px; padding-top:24px; border-top:1px solid rgba(34,107,159,.1); font-size:14px; color:#7a8ca0; }
        .footer a { color:var(--brand-600); font-weight:700; text-decoration:none; }
        .footer a:hover { text-decoration:underline; }
        @keyframes float { 0%,100%{transform:translateY(0)} 50%{transform:translateY(-9px)} }
        @keyframes ping { 75%,100%{transform:scale(2.4); opacity:0} }
        @keyframes enter { from{opacity:0; transform:translateY(20px)} to{opacity:1; transform:none} }
        @media (max-width:480px){ .card{padding:42px 24px} h1{font-size:24px} p{font-size:15px} .logo svg{height:46px} .logo .word b{font-size:28px} }
        @media (prefers-reduced-motion:reduce){ .card,.logo svg,.badge .pulse::after{animation:none} }
    </style>
</head>
<body>
    <div class="blob blob-1"></div>
    <div class="blob blob-2"></div>
    <div class="dots"></div>

    <main class="card">
        <div class="logo">
            <svg viewBox="0 0 64 64" xmlns="http://www.w3.org/2000/svg" aria-hidden="true">
                <defs>
                    <linearGradient id="qg" x1="0" y1="0" x2="1" y2="1">
                        <stop offset="0" stop-color="#226b9f"/>
                        <stop offset="1" stop-color="#27abe3"/>
                    </linearGradient>
                </defs>
                <path fill="url(#qg)" d="M30 2C14.5 2 2 14.5 2 30s12.5 28 28 28c5.2 0 10-1.4 14.2-3.9l8 8a5 5 0 0 0 7.1-7.1l-7.6-7.6A27.9 27.9 0 0 0 58 30C58 14.5 45.5 2 30 2Zm0 16a12 12 0 1 1 0 24 12 12 0 0 1 0-24Z"/>
            </svg>
            <span class="word"><b>ITQAAN</b><span>Information Technology</span></span>
        </div>

        <div class="badge"><span class="pulse"></span> جارٍ التطوير</div>

        <h1>الموقع مغلق مؤقتاً للصيانة</h1>
        <p>نُجري حالياً بعض التحديثات والتحسينات لنقدّم لكم تجربةً أفضل. سنعود قريباً بإذن الله — شكراً لتفهّمكم.</p>

        <div class="footer">
            لأي استفسار عاجل: <a href="mailto:info@itqaanit.com">info@itqaanit.com</a>
        </div>
    </main>
</body>
</html>
