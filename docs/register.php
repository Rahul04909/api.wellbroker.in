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
            Register a new user account on the Wellbroker platform. This endpoint accepts all common profile fields
            plus category-specific fields based on the selected profession. Supports file uploads for profile photo,
            logo, and portfolio images.
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
                        <strong>Content-Type:</strong> Use <span class="inline-code">multipart/form-data</span> when uploading files,
                        or <span class="inline-code">application/json</span> for JSON-only requests.
                    </div>
                </div>

                <div class="endpoint-subtitle">Common Fields (All Categories)</div>
                <div class="table-wrap">
                    <table class="param-table">
                        <thead><tr><th>Parameter</th><th>Type</th><th>Description</th></tr></thead>
                        <tbody>
                            <tr><td><span class="param-name">full_name</span></td><td><span class="param-type">string</span></td><td><span class="param-req required">Required</span><span class="param-desc">Full name of the user</span></td></tr>
                            <tr><td><span class="param-name">company_name</span></td><td><span class="param-type">string</span></td><td><span class="param-req optional">Optional</span><span class="param-desc">Company or firm name</span></td></tr>
                            <tr><td><span class="param-name">mobile</span></td><td><span class="param-type">string</span></td><td><span class="param-req required">Required</span><span class="param-desc">10-digit Indian mobile number (starts with 6-9)</span></td></tr>
                            <tr><td><span class="param-name">email</span></td><td><span class="param-type">string</span></td><td><span class="param-req required">Required</span><span class="param-desc">Valid email address (must have valid domain)</span></td></tr>
                            <tr><td><span class="param-name">password</span></td><td><span class="param-type">string</span></td><td><span class="param-req required">Required</span><span class="param-desc">Min 8 chars, uppercase, lowercase, digit, special char</span></td></tr>
                            <tr><td><span class="param-name">state</span></td><td><span class="param-type">string</span></td><td><span class="param-req required">Required</span><span class="param-desc">State name</span></td></tr>
                            <tr><td><span class="param-name">city</span></td><td><span class="param-type">string</span></td><td><span class="param-req required">Required</span><span class="param-desc">City name</span></td></tr>
                            <tr><td><span class="param-name">address</span></td><td><span class="param-type">string</span></td><td><span class="param-req required">Required</span><span class="param-desc">Full address</span></td></tr>
                            <tr><td><span class="param-name">pincode</span></td><td><span class="param-type">string</span></td><td><span class="param-req required">Required</span><span class="param-desc">6-digit pincode</span></td></tr>
                            <tr><td><span class="param-name">category</span></td><td><span class="param-type">string</span></td><td><span class="param-req required">Required</span><span class="param-desc">See category list below</span></td></tr>
                            <tr><td><span class="param-name">sub_category</span></td><td><span class="param-type">string</span></td><td><span class="param-req optional">Optional</span><span class="param-desc">Sub-category within the selected category</span></td></tr>
                            <tr><td><span class="param-name">experience</span></td><td><span class="param-type">string</span></td><td><span class="param-req optional">Optional</span><span class="param-desc">Years/months of experience</span></td></tr>
                            <tr><td><span class="param-name">about_business</span></td><td><span class="param-type">text</span></td><td><span class="param-req optional">Optional</span><span class="param-desc">Brief description about business</span></td></tr>
                            <tr><td><span class="param-name">service_areas</span></td><td><span class="param-type">json</span></td><td><span class="param-req optional">Optional</span><span class="param-desc">Array of service areas served: <span class="inline-code">["Area1","Area2"]</span></span></td></tr>
                            <tr><td><span class="param-name">website</span></td><td><span class="param-type">string</span></td><td><span class="param-req optional">Optional</span><span class="param-desc">Website URL</span></td></tr>
                            <tr><td><span class="param-name">whatsapp_number</span></td><td><span class="param-type">string</span></td><td><span class="param-req optional">Optional</span><span class="param-desc">WhatsApp contact number</span></td></tr>
                            <tr><td><span class="param-name">profile_photo</span></td><td><span class="param-type">file</span></td><td><span class="param-req optional">Optional</span><span class="param-desc">Profile photo (JPEG, PNG, GIF, WEBP; max 5MB)</span></td></tr>
                            <tr><td><span class="param-name">logo</span></td><td><span class="param-type">file</span></td><td><span class="param-req optional">Optional</span><span class="param-desc">Company logo (JPEG, PNG, GIF, WEBP; max 5MB)</span></td></tr>
                        </tbody>
                    </table>
                </div>

                <div class="endpoint-subtitle" style="margin-top:24px">Categories</div>
                <div class="table-wrap">
                    <table class="param-table">
                        <thead><tr><th>Value</th><th>Label</th></tr></thead>
                        <tbody>
                            <tr><td><span class="param-name">agent_broker</span></td><td><span class="param-desc">Agents / Brokers</span></td></tr>
                            <tr><td><span class="param-name">builder_developer</span></td><td><span class="param-desc">Builders / Developers</span></td></tr>
                            <tr><td><span class="param-name">architect</span></td><td><span class="param-desc">Architects</span></td></tr>
                            <tr><td><span class="param-name">interior_decorator</span></td><td><span class="param-desc">Interior Decorators</span></td></tr>
                            <tr><td><span class="param-name">building_contractor</span></td><td><span class="param-desc">Building Contractors</span></td></tr>
                            <tr><td><span class="param-name">vaastu_consultant</span></td><td><span class="param-desc">Vaastu Consultants</span></td></tr>
                            <tr><td><span class="param-name">home_inspection</span></td><td><span class="param-desc">Home Inspection</span></td></tr>
                            <tr><td><span class="param-name">property_consultant</span></td><td><span class="param-desc">Property Consultants</span></td></tr>
                        </tbody>
                    </table>
                </div>

                <div class="endpoint-subtitle" style="margin-top:24px">Category-Specific Fields</div>

                <div class="card" style="margin-bottom:12px">
                    <div class="card-title">&#127968; Agents / Brokers</div>
                    <div class="table-wrap">
                        <table class="param-table">
                            <thead><tr><th>Parameter</th><th>Type</th><th>Description</th></tr></thead>
                            <tbody>
                                <tr><td><span class="param-name">rera_number</span></td><td><span class="param-type">string</span></td><td><span class="param-req optional">Optional</span><span class="param-desc">RERA registration number</span></td></tr>
                                <tr><td><span class="param-name">property_types</span></td><td><span class="param-type">json</span></td><td><span class="param-req optional">Optional</span><span class="param-desc">Array of property types: <span class="inline-code">["Residential","Commercial"]</span></span></td></tr>
                                <tr><td><span class="param-name">buy_sell_rent</span></td><td><span class="param-type">json</span></td><td><span class="param-req optional">Optional</span><span class="param-desc">Services offered: <span class="inline-code">["Buy","Sell","Rent"]</span></span></td></tr>
                                <tr><td><span class="param-name">years_of_experience</span></td><td><span class="param-type">number</span></td><td><span class="param-req optional">Optional</span><span class="param-desc">Years of experience in real estate</span></td></tr>
                            </tbody>
                        </table>
                    </div>
                </div>

                <div class="card" style="margin-bottom:12px">
                    <div class="card-title">&#127970; Builders / Developers</div>
                    <div class="table-wrap">
                        <table class="param-table">
                            <thead><tr><th>Parameter</th><th>Type</th><th>Description</th></tr></thead>
                            <tbody>
                                <tr><td><span class="param-name">rera_registration</span></td><td><span class="param-type">string</span></td><td><span class="param-req optional">Optional</span><span class="param-desc">RERA registration number</span></td></tr>
                                <tr><td><span class="param-name">company_registration_no</span></td><td><span class="param-type">string</span></td><td><span class="param-req optional">Optional</span><span class="param-desc">Company incorporation / registration number</span></td></tr>
                                <tr><td><span class="param-name">total_projects</span></td><td><span class="param-type">number</span></td><td><span class="param-req optional">Optional</span><span class="param-desc">Total number of projects undertaken</span></td></tr>
                                <tr><td><span class="param-name">ongoing_projects</span></td><td><span class="param-type">number</span></td><td><span class="param-req optional">Optional</span><span class="param-desc">Number of ongoing projects</span></td></tr>
                                <tr><td><span class="param-name">completed_projects</span></td><td><span class="param-type">number</span></td><td><span class="param-req optional">Optional</span><span class="param-desc">Number of completed projects</span></td></tr>
                            </tbody>
                        </table>
                    </div>
                </div>

                <div class="card" style="margin-bottom:12px">
                    <div class="card-title">&#128393; Architects</div>
                    <div class="table-wrap">
                        <table class="param-table">
                            <thead><tr><th>Parameter</th><th>Type</th><th>Description</th></tr></thead>
                            <tbody>
                                <tr><td><span class="param-name">coa_registration_number</span></td><td><span class="param-type">string</span></td><td><span class="param-req optional">Optional</span><span class="param-desc">Council of Architecture registration number</span></td></tr>
                                <tr><td><span class="param-name">qualification</span></td><td><span class="param-type">string</span></td><td><span class="param-req optional">Optional</span><span class="param-desc">Educational qualification details</span></td></tr>
                                <tr><td><span class="param-name">design_style</span></td><td><span class="param-type">string</span></td><td><span class="param-req optional">Optional</span><span class="param-desc">Architectural design style specialisation</span></td></tr>
                                <tr><td><span class="param-name">portfolio</span></td><td><span class="param-type">string</span></td><td><span class="param-req optional">Optional</span><span class="param-desc">URL or description of portfolio work</span></td></tr>
                            </tbody>
                        </table>
                    </div>
                </div>

                <div class="card" style="margin-bottom:12px">
                    <div class="card-title">&#127912; Interior Decorators</div>
                    <div class="table-wrap">
                        <table class="param-table">
                            <thead><tr><th>Parameter</th><th>Type</th><th>Description</th></tr></thead>
                            <tbody>
                                <tr><td><span class="param-name">specialization</span></td><td><span class="param-type">string</span></td><td><span class="param-req optional">Optional</span><span class="param-desc">Area of specialisation (residential, commercial, etc.)</span></td></tr>
                                <tr><td><span class="param-name">portfolio_images</span></td><td><span class="param-type">file[]</span></td><td><span class="param-req optional">Optional</span><span class="param-desc">Multiple portfolio images (use <span class="inline-code">portfolio_images[]</span> in form-data)</span></td></tr>
                                <tr><td><span class="param-name">design_style</span></td><td><span class="param-type">string</span></td><td><span class="param-req optional">Optional</span><span class="param-desc">Preferred design style (modern, traditional, etc.)</span></td></tr>
                                <tr><td><span class="param-name">minimum_project_budget</span></td><td><span class="param-type">string</span></td><td><span class="param-req optional">Optional</span><span class="param-desc">Minimum budget for projects (e.g. "5 Lakhs")</span></td></tr>
                            </tbody>
                        </table>
                    </div>
                </div>

                <div class="card" style="margin-bottom:12px">
                    <div class="card-title">&#128119; Building Contractors</div>
                    <div class="table-wrap">
                        <table class="param-table">
                            <thead><tr><th>Parameter</th><th>Type</th><th>Description</th></tr></thead>
                            <tbody>
                                <tr><td><span class="param-name">contractor_license</span></td><td><span class="param-type">string</span></td><td><span class="param-req optional">Optional</span><span class="param-desc">Contractor license or registration number</span></td></tr>
                                <tr><td><span class="param-name">team_size</span></td><td><span class="param-type">number</span></td><td><span class="param-req optional">Optional</span><span class="param-desc">Size of the construction team</span></td></tr>
                                <tr><td><span class="param-name">services_offered</span></td><td><span class="param-type">json</span></td><td><span class="param-req optional">Optional</span><span class="param-desc">Array of services: <span class="inline-code">["Residential","Commercial","Renovation"]</span></span></td></tr>
                                <tr><td><span class="param-name">minimum_project_value</span></td><td><span class="param-type">string</span></td><td><span class="param-req optional">Optional</span><span class="param-desc">Minimum project value accepted</span></td></tr>
                            </tbody>
                        </table>
                    </div>
                </div>

                <div class="card" style="margin-bottom:12px">
                    <div class="card-title">&#128302; Vaastu Consultants</div>
                    <div class="table-wrap">
                        <table class="param-table">
                            <thead><tr><th>Parameter</th><th>Type</th><th>Description</th></tr></thead>
                            <tbody>
                                <tr><td><span class="param-name">certification</span></td><td><span class="param-type">string</span></td><td><span class="param-req optional">Optional</span><span class="param-desc">Vaastu certification details</span></td></tr>
                                <tr><td><span class="param-name">consultation_type</span></td><td><span class="param-type">json</span></td><td><span class="param-req optional">Optional</span><span class="param-desc">Consultation modes: <span class="inline-code">["Online","Offline"]</span></span></td></tr>
                                <tr><td><span class="param-name">languages</span></td><td><span class="param-type">json</span></td><td><span class="param-req optional">Optional</span><span class="param-desc">Languages spoken: <span class="inline-code">["Hindi","English","Marathi"]</span></span></td></tr>
                            </tbody>
                        </table>
                    </div>
                </div>

                <div class="card" style="margin-bottom:12px">
                    <div class="card-title">&#128269; Home Inspection</div>
                    <div class="table-wrap">
                        <table class="param-table">
                            <thead><tr><th>Parameter</th><th>Type</th><th>Description</th></tr></thead>
                            <tbody>
                                <tr><td><span class="param-name">inspection_types</span></td><td><span class="param-type">json</span></td><td><span class="param-req optional">Optional</span><span class="param-desc">Inspection services: <span class="inline-code">["Structural","Electrical","Plumbing"]</span></span></td></tr>
                                <tr><td><span class="param-name">certifications</span></td><td><span class="param-type">string</span></td><td><span class="param-req optional">Optional</span><span class="param-desc">Professional certifications held</span></td></tr>
                                <tr><td><span class="param-name">equipment_details</span></td><td><span class="param-type">string</span></td><td><span class="param-req optional">Optional</span><span class="param-desc">Details of inspection equipment used</span></td></tr>
                            </tbody>
                        </table>
                    </div>
                </div>

                <div class="card" style="margin-bottom:12px">
                    <div class="card-title">&#128188; Property Consultants</div>
                    <div class="table-wrap">
                        <table class="param-table">
                            <thead><tr><th>Parameter</th><th>Type</th><th>Description</th></tr></thead>
                            <tbody>
                                <tr><td><span class="param-name">specialization</span></td><td><span class="param-type">string</span></td><td><span class="param-req optional">Optional</span><span class="param-desc">Area of property consulting specialisation</span></td></tr>
                                <tr><td><span class="param-name">commercial_residential</span></td><td><span class="param-type">json</span></td><td><span class="param-req optional">Optional</span><span class="param-desc">Sectors served: <span class="inline-code">["Commercial","Residential"]</span></span></td></tr>
                                <tr><td><span class="param-name">investment_consulting</span></td><td><span class="param-type">boolean</span></td><td><span class="param-req optional">Optional</span><span class="param-desc">Whether investment consulting is offered</span></td></tr>
                            </tbody>
                        </table>
                    </div>
                </div>

                <div class="endpoint-subtitle" style="margin-top:24px">Example Request (JSON)</div>
                <div class="code-block">
                    <button class="copy-btn" onclick="copyCode(this)">Copy</button>
                    curl -X POST https://api.wellbroker.in/api/register.php \<br>
                    &nbsp;&nbsp;-H <span class="s">"Content-Type: application/json"</span> \<br>
                    &nbsp;&nbsp;-d <span class="s">'{</span><br>
                    &nbsp;&nbsp;<span class="s">  "full_name": "Rajesh Sharma",</span><br>
                    &nbsp;&nbsp;<span class="s">  "company_name": "Sharma Properties",</span><br>
                    &nbsp;&nbsp;<span class="s">  "mobile": "9876543210",</span><br>
                    &nbsp;&nbsp;<span class="s">  "email": "rajesh@example.com",</span><br>
                    &nbsp;&nbsp;<span class="s">  "password": "Secure@123",</span><br>
                    &nbsp;&nbsp;<span class="s">  "state": "Maharashtra",</span><br>
                    &nbsp;&nbsp;<span class="s">  "city": "Mumbai",</span><br>
                    &nbsp;&nbsp;<span class="s">  "address": "42, Marine Drive, South Mumbai",</span><br>
                    &nbsp;&nbsp;<span class="s">  "pincode": "400001",</span><br>
                    &nbsp;&nbsp;<span class="s">  "category": "agent_broker",</span><br>
                    &nbsp;&nbsp;<span class="s">  "experience": "8 years",</span><br>
                    &nbsp;&nbsp;<span class="s">  "rera_number": "MH/RERA/12345/2024",</span><br>
                    &nbsp;&nbsp;<span class="s">  "property_types": "[\"Residential\",\"Commercial\"]",</span><br>
                    &nbsp;&nbsp;<span class="s">  "buy_sell_rent": "[\"Buy\",\"Sell\",\"Rent\"]",</span><br>
                    &nbsp;&nbsp;<span class="s">  "years_of_experience": "8"</span><br>
                    &nbsp;&nbsp;<span class="s">}'</span>
                </div>

                <div class="endpoint-subtitle" style="margin-top:24px">Example Request (Multipart with Files)</div>
                <div class="code-block">
                    <button class="copy-btn" onclick="copyCode(this)">Copy</button>
                    curl -X POST https://api.wellbroker.in/api/register.php \<br>
                    &nbsp;&nbsp;-F <span class="s">"full_name=Rajesh Sharma"</span> \<br>
                    &nbsp;&nbsp;-F <span class="s">"email=rajesh@example.com"</span> \<br>
                    &nbsp;&nbsp;-F <span class="s">"mobile=9876543210"</span> \<br>
                    &nbsp;&nbsp;-F <span class="s">"password=Secure@123"</span> \<br>
                    &nbsp;&nbsp;-F <span class="s">"category=agent_broker"</span> \<br>
                    &nbsp;&nbsp;-F <span class="s">"profile_photo=@/path/to/photo.jpg"</span> \<br>
                    &nbsp;&nbsp;-F <span class="s">"logo=@/path/to/logo.png"</span>
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
                    &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<span class="s">"full_name"</span>: <span class="s">"Rajesh Sharma"</span>,<br>
                    &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<span class="s">"email"</span>: <span class="s">"rajesh@example.com"</span>,<br>
                    &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<span class="s">"category"</span>: <span class="s">"agent_broker"</span>,<br>
                    &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<span class="s">"category_label"</span>: <span class="s">"Agents / Brokers"</span>,<br>
                    &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<span class="s">"profile_photo"</span>: <span class="s">"https://api.wellbroker.in/uploads/profiles/abc.jpg"</span>,<br>
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
                        &nbsp;&nbsp;&nbsp;&nbsp;<span class="s">"errors"</span>: [<span class="s">"Full name is required"</span>, <span class="s">"Email is required"</span>]<br>
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
