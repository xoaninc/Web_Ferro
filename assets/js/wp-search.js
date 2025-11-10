// SISTEMA DE BÚSQUEDA PARA WORDPRESS

/**
 * Realiza búsqueda en el contenido
 * @param {string} query - Término de búsqueda
 */
function performSearch(query) {
    if (!query || query.length < 2) {
        hideSearchResults();
        return;
    }
    
    const results = searchInContent(query);
    displaySearchResults(results, query);
}

/**
 * Busca en todo el contenido disponible
 * @param {string} query - Término a buscar
 * @returns {Array} Array de resultados
 */
function searchInContent(query) {
    const lowerQuery = query.toLowerCase();
    const results = [];
    
    // Buscar en artículos
    if (typeof allContent !== 'undefined' && allContent.length > 0) {
        allContent.forEach(item => {
            const relevance = calculateRelevance(item.title + ' ' + item.content, lowerQuery);
            if (relevance > 0) {
                results.push({
                    type: 'post',
                    title: item.title,
                    content: item.content,
                    relevance: relevance,
                    id: item.id,
                    date: item.date
                });
            }
        });
    }
    
    // Buscar en categorías
    if (typeof HIERARCHICAL_CATEGORIES !== 'undefined') {
        Object.keys(HIERARCHICAL_CATEGORIES).forEach(key => {
            const category = HIERARCHICAL_CATEGORIES[key];
            const relevance = calculateRelevance(category.label, lowerQuery);
            if (relevance > 0) {
                results.push({
                    type: 'category',
                    title: category.label,
                    relevance: relevance,
                    id: key
                });
            }
        });
    }
    
    // Ordenar por relevancia
    return results.sort((a, b) => b.relevance - a.relevance).slice(0, 10);
}

/**
 * Calcula la relevancia de un texto respecto a la query
 * @param {string} text - Texto a evaluar
 * @param {string} query - Término de búsqueda
 * @returns {number} Puntuación de relevancia
 */
function calculateRelevance(text, query) {
    if (!text || !query) return 0;
    
    const lowerText = text.toLowerCase();
    let relevance = 0;
    
    // Coincidencia exacta (máxima relevancia)
    if (lowerText === query) {
        relevance += 100;
    }
    
    // Comienza con el término (alta relevancia)
    if (lowerText.startsWith(query)) {
        relevance += 50;
    }
    
    // Contiene el término exacto como palabra
    const wordRegex = new RegExp(`\\b${query}\\b`, 'i');
    if (wordRegex.test(text)) {
        relevance += 30;
    }
    
    // Contiene el término (baja relevancia)
    if (lowerText.includes(query)) {
        relevance += 10;
    }
    
    // Contar coincidencias
    const matches = lowerText.match(new RegExp(query, 'g'));
    if (matches) {
        relevance += matches.length * 5;
    }
    
    return relevance;
}

/**
 * Muestra los resultados de búsqueda
 * @param {Array} results - Array de resultados
 * @param {string} query - Término buscado
 */
function displaySearchResults(results, query) {
    const resultsContainer = document.getElementById('searchResults');
    
    if (!resultsContainer) {
        console.warn('No se encontró contenedor de resultados de búsqueda');
        return;
    }
    
    if (results.length === 0) {
        resultsContainer.innerHTML = `
            <div class="search-no-results">
                <p>No se encontraron resultados para: <strong>${escapeHtml(query)}</strong></p>
            </div>
        `;
        return;
    }
    
    const resultsHtml = results.map(result => `
        <div class="search-result-item" data-type="${result.type}" data-id="${result.id}">
            <div class="result-header">
                <span class="result-icon">${getResultIcon(result.type)}</span>
                <h3 class="result-title">${highlightQuery(result.title, query)}</h3>
                <span class="result-type">${getResultTypeLabel(result.type)}</span>
            </div>
            ${result.content ? `
                <p class="result-preview">${highlightQuery(result.content.substring(0, 150), query)}...</p>
            ` : ''}
            ${result.date ? `<span class="result-date">${formatDate(result.date)}</span>` : ''}
        </div>
    `).join('');
    
    resultsContainer.innerHTML = resultsHtml;
    
    // Agregar event listeners
    document.querySelectorAll('.search-result-item').forEach(item => {
        item.addEventListener('click', function() {
            const type = this.getAttribute('data-type');
            const id = this.getAttribute('data-id');
            
            if (type === 'post') {
                viewFullContent(id);
            } else if (type === 'category') {
                loadCategoryContent(id);
            }
        });
    });
}

/**
 * Retorna el ícono para cada tipo de resultado
 * @param {string} type - Tipo de resultado
 * @returns {string} HTML del ícono
 */
function getResultIcon(type) {
    const icons = {
        'post': '📰',
        'category': '📁',
        'page': '📄',
        'event': '📅'
    };
    return icons[type] || '📌';
}

/**
 * Retorna la etiqueta de tipo para mostrar
 * @param {string} type - Tipo de resultado
 * @returns {string} Etiqueta legible
 */
function getResultTypeLabel(type) {
    const labels = {
        'post': 'Artículo',
        'category': 'Categoría',
        'page': 'Página',
        'event': 'Evento'
    };
    return labels[type] || 'Resultado';
}

/**
 * Resalta la query en el texto
 * @param {string} text - Texto original
 * @param {string} query - Término a resaltar
 * @returns {string} HTML con resaltado
 */
function highlightQuery(text, query) {
    if (!text || !query) return text;
    
    const regex = new RegExp(`(${escapeRegex(query)})`, 'gi');
    return text.replace(regex, '<mark>$1</mark>');
}

/**
 * Escapa caracteres especiales en regex
 * @param {string} string - String a escapar
 * @returns {string} String escapado
 */
function escapeRegex(string) {
    return string.replace(/[.*+?^${}()|[\]\\]/g, '\\$&');
}

/**
 * Escapa caracteres HTML
 * @param {string} text - Texto a escapar
 * @returns {string} Texto escapado
 */
function escapeHtml(text) {
    const div = document.createElement('div');
    div.textContent = text;
    return div.innerHTML;
}

/**
 * Oculta los resultados de búsqueda
 */
function hideSearchResults() {
    const resultsContainer = document.getElementById('searchResults');
    if (resultsContainer) {
        resultsContainer.innerHTML = '';
    }
}

/**
 * Genera un ID único para un elemento
 * @param {Element} element - Elemento DOM
 * @returns {string} ID único
 */
function generateId(element) {
    if (element.id) return element.id;
    const id = `element-${Math.random().toString(36).substr(2, 9)}`;
    element.id = id;
    return id;
}

/**
 * Desplaza la página a un elemento específico
 * @param {string} elementId - ID del elemento
 */
function scrollToElement(elementId) {
    const element = document.getElementById(elementId);
    if (element) {
        element.scrollIntoView({ behavior: 'smooth', block: 'start' });
    }
}