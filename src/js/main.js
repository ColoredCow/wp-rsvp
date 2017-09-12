jQuery(document).ready(function($) {
   fetch_all_guests();
   fetch_all_events();
   fetch_select_events();
   $('#loading').hide();
    
    $("#add_event").on("click",function() {
      var requestForm=$('#add_event_form');                      
        if(!requestForm[0].checkValidity() ) {
            requestForm[0].reportValidity();
            return;
          }  else {  
              ajax_add_event_form();
              $('#add_event_form').trigger('reset');
            }
    });

    function ajax_add_event_form() {
      var add_event_form ="action=add_event&"+$('#add_event_form').serialize();
      $.ajax({
        type: 'POST',
        url:PARAMS.ajaxurl,
        data:add_event_form,
        success:function(result){
          document.getElementById("successfull_event_message").innerHTML=result;
        }
      });
    }

    $("#add_guest").on("click",function(){
        var requestForm=$('#add_guest_form');                      
        if(!requestForm[0].checkValidity()){
          requestForm[0].reportValidity();
          return; 
        } else {  
            ajax_add_guest_form();
            $('#add_guest_form').trigger('reset');
          } 
    });

    function ajax_add_guest_form(){
      var add_guest_form ="action=add_guest&"+$('#add_guest_form').serialize();
      $.ajax({
        type: 'POST',
        url:PARAMS.ajaxurl,
        data:add_guest_form,
        success:function(result){
          document.getElementById("successfull_guest_message").innerHTML=result;
        }
      });
    }

    function fetch_all_events(){
       var fetch_events ="action=show_all_events";
        $.ajax({
           type:'POST',
           url:PARAMS.ajaxurl,
           data:fetch_events,
           success:function(result){
              $("#show_all_events").html(result);
          }
      });
    }

    function fetch_all_guests(){
       var fetch_guests ="action=show_all_guests";
        $.ajax({
           type:'POST',
           url:PARAMS.ajaxurl,
           data:fetch_guests,
           success:function(result){
              $("#show_all_guests").html(result);
          }
      });
    }

    $(document).on("click",'.send',function(){
      var check1=confirm("Are You Sure you want to delete this event?");
      if (check1==true) {
        var event_id=$(this).attr('id');
        delete_event(event_id);
      }
    });

    function delete_event(event_id){
      var event_id = event_id;
      var fetch_request ="action=delete_event_details&event_id="+event_id;
      $.ajax({
        type:'POST',
        url:PARAMS.ajaxurl,
        data:fetch_request,
        success:function(result){        
          fetch_all_events();
        }
      });
    }

    $(document).on("click",'.delete',function(){
      var check2=confirm("Are You Sure you want to delete this guest?");
      if (check2==true) {
        var guest_id=$(this).attr('id');
        delete_guest(guest_id);
      }
    });

    function delete_guest(guest_id){
      var guest_id = guest_id;
      var delete_request ="action=delete_guest_details&guest_id="+guest_id;
      $.ajax({
        type:'POST',
        url:PARAMS.ajaxurl,
        data:delete_request,
        success:function(result){        
            fetch_all_guests();
          }
      });
    }   

    function fetch_select_events(){
       var fetch_select_events ="action=fetch_select_events";
        $.ajax({
           type:'POST',
           url:PARAMS.ajaxurl,
           data:fetch_select_events,
           success:function(result){
              $("#show_fetch_select_events").html(result);
          }
      });
    }

    $('#show_fetch_select_events').on("#status").change(function() {
        var event_id = $('#status').val();
       fetch_all_guest_invitation(event_id);
       show_email_template(event_id);
    });

    function show_email_template(event_id){
      var event_id = event_id;
      var show_email_template ="action=show_email_template&event_id="+event_id;
        $.ajax({
          type:'POST',
          url:PARAMS.ajaxurl,
          data:show_email_template,
            success:function(result){
              $("#show_email_template").html(result);
            }
        });
    }


    $(document).on("click",'.test-email',function(){ 
      $('#loading').show();
      var test_email_form ="action=send_test_mail&"+$('#email_form').serialize();
      $.ajax({
        type: 'POST',
        url:PARAMS.ajaxurl,
        data:test_email_form,
        success:function(result){
          $("#email_test_result").html(result);
          $('#loading').hide();
        }
      });
    });

    $(document).on("click",'.hide-email',function(){   
      $('#email-temp').hide();
    });

    $(document).on("click",'.email',function(){   
     $('#email-temp').show();
    });


    function fetch_all_guest_invitation(event_id){
      var event_id = event_id;
      var fetch_guest_invitation ="action=show_all_guest_invitation&event_id="+event_id;
        $.ajax({
          type:'POST',
          url:PARAMS.ajaxurl,
          data:fetch_guest_invitation,
            success:function(result){
              $("#show_all_guest_invitation").html(result);
            }
        });
    }

    $(document).on("click",'.sends',function(){    
        var guest_id=$(this).attr('id');
        var event_id=$(this).attr('value');
        $('#loading').show();
       send(guest_id,event_id); 
    });

    function send(guest_id,event_id){
        var guest_id= guest_id;
        var event_id= event_id;        
        var send_id ="action=send_message&guest_id="+guest_id+"&event_id="+event_id+"&"+$('#email_form').serialize();
        $.ajax({
            type:'POST',
            url:PARAMS.ajaxurl,
            data:send_id,
            success:function(result){
              fetch_all_guest_invitation(event_id);
              $('#loading').hide();
              $("#successfull_send_message").html(result);
            }
        });
    }
});