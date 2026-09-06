/**
 * Module 2 - Frontend Validation & Form Submission
 * Library Book Management System
 */

'use strict';

// ── Toast ──────────────────────────────────────────
function showToast(msg, type = 'success') {
  const icons = { success: '✓', error: '✕' };
  const container = document.getElementById('toast-container');
  const toast = document.createElement('div');
  toast.className = `toast ${type}`;
  toast.innerHTML = `<span class="toast-icon">${icons[type]}</span><span class="toast-msg">${msg}</span>`;
  container.appendChild(toast);
  requestAnimationFrame(() => requestAnimationFrame(() => toast.classList.add('show')));
  setTimeout(() => {
    toast.classList.remove('show');
    toast.classList.add('hide');
    setTimeout(() => toast.remove(), 400);
  }, 3500);
}

// ── Field Validation ───────────────────────────────
const rules = {
  title:  { pattern: /^[a-zA-Z\s]+$/, msg: 'Title must contain only alphabetic characters and spaces.' },
  author: { pattern: /^[a-zA-Z\s]+$/, msg: 'Author name must contain only alphabetic characters.' },
  price:  { pattern: null,            msg: 'Price must be a number greater than 0.' }
};

function validateField(input) {
  const name  = input.name;
  const value = input.value.trim();
  const errEl = document.getElementById(`${name}-error`);
  const okEl  = document.getElementById(`${name}-ok`);

  input.classList.remove('is-invalid', 'is-valid');
  if (errEl) errEl.classList.remove('error');
  if (okEl)  okEl.classList.remove('success');

  let valid = false;

  if (!value) {
    if (errEl) { errEl.textContent = `${capitalize(name)} is required.`; errEl.classList.add('error'); }
    input.classList.add('is-invalid');
    return false;
  }

  if (name === 'price') {
    valid = !isNaN(value) && parseFloat(value) > 0;
  } else {
    valid = rules[name].pattern.test(value);
  }

  if (valid) {
    input.classList.add('is-valid');
    if (okEl) okEl.classList.add('success');
  } else {
    input.classList.add('is-invalid');
    if (errEl) { errEl.textContent = rules[name].msg; errEl.classList.add('error'); }
  }

  return valid;
}

function capitalize(str) { return str.charAt(0).toUpperCase() + str.slice(1); }

function validateAll() {
  const fields = document.querySelectorAll('#add-form .form-control[name]');
  let allValid = true;
  fields.forEach(f => { if (!validateField(f)) allValid = false; });
  return allValid;
}

// ── Live Validation ────────────────────────────────
document.addEventListener('input', e => {
  if (e.target.matches('#add-form .form-control[name]')) validateField(e.target);
});

// ── Form Submit ────────────────────────────────────
async function submitForm() {
  if (!validateAll()) {
    showToast('Please fix the errors before submitting.', 'error');
    return;
  }

  const btn     = document.getElementById('submit-btn');
  const spinner = document.getElementById('btn-spinner');
  const btnText = document.getElementById('btn-text');

  btn.disabled       = true;
  spinner.style.display = 'block';
  btnText.textContent   = 'Adding…';

  const form = document.getElementById('add-form');
  const fd   = new FormData(form);

  try {
    const res  = await fetch('php/insert.php', { method: 'POST', body: fd });
    const data = await res.json();

    if (data.success) {
      showToast('Book added successfully! 🎉', 'success');
      form.reset();
      form.querySelectorAll('.form-control').forEach(i => i.classList.remove('is-valid', 'is-invalid'));
      form.querySelectorAll('.validation-msg').forEach(m => m.classList.remove('error', 'success'));
      updateCount();
    } else {
      showToast(data.message || 'Failed to add book.', 'error');
    }
  } catch (e) {
    showToast('Server error. Make sure XAMPP is running.', 'error');
  }

  btn.disabled          = false;
  spinner.style.display = 'none';
  btnText.textContent   = 'Add Book';
}

// ── Reset Form ─────────────────────────────────────
function resetForm() {
  const form = document.getElementById('add-form');
  form.reset();
  form.querySelectorAll('.form-control').forEach(i => i.classList.remove('is-valid', 'is-invalid'));
  form.querySelectorAll('.validation-msg').forEach(m => m.classList.remove('error', 'success'));
}

// ── Book Count (sidebar) ───────────────────────────
async function updateCount() {
  try {
    const res  = await fetch('php/count.php');
    const data = await res.json();
    const el   = document.getElementById('sidebar-count');
    if (el && data.count !== undefined) el.textContent = data.count;
  } catch (_) {}
}

document.addEventListener('DOMContentLoaded', updateCount);
