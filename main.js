function calcular () {
    const qtd_compra_brl = parseFloat(document.getElementById('input-compra-brl').value);
    const valor_cota = parseFloat(document.getElementById('input-valor-cota').value);
    const calculo = qtd_compra_brl + valor_cota;


document.getElementById('input-qtd-comprada').value = calculo;

}