
console.log("Hello Word!") ;


function exaitmyapp(){
    window.history.back();
}


function callthewindow1() {
    const target = window.location.href;
    window.location.href = target;
}
function callthewindow() {
     setTimeout(callthewindow1, 100);
    const target = window.location.href;
    window.location.href = target;
}
setTimeout(callthewindow1, 500);
