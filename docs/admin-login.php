<?php $pageTitle = 'Admin Login'; ?>
<?php include __DIR__ . '/../components/header.php'; ?>

<div class="overlay" id="overlay"></div>

<div class="layout">
    <?php include __DIR__ . '/../components/sidebar.php'; ?>

    <main class="main-content">

        <div class="page-header">
            <div>
                <span class="section-badge badge-green">AUTHENTICATION</span>
                <h1>Admin Login</h1>
            </div>
            <div class="page-meta">
                <span class="method method-post">POST</span>
                <span class="inline-code">/admin/index.php</span>
            </div>
        </div>

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
                        &nbsp;&nbsp;<span class="s">"message"</span>: <span class="s">"Account is deactivated"</span>,<br>
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
