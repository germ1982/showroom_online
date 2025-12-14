<?php

use yii\helpers\Url;
?>

<style>
      :root {
            --color-negro: #1a1a1a;
            --color-blanco: #ffffff;
            --color-naranja: #ff6600;
            /* Naranja vibrante */
            --color-amarillo: #ffc107;
            /* Amarillo para destacar */
            --padding-base: 15px;
      }

      /* * Nota: body y html deberían estar definidos en tu layout principal, 
 * pero los incluimos aquí para asegurar el contexto de la tarjeta si es necesario.
 */
      body {
            font-family: 'Arial', sans-serif;
            margin: 0;
            padding: 0;
      }

      /* --- Contenedor Principal de la Tarjeta --- */
      .card-container {
            width: 100%;
            /* max-width: 600px; */
            /* Si lo pones en un col-md-4, déjalo al 100% de ese col */
            /* === APLICAR REDUCCIÓN DEL 25% === */
            transform: scale(0.90);
            transform-origin: top center;
            /* Hace que se reduzca desde la parte superior central */
            background-color: var(--color-blanco);
            color: var(--color-negro);
            border-radius: 12px;
            box-shadow: 0 8px 16px rgba(0, 0, 0, 0.5);
            overflow-x: visible;
            /* Asegura que el contenido horizontal pueda desbordarse */
            overflow-y: hidden;
            position: relative;
            z-index: 1;
      }

      /* --- Encabezado / Hero Section --- */
      .hero-section {
            background-color: var(--color-negro);
            color: var(--color-blanco);
            padding: var(--padding-base) 20px;
            text-align: center;
            border-bottom: 4px solid var(--color-naranja);
      }

      .hero-section h1 {
            color: var(--color-amarillo);
            margin-bottom: 5px;
            font-size: 1.8em;
            letter-spacing: 2px;
      }

      .hero-section p {
            font-style: italic;
            font-size: 0.9em;
            color: #e0e0e0;
      }


      .menu-item {

            scroll-snap-align: start;
            padding: 10px;
            border: 2px solid var(--color-negro);
            margin: 5px;
            border-radius: 8px;
            transition: box-shadow 0.3s ease;
      }

      .menu-item:hover {
            /* Efecto de sombra al pasar el mouse, sin desplazamiento vertical */
            box-shadow: 0 6px 12px rgba(0, 0, 0, 0.2);
      }

      .menu-item h2 {
            font-size: 1.3em;
            margin-top: 0;
            margin-bottom: 10px;
      }

      .highlight-naranja {
            border-left: 5px solid var(--color-naranja);
            background-color: #fff8f5;
            /* Blanco muy suave */
      }

      .highlight-amarillo {
            border-left: 5px solid var(--color-amarillo);
            background-color: #fffff0;
      }

      .menu-item ul {
            list-style: none;
            padding: 0;
            margin: 10px 0;
      }

      .menu-item li {
            padding: 3px 0;
            border-bottom: 1px dotted #ccc;
            font-size: 0.95em;
      }

      /* --- Placeholder para Imágenes (simula un espacio con fondo) --- */
      .item-image-placeholder {
            height: 80px;
            background-color: #f0f0f0;
            border: 1px dashed var(--color-naranja);
            overflow: hidden;
            display: flex;
            justify-content: center;
            align-items: center;
            color: #888;
            font-style: italic;
            font-size: 0.8em;
            text-align: center;
      }

      /* --- Pie de Página / Contacto --- */
      .contact-info {
            text-align: center;
            padding: var(--padding-base);
            background-color: var(--color-negro);
            color: var(--color-blanco);
            margin-top: 0px;
      }

      .btn-contacto {
            display: inline-block;
            background-color: var(--color-naranja);
            color: var(--color-negro);
            padding: 8px 20px;
            border-radius: 5px;
            text-decoration: none;
            font-weight: bold;
            margin-top: 10px;
            transition: background-color 0.3s ease;
            border: 2px solid var(--color-naranja);
      }

      .btn-contacto:hover {
            background-color: var(--color-amarillo);
            border-color: var(--color-amarillo);
      }

      /* --- Efecto de Fondo (Estrellas / Líneas) --- */
      .star-bg {
            position: absolute;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            overflow: hidden;
            pointer-events: none;
            opacity: 0.1;
            background-image: radial-gradient(var(--color-naranja) 1px, transparent 1px),
                  radial-gradient(var(--color-amarillo) 1px, transparent 1px);
            background-size: 20px 20px, 40px 40px;
            background-position: 0 0, 10px 10px;
            z-index: 0;
      }
</style>

<div class="card-container">
      <header class="hero-section">
            <h1>La Cocina de Hector 🥂</h1>
            <p>¡Tu mesa, nuestra pasión! Platos de fiesta con sabor casero.</p>
      </header>

      <section>
            <div class="carousel slide" data-bs-ride="carousel">
                  <div class="carousel-inner">

                        <div class="carousel-item active">
                              <div class="menu-item highlight-naranja">
                                    <h2>Tablas y Bocados 🧀</h2>
                                    <ul>
                                          <li>Tablas de Fiambres Premium</li>
                                          <li>Sándwiches de Miga (Simples y Triples)</li>
                                          <li>Vitel Toné Clásico</li>
                                    </ul>
                                    <div class="item-image-placeholder">
                                          <img src="<?= Url::to('@web/img/publicidades/hector_catering_01.jpg') ?>" class="d-block w-100" alt="Foto ">
                                    </div>
                              </div>
                        </div>

                        <div class="carousel-item">
                              <div class="menu-item highlight-amarillo">
                                    <h2>Platos Fuertes 🍖</h2>
                                    <ul>
                                          <li>Lechón Asado</li>
                                          <li>Pollo Arrollado Especial</li>
                                          <li>Matambre Casero</li>
                                    </ul>
                                    <div class="item-image-placeholder">
                                          <img src="<?= Url::to('@web/img/publicidades/hector_catering_02.jpg') ?>" class="d-block w-100" alt="Foto ">
                                    </div>
                              </div>
                        </div>

                        <div class="carousel-item">
                              <div class="menu-item highlight-naranja">
                                    <h2>Clásicos de Siempre 🍕</h2>
                                    <ul>
                                          <li>Empanadas Gourmet (Variedad)</li>
                                          <li>Pizzas Artesanales (Tamaño familiar)</li>
                                          <li>Torre de Panqueques Salada</li>
                                    </ul>
                                    <div class="item-image-placeholder">
                                          <img src="<?= Url::to('@web/img/publicidades/hector_catering_03.jpg') ?>" class="d-block w-100" alt="Foto ">
                                    </div>
                              </div>
                        </div>
                  </div>
            </div>
      </section>

      <footer class="contact-info">
            <p>Pedidos y consultas: ¡Contacta ahora!</p>
            <div class="contact-details">
                  <a href="https://wa.me/5492996314312" target="_blank" class="contact-link whatsapp-link">
                        <i class="bi bi-whatsapp"></i> 2996314312
                  </a>
<BR>
                  <a href="tel:+542996314312" class="contact-link call-link">
                        <i class="bi bi-phone"></i> Llamar
                  </a>
            </div>
            <!--  <a href="#" class="btn-contacto">¡Ver Precios!</a> -->
            <!--  <a href="#" class="btn-contacto">¡Ver Precios!</a> -->
      </footer>

      <div class="star-bg"></div>
</div>