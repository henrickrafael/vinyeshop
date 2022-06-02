function checkSenha() { 

    let senha = document.getElementById("pwd").value;
    let cSenha = document.getElementById("check_pwd").value;

    let msg = document.getElementById("msg");
    let btn = document.getElementById("btnCad");

    if(senha != cSenha) {

        btn.setAttribute("disabled", true);
        msg.innerText = "*As senhas precisam ser iguais!";

        console.log(senha.length)
    } else {
        msg.innerText = '';
        btn.removeAttribute("disabled");
    }

} 