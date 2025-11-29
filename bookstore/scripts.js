// scripts.js

// Simple client-side validation for registration form
function validateRegisterForm() {
  const name = document.getElementById('name').value.trim();
  const password = document.getElementById('password').value;
  const email = document.getElementById('email').value.trim();
  const phone = document.getElementById('phone').value.trim();

  // Name: alphabetic (spaces allowed) and length >= 6
  const nameOK = /^[A-Za-z\s]{6,}$/.test(name);
  if (!nameOK) {
    alert('Name should contain only letters and be at least 6 characters long.');
    return false;
  }

  // Password length >= 6
  if (password.length < 6) {
    alert('Password should be at least 6 characters.');
    return false;
  }

  // Email standard check (HTML type=email already helps). Additional regex:
  const emailOK = /^[^\s@]+@[^\s@]+\.[^\s@]+$/.test(email);
  if (!emailOK) {
    alert('Please enter a valid email address.');
    return false;
  }

  // Phone: exactly 10 digits
  const phoneOK = /^\d{10}$/.test(phone);
  if (!phoneOK) {
    alert('Phone number must contain exactly 10 digits.');
    return false;
  }

  return true; // allow form submit
}

/* --- Cart Implementation (client-side using localStorage) --- */

const BOOKS = {
  'xml-bible': { id: 'xml-bible', title: 'XML Bible', price: 40.5 },
  'java2': { id: 'java2', title: 'Java 2', price: 35.5 },
  'ai': { id: 'ai', title: 'AI', price: 63.0 },
  'html24': { id: 'html24', title: 'HTML in 24 hours', price: 50.0 }
};

function getCart() {
  try {
    return JSON.parse(localStorage.getItem('cart') || '{}');
  } catch (e) { return {}; }
}

function saveCart(cart) {
  localStorage.setItem('cart', JSON.stringify(cart));
}

function addToCart(bookId) {
  const cart = getCart();
  cart[bookId] = (cart[bookId] || 0) + 1;
  saveCart(cart);
  alert('Added to cart');
  // Optionally update cart UI
}

function renderCart() {
  const cart = getCart();
  const container = document.getElementById('cart-contents');
  if (!container) return;
  container.innerHTML = '';
  const table = document.createElement('table');
  table.style.width = '100%';
  table.style.borderCollapse = 'collapse';
  let total = 0;
  for (const id in cart) {
    const qty = cart[id];
    const book = BOOKS[id];
    if (!book) continue;
    const amount = book.price * qty;
    total += amount;
    const row = document.createElement('tr');
    row.innerHTML = `<td style="padding:8px;border-bottom:1px solid #eee">${book.title}</td>
      <td style="padding:8px;border-bottom:1px solid #eee;text-align:right">$${book.price.toFixed(2)}</td>
      <td style="padding:8px;border-bottom:1px solid #eee;text-align:center">${qty}</td>
      <td style="padding:8px;border-bottom:1px solid #eee;text-align:right">$${amount.toFixed(2)}</td>`;
    table.appendChild(row);
  }
  if (Object.keys(cart).length === 0) {
    container.innerHTML = '<p>Your cart is empty.</p>';
    document.getElementById('cart-total').textContent = '';
    return;
  }
  container.appendChild(table);
  document.getElementById('cart-total').textContent = 'Total amount - $' + total.toFixed(2);
}

// Render cart on pages with cart
document.addEventListener('DOMContentLoaded', function() {
  renderCart();
});

