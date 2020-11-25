<script>
function err(){
	alert('Please fill all required fields');
}
</script>
<?php
session_start();
  require_once('mysqli.php');
  if(isset($_POST['_process']) )
  {
	  if((($_POST['first_name']!=NULL) && ($_POST['email']!=NULL)&& ($_POST['password']!=NULL) && ($_POST['privacy_consent']!=NULL) && ($_POST['recaptcha']!=NULL)))
	  {
    $email = $_POST['email'];
    $sql_e = "SELECT * FROM users WHERE emailid='".$email."'";
    $res_e = mysqli_query($mysqli1, $sql_e);
    if($res_e && mysqli_num_rows($res_e) > 0)
    {
      $_SESSION['recur'] =  "Email Id already exists";
      header('Location: register.php');
	  exit();
    }
  
    else{
      $password = $_POST['password'];
      $sql="INSERT INTO users VALUES ('".$_POST["email"]."','".$_POST['first_name']."','".$_POST['last_name']."','".md5($password)."')";
      $mysqli1->query($sql);
      //exit();
	  $_SESSION['mes']='Account created sucessfully';
	  header("Location: signIn.php");
	  exit();
    }
	  }
	  else{
		  echo "<script> err()</script>";
	  }
  }
  
?>
<!doctype html>
<html lang="en">
<head>
  <title>Tesla SSO - Register</title>


  <!-- Required meta tags -->
<meta charset="utf-8" />
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1" />
<meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=0, viewport-fit=cover" />

<link rel="stylesheet" href="static/css/gotham-book.css" />
<link rel="stylesheet" href="static/css/gotham-medium.css" />
<link rel="stylesheet" href="static/css/minimal.bundle.css" />
<link rel="stylesheet" href="static/css/shims.min.css" />

<script src="static/js/i18next.bundle.min.js"></script>
<script src="static/js/i18n.js"></script>

    
  <script nonce="50f54088f624f1dd7773">
  function loadCaptcha() {
    var captcha = document.querySelector(".g-recaptcha");
    if (!captcha) {
      return;
    }
    
    grecaptcha.render(captcha, {
      
      //  https://developers.google.com/recaptcha/docs/language
      'hl': document.querySelector('html').getAttribute('lang'),
      'sitekey' : '6LdUQhgUAAAAAEe8NWX3Rur9bQRqq-2RUPhthpJs',
      
      'callback' : function (token) {
        var child = document.createElement('input');
        child.setAttribute('name', 'recaptcha');
        child.setAttribute('hidden', token);
        child.value = token;
        captcha.appendChild(child);
      }
    });
    
    
  };
  
  </script>
  <script src="https://www.recaptcha.net/recaptcha/api.js?onload=loadCaptcha&render=explicit" async defer nonce="50f54088f624f1dd7773"></script>
  


  <script type="text/javascript" nonce="50f54088f624f1dd7773">
    var messages = {};


    function generateLegalLink(lng, section) {
      //  Override locales
      var overrides = {
        dev: "",
        en: "",
        "en-US": ""
      };

      var locale = (lng in overrides) ? overrides[lng] : lng.replace(/-/g, "_");
      var link = "https://www.tesla.com" + (locale ? "/" + locale : "") + "/about/legal?redirect=no#" + section;

      return link;
    }

    function forEach(selector, cb) {
      Array.prototype.slice.call(document.querySelectorAll(selector)).map(cb);
    }
        
    
    document.addEventListener("DOMContentLoaded", function(event) {

      for (var prop in messages) {
        for (var i in messages[prop]) {
          if (~["privacyConsent", "optIn"].indexOf(prop)) {
            addErrorMessage(messages[prop][i], "_");
          }
          addErrorMessage(messages[prop][i], prop);
        }
      }

      i18n().data = {
        linkend: "</a>",
        link: {
          updates: "<a data-id=\"updates-link\" target=\"_blank\" rel=\"noopener noreferrer\" style=\"font-family: var(--tds-font-combined--medium);\">",
          privacy: "<a data-id=\"privacy-link\" target=\"_blank\" rel=\"noopener noreferrer\" style=\"font-family: var(--tds-font-combined--medium);\">",
          terms: "<a data-id=\"terms-link\" target=\"_blank\" rel=\"noopener noreferrer\" style=\"font-family: var(--tds-font-combined--medium);\">"
        }
      };

      
      function updateLinks(lng) {        
        forEach("[data-id=updates-link]", function(el) {
          el.href = generateLegalLink(lng, "tesla-updates");
        });

        forEach("[data-id=privacy-link]", function(el) {
          el.href = generateLegalLink(lng, "privacy-statement");
        });

        forEach("[data-id=terms-link]", function(el) {
          el.href = generateLegalLink(lng, "terms-of-use");
        });
      }
      
      i18n().afterTranslate = updateLinks;


      i18n().init(["common", "register"], function(err, t) {
        i18n().translate();

        var form = document.getElementById("form");

        var cancel = form.querySelector("#form-submit-cancel");
        if (cancel) {
          cancel.addEventListener("click", function(event) {
            form.querySelector("#form-input-cancel").value = "1";
            form.submit();
          });
        }

        var submit = form.querySelector("#form-submit-continue");
        submit.addEventListener("click", function(event) {
          event.target.disabled = true;
          form.submit();
        });

      });

    });
  </script>



</head>
<body class="">

  <div class="tmp-shell tds--fade-in">


    
<header id="tds-site-header" class="tmp-shell-row tds-site-header tds-shell-masthead tds-shell-masthead--is_sticky">
  <!-- Logo -->
  <h1 class="tds-site-logo tds-align--start">
    <a class="tds-site-logo-link" aria-label="Tesla Logo" href="https://www.tesla.com/" target="_blank">
      <svg class="tds-icon tds-icon--wordmark tds-site-logo-icon" viewBox="0 0 342 35" xmlns="http://www.w3.org/2000/svg">
        <path d="M0 .1a9.7 9.7 0 007 7h11l.5.1v27.6h6.8V7.3L26 7h11a9.8 9.8 0 007-7H0zm238.6 0h-6.8v34.8H263a9.7 9.7 0 006-6.8h-30.3V0zm-52.3 6.8c3.6-1 6.6-3.8 7.4-6.9l-38.1.1v20.6h31.1v7.2h-24.4a13.6 13.6 0 00-8.7 7h39.9v-21h-31.2v-7h24zm116.2 28h6.7v-14h24.6v14h6.7v-21h-38zM85.3 7h26a9.6 9.6 0 007.1-7H78.3a9.6 9.6 0 007 7zm0 13.8h26a9.6 9.6 0 007.1-7H78.3a9.6 9.6 0 007 7zm0 14.1h26a9.6 9.6 0 007.1-7H78.3a9.6 9.6 0 007 7zM308.5 7h26a9.6 9.6 0 007-7h-40a9.6 9.6 0 007 7z" class="tds-icon-fill--secondary" />
      </svg>
    </a>

    <!--<span class="tds-site-app-title tds-text--400 tds-text--h6">Authentication</span>-->
  </h1>

  
  <button type="button" class="tds-site-nav-item modal-locale-button" aria-label="Open Locale Modal" data-should-open="locale-modal">
    <svg width="20px" height="20px" viewBox="0 0 20 20" version="1.1" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink">
      <title>Icons/globe</title>
      <g id="sign-in" stroke="none" stroke-width="1" fill="none" fill-rule="evenodd">
        <g id="SIGNIN_TOOLTIP" transform="translate(-303.000000, -110.000000)">
          <g id="nav" transform="translate(0.000000, 92.000000)">
            <g id="language-picker" transform="translate(298.000000, 13.000000)">
              <g id="globe" transform="translate(5.000000, 5.000000)">
                <path d="M10.5,1 L10.5,5.306 L10.5288889,5.30606717 C12.9762963,5.25172399 15.1333333,4.81697862 17,4.00183105 L17,5 C15.126276,5.78071834 12.9599818,6.195724 10.5011176,6.24501699 L10.5,9.495 L19.5,9.495 L19.5,10.495 L10.5,10.495 L10.5010649,13.754982 C12.784979,13.8007628 14.8164759,14.1620651 16.5955556,14.8388889 L17,15 L17,15.9981689 C15,15.1247965 12.6666667,14.6881104 10,14.6881104 L10.5,14.693 L10.5,19 L9.5,19 L9.49987473,14.6933192 C7.04060097,14.7449565 4.87397606,15.1805167 3,16 L3,16 L3,15 C5,14.1666667 7.33333333,13.75 10,13.75 L9.5,13.755 L9.5,10.495 L0.5,10.495 L0.5,9.495 L9.5,9.495 L9.5,6.244 L9.47111111,6.24444444 C7.0237037,6.19259259 4.86666667,5.77777778 3,5 L3,4 C4.8739899,4.81948932 7.04063298,5.25504996 9.49992923,5.30668192 L9.5,1 L10.5,1 Z" id="lines" fill="#000000"></path>
                <path d="M10.0011079,1.25 C10.5722505,1.25 11.1134284,1.46775805 11.6086408,1.84731382 C12.1710694,2.27838751 12.6726543,2.91358597 13.0959933,3.69693683 C13.9677409,5.31002719 14.5,7.53980359 14.5,10 C14.5,12.4601964 13.9677409,14.6899728 13.0959933,16.3030632 C12.6726543,17.086414 12.1710694,17.7216125 11.6086408,18.1526862 C11.1134284,18.5322419 10.5722505,18.75 10.0011079,18.75 C9.42984041,18.75 8.88843826,18.5321574 8.39296255,18.1524732 C7.83028222,17.7212898 7.32838886,17.0859471 6.90476968,16.3024252 C6.03267273,14.6894033 5.5,12.4598851 5.5,10 C5.5,7.54011491 6.03267273,5.3105967 6.90476968,3.69757476 C7.32838886,2.91405289 7.83028222,2.27871018 8.39296255,1.84752684 C8.88843826,1.46784257 9.42984041,1.25 10.0011079,1.25 Z" id="oval" stroke="#000000"></path>
                <path d="M10,0 C15.5228475,0 20,4.4771525 20,10 C20,15.5228475 15.5228475,20 10,20 C4.4771525,20 0,15.5228475 0,10 C0,4.4771525 4.4771525,0 10,0 Z M10,1.5 C5.30557963,1.5 1.5,5.30557963 1.5,10 C1.5,14.6944204 5.30557963,18.5 10,18.5 C14.6944204,18.5 18.5,14.6944204 18.5,10 C18.5,5.30557963 14.6944204,1.5 10,1.5 Z" id="ring" fill="#000000"></path>
              </g>
            </g>
          </g>
        </g>
      </g>
    </svg>
    <span class="modal-locale-label" data-placeholder-locale><!-- locale --></span>
  </button>
  

</header>




    <main id="main-content" class="tmp-shell-row tmp-shell-row--stretch">
      <div class="tds-content_container tds-content_container--medium">


        <h1 class="tds-text--h1-alt" data-i18n-key="register:pageHeader">Create Account</h1>


        <div class="tds-status_msg tds-status_msg--enclosed tds--is_hidden" role="alert" data-field="_">
  <svg class="tds-status_msg-icon" xmlns="http://www.w3.org/2000/svg">
    <title>Error Icon</title>
    <description>A error icon, calling your attention to an issue preventing form submission. </description>
    <use xlink:href="#tds-error"></use>
  </svg>
  <div class="tds-status_msg-text">
    <!--
    <div class="tds-status_msg-header">
      <h6>Error</h6>
    </div>
    -->
    <div class="tds-status_msg-body">
      <!--<p>Required information is not present in form: &lt;field name&gt;</p>-->
    </div>
  </div>
</div>


        <div class="single-column-form-wrapper">
          <form method="post" action=""id="form" class="sso-form2 sign-up-form2">
          <input type="hidden" name="_csrf" value="reN4tOlc-azgpfXQw-IIMSnlju7gz5TdI2Nc" />
          <input type="hidden" name="_phase" value="register" />
          <input type="hidden" name="_process" value="1" />
          <input type="hidden" name="transaction_id" value="" />


          <div class="tds-form-item" data-field="firstName">
            <label class="tds-form-item-label" for="text-input-demo" for="form-input-first_name">
              <span data-i18n-key="register:formFirstNameLabel">First Name</span>
            </label>

            <div class="tds-text-input--wrapper">
              <input autocomplete="" class="tds-text-input" id="form-input-first_name" name="first_name" type="text"  value="" required>
            </div>

            <p class="tds-form-item-feedback"></p>
          </div>


          <div class="tds-form-item" data-field="lastName">
            <label class="tds-form-item-label" for="form-input-last_name">
              <span data-i18n-key="register:formLastNameLabel">Last Name</span>
            </label>

            <div class="tds-text-input--wrapper">
              <input autocomplete="" class="tds-text-input" id="form-input-last_name" name="last_name" type="text"  value="" required>
            </div>

            <p class="tds-form-item-feedback"></p>
          </div>


          <div class="tds-form-item" data-field="email">
            <label class="tds-form-item-label" for="form-input-email">
              <span data-i18n-key="register:formEmailLabel">Email Address</span>
            </label>

            <div class="tds-text-input--wrapper">
              <div <?php if (isset($recur)): ?> class="form_error" <?php endif ?> >
              <input autocapitalize="none" autocomplete="" class="tds-text-input" id="form-input-email" name="email" type="text" value="" />
              <?php if (isset($_SESSION['recur'])): ?>
                <span><?php echo $_SESSION['recur'];unset($_SESSION['recur']);?></span>
              <?php endif ?>
            </div>

            <p class="tds-form-item-feedback"></p>
          </div>


          <div class="tds-form-item tds-form-item--password" data-field="password" data-hideicon="tds-eye-hide" data-hidelabel="Hide Password" data-showicon="tds-eye-show" data-showlabel="Show Password">
            <label class="tds-form-item-label" for="form-input-password">
              <span data-i18n-key="register:formPasswordLabel">Password</span>

              <div class="tds-tooltip">
                <button type="button" class="tds-tooltip-trigger" aria-label="Tooltip Example">
                  <i class="tds-tooltip-icon"></i>
                </button>
                <div class="tds-tooltip-content" style="top: -143px;">
                  <span data-i18n-key="register:formPasswordTooltip">
                    Please enter a valid password that has a minimum of eight characters. Password must have at least one number and one letter.
                  </span>
                </div>
              </div>
            </label>

            <div class="tds-text-input--wrapper">
              <input class="tds-text-input" id="form-input-password" name="password" type="password" />
              <button class="tds-password-input--toggle" type="button">
                <svg class="tds-icon">
                  <title>Show Password</title>
                  <desc>Click Icon to toggle password visibility</desc>
                  <use xlink:href="#tds-eye-show"></use>
                </svg>
              </button>
            </div>

            <p class="tds-form-item-feedback"></p>
          </div>


          <div class="tds-form-item">
            <fieldset class="tds-form-fieldset">
              <div class="tds-checkboxes">

                <div class="tds-checkbox" data-field="privacyConsent">
                  <input class="tds-checkbox-input" type="checkbox" id="agree-with-privacy-and-terms" name="privacy_consent" value="1" [disabled] />
                  <label class="tds-label tds-label--checkbox" for="agree-with-privacy-and-terms">
                    <span class="tds-label-title"></span>
                    <span class="tds-label-descriptor" data-i18n-key="register:formConsentText">
                      By creating a Tesla Account, I understand and agree to Tesla's
                      <a href="https://www.tesla.com/about/legal?redirect=no#privacy-statement">Privacy Notice</a>
                      and
                      <a href="https://www.tesla.com/about/legal?redirect=no#terms-of-use">Terms of Use</a>
                    </span>
                  </label>
                </div><!-- tds-checkbox -->

                <div class="tds-checkbox" data-field="optIn">
                  <input class="tds-checkbox-input" id="receive-tesla-updates" name="opt_in" type="checkbox" value="1" [disabled] />
                  <label class="tds-label tds-label--checkbox" for="receive-tesla-updates">
                    <span class="tds-label-title"></span>
                    <span class="tds-label-descriptor" data-i18n-key="register:formOptInText">
                      Send me
                      <a href="https://www.tesla.com/about/legal?redirect=no#tesla-updates">updates</a>
                      from Tesla
                    </span>
                  </label>
                </div><!-- tds-checkbox -->

              </div><!-- tds-checkboxes -->
            </fieldset>
          </div><!-- tds-form-item -->


          
          <div class="tds-form-item tds-text--center" id="recaptcha" data-field="recaptcha">
            <div class="g-recaptcha tds-text--center"></div>
            <p class="tds-form-item-feedback"></p>
          </div>
          


          


          <submit class="tds-btn tds-btn--blue  tds-btn--full" data-i18n-key="register:formCreateSubmitLabel" name = "createAccount" id="form-submit-continue" type = "submit">
            Create Account
          </submit>

          
          
          </form>


          
            <span class="linebreak tds-text--500" data-i18n-key="pageSeparatorOrLabel">Or</span>


            <form method="post" action = "signIn.php">
              <input type="hidden" name="_csrf" value="reN4tOlc-azgpfXQw-IIMSnlju7gz5TdI2Nc" />
              <input type="hidden" name="_process" value="login" />
              <input type="hidden" name="transaction_id" value="" />
              <button type="submit" class="tds-btn tds-btn--outline tds-btn--full" data-i18n-key="register:formSignInSubmitLabel">Sign in</button>
            </form>
          

          
        </div>


      </div>
    </main>


    
<footer class="tds-footer tds-footer--centered">
  <div class="tds-container">
    <ul class="tds-footer-meta">
      <li class="tds-footer-list_item">
        <a href="https://www.tesla.com/about" class="tds-link tds-footer-list_link" target="_blank">Tesla &copy; 2020</a>
      </li>

      
      <li class="tds-footer-list_item">
        <a href="https://www.tesla.com/about/legal" class="tds-footer-list_link" target="_blank" data-i18n-key="common:footerPrivacyLinkLabel">Privacy &amp; Legal</a>
      </li>
      
      
      <li class="tds-footer-list_item">
        <a href="https://www.tesla.com/contact" class="tds-footer-list_link" target="_blank" data-i18n-key="common:footerContactLinkLabel">Contact</a>
      </li>
      
    </ul>
  </div>
</footer>




  </div>


  

<dialog id="locale-modal" class="tds-modal">
  <button type="button" class="tds-modal-close" aria-label="Close Locale Modal" data-should-close="locale-modal">
    <i class="tds-modal-close-icon"></i>
  </button>

  <section class="tds-modal-container">
  <header class="tds-modal-header"><h2>Select Your Market</h2></header>

  <section class="tds-modal-content">


    <main class="tds-modal-body_content overflow-scroll-gradient">
      <div class="locale-list-container overflow-scroll-gradient__scroller">
        
        
        <div class="locale-region--North America">
          <h4 class="tds-text--body_headline region-title notranslate">North America</h4>
          <ul class="region-list">
            <li class="region-item i18n-en_us" data-sublang="us">
              <i class="tds-icon tds-icon-flag--us"></i>
              <a rel="en_us" title="United States" class="region-link notranslate" data-lang="en-US">United States</a>
            </li>
            <li class="region-item i18n-en_ca has_sublang" data-sublang="ca">
              <i class="tds-icon tds-icon-flag--ca"></i>
              <a rel="en_ca" title="Canada" class="region-link notranslate" data-lang="en-CA">Canada</a>
            </li>
            <li class="region-item i18n-en_ca is-sublang-ca is-sublang tds--fade-in tds--is_hidden" data-sublang="ca">
              <i class="tds-icon tds-icon-flag--ca"></i>
              <a rel="en_ca" title="English" class="region-link notranslate" data-lang="en-CA">English</a>
            </li>
            <li class="region-item i18n-en_ca is-sublang-ca is-sublang tds--fade-in tds--is_hidden" data-sublang="ca">
              <i class="tds-icon tds-icon-flag--ca"></i>
              <a rel="fr_ca" title="Français" class="region-link notranslate" data-lang="fr-CA">Français</a>
            </li>
            <li class="region-item i18n-es_mx" data-sublang="mx">
              <i class="tds-icon tds-icon-flag--mx"></i>
              <a rel="es_mx" title="México" class="region-link notranslate" data-lang="es-MX">México</a>
            </li>
          </ul>
        </div>
        <div class="locale-region--Europe">
          <h4 class="tds-text--body_headline region-title notranslate">Europe</h4>
          <ul class="region-list">
            <li class="region-item i18n-nl_be has_sublang" data-sublang="be">
              <i class="tds-icon tds-icon-flag--be"></i>
              <a rel="nl_be" title="Belgium" class="region-link notranslate" data-lang="nl-BE">Belgium</a>
            </li>
            <li class="region-item i18n-en_be is-sublang-be is-sublang tds--fade-in tds--is_hidden" data-sublang="be">
              <i class="tds-icon tds-icon-flag--be"></i>
              <a rel="nl_be" title="Nederlands" class="region-link notranslate" data-lang="nl-BE">Nederlands</a>
            </li>
            <li class="region-item i18n-en_be is-sublang-be is-sublang tds--fade-in tds--is_hidden" data-sublang="be">
              <i class="tds-icon tds-icon-flag--be"></i>
              <a rel="fr_be" title="Français" class="region-link notranslate" data-lang="fr-BE">Français</a>
            </li>
            <li class="region-item i18n-cs_cz" data-sublang="cz">
              <i class="tds-icon tds-icon-flag--cz"></i>
              <a rel="cs_cz" title="Česko" class="region-link notranslate" data-lang="cs-CZ">Česko</a>
            </li>
            <li class="region-item i18n-da_dk" data-sublang="dk">
              <i class="tds-icon tds-icon-flag--dk"></i>
              <a rel="da_dk" title="Danmark" class="region-link notranslate" data-lang="da-DK">Danmark</a>
            </li>
            <li class="region-item i18n-de_de" data-sublang="de">
              <i class="tds-icon tds-icon-flag--de"></i>
              <a rel="de_de" title="Deutschland" class="region-link notranslate" data-lang="de">Deutschland</a>
            </li>
            <li class="region-item i18n-es_es" data-sublang="es">
              <i class="tds-icon tds-icon-flag--es"></i>
              <a rel="es_es" title="España" class="region-link notranslate" data-lang="es">España</a>
            </li>
            <li class="region-item i18n-fr_fr" data-sublang="fr">
              <i class="tds-icon tds-icon-flag--fr"></i>
              <a rel="fr_fr" title="France" class="region-link notranslate" data-lang="fr">France</a>
            </li>
            <li class="region-item i18n-en_gb" data-sublang="gb">
              <i class="tds-icon tds-icon-flag--gb"></i>
              <a rel="en_gb" title="United Kingdom" class="region-link notranslate" data-lang="en-GB">United Kingdom</a>
            </li>
            <li class="region-item i18n-en_ie" data-sublang="ie">
              <i class="tds-icon tds-icon-flag--ie"></i>
              <a rel="en_ie" title="Ireland" class="region-link notranslate" data-lang="en-IE">Ireland</a>
            </li>
            <li class="region-item i18n-is_is" data-sublang="is">
              <i class="tds-icon tds-icon-flag--is"></i>
              <a rel="is_is" title="Iceland" class="region-link notranslate" data-lang="is">Iceland</a>
            </li>
            <li class="region-item i18n-it_it" data-sublang="it">
              <i class="tds-icon tds-icon-flag--it"></i>
              <a rel="it_it" title="Italia" class="region-link notranslate" data-lang="it">Italia</a>
            </li>
            <li class="region-item i18n-fr_lu has_sublang" data-sublang="lu">
              <i class="tds-icon tds-icon-flag--lu"></i>
              <a rel="fr_lu" title="Luxembourg" class="region-link notranslate" data-lang="fr-LU">Luxembourg</a>
            </li>
            <li class="region-item i18n-en_lu is-sublang-lu is-sublang tds--fade-in tds--is_hidden" data-sublang="lu">
              <i class="tds-icon tds-icon-flag--lu"></i>
              <a rel="fr_lu" title="Français" class="region-link notranslate" data-lang="fr-LU">Français</a>
            </li>
            <li class="region-item i18n-en_lu is-sublang-lu is-sublang tds--fade-in tds--is_hidden" data-sublang="lu">
              <i class="tds-icon tds-icon-flag--lu"></i>
              <a rel="de_lu" title="Deutsch" class="region-link notranslate" data-lang="de-LU">Deutsch</a>
            </li>
            <li class="region-item i18n-nl_nl" data-sublang="nl">
              <i class="tds-icon tds-icon-flag--nl"></i>
              <a rel="nl_nl" title="Nederland" class="region-link notranslate" data-lang="nl">Nederland</a>
            </li>
            <li class="region-item i18n-no_no" data-sublang="no">
              <i class="tds-icon tds-icon-flag--no"></i>
              <a rel="no_no" title="Norge" class="region-link notranslate" data-lang="no">Norge</a>
            </li>
            <li class="region-item i18n-de_at" data-sublang="at">
              <i class="tds-icon tds-icon-flag--at"></i>
              <a rel="de_at" title="Österreich" class="region-link notranslate" data-lang="de-AT">Österreich</a>
            </li>
            <li class="region-item i18n-pl_pl" data-sublang="pl">
              <i class="tds-icon tds-icon-flag--pl"></i>
              <a rel="pl_pl" title="Polska" class="region-link notranslate" data-lang="pt">Polska</a>
            </li>
            <li class="region-item i18n-pt_pt" data-sublang="pt">
              <i class="tds-icon tds-icon-flag--pt"></i>
              <a rel="pt_pt" title="Portugal" class="region-link notranslate" data-lang="pt">Portugal</a>
            </li>
            <li class="region-item i18n-fr_ch has_sublang" data-sublang="ch">
              <i class="tds-icon tds-icon-flag--ch"></i>
              <a rel="fr_ch" title="Switzerland" class="region-link notranslate" data-lang="fr-CH">Switzerland</a>
            </li>
            <li class="region-item i18n-en_ch is-sublang-ch is-sublang tds--fade-in tds--is_hidden" data-sublang="ch">
              <i class="tds-icon tds-icon-flag--ch"></i>
              <a rel="fr_ch" title="Français" class="region-link notranslate" data-lang="fr-CH">Français</a>
            </li>
            <li class="region-item i18n-en_ch is-sublang-ch is-sublang tds--fade-in tds--is_hidden" data-sublang="ch">
              <i class="tds-icon tds-icon-flag--ch"></i>
              <a rel="de_ch" title="Deutsch" class="region-link notranslate" data-lang="de-CH">Deutsch</a>
            </li>
            <li class="region-item i18n-en_ch is-sublang-ch is-sublang tds--fade-in tds--is_hidden" data-sublang="ch">
              <i class="tds-icon tds-icon-flag--ch"></i>
              <a rel="it_ch" title="Italiano" class="region-link notranslate" data-lang="it-CH">Italiano</a>
            </li>
            <li class="region-item i18n-sv_se" data-sublang="se">
              <i class="tds-icon tds-icon-flag--se"></i>
              <a rel="sv_se" title="Sverige" class="region-link notranslate" data-lang="sv-SE">Sverige</a>
            </li>
            <li class="region-item i18n-fi_fi" data-sublang="fi">
              <i class="tds-icon tds-icon-flag--fi"></i>
              <a rel="fi_fi" title="Suomi" class="region-link notranslate" data-lang="fi">Suomi</a>
            </li>
            <li class="region-item i18n-en_eu" data-sublang="eu">
              <i class="tds-icon tds-icon-flag--eu"></i>
              <a rel="en_eu" title="Other Europe" class="region-link notranslate" data-lang="en-EU">Other Europe</a>
            </li>
          </ul>
        </div>
        <div class="locale-region--Middle-East">
          <h4 class="tds-text--body_headline region-title notranslate">Middle-East</h4>
          <ul class="region-list">
            <li class="region-item i18n-en_ae" data-sublang="ae">
              <i class="tds-icon tds-icon-flag--ae"></i>
              <a rel="en_ae" title="UAE" class="region-link notranslate" data-lang="en-AE">UAE</a>
            </li>
            <li class="region-item i18n-en_jo" data-sublang="jo">
              <i class="tds-icon tds-icon-flag--jo"></i>
              <a rel="en_jo" title="Jordan" class="region-link notranslate" data-lang="en-JO">Jordan</a>
            </li>
          </ul>
        </div>
        <div class="locale-region--Asia/Pacific">
          <h4 class="tds-text--body_headline region-title notranslate">Asia/Pacific</h4>
          <ul class="region-list">
            <li class="region-item i18n-zh_cn" data-sublang="cn">
              <i class="tds-icon tds-icon-flag--cn"></i>
              <a rel="zh_cn" title="中国大陆" class="region-link notranslate" data-lang="zh-CN">中国大陆</a>
            </li>
            <li class="region-item i18n-zh_hk has_sublang" data-sublang="hk">
              <i class="tds-icon tds-icon-flag--hk"></i>
              <a rel="zh_hk" title="Hong Kong" class="region-link notranslate" data-lang="zh-HK">Hong Kong</a>
            </li>
            <li class="region-item i18n-en_hk is-sublang-hk is-sublang tds--fade-in tds--is_hidden" data-sublang="hk">
              <i class="tds-icon tds-icon-flag--hk"></i>
              <a rel="zh_hk" title="中文" class="region-link notranslate" data-lang="zh-HK">中文</a>
            </li>
            <li class="region-item i18n-en_hk is-sublang-hk is-sublang tds--fade-in tds--is_hidden" data-sublang="hk">
              <i class="tds-icon tds-icon-flag--hk"></i>
              <a rel="en_hk" title="English" class="region-link notranslate" data-lang="en-HK">English</a>
            </li>
            <li class="region-item i18n-en_mo has_sublang" data-sublang="mo">
              <i class="tds-icon tds-icon-flag--mo"></i>
              <a rel="en_mo" title="Macau" class="region-link notranslate" data-lang="en-MO">Macau</a>
            </li>
            <li class="region-item i18n-en_mo is-sublang-mo is-sublang tds--fade-in tds--is_hidden" data-sublang="mo">
              <i class="tds-icon tds-icon-flag--mo"></i>
              <a rel="en_mo" title="English" class="region-link notranslate" data-lang="en-MO">English</a>
            </li>
            <li class="region-item i18n-en_mo is-sublang-mo is-sublang tds--fade-in tds--is_hidden" data-sublang="mo">
              <i class="tds-icon tds-icon-flag--mo"></i>
              <a rel="zh_mo" title="中文" class="region-link notranslate" data-lang="zh-MO">中文</a>
            </li>
            <li class="region-item i18n-zh_tw" data-sublang="tw">
              <i class="tds-icon tds-icon-flag--tw"></i>
              <a rel="zh_tw" title="台灣" class="region-link notranslate" data-lang="zh-TW">台灣</a>
            </li>
            <li class="region-item i18n-ja_jp" data-sublang="jp">
              <i class="tds-icon tds-icon-flag--jp"></i>
              <a rel="ja_jp" title="日本" class="region-link notranslate" data-lang="ja-JP">日本</a>
            </li>
            <li class="region-item i18n-ko_kr" data-sublang="kr">
              <i class="tds-icon tds-icon-flag--kr"></i>
              <a rel="ko_kr" title="대한민국" class="region-link notranslate" data-lang="ko-KR">대한민국</a>
            </li>
            <li class="region-item i18n-en_au" data-sublang="au">
              <i class="tds-icon tds-icon-flag--au"></i>
              <a rel="en_au" title="Australia" class="region-link notranslate" data-lang="en-AU">Australia</a>
            </li>
            <li class="region-item i18n-en_nz" data-sublang="nz">
              <i class="tds-icon tds-icon-flag--nz"></i>
              <a rel="en_nz" title="New Zealand" class="region-link notranslate" data-lang="en-NZ">New Zealand</a>
            </li>
          </ul>
        </div>
        
        
      </div>
    </main>


  </section>
</section>
</dialog>


<div class="tds-modal-backdrop" data-should-close="tds-modal-fullscreen-example"></div>


<div id="spinner-modal" class="tds-spinner tds-spinner--fade_out tds-spinner-fullscreen"></div>


<!-- Animated Backdrop -->
<div class="tds-site-nav--flyout-backdrop" data-tds-close="mobile-flyout"></div>


<!-- SVG lookup table - Following pattern from design.tesla.com -->
<div class="tds--is_visually_hidden">
  <svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink">
    <symbol xmlns="http://www.w3.org/2000/svg" viewBox="0 0 30 30" id="tds-eye-hide--inverted"><g fill="#fff" fill-rule="evenodd" transform="translate(6 7)"><path fill-rule="nonzero" d="M17.51 7.81c0 1.48-4.1 5.75-8.77 5.75a8.5 8.5 0 01-2.49-.4l1.23-1.22c.42.08.84.12 1.26.12 1.8 0 3.62-.76 5.2-2.01 1.14-.9 2.04-2.05 2.04-2.24 0-.2-.89-1.34-2.02-2.24l-.06-.05 1.07-1.07c1.56 1.23 2.55 2.63 2.54 3.36zm-5.27 0a3.5 3.5 0 01-4.08 3.45l4.03-4.03c.04.19.05.38.05.58zm-3.5-5.75c.88 0 1.74.15 2.56.4L10.07 3.7a6.89 6.89 0 00-1.33-.13c-1.82 0-3.64.76-5.21 2-1.14.9-2 2.05-2 2.25 0 .19.87 1.34 2.01 2.24l.1.07-1.07 1.08C1 9.95 0 8.54 0 7.8c0-1.48 4.08-5.73 8.74-5.75zm0 2.25c.23 0 .44.02.65.06L5.3 8.46a3.52 3.52 0 013.44-4.15z"/><rect width="1.5" height="19.62" x="8.01" y="-2" rx=".75" transform="scale(-1 1) rotate(-45 0 28.95)"/></g></symbol>
    <symbol xmlns="http://www.w3.org/2000/svg" viewBox="0 0 30 30" id="tds-eye-hide"><g fill="#000" fill-rule="evenodd" transform="translate(6 7)"><path fill-rule="nonzero" d="M17.51 7.81c0 1.48-4.1 5.75-8.77 5.75a8.5 8.5 0 01-2.49-.4l1.23-1.22c.42.08.84.12 1.26.12 1.8 0 3.62-.76 5.2-2.01 1.14-.9 2.04-2.05 2.04-2.24 0-.2-.89-1.34-2.02-2.24l-.06-.05 1.07-1.07c1.56 1.23 2.55 2.63 2.54 3.36zm-5.27 0a3.5 3.5 0 01-4.08 3.45l4.03-4.03c.04.19.05.38.05.58zm-3.5-5.75c.88 0 1.74.15 2.56.4L10.07 3.7a6.89 6.89 0 00-1.33-.13c-1.82 0-3.64.76-5.21 2-1.14.9-2 2.05-2 2.25 0 .19.87 1.34 2.01 2.24l.1.07-1.07 1.08C1 9.95 0 8.54 0 7.8c0-1.48 4.08-5.73 8.74-5.75zm0 2.25c.23 0 .44.02.65.06L5.3 8.46a3.52 3.52 0 013.44-4.15z"/><rect width="1.5" height="19.62" x="8.01" y="-2" rx=".75" transform="scale(-1 1) rotate(-45 0 28.95)"/></g></symbol>
    <symbol xmlns="http://www.w3.org/2000/svg" viewBox="0 0 30 30" id="tds-eye-show--inverted"><g fill="none" fill-rule="evenodd" stroke="#fff" transform="translate(7 10)"><circle cx="8" cy="5" r="2.31" stroke-width="2.37"/><path stroke-width="1.5" d="M8 0c4.49 0 8 4.13 8 5 0 .87-3.56 5-8 5-4.44 0-8-4.12-8-5 0-.88 3.51-5 8-5z"/></g></symbol>
    <symbol xmlns="http://www.w3.org/2000/svg" viewBox="0 0 30 30" id="tds-eye-show"><g fill="none" stroke="#000" fill-rule="evenodd" transform="translate(7 10)"><circle cx="8" cy="5" r="2.31" stroke-width="2.37"/><path stroke-width="1.5" d="M8 0c4.49 0 8 4.13 8 5 0 .87-3.56 5-8 5-4.44 0-8-4.12-8-5 0-.88 3.51-5 8-5z"/></g></symbol>
    <symbol xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" id="tds-error"><g fill="none" fill-rule="evenodd"><circle cx="10" cy="10" r="10" fill="#ED4E3B"/><path fill="#fff" d="M10.075 4.5c.65 0 1.179.528 1.179 1.179v4.714a1.179 1.179 0 11-2.358 0V5.679A1.18 1.18 0 0110.075 4.5zm0 8.25a1.375 1.375 0 110 2.75 1.375 1.375 0 010-2.75z"/></g></symbol>
    <symbol xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 18" id="tds-warning"><g fill="none" fill-rule="evenodd"><path d="M0-1h20v20H0z"/><path fill="#FBB01B" d="M12.825 1.627l6.663 11.077C20.875 15.009 19.28 18 16.663 18H3.337C.72 18-.875 15.01.512 12.704L7.175 1.627a3.266 3.266 0 015.65 0z"/><path d="M10.075 4c.65 0 1.179.528 1.179 1.179v4.714a1.179 1.179 0 11-2.358 0V5.179A1.18 1.18 0 0110.075 4zm0 8.25a1.375 1.375 0 110 2.75 1.375 1.375 0 010-2.75z" fill="#FFF"/></g></symbol>
  </svg>
</div>


<script src="static/js/minimal.bundle.js" type="application/javascript"></script>
<script src="static/scripts/utils.js" type="application/javascript"></script>
<script src="static/js/site.js" type="application/javascript"></script>
  <script src="static/js/tds-text-inputs--password.js" type="application/javascript"></script>

  <!-- @todo rolling index crypto keys: http://bitly.com/2WXBRNp -->
</body>
</html>
