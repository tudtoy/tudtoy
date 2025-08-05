<section class="verify">
    <div class="container verify__container">
        <h1 class="text_h1-medium verify__title">Verify your TUD</h1>
        <span class="text_body verify__text">Your certificate has the Unique Identifier for your TUD. Use it to verify and learn more about your art piece by entering it below.</span>
        <form action="#" class="verify__form">
            <div class="verify__input-wrapper">
                <label class="input__label verify__label">
                    <input type="text" name="code" class="text_body input verify__input">
                    <span class="text_body input__placeholder verify__placeholder">Unique Identifier</span>
                </label>
                <button class="btn btn_with-load text_btn verify__btn">
                    <span class="btn__text">Verify</span>
                    <div class="btn__loader-wrapper">
                        <span class="loader"></span>
                    </div>
                </button>
            </div>
            <div class="verify__error">
                <div class="verify__error-text">
                    <span class="verify__error-text">
                        Invalid Verification Code.<br> Try again or <a href="#support" uk-toggle class="underline verify__error-link">contact support.</a>
                    </span>
                </div>
            </div>
        </form>
    </div>
</section>