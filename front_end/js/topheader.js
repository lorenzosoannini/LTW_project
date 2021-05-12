Vue.component('topheader', {
    template: `
        <header>
            <div class="container">
                <a href="https://www.uniroma1.it/it/">
                    <img class="float-start" style="margin-top: 20px; margin-bottom: 10px;" src="/front_end/assets/img/logo_full.png" alt="Uniroma 1">
                </a>
                <h1 class="float-end" style="margin-top: 20px;">
                    <a class="title" href="/front_end/index.html" title="Home page">CURS - Centro Unico di Ricerca Sapienza</a>
                </h1>
            </div>

            <div class="container topnav" id="myTopnav">
                <a href="/front_end/">Home</a>
                <a href="/front_end/novita/">Novità</a>
                <a href="/front_end/ricerca/">Ricerca</a>
                <a href="/front_end/login/">LogIn</a>
                <a href="/front_end/signup/">Registrati</a>
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