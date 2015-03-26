/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */


$(document).on("click", ".editPlaysFor", function () {
     var pid = $(this).data('pid');
     var gp = $(this).data('gp');
     var goals = $(this).data('goals');
     var hits = $(this).data('hits');
     var ga = $(this).data('ga');
     var ta = $(this).data('ta');
     var pd = $(this).data('pd');
     var sac = $(this).data('sac');
     var qot = $(this).data('qot');
     var qoc = $(this).data('qoc');
     var ozs = $(this).data('ozs');
     var toi = $(this).data('toi');
     var player = $(this).data('player'); 
     var team = $(this).data('team'); 
     var season = $(this).data('season'); 
     $("#edit-modal-title").text(player + "'s " + season + " season with the " + team);
     $(".modal-body #playerID").val( pid );
     $(".modal-body #teamName").val( team );
     $(".modal-body #season").val( season );
     $(".modal-body #gp").val( gp );
     $(".modal-body #goals").val( goals );
     $(".modal-body #hits").val( hits );
     $(".modal-body #ga").val( ga );
     $(".modal-body #ta").val( ta );
     $(".modal-body #pd").val( pd );
     $(".modal-body #sac").val( sac );
     $(".modal-body #qot").val( qot );
     $(".modal-body #qoc").val( qoc );
     $(".modal-body #ozs").val( ozs );
     $(".modal-body #toi").val( toi );

});

    
