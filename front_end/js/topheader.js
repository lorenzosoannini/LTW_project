Vue.component('topheader', {
    template: `
        <header>
            <div class="container mt-3">
                <div class="container">
                    <div class="float-start">
                        <a href="https://www.uniroma1.it/it/">
                            <img src="/front_end/assets/img/logo_full.png" alt="Uniroma 1">
                        </a>
                    </div>
                    <div class="float-end">
                        <h1>
                            <a class="title" href="/front_end/index.html" title="Home page">CURS - Centro Unico di Ricerca Sapienza</a>
                        </h1>
                        <div class="btn-group float-end mb-2" role="group">
                            <a class="btn btn-danger" href="/front_end/login/" role="button" id="loginButton">Log-In</a>
                            <a class="btn btn-danger" href="/front_end/signup/" role="button" id="signupButton">Registrati</a>
                        </div>
                    </div>
                </div>

                <div class="container topnav" id="myTopnav">
                    <a href="/front_end/">Home</a>
                    <a href="/front_end/novita/">Novità</a>
                    <a href="/front_end/ricerca/">Ricerca</a>
                    <a href="javascript:void(0);" class="icon" onclick="doHamburger()">
                    <i class="fa fa-bars"></i>
                    </a>                
                </div>
            </div>
        </header>
        `
});

new Vue({
    el: '#header'
});