
function formattedDate(date) {
   var d = new Date(date || Date.now()),
      month = '' + (d.getMonth() + 1),
      day = '' + d.getDate(),
      year = d.getFullYear();

   if (month.length < 2) month = 1 + parseInt(month);
   if (day.length < 2) day = 1 + parseInt(day);

   if (day < 10 ){
      di = '0'+day;
   }else{
      di = day;
   }
   return [year, month,di].join('-');
}

function Calendar() {
         // llamado a funcion de mantenimintos atrasados
         DetallesMantenimientos();
         //console.log("team")

         var param ={'Funcion':'AllCabinas'};
         $.ajax({
            data: JSON.stringify (param),
            type:"JSON",
            url: 'ajax.php',
            success:function(data){
                console.log("data", data);
               json = JSON.parse(data);
               htm = "";
               //console.log(data)
               
               var initialLangCode = 'es';
               var f = new Date();
               if (f.getDate() < 10 ){
                  di = '0'+f.getDate();
               }else{
                  di = f.getDate();
               }
               
               fechahoy  =f.getFullYear()+ "-" + (f.getMonth() + 1 ) + "-" + di ;
               //console.log(fechahoy + ' este es hoy')
               cal = $('#calendar_valida').val();
               $('#calendar'+cal).fullCalendar({
                  header: {
                     left: 'prev,next today',
                     center: 'title',  
                     right: 'month,agendaWeek,agendaDay'
                  },
                  defaultDate: $("#calendar").click(),
                  navLinks: true, // can click day/week names to navigate views
                  selectable: true,
                  selectHelper: true,

                  select: function(start, end) {
                     if(formattedDate(start._d) > fechahoy){
                        //console.log("SE PODRA REGISTRAR")
                        //console.log(   formattedDate(start._d)  )
                        //console.log(   fechahoy + ' fecha o ===================='  )
                        $('#myModal').modal('show')
                     }else{
                        //console.log('mal')
                        toastr.warning('No puedes Registar aca !', 'Esta fecha ya paso !' , {timeOut: 5000})
                     }

                     //console.log(start + "!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!")
                     //console.log(start._i[0]+"-"+start._i[1]+"-"+start._i[2]+" "+start._i[3]+":"+start._i[4]+":"+start._i[5])
                     if (start._i[3] != undefined) {
                        hora = start._i[3]+":"+start._i[4]+":"+start._i[5];
                     }else{
                        hora ="23:59:59";
                     }
                     //$('#fecha').val(formattedDate(start._d)+" "+hora)
                     var datefecha = f.getFullYear()+"-"+(f.getMonth() + 1 )+"-"+start._i[2];
                     $('#fecha').val(datefecha+" "+hora)
                     //console.log(formattedDate(start._d + ' !!!!!!!!!!11111'))
                     
                     $('#calendar').fullCalendar('unselect');
                  },

                  eventClick: function(date, jsEvent, view) {

                     //console.log(date.title)
                     var cab = date.title;
                     var cod = cab.split( ',' );

                     //console.log(cod[0])
                     ki(cod[0]) 
                  },
                  
                  editable: false,
                  lang: initialLangCode,
                  eventLimit: true, // allow "more" link when too many events
                  events: json

               });

               $(".fc-month-button").on( "click", function() {
                   // lo que queramos realizar
                  $('#calendar_valida_pos').val('month');
                  //console.log('month')
               });
               
               $(".fc-agendaDay-button").on( "click", function() {
                   // lo que queramos realizar
                  $('#calendar_valida_pos').val('agendaDay');
                  //console.log('agendaDay')
               });

               $(".fc-agendaWeek-button").on( "click", function() {
                   // lo que queramos realizar
                  $('#calendar_valida_pos').val('agendaWeek');
                  //console.log('agendaWeek')
               });

               $(".fc-"+$('#calendar_valida_pos').val()+"-button").click();
            

            
         } 
      });
}

function Hu(){
   //console.log(2323);
}

function DetallesMantenimientos() {
   var param ={'Funcion':'DetallesMantenimientosAtrasados'};
         $.ajax({
            data: JSON.stringify (param),
            type:"JSON",
            url: 'ajax.php',
            success:function(data){
               //console.log(data)
               htm = "<ul>";

               variable = JSON.parse(data)
               for ( i = 0; i< variable.length; i++ ) {
                  htm=htm + '<li style="color:red; font-family: arial;" onclick="ki('+variable[i]['codigo']+')">' + ' <i class="fa fa-wrench" aria-hidden="true"></i> ' + '<a href="#" style="color:red; font-family: arial;" >' + variable[i]['nombre']+'</a>' + '</li>';
               }
               html = "</ul>";
               $('#p-atrasados').html(i);
               $('#list_details').html(htm);              
            }
         });
}



$(document).ready(function(){

   $('.fc-day').click(function(){
      alert("hola");
   });

});

/*
function disable() {
   
   document.getElementById("pintura_i").disabled = true;
   document.getElementById("herraje_i").disabled = true;
   document.getElementById("sticker_i").disabled = true;
   document.getElementById("mant_general_i").disabled = true;
   document.getElementById("prot_teclado_i").disabled = true;
   document.getElementById("conectores_i").disabled = true;
   document.getElementById("cable_red_i").disabled = true;
   document.getElementById("cable_bocina_i").disabled = true;
   document.getElementById("material_mantenimiento_i").disabled = true;
   document.getElementById("tipo_materiales_i").disabled = true;
   document.getElementById("content_Mat_i").disabled = true;
   document.getElementById("tipo_materiales_i").disabled = true;
   document.getElementById("descripcion_mantenimiento_i").disabled = true;                   
   document.getElementById("tipo_i").disabled = true;  
   document.getElementById("estado_i").disabled = true; 
   document.getElementById("fecha_i").disabled = true;
}

function Nodisable() {
   document.getElementById("descripcion_i").disabled = false;
   document.getElementById("pintura_i").disabled = false;
   document.getElementById("herraje_i").disabled = false;
   document.getElementById("sticker_i").disabled = false;
   document.getElementById("mant_general_i").disabled = false;
   document.getElementById("prot_teclado_i").disabled = false;
   document.getElementById("conectores_i").disabled = false;
   document.getElementById("cable_red_i").disabled = false;
   document.getElementById("cable_bocina_i").disabled = false;
   document.getElementById("material_mantenimiento_i").disabled = false;
   document.getElementById("tipo_materiales_i").disabled = false;
   document.getElementById("content_Mat_i").disabled = false;
   document.getElementById("tipo_materiales_i").disabled = false;
   document.getElementById("descripcion_mantenimiento_i").disabled = false;                   
   document.getElementById("tipo_i").disabled = false;  
   document.getElementById("estado_i").disabled = false; 
   document.getElementById("fecha_i").disabled = false;
}
  
*/ 

function ki(cod){
   var param ={'Funcion':'CabinaDetalle', 'cod':cod};
   $.ajax({
      data: JSON.stringify (param),
      type:"JSON",
      url: 'ajax.php',
      success:function(data){
         //console.log(data + ' =========================')
         datos = JSON.parse(data)

         $('#responsable_i').val(datos[0]['responsable'])
         $('#cod_ca_i').val(datos[0]['cod_cabina'])
         
         $('#cod_i').val(datos[0]['cod'])

         $('#nombre_i').val(datos[0]['nombre'])
         $('#descripcion_i').val(datos[0]['descripcion'])
         //document.getElementById("descripcion_i").disabled = true;
            if ((datos[0]['descripcion']) == 'cabina') {
               $("#cabina_i").show('slow'); // mostrado
                  if ( (datos[0]['pintura']) == 1 )  {
                     $('#pintura_i').click();
                  }
                  if ( (datos[0]['herraje']) == 1 )  {
                     $('#herraje_i').click();
                  }
                  if ( (datos[0]['sticker']) == 1 )  {
                     $('#sticker_i').click();
                  }
               $("#telefono_i").hide('slow'); // oculto
               $('#tipo_materiales_i').hide('slow'); // ocultos
            }else if ((datos[0]['descripcion']) == 'telefono') {
               $("#cabina_i").hide('slow'); // oculto
               $("#telefono_i").show('slow'); // mostrado
                  if ( (datos[0]['mant_general']) == 1 )  {
                     $('#mant_general_i').click();
                  }
                  if ( (datos[0]['prot_teclado']) == 1 )  {
                     $('#prot_teclado_i').click();
                  }
                  if ( (datos[0]['conectores']) == 1 )  {
                     $('#conectores_i').click();
                  }
                  if ( (datos[0]['cable_red']) == 1 )  {
                     $('#cable_red_i').click();
                  }
                  if ( (datos[0]['cable_bocina']) == 1 )  {
                     $('#cable_bocina_i').click();
                  }
                  if ( (datos[0]['material_mantenimiento']) == 1 )  {
                     $('#material_mantenimiento_i').click();                     
                  }
               $('#tipo_materiales_i').show('slow'); // mostrado
            }else {
               $("#cabina_i").hide('slow'); // ocultos
               $("#telefono_i").hide('slow'); // ocultos
               $('#tipo_materiales_i').hide('slow'); // ocultos
            }
         $('#descripcion_mantenimiento_i').val(datos[0]['descripcion_mantenimiento'])           
         $('#tipo_materiales_i').val(datos[0]['tipo_materiales'])
         
         $('#tipo_i').val(datos[0]['tipo'])

         $('#estado_i').val(datos[0]['estado'])
         if ( (datos[0]['estado']) != 1) {
            if ( (datos[0]['estado']) == 2) { 
             // mantenimientos pendientes
               $("#update").show();
               $("#delete").show(); 
               //$("#pendiente").show(); 
               $("#atrasado").hide()
               //document.getElementById("descripcion_i").disabled = false;              
               //document.getElementById("descripcion_i").disabled = true;
               //Nodisable();                       
            }else { 
             // mantenimientos atrasados
               $("#update").show();
               $("#delete").show();
               $("#pendiente").hide(); 
               //document.getElementById("descripcion_i").disabled = false;              
              //disable();
            }
         }else{
          // mantenimientos ejecutados
            $("#update").hide(); // botton oculto
            $("#delete").hide(); // botton 
            $('#fecha_ejecutado_i').val(datos[0]['fecha_ejecutado']) ;
            //document.getElementById("estado_i").disabled = true;
            //document.getElementById("fecha_ejecutado_i").disabled = true;
            //disable();          
             
         }
          
         $('#fecha_i').val(datos[0]['fecha'])  
         $('#modal-contact').modal('show')
      }
   });
}  
 

