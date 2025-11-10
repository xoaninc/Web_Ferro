// SCRIPT PRINCIPAL DEL BLOG

// Variables globales para el sistema de categorías
let selectedCategories = [];
let allContent = [];

document.addEventListener('DOMContentLoaded', function() {
    // Inicializar todas las funcionalidades
    initializeMobileMenu();
    initializeComments();
    initializeSearch();
    
    // Mostrar noticias si la función existe
    if (typeof displayNews === 'function') {
        displayNews();
    }
    
    // Aplicar configuración del autor
    applyAuthorConfig();
    
    // Inicializar sistema de categorías
    initializeCategorySystem();
});

// ==================================================================================
// MENÚ MÓVIL
// ==================================================================================

function initializeMobileMenu() {
    const mobileMenuToggle = document.querySelector('.mobile-menu-toggle');
    const navMenu = document.querySelector('.nav-menu');
    
    if (mobileMenuToggle && navMenu) {
        mobileMenuToggle.addEventListener('click', function() {
            navMenu.classList.toggle('active');
        });
    }
}

// ==================================================================================
// SISTEMA DE COMENTARIOS
// ==================================================================================

function initializeComments() {
    loadComments();
    
    // Configurar botón de envío si existe
    const submitButton = document.getElementById('submitComment');
    if (submitButton) {
        submitButton.addEventListener('click', addComment);
    }
}

function addComment() {
    const commentTextElement = document.getElementById('commentText');
    const authorElement = document.getElementById('commentAuthor');
    
    if (!commentTextElement || !authorElement) return;
    
    const commentText = commentTextElement.value.trim();
    const authorName = authorElement.value.trim();
    
    if (!commentText || !authorName) {
        showNotification('Por favor, completa todos los campos', 'error');
        return;
    }
    
    // Obtener comentarios existentes
    let comments = JSON.parse(localStorage.getItem('comments') || '[]');
    
    const newComment = {
        id: Date.now(),
        author: authorName,
        text: commentText,
        date: new Date().toISOString()
    };
    
    comments.push(newComment);
    localStorage.setItem('comments', JSON.stringify(comments));
    
    // Limpiar campos
    commentTextElement.value = '';
    authorElement.value = '';
    
    // Recargar comentarios
    loadComments();
    showNotification('Comentario añadido correctamente', 'success');
}

function loadComments() {
    const commentsContainer = document.getElementById('commentsList');
    if (!commentsContainer) return;
    
    const comments = JSON.parse(localStorage.getItem('comments') || '[]');
    
    if (comments.length === 0) {
        commentsContainer.innerHTML = '<p class="no-comments">No hay comentarios aún. ¡Sé el primero en comentar!</p>';
        return;
    }
    
    commentsContainer.innerHTML = comments.map(comment => `
        <div class="comment-item" data-id="${comment.id}">
            <div class="comment-header">
                <strong class="comment-author">${escapeHtml(comment.author)}</strong>
                <span class="comment-date">${formatDate(comment.date)}</span>
            </div>
            <p class="comment-text">${escapeHtml(comment.text)}</p>
        </div>
    `).reverse().join('');
}

// ==================================================================================
// SISTEMA DE BÚSQUEDA (llamadas a wp-search.js)
// ==================================================================================

function initializeSearch() {
    const searchInput = document.getElementById('searchInput');
    const searchButton = document.getElementById('searchButton');
    
    if (searchInput) {
        searchInput.addEventListener('input', function() {
            if (this.value.length > 2) {
                performSearch(this.value);
            } else if (this.value.length === 0) {
                hideSearchResults();
            }
        });
        
        searchInput.addEventListener('keypress', function(e) {
            if (e.key === 'Enter' && this.value.length > 0) {
                performSearch(this.value);
            }
        });
    }
    
    if (searchButton) {
        searchButton.addEventListener('click', function() {
            const query = searchInput.value;
            if (query && query.length > 0) {
                performSearch(query);
            }
        });
    }
}

// ==================================================================================
// SISTEMA DE CATEGORÍAS JERÁRQUICO
// ==================================================================================

function initializeCategorySystem() {
    loadAllContent();
    initializeFilterSystem();
    renderCategoryTree();
}

function loadAllContent() {
    // Cargar contenido desde WordPress o datos locales
    if (typeof addSampleContent === 'function') {
        addSampleContent();
    }
    
    // Cargar posts de WordPress si están disponibles
    if (typeof wpPosts !== 'undefined') {
        wpPosts.forEach(post => {
            allContent.push({
                id: post.id,
                title: post.title,
                content: post.content,
                categories: post.categories,
                date: post.date,
                author: post.author
            });
        });
    }
}

function initializeFilterSystem() {
    const filterButtons = document.querySelectorAll('.category-filter');
    
    filterButtons.forEach(button => {
        button.addEventListener('click', function() {
            const category = this.getAttribute('data-category');
            if (category) {
                this.classList.toggle('active');
                updateCategoryFilter(category);
            }
        });
    });
    
    // Botón para limpiar filtros
    const clearButton = document.getElementById('clearFilters');
    if (clearButton) {
        clearButton.addEventListener('click', clearCategoryFilters);
    }
}

function renderCategoryTree() {
    const categoryTree = document.getElementById('categoryTree');
    if (!categoryTree || typeof HIERARCHICAL_CATEGORIES === 'undefined') return;
    
    let html = '<ul class="category-tree-list">';
    
    Object.keys(HIERARCHICAL_CATEGORIES).forEach(key => {
        const category = HIERARCHICAL_CATEGORIES[key];
        html += `
            <li class="category-tree-item">
                <button class="category-toggle" onclick="toggleCategorySection('${key}')">
                    ${category.label}
                </button>
                ${category.subcategories ? renderSubcategories(category.subcategories) : ''}
            </li>
        `;
    });
    
    html += '</ul>';
    categoryTree.innerHTML = html;
}

function renderSubcategories(subcategories) {
    let html = '<ul class="subcategory-list">';
    
    subcategories.forEach(sub => {
        html += `
            <li class="subcategory-item">
                <button class="category-filter" data-category="${sub}" onclick="filterByCategory('${sub}')">
                    ${sub}
                </button>
            </li>
        `;
    });
    
    html += '</ul>';
    return html;
}

function toggleCategorySection(sectionName) {
    const section = document.querySelector(`[data-section="${sectionName}"]`);
    if (section) {
        section.classList.toggle('expanded');
    }
}

function updateCategoryFilter(category) {
    if (selectedCategories.includes(category)) {
        selectedCategories = selectedCategories.filter(c => c !== category);
    } else {
        selectedCategories.push(category);
    }
    applyCategoryFilter();
}

function applyCategoryFilter() {
    if (selectedCategories.length === 0) {
        hideFilterResults();
        return;
    }
    
    const filtered = allContent.filter(item =>
        selectedCategories.some(cat => item.categories.includes(cat))
    );
    
    displayFilterResults(filtered);
    
    // Mostrar categorías activas
    updateActiveFiltersDisplay();
}

function updateActiveFiltersDisplay() {
    const activeFiltersContainer = document.getElementById('activeFilters');
    if (!activeFiltersContainer) return;
    
    if (selectedCategories.length === 0) {
        activeFiltersContainer.innerHTML = '';
        return;
    }
    
    const html = selectedCategories.map(cat => `
        <span class="active-filter-tag">
            ${cat}
            <button class="remove-filter" onclick="updateCategoryFilter('${cat}')">&times;</button>
        </span>
    `).join('');
    
    activeFiltersContainer.innerHTML = `
        <div class="active-filters-wrapper">
            <strong>Filtros activos:</strong>
            ${html}
            <button class="clear-all-filters" onclick="clearCategoryFilters()">Limpiar todo</button>
        </div>
    `;
}

function displayFilterResults(content) {
    const resultsContainer = document.getElementById('filterResults');
    if (!resultsContainer) return;
    
    if (content.length === 0) {
        resultsContainer.innerHTML = '<p class="no-results">No se encontraron resultados para esta combinación de categorías.</p>';
        return;
    }
    
    resultsContainer.innerHTML = content.map(item => `
        <div class="filter-result-item" data-id="${item.id}">
            <h3 class="result-title">${item.title}</h3>
            <p class="result-preview">${item.content.substring(0, 200)}...</p>
            <div class="result-meta">
                <span class="result-date">${formatDate(item.date)}</span>
                ${item.author ? `<span class="result-author">Por ${item.author}</span>` : ''}
            </div>
            <button class="view-full-btn" onclick="viewFullContent('${item.id}')">Leer completo</button>
        </div>
    `).join('');
}

function hideFilterResults() {
    const resultsContainer = document.getElementById('filterResults');
    if (resultsContainer) {
        resultsContainer.innerHTML = '';
    }
}

function clearCategoryFilters() {
    selectedCategories = [];
    
    // Quitar clase 'active' de todos los botones de filtro
    document.querySelectorAll('.category-filter').forEach(btn => {
        btn.classList.remove('active');
    });
    
    hideFilterResults();
    updateActiveFiltersDisplay();
    showNotification('Filtros eliminados', 'info');
}

function viewFullContent(contentId) {
    const content = allContent.find(item => item.id == contentId);
    if (content) {
        showContentModal(content);
    }
}

function showContentModal(content) {
    const modal = document.createElement('div');
    modal.className = 'content-modal';
    modal.innerHTML = `
        <div class="modal-overlay"></div>
        <div class="modal-content">
            <button class="modal-close">&times;</button>
            <h2 class="modal-title">${content.title}</h2>
            <p class="modal-date">${formatDate(content.date)}</p>
            ${content.author ? `<p class="modal-author">Por ${content.author}</p>` : ''}
            <div class="modal-body">${content.content}</div>
        </div>
    `;
    
    document.body.appendChild(modal);
    document.body.style.overflow = 'hidden';
    
    // Cerrar modal
    const closeModal = () => {
        modal.remove();
        document.body.style.overflow = '';
    };
    
    modal.querySelector('.modal-close').addEventListener('click', closeModal);
    modal.querySelector('.modal-overlay').addEventListener('click', closeModal);
}

function formatDate(dateString) {
    const options = { year: 'numeric', month: 'long', day: 'numeric' };
    return new Date(dateString).toLocaleDateString('es-ES', options);
}

// ==================================================================================
// CALENDARIO FERROVIARIO - Solo funciones auxiliares
// ==================================================================================

function showClickableTooltip(event, dayElement) {
    hideTooltip(); // Limpiar tooltips anteriores
    
    const tooltip = document.createElement('div');
    tooltip.className = 'calendar-tooltip';
    tooltip.innerHTML = `
        <div class="tooltip-content">
            ${event.title}
            ${event.link ? `<a href="${event.link}" class="tooltip-link">Ver detalles</a>` : ''}
        </div>
    `;
    
    dayElement.appendChild(tooltip);
    
    // Posicionar tooltip
    const rect = dayElement.getBoundingClientRect();
    tooltip.style.top = `${rect.bottom + 5}px`;
    tooltip.style.left = `${rect.left}px`;
}

function hideTooltip() {
    const tooltips = document.querySelectorAll('.calendar-tooltip');
    tooltips.forEach(tooltip => tooltip.remove());
}

function addCalendarEvent(date, title, category, link) {
    const eventElement = document.createElement('div');
    eventElement.className = `calendar-event event-${category}`;
    eventElement.innerHTML = `<a href="${link || '#'}">${title}</a>`;
    
    const dayElement = document.querySelector(`[data-date="${date}"]`);
    if (dayElement) {
        dayElement.appendChild(eventElement);
        
        // Añadir evento click para tooltip
        dayElement.addEventListener('click', function(e) {
            showClickableTooltip({ title, link }, dayElement);
            e.stopPropagation();
        });
    }
}

// ==================================================================================
// FUNCIONES AUXILIARES
// ==================================================================================

function showNotification(message, type = 'info') {
    const notification = document.createElement('div');
    notification.className = `notification notification-${type}`;
    notification.innerHTML = `
        <span class="notification-icon">${getNotificationIcon(type)}</span>
        <span class="notification-message">${message}</span>
    `;
    
    document.body.appendChild(notification);
    
    setTimeout(() => {
        notification.classList.add('show');
    }, 10);
    
    setTimeout(() => {
        notification.classList.remove('show');
        setTimeout(() => notification.remove(), 300);
    }, 3000);
}

function getNotificationIcon(type) {
    const icons = {
        'success': '✓',
        'error': '✕',
        'warning': '⚠',
        'info': 'ℹ'
    };
    return icons[type] || icons.info;
}

function toggleCategories() {
    const categoryMenu = document.querySelector('.category-sidebar');
    if (categoryMenu) {
        categoryMenu.classList.toggle('active');
    }
}

function filterByCategory(category) {
    updateCategoryFilter(category);
}

function applyAuthorConfig() {
    if (typeof AUTHOR_CONFIG !== 'undefined') {
        const headerAuthor = document.querySelector('.site-author');
        if (headerAuthor && AUTHOR_CONFIG.name) {
            headerAuthor.textContent = AUTHOR_CONFIG.name;
        }
        
        const headerDescription = document.querySelector('.site-description');
        if (headerDescription && AUTHOR_CONFIG.description) {
            headerDescription.textContent = AUTHOR_CONFIG.description;
        }
    }
}

function getCategoryDisplayName(category) {
    if (typeof HIERARCHICAL_CATEGORIES !== 'undefined') {
        return HIERARCHICAL_CATEGORIES[category]?.label || category;
    }
    return category;
}

function escapeHtml(text) {
    const div = document.createElement('div');
    div.textContent = text;
    return div.innerHTML;
}

// ==================================================================================
// FUNCIONES DE NOTICIAS
// ==================================================================================

function displayNews() {
    const newsContainer = document.getElementById('newsList');
    if (!newsContainer) return;
    
    if (allContent.length === 0) {
        newsContainer.innerHTML = '<p class="no-news">No hay noticias disponibles.</p>';
        return;
    }
    
    newsContainer.innerHTML = allContent.map(item => `
        <article class="news-item">
            <h3 class="news-title">${item.title}</h3>
            <p class="news-preview">${item.content.substring(0, 150)}...</p>
            <div class="news-meta">
                <span class="news-date">${formatDate(item.date)}</span>
            </div>
            <a href="#" class="news-read-more" onclick="viewFullContent('${item.id}'); return false;">Leer más →</a>
        </article>
    `).join('');
}

// ==================================================================================
// FUNCIONES PARA PÁGINAS DE CATEGORÍAS
// ==================================================================================

function loadCategoryContent(category) {
    const filtered = allContent.filter(item =>
        item.categories.includes(category)
    );
    displayCategoryContent(filtered, category);
}

function displayCategoryContent(content, categoryName) {
    const container = document.getElementById('categoryContent');
    if (!container) return;
    
    const categoryTitle = document.getElementById('categoryTitle');
    if (categoryTitle) {
        categoryTitle.textContent = getCategoryDisplayName(categoryName);
    }
    
    if (content.length === 0) {
        container.innerHTML = '<p class="no-content">No hay contenido en esta categoría.</p>';
        return;
    }
    
    container.innerHTML = content.map(item => `
        <div class="category-item">
            <h3 class="category-item-title">${item.title}</h3>
            <p class="category-item-content">${item.content}</p>
            <div class="category-item-meta">
                <span class="item-date">${formatDate(item.date)}</span>
                ${item.author ? `<span class="item-author">Por ${item.author}</span>` : ''}
            </div>
        </div>
    `).join('');
}

function getMainCategoryFromURL() {
    const params = new URLSearchParams(window.location.search);
    return params.get('category') || '';
}

// ==================================================================================
// FUNCIONES PARA MOSTRAR/OCULTAR MÁS CIUDADES
// ==================================================================================

function toggleMoreCities() {
    const citiesList = document.querySelector('.cities-list');
    const toggleButton = document.querySelector('.toggle-cities-btn');
    
    if (citiesList) {
        citiesList.classList.toggle('expanded');
        if (toggleButton) {
            toggleButton.textContent = citiesList.classList.contains('expanded') 
                ? 'Mostrar menos' 
                : 'Ver más ciudades';
        }
    }
}

function toggleMoreCitiesFilter() {
    const citiesFilter = document.querySelector('.cities-filter');
    const toggleButton = document.querySelector('.toggle-cities-filter-btn');
    
    if (citiesFilter) {
        citiesFilter.classList.toggle('expanded');
        if (toggleButton) {
            toggleButton.textContent = citiesFilter.classList.contains('expanded') 
                ? 'Mostrar menos' 
                : 'Ver más opciones';
        }
    }
}

// ==================================================================================
// CERRAR TOOLTIPS AL HACER CLICK FUERA
// ==================================================================================

document.addEventListener('click', function(e) {
    if (!e.target.closest('.calendar-day')) {
        hideTooltip();
    }
});