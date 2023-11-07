document.addEventListener("DOMContentLoaded", function () {
    // Function to hide all sections
    function hideAllSections() {
        const sections = document.querySelectorAll('section');
        sections.forEach(function (section) {
            section.style.display = 'none';
        });
    }

    // Function to show a specific section
    function showSection(sectionId) {
        hideAllSections();
        const section = document.getElementById(sectionId);
        section.style.display = 'block';
    }

    // Click events for navigation links
    document.getElementById('showactualizarperfil').addEventListener('click', function (event) {
        event.preventDefault(); // Prevent default anchor behavior
        showSection('actualizarperfil');
    });

    document.getElementById('showpublicacionnoticia').addEventListener('click', function (event) {
        event.preventDefault(); // Prevent default anchor behavior
        showSection('publicacionnoticia');
    });

    document.getElementById('showpostrecientes').addEventListener('click', function (event) {
        event.preventDefault(); // Prevent default anchor behavior
        showSection('postrecientes');
    });

    document.getElementById('showfeedback').addEventListener('click', function (event) {
        event.preventDefault(); // Prevent default anchor behavior
        showSection('feedback');
    });

    // Initially hide all sections except the profile summary
    hideAllSections();
    document.getElementById('profileSummary').style.display = 'block';
});