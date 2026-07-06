// Fungsi membuat template kartu item
function createItemCard(item) {
  // Cek jika kita berada di dalam folder pages atau root untuk path detail.html
  const detailPath = window.location.pathname.includes('pages/') ? 'detail.html' : 'pages/detail.html';
  
  return `
    <div class="bg-white rounded-2xl border border-slate-100 overflow-hidden card-hover cursor-pointer" onclick="location.href='${detailPath}?id=${item.id}'">
      <div class="aspect-[4/3] bg-gradient-to-br ${item.color} flex items-center justify-center relative">
        <i data-lucide="${item.icon||'package'}" class="w-12 h-12 text-slate-400 opacity-50"></i>
        <span class="absolute top-3 right-3 ${item.status==='Lost'?'badge-lost':'badge-found'} px-2.5 py-1 rounded-full text-[10px] font-semibold">${item.status}</span>
      </div>
      <div class="p-4">
        <h3 class="font-heading font-semibold text-sm text-txt mb-1 truncate">${item.name}</h3>
        <div class="flex items-center gap-1.5 text-xs text-txt-secondary">
          <i data-lucide="map-pin" class="w-3 h-3"></i> ${item.location}
        </div>
      </div>
    </div>
  `;
}

// Fungsi Render untuk halaman Home (Recent Items)
function renderRecent() {
  const grid = document.getElementById('recent-grid');
  if (grid) {
    grid.innerHTML = items.slice(0,4).map(createItemCard).join('');
    lucide.createIcons();
  }
}

// Fungsi Render untuk halaman Explore
function renderExplore(data) {
  const grid = document.getElementById('explore-grid');
  if (grid) {
    grid.innerHTML = data.map(createItemCard).join('');
    lucide.createIcons();
  }
}

// Fungsi untuk Mobile Menu Toggle
function toggleMobileMenu() {
  document.getElementById('mobile-menu').classList.toggle('hidden');
}

// Fungsi Render untuk halaman Dashboard
function renderDashboard(filter = 'all') {
  const list = document.getElementById('dashboard-list');
  if (list) {
    let filteredItems = dashboardItems;
    if (filter !== 'all') {
      filteredItems = dashboardItems.filter(item => item.status === filter);
    }
    
    list.innerHTML = filteredItems.map(createDashboardCard).join('');
    lucide.createIcons();
  }
}

// Fungsi membuat template kartu dashboard
function createDashboardCard(item) {
  const detailPath = window.location.pathname.includes('pages/') ? 'detail.html' : 'pages/detail.html';
  
  return `
    <div class="bg-white rounded-2xl border border-slate-100 overflow-hidden card-hover">
      <div class="p-6">
        <div class="flex items-start justify-between mb-4">
          <div class="flex-1">
            <h3 class="font-heading font-semibold text-lg text-txt mb-1">${item.name}</h3>
            <div class="flex items-center gap-1.5 text-sm text-txt-secondary mb-2">
              <i data-lucide="map-pin" class="w-4 h-4"></i> ${item.location}
            </div>
            <div class="flex items-center gap-1.5 text-sm text-txt-secondary">
              <i data-lucide="calendar" class="w-4 h-4"></i> ${item.date}
            </div>
          </div>
          <span class="px-3 py-1 rounded-full text-xs font-semibold ${item.status==='Lost'?'bg-red-100 text-red-700':'bg-green-100 text-green-700'}">${item.status}</span>
        </div>
        
        <div class="flex items-center justify-between">
          <div class="flex items-center gap-4 text-sm text-txt-secondary">
            <div class="flex items-center gap-1">
              <i data-lucide="eye" class="w-4 h-4"></i> ${item.views}
            </div>
            <div class="flex items-center gap-1">
              <i data-lucide="message-circle" class="w-4 h-4"></i> ${item.responses}
            </div>
          </div>
          <a href="${detailPath}?id=${item.id}" class="text-brand font-medium text-sm hover:underline">View Details</a>
        </div>
      </div>
    </div>
  `;
}

// Fungsi Filter Dashboard
function filterDashboard(filter, button) {
  // Update active button
  document.querySelectorAll('.sidebar-item').forEach(btn => {
    btn.classList.remove('active', 'text-brand');
    btn.classList.add('text-txt-secondary');
  });
  button.classList.add('active', 'text-brand');
  button.classList.remove('text-txt-secondary');
  
  // Render filtered items
  renderDashboard(filter);
}