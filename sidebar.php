<aside class="sidebar">
    <?php if (is_active_sidebar('sidebar-1')) : ?>
        <?php dynamic_sidebar('sidebar-1'); ?>
    <?php endif; ?>

    <div class="advanced-filter">
        <h3>🔍 Filtro Avanzado</h3>
        <p class="filter-description">Selecciona múltiples categorías para encontrar contenido específico</p>

        <!-- Sección Infografía -->
        <div class="filter-section">
            <div class="section-header" onclick="toggleCategorySection('infografia')">
                <h4>📋 Infografía</h4>
                <span class="toggle-icon">▼</span>
            </div>
            <div class="section-content" id="infografia-section">
                <div class="category-checkbox">
                    <input type="checkbox" id="ancho_iberico" value="ancho_iberico" onchange="updateCategoryFilter()">
                    <label for="ancho_iberico">Ancho Ibérico</label>
                </div>
                <div class="category-checkbox">
                    <input type="checkbox" id="ancho_metrico" value="ancho_metrico" onchange="updateCategoryFilter()">
                    <label for="ancho_metrico">Ancho Métrico</label>
                </div>
                <div class="category-checkbox">
                    <input type="checkbox" id="ancho_internacional" value="ancho_internacional" onchange="updateCategoryFilter()">
                    <label for="ancho_internacional">Ancho Internacional</label>
                </div>
                <div class="category-checkbox">
                    <input type="checkbox" id="tipos_lineas" value="tipos_lineas" onchange="updateCategoryFilter()">
                    <label for="tipos_lineas">Distintos tipos de líneas</label>
                </div>
                <div class="category-checkbox">
                    <input type="checkbox" id="lineas_cerradas" value="lineas_cerradas" onchange="updateCategoryFilter()">
                    <label for="lineas_cerradas">Líneas Cerradas</label>
                </div>
                <div class="category-checkbox">
                    <input type="checkbox" id="proyectos_cancelados" value="proyectos_cancelados" onchange="updateCategoryFilter()">
                    <label for="proyectos_cancelados">Proyectos Cancelados</label>
                </div>
                <div class="category-checkbox">
                    <input type="checkbox" id="proyectos_actuales" value="proyectos_actuales" onchange="updateCategoryFilter()">
                    <label for="proyectos_actuales">Proyectos Actuales</label>
                </div>
            </div>
        </div>

        <!-- Sección Noticias -->
        <div class="filter-section">
            <div class="section-header" onclick="toggleCategorySection('noticias')">
                <h4>📰 Noticias</h4>
                <span class="toggle-icon">▼</span>
            </div>
            <div class="section-content" id="noticias-section">
                <div class="category-checkbox">
                    <input type="checkbox" id="noticias" value="noticias" onchange="updateCategoryFilter()">
                    <label for="noticias">Noticias</label>
                </div>
                <div class="category-checkbox">
                    <input type="checkbox" id="ciudades" value="ciudades" onchange="updateCategoryFilter()">
                    <label for="ciudades">Ciudades</label>
                </div>
            </div>
        </div>

        <!-- Sección Curiosidades -->
        <div class="filter-section">
            <div class="section-header" onclick="toggleCategorySection('curiosidades')">
                <h4>✨ Curiosidades</h4>
                <span class="toggle-icon">▼</span>
            </div>
            <div class="section-content" id="curiosidades-section">
                <div class="category-checkbox">
                    <input type="checkbox" id="curiosidades" value="curiosidades" onchange="updateCategoryFilter()">
                    <label for="curiosidades">Curiosidades</label>
                </div>
            </div>
        </div>
    </div>
</aside>
