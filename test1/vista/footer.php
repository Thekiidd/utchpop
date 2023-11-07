
<!-- Incluir al final de tus páginas antes de </body> -->
<footer>
    <div class="footer-container">
        <div class="copyright-section">
            <p>© 2023 Noticias UTCH. Todos los derechos reservados.</p>
        </div>
        <div class="complaint-section">
            <h3>Envía tus quejas o sugerencias</h3>
            <form id="complaintForm">
                <label for="complaintText">Descripción:</label><br>
                <textarea id="complaintText" name="complaintText" rows="4" cols="50" required></textarea><br>
                <input type="submit" value="Enviar">
            </form>
            <div id="complaintResults" style="display: none;">
                Gracias por compartir tu opinión. Tu feedback es valioso para nosotros.
            </div>
        </div>
        <div class="map-section">
            <h3>Encuéntranos</h3>
            <!-- Incrustar mapa de Google Maps -->
            <iframe src="tu_enlace_a_google_maps" width="400" height="300" frameborder="0" style="border:0" allowfullscreen></iframe>
        </div>
    </div>
</footer>
