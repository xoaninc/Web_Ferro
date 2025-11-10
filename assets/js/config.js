// ====================================
// CONFIGURACIÓN DEL BLOG - PERSONALIZA AQUÍ
// ====================================
const AUTHOR_CONFIG = {
    name: "Tu Nombre",
    bio: "Apasionado del ferrocarril español. Comparto la fascinante historia y actualidad de nuestro sistema ferroviario, desde las primeras locomotoras hasta los trenes de alta velocidad del futuro.",
    photo: "images/autor-foto.jpg",
    blogTitle: "Blog Ferrocarril Esp",
    blogDescription: "Blog enfocado a la historia del ferrocarril en España y las noticias del sector. Comparto contigo la fascinante evolución de nuestro sistema ferroviario, desde las primeras locomotoras de vapor hasta los trenes de alta velocidad del futuro. Descubre proyectos, curiosidades y todo lo que hace que el ferrocarril español sea único en el mundo.",
    social: {
        twitter: "https://twitter.com/tu_usuario",
        instagram: "https://instagram.com/tu_usuario",
        youtube: "https://youtube.com/tu_canal"
    }
};

// ====================================
// SISTEMA DE CATEGORÍAS JERÁRQUICO COMPLETO
// ====================================
const HIERARCHICAL_CATEGORIES = {
    // SECCIONES HISTÓRICAS (contenido estático/hechos)
    lineas: {
        name: "Líneas",
        color: "#3498db",
        icon: "🚆",
        description: "Información histórica sobre las líneas ferroviarias españolas",
        subcategories: {
            ancho_iberico: "Ancho Ibérico",
            ancho_metrico: "Ancho Métrico",
            ancho_internacional: "Ancho Internacional",
            metro: "Metro",
            tram: "Tram",
            lineas_cerradas: "Líneas Cerradas"
        }
    },
    proyectos: {
        name: "Proyectos",
        color: "#e74c3c",
        icon: "📋",
        description: "Proyectos ferroviarios históricos y actuales",
        subcategories: {
            proyectos_cancelados: "Proyectos Cancelados",
            proyectos_actuales: "Proyectos Actuales",
            proyectos_en_marcha: "Proyectos en Marcha",
            proyectos_estudio: "Proyectos Solo en Estudio"
        }
    },
    desarrollo_ciudades: {
        name: "Desarrollo Ciudades",
        color: "#27ae60",
        icon: "🏛️",
        description: "Impacto del ferrocarril en el desarrollo urbano",
        subcategories: {
            sevilla: "Sevilla",
            madrid: "Madrid",
            barcelona: "Barcelona"
        }
    },
    estaciones_tren: {
        name: "Estaciones de Tren",
        color: "#8e44ad",
        icon: "🚉",
        description: "Historia y características de las estaciones",
        subcategories: {
            mapa_provincias: "Mapa por Provincias"
        }
    },
    otras_secciones: {
        name: "Otras Secciones",
        color: "#f39c12",
        icon: "📚",
        description: "Otros aspectos del ferrocarril español",
        subcategories: {
            curiosidades: "Curiosidades",
            compra_billetes: "Compra de Billetes"
        }
    },
    
    // CATEGORÍAS DE NOTICIAS (contenido dinámico - SOLO en página de noticias)
    noticias: {
        name: "Noticias",
        color: "#1abc9c",
        icon: "📰",
        description: "Noticias actuales del sector ferroviario",
        subcategories: {
            general: "General",
            historia: "Historia",
            tecnologia: "Tecnología"
        }
    },
    
    // CATEGORÍAS DE EVENTOS DEL CALENDARIO (con colores, solo visibles en calendario)
    calendario: {
        name: "Calendario",
        color: "#34495e",
        icon: "📅",
        description: "Eventos y fechas importantes del ferrocarril",
        subcategories: {
            apertura_linea: "Apertura de Línea",
            inicio_obras: "Inicio de Obras",
            fin_obras: "Fin de Obras",
            evento_especial: "Evento Especial",
            mantenimiento: "Mantenimiento",
            aniversario: "Aniversario",
            cambio_horarios: "Cambio de Horarios",
            nueva_tecnologia: "Nueva Tecnología"
        }
    }
};

// ====================================
// TIPOS DE EVENTOS DEL CALENDARIO (con colores sutiles y minimalistas)
// ====================================
const CALENDAR_EVENT_TYPES = {
    apertura_linea: {
        name: "Apertura de Línea",
        color: "#e8f5e8",
        icon: "🎉",
        description: "Inauguración de nuevas líneas ferroviarias"
    },
    inicio_obras: {
        name: "Inicio de Obras",
        color: "#fff3e0",
        icon: "🚧",
        description: "Comienzo de trabajos de construcción"
    },
    fin_obras: {
        name: "Fin de Obras",
        color: "#e3f2fd",
        icon: "✅",
        description: "Finalización de trabajos de construcción"
    },
    evento_especial: {
        name: "Evento Especial",
        color: "#fce4ec",
        icon: "⭐",
        description: "Eventos únicos y especiales"
    },
    mantenimiento: {
        name: "Mantenimiento",
        color: "#f3e5f5",
        icon: "🔧",
        description: "Trabajos de mantenimiento programados"
    },
    aniversario: {
        name: "Aniversario",
        color: "#e0f2f1",
        icon: "🎂",
        description: "Fechas conmemorativas importantes"
    },
    cambio_horarios: {
        name: "Cambio de Horarios",
        color: "#fff8e1",
        icon: "⏰",
        description: "Modificaciones en los horarios de trenes"
    },
    nueva_tecnologia: {
        name: "Nueva Tecnología",
        color: "#e8f5e8",
        icon: "💡",
        description: "Implementación de nuevas tecnologías"
    }
};

// ====================================
// EXPORTAR PARA USO EN OTROS ARCHIVOS
// ====================================
if (typeof module !== 'undefined') {
    module.exports = {
        AUTHOR_CONFIG,
        HIERARCHICAL_CATEGORIES,
        CALENDAR_EVENT_TYPES
    };
}
