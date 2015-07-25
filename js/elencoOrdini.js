/* 
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */

$(document).ready(function () {
    
    $(".error").hide();
    $("#tabella_ordini").hide();
    
    $('#filtra').click(function(e){
        
        // impedisco il submit
        e.preventDefault(); 
        var _status = $( "#status option:selected" ).attr('value');
        if(_status === 'qualsiasi'){
            _status = '';
        }
        //var _ordine = $("#ordine").val();
        //var _cliente = $("#cliente").val();
        //var _cognome = $("#cognome").val();
        //var _data = $("#data").val();
        
        var par = {
            //ordine : _ordine,
            status: _status,
        //    data:_data,
            //cliente: _cliente,
        //    cognome:_cognome
            
        };
        
        $.ajax({
            url: 'gestore/filtra_ordini',
            data : par,
            dataType: 'json',
            
            success: function (data, state) {
                
                if(data['errori'].length === 0){
                    // nessun errore
                    $(".error").hide();
                    if(data['ordini'].length === 0){
                        // mostro il messaggio per nessun elemento
                        $("#nessuno").show();
                       
                        // nascondo la tabella
                        $("#tabella_ordini").hide();
                    }else{
                        // nascondo il messaggio per nessun elemento
                        
                        $("#nessuno").hide();
                        $("#tabella_ordini").show();
                        //cancello tutti gli elementi dalla tabella
                        $("#tabella_ordini tbody").empty();
                       
                        // aggingo le righe
                        var i = 0;
                        for(var key in data['ordini']){
                            var esame = data['ordini'][key];
                            $("#tabella_ordini tbody").append(
                                "<tr id=\"row_" + i + "\" >\n\
                                       <td>a</td>\n\
                                       <td>\n\
                                          <ul class=\"none no-space\" id=\"com_"+ i + "\" >\n\
                                          </ul>\n\
                                       </td>\n\
                                 </tr>");
                            if(i%2 == 0){
                                $("#row_" + i).addClass("alt-row");
                            }
                            
                            var colonne = $("#row_"+ i +" td");
                            $(colonne[1]).text(esame['status']);
                            $(colonne[1]).text('bo']);
                            i++;
                            
                           
                        }
                    }
                }else{
                    
                    $(".error").show();
                    $(".error ul").empty();
                    for(var k in data['errori']){
                        $(".error ul").append("<li>"+ data['errori'][k] + "<\li>");
                    }
                }
               
            },
         
            error: function (data, state) {
            }
        
        });
        
        
    })
});
