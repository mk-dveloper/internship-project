<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <title>LibraryMS — Module 2: Add New Book</title>
  <link rel="preconnect" href="https://fonts.googleapis.com" />
  <link href="https://fonts.googleapis.com/css2?family=Playfair+Display:wght@400;600;700&family=DM+Sans:wght@300;400;500;600&display=swap" rel="stylesheet" />
  <link rel="stylesheet" href="css/style.css" />
</head>
<body>

<?php include 'php/db_connect.php'; ?>

<!-- Toast Container -->
<div id="toast-container"></div>

<!-- ── NAVBAR ── -->
<nav class="navbar">
  <a class="navbar-brand" href="#">
    <div class="navbar-logo">📚</div>
    <div>
      <div class="navbar-title">Library<span>MS</span></div>
      <div class="navbar-sub">Book Management System</div>
    </div>
  </a>
  <div class="module-badge">📦 Module 2</div>
</nav>

<!-- ── LAYOUT ── -->
<div class="layout">

  <!-- SIDEBAR -->
  <aside class="sidebar">
    <div class="sidebar-label">Module 2</div>
    <nav class="sidebar-nav">
      <a href="#" class="active">➕ Add New Book</a>
      <a href="#rules-section">📋 Validation Rules</a>
      <a href="#checklist-section">✅ Checklist</a>
    </nav>

    <div class="sidebar-label" style="margin-top:1.5rem;">Quick Info</div>
    <div style="padding: 0 1.5rem;">
      <div style="display:flex; justify-content:space-between; font-size:0.8rem; color:var(--text-secondary); padding:0.4rem 0; border-bottom:1px solid var(--border);">
        <span>Books Added</span>
        <span style="color:var(--accent); font-weight:600;" id="sidebar-count">—</span>
      </div>
      <div style="display:flex; justify-content:space-between; font-size:0.8rem; color:var(--text-secondary); padding:0.4rem 0;">
        <span>DB Status</span>
        <span style="color:#4caf7d; font-weight:600;">
          <?php echo $conn->connect_error ? '❌ Error' : '✅ Active'; ?>
        </span>
      </div>
    </div>

    <div class="sidebar-bottom">
      <strong style="color:var(--text-secondary);">Submission Deadline</strong><br/>
      Sep 06, 2026 @ 4:00 PM<br/>
      Starts: Aug 31, 2026
    </div>
  </aside>

  <!-- MAIN -->
  <main class="main">

    <!-- PAGE HEADER -->
    <div class="page-header">
      <div class="breadcrumb">
        <span>📚 LibraryMS</span>
        <span style="color:var(--text-muted)">›</span>
        <span>Module 2 — Add New Book</span>
      </div>
      <h1>Add New <em>Book</em></h1>
      <p>Fill in the form below to insert a new book record into the database.</p>
    </div>

    <!-- ADD BOOK FORM CARD -->
    <div class="form-card">
      <div class="form-card-header">
        <span style="font-size:1.3rem;">📗</span>
        <div class="form-card-title">New Book Entry Form</div>
      </div>

      <div class="form-card-body">
        <form id="add-form" onsubmit="return false;" novalidate>

          <!-- Title -->
          <div class="form-group">
            <label class="form-label" for="title">
              Book Title <span class="req">*</span>
            </label>
            <div class="input-wrap">
              <input
                type="text"
                class="form-control"
                id="title"
                name="title"
                placeholder="e.g. Introduction to Algorithms"
                autocomplete="off"
              />
              <span class="input-icon">📖</span>
            </div>
            <div class="validation-msg error" id="title-error"></div>
            <div class="validation-msg success" id="title-ok">✓ Looks good!</div>
            <span class="hint">Only alphabetic characters and spaces allowed.</span>
          </div>

          <!-- Author -->
          <div class="form-group">
            <label class="form-label" for="author">
              Author Name <span class="req">*</span>
            </label>
            <div class="input-wrap">
              <input
                type="text"
                class="form-control"
                id="author"
                name="author"
                placeholder="e.g. Thomas Cormen"
                autocomplete="off"
              />
              <span class="input-icon">✍️</span>
            </div>
            <div class="validation-msg error" id="author-error"></div>
            <div class="validation-msg success" id="author-ok">✓ Looks good!</div>
            <span class="hint">Only alphabetic characters allowed.</span>
          </div>

          <!-- Price -->
          <div class="form-group" style="margin-bottom:0;">
            <label class="form-label" for="price">
              Price (USD) <span class="req">*</span>
            </label>
            <div class="input-wrap">
              <input
                type="number"
                class="form-control"
                id="price"
                name="price"
                placeholder="e.g. 49.99"
                step="0.01"
                min="0.01"
              />
              <span class="input-icon">💵</span>
            </div>
            <div class="validation-msg error" id="price-error"></div>
            <div class="validation-msg success" id="price-ok">✓ Valid price!</div>
            <span class="hint">Must be a number greater than 0.</span>
          </div>

        </form>
      </div>

      <!-- Form Footer -->
      <div class="form-footer">
        <button class="btn btn-primary" id="submit-btn" onclick="submitForm()">
          <div class="spinner" id="btn-spinner"></div>
          <span id="btn-text">📗 Add Book</span>
        </button>
        <button class="btn btn-outline" onclick="resetForm()">↺ Reset</button>
      </div>
    </div>

    <!-- VALIDATION RULES CARD -->
    <div class="rules-card" id="rules-section">
      <div class="rules-title">📋 Validation Rules</div>
      <div class="rule-item">
        <span class="rule-dot">▶</span>
        <span><strong>Book Title:</strong> Must contain only alphabetic characters (A–Z, a–z) and spaces. Numbers and symbols are not allowed.</span>
      </div>
      <div class="rule-item">
        <span class="rule-dot">▶</span>
        <span><strong>Author Name:</strong> Must contain only alphabetic characters. No numbers or special characters.</span>
      </div>
      <div class="rule-item">
        <span class="rule-dot">▶</span>
        <span><strong>Price:</strong> Must be a valid numeric value strictly greater than 0. Decimals are allowed (e.g. 49.99).</span>
      </div>
      <div class="rule-item">
        <span class="rule-dot">▶</span>
        <span><strong>All fields</strong> are required. Validation is enforced on both frontend (JavaScript) and backend (PHP).</span>
      </div>
    </div>

    <!-- MODULE CHECKLIST -->
    <div class="checklist-card" id="checklist-section">
      <div class="rules-title">✅ Module 2 Checklist</div>
      <ul class="checklist">
        <li><span class="check-icon">✅</span> HTML form with Title, Author, and Price fields</li>
        <li><span class="check-icon">✅</span> Frontend validation using JavaScript (live, on input)</li>
        <li><span class="check-icon">✅</span> Backend validation using PHP regex and numeric checks</li>
        <li><span class="check-icon">✅</span> Title: alphabetic characters and spaces only</li>
        <li><span class="check-icon">✅</span> Author: alphabetic characters only</li>
        <li><span class="check-icon">✅</span> Price: number strictly greater than 0</li>
        <li><span class="check-icon">✅</span> Successful submission inserts record into MySQL database</li>
        <li><span class="check-icon">✅</span> Toast notifications for success and error feedback</li>
        <li><span class="check-icon">✅</span> Form resets after successful submission</li>
        <li><span class="check-icon">✅</span> AJAX-based form submission (no page reload)</li>
      </ul>
    </div>

  </main>
</div>

<!-- FOOTER -->
<footer>
  <span>Library Book Management System — Module 2: Add New Book</span>
  <span>Deadline: Sep 06, 2026 @ 4:00 PM</span>
</footer>

<script src="js/app.js"></script>
</body>
</html>
