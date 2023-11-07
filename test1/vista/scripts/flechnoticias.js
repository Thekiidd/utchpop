
        let indiceActual = 0;
        const grupos = document.querySelectorAll('.noticias-grupo');
        const totalGrupos = grupos.length;

        function actualizarVisibilidad() {
            grupos.forEach((grupo, indice) => {
                grupo.style.display = indice === indiceActual ? 'block' : 'none';
            });
        }

        actualizarVisibilidad();

        document.getElementById('flecha-izquierda').addEventListener('click', () => {
            if (indiceActual > 0) {
                indiceActual--;
                actualizarVisibilidad();
            }
        });

        document.getElementById('flecha-derecha').addEventListener('click', () => {
            if (indiceActual < totalGrupos - 1) {
                indiceActual++;
                actualizarVisibilidad();
            }
        });

