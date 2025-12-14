<?php

use yii\helpers\Url;
?>
<style>
    /* 1. Variables de Color (Definidas en el contenedor específico) */
    .card-alquiler {
/* Paleta de Colores de "Elegancia Cálida": Taupe, Dorado Suave, Blanco Roto */
        --color-primario: #cbfbfbff;      /* Gris Topo Oscuro (Base) */
        --color-secundario: #b28800da;    /* Dorado Suave/Beige (Acento) */
        --color-fondo: #ffffffff;         /* Blanco Roto (Fondo principal) */
        --color-texto: #333333;         /* Gris Oscuro (Texto) */
        --color-acento: #FFFBEB;        /* Fondo muy claro de acento */
        --padding-base: 15px;
        
        /* Estilos del Contenedor Principal (Antes: .card-container) */
        width: 100%;
        transform: scale(0.90);
        transform-origin: top center;
        background-color: var(--color-fondo); /* Blanco Puro */
        color: var(--color-texto);
        border-radius: 12px;
        box-shadow: 0 4px 10px rgba(0, 0, 0, 0.9); 
        overflow-x: visible;
        overflow-y: hidden;
        position: relative;
        z-index: 1;
        font-family: 'Georgia', 'Times New Roman', serif; /* Tipografía específica */
    }

    /* * NOTA: Los estilos de BODY se deben definir SOLO en el layout principal */
    
    /* --- Encabezado / Hero Section --- */
    .card-alquiler .hero-section {
        background-color: var(--color-primario);
        color: var(--color-fondo);
        padding: var(--padding-base) 20px;
        text-align: center;
        border-bottom: 3px solid var(--color-secundario);
    }

    .card-alquiler .hero-section h1 {
        color: var(--color-secundario);
        margin-bottom: 5px;
        font-size: 1.8em;
        letter-spacing: 2px;
        font-weight: normal; 
    }

    .card-alquiler .hero-section p {
        font-style: italic;
        font-size: 0.9em;
        color: #0036fbff;
    }

    /* --- Estilos de los Ítems del Menú --- */
    .card-alquiler .menu-item {
        scroll-snap-align: start;
        padding: 10px;
        border: px solid var(--color-secundario);
        margin: 5px;
        border-radius: 8px;
        transition: box-shadow 0.3s ease;
        background-color: var(--color-fondo);
    }

    .card-alquiler .menu-item:hover {
        box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
        transform: translateY(-2px);
    }

    .card-alquiler .menu-item h2 {
        font-size: 1.3em;
        margin-top: 0;
        margin-bottom: 10px;
        color: var(--color-texto); 
    }

    .card-alquiler .highlight-primario {
        border-left: 5px solid var(--color-texto); 
        background-color: var(--color-acento);
    }

    .card-alquiler .highlight-secundario {
        border-left: 5px solid var(--color-secundario);
        background-color: var(--color-fondo);
    }

    .card-alquiler .menu-item ul {
        list-style: none;
        padding: 0;
        margin: 10px 0;
    }

    .card-alquiler .menu-item li {
        padding: 3px 0;
        border-bottom: 1px dotted #ccc;
        font-size: 0.95em;
    }

    /* --- Placeholder para Imágenes --- */
    .card-alquiler .item-image-placeholder {
        height: 80px;
        background-color: #f8f8f8;
        border: 1px dashed var(--color-texto);
        overflow: hidden;
        display: flex;
        justify-content: center;
        align-items: center;
        color: #888;
        font-style: italic;
        font-size: 0.8em;
        text-align: center;
    }
    
    .card-alquiler .item-image-placeholder img {
        height: 100%;
        width: 100%;
        object-fit: cover;
    }

    /* --- Pie de Página / Contacto --- */
    .card-alquiler .contact-info {
        text-align: center;
        padding: var(--padding-base);
        background-color: var(--color-texto);
        color: var(--color-fondo);
        margin-top: 0px;
    }

    .card-alquiler .btn-contacto {
        display: inline-block;
        background-color: var(--color-secundario);
        color: var(--color-texto);
        padding: 8px 20px;
        border-radius: 5px;
        text-decoration: none;
        font-weight: bold;
        margin-top: 10px;
        transition: background-color 0.3s ease;
        border: 2px solid var(--color-secundario);
    }

    .card-alquiler .btn-contacto:hover {
        background-color: #ccc;
        border-color: #ccc;
        color: var(--color-texto);
    }

    /* --- Efecto de Fondo --- */
    .card-alquiler .star-bg {
        position: absolute;
        top: 0;
        left: 0;
        width: 100%;
        height: 100%;
        overflow: hidden;
        pointer-events: none;
        opacity: 0.1;
        background-image: radial-gradient(var(--color-secundario) 1px, transparent 1px),
                          radial-gradient(var(--color-fondo) 1px, transparent 1px);
        background-size: 20px 20px, 40px 40px;
        background-position: 0 0, 10px 10px;
        z-index: 0;
    }
</style>
<div class="card-alquiler">
    <header class="hero-section">
        <h1>Liliana Catering 💎</h1>
        <p>Soluciones completas para tu evento: Elegancia y Logística.</p>
    </header>

    <section>
        <div class="carousel slide" data-bs-ride="carousel">
            <div class="carousel-inner">
                <div class="carousel-item active">
                    <div class="menu-item highlight-primario">
                        <h2>Mobiliario y Estructuras 🏛️</h2>
                        <ul>
                            <li>Sillas Tiffany/Crossback y Fundas</li>
                            <li>Mesas Redondas y Rectangulares (diversos tamaños)</li>
                            <li>Livings, Barras Móviles y Pistas de Baile</li>
                        </ul>
                        <div class="item-image-placeholder">
                            <img src="<?= Url::to('@web/img/publicidades/alquiler_mobiliario.jpg') ?>" class="d-block w-100" alt="Mobiliario de Eventos">
                        </div>
                    </div>
                </div>
                <div class="carousel-item">
                    <div class="menu-item highlight-secundario">
                        <h2>Menaje y Cristalería ✨</h2>
                        <ul>
                            <li>Juegos de Vajilla Premium (Porcelana y Cerámica)</li>
                            <li>Cubertería (Línea Clásica y Dorada)</li>
                            <li>Copas, Vasos y Jarras de Cristal</li>
                        </ul>
                        <div class="item-image-placeholder">
                            <img src="<?= Url::to('@web/img/publicidades/alquiler_menaje.jpg') ?>" class="d-block w-100" alt="Vajilla y Copas">
                        </div>
                    </div>
                </div>
                <div class="carousel-item">
                    <div class="menu-item highlight-primario">
                        <h2>Textiles y Servicio 👔</h2>
                        <ul>
                            <li>Mantelería y Caminos (Amplia gama de colores)</li>
                            <li>Servilletas y Fundas para Sillas</li>
                            <li>Servicio de Mozos y Personal de Catering (Opcional)</li>
                        </ul>
                        <div class="item-image-placeholder">
                            <img src="<?= Url::to('@web/img/publicidades/alquiler_textiles.jpg') ?>" class="d-block w-100" alt="Mantelería y Servicio">
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <footer class="contact-info">
        <p>Organiza tu evento sin estrés. ¡Consulta nuestras tarifas!</p>
        <div class="contact-details">
            <a href="https://wa.me/5492996314312" target="_blank" class="contact-link whatsapp-link">
                <i class="bi bi-whatsapp"></i> 2996314312
            </a>
            <BR>
            <a href="tel:+542996314312" class="contact-link call-link">
                <i class="bi bi-phone"></i> Llamar
            </a>
        </div>
    </footer>

    <div class="star-bg"></div>
</div>