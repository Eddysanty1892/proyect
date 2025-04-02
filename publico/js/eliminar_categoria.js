document.addEventListener("DOMContentLoaded", function() {
    document.querySelectorAll(".btn-delete").forEach(button => {
        button.addEventListener("click", function() {
            let proveedorId = this.getAttribute("data-id");

            if (confirm("¿Estás seguro de que deseas eliminar esta categoria?")) {
                fetch("../modelos/eliminar_categoria.php", {
                    method: "POST",
                    headers: { "Content-Type": "application/x-www-form-urlencoded" },
                    body: "id=" + proveedorId
                })
                .then(response => response.text())
                .then(data => {
                    if (data.trim() === "success") {
                        alert("categoria eliminada correctamente.");
                        document.getElementById("fila-" + proveedorId).remove();
                    } else {
                        alert("Error al eliminar el categoria.");
                    }
                })
                .catch(error => console.error("Error:", error));
            }
        });
    });
});
