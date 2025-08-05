<section class="feedback">
    <div class="container feedback__container">
        <h1 class="text_h1-medium feedback__title">Got Questions?<br>We’ve Got Answers</h1>
        <span class="text_body feedback__text">Let us know how you'd like us to get back to you — whether it’s a quick email or a call, we’ll be in touch soon to help you out.</span>


        <div class="feedback__content">
            <form action="#" class="feedback__form ajax-form">
                <label class="feedback__input input__label">
                    <input type="text" name="name" class="text_body-small input input_checkout input_required">
                    <span class="text_body-small input__placeholder">Name</span>
                    <span class="input__error-text text_caption-small"></span>
                </label>
                <label class="feedback__input input__label input-mask input-mask_disabled">
                    <input type="text" name="phone" class="text_body-small input input_checkout input_required">
                    <span class="text_body-small input__placeholder input__placeholder_focus">Phone</span>
                    <span class="input__error-text text_caption-small"></span>
                </label>
                <label class="input__label feedback__input">
                    <div class="select">
                        <select class="select__input input input_required" name="preferred_messenger">
                            <option value hidden selected></option>
                            <option value="WhatsApp">WhatsApp</option>
                            <option value="Telegram">Telegram</option>
                            <option value="Other">Other</option>
                        </select>
                        <span class="select__placeholder text_body-small input__placeholder">Preferred Messenger</span>
                        <span class="select__value text_body-small"></span>
                        <img src="<?=get_template_directory_uri()?>/assets/images/icons/dropdown.svg" class="select__arrow" uk-svg>
                    </div>
                    <span class="input__error-text text_caption-small"></span>
                </label>
                <label class="feedback__input input__label select-extra-input select-extra-input_hidden">
                    <input type="text" name="messanger" class="text_body-small input input_checkout input_required">
                    <span class="text_body-small input__placeholder">Messenger or Contact Link</span>
                    <span class="input__error-text text_caption-small"></span>
                </label>
                <label class="feedback__input input__label">
                    <input type="text" name="email" class="text_body-small input input_checkout input_required">
                    <span class="text_body-small input__placeholder">Email</span>
                    <span class="input__error-text text_caption-small"></span>
                </label>
                <label class="feedback__input input__label feedback__input_textarea">
                    <textarea type="text" class="text_body-small input input_checkout" name="message"></textarea>
                    <span class="text_body-small input__placeholder">Message</span>
                </label>
                <button class="btn btn_white feedback__btn btn_with-load">
                    <span class="text_btn btn__text">Make the Connection</span>
                    <div class="btn__loader-wrapper">
                        <span class="loader"></span>
                    </div>
                </button>
            </form>
            <!-- <form action="#" class="feedback__form ajax-form">
                <label class="feedback__input input__label">
                    <input type="text" name="name" class="text_body-small input input_checkout input_required">
                    <span class="text_body-small input__placeholder">Name</span>
                    <span class="input__error-text text_caption-small"></span>
                </label>
                <label class="feedback__input input__label">
                    <input type="text" name="email" class="text_body-small input input_checkout input_required">
                    <span class="text_body-small input__placeholder">Email</span>
                    <span class="input__error-text text_caption-small"></span>
                </label>
                <label class="feedback__input input__label feedback__input_textarea">
                    <textarea type="text" class="text_body-small input input_checkout" name="message"></textarea>
                    <span class="text_body-small input__placeholder">Message</span>
                </label>
                <button class="btn btn_white feedback__btn btn_with-load">
                    <span class="text_btn btn__text">Make the Connection</span>
                    <div class="btn__loader-wrapper">
                        <span class="loader"></span>
                    </div>
                </button>
            </form> -->
        </div>
    </div>
</section>