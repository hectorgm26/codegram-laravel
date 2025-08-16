import './bootstrap';

import Dropzone from "dropzone";

Dropzone.autoDiscover = false;

const dropzone = new Dropzone('#dropzone', {
    dictDefaultMessage: 'Sube aquí tu imagen',
    acceptedFiles: '.png, .jpg, .jpeg, .gif, .webp, .avif',
    addRemoveLinks: true,
    dictRemoveFile: 'Eliminar Imagen',
    maxFiles: 1,
    uploadMultiple: false,

    init: function() {
        if (document.querySelector('[name="imagen"]').value.trim()) {
            const imagenPublicada = {};
            imagenPublicada.size = 1234; // valor obligatorio que no influye en el resultado final
            imagenPublicada.name = document.querySelector('[name="imagen"]').value;

            this.options.addedfile.call(this, imagenPublicada);
            this.options.thumbnail.call(this, imagenPublicada, `/uploads/${imagenPublicada.name}`);

            imagenPublicada.previewElement.classList.add('dz-success', 'dz-complete');
        }
    }
});

dropzone.on('sending', function(file, xhr, formData) {
    console.log(formData);
});

dropzone.on('success', function(file, response) {
    document.querySelector('[name="imagen"]').value = response.imagen;
});

dropzone.on('removedfile', function() {
    document.querySelector('[name="imagen"]').value = '';
});