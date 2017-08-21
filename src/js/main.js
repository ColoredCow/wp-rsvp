jQuery(document).ready(function($) {
   fetch_all_guests();
   fetch_all_events();
  
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
          document.getElementById("msg3").innerHTML=result;
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
          document.getElementById("msg4").innerHTML=result;
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
      console.log(fetch_request);
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
});