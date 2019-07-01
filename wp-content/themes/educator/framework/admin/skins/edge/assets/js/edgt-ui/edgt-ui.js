(function($){
	$(document).ready(function() {
		//plugins init goes here
		edgtInitSelectChange();
		edgtInitSwitch();
        edgtInitSaveCheckBoxesValue();
        edgtCheckBoxMultiSelectInitState();
        edgtInitCheckBoxMultiSelectChange();
		edgtInitTooltips();
		edgtInitColorpicker();
		edgtInitRangeSlider();
		edgtInitMediaUploader();
		edgtInitGalleryUploader();
		if ($('.edgt-page-form').length > 0) {
			edgtInitAjaxForm();
			edgtAnchorSelectOnLoad();
			edgtScrollToAnchorSelect();
			initTopAnchorHolderSize();
			edgtCheckVisibilityOfAnchorButtons();
			edgtCheckVisibilityOfAnchorOptions();
			edgtCheckAnchorsOnDependencyChange();
			edgtCheckOptionAnchorsOnDependencyChange();
			edgtChangedInput();
			edgtFixHeaderAndTitle();
			totop_button();
			backButtonShowHide();
			backToTop();
            edgtInitSelectPicker();
		}
		edgtInitPortfolioImagesVideosBox();
		edgtInitPortfolioMediaAcc();
		edgtInitPortfolioItemsBox();
		edgtInitPortfolioItemAcc();
        edgtInitSlideElementItemAcc();
        edgtInitSlideElementItemsBox();
		edgtInitDatePicker();
		edgtShowHidePostFormats();
		edgtPageTemplatesMetaBoxDependency();
        edgtRepeater();
        edgtInitSortable();
		edgtImportOptions();
		edgtImportCustomSidebars();
		edgtImportWidgets();
		edgtInitImportContent();
		edgtSelect2();
    });

	function edgtFixHeaderAndTitle () {
		var pageHeader 				= $('.edgt-page-header');
		var pageHeaderHeight		= pageHeader.height();
		var adminBarHeight			= $('#wpadminbar').height();
		var pageHeaderTopPosition 	= pageHeader.offset().top - parseInt(adminBarHeight);
		var pageTitle				= $('.edgt-page-title');
		var pageTitleTopPosition	= pageHeaderHeight + adminBarHeight - parseInt(pageTitle.css('marginTop'));
		var tabsNavWrapper			= $('.edgt-tabs-navigation-wrapper');
		var tabsNavWrapperTop		= pageHeaderHeight;
		var tabsContentWrapper	    = $('.edgt-tab-content');
		var tabsContentWrapperTop	= pageHeaderHeight + pageTitle.outerHeight();

		$(window).on('scroll load', function() {
			if($(window).scrollTop() >= pageHeaderTopPosition) {
				pageHeader.addClass('edgt-header-fixed').css('top', parseInt(adminBarHeight));
				pageTitle.addClass('edgt-page-title-fixed').css('top', pageTitleTopPosition);
				tabsNavWrapper.css('marginTop', tabsNavWrapperTop);
				tabsContentWrapper.css('marginTop', tabsContentWrapperTop);
			} else {
				pageHeader.removeClass('edgt-header-fixed').css('top', 0);
				pageTitle.removeClass('edgt-page-title-fixed').css('top', 0);
				tabsNavWrapper.css('marginTop', 0);
				tabsContentWrapper.css('marginTop', 0);
			}
		});
	}

	function initTopAnchorHolderSize() {
		function initTopSize() {
			var optionsPageHolder = $('.edgt-options-page');
			var anchorAndSaveHolder = $('.edgt-top-section-holder');
			var pageTitle = $('.edgt-page-title');
			var tabsContentWrapper = $('.edgt-tabs-content');

			anchorAndSaveHolder.css('width', optionsPageHolder.width() - parseInt(anchorAndSaveHolder.css('margin-left')));
			pageTitle.css('width', tabsContentWrapper.outerWidth());
		}

		initTopSize();

		$(window).on('resize', function() {
			initTopSize();
		});
	}

	function edgtScrollToAnchorSelect() {
		var selectAnchor = $('#edgt-select-anchor');
		selectAnchor.on('change', function() {
			var selectAnchor = $('option:selected', selectAnchor);
			if(typeof selectAnchor.data('anchor') !== 'undefined') {
				edgtScrollToPanel(selectAnchor.data('anchor'));
			}
		});
	}

	function edgtAnchorSelectOnLoad() {
		var currentPanel = window.location.hash;
		if(currentPanel) {
			var selectAnchor = $('#edgt-select-anchor');
			var currentOption = selectAnchor.find('option[data-anchor="'+currentPanel+'"]').first();

			if(currentOption) {
				currentOption.attr('selected', 'selected');
			}
		}
	}

	function edgtScrollToPanel(panel) {
		var pageHeader 				= $('.edgt-page-header');
		var pageHeaderHeight		= pageHeader.height();
		var adminBarHeight			= $('#wpadminbar').height();
		var pageTitle				= $('.edgt-page-title');
		var pageTitleHeight			= pageTitle.outerHeight();

		var panelTopPosition = $(panel).offset().top - adminBarHeight - pageHeaderHeight - pageTitleHeight;

		$('html, body').animate({
			scrollTop: panelTopPosition
		}, 1000);

		return false;
	}

	function totop_button(a) {
		"use strict";

		var b = $("#back_to_top");
		b.removeClass("off on");
		if (a === "on") { b.addClass("on"); } else { b.addClass("off"); }
	}

	function backButtonShowHide(){
		"use strict";

		$(window).scroll(function () {
			var b = $(this).scrollTop();
			var c = $(this).height();
			var d;
			if (b > 0) { d = b + c / 2; } else { d = 1; }
			if (d < 1e3) { totop_button("off"); } else { totop_button("on"); }
		});
	}

	function backToTop(){
		"use strict";

		$(document).on('click','#back_to_top',function(){
			$('html, body').animate({
				scrollTop: $('html').offset().top}, 1000);
			return false;
		});
	}
	
	function edgtChangedInput () {
		$('.edgt-tabs-content form.edgt_ajax_form:not(.edgt-import-page-holder):not(.edgt-backup-options-page-holder)').on('change keyup keydown', 'input:not([type="submit"]), textarea, select', function (e) {
			$('.edgt-input-change').addClass('yes');
		});

		$('.edgt-tabs-content form.edgt_ajax_form:not(.edgt-import-page-holder):not(.edgt-backup-options-page-holder) .field.switch label:not(.selected)').click( function() {
			$('.edgt-input-change').addClass('yes');
		});

		$('.edgt-tabs-content form.edgt_ajax_form:not(.edgt-import-page-holder):not(.edgt-backup-options-page-holder) #anchornav input').click(function() {
			if ($('.edgt-input-change.yes').length) {
				$('.edgt-input-change.yes').removeClass('yes');
			}
			$('.edgt-changes-saved').addClass('yes');
			setTimeout(function(){$('.edgt-changes-saved').removeClass('yes');}, 3000);
		});

		$(window).on('beforeunload', function () {
			if ($('.edgt-input-change.yes').length) {
				return 'You haven\'t saved your changes.';
			}
		});
	}

	function edgtCheckVisibilityOfAnchorButtons () {

		$('.edgt-page-form > div:hidden').each( function() {
			var $panelID =  $(this).attr('id');
			$('#anchornav a').each ( function() {
				if ($(this).attr('href') == '#'+$panelID) {
					$(this).parent().hide();//hide <li>s
				}
			});
		})
	}

	function edgtCheckVisibilityOfAnchorOptions() {
		$('.edgt-page-form > div:hidden').each( function() {
			var $panelID =  $(this).attr('id');
			$('#edgt-select-anchor option').each ( function() {
				if ($(this).data('anchor') == '#'+$panelID) {
					$(this).hide();//hide <li>s
				}
			});
		})
	}

	function edgtGetArrayOfHiddenElements(changedElement) {
		var hidden_elements_string = changedElement.data('hide');
		hidden_elements_array = [];
		if(typeof hidden_elements_string !== 'undefined' && hidden_elements_string.indexOf(",") >= 0) {
			var hidden_elements_array = hidden_elements_string.split(',');
		} else {
			var hidden_elements_array = new Array(hidden_elements_string);
		}

		return hidden_elements_array;
	}

	function edgtGetArrayOfShownElements(changedElement) {
		//check for links to show
		var shown_elements_string = changedElement.data('show');
		shown_elements_array = [];
		if(typeof shown_elements_string !== 'undefined' && shown_elements_string.indexOf(",") >= 0) {
			var shown_elements_array = shown_elements_string.split(',');
		} else {
			var shown_elements_array = new Array(shown_elements_string);
		}

		return shown_elements_array;
	}
	
	function edgtGetArrayOfHiddenElementsSelectBox(changedElement,changedElementValue) {
        var hidden_elements_string = changedElement.data('hide-'+changedElementValue);
        hidden_elements_array = [];
        if(typeof hidden_elements_string !== 'undefined' && hidden_elements_string.indexOf(",") >= 0) {
            var hidden_elements_array = hidden_elements_string.split(',');
        } else {
            var hidden_elements_array = new Array(hidden_elements_string);
        }

        return hidden_elements_array;
    }

    function edgtGetArrayOfShownElementsSelectBox(changedElement,changedElementValue) {
        //check for links to show
        var shown_elements_string = changedElement.data('show-'+changedElementValue);
        shown_elements_array = [];
        if(typeof shown_elements_string !== 'undefined' && shown_elements_string.indexOf(",") >= 0) {
            var shown_elements_array = shown_elements_string.split(',');
        } else {
            var shown_elements_array = new Array(shown_elements_string);
        }

        return shown_elements_array;
    }

	function edgtCheckAnchorsOnDependencyChange(){
		$(document).on('click','.cb-enable.dependence, .cb-disable.dependence',function(){
			var hidden_elements_array = edgtGetArrayOfHiddenElements($(this));
			var shown_elements_array  = edgtGetArrayOfShownElements($(this));

			//show all buttons, but hide unnecessary ones
			$.each(hidden_elements_array, function(index, value){
				$('#anchornav a').each ( function() {

					if ($(this).attr('href') == value) {
						$(this).parent().hide();//hide <li>s
					}
				});
			});
			$.each(shown_elements_array, function(index, value){
				$('#anchornav a').each ( function() {
					if ($(this).attr('href') == value) {
						$(this).parent().show();//show <li>s
					}
				});
			});
		});
		
		$(document).on('change','.edgt-form-element.dependence',function(){
            hidden_elements_array = edgtGetArrayOfHiddenElementsSelectBox($(this),$(this).val());
            shown_elements_array  = edgtGetArrayOfShownElementsSelectBox($(this),$(this).val());

            //show all buttons, but hide unnecessary ones
            $.each(hidden_elements_array, function(index, value){
                $('#anchornav a').each ( function() {

                    if ($(this).attr('href') == value) {
                        $(this).parent().hide();//hide <li>s
                    }
                });
            });
            $.each(shown_elements_array, function(index, value){
                $('#anchornav a').each ( function() {
                    if ($(this).attr('href') == value) {
                        $(this).parent().show();//show <li>s
                    }
                });
            });
        });
	}

	function edgtCheckOptionAnchorsOnDependencyChange() {
		$(document).on('click','.cb-enable.dependence, .cb-disable.dependence',function(){
			var hidden_elements_array = edgtGetArrayOfHiddenElements($(this));
			var shown_elements_array  = edgtGetArrayOfShownElements($(this));

			//show all buttons, but hide unnecessary ones
			$.each(hidden_elements_array, function(index, value){
				$('#edgt-select-anchor option').each ( function() {

					if ($(this).data('anchor') == value) {
						$(this).hide();//hide option
					}
				});
			});
			$.each(shown_elements_array, function(index, value){
				$('#edgt-select-anchor option').each ( function() {
					if ($(this).data('anchor') == value) {
						$(this).show();//show option
					}
				});
			});

			$('#edgt-select-anchor').selectpicker('refresh');
		});
		
		$(document).on('change','.edgt-form-element.dependence',function(){
            hidden_elements_array = edgtGetArrayOfHiddenElementsSelectBox($(this),$(this).val());
            shown_elements_array  = edgtGetArrayOfShownElementsSelectBox($(this),$(this).val());

            //show all buttons, but hide unnecessary ones
            $.each(hidden_elements_array, function(index, value){
                $('#edgt-select-anchor option').each ( function() {

                    if ($(this).data('anchor') == value) {
                        $(this).hide();//hide option
                    }
                });
            });
            $.each(shown_elements_array, function(index, value){
                $('#edgt-select-anchor option').each ( function() {
                    if ($(this).data('anchor') == value) {
                        $(this).show();//show option
                    }
                });
            });

            $('#edgt-select-anchor').selectpicker('refresh');
        });
	}

	function edgtInitSelectChange() {
	    var selectBox = $('select.dependence');
	    selectBox.each(function() {
            initialHide($(this), this);
        });
        selectBox.on('change', function (e) {
            initialHide($(this), this);
		});

        function initialHide(selectField, selectObject) {
            var valueSelected = selectObject.value.replace(/ /g, '');
            $(selectField.data('hide-'+valueSelected)).fadeOut();
            $(selectField.data('show-'+valueSelected)).fadeIn();
        }

		var switchers = $('select.edgt-switcher');
		switchers.each(function() {
            changeActions($(this), $(this).val(), true);
        });

        switchers.on('change', function (e) {
            var valueSelected = this.value.replace(/ /g, '');
            changeActions($(this), valueSelected, false);
        });

        function changeActions(selectField, valueSelected, initialCall) {
            var switchType = selectField.data('switch-type');
            var switchProperty = selectField.data('switch-property');
            var switchEnabled = selectField.data('switch-enabled');

            if (switchType === 'single_yesno') {
                var switchers = $('.switch-' + switchProperty);
                if (switchEnabled === valueSelected) {
                    switchers.addClass('edgt-switch-single-mode');
                    switchers.attr('data-switch-selector', switchProperty);
                } else {
                    switchers.removeClass('edgt-switch-single-mode');
                    switchers.removeAttr('data-switch-selector');
                }

                //On property change leave only one switcher enabled
                if(!initialCall) {
                    var oneSwitcherEnabled = false;
                    switchers.removeClass('switcher-auto-enabled');
                    switchers.each(function () {
                        var switcher = $(this);
                        var enabled = $(this).find('.cb-enable');
                        if (!oneSwitcherEnabled && enabled.hasClass('selected')) {
                            oneSwitcherEnabled = true;
                            $(this).addClass('switcher-auto-enabled');
                        }
                        if (!switcher.hasClass('switcher-auto-enabled')) {
                            switcher.find('.cb-disable').addClass('selected');
                            switcher.find('.cb-enable').removeClass('selected');
                            switcher.find('.checkbox').attr('checked', false);
                            switcher.find('.checkboxhidden_yesno').val("no");
                        }
                    });
                }
            }
        }

	}

	function edgtInitSwitch() {
	    //Logic for setting element initial to be no
	    var yesNoElements = $(".switch");
	    yesNoElements.each(function () {
            var element = $(this);
            if (element.parents('.edgt-repeater-field') && !element.find('input[type="hidden"]').val()) {
                element.find('.cb-enable').removeClass('selected');
                element.find('.cb-disable').addClass('selected');
            }
        });
		$(".cb-enable").click(function(){
			var parent = $(this).parents('.switch');
			//This condition is if only one element can be active, developed for repeater purposes
            //First disable all yes/no elements...
			if(parent.hasClass('edgt-switch-single-mode')) {
			    var selector = '.switch-'+ parent.data('switch-selector');
                var switchers = $(selector);
                switchers.each(function() {
                    var switcher = $(this);
                    switcher.find('.cb-disable').addClass('selected');
                    switcher.find('.cb-enable').removeClass('selected');
                    switcher.find('.checkbox').attr('checked', false);
                    switcher.find('.checkboxhidden_yesno').val("no");
                });
                //Then enable the one that is clicked
                $('.cb-disable', parent).removeClass('selected');
                $(this).addClass('selected');
                $('.checkbox',parent).attr('checked', true);
                $('.checkboxhidden_yesno',parent).val("yes");
            } else {
                $('.cb-disable', parent).removeClass('selected');
                $(this).addClass('selected');
                $('.checkbox', parent).attr('checked', true);
                $('.checkboxhidden_yesno', parent).val("yes");
                $('.checkboxhidden_onoff', parent).val("on");
                $('.checkboxhidden_portfoliofollow', parent).val("portfolio_single_follow");
                $('.checkboxhidden_zeroone', parent).val("1");
                $('.checkboxhidden_imagevideo', parent).val("image");
                $('.checkboxhidden_yesempty', parent).val("yes");
                $('.checkboxhidden_flagpost', parent).val("post");
                $('.checkboxhidden_flagpage', parent).val("page");
                $('.checkboxhidden_flagmedia', parent).val("attachment");
                $('.checkboxhidden_flagportfolio', parent).val("portfolio_page");
                $('.checkboxhidden_flagproduct', parent).val("product");
            }
		});
		$(".cb-disable").click(function(){
			var parent = $(this).parents('.switch');
            //If only one element can be active, than no value shouldn't be clickable
            if(!parent.hasClass('edgt-switch-single-mode')) {
                $('.cb-enable', parent).removeClass('selected');
                $(this).addClass('selected');
                $('.checkbox', parent).attr('checked', false);
                $('.checkboxhidden_yesno', parent).val("no");
                $('.checkboxhidden_onoff', parent).val("off");
                $('.checkboxhidden_portfoliofollow', parent).val("portfolio_single_no_follow");
                $('.checkboxhidden_zeroone', parent).val("0");
                $('.checkboxhidden_imagevideo', parent).val("video");
                $('.checkboxhidden_yesempty', parent).val("");
                $('.checkboxhidden_flagpost', parent).val("");
                $('.checkboxhidden_flagpage', parent).val("");
                $('.checkboxhidden_flagmedia', parent).val("");
                $('.checkboxhidden_flagportfolio', parent).val("");
                $('.checkboxhidden_flagproduct', parent).val("");
            }
		});
		$(".cb-enable.dependence").click(function(){
			$($(this).data('hide')).fadeOut();
			$($(this).data('show')).fadeIn();
		});
		$(".cb-disable.dependence").click(function(){
			$($(this).data('hide')).fadeOut();
			$($(this).data('show')).fadeIn();
		});
	}

    function edgtInitSaveCheckBoxesValue(){
        var checkboxes = $('.edgt-single-checkbox-field');
        checkboxes.change(function(){
            edgtDisableHidden($(this));
        });
        checkboxes.each(function(){
            edgtDisableHidden($(this));
        });
        function edgtDisableHidden(thisBox){
            if(thisBox.is(':checked')){
                thisBox.siblings('.edgt-checkbox-single-hidden').prop('disabled', true);
            }else{
                thisBox.siblings('.edgt-checkbox-single-hidden').prop('disabled', false);
            }
        }
    }

    function edgtCheckBoxMultiSelectInitState(){
        var element = $('input[type="checkbox"].dependence.multiselect');
        if(element.length){
            element.each(function() {
                var thisItem = $(this);
                edgtInitCheckBox(thisItem);
            });
        }
    }

    function edgtInitCheckBoxMultiSelectChange() {
        var element = $('input[type="checkbox"].dependence.multiselect');
        element.on('change', function(){
            var thisItem = $(this);
            edgtInitCheckBox(thisItem);
        });
    }

    function edgtInitCheckBox(checkBox){

        var thisItem = checkBox;
        var checked = thisItem.attr('checked');
        var dataShow = thisItem.data('show');

        if(checked === 'checked'){
            if(typeof(dataShow)!== 'undefined' && dataShow !== '') {
                var elementsToShow = dataShow.split(',');
                $.each(elementsToShow, function(index, value) {
                    $(value).fadeIn();
                });
            }
        }
        else{
            if(typeof(dataShow)!== 'undefined' && dataShow !== '') {
                var elementsToShow = dataShow.split(',');
                $.each(elementsToShow, function(index, value) {
                    $(value).fadeOut();
                });
            }
        }

    }

	function edgtInitTooltips() {
		$('.edgt-tooltip').tooltip();
	}

	function edgtInitColorpicker() {
		$('.edgt-page .my-color-field').wpColorPicker({
			change:    function( event, ui ) {
				$('.edgt-input-change').addClass('yes');
			}
		});
	}

	/**
	 * Function that initializes
	 */
	function edgtInitRangeSlider() {
		if($('.edgt-slider-range').length) {

			$('.edgt-slider-range').each(function() {
				var Link = $.noUiSlider.Link;

				var start       = 0;            //starting position of slider
				var min         = 0;            //minimal value
				var max         = 100;          //maximal value of slider
				var step        = 1;            //number of steps to snap to
				var orientation = 'horizontal';   //orientation. Could be vertical or horizontal
				var prefix      = '';           //prefix to the serialized value that is written field
				var postfix     = '';           //postfix to the serialized value that is written to field
				var thousand    = '';           //separator for thousand
				var decimals    = 2;            //number of decimals
				var mark        = '.';          //decimal separator

				//is data-start attribute set for current instance?
				if($(this).data('start') != null && $(this).data('start') !== "" && $(this).data('start') != "0.00") {
					start = $(this).data('start');
					if (start == "1.00") start = 1;
					if(parseInt(start) == start){
						start = parseInt(start);
					}
				}

				//is data-min attribute set for current instance?
				if($(this).data('min') != null && $(this).data('min') !== "") {
					min = $(this).data('min');
				}

				//is data-max attribute set for current instance?
				if($(this).data('max') != null && $(this).data('max') !== "") {
					max = $(this).data('max');
				}

				//is data-step attribute set for current instance?
				if($(this).data('step') != null && $(this).data('step') !== "") {
					step = $(this).data('step');
				}

				//is data-orientation attribute set for current instance?
				if($(this).data('orientation') != null && $(this).data('orientation') !== "") {
					//define available orientations
					var availableOrientations = ['horizontal', 'vertical'];

					//is data-orientation value in array of available orientations?
					if(availableOrientations.indexOf($(this).data('orientation'))) {
						orientation = $(this).data('orientation');
					}
				}

				//is data-prefix attribute set for current instance?
				if($(this).data('prefix') != null && $(this).data('prefix') !== "") {
					prefix = $(this).data('prefix');
				}

				//is data-postfix attribute set for current instance?
				if($(this).data('postfix') != null && $(this).data('postfix') !== "") {
					postfix = $(this).data('postfix');
				}

				//is data-thousand attribute set for current instance?
				if($(this).data('thousand') != null && $(this).data('thousand') !== "") {
					thousand = $(this).data('thousand');
				}

				//is data-decimals attribute set for current instance?
				if($(this).data('decimals') != null && $(this).data('decimals') !== "") {
					decimals = $(this).data('decimals');
				}

				//is data-mark attribute set for current instance?
				if($(this).data('mark') != null && $(this).data('mark') !== "") {
					mark = $(this).data('mark');
				}

				$(this).noUiSlider({
					start: start,
					step: step,
					orientation: orientation,
					range: {
						'min': min,
						'max': max
					},
					serialization: {
						lower: [
							new Link({
								target: $(this).prev('.edgt-slider-range-value')
							})
						],
						format: {
							// Set formatting
							thousand: thousand,
							postfix: postfix,
							prefix: prefix,
							decimals: decimals,
							mark: mark
						}
					}
				}).on({
					change: function(){
						$('.edgt-input-change').addClass('yes');
					}
				});
			});
		}
	}

	function edgtInitMediaUploader() {
		if($('.edgt-media-uploader').length) {
			$('.edgt-media-uploader').each(function() {
				var fileFrame;
				var uploadUrl;
				var uploadHeight;
				var uploadWidth;
				var uploadImageHolder;
				var attachment;
				var removeButton;

				//set variables values
				uploadUrl           = $(this).find('.edgt-media-upload-url');
				uploadHeight        = $(this).find('.edgt-media-upload-height');
				uploadWidth        = $(this).find('.edgt-media-upload-width');
				uploadImageHolder   = $(this).find('.edgt-media-image-holder');
				removeButton        = $(this).find('.edgt-media-remove-btn');

				if (uploadImageHolder.find('img').attr('src') != "") {
					removeButton.show();
					edgtInitMediaRemoveBtn(removeButton);
				}

				$(this).on('click', '.edgt-media-upload-btn', function() {
					//if the media frame already exists, reopen it.
					if (fileFrame) {
						fileFrame.open();
						return;
					}

					//create the media frame
					fileFrame = wp.media.frames.fileFrame = wp.media({
						title: $(this).data('frame-title'),
						button: {
							text: $(this).data('frame-button-text')
						},
						multiple: false
					});

					//when an image is selected, run a callback
					fileFrame.on( 'select', function() {
						attachment = fileFrame.state().get('selection').first().toJSON();
						removeButton.show();
						edgtInitMediaRemoveBtn(removeButton);
						//write to url field and img tag
						if(attachment.hasOwnProperty('url') && attachment.hasOwnProperty('sizes')) {
							uploadUrl.val(attachment.url);
							if (attachment.sizes.thumbnail)
								uploadImageHolder.find('img').attr('src', attachment.sizes.thumbnail.url);
							else
								uploadImageHolder.find('img').attr('src', attachment.url);
							uploadImageHolder.show();
						} else if (attachment.hasOwnProperty('url')) {
							uploadUrl.val(attachment.url);
							uploadImageHolder.find('img').attr('src', attachment.url);
							uploadImageHolder.show();
						}

						//write to hidden meta fields
						if(attachment.hasOwnProperty('height')) {
							uploadHeight.val(attachment.height);
						}

						if(attachment.hasOwnProperty('width')) {
							uploadWidth.val(attachment.width);
						}
						$('.edgt-input-change').addClass('yes');
					});

					//open media frame
					fileFrame.open();
				});
			});
		}

		function edgtInitMediaRemoveBtn(btn) {
			btn.on('click', function() {
				//remove image src and hide it's holder
				btn.siblings('.edgt-media-image-holder').hide();
				btn.siblings('.edgt-media-image-holder').find('img').attr('src', '');

				//reset meta fields
				btn.siblings('.edgt-media-meta-fields').find('input[type="hidden"]').each(function(e) {
					$(this).val('');
				});

				btn.hide();
			});
		}
	}

	function edgtInitGalleryUploader() {

		var $edgt_upload_button = jQuery('.edgt-gallery-upload-btn');

		var $edgt_clear_button = jQuery('.edgt-gallery-clear-btn');

		wp.media.customlibEditGallery1 = {

			frame: function() {

				if ( this._frame )
					return this._frame;

				var selection = this.select();

				this._frame = wp.media({
					id: 'edgt-portfolio-image-gallery',
					frame: 'post',
					state: 'gallery-edit',
					title: wp.media.view.l10n.editGalleryTitle,
					editing: true,
					multiple: true,
					selection: selection
				});

				this._frame.on('update', function() {

					var controller = wp.media.customlibEditGallery1._frame.states.get('gallery-edit');
					var library = controller.get('library');
					// Need to get all the attachment ids for gallery
					var ids = library.pluck('id');

					$input_gallery_items.val(ids);

					jQuery.ajax({
						type: "post",
						url: ajaxurl,
						data: "action=educator_edge_gallery_upload_get_images&ids=" + ids,
						success: function(data) {

							$thumbs_wrap.empty().html(data);

						}
					});
				});

				return this._frame;
			},

			init: function() {
				$edgt_upload_button.click(function(event) {
					$thumbs_wrap = $(this).parent().prev().prev();
					$input_gallery_items = $thumbs_wrap.next();

					event.preventDefault();
					wp.media.customlibEditGallery1.frame().open();
				});

				$edgt_clear_button.click(function(event) {
					$thumbs_wrap = $edgt_upload_button.parent().prev().prev();
					$input_gallery_items = $thumbs_wrap.next();

					event.preventDefault();
					$thumbs_wrap.empty();
					$input_gallery_items.val("");
				});
			},

			// Gets initial gallery-edit images. Function modified from wp.media.gallery.edit
			// in wp-includes/js/media-editor.js.source.html
			select: function() {

				var shortcode = wp.shortcode.next('gallery', '[gallery ids="' + $input_gallery_items.val() + '"]'),
					defaultPostId = wp.media.gallery.defaults.id,
					attachments, selection;

				// Bail if we didn't match the shortcode or all of the content.
				if (!shortcode)
					return;

				// Ignore the rest of the match object.
				shortcode = shortcode.shortcode;

				if (_.isUndefined(shortcode.get('id')) && !_.isUndefined(defaultPostId))
					shortcode.set('id', defaultPostId);

				attachments = wp.media.gallery.attachments(shortcode);
				selection = new wp.media.model.Selection(attachments.models, {
					props: attachments.props.toJSON(),
					multiple: true
				});

				selection.gallery = attachments.gallery;

				// Fetch the query's attachments, and then break ties from the
				// query to allow for sorting.
				selection.more().done(function() {
					// Break ties with the query.
					selection.props.set({
						query: false
					});
					selection.unmirror();
					selection.props.unset('orderby');
				});

				return selection;
			}
		};
		$(wp.media.customlibEditGallery1.init);
	}

	function edgtInitPortfolioItemAcc() {
		//remove portfolio item
		$(document).on('click', '.remove-portfolio-item', function(event) {
			event.preventDefault();
			var $toggleHolder = $(this).parent().parent().parent();
			$toggleHolder.fadeOut(300,function() {
				$(this).remove();

				//after removing portfolio image, set new rel numbers and set new ids/names
				$('.edgt-portfolio-additional-item').each(function(i){
					$(this).attr('rel',i+1);
					$(this).find('.number').text($(this).attr('rel'));
					edgtSetIdOnRemoveItem($(this),i+1);
				});
				//hide expand all button if all items are removed
				noPortfolioItemShown();
			});
			return false;
		});

		//hide expand all button if there is no items
		noPortfolioItemShown();
		function noPortfolioItemShown()  {
			if($('.edgt-portfolio-additional-item').length == 0){
				$('.edgt-toggle-all-item').hide();
			}
		}

		//expand all additional sidebar items on click on 'expand all' button
		$(document).on('click', '.edgt-toggle-all-item', function(event) {
			event.preventDefault();
			$('.edgt-portfolio-additional-item').each(function(i){

				var $toggleContent = $(this).find('.edgt-portfolio-toggle-content');
				var $this = $(this).find('.toggle-portfolio-item');
				if ($toggleContent.is(':visible')) {
				}
				else {
					$toggleContent.slideToggle();
					$this.html('<i class="fa fa-caret-down"></i>')
				}
			});
			return false;
		});
		//toggle for portfolio additional sidebar items
		$(document).on('click', '.edgt-portfolio-additional-item .edgt-portfolio-toggle-holder', function(event) {
			event.preventDefault();

			var $this = $(this);
			var $caret_holder = $this.find('.toggle-portfolio-item');
			$caret_holder.html('<i class="fa fa-caret-up"></i>');
			var $toggleContent = $this.next();
			$toggleContent.slideToggle(function() {
				if ($toggleContent.is(':visible')) {
					$caret_holder.html('<i class="fa fa-caret-up"></i>')
				}
				else {
					$caret_holder.html('<i class="fa fa-caret-down"></i>')
				}
				//hide expand all button function in case of all boxes revealed
				checkExpandAllBtn();
			});
			return false;
		});
		//hide expand all button when it's clicked
		$(document).on('click','.edgt-toggle-all-item', function(event) {
			event.preventDefault();
			$(this).hide();
		})

		function checkExpandAllBtn() {
			if($('.edgt-portfolio-additional-item .edgt-portfolio-toggle-content:hidden').length == 0){
				$('.edgt-toggle-all-item').hide();
			}else{
				$('.edgt-toggle-all-item').show();
			}
		}
	}

    function edgtInitPortfolioItemsBox() {
        var edgt_portfolio_additional_item = $('.edgt-portfolio-additional-item-holder').clone().html();
        $portfolio_item = '<div class="edgt-portfolio-additional-item" rel="">'+ edgt_portfolio_additional_item +'</div>';

        $('.edgt-portfolio-add a.edgt-add-item').click(function (event) {
            event.preventDefault();
            $(this).parent().before($($portfolio_item).hide().fadeIn(500));
            var portfolio_num = $(this).parent().siblings('.edgt-portfolio-additional-item').length;
            $(this).parent().siblings('.edgt-portfolio-additional-item:last').attr('rel',portfolio_num);
            edgtSetIdOnAddItem($(this).parent(),portfolio_num);
            $(this).parent().prev().find('.number').text(portfolio_num);
        });
    }

	function edgtSetIdOnAddItem(addButton,portfolio_num){
		addButton.siblings('.edgt-portfolio-additional-item:last').find('input[type="text"], input[type="hidden"], select, textarea').each(function(){
			var name = $(this).attr('name');
			var new_name= name.replace("_x", "[]");
			var new_id = name.replace("_x", "_"+portfolio_num);
			$(this).attr('name',new_name);
			$(this).attr('id',new_id);
		});
	}

	function edgtSetIdOnRemoveItem(portfolio,portfolio_num){
		if(portfolio_num == undefined){
			var portfolio_num = portfolio.attr('rel');
		}else{
			var portfolio_num = portfolio_num;
		}

		portfolio.find('input[type="text"], input[type="hidden"], select, textarea').each(function(){
			var name = $(this).attr('name').split('[')[0];
			var new_name = name+"[]";
			var new_id = name+"_"+portfolio_num;
			$(this).attr('name',new_name);
			$(this).attr('id',new_id);
		});
	}

	function edgtInitPortfolioMediaAcc() {
		//remove portfolio media
		$(document).on('click', '.remove-portfolio-media', function(event) {
			event.preventDefault();
			var $toggleHolder = $(this).parent().parent().parent();
			$toggleHolder.fadeOut(300,function() {
				$(this).remove();

				//after removing portfolio image, set new rel numbers and set new ids/names
				$('.edgt-portfolio-media').each(function(i){
					$(this).attr('rel',i+1);
					$(this).find('.number').text($(this).attr('rel'));
					edgtSetIdOnRemoveMedia($(this),i+1);
				});
				//hide expand all button if all medias are removed
				noPortfolioMedia()
			});  return false;
		});

		//hide 'expand all' button if there is no media
		noPortfolioMedia();
		function noPortfolioMedia() {
			if($('.edgt-portfolio-media').length == 0){
				$('.edgt-toggle-all-media').hide();
			}
		}

		//expand all portfolio medias (video and images) onClick on 'expand all' button
		$(document).on('click','.edgt-toggle-all-media', function(event) {
			event.preventDefault();
			$('.edgt-portfolio-media').each(function(i){

				var $toggleContent = $(this).find('.edgt-portfolio-toggle-content');
				var $this = $(this).find('.toggle-portfolio-media');
				if ($toggleContent.is(':visible')) {
				}
				else {
					$toggleContent.slideToggle();
					$this.html('<i class="fa fa-caret-down"></i>')
				}

			});        return false;
		});
		//toggle for portfolio media (images or videos)
		$(document).on('click', '.edgt-portfolio-media .edgt-portfolio-toggle-holder', function(event) {
			event.preventDefault();
			var $this = $(this);
			var $caret_holder = $this.find('.toggle-portfolio-media');
			$caret_holder.html('<i class="fa fa-caret-up"></i>');
			var $toggleContent = $(this).next();
			$toggleContent.slideToggle(function() {
				if ($toggleContent.is(':visible')) {
					$caret_holder.html('<i class="fa fa-caret-up"></i>')
				}
				else {
					$caret_holder.html('<i class="fa fa-caret-down"></i>')
				}
				//hide expand all button function in case of all boxes revealed
				checkExpandAllMediaBtn();
			});
			return false;
		});
		//hide expand all button when it's clicked
		$(document).on('click','.edgt-toggle-all-media', function(event) {
			event.preventDefault();
			$(this).hide();
		});
		function checkExpandAllMediaBtn() {
			if($('.edgt-portfolio-media .edgt-portfolio-toggle-content:hidden').length == 0){
				$('.edgt-toggle-all-media').hide();
			}else{
				$('.edgt-toggle-all-media').show();
			}
		}
	}

	function edgtInitPortfolioImagesVideosBox() {
		var edgt_portfolio_images = $('.edgt-hidden-portfolio-images').clone().html();
		$portfolio_image = '<div class="edgt-portfolio-images edgt-portfolio-media" rel="">'+ edgt_portfolio_images +'</div>';
		var edgt_portfolio_videos = $('.edgt-hidden-portfolio-videos').clone().html();

		$portfolio_videos = '<div class="edgt-portfolio-videos edgt-portfolio-media" rel="">'+ edgt_portfolio_videos +'</div>';
		$('a.edgt-add-image').click(function (e) {
			e.preventDefault();
			$(this).parent().before($($portfolio_image).hide().fadeIn(500));
			var portfolio_num = $(this).parent().siblings('.edgt-portfolio-media').length;
			$(this).parent().siblings('.edgt-portfolio-media:last').attr('rel',portfolio_num);
			edgtInitMediaUploaderAdded($(this).parent());
			edgtSetIdOnAddMedia($(this).parent(),portfolio_num);
			$(this).parent().prev().find('.number').text(portfolio_num);
		});

		$('a.edgt-add-video').click(function (e) {
			e.preventDefault();
			$(this).parent().before($($portfolio_videos).hide().fadeIn(500));
			var portfolio_num = $(this).parent().siblings('.edgt-portfolio-media').length;
			$(this).parent().siblings('.edgt-portfolio-media:last').attr('rel',portfolio_num);
			edgtInitMediaUploaderAdded($(this).parent());
			edgtSetIdOnAddMedia($(this).parent(),portfolio_num);
			$(this).parent().prev().find('.number').text(portfolio_num);
		});

		$(document).on('click', '.edgt-remove-last-row-media', function(event) {
			event.preventDefault();
			$(this).parent().prev().fadeOut(300,function() {
				$(this).remove();

				//after removing portfolio image, set new rel numbers and set new ids/names
				$('.edgt-portfolio-media').each(function(i){
					$(this).attr('rel',i+1);
					edgtSetIdOnRemoveMedia($(this),i+1);
				});
			});

		});
		edgtShowHidePorfolioImageVideoType();
		$(document).on('change', 'select.edgt-portfoliovideotype', function(e) {
			edgtShowHidePorfolioImageVideoType();
		});
	}

	function edgtSetIdOnAddMedia(addButton,portfolio_num){
		addButton.siblings('.edgt-portfolio-media:last').find('input[type="text"], input[type="hidden"], select, textarea').each(function(){
			var name = $(this).attr('name');
			var new_name= name.replace("_x", "[]");
			var new_id = name.replace("_x", "_"+portfolio_num);
			$(this).attr('name',new_name);
			$(this).attr('id',new_id);

		});

		edgtShowHidePorfolioImageVideoType();
	}

	function edgtSetIdOnRemoveMedia(portfolio,portfolio_num){

		if(portfolio_num == undefined){
			var portfolio_num = portfolio.attr('rel');
		}else{
			var portfolio_num = portfolio_num;
		}

		portfolio.find('input[type="text"], input[type="hidden"], select, textarea').each(function(){
			var name = $(this).attr('name').split('[')[0];
			var new_name = name+"[]";
			var new_id = name+"_"+portfolio_num;
			$(this).attr('name',new_name);
			$(this).attr('id',new_id);
		});
	}

	function edgtShowHidePorfolioImageVideoType(){

		$('.edgt-portfoliovideotype').each(function(i){
			var $selected = $(this).val();

			if($selected == "self"){
				$(this).parent().parent().parent().find('.edgt-video-id-holder').hide();
				$(this).parent().parent().parent().parent().find('.edgt-media-uploader').show();
				$(this).parent().parent().parent().find('.edgt-video-self-hosted-path-holder').show();
			}else{
				$(this).parent().parent().parent().find('.edgt-video-id-holder').show();
				$(this).parent().parent().parent().parent().find('.edgt-media-uploader').hide();
				$(this).parent().parent().parent().find('.edgt-video-self-hosted-path-holder').hide();
			}
		});
	}

	function edgtInitMediaUploaderAdded(addButton) {

		addButton.siblings('.edgt-portfolio-media:last, .edgt-slide-element-additional-item:last').find('.edgt-media-uploader').each(function(){
			var fileFrame;
			var uploadUrl;
			var uploadHeight;
			var uploadWidth;
			var uploadImageHolder;
			var attachment;
			var removeButton;

			//set variables values
			uploadUrl           = $(this).find('.edgt-media-upload-url');
			uploadHeight        = $(this).find('.edgt-media-upload-height');
			uploadWidth        = $(this).find('.edgt-media-upload-width');
			uploadImageHolder   = $(this).find('.edgt-media-image-holder');
			removeButton        = $(this).find('.edgt-media-remove-btn');

			if (uploadImageHolder.find('img').attr('src') != "") {
				removeButton.show();
				edgtInitMediaRemoveBtn(removeButton);
			}

			$(this).on('click', '.edgt-media-upload-btn', function() {
				//if the media frame already exists, reopen it.
				if (fileFrame) {
					fileFrame.open();
					return;
				}

				//create the media frame
				fileFrame = wp.media.frames.fileFrame = wp.media({
					title: $(this).data('frame-title'),
					button: {
						text: $(this).data('frame-button-text')
					},
					multiple: false
				});

				//when an image is selected, run a callback
				fileFrame.on( 'select', function() {
					attachment = fileFrame.state().get('selection').first().toJSON();
					removeButton.show();
					edgtInitMediaRemoveBtn(removeButton);
					//write to url field and img tag
					if(attachment.hasOwnProperty('url') && attachment.hasOwnProperty('sizes')) {
						uploadUrl.val(attachment.url);
						if (attachment.sizes.thumbnail)
							uploadImageHolder.find('img').attr('src', attachment.sizes.thumbnail.url);
						else
							uploadImageHolder.find('img').attr('src', attachment.url);
						uploadImageHolder.show();
					} else if (attachment.hasOwnProperty('url')) {
						uploadUrl.val(attachment.url);
						uploadImageHolder.find('img').attr('src', attachment.url);
						uploadImageHolder.show();
					}

					//write to hidden meta fields
					if(attachment.hasOwnProperty('height')) {
						uploadHeight.val(attachment.height);
					}

					if(attachment.hasOwnProperty('width')) {
						uploadWidth.val(attachment.width);
					}
					$('.edgt-input-change').addClass('yes');
				});

				//open media frame
				fileFrame.open();
			});
		});

		function edgtInitMediaRemoveBtn(btn) {
			btn.on('click', function() {
				//remove image src and hide it's holder
				btn.siblings('.edgt-media-image-holder').hide();
				btn.siblings('.edgt-media-image-holder').find('img').attr('src', '');

				//reset meta fields
				btn.siblings('.edgt-media-meta-fields').find('input[type="hidden"]').each(function(e) {
					$(this).val('');
				});

				btn.hide();
			});
		}
	}

    /**
        Slide elements script - start
    */
    function edgtInitSlideElementItemAcc() {
        //remove slide-element item
        $(document).on('click', '.remove-slide-element-item', function(event) {
            event.preventDefault();
            var $toggleHolder = $(this).parent().parent().parent();
            $toggleHolder.fadeOut(300,function() {
                $(this).remove();

                //after removing slide-element image, set new rel numbers and set new ids/names
                $('.edgt-slide-element-additional-item').each(function(i){
                    $(this).attr('rel',i+1);
                    $(this).find('.number').text($(this).attr('rel'));
                    edgtSetIdOnRemoveElement($(this),i+1);
                });
                //hide expand all button if all items are removed
                noSlideElementItemShown();
            });
            return false;
        });

        //hide expand all button if there is no items
        noSlideElementItemShown();
        function noSlideElementItemShown()  {
            if($('.edgt-slide-element-additional-item').length == 0){
                $('.edgt-toggle-all-item').hide();
            }
        }

        //expand all additional items on click on 'expand all' button
        $(document).on('click', '.edgt-toggle-all-item', function(event) {
            event.preventDefault();
            $('.edgt-slide-element-additional-item').each(function(i){

                var $toggleContent = $(this).find('.edgt-slide-element-toggle-content');
                var $this = $(this).find('.toggle-slide-element-item');
                if ($toggleContent.is(':visible')) {
                }
                else {
                    $toggleContent.slideToggle();
                    $this.html('<i class="fa fa-caret-down"></i>')
                }
            });
            return false;
        });
        //toggle for slide-element item
        $(document).on('click', '.edgt-slide-element-additional-item .edgt-slide-element-toggle-holder', function(event) {
            event.preventDefault();

            var $this = $(this);
            var $caret_holder = $this.find('.toggle-slide-element-item');
            $caret_holder.html('<i class="fa fa-caret-up"></i>');
            var $toggleContent = $this.next();
            $toggleContent.slideToggle(function() {
                if ($toggleContent.is(':visible')) {
                    $caret_holder.html('<i class="fa fa-caret-up"></i>')
                }
                else {
                    $caret_holder.html('<i class="fa fa-caret-down"></i>')
                }
                //hide expand all button function in case of all boxes revealed
                checkExpandAllBtn();
            });
            return false;
        });
        //hide expand all button when it's clicked
        $(document).on('click','.edgt-toggle-all-item', function(event) {
            event.preventDefault();
            $(this).hide();
        });

        //reveal only the fields for custom positioning of elements
        $(document).on('change', '#edgt_edgt_slide_holder_elements_alignment select', function(event) {
            var meta_box = $(this).parents('#edgt-meta-box-edgt_slides_elements');
            if ($(this).find('option:selected').attr('value') == 'custom') {
                meta_box.find('.edgt-slide-element-custom-only').slideDown(300);
                meta_box.find('.edgt-slide-element-all-but-custom').slideUp(300);
            }
            else {
                meta_box.find('.edgt-slide-element-all-but-custom').slideDown(300);
                meta_box.find('.edgt-slide-element-custom-only').slideUp(300);
            }
        });

        //reveal only the fields for certain type of the element
        $(document).on('change', '.edgt-slide-element-type-selector', function(event) {
            var type_fields_holders = $(this).parents('.edgt-slide-element-additional-item').find('.edgt-slide-element-type-fields');
            type_fields_holders.not('.edgt-setf-'+$(this).find('option:selected').attr('value')).slideUp(300);
            type_fields_holders.filter('.edgt-setf-'+$(this).find('option:selected').attr('value')).slideDown(300);
        });

        // reveal advanced text options
        $(document).on('change', '.edgt-slide-element-options-selector-text', function(event) {
            if ($(this).find('option:selected').attr('value') == 'advanced') {
                $(this).parents('.edgt-slide-element-additional-item').find('.edgt-slide-elements-advanced-text-options').slideDown(300);
                $(this).parents('.edgt-slide-element-additional-item').find('.edgt-slide-elements-simple-text-options').slideUp(300);
            }
            else {
                $(this).parents('.edgt-slide-element-additional-item').find('.edgt-slide-elements-advanced-text-options').slideUp(300);
                $(this).parents('.edgt-slide-element-additional-item').find('.edgt-slide-elements-simple-text-options').slideDown(300);
            }
        });

        // reveal responsive text options
        $(document).on('change', '.edgt-slide-element-responsive-selector', function(event) {
            if ($(this).find('option:selected').attr('value') == 'yes') {
                $(this).parents('.edgt-slide-element-type-fields').find('.edgt-slide-element-scale-factors').slideDown(300);
            }
            else {
                $(this).parents('.edgt-slide-element-type-fields').find('.edgt-slide-element-scale-factors').slideUp(300);
            }
        });

        // reveal responsive element options
        $(document).on('change', '.edgt-slide-element-responsiveness-selector', function(event) {
            if ($(this).find('option:selected').attr('value') == 'stages') {
                $(this).closest('.row').siblings('.edgt-slide-responsive-scale-factors').slideDown(300);
            }
            else {
                $(this).closest('.row').siblings('.edgt-slide-responsive-scale-factors').slideUp(300);
            }
        });

        //update the default screen width in elements
        $(document).on('change keyup', "input[name='edgt_slide_elements_default_width']", function(event) {
            $(this).parents('#edgt-meta-box-edgt_slides_elements').find('.edgt-slide-dynamic-def-width').html($(this).attr('value'));
        });

        // reveal proper icon picker
        $(document).on('change', '.edgt-slide-element-button-icon-pack', function(event) {
            var icon_pack = $(this).find('option:selected').attr('value');
            if (icon_pack == 'no_icon') {
                $(this).parents('.edgt-slide-element-additional-item').find('.edgt-slide-element-button-icon-collection').slideUp(300);
            }
            else {
                $(this)
                .parents('.edgt-slide-element-additional-item')
                .find('.edgt-slide-element-button-icon-collection.'+icon_pack).slideDown(300)
                .siblings('.edgt-slide-element-button-icon-collection').slideUp(300);
            }
        });

        function checkExpandAllBtn() {
            if($('.edgt-slide-element-additional-item .edgt-slide-element-toggle-content:hidden').length == 0){
                $('.edgt-toggle-all-item').hide();
            }else{
                $('.edgt-toggle-all-item').show();
            }
        }
    }

    function edgtInitSlideElementItemsBox() {

        $('.edgt-slide-element-add a.edgt-add-item').click(function (event) {
            var edgt_slide_element = $('.edgt-slide-element-additional-item-holder').clone().html();
            $slide_element = '<div class="edgt-slide-element-additional-item" rel="">'+ edgt_slide_element +'</div>';
            event.preventDefault();
            $(this).parent().before($($slide_element).hide().fadeIn(500));
            edgtInitMediaUploaderAdded($(this).parent());
            var elem_num = $(this).parent().siblings('.edgt-slide-element-additional-item').length;
            var item = $(this).parent().siblings('.edgt-slide-element-additional-item:last');
            item.attr('rel',elem_num);
            item.find('.wp-picker-container').each(function() {
                var picker = $(this);
                var input = picker.find('input[type="text"]');
                picker.before('<input type="text" id="'+ input.attr('id') +'" name="'+ input.attr('name') +'" value="" class="my-color-field"/>').remove();
            });
            item.find('.my-color-field').wpColorPicker();
            edgtSetIdOnAddElement($(this).parent(),elem_num);
            $(this).parent().prev().find('.number').text(elem_num);
        });
    }

    function edgtSetIdOnAddElement(addButton,elem_num){
        addButton.siblings('.edgt-slide-element-additional-item:last').find('input[type="text"], input[type="hidden"], select, textarea').each(function(){
            var name = $(this).attr('name');
            var new_name= name.replace("_x", "[]");
            var new_id = name.replace("_x", "_"+elem_num);
            $(this).attr('name',new_name);
            $(this).attr('id',new_id);
        });
    }

    function edgtSetIdOnRemoveElement(element,elem_num){
        if(elem_num == undefined){
            var elem_num = element.attr('rel');
        }else{
            var elem_num = elem_num;
        }

        element.find('input[type="text"], input[type="hidden"], select, textarea').each(function(){
            var name = $(this).attr('name').split('[')[0];
            var new_name = name+"[]";
            var new_id = name+"_"+elem_num;
            $(this).attr('name',new_name);
            $(this).attr('id',new_id);
        });
    }

    /**
        Slide elements script - end
    */
	function edgtInitAjaxForm() {
		$('#edgt_top_save_button').click( function() {
			$('.edgt_ajax_form').submit();
			if ($('.edgt-input-change.yes').length) {
				$('.edgt-input-change.yes').removeClass('yes');
			}
			$('.edgt-changes-saved').addClass('yes');
			setTimeout(function(){$('.edgt-changes-saved').removeClass('yes');}, 3000);
			return false;
		});
		$(document).delegate(".edgt_ajax_form", "submit", function (a) {
			var b = $(this);
			var c = {
				action: "educator_edge_save_options"
			};
			jQuery.ajax({
				url: ajaxurl,
				cache: !1,
				type: "POST",
				data: jQuery.param(c, !0) + "&" + b.serialize()
			}), a.preventDefault(), a.stopPropagation()
		})
	}

	function edgtInitDatePicker() {
		$( ".edgt-input.datepicker" ).datepicker( { dateFormat: "MM dd, yy" });
	}
	
    function edgtInitSelectPicker() {
        $(".edgt-selectpicker").selectpicker({
            style: 'btn-info',
            size: 10
        });
    }
    
	function edgtShowHidePostFormats(){
		$('input[name="post_format"]').each(function(){
			var id = $(this).attr('id');
			if(id !== '' && id !== undefined) {
				var	metaboxName = id.replace(/-/g, '_');
				$('#edgt-meta-box-'+ metaboxName +'_meta').hide();
			}
		});
		
		var selectedId = $("input[name='post_format']:checked").attr("id");
		if(selectedId !== '' && selectedId !== undefined) {
			var selected = selectedId.replace(/-/g, '_');
			$('#edgt-meta-box-' + selected + '_meta').fadeIn();
		}

		$("input[name='post_format']").change(function() {
			edgtShowHidePostFormats();
		});
	}

	function edgtPageTemplatesMetaBoxDependency(){
		if($('#page_template').length) {
			var selected = $('#page_template').val();
			var template_name_parts = selected.split("-");

			if (template_name_parts[0] !== 'blog') {
				$('#edgt-meta-box-blog-meta').hide();
			} else {
				$('#edgt-meta-box-blog-meta').show();
			}
			$('select[name="page_template"]').change(function () {
				edgtPageTemplatesMetaBoxDependency();
			});
		}
	}

    function edgtRepeater(){
        var wrapper = $('.edgt-repeater-wrapper');

        if(wrapper.length) {
            wrapper.each(function() {
                var thisWrapper = $(this);
                initCoreRepeater(thisWrapper);
            });
        }

        function initCoreRepeater(wrapper) {
            initRemoveRow(wrapper);
            initEmptyRow(wrapper);

            //Init add new button
            var addNew = wrapper.find('> .edgt-repeater-add .edgt-clone'); // add new button
            addNew.on('click', function (e) {
                e.preventDefault();
                var thisAddNew = $(this);
                initCloneRow(wrapper, thisAddNew);
            });
        }

        function initRemoveRow(wrapper){
            var removeBtn = wrapper.find('.edgt-clone-remove');
            removeBtn.on('click', function (e) {
                e.preventDefault();
                var thisRemoveBtn = $(this);
                var parentRow = thisRemoveBtn.closest('.edgt-repeater-fields-row');
                var fieldsHolder = thisRemoveBtn.closest('.edgt-repeater-fields-holder');
                var parentChildRepeater = !!fieldsHolder.hasClass('edgt-enable-pc');
                var thisHolderRows;

                if(fieldsHolder.hasClass('edgt-table-layout')) {
                    thisHolderRows = fieldsHolder.find('tbody tr.edgt-repeater-fields-row');
                } else {
                    if(parentChildRepeater) {
                        var name = thisRemoveBtn.data("name");
                        thisHolderRows = fieldsHolder.find('> .edgt-repeater-fields-row[data-name=' + name + ']');
                    } else {
                        thisHolderRows = fieldsHolder.find('> .edgt-repeater-fields-row');
                    }
                }

                if (thisHolderRows.length == 1) {
                    parentRow.find(':input').val('').removeAttr('checked').removeAttr('selected');
                    parentRow.hide();
                } else {
                    parentRow.remove();
                }
            });
        }

        function initEmptyRow(wrapper) {
            var fieldsHolder = wrapper.find('> .edgt-repeater-fields-holder');
            var thisHolderRows;
            if(fieldsHolder.hasClass('edgt-table-layout')) {
                thisHolderRows = fieldsHolder.find('tbody tr.edgt-repeater-fields-row');
            } else {
                thisHolderRows = fieldsHolder.find('> .edgt-repeater-fields-row');
            }

            thisHolderRows.each(function() {
                var row = $(this);
                if (row.hasClass('edgt-initially-hidden')) {
                    row.hide();
                }
            });
        }

        function initCloneRow(wrapper, button) {
            var fieldsHolder = wrapper.find('> .edgt-repeater-fields-holder');
            var parentChildRepeater = !!fieldsHolder.hasClass('edgt-enable-pc');
            var rows;
            if(fieldsHolder.hasClass('edgt-table-layout')) {
                 rows = fieldsHolder.find('tbody tr.edgt-repeater-fields-row');
            } else {
                if(parentChildRepeater) {
                    var name = button.data("name");
                    rows = fieldsHolder.find('> .edgt-repeater-fields-row[data-name=' + name + ']');
                } else {
                    rows = fieldsHolder.find('> .edgt-repeater-fields-row');
                }
            }
            var append = true; // flag for showing or appending new row
            if (rows.length == 1 && rows.css('display') == 'none') {
                rows.show();
                append = false;
            }
            if (append) {
                var child = rows.eq(0);
                //FIND FIRST ELEMENT AND DESTROY INITIALIZED SCRIPTS
                child.find('.edgt-repeater-field').each(function () {
                    var thisField = $(this);
                    thisField.find('select').each(function () {
                        var thisInput = $(this);
                        if(thisInput.hasClass('edgt-select2')) {
                            $('select.edgt-select2').select2("destroy");
                        }
                    });
                });

                var rowIndex = button.data('count'); // number of rows for changing id stored as data of add new button
                var firstChild = rows.eq(0).clone(); // clone first row
                var colorPicker = false; // flag for initializing color picker - calling wpColorPicker
                var mediaUploader = false; // flag for initializing media uploader - calling mediaUploader
                var yesNoSwitcher = false; // flag for initializing yes no switcher - calling initSwitch
                var select2 = false; // flag for initializing select2 - calling select2
                var innerRepeater = false; // flag for initializing select2 - calling select2

                firstChild.find('.edgt-repeater-field').each(function () {
                        var thisField = $(this);
                        var id = thisField.attr('id');
                        if (typeof id !== 'undefined') {
                            thisField.attr('id', id.slice(0, -1) + rowIndex); // change id - first row will have 0 as the last char
                        }
                        thisField.find(':input').each(function () {
                            var thisInput = $(this);
                            if (thisInput.hasClass('my-color-field')) { // if input type is color picker
                                thisInput.parents('.wp-picker-container').html(thisInput); // overwrite added html with field html- wpColorPicker adds it on initialization
                                colorPicker = true;
                            }
                            else if (thisInput.hasClass('edgt-media-upload-url')) {// if input type is media uploader
                                mediaUploader = true;
                                var btn = thisInput.parent().siblings('.edgt-media-remove-btn');
                                edgtInitMediaRemoveBtn(btn); // get and init new remove btn
                                btn.trigger('click'); // trigger click to reset values
                            }
                            else if(thisInput.hasClass('checkbox')) {
                                yesNoSwitcher = true;
                            }
                            thisInput.val('').removeAttr('checked').removeAttr('selected'); //empty fields values
                            if(thisInput.is(':radio')){
                                thisInput.val(fieldsHolder.find(':radio').length);
                            }
                        });
                        thisField.find('select').each(function () {
                            var thisInput = $(this);
                            if(thisInput.hasClass('edgt-select2')) {
                                select2 = true;
                            }
                        });
                    }
                );
                rows.each(function () {
                    if($(this).find('.edgt-repeater-wrapper').length) {
                        innerRepeater = true;
                    }
                });
                button.data('count', rowIndex + 1); //increase number of rows
                firstChild.appendTo(fieldsHolder); // append html
                initCoreRepeater(firstChild.find('.edgt-repeater-wrapper'));
                initRemoveRow(firstChild);
                if (colorPicker) { // reinit colorpickers
                    $('.edgt-page .my-color-field').wpColorPicker();
                }
                if (mediaUploader) {
                    // deregister click on all media buttons (multiple frames will be opened otherwise)
                    $('.edgt-media-uploader').off('click', '.edgt-media-upload-btn');
                    edgtInitMediaUploader();
                }
                if (yesNoSwitcher) {
                    edgtInitSwitch(); //init yes no switchers
                }
                if (select2) {
                    edgtSelect2(); //init select2 script
                }
            }
        }
    }

    function edgtInitSortable() {
        var sortingHolder = $('.edgt-sortable-holder');
        var enableParentChild = sortingHolder.hasClass('edgt-enable-pc');
        sortingHolder.sortable({
            handle: '.edgt-repeater-sort',
            cursor: 'move',
            placeholder: "placeholder",
            start: function(event, ui) {
                ui.placeholder.height(ui.item.height());
                if(enableParentChild) {
                    if (ui.helper.hasClass('second-level')) {
                        ui.placeholder.removeClass('placeholder');
                        ui.placeholder.addClass('placeholder-sub');
                    }
                    else {
                        ui.placeholder.removeClass('placeholder-sub');
                        ui.placeholder.addClass('placeholder');
                    }
                }
            },
            sort: function(event, ui) {
                if(enableParentChild) {
                    var pos;
                    if (ui.helper.hasClass('second-level')) {
                        pos = ui.position.left + 50;
                    }
                    else {
                        pos = ui.position.left;
                    }
                    if (pos >= 75 && !ui.helper.hasClass('second-level') && !ui.helper.hasClass('edgt-sort-parent')) {
                        ui.placeholder.removeClass('placeholder');
                        ui.placeholder.addClass('placeholder-sub');
                        ui.helper.addClass('second-level');
                    }
                    else if (pos < 30 && ui.helper.hasClass('second-level') && !ui.helper.hasClass('edgt-sort-child')) {
                        ui.placeholder.removeClass('placeholder-sub');
                        ui.placeholder.addClass('placeholder');
                        ui.helper.removeClass('second-level');
                    }
                }
            }
        });
    }

	function edgtImportOptions(){

		if($('.edgt-backup-options-page-holder').length) {
			var edgtImportBtn = $('#edgt-import-theme-options-btn');
			edgtImportBtn.on('click', function(e) {
				e.preventDefault();
				if (confirm('Are you sure, you want to import Options now?')) {
					edgtImportBtn.blur();
					edgtImportBtn.text('Please wait');
					var importValue = $('#import_theme_options').val();
					var importNonce = $('#edgt_import_theme_options_secret').val();
					var data = {
						action: 'edgt_core_import_theme_options',
						content: importValue,
						nonce: importNonce
					};
					$.ajax({
						type: "POST",
						url: ajaxurl,
						data: data,
						success: function (data) {
							var response = JSON.parse(data);
							if (response.status == 'error') {
								alert(response.message);
							} else {
								edgtImportBtn.text('Import');
								$('.edgt-bckp-message').text(response.message);
							}
						}
					});
				}
			});
		}
	}
	function edgtImportCustomSidebars(){

		if($('.edgt-backup-options-page-holder').length) {
			var edgtImportBtn = $('#edgt-import-custom-sidebars-btn');
			edgtImportBtn.on('click', function(e) {
				e.preventDefault();
				if (confirm('Are you sure, you want to import Custom Sidebars now?')) {
					edgtImportBtn.blur();
					edgtImportBtn.text('Please wait');
					var importValue = $('#import_custom_sidebars').val();
					var importNonce = $('#edgt_import_custom_sidebars_secret').val();
					var data = {
						action: 'edgt_core_import_custom_sidebars',
						content: importValue,
						nonce: importNonce
					};
					$.ajax({
						type: "POST",
						url: ajaxurl,
						data: data,
						success: function (data) {
							var response = JSON.parse(data);
							if (response.status == 'error') {
								alert(response.message);
							} else {
								edgtImportBtn.text('Import');
								$('.edgt-bckp-message').text(response.message);
							}
						}
					});
				}
			});
		}
	}
	function edgtImportWidgets(){

		if($('.edgt-backup-options-page-holder').length) {
			var edgtImportBtn = $('#edgt-import-widgets-btn');
			edgtImportBtn.on('click', function(e) {
				e.preventDefault();
				if (confirm('Are you sure, you want to import Widgets now?')) {
					edgtImportBtn.blur();
					edgtImportBtn.text('Please wait');
					var importValue = $('#import_widgets').val();
					var importNonce = $('#edgt_import_widgets_secret').val();
					var data = {
						action: 'edgt_core_import_widgets',
						content: importValue,
						nonce: importNonce
					};
					$.ajax({
						type: "POST",
						url: ajaxurl,
						data: data,
						success: function (data) {
							var response = JSON.parse(data);
							if (response.status == 'error') {
								alert(response.message);
							} else {
								edgtImportBtn.text('Import');
								$('.edgt-bckp-message').text(response.message);
							}
						}
					});
				}
			});
		}
	}

	function edgtInitImportContent(){
		var edgtImportHolder   = $('.edgt-import-page-holder');
		
		if(edgtImportHolder.length) {
			var edgtImportBtn      = $('#edgt-import-demo-data');
			var confirmMessage = edgtImportHolder.data('confirm-message');
			edgtImportBtn.on('click', function(e) {
				e.preventDefault();
	
				if (confirm(confirmMessage)) {
					$('.edgt-import-load').css('display','block');
					var progressbar     = $('#progressbar');
					var import_opt      = $('#import_option').val();
					var import_expl     = $('#import_example').val();
					var p = 0;
	
					if(import_opt == 'content'){
						for( var i=1; i < 10; i++ ){
							var str;
							if (i < 10) str = 'educator_content_0'+i+'.xml';
							else str = 'educator_content_'+i+'.xml';
							jQuery.ajax({
								type: 'POST',
								url: ajaxurl,
								data: {
									action: 'edgt_core_data_import',
									xml: str,
									example: import_expl,
									import_attachments: ($("#import_attachments").is(':checked') ? 1 : 0)
								},
								success: function(data, textStatus, XMLHttpRequest){
									p+= 10;
									$('.progress-value').html((p) + '%');
									progressbar.val(p);
									if (p == 90) {
										str = 'educator_content_10.xml';
										jQuery.ajax({
											type: 'POST',
											url: ajaxurl,
											data: {
												action: 'edgt_core_data_import',
												xml: str,
												example: import_expl,
												import_attachments: ($("#import_attachments").is(':checked') ? 1 : 0)
											},
											success: function(data, textStatus, XMLHttpRequest){
												p+= 10;
												$('.progress-value').html((p) + '%');
												progressbar.val(p);
												$('.progress-bar-message').html('<div class="alert alert-success"><strong>Import is completed</strong></div>');
											}
										});
									}
								}
							});
						}
					} else if(import_opt == 'widgets') {
						$.ajax({
							type: 'POST',
							url: ajaxurl,
							data: {
								action: 'edgt_core_widgets_import',
								example: import_expl
							},
							success: function(data, textStatus, XMLHttpRequest){
								$('.progress-value').html((100) + '%');
								progressbar.val(100);
							}
						});
						$('.progress-bar-message').html('<div class="alert alert-success"><strong>Import is completed</strong></div>');
					} else if(import_opt == 'options'){
						jQuery.ajax({
							type: 'POST',
							url: ajaxurl,
							data: {
								action: 'edgt_core_options_import',
								example: import_expl
							},
							success: function(data, textStatus, XMLHttpRequest){
								$('.progress-value').html((100) + '%');
								progressbar.val(100);
							}
						});
						$('.progress-bar-message').html('<div class="alert alert-success"><strong>Import is completed</strong></div>');
					} else if(import_opt == 'complete_content') {
						for(var i=1;i<10;i++){
							var str;
							if (i < 10) str = 'educator_content_0'+i+'.xml';
							else str = 'educator_content_'+i+'.xml';
							jQuery.ajax({
								type: 'POST',
								url: ajaxurl,
								data: {
									action: 'edgt_core_data_import',
									xml: str,
									example: import_expl,
									import_attachments: ($("#import_attachments").is(':checked') ? 1 : 0)
								},
								success: function(data, textStatus, XMLHttpRequest){
									p+= 10;
									$('.progress-value').html((p) + '%');
									progressbar.val(p);
									if (p == 90) {
										str = 'educator_content_10.xml';
										jQuery.ajax({
											type: 'POST',
											url: ajaxurl,
											data: {
												action: 'edgt_core_data_import',
												xml: str,
												example: import_expl,
												import_attachments: ($("#import_attachments").is(':checked') ? 1 : 0)
											},
											success: function(data, textStatus, XMLHttpRequest){
												jQuery.ajax({
													type: 'POST',
													url: ajaxurl,
													data: {
														action: 'edgt_core_other_import',
														example: import_expl
													},
													success: function(data, textStatus, XMLHttpRequest){
														//alert(data);
														$('.progress-value').html((100) + '%');
														progressbar.val(100);
														$('.progress-bar-message').html('<div class="alert alert-success">Import is completed.</div>');
													}
												});
											}
										});
									}
								}
							});
						}
					}
				}
				return false;
			});
		}
	}

	function edgtSelect2() {
		if ($('select.edgt-select2').length) {
			$('select.edgt-select2').select2({
                allowClear: true
            });
		}
	}

})(jQuery);