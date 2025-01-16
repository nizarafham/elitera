document.addEventListener('DOMContentLoaded', () => {
  const modal = document.getElementById('paymentModal');
  const openModalBtn = document.getElementById('openModal');
  const closeModalBtn = document.querySelector('.close');
  const paymentForm = document.getElementById('paymentForm');
  const promoCodeInput = document.getElementById('promoCode');
  const applyPromoBtn = document.getElementById('applyPromo');
  const promoDiscount = document.getElementById('promoDiscount');
  const totalPriceEl = document.getElementById('totalPrice');
  const creditCardOptions = document.getElementById('creditCardOptions');
  const eWalletOptions = document.getElementById('eWalletOptions');
  const bankTransferOptions = document.getElementById('bankTransferOptions');
  const eWalletBarcode = document.getElementById('eWalletBarcode');
  const bankTransferBarcode = document.getElementById('bankTransferBarcode');
  let totalPrice = 505000;

  // Open modal
  openModalBtn.addEventListener('click', () => {
      modal.style.display = 'block';
  });

  // Close modal
  closeModalBtn.addEventListener('click', () => {
      modal.style.display = 'none';
  });

  // Close modal when clicking outside
  window.addEventListener('click', (event) => {
      if (event.target === modal) {
          modal.style.display = 'none';
      }
  });

  // Apply promo code
  applyPromoBtn.addEventListener('click', () => {
      const promoCode = promoCodeInput.value.trim().toUpperCase();
      if (promoCode === 'DISKON50') {
          promoDiscount.textContent = 'Diskon Promo: Rp50.000';
          promoDiscount.classList.remove('hidden');
          totalPrice -= 50000;
          totalPriceEl.textContent = `Rp${totalPrice.toLocaleString('id-ID')}`;
      } else {
          alert('Kode promo tidak valid!');
      }
  });

  // Dynamic payment options
  paymentForm.addEventListener('change', (event) => {
      const method = event.target.value;
      creditCardOptions.classList.add('hidden');
      eWalletOptions.classList.add('hidden');
      bankTransferOptions.classList.add('hidden');
      eWalletBarcode.classList.add('hidden');
      bankTransferBarcode.classList.add('hidden');

      if (method === 'credit-card') {
          creditCardOptions.classList.remove('hidden');
      } else if (method === 'e-wallet') {
          eWalletOptions.classList.remove('hidden');
          eWalletBarcode.classList.remove('hidden');
      } else if (method === 'bank-transfer') {
          bankTransferOptions.classList.remove('hidden');
          bankTransferBarcode.classList.remove('hidden');
      }
  });

  // Submit form
  paymentForm.addEventListener('submit', (event) => {
      event.preventDefault();
      alert('Pembayaran berhasil dikonfirmasi!');
      modal.style.display = 'none';
  });
});
