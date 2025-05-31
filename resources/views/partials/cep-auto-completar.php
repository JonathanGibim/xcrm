<script>
    document.addEventListener('DOMContentLoaded', function() {
        
        const cepInput = document.getElementById('cep');
        const enderecoInput = document.getElementById('endereco');
        const complementoInput = document.getElementById('complemento');
        const cidadeInput = document.getElementById('cidade');
        const estadoSelect = document.getElementById('estado');
        const numeroInput = document.getElementById('numero'); // Pegar o campo numero

        cepInput.addEventListener('blur', function() { // `blur` é quando o campo perde o foco
            let cep = cepInput.value.replace(/\D/g, ''); // Remove qualquer coisa que não seja dígito

            if (cep.length === 8) {
                // Limpa os campos enquanto espera
                enderecoInput.value = '';
                cidadeInput.value = '';
                estadoSelect.value = '';
                complementoInput.value = ''; // Limpa complemento também, pois pode ser específico do CEP

                // Faz a requisição usando a API fetch nativa do navegador
                fetch(`https://viacep.com.br/ws/${cep}/json/`)
                    .then(response => response.json()) // Converte a resposta para JSON
                    .then(data => {
                        if (!data.erro) { // Verifica se a API não retornou erro (CEP não encontrado)
                            enderecoInput.value = data.logradouro;
                            cidadeInput.value = data.localidade;
                            estadoSelect.value = data.uf; // Preenche o select com a sigla do estado
                            complementoInput.value = data.complemento; // Preenche o complemento

                            // Foca no campo de número após preencher, para o usuário continuar
                            numeroInput.focus();

                        } else {
                            alert('CEP não encontrado.');
                            cepInput.value = ''; // Limpa o CEP inválido
                            cepInput.focus(); // Coloca o foco de volta no CEP
                        }
                    })
                    .catch(error => {
                        console.error('Erro ao buscar CEP:', error);
                        alert('Erro ao buscar CEP. Verifique sua conexão ou tente novamente.');
                        // Opcional: Limpar campos em caso de erro de API
                        enderecoInput.value = '';
                        cidadeInput.value = '';
                        estadoSelect.value = '';
                        complementoInput.value = '';
                    });
            } else if (cep.length > 0 && cep.length < 8) { // Se o CEP não tiver 8 dígitos, mas algo foi digitado
                alert('CEP inválido. Por favor, digite um CEP com 8 dígitos.');
                cepInput.focus();
            }
        });
    });
</script>