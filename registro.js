$(document).ready(function() {
    $('#enviar').click(function() {
        const email = $('#email').val();
        
        
        if(email.indexOf('@') === -1) {
            alert('El correo electrónico debe contener @');
            return false;
        }
        
     
        if(email.split('@')[1].length === 0) {
            alert('El correo electrónico no es válido');
            return false;
        }
        
           
        return true;
    });
    
    $('#siguiente').on('click', function() {
        {
            $("#infopersonal").show();
            $("#InfoWeb").hide();
        }
        
    });
 
    });


