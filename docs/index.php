<?php $pageTitle = 'Getting Started'; ?>
<?php include __DIR__ . '/../components/header.php'; ?>

<div class="overlay" id="overlay"></div>

<div class="layout">
    <?php include __DIR__ . '/../components/sidebar.php'; ?>

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
                    <div class="card-text">All dates in <strong>ISO 8601</strong> format (UTC). Example: <span class="inline-code">2026-07-12 12:00:00</span></div>
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

            <div class="card">
                <div class="card-title">
                    <svg width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="var(--accent)" stroke-width="2" stroke-linecap="round"><path d="M14 2H6a2 2 0 00-2 2v16a2 2 0 002 2h12a2 2 0 002-2V8z"/><polyline points="14 2 14 8 20 8"/></svg>
                    SQL Schema
                </div>
                <div class="card-text">
                    Import the required tables from the <span class="inline-code">sql/</span> directory:
                </div>
                <div class="code-block" style="margin-top:8px">
                    <button class="copy-btn" onclick="copyCode(this)">Copy</button>
                    <span class="c"># Import admin table</span><br>
                    mysql -u root -p your_database &lt; sql/admins.sql<br><br>
                    <span class="c"># Import users table</span><br>
                    mysql -u root -p your_database &lt; sql/users.sql
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
                            <tr><td><span class="param-name">sub</span></td><td><span class="param-desc">Subject &mdash; the authenticated user ID</span></td></tr>
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
                <div class="card"><div class="card-title"><span class="status-code s2xx">201</span></div><div class="card-text">Resource created</div></div>
                <div class="card"><div class="card-title"><span class="status-code s4xx">400</span></div><div class="card-text">Bad request / invalid input</div></div>
                <div class="card"><div class="card-title"><span class="status-code s4xx">401</span></div><div class="card-text">Invalid credentials</div></div>
                <div class="card"><div class="card-title"><span class="status-code s4xx">403</span></div><div class="card-text">Account deactivated</div></div>
                <div class="card"><div class="card-title"><span class="status-code s4xx">405</span></div><div class="card-text">Method not allowed</div></div>
                <div class="card"><div class="card-title"><span class="status-code s4xx">409</span></div><div class="card-text">Duplicate resource</div></div>
                <div class="card"><div class="card-title"><span class="status-code s4xx">422</span></div><div class="card-text">Validation failed</div></div>
                <div class="card"><div class="card-title"><span class="status-code s5xx">500</span></div><div class="card-text">Internal server error</div></div>
            </div>
        </section>

        <div class="divider"></div>

        <!-- ====== ENDPOINTS REFERENCE ====== -->
        <section class="section" id="endpoints">
            <span class="section-badge badge-accent">REFERENCE</span>
            <h2 class="section-subtitle">API Endpoints</h2>
            <p class="section-desc">Quick-reference summary of all available endpoints. Click on an endpoint name to view full documentation.</p>

            <div class="card">
                <div class="card-title">Authentication</div>
                <div class="table-wrap">
                    <table class="param-table">
                        <thead><tr><th>Method</th><th>Endpoint</th><th>Auth</th><th>Description</th></tr></thead>
                        <tbody>
                            <tr>
                                <td><span class="method method-post">POST</span></td>
                                <td><a href="/docs/register.php"><span class="param-name">/api/register.php</span></a></td>
                                <td><span class="tag">None</span></td>
                                <td><span class="param-desc">User registration &mdash; create account + return JWT</span></td>
                            </tr>
                            <tr>
                                <td><span class="method method-post">POST</span></td>
                                <td><a href="/docs/login.php"><span class="param-name">/api/login.php</span></a></td>
                                <td><span class="tag">None</span></td>
                                <td><span class="param-desc">User login &mdash; email or mobile + password &rarr; JWT</span></td>
                            </tr>
                            <tr>
                                <td><span class="method method-post">POST</span></td>
                                <td><a href="/docs/admin-login.php"><span class="param-name">/admin/index.php</span></a></td>
                                <td><span class="tag">None</span></td>
                                <td><span class="param-desc">Admin login &mdash; email or username + password &rarr; JWT</span></td>
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
