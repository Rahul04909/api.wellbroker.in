<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Wellbroker API - Documentation</title>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700&family=JetBrains+Mono:wght@400;500&display=swap" rel="stylesheet">
    <style>
        *, *::before, *::after {
            box-sizing: border-box;
            margin: 0;
            padding: 0;
        }

        :root {
            --bg-primary: #0f1117;
            --bg-secondary: #161822;
            --bg-card: #1c1e2e;
            --bg-code: #13151f;
            --bg-hover: #252840;
            --border-color: #2a2d42;
            --border-light: #363a52;
            --text-primary: #e4e6f0;
            --text-secondary: #9298b0;
            --text-muted: #6b7194;
            --accent: #4f46e5;
            --accent-hover: #6366f1;
            --accent-light: rgba(79, 70, 229, 0.1);
            --green: #22c55e;
            --green-bg: rgba(34, 197, 94, 0.1);
            --red: #ef4444;
            --red-bg: rgba(239, 68, 68, 0.1);
            --yellow: #eab308;
            --yellow-bg: rgba(234, 179, 8, 0.1);
            --sidebar-width: 280px;
            --header-height: 64px;
            --radius: 8px;
            --radius-lg: 12px;
        }

        html {
            scroll-behavior: smooth;
            scroll-padding-top: calc(var(--header-height) + 20px);
        }

        body {
            font-family: 'Inter', -apple-system, BlinkMacSystemFont, sans-serif;
            background: var(--bg-primary);
            color: var(--text-primary);
            line-height: 1.6;
            min-height: 100vh;
        }

        .header {
            position: fixed;
            top: 0;
            left: 0;
            right: 0;
            height: var(--header-height);
            background: var(--bg-secondary);
            border-bottom: 1px solid var(--border-color);
            z-index: 100;
        }

        .header-inner {
            display: flex;
            align-items: center;
            justify-content: space-between;
            height: 100%;
            padding: 0 24px;
            max-width: 1440px;
            margin: 0 auto;
        }

        .header-left {
            display: flex;
            align-items: center;
            gap: 16px;
        }

        .sidebar-toggle {
            display: none;
            background: none;
            border: none;
            color: var(--text-secondary);
            cursor: pointer;
            padding: 6px;
            border-radius: var(--radius);
            transition: background 0.2s;
        }

        .sidebar-toggle:hover {
            background: var(--bg-hover);
            color: var(--text-primary);
        }

        .logo {
            display: flex;
            align-items: center;
            gap: 10px;
        }

        .logo-icon {
            flex-shrink: 0;
        }

        .logo-text {
            display: flex;
            flex-direction: column;
        }

        .logo-title {
            font-size: 16px;
            font-weight: 700;
            color: var(--text-primary);
            letter-spacing: -0.02em;
        }

        .logo-subtitle {
            font-size: 11px;
            color: var(--text-muted);
            text-transform: uppercase;
            letter-spacing: 0.08em;
        }

        .header-right {
            display: flex;
            align-items: center;
            gap: 16px;
        }

        .version-badge {
            font-size: 12px;
            font-weight: 600;
            padding: 4px 10px;
            background: var(--accent-light);
            color: var(--accent);
            border-radius: 100px;
            border: 1px solid rgba(79, 70, 229, 0.2);
        }

        .header-link {
            color: var(--text-secondary);
            transition: color 0.2s;
            display: flex;
            align-items: center;
        }

        .header-link:hover {
            color: var(--text-primary);
        }

        .layout {
            display: flex;
            min-height: 100vh;
            padding-top: var(--header-height);
        }

        .sidebar {
            position: fixed;
            top: var(--header-height);
            left: 0;
            bottom: 0;
            width: var(--sidebar-width);
            background: var(--bg-secondary);
            border-right: 1px solid var(--border-color);
            overflow-y: auto;
            z-index: 50;
            transition: transform 0.3s ease;
        }

        .sidebar::-webkit-scrollbar {
            width: 4px;
        }

        .sidebar::-webkit-scrollbar-track {
            background: transparent;
        }

        .sidebar::-webkit-scrollbar-thumb {
            background: var(--border-color);
            border-radius: 4px;
        }

        .sidebar-nav {
            padding: 20px 16px;
        }

        .sidebar-section {
            margin-bottom: 24px;
        }

        .sidebar-heading {
            font-size: 11px;
            font-weight: 600;
            text-transform: uppercase;
            letter-spacing: 0.08em;
            color: var(--text-muted);
            padding: 0 12px;
            margin-bottom: 8px;
        }

        .sidebar-links {
            list-style: none;
        }

        .sidebar-link {
            display: block;
            padding: 8px 12px;
            color: var(--text-secondary);
            text-decoration: none;
            font-size: 14px;
            border-radius: var(--radius);
            transition: all 0.15s;
            border-left: 2px solid transparent;
        }

        .sidebar-link:hover {
            color: var(--text-primary);
            background: var(--bg-hover);
        }

        .sidebar-link.active {
            color: var(--accent);
            background: var(--accent-light);
            border-left-color: var(--accent);
            font-weight: 500;
        }

        .main-content {
            flex: 1;
            margin-left: var(--sidebar-width);
            padding: 40px 48px;
            max-width: 960px;
        }

        @media (max-width: 768px) {
            .sidebar-toggle {
                display: block;
            }

            .sidebar {
                transform: translateX(-100%);
            }

            .sidebar.open {
                transform: translateX(0);
            }

            .main-content {
                margin-left: 0;
                padding: 24px 20px;
            }
        }

        .section {
            margin-bottom: 48px;
        }

        .section:last-child {
            margin-bottom: 0;
        }

        .section-title {
            font-size: 28px;
            font-weight: 700;
            color: var(--text-primary);
            letter-spacing: -0.03em;
            margin-bottom: 12px;
        }

        .section-desc {
            font-size: 15px;
            color: var(--text-secondary);
            margin-bottom: 24px;
            line-height: 1.7;
        }

        .card {
            background: var(--bg-card);
            border: 1px solid var(--border-color);
            border-radius: var(--radius-lg);
            padding: 24px;
            margin-bottom: 20px;
        }

        .card-title {
            font-size: 16px;
            font-weight: 600;
            margin-bottom: 8px;
            display: flex;
            align-items: center;
            gap: 8px;
        }

        .card-text {
            font-size: 14px;
            color: var(--text-secondary);
            line-height: 1.7;
        }

        .endpoint {
            background: var(--bg-card);
            border: 1px solid var(--border-color);
            border-radius: var(--radius-lg);
            overflow: hidden;
            margin-bottom: 24px;
        }

        .endpoint-header {
            display: flex;
            align-items: center;
            gap: 12px;
            padding: 16px 24px;
            border-bottom: 1px solid var(--border-color);
            background: var(--bg-secondary);
        }

        .method {
            font-size: 12px;
            font-weight: 700;
            padding: 4px 10px;
            border-radius: 4px;
            text-transform: uppercase;
            letter-spacing: 0.05em;
            font-family: 'JetBrains Mono', monospace;
        }

        .method-post {
            background: var(--yellow-bg);
            color: var(--yellow);
        }

        .method-get {
            background: var(--green-bg);
            color: var(--green);
        }

        .endpoint-path {
            font-family: 'JetBrains Mono', monospace;
            font-size: 14px;
            color: var(--text-primary);
            font-weight: 500;
        }

        .endpoint-desc {
            font-size: 13px;
            color: var(--text-muted);
            margin-left: auto;
        }

        .endpoint-body {
            padding: 24px;
        }

        .endpoint-subtitle {
            font-size: 13px;
            font-weight: 600;
            color: var(--text-secondary);
            text-transform: uppercase;
            letter-spacing: 0.06em;
            margin-bottom: 12px;
        }

        .code-block {
            background: var(--bg-code);
            border: 1px solid var(--border-color);
            border-radius: var(--radius);
            padding: 16px 20px;
            font-family: 'JetBrains Mono', monospace;
            font-size: 13px;
            line-height: 1.7;
            overflow-x: auto;
            color: var(--text-primary);
            margin-bottom: 16px;
            position: relative;
        }

        .code-block .comment {
            color: var(--text-muted);
        }

        .code-block .keyword {
            color: #818cf8;
        }

        .code-block .string {
            color: #34d399;
        }

        .code-block .number {
            color: #f472b6;
        }

        .code-block .function {
            color: #60a5fa;
        }

        .param-table {
            width: 100%;
            border-collapse: collapse;
            margin-bottom: 16px;
        }

        .param-table th {
            text-align: left;
            font-size: 12px;
            font-weight: 600;
            text-transform: uppercase;
            letter-spacing: 0.06em;
            color: var(--text-muted);
            padding: 8px 12px;
            border-bottom: 1px solid var(--border-color);
        }

        .param-table td {
            padding: 10px 12px;
            font-size: 14px;
            border-bottom: 1px solid var(--border-color);
            vertical-align: top;
        }

        .param-table tr:last-child td {
            border-bottom: none;
        }

        .param-name {
            font-family: 'JetBrains Mono', monospace;
            font-size: 13px;
            color: var(--text-primary);
            font-weight: 500;
        }

        .param-type {
            font-size: 12px;
            color: var(--accent);
            font-weight: 500;
        }

        .param-required {
            font-size: 11px;
            padding: 2px 8px;
            border-radius: 100px;
            background: var(--red-bg);
            color: var(--red);
            font-weight: 600;
        }

        .param-optional {
            font-size: 11px;
            padding: 2px 8px;
            border-radius: 100px;
            background: var(--bg-hover);
            color: var(--text-muted);
            font-weight: 600;
        }

        .param-desc {
            font-size: 13px;
            color: var(--text-secondary);
        }

        .status-code {
            display: inline-flex;
            align-items: center;
            gap: 6px;
            font-size: 13px;
            font-weight: 600;
            padding: 4px 10px;
            border-radius: 4px;
            font-family: 'JetBrains Mono', monospace;
        }

        .status-2xx {
            background: var(--green-bg);
            color: var(--green);
        }

        .status-4xx {
            background: var(--red-bg);
            color: var(--red);
        }

        .status-5xx {
            background: var(--yellow-bg);
            color: var(--yellow);
        }

        .copy-btn {
            position: absolute;
            top: 8px;
            right: 8px;
            padding: 4px 10px;
            font-size: 11px;
            font-weight: 500;
            background: var(--bg-hover);
            border: 1px solid var(--border-color);
            color: var(--text-secondary);
            border-radius: 4px;
            cursor: pointer;
            transition: all 0.15s;
            font-family: 'Inter', sans-serif;
        }

        .copy-btn:hover {
            background: var(--border-light);
            color: var(--text-primary);
        }

        .copy-btn.copied {
            background: var(--green-bg);
            border-color: var(--green);
            color: var(--green);
        }

        .tag {
            display: inline-flex;
            align-items: center;
            gap: 4px;
            font-size: 12px;
            padding: 4px 10px;
            border-radius: 100px;
            font-weight: 500;
            background: var(--bg-hover);
            color: var(--text-secondary);
            border: 1px solid var(--border-color);
        }

        .tag-key {
            color: var(--text-muted);
            font-size: 11px;
        }

        .response-section {
            margin-top: 16px;
        }

        .response-section-title {
            font-size: 13px;
            font-weight: 600;
            color: var(--text-secondary);
            margin-bottom: 8px;
        }

        .example-box {
            display: flex;
            flex-direction: column;
            gap: 16px;
        }

        .example-item {
            background: var(--bg-code);
            border: 1px solid var(--border-color);
            border-radius: var(--radius);
            overflow: hidden;
        }

        .example-label {
            font-size: 11px;
            font-weight: 600;
            text-transform: uppercase;
            letter-spacing: 0.06em;
            padding: 8px 16px;
            background: var(--bg-secondary);
            border-bottom: 1px solid var(--border-color);
            color: var(--text-muted);
        }

        .example-content {
            padding: 16px 20px;
            font-family: 'JetBrains Mono', monospace;
            font-size: 13px;
            line-height: 1.7;
            overflow-x: auto;
            color: var(--text-primary);
        }

        .note {
            display: flex;
            gap: 12px;
            background: var(--accent-light);
            border: 1px solid rgba(79, 70, 229, 0.2);
            border-radius: var(--radius);
            padding: 16px 20px;
            margin-bottom: 20px;
        }

        .note-icon {
            font-size: 18px;
            flex-shrink: 0;
            color: var(--accent);
        }

        .note-text {
            font-size: 14px;
            color: var(--text-secondary);
            line-height: 1.6;
        }

        .divider {
            height: 1px;
            background: var(--border-color);
            margin: 32px 0;
        }

        .inline-code {
            font-family: 'JetBrains Mono', monospace;
            font-size: 13px;
            background: var(--bg-code);
            padding: 2px 6px;
            border-radius: 4px;
            color: var(--accent);
            border: 1px solid var(--border-color);
        }

        .overlay {
            display: none;
            position: fixed;
            inset: 0;
            background: rgba(0, 0, 0, 0.5);
            z-index: 49;
        }

        .overlay.show {
            display: block;
        }

        @media (max-width: 768px) {
            .overlay.show {
                display: block;
            }
        }

        ul, ol {
            padding-left: 20px;
            color: var(--text-secondary);
            font-size: 14px;
            line-height: 1.8;
        }

        strong {
            color: var(--text-primary);
        }

        a {
            color: var(--accent);
            text-decoration: none;
        }

        a:hover {
            color: var(--accent-hover);
        }
    </style>
</head>
<body>

    <?php include __DIR__ . '/components/header.php'; ?>

    <div class="overlay" id="overlay"></div>

    <div class="layout">
        <?php include __DIR__ . '/components/sidebar.php'; ?>

        <main class="main-content">

            <section class="section" id="introduction">
                <h1 class="section-title">Introduction</h1>
                <p class="section-desc">
                    Welcome to the Wellbroker API documentation. This API provides a secure and robust interface
                    for managing your real estate platform. All endpoints return JSON responses and use standard
                    HTTP status codes for error handling.
                </p>
                <div class="card">
                    <div class="card-title">Base Requirements</div>
                    <div class="card-text">
                        <ul>
                            <li>API requests must include the <strong>Content-Type: application/json</strong> header</li>
                            <li>Authentication is performed via <strong>JWT Bearer tokens</strong></li>
                            <li>All timestamps are in <strong>ISO 8601</strong> format (UTC)</li>
                            <li>Responses are wrapped in a consistent JSON envelope</li>
                        </ul>
                    </div>
                </div>
            </section>

            <section class="section" id="base-url">
                <h2 class="section-title">Base URL</h2>
                <p class="section-desc">
                    All API endpoints are relative to the base URL below. Use the appropriate environment
                    URL when making requests.
                </p>
                <div class="code-block">
                    <button class="copy-btn" onclick="copyCode(this)">Copy</button>
                    <span class="function">https://</span>api.wellbroker.in
                </div>
            </section>

            <section class="section" id="authentication">
                <h2 class="section-title">Authentication</h2>
                <p class="section-desc">
                    The API uses <strong>JSON Web Tokens (JWT)</strong> for authentication. After a successful login,
                    you will receive a token that must be included in the <span class="inline-code">Authorization</span>
                    header of subsequent requests.
                </p>
                <div class="note">
                    <span class="note-icon">&#9432;</span>
                    <div class="note-text">
                        All authenticated endpoints require the header:
                        <strong>Authorization: Bearer &lt;your_token&gt;</strong>
                    </div>
                </div>
                <div class="code-block">
                    <button class="copy-btn" onclick="copyCode(this)">Copy</button>
                    Authorization: Bearer eyJ0eXAiOiJKV1QiLCJhbGciOiJIUzI1NiJ9...
                </div>

                <div class="card" style="margin-top: 20px;">
                    <div class="card-title">Token Claims</div>
                    <table class="param-table">
                        <thead>
                            <tr>
                                <th>Claim</th>
                                <th>Description</th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr>
                                <td><span class="param-name">iss</span></td>
                                <td><span class="param-desc">Issuer - identifies the API that issued the token</span></td>
                            </tr>
                            <tr>
                                <td><span class="param-name">aud</span></td>
                                <td><span class="param-desc">Audience - intended recipient of the token</span></td>
                            </tr>
                            <tr>
                                <td><span class="param-name">iat</span></td>
                                <td><span class="param-desc">Issued at - timestamp when token was created</span></td>
                            </tr>
                            <tr>
                                <td><span class="param-name">nbf</span></td>
                                <td><span class="param-desc">Not before - token is not valid before this time</span></td>
                            </tr>
                            <tr>
                                <td><span class="param-name">exp</span></td>
                                <td><span class="param-desc">Expiration - token expiry timestamp</span></td>
                            </tr>
                            <tr>
                                <td><span class="param-name">jti</span></td>
                                <td><span class="param-desc">JWT ID - unique identifier to prevent replay attacks</span></td>
                            </tr>
                            <tr>
                                <td><span class="param-name">sub</span></td>
                                <td><span class="param-desc">Subject - the admin user ID</span></td>
                            </tr>
                        </tbody>
                    </table>
                </div>
            </section>

            <section class="section" id="setup">
                <h2 class="section-title">Setup &amp; Configuration</h2>
                <p class="section-desc">
                    Configure your environment variables in the <span class="inline-code">.env</span> file
                    (copy from <span class="inline-code">.env.example</span>). Below are the available
                    configuration variables.
                </p>

                <div class="card">
                    <div class="card-title">Database Configuration</div>
                    <table class="param-table">
                        <thead>
                            <tr>
                                <th>Variable</th>
                                <th>Default</th>
                                <th>Description</th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr>
                                <td><span class="param-name">DB_HOST</span></td>
                                <td><span class="param-type">localhost</span></td>
                                <td><span class="param-desc">Database server hostname</span></td>
                            </tr>
                            <tr>
                                <td><span class="param-name">DB_PORT</span></td>
                                <td><span class="param-type">3306</span></td>
                                <td><span class="param-desc">Database server port</span></td>
                            </tr>
                            <tr>
                                <td><span class="param-name">DB_DATABASE</span></td>
                                <td><span class="param-type">wellbroker</span></td>
                                <td><span class="param-desc">Database name</span></td>
                            </tr>
                            <tr>
                                <td><span class="param-name">DB_USERNAME</span></td>
                                <td><span class="param-type">root</span></td>
                                <td><span class="param-desc">Database username</span></td>
                            </tr>
                            <tr>
                                <td><span class="param-name">DB_PASSWORD</span></td>
                                <td><span class="param-type">(empty)</span></td>
                                <td><span class="param-desc">Database password</span></td>
                            </tr>
                        </tbody>
                    </table>
                </div>

                <div class="card">
                    <div class="card-title">JWT Configuration</div>
                    <table class="param-table">
                        <thead>
                            <tr>
                                <th>Variable</th>
                                <th>Default</th>
                                <th>Description</th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr>
                                <td><span class="param-name">JWT_SECRET</span></td>
                                <td><span class="param-type">(required)</span></td>
                                <td><span class="param-desc">Secret key (min 32 chars) for signing tokens</span></td>
                            </tr>
                            <tr>
                                <td><span class="param-name">JWT_ISSUER</span></td>
                                <td><span class="param-type">wellbroker-api</span></td>
                                <td><span class="param-desc">Token issuer claim</span></td>
                            </tr>
                            <tr>
                                <td><span class="param-name">JWT_EXPIRY</span></td>
                                <td><span class="param-type">3600</span></td>
                                <td><span class="param-desc">Token expiry in seconds (1 hour)</span></td>
                            </tr>
                            <tr>
                                <td><span class="param-name">JWT_REFRESH_EXPIRY</span></td>
                                <td><span class="param-type">604800</span></td>
                                <td><span class="param-desc">Refresh token expiry in seconds (7 days)</span></td>
                            </tr>
                            <tr>
                                <td><span class="param-name">JWT_ALGORITHM</span></td>
                                <td><span class="param-type">HS256</span></td>
                                <td><span class="param-desc">Signing algorithm (HS256 recommended)</span></td>
                            </tr>
                        </tbody>
                    </table>
                </div>
            </section>

            <div class="divider"></div>

            <section class="section" id="errors">
                <h2 class="section-title">Error Handling</h2>
                <p class="section-desc">
                    The API uses conventional HTTP response codes to indicate success or failure.
                    All errors return a consistent JSON response structure.
                </p>
                <div class="card">
                    <div class="card-title">Response Envelope</div>
                    <div class="card-text">
                        Every response follows this structure:
                    </div>
                    <div class="code-block" style="margin-top: 12px;">
                        <button class="copy-btn" onclick="copyCode(this)">Copy</button>
{<br>
&nbsp;&nbsp;<span class="string">"status"</span>: <span class="keyword">true</span> <span class="comment">// boolean</span><br>
&nbsp;&nbsp;<span class="string">"message"</span>: <span class="string">"Success"</span> <span class="comment">// human-readable message</span><br>
&nbsp;&nbsp;<span class="string">"data"</span>: {} <span class="comment">// response payload</span><br>
}
                    </div>
                </div>
                <div style="display: flex; flex-wrap: wrap; gap: 12px; margin-top: 16px;">
                    <div class="card" style="flex: 1; min-width: 200px;">
                        <div class="card-title"><span class="status-code status-2xx">200 OK</span></div>
                        <div class="card-text">Request succeeded</div>
                    </div>
                    <div class="card" style="flex: 1; min-width: 200px;">
                        <div class="card-title"><span class="status-code status-4xx">400 Bad Request</span></div>
                        <div class="card-text">Invalid input or validation error</div>
                    </div>
                    <div class="card" style="flex: 1; min-width: 200px;">
                        <div class="card-title"><span class="status-code status-4xx">401 Unauthorized</span></div>
                        <div class="card-text">Invalid credentials</div>
                    </div>
                    <div class="card" style="flex: 1; min-width: 200px;">
                        <div class="card-title"><span class="status-code status-4xx">403 Forbidden</span></div>
                        <div class="card-text">Account deactivated or insufficient permissions</div>
                    </div>
                    <div class="card" style="flex: 1; min-width: 200px;">
                        <div class="card-title"><span class="status-code status-4xx">405 Method Not Allowed</span></div>
                        <div class="card-text">HTTP method not supported for this endpoint</div>
                    </div>
                    <div class="card" style="flex: 1; min-width: 200px;">
                        <div class="card-title"><span class="status-code status-5xx">500 Server Error</span></div>
                        <div class="card-text">Internal server error occurred</div>
                    </div>
                </div>
            </section>

            <div class="divider"></div>

            <section class="section" id="admin-login">
                <h2 class="section-title">Admin Login</h2>
                <p class="section-desc">
                    Authenticate an administrator account using <strong>email</strong> or <strong>username</strong>
                    and receive a JWT token for subsequent API requests.
                </p>

                <div class="note">
                    <span class="note-icon">&#9432;</span>
                    <div class="note-text">
                        You can log in using either your <strong>email address</strong> or <strong>username</strong>.
                        Send the value in the <span class="inline-code">email</span> field — the API auto-detects
                        which one you're using.
                    </div>
                </div>

                <div class="endpoint">
                    <div class="endpoint-header">
                        <span class="method method-post">POST</span>
                        <span class="endpoint-path">/admin/index.php</span>
                        <span class="endpoint-desc">Authenticate admin user</span>
                    </div>
                    <div class="endpoint-body">
                        <div class="endpoint-subtitle">Request Body</div>
                        <table class="param-table">
                            <thead>
                                <tr>
                                    <th>Parameter</th>
                                    <th>Type</th>
                                    <th>Description</th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr>
                                    <td><span class="param-name">email</span></td>
                                    <td><span class="param-type">string</span></td>
                                    <td>
                                        <span class="param-required">Required*</span>
                                        <span class="param-desc">Admin email <strong>or</strong> username</span>
                                    </td>
                                </tr>
                                <tr>
                                    <td><span class="param-name">password</span></td>
                                    <td><span class="param-type">string</span></td>
                                    <td>
                                        <span class="param-required">Required</span>
                                        <span class="param-desc">Admin account password</span>
                                    </td>
                                </tr>
                            </tbody>
                        </table>

                        <div class="endpoint-subtitle">Admin Fields</div>
                        <table class="param-table">
                            <thead>
                                <tr>
                                    <th>Field</th>
                                    <th>Type</th>
                                    <th>Description</th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr>
                                    <td><span class="param-name">id</span></td>
                                    <td><span class="param-type">integer</span></td>
                                    <td><span class="param-desc">Unique admin identifier</span></td>
                                </tr>
                                <tr>
                                    <td><span class="param-name">name</span></td>
                                    <td><span class="param-type">string</span></td>
                                    <td><span class="param-desc">Full name of the admin</span></td>
                                </tr>
                                <tr>
                                    <td><span class="param-name">email</span></td>
                                    <td><span class="param-type">string</span></td>
                                    <td><span class="param-desc">Admin email address (unique)</span></td>
                                </tr>
                                <tr>
                                    <td><span class="param-name">username</span></td>
                                    <td><span class="param-type">string</span></td>
                                    <td><span class="param-desc">Unique username for login</span></td>
                                </tr>
                                <tr>
                                    <td><span class="param-name">mobile</span></td>
                                    <td><span class="param-type">string</span></td>
                                    <td><span class="param-desc">Admin mobile number</span></td>
                                </tr>
                                <tr>
                                    <td><span class="param-name">profile_picture</span></td>
                                    <td><span class="param-type">string|null</span></td>
                                    <td><span class="param-desc">URL of the admin profile picture</span></td>
                                </tr>
                                <tr>
                                    <td><span class="param-name">created_at</span></td>
                                    <td><span class="param-type">string</span></td>
                                    <td><span class="param-desc">Account creation timestamp</span></td>
                                </tr>
                                <tr>
                                    <td><span class="param-name">status</span></td>
                                    <td><span class="param-type">integer</span></td>
                                    <td><span class="param-desc">1 = Active, 0 = Deactivated</span></td>
                                </tr>
                            </tbody>
                        </table>

                        <div class="endpoint-subtitle">Example Request</div>
                        <div class="example-box">
                            <div class="example-item">
                                <div class="example-label">cURL (by email)</div>
                                <div class="example-content">
                                    <button class="copy-btn" onclick="copyCode(this)">Copy</button>
curl -X POST https://api.wellbroker.in/admin/index.php \<br>
&nbsp;&nbsp;-H <span class="string">"Content-Type: application/json"</span> \<br>
&nbsp;&nbsp;-d <span class="string">'{<br>
&nbsp;&nbsp;&nbsp;&nbsp;"email": "admin@wellbroker.in",<br>
&nbsp;&nbsp;&nbsp;&nbsp;"password": "your_password"<br>
&nbsp;&nbsp;}'</span>
                                </div>
                            </div>
                            <div class="example-item">
                                <div class="example-label">cURL (by username)</div>
                                <div class="example-content">
                                    <button class="copy-btn" onclick="copyCode(this)">Copy</button>
curl -X POST https://api.wellbroker.in/admin/index.php \<br>
&nbsp;&nbsp;-H <span class="string">"Content-Type: application/json"</span> \<br>
&nbsp;&nbsp;-d <span class="string">'{<br>
&nbsp;&nbsp;&nbsp;&nbsp;"email": "superadmin",<br>
&nbsp;&nbsp;&nbsp;&nbsp;"password": "your_password"<br>
&nbsp;&nbsp;}'</span>
                                </div>
                            </div>
                            <div class="example-item">
                                <div class="example-label">JavaScript (Fetch)</div>
                                <div class="example-content">
                                    <button class="copy-btn" onclick="copyCode(this)">Copy</button>
<span class="keyword">await</span> <span class="function">fetch</span>(<span class="string">"https://api.wellbroker.in/admin/index.php"</span>, {<br>
&nbsp;&nbsp;<span class="keyword">method</span>: <span class="string">"POST"</span>,<br>
&nbsp;&nbsp;<span class="keyword">headers</span>: { <span class="string">"Content-Type"</span>: <span class="string">"application/json"</span> },<br>
&nbsp;&nbsp;<span class="keyword">body</span>: <span class="function">JSON.stringify</span>({<br>
&nbsp;&nbsp;&nbsp;&nbsp;email: <span class="string">"admin@wellbroker.in"</span>,<br>
&nbsp;&nbsp;&nbsp;&nbsp;password: <span class="string">"your_password"</span><br>
&nbsp;&nbsp;})<br>
});
                                </div>
                            </div>
                        </div>

                        <div class="response-section">
                            <div class="endpoint-subtitle">Success Response (200 OK)</div>
                            <div class="code-block">
                                <button class="copy-btn" onclick="copyCode(this)">Copy</button>
{<br>
&nbsp;&nbsp;<span class="string">"status"</span>: <span class="keyword">true</span>,<br>
&nbsp;&nbsp;<span class="string">"message"</span>: <span class="string">"Login successful"</span>,<br>
&nbsp;&nbsp;<span class="string">"data"</span>: {<br>
&nbsp;&nbsp;&nbsp;&nbsp;<span class="string">"token"</span>: <span class="string">"eyJ0eXAiOiJKV1QiLCJhbGciOiJIUzI1NiJ9..."</span>,<br>
&nbsp;&nbsp;&nbsp;&nbsp;<span class="string">"token_type"</span>: <span class="string">"Bearer"</span>,<br>
&nbsp;&nbsp;&nbsp;&nbsp;<span class="string">"expires_in"</span>: <span class="number">3600</span>,<br>
&nbsp;&nbsp;&nbsp;&nbsp;<span class="string">"refresh_token"</span>: <span class="string">"a1b2c3d4e5f6..."</span>,<br>
&nbsp;&nbsp;&nbsp;&nbsp;<span class="string">"user"</span>: {<br>
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<span class="string">"id"</span>: <span class="number">1</span>,<br>
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<span class="string">"name"</span>: <span class="string">"Super Admin"</span>,<br>
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<span class="string">"email"</span>: <span class="string">"admin@wellbroker.in"</span>,<br>
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<span class="string">"username"</span>: <span class="string">"superadmin"</span>,<br>
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<span class="string">"mobile"</span>: <span class="string">"9876543210"</span>,<br>
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<span class="string">"profile_picture"</span>: <span class="string">"https://api.wellbroker.in/uploads/admins/default.png"</span>,<br>
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<span class="string">"created_at"</span>: <span class="string">"2026-07-09 12:00:00"</span><br>
&nbsp;&nbsp;&nbsp;&nbsp;}<br>
&nbsp;&nbsp;}<br>
}
                            </div>
                        </div>

                        <div class="response-section">
                            <div class="endpoint-subtitle">Error Responses</div>
                            <div class="code-block">
                                <button class="copy-btn" onclick="copyCode(this)">Copy</button>
<span class="comment">// 400 - Validation Error</span><br>
{<br>
&nbsp;&nbsp;<span class="string">"status"</span>: <span class="keyword">false</span>,<br>
&nbsp;&nbsp;<span class="string">"message"</span>: <span class="string">"Email/Username and password are required"</span>,<br>
&nbsp;&nbsp;<span class="string">"data"</span>: {}<br>
}<br><br>
<span class="comment">// 401 - Invalid Credentials</span><br>
{<br>
&nbsp;&nbsp;<span class="string">"status"</span>: <span class="keyword">false</span>,<br>
&nbsp;&nbsp;<span class="string">"message"</span>: <span class="string">"Invalid credentials"</span>,<br>
&nbsp;&nbsp;<span class="string">"data"</span>: {}<br>
}<br><br>
<span class="comment">// 403 - Account Deactivated</span><br>
{<br>
&nbsp;&nbsp;<span class="string">"status"</span>: <span class="keyword">false</span>,<br>
&nbsp;&nbsp;<span class="string">"message"</span>: <span class="string">"Account is deactivated. Contact administrator."</span>,<br>
&nbsp;&nbsp;<span class="string">"data"</span>: {}<br>
}
                            </div>
                        </div>
                    </div>
                </div>
            </section>

            <section class="section" id="endpoints">
                <h2 class="section-title">API Endpoints</h2>
                <p class="section-desc">
                    Below is a summary of all available API endpoints. Each endpoint is documented with
                    its HTTP method, path, required parameters, and example responses.
                </p>

                <div class="card">
                    <div class="card-title">Authentication</div>
                    <table class="param-table">
                        <thead>
                            <tr>
                                <th>Method</th>
                                <th>Endpoint</th>
                                <th>Description</th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr>
                                <td><span class="method method-post">POST</span></td>
                                <td><span class="param-name">/admin/index.php</span></td>
                                <td><span class="param-desc">Admin login</span></td>
                            </tr>
                        </tbody>
                    </table>
                </div>
            </section>

        </main>
    </div>

    <script>
        document.addEventListener('DOMContentLoaded', function() {
            const sidebar = document.getElementById('sidebar');
            const overlay = document.getElementById('overlay');
            const toggle = document.getElementById('sidebarToggle');
            const links = document.querySelectorAll('.sidebar-link');

            toggle.addEventListener('click', function() {
                sidebar.classList.toggle('open');
                overlay.classList.toggle('show');
            });

            overlay.addEventListener('click', function() {
                sidebar.classList.remove('open');
                overlay.classList.remove('show');
            });

            const observer = new IntersectionObserver(function(entries) {
                entries.forEach(function(entry) {
                    if (entry.isIntersecting) {
                        links.forEach(function(link) {
                            link.classList.remove('active');
                            if (link.dataset.section === entry.target.id) {
                                link.classList.add('active');
                            }
                        });
                    }
                });
            }, { rootMargin: '-80px 0px -60% 0px' });

            document.querySelectorAll('section[id]').forEach(function(section) {
                observer.observe(section);
            });

            links.forEach(function(link) {
                link.addEventListener('click', function(e) {
                    e.preventDefault();
                    const target = document.getElementById(this.dataset.section);
                    if (target) {
                        target.scrollIntoView({ behavior: 'smooth' });
                    }
                    if (window.innerWidth <= 768) {
                        sidebar.classList.remove('open');
                        overlay.classList.remove('show');
                    }
                });
            });
        });

        function copyCode(btn) {
            const block = btn.parentElement;
            const code = block.textContent.replace('Copy', '').trim();
            navigator.clipboard.writeText(code).then(function() {
                btn.textContent = 'Copied!';
                btn.classList.add('copied');
                setTimeout(function() {
                    btn.textContent = 'Copy';
                    btn.classList.remove('copied');
                }, 2000);
            });
        }
    </script>
</body>
</html>
