<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?= $pageTitle ?? 'Wellbroker API' ?> — Developer Documentation</title>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;450;500;600;700;800&family=JetBrains+Mono:wght@400;450;500;600&display=swap" rel="stylesheet">
    <style>
        *,*::before,*::after{box-sizing:border-box;margin:0;padding:0}
        :root{
            --bg-body:#f4f5f9;
            --bg-primary:#ffffff;
            --bg-secondary:#f8f9fc;
            --bg-card:#ffffff;
            --bg-code:#f0f1f6;
            --bg-hover:#eef0f5;
            --bg-elevated:#ffffff;
            --border:#e2e5ed;
            --border-light:#d0d4e0;
            --text-primary:#1a1c2e;
            --text-secondary:#5a5e7a;
            --text-muted:#9094b0;
            --accent:#6366f1;
            --accent-hover:#4f46e5;
            --accent-glow:rgba(99,102,241,0.15);
            --accent-bg:rgba(99,102,241,0.06);
            --green:#10b981;
            --green-bg:rgba(16,185,129,0.08);
            --green-border:rgba(16,185,129,0.2);
            --red:#ef4444;
            --red-bg:rgba(239,68,68,0.08);
            --red-border:rgba(239,68,68,0.2);
            --yellow:#f59e0b;
            --yellow-bg:rgba(245,158,11,0.08);
            --orange:#f97316;
            --orange-bg:rgba(249,115,22,0.06);
            --blue:#3b82f6;
            --blue-bg:rgba(59,130,246,0.06);
            --cyan:#06b6d4;
            --cyan-bg:rgba(6,182,212,0.06);
            --sidebar-w:280px;
            --header-h:64px;
            --radius:8px;
            --radius-lg:12px;
            --radius-xl:16px;
            --shadow:0 1px 2px rgba(0,0,0,0.04),0 1px 4px rgba(0,0,0,0.04);
            --shadow-md:0 4px 6px rgba(0,0,0,0.04),0 2px 4px rgba(0,0,0,0.03);
            --shadow-lg:0 10px 25px rgba(0,0,0,0.05),0 4px 10px rgba(0,0,0,0.03)
        }
        html{scroll-behavior:smooth;scroll-padding-top:calc(var(--header-h) + 24px)}
        body{
            font-family:'Inter',-apple-system,BlinkMacSystemFont,sans-serif;
            background:var(--bg-body);color:var(--text-primary);
            line-height:1.7;min-height:100vh;-webkit-font-smoothing:antialiased
        }
        ::selection{background:var(--accent);color:#fff}

        .header{
            position:fixed;top:0;left:0;right:0;height:var(--header-h);
            background:rgba(255,255,255,0.92);backdrop-filter:blur(16px);
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
        .logo{display:flex;align-items:center;gap:12px;text-decoration:none}
        .logo-icon{flex-shrink:0}
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
            width:var(--sidebar-w);background:var(--bg-primary);
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
            transition:all .12s;border-left:2px solid transparent
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
        .overlay{display:none;position:fixed;inset:0;background:rgba(0,0,0,0.3);z-index:49;backdrop-filter:blur(4px)}
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
            margin-bottom:24px;line-height:1.8;max-width:720px
        }
        .section-badge{
            display:inline-flex;align-items:center;gap:6px;
            font-size:11px;font-weight:600;padding:4px 12px;
            border-radius:100px;margin-bottom:12px
        }
        .badge-accent{background:var(--accent-bg);color:var(--accent);border:1px solid rgba(99,102,241,0.2)}
        .badge-green{background:var(--green-bg);color:var(--green);border:1px solid var(--green-border)}
        .badge-blue{background:var(--blue-bg);color:var(--blue);border:1px solid rgba(59,130,246,0.2)}

        .card{
            background:var(--bg-card);border:1px solid var(--border);
            border-radius:var(--radius-xl);padding:24px 28px;
            margin-bottom:20px;transition:border-color .15s,box-shadow .15s
        }
        .card:hover{border-color:var(--border-light);box-shadow:var(--shadow-md)}
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
        .callout-info{background:var(--blue-bg);border:1px solid rgba(59,130,246,0.2)}
        .callout-info .callout-icon{color:var(--blue)}
        .callout-warning{background:var(--orange-bg);border:1px solid rgba(249,115,22,0.2)}
        .callout-warning .callout-icon{color:var(--orange)}
        .callout-success{background:var(--green-bg);border:1px solid var(--green-border)}
        .callout-success .callout-icon{color:var(--green)}
        .callout-tip{background:var(--accent-bg);border:1px solid rgba(99,102,241,0.2)}
        .callout-tip .callout-icon{color:var(--accent)}
        .callout-text{color:var(--text-secondary);flex:1}
        .callout-text strong{color:var(--text-primary)}

        .endpoint{
            background:var(--bg-card);border:1px solid var(--border);
            border-radius:var(--radius-xl);overflow:hidden;
            margin-bottom:28px;transition:border-color .15s,box-shadow .15s
        }
        .endpoint:hover{border-color:var(--border-light);box-shadow:var(--shadow-md)}
        .endpoint-header{
            display:flex;align-items:center;gap:14px;
            padding:16px 24px;border-bottom:1px solid var(--border);
            background:var(--bg-secondary)
        }
        .method{
            font-size:11.5px;font-weight:700;padding:4px 10px;
            border-radius:5px;text-transform:uppercase;
            letter-spacing:.06em;font-family:'JetBrains Mono',monospace;flex-shrink:0
        }
        .method-post{background:var(--yellow-bg);color:#b45309}
        .method-get{background:var(--green-bg);color:var(--green)}
        .method-put{background:var(--blue-bg);color:var(--blue)}
        .method-delete{background:var(--red-bg);color:var(--red)}
        .endpoint-path{
            font-family:'JetBrains Mono',monospace;font-size:13.5px;
            color:var(--text-primary);font-weight:500
        }
        .endpoint-desc{font-size:12.5px;color:var(--text-muted);margin-left:auto;white-space:nowrap}
        .endpoint-body{padding:24px 28px}
        .endpoint-subtitle{
            font-size:12px;font-weight:600;color:var(--text-secondary);
            text-transform:uppercase;letter-spacing:.07em;
            margin-bottom:12px;display:flex;align-items:center;gap:8px
        }
        .endpoint-subtitle:after{content:'';flex:1;height:1px;background:var(--border)}

        .code-block{
            background:var(--bg-code);border:1px solid var(--border);
            border-radius:var(--radius-lg);padding:18px 22px;
            font-family:'JetBrains Mono',monospace;font-size:12.5px;
            line-height:1.8;overflow-x:auto;color:var(--text-primary);
            margin-bottom:16px;position:relative
        }
        .code-block .c{color:var(--text-muted)}
        .code-block .k{color:#7c3aed}
        .code-block .s{color:#059669}
        .code-block .n{color:#dc2626}
        .code-block .f{color:#2563eb}
        .code-block .v{color:#d97706}
        .code-block .o{color:#dc2626}

        .copy-btn{
            position:absolute;top:10px;right:10px;padding:4px 10px;
            font-size:10.5px;font-weight:500;background:var(--bg-primary);
            border:1px solid var(--border);color:var(--text-secondary);
            border-radius:5px;cursor:pointer;transition:all .12s;
            font-family:'Inter',sans-serif;opacity:0
        }
        .code-block:hover .copy-btn{opacity:1}
        .copy-btn:hover{background:var(--bg-hover);color:var(--text-primary);border-color:var(--border-light)}
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
        .s5xx{background:var(--orange-bg);color:var(--orange);border:1px solid rgba(249,115,22,0.2)}

        .step-card{
            background:var(--bg-card);border:1px solid var(--border);
            border-radius:var(--radius-xl);padding:24px 28px;
            margin-bottom:16px;transition:border-color .15s,box-shadow .15s;
            display:flex;gap:18px
        }
        .step-card:hover{border-color:var(--border-light);box-shadow:var(--shadow-md)}
        .step-num{
            width:36px;height:36px;border-radius:50%;
            background:var(--accent-bg);border:1px solid rgba(99,102,241,0.25);
            display:flex;align-items:center;justify-content:center;
            font-size:14px;font-weight:700;color:var(--accent);flex-shrink:0
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

        .page-header{
            display:flex;align-items:center;justify-content:space-between;
            margin-bottom:32px;padding-bottom:24px;border-bottom:1px solid var(--border)
        }
        .page-header h1{
            font-size:28px;font-weight:800;letter-spacing:-.04em
        }
        .page-header .page-meta{
            font-size:13px;color:var(--text-muted);
            display:flex;align-items:center;gap:12px
        }
    </style>
</head>
<body>

<header class="header">
    <div class="header-inner">
        <div class="header-left">
            <button class="sidebar-toggle" id="sidebarToggle" aria-label="Toggle sidebar">
                <svg width="22" height="22" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round">
                    <line x1="3" y1="6" x2="21" y2="6"/>
                    <line x1="3" y1="12" x2="21" y2="12"/>
                    <line x1="3" y1="18" x2="21" y2="18"/>
                </svg>
            </button>
            <a href="/docs/index.php" class="logo">
                <div class="logo-icon">
                    <svg width="34" height="34" viewBox="0 0 34 34" fill="none">
                        <defs>
                            <linearGradient id="logoGrad" x1="0" y1="0" x2="34" y2="34">
                                <stop offset="0%" stop-color="#6366f1"/>
                                <stop offset="100%" stop-color="#8b5cf6"/>
                            </linearGradient>
                        </defs>
                        <rect width="34" height="34" rx="9" fill="url(#logoGrad)"/>
                        <path d="M11 23V12l6 6 6-6v11" stroke="#fff" stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round"/>
                    </svg>
                </div>
                <div class="logo-text">
                    <span class="logo-title">Wellbroker API</span>
                    <span class="logo-subtitle">Developer Documentation</span>
                </div>
            </a>
        </div>
        <div class="header-right">
            <div class="header-stats">
                <div class="stat-item">
                    <span class="stat-value">v1.0.0</span>
                    <span class="stat-label">Version</span>
                </div>
                <div class="stat-divider"></div>
                <div class="stat-item">
                    <span class="stat-value">REST</span>
                    <span class="stat-label">Protocol</span>
                </div>
                <div class="stat-divider"></div>
                <div class="stat-item">
                    <span class="stat-value">JWT</span>
                    <span class="stat-label">Auth</span>
                </div>
                <div class="stat-divider"></div>
                <div class="stat-item">
                    <span class="stat-value">3</span>
                    <span class="stat-label">Endpoints</span>
                </div>
            </div>
            <a href="https://github.com/wellbroker/api" target="_blank" class="header-link" rel="noopener" title="GitHub Repository">
                <svg width="20" height="20" viewBox="0 0 24 24" fill="currentColor">
                    <path d="M12 0C5.37 0 0 5.37 0 12c0 5.31 3.435 9.795 8.205 11.385.6.105.825-.255.825-.57 0-.285-.015-1.23-.015-2.235-3.015.555-3.795-.735-4.035-1.41-.135-.345-.72-1.41-1.23-1.695-.42-.225-1.02-.78-.015-.795.945-.015 1.62.87 1.845 1.23 1.08 1.815 2.805 1.305 3.495.99.105-.78.42-1.305.765-1.605-2.67-.3-5.46-1.335-5.46-5.925 0-1.305.465-2.385 1.23-3.225-.12-.3-.54-1.53.12-3.18 0 0 1.005-.315 3.3 1.23.96-.27 1.98-.405 3-.405s2.04.135 3 .405c2.295-1.56 3.3-1.23 3.3-1.23.66 1.65.24 2.88.12 3.18.765.84 1.23 1.905 1.23 3.225 0 4.605-2.805 5.625-5.475 5.925.435.375.81 1.095.81 2.22 0 1.605-.015 2.895-.015 3.3 0 .315.225.69.825.57A12.02 12.02 0 0024 12c0-6.63-5.37-12-12-12z"/>
                </svg>
            </a>
        </div>
    </div>
</header>
