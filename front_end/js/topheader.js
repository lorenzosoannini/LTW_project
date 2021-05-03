Vue.component('topheader', {
    template: `
        <header>
            <div class="container">
                <a href="https://www.uniroma1.it/it/">
                    <img class="float-start" style="margin-top: 20px; margin-bottom: 10px;" src="../assets/img/logo_full.png" alt="Uniroma 1">
                </a>
                <h1 class="float-end" style="margin-top: 20px;">
                    <a class="title" href="/front_end/index.html" title="Home page">CUR - Centro Unico di Ricerca Sapienza</a>
                    <button class="accountButton" onclick="window.location.href='../login/index.html'" type="button" class="btn btn-secondary" > Entra      </button>
                    <button class="accountButton" onclick="window.location.href='../signup/index.html'" type="button" class="btn btn-secondary"> Registrati </button>
                </h1>
            </div>

            <div class="container topnav" id="myTopnav">
                <a href="#" class="active">Home</a>
                <a href="#">Novità</a>
                <a href="#">Ricerca</a>
                <a href="#">Contatti</a>
                <a href="javascript:void(0);" class="icon" onclick="doHamburger()">
                <i class="fa fa-bars"></i>
                </a>
                
            </div>
        </header>
        `
});

new Vue({
    el: '#header'
});