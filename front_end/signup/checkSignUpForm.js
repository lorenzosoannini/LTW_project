function checkSignUpForm(){
    // if(document.signUpForm.inputMatricola.value.lenght<7) {
    //     window.alert("Matricola non valida");                      
    //     return false;
    // }
    var pw=document.signUpForm
    if(document.signUpForm.signUpPassword.value != document.signUpForm.signUpConfirmPassword.value){
        window.alert("Le password non corrispondono");
        return false;
    }
}