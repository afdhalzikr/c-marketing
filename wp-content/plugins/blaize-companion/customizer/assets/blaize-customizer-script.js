jQuery(document).ready(function ($) {

	/** Icon Picker Scripts **/
		$('.blaize-iconset li').click( function () {
			var icon = $(this).attr('data-icons');
			$(this).parents('.blaize-iconset').find('li').removeClass('active');
			$(this).addClass('active');

			$(this).parents('.blaize-iconset').prev('.current-icon').html('<i class="fas fa-'+icon+'"></i>');
			$(this).parents('.blaize-iconset').next('input:hidden').val(icon).trigger('change');
		});

	/** Radio Image Picker **/
		$('.blz-img-choices li').click( function () {
			var val = $(this).attr('data-val');

			$(this).parents('.blz-img-choices').find('li').removeClass('active');
			$(this).addClass('active');
			$(this).parents('.blz-img-choices').next('input:hidden').val(val).trigger('change');
		} );

	/** Category Multi-Select **/
		$('#ex-cat-wrap input:checkbox').on('change', function (e) {
	        e.preventDefault();
	        var chkbox = $('#ex-cat-wrap input:checkbox');
	        var id = '';
	        
	        $.each( chkbox, function () {
	            var oid = $(this).val(); 
	            
	            if($(this).attr('checked')) {
	                id += oid;
	                id += ','; 
	            }
	        });
	        
	        $('#ex-cat-wrap').next('input:hidden').val(id).change();
	    });

    /** Customizer Repeater **/
    	function blaize_refresh_repeater_values(){
	        $(".blz-repeater-field-control-wrap").each(function(){
	            
	            var values = []; 
	            var $this = $(this);
	            
	            $this.find(".blz-repeater-field-control").each(function(){
	            var valueToPush = {};   

	            $(this).find('[data-name]').each(function(){
	                var dataName = $(this).attr('data-name');
	                var dataValue = $(this).val();
	                valueToPush[dataName] = dataValue;
	            });

	            values.push(valueToPush);
	            });

	            $this.next('.blz-repeater-collector').val(JSON.stringify(values)).trigger('change');
	        });
	    }

	    $("body").on("click",'.blz-add-control-field', function(){

	        var $this = $(this).parent();
	        
	        if(typeof $this != 'undefined') {

	            var field = $this.find(".blz-repeater-field-control:first").clone();
	            if(typeof field != 'undefined'){
	                
	                field.find("input[type='text'][data-name]").each(function(){
	                    var defaultValue = $(this).attr('data-default');
	                    $(this).val(defaultValue);
	                });

	                field.find("textarea[data-name]").each(function(){
	                    var defaultValue = $(this).attr('data-default');
	                    $(this).val(defaultValue);
	                });

	                field.find("select[data-name]").each(function(){
	                    var defaultValue = $(this).attr('data-default');
	                    $(this).val(defaultValue);
	                });

	                field.find(".radio-labels input[type='radio']").each(function(){
	                    var defaultValue = $(this).closest('.radio-labels').next('input[data-name]').attr('data-default');
	                    $(this).closest('.radio-labels').next('input[data-name]').val(defaultValue);
	                    
	                    if($(this).val() == defaultValue){
	                        $(this).prop('checked',true);
	                    }else{
	                        $(this).prop('checked',false);
	                    }
	                });

	                field.find(".selector-labels label").each(function(){
	                    var defaultValue = $(this).closest('.selector-labels').next('input[data-name]').attr('data-default');
	                    var dataVal = $(this).attr('data-val');
	                    $(this).closest('.selector-labels').next('input[data-name]').val(defaultValue);

	                    if(defaultValue == dataVal){
	                        $(this).addClass('selector-selected');
	                    }else{
	                        $(this).removeClass('selector-selected');
	                    }
	                });
	                
	                field.find(".blz-icon-list").each(function(){
	                    var defaultValue = $(this).next('input[data-name]').attr('data-default');
	                    $(this).next('input[data-name]').val(defaultValue);
	                    $(this).prev('.blz-selected-icon').children('i').attr('class','').addClass(defaultValue);
	                    
	                    $(this).find('li').each(function(){
	                        var icon_class = $(this).find('i').attr('class');
	                        if(defaultValue == icon_class ){
	                            $(this).addClass('icon-active');
	                        }else{
	                            $(this).removeClass('icon-active');
	                        }
	                    });
	                });
	                
	                field.find('.blz-fields').show();

	                $this.find('.blz-repeater-field-control-wrap').append(field);

	                field.addClass('expanded').find('.blz-repeater-fields').show(); 
	                $('.accordion-section-content').animate({ scrollTop: $this.height() }, 1000);
	                blaize_refresh_repeater_values();
	            }

	        }
	        return false;
	    });
	    $('body').on('click', '.blz-icon-list li', function(){
	        var icon_class = $(this).find('i').attr('class');
	        $(this).addClass('icon-active').siblings().removeClass('icon-active');
	        $(this).parent('.blz-icon-list').prev('.blz-selected-icon').children('i').attr('class','').addClass(icon_class);
	        $(this).parent('.blz-icon-list').next('input').val(icon_class).trigger('change');
	        blaize_refresh_repeater_values();
	    });

	    $('body').on('click', '.blz-selected-icon', function(){
	        $(this).next().slideToggle();
	    });

	    $("#customize-theme-controls").on("click", ".blz-repeater-field-remove",function(){
	        if( typeof  $(this).parent() != 'undefined'){
	            $(this).closest('.blz-repeater-field-control').slideUp('normal', function(){
	                $(this).remove();
	                blaize_refresh_repeater_values();
	            });
	            
	        }
	        return false;
	    });
	    $('#customize-theme-controls').on('click', '.blz-repeater-field-close', function(){
	        $(this).closest('.blz-repeater-fields').slideUp();;
	        $(this).closest('.blz-repeater-field-control').toggleClass('expanded');
	    });
	    $('#customize-theme-controls').on('click','.blz-repeater-field-title',function(){
	        $(this).next().slideToggle();
	        $(this).closest('.blz-repeater-field-control').toggleClass('expanded');
	    });

	    // Set all variables to be used in scope
	    var frame;

	    // ADD IMAGE LINK
	    $('.customize-control-repeater').on( 'click', '.blz-upload-button', function( event ){
	    event.preventDefault();

	    var imgContainer = $(this).closest('.blz-fields-wrap').find( '.thumbnail-image'),
	    placeholder = $(this).closest('.blz-fields-wrap').find( '.placeholder'),
	    imgIdInput = $(this).siblings('.upload-id');

	    // Create a new media frame
	    frame = wp.media({
	        title: 'Select or Upload Image',
	        button: {
	        text: 'Use Image'
	        },
	        multiple: false  // Set to true to allow multiple files to be selected
	    });

	    // When an image is selected in the media frame...
	    frame.on( 'select', function() {

	    // Get media attachment details from the frame state
	    var attachment = frame.state().get('selection').first().toJSON();

	    // Send the attachment URL to our custom image input field.
	    imgContainer.html( '<img src="'+attachment.url+'" style="max-width:100%;"/>' );
	    placeholder.addClass('hidden');

	    // Send the attachment id to our hidden input
	    imgIdInput.val( attachment.url ).trigger('change');

	    });

	    // Finally, open the modal on click
	    frame.open();
	    });


	    // DELETE IMAGE LINK
	    $('.customize-control-repeater').on( 'click', '.blz-delete-button', function( event ){

	    event.preventDefault();
	    var imgContainer = $(this).closest('.blz-fields-wrap').find( '.thumbnail-image'),
	    placeholder = $(this).closest('.blz-fields-wrap').find( '.placeholder'),
	    imgIdInput = $(this).siblings('.upload-id');

	    // Clear out the preview image
	    imgContainer.find('img').remove();
	    placeholder.removeClass('hidden');

	    // Delete the image id from the hidden input
	    imgIdInput.val( '' ).trigger('change');

	    });

	    /*Drag and drop to change order*/
	    $(".blz-repeater-field-control-wrap").sortable({
	        orientation: "vertical",
	        update: function( event, ui ) {
	            blaize_refresh_repeater_values();
	        }
	    });
	    $("#customize-theme-controls").on('keyup change', '[data-name]',function(){
	         blaize_refresh_repeater_values();
	         return false;
	    });

	    $("#customize-theme-controls").on('change', 'input[type="checkbox"][data-name]',function(){
	        if($(this).is(":checked")){
	            $(this).val('yes');
	        }else{
	            $(this).val('no');
	        }
	        blaize_refresh_repeater_values();
	        return false;
	    });

    /** Section Reorder **/
	  function blaize_sections_order( container ){

	    var sections = $('#sub-accordion-panel-blaize_home_panel').sortable('toArray');
	    var s_ordered = [];
	    $.each(sections, function( index, s_id ) {
	      s_id = s_id.replace( "accordion-section-", "");
	      s_ordered.push(s_id);
	    });
	    console.log(s_ordered);
	    $.ajax({
	      url: BlaizeObj.ajax_url,
	      type: 'post',
	      dataType: 'html',
	      data: {
	        'action': 'blaize_reorder_home_section',
	        'sections': s_ordered,
	      }
	    })
	    .done( function( data ) {
	      wp.customize.previewer.refresh();
	    });

	  }

	  $('#sub-accordion-panel-blaize_home_panel').sortable({
	    helper: 'clone',
	    items: '> li.control-section:not(#accordion-section-blaize_slider_section)',
	    cancel: 'li.ui-sortable-handle.open',
	    delay: 150,
	    update: function( event, ui ) {

	      blaize_sections_order( $('#sub-accordion-panel-blaize_home_panel') );

	    },

	  });
});