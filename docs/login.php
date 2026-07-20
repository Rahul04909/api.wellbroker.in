<?php $pageTitle = 'User Login'; ?>
<?php include __DIR__ . '/../components/header.php'; ?>

<div class="overlay" id="overlay"></div>

<div class="layout">
    <?php include __DIR__ . '/../components/sidebar.php'; ?>

    <main class="main-content">

        <div class="page-header">
            <div>
                <span class="section-badge badge-green">AUTHENTICATION</span>
                <h1>User Login</h1>
            </div>
            <div class="page-meta">
                <span class="method method-post">POST</span>
                <span class="inline-code">/api/login.php</span>
            </div>
        </div>

        <p class="section-desc">
            Authenticate as a registered user. Accepts <strong>email</strong> or <strong>mobile number</strong>.
            On success you receive a JWT access token, refresh token, and the complete user profile.
        </p>

        <div class="endpoint">
            <div class="endpoint-header">
                <span class="method method-post">POST</span>
                <span class="endpoint-path">/api/login.php</span>
                <span class="endpoint-desc">Authenticate a registered user</span>
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
                                    <span class="param-desc">Registered email <strong>or</strong> mobile number. The API auto-detects which.</span>
                                </td>
                            </tr>
                            <tr>
                                <td><span class="param-name">password</span></td>
                                <td><span class="param-type">string</span></td>
                                <td>
                                    <span class="param-req required">Required</span>
                                    <span class="param-desc">Account password</span>
                                </td>
                            </tr>
                        </tbody>
                    </table>
                </div>

                <div class="callout callout-tip">
                    <span class="callout-icon">&#9889;</span>
                    <div class="callout-text">
                        <strong>Login via email or mobile.</strong> Send either value in the <span class="inline-code">email</span> field.
                        If the value is a valid email, the API looks up by email; otherwise by mobile number.
                    </div>
                </div>

                <div class="endpoint-subtitle" style="margin-top:24px">User Profile Fields</div>
                <div class="table-wrap">
                    <table class="param-table">
                        <thead><tr><th>Field</th><th>Type</th><th>Description</th></tr></thead>
                        <tbody>
                            <tr><td><span class="param-name">id</span></td><td><span class="param-type">integer</span></td><td><span class="param-desc">Unique user identifier</span></td></tr>
                            <tr><td><span class="param-name">name</span></td><td><span class="param-type">string</span></td><td><span class="param-desc">Full name</span></td></tr>
                            <tr><td><span class="param-name">email</span></td><td><span class="param-type">string</span></td><td><span class="param-desc">Email address</span></td></tr>
                            <tr><td><span class="param-name">mobile</span></td><td><span class="param-type">string</span></td><td><span class="param-desc">Mobile number</span></td></tr>
                            <tr><td><span class="param-name">state</span></td><td><span class="param-type">string</span></td><td><span class="param-desc">State</span></td></tr>
                            <tr><td><span class="param-name">city</span></td><td><span class="param-type">string</span></td><td><span class="param-desc">City</span></td></tr>
                            <tr><td><span class="param-name">locality</span></td><td><span class="param-type">string</span></td><td><span class="param-desc">Locality or area</span></td></tr>
                            <tr><td><span class="param-name">whatsapp_number</span></td><td><span class="param-type">string</span></td><td><span class="param-desc">WhatsApp number</span></td></tr>
                            <tr><td><span class="param-name">category</span></td><td><span class="param-type">string</span></td><td><span class="param-desc">User category slug</span></td></tr>
                            <tr><td><span class="param-name">category_label</span></td><td><span class="param-type">string</span></td><td><span class="param-desc">Human-readable category name</span></td></tr>
                            <tr><td><span class="param-name">sub_category</span></td><td><span class="param-type">string|null</span></td><td><span class="param-desc">Sub-category</span></td></tr>
                            <tr><td><span class="param-name">mobile_verified</span></td><td><span class="param-type">boolean</span></td><td><span class="param-desc">Mobile verification status</span></td></tr>
                            <tr><td><span class="param-name">email_verified</span></td><td><span class="param-type">boolean</span></td><td><span class="param-desc">Email verification status</span></td></tr>
                            <tr><td><span class="param-name">created_at</span></td><td><span class="param-type">string</span></td><td><span class="param-desc">Account creation timestamp</span></td></tr>
                        </tbody>
                    </table>
                </div>

                <div class="endpoint-subtitle" style="margin-top:24px">Example Requests</div>

                <div class="code-block">
                    <button class="copy-btn" onclick="copyCode(this)">Copy</button>
                    <span class="c"># Login by email</span><br>
                    curl -X POST https://api.wellbroker.in/api/login.php \<br>
                    &nbsp;&nbsp;-H <span class="s">"Content-Type: application/json"</span> \<br>
                    &nbsp;&nbsp;-d <span class="s">'{"email": "rajesh@example.com", "password": "Secure@123"}'</span>
                </div>

                <div class="code-block">
                    <button class="copy-btn" onclick="copyCode(this)">Copy</button>
                    <span class="c"># Login by mobile number</span><br>
                    curl -X POST https://api.wellbroker.in/api/login.php \<br>
                    &nbsp;&nbsp;-H <span class="s">"Content-Type: application/json"</span> \<br>
                    &nbsp;&nbsp;-d <span class="s">'{"email": "9876543210", "password": "Secure@123"}'</span>
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
                    &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<span class="s">"name"</span>: <span class="s">"Rajesh Sharma"</span>,<br>
                    &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<span class="s">"email"</span>: <span class="s">"rajesh@example.com"</span>,<br>
                    &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<span class="s">"mobile"</span>: <span class="s">"9876543210"</span>,<br>
                    &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<span class="s">"state"</span>: <span class="s">"Maharashtra"</span>,<br>
                    &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<span class="s">"city"</span>: <span class="s">"Mumbai"</span>,<br>
                    &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<span class="s">"locality"</span>: <span class="s">"Andheri West"</span>,<br>
                    &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<span class="s">"whatsapp_number"</span>: <span class="s">"9876543210"</span>,<br>
                    &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<span class="s">"category"</span>: <span class="s">"agent_broker"</span>,<br>
                    &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<span class="s">"category_label"</span>: <span class="s">"Agents / Brokers"</span>,<br>
                    &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<span class="s">"sub_category"</span>: <span class="s">"Residential"</span>,<br>
                    &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<span class="s">"mobile_verified"</span>: <span class="k">false</span>,<br>
                    &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<span class="s">"email_verified"</span>: <span class="k">false</span>,<br>
                    &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<span class="s">"created_at"</span>: <span class="s">"2026-07-12 21:30:00"</span><br>
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
                        &nbsp;&nbsp;<span class="s">"message"</span>: <span class="s">"Email or mobile number is required"</span>,<br>
                        &nbsp;&nbsp;<span class="s">"data"</span>: {}<br>
                        }
                    </div>
                    <div class="code-block" style="margin:0">
                        <span class="c">// 401 &mdash; Invalid credentials</span><br>
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
