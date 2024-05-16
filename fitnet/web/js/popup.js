const openModalButtons = document.querySelectorAll('[data-modal-target]')
const closeModalButtons = document.querySelectorAll('[data-close-button]')
const overlay = document.getElementById('overlay')

openModalButtons.forEach(button => {
  button.addEventListener('click', () => {
    const modal = document.querySelector(button.dataset.modalTarget)
    openModal(modal)
  })
})

overlay.addEventListener('click', () => {
  const modals = document.querySelectorAll('.modal.active')
  modals.forEach(modal => {
    closeModal(modal)
  })
})

closeModalButtons.forEach(button => {
  button.addEventListener('click', () => {
    const modal = button.closest('.modal')
    closeModal(modal)
  })
})

function disableScroll() {
  document.body.scrollTop = document.documentElement.scrollTop = 0;
  scrollTop =
    window.pageYOffset||
    document.documentElement.scrollTop;
  scrollLeft =
    window.pageXOffset ||
    document.documentElement.scrollLeft,
    window.onscroll = function () {
      window.scrollTo(scrollLeft, scrollTop);
    };
}

function enableScroll() {
  window.onscroll = function () { };
}

function openModal(modal) {
  if (modal == null) return
  modal.classList.add('active');
  overlay.classList.add('active');
  var blob = document.getElementById('blob');
  blob.classList.add('-z-50');
  var bigFitnetLogo = document.getElementById('bigFitnetLogo');
  bigFitnetLogo.classList.add('-z-50');
  var jumbotron = document.getElementById('jumbotron');
  jumbotron.classList.add('-z-50');
  document.body.style.touchAction = 'none';
  disableScroll();
 
}

function closeModal(modal) {
  if (modal == null) return
  modal.classList.remove('active')
  overlay.classList.remove('active')
  var blob = document.getElementById('blob');
  blob.classList.remove('-z-50');
  var bigFitnetLogo = document.getElementById('bigFitnetLogo');
  bigFitnetLogo.classList.remove('-z-50');
  var jumbotron = document.getElementById('jumbotron');
  jumbotron.classList.remove('-z-50');
  document.body.style.touchAction = 'auto';
  enableScroll();
  
}



