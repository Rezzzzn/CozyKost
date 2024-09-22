
    function showPaymentModal() {
        var paymentModal = new bootstrap.Modal(document.getElementById('paymentModal'), {
            keyboard: false
        });
        paymentModal.show();
    }

    function savePaymentMethod() {
        var selectedOption = document.querySelector('input[name="paymentOptions"]:checked').value;
        document.getElementById('selectedPayment').textContent = selectedOption;
    }


    function toggleSubOptions(show) {
            var subOptions = document.getElementById('ewalletOptions');
            if (show) {
                subOptions.style.display = 'block'; // Tampilkan dropdown
            } else {
                subOptions.style.display = 'none'; // Sembunyikan dropdown
            }
        }

        // Menyembunyikan sub-pilihan jika metode lain dipilih
        document.querySelectorAll('input[name="paymentOptions"]').forEach(function(radio) {
            radio.addEventListener('change', function() {
                if (this.id !== 'ewallet') {
                    toggleSubOptions(false);
                }
            });
        });

