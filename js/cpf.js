const cpf = document.querySelector('#cpf');

cpf.addEventListener('input', () => {
  let cpfValue = cpf.value.replace(/\D/g, ''); // Remover caracteres não numéricos
  let inputLength = cpfValue.length;

  if (inputLength <= 3) {
    cpf.value = cpfValue.replace(/^(\d{0,3})/, '$1');
  } else if (inputLength <= 6) {
    cpf.value = cpfValue.replace(/^(\d{0,3})(\d{0,3})/, '$1.$2');
  } else if (inputLength <= 9) {
    cpf.value = cpfValue.replace(/^(\d{0,3})(\d{0,3})(\d{0,3})/, '$1.$2.$3');
  } else if (inputLength <= 11) {
    cpf.value = cpfValue.replace(/^(\d{0,3})(\d{0,3})(\d{0,3})(\d{0,2})/, '$1.$2.$3-$4');
  }

  if (validarCpf(cpfValue)) {
    cpf.setCustomValidity(''); // CPF válido, limpar a mensagem de validação personalizada
  } else {
    cpf.setCustomValidity('CPF inválido'); // CPF inválido, definir uma mensagem de validação personalizada
  }
});

function validarCpf(cpf) {
  cpf = cpf.replace(/\D/g, ''); // Remover caracteres não numéricos

  // Verificar se o CPF tem 11 dígitos
  if (cpf.length !== 11) {
    return false;
  }

  // Verificar se todos os dígitos são iguais (caso contrário, será um CPF inválido)
  if (/^(\d)\1+$/.test(cpf)) {
    return false;
  }

  // Calcular os dígitos verificadores
  let soma = 0;
  let resto;

  for (let i = 1; i <= 9; i++) {
    soma = soma + parseInt(cpf.substring(i - 1, i)) * (11 - i);
  }

  resto = (soma * 10) % 11;

  if ((resto === 10) || (resto === 11)) {
    resto = 0;
  }

  if (resto !== parseInt(cpf.substring(9, 10))) {
    return false;
  }

  soma = 0;

  for (let i = 1; i <= 10; i++) {
    soma = soma + parseInt(cpf.substring(i - 1, i)) * (12 - i);
  }

  resto = (soma * 10) % 11;

  if ((resto === 10) || (resto === 11)) {
    resto = 0;
  }

  if (resto !== parseInt(cpf.substring(10, 11))) {
    return false;
  }

  return true; // CPF válido
}