<?php $pageTitle = 'Postman Testing Guide'; ?>
<?php include __DIR__ . '/../components/header.php'; ?>

<div class="overlay" id="overlay"></div>

<div class="layout">
    <?php include __DIR__ . '/../components/sidebar.php'; ?>

    <main class="main-content">

        <div class="page-header">
            <div>
                <span class="section-badge badge-accent">TESTING</span>
                <h1>Postman Testing Guide</h1>
            </div>
            <div class="page-meta">
                <span class="tag">3 Endpoints</span>
            </div>
        </div>

        <p class="section-desc">
            Follow this step-by-step guide to test every API endpoint using Postman.
            Each endpoint includes setup instructions, header configuration, request body,
            and expected responses so you can verify everything works end-to-end.
        </p>

        <div class="callout callout-warning">
            <span class="callout-icon">&#9888;</span>
            <div class="callout-text">
                <strong>Prerequisites:</strong> Make sure the API server is running and the database is seeded.
                Import <span class="inline-code">sql/admins.sql</span> for the admin user and
                <span class="inline-code">sql/users.sql</span> for the user registration table.
                The default admin password hash is for <strong>"password"</strong> (change in production).
            </div>
        </div>

        <!-- COLLECTION SETUP -->
        <section class="section" id="setup">
            <h2 class="section-subtitle">Collection Setup</h2>
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
                        <li>Go to the <strong>Pre-request Script</strong> tab and add the script below to automatically set the <span class="inline-code">Content-Type</span> header for JSON requests.</li>
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

        <!-- TESTING USER REGISTRATION -->
        <section class="section" id="testing-register">
            <span class="section-badge badge-green">STEP-BY-STEP</span>
            <h2 class="section-subtitle">Testing: User Registration</h2>
            <p class="section-desc">
                Follow these steps to test the User Registration endpoint. This endpoint uses <strong>multipart/form-data</strong> for file uploads.
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
                            <tr><td><span class="param-name">URL</span></td><td><span class="param-type">{{base_url}}/api/register.php</span></td></tr>
                            <tr><td><span class="param-name">Headers</span></td><td><span class="param-type">No Content-Type (auto-set for multipart)</span></td></tr>
                            <tr><td><span class="param-name">Auth</span></td><td><span class="param-type">None (public endpoint)</span></td></tr>
                            <tr><td><span class="param-name">Body Type</span></td><td><span class="param-type">form-data</span></td></tr>
                        </tbody>
                    </table>
                </div>
            </div>

            <div class="step-card">
                <div class="step-num">1</div>
                <div class="step-body">
                    <div class="step-title">Create a new request</div>
                    <div class="step-text">In the <strong>Wellbroker API</strong> collection, click <strong>Add a request</strong>. Name it <span class="inline-code">User Registration</span>.</div>
                </div>
            </div>

            <div class="step-card">
                <div class="step-num">2</div>
                <div class="step-body">
                    <div class="step-title">Set method and URL</div>
                    <div class="step-text">Set method to <strong>POST</strong> and URL to <span class="inline-code">{{base_url}}/api/register.php</span>.</div>
                </div>
            </div>

            <div class="step-card">
                <div class="step-num">3</div>
                <div class="step-body">
                    <div class="step-title">Set up form-data body</div>
                    <div class="step-text">Go to the <strong>Body</strong> tab, select <strong>form-data</strong>, and add the following fields:</div>
                    <div class="code-block" style="margin-top:10px">
                        <button class="copy-btn" onclick="copyCode(this)">Copy</button>
                        <span class="c"># Key-Value pairs (all text type)</span><br>
                        <span class="hl">full_name</span>: Rajesh Sharma<br>
                        <span class="hl">email</span>: rajesh@example.com<br>
                        <span class="hl">mobile</span>: 9876543210<br>
                        <span class="hl">password</span>: Secure@123<br>
                        <span class="hl">state</span>: Maharashtra<br>
                        <span class="hl">city</span>: Mumbai<br>
                        <span class="hl">address</span>: 42, Marine Drive<br>
                        <span class="hl">pincode</span>: 400001<br>
                        <span class="hl">category</span>: agent_broker
                    </div>
                </div>
            </div>

            <div class="step-card">
                <div class="step-num">4</div>
                <div class="step-body">
                    <div class="step-title">Add category-specific fields</div>
                    <div class="step-text">
                        For <strong>agent_broker</strong> category, add these additional form-data fields:<br>
                        <span class="inline-code">rera_number</span>: <span class="inline-code">MH/RERA/12345</span><br>
                        <span class="inline-code">property_types</span>: <span class="inline-code">["Residential","Commercial"]</span> (JSON string)<br>
                        <span class="inline-code">years_of_experience</span>: <span class="inline-code">8</span>
                    </div>
                </div>
            </div>

            <div class="step-card">
                <div class="step-num">5</div>
                <div class="step-body">
                    <div class="step-title">Upload files (optional)</div>
                    <div class="step-text">
                        Change the key type from <strong>Text</strong> to <strong>File</strong> for these fields:<br>
                        <span class="inline-code">profile_photo</span> &rarr; select a JPEG/PNG file<br>
                        <span class="inline-code">logo</span> &rarr; select a company logo image
                    </div>
                </div>
            </div>

            <div class="step-card">
                <div class="step-num">6</div>
                <div class="step-body">
                    <div class="step-title">Send and verify</div>
                    <div class="step-text">
                        Click <strong>Send</strong>. Expect a <span class="status-code s2xx">201 Created</span> response with:
                        <ul style="margin-top:4px">
                            <li><span class="inline-code">status: true</span></li>
                            <li>A JWT <span class="inline-code">token</span> for immediate use</li>
                            <li>A <span class="inline-code">user</span> object with profile data</li>
                        </ul>
                    </div>
                </div>
            </div>

            <div class="step-card">
                <div class="step-num">7</div>
                <div class="step-body">
                    <div class="step-title">Test error scenarios</div>
                    <div class="step-text">
                        <ul>
                            <li><strong>Missing required fields:</strong> Send only <span class="inline-code">full_name</span> &rarr; expect <span class="status-code s4xx">422</span> with validation errors array</li>
                            <li><strong>Duplicate email:</strong> Register again with same email &rarr; expect <span class="status-code s4xx">409</span></li>
                            <li><strong>Weak password:</strong> Use <span class="inline-code">"password": "123"</span> &rarr; expect <span class="status-code s4xx">422</span></li>
                            <li><strong>Invalid mobile:</strong> Use <span class="inline-code">"mobile": "12345"</span> &rarr; expect <span class="status-code s4xx">422</span></li>
                        </ul>
                    </div>
                </div>
            </div>

            <div class="callout callout-success" style="margin-top:24px">
                <span class="callout-icon">&#10003;</span>
                <div class="callout-text">
                    <strong>Pro tip:</strong> After registration, the JWT token is returned immediately. Use the Postman
                    <strong>Tests</strong> tab with the script below to auto-save it to <span class="inline-code">{{auth_token}}</span>.
                </div>
            </div>
        </section>

        <!-- TESTING USER LOGIN -->
        <section class="section" id="testing-login">
            <span class="section-badge badge-green">STEP-BY-STEP</span>
            <h2 class="section-subtitle">Testing: User Login</h2>
            <p class="section-desc">
                Follow these steps to test the User Login endpoint. Login is available via email or mobile number.
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
                            <tr><td><span class="param-name">URL</span></td><td><span class="param-type">{{base_url}}/api/login.php</span></td></tr>
                            <tr><td><span class="param-name">Headers</span></td><td><span class="param-type">Content-Type: application/json</span></td></tr>
                            <tr><td><span class="param-name">Auth</span></td><td><span class="param-type">None (public endpoint)</span></td></tr>
                            <tr><td><span class="param-name">Body Type</span></td><td><span class="param-type">raw (JSON)</span></td></tr>
                        </tbody>
                    </table>
                </div>
            </div>

            <div class="step-card">
                <div class="step-num">1</div>
                <div class="step-body">
                    <div class="step-title">Create a new request</div>
                    <div class="step-text">In the <strong>Wellbroker API</strong> collection, add a request named <span class="inline-code">User Login</span>.</div>
                </div>
            </div>

            <div class="step-card">
                <div class="step-num">2</div>
                <div class="step-body">
                    <div class="step-title">Set method, URL, and headers</div>
                    <div class="step-text">
                        Set method to <strong>POST</strong>, URL to <span class="inline-code">{{base_url}}/api/login.php</span>,
                        and add header <span class="inline-code">Content-Type: application/json</span>.
                    </div>
                </div>
            </div>

            <div class="step-card">
                <div class="step-num">3</div>
                <div class="step-body">
                    <div class="step-title">Prepare the request body</div>
                    <div class="step-text">Go to <strong>Body</strong> &rarr; <strong>raw</strong> &rarr; <strong>JSON</strong> and paste:</div>
                    <div class="code-block" style="margin-top:10px">
                        <button class="copy-btn" onclick="copyCode(this)">Copy</button>
                        {<br>
                        &nbsp;&nbsp;<span class="s">"email"</span>: <span class="s">"rajesh@example.com"</span>,<br>
                        &nbsp;&nbsp;<span class="s">"password"</span>: <span class="s">"Secure@123"</span><br>
                        }
                    </div>
                </div>
            </div>

            <div class="step-card">
                <div class="step-num">4</div>
                <div class="step-body">
                    <div class="step-title">Test login by mobile</div>
                    <div class="step-text">Change the <span class="inline-code">email</span> value to the registered mobile number:<br>
                    <span class="inline-code">"email": "9876543210"</span></div>
                </div>
            </div>

            <div class="step-card">
                <div class="step-num">5</div>
                <div class="step-body">
                    <div class="step-title">Send and verify</div>
                    <div class="step-text">
                        Click <strong>Send</strong>. Expect a <span class="status-code s2xx">200 OK</span> response with:
                        <ul style="margin-top:4px">
                            <li><span class="inline-code">status: true</span></li>
                            <li>A JWT <span class="inline-code">token</span></li>
                            <li>Complete <span class="inline-code">user</span> profile including <span class="inline-code">extra_fields</span> with category-specific data</li>
                        </ul>
                    </div>
                </div>
            </div>

            <div class="step-card">
                <div class="step-num">6</div>
                <div class="step-body">
                    <div class="step-title">Test error scenarios</div>
                    <div class="step-text">
                        <ul>
                            <li><strong>Wrong password:</strong> Send wrong password &rarr; expect <span class="status-code s4xx">401</span></li>
                            <li><strong>Unregistered email:</strong> Send unregistered email &rarr; expect <span class="status-code s4xx">401</span></li>
                            <li><strong>Missing fields:</strong> Send empty body &rarr; expect <span class="status-code s4xx">400</span></li>
                        </ul>
                    </div>
                </div>
            </div>
        </section>

        <!-- TESTING ADMIN LOGIN -->
        <section class="section" id="testing-admin-login">
            <span class="section-badge badge-green">STEP-BY-STEP</span>
            <h2 class="section-subtitle">Testing: Admin Login</h2>
            <p class="section-desc">
                Follow these steps to test the Admin Login endpoint in Postman.
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
                            <tr><td><span class="param-name">Body Type</span></td><td><span class="param-type">raw (JSON)</span></td></tr>
                        </tbody>
                    </table>
                </div>
            </div>

            <div class="step-card">
                <div class="step-num">1</div>
                <div class="step-body">
                    <div class="step-title">Create a new request</div>
                    <div class="step-text">In the <strong>Wellbroker API</strong> collection, click <strong>Add a request</strong>. Name it <span class="inline-code">Admin Login</span>.</div>
                </div>
            </div>

            <div class="step-card">
                <div class="step-num">2</div>
                <div class="step-body">
                    <div class="step-title">Set the HTTP method</div>
                    <div class="step-text">Change the method dropdown from <strong>GET</strong> to <strong>POST</strong>.</div>
                </div>
            </div>

            <div class="step-card">
                <div class="step-num">3</div>
                <div class="step-body">
                    <div class="step-title">Enter the request URL</div>
                    <div class="step-text">In the URL field, enter: <span class="inline-code">{{base_url}}/admin/index.php</span></div>
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
                </div>
            </div>

            <div class="step-card">
                <div class="step-num">5</div>
                <div class="step-body">
                    <div class="step-title">Prepare the request body</div>
                    <div class="step-text">Go to the <strong>Body</strong> tab, select <strong>raw</strong>, and choose <strong>JSON</strong> from the dropdown. Paste the following:</div>
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
                    <div class="step-title">(Optional) Test with username</div>
                    <div class="step-text">Change the <span class="inline-code">email</span> value to a username: <span class="inline-code">"email": "superadmin"</span></div>
                </div>
            </div>

            <div class="step-card">
                <div class="step-num">7</div>
                <div class="step-body">
                    <div class="step-title">Send the request</div>
                    <div class="step-text">Click the <strong>Send</strong> button. You should receive a <strong>200 OK</strong> response.</div>
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
                            <li>A <span class="inline-code">user</span> object with admin profile fields</li>
                        </ul>
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
                        <span class="k">if</span> (pm.response.code === 200 || pm.response.code === 201) {<br>
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
                        <ul>
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
                    The <span class="inline-code">auth_token</span> variable is automatically populated
                    for all subsequent requests.
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
