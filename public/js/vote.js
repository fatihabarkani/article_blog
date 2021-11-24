$(function(){

    $('#vote_plus, #vote_moins').on('click', ()=>{
        requeteAjax();
    })
})

function requeteAjax(){
    $.ajax({
        url: window.location.origin + '/article/vote',
        dataType : 'json',
        success: (data) =>  {
            console.log(data);
            $('#nombre_votes').text(data.votes)
        }  
    
    })
}