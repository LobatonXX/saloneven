async function handleSubmit(event) {
    event.preventDefault();

    const form = document.getElementById('reservaciones');
    const formData = new FormData(form);

    try {
        // Enviar los datos a PHP para guardarlos en la base de datos
        const response = await fetch('enviar.php', {
            method: 'POST',
            body: formData
        });

        if (response.ok) {
            // Datos guardados correctamente, generar el PDF
            await generatePDF(formData);
            // Redirigir a otra página después de generar el PDF
            window.location.href = 'pago.html';
        } else {
            console.error('Error al guardar los datos en la base de datos.');
        }
    } catch (error) {
        console.error('Error:', error);
    }
}

function generatePDF(formData) {
    return new Promise((resolve) => {
        const { jsPDF } = window.jspdf;
        const pdf = new jsPDF();

        // Cargar la imagen del formulario
        const img = new Image();
        img.src = 'contratos.jpg'; // Asegúrate de que la imagen esté accesible

        img.onload = () => {
            pdf.addImage(img, 'JPEG', 0, 0, 210, 297); // Ajusta las dimensiones según sea necesario

            // Completar los campos en la imagen (ajusta las coordenadas según sea necesario)
            pdf.setFontSize(12);

            // Datos del Cliente
            pdf.text(formData.get('nombre'), 40, 45); // Coordenadas ajustadas
            pdf.text(formData.get('direccion'), 40, 52);
            pdf.text(formData.get('telefono'), 40, 59);
            pdf.text(formData.get('correo'), 40, 66);
            pdf.text(formData.get('evento'), 50, 73);
            pdf.text(formData.get('fechaEvento'), 40, 80);
            pdf.text(formData.get('horaIni'), 45, 87);
            pdf.text(formData.get('horaFin'), 45, 94);
            pdf.text(formData.get('observaciones'), 50, 101);

            // Datos del Evento
            pdf.text(formData.get('paquete'), 50, 114);

            // Agregar las entradas seleccionadas
            const entradas = [
                { id: 'crema1', nombre: 'Crema de Elote' },
                { id: 'crema2', nombre: 'Crema de Brocoli' },
                { id: 'crema3', nombre: 'Crema de Calabaza' },
                { id: 'crema4', nombre: 'Crema de Nuez' }
            ];

            let yEntradas = 121; // Coordenada Y inicial para las entradas
            const entradaSeleccionadas = [formData.get('entrada')]; // Solo una entrada seleccionada
            entradas .forEach((entrada, index) => {
                if (entradaSeleccionadas.includes(entrada.id)) {
                    pdf.text(`${index + 1}. ${entrada.nombre}`, 40, yEntradas);
                    yEntradas += 7;
                }
            });
              // Agregar las segundoT seleccionadas
              const segundoT = [
                { id: 'Pasta1', nombre: 'Pasta Hawaiana' },
                { id: 'Pasta2', nombre: 'Pasta Alfredo' },
                { id: 'Pasta3', nombre: 'Pasta Italiana' },
            ];

            let ySegun = 128; // Coordenada Y inicial para las entradas
            const segundoTSeleccionado = [formData.get('segundoT')]; 
            segundoT.forEach((segundoT, index) => {
                if (segundoTSeleccionado.includes(segundoT.id)) {
                    pdf.text(`${index + 1}. ${segundoT.nombre}`, 50, ySegun);
                    ySegun += 7;
                }
            });
              // Agregar los platoF seleccionados
              const platoF = [
                { id: 'plato1', nombre: 'Pechuga cordon bleu' },
                { id: 'plato2', nombre: 'Lomo relleno de jamón con queso' },
                { id: 'plato3', nombre: 'Lomo en adobo' },
            ];

            let yPlato = 135; // Coordenada Y inicial para las entradas
            const platoSeleccionado = [formData.get('platoF')]; // Solo una entrada seleccionada
            platoF.forEach((platoF, index) => {
                if (platoSeleccionado.includes(platoF.id)) {
                    pdf.text(`${index + 1}. ${platoF.nombre}`, 45, yPlato);
                    yPlato += 7;
                }
            });
              // Agregar la guarnicion seleccionada
            const guarniciones = [
                { id: 'guar1', nombre: 'Verduras a la mantequilla' },
                { id: 'guar2', nombre: 'Papas cambray salteadas al perejil' },
                { id: 'guar3', nombre: 'Ensalada Rusa' },
                { id: 'guar4', nombre: 'Chayotes a la crema' }
            ];

            let yGuar = 142; // Coordenada Y inicial para las entradas
            const guarnicionesSeleccionadas = [formData.get('guarniciones')]; // Solo una entrada seleccionada
            guarniciones.forEach((guarnicion, index) => {
                if (guarnicionesSeleccionadas.includes(guarnicion.id)) {
                    pdf.text(`${index + 1}. ${guarnicion.nombre}`, 45, yGuar);
                    yGuar += 7;
                }
            });
            // Agregar los servicios seleccionados
            const serviciosAdicionales = [
                { id: 'servAd1', nombre: 'Robot', costo: '$1000' },
                { id: 'servAd2', nombre: 'Botarga', costo: '$550' },
                { id: 'servAd3', nombre: 'Orquesta', costo: '$6500' },
                { id: 'servAd4', nombre: 'DJ', costo: '$3000' },
                { id: 'servAd5', nombre: 'Fotografía y video del evento', costo: '$5000' },
                { id: 'servAd6', nombre: 'Banquete para 100 personas más', costo: '$8000' },
                { id: 'servAd7', nombre: 'Banquete para 50 personas más', costo: '$4000' }
            ];

            let yServicios = 160; // Coordenada Y inicial para los servicios adicionales
            const serviciosSeleccionados = formData.getAll('serviciosAd[]');
            serviciosAdicionales.forEach((servicio, index) => {
                if (serviciosSeleccionados.includes(servicio.id)) {
                    pdf.text(`${index + 1}. ${servicio.nombre} - ${servicio.costo}`, 40, yServicios);
                    yServicios += 5;
                }
            });

            // Generar el archivo PDF y resolver la promesa
            pdf.save('Contrato.pdf');
            resolve();
        };
    });
}
