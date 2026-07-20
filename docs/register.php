<?php $pageTitle = 'User Registration'; ?>
<?php include __DIR__ . '/../components/header.php'; ?>

<div class="overlay" id="overlay"></div>

<div class="layout">
    <?php include __DIR__ . '/../components/sidebar.php'; ?>

    <main class="main-content">

        <div class="page-header">
            <div>
                <span class="section-badge badge-green">AUTHENTICATION</span>
                <h1>User Registration</h1>
            </div>
            <div class="page-meta">
                <span class="method method-post">POST</span>
                <span class="inline-code">/api/register.php</span>
            </div>
        </div>

        <p class="section-desc">
            Register a new user account on the Wellbroker platform.
        </p>

        <div class="endpoint">
            <div class="endpoint-header">
                <span class="method method-post">POST</span>
                <span class="endpoint-path">/api/register.php</span>
                <span class="endpoint-desc">Create a new user account</span>
            </div>
            <div class="endpoint-body">

                <div class="callout callout-info">
                    <span class="callout-icon">&#9432;</span>
                    <div class="callout-text">
                        <strong>Content-Type:</strong> Use <span class="inline-code">application/json</span> or <span class="inline-code">multipart/form-data</span>.
                    </div>
                </div>

                <div class="endpoint-subtitle">Request Parameters</div>
                <div class="table-wrap">
                    <table class="param-table">
                        <thead><tr><th>Parameter</th><th>Type</th><th>Description</th></tr></thead>
                        <tbody>
                            <tr><td><span class="param-name">name</span></td><td><span class="param-type">string</span></td><td><span class="param-req required">Required</span><span class="param-desc">Full name of the user</span></td></tr>
                            <tr><td><span class="param-name">email</span></td><td><span class="param-type">string</span></td><td><span class="param-req required">Required</span><span class="param-desc">Valid email address</span></td></tr>
                            <tr><td><span class="param-name">mobile</span></td><td><span class="param-type">string</span></td><td><span class="param-req required">Required</span><span class="param-desc">10-digit Indian mobile number starting with 6-9</span></td></tr>
                            <tr><td><span class="param-name">password</span></td><td><span class="param-type">string</span></td><td><span class="param-req required">Required</span><span class="param-desc">Min 8 chars, uppercase, lowercase, digit, special char</span></td></tr>
                            <tr><td><span class="param-name">state</span></td><td><span class="param-type">string</span></td><td><span class="param-req required">Required</span><span class="param-desc">State name</span></td></tr>
                            <tr><td><span class="param-name">city</span></td><td><span class="param-type">string</span></td><td><span class="param-req required">Required</span><span class="param-desc">City name</span></td></tr>
                            <tr><td><span class="param-name">locality</span></td><td><span class="param-type">string</span></td><td><span class="param-req required">Required</span><span class="param-desc">Locality or area name</span></td></tr>
                            <tr><td><span class="param-name">whatsapp_number</span></td><td><span class="param-type">string</span></td><td><span class="param-req required">Required</span><span class="param-desc">10-digit Indian WhatsApp number starting with 6-9</span></td></tr>
                            <tr><td><span class="param-name">category</span></td><td><span class="param-type">string</span></td><td><span class="param-req required">Required</span><span class="param-desc">User category slug. One of: <span class="inline-code">agent_broker</span>, <span class="inline-code">builder_developer</span>, <span class="inline-code">architect</span>, <span class="inline-code">interior_decorator</span>, <span class="inline-code">vaastu_consultant</span>, <span class="inline-code">building_contractor</span>, <span class="inline-code">home_inspection</span>, <span class="inline-code">property_consultant</span></span></td></tr>
                            <tr><td><span class="param-name">sub_category</span></td><td><span class="param-type">string</span></td><td><span class="param-req optional">Optional</span><span class="param-desc">Sub-category within the selected category</span></td></tr>
                        </tbody>
                    </table>
                </div>

                <div class="endpoint-subtitle" style="margin-top:24px">Example Request (JSON)</div>
                <div class="code-block">
                    <button class="copy-btn" onclick="copyCode(this)">Copy</button>
                    curl -X POST https://api.wellbroker.in/api/register.php \<br>
                    &nbsp;&nbsp;-H <span class="s">"Content-Type: application/json"</span> \<br>
                    &nbsp;&nbsp;-d <span class="s">'{</span><br>
                    &nbsp;&nbsp;<span class="s">  "name": "Rajesh Sharma",</span><br>
                    &nbsp;&nbsp;<span class="s">  "email": "rajesh@example.com",</span><br>
                    &nbsp;&nbsp;<span class="s">  "mobile": "9876543210",</span><br>
                    &nbsp;&nbsp;<span class="s">  "password": "Secure@123",</span><br>
                    &nbsp;&nbsp;<span class="s">  "state": "Maharashtra",</span><br>
                    &nbsp;&nbsp;<span class="s">  "city": "Mumbai",</span><br>
                    &nbsp;&nbsp;<span class="s">  "locality": "Andheri West",</span><br>
                    &nbsp;&nbsp;<span class="s">  "whatsapp_number": "9876543210",</span><br>
                    &nbsp;&nbsp;<span class="s">  "category": "agent_broker",</span><br>
                    &nbsp;&nbsp;<span class="s">  "sub_category": "Residential"</span><br>
                    &nbsp;&nbsp;<span class="s">}'</span>
                </div>

                <div class="endpoint-subtitle" style="margin-top:24px">Success Response &mdash; <span class="status-code s2xx">201 Created</span></div>
                <div class="code-block">
                    <button class="copy-btn" onclick="copyCode(this)">Copy</button>
                    {<br>
                    &nbsp;&nbsp;<span class="s">"status"</span>: <span class="k">true</span>,<br>
                    &nbsp;&nbsp;<span class="s">"message"</span>: <span class="s">"Registration successful"</span>,<br>
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
                    &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<span class="s">"category"</span>: <span class="s">"agent_broker"</span>,<br>
                    &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<span class="s">"category_label"</span>: <span class="s">"Agents / Brokers"</span>,<br>
                    &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<span class="s">"sub_category"</span>: <span class="s">"Residential"</span>,<br>
                    &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<span class="s">"created_at"</span>: <span class="s">"2026-07-12 21:30:00"</span><br>
                    &nbsp;&nbsp;&nbsp;&nbsp;}<br>
                    &nbsp;&nbsp;}<br>
                    }
                </div>

                <div class="endpoint-subtitle" style="margin-top:24px">Error Responses</div>
                <div class="grid-2">
                    <div class="code-block" style="margin:0">
                        <span class="c">// 422 &mdash; Validation errors</span><br>
                        {<br>
                        &nbsp;&nbsp;<span class="s">"status"</span>: <span class="k">false</span>,<br>
                        &nbsp;&nbsp;<span class="s">"message"</span>: <span class="s">"Validation failed"</span>,<br>
                        &nbsp;&nbsp;<span class="s">"data"</span>: {<br>
                        &nbsp;&nbsp;&nbsp;&nbsp;<span class="s">"errors"</span>: [<span class="s">"Name is required"</span>, <span class="s">"Email is required"</span>]<br>
                        &nbsp;&nbsp;}<br>
                        }
                    </div>
                    <div class="code-block" style="margin:0">
                        <span class="c">// 409 &mdash; Duplicate</span><br>
                        {<br>
                        &nbsp;&nbsp;<span class="s">"status"</span>: <span class="k">false</span>,<br>
                        &nbsp;&nbsp;<span class="s">"message"</span>: <span class="s">"An account with this email already exists"</span>,<br>
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
