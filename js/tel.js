const tel = document.querySelector('#tel');

tel.addEventListener('input', () => {
  let inputValue = tel.value.replace(/\D/g, ''); // Remover caracteres não numéricos
  let inputLength = inputValue.length;

  if (inputLength === 0) {
    tel.value = '';
  } else if (inputLength <= 2) {
    tel.value = `(${inputValue}`;
  } else if (inputLength <= 6) {
    tel.value = `(${inputValue.slice(0, 2)})${inputValue.slice(2)}`;
  } else if (inputLength <= 10) {
    tel.value = `(${inputValue.slice(0, 2)})${inputValue.slice(2, 6)}-${inputValue.slice(6)}`;
  } else {
    tel.value = `(${inputValue.slice(0, 2)})${inputValue.slice(2, 7)}-${inputValue.slice(7)}`;
  }
});