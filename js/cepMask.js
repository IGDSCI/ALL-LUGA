const cep = document.querySelector('#cep');

cep.addEventListener('keypress', () => {
  let inputLength = cep.value.length;

  if (inputLength === 5) {
    cep.value += '-';
  }
});