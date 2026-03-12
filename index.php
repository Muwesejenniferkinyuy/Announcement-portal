<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Internship Notice Board System</title>
  <link rel="preconnect" href="https://fonts.googleapis.com">
  <link href="https://fonts.googleapis.com/css2?family=Playfair+Display:wght@600;700&family=DM+Sans:wght@400;500;600&display=swap" rel="stylesheet">
  <style>
/* ============================================================
   GLOBAL RESET & VARIABLES
============================================================ */
:root {
  --primary:       #7c2d12;
  --primary-dark:  #5b1e0e;
  --primary-light: #9a3412;
  --bg:            #faf7f4;
  --white:         #ffffff;
  --border:        #e0d6d0;
  --text:          #333;
  --muted:         #777;
  --shadow:        0 4px 20px rgba(0,0,0,0.07);
  --shadow-h:      0 8px 28px rgba(124,45,18,0.14);
  --radius:        10px;
}
*{margin:0;padding:0;box-sizing:border-box}
body{font-family:'DM Sans',Arial,sans-serif;background:var(--bg);color:var(--text);min-height:100vh;display:flex;flex-direction:column}

/* ============================================================
   PAGE SYSTEM — show/hide pages
============================================================ */
.page{display:none;flex-direction:column;min-height:100vh}
.page.active{display:flex}

/* ============================================================
   HEADER / NAV
============================================================ */
.site-header{
  background:linear-gradient(135deg,var(--primary) 0%,var(--primary-light) 100%);
  color:white;padding:0 32px;
  box-shadow:0 2px 12px rgba(124,45,18,0.3);
  position:sticky;top:0;z-index:100;
}
.header-inner{
  max-width:1200px;margin:0 auto;height:64px;
  display:flex;align-items:center;justify-content:space-between;gap:16px;
}
.site-logo{
  font-family:'Playfair Display',Georgia,serif;
  font-size:1.15rem;color:white;text-decoration:none;
  white-space:nowrap;letter-spacing:.3px;cursor:pointer;
}
.site-nav{display:flex;align-items:center;gap:4px;flex-wrap:wrap}
.site-nav a{
  text-decoration:none;color:rgba(255,255,255,.82);
  font-weight:500;font-size:.875rem;padding:6px 13px;
  border-radius:6px;transition:background .18s,color .18s;
  white-space:nowrap;cursor:pointer;
}
.site-nav a:hover,.site-nav a.active{background:rgba(255,255,255,.18);color:white}
.site-nav a.nav-logout{background:rgba(255,255,255,.1);border:1px solid rgba(255,255,255,.25)}
.site-nav a.nav-logout:hover{background:rgba(255,255,255,.22)}

/* ============================================================
   LAYOUT
============================================================ */
.page-wrapper{flex:1;max-width:1200px;width:100%;margin:0 auto;padding:40px 24px}
.page-wrapper.narrow{max-width:700px}
.page-wrapper.medium{max-width:900px}
.page-wrapper.center{display:flex;align-items:center;justify-content:center;min-height:calc(100vh - 130px)}

.page-title{margin-bottom:32px}
.page-title h1{font-family:'Playfair Display',Georgia,serif;font-size:1.9rem;color:var(--primary);margin-bottom:6px}
.page-title p{color:var(--muted);font-size:.93rem}

/* ============================================================
   FOOTER
============================================================ */
.site-footer{background:var(--primary);color:rgba(255,255,255,.82);text-align:center;padding:16px 20px;font-size:.82rem;margin-top:auto}

/* ============================================================
   FORM CARD
============================================================ */
.form-card{background:var(--white);border-radius:var(--radius);padding:36px 40px;box-shadow:var(--shadow);border-top:4px solid var(--primary)}
.form-header{text-align:center;margin-bottom:28px}
.form-icon{font-size:2.2rem;display:block;margin-bottom:10px}
.form-header h1{font-family:'Playfair Display',Georgia,serif;font-size:1.75rem;color:var(--primary);margin-bottom:6px}
.form-header p{color:var(--muted);font-size:.9rem}

.form-group{margin-bottom:18px}
label{display:block;font-weight:600;font-size:.84rem;color:#444;margin-bottom:5px}
.required{color:#dc2626}

input[type=text],input[type=email],input[type=password],input[type=date],select,textarea{
  width:100%;padding:10px 14px;border-radius:7px;
  border:1.5px solid var(--border);
  font-family:'DM Sans',Arial,sans-serif;font-size:.93rem;
  color:var(--text);background:#fdfcfb;outline:none;
  transition:border-color .2s,box-shadow .2s;
}
input:focus,select:focus,textarea:focus{border-color:var(--primary);box-shadow:0 0 0 3px rgba(124,45,18,.1);background:var(--white)}
input::placeholder,textarea::placeholder{color:#bbb}
textarea{resize:vertical;min-height:120px}

.password-box{position:relative}
.password-box input{padding-right:46px}
.eye-toggle{position:absolute;right:13px;top:50%;transform:translateY(-50%);cursor:pointer;font-size:16px;user-select:none;opacity:.55;transition:opacity .2s}
.eye-toggle:hover{opacity:1}

.char-count{display:block;text-align:right;font-size:.76rem;color:#999;margin-top:3px}

/* ============================================================
   BUTTONS
============================================================ */
.btn-primary{
  display:inline-block;padding:11px 22px;
  background:linear-gradient(135deg,var(--primary),var(--primary-light));
  color:white;border:none;border-radius:7px;
  font-family:'DM Sans',Arial,sans-serif;font-size:.93rem;font-weight:600;
  cursor:pointer;text-decoration:none;
  transition:transform .15s,box-shadow .15s;letter-spacing:.2px;
}
.btn-primary:hover{background:linear-gradient(135deg,var(--primary-dark),var(--primary));transform:translateY(-1px);box-shadow:0 4px 16px rgba(124,45,18,.32)}
.btn-secondary{
  display:inline-block;padding:11px 22px;background:#f3f4f6;color:#555;
  border:1.5px solid #ddd;border-radius:7px;
  font-family:'DM Sans',Arial,sans-serif;font-size:.93rem;font-weight:500;
  cursor:pointer;text-decoration:none;transition:background .18s;
}
.btn-secondary:hover{background:#e5e7eb}
.form-actions{display:flex;gap:12px;margin-top:6px;flex-wrap:wrap}
.form-actions .btn-primary{flex:1;text-align:center}

/* ============================================================
   ALERT & TOAST
============================================================ */
.form-alert{padding:11px 14px;border-radius:7px;margin-bottom:16px;font-size:.88rem;font-weight:500}
.form-alert.error{background:#fef2f2;color:#991b1b;border:1px solid #fecaca}
.form-alert.success{background:#f0fdf4;color:#166534;border:1px solid #bbf7d0}
.toast{position:fixed;bottom:28px;right:28px;padding:12px 20px;border-radius:8px;font-size:.88rem;font-weight:500;color:white;z-index:9999;box-shadow:0 4px 16px rgba(0,0,0,.15);animation:toastIn .3s ease}
.toast.success{background:#16a34a}
.toast.error{background:#dc2626}
@keyframes toastIn{from{opacity:0;transform:translateY(10px)}to{opacity:1;transform:translateY(0)}}

/* ============================================================
   BADGE ITEM CARDS (Notices / Announcements)
============================================================ */
.item-list{display:flex;flex-direction:column;gap:18px}
.item-card{background:var(--white);border-radius:var(--radius);box-shadow:var(--shadow);display:flex;overflow:hidden;border-left:5px solid;transition:transform .2s,box-shadow .2s}
.item-card:hover{transform:translateY(-2px);box-shadow:var(--shadow-h)}
.item-badge{writing-mode:vertical-rl;text-orientation:mixed;transform:rotate(180deg);padding:14px 8px;font-size:.68rem;font-weight:700;letter-spacing:1.2px;text-transform:uppercase;color:white;min-width:32px;display:flex;align-items:center;justify-content:center;flex-shrink:0}
.item-body{padding:18px 22px;flex:1}
.item-meta{margin-bottom:7px}
.item-date{font-size:.79rem;color:#aaa;font-weight:500}
.item-body h3{font-family:'Playfair Display',Georgia,serif;font-size:1.08rem;color:var(--primary);margin-bottom:7px}
.item-body p{font-size:.88rem;color:#555;line-height:1.6}

.cat-meeting{border-left-color:var(--primary)} .cat-meeting .item-badge{background:var(--primary)}
.cat-report{border-left-color:#d97706}         .cat-report .item-badge{background:#d97706}
.cat-deadline{border-left-color:#dc2626}        .cat-deadline .item-badge{background:#dc2626}
.cat-general{border-left-color:#16a34a}         .cat-general .item-badge{background:#16a34a}
.cat-high{border-left-color:#dc2626}            .cat-high .item-badge{background:#dc2626}
.cat-medium{border-left-color:#d97706}          .cat-medium .item-badge{background:#d97706}
.cat-low{border-left-color:#16a34a}             .cat-low .item-badge{background:#16a34a}
.cat-holiday{border-left-color:#0891b2}         .cat-holiday .item-badge{background:#0891b2}
.cat-event{border-left-color:#7c3aed}           .cat-event .item-badge{background:#7c3aed}
.cat-guideline{border-left-color:#d97706}       .cat-guideline .item-badge{background:#d97706}

/* ============================================================
   DASHBOARD CARDS
============================================================ */
.dash-grid{display:grid;grid-template-columns:repeat(auto-fit,minmax(260px,1fr));gap:22px}
.dash-card{background:var(--white);border-radius:var(--radius);padding:28px 24px;box-shadow:var(--shadow);border-left:4px solid var(--primary);display:flex;gap:18px;align-items:flex-start;transition:transform .2s,box-shadow .2s}
.dash-card:hover{transform:translateY(-3px);box-shadow:var(--shadow-h)}
.dash-card .dc-icon{font-size:2rem;line-height:1;flex-shrink:0}
.dash-card h3{font-family:'Playfair Display',Georgia,serif;color:var(--primary);font-size:1.05rem;margin-bottom:7px}
.dash-card p{font-size:.87rem;color:#666;line-height:1.5;margin-bottom:14px}
.dash-card a{display:inline-block;padding:7px 15px;background:var(--primary);color:white;border-radius:6px;text-decoration:none;font-size:.84rem;font-weight:600;transition:background .2s,transform .15s;cursor:pointer}
.dash-card a:hover{background:var(--primary-dark);transform:translateX(2px)}

/* ============================================================
   STATS BAR
============================================================ */
.stats-bar{display:grid;grid-template-columns:repeat(auto-fit,minmax(130px,1fr));gap:16px;margin-bottom:36px}
.stat{background:var(--white);border-radius:var(--radius);padding:18px 20px;box-shadow:var(--shadow);text-align:center}
.stat .num{font-size:1.9rem;font-weight:700;color:var(--primary)}
.stat .lbl{font-size:.78rem;color:#aaa;margin-top:4px;letter-spacing:.3px}

/* ============================================================
   TABLE
============================================================ */
.table-wrapper{background:var(--white);border-radius:var(--radius);box-shadow:var(--shadow);overflow:hidden}
table{width:100%;border-collapse:collapse}
thead tr{background:var(--primary)}
th{color:white;padding:14px 16px;text-align:left;font-size:.87rem;font-weight:600;letter-spacing:.2px}
td{padding:13px 16px;border-bottom:1px solid #f0ebe6;font-size:.9rem;color:#444}
tbody tr:last-child td{border-bottom:none}
tbody tr:hover{background:#fdf8f6}
.td-actions{display:flex;gap:8px;flex-wrap:wrap}
.btn-table{padding:5px 12px;border-radius:5px;font-size:.8rem;font-weight:600;color:white;border:none;cursor:pointer;transition:opacity .2s,transform .15s}
.btn-table:hover{opacity:.88;transform:translateY(-1px)}
.btn-edit{background:var(--primary)}
.btn-delete{background:#9ca3af}
.btn-delete:hover{background:#6b7280}

/* ============================================================
   SEARCH BAR
============================================================ */
.search-bar{margin-bottom:18px}
.search-bar input{width:100%;max-width:400px;padding:9px 14px;border:1.5px solid var(--border);border-radius:7px;font-family:'DM Sans',Arial,sans-serif;font-size:.9rem;outline:none;transition:border-color .2s}
.search-bar input:focus{border-color:var(--primary)}

/* ============================================================
   LOGOUT CARD
============================================================ */
.logout-card{background:var(--white);max-width:400px;width:100%;padding:44px 40px;border-radius:var(--radius);box-shadow:0 8px 32px rgba(124,45,18,.1);border-top:4px solid var(--primary);text-align:center}
.logout-card .lc-icon{font-size:2.6rem;margin-bottom:14px}
.logout-card h2{font-family:'Playfair Display',Georgia,serif;color:var(--primary);font-size:1.55rem;margin-bottom:10px}
.logout-card p{color:var(--muted);font-size:.9rem;margin-bottom:28px}
.btn-group{display:flex;gap:12px;justify-content:center;flex-wrap:wrap}

/* ============================================================
   RESPONSIVE
============================================================ */
@media(max-width:640px){
  .site-header{padding:0 16px}
  .header-inner{height:auto;padding:12px 0;flex-wrap:wrap;gap:10px}
  .site-nav{flex-wrap:wrap}
  .page-wrapper{padding:24px 16px}
  .form-card{padding:24px 20px}
  .dash-card{flex-direction:column;gap:10px}
}
  </style>
</head>
<body>

<!-- ============================================================
     LOGIN PAGE (intern)
============================================================ -->
<div id="pg-login" class="page active">
  <header class="site-header">
    <div class="header-inner">
      <span class="site-logo">🎓 Internship Notice Board System</span>
    </div>
  </header>
  <main class="page-wrapper center">
    <div class="form-card" style="width:100%;max-width:430px;text-align:center">
      <span class="form-icon">🎓</span>
      <div class="form-header"><h1>Intern Login</h1><p>Enter your username and password to continue.</p></div>
      <form id="loginForm" onsubmit="doLogin(event)" style="text-align:left">
        <div class="form-group">
          <label for="l-user">Username</label>
          <input type="text" id="l-user" placeholder="Enter your username" required>
        </div>
        <div class="form-group">
          <label for="l-pass">Password</label>
          <div class="password-box">
            <input type="password" id="l-pass" placeholder="Enter your password" required>
            <span class="eye-toggle" onclick="togglePw('l-pass',this)">👁️</span>
          </div>
        </div>
        <div id="login-alert"></div>
        <div class="form-actions"><button type="submit" class="btn-primary" style="width:100%;text-align:center">Login</button></div>
        <p style="text-align:center;margin-top:14px;font-size:.88rem;color:#777">No account? <a onclick="nav('pg-register')" style="color:var(--primary);font-weight:600;cursor:pointer">Register here</a></p>
        <p style="text-align:center;margin-top:8px;font-size:.85rem;color:#aaa;border-top:1px solid #f0ebe6;padding-top:12px">Admin? <a onclick="nav('pg-admin-login')" style="color:var(--primary);font-weight:600;cursor:pointer">Admin Login →</a></p>
      </form>
    </div>
  </main>
  <footer class="site-footer"><p>&copy; 2026 Internship Notice Board System. All rights reserved.</p></footer>
</div>

<!-- ============================================================
     REGISTER PAGE
============================================================ -->
<div id="pg-register" class="page">
  <header class="site-header">
    <div class="header-inner">
      <span class="site-logo">🎓 Internship Notice Board System</span>
    </div>
  </header>
  <main class="page-wrapper narrow" style="padding-top:36px;padding-bottom:36px">
    <div class="form-card">
      <span class="form-icon">📝</span>
      <div class="form-header"><h1>Create Account</h1><p>Fill in the details below to register as an intern.</p></div>
      <form id="registerForm" onsubmit="doRegister(event)" style="text-align:left">
        <div class="form-group">
          <label>Full Name <span class="required">*</span></label>
          <input type="text" id="r-name" placeholder="Enter your full name" required>
        </div>
        <div class="form-group">
          <label>Email Address <span class="required">*</span></label>
          <input type="email" id="r-email" placeholder="Enter your email" required>
        </div>
        <div class="form-group">
          <label>Username <span class="required">*</span></label>
          <input type="text" id="r-username" placeholder="Choose a username (min 3 chars)" required>
        </div>
        <div class="form-group">
          <label>Department <span class="required">*</span></label>
          <select id="r-dept" required>
            <option value="">-- Select Department --</option>
            <option>IT Department</option><option>Finance</option>
            <option>Human Resources</option><option>Marketing</option>
            <option>Operations</option><option>General</option>
          </select>
        </div>
        <div class="form-group">
          <label>Password <span class="required">*</span></label>
          <div class="password-box">
            <input type="password" id="r-pass" placeholder="Min. 6 characters" required>
            <span class="eye-toggle" onclick="togglePw('r-pass',this)">👁️</span>
          </div>
        </div>
        <div class="form-group">
          <label>Confirm Password <span class="required">*</span></label>
          <div class="password-box">
            <input type="password" id="r-pass2" placeholder="Re-enter your password" required>
            <span class="eye-toggle" onclick="togglePw('r-pass2',this)">👁️</span>
          </div>
        </div>
        <div id="reg-alert"></div>
        <div class="form-actions">
          <button type="submit" class="btn-primary">Create Account</button>
          <button type="reset" class="btn-secondary">Clear</button>
        </div>
        <p style="text-align:center;margin-top:14px;font-size:.88rem;color:#777">Already registered? <a onclick="nav('pg-login')" style="color:var(--primary);font-weight:600;cursor:pointer">Login</a></p>
      </form>
    </div>
  </main>
  <footer class="site-footer"><p>&copy; 2026 Internship Notice Board System. All rights reserved.</p></footer>
</div>

<!-- ============================================================
     INTERN HOME
============================================================ -->
<div id="pg-intern-home" class="page">
  <header class="site-header">
    <div class="header-inner">
      <a class="site-logo" onclick="nav('pg-intern-home')">🎓 Intern Portal</a>
      <nav class="site-nav">
        <a id="inav-home" onclick="nav('pg-intern-home')" class="active">Home</a>
        <a id="inav-notices" onclick="nav('pg-notices')">Notices</a>
        <a id="inav-ann" onclick="nav('pg-announcements')">Announcements</a>
        <a onclick="nav('pg-logout')" class="nav-logout">Logout</a>
      </nav>
    </div>
  </header>
  <main class="page-wrapper">
    <div class="page-title">
      <h1>Welcome, <span id="intern-greet">Intern</span>! 👋</h1>
      <p>Your internship dashboard. Stay updated with the latest notices and announcements.</p>
    </div>
    <div class="dash-grid">
      <div class="dash-card"><div class="dc-icon">📋</div><div><h3>Notice Board</h3><p>View important internship notices about meetings, deadlines, reports, and guidelines.</p><a onclick="nav('pg-notices')">View Notices →</a></div></div>
      <div class="dash-card"><div class="dc-icon">📢</div><div><h3>Announcements</h3><p>Check the latest important announcements posted by the administration.</p><a onclick="nav('pg-announcements')">View Announcements →</a></div></div>
      <div class="dash-card"><div class="dc-icon">👤</div><div><h3>My Profile</h3><p>View your internship information, account details and department assignment.</p><a onclick="showProfileModal()">View Profile →</a></div></div>
    </div>
  </main>
  <footer class="site-footer"><p>&copy; 2026 Internship Notice Board System. All rights reserved.</p></footer>
</div>

<!-- ============================================================
     NOTICE BOARD
============================================================ -->
<div id="pg-notices" class="page">
  <header class="site-header">
    <div class="header-inner">
      <a class="site-logo" onclick="nav('pg-intern-home')">🎓 Intern Portal</a>
      <nav class="site-nav">
        <a onclick="nav('pg-intern-home')">Home</a>
        <a onclick="nav('pg-notices')" class="active">Notices</a>
        <a onclick="nav('pg-announcements')">Announcements</a>
        <a onclick="nav('pg-logout')" class="nav-logout">Logout</a>
      </nav>
    </div>
  </header>
  <main class="page-wrapper medium">
    <div class="page-title"><h1>📋 Notice Board</h1><p>Latest notices posted by management. Stay informed and up to date.</p></div>
    <div class="item-list" id="notices-list">
      <div class="item-card cat-meeting"><div class="item-badge">Meeting</div><div class="item-body"><div class="item-meta"><span class="item-date">📅 20th February 2026</span></div><h3>Intern Meeting Reminder</h3><p>All interns are required to attend a meeting at the conference hall by 10:00 AM. Please be punctual and bring your weekly progress report.</p></div></div>
      <div class="item-card cat-report"><div class="item-badge">Report</div><div class="item-body"><div class="item-meta"><span class="item-date">📅 22nd February 2026</span></div><h3>Submission of Weekly Report</h3><p>Please ensure that your weekly internship report is submitted to your supervisor before Friday 4:00 PM. Late submissions will not be accepted.</p></div></div>
      <div class="item-card cat-deadline"><div class="item-badge">Deadline</div><div class="item-body"><div class="item-meta"><span class="item-date">📅 28th February 2026</span></div><h3>Final Project Submission Deadline</h3><p>All interns must submit their final internship project by end of day on 28th February 2026. Contact HR if you require an extension.</p></div></div>
      <div class="item-card cat-general"><div class="item-badge">General</div><div class="item-body"><div class="item-meta"><span class="item-date">📅 18th February 2026</span></div><h3>Office Conduct Guidelines</h3><p>All interns are reminded to maintain professional conduct within the workplace at all times. Please refer to the intern handbook for full guidelines.</p></div></div>
    </div>
  </main>
  <footer class="site-footer"><p>&copy; 2026 Internship Notice Board System. All rights reserved.</p></footer>
</div>

<!-- ============================================================
     ANNOUNCEMENTS
============================================================ -->
<div id="pg-announcements" class="page">
  <header class="site-header">
    <div class="header-inner">
      <a class="site-logo" onclick="nav('pg-intern-home')">🎓 Intern Portal</a>
      <nav class="site-nav">
        <a onclick="nav('pg-intern-home')">Home</a>
        <a onclick="nav('pg-notices')">Notices</a>
        <a onclick="nav('pg-announcements')" class="active">Announcements</a>
        <a onclick="nav('pg-logout')" class="nav-logout">Logout</a>
      </nav>
    </div>
  </header>
  <main class="page-wrapper medium">
    <div class="page-title"><h1>📢 Announcements</h1><p>Stay updated with the latest important announcements from the administration.</p></div>
    <div class="item-list" id="announcements-list">
      <div class="item-card cat-high"><div class="item-badge">Urgent</div><div class="item-body"><div class="item-meta"><span class="item-date">📅 30th March 2026</span></div><h3>Internship Completion Ceremony</h3><p>All interns are invited to attend the internship completion ceremony at the main hall by 12:00 PM. Attendance is mandatory. Please dress formally and arrive on time.</p></div></div>
      <div class="item-card cat-guideline"><div class="item-badge">Guideline</div><div class="item-body"><div class="item-meta"><span class="item-date">📅 25th February 2026</span></div><h3>New Internship Guidelines</h3><p>Please review the updated internship guidelines available at the HR office. All interns are expected to comply with the new policies starting 1st March 2026.</p></div></div>
      <div class="item-card cat-holiday"><div class="item-badge">Holiday</div><div class="item-body"><div class="item-meta"><span class="item-date">📅 1st March 2026</span></div><h3>Public Holiday Notice</h3><p>The office will be closed on the stated date due to a public holiday. All intern activities and assignments are suspended. Resume on the next working day.</p></div></div>
      <div class="item-card cat-event"><div class="item-badge">Event</div><div class="item-body"><div class="item-meta"><span class="item-date">📅 15th March 2026</span></div><h3>Intern Networking Event</h3><p>Join us for an afternoon networking event with senior staff and fellow interns. Light refreshments provided. Venue: Company Boardroom, 3:00 PM.</p></div></div>
    </div>
  </main>
  <footer class="site-footer"><p>&copy; 2026 Internship Notice Board System. All rights reserved.</p></footer>
</div>

<!-- ============================================================
     INTERN LOGOUT
============================================================ -->
<div id="pg-logout" class="page" style="align-items:center;justify-content:center">
  <div class="logout-card">
    <div class="lc-icon">👋</div>
    <h2>Logged Out Successfully</h2>
    <p>Thank you for using the Internship Notice Board System. See you next time!</p>
    <div class="btn-group">
      <a onclick="doLogout()" class="btn-primary" style="cursor:pointer">Confirm Logout</a>
      <a onclick="nav('pg-intern-home')" class="btn-secondary" style="cursor:pointer">Stay Logged In</a>
    </div>
  </div>
</div>

<!-- ============================================================
     ADMIN LOGIN
============================================================ -->
<div id="pg-admin-login" class="page">
  <header class="site-header">
    <div class="header-inner">
      <span class="site-logo">🔐 Admin Panel — Internship Notice Board</span>
    </div>
  </header>
  <main class="page-wrapper center">
    <div class="form-card" style="width:100%;max-width:430px;text-align:center">
      <span class="form-icon">🔐</span>
      <div class="form-header"><h1>Administrator Login</h1><p>Enter your admin username and password to access the dashboard.</p></div>
      <form id="adminLoginForm" onsubmit="doAdminLogin(event)" style="text-align:left">
        <div class="form-group">
          <label>Username</label>
          <input type="text" id="al-user" placeholder="Admin username" required>
        </div>
        <div class="form-group">
          <label>Password</label>
          <div class="password-box">
            <input type="password" id="al-pass" placeholder="Admin password" required>
            <span class="eye-toggle" onclick="togglePw('al-pass',this)">👁️</span>
          </div>
        </div>
        <div id="admin-login-alert"></div>
        <div class="form-actions"><button type="submit" class="btn-primary" style="width:100%;text-align:center">Login to Dashboard</button></div>
        <p style="text-align:center;margin-top:14px;font-size:.87rem;color:#aaa;border-top:1px solid #f0ebe6;padding-top:12px">
          <a onclick="nav('pg-login')" style="color:var(--primary);font-weight:600;cursor:pointer">← Back to Intern Login</a>
        </p>
      </form>
    </div>
  </main>
  <footer class="site-footer"><p>&copy; 2026 Internship Notice Board System. All rights reserved.</p></footer>
</div>

<!-- ============================================================
     ADMIN DASHBOARD
============================================================ -->
<div id="pg-admin-dash" class="page">
  <header class="site-header">
    <div class="header-inner">
      <a class="site-logo" onclick="nav('pg-admin-dash')">🔐 Admin Panel</a>
      <nav class="site-nav">
        <a onclick="nav('pg-admin-dash')" class="active" id="anav-dash">Dashboard</a>
        <a onclick="nav('pg-create-notice')" id="anav-cn">Create Notice</a>
        <a onclick="nav('pg-create-ann')" id="anav-ca">Create Announcement</a>
        <a onclick="nav('pg-manage-users')" id="anav-mu">Manage Interns</a>
        <a onclick="nav('pg-admin-logout')" class="nav-logout">Logout</a>
      </nav>
    </div>
  </header>
  <main class="page-wrapper">
    <div class="page-title"><h1>Administrator Dashboard</h1><p>Welcome back, Admin. Manage notices, announcements, and intern records from here.</p></div>
    <div class="stats-bar">
      <div class="stat"><div class="num" id="stat-notices">4</div><div class="lbl">Active Notices</div></div>
      <div class="stat"><div class="num" id="stat-ann">4</div><div class="lbl">Announcements</div></div>
      <div class="stat"><div class="num" id="stat-interns">3</div><div class="lbl">Registered Interns</div></div>
      <div class="stat"><div class="num">2026</div><div class="lbl">Current Year</div></div>
    </div>
    <div class="dash-grid">
      <div class="dash-card"><div class="dc-icon">📋</div><div><h3>Post a New Notice</h3><p>Create and publish notices for interns about meetings, reports, deadlines, and guidelines.</p><a onclick="nav('pg-create-notice')">Create Notice →</a></div></div>
      <div class="dash-card"><div class="dc-icon">📢</div><div><h3>Post a New Announcement</h3><p>Add important announcements immediately visible to all registered interns.</p><a onclick="nav('pg-create-ann')">Create Announcement →</a></div></div>
      <div class="dash-card"><div class="dc-icon">👥</div><div><h3>Manage Interns</h3><p>View, edit, and remove intern accounts. Search by name, department, or email.</p><a onclick="nav('pg-manage-users')">Manage Interns →</a></div></div>
    </div>
  </main>
  <footer class="site-footer"><p>&copy; 2026 Internship Notice Board System. All rights reserved.</p></footer>
</div>

<!-- ============================================================
     CREATE NOTICE
============================================================ -->
<div id="pg-create-notice" class="page">
  <header class="site-header">
    <div class="header-inner">
      <a class="site-logo" onclick="nav('pg-admin-dash')">🔐 Admin Panel</a>
      <nav class="site-nav">
        <a onclick="nav('pg-admin-dash')">Dashboard</a>
        <a onclick="nav('pg-create-notice')" class="active">Create Notice</a>
        <a onclick="nav('pg-create-ann')">Create Announcement</a>
        <a onclick="nav('pg-manage-users')">Manage Interns</a>
        <a onclick="nav('pg-admin-logout')" class="nav-logout">Logout</a>
      </nav>
    </div>
  </header>
  <main class="page-wrapper narrow">
    <div class="form-card">
      <span class="form-icon">📋</span>
      <div class="form-header"><h1>Create New Notice</h1><p>Fill in the details below to publish a notice for all interns.</p></div>
      <form id="noticeForm" onsubmit="submitNotice(event)">
        <div class="form-group"><label>Notice Title <span class="required">*</span></label><input type="text" id="n-title" placeholder="Enter notice title" required></div>
        <div class="form-group"><label>Date <span class="required">*</span></label><input type="date" id="n-date" required></div>
        <div class="form-group">
          <label>Category <span class="required">*</span></label>
          <select id="n-cat" required><option value="">-- Select Category --</option><option value="meeting">Meeting</option><option value="report">Report</option><option value="deadline">Deadline</option><option value="general">General</option></select>
        </div>
        <div class="form-group">
          <label>Notice Description <span class="required">*</span></label>
          <textarea id="n-desc" placeholder="Enter notice details here..." required maxlength="500"></textarea>
          <span class="char-count" id="n-count">0 / 500 characters</span>
        </div>
        <div id="notice-alert"></div>
        <div class="form-actions">
          <button type="submit" class="btn-primary">📋 Publish Notice</button>
          <button type="reset" class="btn-secondary" onclick="document.getElementById('n-count').textContent='0 / 500 characters'">Clear</button>
        </div>
      </form>
    </div>
  </main>
  <footer class="site-footer"><p>&copy; 2026 Internship Notice Board System. All rights reserved.</p></footer>
</div>

<!-- ============================================================
     CREATE ANNOUNCEMENT
============================================================ -->
<div id="pg-create-ann" class="page">
  <header class="site-header">
    <div class="header-inner">
      <a class="site-logo" onclick="nav('pg-admin-dash')">🔐 Admin Panel</a>
      <nav class="site-nav">
        <a onclick="nav('pg-admin-dash')">Dashboard</a>
        <a onclick="nav('pg-create-notice')">Create Notice</a>
        <a onclick="nav('pg-create-ann')" class="active">Create Announcement</a>
        <a onclick="nav('pg-manage-users')">Manage Interns</a>
        <a onclick="nav('pg-admin-logout')" class="nav-logout">Logout</a>
      </nav>
    </div>
  </header>
  <main class="page-wrapper narrow">
    <div class="form-card">
      <span class="form-icon">📢</span>
      <div class="form-header"><h1>Create New Announcement</h1><p>Fill in the details below to publish an announcement to all interns.</p></div>
      <form id="annForm" onsubmit="submitAnn(event)">
        <div class="form-group"><label>Announcement Title <span class="required">*</span></label><input type="text" id="a-title" placeholder="Enter announcement title" required></div>
        <div class="form-group"><label>Publish Date <span class="required">*</span></label><input type="date" id="a-date" required></div>
        <div class="form-group">
          <label>Category <span class="required">*</span></label>
          <select id="a-cat" required><option value="">-- Select Category --</option><option value="general">General</option><option value="event">Event</option><option value="holiday">Holiday</option><option value="guideline">Guideline</option><option value="urgent">Urgent</option></select>
        </div>
        <div class="form-group">
          <label>Priority Level <span class="required">*</span></label>
          <select id="a-pri" required><option value="">-- Select Priority --</option><option value="high">🔴 High</option><option value="medium">🟡 Medium</option><option value="low">🟢 Low</option></select>
        </div>
        <div class="form-group">
          <label>Announcement Details <span class="required">*</span></label>
          <textarea id="a-desc" placeholder="Enter announcement details here..." required maxlength="500"></textarea>
          <span class="char-count" id="a-count">0 / 500 characters</span>
        </div>
        <div id="ann-alert"></div>
        <div class="form-actions">
          <button type="submit" class="btn-primary">📢 Publish Announcement</button>
          <button type="reset" class="btn-secondary" onclick="document.getElementById('a-count').textContent='0 / 500 characters'">Clear</button>
        </div>
      </form>
    </div>
  </main>
  <footer class="site-footer"><p>&copy; 2026 Internship Notice Board System. All rights reserved.</p></footer>
</div>

<!-- ============================================================
     MANAGE USERS
============================================================ -->
<div id="pg-manage-users" class="page">
  <header class="site-header">
    <div class="header-inner">
      <a class="site-logo" onclick="nav('pg-admin-dash')">🔐 Admin Panel</a>
      <nav class="site-nav">
        <a onclick="nav('pg-admin-dash')">Dashboard</a>
        <a onclick="nav('pg-create-notice')">Create Notice</a>
        <a onclick="nav('pg-create-ann')">Create Announcement</a>
        <a onclick="nav('pg-manage-users')" class="active">Manage Interns</a>
        <a onclick="nav('pg-admin-logout')" class="nav-logout">Logout</a>
      </nav>
    </div>
  </header>
  <main class="page-wrapper">
    <div class="page-title"><h1>Manage Registered Interns</h1><p>View, edit, and remove intern accounts from the system.</p></div>
    <div class="search-bar"><input type="text" id="mu-search" placeholder="🔍  Search by name, email, or department..." oninput="filterUsers()"></div>
    <div class="table-wrapper">
      <table><thead><tr><th>#</th><th>Full Name</th><th>Email</th><th>Department</th><th>Username</th><th>Actions</th></tr></thead>
      <tbody id="users-tbody"></tbody></table>
    </div>
  </main>
  <footer class="site-footer"><p>&copy; 2026 Internship Notice Board System. All rights reserved.</p></footer>
</div>

<!-- ============================================================
     ADMIN LOGOUT
============================================================ -->
<div id="pg-admin-logout" class="page" style="align-items:center;justify-content:center">
  <div class="logout-card">
    <div class="lc-icon">🔐</div>
    <h2>Admin Logged Out</h2>
    <p>You have been safely logged out of the Admin Dashboard.</p>
    <div class="btn-group">
      <a onclick="doAdminLogout()" class="btn-primary" style="cursor:pointer">Confirm Logout</a>
      <a onclick="nav('pg-admin-dash')" class="btn-secondary" style="cursor:pointer">Back to Dashboard</a>
    </div>
  </div>
</div>

<!-- ============================================================
     PROFILE MODAL
============================================================ -->
<div id="profile-modal" style="display:none;position:fixed;inset:0;background:rgba(0,0,0,.45);z-index:500;align-items:center;justify-content:center">
  <div style="background:white;border-radius:12px;padding:36px 32px;max-width:420px;width:90%;box-shadow:0 8px 40px rgba(0,0,0,.2);border-top:4px solid var(--primary);position:relative">
    <button onclick="closeProfileModal()" style="position:absolute;top:14px;right:16px;background:none;border:none;font-size:1.3rem;cursor:pointer;color:#999">✕</button>
    <div style="text-align:center;margin-bottom:20px">
      <div style="font-size:3rem;margin-bottom:10px">👤</div>
      <h2 style="font-family:'Playfair Display',Georgia,serif;color:var(--primary);font-size:1.4rem" id="pm-name">—</h2>
    </div>
    <div style="display:grid;gap:10px">
      <div style="background:#faf7f4;border-radius:7px;padding:10px 14px"><span style="font-size:.75rem;color:#aaa;font-weight:600;text-transform:uppercase;letter-spacing:.4px">Username</span><div style="font-weight:600;color:#333;margin-top:2px" id="pm-user">—</div></div>
      <div style="background:#faf7f4;border-radius:7px;padding:10px 14px"><span style="font-size:.75rem;color:#aaa;font-weight:600;text-transform:uppercase;letter-spacing:.4px">Email</span><div style="font-weight:600;color:#333;margin-top:2px" id="pm-email">—</div></div>
      <div style="background:#faf7f4;border-radius:7px;padding:10px 14px"><span style="font-size:.75rem;color:#aaa;font-weight:600;text-transform:uppercase;letter-spacing:.4px">Department</span><div style="font-weight:600;color:#333;margin-top:2px" id="pm-dept">—</div></div>
    </div>
  </div>
</div>

<script>
/* ============================================================
   STATE
============================================================ */
let currentUser  = null;
let isAdmin      = false;

// Intern user store (simulates DB)
const users = [
  {id:1, fullname:'Jane Doe',    email:'jane@example.com',  username:'jane',  password:'pass123', department:'IT Department'},
  {id:2, fullname:'John Smith',  email:'john@example.com',  username:'john',  password:'pass123', department:'Finance'},
  {id:3, fullname:'Amara Nkosi', email:'amara@example.com', username:'amara', password:'pass123', department:'Human Resources'},
];

// Dynamic notices & announcements stores
const noticesStore = [
  {id:1, title:'Intern Meeting Reminder',       date:'2026-02-20', cat:'meeting',  desc:'All interns are required to attend a meeting at the conference hall by 10:00 AM. Please be punctual and bring your weekly progress report.'},
  {id:2, title:'Submission of Weekly Report',   date:'2026-02-22', cat:'report',   desc:'Please ensure that your weekly internship report is submitted to your supervisor before Friday 4:00 PM. Late submissions will not be accepted.'},
  {id:3, title:'Final Project Submission',      date:'2026-02-28', cat:'deadline', desc:'All interns must submit their final internship project by end of day. Contact HR if you require an extension.'},
  {id:4, title:'Office Conduct Guidelines',     date:'2026-02-18', cat:'general',  desc:'All interns are reminded to maintain professional conduct within the workplace at all times.'},
];

const annStore = [
  {id:1, title:'Internship Completion Ceremony', date:'2026-03-30', cat:'high',      priority:'high',   desc:'All interns are invited to attend the completion ceremony at the main hall by 12:00 PM. Attendance is mandatory. Please dress formally.'},
  {id:2, title:'New Internship Guidelines',       date:'2026-02-25', cat:'guideline', priority:'medium', desc:'Please review the updated internship guidelines at the HR office. All interns must comply starting 1st March 2026.'},
  {id:3, title:'Public Holiday Notice',           date:'2026-03-01', cat:'holiday',   priority:'low',    desc:'The office will be closed on the stated date due to a public holiday. All intern activities are suspended.'},
  {id:4, title:'Intern Networking Event',         date:'2026-03-15', cat:'event',     priority:'medium', desc:'Join us for a networking event with senior staff and fellow interns. Light refreshments provided. Venue: Company Boardroom, 3:00 PM.'},
];

/* ============================================================
   NAVIGATION
============================================================ */
function nav(pageId) {
  document.querySelectorAll('.page').forEach(p => p.classList.remove('active'));
  document.getElementById(pageId).classList.add('active');
  window.scrollTo(0,0);

  // Re-render dynamic pages on visit
  if (pageId === 'pg-notices')       renderNotices();
  if (pageId === 'pg-announcements') renderAnnouncements();
  if (pageId === 'pg-manage-users')  renderUsers();
  if (pageId === 'pg-admin-dash')    updateStats();
  if (pageId === 'pg-create-notice') initCharCounter('n-desc','n-count',500);
  if (pageId === 'pg-create-ann')    initCharCounter('a-desc','a-count',500);
}

/* ============================================================
   PASSWORD TOGGLE
============================================================ */
function togglePw(id, el) {
  const inp = document.getElementById(id);
  if (!inp) return;
  inp.type = inp.type === 'password' ? 'text' : 'password';
  el.textContent = inp.type === 'password' ? '👁️' : '🙈';
}

/* ============================================================
   ALERTS
============================================================ */
function showInlineAlert(containerId, msg, type) {
  const c = document.getElementById(containerId);
  if (!c) return;
  c.innerHTML = `<div class="form-alert ${type}" style="margin-bottom:14px">${msg}</div>`;
  setTimeout(() => { c.innerHTML = ''; }, 5000);
}

function showToast(msg, type) {
  const ex = document.querySelector('.toast');
  if (ex) ex.remove();
  const t = document.createElement('div');
  t.className = 'toast ' + (type||'success');
  t.textContent = msg;
  document.body.appendChild(t);
  setTimeout(() => t.remove(), 3500);
}

/* ============================================================
   CHAR COUNTER
============================================================ */
function initCharCounter(taId, ctId, max) {
  const ta = document.getElementById(taId);
  const ct = document.getElementById(ctId);
  if (!ta||!ct) return;
  ta.removeEventListener('input', ta._ccHandler);
  ta._ccHandler = () => {
    const l = ta.value.length;
    ct.textContent = l+' / '+max+' characters';
    ct.style.color = l > max*.9 ? (l>=max?'#dc2626':'#d97706') : '#999';
  };
  ta.addEventListener('input', ta._ccHandler);
  ta._ccHandler();
}

/* ============================================================
   LOGIN
============================================================ */
function doLogin(e) {
  e.preventDefault();
  const u = document.getElementById('l-user').value.trim();
  const p = document.getElementById('l-pass').value.trim();
  if (!u || !p) { showInlineAlert('login-alert','Please fill in all fields.','error'); return; }
  if (u.length < 2) { showInlineAlert('login-alert','Username must be at least 2 characters.','error'); return; }
  if (p.length < 1) { showInlineAlert('login-alert','Please enter a password.','error'); return; }

  // Accept any username/password — check registered users first, otherwise create a session user
  let found = users.find(x => x.username.toLowerCase() === u.toLowerCase());
  if (!found) {
    // Not in DB — create a temporary session user with the entered name
    found = { id: Date.now(), fullname: u, email: u + '@intern.com', username: u, password: p, department: 'General' };
  }

  currentUser = found;
  isAdmin = false;
  document.getElementById('intern-greet').textContent = found.fullname.split(' ')[0];
  document.getElementById('loginForm').reset();
  nav('pg-intern-home');
  showToast('Welcome, ' + found.fullname + '! 👋', 'success');
}

function doLogout() {
  currentUser = null;
  nav('pg-login');
  showToast('Logged out successfully.','success');
}

/* ============================================================
   REGISTER
============================================================ */
function doRegister(e) {
  e.preventDefault();
  const name = document.getElementById('r-name').value.trim();
  const email= document.getElementById('r-email').value.trim();
  const user = document.getElementById('r-username').value.trim();
  const dept = document.getElementById('r-dept').value;
  const pass = document.getElementById('r-pass').value;
  const conf = document.getElementById('r-pass2').value;

  if (!name||!email||!user||!dept||!pass||!conf) { showInlineAlert('reg-alert','All fields are required.','error'); return; }
  if (!/^[^\s@]+@[^\s@]+\.[a-zA-Z]{2,}$/.test(email)) { showInlineAlert('reg-alert','Please enter a valid email address.','error'); return; }
  if (user.length < 3) { showInlineAlert('reg-alert','Username must be at least 3 characters.','error'); return; }
  if (pass.length < 6) { showInlineAlert('reg-alert','Password must be at least 6 characters.','error'); return; }
  if (pass !== conf) { showInlineAlert('reg-alert','Passwords do not match.','error'); return; }
  if (users.find(x=>x.username===user)) { showInlineAlert('reg-alert','That username is already taken. Please choose another.','error'); return; }
  if (users.find(x=>x.email===email))   { showInlineAlert('reg-alert','An account with that email already exists.','error'); return; }

  const newUser = {id: users.length+1, fullname:name, email:email, username:user, password:pass, department:dept};
  users.push(newUser);
  updateStats();
  showInlineAlert('reg-alert','Account created successfully! Redirecting to login...','success');
  document.getElementById('registerForm').reset();
  setTimeout(() => nav('pg-login'), 1800);
}

/* ============================================================
   ADMIN LOGIN / LOGOUT
============================================================ */
function doAdminLogin(e) {
  e.preventDefault();
  const u = document.getElementById('al-user').value.trim();
  const p = document.getElementById('al-pass').value.trim();
  if (!u || !p) { showInlineAlert('admin-login-alert','Please fill in all fields.','error'); return; }
  if (u.length < 2) { showInlineAlert('admin-login-alert','Username must be at least 2 characters.','error'); return; }

  // Accept any username and password for admin login
  isAdmin = true;
  document.getElementById('adminLoginForm').reset();
  nav('pg-admin-dash');
  showToast('Welcome back, Admin ' + u + '! 🔐', 'success');
}

function doAdminLogout() {
  isAdmin = false;
  nav('pg-login');
  showToast('Admin logged out successfully.','success');
}

/* ============================================================
   SUBMIT NOTICE
============================================================ */
function submitNotice(e) {
  e.preventDefault();
  const title = document.getElementById('n-title').value.trim();
  const date  = document.getElementById('n-date').value;
  const cat   = document.getElementById('n-cat').value;
  const desc  = document.getElementById('n-desc').value.trim();
  if (!title||!date||!cat||!desc) { showInlineAlert('notice-alert','All fields are required.','error'); return; }
  if (desc.length > 500) { showInlineAlert('notice-alert','Description must not exceed 500 characters.','error'); return; }

  const d = new Date(date);
  const label = d.toLocaleDateString('en-GB',{day:'numeric',month:'long',year:'numeric'});
  noticesStore.unshift({id: noticesStore.length+1, title, date, cat, desc, label});
  updateStats();
  document.getElementById('noticeForm').reset();
  document.getElementById('n-count').textContent = '0 / 500 characters';
  showInlineAlert('notice-alert','✅ Notice published successfully! View it on the Notice Board.','success');
}

/* ============================================================
   SUBMIT ANNOUNCEMENT
============================================================ */
function submitAnn(e) {
  e.preventDefault();
  const title = document.getElementById('a-title').value.trim();
  const date  = document.getElementById('a-date').value;
  const cat   = document.getElementById('a-cat').value;
  const pri   = document.getElementById('a-pri').value;
  const desc  = document.getElementById('a-desc').value.trim();
  if (!title||!date||!cat||!pri||!desc) { showInlineAlert('ann-alert','All fields are required.','error'); return; }
  if (desc.length > 500) { showInlineAlert('ann-alert','Description must not exceed 500 characters.','error'); return; }

  annStore.unshift({id: annStore.length+1, title, date, cat: pri, priority:pri, catLabel:cat, desc});
  updateStats();
  document.getElementById('annForm').reset();
  document.getElementById('a-count').textContent = '0 / 500 characters';
  showInlineAlert('ann-alert','✅ Announcement published successfully! View it on the Announcements page.','success');
}

/* ============================================================
   RENDER NOTICES
============================================================ */
function renderNotices() {
  const container = document.getElementById('notices-list');
  container.innerHTML = noticesStore.map(n => {
    const d = new Date(n.date);
    const label = n.label || d.toLocaleDateString('en-GB',{day:'numeric',month:'long',year:'numeric'});
    return `<div class="item-card cat-${n.cat}">
      <div class="item-badge">${n.cat.charAt(0).toUpperCase()+n.cat.slice(1)}</div>
      <div class="item-body">
        <div class="item-meta"><span class="item-date">📅 ${label}</span></div>
        <h3>${escHtml(n.title)}</h3>
        <p>${escHtml(n.desc)}</p>
      </div>
    </div>`;
  }).join('');
}

/* ============================================================
   RENDER ANNOUNCEMENTS
============================================================ */
function renderAnnouncements() {
  const catLabels = {high:'Urgent',medium:'General',low:'General',event:'Event',holiday:'Holiday',guideline:'Guideline',general:'General'};
  const container = document.getElementById('announcements-list');
  container.innerHTML = annStore.map(a => {
    const d = new Date(a.date);
    const label = d.toLocaleDateString('en-GB',{day:'numeric',month:'long',year:'numeric'});
    const badge = a.catLabel ? (a.catLabel.charAt(0).toUpperCase()+a.catLabel.slice(1)) : catLabels[a.cat]||'Notice';
    return `<div class="item-card cat-${a.cat}">
      <div class="item-badge">${badge}</div>
      <div class="item-body">
        <div class="item-meta"><span class="item-date">📅 ${label}</span></div>
        <h3>${escHtml(a.title)}</h3>
        <p>${escHtml(a.desc)}</p>
      </div>
    </div>`;
  }).join('');
}

/* ============================================================
   RENDER / MANAGE USERS
============================================================ */
function renderUsers() {
  const tbody = document.getElementById('users-tbody');
  tbody.innerHTML = users.map((u,i) => `
    <tr data-id="${u.id}">
      <td>${i+1}</td>
      <td>${escHtml(u.fullname)}</td>
      <td>${escHtml(u.email)}</td>
      <td>${escHtml(u.department)}</td>
      <td>${escHtml(u.username)}</td>
      <td class="td-actions">
        <button class="btn-table btn-edit"   onclick="editUser(${u.id})">✏️ Edit</button>
        <button class="btn-table btn-delete" onclick="deleteUser(${u.id})">🗑️ Delete</button>
      </td>
    </tr>`).join('');
}

function filterUsers() {
  const q = document.getElementById('mu-search').value.toLowerCase();
  document.querySelectorAll('#users-tbody tr').forEach(r => {
    r.style.display = r.textContent.toLowerCase().includes(q) ? '' : 'none';
  });
}

function deleteUser(id) {
  if (!confirm('Are you sure you want to remove this intern?')) return;
  const i = users.findIndex(u => u.id === id);
  if (i === -1) return;
  const name = users[i].fullname;
  users.splice(i, 1);
  renderUsers();
  updateStats();
  showToast(name + ' has been removed.', 'success');
}

function editUser(id) {
  const u = users.find(x => x.id === id);
  if (!u) return;
  const n = prompt('Full Name:', u.fullname);     if (n===null) return;
  const e = prompt('Email:', u.email);             if (e===null) return;
  const d = prompt('Department:', u.department);   if (d===null) return;
  u.fullname   = n.trim() || u.fullname;
  u.email      = e.trim() || u.email;
  u.department = d.trim() || u.department;
  renderUsers();
  showToast('Intern record updated successfully.', 'success');
}

/* ============================================================
   STATS
============================================================ */
function updateStats() {
  const sn = document.getElementById('stat-notices');
  const sa = document.getElementById('stat-ann');
  const si = document.getElementById('stat-interns');
  if (sn) sn.textContent = noticesStore.length;
  if (sa) sa.textContent = annStore.length;
  if (si) si.textContent = users.length;
}

/* ============================================================
   PROFILE MODAL
============================================================ */
function showProfileModal() {
  if (!currentUser) return;
  document.getElementById('pm-name').textContent  = currentUser.fullname;
  document.getElementById('pm-user').textContent  = currentUser.username;
  document.getElementById('pm-email').textContent = currentUser.email;
  document.getElementById('pm-dept').textContent  = currentUser.department;
  const m = document.getElementById('profile-modal');
  m.style.display = 'flex';
}

function closeProfileModal() {
  document.getElementById('profile-modal').style.display = 'none';
}

document.getElementById('profile-modal').addEventListener('click', function(e) {
  if (e.target === this) closeProfileModal();
});

/* ============================================================
   UTILITY
============================================================ */
function escHtml(s) {
  return String(s).replace(/&/g,'&amp;').replace(/</g,'&lt;').replace(/>/g,'&gt;').replace(/"/g,'&quot;');
}

// Init
updateStats();
</script>
</body>
</html>