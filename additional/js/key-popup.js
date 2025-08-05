// add to cart
$(document).on('addToCart:success', function(event, responseData, $button) {
  if (localStorage.getItem('is_apply_key_popup') !== "true") {
    localStorage.setItem('is_show_popup', 'true');
  }
});

// close popup with button
$(document).ready(function() {

  var modal = UIkit.modal('#key-popup');
  
  if (localStorage.getItem('is_show_popup') == "true") {
    setTimeout(function() {
      modal.show();
    }, 5000);
  }
  
  $(document).on('click', '#key-popup .uk-modal-close-default', function() {
    localStorage.setItem('is_show_popup', 'false');
  });

    $(document).on('click', '#cart-widget .cart-widget__close', function() {
        if (localStorage.getItem('is_show_popup') == "true") {
            setTimeout(function() {
            modal.show();
            }, 5000);
        }
    });
});

document.querySelector('.promo-key').addEventListener('click', function() {

  const promoCode = this.querySelector('.promo-box').textContent;
  
  const textarea = document.createElement('textarea');
  textarea.value = promoCode;
  textarea.style.position = 'fixed';
  document.body.appendChild(textarea);
  textarea.select();
  
  try {

    const successful = document.execCommand('copy');
    if (successful) {

      showNotification('Promo code copied: ' + promoCode);
    }
  } catch (err) {
    console.error('Error:', err);
  } finally {
    document.body.removeChild(textarea);
  }
});

function showNotification(message, isError = false) {
  const notification = document.createElement('div');
  notification.textContent = message;
  notification.style.position = 'fixed';
  notification.style.bottom = '20px';
  notification.style.right = '20px';
  notification.style.padding = '10px 15px';
  //notification.style.background = isError ? '#ff4444' : '#4CAF50';
  notification.style.background = '#4CAF50';
  notification.style.color = 'white';
  notification.style.borderRadius = '4px';
  notification.style.zIndex = '10000';
  notification.style.animation = 'fadeIn 0.3s';
  
  document.body.appendChild(notification);
  
  setTimeout(() => {
    notification.style.animation = 'fadeOut 0.3s';
    setTimeout(() => {
      document.body.removeChild(notification);
    }, 300);
  }, 3000);
}

const style = document.createElement('style');
style.textContent = `
  @keyframes fadeIn {
    from { opacity: 0; transform: translateY(10px); }
    to { opacity: 1; transform: translateY(0); }
  }
  @keyframes fadeOut {
    from { opacity: 1; transform: translateY(0); }
    to { opacity: 0; transform: translateY(10px); }
  }
`;
document.head.appendChild(style);



document.addEventListener('DOMContentLoaded', function() {
    // 1. Копирование промокода
    const promoElement = document.getElementById('promoCode');
    if (promoElement) {
        promoElement.addEventListener('click', function() {
            const promoCode = this.textContent.trim();
            copyToClipboard(promoCode);
        });
    }

    // 2. Применение промокода в корзине
    const applyButton = document.querySelector('.key-popup__cart-button');
    if (applyButton) {
        applyButton.addEventListener('click', function(e) {
            e.preventDefault();
            applyPromoCode();
            localStorage.setItem('is_show_popup', 'false');
        });
    }

    // Функция копирования в буфер
    function copyToClipboard(text) {
        navigator.clipboard.writeText(text).then(() => {
            showNotification('Promo code copied: ' + text, 'success');
        }).catch(() => {
            // Fallback для старых браузеров
            const textarea = document.createElement('textarea');
            textarea.value = text;
            document.body.appendChild(textarea);
            textarea.select();
            document.execCommand('copy');
            document.body.removeChild(textarea);
            showNotification('Promo code copied: ' + text, 'primary');
        });
    }

    // Функция применения промокода
    function applyPromoCode() {
        const promoCode = document.getElementById('promoCode').textContent.trim();
        if (!promoCode) {
            showNotification('Promo code not found!', 'danger');
            return;
        }

        const button = document.querySelector('.key-popup__cart-button');
        button.classList.add('loading');
        button.disabled = true;

        // AJAX запрос к вашему обработчику
        $.ajax({
            type: 'POST',
            url: keyPopup.ajaxurl, // WordPress AJAX URL
            data: {
                action: 'apply_collectors_key',
                coupon_code: promoCode,
                security: keyPopup.nonce // Nonce для безопасности
            },
            success: function(response) {                
                if (response.includes('success')) {
                  localStorage.setItem('is_apply_key_popup', 'true');
                  localStorage.setItem('is_show_popup', 'false');
                    // Если успешно - перенаправляем в корзину через 1 секунду
                    setTimeout(function() {
                        window.location.href = '/cart/';
                    }, 1000);
                } else {
                    $button.removeClass('loading').text('Apply in Cart');
                }
            },
            error: function() {
                $button.removeClass('loading').text('Apply in Cart');
            }
        });
    }
});
