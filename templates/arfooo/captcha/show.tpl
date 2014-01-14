<img class="captchaImage" src="{"/captcha/png/$generatedPublicCode"|url}" alt="" />
<br />
<input type="text" name="privateCode" class="input_text_small" /> 
<input type="hidden" name="publicCode" value="{$generatedPublicCode}" />
&nbsp;&nbsp;
<a href="#" class="linkGenerateNewCaptchaImg link_small_underline">{'captchaShow_generate_new_image'|lang}</a>
             