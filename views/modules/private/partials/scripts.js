const carruselModal = '<div class="col-md-6"><div class="form-group"><label for="">Titulo</label><input type="text" class="form-control" placeholder="Your Name"></div></div><div class="col-md-6"><div class="form-group"><label for="">Nombre</label><input type="text" class="form-control" placeholder="Your Email"></div></div>';
function add(id) {
    const section = document.getElementById(id);
    const elemtento = selection(id);
    section.innerHTML += elemtento;
}
function selection(id) {
    switch (id) {
        case 'carruselModal':
            return carruselModal;
            break;
        default:
          console.log(`Sorry, we are out of ${expr}.`);
      }
      
}