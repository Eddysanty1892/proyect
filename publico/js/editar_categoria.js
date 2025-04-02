document.addEventListener("DOMContentLoaded", function() {
    document.querySelectorAll(".btn-edit").forEach(button => {
        button.addEventListener("click", function() {
            document.getElementById("edit-id").value = this.getAttribute("data-id");
            document.getElementById("edit-nombre").value = this.getAttribute("data-nombre");
            document.getElementById("edit-descripcion").value = this.getAttribute("data-descripcion");
            document.getElementById("edit-correo").value = this.getAttribute("data-correo");
            document.getElementById("edit-contacto").value = this.getAttribute("data-contacto");

            let imagenSrc = this.getAttribute("data-imagen");
            let imagenPreview = document.getElementById("edit-imagen-preview");

            if (imagenSrc) {
                imagenPreview.src = imagenSrc;
                imagenPreview.style.display = "block";
            } else {
                imagenPreview.style.display = "none";
            }
        });
    });
});
