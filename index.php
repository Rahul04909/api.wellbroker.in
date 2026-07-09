<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Wellbroker API — Developer Documentation</title>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;450;500;600;700;800&family=JetBrains+Mono:wght@400;450;500;600&display=swap" rel="stylesheet">
    <style>
        *,*::before,*::after{box-sizing:border-box;margin:0;padding:0}
        :root{
            --bg-deep:#090b14;
            --bg-primary:#0e1019;
            --bg-secondary:#151726;
            --bg-card:#1a1d2e;
            --bg-code:#0d0f1a;
            --bg-hover:#222640;
            --bg-elevated:#1e2140;
            --border:#262a45;
            --border-light:#313660;
            --text-primary:#e8eaf0;
            --text-secondary:#9498b8;
            --text-muted:#656a8f;
            --accent:#6366f1;
            --accent-hover:#818cf8;
            --accent-glow:rgba(99,102,241,.25);
            --accent-bg:rgba(99,102,241,.08);
            --green:#22c55e;
            --green-bg:rgba(34,197,94,.1);
            --green-border:rgba(34,197,94,.25);
            --red:#ef4444;
            --red-bg:rgba(239,68,68,.1);
            --red-border:rgba(239,68,68,.25);
            --yellow:#eab308;
            --yellow-bg:rgba(234,179,8,.1);
            --orange:#f97316;
            --orange-bg:rgba(249,115,22,.08);
            --blue:#3b82f6;
            --blue-bg:rgba(59,130,246,.08);
            --cyan:#06b6d4;
            --cyan-bg:rgba(6,182,212,.08);
            --sidebar-w:280px;
            --header-h:66px;
            --radius:8px;
            --radius-lg:12px;
            --radius-xl:16px;
            --shadow:0 1px 3px rgba(0,0,0,.4),0 1px 2px rgba(0,0,0,.3)
        }
        html{scroll-behavior:smooth;scroll-padding-top:calc(var(--header-h) + 24px)}
        body{
            font-family:'Inter',-apple-system,BlinkMacSystemFont,sans-serif;
            background:var(--bg-deep);
            color:var(--text-primary);
            line-height:1.7;
            min-height:100vh;
            -webkit-font-smoothing:antialiased
        }
        ::selection{background:var(--accent);color:#fff}

        .header{
            position:fixed;top:0;left:0;right:0;height:var(--header-h);
            background:rgba(14,16,25,.92);backdrop-filter:blur(16px);
            border-bottom:1px solid var(--border);z-index:100
        }
        .header-inner{
            display:flex;align-items:center;justify-content:space-between;
            height:100%;padding:0 28px;max-width:1440px;margin:0 auto
        }
        .header-left{display:flex;align-items:center;gap:16px}
        .sidebar-toggle{
            display:none;background:none;border:none;color:var(--text-secondary);
            cursor:pointer;padding:6px;border-radius:var(--radius);
            transition:all .15s
        }
        .sidebar-toggle:hover{background:var(--bg-hover);color:var(--text-primary)}
        .logo{display:flex;align-items:center;gap:12px}
        .logo-icon{flex-shrink:0;filter:drop-shadow(0 0 12px var(--accent-glow))}
        .logo-text{display:flex;flex-direction:column}
        .logo-title{font-size:17px;font-weight:700;color:var(--text-primary);letter-spacing:-.03em;line-height:1.2}
        .logo-subtitle{font-size:10.5px;color:var(--text-muted);text-transform:uppercase;letter-spacing:.1em;font-weight:500}
        .header-right{display:flex;align-items:center;gap:20px}
        .header-stats{display:flex;align-items:center;gap:14px}
        .stat-item{display:flex;flex-direction:column;align-items:center;gap:0}
        .stat-value{font-size:12px;font-weight:600;color:var(--text-primary);line-height:1.2}
        .stat-label{font-size:9.5px;text-transform:uppercase;letter-spacing:.08em;color:var(--text-muted)}
        .stat-divider{width:1px;height:28px;background:var(--border)}
        .header-link{color:var(--text-muted);transition:color .2s;display:flex;padding:6px}
        .header-link:hover{color:var(--text-primary)}

        .layout{display:flex;min-height:100vh;padding-top:var(--header-h)}
        .sidebar{
            position:fixed;top:var(--header-h);left:0;bottom:0;
            width:var(--sidebar-w);background:var(--bg-secondary);
            border-right:1px solid var(--border);overflow-y:auto;
            z-index:50;transition:transform .3s cubic-bezier(.4,0,.2,1);
            display:flex;flex-direction:column
        }
        .sidebar::-webkit-scrollbar{width:4px}
        .sidebar::-webkit-scrollbar-track{background:transparent}
        .sidebar::-webkit-scrollbar-thumb{background:var(--border);border-radius:4px}
        .sidebar-nav{padding:20px 12px;flex:1}
        .sidebar-section{margin-bottom:22px}
        .sidebar-heading{
            font-size:10.5px;font-weight:600;text-transform:uppercase;
            letter-spacing:.08em;color:var(--text-muted);padding:0 12px;
            margin-bottom:6px
        }
        .sidebar-links{list-style:none}
        .sidebar-link{
            display:flex;align-items:center;gap:8px;padding:7px 12px;
            color:var(--text-secondary);text-decoration:none;
            font-size:13.5px;border-radius:var(--radius);
            transition:all .12s;border-left:2px solid transparent;
            position:relative
        }
        .sidebar-link:hover{color:var(--text-primary);background:var(--bg-hover)}
        .sidebar-link.active{
            color:var(--accent);background:var(--accent-bg);
            border-left-color:var(--accent);font-weight:500
        }
        .sidebar-footer{
            padding:14px 16px;border-top:1px solid var(--border);
            background:var(--bg-card)
        }
        .sidebar-footer-text{
            display:flex;align-items:center;gap:8px;
            font-size:12px;color:var(--text-muted)
        }
        .sidebar-footer-text svg{color:var(--green)}

        .main-content{
            flex:1;margin-left:var(--sidebar-w);
            padding:48px 56px 80px;max-width:960px
        }

        @media(max-width:900px){
            .sidebar-toggle{display:block}
            .sidebar{transform:translateX(-100%)}
            .sidebar.open{transform:translateX(0)}
            .main-content{margin-left:0;padding:28px 22px 60px}
            .header-stats{display:none}
        }
        .overlay{display:none;position:fixed;inset:0;background:rgba(0,0,0,.6);z-index:49;backdrop-filter:blur(4px)}
        .overlay.show{display:block}

        .section{margin-bottom:56px;scroll-margin-top:calc(var(--header-h) + 24px)}
        .section:last-child{margin-bottom:0}
        .section-title{
            font-size:30px;font-weight:800;color:var(--text-primary);
            letter-spacing:-.04em;margin-bottom:6px;line-height:1.3
        }
        .section-subtitle{
            font-size:22px;font-weight:700;color:var(--text-primary);
            letter-spacing:-.03em;margin-bottom:6px;line-height:1.3
        }
        .section-desc{
            font-size:14.5px;color:var(--text-secondary);
            margin-bottom:24px;line-height:1.8;
            max-width:720px
        }
        .section-badge{
            display:inline-flex;align-items:center;gap:6px;
            font-size:11px;font-weight:600;padding:4px 12px;
            border-radius:100px;margin-bottom:12px
        }
        .badge-accent{background:var(--accent-bg);color:var(--accent);border:1px solid rgba(99,102,241,.2)}
        .badge-green{background:var(--green-bg);color:var(--green);border:1px solid var(--green-border)}

        .card{
            background:var(--bg-card);border:1px solid var(--border);
            border-radius:var(--radius-xl);padding:24px 28px;
            margin-bottom:20px;transition:border-color .2s
        }
        .card:hover{border-color:var(--border-light)}
        .card-title{
            font-size:15px;font-weight:600;margin-bottom:10px;
            display:flex;align-items:center;gap:8px;color:var(--text-primary)
        }
        .card-text{font-size:13.5px;color:var(--text-secondary);line-height:1.75}

        .callout{
            display:flex;gap:14px;padding:16px 20px;border-radius:var(--radius-lg);
            margin-bottom:20px;font-size:14px;line-height:1.7
        }
        .callout-icon{font-size:18px;flex-shrink:0;margin-top:1px}
        .callout-info{
            background:var(--blue-bg);border:1px solid rgba(59,130,246,.2)
        }
        .callout-info .callout-icon{color:var(--blue)}
        .callout-warning{
            background:var(--orange-bg);border:1px solid rgba(249,115,22,.2)
        }
        .callout-warning .callout-icon{color:var(--orange)}
        .callout-success{
            background:var(--green-bg);border:1px solid var(--green-border)
        }
        .callout-success .callout-icon{color:var(--green)}
        .callout-tip{
            background:var(--accent-bg);border:1px solid rgba(99,102,241,.2)
        }
        .callout-tip .callout-icon{color:var(--accent)}
        .callout-text{color:var(--text-secondary);flex:1}
        .callout-text strong{color:var(--text-primary)}

        .endpoint{
            background:var(--bg-card);border:1px solid var(--border);
            border-radius:var(--radius-xl);overflow:hidden;
            margin-bottom:28px;transition:border-color .2s
        }
        .endpoint:hover{border-color:var(--border-light)}
        .endpoint-header{
            display:flex;align-items:center;gap:14px;
            padding:16px 24px;border-bottom:1px solid var(--border);
            background:var(--bg-secondary)
        }
        .method{
            font-size:11.5px;font-weight:700;padding:4px 10px;
            border-radius:5px;text-transform:uppercase;
            letter-spacing:.06em;font-family:'JetBrains Mono',monospace;
            flex-shrink:0
        }
        .method-post{background:var(--yellow-bg);color:var(--yellow)}
        .method-get{background:var(--green-bg);color:var(--green)}
        .method-put{background:var(--blue-bg);color:var(--blue)}
        .method-delete{background:var(--red-bg);color:var(--red)}
        .endpoint-path{
            font-family:'JetBrains Mono',monospace;font-size:13.5px;
            color:var(--text-primary);font-weight:500
        }
        .endpoint-desc{
            font-size:12.5px;color:var(--text-muted);
            margin-left:auto;white-space:nowrap
        }

        .endpoint-body{padding:24px 28px}
        .endpoint-subtitle{
            font-size:12px;font-weight:600;color:var(--text-secondary);
            text-transform:uppercase;letter-spacing:.07em;
            margin-bottom:12px;display:flex;align-items:center;gap:8px
        }
        .endpoint-subtitle:after{
            content:'';flex:1;height:1px;background:var(--border)
        }

        .code-block{
            background:var(--bg-code);border:1px solid var(--border);
            border-radius:var(--radius-lg);padding:18px 22px;
            font-family:'JetBrains Mono',monospace;font-size:12.5px;
            line-height:1.8;overflow-x:auto;color:var(--text-primary);
            margin-bottom:16px;position:relative
        }
        .code-block .c{color:var(--text-muted)}
        .code-block .k{color:#818cf8}
        .code-block .s{color:#34d399}
        .code-block .n{color:#f472b6}
        .code-block .f{color:#60a5fa}
        .code-block .v{color:#fbbf24}
        .code-block .o{color:#f472b6}

        .copy-btn{
            position:absolute;top:10px;right:10px;padding:4px 10px;
            font-size:10.5px;font-weight:500;background:var(--bg-hover);
            border:1px solid var(--border);color:var(--text-secondary);
            border-radius:5px;cursor:pointer;transition:all .12s;
            font-family:'Inter',sans-serif;opacity:0
        }
        .code-block:hover .copy-btn{opacity:1}
        .copy-btn:hover{background:var(--border-light);color:var(--text-primary)}
        .copy-btn.copied{background:var(--green-bg);border-color:var(--green);color:var(--green);opacity:1}

        .param-table{width:100%;border-collapse:collapse;margin-bottom:16px}
        .param-table th{
            text-align:left;font-size:11px;font-weight:600;
            text-transform:uppercase;letter-spacing:.07em;
            color:var(--text-muted);padding:8px 14px;
            border-bottom:1px solid var(--border)
        }
        .param-table td{
            padding:10px 14px;font-size:13.5px;
            border-bottom:1px solid var(--border);vertical-align:top
        }
        .param-table tr:last-child td{border-bottom:none}
        .param-name{font-family:'JetBrains Mono',monospace;font-size:13px;color:var(--text-primary);font-weight:500;white-space:nowrap}
        .param-type{font-size:11.5px;color:var(--accent);font-weight:500;white-space:nowrap}
        .param-req{
            font-size:10px;padding:2px 8px;border-radius:100px;
            font-weight:600;display:inline-block;margin-right:6px
        }
        .param-req.required{background:var(--red-bg);color:var(--red)}
        .param-req.optional{background:var(--bg-hover);color:var(--text-muted)}
        .param-desc{font-size:13px;color:var(--text-secondary)}

        .status-code{
            display:inline-flex;align-items:center;gap:5px;font-size:12px;
            font-weight:600;padding:3px 10px;border-radius:5px;
            font-family:'JetBrains Mono',monospace
        }
        .s2xx{background:var(--green-bg);color:var(--green);border:1px solid var(--green-border)}
        .s4xx{background:var(--red-bg);color:var(--red);border:1px solid var(--red-border)}
        .s5xx{background:var(--orange-bg);color:var(--orange);border:1px solid rgba(249,115,22,.2)}

        .step-card{
            background:var(--bg-card);border:1px solid var(--border);
            border-radius:var(--radius-xl);padding:24px 28px;
            margin-bottom:16px;transition:border-color .2s;
            display:flex;gap:18px
        }
        .step-card:hover{border-color:var(--border-light)}
        .step-num{
            width:36px;height:36px;border-radius:50%;
            background:var(--accent-bg);border:1px solid rgba(99,102,241,.25);
            display:flex;align-items:center;justify-content:center;
            font-size:14px;font-weight:700;color:var(--accent);
            flex-shrink:0
        }
        .step-body{flex:1;min-width:0}
        .step-title{font-size:15px;font-weight:600;color:var(--text-primary);margin-bottom:6px}
        .step-text{font-size:13.5px;color:var(--text-secondary);line-height:1.7}
        .step-text strong{color:var(--text-primary)}
        .step-text .inline-code{
            font-family:'JetBrains Mono',monospace;font-size:12px;
            background:var(--bg-code);padding:1px 6px;border-radius:4px;
            color:var(--accent);border:1px solid var(--border)
        }

        .inline-code{
            font-family:'JetBrains Mono',monospace;font-size:12.5px;
            background:var(--bg-code);padding:2px 7px;border-radius:5px;
            color:var(--accent-hover);border:1px solid var(--border)
        }

        .divider{height:1px;background:var(--border);margin:40px 0}

        .grid-2{display:grid;grid-template-columns:1fr 1fr;gap:16px}
        .grid-3{display:grid;grid-template-columns:1fr 1fr 1fr;gap:14px}
        @media(max-width:700px){.grid-2,.grid-3{grid-template-columns:1fr}}

        .img-placeholder{
            background:var(--bg-code);border:1px solid var(--border);
            border-radius:var(--radius-lg);padding:20px 24px;
            text-align:center;color:var(--text-muted);font-size:13px;
            margin-bottom:16px;overflow:hidden
        }
        .img-placeholder .screen{
            text-align:left;font-family:'JetBrains Mono',monospace;
            font-size:12px;line-height:1.6;color:var(--text-secondary)
        }
        .img-placeholder .screen .hl{color:var(--accent)}
        .img-placeholder .screen .gr{color:var(--green)}
        .img-placeholder .screen .yw{color:var(--yellow)}
        .img-placeholder .screen .rd{color:var(--red)}
        .img-placeholder .screen .dim{color:var(--text-muted)}

        .tag-group{display:flex;flex-wrap:wrap;gap:6px;margin-bottom:12px}
        .tag{
            display:inline-flex;align-items:center;gap:4px;
            font-size:11px;padding:3px 10px;border-radius:100px;
            font-weight:500;background:var(--bg-hover);
            color:var(--text-secondary);border:1px solid var(--border)
        }

        .table-wrap{overflow-x:auto}

        ul,ol{padding-left:20px;color:var(--text-secondary);font-size:14px;line-height:1.9}
        li{margin-bottom:2px}
        strong{color:var(--text-primary)}
        a{color:var(--accent);text-decoration:none}
        a:hover{color:var(--accent-hover)}
    </style>
</head>
<body>

<?php include __DIR__.'/components/header.php'; ?>

<div class="overlay" id="overlay"></div>

<div class="layout">
    <?php include __DIR__.'/components/sidebar.php'; ?>

    <main class="main-content">

        <!-- INTRODUCTION -->
        <section class="section" id="introduction">
            <span class="section-badge badge-accent">Getting Started</span>
            <h1 class="section-title">Wellbroker API</h1>
            <p class="section-desc">
                A secure RESTful API for managing the Wellbroker real estate platform. Every endpoint returns
                consistent JSON responses and follows standard HTTP semantics. This documentation covers
                authentication, available endpoints, request/response formats, and a complete testing guide.
            </p>
            <div class="grid-2">
                <div class="card">
                    <div class="card-title">
                        <svg width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="var(--accent)" stroke-width="2" stroke-linecap="round"><path d="M12 2L2 7l10 5 10-5-10-5z"/><path d="M2 17l10 5 10-5"/><path d="M2 12l10 5 10-5"/></svg>
                        Protocol
                    </div>
                    <div class="card-text">RESTful API over HTTPS. All requests must use <strong>HTTPS</strong> in production.</div>
                </div>
                <div class="card">
                    <div class="card-title">
                        <svg width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="var(--accent)" stroke-width="2" stroke-linecap="round"><rect x="3" y="11" width="18" height="11" rx="2" ry="2"/><path d="M7 11V7a5 5 0 0110 0v4"/></svg>
                        Authentication
                    </div>
                    <div class="card-text">JWT Bearer tokens. Include <strong>Authorization: Bearer &lt;token&gt;</strong> in headers.</div>
                </div>
                <div class="card">
                    <div class="card-title">
                        <svg width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="var(--accent)" stroke-width="2" stroke-linecap="round"><path d="M14 2H6a2 2 0 00-2 2v16a2 2 0 002 2h12a2 2 0 002-2V8z"/><polyline points="14 2 14 8 20 8"/><line x1="16" y1="13" x2="8" y2="13"/><line x1="16" y1="17" x2="8" y2="17"/></svg>
                        Format
                    </div>
                    <div class="card-text">JSON request/response. Set <strong>Content-Type: application/json</strong>.</div>
                </div>
                <div class="card">
                    <div class="card-title">
                        <svg width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="var(--accent)" stroke-width="2" stroke-linecap="round"><circle cx="12" cy="12" r="10"/><polyline points="12 6 12 12 16 14"/></svg>
                        Timestamps
                    </div>
                    <div class="card-text">All dates in <strong>ISO 8601</strong> format (UTC). Example: <span class="inline-code">2026-07-09 12:00:00</span></div>
                </div>
            </div>
        </section>

        <!-- BASE URL -->
        <section class="section" id="base-url">
            <span class="section-badge badge-accent">Endpoint</span>
            <h2 class="section-subtitle">Base URL</h2>
            <p class="section-desc">All API requests are relative to this base URL. Substitute the domain for your environment.</p>
            <div class="code-block">https://api.wellbroker.in</div>
        </section>

        <!-- SETUP & CONFIGURATION -->
        <section class="section" id="setup">
            <span class="section-badge badge-accent">Configuration</span>
            <h2 class="section-subtitle">Setup &amp; Configuration</h2>
            <p class="section-desc">
                Copy <span class="inline-code">.env.example</span> to <span class="inline-code">.env</span> and adjust the values.
                The API reads environment variables at runtime &mdash; no code changes needed.
            </p>

            <div class="card">
                <div class="card-title">
                    <svg width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="var(--accent)" stroke-width="2" stroke-linecap="round"><ellipse cx="12" cy="5" rx="9" ry="3"/><path d="M21 12c0 1.66-4 3-9 3s-9-1.34-9-3"/><path d="M3 5v14c0 1.66 4 3 9 3s9-1.34 9-3V5"/></svg>
                    Database
                </div>
                <div class="table-wrap">
                    <table class="param-table">
                        <thead><tr><th>Variable</th><th>Default</th><th>Description</th></tr></thead>
                        <tbody>
                            <tr><td><span class="param-name">DB_HOST</span></td><td><span class="param-type">localhost</span></td><td><span class="param-desc">Database server hostname</span></td></tr>
                            <tr><td><span class="param-name">DB_PORT</span></td><td><span class="param-type">3306</span></td><td><span class="param-desc">Database server port</span></td></tr>
                            <tr><td><span class="param-name">DB_DATABASE</span></td><td><span class="param-type">wellbroker</span></td><td><span class="param-desc">Database name</span></td></tr>
                            <tr><td><span class="param-name">DB_USERNAME</span></td><td><span class="param-type">root</span></td><td><span class="param-desc">Database username</span></td></tr>
                            <tr><td><span class="param-name">DB_PASSWORD</span></td><td><span class="param-type">(empty)</span></td><td><span class="param-desc">Database password</span></td></tr>
                        </tbody>
                    </table>
                </div>
            </div>

            <div class="card">
                <div class="card-title">
                    <svg width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="var(--accent)" stroke-width="2" stroke-linecap="round"><path d="M12 22s8-4 8-10V5l-8-3-8 3v7c0 6 8 10 8 10z"/></svg>
                    JWT
                </div>
                <div class="table-wrap">
                    <table class="param-table">
                        <thead><tr><th>Variable</th><th>Default</th><th>Description</th></tr></thead>
                        <tbody>
                            <tr><td><span class="param-name">JWT_SECRET</span></td><td><span class="param-type">(required)</span></td><td><span class="param-desc">Secret key &ge; 32 chars for signing tokens</span></td></tr>
                            <tr><td><span class="param-name">JWT_ISSUER</span></td><td><span class="param-type">wellbroker-api</span></td><td><span class="param-desc">Token issuer claim (<span class="inline-code">iss</span>)</span></td></tr>
                            <tr><td><span class="param-name">JWT_EXPIRY</span></td><td><span class="param-type">3600</span></td><td><span class="param-desc">Access token lifetime (seconds, 1 hour)</span></td></tr>
                            <tr><td><span class="param-name">JWT_REFRESH_EXPIRY</span></td><td><span class="param-type">604800</span></td><td><span class="param-desc">Refresh token lifetime (seconds, 7 days)</span></td></tr>
                            <tr><td><span class="param-name">JWT_ALGORITHM</span></td><td><span class="param-type">HS256</span></td><td><span class="param-desc">Signing algorithm</span></td></tr>
                        </tbody>
                    </table>
                </div>
            </div>
        </section>

        <!-- AUTHENTICATION -->
        <section class="section" id="authentication">
            <span class="section-badge badge-accent">Security</span>
            <h2 class="section-subtitle">Authentication</h2>
            <p class="section-desc">
                The API uses <strong>JSON Web Tokens (JWT)</strong>. After a successful login, include the token
                in every subsequent request via the <span class="inline-code">Authorization</span> header.
            </p>

            <div class="callout callout-info">
                <span class="callout-icon">&#9432;</span>
                <div class="callout-text">
                    <strong>Header format:</strong> <span class="inline-code">Authorization: Bearer &lt;jwt_token&gt;</span>
                </div>
            </div>

            <div class="code-block">
                <button class="copy-btn" onclick="copyCode(this)">Copy</button>
                Authorization: Bearer eyJ0eXAiOiJKV1QiLCJhbGciOiJIUzI1NiJ9...
            </div>

            <div class="card">
                <div class="card-title">JWT Claims</div>
                <div class="table-wrap">
                    <table class="param-table">
                        <thead><tr><th>Claim</th><th>Description</th></tr></thead>
                        <tbody>
                            <tr><td><span class="param-name">iss</span></td><td><span class="param-desc">Issuer &mdash; identifies the API that issued the token</span></td></tr>
                            <tr><td><span class="param-name">aud</span></td><td><span class="param-desc">Audience &mdash; intended recipient of the token</span></td></tr>
                            <tr><td><span class="param-name">iat</span></td><td><span class="param-desc">Issued-at timestamp</span></td></tr>
                            <tr><td><span class="param-name">nbf</span></td><td><span class="param-desc">Not-before timestamp &mdash; token invalid before this time</span></td></tr>
                            <tr><td><span class="param-name">exp</span></td><td><span class="param-desc">Expiration timestamp</span></td></tr>
                            <tr><td><span class="param-name">jti</span></td><td><span class="param-desc">Unique token ID &mdash; prevents replay attacks</span></td></tr>
                            <tr><td><span class="param-name">sub</span></td><td><span class="param-desc">Subject &mdash; the admin user ID</span></td></tr>
                        </tbody>
                    </table>
                </div>
            </div>
        </section>

        <!-- ERROR HANDLING -->
        <section class="section" id="errors">
            <span class="section-badge badge-accent">Reference</span>
            <h2 class="section-subtitle">Error Handling</h2>
            <p class="section-desc">All errors return a consistent JSON envelope. HTTP status codes indicate the nature of the error.</p>

            <div class="card">
                <div class="card-title">Response Envelope</div>
                <div class="code-block" style="margin-top:8px">
{<br>
&nbsp;&nbsp;<span class="s">"status"</span>: <span class="k">true</span>,<br>
&nbsp;&nbsp;<span class="s">"message"</span>: <span class="s">"human-readable message"</span>,<br>
&nbsp;&nbsp;<span class="s">"data"</span>: {}<br>
}
                </div>
            </div>

            <div class="grid-3">
                <div class="card"><div class="card-title"><span class="status-code s2xx">200</span></div><div class="card-text">Request succeeded</div></div>
                <div class="card"><div class="card-title"><span class="status-code s4xx">400</span></div><div class="card-text">Validation error</div></div>
                <div class="card"><div class="card-title"><span class="status-code s4xx">401</span></div><div class="card-text">Invalid credentials</div></div>
                <div class="card"><div class="card-title"><span class="status-code s4xx">403</span></div><div class="card-text">Account deactivated</div></div>
                <div class="card"><div class="card-title"><span class="status-code s4xx">405</span></div><div class="card-text">Method not allowed</div></div>
                <div class="card"><div class="card-title"><span class="status-code s5xx">500</span></div><div class="card-text">Internal server error</div></div>
            </div>
        </section>

        <div class="divider"></div>

        <!-- ====== ADMIN LOGIN ====== -->
        <section class="section" id="admin-login">
            <span class="section-badge badge-green">AUTHENTICATION</span>
            <h2 class="section-subtitle">Admin Login</h2>
            <p class="section-desc">
                Authenticate as an administrator using your <strong>email</strong> or <strong>username</strong>.
                On success you receive a JWT access token, a refresh token, and the admin profile.
            </p>

            <div class="endpoint">
                <div class="endpoint-header">
                    <span class="method method-post">POST</span>
                    <span class="endpoint-path">/admin/index.php</span>
                    <span class="endpoint-desc">Authenticate admin user</span>
                </div>
                <div class="endpoint-body">

                    <div class="endpoint-subtitle">Request Body</div>
                    <div class="table-wrap">
                        <table class="param-table">
                            <thead><tr><th>Parameter</th><th>Type</th><th>Description</th></tr></thead>
                            <tbody>
                                <tr>
                                    <td><span class="param-name">email</span></td>
                                    <td><span class="param-type">string</span></td>
                                    <td>
                                        <span class="param-req required">Required</span>
                                        <span class="param-desc">Admin email <strong>or</strong> username. The API auto-detects which.</span>
                                    </td>
                                </tr>
                                <tr>
                                    <td><span class="param-name">password</span></td>
                                    <td><span class="param-type">string</span></td>
                                    <td>
                                        <span class="param-req required">Required</span>
                                        <span class="param-desc">Admin account password</span>
                                    </td>
                                </tr>
                            </tbody>
                        </table>
                    </div>

                    <div class="callout callout-tip">
                        <span class="callout-icon">&#9889;</span>
                        <div class="callout-text">
                            <strong>Login via email or username.</strong> Send either value in the <span class="inline-code">email</span> field.
                            If the value is a valid email, the API looks up by email; otherwise by username.
                        </div>
                    </div>

                    <div class="endpoint-subtitle" style="margin-top:24px">Admin Profile Fields</div>
                    <div class="table-wrap">
                        <table class="param-table">
                            <thead><tr><th>Field</th><th>Type</th><th>Description</th></tr></thead>
                            <tbody>
                                <tr><td><span class="param-name">id</span></td><td><span class="param-type">integer</span></td><td><span class="param-desc">Unique identifier</span></td></tr>
                                <tr><td><span class="param-name">name</span></td><td><span class="param-type">string</span></td><td><span class="param-desc">Full name</span></td></tr>
                                <tr><td><span class="param-name">email</span></td><td><span class="param-type">string</span></td><td><span class="param-desc">Email address (unique)</span></td></tr>
                                <tr><td><span class="param-name">username</span></td><td><span class="param-type">string</span></td><td><span class="param-desc">Login username (unique)</span></td></tr>
                                <tr><td><span class="param-name">mobile</span></td><td><span class="param-type">string</span></td><td><span class="param-desc">Mobile number</span></td></tr>
                                <tr><td><span class="param-name">profile_picture</span></td><td><span class="param-type">string|null</span></td><td><span class="param-desc">Profile picture URL</span></td></tr>
                                <tr><td><span class="param-name">created_at</span></td><td><span class="param-type">string</span></td><td><span class="param-desc">Account creation timestamp</span></td></tr>
                            </tbody>
                        </table>
                    </div>

                    <div class="endpoint-subtitle" style="margin-top:24px">Example Requests</div>

                    <div class="code-block">
                        <button class="copy-btn" onclick="copyCode(this)">Copy</button>
                        <span class="c"># Login by email</span><br>
                        curl -X POST https://api.wellbroker.in/admin/index.php \<br>
                        &nbsp;&nbsp;-H <span class="s">"Content-Type: application/json"</span> \<br>
                        &nbsp;&nbsp;-d <span class="s">'{"email": "admin@wellbroker.in", "password": "your_password"}'</span>
                    </div>

                    <div class="code-block">
                        <button class="copy-btn" onclick="copyCode(this)">Copy</button>
                        <span class="c"># Login by username</span><br>
                        curl -X POST https://api.wellbroker.in/admin/index.php \<br>
                        &nbsp;&nbsp;-H <span class="s">"Content-Type: application/json"</span> \<br>
                        &nbsp;&nbsp;-d <span class="s">'{"email": "superadmin", "password": "your_password"}'</span>
                    </div>

                    <div class="endpoint-subtitle" style="margin-top:24px">Success Response &mdash; <span class="status-code s2xx">200 OK</span></div>
                    <div class="code-block">
                        <button class="copy-btn" onclick="copyCode(this)">Copy</button>
{<br>
&nbsp;&nbsp;<span class="s">"status"</span>: <span class="k">true</span>,<br>
&nbsp;&nbsp;<span class="s">"message"</span>: <span class="s">"Login successful"</span>,<br>
&nbsp;&nbsp;<span class="s">"data"</span>: {<br>
&nbsp;&nbsp;&nbsp;&nbsp;<span class="s">"token"</span>: <span class="s">"eyJ0eXAiOiJKV1QiLCJhbGciOiJIUzI1NiJ9..."</span>,<br>
&nbsp;&nbsp;&nbsp;&nbsp;<span class="s">"token_type"</span>: <span class="s">"Bearer"</span>,<br>
&nbsp;&nbsp;&nbsp;&nbsp;<span class="s">"expires_in"</span>: <span class="n">3600</span>,<br>
&nbsp;&nbsp;&nbsp;&nbsp;<span class="s">"refresh_token"</span>: <span class="s">"a1b2c3d4e5f6..."</span>,<br>
&nbsp;&nbsp;&nbsp;&nbsp;<span class="s">"user"</span>: {<br>
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<span class="s">"id"</span>: <span class="n">1</span>,<br>
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<span class="s">"name"</span>: <span class="s">"Super Admin"</span>,<br>
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<span class="s">"email"</span>: <span class="s">"admin@wellbroker.in"</span>,<br>
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<span class="s">"username"</span>: <span class="s">"superadmin"</span>,<br>
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<span class="s">"mobile"</span>: <span class="s">"9876543210"</span>,<br>
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<span class="s">"profile_picture"</span>: <span class="s">"https://api.wellbroker.in/uploads/admins/default.png"</span>,<br>
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<span class="s">"created_at"</span>: <span class="s">"2026-07-09 12:00:00"</span><br>
&nbsp;&nbsp;&nbsp;&nbsp;}<br>
&nbsp;&nbsp;}<br>
}
                    </div>

                    <div class="endpoint-subtitle" style="margin-top:24px">Error Responses</div>

                    <div class="grid-2">
                        <div class="code-block" style="margin:0">
                            <span class="c">// 400 &mdash; Validation</span><br>
                            {<br>
                            &nbsp;&nbsp;<span class="s">"status"</span>: <span class="k">false</span>,<br>
                            &nbsp;&nbsp;<span class="s">"message"</span>: <span class="s">"Email/Username and password are required"</span>,<br>
                            &nbsp;&nbsp;<span class="s">"data"</span>: {}<br>
                            }
                        </div>
                        <div class="code-block" style="margin:0">
                            <span class="c">// 401 &mdash; Bad credentials</span><br>
                            {<br>
                            &nbsp;&nbsp;<span class="s">"status"</span>: <span class="k">false</span>,<br>
                            &nbsp;&nbsp;<span class="s">"message"</span>: <span class="s">"Invalid credentials"</span>,<br>
                            &nbsp;&nbsp;<span class="s">"data"</span>: {}<br>
                            }
                        </div>
                        <div class="code-block" style="margin:0">
                            <span class="c">// 403 &mdash; Deactivated</span><br>
                            {<br>
                            &nbsp;&nbsp;<span class="s">"status"</span>: <span class="k">false</span>,<br>
                            &nbsp;&nbsp;<span class="s">"message"</span>: <span class="s">"Account is deactivated. Contact administrator."</span>,<br>
                            &nbsp;&nbsp;<span class="s">"data"</span>: {}<br>
                            }
                        </div>
                        <div class="code-block" style="margin:0">
                            <span class="c">// 500 &mdash; Server error</span><br>
                            {<br>
                            &nbsp;&nbsp;<span class="s">"status"</span>: <span class="k">false</span>,<br>
                            &nbsp;&nbsp;<span class="s">"message"</span>: <span class="s">"Internal server error"</span>,<br>
                            &nbsp;&nbsp;<span class="s">"data"</span>: {}<br>
                            }
                        </div>
                    </div>
                </div>
            </div>
        </section>

        <div class="divider"></div>

        <!-- ====== POSTMAN TESTING GUIDE ====== -->
        <section class="section" id="postman-setup">
            <span class="section-badge badge-accent">TESTING</span>
            <h2 class="section-subtitle">Postman Testing Guide</h2>
            <p class="section-desc">
                Follow this step-by-step guide to test every API endpoint using Postman.
                Each endpoint includes setup instructions, header configuration, request body,
                and expected responses so you can verify everything works end-to-end.
            </p>

            <div class="callout callout-warning">
                <span class="callout-icon">&#9888;</span>
                <div class="callout-text">
                    <strong>Prerequisites:</strong> Make sure the API server is running and the database is seeded with the
                    admin user from <span class="inline-code">sql/admins.sql</span>. The default password hash is for
                    <strong>"password"</strong> (you should change this in production).
                </div>
            </div>

            <div class="card">
                <div class="card-title">
                    <svg width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="var(--accent)" stroke-width="2" stroke-linecap="round"><circle cx="12" cy="12" r="10"/><polyline points="12 6 12 12 16 14"/></svg>
                    Postman Collection Setup
                </div>
                <div class="card-text">
                    <ol>
                        <li>Open <strong>Postman</strong> and create a new Collection named <span class="inline-code">Wellbroker API</span>.</li>
                        <li>Select the collection, go to the <strong>Variables</strong> tab, and add these variables:
                            <ul>
                                <li><span class="inline-code">base_url</span> &mdash; Initial value: <span class="inline-code">https://api.wellbroker.in</span></li>
                                <li><span class="inline-code">auth_token</span> &mdash; leave empty (populated after login)</li>
                            </ul>
                        </li>
                        <li>Go to the <strong>Authorization</strong> tab, set <strong>Type</strong> to <span class="inline-code">Bearer Token</span>, and set the token value to <span class="inline-code">{{auth_token}}</span>.</li>
                        <li>Go to the <strong>Pre-request Script</strong> tab and add the script below to automatically set the <span class="inline-code">Content-Type</span> header.</li>
                    </ol>
                </div>
                <div class="code-block" style="margin-top:12px">
                    <button class="copy-btn" onclick="copyCode(this)">Copy</button>
                    <span class="c">// Postman collection pre-request script</span><br>
                    pm.request.headers.add({<br>
                    &nbsp;&nbsp;key: <span class="s">"Content-Type"</span>,<br>
                    &nbsp;&nbsp;value: <span class="s">"application/json"</span><br>
                    });
                </div>
            </div>
        </section>

        <section class="section" id="postman-login">
            <span class="section-badge badge-green">STEP-BY-STEP</span>
            <h2 class="section-subtitle">Testing: Admin Login</h2>
            <p class="section-desc">
                Follow these 10 steps to test the Admin Login endpoint in Postman.
            </p>

            <div class="card">
                <div class="card-title">
                    <svg width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="var(--accent)" stroke-width="2" stroke-linecap="round"><path d="M4 19.5A2.5 2.5 0 016.5 17H20"/><path d="M6.5 2H20v20H6.5A2.5 2.5 0 014 19.5v-15A2.5 2.5 0 016.5 2z"/></svg>
                    Quick Reference
                </div>
                <div class="table-wrap">
                    <table class="param-table">
                        <thead><tr><th>Item</th><th>Value</th></tr></thead>
                        <tbody>
                            <tr><td><span class="param-name">Method</span></td><td><span class="param-type">POST</span></td></tr>
                            <tr><td><span class="param-name">URL</span></td><td><span class="param-type">{{base_url}}/admin/index.php</span></td></tr>
                            <tr><td><span class="param-name">Headers</span></td><td><span class="param-type">Content-Type: application/json</span></td></tr>
                            <tr><td><span class="param-name">Auth</span></td><td><span class="param-type">None (public endpoint)</span></td></tr>
                        </tbody>
                    </table>
                </div>
            </div>

            <div class="step-card">
                <div class="step-num">1</div>
                <div class="step-body">
                    <div class="step-title">Create a new request</div>
                    <div class="step-text">
                        In the <strong>Wellbroker API</strong> collection, click <strong>Add a request</strong>.
                        Name it <span class="inline-code">Admin Login</span>.
                    </div>
                </div>
            </div>

            <div class="step-card">
                <div class="step-num">2</div>
                <div class="step-body">
                    <div class="step-title">Set the HTTP method</div>
                    <div class="step-text">
                        Change the method dropdown from <strong>GET</strong> to <strong>POST</strong>.
                    </div>
                </div>
            </div>

            <div class="step-card">
                <div class="step-num">3</div>
                <div class="step-body">
                    <div class="step-title">Enter the request URL</div>
                    <div class="step-text">
                        In the URL field, enter: <span class="inline-code">{{base_url}}/admin/index.php</span>
                    </div>
                </div>
            </div>

            <div class="step-card">
                <div class="step-num">4</div>
                <div class="step-body">
                    <div class="step-title">Set the request headers</div>
                    <div class="step-text">
                        Go to the <strong>Headers</strong> tab and add:<br>
                        <strong>Key:</strong> <span class="inline-code">Content-Type</span><br>
                        <strong>Value:</strong> <span class="inline-code">application/json</span>
                    </div>
                    <div class="img-placeholder" style="margin-top:10px">
                        <div class="screen">
                            <span class="dim">Headers tab in Postman</span><br><br>
                            <span class="hl">Content-Type</span>: <span class="gr">application/json</span> &nbsp;<span class="dim">// key-value pair</span>
                        </div>
                    </div>
                </div>
            </div>

            <div class="step-card">
                <div class="step-num">5</div>
                <div class="step-body">
                    <div class="step-title">Prepare the request body</div>
                    <div class="step-text">
                        Go to the <strong>Body</strong> tab, select <strong>raw</strong>, and choose <strong>JSON</strong>
                        from the dropdown on the right. Paste the following:
                    </div>
                    <div class="code-block" style="margin-top:10px">
                        <button class="copy-btn" onclick="copyCode(this)">Copy</button>
                        {<br>
                        &nbsp;&nbsp;<span class="s">"email"</span>: <span class="s">"admin@wellbroker.in"</span>,<br>
                        &nbsp;&nbsp;<span class="s">"password"</span>: <span class="s">"password"</span><br>
                        }
                    </div>
                </div>
            </div>

            <div class="step-card">
                <div class="step-num">6</div>
                <div class="step-body">
                    <div class="step-title">(Optional) Test with username instead of email</div>
                    <div class="step-text">
                        Change the <span class="inline-code">email</span> value to a username:<br>
                        <span class="inline-code">"email": "superadmin"</span>
                    </div>
                </div>
            </div>

            <div class="step-card">
                <div class="step-num">7</div>
                <div class="step-body">
                    <div class="step-title">Send the request</div>
                    <div class="step-text">
                        Click the <strong>Send</strong> button. You should receive a <strong>200 OK</strong> response.
                    </div>
                </div>
            </div>

            <div class="step-card">
                <div class="step-num">8</div>
                <div class="step-body">
                    <div class="step-title">Verify the response</div>
                    <div class="step-text">
                        Check that the response body contains:
                        <ul style="margin-top:4px">
                            <li><span class="inline-code">status: true</span></li>
                            <li>A <span class="inline-code">token</span> field with a JWT string</li>
                            <li>A <span class="inline-code">refresh_token</span> field</li>
                            <li>A <span class="inline-code">user</span> object with all admin fields (<span class="inline-code">id</span>, <span class="inline-code">name</span>, <span class="inline-code">email</span>, <span class="inline-code">username</span>, <span class="inline-code">mobile</span>, <span class="inline-code">profile_picture</span>, <span class="inline-code">created_at</span>)</li>
                        </ul>
                    </div>
                    <div class="img-placeholder" style="margin-top:10px">
                        <div class="screen">
                            <span class="dim">Expected response (Body tab)</span><br><br>
                            {<br>
                            &nbsp;&nbsp;<span class="gr">"status"</span>: <span class="k">true</span>,<br>
                            &nbsp;&nbsp;<span class="gr">"message"</span>: <span class="s">"Login successful"</span>,<br>
                            &nbsp;&nbsp;<span class="gr">"data"</span>: {<br>
                            &nbsp;&nbsp;&nbsp;&nbsp;<span class="gr">"token"</span>: <span class="s">"eyJ..."</span>,<br>
                            &nbsp;&nbsp;&nbsp;&nbsp;<span class="gr">"refresh_token"</span>: <span class="s">"a1b2..."</span>,<br>
                            &nbsp;&nbsp;&nbsp;&nbsp;<span class="gr">"user"</span>: {<br>
                            &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<span class="gr">"id"</span>: 1,<br>
                            &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<span class="gr">"name"</span>: <span class="s">"Super Admin"</span>,<br>
                            &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<span class="gr">"email"</span>: <span class="s">"admin@wellbroker.in"</span>,<br>
                            &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<span class="gr">"username"</span>: <span class="s">"superadmin"</span>,<br>
                            &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<span class="gr">"mobile"</span>: <span class="s">"9876543210"</span>,<br>
                            &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<span class="gr">"profile_picture"</span>: <span class="s">"https://..."</span><br>
                            &nbsp;&nbsp;&nbsp;&nbsp;}<br>
                            &nbsp;&nbsp;}<br>
                            }
                        </div>
                    </div>
                </div>
            </div>

            <div class="step-card">
                <div class="step-num">9</div>
                <div class="step-body">
                    <div class="step-title">Automatically save the token</div>
                    <div class="step-text">
                        Go to the <strong>Tests</strong> tab and paste the script below.
                        It extracts the JWT token from the response and saves it to the
                        collection variable <span class="inline-code">auth_token</span>,
                        so subsequent requests are automatically authenticated.
                    </div>
                    <div class="code-block" style="margin-top:10px">
                        <button class="copy-btn" onclick="copyCode(this)">Copy</button>
                        <span class="c">// Postman test script &mdash; auto-save token</span><br>
                        <span class="k">if</span> (pm.response.code === 200) {<br>
                        &nbsp;&nbsp;<span class="k">var</span> jsonData = pm.response.json();<br>
                        &nbsp;&nbsp;<span class="k">if</span> (jsonData.status && jsonData.data.token) {<br>
                        &nbsp;&nbsp;&nbsp;&nbsp;pm.collectionVariables.set(<span class="s">"auth_token"</span>, jsonData.data.token);<br>
                        &nbsp;&nbsp;&nbsp;&nbsp;console.log(<span class="s">"Token saved successfully"</span>);<br>
                        &nbsp;&nbsp;}<br>
                        }
                    </div>
                </div>
            </div>

            <div class="step-card">
                <div class="step-num">10</div>
                <div class="step-body">
                    <div class="step-title">Test error scenarios</div>
                    <div class="step-text">
                        Try these variations to verify error handling:
                        <ul style="margin-top:4px">
                            <li><strong>Missing fields:</strong> Send <span class="inline-code">{}</span> &rarr; expect <span class="status-code s4xx">400</span></li>
                            <li><strong>Wrong password:</strong> Send <span class="inline-code">"password": "wrong"</span> &rarr; expect <span class="status-code s4xx">401</span></li>
                            <li><strong>Wrong email:</strong> Send <span class="inline-code">"email": "nonexistent@test.com"</span> &rarr; expect <span class="status-code s4xx">401</span></li>
                            <li><strong>Wrong method:</strong> Change to <strong>GET</strong> &rarr; expect <span class="status-code s4xx">405</span></li>
                        </ul>
                    </div>
                </div>
            </div>

            <div class="callout callout-success" style="margin-top:24px">
                <span class="callout-icon">&#10003;</span>
                <div class="callout-text">
                    <strong>All tests passed?</strong> You now have a fully functional Postman collection.
                    The <span class="inline-code">auth_token</span> variable will be automatically populated
                    for all subsequent requests in the collection.
                </div>
            </div>
        </section>

        <div class="divider"></div>

        <!-- ====== ENDPOINTS REFERENCE ====== -->
        <section class="section" id="endpoints">
            <span class="section-badge badge-accent">REFERENCE</span>
            <h2 class="section-subtitle">API Endpoints</h2>
            <p class="section-desc">Quick-reference summary of all available endpoints.</p>

            <div class="card">
                <div class="card-title">Authentication</div>
                <div class="table-wrap">
                    <table class="param-table">
                        <thead><tr><th>Method</th><th>Endpoint</th><th>Auth</th><th>Description</th></tr></thead>
                        <tbody>
                            <tr>
                                <td><span class="method method-post">POST</span></td>
                                <td><span class="param-name">/admin/index.php</span></td>
                                <td><span class="tag">None</span></td>
                                <td><span class="param-desc">Admin login &mdash; returns JWT token + admin profile</span></td>
                            </tr>
                        </tbody>
                    </table>
                </div>
            </div>
        </section>

    </main>
</div>

<script>
document.addEventListener('DOMContentLoaded',function(){
    var s=document.getElementById('sidebar'),o=document.getElementById('overlay'),t=document.getElementById('sidebarToggle'),l=document.querySelectorAll('.sidebar-link');
    if(t){t.addEventListener('click',function(){s.classList.toggle('open');o.classList.toggle('show')})}
    if(o){o.addEventListener('click',function(){s.classList.remove('open');o.classList.remove('show')})}
    var obs=new IntersectionObserver(function(e){
        e.forEach(function(e){
            if(e.isIntersecting){
                l.forEach(function(lnk){lnk.classList.remove('active');if(lnk.dataset.section===e.target.id){lnk.classList.add('active')}})
            }
        })
    },{rootMargin:'-80px 0px -60% 0px'});
    document.querySelectorAll('section[id]').forEach(function(sec){obs.observe(sec)});
    l.forEach(function(lnk){
        lnk.addEventListener('click',function(e){
            e.preventDefault();var target=document.getElementById(this.dataset.section);
            if(target){target.scrollIntoView({behavior:'smooth'})}
            if(window.innerWidth<=900){s.classList.remove('open');o.classList.remove('show')}
        })
    })
});
function copyCode(btn){
    var block=btn.parentElement,code=block.textContent.replace('Copy','').trim();
    if(navigator.clipboard){navigator.clipboard.writeText(code).then(function(){
        btn.textContent='Copied!';btn.classList.add('copied');
        setTimeout(function(){btn.textContent='Copy';btn.classList.remove('copied')},2000)
    })}
}
</script>
</body>
</html>
