// Load the SDK asynchronously
(function (d, s, id) {
    var js, fjs = d.getElementsByTagName(s)[0];
    if (d.getElementById(id)) {
        return;
    }
    js = d.createElement(s);
    js.id = id;
    js.src = "//connect.facebook.net/en_US/sdk.js";
    fjs.parentNode.insertBefore(js, fjs);
}(document, 'script', 'facebook-jssdk'));
if (typeof edgtSocialLoginVars !== 'undefined') {
    var facebookAppId = edgtSocialLoginVars.social.facebookAppId;
}
if (facebookAppId) {
    window.fbAsyncInit = function () {
        FB.init({
            appId: facebookAppId, //265124653818954 - test app ID
            cookie: true,  // enable cookies to allow the server to access
            xfbml: true,  // parse social plugins on this page
            version: 'v2.8' // use version 2.8
        });

        window.FB = FB;
    };
}

(function ($) {
    "use strict";

    var socialLogin = {};
    if ( typeof edgt !== 'undefined' ) {
        edgt.modules.socialLogin = socialLogin;
    }

    socialLogin.edgtUserLogin = edgtUserLogin;
    socialLogin.edgtUserRegister = edgtUserRegister;
    socialLogin.edgtUserLostPassword = edgtUserLostPassword;
    socialLogin.edgtInitWidgetModal = edgtInitWidgetModal;
    socialLogin.edgtInitFacebookLogin = edgtInitFacebookLogin;
    socialLogin.edgtInitGooglePlusLogin = edgtInitGooglePlusLogin;
    socialLogin.edgtUpdateUserProfile = edgtUpdateUserProfile;

    $(document).ready(edgtOnDocumentReady);
    $(window).load(edgtOnWindowLoad);
    $(window).resize(edgtOnWindowResize);
    $(window).scroll(edgtOnWindowScroll);

    /**
     * All functions to be called on $(document).ready() should be in this function
     */
    function edgtOnDocumentReady() {
        edgtInitWidgetModal();
        edgtUserLogin();
        edgtUserRegister();
        edgtUserLostPassword();
        edgtUpdateUserProfile();
    }

    /**
     * All functions to be called on $(window).load() should be in this function
     */
    function edgtOnWindowLoad() {
        edgtInitFacebookLogin();
        edgtInitGooglePlusLogin();
        edgtMembershipFullScreen();
    }

    /**
     * All functions to be called on $(window).resize() should be in this function
     */
    function edgtOnWindowResize() {
    }

    /**
     * All functions to be called on $(window).scroll() should be in this function
     */
    function edgtOnWindowScroll() {
    }

    /**
     * Initialize register widget modal
     */
    function edgtInitWidgetModal() {
        var modalOpeners = $('.edgt-modal-opener'),
            modalHolders = $('.edgt-modal-holder');

        if (modalOpeners.length && modalHolders.length) {

            //Init opening login modal
            modalOpeners.click(function (e) {
                e.preventDefault();
                var thisModalOpener = $(this);
                var type = thisModalOpener.data("modal");
                modalHolders.fadeOut(300);
                modalHolders.removeClass('opened');
                modalHolders.each(function(){
                   var thisModalHolder = $(this);
                   if(thisModalHolder.data('modal') !== 'undefined' && thisModalHolder.data('modal') == type) {
                       thisModalHolder.fadeIn(300);
                       thisModalHolder.addClass('opened');
                   }
                });
            });

            modalHolders.each(function() {
                var thisModalHolder = $(this);

                //Init closing login modal
                thisModalHolder.click(function (e) {
                    if (thisModalHolder.hasClass('opened')) {
                        thisModalHolder.fadeOut(300);
                        thisModalHolder.removeClass('opened');
                    }
                });

                // on esc too
                $(window).on('keyup', function (e) {
                    if (thisModalHolder.hasClass('opened') && e.keyCode == 27) {
                        thisModalHolder.fadeOut(300);
                        thisModalHolder.removeClass('opened');
                    }
                });

                var modalContent = thisModalHolder.find('.edgt-modal-content');
                modalContent.click(function (e) {
                    e.stopPropagation();
                });
            });
        }
    }

    /**
     * Login user via Ajax
     */
    function edgtUserLogin() {
        $('.edgt-login-form').on('submit', function (e) {
            e.preventDefault();
            var ajaxData = {
                action: 'edgt_membership_login_user',
                security: $(this).find('#edgt-login-security').val(),
                login_data: $(this).serialize()
            };
            $.ajax({
                type: 'POST',
                data: ajaxData,
                url: edgtGlobalVars.vars.edgtAjaxUrl,
                success: function (data) {
                    var response;
                    response = JSON.parse(data);

                    edgtRenderAjaxResponseMessage(response);
                    if (response.status == 'success') {
                        window.location = response.redirect;
                    }
                }

            });
            return false;
        });
    }

    /**
     * Register New User via Ajax
     */
    function edgtUserRegister() {

        $('.edgt-register-form').on('submit', function (e) {

            e.preventDefault();
            var ajaxData = {
                action: 'edgt_membership_register_user',
                security: $(this).find('#edgt-register-security').val(),
                register_data: $(this).serialize()
            };

            $.ajax({
                type: 'POST',
                data: ajaxData,
                url: edgtGlobalVars.vars.edgtAjaxUrl,
                success: function (data) {
                    var response;
                    response = JSON.parse(data);

                    edgtRenderAjaxResponseMessage(response);
                    if (response.status == 'success') {
                        window.location = response.redirect;
                    }
                }
            });

            return false;
        });
    }

    /**
     * Reset user password
     */
    function edgtUserLostPassword() {

        var lostPassForm = $('.edgt-reset-pass-form');
        lostPassForm.submit(function (e) {
            e.preventDefault();
            var data = {
                action: 'edgt_membership_user_lost_password',
                user_login: lostPassForm.find('#user_reset_password_login').val()
            };
            $.ajax({
                type: 'POST',
                data: data,
                url: edgtGlobalVars.vars.edgtAjaxUrl,
                success: function (data) {
                    var response = JSON.parse(data);
                    edgtRenderAjaxResponseMessage(response);
                    if (response.status == 'success') {
                        window.location = response.redirect;
                    }
                }
            });
        });
    }

    /**
     * Response notice for users
     * @param response
     */
    function edgtRenderAjaxResponseMessage(response) {

        var responseHolder = $('.edgt-membership-response-holder'), //response holder div
            responseTemplate = _.template($('.edgt-membership-response-template').html()); //Locate template for info window and insert data from marker options (via underscore)

        var messageClass;
        if (response.status === 'success') {
            messageClass = 'edgt-membership-message-succes';
        } else {
            messageClass = 'edgt-membership-message-error';
        }

        var templateData = {
            messageClass: messageClass,
            message: response.message
        };

        var template = responseTemplate(templateData);
        responseHolder.html(template);
    }

    /**
     * Facebook Login
     */
    function edgtInitFacebookLogin() {
        var loginForm = $('.edgt-facebook-login-holder');
        loginForm.submit(function (e) {
            e.preventDefault();
            window.FB.login(function (response) {
                edgtFacebookCheckStatus(response);
            }, {scope: 'email, public_profile'});
        });

    }

    /**
     * Check if user is logged into Facebook and App
     *
     * @param response
     */
    function edgtFacebookCheckStatus(response) {
        if (response.status === 'connected') {
            // Logged into your app and Facebook.
            edgtGetFacebookUserData();
        } else if (response.status === 'not_authorized') {
            // The person is logged into Facebook, but not your app.
            console.log('Please log into this app');
        } else {
            // The person is not logged into Facebook, so we're not sure if
            // they are logged into this app or not.
            console.log('Please log into Facebook');
        }
    }

    /**
     * Get user data from Facebook and login user
     */
    function edgtGetFacebookUserData() {
        console.log('Welcome! Fetching information from Facebook...');
        FB.api('/me', 'GET', {'fields': 'id, name, email, link, picture'}, function (response) {
            var nonce = $('.edgt-facebook-login-holder [name^=edgt_nonce_facebook_login]').val();
            response.nonce = nonce;
            response.image = response.picture.data.url;
            var data = {
                action: 'edgt_membership_check_facebook_user',
                response: response
            };
            $.ajax({
                type: 'POST',
                data: data,
                url: edgtGlobalVars.vars.edgtAjaxUrl,
                success: function (data) {
                    var response;
                    response = JSON.parse(data);

                    edgtRenderAjaxResponseMessage(response);
                    if (response.status == 'success') {
                        window.location = response.redirect;
                    }
                }
            });

        });
    }

    /**
     * Google Login
     */
    function edgtInitGooglePlusLogin() {

        if (typeof edgtSocialLoginVars !== 'undefined') {
            var clientId = edgtSocialLoginVars.social.googleClientId;
        }
        if (clientId) {
            gapi.load('auth2', function () {
                window.auth2 = gapi.auth2.init({
                    client_id: clientId
                });
                edgtInitGooglePlusLoginButton();
            });
        } else {
            var loginForm = $('.edgt-google-login-holder');
            loginForm.submit(function (e) {
                e.preventDefault();
            });
        }

    }

    /**
     * Initialize login button for Google Login
     */
    function edgtInitGooglePlusLoginButton() {

        var loginForm = $('.edgt-google-login-holder');
        loginForm.submit(function (e) {
            e.preventDefault();
            window.auth2.signIn();
            edgtSignInCallback();
        });

    }

    /**
     * Get user data from Google and login user
     */
    function edgtSignInCallback() {
        var signedIn = window.auth2.isSignedIn.get();
        if (signedIn) {
            var currentUser = window.auth2.currentUser.get(),
                profile = currentUser.getBasicProfile(),
                nonce = $('.edgt-google-login-holder [name^=edgt_nonce_google_login]').val(),
                userData = {
                    id: profile.getId(),
                    name: profile.getName(),
                    email: profile.getEmail(),
                    image: profile.getImageUrl(),
                    link: 'https://plus.google.com/' + profile.getId(),
                    nonce: nonce
                },
                data = {
                    action: 'edgt_membership_check_google_user',
                    response: userData
                };
            $.ajax({
                type: 'POST',
                data: data,
                url: edgtGlobalVars.vars.edgtAjaxUrl,
                success: function (data) {
                    var response;
                    response = JSON.parse(data);

                    edgtRenderAjaxResponseMessage(response);
                    if (response.status == 'success') {
                        window.location = response.redirect;
                    }
                }
            });
        }
    }

    /**
     * Update User Profile
     */
    function edgtUpdateUserProfile() {
        var updateForm = $('#edgt-membership-update-profile-form');
        if ( updateForm.length ) {
            var btnText = updateForm.find('button'),
                updatingBtnText = btnText.data('updating-text'),
                updatedBtnText = btnText.data('updated-text');

            updateForm.on('submit', function (e) {
                e.preventDefault();
                var prevBtnText = btnText.html();
                btnText.html(updatingBtnText);

                var ajaxData = {
                    action: 'edgt_membership_update_user_profile',
                    data: $(this).serialize()
                };

                $.ajax({
                    type: 'POST',
                    data: ajaxData,
                    url: edgtGlobalVars.vars.edgtAjaxUrl,
                    success: function (data) {
                        var response;
                        response = JSON.parse(data);

                        // append ajax response html
                        edgtRenderAjaxResponseMessage(response);
                        if (response.status == 'success') {
                            btnText.html(updatedBtnText);
                            window.location = response.redirect;
                        } else {
                            btnText.html(prevBtnText);
                        }
                    }
                });
                return false;
            });
        }
    }

    function edgtMembershipFullScreen() {
        var membership = $('.edgt-membership-main-wrapper');
        var profileContent = $('.page-template-user-dashboard .edgt-content');
        var footer = $('.edgt-page-footer');

        var reduceHeight = 0;

        if(!edgt.body.hasClass('edgt-header-transparent') && edgt.windowWidth > 1024) {
            reduceHeight = reduceHeight + edgtGlobalVars.vars.edgtMenuAreaHeight + edgtGlobalVars.vars.edgtLogoAreaHeight;
        }
        if(footer.length > 0) {
            reduceHeight += footer.outerHeight();
        }

        if(edgt.windowWidth > 1024) {
            var height = edgt.windowHeight - reduceHeight;
            profileContent.css({'min-height': height  + 'px'});
        }
    }

})(jQuery);