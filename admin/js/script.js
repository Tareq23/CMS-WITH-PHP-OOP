
$(document).ready(function(){
    //CK Editor

    ClassicEditor
            .create( document.querySelector( '#post-content' ) )
            .catch( error => {
                console.error( error );
            } );
    //REST OF THE EDITOR
});


$(document).ready(function(){
    $('#selectAllBoxes').click(function(event){
        if(this.checked){
            $('.checkBox').each(function(){
                this.checked = true;
            });
        }
        else{
            $('.checkBox').each(function(){
                this.checked = false;
            });
        }
    });
});




