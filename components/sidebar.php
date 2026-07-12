<?php
$currentFile = basename($_SERVER['SCRIPT_NAME']);
$currentDir = basename(dirname($_SERVER['SCRIPT_NAME']));
$currentPage = ($currentDir === 'docs') ? $currentFile : 'index.php';

function isActive($pageFile): string {
    global $currentPage;
    return $currentPage === $pageFile ? 'active' : '';
}
?>
<aside class="sidebar" id="sidebar">
    <nav class="sidebar-nav">
        <div class="sidebar-section">
            <h3 class="sidebar-heading">Getting Started</h3>
            <ul class="sidebar-links">
                <li><a href="/docs/index.php" class="sidebar-link <?= isActive('index.php') ?>">
                    <svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round"><circle cx="12" cy="12" r="10"/><polyline points="12 6 12 12 16 14"/></svg>
                    Introduction
                </a></li>
            </ul>
        </div>
        <div class="sidebar-section">
            <h3 class="sidebar-heading">API Endpoints</h3>
            <ul class="sidebar-links">
                <li><a href="/docs/register.php" class="sidebar-link <?= isActive('register.php') ?>">
                    <svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round"><path d="M16 21v-2a4 4 0 00-4-4H5a4 4 0 00-4 4v2"/><circle cx="8.5" cy="7" r="4"/><line x1="20" y1="8" x2="20" y2="14"/><line x1="23" y1="11" x2="17" y2="11"/></svg>
                    User Registration
                </a></li>
                <li><a href="/docs/login.php" class="sidebar-link <?= isActive('login.php') ?>">
                    <svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round"><path d="M15 3h4a2 2 0 012 2v14a2 2 0 01-2 2h-4"/><polyline points="10 17 15 12 10 7"/><line x1="15" y1="12" x2="3" y2="12"/></svg>
                    User Login
                </a></li>
                <li><a href="/docs/admin-login.php" class="sidebar-link <?= isActive('admin-login.php') ?>">
                    <svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round"><path d="M12 22s8-4 8-10V5l-8-3-8 3v7c0 6 8 10 8 10z"/></svg>
                    Admin Login
                </a></li>
            </ul>
        </div>
        <div class="sidebar-section">
            <h3 class="sidebar-heading">Testing</h3>
            <ul class="sidebar-links">
                <li><a href="/docs/testing.php" class="sidebar-link <?= isActive('testing.php') ?>">
                    <svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round"><path d="M4 19.5A2.5 2.5 0 016.5 17H20"/><path d="M6.5 2H20v20H6.5A2.5 2.5 0 014 19.5v-15A2.5 2.5 0 016.5 2z"/></svg>
                    Postman Testing Guide
                </a></li>
            </ul>
        </div>
        <div class="sidebar-section">
            <h3 class="sidebar-heading">Resources</h3>
            <ul class="sidebar-links">
                <li><a href="/docs/index.php#endpoints" class="sidebar-link">
                    <svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round"><line x1="8" y1="6" x2="21" y2="6"/><line x1="8" y1="12" x2="21" y2="12"/><line x1="8" y1="18" x2="21" y2="18"/><line x1="3" y1="6" x2="3.01" y2="6"/><line x1="3" y1="12" x2="3.01" y2="12"/><line x1="3" y1="18" x2="3.01" y2="18"/></svg>
                    Quick Reference
                </a></li>
            </ul>
        </div>
    </nav>
    <div class="sidebar-footer">
        <div class="sidebar-footer-text">
            <svg width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M12 22s8-4 8-10V5l-8-3-8 3v7c0 6 8 10 8 10z"/></svg>
            <span>API Status: Active</span>
        </div>
    </div>
</aside>
