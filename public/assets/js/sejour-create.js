/* ========================================== *
 * ==                PHOTOS                == *
 * ========================================== */

const photo = document.getElementById('photo-img'),
    photoUploadContainer = document.getElementById('photo-upload-container'),
    photoUpload = document.getElementById('photo-upload'),
    photoUploadRemove = document.getElementById('photo-upload-remove'),
    photoOu = document.getElementById('photo-ou'),
    photoLinkContainer = document.getElementById('photo-link-container'),
    photoLink = document.getElementById('photo-link');

function updatePhoto() {
    photoUploadContainer.classList.toggle('hidden', photoLink.value !== '');
    photoOu.classList.toggle('hidden', photoUpload.files.length > 0 || photoLink.value !== '');
    photoLinkContainer.classList.toggle('hidden', photoUpload.files.length > 0);
    photoUploadRemove.disabled = photoUpload.files.length === 0;


    if (photoLink.value !== '') {
        // photo.classList.remove('hidden');
        photo.src = photoLink.value;
    } else if (photoUpload.files.length > 0) {
        // photo.classList.remove('hidden');
        photo.src = URL.createObjectURL(photoUpload.files[0]);
    }
    else {
        // photo.classList.add('hidden');
        photo.src = "https://placehold.co/1600x900/png?text=Choisir+une+image";
    }
}

photoUpload.addEventListener('change', updatePhoto);

photoUploadRemove.addEventListener('click', () => {
    photoUpload.value = '';
    updatePhoto();
});

photoLink.addEventListener('change', updatePhoto);

updatePhoto();

/* ========================================== *
 * ==               LOCALITE               == *
 * ========================================== */

const vignobleSelect = document.getElementById('vignoble'),
    localiteControl = document.getElementById('localite-control'),
    localiteSelect = document.getElementById('localite');

function updateLocalite() {
    const vignoble = vignobleSelect.value;

    localiteControl.classList.toggle('hidden', localiteSelect.querySelectorAll(`option[data-vignoble='${vignoble}']`).length === 0);

    localiteSelect.querySelectorAll(`option`).forEach((localite) => {
        localite.classList.toggle('hidden', localite.getAttribute('data-vignoble') != vignoble && localite.value !== 'null');
    });
    localiteSelect.value = 'null';

}

updateLocalite();
vignobleSelect.addEventListener('change', () => updateLocalite());

/* ========================================== *
 * ==                ETAPES                == *
 * ========================================== */

const etapesTitre = document.getElementById('etapes-titre'),
    addEtape = document.getElementById('add-etape'),
    etapes = document.getElementById('etapes'),
    maxEtapes = 5,
    minEtapes = 1;

const countEtapes = () => etapes.querySelectorAll('.etape').length;

function updateEtapeCount() {
    const nbEtapes = countEtapes();
    etapesTitre.innerText = `Étapes (${nbEtapes}/${maxEtapes} max)`;
    etapes.querySelectorAll('.btn-supprimer').forEach((btn) => btn.disabled = nbEtapes <= minEtapes);
    addEtape.disabled = nbEtapes >= maxEtapes;
}

function updateEtapeIndexes() {
    etapes.querySelectorAll('.etape').forEach((etape, i) => {
        etape.id = `etape-${i}`;
        etape.querySelector('input[type="file"]').name = `etapes[${i}][image]`;
        etape.querySelector('input.titre').name = `etapes[${i}][titre]`;
        etape.querySelector('textarea.description').name = `etapes[${i}][description]`;
        etape.querySelector('.hebergement label').for = etape.querySelector('.hebergement select').id = `hebergement-${i}`;
        etape.querySelector('.hebergement select').name = `etapes[${i}][hebergement]`;
        etape.querySelector('.button.btn-supprimer').setAttribute('data-etape', i);
    });
}

/**
 * @param {MouseEvent} ev
 */
function deleteEtape(ev) {
    document.getElementById('etape-' + ev.currentTarget.getAttribute('data-etape'))?.remove();
    document.getElementById('hebergement-' + ev.currentTarget.getAttribute('data-etape'))?.remove();

    updateEtapeIndexes();
    updateEtapeCount();
}

function createEtape() {
    updateEtapeIndexes();

    if (countEtapes() >= maxEtapes)
        return;

    const etapeIndex = countEtapes();

    // ======================== ETAPE ========================

    const etape = createElement('div', etapes, {
        class: 'etape',
        id: `etape-${etapeIndex}`
    });

    // ------------ PHOTO ------------

    const etapePhoto = createElement('div', etape, {
        class: 'image',
    });

    const etapePhotoImg = createElement('img', etapePhoto, {
        src: 'https://placehold.co/1600x900/png?text=Choisir+une+image'
    });
    const etapePhotoHover = createElement('div', etapePhoto, {
        class: 'hover'
    });
    icon('image-up', etapePhotoHover, false);

    const etapePhotoInput = createElement('input', etapePhoto, {
        type: 'file',
        hidden: true
    });

    etapePhoto.addEventListener('click', () => {
        etapePhotoInput.click();
    });

    etapePhotoInput.addEventListener('change', () => {
        etapePhotoImg.src = URL.createObjectURL(etapePhotoInput.files[0]);
    });

    // ------------ INPUTS ------------

    createElement('input', etape, {
        class: 'titre',
        type: 'text',
        value: 'Titre',
        name: `etapes[${etapeIndex}][titre]`
    });

    createElement('textarea', etape, {
        class: 'description',
        innerText: 'Description',
        name: `etapes[${etapeIndex}][description]`,
        rows: 3
    });

    // ------------ HEBERGEMENT ------------

    const hebergement = createElement('div', etape, {
        classes: ['hebergement', 'input-control', 'input-control-select'],
        name: `etapes[${etapeIndex}][hebergement]`
    });

    let hebergementId = `hebergement-${etapeIndex}`;

    createElement('label', hebergement, {
        for: hebergementId,
        innerText: 'Hébergement'
    });

    const hebergementSelect = createElement('select', hebergement, {
        class: 'hebergement',
        name: `etapes[${etapeIndex}][hebergement]`,
        id: hebergementId
    });

    for (const opt of hebergements) {
        createElement('option', hebergementSelect, {
            value: opt.idhebergement,
            innerText: `${opt.idhebergement}. ${opt.descriptionhebergement}`
        });
    }

    // ------------ DELETE ------------

    const btnSupprimer = createElement('button', etape, {
        classes: ['button', 'btn-supprimer'],
        type: 'button',
        data: {
            etape: etapeIndex
        }
    });
    icon('trash-2', btnSupprimer, false);
    btnSupprimer.addEventListener('click', deleteEtape);

    lucide.createIcons();

    updateEtapeCount();
}

etapes.querySelectorAll('.etape').forEach((etape) => {
    const etapePhoto = etape.querySelector('.image'),
        etapePhotoImg = etapePhoto.querySelector('img'),
        etapePhotoInput = etapePhoto.querySelector('input');
    etapePhoto.addEventListener('click', () => {
        etapePhotoInput.click();
    });
    etapePhotoInput.addEventListener('change', () => {
        etapePhotoImg.src = URL.createObjectURL(etapePhotoInput.files[0]);
    });

    const btnSupprimer = etape.querySelector('.button.btn-supprimer');
    btnSupprimer.addEventListener('click', deleteEtape);
});
updateEtapeIndexes();
updateEtapeCount();

addEtape.addEventListener('click', () => createEtape());

for (let i = countEtapes(); i < minEtapes; i++) {
    createEtape();
}
