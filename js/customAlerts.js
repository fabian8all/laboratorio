
function customAlert(title, content){
	$.alert({
        title: title,
        content: content,
        theme: 'black',
        animation: 'left',
        closeAnimation: 'right',
        icon: 'fa fa-warning',
        keyboardEnabled: true,
        confirm: function(){
            // $.alert('Confirmed!'); // shorthand.
        }
    });
}

