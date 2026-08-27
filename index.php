<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <title>LibraryMS — Module 1</title>
  <link rel="preconnect" href="https://fonts.googleapis.com" />
  <link href="https://fonts.googleapis.com/css2?family=Playfair+Display:wght@400;600;700&family=DM+Sans:wght@300;400;500;600&display=swap" rel="stylesheet" />
  
  <link rel="stylesheet" href="style.css" />
</head>
<body>

<?php include 'php/db_connect.php'; ?>

<!-- NAVBAR -->
<nav class="navbar">
  <a class="navbar-brand" href="#">
    <div class="navbar-logo">📚</div>
    <div>
      <div class="navbar-title">Library<span>MS</span></div>
      <div class="navbar-sub">Book Management System</div>
    </div>
  </a>
  <div class="module-badge">📦 Module 1</div>
</nav>

<!-- LAYOUT -->
<div class="layout">

  <!-- SIDEBAR -->
  <aside class="sidebar">
    <div class="sidebar-label">Module 1</div>
    <nav class="sidebar-nav">
      <a href="#" class="active">🏠 Dashboard</a>
      <a href="#db-section">🗄️ Database Setup</a>
      <a href="#table-section">📋 Table Structure</a>
      <a href="#checklist-section">✅ Checklist</a>
    </nav>
    <div class="sidebar-bottom">
      <strong style="color:var(--text-secondary);">Submission Deadline</strong><br/>
      Aug 30, 2026 @ 4:00 PM<br/>
      Starts: Aug 24, 2026
    </div>
  </aside>

  <!-- MAIN -->
  <main class="main">

    <!-- PAGE HEADER -->
    <div class="page-header">
      <div class="breadcrumb">
        <span>📚 LibraryMS</span>
        <span style="color:var(--text-muted)">›</span>
        <span>Module 1 — Database Setup & UI Layout</span>
      </div>
      <h1>Module <em>1</em> Submission</h1>
      <p>Database setup, project structure, DB connection, and base UI theme.</p>
    </div>

    <!-- STAT CARDS -->
    <div class="cards-grid">
      <div class="info-card" style="animation-delay:0.05s">
        <div class="card-icon gold">🗄️</div>
        <div class="card-info">
          <div class="label">Database</div>
          <div class="value" style="font-size:1rem;">internship_project</div>
        </div>
      </div>
      <div class="info-card" style="animation-delay:0.1s">
        <div class="card-icon green">📋</div>
        <div class="card-info">
          <div class="label">Tables</div>
          <div class="value">1</div>
        </div>
      </div>
      <div class="info-card" style="animation-delay:0.15s">
        <div class="card-icon blue">🔢</div>
        <div class="card-info">
          <div class="label">Columns</div>
          <div class="value">5</div>
        </div>
      </div>
      <div class="info-card" style="animation-delay:0.2s">
        <div class="card-icon red">🔗</div>
        <div class="card-info">
          <div class="label">Connection</div>
          <div class="value" style="font-size:1rem; color:#4caf7d;">Active</div>
        </div>
      </div>
    </div>

    <!-- DB CONNECTION STATUS -->
    <div class="section-card" id="db-section">
      <div class="section-card-header">
        <div class="section-card-title">🔌 Database Connection Status</div>
      </div>
      <div class="section-card-body">
        <?php if (!$conn->connect_error): ?>
          <div class="db-status connected">
            <div class="dot"></div>
            Connected successfully to <strong>internship_project</strong> on localhost (MySQL via XAMPP)
          </div>
        <?php else: ?>
          <div class="db-status error">
            <div class="dot"></div>
            Connection failed: <?php echo $conn->connect_error; ?>
          </div>
        <?php endif; ?>
      </div>
    </div>

    <!-- TABLE STRUCTURE -->
    <div class="section-card" id="table-section">
      <div class="section-card-header">
        <div class="section-card-title">📋 Table Structure — <code style="color:var(--accent); font-size:0.9rem;">books</code></div>
      </div>
      <div class="section-card-body" style="padding:0; overflow-x:auto;">
        <table class="table-structure">
          <thead>
            <tr>
              <th>Column</th>
              <th>Data Type</th>
              <th>Constraint</th>
              <th>Description</th>
            </tr>
          </thead>
          <tbody>
            <tr>
              <td><strong style="color:var(--text-primary);">id</strong></td>
              <td>INT</td>
              <td>
                <span class="badge badge-pk">PRIMARY KEY</span>
                <span class="badge badge-ai">AUTO_INCREMENT</span>
              </td>
              <td>Unique identifier for each book</td>
            </tr>
            <tr>
              <td><strong style="color:var(--text-primary);">title</strong></td>
              <td>VARCHAR(100)</td>
              <td><span class="badge badge-nn">NOT NULL</span></td>
              <td>Title of the book</td>
            </tr>
            <tr>
              <td><strong style="color:var(--text-primary);">author</strong></td>
              <td>VARCHAR(100)</td>
              <td><span class="badge badge-nn">NOT NULL</span></td>
              <td>Author name</td>
            </tr>
            <tr>
              <td><strong style="color:var(--text-primary);">price</strong></td>
              <td>DECIMAL(10,2)</td>
              <td><span class="badge badge-nn">NOT NULL</span></td>
              <td>Price of the book in USD</td>
            </tr>
            <tr>
              <td><strong style="color:var(--text-primary);">created_at</strong></td>
              <td>TIMESTAMP</td>
              <td>DEFAULT NOW()</td>
              <td>Record creation timestamp</td>
            </tr>
          </tbody>
        </table>
      </div>
    </div>

    <!-- MODULE CHECKLIST -->
    <div class="section-card" id="checklist-section">
      <div class="section-card-header">
        <div class="section-card-title">✅ Module 1 Checklist</div>
      </div>
      <div class="section-card-body">
        <ul class="checklist">
          <li><span class="check-icon">✅</span> MySQL database created: <code>internship_project</code></li>
          <li><span class="check-icon">✅</span> Table <code>books</code> created with all required fields</li>
          <li><span class="check-icon">✅</span> Primary key, NOT NULL, and AUTO_INCREMENT constraints applied</li>
          <li><span class="check-icon">✅</span> <code>db_connect.php</code> — database connection file created</li>
          <li><span class="check-icon">✅</span> Connection tested and verified as active</li>
          <li><span class="check-icon">✅</span> Base UI layout with navbar, sidebar, and dark theme implemented</li>
          <li><span class="check-icon">✅</span> Project folder structure organized</li>
          <li><span class="check-icon">✅</span> Responsive design for desktop, tablet, and mobile</li>
        </ul>
      </div>
    </div>

  </main>
</div>

<!-- FOOTER -->
<footer>
  <span>Library Book Management System — Module 1</span>
  <span>Deadline: Aug 30, 2026 @ 4:00 PM</span>
</footer>

</body>
</html>
