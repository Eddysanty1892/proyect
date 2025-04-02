document.addEventListener("DOMContentLoaded", function() {
    document.querySelectorAll(".btn-delete").forEach(button => {
        button.addEventListener("click", function() {
            let proveedorId = this.getAttribute("data-id");

            if (confirm("¿Estás seguro de que deseas eliminar este proveedor?")) {
                fetch("../modelos/eliminar_proveedor.php", {
                    method: "POST",
                    headers: { "Content-Type": "application/x-www-form-urlencoded" },
                    body: "id=" + proveedorId
                })
                .then(response => response.text())
                .then(data => {
                    if (data.trim() === "success") {
                        alert("Proveedor eliminado correctamente.");
                        document.getElementById("fila-" + proveedorId).remove();
                    } else {
                        alert("Error al eliminar el proveedor.");
                    }
                })
                .catch(error => console.error("Error:", error));
            }
        });
    });
});
