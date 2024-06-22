$(document).ready(function(){
    $("#president").click(function(){ //if we click the button with id president,the gambar element will be unhidden and 
      $("#gambar").toggle(500);       //we can see the image of the position. 500 means a little bit delay of time to unhidden picture will have
    });                               //when we click the button. when we click back the button it will hid back the picture
    $("#chief").click(function(){
      $("#gambar1").toggle(500);
    });
    $("#dep-pres").click(function(){          //every line is basically same function just change the id of the button
        $("#gambar2").toggle(500);
      });
    $("#secretary").click(function(){
        $("#gmbr-secretary").toggle(500);
      });
    $("#vice-secretary").click(function(){
        $("#gmbr-vice-secretary").toggle(500);
      });
    $("#treasurer").click(function(){
        $("#gmbr-treasurer").toggle(500);
      });
    $("#vice-treasurer").click(function(){
        $("#gmbr-vice-treasurer").toggle(500);
      });
    $("#vice-president-1").click(function(){
        $("#gmbr-vice-president-1").toggle(500);
      });
    $("#vice-president-2").click(function(){
        $("#gmbr-vice-president-2").toggle(500);
      });
    $("#Intellectual").click(function(){
        $("#gmbr-intellectual").toggle(500);
      });
      $("#Islamization").click(function(){
        $("#gmbr-islamization").toggle(500);
      });
      $("#Activisme").click(function(){
        $("#gmbr-activisme").toggle(500);
      });
      $("#Media").click(function(){
        $("#gmbr-multimedia").toggle(500);
      });
  });