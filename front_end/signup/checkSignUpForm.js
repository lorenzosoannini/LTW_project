function checkSignUpForm(){
    if(document.signUpForm.inputMatricola.value.length<7) {
        window.alert("Matricola non valida");                      
        return false;
    }
    if(document.signUpForm.inputSignUpPassword.value != document.signUpForm.signUpConfirmPassword.value){
        window.alert("Le password non corrispondono");
        return false;
    }
}