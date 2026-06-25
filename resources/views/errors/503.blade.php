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
    <link href="https://fonts.googleapis.com/css2?family=IBM+Plex+Sans+Arabic:wght@300;400;500;600;700&display=swap" rel="stylesheet">
    <style>
        :root{ --ink:#1b2530; --muted:#6a7682; --line:rgba(27,37,48,.14); --brand:#226b9f; --paper:#f7f5f0; }
        *{ margin:0; padding:0; box-sizing:border-box; }
        html,body{ height:100%; }
        body{
            font-family:'IBM Plex Sans Arabic', system-ui, sans-serif;
            background:var(--paper); color:var(--ink);
            -webkit-font-smoothing:antialiased; text-rendering:optimizeLegibility;
        }
        .sheet{
            position:relative; min-height:100%;
            max-width:1080px; margin:0 auto; padding:40px clamp(24px,6vw,72px);
            display:flex; flex-direction:column; min-height:100vh; overflow:hidden;
        }
        .mark-bg{
            position:absolute; inset-block-end:-8%; inset-inline-start:-6%;
            width:min(46vw,460px); color:var(--brand); opacity:.05; z-index:0; pointer-events:none;
        }
        .row{ position:relative; z-index:1; display:flex; align-items:center; justify-content:space-between; gap:20px; }
        .row.head{ padding-bottom:22px; border-bottom:1px solid var(--line); }
        .row.foot{ padding-top:22px; border-top:1px solid var(--line); margin-top:auto;
            font-size:13.5px; color:var(--muted); letter-spacing:.2px; flex-wrap:wrap; }
        .brand{ display:inline-flex; align-items:center; gap:11px; }
        .brand svg{ height:30px; width:auto; color:var(--brand); }
        .brand b{ font-weight:700; font-size:21px; letter-spacing:-.3px; color:var(--ink); }
        .stamp{ font-size:12.5px; font-weight:500; letter-spacing:3px; color:var(--muted); }
        main{ position:relative; z-index:1; flex:1; display:flex; flex-direction:column; justify-content:center; padding:64px 0; max-width:36ch; }
        .kicker{ font-size:14px; font-weight:600; color:var(--brand); letter-spacing:.5px; margin-bottom:22px; }
        .kicker::before{ content:""; display:inline-block; width:34px; height:2px; background:var(--brand);
            vertical-align:middle; margin-inline-end:12px; margin-bottom:5px; }
        h1{ font-weight:700; font-size:clamp(30px,5.4vw,52px); line-height:1.32; letter-spacing:-.5px; margin-bottom:24px; }
        h1 .soft{ font-weight:300; color:var(--muted); display:block; font-size:.62em; letter-spacing:0; margin-bottom:6px; }
        .lead{ font-size:clamp(16px,2.2vw,18.5px); font-weight:400; line-height:2; color:#46535f; max-width:42ch; }
        .foot a{ color:var(--ink); text-decoration:none; border-bottom:1px solid var(--line); padding-bottom:1px; }
        .foot a:hover{ border-color:var(--brand); color:var(--brand); }
        .foot .sep{ color:var(--line); }
        @media (max-width:560px){
            .stamp{ display:none; }
            .row.foot{ flex-direction:column; align-items:flex-start; gap:8px; }
            main{ padding:48px 0; }
        }
    </style>
</head>
<body>
    <div class="sheet">
        <svg class="mark-bg" viewBox="0 0 64 64" xmlns="http://www.w3.org/2000/svg" aria-hidden="true">
            <path fill="currentColor" d="M30 2C14.5 2 2 14.5 2 30s12.5 28 28 28c5.2 0 10-1.4 14.2-3.9l8 8a5 5 0 0 0 7.1-7.1l-7.6-7.6A27.9 27.9 0 0 0 58 30C58 14.5 45.5 2 30 2Zm0 16a12 12 0 1 1 0 24 12 12 0 0 1 0-24Z"/>
        </svg>

        <header class="row head">
            <span class="brand">
                <svg viewBox="0 0 64 64" xmlns="http://www.w3.org/2000/svg" aria-hidden="true">
                    <path fill="currentColor" d="M30 2C14.5 2 2 14.5 2 30s12.5 28 28 28c5.2 0 10-1.4 14.2-3.9l8 8a5 5 0 0 0 7.1-7.1l-7.6-7.6A27.9 27.9 0 0 0 58 30C58 14.5 45.5 2 30 2Zm0 16a12 12 0 1 1 0 24 12 12 0 0 1 0-24Z"/>
                </svg>
                <b>ITQAAN</b>
            </span>
            <span class="stamp">صيانة</span>
        </header>

        <main>
            <p class="kicker">إتقان لتقنية المعلومات</p>
            <h1>
                <span class="soft">نعمل على شيءٍ يستحقّ الانتظار</span>
                الموقع تحت الصيانة مؤقتاً
            </h1>
            <p class="lead">
                نُجري بعض التحديثات خلف الكواليس لنعود بتجربةٍ أنقى وأسرع.
                نُقدّر صبركم، وسنكون بين أيديكم قريباً.
            </p>
        </main>

        <footer class="row foot">
            <span>للتواصل: <a href="mailto:info@itqaanit.com">info@itqaanit.com</a></span>
            <span>© ٢٠٢٦ إتقان لتقنية المعلومات</span>
        </footer>
    </div>
</body>
</html>
