$(document).ready(function () {
    var navListItems = $('div.setup-panel div a'),
            allWells = $('.setup-content'),
            allNextBtn = $('.nextBtn'),
            allPrevBtn = $('.prevBtn');
  
    allWells.hide();
  
    navListItems.click(function (e) {
        e.preventDefault();
        //console.log("navListItems");
        var $target = $($(this).attr('href')),
                $item = $(this);
  
        if (typeof $(this).attr('disabled')== 'undefined' || $(this).attr('disabled') == false) {
            navListItems.removeClass('btn-primary').addClass('btn-default');
            $item.addClass('btn-primary').removeClass('btn-default');
            allWells.hide();
            $target.show();
            $target.find('input:eq(0)').focus();
            
            if($(this).text()=="4"){
                $('div.choosen-datetime').empty();
                $('div.choosen-datetime').prepend('<p>'+ (new Date($('#start-datetime').val())).toLocaleString('en-AU', {
                    hour12: true,
                })+'</p>');

                var checkboxes= $("input.btn-check");
                var count=0;
                var totalTime=0;
                var totalCost=0;
                $('div.package-summary').empty();
                for(var i=0; i<checkboxes.length; i++){
                    if (checkboxes.eq(i).is(':checked') && checkboxes.eq(i).attr("value")=='1') {
                        count++;
                        totalTime+=parseInt(checkboxes.eq(i).attr("time-duration"));
                        totalCost+=parseInt(checkboxes.eq(i).attr("price"));
                        
                        $('div.package-summary').prepend( "<p>"+checkboxes.eq(i).attr("package")+"</p>" );
                        //console.log('h');
                    }
                }
                if(count==0){
                    isValid=false;
                    for(var i=0; i<checkboxes.length; i++){
                        checkboxes.eq(i).addClass("has-error");
                        
                    }
                    
                    $( "<h4 class='error-message'>Please select at least one package to book</h4>" ).insertAfter($('h3:contains("packages")'));
                }
                else {
                    var m = totalTime % 60;
                    var h = (totalTime-m)/60;
                    var formatTime= (h>0? h.toString() + " hours " : "") + (m < 10 ? "0" : "") + m.toString() + " minutes";
                    $('#total-time-duration').text( formatTime);
                    $('#total-time').text( formatTime);
                    $('#total-price').text( 'AUD'+totalCost.toString());
                    //console.log(h)
                    //console.log(totalTime)
                }
            }
        }
    });
    
    allPrevBtn.click(function(){
        //console.log("prevButton");
        var curStep = $(this).closest(".setup-content"),
            curStepBtn = curStep.attr("id"),
            prevStepWizard = $('div.setup-panel div a[href="#' + curStepBtn + '"]').parent().prev().children("a");
  
            prevStepWizard.removeAttr('disabled').trigger('click');
    });
  
    allNextBtn.click(function(){
        //console.log("nextbutton");
        var curStep = $(this).closest(".setup-content"),
            curStepBtn = curStep.attr("id"),
            nextStepWizard = $('div.setup-panel div a[href="#' + curStepBtn + '"]').parent().next().children("a"),
            curInputs = curStep.find("input[type='text'],input[type='url'],input[type='datetime-local']"),
            isValid = true;
  
        $(".input").removeClass("has-error");
        for(var i=0; i<curInputs.length; i++){
            if (!curInputs[i].validity.valid){
                isValid = false;
                $(curInputs[i]).closest(".input").addClass("has-error");
            }
        }

        if($(this).hasClass("first")){
            var checkboxes= $("input.btn-check");
            var count=0;
            var totalTime=0;
            var totalCost=0;
            $("h4.error-message").remove();
            $('div.package-summary').empty();
            for(var i=0; i<checkboxes.length; i++){
                if (checkboxes.eq(i).is(':checked')) {
                    count++;
                    totalTime+=parseInt(checkboxes.eq(i).attr("time-duration"));
                    totalCost+=parseInt(checkboxes.eq(i).attr("price"));
                    
                    $('div.package-summary').prepend( "<p>"+checkboxes.eq(i).attr("package")+"</p>" );
                    //console.log('h');
                }
            }
            if(count==0){
                isValid=false;
                for(var i=0; i<checkboxes.length; i++){
                    checkboxes.eq(i).addClass("has-error");
                    
                }
                
                $( "<h4 class='error-message'>Please select at least one package to book</h4>" ).insertAfter($('h3:contains("Packages")'));
            }
            else {
                $('#total-price').text( 'AUD'+totalCost.toString());
            }

            //console.log("H");
        }

        if($(this).hasClass("third")){
            $('div.choosen-datetime').empty();
            $('div.choosen-datetime').prepend('<p>'+ (new Date($('#start-datetime').val())).toLocaleString('en-AU', {
                hour12: true,
            })+'</p>');

            var checkboxes= $("input.btn-check");
            //var count=0;
            //var totalTime=0;
            var totalCost=0;
            $('div.package-summary').empty();
            for(var i=0; i<checkboxes.length; i++){
                if (checkboxes.eq(i).is(':checked')) {
                    count++;
                    totalCost+=parseInt(checkboxes.eq(i).attr("cost"));
                    
                    $('div.package-summary').prepend( "<p>"+checkboxes.eq(i).attr("package")+"</p>" );
                    //console.log('h');
                }
            }
            if(count==0){
                isValid=false;
                for(var i=0; i<checkboxes.length; i++){
                    checkboxes.eq(i).addClass("has-error");
                    
                }
                
                $( "<h4 class='error-message'>Please select at least one package to book</h4>" ).insertAfter($('h3:contains("packages")'));
            }
            else {
                $('#total-price').text( 'AUD'+totalCost.toString());
            }
        }
  
        if (isValid)
            nextStepWizard.removeAttr('disabled').trigger('click');
    });
  
    $('div.setup-panel div a.btn-primary').trigger('click');

});