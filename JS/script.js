function checkSenha() { 

    let senha = document.getElementById("pwd").value;
    let cSenha = document.getElementById("check_pwd").value;

    let msg = document.getElementById("msg");
    let btn = document.getElementById("btnCad");

    if(senha != cSenha) {

        btn.setAttribute("disabled", true);
        btn.classList.add("btn-disabled");
        msg.style.color = 'red';
        msg.innerText = "*As senhas precisam ser iguais!";

        console.log(senha.length)
    } else {
        msg.innerText = '';
        btn.removeAttribute("disabled");
        btn.classList.remove("btn-disabled");
    }
} 

function validateQtd() {

    let qtd = document.getElementById("qtty").value;
    let preco = document.getElementById("input-price").value;
    let field = document.getElementById("price");
    let qtdParse = parseInt(qtd);   
    let precoParse = parseFloat(preco); 

    if (qtdParse != 0 && (!isNaN(qtdParse))) {
        console.log(qtdParse + qtdParse);
        field.innerText = `R$ ${(qtdParse * precoParse).toFixed(2)}`
    } else {
        console.log(`${qtdParse} -> não é um número`);
    }

}